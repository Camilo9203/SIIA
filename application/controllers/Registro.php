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
			'tipo_usuario' => "none",
			'activeLink' => "register"
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

	public function verificarUsuario()
	{
		// Comprobar que el nombre de usuario no se encuentre en la base de datos.
		$nombreUsuario = $this->db->select("usuario")->from("usuarios")->where("usuario", $this->input->post('nombre_usuario'))->get()->row()->usuario;
		if ($nombreUsuario != NULL || $nombreUsuario != "") {
			echo json_encode(array("existe" => 1));
		} else {
			echo json_encode(array("existe" => 0));
		}
	}
	public function verificarNIT()
	{
		// Comprobar que el nit no se encuentre en la base de datos.
		$nit = $this->db->select("numNIT")->from("organizaciones")->where("numNIT", $this->input->post('nit'))->get()->row()->numNIT;
		if ($nit != NULL || $nit != "") {
			echo json_encode(array("existe" => 1));
		} else {
			echo json_encode(array("existe" => 0));
		}
	}

	public function registrar_info()
	{
		/** Reglas de validación formulario */
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
		/** Correr validación de formulario */
		if ($this->form_validation->run("formulario_registro") == FALSE) {
			// Capturar error si la validación falsa
			$error = validation_errors();
			// Imprimir error de validación
			echo json_encode(array('url' => "registro", 'msg' => $error));
		}
		else {
			/**	@var $nombreUsuario Capturar nombre de usuario */
			$nombreUsuario = $this->db->select("usuario")->from("usuarios")->where("usuario", $this->input->post('nombre_usuario'))->get()->row()->usuario;
			/**	@var $nit Capturar NIT de Organización */
			$nit = $this->db->select("numNIT")->from("organizaciones")->where("numNIT", $this->input->post('nit'))->get()->row()->numNIT;
			/** Comprobar que usuario existe */
			if ($nombreUsuario != NULL || $nombreUsuario != "") {
				echo json_encode(array('url' => "registro", "msg" => "Usuario existente, intente de nuevo"));
			}
			/** Comprobar que NIT existe */
			elseif ($nit != NULL || $nit != "") {
				echo json_encode(array('url' => "registro", "msg" => "NIT existente, intente de nuevo"));
			}
			/** Acción si no existe ni usuario ni nit */
			else {
				/** Capturar Data Tabla Usuario */
				$data_registro_user = array(
					'usuario' => $this->input->post('nombre_usuario'),
					'contrasena' => $this->input->post('password'),
					'contrasena_rdel'=> $this->input->post('password'),
					'contrasena' => generate_hash($this->input->post('password')),
					'contrasena_rdel' => mc_encrypt($this->input->post('password'), KEY_RDEL),
					'logged_in' => 0,
					'created_at' => date('Y/m/d H:i:s'),
				);
				/** Guardar data de usuario y comprobar que se hubiese guardado */
				if ($this->db->insert('usuarios', $data_registro_user)){
					$this->logs_sia->logQueries();
					/**  Capturar id del usuario registrado */
					$usuario = $this->db->select('id_usuario')->from('usuarios')->where('usuario', $data_registro_user['usuario'])->get()->row();
					/** @var $data_token  Capturar Data Tabla Token */
					$data_token = array(
						'token' => generate_token(),
						'verificado' => 0,
						'usuario_token' => $data_registro_user['usuario'],
						'created_at' => date('Y/m/d H:i:s'),
					);
					/** Guardar datos en tabla token */
					$this->db->insert('token', $data_token);
					//Capturar data de token registrado
					$token = $this->db->select('id_token')->from('token')->where('usuario_token', $data_token['usuario_token'])->get()->row();
					//Crear variable de token
					$update_usuario['token_id_token'] = $token->id_token;
					//Buscar registro de usuario
					$this->db->where('id_usuario', $usuario->id_usuario);
					/**  Actualizar y comprobar usuario con token registrado. */
					if ($this->db->update('usuarios', $update_usuario)) {
						$this->logs_sia->logQueries();
						/** @var  $data_registro_org
						Capturar datos de la organización
						 */
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
							'usuarios_id_usuario' => $usuario->id_usuario,
							'created_at' => date('Y/m/d H:i:s'),
						);
						//Guardar datos en la tabla de usuarios y comprobar.
						if ($this->db->insert('organizaciones', $data_registro_org)) {
							$this->logs_sia->logQueries();
							$token = $this->db->select('token')->from('token')->where('usuario_token', $data_registro_user['usuario'])->get()->row();
							$fromSIA = "Unidad Administrativa Especial de Organizaciones Solidarias UAEOS - Aplicación SIIA.";
							$this->enviomail_activar(CORREO_SIA, $fromSIA, $data_registro_org['direccionCorreoElectronicoOrganizacion'], $data_registro_org['direccionCorreoElectronicoRepLegal'], $token->token, $data_registro_org['primerNombreRepLegal'], $data_registro_org['primerApellidoRepLegal'], $data_registro_org['nombreOrganizacion'], $data_registro_org['numNIT'], $data_registro_user['usuario']);
							$this->logs_sia->logs('REGISTER_TYPE');
							$this->logs_sia->logs('URL_TYPE');
							$this->logs_sia->logQueries();
							//echo json_encode(array('url' => "registro", 'msg' => "Se ha registrado usuario correctamente, verifica correo de notificaciones" . $data_registro_org['direccionCorreoElectronicoOrganizacion'], 'status' => 1));
						}
						else {
							echo json_encode(array('url' => "registro", 'msg' => "No se logro crear organización"));
						}
					}
					else {
						echo json_encode(array('url' => "registro", 'msg' => "No se logro crear token"));
					}
				}
				else {
					echo json_encode(array('url' => "registro", 'msg' => "No se logro crear usuario"));
				}
			}

		}
	}
	/**
	Función para enviar un correo electrónico.
	@param from = De quien lo envía.
	@param from_name = Para quien se envía.
	@param to = A que correo se envía.
	@param token = Token para validar la cuenta.
	@param nombre = Primer nombre del representante legal.
	@param apellido = Primer apellido del representante legal.
	@param organizacion = Nombre de la organización.
	@param nit = Nit de la organización.
	@param nombre_usuario = Nombre de usuario del usuario.
	 **/
	function enviomail_activar($from, $from_name, $to, $cc, $token, $nombre, $apellido, $organizacion, $nit, $nombre_usuario)
	{
		$this->email->from($from, "Acreditaciones");
		$this->email->to($to);
		$this->email->cc($cc);
		$this->email->subject('SIIA - Activación de Cuenta.');
		/** Capturar data mensaje */
		$data_msg = array(
			'organización' => $organizacion,
			'nit' => $nit,
			'to' => $to,
			'nombre_rep_legal' => $nombre,
			'apellido_rep_legal' => $apellido,
			'nombre_usuario' => $nombre_usuario,
			'token' => $token
		);
		/** Variable de mensaje, con vista y mensaje */
		$email_view = $this->load->view('email/verificacion_cuenta', $data_msg, true);
		/** Enviar vista al mensaje */
		$this->email->message($email_view);
		/** Comprobar si se envía mensaje */
		if ($this->email->send()) {
			//Capturar datos para guardar en base de datos registro del correo enviado.
			$correo_registro = array(
				'fecha' => date('Y/m/d H:i:s'),
				'de' => CORREO_SIA,
				'para' => $to,
				'cc' => $cc,
				'asunto' => "Nuevo usuario registrado - Correo de activación enviado",
				'cuerpo' => json_encode($data_msg),
				'estado' => "1",
				'tipo' => "Notificación externa",
				'error' => $this->email->print_debugger()
			);
			//Comprobar que se guardó o no el registro en la tabla correosRegistro
			if($this->db->insert('correosRegistro', $correo_registro)){
				echo json_encode(array('url' => "registro", 'msg' => "Se envío un correo a: " . $to . ", por favor verifíquelo para activar su cuenta.", "status" => 1));
			}
			else {
				echo json_encode(array('msg' => "Se envío el correo de activación pero no se guardo registro en base de datos", "status" => 1));
			}

		} else {
			//Capturar datos para guardar en base de datos registro del correo no enviado.
			$correo_registro = array(
				'fecha' => date('Y/m/d H:i:s'),
				'de' => CORREO_SIA,
				'para' => $to,
				'cc' => $cc,
				'asunto' => "Correo de activación no enviado",
				'cuerpo' => json_encode($data_msg),
				'estado' => "0",
				'tipo' => "Notificación interna",
				'error' => $this->email->print_debugger()
			);
			//Comprobar que se guardó o no el registro en la tabla correosRegistro
			if($this->db->insert('correosRegistro', $correo_registro)){
				echo json_encode(array('msg' => "Se han guardado tus datos registrados, pero no se logro enviar correo de activación, sin embargo se registro error en base de datos para verificación por parte del administrador"));
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
		$correo_electronico_rep_legal = $this->input->post('to');
		$nombre_p = $this->input->post('nombre_p');
		$apellido_p = $this->input->post('apellido_p');
		$nombre_usuario = $this->input->post('usuario');
		$token = $this->input->post('tk');
		$this->enviomail_activar(CORREO_SIA, "$fromSIA", "$correo_electronico", "$correo_electronico_rep_legal", "$token", "$nombre", "$apellido", "$organizacion", "$nit", "$nombre_usuario");
	}
}
