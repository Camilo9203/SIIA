<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reportes extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welco7me
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		verify_session_admin();
	}

	public function entidadesAcreditadas()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['organizacionesAcreditadas'] = $this->cargar_organizacionesAcreditadas();

		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/acreditadas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function entidadesAcreditadasSin()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['organizacionesAcreditadas'] = $this->cargar_organizacionesAcreditadas();

		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/acreditadasSin', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}


	public function entidadesHistorico()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['organizacionesHistorico'] = $this->cargar_organizacionesHistorico();

		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/historico', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function verAsistentes()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Administrador - Reportes Asistentes';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['asistentes'] = $this->cargar_asistentesCursos();

		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/asistentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function registroTelefonico()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Administrador - Registro telefonico';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['registros'] = $this->cargar_registrosTelefonicos();

		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/telefonicos', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function docentesHabilitados()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Administrador - Reportes Docentes';
		$data['logged_in'] = $logged;
		$data['nombre_usuario'] = $nombre_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['docentes'] = $this->cargar_docentesHabilitados();

		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/docentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function cargarDepartamentos()
	{
		$departamentos = $this->db->select("*")->from("departamentos")->get()->result();
		return $departamentos;
	}

	public function cargar_organizacionesAcreditadas()
	{
		$organizaciones = array();
		$dataOrganizaciones = $this->db->select("organizaciones_id_organizacion")->from("estadoOrganizaciones")->where("nombre", "Acreditado")->or_where("estadoAnterior", "Acreditado")->get()->result();
		$organizacionesNITDB = $this->db->select(("distinct(numNIT), numNIT"))->from("nits_db")->get()->result();

		foreach ($organizacionesNITDB as $organizacionDB) {
			$numNIT = $organizacionDB->numNIT;
			$data_organizaciones = $this->db->select("*")->from("organizaciones")->where("numNIT", $numNIT)->get()->row();
			$data_organizacionesBD = $this->db->select("*")->from("nits_db")->where("numNIT", $numNIT)->get()->row();
			$id_org = $data_organizaciones->id_organizacion;
			$data_organizaciones_inf = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_org)->get()->row();
			$data_organizaciones_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_org)->get()->row();
			//$data_organizaciones_est = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_org)->get()->row();
			$estadoOrganizacion = $data_organizaciones_est->nombre;
			$data_organizaciones_res = $this->db->select("*")->from("resoluciones")->where("organizaciones_id_organizacion", $id_org)->get()->result();

			if ($data_organizaciones != NULL && $estadoOrganizacion != "Inscrito") {
				foreach ($data_organizaciones_res as $resol) {
					$id_resol = $resol->id_resoluciones;
					$data_organizaciones_res_ = $this->db->select("*")->from("resoluciones")->where("id_resoluciones", $id_resol)->get()->row();

					array_push($organizaciones, array("data_organizaciones" => $data_organizaciones, "data_organizaciones_inf" => $data_organizaciones_inf, "data_organizaciones_est" => $data_organizaciones_est, "resoluciones" => $data_organizaciones_res_));
				}
			} else if ($data_organizacionesBD != NULL) {
				$data_organizacionesHist = $this->db->select("*")->from("organizacionesHistorial")->where("numNIT", $numNIT)->get()->row();
				$id_OrgHist = $data_organizacionesHist->id_organizacionHistorial;
				$data_hist = $this->db->select("*")->from("historial")->where("organizaciones_id_organizacion", $id_OrgHist)->get()->row();
				$id_hist = $data_hist->id_historial;
				$data_organizaciones_resHist = $this->db->select("*")->from("historialResoluciones")->where("historial_id_historial", $id_hist)->order_by("id_historialResoluciones", "desc")->get()->row();

				array_push($organizaciones, array("data_organizaciones" => $data_organizacionesBD, "data_organizaciones_inf" => $data_organizacionesBD, "data_organizaciones_est" => $data_organizacionesBD, "resoluciones" => $data_organizaciones_resHist));
			}
		}
		/*foreach ($dataOrganizaciones as $organizacion) {
			$data_organizaciones = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $organizacion->organizaciones_id_organizacion)->get()->row();
	 		$data_organizaciones_inf = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $organizacion->organizaciones_id_organizacion)->get()->row();
	 		$data_organizaciones_est = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $organizacion->organizaciones_id_organizacion)->get()->row();
	 		$data_organizaciones_res = $this->db->select("*")->from("resoluciones")->where("organizaciones_id_organizacion", $organizacion->organizaciones_id_organizacion)->get()->row();
			array_push($organizaciones, array("data_organizaciones" => $data_organizaciones, "data_organizaciones_inf" => $data_organizaciones_inf, "data_organizaciones_est" => $data_organizaciones_est, "resoluciones" => $data_organizaciones_res));
		}*/
		return $organizaciones;
	}

	public function cargar_organizacionesHistorico()
	{
		$data_organizaciones = $this->db->select("*")->from("organizacionesHistorial")->get()->result();
		return $data_organizaciones;
	}

	public function cargar_asistentesCursos()
	{
		$asistentes = $this->db->select("*")->from("asistentes")->get()->result();
		return $asistentes;
	}

	public function cargar_docentesHabilitados()
	{
		$docentes = $this->db->select("*")->from("docentes")->where("valido", 1)->get()->result();
		return $docentes;
	}

	public function verInformacion()
	{
		$data_ = array();
		$informes = $this->db->select("*")->from("informeActividades")->get()->result();
		foreach ($informes as $informe) {
			$id_informe = $informe->id_informeActividades;
			$asistentes = $this->db->select("*")->from("asistentes")->where("informeActividades_id_informeActividades", $id_informe)->get()->result();
			array_push($data_, $asistentes);
		}
		echo json_encode(array("informe" => $informes, "asistentes" => $data_));
	}

	public function cargar_registrosTelefonicos()
	{
		$reportes = $this->db->select("*")->from("registroTelefonico")->get()->result();
		return $reportes;
	}
}
