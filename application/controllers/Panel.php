<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		verify_session();
	}

	/**
		Funcion Index para cargar las vistas necesarias.
	 **/
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
		$data['activeLink'] = 'panel';
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
//		$data['estado'] = $this->estadoOrganizaciones();
//		$data['departamentos'] = $this->cargarDepartamentos();
//
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();
//		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
//		$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal();
//		$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo();
//		$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos();
//		$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion();
//		$data['data_basicos_programas'] = $this->cargarDatos_formulario_basicos_programas();
//		$data['data_aval_economia'] = $this->cargarDatos_formulario_aval_economia();
//		$data['data_programas_avalar'] = $this->cargarDatos_formulario_programas_avalar();
//		$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma();
//		$data["camara"] = $this->cargarCamaraComercio();
//		$data['informacionModal'] = $this->cargar_informacionModal();

		$this->load->view('include/header/main', $data);
		$this->load->view('usuario/panel', $data);
		$this->load->view('include/footer/main', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function formularios()
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
		$data['activeLink'] = 'panel';
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
//		$data['estado'] = $this->estadoOrganizaciones();
//		$data['departamentos'] = $this->cargarDepartamentos();
//
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();
//		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
//		$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal();
//		$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo();
//		$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos();
//		$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion();
//		$data['data_basicos_programas'] = $this->cargarDatos_formulario_basicos_programas();
//		$data['data_aval_economia'] = $this->cargarDatos_formulario_aval_economia();
//		$data['data_programas_avalar'] = $this->cargarDatos_formulario_programas_avalar();
//		$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma();
//		$data["camara"] = $this->cargarCamaraComercio();
//		$data['informacionModal'] = $this->cargar_informacionModal();

		$this->load->view('include/header/main', $data);
		$this->load->view('usuario/paginas/formularios', $data);
		$this->load->view('include/footer/main', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function facilitadores()
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
		$data['activeLink'] = 'panel';
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
//		$data['estado'] = $this->estadoOrganizaciones();
//		$data['departamentos'] = $this->cargarDepartamentos();
//
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();
//		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
//		$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal();
//		$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo();
//		$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos();
//		$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion();
//		$data['data_basicos_programas'] = $this->cargarDatos_formulario_basicos_programas();
//		$data['data_aval_economia'] = $this->cargarDatos_formulario_aval_economia();
//		$data['data_programas_avalar'] = $this->cargarDatos_formulario_programas_avalar();
//		$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma();
//		$data["camara"] = $this->cargarCamaraComercio();
//		$data['informacionModal'] = $this->cargar_informacionModal();

		$this->load->view('include/header/main', $data);
		$this->load->view('usuario/paginas/facilitadores', $data);
		$this->load->view('include/footer/main', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function estadisticas()
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
		$data['activeLink'] = 'panel';
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
//		$data['estado'] = $this->estadoOrganizaciones();
//		$data['departamentos'] = $this->cargarDepartamentos();
//
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();
//		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
//		$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal();
//		$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo();
//		$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos();
//		$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion();
//		$data['data_basicos_programas'] = $this->cargarDatos_formulario_basicos_programas();
//		$data['data_aval_economia'] = $this->cargarDatos_formulario_aval_economia();
//		$data['data_programas_avalar'] = $this->cargarDatos_formulario_programas_avalar();
//		$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma();
//		$data["camara"] = $this->cargarCamaraComercio();
//		$data['informacionModal'] = $this->cargar_informacionModal();

		$this->load->view('include/header/main', $data);
		$this->load->view('usuario/paginas/estadisticas', $data);
		$this->load->view('include/footer/main', $data);
		$this->logs_sia->logs('PLACE_USER');
	}


	public function estadoSolicitud()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Estado de la Solicitud';
		$data['logged_in'] = $logged;
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['data_organizacion'] = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row()->id_organizacion;
		$data['idSolicitud'] = $this->idSolicitud();
		$data['observaciones'] = $this->cargarObservaciones();
		$data['estadoSolicitud'] = $this->cargarEstadoSolicitudAdmin();
		$data['archivosPlataforma'] = $this->cargarObservacionesPlataforma();

		$this->load->view('include/header', $data);
		$this->load->view('paneles/estadoSolicitud', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function informeActividades()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Informe de Actividades';
		$data['logged_in'] = $logged;
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['docentes'] = $this->cargarDocentesInforme();
		$data['departamentos'] = $this->cargarDepartamentos();
		$data['cursos'] = $this->cargar_informeCursos();
		$data['organizaciones'] = $this->cargarTodasOrganizaciones();
		$data['tiposCursos'] = $this->cargarTiposCursoInforme();

		$this->load->view('include/header', $data);
		$this->load->view('paneles/informe', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function docentes()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Facilitadores';
		$data['logged_in'] = $logged;
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['dataInformacionGeneral'] = $this->cargarDatos_formulario_informacion_general_entidad();
		$data['docentes'] = $this->cargar_docentes();

		$this->load->view('include/header', $data);
		$this->load->view('paneles/docentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}

	public function planMejora()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date("H:i", time());
		$fecha = date('Y/m/d');

		$data['title'] = 'Panel Principal - Seguimiento y Plan de Mejora';
		$data['logged_in'] = $logged;
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;
		$data['usuario_id'] = $usuario_id;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['visitas'] = $this->cargarVisitas();
		$data['seguimientos'] = $this->cargarSeguimientos();
		$data['planesMejoramiento'] = $this->cargarPlanesMejoramiento();

		$this->load->view('include/header', $data);
		$this->load->view('paneles/planMejoramiento', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/**
		Cargar datos
	 **/
	public function cargarCamaraComercio()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$resolucion = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row();
		return $resolucion;
	}

	public function cargarDatosOrganizacion()
	{
		$usuario_id = $this->session->userdata('usuario_id');

		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		return $datos_organizacion;
	}

	public function cargarTodasOrganizaciones()
	{
		$organizaciones = $this->db->select("*")->from("organizaciones")->get()->result();
		return $organizaciones;
	}

	public function cargarVisitas()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$visitas = $this->db->select("*")->from("visitas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $visitas;
	}

	public function cargarSeguimientos()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$seguimientos = $this->db->select("*")->from("seguimientoSimple")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $seguimientos;
	}

	public function cargarPlanesMejoramiento()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$planMejoramiento = $this->db->select("*")->from("planMejoramiento")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $planMejoramiento;
	}

	public function cargarDatos_formulario_informacion_general_entidad()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_documentacion_legal()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("documentacionLegal")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_registro_educativo()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("registroEducativoProgramas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_antecedentes_academicos()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("antecedentesAcademicos")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_jornadas_actualizacion()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("jornadasActualizacion")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_aval_economia()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("programasAvalEconomia")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_basicos_programas()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("datosBasicosProgramas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_programas_avalar()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("programasAvalar")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $datos_formulario;
	}

	public function cargarDatos_formulario_datos_plataforma()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("datosAplicacion")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $datos_formulario;
	}

	public function cargarDepartamentos()
	{
		$departamentos = $this->db->select("*")->from("departamentos")->get()->result();
		return $departamentos;
	}

	public function cargarMunicipios()
	{
		$departamento = $this->input->post('departamento');

		$data_departamento = $this->db->select("id_departamento")->from("departamentos")->where('nombre', $departamento)->get()->row();
		$id_departamento = $data_departamento->id_departamento;
		$municipios = $this->db->select("*")->from("municipios")->where('departamentos_id_departamento', $id_departamento)->get()->result();
		echo json_encode($municipios);
	}

	public function eliminarRegistroPrograma()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_programa = $this->input->post('id_programa');

		$this->db->where('id_registroEducativoPro', $id_programa)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('registroEducativoProgramas')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el programa."));
		}
	}

	public function eliminarDocumentacionLegal()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$documentacion = $this->input->post('documentacion');

		$this->db->where('id_documentacionLegal', $documentacion)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('documentacionLegal')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino la documentacion legal."));
		}
	}

	public function eliminarAntecedentes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_antecedentes = $this->input->post('id_antecedentes');

		$this->db->where('id_antecedentesAcademicos', $id_antecedentes)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('antecedentesAcademicos')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el antecedente."));
		}
	}

	public function eliminarJornadaActualizacion()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_jornada = $this->input->post('id_jornada');

		$this->db->where('id_jornadasActualizacion', $id_jornada)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('jornadasActualizacion')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino la jornada de actualización."));
		}
	}

	public function eliminarProgramasBasicos()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_programa = $this->input->post('id_programa');

		$this->db->where('id_datosBasicosProgramas', $id_programa)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('datosBasicosProgramas')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el programa básico."));
		}
	}

	public function eliminarProgramasAvalEconomia()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_programa = $this->input->post('id_programa');

		$this->db->where('id_programasAvalEconomia', $id_programa)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('programasAvalEconomia')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el programa aval de economía."));
		}
	}

	public function eliminarProgramasAvalar()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_programa = $this->input->post('id_programa');

		$this->db->where('id_programasAvalar', $id_programa)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('programasAvalar')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el programa a avalar."));
		}
	}

	public function eliminarDatosPlataforma()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_plataforma = $this->input->post('id_plataforma');

		$this->db->where('id_datosAplicacion', $id_plataforma)->where('organizaciones_id_organizacion', $id_organizacion);
		if ($this->db->delete('datosAplicacion')) {
			echo json_encode(array('url' => "", 'msg' => "Se eliminaron los datos de la plataforma."));
		}
	}

	public function cargarObservaciones()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$numero_rev = $this->db->select("numeroRevisiones")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row()->numeroRevisiones;

		$id_solicitud = $this->db->select("idSolicitud")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row()->idSolicitud;

		$observaciones = $this->db->select("*")->from("observaciones")->where("numeroRevision", $numero_rev)->where("idSolicitud", $id_solicitud)->where("organizaciones_id_organizacion", $id_organizacion)->order_by("valueForm", "asc")->get()->result();
		return $observaciones;
	}

	public function cargarObservacionesPlataforma()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$archivos = $this->db->select("*")->from("archivos")->where("organizaciones_id_organizacion", $id_organizacion)->where("tipo", "observacionesPlataformaVirtual")->where("id_formulario", 10)->get()->result();
		return $archivos;
	}

	public function idSolicitud()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$idSolicitud = $this->db->select("idSolicitud")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$id_Solicitud = $idSolicitud->idSolicitud;
		return $id_Solicitud;
	}

	public function cargarDocentesInforme()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->where("valido", 1)->get()->result();
		return $docentes;
	}

	public function cargarInformacionDocente()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_docente = $this->input->post('id_docente');
		$informacionDocente = $this->db->select("*")->from("docentes")->where("id_docente", $id_docente)->get()->row();
		echo json_encode($informacionDocente);
	}

	public function cargarDatosArchivos()
	{
		$id_form = $this->input->post('id_form');

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$where = array('organizaciones_id_organizacion =' => $id_organizacion, 'id_formulario =' => $id_form);
		$data_archivos = $this->db->select("*")->from("archivos")->where($where)->where("tipo !=", "observacionesPlataformaVirtual", FLASE)->get()->result();
		echo json_encode($data_archivos);
	}

	public function cargarDatosArchivosDocente()
	{
		$id_docente = $this->input->post('id_docente');

		$data_archivos = $this->db->select("*")->from("archivosDocente")->where('docentes_id_docente', $id_docente)->get()->result();
		echo json_encode($data_archivos);
	}

	public function cargarDatosArchivosDocentes($id)
	{
		$data_archivos = $this->db->select("*")->from("archivosDocente")->where('docentes_id_docente', $id)->get()->result();
		return $data_archivos;
	}

	public function cargar_docentes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $docentes;
	}

	public function cargarEstadoSolicitudAdmin()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$formularios = $this->verificarFormularios();
		$numeroSolicitudes = $this->numeroSolicitudes();
		$estadoOrganizaciones = $this->estadoOrganizaciones();
		$estadoAnterior = $this->estadoAnteriorOrganizaciones();
		$tipoSolicitud = $this->cargarTipoSolicitud();
		$motivoSolicitud = $this->cargarMotivoSolicitud();
		$modalidadSolicitud = $this->cargarModalidadSolicitud();
		$numeroRevisiones = $this->numeroRevisiones();
		$fechaUltimaRevision = $this->fechaUltimaRevision();

		return array("numero" => $numeroSolicitudes, "estado" => $estadoOrganizaciones, "tipoSolicitud" => $tipoSolicitud, "modalidadSolicitud" => $modalidadSolicitud, "motivoSolicitud" => $motivoSolicitud, "numeroRevisiones" => $numeroRevisiones, "fechaUltimaRevision" => $fechaUltimaRevision, 'estadoAnterior' => $estadoAnterior);
	}

	public function cargarEstadoSolicitud()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$formularios = $this->verificarFormularios();
		$numeroSolicitudes = $this->numeroSolicitudes();
		$estadoOrganizaciones = $this->estadoOrganizaciones();
		$estadoAnterior = $this->estadoAnteriorOrganizaciones();
		$tipoSolicitud = $this->cargarTipoSolicitud();
		$motivoSolicitud = $this->cargarMotivoSolicitud();
		$modalidadSolicitud = $this->cargarModalidadSolicitud();

		switch ($estadoOrganizaciones) {
			case "En Proceso":
				if ($tipoSolicitud != NULL || $tipoSolicitud != "Eliminar" && $estadoOrganizaciones == "En Proceso") {
					echo json_encode(array('url' => "panel", 'msg' => "Continue diligenciando los formularios, Solicitud número: " . $numeroSolicitudes, 'tipo' => $tipoSolicitud, "numero" => $numeroSolicitudes, 'motivo' => $motivoSolicitud, 'modalidad' => $modalidadSolicitud, 'formularios' => $formularios, 'estado' => $estadoOrganizaciones, 'estadoAnterior' => $estadoAnterior));
				}
				break;
			case "En Proceso de Renovación":
				if ($estadoOrganizaciones == "En Proceso de Renovación") {
					echo json_encode(array('url' => "panel", 'msg' => "Continue diligenciando los formularios, solicitud número: " . $numeroSolicitudes, 'tipo' => $tipoSolicitud, "numero" => $numeroSolicitudes, 'motivo' => $motivoSolicitud, 'modalidad' => $modalidadSolicitud, 'formularios' => $formularios, 'estado' => $estadoOrganizaciones, 'estadoAnterior' => $estadoAnterior));
				}
				break;
			case "En Proceso de Actualización":
				if ($numeroSolicitudes != "0" || $numeroSolicitudes != 0 && $estadoOrganizaciones == "En Proceso de Actualización") {
					echo json_encode(array('url' => "panel", 'msg' => "Continue diligenciando los formularios, solicitud número: " . $numeroSolicitudes, 'tipo' => $tipoSolicitud, "numero" => $numeroSolicitudes, 'motivo' => $motivoSolicitud, 'modalidad' => $modalidadSolicitud, 'formularios' => $formularios, 'estado' => $estadoOrganizaciones, 'estadoAnterior' => $estadoAnterior));
				}
				break;
			case "En Observaciones":
				echo json_encode(array('url' => "panel", 'msg' => "Verifique el estado de la acreditación y las observaciones en el panel.", 'tipo' => $tipoSolicitud, "numero" => $numeroSolicitudes, 'motivo' => $motivoSolicitud, 'modalidad' => $modalidadSolicitud, 'formularios' => $formularios, 'estado' => $estadoOrganizaciones, 'estadoAnterior' => $estadoAnterior));
				break;
			default:
				echo json_encode(array('url' => "panel", 'msg' => "Verifique el estado de la acreditacion en el panel.", 'estado' => $numeroSolicitudes, 'tipo' => $tipoSolicitud, 'motivo' => $motivoSolicitud, 'formularios' => $formularios, 'estado' => $estadoOrganizaciones, 'estadoAnterior' => $estadoAnterior));
				break;
		}
		// Para contar el array de formularios si se necesita (count($formularios) == 0)
	}

	public function numeroSolicitudes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$solicitudes = $this->db->select("numeroSolicitudes")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$numeroSolicitudes = $solicitudes->numeroSolicitudes;
		return $numeroSolicitudes;
	}

	public function numeroRevisiones()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$revisiones = $this->db->select("numeroRevisiones")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$numeroRevisiones = $revisiones->numeroRevisiones;
		return $numeroRevisiones;
	}

	public function fechaUltimaRevision()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$fecha = $this->db->select("fechaUltimaRevision")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$fechaUltimaRevision = $fecha->fechaUltimaRevision;
		return $fechaUltimaRevision;
	}

	public function cargarTipoSolicitud()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$tipoSolicitud = $this->db->select("tipoSolicitud")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$tipoSolicitudBD = $tipoSolicitud->tipoSolicitud;
		return $tipoSolicitudBD;
	}

	public function cargarMotivoSolicitud()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$motivoSolicitud = $this->db->select("motivoSolicitud")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$motivoSolicitudBD = $motivoSolicitud->motivoSolicitud;
		return $motivoSolicitudBD;
	}

	public function cargarModalidadSolicitud()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$modalidadSolicitud = $this->db->select("modalidadSolicitud")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$modalidadSolicitudBD = $modalidadSolicitud->modalidadSolicitud;
		return $modalidadSolicitudBD;
	}

	public function cargarTiposCursoInforme()
	{
		$tiposCursoInformes = $this->db->select("*")->from("tiposCursoInformes")->get()->result();
		return $tiposCursoInformes;
	}

	public function estadoAnteriorOrganizaciones()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$estado = $this->db->select("estadoAnterior")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$nombreEstado = $estado->estadoAnterior;
		return $nombreEstado;
	}

	public function estadoOrganizaciones()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$estado = $this->db->select("nombre")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$nombreEstado = $estado->nombre;
		return $nombreEstado;
		/*
			Por si se necesita hacer alguna accion dependiendo del estado de la organizacion.
		switch ($nombreEstado) {
			case "En Proceso de Acreditacion":
				return $nombreEstado;
				break;
			case "En Proceso de Llenado de Formularios":
				return $nombreEstado;
				break;
			case "Acreditado":
				return $nombreEstado;
				break;
			case "Negada":
				return $nombreEstado;
				break;
			case "Ninguno":
				return $nombreEstado;
				break;
			default:
				return 0;
				break;
		}*/
	}

	public function verificarFormularios()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$certificacionesForm = NULL;
		$lugar = NULL;
		$carta = NULL;
		$jornada = NULL;
		$materialProgBasicos = NULL;
		$materialAvalEcon = NULL;
		$formatosEval = NULL;
		$materialProgEval = NULL;
		$instructivo = NULL;
		$icert = 0;
		$datosBasicosProg = TRUE;
		$datosAvalEcon = TRUE;

		$tipoSolicitud = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$motivoSolicitud = $tipoSolicitud->motivoSolicitud;
		$modalidadSolicitud = $tipoSolicitud->modalidadSolicitud;

		$archivosBD = $this->db->select("*")->from("archivos")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();

		foreach ($archivosBD as $archivo) {
			$tipo = $archivo->tipo;
			$formulario = $archivo->id_formulario;

			switch ($formulario) {
				case 1:
					switch ($tipo) {
						case 'certificaciones':
							$icert += 1;
							if ($icert >= 3) {
								$certificacionesForm = TRUE;
							}
							break;
						case 'lugar':
							$lugar = TRUE;
							break;
						case 'carta':
							$carta = TRUE;
							break;
						default:
							$certificacionesForm = FALSE;
							$lugar = FALSE;
							$carta = FALSE;
							break;
					}
					break;
				case 5:
					if ($tipo == "jornadaAct") {
						$jornada = TRUE;
					}
					break;
				case 6:
					if ($tipo == "materialDidacticoProgBasicos") {
						$materialProgBasicos = TRUE;
					}
					break;
				case 7:
					if ($tipo == "materialDidacticoAvalEconomia") {
						$materialAvalEcon = TRUE;
					}
					break;
				case 8:
					if ($tipo == "formatosEvalProgAvalar") {
						$formatosEval = TRUE;
					}

					if ($tipo == "materialDidacticoProgAvalar") {
						$materialProgEval = TRUE;
					}
					break;
				case 10:
					if ($tipo == "instructivoPlataforma" || $tipo == "observacionesPlataformaVirtual") {
						$instructivo = TRUE;
					}
					break;
				default:
					break;
			}
		}

		$informacionGeneral = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$documentacionLegal = $this->db->select("*")->from("documentacionLegal")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$registroE = $documentacionLegal->registroEducativo;
		$registroEducativoProgramas = $this->db->select("*")->from("registroEducativoProgramas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$antecedentesAcademicos = $this->db->select("*")->from("antecedentesAcademicos")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$jornadasActualizacion = $this->db->select("*")->from("jornadasActualizacion")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

		$datosBasicosProgramas = $this->db->select("*")->from("datosBasicosProgramas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$formularioProg = array('objetivos', 'metodologia', 'materialDidactico', 'bibliografia', 'duracionCurso', 'eticaValoresPrincipios', 'solidaridad', 'economia', 'economiaSolidaria', 'asosiatividadEmprendimiento', 'organizacionSolidaria', 'trabajoEquipo', 'educacionSolidaria', 'responsabilidadSocial', 'medioAmbiente', 'contextoEconomicoSocial', 'necesidadesSerHumano', 'porqueFomentar', 'principiosValoresFines', 'marcoNormativo', 'tiposOrganizacionesEconomiaSolidaria', 'antecedentesHistoricos', 'caracteristicasEconomicas', 'estructuraInterna', 'marcoJuridicoAplicable', 'fundamentosAdministrativos', 'orientacionElaboracionEstatutos', 'unidadAdministrativa', 'superintendencia', 'fondoGarantias', 'consejoNacional', 'fondoNacional', 'mesasRegionales');
		foreach ($formularioProg as $prog) {
			$prog = $datosBasicosProgramas->$prog;
			if ($prog == NULL) {
				$datosBasicosProg = NULL;
			}
		}

		$programasAvalEconomia = $this->db->select("*")->from("programasAvalEconomia")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$formularioAval = array('objetivos', 'metodologia', 'materialDidactico', 'bibliografia', 'duracionCurso', 'antecedentesAspectos', 'diferencias', 'regulacionJuridica', 'desarrolloSocioempresarial', 'legislacionTributaria', 'administracionTrabajo', 'regimenesTrabajo', 'manejoSeguridad', 'inspeccionVigilancia');
		foreach ($formularioAval as $aval) {
			$aval = $programasAvalEconomia->$aval;
			if ($aval == NULL) {
				$datosAvalEcon = NULL;
			}
		}
		$programasAvalar = $this->db->select("*")->from("programasAvalar")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		$numeroDocentes = $this->db->select("count(docentes.id_docente) as numeroDocentes")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row()->numeroDocentes;
		$aplicacion = $this->db->select("*")->from("datosAplicacion")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

		$strDocentes = "";

		foreach ($docentes as $docente) {
			$hoja = false;
			$titulo = false;
			$certificacionesEco = false;
			$certificaciones = false;
			$hojas = 0;
			$titulos = 0;
			$certEcos = 0;
			$certs = 0;

			$id_docente = $docente->id_docente;
			$nombre = $this->db->select("primerNombreDocente")->from("docentes")->where("id_docente", $id_docente)->get()->row()->primerNombreDocente;
			$archivos = $this->cargarDatosArchivosDocentes($id_docente);

			for ($i = 0; $i < count($archivos); $i++) {
				$tipo = json_encode($archivos[$i]->tipo);

				if ($tipo == '"docenteHojaVida"') {
					$hojas += 1;
					if ($hojas >= 1) {
						$hoja = true;
					}
				}
				if ($tipo == '"docenteTitulo"') {
					$titulos += 1;
					if ($titulos >= 1) {
						$titulo = true;
					}
				}
				if ($tipo == '"docenteCertificadosEconomia"') {
					$certEcos += 1;
					if ($certEcos >= 1) {
						$certificacionesEco = true;
					}
				}
				if ($tipo == '"docenteCertificados"') {
					$certs += 1;
					if ($certs >= 3) {
						$certificaciones = true;
					}
				}
			}

			if ($hoja == true && $titulo == true && $certificacionesEco == true && $certificaciones && true) {
				$strDocentes .= "El facilitador <span class='upper'>" . $nombre . "</span> esta correcto en los documentos mínimos requeridos. <i class='fa fa-check spanVerde' aria-hidden='true'></i><br/>";
			} else {
				$strDocentes .= "Verificar los documentos del facilitador <span class='upper'>" . $nombre . "</span>. <i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
			}
		}

		$formularios = array();

		if ($motivoSolicitud == "Acreditación Curso Basico de Economia Solidaria") {
			if ($informacionGeneral == NULL || $certificacionesForm == NULL || $lugar == NULL || $carta == NULL) {
				array_push($formularios, "1. Falta el formulario de Informacion General.");
			}
			if ($documentacionLegal == NULL) {
				array_push($formularios, "2. Falta el formulario de Documentacion Legal.");
			}
			if ($registroEducativoProgramas == NULL && $documentacionLegal != NULL && $registroE != "No Tiene") {
				array_push($formularios, "3. Falta el formulario de Registro Educativo Programas.");
			}
			if ($antecedentesAcademicos == NULL) {
				array_push($formularios, "4. Falta el formulario de Antecedentes Academicos.");
			}
			if ($jornadasActualizacion == NULL || $jornada == NULL) {
				array_push($formularios, "5. Falta el formulario de Jornadas Actualización.");
			}
			if ($datosBasicosProgramas == NULL || $datosBasicosProg == NULL || $materialProgBasicos == NULL) {
				array_push($formularios, "6. Falta el formulario de Datos Basicos Programas.");
			}
			if ($docentes == NULL || $numeroDocentes < 3) {
				array_push($formularios, "9. Faltan facilitadores y/o archivos, deben ser tres (3) con sus respectivos documentos.");
			}
			if (($modalidadSolicitud == "Virtual" || $modalidadSolicitud == "Virtual y Presencial") && $aplicacion == NULL) {
				array_push($formularios, "10. Falta el formulario de Ingreso a la Plataforma Virtual.");
			}
		} else if ($motivoSolicitud == "Acreditación, Aval de Trabajo Asociado") {
			if ($informacionGeneral == NULL || $certificacionesForm == NULL || $lugar == NULL || $carta == NULL) {
				array_push($formularios, "1. Falta el formulario de Informacion General.");
			}
			if ($documentacionLegal == NULL) {
				array_push($formularios, "2. Falta el formulario de Documentacion Legal.");
			}
			if ($registroEducativoProgramas == NULL && $documentacionLegal != NULL && $registroE != "No Tiene") {
				array_push($formularios, "3. Falta el formulario de Registro Educativo Programas.");
			}
			if ($antecedentesAcademicos == NULL) {
				array_push($formularios, "4. Falta el formulario de Antecedentes Academicos.");
			}
			if ($jornadasActualizacion == NULL || $jornada == NULL) {
				array_push($formularios, "5. Falta el formulario de Jornadas Actualización.");
			}
			if ($datosBasicosProgramas == NULL || $datosBasicosProg == NULL || $materialProgBasicos == NULL) {
				array_push($formularios, "6. Falta el formulario de Datos Basicos Programas.");
			}
			if ($programasAvalEconomia == NULL || $datosAvalEcon == NULL || $materialAvalEcon == NULL) {
				array_push($formularios, "7. Falta el formulario de Programas Aval Economia.");
			}
			if ($docentes == NULL || $numeroDocentes < 3) {
				array_push($formularios, "9. Faltan facilitadores y/o archivos, deben ser tres (3) con sus respectivos documentos.");
			}
			if (($modalidadSolicitud == "Virtual" || $modalidadSolicitud == "Virtual y Presencial") && $aplicacion == NULL) {
				array_push($formularios, "10. Falta el formulario de Ingreso a la Plataforma Virtual.");
			}
		} else if ($motivoSolicitud == "Acreditación, Aval a otros Programas") {
			if ($informacionGeneral == NULL || $certificacionesForm == NULL || $lugar == NULL || $carta == NULL) {
				array_push($formularios, "1. Falta el formulario de Informacion General.");
			}
			if ($documentacionLegal == NULL) {
				array_push($formularios, "2. Falta el formulario de Documentacion Legal.");
			}
			if ($registroEducativoProgramas == NULL && $documentacionLegal != NULL && $registroE != "No Tiene") {
				array_push($formularios, "3. Falta el formulario de Registro Educativo Programas.");
			}
			if ($antecedentesAcademicos == NULL) {
				array_push($formularios, "4. Falta el formulario de Antecedentes Academicos.");
			}
			if ($jornadasActualizacion == NULL || $jornada == NULL) {
				array_push($formularios, "5. Falta el formulario de Jornadas Actualización.");
			}
			if ($datosBasicosProgramas == NULL || $datosBasicosProg == NULL || $materialProgBasicos == NULL) {
				array_push($formularios, "6. Falta el formulario de Datos Basicos Programas.");
			}
			if ($programasAvalar == NULL || $formatosEval == NULL || $materialProgEval == NULL) {
				array_push($formularios, "8. Falta el formulario de Programas Avalar.");
			}
			if ($docentes == NULL || $numeroDocentes < 3) {
				array_push($formularios, "9. Faltan facilitadores y/o archivos, deben ser tres (3) con sus respectivos documentos.");
			}
			if (($modalidadSolicitud == "Virtual" || $modalidadSolicitud == "Virtual y Presencial") && $aplicacion == NULL) {
				array_push($formularios, "10. Falta el formulario de Ingreso a la Plataforma Virtual.");
			}
		} else if ($motivoSolicitud == "Acreditación, Aval de Trabajo Asociado, Aval a otros Programas") {
			if ($informacionGeneral == NULL || $certificacionesForm == NULL || $lugar == NULL || $carta == NULL) {
				array_push($formularios, "1. Falta el formulario de Informacion General.");
			}
			if ($documentacionLegal == NULL) {
				array_push($formularios, "2. Falta el formulario de Documentacion Legal.");
			}
			if ($registroEducativoProgramas == NULL && $documentacionLegal != NULL && $registroE != "No Tiene") {
				array_push($formularios, "3. Falta el formulario de Registro Educativo Programas.");
			}
			if ($antecedentesAcademicos == NULL) {
				array_push($formularios, "4. Falta el formulario de Antecedentes Academicos.");
			}
			if ($jornadasActualizacion == NULL || $jornada == NULL) {
				array_push($formularios, "5. Falta el formulario de Jornadas Actualización.");
			}
			if ($datosBasicosProgramas == NULL || $datosBasicosProg == NULL || $materialProgBasicos == NULL) {
				array_push($formularios, "6. Falta el formulario de Datos Basicos Programas.");
			}
			if ($programasAvalEconomia == NULL || $datosAvalEcon == NULL || $materialAvalEcon == NULL) {
				array_push($formularios, "7. Falta el formulario de Programas Aval Economia.");
			}
			if ($programasAvalar == NULL || $formatosEval == NULL || $materialProgEval == NULL) {
				array_push($formularios, "8. Falta el formulario de Programas Avalar.");
			}
			if ($docentes == NULL || $numeroDocentes < 3) {
				array_push($formularios, "9. Faltan facilitadores y/o archivos, deben ser tres (3) con sus respectivos documentos.");
			}
			if (($modalidadSolicitud == "Virtual" || $modalidadSolicitud == "Virtual y Presencial") && $aplicacion == NULL) {
				array_push($formularios, "10. Falta el formulario de Ingreso a la Plataforma Virtual.");
			}
		} else if ($motivoSolicitud == "Actualizar Datos") {
			if ($informacionGeneral == NULL) {
				array_push($formularios, "Llene los formularios que requieran actualizacion." && $aplicacion == NULL);
			}
			if ($modalidadSolicitud == "Virtual" || $modalidadSolicitud == "Virtual y Presencial" || $modalidadSolicitud == "Presencial") {
				array_push($formularios, "10. Falta el formulario de Ingreso a la Plataforma Virtual." && $aplicacion == NULL || $instructivo == NULL);
			}
		}
		array_push($formularios, "0. Tenga en cuenta la siguiente lista de sus facilitadores y hacer lo correspondiente:<br/><strong><small><i>" . $strDocentes . "</i></small></strong>");
		return $formularios;
	}
	/**
		Guardar datos
	 **/
	// Tipo solicitud
	public function guardar_tipoSolicitud()
	{
		/*$this->form_validation->set_rules('tipo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('motivo_solicitud','','trim|required|min_length[3]|xss_clean');*/
		$tipo_solicitud = $this->input->post('tipo_solicitud');
		$motivo_solicitud = $this->input->post('motivo_solicitud');
		$modalidad_solicitud = $this->input->post('modalidad_solicitud');

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$nombre_org = $this->db->select("nombreOrganizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row()->nombreOrganizacion;

			$numeroSolicitud = date('YmdHis') . $nombre_org[3] . random(2);

			$data_tipoSolicitud = array(
				'tipoSolicitud' => $tipo_solicitud,
				'motivoSolicitud' => $motivo_solicitud,
				'modalidadSolicitud' => $modalidad_solicitud,
				'idSolicitud' => $numeroSolicitud,
				'organizaciones_id_organizacion' => $id_organizacion
			);
			$estado = $this->estadoOrganizaciones();

			$numeroSolicitudes = $this->numeroSolicitudes();

			$data_update_solicitud = array(
				'numeroSolicitudes' => $numeroSolicitudes += 1,
				'fecha' =>  date('Y/m/d H:i:s'),
				'organizaciones_id_organizacion' => $id_organizacion
			);

			$this->db->where('organizaciones_id_organizacion', $id_organizacion);
			$this->db->update('solicitudes', $data_update_solicitud);

			if ($tipo_solicitud == "Acreditación Primera vez" && $motivo_solicitud != "Actualizar Datos") {
				$nombre = "En Proceso";
			} else if ($tipo_solicitud == "Renovacion de Acreditación") {
				$nombre = "En Proceso de Renovación";
			} else if ($tipo_solicitud == "Actualización de datos") {
				$nombre = "En Proceso de Actualización";
			} else if ($motivo_solicitud == "Actualizar Datos") {
				$nombre = "En Proceso de Actualización";
			}

			$data_estado = array(
				'nombre' => $nombre,
				'fecha' => date('Y/m/d H:i:s'),
				'estadoAnterior' => $estado,
				'organizaciones_id_organizacion' => $id_organizacion
			);
			$this->db->where('organizaciones_id_organizacion', $id_organizacion);
			$this->db->update('estadoOrganizaciones', $data_estado);

			$datos_tipos = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			if ($datos_tipos == NULL) {
				$this->db->insert('tipoSolicitud', $data_tipoSolicitud);
				echo json_encode(array('url' => "panel", 'msg' => "Se guardo el tipo de soliditud.", "est" => $nombre));
				$this->envio_mailcontacto("inicia", 2);
				$this->logs_sia->session_log('Formulario Motivo Solicitud tipoSolicitud motivoSolicitud modalidadSolicitud: ' . $tipo_solicitud . ' con el ID: ' . $numeroSolicitud);
				$this->logs_sia->logQueries();
			} else {
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('tipoSolicitud', $data_tipoSolicitud);
				echo json_encode(array('url' => "panel", 'msg' => "Se guardo el tipo de soliditud.", "est" => $nombre));
				$this->envio_mailcontacto("inicia", 2);
				$this->logs_sia->session_log('Formulario Motivo Solicitud - Tipo Solicitud: ' . $tipo_solicitud . '. Motivo Solicitud: ' . $motivo_solicitud . '. Modalidad Solicitud: ' . $modalidad_solicitud . '. ID: ' . $numeroSolicitud . '. Fecha: ' . date('Y/m/d') . '.');
				$this->logs_sia->logQueries();
			}
		}
	}

	public function verificar_tipoSolicitud()
	{
		/*$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$tipoSolicitudBD = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$tipoSolicitud = $tipoSolicitudBD ->tipoSolicitud;

		$motivoSolicitudBD = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$motivoSolicitud = $motivoSolicitudBD ->motivoSolicitud;

		$estadoBD = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$estadoAnterior = $estadoBD ->estadoAnterior;
		$estado = $estadoBD ->nombre;*/

		$tipoSolicitud = $this->cargarTipoSolicitud();
		$estado = $this->estadoOrganizaciones();
		$estadoAnterior = $this->estadoAnteriorOrganizaciones();

		if ($estado == "En Proceso" && ($estadoAnterior == "Inscrito" || $estadoAnterior == "Revocada" || $estadoAnterior == "Finalizado")) {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "1", 'estado' => "1"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Inscrito" && $tipoSolicitud == NULL) {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "2", 'estado' => "2"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Inscrito" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "3", 'estado' => "2"));
		}
		if ($estado == "En Proceso de Renovación" && $estadoAnterior == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "4", 'estado' => "1"));
		}
		if ($estado == "En Proceso de Renovación" && $estadoAnterior == "Acreditado" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "5", 'estado' => "0"));
		}
		if ($estado == "En Proceso de Actualización" && $estadoAnterior == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "6", 'estado' => "1"));
		}
		if ($estado == "En Proceso de Actualización" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "6.1", 'estado' => "1"));
		}
		/*if($estado == "Finalizado" && $estadoAnterior == "Finalizado"){
			echo json_encode(array('est' => $estado, 'url'=>"panel", 'msg'=>"6.2", 'estado' => "0"));
		}*/
		if ($estado == "En Proceso de Actualización" && $estadoAnterior == "Acreditado" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "7", 'estado' => "0"));
		}
		if ($estado == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "8", 'estado' => "0"));
		}
		if ($estado == "En Observaciones" && $estadoAnterior == "En Proceso") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "9", 'estado' => "1"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Acreditado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "10", 'estado' => "1"));
		}
		if ($estado == "En Observaciones" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "11", 'estado' => "1"));
		}
		if ($estado == "Negada" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "12", 'estado' => "2"));
		}
		if ($estado == "Revocada" && $estadoAnterior == "Finalizado") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "13", 'estado' => "2"));
		}
		if ($estado == "Negada" && $estadoAnterior == "Negada") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "14", 'estado' => "2"));
		}
		if ($estado == "Revocada" && $estadoAnterior == "Revocada") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "15", 'estado' => "2"));
		}
		if ($estado == "En Proceso" && $estadoAnterior == "Negada") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "16", 'estado' => "1"));
		}
		if ($estado == "Finalizado" && $estadoAnterior == "Finalizado" && $tipoSolicitud == "Eliminar") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "17", 'estado' => "0"));
		}
		if ($estado == "En Proceso de Renovación" && $estadoAnterior == "Finalizado" && $tipoSolicitud == "Renovacion de Acreditación") {
			echo json_encode(array('est' => $estado, 'url' => "panel", 'msg' => "18", 'estado' => "1"));
		}
	}
	// Formulario 1
	public function guardar_formulario_informacion_general_entidad()
	{
		$this->form_validation->set_rules('tipo_organizacion', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('departamento', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('municipio', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('direccion', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('fax', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('extension', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('urlOrganizacion', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('actuacion', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('educacion', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('numCedulaCiudadaniaPersona', '', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('presentacion', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('objetoSocialEstatutos', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('mision', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('vision', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('principios', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('fines', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('portafolio', '', 'trim|min_length[1]|xss_clean');
		$this->form_validation->set_rules('otros', '', 'trim|min_length[1]|xss_clean');

		if ($this->form_validation->run("formulario_informacion_general_entidad") == FALSE) {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		} else {
			$tipo_organizacion = $this->input->post('tipo_organizacion');
			$departamento = $this->input->post('departamento');
			$municipio = $this->input->post('municipio');
			$direccion = $this->input->post('direccion');
			$fax = $this->input->post('fax');
			$extension = $this->input->post('extension');
			$urlOrganizacion = $this->input->post('urlOrganizacion');
			$actuacion = $this->input->post('actuacion');
			$educacion = $this->input->post('educacion');
			$numCedulaCiudadaniaPersona = $this->input->post('numCedulaCiudadaniaPersona');
			$presentacion = $this->input->post('presentacion');
			$objetoSocialEstatutos = $this->input->post('objetoSocialEstatutos');
			$mision = $this->input->post('mision');
			$vision = $this->input->post('vision');
			$principios = $this->input->post('principios');
			$fines = $this->input->post('fines');
			$portafolio = $this->input->post('portafolio');
			$otros = $this->input->post('otros');

			if ($this->input->post()) {
				$usuario_id = $this->session->userdata('usuario_id');
				$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
				$id_organizacion = $datos_organizacion->id_organizacion;
				$datos_informacion_general = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

				$data_informacion_general = array(
					'tipoOrganizacion' => $tipo_organizacion,
					'direccionOrganizacion' => $direccion,
					'nomDepartamentoUbicacion' => $departamento,
					'nomMunicipioNacional' => $municipio,
					'fax' => $fax,
					'extension' => $extension,
					'urlOrganizacion' => $urlOrganizacion,
					'actuacionOrganizacion' => $actuacion,
					'tipoEducacion' => $educacion,
					'numCedulaCiudadaniaPersona' => $numCedulaCiudadaniaPersona,
					'presentacionInstitucional' => $presentacion,
					'objetoSocialEstatutos' => $objetoSocialEstatutos,
					'mision' => $mision,
					'vision' => $vision,
					'principios' => $principios,
					'fines' => $fines,
					'portafolio' => $portafolio,
					'otros' => $otros,
					'fecha' => date('Y/m/d H:i:s'),
					'organizaciones_id_organizacion' => $id_organizacion
				);

				if ($datos_informacion_general != NULL) {
					$this->db->where('organizaciones_id_organizacion', $id_organizacion);
					$this->db->update('informacionGeneral', $data_informacion_general);
					echo json_encode(array('url' => "panel", 'msg' => "Se actualizó la Información General."));
					$this->logs_sia->session_log('Formulario Actualización Informacion General');
					$this->logs_sia->logQueries();
				} else {
					$this->db->insert('informacionGeneral', $data_informacion_general);
					echo json_encode(array('url' => "panel", 'msg' => "Se guardo la Información General."));
					$this->logs_sia->session_log('Formulario Informacion General');
					$this->logs_sia->logQueries();
				}
			} else {
				echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
			}
		}
	}
	// Formulario 2
	public function guardar_formulario_documentacion_legal()
	{

		/*$this->form_validation->set_rules('tipo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('motivo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('tipo_organizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('departamento','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('municipio','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('direccion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('fax','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('extension','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('urlOrganizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('actuacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('educacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('numCedulaCiudadaniaPersona','','trim|required|min_length[3]|xss_clean');

    	if($this->form_validation->run("formulario_informacion_general_entidad") == FALSE){
    		echo json_encode(array('url'=>"panel", 'msg'=>"Verifique los datos ingresado, no son correctos."));
    	}else{**/

		/**$certificadoExistencia = $this->input->post('certificadoExistencia');
    		$numeroExistencia = $this->input->post('numeroExistencia');
    		$fechaExpedicion = $this->input->post('fechaExpedicion');
    		$departamentoCertificado = $this->input->post('departamentoCertificado');
    		$municipioCertificado = $this->input->post('municipioCertificado');
    		$objetoSocial = $this->input->post('objetoSocial');**/
		$registroEducativo = $this->input->post('registroEducativo');
		$entidadRegistro = $this->input->post('entidadRegistro');
		$numeroResolucion = $this->input->post('numeroResolucion');
		$fechaResolucion = $this->input->post('fechaResolucion');
		$departamentoResolucion = $this->input->post('departamentoResolucion');
		$municipioResolucion = $this->input->post('municipioResolucion');

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_documentacionLegal = $this->db->select("*")->from("documentacionLegal")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_documentacionLegal = array(
				/**'certificadoExistencia' => $certificadoExistencia,
					'numeroExistencia' => $numeroExistencia,
					'fechaExpedicion' => $fechaExpedicion,
					'departamentoCertificado' => $departamentoCertificado,
					'municipioCertificado' => $municipioCertificado,
					'objetoSocial' => $objetoSocial,*/
				'registroEducativo' => $registroEducativo,
				'entidadRegistro' => $entidadRegistro,
				'numeroResolucion' => $numeroResolucion,
				'fechaResolucion' => $fechaResolucion,
				'departamentoResolucion' => $departamentoResolucion,
				'municipioResolucion' => $municipioResolucion,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			/*if($datos_documentacionLegal != NULL){
    				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
					$this->db->update('documentacionLegal', $data_documentacionLegal);
					echo json_encode(array('url'=>"panel", 'msg'=>"Se actualizó la Documentación Legal."));
					$this->logs_sia->session_log('Formulario Actualización Documentacion Legal');
					$this->logs_sia->logQueries();
    			}else{*/
			$this->db->insert('documentacionLegal', $data_documentacionLegal);
			echo json_encode(array('url' => "panel", 'msg' => "Se guardo la Documentación Legal."));
			$this->logs_sia->session_log('Formulario Documentacion Legal');
			$this->logs_sia->logQueries();
			//}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
		//}
	}
	// Formulario 3
	public function guardar_formulario_registro_educativo()
	{

		/*$this->form_validation->set_rules('tipo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('motivo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('tipo_organizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('departamento','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('municipio','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('direccion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('fax','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('extension','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('urlOrganizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('actuacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('educacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('numCedulaCiudadaniaPersona','','trim|required|min_length[3]|xss_clean');

    	if($this->form_validation->run("formulario_informacion_general_entidad") == FALSE){
    		echo json_encode(array('url'=>"panel", 'msg'=>"Verifique los datos ingresado, no son correctos."));
    	}else{**/

		$tipoEducacion = $this->input->post('tipoEducacion');
		$fechaResolucionProgramas = $this->input->post('fechaResolucionProgramas');
		$numeroResolucionProgramas = $this->input->post('numeroResolucionProgramas');
		$nombrePrograma = $this->input->post('nombrePrograma');
		$objetoResolucionProgramas = $this->input->post('objetoResolucionProgramas');
		$entidadResolucion = $this->input->post('entidadResolucion');


		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_registroEducativoProgramas = $this->db->select("*")->from("registroEducativoProgramas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_registroEducativoProgramas = array(
				'tipoEducacion' => $tipoEducacion,
				'fechaResolucion' => $fechaResolucionProgramas,
				'numeroResolucion' => $numeroResolucionProgramas,
				'nombrePrograma' => $nombrePrograma,
				'objetoResolucion' => $objetoResolucionProgramas,
				'entidadResolucion' => $entidadResolucion,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			$this->db->insert('registroEducativoProgramas', $data_registroEducativoProgramas);
			echo json_encode(array('url' => "panel", 'msg' => "Se guardo el registro educativo"));
			$this->logs_sia->session_log('Formulario Registro Educativo Programas');
			$this->logs_sia->logQueries();
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
		//}
	}
	// Formulario 4
	public function guardar_formulario_antecedentes_academicos()
	{

		/*$this->form_validation->set_rules('tipo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('motivo_solicitud','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('tipo_organizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('departamento','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('municipio','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('direccion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('fax','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('extension','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('urlOrganizacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('actuacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('educacion','','trim|required|min_length[3]|xss_clean');
    	$this->form_validation->set_rules('numCedulaCiudadaniaPersona','','trim|required|min_length[3]|xss_clean');

    	if($this->form_validation->run("formulario_informacion_general_entidad") == FALSE){
    		echo json_encode(array('url'=>"panel", 'msg'=>"Verifique los datos ingresado, no son correctos."));
    	}else{**/

		$descripcionProceso = $this->input->post('descripcionProceso');
		$justificacionAcademicos = $this->input->post('justificacionAcademicos');
		$objetivosAcademicos = $this->input->post('objetivosAcademicos');
		$metodologiaAcademicos = $this->input->post('metodologiaAcademicos');
		$materialDidacticoAcademicos = $this->input->post('materialDidacticoAcademicos');
		$bibliografiaAcademicos = $this->input->post('bibliografiaAcademicos');
		$duracionCursoAcademicos = $this->input->post('duracionCursoAcademicos');


		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_antecedentesAcademicos = $this->db->select("*")->from("antecedentesAcademicos")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_antecedentesAcademicos = array(
				'descripcionProceso' => $descripcionProceso,
				'justificacion' => $justificacionAcademicos,
				'objetivos' => $objetivosAcademicos,
				'metodologia' => $metodologiaAcademicos,
				'materialDidactico' => $materialDidacticoAcademicos,
				'bibliografia' => $bibliografiaAcademicos,
				'duracionCurso' => $duracionCursoAcademicos,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			/*if($datos_antecedentesAcademicos != NULL){
    				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
					$this->db->update('antecedentesAcademicos', $data_antecedentesAcademicos);
					echo json_encode(array('url'=>"panel", 'msg'=>"Se actualizaron los Antecedentes Academicos."));
					$this->logs_sia->session_log('Formulario Actualización Antecedentes Academicos');
					$this->logs_sia->logQueries();
    			}else{*/
			$this->db->insert('antecedentesAcademicos', $data_antecedentesAcademicos);
			echo json_encode(array('url' => "panel", 'msg' => "Se guardaron los Antecedentes Academicos."));
			$this->logs_sia->session_log('Formulario Antecedentes Academicos');
			$this->logs_sia->logQueries();
			//}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
		//}
	}
	// Formulario 5
	public function guardar_formulario_jornadas_actualizacion()
	{
		$numeroPersonas = $this->input->post('numeroPersonas');
		$fechaAsistencia = $this->input->post('fechaAsistencia');

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_jornadasActualizacion = $this->db->select("*")->from("jornadasActualizacion")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_jornadasActualizacion = array(
				'numeroPersonas' => $numeroPersonas,
				'fechaAsistencia' => $fechaAsistencia,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			/*if($datos_jornadasActualizacion != NULL){
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('jornadasActualizacion', $data_jornadasActualizacion);
				echo json_encode(array('url'=>"panel", 'msg'=>"Se actualizo la Jornada de Actualización."));
				$this->logs_sia->session_log('Formulario Actualización Jornadas Actualización');
				$this->logs_sia->logQueries();
			}else{*/
			$this->db->insert('jornadasActualizacion', $data_jornadasActualizacion);
			echo json_encode(array('url' => "panel", 'msg' => "Se guardo la Jornada de Actualización."));
			$this->logs_sia->session_log('Formulario Jornadas Actualización');
			$this->logs_sia->logQueries();
			//}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
	}
	// Formulario 6
	public function guardar_formulario_datos_basicos_programas()
	{
		$objetivos = $this->input->post('objetivos');
		$metodologia = $this->input->post('metodologia');
		$material = $this->input->post('material');
		$bibliografia = $this->input->post('bibliografia');
		$duracion = $this->input->post('duracion');
		//Nuevo
		$programa_basico_eticaValoresPrincipios = $this->input->post('programa_basico_eticaValoresPrincipios');
		$programa_basico_solidaridad = $this->input->post('programa_basico_solidaridad');
		$programa_basico_economia = $this->input->post('programa_basico_economia');
		$programa_basico_economiaSolidaria = $this->input->post('programa_basico_economiaSolidaria');
		$programa_basico_asosiatividadEmprendimiento = $this->input->post('programa_basico_asosiatividadEmprendimiento');
		$programa_basico_organizacionSolidaria = $this->input->post('programa_basico_organizacionSolidaria');
		$programa_basico_trabajoEquipo = $this->input->post('programa_basico_trabajoEquipo');
		$programa_basico_educacionSolidaria = $this->input->post('programa_basico_educacionSolidaria');
		$programa_basico_responsabilidadSocial = $this->input->post('programa_basico_responsabilidadSocial');
		$programa_basico_medioAmbiente = $this->input->post('programa_basico_medioAmbiente');
		$programa_basico_contextoEconomicoSocial = $this->input->post('programa_basico_contextoEconomicoSocial');
		$programa_basico_necesidadesSerHumano = $this->input->post('programa_basico_necesidadesSerHumano');
		$programa_basico_porqueFomentar = $this->input->post('programa_basico_porqueFomentar');
		$programa_basico_principiosValoresFines = $this->input->post('programa_basico_principiosValoresFines');
		$programa_basico_marcoNormativo = $this->input->post('programa_basico_marcoNormativo');
		$programa_basico_tiposOrganizacionesEconomiaSolidaria = $this->input->post('programa_basico_tiposOrganizacionesEconomiaSolidaria');
		$programa_basico_antecedentesHistoricos = $this->input->post('programa_basico_antecedentesHistoricos');
		$programa_basico_caracteristicasEconomicas = $this->input->post('programa_basico_caracteristicasEconomicas');
		$programa_basico_estructuraInterna = $this->input->post('programa_basico_estructuraInterna');
		$programa_basico_marcoJuridicoAplicable = $this->input->post('programa_basico_marcoJuridicoAplicable');
		$programa_basico_fundamentosAdministrativos = $this->input->post('programa_basico_fundamentosAdministrativos');
		$programa_basico_orientacionElaboracionEstatutos = $this->input->post('programa_basico_orientacionElaboracionEstatutos');
		$programa_basico_unidadAdministrativa = $this->input->post('programa_basico_unidadAdministrativa');
		$programa_basico_superintendencia = $this->input->post('programa_basico_superintendencia');
		$programa_basico_fondoGarantias = $this->input->post('programa_basico_fondoGarantias');
		$programa_basico_consejoNacional = $this->input->post('programa_basico_consejoNacional');
		$programa_basico_fondoNacional = $this->input->post('programa_basico_fondoNacional');
		$programa_basico_mesasRegionales = $this->input->post('programa_basico_mesasRegionales');

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_datosBasicosProgramas = $this->db->select("*")->from("datosBasicosProgramas")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_datosBasicosProgramas = array(
				'objetivos' => $objetivos,
				'metodologia' => $metodologia,
				'materialDidactico' => $material,
				'bibliografia' => $bibliografia,
				'duracionCurso' => $duracion,
				'eticaValoresPrincipios' => $programa_basico_eticaValoresPrincipios,
				'solidaridad' => $programa_basico_solidaridad,
				'economia' => $programa_basico_economia,
				'economiaSolidaria' => $programa_basico_economiaSolidaria,
				'asosiatividadEmprendimiento' => $programa_basico_asosiatividadEmprendimiento,
				'organizacionSolidaria' => $programa_basico_organizacionSolidaria,
				'trabajoEquipo' => $programa_basico_trabajoEquipo,
				'educacionSolidaria' => $programa_basico_educacionSolidaria,
				'responsabilidadSocial' => $programa_basico_responsabilidadSocial,
				'medioAmbiente' => $programa_basico_medioAmbiente,
				'contextoEconomicoSocial' => $programa_basico_contextoEconomicoSocial,
				'necesidadesSerHumano' => $programa_basico_necesidadesSerHumano,
				'porqueFomentar' => $programa_basico_porqueFomentar,
				'principiosValoresFines' => $programa_basico_principiosValoresFines,
				'marcoNormativo' => $programa_basico_marcoNormativo,
				'tiposOrganizacionesEconomiaSolidaria' => $programa_basico_tiposOrganizacionesEconomiaSolidaria,
				'antecedentesHistoricos' => $programa_basico_antecedentesHistoricos,
				'caracteristicasEconomicas' => $programa_basico_caracteristicasEconomicas,
				'estructuraInterna' => $programa_basico_estructuraInterna,
				'marcoJuridicoAplicable' => $programa_basico_marcoJuridicoAplicable,
				'fundamentosAdministrativos' => $programa_basico_fundamentosAdministrativos,
				'orientacionElaboracionEstatutos' => $programa_basico_orientacionElaboracionEstatutos,
				'unidadAdministrativa' => $programa_basico_unidadAdministrativa,
				'superintendencia' => $programa_basico_superintendencia,
				'fondoGarantias' => $programa_basico_fondoGarantias,
				'consejoNacional' => $programa_basico_consejoNacional,
				'fondoNacional' => $programa_basico_fondoNacional,
				'mesasRegionales' => $programa_basico_mesasRegionales,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			if ($datos_datosBasicosProgramas != NULL) {
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('datosBasicosProgramas', $data_datosBasicosProgramas);
				echo json_encode(array('url' => "panel", 'msg' => "Se actualizo programas básicos."));
				$this->logs_sia->session_log('Formulario Actualización programas básicos');
				$this->logs_sia->logQueries();
			} else {
				$this->db->insert('datosBasicosProgramas', $data_datosBasicosProgramas);
				echo json_encode(array('url' => "panel", 'msg' => "Se guardo Programas Basicos."));
				$this->logs_sia->session_log('Formulario Programas Basicos');
				$this->logs_sia->logQueries();
			}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
	}
	// Formulario 7
	public function guardar_formulario_programas_aval()
	{
		$objetivos = $this->input->post('objetivos');
		$metodologia = $this->input->post('metodologia');
		$material = $this->input->post('material');
		$bibliografia = $this->input->post('bibliografia');
		$duracion = $this->input->post('duracion');
		//Nuevo
		$antecedentesAspectos = $this->input->post("antecedentesAspectos");
		$diferencias = $this->input->post("diferencias");
		$regulacionJuridica = $this->input->post("regulacionJuridica");
		$desarrolloSocioempresarial = $this->input->post("desarrolloSocioempresarial");
		$legislacionTributaria = $this->input->post("legislacionTributaria");
		$administracionTrabajo = $this->input->post("administracionTrabajo");
		$regimenesTrabajo = $this->input->post("regimenesTrabajo");
		$manejoSeguridad = $this->input->post("manejoSeguridad");
		$inspeccionVigilancia = $this->input->post("inspeccionVigilancia");

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_programasAvalEconomia = $this->db->select("*")->from("programasAvalEconomia")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_programasAvalEconomia = array(
				'objetivos' => $objetivos,
				'metodologia' => $metodologia,
				'materialDidactico' => $material,
				'bibliografia' => $bibliografia,
				'duracionCurso' => $duracion,
				'antecedentesAspectos' => $antecedentesAspectos,
				'diferencias' => $diferencias,
				'regulacionJuridica' => $regulacionJuridica,
				'desarrolloSocioempresarial' => $desarrolloSocioempresarial,
				'legislacionTributaria' => $legislacionTributaria,
				'administracionTrabajo' => $administracionTrabajo,
				'regimenesTrabajo' => $regimenesTrabajo,
				'manejoSeguridad' => $manejoSeguridad,
				'inspeccionVigilancia' => $inspeccionVigilancia,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			if ($datos_programasAvalEconomia != NULL) {
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('programasAvalEconomia', $data_programasAvalEconomia);
				echo json_encode(array('url' => "panel", 'msg' => "Se actualizo Programas Aval."));
				$this->logs_sia->session_log('Formulario Actualización Programas Aval');
				$this->logs_sia->logQueries();
			} else {
				$this->db->insert('programasAvalEconomia', $data_programasAvalEconomia);
				echo json_encode(array('url' => "panel", 'msg' => "Se guardo Programas Aval."));
				$this->logs_sia->session_log('Formulario Programas Aval');
				$this->logs_sia->logQueries();
			}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
	}
	// Formulario 8
	public function guardar_formulario_programas_avalar()
	{
		$nombre = $this->input->post("nombre");
		$objetivos = $this->input->post("objetivos");
		$metodologia = $this->input->post("metodologia");
		$contenido = $this->input->post("contenido");
		$material = $this->input->post("material");
		$bibliografia = $this->input->post("bibliografia");
		$intensidad = $this->input->post("intensidad");
		$evaluacion = $this->input->post("evaluacion");

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_programasAvalar = $this->db->select("*")->from("programasAvalar")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_programasAvalar = array(
				'nombrePrograma' => $nombre,
				'objetivos' => $objetivos,
				'metodologia' => $metodologia,
				'contenidosPlanteados' => $contenido,
				'materialDidactico' => $material,
				'bibliografia' => $bibliografia,
				'intensidadHoraria' => $intensidad,
				'evaluacion' => $evaluacion,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			/*if($datos_jornadasActualizacion != NULL){
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('jornadasActualizacion', $data_jornadasActualizacion);
				echo json_encode(array('url'=>"panel", 'msg'=>"Se actualizo la Jornada de Actualización."));
				$this->logs_sia->session_log('Formulario Actualización Jornadas Actualización');
				$this->logs_sia->logQueries();
			}else{*/
			$this->db->insert('programasAvalar', $data_programasAvalar);
			echo json_encode(array('url' => "panel", 'msg' => "Se guardo Programas a Avalar."));
			$this->logs_sia->session_log('Formulario Programas a Avalar');
			$this->logs_sia->logQueries();
			//}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
	}
	// Formulario 9
	public function guardar_formulario_docentes()
	{
		$cedula = $this->input->post("cedula");
		$primer_nombre = $this->input->post("primer_nombre");
		$segundo_nombre = $this->input->post("segundo_nombre");
		$primer_apellido = $this->input->post("primer_apellido");
		$segundo_apellido = $this->input->post("segundo_apellido");
		$profesion = $this->input->post("profesion");
		$horas = $this->input->post("horas");

		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;

			$datos_docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_docentes = array(
				'primerNombreDocente' => $primer_nombre,
				'segundoNombreDocente' => $segundo_nombre,
				'primerApellidoDocente' => $primer_apellido,
				'segundoApellidoDocente' => $segundo_apellido,
				'numCedulaCiudadaniaDocente' => $cedula,
				'profesion' => $profesion,
				'horaCapacitacion' => $horas,
				'valido' => 0,
				'organizaciones_id_organizacion' => $id_organizacion
			);

			/*if($datos_jornadasActualizacion != NULL){
				$this->db->where('organizaciones_id_organizacion', $id_organizacion);
				$this->db->update('jornadasActualizacion', $data_jornadasActualizacion);
				echo json_encode(array('url'=>"panel", 'msg'=>"Se actualizo la Jornada de Actualización."));
				$this->logs_sia->session_log('Formulario Actualización Jornadas Actualización');
				$this->logs_sia->logQueries();
			}else{*/
			$this->db->insert('docentes', $data_docentes);
			echo json_encode(array('url' => "panel", 'msg' => "Se creo el docente, adjunte los archivos."));
			$this->logs_sia->session_log('Formulario Docentes');
			$this->logs_sia->logQueries();
			//}
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los datos ingresado, no son correctos."));
		}
	}
	// Formulario 10
	public function guardar_formulario_aplicacion()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$datos_plataforma_url = $this->input->post("datos_plataforma_url");
		$datos_plataforma_usuario = $this->input->post("datos_plataforma_usuario");
		$datos_plataforma_contrasena = $this->input->post("datos_plataforma_contrasena");

		$data_aplicacion = array(
			'urlAplicacion' => $datos_plataforma_url,
			'usuarioAplicacion' => $datos_plataforma_usuario,
			'contrasenaAplicacion' => $datos_plataforma_contrasena,
			'organizaciones_id_organizacion' => $id_organizacion
		);

		$this->db->insert('datosAplicacion', $data_aplicacion);
		echo json_encode(array('url' => "panel", 'msg' => "Se guardo la información de la plataforma."));
	}

	// Informe de actividades
	public function guardar_cursoInformeActividades()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$nombreOrganizacion = $datos_organizacion->nombreOrganizacion;

		$informe_nombre_curso = $this->input->post("informe_nombre_curso");
		$informe_tipo_curso = $this->input->post("informe_tipo_curso");
		$informe_intencionalidad_curso = $this->input->post("informe_intencionalidad_curso");
		$informe_union = $this->input->post("informe_union");
		$informe_duracion_curso = $this->input->post("informe_duracion_curso");
		$informe_departamento_curso = $this->input->post("informe_departamento_curso");
		$informe_municipio_curso = $this->input->post("informe_municipio_curso");
		$informe_curso_gratis = $this->input->post("informe_curso_gratis");
		$informe_docente = $this->input->post("informe_docente");
		$informe_fecha_curso = $this->input->post("informe_fecha_curso");
		$informe_asistentes = $this->input->post("informe_asistentes");
		$informe_numero_mujeres = $this->input->post("informe_numero_mujeres");
		$informe_numero_hombres = $this->input->post("informe_numero_hombres");

		$docente = $this->db->select("*")->from("docentes")->where("id_docente", $informe_docente)->get()->row();

		$nombreDocente = $docente->primerNombreDocente . " " . $docente->primerApellidoDocente;

		$data_curso = array(
			"nombreCurso" => $informe_nombre_curso,
			"numeroAsistentes" => $informe_asistentes,
			"duracionCurso" => $informe_duracion_curso,
			"tipoCurso" => $informe_tipo_curso,
			"numeroMujeres" => $informe_numero_mujeres,
			"numeroHombres" => $informe_numero_hombres,
			"fechaCurso" => $informe_fecha_curso,
			"fechaIngresoCurso" => date('Y/m/d H:i:s'),
			"enUnionCon" => $informe_union,
			"intencionalidadCurso" => $informe_intencionalidad_curso,
			"cursoGratis" => $informe_curso_gratis,
			"departamentoCurso" => $informe_departamento_curso,
			"municipioCurso" => $informe_municipio_curso,
			"nombreDocente" => $nombreDocente,
			"docentes_id_docente" => $informe_docente,
			"organizaciones_id_organizacion" => $id_organizacion
		);

		if ($this->db->insert('informeActividades', $data_curso)) {
			echo json_encode(array("msg" => "Curso Guardado."));
			$this->logs_sia->session_log('Informe de actividad');
			$this->notif_sia->notification('Informe', 'admin', $nombreOrganizacion);
		}
	}

	public function guardar_asistentesInformeActividades()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$informe_primerNombre_asistente = $this->input->post("informe_primerNombre_asistente");
		$informe_segundoNombre_asistente = $this->input->post("informe_segundoNombre_asistente");
		$informe_primerApellido_asistente = $this->input->post("informe_primerApellido_asistente");
		$informe_segundoApellido_asistente = $this->input->post("informe_segundoApellido_asistente");
		$informe_sexo_asistente = $this->input->post("informe_sexo_asistente");
		$informe_edad_asistente = $this->input->post("informe_edad_asistente");
		$informe_tipoDocumento_asistente = $this->input->post("informe_tipoDocumento_asistente");
		$informe_numeroDocumento_asistente = $this->input->post("informe_numeroDocumento_asistente");
		$informe_formacion_asistente = $this->input->post("informe_formacion_asistente");
		$informe_nit_asistente = $this->input->post("informe_nit_asistente");
		$informe_razonsocial_asistente = $this->input->post("informe_razonsocial_asistente");
		$informe_rolorganizacion_asistente = $this->input->post("informe_rolorganizacion_asistente");
		$informe_proceso_asistente = $this->input->post("informe_proceso_asistente");
		$informe_fechafinalizacion_asistente = $this->input->post("informe_fechafinalizacion_asistente");
		$informe_departamento_asistente = $this->input->post("informe_departamento_asistente");
		$informe_municipio_asistente = $this->input->post("informe_municipio_asistente");
		$informe_fax_asistente = $this->input->post("informe_fax_asistente");
		$informe_direccion_asistente = $this->input->post("informe_direccion_asistente");
		$informe_direccionCorreoElectronico_asistente = $this->input->post("informe_direccionCorreoElectronico_asistente");

		$cabeza_radio = $this->input->post("cabeza_radio");
		$informe_discapacidad_asistente = $this->input->post("informe_discapacidad_asistente");
		$indigenas_chekbox = $this->input->post("indigenas_chekbox");
		$Rom_Gitanos_checkbox = $this->input->post("Rom_Gitanos_checkbox");
		$Afro_Negros_Mulatos_checkbox = $this->input->post("Afro_Negros_Mulatos_checkbox");
		$raizal_checkbox = $this->input->post("raizal_checkbox");
		$palenqueros_checkbox = $this->input->post("palenqueros_checkbox");
		$red_radio = $this->input->post("red_radio");
		$informe_folio_red_asistente = $this->input->post("informe_folio_red_asistente");
		$victima_radio = $this->input->post("victima_radio");
		$informe_ruv_asistente = $this->input->post("informe_ruv_asistente");
		$reintegracion_radio = $this->input->post("reintegracion_radio");
		$informe_coda_asistente = $this->input->post("informe_coda_asistente");
		$lgtbi_radio = $this->input->post("lgtbi_radio");
		$prostitucion_radio = $this->input->post("prostitucion_radio");
		$libertad_radio = $this->input->post("libertad_radio");

		if ($indigenas_chekbox == "on") {
			$indigenas_chekbox = "Si";
		} else {
			$indigenas_chekbox = "No";
		}
		if ($Rom_Gitanos_checkbox == "on") {
			$Rom_Gitanos_checkbox = "Si";
		} else {
			$Rom_Gitanos_checkbox = "No";
		}
		if ($Afro_Negros_Mulatos_checkbox == "on") {
			$Afro_Negros_Mulatos_checkbox = "Si";
		} else {
			$Afro_Negros_Mulatos_checkbox = "No";
		}
		if ($raizal_checkbox == "on") {
			$raizal_checkbox = "Si";
		} else {
			$raizal_checkbox = "No";
		}
		if ($palenqueros_checkbox == "on") {
			$palenqueros_checkbox = "Si";
		} else {
			$palenqueros_checkbox = "No";
		}
		$id_curso = $this->db->select_max("id_informeActividades")->from("informeActividades")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row()->id_informeActividades;
		$data_asistente = array(
			'primerNombreAsistente' => $informe_primerNombre_asistente,
			'segundoNombreAsistente' => $informe_segundoNombre_asistente,
			'primerApellidoAsistente' => $informe_primerApellido_asistente,
			'segundoApellidoAsistente' => $informe_segundoApellido_asistente,
			'tipoDocumentoAsistente' => $informe_tipoDocumento_asistente,
			'numeroDocumentoAsistente' => $informe_numeroDocumento_asistente,
			'numNITOrganizacion' => $informe_nit_asistente,
			'nombreOrganizacion' => $informe_razonsocial_asistente,
			'procesoBeneficio' => $informe_proceso_asistente,
			'fechaFinalizacion' => $informe_fechafinalizacion_asistente,
			'departamentoResidencia' => $informe_departamento_asistente,
			'municipioResidencia' => $informe_municipio_asistente,
			'faxAsistente' => $informe_fax_asistente,
			'direccionAsistente' => $informe_direccion_asistente,
			'direccionCorreoElectronicoAsistente' => $informe_direccionCorreoElectronico_asistente,
			'edadAsistente' => $informe_edad_asistente,
			'sexoAsistente' => $informe_sexo_asistente,
			'nivelFormacion' => $informe_formacion_asistente,
			'rolOrganizacion' => $informe_rolorganizacion_asistente,
			'cabezaFamilia' => $cabeza_radio,
			'discapacidad' => $informe_discapacidad_asistente,
			'indigena' => $indigenas_chekbox,
			'afro' => $Afro_Negros_Mulatos_checkbox,
			'raizal' => $raizal_checkbox,
			'palenquero' => $palenqueros_checkbox,
			'romGitano' => $Rom_Gitanos_checkbox,
			'redUnidos' => $red_radio,
			'numeroFolioRedUnidos' => $informe_folio_red_asistente,
			'victima' => $victima_radio,
			'numeroRUVVictima' => $informe_ruv_asistente,
			'reintegro' => $reintegracion_radio,
			'numeroCODAReintegro' => $informe_coda_asistente,
			'LGTBI' => $lgtbi_radio,
			'prostitucion' => $prostitucion_radio,
			'privadoLibertad' => $libertad_radio,
			'informeActividades_id_informeActividades' => $id_curso
		);
		if ($this->db->insert("asistentes", $data_asistente)) {
			echo  json_encode(array("msg" => "Asistentes Guardadados."));
		}
	}

	public function verAsistentesCurso()
	{
		$id_curso = $this->input->post("id_curso");
		$asistentes = $this->db->select("*")->from("asistentes")->where("informeActividades_id_informeActividades", $id_curso)->get()->result();
		echo json_encode($asistentes);
	}

	public function cargar_informeCursos()
	{
		$datos = array();
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$cursos = $this->db->select("*")->from("informeActividades")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		array_push($datos, $cursos);
		foreach ($cursos as $curso) {
			$id_docente = $curso->docentes_id_docente;
			$docente = $this->db->select("*")->from("docentes")->where("id_docente", $id_docente)->get()->result();
			array_push($datos, $docente);
		}
		return $datos;
	}
	// TODO: Actualizar docentes
	public function actualizarDocente()
	{
		// Traer datos organanzación, se captura usuario id y se trae organización que pertenece al id del usuario. 
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// ID organización & Nombre de la organización
		$id_organizacion = $datos_organizacion->id_organizacion;
		$nombreOrganizacion = $datos_organizacion->nombreOrganizacion;
		// ID docente desde post y solci
		$id_docente = $this->input->post("id_docente");
		$solicitud = $this->input->post("solicitud");
		// TODO: Variables nuevas para asignación de docente según su estado. 
		$informacionDocente = $this->db->select("*")->from("docentes")->where("id_docente", $id_docente)->get()->row();
		// Asignar "No" a valor de asignación y evitar que se reemplace el valor ya asignado
		$asignado = $informacionDocente->asignado;
		if ($asignado == NULL && $informacionDocente->valido == "0") {
			$asignado = "No";
		}
		// Datos para la actualización de docentes en Array
		$data_update = array(
			'primerNombreDocente' => $this->input->post("primer_nombre_doc"),
			'segundoNombreDocente' => $this->input->post("segundo_nombre_doc"),
			'primerApellidoDocente' => $this->input->post("primer_nombre_doc"),
			'segundoApellidoDocente' => $this->input->post("segundo_apellido_doc"),
			'numCedulaCiudadaniaDocente' => $this->input->post("numero_cedula_doc"),
			'profesion' => $this->input->post("profesion_doc"),
			'horaCapacitacion' => $this->input->post("horas_doc"),
			'observacion' => "Facilitador actualizado.",
			'observacionAnterior' => $informacionDocente->observacion,
			'asignado' => $asignado,
		);

		$where = array('organizaciones_id_organizacion' => $id_organizacion, 'id_docente' => $id_docente);
		$this->db->where($where);
		if ($this->db->update('docentes', $data_update)) {
			echo json_encode(array("msg" => "Docente $primer_apellido_doc $primer_apellido_doc Actualizado."));
			// Solo actualizacion como log
			$this->logs_sia->session_log('Docentes Actualizados');
			// Si se marca actualizar con envio de solicitud
			if ($solicitud == "Si") {
				// Se enviera notificación en caso de no estar aprobado el docente, adicional correo electronico en caso de no estar asignado a evaluador
				if ($informacionDocente->valido == "0") {
					// Solo envia notificación si no esta aprobado
					$this->notif_sia->notification('Docentes', 'admin', $nombreOrganizacion);
					// Solo envia correo si no esta asignado
					if ($asignado != NULL || $asignado == "No") {
						$this->envilo_mailadmin("actualizacion", "2", $numero_cedula_doc);
					}
				}
			}
		}
	}

	public function anadirNuevoDocente()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$cedula = $this->input->post("cedula");
		$primer_nombre = $this->input->post("primer_nombre");
		$segundo_nombre = $this->input->post("segundo_nombre");
		$primer_apellido = $this->input->post("primer_apellido");
		$segundo_apellido = $this->input->post("segundo_apellido");
		$profesion = $this->input->post("profesion");
		$horas = $this->input->post("horas");

		$data_docentes = array(
			'primerNombreDocente' => $primer_nombre,
			'segundoNombreDocente' => $segundo_nombre,
			'primerApellidoDocente' => $primer_apellido,
			'segundoApellidoDocente' => $segundo_apellido,
			'numCedulaCiudadaniaDocente' => $cedula,
			'profesion' => $profesion,
			'horaCapacitacion' => $horas,
			'valido' => 0,
			'organizaciones_id_organizacion' => $id_organizacion
		);

		$this->db->insert('docentes', $data_docentes);
		echo json_encode(array('url' => "panel", 'msg' => "Se creo Docente."));
	}

	public function darRespuestaSeguimiento()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$id_seguimiento = $this->input->post("id_seguimiento");
		$respuestaSeguimiento = $this->input->post("respuestaSeguimiento");

		$data_respuesta = array(
			'respuestaSeguimiento' => $respuestaSeguimiento
		);

		$this->db->where('id_seguimientoSimple', $id_seguimiento);
		if ($this->db->update('seguimientoSimple', $data_respuesta)) {
			echo json_encode(array('url' => "panel", 'msg' => "Se respondio al seguimiento."));
		}
	}

	public function eliminarDocente()
	{
		$id_docente = $this->input->post("id_docente");
		$archivos = $this->db->select("*")->from("archivosDocente")->where("docentes_id_docente", $id_docente)->get()->result();
		foreach ($archivos as $archivo) {
			$nombre = $archivo->nombre;
			$tipo = $archivo->tipo;
			$id_archivosDocente = $archivo->id_archivosDocente;

			if ($tipo == "docenteHojaVida") {
				unlink('uploads/docentes/hojasVida/' . $nombre);
				$this->db->where('id_archivosDocente', $id_archivosDocente)->where('docentes_id_docente', $id_docente);
				$this->db->delete('archivosDocente');
			}
			if ($tipo == "docenteTitulo") {
				unlink('uploads/docentes/titulos/' . $nombre);
				$this->db->where('id_archivosDocente', $id_archivosDocente)->where('docentes_id_docente', $id_docente);
				$this->db->delete('archivosDocente');
			}
			if ($tipo == "docenteCertificados") {
				unlink('uploads/docentes/certificados/' . $nombre);
				$this->db->where('id_archivosDocente', $id_archivosDocente)->where('docentes_id_docente', $id_docente);
				$this->db->delete('archivosDocente');
			}
			if ($tipo == "docenteCertificadosEconomia") {
				unlink('uploads/docentes/certificadosEconomia/' . $nombre);
				$this->db->where('id_archivosDocente', $id_archivosDocente)->where('docentes_id_docente', $id_docente);
				$this->db->delete('archivosDocente');
			}
		}

		$this->db->where("id_docente", $id_docente);
		if ($this->db->delete('docentes')) {
			echo json_encode(array("msg" => "Docente Eliminado de su organización."));
		}
	}

	public function verFirmaRepLegal()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$contrasena = $this->input->post("contrasena");

		$contrasena_db = $this->db->select("contrasena_firma")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row()->contrasena_firma;

		if ($contrasena_db == $contrasena) {
			echo json_encode(array("estado" => "1"));
		} else {
			echo json_encode(array("estado" => "0"));
		}
	}

	//TODO: Finalizar proceso
	public function finalizarProceso()
	{
		$formularios = $this->verificarFormularios();

		if (count($formularios) == 1) {
			$usuario_id = $this->session->userdata('usuario_id');
			$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$id_organizacion = $datos_organizacion->id_organizacion;
			$nombreOrganizacion = $datos_organizacion->nombreOrganizacion;

			$data_estado = array(
				'nombre' => "Finalizado",
				'fecha' => date('Y/m/d H:i:s'),
				'estadoAnterior' => "En Proceso",
				'fechaFinalizado' => date('Y/m/d H:i:s'),
				'organizaciones_id_organizacion' => $id_organizacion
			);

			$this->db->where('organizaciones_id_organizacion', $id_organizacion);
			$this->db->update('estadoOrganizaciones', $data_estado);
			echo json_encode(array('url' => "panel", 'msg' => "Solicitud Terminada, cambio de estado a Finalizado.", 'estado' => "1"));
			$this->envio_mailcontacto("finaliza", 2);
			$this->logs_sia->session_log('Finalizada la Solicitud');
			$this->notif_sia->notification('Finalizada', 'admin', $nombreOrganizacion);
			$this->logs_sia->logQueries();
		} else {
			echo json_encode(array('url' => "panel", 'msg' => "Verifique los formularios.", 'estado' => "0"));
		}
	}

	public function eliminarArchivo()
	{
		$id_formulario = $this->input->post('id_formulario');
		$id_archivo = $this->input->post('id_archivo');
		$tipo = $this->input->post('tipo');
		$nombre = $this->input->post('nombre');

		if ($tipo == "carta") {
			unlink('uploads/cartaRep/' . $nombre);
		}
		if ($tipo == "certificaciones") {
			unlink('uploads/certificaciones/' . $nombre);
		}
		if ($tipo == "lugar") {
			unlink('uploads/lugarAtencion/' . $nombre);
		}
		if ($tipo == "registroEdu") {
			unlink('uploads/registrosEducativos/' . $nombre);
		}
		if ($tipo == "jornadaAct") {
			unlink('uploads/jornadas/' . $nombre);
		}
		if ($tipo == "materialDidacticoProgBasicos") {
			unlink('uploads/materialDidacticoProgBasicos/' . $nombre);
		}
		if ($tipo == "materialDidacticoAvalEconomia") {
			unlink('uploads/materialDidacticoAvalEconomia/' . $nombre);
		}
		if ($tipo == "formatosEvalProgAvalar") {
			unlink('uploads/formatosEvalProgAvalar/' . $nombre);
		}
		if ($tipo == "materialDidacticoProgAvalar") {
			unlink('uploads/materialDidacticoProgAvalar/' . $nombre);
		}
		if ($tipo == "instructivoPlataforma") {
			unlink('uploads/instructivosPlataforma/' . $nombre);
		}

		$this->db->where('id_archivo', $id_archivo)->where('id_formulario', $id_formulario);
		if ($this->db->delete('archivos')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el archivo."));
		}
	}

	public function eliminarArchivoDocente()
	{
		$id_archivoDocente = $this->input->post('id_archivoDocente');
		$id_docente = $this->input->post('id_docente');
		$tipo = $this->input->post('tipo');
		$nombre = $this->input->post('nombre');

		if ($tipo == "docenteHojaVida") {
			unlink('uploads/docentes/hojasVida/' . $nombre);
		}
		if ($tipo == "docenteTitulo") {
			unlink('uploads/docentes/titulos/' . $nombre);
		}
		if ($tipo == "docenteCertificados") {
			unlink('uploads/docentes/certificados/' . $nombre);
		}
		if ($tipo == "docenteCertificadosEconomia") {
			unlink('uploads/docentes/certificadosEconomia/' . $nombre);
		}

		$this->db->where('id_archivosDocente', $id_archivoDocente)->where('docentes_id_docente', $id_docente);
		if ($this->db->delete('archivosDocente')) {
			echo json_encode(array('url' => "", 'msg' => "Se elimino el archivo."));
		}
	}

	public function guardarArchivoCarta()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 1;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "carta") {
			$ruta = 'uploads/cartaRep';
			$mensaje = "Se guardo la " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoRegistro()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 2;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "registroEdu") {
			$ruta = 'uploads/registrosEducativos';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoJornada()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 5;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "jornadaAct") {
			$ruta = 'uploads/jornadas';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoMaterialProgBasic()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		//var_dump("prueba ".$_FILES['file']);
		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 2000000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 6;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "materialDidacticoProgBasicos") {
			$ruta = 'uploads/materialDidacticoProgBasicos';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoMaterialAvalEco()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 7;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "materialDidacticoAvalEconomia") {
			$ruta = 'uploads/materialDidacticoAvalEconomia';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoFormatosEvalProgAval()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 8;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "formatosEvalProgAvalar") {
			$ruta = 'uploads/formatosEvalProgAvalar';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoMaterialDicProgAvalar()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 8;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "materialDidacticoProgAvalar") {
			$ruta = 'uploads/materialDidacticoProgAvalar';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoInstructivoPlataforma()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 10;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "instructivoPlataforma") {
			$ruta = 'uploads/instructivosPlataforma';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $id_organizacion
		);


		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivos', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoHojaVidaDocente()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$id_docente = $this->input->post('id_docente');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "docenteHojaVida") {
			$ruta = 'uploads/docentes/hojasVida';
			$mensaje = "Se guardo la " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'docentes_id_docente' => $id_docente
		);

		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivosDocente', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoTituloDocente()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$id_docente = $this->input->post('id_docente');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "docenteTitulo") {
			$ruta = 'uploads/docentes/titulos';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'docentes_id_docente' => $id_docente
		);

		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivosDocente', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoCertificadoDocente()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$id_docente = $this->input->post('id_docente');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();


		if ($tipoArchivo == "docenteCertificados") {
			$ruta = 'uploads/docentes/certificados';
			$mensaje = "Se guardo la " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'docentes_id_docente' => $id_docente
		);

		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
		} else if ($this->db->insert('archivosDocente', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivoCertificadoEconomiaDocente()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$id_docente = $this->input->post('id_docente');
		$horas = $this->input->post('horas');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();

		if ($horas < 1) {
			echo json_encode(array('url' => "", 'msg' => "El certificado debe tener mínimo 1 hora."));
		} else {
			if ($tipoArchivo == "docenteCertificadosEconomia") {
				$ruta = 'uploads/docentes/certificadosEconomia';
				$mensaje = "Se guardo la " . $append_name;
			}

			$nombre_imagen =  $append_name . "_" . $horas . "Horas_" . $name_random . "_" . $_FILES['file']['name'];
			$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

			$data_update = array(
				'tipo' => $tipoArchivo,
				'nombre' => $nombre_imagen,
				'docentes_id_docente' => $id_docente
			);

			if (0 < $_FILES['file']['error']) {
				echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
			} else if ($_FILES['file']['size'] > $size) {
				echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF."));
			} else if ($tipo_archivo != "pdf") {
				echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)"));
			} else if ($this->db->insert('archivosDocente', $data_update)) {
				if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
					echo json_encode(array('url' => "", 'msg' => $mensaje));
					//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){	
				} else {
					echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
				}
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function guardarArchivos()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');

		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$id_formulario = 1;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $id_organizacion)->get()->row();

		if ($tipoArchivo == "certificaciones") {
			$ruta = 'uploads/certificaciones';
			$mensaje = "Se guardo la " . $append_name;
		} else if ($tipoArchivo == "lugar") {
			$ruta = 'uploads/lugarAtencion';
			$mensaje = "Se guardo " . $append_name;
		}
		//inicializamos un contador para recorrer los archivos
		$i = 0;
		$files = $_FILES['file']['name'];
		//recorremos los input files del formulario
		foreach ($files as $file) {
			//si se está subiendo algún archivo en ese indice
			if ($_FILES['file']['tmp_name'][$i]) {
				//separamos los trozos del archivo, nombre extension
				$trozos[$i] = explode(".", $_FILES["file"]["name"][$i]);

				//obtenemos la extensión
				$extension[$i] = end($trozos[$i]);
				$tipo_archivo = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
				//si la extensión es una de las permitidas
				if ($tipo_archivo == "pdf" && $tipoArchivo == "certificaciones" && $this->checkExtensionPDF($extension[$i]) === TRUE) {
					$name_random_end = random(5);
					$data_update = array(
						'tipo' => $tipoArchivo,
						'nombre' => $append_name . "_" . $name_random . $name_random_end . "_" . $_FILES['file']['name'][$i],
						'id_formulario' => $id_formulario,
						'organizaciones_id_organizacion' => $id_organizacion
					);
					if ($this->db->insert('archivos', $data_update)) {
						if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $ruta . '/' . $append_name . "_" . $name_random . $name_random_end . "_" . $_FILES['file']['name'][$i])) {
						}
					}
				} else {
					echo json_encode(array('url' => "", 'msg' => "La extensión no coindice en el archivo #" . $i . ", por favor, seleccione otro archivo."));
				}
				if (($tipo_archivo == "jpg" || $tipo_archivo == "png") && $tipoArchivo == "lugar" && $this->checkExtensionImagenes($extension[$i]) === TRUE) {
					$name_random_end = random(5);
					$data_update = array(
						'tipo' => $tipoArchivo,
						'nombre' => $append_name . "_" . $name_random . $name_random_end . "_" . $_FILES['file']['name'][$i],
						'id_formulario' => $id_formulario,
						'organizaciones_id_organizacion' => $id_organizacion
					);
					if ($this->db->insert('archivos', $data_update)) {
						if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $ruta . '/' . $append_name . "_" . $name_random . $name_random_end . "_" . $_FILES['file']['name'][$i])) {
						}
					}
				} else {
					echo json_encode(array('url' => "", 'msg' => "La extensión no coindice en el archivo #" . $i . ", por favor, seleccione otro archivo."));
				}
			} else {
				echo json_encode(array('url' => "", 'msg' => "No hay seleccion de archivos."));
			}
			$i++;
		}
		echo json_encode(array('url' => "", 'msg' => "Error intente de nuevo, nombres diferentes de los archivos."));
	}

	public function eliminarSolicitud()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$numeroSolicitudes = $this->numeroSolicitudes();

		$data_update_solicitud = array(
			'numeroSolicitudes' => $numeroSolicitudes - 1,
			'fecha' =>  date('Y/m/d H:i:s'),
			'organizaciones_id_organizacion' => $id_organizacion
		);

		$this->db->where('organizaciones_id_organizacion', $id_organizacion);
		$this->db->update('solicitudes', $data_update_solicitud);

		$estadoAnterior = $this->estadoAnteriorOrganizaciones();

		$data_estado = array(
			'nombre' => $estadoAnterior,
			'fecha' => date('Y/m/d H:i:s'),
			'estadoAnterior' => $estadoAnterior
		);

		$this->db->where('organizaciones_id_organizacion', $id_organizacion);
		$this->db->update('estadoOrganizaciones', $data_estado);

		$data_update_solicitud2 = array(
			'tipoSolicitud' => "Eliminar",
			'motivoSolicitud' =>  "Eliminar",
			'modalidadSolicitud' =>  "Eliminar",
			'idSolicitud' => "0",
			'organizaciones_id_organizacion' => $id_organizacion
		);

		$this->db->where('organizaciones_id_organizacion', $id_organizacion);
		$this->db->update('tipoSolicitud', $data_update_solicitud2);
		echo json_encode(array('url' => "", 'msg' => "Solicitud eliminada."));
		$this->logs_sia->session_log('Eliminar Solicitud');
		$this->logs_sia->logQueries();
	}

	private function checkExtensionImagenes($extension)
	{
		//aqui podemos añadir las extensiones que deseemos permitir
		$extensiones = array("jpg", "png");
		if (in_array(strtolower($extension), $extensiones)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function checkExtensionPDF($extension)
	{
		//aqui podemos añadir las extensiones que deseemos permitir
		$extensiones = array("pdf");
		if (in_array(strtolower($extension), $extensiones)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function excelAsistentes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$append_name = $this->input->post('append_name');
		$name_random = random(10);
		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$this->load->library('PHPExcel'); //load PHPExcel library 
		//Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
		$ruta = 'uploads/asistentes/';
		$size = 60000000;

		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 60 Mb, intente con otro archivo xlsx."));
		} else if ($tipo_archivo != "xlsx") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser xlsx. (archivo.xlsx)"));
		} else if (1 == 1) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . $nombre_imagen)) {
				//$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 
				//Set to read only
				$objReader->setReadDataOnly(true);
				//Load excel file
				$objPHPExcel = $objReader->load($ruta . $nombre_imagen);
				$totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
				//loop from first data untill last data
				$id_curso = $this->db->select_max("id_informeActividades")->from("informeActividades")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row()->id_informeActividades;
				$data_archivoAsistentes = array(
					'archivoAsistentes' => $nombre_imagen
				);

				$this->db->where('id_informeActividades', $id_curso);
				if ($this->db->update('informeActividades', $data_archivoAsistentes)) {
					for ($i = 2; $i <= $totalrows; $i++) {
						$cellVall1 = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();

						if ($cellVall1 != null || $cellVall1 != "" || $cellVall1 != NULL) {
							$primerNombreAsistente = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
							$segundoNombreAsistente = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
							$primerApellidoAsistente = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
							$segundoApellidoAsistente = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
							$tipoDocumentoAsistente = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
							$numeroDocumentoAsistente = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
							$nombreOrganizacion = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue();
							$numNITOrganizacion = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
							$procesoBeneficio = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
							$fechaFinalizacion = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
							$departamentoResidencia = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
							$municipioResidencia = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
							$faxAsistente = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
							$direccionAsistente = $objWorksheet->getCellByColumnAndRow(13, $i)->getValue();
							$direccionCorreoElectronicoAsistente = $objWorksheet->getCellByColumnAndRow(14, $i)->getValue();
							$edadAsistente = $objWorksheet->getCellByColumnAndRow(15, $i)->getValue();
							$sexoAsistente = $objWorksheet->getCellByColumnAndRow(16, $i)->getValue();
							$nivelFormacion = $objWorksheet->getCellByColumnAndRow(17, $i)->getValue();
							$rolOrganizacion = $objWorksheet->getCellByColumnAndRow(18, $i)->getValue();
							$cabezaFamilia = $objWorksheet->getCellByColumnAndRow(19, $i)->getValue();
							$discapacidad = $objWorksheet->getCellByColumnAndRow(20, $i)->getValue();
							$indigena = $objWorksheet->getCellByColumnAndRow(21, $i)->getValue();
							$afro = $objWorksheet->getCellByColumnAndRow(22, $i)->getValue();
							$raizal = $objWorksheet->getCellByColumnAndRow(23, $i)->getValue();
							$palenquero = $objWorksheet->getCellByColumnAndRow(24, $i)->getValue();
							$romGitano = $objWorksheet->getCellByColumnAndRow(25, $i)->getValue();
							$redUnidos = $objWorksheet->getCellByColumnAndRow(26, $i)->getValue();
							$numeroFolioRedUnidos = $objWorksheet->getCellByColumnAndRow(27, $i)->getValue();
							$victima = $objWorksheet->getCellByColumnAndRow(28, $i)->getValue();
							$numeroRUVVictima = $objWorksheet->getCellByColumnAndRow(29, $i)->getValue();
							$reintegro = $objWorksheet->getCellByColumnAndRow(30, $i)->getValue();
							$numeroCODAReintegro = $objWorksheet->getCellByColumnAndRow(31, $i)->getValue();
							$LGTBI = $objWorksheet->getCellByColumnAndRow(32, $i)->getValue();
							$prostitucion = $objWorksheet->getCellByColumnAndRow(33, $i)->getValue();
							$privadoLibertad = $objWorksheet->getCellByColumnAndRow(34, $i)->getValue();

							$data_asistentes = array(
								'primerNombreAsistente' => $primerNombreAsistente,
								'segundoNombreAsistente' => $segundoNombreAsistente,
								'primerApellidoAsistente' => $primerApellidoAsistente,
								'segundoApellidoAsistente' => $segundoApellidoAsistente,
								'tipoDocumentoAsistente' => $tipoDocumentoAsistente,
								'numeroDocumentoAsistente' => $numeroDocumentoAsistente,
								'nombreOrganizacion' => $nombreOrganizacion,
								'numNITOrganizacion' => $numNITOrganizacion,
								'procesoBeneficio' => $procesoBeneficio,
								'fechaFinalizacion' => $fechaFinalizacion,
								'departamentoResidencia' => $departamentoResidencia,
								'municipioResidencia' => $municipioResidencia,
								'faxAsistente' => $faxAsistente,
								'direccionAsistente' => $direccionAsistente,
								'direccionCorreoElectronicoAsistente' => $direccionCorreoElectronicoAsistente,
								'edadAsistente' => $edadAsistente,
								'sexoAsistente' => $sexoAsistente,
								'nivelFormacion' => $nivelFormacion,
								'rolOrganizacion' => $rolOrganizacion,
								'cabezaFamilia' => $cabezaFamilia,
								'discapacidad' => $discapacidad,
								'indigena' => $indigena,
								'afro' => $afro,
								'raizal' => $raizal,
								'palenquero' => $palenquero,
								'romGitano' => $romGitano,
								'redUnidos' => $redUnidos,
								'numeroFolioRedUnidos' => $numeroFolioRedUnidos,
								'victima' => $victima,
								'numeroRUVVictima' => $numeroRUVVictima,
								'reintegro' => $reintegro,
								'numeroCODAReintegro' => $numeroCODAReintegro,
								'LGTBI' => $LGTBI,
								'prostitucion' => $prostitucion,
								'privadoLibertad' => $privadoLibertad,
								'informeActividades_id_informeActividades' => $id_curso
							);
							$this->db->insert('asistentes', $data_asistentes);
						}
					}
					echo json_encode(array('url' => "panel", 'msg' => "Se guardaron los asistentes del curso, espere 5 segundos."));
					//unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
					//redirect(base_url() . "put link were you want to redirect");
				} else {
					echo json_encode(array('url' => "", 'msg' => "No se actualizo la tabla."));
				}
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}
	}

	public function archivoAsistencia()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$name_random = random(10);
		$size = 50000000;

		$imagen_db = $this->db->select('*')->from('informeActividades')->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$imagen_db_nombre = $imagen_db->archivoAsistencia;

		$nombre_archivo =  "archivoAsistencia_" . $name_random . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('url' => "informeActividades", 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "informeActividades", 'msg' => "El tamaño supera las 50 Mb, intente con otro pdf."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "informeActividades", 'msg' => "La extensión de la imagen no es correcta, debe ser JPG, PNG"));
		} else if (move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/asistentes/' . $nombre_archivo)) {

			$id_curso = $this->db->select_max("id_informeActividades")->from("informeActividades")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row()->id_informeActividades;

			$data_insert = array(
				'archivoAsistencia' => $nombre_archivo
			);

			$this->db->where('id_informeActividades', $id_curso);
			if ($this->db->update('informeActividades', $data_insert)) {
				echo json_encode(array('msg' => "Se ingreso la asistencia."));
				$this->logs_sia->session_log('Ingreso de archivo de asistencia curso');
			}
		}
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function cargarObservacionesUsuario()
	{
		$id_organizacion = $this->input->post('id_organizacion');

		$observaciones = $this->db->select("*")->from("observaciones")->where("organizaciones_id_organizacion", $id_organizacion)->order_by("numeroRevision", "desc")->get()->result();
		echo json_encode(array("observaciones" => $observaciones));
	}

	public function cargar_informacionAsistente()
	{
		$id_asistente = $this->input->post('id_asistente');

		$informacion = $this->db->select("*")->from("asistentes")->where("id_asistentes", $id_asistente)->get()->row();
		echo json_encode(array("informacion" => $informacion));
	}

	public function actualizarAsistente()
	{
		$id_asistente = $this->input->post('id_asistente');
		$editarAsisPN = $this->input->post('editarAsisPN');
		$editarAsisSN = $this->input->post('editarAsisSN');
		$editarAsisPA = $this->input->post('editarAsisPA');
		$editarAsisSA = $this->input->post('editarAsisSA');
		$editarAsisTipo = $this->input->post('editarAsisTipo');
		$editarAsisNumero = $this->input->post('editarAsisNumero');
		$editarAsisDireccion = $this->input->post('editarAsisDireccion');

		$data_update_asistente = array(
			'primerNombreAsistente' => $editarAsisPN,
			'segundoNombreAsistente' => $editarAsisSN,
			'primerApellidoAsistente' => $editarAsisPA,
			'segundoApellidoAsistente' => $editarAsisSA,
			'tipoDocumentoAsistente' => $editarAsisTipo,
			'numeroDocumentoAsistente' => $editarAsisNumero,
			'direccionCorreoElectronicoAsistente' => $editarAsisDireccion
		);

		$this->db->where('id_asistentes', $id_asistente);
		if ($this->db->update('asistentes', $data_update_asistente)) {
			echo json_encode(array("msg" => "Asistente actualizado, verifique la información."));
		}
	}
	// TODO: Enviar Correos a contacto de la solicitud
	function envio_mailcontacto($tipo, $prioridad)
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$to_correo = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $to_correo->id_organizacion;
		$datosSolicitud = $this->db->select("*")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$idSolicitud = $datosSolicitud->idSolicitud;
		$datosSolicitudes = $this->db->select("*")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$fechaSolicitud = $datosSolicitudes->fecha;

		switch ($tipo) {
			case 'finaliza':
				$asunto = "Finaliza el diligenciamiento de la solicitud";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que su solicitud de acreditación ha sido enviada por el SIIA para ser evaluada. En este momento no puede visualizarla en el aplicativo hasta que se realice la verificación de requisitos. De ser necesario, le será devuelta con las observaciones pertinentes, dentro de los siguientes diez (10) días hábiles. 
					<br/><br/>
					<label>Datos de recepción:</label> <br/>
					Fecha de recepcion de solicitud: <strong>" . date("Y-m-d h:m:s") . "</strong>. <br/> 
					Fecha de creación de solicitud: <strong>" . $fechaSolicitud . "</strong>. <br/> 
					Número ID de la solicitud: <strong>" . $idSolicitud . "</strong>. <br/>";
				break;
			case 'inicia':
				$asunto = "Inicia el diligenciamiento de la solicitud";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que ha iniciado el diligenciamiento de su solicitud de acreditación. Recuerde diligenciar todos los formularios, ingresando la información en los campos requeridos, los archivos adjuntos como imágenes y archivos con las extensiones en letra minúscula admitidas (archivo.jpg, archivo.png, archivo.pdf) y con un peso no mayor a 15 Mb cada archivo. Al final de cada formulario guarde la información con el botón 'Guardar'. Cuando concluya con el ingreso de información en todos los formularios y archivos adjuntos requeridos, favor enviar la solicitud para su evaluación dando FINALIZAR en el SIIA. Si esta actualizando información recuerde eliminar la solicitud al finalizar. Organizaciones Solidarias le recuerda que es importante mantener la  información básica de contacto de la entidad actualizada, para facilitar el desarrollo procesos derivados de la acreditación. Le recomendamos  cada vez que se realice algún cambio sea reportado por medio del SIIA.";
				break;
			case 'docentes':
				$asunto = "Docentes";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que  por medio del SIIA se recibió de su entidad una solicitud de revisión de hojas de vida para ampliar el equipo de facilitadores aprobados. En los próximos  diez (10) días hábiles será realizada la verificación de los requisitos establecidos en el numeral 6 del artículo 4 de la resolución 110 de 2016. Una vez realizada esta verificación, se procederá a  actualizar el listado de facilitadores de la entidad acreditada.";
				break;
			default:
				$asunto = "";
				$mensaje = "";
				break;
		}
		/**
		1 => '1 (Highest)',
		2 => '2 (High)',
		3 => '3 (Normal)',
		4 => '4 (Low)',
		5 => '5 (Lowest)'
		 **/
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($to_correo->direccionCorreoElectronicoOrganizacion);
		$this->email->cc(CORREO_SIA);
		$this->email->subject('SIIA - : ' . $asunto);
		$this->email->set_priority($prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if ($this->email->send()) {
			// Do nothing.
		} else {
			echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envio el correo."));
		}
	}
	// TODO: Enviar Correos a Administrador
	function envilo_mailadmin($type, $prioridad, $docente)
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// $id_organizacion = $organizacion->id_organizacion;
		$docente = $this->db->select("*")->from("docentes")->where("numCedulaCiudadaniaDocente", $docente)->get()->row();
		// Cuerpo del mensaje según sea el caso.
		switch ($type) {
				// Actualización de facilitadores
			case 'actualizacion':
				$asunto = "Actualizacion Docente";
				$mensaje = "La organización <strong>" . $organizacion->nombreOrganizacion . "</strong>: Realizo una solicitud para actualización del facilitador <strong>" . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . "</strong>, por favor ingrese al sistema para asignar dicha solicitud, gracias. 
					<br/><br/>
					<label>Datos de recepción:</label> <br/>
					Fecha de recepcion de solicitud: <strong>" . date("Y-m-d h:m:s") . "</strong>. <br/>";
				break;
			default:
				$asunto = "";
				$mensaje = "";
				break;
		}
		/**
		 * Datos para envio de Email al administrador
		 * Prioridad
		1 => '1 (Highest)',
		2 => '2 (High)',
		3 => '3 (Normal)',
		4 => '4 (Low)',
		5 => '5 (Lowest)'
		 **/
		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to(CORREO_SIA);
		$this->email->cc(CORREO_SIA);
		$this->email->subject('SIIA: ' . $asunto);
		$this->email->set_priority($prioridad);
		// Crear arrya con el mesaje
		$data_msg['mensaje'] = $mensaje;
		// Vista del mensaje
		$email_view = $this->load->view('email/contacto', $data_msg, true);
		// Envio del correo con la vista
		$this->email->message($email_view);
		// Comprobación de que se enviara el correo
		if ($this->email->send()) {
			// Do nothing.
		} else {
			echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envio el correo."));
		}
	}
	public function cargar_informacionModal()
	{
		$informacionModal = $this->db->select("valor")->from("opciones")->where("nombre", "informacionModal")->get()->row()->valor;
		return $informacionModal;
	}
}
