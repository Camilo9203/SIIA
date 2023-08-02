<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
			$asunto = 'Actualización Docente';
			$mensaje = 'La organización <strong>' . $organizacion->nombreOrganizacion . '</strong>: Realizo una solicitud para actualización del facilitador <strong>' . $docente->primerNombreDocente . ' ' . $docente->primerApellidoDocente . '</strong>, por favor ingrese al sistema para asignar dicha solicitud, gracias. 
					<br/><br/>
					<label>Datos de recepción:</label> <br/>
					Fecha de recepcion de solicitud: <strong>' . date("Y-m-d H:i:s") . '</strong>. <br/>';
			break;
		// Asignar solicitudes a evaluadores
		case 'asignarSolicitud':
			$asunto = 'Asignación de organización';
			$mensaje = 'Se le ha asignado la solicitud: <strong>' . $solicitud . '</strong> de la organización <strong>' . $organizacion->nombreOrganizacion . '</strong> para que pueda ver la solicitud y la información, este correo es informativo y debe ingresar a la aplicación SIIA, en organizaciones y luego en evaluación para poder ver la solicitud.';
			$respuesta = array('url' => 'panelAdmin/solicitudes/asignar', 'msg' => 'Se asigno la solicitud: ' . $solicitud . ' de la organización: ' . $organizacion->nombreOrganizacion .   ' correctamente en la fecha ' . date("Y-m-d H:i:s") . '.');
			break;
		case 'solicitarCamara':
			$asunto = "Solicitud cámara de comercio: " . $organizacion->sigla;
			$head = "Buen día, esta es una notificación del sistema:, <br><br>Se ha enviado una solicitud para cargar la camara de comercio de la siguiente organización:<br><br>";
			$body = "<li> Nombre: " . $organizacion->nombreOrganizacion . " con NIT: <strong>" . $organizacion->numNIT . "</strong></li>";
			$mensaje = $head . " " . $body;
			$respuesta = (array('url' => "panel", 'msg' => "Correo enviado a funcionario encargado de subir cámaras de comercio."));
			$errorEmail = $CI->email->print_debugger();
			$error = array('url' => "panel", 'msg' => "Lo sentimos, hubo un error y no se envio el correo. <br>" . $errorEmail);
			break;
		default:
			$asunto = "";
			$mensaje = "";
			break;
	endswitch;
	/** Datos de correo */
	$CI->email->from(CORREO_SIA, "Acreditaciones");
	$CI->email->to($to);
	$CI->email->cc(CORREO_SIA);
	$CI->email->subject('SIIA: ' . $asunto);
	$CI->email->set_priority($prioridad);
	$data_msg['mensaje'] = $mensaje;
	$email_view = $CI->load->view('email/contacto', $data_msg, true);
	$CI->email->message($email_view);
	/** Envió de correo */
	if ($CI->email->send()):
		//Capturar datos para guardar en base de datos registro del correo enviado.
		$correo_registro = array(
			'fecha' => date("Y-m-d H:i:s"),
			'de' => CORREO_SIA,
			'para' => $to,
			'cc' => CORREO_SIA,
			'asunto' => $asunto,
			'cuerpo' => json_encode($data_msg),
			'estado' => 1,
			'tipo' => $tipo,
			'error' => 'Enviado'
		);
		//Comprobar que se guardó o no el registro en la tabla correosRegistro
		if($CI->db->insert('correosregistro', $correo_registro)):
			echo json_encode($respuesta);
		else:
			echo json_encode(array('url' => "panel", 'msg' => "Se ha enviado correo, pero no se guardo registro de este en base de datos"));
		endif;
	else:
		//Capturar datos para guardar en base de datos registro del correo no enviado.
		$correo_registro = array(
			'fecha' => date("Y-m-d H:i:s"),
			'de' => CORREO_SIA,
			'para' => $to,
			'cc' => CORREO_SIA,
			'asunto' => $asunto,
			'cuerpo' => json_encode($data_msg),
			'estado' => 0,
			'tipo' => $tipo,
			'error' => $CI->email->print_debugger()
		);
		//Comprobar que se guardó o no el registro en la tabla correosRegistro
		if($CI->db->insert('correosregistro', $correo_registro))
			echo json_encode($error);
	endif;
}
/** Enviar correo a usuarios */
function send_email_user($to, $type, $organizacion, $usuario = null, $token = null){
	$CI = & get_instance();
	/** Asuntos y correos emails */
	switch ($type):
		// Actualización de facilitadores
		case 'registroUsuario':
			$subject = 'Activación de Cuenta';
			$mensaje = '<strong><label>Nombre de la organización:</label></strong>
						<p>' . $organizacion->nombreOrganizacion . '</p>
						<strong><label>Número NIT:</label></strong>
						<p>' . $organizacion->numNIT .  '</p>
						<strong><label>Correo de contacto:</label></strong>
						<p>' . $to . '</p>
						<strong><label>Representante legal:</label></strong>
						<p>' . $organizacion->primerNombreRepLegal . ' ' . $organizacion->primerApellidoRepLegal . '</p>
						<strong><label>Nombre de usuario:</label></strong>
						<p>' . $usuario . '</p>
						<p>Organizaciones Solidarias le recuerda que es importante mantener la información básica de contacto de la entidad actualizada, para facilitar el desarrollo procesos derivados de la acreditación. Le recomendamos cada vez que se realice algún cambio sea reportado por medio del SIIA. En razón a la política de manejo de datos institucional y para verificar la identidad de la organización, es necesario activar su cuenta en el siguiente link:</p><br />
						<a target="_blank" style="font-family: Arial, sans-serif; background: #0071b9; color:white; display: inline-block; text-decoration: none; line-height:40px; font-size: 18px; width:200px; box-shadow: 2px 3px #e2e2e2; font-weight: bold;" href='. base_url() . 'activate/?tk:' . $token . ':' . $usuario . '>Activar mi cuenta</a>';
			$response = array('url' => "registro", 'msg' => "Se envío un correo a: " . $to . ", por favor verifíquelo para activar su cuenta.", "status" => 1);
			break;
		default:
			$asunto = "";
			$mensaje = "";
			break;
	endswitch;
	/** Datos de correo */
	$CI->email->from(CORREO_SIA, "Acreditaciones");
	$CI->email->to($to);
	$CI->email->cc(CORREO_SIA);
	$CI->email->subject('SIIA: ' . $subject);
	$msg['mensaje'] = $mensaje;
	$email_view = $CI->load->view('email/contacto', $msg, true);
	$CI->email->message($email_view);
	/** Envió de correo */
	if ($CI->email->send()):
		$error = $CI->email->print_debugger();
		save_log_email($to, $subject, $mensaje, $type, $error, $response);
	else:
		$error = $CI->email->print_debugger();
		save_log_email($to, $subject, $mensaje, $type, $error, $response);
	endif;
}
/** Guardar logs correos */
function save_log_email($to, $subject, $msg, $type, $error, $response) {
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
		echo json_encode($response);
	else:
		echo json_encode(array('url' => "panel", 'msg' => "Se ha enviado correo, pero no se guardo registro de este en base de datos"));
	endif;
}

?>


