<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {
	
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
	 * map to /register.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();	
	}

	public function index()
	{
		$data['title'] = 'Actualización';
		$this->load->view('include/header', $data);
		$this->load->view('actualizacion');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}
	
	public function update_info()
	{
		$this->form_validation->set_rules('organizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('nit','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('sigla','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('nombre','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('nombre_s','','trim|xss_clean');
    	$this->form_validation->set_rules('apellido','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('apellido_s','','trim|xss_clean');
    	$this->form_validation->set_rules('correo_electronico','','trim|required|min_length[3]|valid_email|xss_clean');
    	$this->form_validation->set_rules('correo_electronico_rep_legal','','trim|required|min_length[3]|valid_email|xss_clean');
    	$this->form_validation->set_rules('nombre_p','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('apellido_p','','trim|required|min_length[3]|xss_clean');
    	//___
    	$this->form_validation->set_rules('tipo_organizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('departamento','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('municipio','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('direccion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('fax','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('extension','','trim|min_length[1]|xss_clean');
    	$this->form_validation->set_rules('urlOrganizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('actuacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('educacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('numCedulaCiudadaniaPersona','','trim|required|min_length[3]|xss_clean');

		if ($this->form_validation->run("formulario_actualizar") == FALSE)
		{
			echo json_encode(array('url'=>"perfil", 'msg'=>"Verifique los datos, no son validos."));
		}
		else
		{
			$organizacion = $this->input->post('organizacion');
			$nit = $this->input->post('nit');
			$sigla = $this->input->post('sigla');
			$nombre = $this->input->post('nombre');
			$nombre_s = $this->input->post('nombre_s');
			$apellido = $this->input->post('apellido');
			$apellido_s = $this->input->post('apellido_s');
			$correo_electronico = $this->input->post('correo_electronico');
			$correo_electronico_rep_legal = $this->input->post('correo_electronico_rep_legal');
			$nombre_p = $this->input->post('nombre_p');
			$apellido_p = $this->input->post('apellido_p');
			//______
			$tipo_organizacion = $this->input->post('tipo_organizacion');
    		$departamento = $this->input->post('departamento');
    		$municipio = $this->input->post('municipio');
    		$direccion = $this->input->post('direccion');
    		$fax = $this->input->post('fax');
    		$extension = $this->input->post('extension');
    		$urlOrganizacion = $this->input->post('urlOrganizacion');
    		$actuacion = $this->input->post('actuacion');
    		$educacion = $this->input->post('educacion');
    		$numCedulaCiudadaniaPersona = $this->input->post('numCedulaCiudadaniaPersona');

			$usuario_id = $this->session->userdata('usuario_id');
			$id_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row()->id_organizacion;
			$data_informacion_generalDB = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
			
			$data_update = array(
				'nombreOrganizacion' => $organizacion,
				'numNIT' => $nit,
				'sigla' => $sigla,
				'primerNombreRepLegal' => $nombre,
				'segundoNombreRepLegal' => $nombre_s,
				'primerApellidoRepLegal' => $apellido,
				'segundoApellidoRepLegal' => $apellido_s,
				'direccionCorreoElectronicoOrganizacion' => $correo_electronico,
				'direccionCorreoElectronicoRepLegal' => $correo_electronico_rep_legal,
				'primerNombrePersona' => $nombre_p,
				'primerApellidoPersona' => $apellido_p,
			);

			$data_informacion_general = array(
				'tipoOrganizacion' => $tipo_organizacion,
				'direccionOrganizacion' => $direccion,
				'nomDepartamentoUbicacion' => $departamento,
				'nomMunicipioNacional' => $municipio,
				'fax' => $fax,
				'extension' => $extension,
				'urlOrganizacion' => $urlOrganizacion,
				'actuacionOrganizacion' => $actuacion,
				'tipoEducacion' => $educacion,
				'numCedulaCiudadaniaPersona' => $numCedulaCiudadaniaPersona,
				'fecha' => date('Y/m/d H:i:s'),
				'organizaciones_id_organizacion' => $id_organizacion
			);

			$this->db->where('usuarios_id_usuario', $usuario_id);
			if($this->db->update('organizaciones', $data_update)){
				if($data_informacion_generalDB == NULL || $data_informacion_generalDB == ""){
					$this->db->insert('informacionGeneral', $data_informacion_general);	
				}else{
					$this->db->where('organizaciones_id_organizacion', $id_organizacion);
					$this->db->update('informacionGeneral', $data_informacion_general);
				}
				$this->envio_mailcontacto("update", 3);
				$this->logs_sia->session_log('Actualizacion de datos básicos');
				$this->logs_sia->logQueries();
				$this->logs_sia->logs('URL_TYPE');
				$this->notif_sia->notification('ACTUALIZAR_DATOS', 'admin', $organizacion);
				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizó la información."));
			}
		}
	}

	public function update_password(){
		$this->form_validation->set_rules('contrasena_anterior','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('contrasena_nueva','','trim|required|min_length[3]|xss_clean');

		if($this->form_validation->run("formulario_actualizar_contrasena") == FALSE)
		{
			echo json_encode(array('url'=>"perfil", 'msg'=>"Verifique los datos."));
		}
		else
		{
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
			$nombre_usuario = $datos_usuario ->usuario;

			$contrasena_anterior = $this->input->post('contrasena_anterior');
			$contrasena_nueva = $this->input->post('contrasena_nueva');

			if(verify_login($nombre_usuario, $contrasena_anterior)){
				$password_rdel = mc_encrypt($contrasena_nueva, KEY_RDEL);
				$password_hash = generate_hash($contrasena_nueva);

				$data_update = array(
								'contrasena' => $password_hash,
								'contrasena_rdel' => $password_rdel
				);
				$this->db->where('id_usuario', $usuario_id);
				$this->db->update('usuarios', $data_update);

				$this->logs_sia->session_log('Actualizacion de Contraseña');
				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizó la contraseña."));
			}else{
				echo json_encode(array('url'=>"perfil", 'msg'=>"La contraseña ingresada no concide con la actual."));
			}
		}
		$this->logs_sia->logQueries();
		$this->logs_sia->logs('URL_TYPE');
	}

	public function update_user(){
		$this->form_validation->set_rules('usuario_nuevo','','trim|required|min_length[3]|xss_clean');

		if($this->form_validation->run("formulario_actualizar_usuario") == FALSE){
			echo json_encode(array('url'=>"perfil", 'msg'=>"Verifique los datos."));
		}else{
			$usuario_nuevo = $this->input->post('usuario_nuevo');
			$usuario_id = $this->session->userdata('usuario_id');

			$nombre_usuarios = $this->db->select("*")->from("usuarios")->where("usuario", $usuario_nuevo)->get()->row();

			if($nombre_usuarios == NULL){
				$data_update = array(
								'usuario' => $usuario_nuevo
				);
				$this->db->where('id_usuario', $usuario_id);
				$this->db->update('usuarios', $data_update);

				$data_update_token = array(
								'usuario_token' => $usuario_nuevo
				);
				$nombre_usuario = $this->session->userdata('nombre_usuario');
				$this->db->where('usuario_token', $nombre_usuario);
				$this->db->update('token', $data_update_token);

				$this->logs_sia->session_log('Actualizacion de Nombre de Usuario');
				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizó el Nombre de Usuario."));
			}else{
				echo json_encode(array('url'=>"perfil", 'msg'=>"El nombre de usuario ya existe, elija otro."));
			}
		}
		$this->logs_sia->logQueries();
		$this->logs_sia->logs('URL_TYPE');
	}

	function envio_mailcontacto($type, $prioridad){
		$usuario_id = $this->session->userdata('usuario_id');
		$to_correo = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();

		switch ($type) {
			case 'update':
				$asunto = "Actualización de perfil";
				$mensaje = "Organización ".$to_correo->nombreOrganizacion.":Organizaciones Solidarias le informa que la información básica de contacto de la entidad se ha actualizado satisfactoriamente y será publicada en el listado de entidades acreditadas si está acreditada durante los primeros cinco días del siguiente mes. Lo invitamos a actualizar su información cada vez que lo sea necesario.";
				break;
			default:
				$asunto = "";
				$mensaje = "";
				break;
		}
		/**
		1 => '1 (Highest)',
		2 => '2 (High)',
		3 => '3 (Normal)',
		4 => '4 (Low)',
		5 => '5 (Lowest)'
		**/
		switch ($prioridad) {
			case 1:
				$num_prioridad = 1;
				break;
			case 2:
				$num_prioridad = 2;
				break;
			case 3:
				$num_prioridad = 3;
				break;
			default:
				$num_prioridad = 3;
				break;
		}

		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($to_correo->direccionCorreoElectronicoOrganizacion);
		$this->email->subject('SIIA - : '.$asunto);
		$this->email->set_priority($num_prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if($this->email->send()){
			// Do nothing.
		}else{
			echo json_encode(array('url'=>"login", 'msg'=>"Lo sentimos, hubo un error y no se envio el correo."));
		}
	}
}
