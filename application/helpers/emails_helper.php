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
?>


