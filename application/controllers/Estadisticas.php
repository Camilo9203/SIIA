<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Estadisticas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		verify_session_admin();
		$this->load->model('EstadisticasModel');
	}
	// Traer datos estadisticos
	public function index()
	{
		// $data['solicitudes'] = $this->EstadisticasModel->get_solicitudes();
		// $data['tipoSolicitud'] = $this->EstadisticasModel->get_tipoSolicitud();
		$data = array(

			'solicitudes' => $this->EstadisticasModel->get_solicitudes(),
			'tipoSolicitud' => $this->EstadisticasModel->get_tipoSolicitud(),

		);

		echo json_encode($data['tipoSolicitud']);

		// $hoy = getdate($data['solicitudes'][0]['fecha']);
		// print_r($data['solicitudes'][0]['fecha']);

		// $solicitudes = $this->db->get('solicitudes');
		// foreach ($solicitudes->result() as $row) {
		// 	echo $row->id_solicitud;
		// 	echo $row->fecha;
		// }
	}

	// public function view($id = NULL)
	// {
	// 	$data['estadisticasmodel'] = $this->EstadisticasModel->get_solicitudes($id);
	// }

	public function panel_estadisticas()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$nivel = $this->session->userdata('nivel');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal / Administrador / Reportes';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['nivel'] = $nivel;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();

		$this->load->view('include/header', $data);
		$this->load->view('admin/estadisticas/estadisticas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	// Opciones del sistema
	public function cargarDepartamentos()
	{
		$departamentos = $this->db->select("*")->from("departamentos")->get()->result();
		return $departamentos;
	}
}
