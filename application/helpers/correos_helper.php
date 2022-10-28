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
function enviar_correo_admin($type, $prioridad, $docente = null)
{
	$CI = & get_instance();
	$organizacion = $CI->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $CI->session->userdata('usuario_id') )->get()->row();
	$docente = $CI->db->select("*")->from("docentes")->where("numCedulaCiudadaniaDocente", $docente)->get()->row();
	switch ($type) {
		// Actualización de facilitadores
		case 'solicitudDocente':
			$asunto = "Actualización Docente";
			$mensaje = "La organización <strong>" . $organizacion->nombreOrganizacion . "</strong>: Realizo una solicitud para actualización del facilitador <strong>" . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . "</strong>, por favor ingrese al sistema para asignar dicha solicitud, gracias. 
					<br/><br/>
					<label>Datos de recepción:</label> <br/>
					Fecha de recepcion de solicitud: <strong>" . date("Y-m-d h:m:s") . "</strong>. <br/>";
			break;
		default:
			$asunto = "";
			$mensaje = "";
			break;
	}

	$CI->email->from(CORREO_SIA, "Acreditaciones");
	$CI->email->to(CORREO_SIA);
	$CI->email->cc(CORREO_SIA);
	$CI->email->subject('SIIA: ' . $asunto);
	$CI->email->set_priority($prioridad);
	$data_msg['mensaje'] = $mensaje;
	$email_view = $CI->load->view('email/contacto', $data_msg, true);
	$CI->email->message($email_view);
	if ($CI->email->send()) {
		echo json_encode(array("msg" => "Docente " . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . " Actualizado. Se ha enviado correo para asignar solicitud"));
	} else {
		echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envío el correo."));
	}
}
?>


