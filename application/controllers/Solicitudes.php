<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Solicitudes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EstadisticasModel');
		$this->load->model('SolicitudesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('AdministradoresModel');
	}

	/** Datos de sesión administrador */
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
			'activeLink' => 'solicitudes',
			'departamentos' => $this->DepartamentosModel->getDepartamentos(),
		);
		return $data;
	}
	/** Cargar Solicitud  */
	public function cargarDatosSolicitud(){
		$solicitud = $this->SolicitudesModel->solicitudes($this->input->post('idSolicitud'));
		echo json_encode(array('solicitud' => $solicitud));
	}
	/** Tipo solicitud */
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
	/** Verificar tipo solicitud */
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
	/** Verificar numero de solicitudes */
	public function numeroSolicitudes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$solicitudes = $this->db->select("numeroSolicitudes")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$numeroSolicitudes = $solicitudes->numeroSolicitudes;
		return $numeroSolicitudes;
	}
	/** Asignación de solicitudes   */
	public function asignarSolicitudes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Organizaciones / Asignar';
		$data['solicitudesSinAsignar'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesSinAsignar'];
		$data['solicitudesAsignadas'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesAsignadas'];
		$data['administradores'] = $this->AdministradoresModel->getAdministradores();
		$this->load->view('include/header', $data);
		$this->load->view('admin/solicitudes/asignar', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/** Solicitudes finalizadas */
	public function finalizadas()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / En evaluación';
		$data['solicitudesAsignadas'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesAsignadas'];
		$this->load->view('include/header', $data);
		$this->load->view('admin/solicitudes/finalizadas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
}
function var_dump_pre($mixed = null) {
	echo '<pre>';
	var_dump($mixed);
	echo '</pre>';
	return null;
}
