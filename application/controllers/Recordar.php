<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recordar extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Bogota");
	}

	/**
		Funcion Index para cargar las vistas necesarias.
	**/
	public function index(){
		$this->load->view('include/header_src');
		$this->load->view('recordar/recordar_contrasena');
	}

	/**
		Funcion para recordar contraseña del usuario.
		Los parametros se traen del ajax.
	**/
	public function recordar()
	{
		$organizacion = $this->db->select('*')->from('organizaciones')->where('numNIT', $this->input->post('nit'))->get()->row();

		die(var_dump($organizacion->direccionCorreoElectronicoOrganizacion));

		$fromSIA = "Unidad Administrativa Especial de Organizaciones Solidarias UAEOS - Aplicacion SIIA.";
		$usuario = $this->input->post('usuario');
		$correo_electronico =  $this->input->post('correo_electronico');

		$datos_usuario = $this->db->select('*')->from('usuarios')->where('usuario', $usuario)->get()->row();
		$datos_registro = $this->db->select('*')->from('organizaciones')->where('direccionCorreoElectronicoOrganizacion', $correo_electronico)->get()->row();
		$this->logs_sia->logQueries();

		if($datos_usuario == "NULL" || $datos_usuario == NULL || $datos_usuario == null && $datos_registro == "NULL" || $datos_registro == NULL || $datos_registro == null){
			$user_exist = false;
		}else{
			$user_exist = true;
		}

		if($user_exist == true){
			$contrasena_rdel = $datos_usuario ->contrasena_rdel;
			$correo_electronico = $datos_registro ->direccionCorreoElectronicoOrganizacion;
			$nombre_usuario = $datos_usuario ->usuario;
			$password = mc_decrypt($contrasena_rdel, KEY_RDEL);
			$this->enviomail_recodar(CORREO_SIA, "$fromSIA", "$correo_electronico", "$password", "$nombre_usuario");
			$this->logs_sia->logs('REMEMBER_PASSWORD');
			$this->logs_sia->logs('URL_TYPE');
		}else{
			echo json_encode(array('url'=>"login", 'msg'=>"No existe el usuario."));
			$this->logs_sia->logs('URL_TYPE');
		}
	}

	/**
		Funcion para enviar un correo electronico.
		@param from = De quien lo envia.
		@param from_name = Para quien se envia.
		@param to = A que correo se envia.
		@param contrasena = Constraseña del usuario descencriptada.
		@param nombre_usuario = Nombre de usuario del usuario.
	**/
	function enviomail_recodar($from, $from_name, $to, $contrasena, $nombre_usuario){
		$this->email->from($from, "Acreditaciones");
		$this->email->to($to);
		$this->email->subject('SIIA - Recordar Contraseña.');

		$data_msg['to'] = $to;
		$data_msg['nombre_usuario'] = $nombre_usuario;
		$data_msg['contrasena'] = $contrasena;

		$email_view = $this->load->view('email/recordar_contrasena', $data_msg, true);

		$this->email->message($email_view);

		if($this->email->send()){
			$data = array(
				'fecha' => date('Y/m/d'),
				'de' => $from,
				'para' => $to,
				'asunto' => 'SIIA - Recordar Contraseña.',
				'cuerpo' => $data_msg,
				'estado' => 'enviado',
				'tipo' => 'Alerta Automatica',
				'error' => 'Ninguno'
			);
//			die(var_dump($data));
			$this->db->insert('correosRegistro', $data);
			echo json_encode(array('url'=>"", 'msg'=>"Se envio un correo, por favor verifiquelo."));
		}else{
			$error = $this->email->print_debugger();
			echo json_encode(array('url'=>"login", 'msg'=>"Lo sentimos, hubo un error y no se envio el correo." . $error));
		}
	}

	public function recordarToUser(){
		date_default_timezone_set("America/Bogota");
		$organizaciones = $this->db->select("*")->from("estadoOrganizaciones")->where("nombre", "En Observaciones")->get()->result();

		foreach ($organizaciones as $organizacion) {
			$id_org = $organizacion->organizaciones_id_organizacion;

			$data_org = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_org)->get()->result();
			$data_org_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->result();
			$solicitud_org = $this->db->select("*")->from("solicitudes")->where("organizaciones_id_organizacion", $id_org)->get()->result();

			foreach ($data_org as $data) {
				foreach ($data_org_est as $estado) {
					foreach ($solicitud_org as $solicitud) {
						$direccionOrganizacion = $data->direccionCorreoElectronicoOrganizacion;
						$id_user = $data->usuarios_id_usuario;
						$direccionRepresentante = $data->direccionCorreoElectronicoRepLegal;
						$nombreOrganizacion = $data->nombreOrganizacion;
						$nit = $data->numNIT;
						$fechaFinalizado = $estado->fechaFinalizado;
						$fechaUltimaRevision = $solicitud->fechaUltimaRevision;
						$today = date('Y-m-d');
						list($año, $mes, $dia) = explode('-', $fechaUltimaRevision);
						list($año_, $mes_, $dia_) = explode('-', $today);
						if($año == $año_){
							if(($dia_ - $dia) == 10){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le informa que aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016,  solicitud de acreditación ha sido archivada. Su cuenta se activará en un mes a partir de hoy,  para que pueda presentar una nueva solicitud de acreditación, según lo establecido en  parágrafo 2 del artículo 5 de la mencionada Resolución. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";

									$fechaAct = strtotime('.1 month', strtotime($today));
									$fechaAct = date('Y-m-d', $fechaAct);
									 
									$dataToken = array(
										"verificado" => 2,
										"fechaActivacion" => $fechaAct,
									);

									$id_tk = $this->db->select("token_id_token")->from("usuarios")->where("id_usuario", $id_user)->get()->row()->token_id_token;

									$this->db->where('id_token', $id_tk);
									if($this->db->update('token', $dataToken)){
										$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
									}
							}
							if(($dia_ - $dia) == 9){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en un (1) día hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
							}
							if(($dia_ - $dia) == 7){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en tres (3) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
							}
							if(($dia_ - $dia) == 5){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en cinco (5) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
							}
							if(($dia_ - $dia) == 3){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en siete (7) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.\nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
							}
							if(($dia_ - $dia) == 1){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en nueve (9) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.\nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
							}
							if(($dia_ - $dia) == 0){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.", Organizaciones Solidarias le recuerda que en cinco (5) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.\nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
							}
						}
					}
				}
			}
		}
	}

	public function recordarToUserActivation(){
		date_default_timezone_set("America/Bogota");
		$organizaciones = $this->db->select("*")->from("estadoOrganizaciones")->where("nombre", "En Observaciones")->get()->result();

		foreach ($organizaciones as $organizacion) {
			$id_org = $organizacion->organizaciones_id_organizacion;

			$data_org = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_org)->get()->result();
			$data_org_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->result();
			$solicitud_org = $this->db->select("*")->from("solicitudes")->where("organizaciones_id_organizacion", $id_org)->get()->result();

			foreach ($data_org as $data) {
				foreach ($data_org_est as $estado) {
					foreach ($solicitud_org as $solicitud) {
						$direccionOrganizacion = $data->direccionCorreoElectronicoOrganizacion;
						$id_user = $data->usuarios_id_usuario;
						$direccionRepresentante = $data->direccionCorreoElectronicoRepLegal;
						$nombreOrganizacion = $data->nombreOrganizacion;
						$id_organizacion = $data->id_organizacion;
						$nit = $data->numNIT;
						$fechaFinalizado = $estado->fechaFinalizado;
						$fechaUltimaRevision = $solicitud->fechaUltimaRevision;
						$today = date('Y-m-d');
						$id_tk = $this->db->select("token_id_token")->from("usuarios")->where("id_usuario", $id_user)->get()->row()->token_id_token;
						$fechaActivacion = $this->db->select("fechaActivacion")->from("token")->where("id_token", $id_tk)->get()->row()->fechaActivacion;
						list($año, $mes, $dia) = explode('-', $fechaActivacion);
						list($año_, $mes_, $dia_) = explode('-', $today);
						if($año == $año_){
							if(($dia_ - $dia) == 0){
								$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le informa que aplicando lo   establecido en  parágrafo 2 del artículo 5 de la Resolución 110 de 2016, la cuenta creada en el SIIA fue activada nuevamente. De mantenerse el interés por la acreditación le invitamos a  presentar una nueva solicitud. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
									 
									$dataToken = array(
										"verificado" => 1,
										"fechaActivacion" => NULL,
									);

									$dataEstado = array(
										"nombre" => "Inscrito",
										"estadoAnterior" => "Inscrito",
									);

									$id_tk = $this->db->select("token_id_token")->from("usuarios")->where("id_usuario", $id_user)->get()->row()->token_id_token;

									$this->db->where('id_token', $id_tk);
									if($this->db->update('token', $dataToken)){
										$this->db->where('organizaciones_id_organizacion', $id_organizacion);
										if($this->db->update('estadoOrganizaciones', $dataEstado)){
											$this->envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante);
										}
									}
							}
						}
					}
				}
			}
		}
	}

	public function recordarToAdmin(){
		date_default_timezone_set("America/Bogota");
		$organizaciones = $this->db->select("*")->from("estadoOrganizaciones")->where("nombre", "Finalizado")->get()->result();

		foreach ($organizaciones as $organizacion) {
			$id_org = $organizacion->organizaciones_id_organizacion;

			$data_org = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_org)->get()->result();
			$data_org_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->result();

			foreach ($data_org as $data) {
				foreach ($data_org_est as $estado) {
					$direccionOrganizacion = $data->direccionCorreoElectronicoOrganizacion;
					$direccionRepresentante = $data->direccionCorreoElectronicoRepLegal;
					$nombreOrganizacion = $data->nombreOrganizacion;
					$nit = $data->numNIT;
					$fechaFinalizado = $estado->fechaFinalizado;
					$today = date('Y-m-d');
					list($año, $mes, $dia) = explode('-', $fechaFinalizado);
					list($año_, $mes_, $dia_) = explode('-', $today);
					if($año == $año_){
						if(($dia_ - $dia) == 10){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.", Organizaciones Solidarias le recuerda que HOY vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_ATENCION, CORREO_ATENCION);
						}
						if(($dia_ - $dia) == 9){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en un (1) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_ATENCION, CORREO_ATENCION);
						}
						if(($dia_ - $dia) == 7){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en dos (2) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_COORDINADOR, CORREO_ATENCION);
						}
						if(($dia_ - $dia) == 5){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en cinco (5) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación.  Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016. \nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_COORDINADOR, CORREO_ATENCION);
						}
						if(($dia_ - $dia) == 3){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en siete (7) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.\nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_AREA, CORREO_COORDINADOR);
						}
						if(($dia_ - $dia) == 1){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.": Organizaciones Solidarias le recuerda que en nueve (9) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.\nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_AREA, CORREO_COORDINADOR);
						}
						if(($dia_ - $dia) == 0){
							$mensaje = "Hola, la organización: ".$nombreOrganizacion.", Organizaciones Solidarias le recuerda que en cinco (5) días hábiles vence el plazo para enviar la información complementaria requerida en la verificación de requisitos de su solicitud de acreditación. Tenga presente que vencido este tiempo su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.\nDatos:\nCorreo organización:".$direccionOrganizacion."\nCorreo representante:".$direccionRepresentante."\nNIT:".$nit.".";
								$this->envio_mail_tiempo_admin($mensaje, CORREO_DIRECTOR, CORREO_AREA);
						}
					}
				}
			}
		}
	}

	public function recordarToCamara(){
		$usuarioCamara = $this->db->select("*")->from("administradores")->where("nivel", 3)->get()->row();
		$nombre = $usuarioCamara->primerNombreAdministrador;
		$apellido = $usuarioCamara->primerApellidoAdministrador; 
		$correoCamara = $usuarioCamara->direccionCorreoElectronico;

		$inicio = "Buen día ".$nombre." ".$apellido.", <br>Las siguientes organizaciones estan pendientes por subir la camara de comercio:<br><br>";
		$orgTotales = "Organizaciones inscritas en la aplicación (todas): <br><br>";
		$orgFinalizadas = "Organizaciones que finalizaron, en observaciones o requieren nueva camara de comercio <strong>(prioritarias)</strong>: <br><br>";

		$dataOrganizaciones = $this->db->select("organizaciones_id_organizacion")->from("estadoOrganizaciones")->get()->result();
		
		foreach ($dataOrganizaciones as $organizacionDB) {
			$id_organizacion = $organizacionDB->organizaciones_id_organizacion;
			$data_organizaciones = $this->db->select("nombreOrganizacion, numNIT, camaraComercio, id_organizacion")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row();
			$id_org = $data_organizaciones->id_organizacion;
			$camaraComercio = $data_organizaciones->camaraComercio;
	 		$data_organizaciones_inf = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_org)->get()->row();
			$documentacionLegal = $this->db->select("*")->from("documentacionLegal")->where("organizaciones_id_organizacion",$id_org)->get()->row();
	 		$data_organizaciones_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->row();
	 		$estadoOrganizacion = $data_organizaciones_est->nombre;
	 		$registro = $documentacionLegal->registroEducativo;

	 		if(($estadoOrganizacion == "Finalizado" || $estadoOrganizacion == "En Observaciones") && $camaraComercio == "default.pdf" && $registro == "No Tiene"){
	 			$texto1 .= "Nombre: ".$data_organizaciones->nombreOrganizacion." con NIT: <strong>".$data_organizaciones->numNIT."</strong><br>";
	 		}
	 		
	 		if($data_organizaciones != NULL && $camaraComercio == "default.pdf"){
	 			$texto .= "Nombre: ".$data_organizaciones->nombreOrganizacion." con NIT: <strong>".$data_organizaciones->numNIT."</strong><br>";
	 		}
		}

		echo $inicio;
		echo "Correo de notificaciones: ".$correoCamara;
		echo "<br><br>";
		echo $orgFinalizadas;
		echo $texto1;
		echo "<br>";
		echo $orgTotales;
		echo $texto;
	}

	/*public funciones recordarToAsignar(){
		$usuarioAsignar = $this->db->select("*")->from("administradores")->where("nivel", 6)->get()->row();
		$nombre = $usuarioAsignar->primerNombreAdministrador;
		$apellido = $usuarioAsignar->primerApellidoAdministrador;
		$correoCoordinacion = $usuarioAsignar->direccionCorreoElectronico;

		$inicio = "Buen día ".$nombre." ".$apellido.", <br>Las siguientes organizaciones estan pendientes por asignar:<br><br>";
		$dataOrganizaciones = $this->db->select("organizaciones_id_organizacion")->from("estadoOrganizaciones")->get()->result();
		
		foreach ($dataOrganizaciones as $organizacionDB) {
			$id_organizacion = $organizacionDB->organizaciones_id_organizacion;
			$data_organizaciones = $this->db->select("nombreOrganizacion, numNIT, id_organizacion, asignada")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row();
			$id_org = $data_organizaciones->id_organizacion;
			$asignada = $data_organizaciones->asignada;
	 		$data_organizaciones_inf = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_org)->get()->row();
	 		$data_organizaciones_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->row();
	 		$estadoOrganizacion = $data_organizaciones_est->nombre;

	 		if(($estadoOrganizacion == "Finalizado" || $estadoOrganizacion == "En Observaciones") && $asignada == "SIN ASIGNAR"){
	 			$texto1 .= "Nombre: ".$data_organizaciones->nombreOrganizacion." con NIT: <strong>".$data_organizaciones->numNIT."</strong><br>";
	 		}
		}

		echo $inicio;
		echo "Correo de notificaciones: ".$correoCoordinacion;
		echo "<br><br>";
		echo $texto1;
		echo "<br>";
		echo $texto;
	}*/

	public function recordarToAsignarMail(){
		$usuarioAsignar = $this->db->select("*")->from("administradores")->where("nivel", 6)->get()->row();
		$nombre = $usuarioAsignar->primerNombreAdministrador;
		$apellido = $usuarioAsignar->primerApellidoAdministrador;
		$correoCoordinacion = $usuarioAsignar->direccionCorreoElectronico;

		$inicio = "Buen día ".$nombre." ".$apellido.", <br>Las siguientes organizaciones estan pendientes por asignar:<br><br>";
		$dataOrganizaciones = $this->db->select("organizaciones_id_organizacion")->from("estadoOrganizaciones")->get()->result();
		
		foreach ($dataOrganizaciones as $organizacionDB) {
			$id_organizacion = $organizacionDB->organizaciones_id_organizacion;
			$data_organizaciones = $this->db->select("nombreOrganizacion, numNIT, id_organizacion, asignada")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row();
			$id_org = $data_organizaciones->id_organizacion;
			$asignada = $data_organizaciones->asignada;
	 		$data_organizaciones_inf = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_org)->get()->row();
	 		$data_organizaciones_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->row();
	 		$estadoOrganizacion = $data_organizaciones_est->nombre;

	 		if(($estadoOrganizacion == "Finalizado" || $estadoOrganizacion == "En Observaciones") && $asignada == "SIN ASIGNAR"){
	 			$texto1 .= "Nombre: ".$data_organizaciones->nombreOrganizacion." con NIT: <strong>".$data_organizaciones->numNIT."</strong><br>";
	 		}
		}

		$correo = $inicio."".$texto1."".$texto;

		$this->envio_mail_asginar_admin($correo, $correoCoordinacion);
	}
	// Solicitar Camara de Comercio
	public function pedirCamara(){
		$idOrganizacion = $this->input->post('id_organizacion');
		$imagen_db = $this->db->select('camaraComercio')->from('organizaciones')->where('id_organizacion', $idOrganizacion)->get()->row();
		$imagen_db_nombre = $imagen_db ->camaraComercio;
		unlink('uploads/camaraComercio/' . $imagen_db_nombre);
		$camaraComercio = array(
			'camaraComercio' => "default.pdf"
		);
		$this->db->where('id_organizacion', $idOrganizacion);
		if($this->db->update('organizaciones', $camaraComercio)){
			$this->logs_sia->session_log('Organización:' . $this->session->userdata('nombre_usuario').' pidió nueva camara de comercio a la organización con ID: ' . $idOrganizacion . '.');
			$usuarioCamara = $this->db->select("*")->from("administradores")->where("nivel", 3)->get()->row();
			$correo = $usuarioCamara->direccionCorreoElectronico;
			$head = "Buen día " . $usuarioCamara->primerNombreAdministrador . " " . $usuarioCamara->primerApellidoAdministrador . ", <br><br>Es necesario cargar la Camara de Comercio de la siguiente organización:<br><br>";
			$organizacion = $this->db->select("*")->from("organizaciones")->where('id_organizacion', $idOrganizacion)->get()->row();
			$body = "<li> Nombre: " . $organizacion->nombreOrganizacion . " con NIT: <strong>" . $organizacion->numNIT . "</strong></li>";
			$mensaje = $head . "" . $body;
			$num_prioridad = 1;
			$asunto = "Cámaras de comercio: " . $organizacion->sigla;
			$this->email->from(CORREO_SIA, "Acreditaciones");
			$this->email->to($correo);
			$this->email->cc(CORREO_SIA);
			$this->email->subject('SIIA - ' . $asunto);
			$this->email->set_priority($num_prioridad);
			$msgEmail['mensaje'] = $mensaje;
			$email_view = $this->load->view('email/contacto', $msgEmail, true);
			$this->email->message($email_view);
			if($this->email->send()){
				echo json_encode(array('url' => "panel", 'msg' => "Correo enviado a " . $correo . " solicitando camara de comercio. No es necesario subir archivos en este formulario."));
			}else{
				$error = $this->email->print_debugger();
				echo json_encode(array('url' => "panel", 'msg'=>"Lo sentimos, hubo un error y no se envío el correo." . $error));
			}

		}
		// LogQueries
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function calculo_tiempo(){
		$organizaciones = $this->db->select("*")->from("estadoOrganizaciones")->where("nombre", "Acreditado")->get()->result();

		foreach ($organizaciones as $organizacion) {
			$id_org = $organizacion->organizaciones_id_organizacion;

			$data_org = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_org)->get()->result();
			$data_org_res = $this->db->select("*")->from("resoluciones")->where("organizaciones_id_organizacion", $id_org)->get()->result();

			foreach ($data_org as $data) {
				foreach ($data_org_res as $resolucion) {
					$direccionOrganizacion = $data->direccionCorreoElectronicoOrganizacion;
					$direccionRepresentante = $data->direccionCorreoElectronicoRepLegal;
					$nombreOrganizacion = $data->nombreOrganizacion;
					$today = date('Y-m-d');
					$fechaFinal = $resolucion->fechaResolucionFinal;
					list($año, $mes, $dia) = explode('-', $fechaFinal);
					list($año_, $mes_, $dia_) = explode('-', $today);

					if($año == $año_){
						if(($mes - $mes_) == 0){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad perdió su vigencia.  Por lo anterior no es posible que la entidad ofrezca y certifique cursos de economía solidaria para efectos de constitución de organizaciones. Si se mantiene el interés por la acreditación, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017.Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones.";
								
								$this->db->where('organizaciones_id_organizacion', $id_org);
								$resolucion = $data_org_res->resolucion;
								unlink('uploads/resoluciones/'.$resolucion);

								if($this->db->delete('resoluciones')){
									$data_update_estado = array(
										'nombre' => "Acreditado",
										'fecha' =>  date('Y/m/d H:i:s'),
										'estadoAnterior' => "Acreditado"
									);

									$this->db->where('organizaciones_id_organizacion', $id_org);
									$this->db->update('estadoOrganizaciones', $data_update_estado);
								}
							}
						}
						if(($mes - $mes_) == 1){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 1 mes. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						if(($mes - $mes_) == 2){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 2 meses. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						if(($mes - $mes_) == 3){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 3 meses. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						if(($mes - $mes_) == 4){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 4 meses. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						if(($mes - $mes_) == 6){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 6 meses. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						if(($mes - $mes_) == 9){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 9 meses. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						if(($mes - $mes_) == 11){
							if($dia_ == $dia){
								$mensaje = "Hola ".$nombreOrganizacion.": Organizaciones Solidarias le informa que la acreditación otorgada a su entidad  vence dentro de 11 meses. Para mantener  la continuidad en la acreditación, le invitamos a realizar la solicitud de renovación por el SIIA teniendo en cuenta lo establecido en el artículo 6 de la resolución 110 de 2016 y en la resolución 332 de 2017. Vencido este término, se puede presentar solicitud de renovación la entidad siguiendo lo establecido en la  Resolución 332 de 2017. Se aclara que las certificaciones de cursos que se emitan en el periodo de tiempo comprendido entre el vencimiento de la acreditación y la renovación, no será válidos para efectos de constitución de organizaciones, dado que se interrumpe la continuidad de la acreditación.";
							}
						}
						$this->envio_mail_tiempo($mensaje, $direccionOrganizacion, $direccionRepresentante);
					}
				}
			}
		}
	}

	public function envio_mail_tiempo($mensaje, $direccionOrganizacion, $direccionRepresentante){
		$num_prioridad = 1;
		$asunto = "Tiempo de renovación de solicitud";
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($direccionOrganizacion);
		$this->email->cc($direccionRepresentante);
		$this->email->subject('SIIA - : '.$asunto);
		$this->email->set_priority($num_prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if($this->email->send()){
			echo json_encode("Correo enviado a ".$direccionOrganizacion." y ".$direccionRepresentante." con mensaje: ".$mensaje."");
		}else{
			echo json_encode("Lo sentimos, hubo un error y no se envio el correo.");
		}
	}

	public function envio_mail_tiempoUser($mensaje, $direccionOrganizacion, $direccionRepresentante){
		$num_prioridad = 1;
		$asunto = "Observaciones de la solicitud";
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($direccionOrganizacion);
		$this->email->cc($direccionRepresentante);
		$this->email->subject('SIIA - : '.$asunto);
		$this->email->set_priority($num_prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if($this->email->send()){
			echo json_encode("Correo enviado a ".$direccionOrganizacion." y ".$direccionRepresentante." con mensaje: ".$mensaje."");
		}else{
			echo json_encode("Lo sentimos, hubo un error y no se envio el correo.");
		}
	}

	public function envio_mail_tiempo_admin($mensaje, $correo_1, $correo_2){
		$num_prioridad = 1;
		$asunto = "Ver solicitud de organización por tiempo de 10 dias habiles";
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($correo_1);
		$this->email->cc($correo_2);
		$this->email->subject('SIIA - : '.$asunto);
		$this->email->set_priority($num_prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if($this->email->send()){
			echo json_encode("Correo enviado a ".$correo_1." y ".$correo_2." con mensaje: ".$mensaje."");
		}else{
			echo json_encode("Lo sentimos, hubo un error y no se envio el correo.");
		}
	}

	public function envio_mail_asginar_admin($mensaje, $correo){
		$num_prioridad = 1;
		$asunto = "Asignación de Organizaciones/Solicitudes";
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($correo);
		$this->email->cc(CORREO_SIA);
		$this->email->subject('SIIA - : '.$asunto);
		$this->email->set_priority($num_prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if($this->email->send()){
			echo json_encode("Correo enviado a ".$correo." de asginaciones.");
		}else{
			echo json_encode("Lo sentimos, hubo un error y no se envio el correo.");
		}
	}
}
