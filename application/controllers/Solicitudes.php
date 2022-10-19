<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Solicitudes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DocentesModel');
		$this->load->model('AdminModel');
	}
	/** Datos Iniciales */
	public function datosSession()
	{
		verify_session();
		date_default_timezone_set("America/Bogota");
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'administradores' => $this->AdminModel->cargarAdministradores(),
			'data_organizacion' => $this->db->select('*')->from('organizaciones')->where('usuarios_id_usuario', $this->session->userdata('usuario_id'))->get()->row(),
			'solicitudes' => $this->cargar_solicitudes(),
		);
		return $data;
	}
	/** Vista Inicial */
	public function index()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Solicitudes';
		$data['activeLink'] = 'solicitudes';
		$this->load->view('include/header/main', $data);
		$this->load->view('paneles/solicitudes', $data);
		$this->load->view('include/footer/main', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function cargar_solicitudes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$solicitudes = $this->db->select("*")->from("solicitudes")->join('tipoSolicitud', "tipoSolicitud.idSolicitud = solicitudes.idSolicitud")->join('estadoOrganizaciones', "estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud")->where('solicitudes.organizaciones_id_organizacion', $organizacion->id_organizacion)->get()->result();
		return $solicitudes;
	}

	/** TODO: Notificaciones Email */
	function envilo_mailadmin($type, $prioridad, $docente)
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// $id_organizacion = $organizacion->id_organizacion;
		$docente = $this->db->select("*")->from("docentes")->where("numCedulaCiudadaniaDocente", $docente)->get()->row();
		switch ($type) {
			// Actualización de facilitadores
			case 'actualizacion':
				$asunto = "Actualización Docente";
				$mensaje = "La organización <strong>" . $organizacion->nombreOrganizacion . "</strong>: Realizo una solicitud para actualización del facilitador <strong>" . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . "</strong>, por favor ingrese al sistema para asignar dicha solicitud, gracias. 
					<br/><br/>
					<label>Datos de recepción:</label> <br/>
					Fecha de recepcion de solicitud: <strong>" . date("Y-m-d h:m:s") . "</strong>. <br/>";
				break;
			default:
				$asunto = "";
				$mensaje = "";
				break;
		}
		/**
		 * Datos para envío de Email al administrador
		 * Prioridad
		1 => '1 (Highest)',
		2 => '2 (High)',
		3 => '3 (Normal)',
		4 => '4 (Low)',
		5 => '5 (Lowest)'
		 **/
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to(CORREO_SIA);
		$this->email->cc(CORREO_SIA);
		$this->email->subject('SIIA: ' . $asunto);
		$this->email->set_priority($prioridad);
		$data_msg['mensaje'] = $mensaje;
		$email_view = $this->load->view('email/contacto', $data_msg, true);
		$this->email->message($email_view);
		if ($this->email->send()) {
			echo json_encode(array("msg" => "Docente " . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . " Actualizado. Se ha enviado correo para asignar solicitud"));
		} else {
			echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envío el correo."));
		}
	}
}
