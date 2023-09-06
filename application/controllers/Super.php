<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Super extends CI_Controller {
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
	function __construct(){
		parent::__construct();
		$this->load->model('AdministradoresModel');
	}
	public function index()
	{
		$data['title'] = 'SUP';
		$data['tipo_usuario'] = "none";
		$data['logged_in'] = FALSE;
		$this->load->view('include/header', $data);
		$this->load->view('admin/super/super');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}
	/**
	 * Inició de sesión súper administrador
	 */
	public function verify(){
		$ps = $this->input->post('sp');
		if($ps == SUPER_PS){
			$data_update = array('valor' => 'TRUE');
			$this->db->where('nombre', 'super');
			if($this->db->update('opciones', $data_update)){
				$usuario_ip = $_SERVER['REMOTE_ADDR'];
				echo json_encode(array("url"=>"panel", 'error' => 0, "msg" => "Inicio de sesión super administrador!"));
				$datos_sesion = array(
					'usuario_id'     => "1-666-1", // Number of the beast #-#
					'nombre_usuario'  => "super",
					'type_user' => 'super',
					'logged_in' => 1,
					'usuario_ip' => $usuario_ip,
					'usuario_ip_proxy' => $usuario_ip,
					'user_agent' => $_SERVER['HTTP_USER_AGENT']
				);
				$this->session->set_userdata($datos_sesion);
			}
		}else if($ps == "" || $ps == NULL || $ps != SUPER_PS){
			$data_update = array('valor' => 'FALSE');
			$this->db->where('nombre', 'super');
			if($this->db->update('opciones', $data_update)){
				echo json_encode(array('url' => 'super','error' => 1, 'msg' => 'Ingrese una contraseña valida'));
			}
		}
	}
	/**
	 * Datos sesión súper administrador
	 */
	public function dataSessionSuper() {
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'title' => 'SUPER',
			'tipo_usuario' => $this->session->userdata('type_user'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'activeLink' => 'super',
			'administradores' => $this->AdministradoresModel->getAdministradores()
		);
		return $data;
	}
	/**
	 * Panel súper administrador
	 */
	public function panel(){
		verify_session_admin();
		$is = $this->db->select("valor")->from("opciones")->where("nombre","super")->get()->row()->valor;
		if($is == "TRUE"):
			$data = $this->dataSessionSuper();
			$this->load->view('include/header', $data);
			$this->load->view('admin/super/super', $data);
			$this->load->view('include/footer');
			$this->logs_sia->logs('PLACE_USER');
		endif;
	}
	/**
	 * Cerrar sesión
	 */
	public function logout(){
		$data_update = array('valor' => 'FALSE');
		$this->db->where('nombre', 'super');
		if($this->db->update('opciones', $data_update)){
			echo json_encode("salir");
			delete_cookie('sia_session');
			$this->session->sess_destroy();
		}
	}
}
