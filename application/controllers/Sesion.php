<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	/**
		Funcion Index para cargar las vistas necesarias.
	**/
	public function index(){
		$data['title'] = 'Iniciar Sesión';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		$this->load->view('include/header', $data);
		$this->load->view('login/login');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	/**
		Funcion para hacer Login a SIA y redireccionar a Panel.
		Los parametros se traen del ajax.
	**/
	public function login()
	{
		$this->form_validation->set_rules('usuario','Username','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('password','Password','trim|required|min_length[3]|xss_clean');


		if ($this->form_validation->run("formulario_login") == FALSE)
		{
			echo json_encode(array('url'=>"login", 'msg'=>"Verifique los datos ingresados."));
		}
		else
		{
			$nombre_usuario = $this->input->post('usuario');
			$password =  $this->input->post('password');
			$user_exist = false;

			$datos_usuario = $this->db->select('*')->from('usuarios')->where('usuario', $nombre_usuario)->get()->row();
			$datos_token = $this->db->select('*')->from('token')->where('usuario_token', $nombre_usuario)->get()->row();
			$this->logs_sia->logQueries();

			if($datos_usuario == "NULL" || $datos_usuario == NULL || $datos_usuario == null){
				$user_exist = false;
			}else{
				$user_exist = true;
			}

			$usuario_ip = $_SERVER['REMOTE_ADDR'];

	        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
	            $usuario_ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
	        }

			if($user_exist == true){
				if(verificar_logged_in($nombre_usuario)){
					echo json_encode(array('url'=>"login", 'msg'=>"Su sesión se ha cerrado, intente otra vez."));
					$this->logs_sia->logs('URL_TYPE');
				}else{
					if(verify_login("$nombre_usuario", $password)){
						if($datos_token->verificado == 1){
							if($datos_usuario ->logged_in == 0){
								$datos_sesion = array(
								'usuario_id'     => $datos_usuario->id_usuario,
				            	'nombre_usuario'  => $datos_usuario ->usuario,
				            	'type_user' => 'user',
				            	'logged_in' => 1,
				            	'usuario_ip' => $usuario_ip,
				            	'usuario_ip_proxy' => $usuario_ip,
				            	'user_agent' => $_SERVER['HTTP_USER_AGENT']
						        );
								$this->session->set_userdata($datos_sesion);

								$nombre_usuario = $this->session->userdata('nombre_usuario');
								$usuario_id = $this->session->userdata('usuario_id');

								echo json_encode(array('url'=>"panel", 'msg'=>""));
								$this->logs_sia->session_log('Login');
								$data_update = array(
											'logged_in' => "1"
								);

								$this->db->where('id_usuario', $usuario_id);
								$this->db->update('usuarios', $data_update);

								$this->logs_sia->logs('LOGIN_TYPE');
								$this->logs_sia->logs('URL_TYPE');
								$this->logs_sia->logQueries();
							}else{
								echo json_encode(array('url'=>"login", 'msg'=>"El usuario ya inicio sesión."));
								$this->logs_sia->logs('URL_TYPE');
							}
						}else{
							if($datos_token->verificado == 2){
								echo json_encode(array('url'=>"login", 'msg'=>"Su cuenta esta bloqueada, este pendiente cuando sea activada de nuevo en la fecha ".$datos_token->fechaActivacion."."));
								$this->logs_sia->logs('URL_TYPE');
							}else{
								echo json_encode(array('url'=>"login", 'msg'=>"Verifique su cuenta."));
								$this->logs_sia->logs('URL_TYPE');
							}
						}
					}else{
						echo json_encode(array('url'=>"login", 'msg'=>"Verifique el usuario y la contraseña."));
						$this->logs_sia->logs('URL_TYPE');
					}
				}
			}else{
				echo json_encode(array('url'=>"login", 'msg'=>"No existe el usuario."));
				$this->logs_sia->logs('URL_TYPE');
			}
		}
	}

	/**
		Funcion para cerrar la sesion del usuario.
		Destruye la sesion actual del usuario y redirecciona a Login.
	**/
	public function logout()
	{
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');

		$this->logs_sia->session_log('Logout');

		$data_update = array(
					'logged_in' => "0"
		);

		$this->db->where('id_usuario', $usuario_id);
		$this->db->update('usuarios', $data_update);

		$this->logs_sia->logs('LOGOUT_TYPE');
		$this->logs_sia->logQueries();
		$this->logs_sia->logs('URL_TYPE');

		delete_cookie('SIIASession');
		$this->session->sess_destroy();
		echo json_encode(array('url'=>base_url()."login", 'msg'=>"Sesión terminada."));
	}

		/**
		Funcion Index para cargar las vistas necesarias.
	**/
	public function login_admin()
	{
		$data['title'] = 'Login Administrador';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		$this->load->view('include/header', $data);
		$this->load->view('admin/login');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function log_in_admin(){
		$this->form_validation->set_rules('usuario','Username','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('password','Password','trim|required|min_length[3]|xss_clean');


		if ($this->form_validation->run("formulario_login_admin") == FALSE)
		{
			echo json_encode(array('url'=>"login", 'msg'=>"Verifique los datos, no son validos, si tiene dudas presione ?."));
		}
		else
		{
			$nombre_usuario = $this->input->post('usuario');
			$password =  $this->input->post('password');
			$user_exist = false;

			$datos_usuario = $this->db->select('*')->from('administradores')->where('usuario', $nombre_usuario)->get()->row();
			$this->logs_sia->logQueries();

			if($datos_usuario == "NULL" || $datos_usuario == NULL || $datos_usuario == null){
				$user_exist = false;
			}else{
				$user_exist = true;
			}

			$usuario_ip = $_SERVER['REMOTE_ADDR'];

	        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
	            $usuario_ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
	        }

			if($user_exist == true){
				if(verify_login_admin($nombre_usuario, $password)){
					if($datos_usuario ->logged_in == 0){
						$datos_sesion = array(
						'usuario_id'     => $datos_usuario->id_administrador,
		            	'nombre_usuario'  => $datos_usuario ->usuario,
		            	'type_user' => 'admin',
		            	'nivel' => $datos_usuario->nivel,
		            	'logged_in' => TRUE,
		            	'usuario_ip' => $usuario_ip,
		            	'usuario_ip_proxy' => $usuario_ip,
		            	'user_agent' => $_SERVER['HTTP_USER_AGENT']
				        );
						$this->session->set_userdata($datos_sesion);

						$nombre_usuario = $this->session->userdata('nombre_usuario');
						$usuario_id = $this->session->userdata('usuario_id');

						echo json_encode(array('url'=>"panel_admin", 'msg'=>""));
						$this->logs_sia->session_log('Login Administrador');

						$data_update = array(
									'logged_in' => "1"
						);

						$this->db->where('id_administrador', $usuario_id);
						$this->db->update('administradores', $data_update);

						$this->logs_sia->logs('LOGIN_TYPE');
						$this->logs_sia->logs('URL_TYPE');
						$this->logs_sia->logQueries();
					}else{
						echo json_encode(array('url'=>"login", 'msg'=>"Su sesión se ha cerrado, intente otra vez."));
						$this->logs_sia->logs('URL_TYPE');

						$data_update = array(
									'logged_in' => "0"
						);

						$this->db->where('usuario', $nombre_usuario);
						$this->db->update('administradores', $data_update);
					}
				}else{
					echo json_encode(array('url'=>"login", 'msg'=>"Verifique el usuario y la contraseña."));
					$this->logs_sia->logs('URL_TYPE');
				}
			}else{
				echo json_encode(array('url'=>"login", 'msg'=>"No existe el usuario."));
				$this->logs_sia->logs('URL_TYPE');
			}
		}
	}
}
