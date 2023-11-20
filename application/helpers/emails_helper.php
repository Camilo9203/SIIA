<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Enviar correo desde súper admin
 */
function send_email_super($type, $administrador)
{
	$CI = & get_instance();
	switch ($type):
		case 'creacionAdministrador':
				$CI->load->model('AdministradoresModel');
				$subject = 'Creación administrador';
				$message = '<strong><h4>Se ha creado un usuario administrador!</h4></strong>
							<p>Buen día, ' . $administrador->primerNombreAdministrador . ' ' . $administrador->primerApellido . 'La unidad solidaria le informa que se le ha asignado un usuario administrador con los siguientes datos:</p><br />
							<strong><label>Usuario:</label></strong>
							<p>' . $administrador->usuario .  '</p>
							<strong><label>Contraseña:</label></strong>
							<p>' . $CI->AdministradoresModel->getPassword($administrador->contrasena_rdel) . '</p>
							<strong><label>Correo electrónico:</label></strong>
							<p>' . $administrador->direccionCorreoElectronico . '</p>
							<strong><label>Rol:</label></strong>
							<p>' . $CI->AdministradoresModel->getNivel($administrador->nivel)  . '</p>
							<a target="_blank" style="font-family: Arial, sans-serif; background: #0071b9; color:white; display: inline-block; text-decoration: none; line-height:40px; font-size: 18px; width:200px; box-shadow: 2px 3px #e2e2e2; font-weight: bold;" href='. base_url() . 'admin/>Ingresar</a>';
				$response = array("status" => 1, "title" => "Administrador creado!", "icon" => "success", 'msg' => "Se envío un correo a: " . $administrador->direccionCorreoElectronico . " y a la supervisión con la información de acceso.");
			break;
		default:
			break;
	endswitch;
	/** Datos de correo */
	$CI->email->from(CORREO_SIA, "Acreditaciones");
	$CI->email->to($administrador->direccionCorreoElectronico);
	$CI->email->cc(CORREO_COORDINADOR);
	$CI->email->subject('SIIA: ' . $subject);
	$msg['mensaje'] = $message;
	$email_view = $CI->load->view('email/contacto', $msg, true);
	$CI->email->message($email_view);
	/** Envió de correo */
	if ($CI->email->send()):
		$error = 'Enviado';
		save_log_email($administrador->direccionCorreoElectronico, $subject, $message, $type, $error, $response);
	else:
		$error = $CI->email->print_debugger();
		$response = array("status" => 1, "title" => "Administrador creado!", "icon" => "info", 'msg' => "Se creo administrador, pero no se logro enviar correo a : " . $administrador->direccionCorreoElectronico . " Error: " . $error , );
		save_log_email($administrador->direccionCorreoElectronico, $subject, $message, $type, $error, $response);
	endif;

}
/**
 * Datos para envío de Email al administrador
 * Prioridad
1 => '1 (Highest)',
2 => '2 (High)',
3 => '3 (Normal)',
4 => '4 (Low)',
5 => '5 (Lowest)'
 **/
function send_email_admin($tipo, $prioridad = null, $to = null, $docente = null, $organizacion = null, $solicitud = null)
{
	$CI = & get_instance();
	/** Asuntos y correos emails */
	switch ($tipo):
		// Actualización de facilitadores
		case 'solicitudDocente':
			$subject = 'Actualización Docente';
			$message = 'La organización <strong>' . $organizacion->nombreOrganizacion . '</strong>: Realizo una solicitud para actualización del facilitador <strong>' . $docente->primerNombreDocente . ' ' . $docente->primerApellidoDocente . '</strong>, por favor ingrese al sistema para asignar dicha solicitud, gracias. 
					<br/><br/>
					<label>Datos de recepción:</label> <br/>
					Fecha de recepcion de solicitud: <strong>' . date("Y-m-d H:i:s") . '</strong>. <br/>';
			break;
		// Asignar solicitudes a evaluadores
		case 'asignarSolicitud':
			$subject = 'Asignación de organización';
			$message = 'Se le ha asignado la solicitud: <strong>' . $solicitud . '</strong> de la organización <strong>' . $organizacion->nombreOrganizacion . '</strong> para que pueda ver la solicitud y la información, este correo es informativo y debe ingresar a la aplicación SIIA, en organizaciones y luego en evaluación para poder ver la solicitud.';
			//$response = array('url' => 'panelAdmin/solicitudes/asignar', 'msg' => 'Se asigno la solicitud: ' . $solicitud . ' de la organización: ' . $organizacion->nombreOrganizacion .   ' correctamente en la fecha ' . date("Y-m-d H:i:s") . '.');
			break;
		case 'solicitarCamara':
			$subject = "Solicitud cámara de comercio: " . $organizacion->sigla;
			$head = "Buen día, esta es una notificación del sistema:, <br><br>Se ha enviado una solicitud para cargar la camara de comercio de la siguiente organización:<br><br>";
			$body = "<li> Nombre: " . $organizacion->nombreOrganizacion . " con NIT: <strong>" . $organizacion->numNIT . "</strong></li>";
			$message = $head . " " . $body;
			$response = (array('url' => "panel", 'msg' => "Correo enviado a funcionario encargado de subir cámaras de comercio."));
			break;
		default:
			$subject = "";
			$mensaje = "";
			break;
	endswitch;
	/** Datos de correo */
	$CI->email->from(CORREO_SIA, "Acreditaciones");
	$CI->email->to($to);
	$CI->email->cc(CORREO_SIA);
	$CI->email->subject('SIIA: ' . $subject);
	$CI->email->set_priority($prioridad);
	$data_msg['mensaje'] = $message;
	$email_view = $CI->load->view('email/contacto', $data_msg, true);
	$CI->email->message($email_view);
	/** Envió de correo */
	if ($CI->email->send()):
		$error = 'Enviado';
		//Capturar datos para guardar en base de datos registro del correo enviado.
		save_log_email($to, $subject, $message, $tipo, $error, $response);
	else:
		$error = $CI->email->print_debugger();
		//Capturar datos para guardar en base de datos registro del correo enviado.
		save_log_email($to, $subject, $message, $tipo, $error, $response);
	endif;
}
/**
 * Enviar correo a usuarios
 */
function send_email_user($to, $type, $organizacion, $usuario = null, $token = null, $idSolicitud = null){
	$CI = & get_instance();
	$CI->load->model('SolicitudesModel');
	$CI->load->model('UsuariosModel');
	/** Asuntos y correos emails */
	switch ($type):
		// Actualización de facilitadores
		case 'registroUsuario':
			$subject = 'Activación de Cuenta';
			$message = '<strong><label>Nombre de la organización:</label></strong>
						<p>' . $organizacion->nombreOrganizacion . '</p>
						<strong><label>Número NIT:</label></strong>
						<p>' . $organizacion->numNIT .  '</p>
						<strong><label>Correo de contacto:</label></strong>
						<p>' . $to . '</p>
						<strong><label>Representante legal:</label></strong>
						<p>' . $organizacion->primerNombreRepLegal . ' ' . $organizacion->primerApellidoRepLegal . '</p>
						<strong><label>Nombre de usuario:</label></strong>
						<p>' . $usuario . '</p>
						<p>Unidad Solidaria le recuerda que es importante mantener la información básica de contacto de la entidad actualizada, para facilitar el desarrollo procesos derivados de la acreditación. Le recomendamos cada vez que se realice algún cambio sea reportado por medio del SIIA. En razón a la política de manejo de datos institucional y para verificar la identidad de la organización, es necesario activar su cuenta en el siguiente link:</p><br />
						<a target="_blank" style="font-family: Arial, sans-serif; background: #0071b9; color:white; display: inline-block; text-decoration: none; line-height:40px; font-size: 18px; width:200px; box-shadow: 2px 3px #e2e2e2; font-weight: bold;" href='. base_url() . 'activate/?tk:' . $token . ':' . $usuario . '>Activar mi cuenta</a>';
			$response = array('status' => 'success', 'title' => 'Cuenta registrada', 'msg' => "Se envío un correo a: <strong> " . $to . "</strong>, por favor verifíquelo para activar su cuenta.");
			break;
		case 'crearSolicitud':
			$subject = "Inicia el diligenciamiento de la solicitud";
			$message = "Organización " . $organizacion->nombreOrganizacion . ": Unidad Solidaria le informa que ha iniciado el diligenciamiento de su solicitud de acreditación. Recuerde diligenciar todos los formularios, ingresando la información en los campos requeridos, los archivos adjuntos como imágenes y archivos con las extensiones en letra minúscula admitidas (archivo.jpg, archivo.png, archivo.pdf) y con un peso no mayor a 15 Mb cada archivo. Al final de cada formulario guarde la información con el botón 'Guardar'. Cuando concluya con el ingreso de información en todos los formularios y archivos adjuntos requeridos, favor enviar la solicitud para su evaluación dando FINALIZAR en el SIIA. Si esta actualizando información recuerde eliminar la solicitud al finalizar. Unidad Solidaria le recuerda que es importante mantener la  información básica de contacto de la entidad actualizada, para facilitar el desarrollo procesos derivados de la acreditación. Le recomendamos  cada vez que se realice algún cambio sea reportado por medio del SIIA.";
			$response = array('status' => 'success', 'title' => 'Solicitud creada!', 'msg' => "Se créo nueva solicitud: <strong>" . $idSolicitud . "</strong> Será redireccionado a la página para diligenciar los formularios de esta solicitud.", 'id' => $idSolicitud);
			break;
		case 'enviarSolicitd':
			$subject = "Finaliza el diligenciamiento de la solicitud";
			$message = "<p>Buen día, <strong>" . $organizacion->nombreOrganizacion . "</strong>
 					<br><br>La unidad Solidaria le informa que su solicitud de acreditación ha sido enviada para ser evaluada.
					<br>En este momento no puede visualizarla en el aplicativo hasta que se realice la verificación de requisitos. 
					<br><br>Una vez sea recepcionada la solicitud por el coordinador de areá, él asignará un <strong>evaluador</strong> a esta solicitud y se notificará por correo eléctronico.
					<br>De ser necesario, el <strong>evaluador</strong> le devolverá la solicitud con las observaciones pertinentes, dentro de los siguientes <strong>(10) días hábiles</strong>.</p> 
					<br/><br/>
					<label>Datos de recepción:</label> <br/><br/>
					Fecha de envío solicitud: <strong>" . date("Y-m-d h:m:s") . "</strong>. <br/> 
					Fecha de creación de solicitud: <strong>" . $CI->SolicitudesModel->solicitudes($idSolicitud)->fechaCreacion . "</strong>. <br/> 
					Número ID de la solicitud: <strong>" . $idSolicitud . "</strong><br><br> ¡Muchas Gracias!";
			$response = array('status' => "success", 'title' => 'Solicitud enviada!' ,'msg' => $message);
			break;
		case 'actualizarPerfil':
			$subject = "Actualización de perfil";
			$message = "Organización " . $organizacion->nombreOrganizacion . ": Unidad Solidaria le informa que la información básica de contacto de la entidad se ha actualizado satisfactoriamente y será publicada en el listado de entidades acreditadas si está acreditada durante los primeros cinco días del siguiente mes. Lo invitamos a actualizar su información cada vez que lo sea necesario.";
			$response = array('status' => "success", 'title' => 'Actualización de perfil correcta!' ,'msg' => "Su información de perfil ha sido actualizada con éxito");
			break;
		case 'EnviarDatosUsuario':
			$subject = "Información de usuario SIIA";
			$message = "Buen día, <strong>" . $organizacion->nombreOrganizacion . " </strong><br>A continuación se relacionan los datos de usuario para inicio de sesión en el sistema integrado de acreditación SIIA:
			<br><br><h3>Datos de usuario </h3><br>
			<strong>Usuario: </strong>" . $usuario->usuario . "<br><br>
			<strong>Contraseña: </strong>" . $CI->UsuariosModel->getPassword($usuario->contrasena_rdel);
			$response = array('status' => "success", 'title' => "Información enviada",'msg' =>  "Correo enviado a " . $organizacion->direccionCorreoElectronicoOrganizacion . " correctamente!");
			break;
		case 'asignarEvaluador':
			$subject = "Asignación de evaluador a su solicitud";
			$message = "Buen día, <strong>" . $organizacion->nombreOrganizacion . " </strong><br> A continuación se relacionan los datos del evaluador que está a cargo de su solicitud: <strong>" . $idSolicitud .
			"</strong><br><br><h3>Datos de evaluador </h3><br>
			<strong>Evaluador: </strong>" . $usuario->primerNombreAdministrador . " " . $usuario->primerApellidoAdministrador . "<br><br>
			<strong>Celular: </strong>" . $usuario->celular . "<br><br>
			<strong>Correo electronico: </strong>" . $usuario->direccionCorreoElectronico;
			$response = array('status' => "success", 'title' => "Solicitud asignada correctamente",'msg' =>  "Se a notificado a <strong> " . $organizacion->direccionCorreoElectronicoOrganizacion . "</strong> y a <strong>" . $usuario->direccionCorreoElectronico . "</strong>");
			break;
		default:
			$asunto = "";
			$message = "";
			break;
	endswitch;
	/** Datos de correo */
	$CI->email->from(CORREO_SIA, "Acreditaciones");
	$CI->email->to($to);
	$CI->email->cc(CORREO_SIA);
	$CI->email->subject('SIIA: ' . $subject);
	$msg['mensaje'] = $message;
	$email_view = $CI->load->view('email/contacto', $msg, true);
	$CI->email->message($email_view);
	/** Envió de correo */
	if ($CI->email->send()):
		$error = 'Enviado';
		save_log_email($to, $subject, $message, $type, $error, $response);
	else:
		$error = $CI->email->print_debugger();
		save_log_email($to, $subject, $message, $type, $error, $response);
	endif;
}
/**
 * Guardar logs correos
 */
function save_log_email($to, $subject, $msg, $type, $error, $response = null) {
	$CI = & get_instance();
	$email_details = array(
		'fecha' => date("Y-m-d H:i:s"),
		'de' => CORREO_SIA,
		'para' => $to,
		'cc' => CORREO_SIA,
		'asunto' => $subject,
		'cuerpo' => json_encode($msg),
		'estado' => 1,
		'tipo' => $type,
		'error' => $error
	);
	if($CI->db->insert('correosregistro', $email_details)):
		if($response != null):
			echo json_encode($response);
		endif;
	else:
		if($response != null):
			echo json_encode($response);
		endif;
	endif;
}

?>


