<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nit extends CI_Controller
{
	//ALTER TABLE administradores AUTO_INCREMENT=99999999;
	function __construct()
	{
		parent::__construct();
		verify_session_admin();
		$this->load->model('OrganizacionesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('NitsModel');
	}
	/** Datos Sesión */
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
	/** NITS Entidades */
	public function nitEntidades()
	{
		$data = $this->datosSession();
		$data['nits'] = $this->NitsModel->getNits();
		$data['organizaciones'] = $this->OrganizacionesModel->getOrganizacionesEstadoAcreditado();
		$this->load->view('include/header', $data);
		$this->load->view('admin/opciones/nitEntidades', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/** Cargar datos organizaciones */
	public function cargarDatosOrganizacion()
	{
		$id= $this->input->post('id');
		$organizacion = $this->db->select('*')->from('organizaciones')->where('organizaciones.numNIT', $id)->get()->row();
		$solicitudes = $this->db->select('*')->from('estadoOrganizaciones')
			->join('solicitudes', 'solicitudes.organizaciones_id_organizacion = estadoOrganizaciones.organizaciones_id_organizacion')
			->join('tipoSolicitud', 'tipoSolicitud.organizaciones_id_organizacion = estadoOrganizaciones.organizaciones_id_organizacion')
			->where('estadoOrganizaciones.organizaciones_id_organizacion', $id)->get()->result();
		$resoluciones = $this->db->select('*')->from('resoluciones')->where('resoluciones.organizaciones_id_organizacion', $organizacion->id_organizacion)->get()->result();
		echo json_encode(array('msg' => 'Información Cargada' ,'organizacion' => $organizacion, 'solicitudes' => $solicitudes, 'resoluciones' => $resoluciones));
	}
	/** Cargar datos resolución */
	public function cargarDatosResolucion()
	{
		$idResolucion = $this->input->post('idResolucion');
		$resolucion = $this->db->select('*')->from('resoluciones')->where('resoluciones.id_resoluciones', $idResolucion)->get()->row();
		echo json_encode(array('msg' => 'Información Cargada', 'resolucion' => $resolucion));
	}
	/** Guardar NITS */
	public function guardarNitAcreditadas()
	{
		$data_nit_acre = array(
			'numNIT' => $this->input->post('nit_org'),
			'nombreOrganizacion' => $this->input->post('nombreOrganizacion'),
			'numeroResolucion' => $this->input->post('numeroResolucion'),
			'fechaFinalizacion' => $this->input->post('fechaFinalizacion')
		);
		if ($this->db->insert('nits_db', $data_nit_acre)) {
			echo json_encode(array('msg' => "El nit se guardo."));
			$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' creo un nit de entidades acreditadas.');
		}
	}
}
/** Función depuración */
function var_dump_pre($mixed = null) {
	echo '<pre>';
	var_dump($mixed);
	echo '</pre>';
	return null;
}



