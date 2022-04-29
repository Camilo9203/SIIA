<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registro extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	/**
		Función form de registro.
	 **/
	public function index()
	{
		$data = array(
			'title' => 'Registro',
			'loggen_in' => false,
			'tipo_usuario' => "none"
		);
		$this->load->view('include/header', $data);
		$this->load->view('registro/registro');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	/**
	Función para validar formulario de registro, almacenar datos de organización, usuario y token.
	 * Se envía email de activación de cuenta.
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
		$this->form_validation->set_rules('nombre_usuario', '', 'trim|required|min_length[3]|xss_clean|is_unique[usuarios.usuario]');
		$this->form_validation->set_rules('password', '', 'trim|required|min_length[3]|xss_clean');

		if ($this->form_validation->run("formulario_registro") == FALSE) {
			$error = validation_errors();
			echo json_encode(array('url' => "registro", 'msg' => $error));
		} else {
			$data_registro_user = array(
				'usuario' => $this->input->post('nombre_usuario'),
				'contrasena' => generate_hash($this->input->post('password')),
				'contrasena_rdel' => mc_encrypt($this->input->post('password'), KEY_RDEL),
				'logged_in' => 0,
			);
			if ($this->db->insert('usuarios', $data_registro_user)){
				$this->logs_sia->logQueries();
				$id_usuario = $this->db->select('id_usuario')->from('usuarios')->where('usuario', $data_registro_user['usuario'])->get()->row();
				$data_token = array(
					'token' => generate_token(),
					'verificado' => 0,
					'usuario_token' => $data_registro_user['usuario']
				);
				$id_token = $this->db->select('id_token')->from('token')->where('usuario_token', $data_registro_user['usuario'])->get()->row();
				$this->db->set('token_id_token', $id_token);
				$this->db->insert('usuarios');
				if ($this->db->insert('token', $data_token)) {
					$this->logs_sia->logQueries();
					$data_registro_org = array(
						'nombreOrganizacion' => $this->input->post('organizacion'),
						'numNIT' => $this->input->post('nit'),
						'sigla' => $this->input->post('sigla'),
						'primerNombreRepLegal' => $this->input->post('nombre'),
						'segundoNombreRepLegal' => $this->input->post('nombre_s'),
						'primerApellidoRepLegal' => $this->input->post('apellido'),
						'segundoApellidoRepLegal' => $this->input->post('apellido'),
						'direccionCorreoElectronicoOrganizacion' => $this->input->post('correo_electronico'),
						'direccionCorreoElectronicoRepLegal' => $this->input->post('correo_electronico_rep_legal'),
						'estado' => "Inscrito",
						'usuarios_id_usuario' => $id_usuario
					);
					if ($this->db->insert('organizaciones', $data_registro_org)) {
						$this->logs_sia->logQueries();
						$datos_token = $this->db->select('id_token')->from('token')->where('usuario_token', $data_registro_user['usuario'])->get()->row();
						$fromSIA = "Unidad Administrativa Especial de Organizaciones Solidarias UAEOS - Aplicación SIIA.";
						$this->enviomail_activar(CORREO_SIA, $fromSIA, $data_registro_org['direccionCorreoElectronicoOrganizacion'], $data_registro_org['direccionCorreoElectronicoRepLegal'], $datos_token->token, $data_registro_org['primerNombreRepLegal'], $data_registro_org['primerApellidoRepLegal'], $data_registro_org['nombreOrganizacion'], $data_registro_org['numNIT'], $data_registro_user['usuario']);
						$this->logs_sia->logs('REGISTER_TYPE');
						$this->logs_sia->logs('URL_TYPE');
						$this->logs_sia->logQueries();
						}
					}
				}
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
