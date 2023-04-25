<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welco7me
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		verify_session_admin();
		$this->load->model('OrganizacionesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('AsistentesModel');
		$this->load->model('RegistroTelefonicoModel');
		$this->load->model('DocentesModel');
	}
	/** Datos Sesión */
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
			'activeLink' => 'reportes',
			'departamentos' => $this->DepartamentosModel->getDepartamentos(),
		);
		return $data;
	}
	public function entidadesAcreditadas()
	{
		$data = $this->datosSession();
		$data['title'] = 'Reportes - Entidades Acreditadas';
		$data['organizacionesAcreditadas'] = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/acreditadas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function entidadesAcreditadasSin()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['organizacionesAcreditadas'] = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/acreditadasSin', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function entidadesHistorico()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['organizacionesHistorico'] = $this->OrganizacionesModel->getOrganizacionesHistorico();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/historico', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function verAsistentes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes Asistentes';
		$data['asistentes'] = $this->AsistentesModel->getAsistentes();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/asistentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function registroTelefonico()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Registro telefónico';
		$data['registros'] = $this->RegistroTelefonicoModel->getRegistrosTelefonicos();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/telefonicos', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function docentesHabilitados()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes Docentes';
		$data['docentes'] = $this->DocentesModel->getDocentesHabilitados();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/docentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function verInformacion()
	{
		$data_ = array();
		$informes = $this->db->select("*")->from("informeActividades")->get()->result();
		foreach ($informes as $informe) {
			$id_informe = $informe->id_informeActividades;
			$asistentes = $this->db->select("*")->from("asistentes")->where("informeActividades_id_informeActividades", $id_informe)->get()->result();
			array_push($data_, $asistentes);
		}
		echo json_encode(array("informe" => $informes, "asistentes" => $data_));
	}
}
