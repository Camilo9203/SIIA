<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Encuesta extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EncuestaModel');
	}
	//Función de inicio.
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
	//Cargar todas las encuestas registradas
	public function cargar()
	{
		$data = array(
			'encuestas' => $this->EncuestaModel->encuestas(),
		);
		// Json datos encuestas
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}
	// Almacenar y enviar encuesta.
	public function enviarEncuesta()
	{
		//Captura datos de encuesta
		$data = array(
			'general' => $this->input->post('calificacion_general'),
			'evaluador' => $this->input->post('calificacion_evaluador'),
			'comentario' => $this->input->post('comentario'),
			'fecha' => date('Y/m/d'),
			'solicitudes_id_solicitud' => "1"
		);
		//Guardar y comprobar datos guardados en tabla encuesta
		if ($this->db->insert('encuesta', $data)) {
			//Capturar datos para envío de correo electrónico a administrador del sistema
			$this->email->from(CORREO_SIA, "Acreditaciones");
			$this->email->to(CORREO_PRUEBAS);
			$this->email->subject('Correo de información del SIIA - Asunto: Se ha registrado una encuesta');
			//Declarar vista de correo y enviar datos de la encuesta a plantilla para ser trabajada desde allí.
			$email_view = $this->load->view('email/encuesta', $data, true);
			$this->email->message($email_view);
			//Enviar y comprobar el envío del correo electrónico de notificación.
			if ($this->email->send()) {
				//Capturar datos para guardar en base de datos registro del correo enviado.
				$correo_registro = array(
					'fecha' => date('Y/m/d'),
					'de' => CORREO_SIA,
					'para' => CORREO_PRUEBAS,
					'asunto' => "Encuesta enviada",
					'cuerpo' => json_encode($data),
					'estado' => "1",
					'tipo' => "Notificación interna"
				);
				//Comprobar que se guardó o no el registro en la tabla correosRegistro
				if($this->db->insert('correosRegistro', $correo_registro)){
					echo json_encode(array('estado' => 1, 'msg' => "Se envío el correo, por favor esperar la respuesta."));
				}
				else {
					echo json_encode(array('estado' => 2, 'msg' => "Se envío el correo al administrador con tus respuesta pero no se guardo registro en base de datos"));
				}
			} else {
				//Capturar datos para guardar en base de datos registro del correo no enviado.
				$correo_registro = array(
					'fecha' => date('Y/m/d'),
					'de' => CORREO_SIA,
					'para' => CORREO_PRUEBAS,
					'asunto' => "Encuesta no enviada",
					'cuerpo' => json_encode($data),
					'estado' => "0",
					'tipo' => "Notificación interna",
					'error' => $this->email->print_debugger()
				);
				//Comprobar que se guardó o no el registro en la tabla correosRegistro
				if($this->db->insert('correosRegistro', $correo_registro)){
					echo json_encode(array('estado' => 2, 'msg' => "Se han guardado tus repuestas en base de datos pero no se logro notificar por correo al administrador, sin embargo se registro error en base de datos para verificación"));
				}
			}
		} else {
			echo json_decode(array('estado' => 0, 'msg' => "No se ha logrado registrar tu respuesta por favor intenta de nuevo" ));
		}

	}

}
