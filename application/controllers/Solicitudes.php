<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Solicitudes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EstadisticasModel');
	}
	// Traer datos solicitud
	public function index()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal';
		$data['logged_in'] = $logged;
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['estado'] = $this->estadoOrganizaciones();
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();
		$data['data_solicitudes'] = $this->cargarSolicitudes();
		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
		$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal();
		$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo();
		$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos();
		$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion();
		$data['data_basicos_programas'] = $this->cargarDatos_formulario_basicos_programas();
		$data['data_aval_economia'] = $this->cargarDatos_formulario_aval_economia();
		$data['data_programas_avalar'] = $this->cargarDatos_formulario_programas_avalar();
		$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma();
		$data['data_modalidad_en_linea'] = $this->cargarDatos_modalidad_en_linea();
		$data['data_programas'] = $this->cargarDatos_programas();
		$data["camara"] = $this->cargarCamaraComercio();
		$data['informacionModal'] = $this->cargar_informacionModal();
		$this->load->view('include/header', $data);
		$this->load->view('paneles/panel', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Variables de Session
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
		);
		return $data;
	}
	// Panel Estadistico
	public function panel()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / Estadisticas / Panel';
		$this->load->view('include/header', $data);
		$this->load->view('admin/estadisticas/estadisticas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Estdisticas del acreditacion
	public function acreditacion()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / Estadisticas / Acreditacion';
		$this->load->view('include/header', $data);
		$this->load->view('admin/estadisticas/acreditacion', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// public function view($id = NULL)
	// {
	// 	$data['estadisticasmodel'] = $this->EstadisticasModel->get_solicitudes($id);
	// }
}
