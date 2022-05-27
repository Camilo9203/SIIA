<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activate extends CI_Controller {
	
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
	 * map to /login.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Activacion de Cuenta';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		
		$this->load->view('include/header', $data);
		$this->load->view('activate/activate');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function verification()
	{
		$token = $this->input->post('tk');
		$user = $this->input->post('user');

		$datos_token = $this->db->select('*')->from('token')->where('usuario_token', $user)->get()->row();
		$this->logs_sia->logQueries();

		$tokenDB = $datos_token ->token;
		$verificadoDB = $datos_token ->verificado;
		$userDB = $datos_token ->usuario_token;

		if($token == $tokenDB && $user == $userDB && $verificadoDB == 0){
			$data_update_token = array (
				'verificado' => 1,
				'fechaActivacion' => date('Y/m/d')
			);
			$this->db->where('usuario_token', $userDB);
			$this->db->update('token', $data_update_token);
			echo json_encode(array('url'=>base_url()."login", 'msg'=>"Cuenta activada."));
			$this->logs_sia->logs('ACTIVATION_ACCOUNT');
			$this->logs_sia->logs('URL_TYPE');
		}else{
			echo json_encode(array('url'=>base_url()."registro", 'msg'=>"La cuenta no existe o ya se activo."));
			$this->logs_sia->logs('URL_TYPE');
		}
	}

}
