<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		setlocale(LC_ALL, 'es_CO.UTF-8');
	}

	/**
		Funcion Index para cargar las vistas necesarias.
	 **/
	public function index()
	{
		$data = array(
			'title' => 'Home',
			'loggen_in' => false,
			'tipo_usuario' => "none",
			'activeLink' => "home"
		);
		$this->load->view('include/header/guest', $data);
		$this->load->view('home');
		$this->load->view('include/footer/guest');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function cargarOpcionesSistema()
	{
		$opciones = $this->db->select("*")->from("opciones")->get()->result();
		echo json_encode($opciones);
	}

	public function construccion()
	{
		$data['title'] = 'En contrucción';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		$data['nombre_usuario'] = "none";

		$this->load->view('404_r');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function ejemploCorreos()
	{
		$this->load->view('email/contacto');
		$this->load->view('email/recordar_contrasena');
		$this->load->view('email/verificacion_cuenta');
	}

	public function mantenimiento()
	{
		$data['title'] = 'En mantenimiento';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		$data['nombre_usuario'] = "none";

		$this->load->view('mantenimiento');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function mapa()
	{
		$data['title'] = 'Mapa Gestión';
		$data['logged_in'] = false;
		$data['tipo_usuario'] = "none";
		$data['nombre_usuario'] = "none";

		$this->load->view('include/header', $data);
		$this->load->view('mapagestion/mapa');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function estadoSolicitud()
	{
		$data = array(
			'title' => 'Estado de la organización - solicitud',
			'loggen_in' => false,
			'tipo_usuario' => "none",
			'activeLink' => "estado"
		);

		$this->load->view('include/header/guest', $data);
		$this->load->view('estadoSolicitud');
		$this->load->view('include/footer/guest');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function facilitadores()
	{
		$data = array(
			'title' => 'Facilitadores válidos',
			'loggen_in' => false,
			'tipo_usuario' => "none",
			'activeLink' => "facilitadores"
		);

		$this->load->view('include/header/guest', $data);
		$this->load->view('facilitadores');
		$this->load->view('include/footer/guest');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function consultarEstado()
	{
		$idoNit = $this->input->post('idoNit');

		$tipoSolicitud = $this->db->select("*")->from("tipoSolicitud")->where("idSolicitud", $idoNit)->get()->row();
		if ($tipoSolicitud == "") {
			$organizaciones = $this->db->select("*")->from("organizaciones")->where("numNIT", $idoNit)->get()->row();

			$idOrganizacion = $organizaciones->id_organizacion;

			$tipoSolicitud = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $idOrganizacion)->get()->row();
		} else {
			$idOrganizacion = $tipoSolicitud->organizaciones_id_organizacion;
		}
		$estado = $this->db->select("fechaFinalizado, nombre, organizaciones_id_organizacion")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $idOrganizacion)->get()->row();

		echo json_encode(array("estado" => $estado, "tipoSolicitud" => $tipoSolicitud));
	}

	public function consultarFacilitadores()
	{
		$numeroNIT = $this->input->post('numeroNIT');

		$organizaciones = $this->db->select("*")->from("organizaciones")->where("numNIT", $numeroNIT)->get()->row();
		$id_organizacion = $organizaciones->id_organizacion;

		if ($organizaciones != "") {
			$facilitadores = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->where("valido", 1)->get()->result();
		}

		echo json_encode(array("facilitadores" => $facilitadores));
	}

}
