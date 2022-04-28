<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Encuesta extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EncuestaModel');
	}
	// Traer datos estadisticos
	public function index()
	{
		$data = array(
			'title' => 'Encuesta de Satisfacción',
			'logged_in' => false,
			'tipo_usuario' => "none",
			'nombre_usuario' => "none",
		);
		$this->load->view('include/header_new', $data);
		$this->load->view('encuesta/index');
		$this->load->view('include/footer_new');
		$this->logs_sia->logs('PLACE_USER');
	}
	// Almacenar y enviar encuesta.
	public function enviarEncuesta()
	{
		$data = array(
			'general' => $this->input->post('calificacion_general'),
			'evaluador' => $this->input->post('calificacion_evaluador'),
			'comentario' => $this->input->post('comentario'),
			'fecha' => date('Y/m/d'),
			'solicitudes_id_solicitud' => "1"
		);

		if ($this->db->insert('encuesta', $data)) {

			$this->email->from(CORREO_SIA, "Acreditaciones");
			$this->email->to(CORREO_PRUEBAS);
			$this->email->subject('Correo de información del SIIA - Asunto: Se ha registrado una encuesta');
			$mensaje['mensaje'] = $this->input->post('calificacion_general');
			$email_view = $this->load->view('email/contacto', $mensaje, true);
			$this->email->message($email_view);

			if ($this->email->send()) {
				$correo_registro = array(
					'fecha' => date('Y/m/d'),
					'de' => CORREO_SIA,
					'para' => CORREO_PRUEBAS,
					'asunto' => "Correo de información del SIIA - Asunto: Se ha registrado una encuesta",
					'estado' => "1",
					'tipo' => "Notificación interna"
				);
				if($this->db->insert('correosRegistro', $correo_registro)){
					echo json_encode(array('url' => "login", 'msg' => "Se envío el correo, por favor esperar la respuesta."));
				}
			} else {
				echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envío el correo."));
			}
			//echo json_encode(array('url' => "login", 'msg' => "Se ha logrado registrar tu respuesta, muchas gracias."));
		} else {
			echo json_decode(array('url' => "login", 'msg' => "No se ha logrado registrar tu respuesta por favor intenta de nuevo" ));
		}

	}

}
