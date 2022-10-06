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
	}

	public function nitEntidades()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$nivel = $this->session->userdata('nivel');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal / Administrador / Opciones / Nit de entidades';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['nivel'] = $nivel;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['nits'] = $this->cargarNits();
		$data['organizaciones'] = $this->OrganizacionesModel->getOrganizacionesAcreditadas();

		$this->load->view('include/header', $data);
		$this->load->view('admin/opciones/nitEntidades', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function cargarNits()
	{
		$nits = $this->db->select("*")->from("nits_db")->get()->result();
		return $nits;
	}
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
	public function cargarDatosResolucion()
	{
		$idResolucion = $this->input->post('idResolucion');
		$resolucion = $this->db->select('*')->from('resoluciones')->where('resoluciones.id_resoluciones', $idResolucion)->get()->row();
		echo json_encode(array('msg' => 'Información Cargada', 'resolucion' => $resolucion));
	}


}

function var_dump_pre($mixed = null) {
	echo '<pre>';
	var_dump($mixed);
	echo '</pre>';
	return null;
}



