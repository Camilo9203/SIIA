<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class JornadasActualizacion extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('JornadasActualizacionModel');
	}
	/**
	 * Guardar datos jornadas de actualización
	 */
	public function create()
	{
		// Traer datos organizaciones
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// Capturar datos de archivo
		$file = $_FILES['file'];
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append = $this->input->post('append_name');
		$random = random(10);
		$nombreImagen =  $append . "_" . $random . "_" . $file['name'];
		$metadata = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombreImagen,
			'id_formulario' => 4,
			'id_registro' => $this->input->post('idSolicitud'),
			'organizaciones_id_organizacion' => $organizacion->id_organizacion
		);
		// Crear y cargar archivo
		$fileCreated = create_file($file, $metadata);
		// Comprobar si el archivo se cargó correctamente
		if ($fileCreated == "true"):
			// Validar si existen datos en numero de personas y fecha
			$numeroPersonas = empty($this->input->post('numeroPersonas')) ? 0 : $this->input->post('numeroPersonas');
			$fechaAsistencia = empty($this->input->post('fechaAsistencia')) ? date('Y/m/d H:i:s') : $this->input->post('fechaAsistencia');
			// Comprobar si se traen datos por post
			if ($this->input->post()) {
				// Datos de creación de la jornada.
				$datos = array(
					'numeroPersonas' => $numeroPersonas,
					'fechaAsistencia' => $fechaAsistencia,
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
					'idSolicitud' => $this->input->post('idSolicitud')
				);
				if ($this->db->insert('jornadasActualizacion', $datos)):
					echo json_encode(array("icon" => "success", "msg" => "Se guardo formulario 4: Jornada de actualización."));
				else:
					echo json_encode(array("icon" => "error", "msg" => "No se guardo la Jornada de actualización."));
				endif;
				$this->logs_sia->session_log("Formulario Jornadas Actualización");
				$this->logs_sia->logQueries();
			} else {
				echo json_encode(array("icon" => "error", "msg" => "Verifique los datos ingresado, no son correctos."));
			}
		else:
			echo json_encode(array("icon" => "error", "msg" => $fileCreated));
		endif;
	}
	/**
	 * Eliminar datos jornadas actualización
	 */
	public function delete(){
		$id = $this->input->post('id_jornada');
		$this->db->where('idSolicitud', $id);
		if($this->db->delete('jornadasActualizacion'))
			echo json_encode(array("msg" => "El registro ha sido eliminado."));
	}
}
