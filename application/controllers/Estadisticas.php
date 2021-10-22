<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Estadisticas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// verify_session_admin();
		$this->load->model('EstadisticasModel');
	}
	// Traer datos estadisticos
	public function index()
	{
		$data = array(

			'acreditadas' => $this->EstadisticasModel->organizacionesAcreditadas(),
			'cursoBasico' => $this->EstadisticasModel->organizacionesBasico(),
			'avaladas' => $this->EstadisticasModel->organizacionesAvaladas(),
			'modalidadVirtual' => $this->EstadisticasModel->organizacionesVirtual(),

		);
		// Json datos estadisticos
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
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

		$data['title'] = 'Panel Principal / Administrador / Estadisticas';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['nivel'] = $nivel;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['organizaciones'] = $this->index();

		$this->load->view('include/header', $data);
		$this->load->view('admin/estadisticas/estadisticas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function estadisticas_tramite()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$nivel = $this->session->userdata('nivel');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal / Administrador / Estadisticas';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['nivel'] = $nivel;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;

		$this->load->view('include/header', $data);
		$this->load->view('admin/estadisticas/tramite', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
}
