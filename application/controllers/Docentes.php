<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Docentes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		verify_session_admin();
		$this->load->model('DocentesModel');
		$this->load->model('AdminModel');
		$this->load->model('DepartamentosModel');
	}
	// Traer datos estadisticos
	public function index()
	{
		// $data = array(

		// 	'acreditadas' => $this->EstadisticasModel->organizacionesAcreditadas(),
		// 	'cursoBasico' => $this->EstadisticasModel->organizacionesBasico(),
		// 	'avaladas' => $this->EstadisticasModel->organizacionesAvaladas(),
		// 	'modalidadVirtual' => $this->EstadisticasModel->organizacionesVirtual(),

		// );
		// Json datos estadisticos
		// echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	// public function view($id = NULL)
	// {
	// 	$data['estadisticasmodel'] = $this->EstadisticasModel->get_solicitudes($id);
	// }
	public function panelDocentes()
	{
		date_default_timezone_set("America/Bogota");
		$data = array(
			'title' => 'Panel Principal / Administrador / Facilitadores / Panel',
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'administradores' => $this->AdminModel->cargarAdministradores(),

		);
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/docentes/panelDocentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// TODO: Codigo nuevo para la asignación de solicitudes de actulizacion de docentes.
	public function asignarDocentes()
	{
		date_default_timezone_set("America/Bogota");
		$data = array(
			'title' => 'Panel Principal / Administrador / Facilitadores / Asignar',
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'docentes' => $this->DocentesModel->docentesSinAsignar(),
			'administradores' => $this->AdminModel->cargarAdministradores(),

		);
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/docentes/asignarDocentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// TODO: Codigo nuevo para la asignación de solicitudes de actulizacion de docentes.
	public function evaluarDocentes()
	{
		date_default_timezone_set("America/Bogota");
		$data = array(
			'title' => 'Panel Principal / Administrador / Facilitadores / Evaluar',
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'docentes' => $this->DocentesModel->docentesSinAsignar(),
			'administradores' => $this->AdminModel->cargarAdministradores(),
		);
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/docentes/evaluarDocentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
}
