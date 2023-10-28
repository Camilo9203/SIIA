<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DocumentacionLegal extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('InformacionGeneralModel');
		verify_session();
	}
	// Formulario 2
	public function create()
	{
		$tipoForm = $this->input->post('tipo');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $this->session->userdata('usuario_id'))->get()->row();
		switch ($tipoForm) {
			case 1:
				$data = array(
					'tipo' => $this->input->post('tipo'),
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
					'idSolicitud' => $this->input->post('idSolicitud')
				);
				if ($this->db->insert('documentacion', $data)):
					echo json_encode(array('status' => "success", 'msg' => "Datos de camara de comercio guardados"));
				else:
					echo json_encode(array('status' => "error", 'msg' => "Verifique los datos ingresado, no son correctos."));
				endif;
				break;
			case 2:
				$dataDocumentacion = array(
					'tipo' => $this->input->post('tipo'),
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
					'idSolicitud' => $this->input->post('idSolicitud')
				);
				if ($this->db->insert('documentacion', $dataDocumentacion)) {
					$dataCertificadoExistencia = array(
						'entidad' => $this->input->post('entidadCertificadoExistencia'),
						'fechaExpedicion' => $this->input->post('fechaExpedicion'),
						'departamento' => $this->input->post('departamentoCertificado'),
						'municipio' => $this->input->post('municipioCertificado'),
						'organizaciones_id_organizacion' => $organizacion->id_organizacion,
						'idSolicitud' => $this->input->post('idSolicitud')
					);
					if ($this->db->insert('certificadoExistencia', $dataCertificadoExistencia)) {
						$name_random = random(10);
						$size = 100000000;
						$registro = $this->db->select('*')->from('certificadoExistencia')->where('idSolicitud', $this->input->post('idSolicitud'))->get()->row();
						$nombreArchivo = $this->input->post('append_name') . "_" . $name_random . "_" . $_FILES['file']['name'];
						$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
						$ruta = 'uploads/certificadoExistencia';
						$mensaje = "Se guardo el " . $this->input->post('append_name');
						$dataArchivo = array(
							'tipo' => 'certificadoExistencia',
							'nombre' => $nombreArchivo,
							'id_formulario' => 2,
							'id_registro' => $registro->id_certificadoExistencia,
							'organizaciones_id_organizacion' => $organizacion->id_organizacion,
						);

						if (0 < $_FILES['file']['error']) {
							echo json_encode(array('status' => "error", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
						} else if ($_FILES['file']['size'] > $size) {
							echo json_encode(array('status' => "error", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
						} else if ($extension != "pdf") {
							echo json_encode(array('status' => "error", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
						} else if ($this->db->insert('archivos', $dataArchivo)) {
							if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombreArchivo)) {
								echo json_encode(array('status' => "success", 'msg' => $mensaje));
							} else {
								echo json_encode(array('status' => "error", 'msg' => "No se guardo el archivo(s)."));
							}
						}
						$this->logs_sia->logs('URL_TYPE');
						$this->logs_sia->logQueries();
					}
				} else {
					echo json_encode(array('status' => "error", 'msg' => "Verifique los datos ingresado, no son correctos."));
				}
				break;
			case 3:
				$dataDocumentacion = array(
					'tipo' => $this->input->post('tipo'),
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
					'idSolicitud' => $this->input->post('idSolicitud')
				);
				if ($this->db->insert('documentacion', $dataDocumentacion)) {
					$dataRegistro = array(
						'tipoEducacion' => $this->input->post('tipoEducacion'),
						'fechaResolucion' => $this->input->post('fechaResolucionProgramas'),
						'numeroResolucion' => $this->input->post('numeroResolucionProgramas'),
						'nombrePrograma' => $this->input->post('nombrePrograma'),
						'objetoResolucion' => $this->input->post('objetoResolucionProgramas'),
						'entidadResolucion' => $this->input->post('entidadResolucion'),
						'organizaciones_id_organizacion' => $organizacion->id_organizacion,
						'idSolicitud' => $this->input->post('idSolicitud')
					);
					if ($this->db->insert('registroEducativoProgramas', $dataRegistro)) {
						$name_random = random(10);
						$size = 100000000;
						$registro = $this->db->select('*')->from('registroEducativoProgramas')->where('numeroResolucion', $this->input->post('numeroResolucionProgramas'))->get()->row();
						$nombreArchivo = $this->input->post('append_name') . "_" . $name_random . "_" . $_FILES['file']['name'];
						$extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
						$ruta = 'uploads/registrosEducativos';
						$mensaje = "Se guardo el " . $this->input->post('append_name');
						$dataArchivo = array(
							'tipo' => 'registroEdu',
							'nombre' => $nombreArchivo,
							'id_formulario' => 2,
							'id_registro' => $registro->id_registroEducativoPro,
							'organizaciones_id_organizacion' => $organizacion->id_organizacion,
						);
						if (0 < $_FILES['file']['error']) {
							echo json_encode(array('status' => "error", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
						} else if ($_FILES['file']['size'] > $size) {
							echo json_encode(array('status' => "error", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
						} else if ($extension != "pdf") {
							echo json_encode(array('status' => "error", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
						} else if ($this->db->insert('archivos', $dataArchivo)) {
							if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombreArchivo)) {
								echo json_encode(array('status' => "success", 'msg' => $mensaje));
							} else {
								echo json_encode(array('status' => "error", 'msg' => "No se guardo el archivo(s)."));
							}
						}
						$this->logs_sia->logs('URL_TYPE');
						$this->logs_sia->logQueries();
					}
				} else {
					echo json_encode(array('status' => "error", 'msg' => "Verifique los datos ingresado, no son correctos."));
				}
				break;
			default:
				break;
		}
	}
}
