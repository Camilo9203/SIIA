<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Solicitudes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EstadisticasModel');
	}
	// Traer datos solicitud
	public function solicitud($idSolicitud)
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');
		$data['title'] = 'Panel Principal';
		$data['logged_in'] = $logged;
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['estado'] = $this->estadoOrganizaciones();
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();
		$data['data_solicitud'] = $this->cargarSolicitud($idSolicitud);
		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad($idSolicitud);
		$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal($idSolicitud);
		$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo($idSolicitud);
		$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos($idSolicitud);
		$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion($idSolicitud);
		$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma($idSolicitud);
		$data['data_modalidad_en_linea'] = $this->cargarDatos_modalidad_en_linea($idSolicitud);
		$data['data_programas'] = $this->cargarDatos_programas($idSolicitud);
		$data["camara"] = $this->cargarCamaraComercio();
		$data['informacionModal'] = $this->cargar_informacionModal();
		$this->load->view('include/header', $data);
		$this->load->view('paneles/solicitud', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Variables de Session
	public function datosSession()
	{
		verify_session_admin();
		date_default_timezone_set("America/Bogota");
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
		);
		return $data;
	}
	// Tipo solicitud
	public function guardar_tipoSolicitud()
	{
		/* $this->form_validation->set_rules('tipo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('motivo_solicitud','','trim|required|min_length[3]|xss_clean'); */
		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $organizacion->id_organizacion;
			$nombre_org =  $organizacion->nombreOrganizacion;
			$data_tipoSolicitud = array(
				'tipoSolicitud' =>$this->input->post('tipo_solicitud'),
				'motivoSolicitud' => $this->input->post('motivo_solicitud'),
				'modalidadSolicitud' => $this->input->post('modalidad_solicitud'),
				'idSolicitud' => date('YmdHis') . $nombre_org[3] . random(2),
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				'motivosSolicitud' => json_encode($this->input->post('motivos_solicitud')),
				'modalidadesSolicitud' => json_encode($this->input->post('modalidades_solicitud'))
			);

			$estado = $this->estadoOrganizaciones();
			$numeroSolicitudes = $this->numeroSolicitudes();
			$data_update_solicitud = array(
				'numeroSolicitudes' => $numeroSolicitudes += 1,
				'fecha' =>  date('Y/m/d H:i:s'),
				'organizaciones_id_organizacion' => $id_organizacion
			);
			$this->db->where('organizaciones_id_organizacion', $id_organizacion);
			// TODO: Cambiar por insert
			$this->db->update('solicitudes', $data_update_solicitud);
			// TODO: Borrar inicio
			if ($tipo_solicitud == "Acreditación Primera vez" && $motivo_solicitud != "Actualizar Datos") {
				$nombre = "En Proceso";
			}
			else if ($tipo_solicitud == "Renovacion de Acreditación") {
				$nombre = "En Proceso de Renovación";
			}
			else if ($tipo_solicitud == "Actualización de datos") {
				$nombre = "En Proceso de Actualización";
			}
			else if ($motivo_solicitud == "Actualizar Datos") {
				$nombre = "En Proceso de Actualización";
			}
			// TODO: Borrar fin
			// TODO: Se cambio la variable $nombre por "En Proceso"
			$data_estado = array(
				'nombre' => "En Proceso",
				'fecha' => date('Y/m/d H:i:s'),
				'estadoAnterior' => $estado,
				'organizaciones_id_organizacion' => $id_organizacion
			);
			$this->db->where('organizaciones_id_organizacion', $id_organizacion);
			// TODO: Cambiar por insert
			$this->db->update('estadoOrganizaciones', $data_estado);
			$datos_tipos = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
			if ($datos_tipos == NULL) {
				$this->db->insert('tipoSolicitud', $data_tipoSolicitud);
				echo json_encode(array('url' => "panel", 'msg' => "Se guardo el tipo de solicitud.", "est" => $nombre));
				$this->envio_mailcontacto("inicia", 2);
				$this->logs_sia->session_log('Formulario Motivo Solicitud tipoSolicitud motivoSolicitud modalidadSolicitud: ' . $tipo_solicitud . ' con el ID: ' . $numeroSolicitud);
				$this->logs_sia->logQueries();
			}
			else {
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('tipoSolicitud', $data_tipoSolicitud);
				echo json_encode(array('url' => "panel", 'msg' => "Se guardo el tipo de soliditud.", "est" => $nombre));
				$this->envio_mailcontacto("inicia", 2);
				$this->logs_sia->session_log('Formulario Motivo Solicitud - Tipo Solicitud: ' . $tipo_solicitud . '. Motivo Solicitud: ' . $motivo_solicitud . '. Modalidad Solicitud: ' . $modalidad_solicitud . '. ID: ' . $numeroSolicitud . '. Fecha: ' . date('Y/m/d') . '.');
				$this->logs_sia->logQueries();
			}
		}
	}
	// Verificar tipo solicitud
	public function verificar_tipoSolicitud()
	{
		/*$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$tipoSolicitudBD = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$tipoSolicitud = $tipoSolicitudBD ->tipoSolicitud;

		$motivoSolicitudBD = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$motivoSolicitud = $motivoSolicitudBD ->motivoSolicitud;

		$estadoBD = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$estadoAnterior = $estadoBD ->estadoAnterior;
		$estado = $estadoBD ->nombre;*/

		$tipoSolicitud = $this->cargarTipoSolicitud();
		$estado = $this->estadoOrganizaciones();
		$estadoAnterior = $this->estadoAnteriorOrganizaciones();

		if ($estado == "En Proceso" && ($estadoAnterior == "Inscrito" || $estadoAnterior == "Revocada" || $estadoAnterior == "Finalizado")) {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "1", 'estado' => "1"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Inscrito" && $tipoSolicitud == NULL) {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "2", 'estado' => "2"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Inscrito" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "3", 'estado' => "2"));
		}
		if ($estado == "En Proceso de Renovación" && $estadoAnterior == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "4", 'estado' => "1"));
		}
		if ($estado == "En Proceso de Renovación" && $estadoAnterior == "Acreditado" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "5", 'estado' => "0"));
		}
		if ($estado == "En Proceso de Actualización" && $estadoAnterior == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "6", 'estado' => "1"));
		}
		if ($estado == "En Proceso de Actualización" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "6.1", 'estado' => "1"));
		}
		/*if($estado == "Finalizado" && $estadoAnterior == "Finalizado"){
			echo json_encode(array('est' => $estado, 'url'=>"panel", 'msg'=>"6.2", 'estado' => "0"));
		}*/
		if ($estado == "En Proceso de Actualización" && $estadoAnterior == "Acreditado" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "7", 'estado' => "0"));
		}
		if ($estado == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "8", 'estado' => "0"));
		}
		if ($estado == "En Observaciones" && $estadoAnterior == "En Proceso") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "9", 'estado' => "1"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "10", 'estado' => "1"));
		}
		if ($estado == "En Observaciones" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "11", 'estado' => "1"));
		}
		if ($estado == "Negada" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "12", 'estado' => "2"));
		}
		if ($estado == "Revocada" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "13", 'estado' => "2"));
		}
		if ($estado == "Negada" && $estadoAnterior == "Negada") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "14", 'estado' => "2"));
		}
		if ($estado == "Revocada" && $estadoAnterior == "Revocada") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "15", 'estado' => "2"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Negada") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "16", 'estado' => "1"));
		}
		if ($estado == "Finalizado" && $estadoAnterior == "Finalizado" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "17", 'estado' => "0"));
		}
		if ($estado == "En Proceso de Renovación" && $estadoAnterior == "Finalizado" && $tipoSolicitud == "Renovacion de Acreditación") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "18", 'estado' => "1"));
		}
	}
	public function numeroSolicitudes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$solicitudes = $this->db->select("numeroSolicitudes")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$numeroSolicitudes = $solicitudes->numeroSolicitudes;
		return $numeroSolicitudes;
	}
}
