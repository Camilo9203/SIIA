<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registro extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
		Funcion Index para cargar las vistas necesarias.
	 **/
	public function index()
	{
		$data['title'] = 'Registro';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		$this->load->view('include/header', $data);
		$this->load->view('registro/registro');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	/**
		Funcion para Registrar la informacion del formulario registro que el usuario ingreso.
		Los parametros se traen del ajax.
	 **/
	public function registrar_info()
	{
		$this->form_validation->set_rules('organizacion', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('nit', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('sigla', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('nombre', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('nombre_s', '', 'trim|xss_clean');
		$this->form_validation->set_rules('apellido', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('apellido_p', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('apellido_s', '', 'trim|xss_clean');
		$this->form_validation->set_rules('correo_electronico', '', 'trim|required|min_length[3]|valid_email|xss_clean');
		$this->form_validation->set_rules('correo_electronico_rep_legal', '', 'trim|required|min_length[3]|valid_email|xss_clean');
		$this->form_validation->set_rules('nombre_p', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('nombre_usuario', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('password', '', 'trim|required|min_length[3]|xss_clean');

		if ($this->form_validation->run("formulario_registro") == FALSE) {
			echo json_encode(array('url' => "registro", 'msg' => "Verifique los datos, no son válidos."));
			var_dump(validation_errors());
		}
		else {
			$fromSIA = "Unidad Administrativa Especial de Organizaciones Solidarias UAEOS - Aplicación SIIA.";
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
			$nombre_usuario = $this->input->post('nombre_usuario');
			$password = $this->input->post('password');
			$password_rdel = mc_encrypt($password, KEY_RDEL);
			$password_hash = generate_hash($password);

			$token = generate_token();

			$data_exist = false;
			$name_user_exist = false;
			$organizacion_exist = false;

			$data_user = $this->db->select('usuario')->from('usuarios')->where('usuario', $nombre_usuario)->get()->row();
			$data_usuarioBD = $this->db->select('*')->from('usuarios')->where('usuario', $nombre_usuario)->get()->row();
			$datos_registro = $this->db->select('numNIT')->from('organizaciones')->where('numNIT', $nit)->get()->row();

			if ($data_user == "NULL" || $data_user == NULL || $data_user == null) {
				$data_exist = false;
			} else {
				$data_exist = true;
			}

			if ($datos_registro == "NULL" || $datos_registro == NULL || $datos_registro == null) {
				$organizacion_exist = false;
			} else {
				$organizacion_exist = true;
			}

			if ($data_exist == false) {
				if ($organizacion_exist == false) {

					$data_token = array(
						'token' => $token,
						'verificado' => 0,
						'usuario_token' => $nombre_usuario
					);

					$this->db->insert('token', $data_token);
					$datos_token = $this->db->select('id_token')->from('token')->where('usuario_token', $nombre_usuario)->get()->row();
					$id_token = $datos_token->id_token;
					$this->logs_sia->logQueries();

					$data_usuario = array(
						'usuario' => $nombre_usuario,
						'contrasena' => $password_hash,
						'contrasena_rdel' => $password_rdel,
						'logged_in' => 0,
						'token_id_token' => $id_token
					);

					$this->db->insert('usuarios', $data_usuario);
					$this->logs_sia->logQueries();

					$data_user = $this->db->select('id_usuario')->from('usuarios')->where('usuario', $nombre_usuario)->get()->row();
					$id_usuario = $data_user->id_usuario;
					$this->logs_sia->logQueries();

					$data_registro = array(
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
						'usuarios_id_usuario' => $id_usuario
					);
					$this->db->insert('organizaciones', $data_registro);

					$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $id_usuario)->get()->row();
					$id_organizacion = $datos_organizacion->id_organizacion;

					$data_solicitud = array(
						'numeroSolicitudes' => 0,
						'fecha' =>  date('Y/m/d H:i:s'),
						'organizaciones_id_organizacion' => $id_organizacion
					);

					$this->db->insert('solicitudes', $data_solicitud);

					$nits_db = $this->db->select("*")->from("nits_db")->get()->result();

					foreach ($nits_db as $nits) {
						$nt_db = $nits->numNIT;

						if ($nit == $nt_db) {
							$fechaFinalizacion = $nits->fechaFinalizacion;

							$data_resolucion = array(
								'fechaResolucionFinal' => $fechaFinalizacion,
								'organizaciones_id_organizacion' => $id_organizacion
							);

							$this->db->insert('resoluciones', $data_resolucion);

							$data_estadoOrganizacion = array(
								'nombre' => "Acreditado",
								'fecha' =>  date('Y/m/d H:i:s'),
								'estadoAnterior' => "Finalizado",
								'organizaciones_id_organizacion' => $id_organizacion
							);
							break;
						} else {
							$data_estadoOrganizacion = array(
								'nombre' => "Inscrito",
								'fecha' =>  date('Y/m/d H:i:s'),
								'estadoAnterior' => "Inscrito",
								'organizaciones_id_organizacion' => $id_organizacion
							);
						}
					}

					$this->db->insert('estadoOrganizaciones', $data_estadoOrganizacion);
					$this->enviomail_activar(CORREO_SIA, "$fromSIA", "$correo_electronico", "$correo_electronico_rep_legal", "$token", "$nombre", "$apellido", "$organizacion", "$nit", "$nombre_usuario");
					$this->logs_sia->logs('REGISTER_TYPE');
					$this->logs_sia->logs('URL_TYPE');
					$this->logs_sia->logQueries();
				} else {
					//echo json_encode(array('url'=>"", 'msg'=>"El numero NIT de la organización ya esta registrado, de igual forma se envio correo electrónico."));
					$tokenID = $data_usuarioBD->token_id_token;
					$usuarioID = $data_usuarioBD->id_usuario;

					$tokenBD = $this->db->select("*")->from("token")->where("id_token", $tokenID)->get()->row();
					$token = $tokenBD->token;

					$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuarioID)->get()->row();
					$correo_electronico = $organizacion->direccionCorreoElectronicoOrganizacion;
					$correo_electronico_rep_legal = $organizacion->direccionCorreoElectronicoRepLegal;
					$nombre = $organizacion->primerNombreRepLegal;
					$apellido = $organizacion->primerApellidoRepLegal;
					$organizacion = $organizacion->nombreOrganizacion;
					$nit = $organizacion->numNIT;
					$nombre_usuario = $data_usuarioBD->usuario;

					$this->enviomail_activar(CORREO_SIA, "$fromSIA", "$correo_electronico", "$correo_electronico_rep_legal", $token, "$nombre", "$apellido", "$organizacion", "$nit", "$nombre_usuario");
					$this->logs_sia->logs('URL_TYPE');
				}
			} else {
				//echo json_encode(array('url'=>"", 'msg'=>"El nombre de usuario ya esta registrado, de igual forma se envio correo electrónico, por favor elija otro."));
				$tokenID = $data_usuarioBD->token_id_token;
				$usuarioID = $data_usuarioBD->id_usuario;

				$tokenBD = $this->db->select("*")->from("token")->where("id_token", $tokenID)->get()->row();
				$token = $tokenBD->token;

				$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuarioID)->get()->row();
				$correo_electronico = $organizacion->direccionCorreoElectronicoOrganizacion;
				$correo_electronico_rep_legal = $organizacion->direccionCorreoElectronicoRepLegal;
				$nombre = $organizacion->primerNombreRepLegal;
				$apellido = $organizacion->primerApellidoRepLegal;
				$organizacion = $organizacion->nombreOrganizacion;
				$nit = $organizacion->numNIT;
				$nombre_usuario = $data_usuarioBD->usuario;

				$this->enviomail_activar(CORREO_SIA, "$fromSIA", "$correo_electronico", "$correo_electronico_rep_legal", $token, "$nombre", "$apellido", "$organizacion", "$nit", "$nombre_usuario");
				$this->logs_sia->logs('URL_TYPE');
			}
		}
	}

	/**
		Funcion para enviar un correo electronico.
		@param from = De quien lo envia.
		@param from_name = Para quien se envia.
		@param to = A que correo se envia.
		@param token = Token para validar la cuenta.
		@param nombre = Primer nombre del representante legal.
		@param apellido = Primer apellido del representante legal.
		@param organizacion = Nombre de la organizacion.
		@param nit = Nit de la organizacion.
		@param nombre_usuario = Nombre de usuario del usuario.
	 **/
	function enviomail_activar($from, $from_name, $to, $cc, $token, $nombre, $apellido, $organizacion, $nit, $nombre_usuario)
	{
		$this->email->from($from, "Acreditaciones");
		$this->email->to($to);
		$this->email->cc($cc);
		$this->email->subject('SIIA - Activación de Cuenta.');

		$data_msg['organizacion'] = $organizacion;
		$data_msg['nit'] = $nit;
		$data_msg['to'] = $to;
		$data_msg['nombre_rep_legal'] = $nombre;
		$data_msg['apellido_rep_legal'] = $apellido;
		$data_msg['nombre_usuario'] = $nombre_usuario;
		$data_msg['token'] = $token;

		$email_view = $this->load->view('email/verificacion_cuenta', $data_msg, true);

		$this->email->message($email_view);

		if ($this->email->send()) {
			$usuarios = $this->db->select("*")->from("usuarios")->where("usuario", $nombre_usuario)->get()->row();
			$id_us = $usuarios->id_usuario;
			$token = $this->db->select("*")->from("token")->where("usuario_token", $nombre_usuario)->get()->row();
			$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $id_us)->get()->row();
			echo json_encode(array('url' => "login", 'msg' => "Se envio un correo a: " . $to . ", por favor verifiquelo para activar su cuenta.", "usuario" => $usuarios, "token" => $token, "organizacion" => $organizacion));
		} else {
			//SET FOREIGN_KEY_CHECKS=0; -- to disable them
			$id_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("nombreOrganizacion", $organizacion)->get()->row()->id_organizacion;
			$this->db->where('organizaciones_id_organizacion', $id_organizacion);
			if ($this->db->delete('estadoOrganizaciones')) {
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				if ($this->db->delete('solicitudes')) {
					$this->db->where('id_organizacion', $id_organizacion);
					if ($this->db->delete('organizaciones')) {
						$this->db->where('usuario', $nombre_usuario);
						if ($this->db->delete('usuarios')) {
							$this->db->where('token', $token);
							if ($this->db->delete('token')) {
								echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envio el correo, intente de nuevo.", "status" => 0));
							}
						}
					}
				}
			}
		}
	}

	public function reenvio()
	{
		$fromSIA = "Unidad Administrativa Especial de Organizaciones Solidarias UAEOS - Aplicación SIIA.";
		$organizacion = $this->input->post('organizacion');
		$nit = $this->input->post('nit');
		$nombre = $this->input->post('primerNombre');
		$apellido = $this->input->post('primerApellido');
		$correo_electronico = $this->input->post('to');
		$nombre_p = $this->input->post('nombre_p');
		$apellido_p = $this->input->post('apellido_p');
		$nombre_usuario = $this->input->post('usuario');
		$token = $this->input->post('tk');

		$this->enviomail_activar(CORREO_SIA, "$fromSIA", "$correo_electronico", "$correo_electronico_rep_legal", "$token", "$nombre", "$apellido", "$organizacion", "$nit", "$nombre_usuario");
	}
}
