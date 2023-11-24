<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Resoluciones extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('SolicitudesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('AdministradoresModel');
		$this->load->model('OrganizacionesModel');
		$this->load->model('UsuariosModel');
		$this->load->model('ResolucionesModel');
	}
	/**
	 * Datos Sesión
	 */
	public function datosSession()
	{
		verify_session_admin();
		date_default_timezone_set("America/Bogota");
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'activeLink' => 'reportes',
			'departamentos' => $this->DepartamentosModel->getDepartamentos(),
		);
		return $data;
	}
	/**
	 * Vista de panel de organizaciones
	 */
	public function index()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / Resoluciones';
		$data['organizaciones'] = $this->OrganizacionesModel->getOrganizacionesEstadoAcreditado();
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/resoluciones', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/**
	 * Resoluciones por organización
	 */
	public function organizacion($idOrganizacion)
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Organización / Resoluciones';
		$data['organizacion'] = $this->OrganizacionesModel->getOrganizacion($idOrganizacion);
		$data['resoluciones'] = $this->ResolucionesModel->getResoluciones($idOrganizacion);
		$data['solicitudes'] = $this->SolicitudesModel->getSolicitudesAcreditadasOrganizacion($idOrganizacion);
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/resoluciones', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/**
	 * Cargar resolución a organización
	 */
	public function cargarResolucionOrganizacion()
	{
		$tipoResolucion = $this->input->post('tipoResolucion');
		if ($tipoResolucion == 'vieja'):
			$cursoAprobado = $this->input->post('cursoAprobado');
			$modalidadAprobada = $this->input->post('modalidadAprobada');
		else:
			$solicitud = $this->SolicitudesModel->solicitudes($this->input->post('idSolicitud'));
			$cursoAprobado = $solicitud->motivoSolicitud;
			$modalidadAprobada = $solicitud->modalidadSolicitud;
		endif;
		$organizacion = $this->OrganizacionesModel->getOrganizacion($this->input->post('id_organizacion'));
		$random = random(10);
		$size = 100000000;
		$resolucion =  "resolucion_" . $random . $_FILES['file']['name'];
		$tipo_imagen = pathinfo($resolucion, PATHINFO_EXTENSION);
		if (0 < $_FILES['file']['error']):
			echo json_encode(array('status' => "error", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		elseif ($_FILES['file']['size'] > $size):
			echo json_encode(array('status' => "warning", 'msg' => "El tamaño supera 10 MB, intente con otro pdf."));
		elseif ($tipo_imagen != "pdf"):
			echo json_encode(array('status' => "warning", 'msg' => "La extensión de la resolución no es correcta, debe ser PDF (archivo.pdf)"));
		elseif (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/resoluciones/' . $resolucion)):
			$data_update = array(
				'fechaResolucionInicial' => $this->input->post('fechaResolucionInicial'),
				'fechaResolucionFinal' => $this->input->post('fechaResolucionFinal'),
				'anosResolucion' => $this->input->post('anosResolucion'),
				'resolucion' => $resolucion,
				'numeroResolucion' => $this->input->post('numeroResolucion'),
				'cursoAprobado' => $cursoAprobado,
				'modalidadAprobada' => $modalidadAprobada,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				'idSolicitud' => $this->input->post('idSolicitud')
			);
			$this->db->insert('resoluciones', $data_update);
			$this->logs_sia->session_log('Resolución Adjuntada');
			$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' actualizó la resolución de la organización id: ' . $organizacion->id_organizacion . '.');
			$this->logs_sia->logs('URL_TYPE');
			$this->logs_sia->logQueries();
			send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'resolucionCargada', $organizacion, $resolucion, $tipoResolucion, $solicitud->idSolicitud);
		endif;
	}
	/**
	 * Eliminar resolución
	 */
	public function eliminarResolucion()
	{
		$resolucion = $this->ResolucionesModel->getResolucion($this->input->post('id_resolucion'));
		unlink('uploads/resoluciones/' . $resolucion->resolucion);
		$this->db->where('id_resoluciones', $resolucion->id_resoluciones);
		if ($this->db->delete("resoluciones")) {
			echo json_encode(array('title' => 'Eliminación resolución', 'status' => "success", 'msg' => "Se elimino la resolución."));
			$this->logs_sia->session_log('Resolución eliminada');
			$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' elimino la resolución de la organización id: ' . $this->input->post('id_organizacion') . '.');
			$this->logs_sia->logs('URL_TYPE');
			$this->logs_sia->logQueries();
		}
	}
}
// Validación de errores
function var_dump_pre($mixed = null) {
	echo '<pre>';
	var_dump($mixed);
	echo '</pre>';
	return null;
}
