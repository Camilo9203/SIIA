<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('download', 'file', 'url', 'html', 'form'));
		$this->load->model('InformacionGeneralModel');
		verify_session();
	}
	// Vista index
	public function index()
	{
		date_default_timezone_set("America/Bogota");
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');

		$usuario = $this->db->select('*')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data = array (
			'title' => 'Panel Principal',
			'logged_in' => $logged,
			'nombre_usuario' => $usuario->usuario,
			'usuario_id' => $usuario_id,
			'tipo_usuario' => $tipo_usuario,
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'departamentos' => $this->cargarDepartamentos(),
			'data_organizacion' => $this->cargarDatosOrganizacion(),
			'data_solicitudes' => $this->cargarSolicitudes(),
			'informacionGeneral' => $this->InformacionGeneralModel->getInformacionGeneral($usuario->id_usuario)
		);

		//$data['estado'] = $this->estadoOrganizaciones();
		//$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
		//$data['data_documentacion_legal'] = $this->cargarDatos_formulario_documentacion_legal();
		//$data['data_registro_educativo'] = $this->cargarDatos_formulario_registro_educativo();
		//$data['data_antecedentes_academicos'] = $this->cargarDatos_formulario_antecedentes_academicos();
		//$data['data_jornadas_actualizacion'] = $this->cargarDatos_formulario_jornadas_actualizacion();
		//$data['data_basicos_programas'] = $this->cargarDatos_formulario_basicos_programas();
		//$data['data_plataforma'] = $this->cargarDatos_formulario_datos_plataforma();
		//$data['data_modalidad_en_linea'] = $this->cargarDatos_modalidad_en_linea();
		//$data['data_programas'] = $this->cargarDatos_programas();
		$data["camara"] = $this->cargarCamaraComercio();
		$data['informacionModal'] = $this->cargar_informacionModal();
		$this->load->view('include/header', $data);
		$this->load->view('paneles/panel', $data);
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
		$archivo = $this->db->select('*')->from('archivos')->where('id_registro', $this->input->post('id'))->get()->row();
		$this->db->where('id_archivo', $archivo->id_archivo);
		if($this->db->delete('archivos')){
			unlink($this->input->post('ruta') . $archivo->nombre);
			switch ($this->input->post('tipo')) {
				case 2:
					$documentacion = $this->db->select('*')->from('documentacion')->where('id_tipoDocumentacion', $this->input->post('id'))->get()->row();
					$this->db->where('id_tipoDocumentacion', $documentacion->id_tipoDocumentacion);
					if ($this->db->delete('documentacion')) {
							echo json_encode(array('url' => "panel", 'msg' => "Se eliminaron los datos de camara de comercio."));
					}
					else {
						echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos de camara de comercio."));
					}
					break;
				case 2.1:
					$certificadoExistencia = $this->db->select('*')->from('certificadoExistencia')->where('id_certificadoExistencia', $this->input->post('id'))->get()->row();
					$documentacion = $this->db->select('*')->from('documentacion')->where('idSolicitud', $certificadoExistencia->idSolicitud)->get()->row();
					$this->db->where('id_tipoDocumentacion', $documentacion->id_tipoDocumentacion);
					if ($this->db->delete('documentacion')) {
						$this->db->where('id_certificadoExistencia', $certificadoExistencia->id_certificadoExistencia);
						if ($this->db->delete('certificadoExistencia')) {
							echo json_encode(array('url' => "panel", 'msg' => "Se eliminaron los datos del certificado existencia."));
						}
						else {
							echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos del certificado existencia."));
						}
					}
					else {
						echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos de la documentación legal."));
					}
					break;
				case 2.2:
					$registroEducativo = $this->db->select('*')->from('registroEducativoProgramas')->where('id_registroEducativoPro', $this->input->post('id'))->get()->row();
					$documentacion = $this->db->select('*')->from('documentacion')->where('idSolicitud', $registroEducativo->idSolicitud)->get()->row();
					$this->db->where('id_tipoDocumentacion', $documentacion->id_tipoDocumentacion);
					if ($this->db->delete('documentacion')) {
						$this->db->where('id_registroEducativoPro', $registroEducativo->id_registroEducativoPro);
						if ($this->db->delete('registroEducativoProgramas')) {
							echo json_encode(array('url' => "panel", 'msg' => "Se eliminaron los datos del registro educativo."));
						}
						else {
							echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos del registro educativo."));
						}
					}
					else {
						echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos de la documentación legal."));
					}
					break;
				default:
			}
		}
		else {
			echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los archivos, vuelve a intentar o comunicate con el administrador."));
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
	public function eliminarDatosEnLinea()
	{
		$archivo = $this->db->select('*')->from('archivos')->where('id_registro', $this->input->post('id'))->get()->row();
		$this->db->where('id_archivo', $archivo->id_archivo);
		if($this->db->delete('archivos')){
			unlink('uploads/instructivoEnLinea/' . $archivo->nombre);
			$this->db->where('id', $this->input->post('id'));
			if ($this->db->delete('datosEnLinea')) {
				echo json_encode(array('url' => "panel", 'msg' => "Se eliminaron los datos de la herramienta."));
			}
			else {
				echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos de la herramienta."));
			}
		}
	}
	public function eliminarDatosProgramas()
	{
		$programa = $this->db->select('*')->from('datosProgramas')->where('id', $this->input->post('id'))->get()->row();
		$this->db->where('id', $programa->id);
		if ($this->db->delete('datosProgramas')) {
			echo json_encode(array('url' => "panel", 'msg' => "Se eliminaron los datos de aceptación del programa: " . $programa->nombrePrograma, 'status' => 1));
		}
		else {
			echo json_encode(array('url' => "panel", 'msg' => "No se eliminaron los datos de aceptación del programa: " . $programa->nombrePrograma, 'status' => 2));
		}

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
	public function cargar_docentes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		return $docentes;
	}
	public function numeroRevisiones($idSolicitud)
	{
		$revisiones = $this->db->select("numeroRevisiones")->from("solicitudes")->where("idSolicitud", $idSolicitud)->get()->row();
		$numeroRevisiones = $revisiones->numeroRevisiones;
		return $numeroRevisiones;
	}
	public function fechaUltimaRevision($idSolicitud)
	{
		$fecha = $this->db->select("fechaUltimaRevision")->from("solicitudes")->where("idSolicitud", $idSolicitud)->get()->row();
		$fechaUltimaRevision = $fecha->fechaUltimaRevision;
		return $fechaUltimaRevision;
	}
	public function cargarSolicitudes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$solicitudes = $this->db->select("*")->from("solicitudes")->join('tipoSolicitud', "tipoSolicitud.idSolicitud = solicitudes.idSolicitud")->join('estadoOrganizaciones', "estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud")->where('solicitudes.organizaciones_id_organizacion', $organizacion->id_organizacion)->get()->result();
		return $solicitudes;
	}
	public function cargarSolicitud($idSolicitud)
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$solicitud = $this->db->select("*")->from("solicitudes")->join('tipoSolicitud', "tipoSolicitud.idSolicitud = solicitudes.idSolicitud")->join('estadoOrganizaciones', "estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud")->where("solicitudes.idSolicitud", $idSolicitud)->get()->row();
		return $solicitud;
	}
	// Cargar tipo solicitud
	public function cargarTipoSolicitud($idSolicitud)
	{
		$tipoSolicitud = $this->db->select("tipoSolicitud")->from("tipoSolicitud")->where("idSolicitud", $idSolicitud)->get()->row();
		$tipoSolicitudBD = $tipoSolicitud->tipoSolicitud;
		return $tipoSolicitudBD;
	}
	// Cargar motivo solicitud
	public function cargarMotivoSolicitud($idSolicitud)
	{
		$motivoSolicitud = $this->db->select("motivoSolicitud")->from("tipoSolicitud")->where("idSolicitud", $idSolicitud)->get()->row();
		$motivoSolicitudBD = $motivoSolicitud->motivoSolicitud;
		return $motivoSolicitudBD;
	}
	// Cargar motivos solicitud

	// Cargar modalidad solicitud
	public function cargarModalidadSolicitud($idSolicitud)
	{
		$modalidadSolicitud = $this->db->select("modalidadSolicitud")->from("tipoSolicitud")->where("idSolicitud", $idSolicitud)->get()->row();
		$modalidadSolicitudBD = $modalidadSolicitud->modalidadSolicitud;
		return $modalidadSolicitudBD;
	}
	public function cargarTiposCursoInforme()
	{
		$tiposCursoInformes = $this->db->select("*")->from("tiposCursoInformes")->get()->result();
		return $tiposCursoInformes;
	}

	// Cargar estado solicitud
	public function estadoOrganizaciones($idSolicitud)
	{
		$estado = $this->db->select("*")->from("estadoOrganizaciones")->where("idSolicitud", $idSolicitud)->get()->row();
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

	// Verificar Solicitud
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
	// Formulario 3
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
				'organizaciones_id_organizacion' => $id_organizacion,
				'idSolicitud' => $this->input->post('idSolicitud')
			);
			$this->db->insert('antecedentesAcademicos', $data_antecedentesAcademicos);
			echo json_encode(array('msg' => "Se guardaron los Antecedentes Academicos."));
			$this->logs_sia->session_log('Formulario Antecedentes Academicos');
			$this->logs_sia->logQueries();
			//}
		} else {
			echo json_encode(array('msg' => "Verifique los datos ingresado, no son correctos."));
		}
		//}
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
	/** Guardar Archivo de Registro Educativo */
	public function guardarArchivoRegistro()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_formulario = 2;

		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $datos_organizacion->id_organizacion)->get()->row();


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
	/** Guardar Archivo de Certificado de Existencia*/
	public function guardarArchivoCertificadoExistencia()
	{
		//$this->form_validation->set_rules('tipoArchivo','','trim|required|min_length[3]|xss_clean');
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$name_random = random(10);
		$size = 100000000;

		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_formulario = 2;
		$archivos = $this->db->select('*')->from('archivos')->where('organizaciones_id_organizacion', $datos_organizacion->id_organizacion)->get()->row();


		if ($tipoArchivo == "certifcadoExistencia") {
			$ruta = 'uploads/certifcadoExistencia';
			$mensaje = "Se guardo el " . $append_name;
		}

		$nombre_imagen =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($nombre_imagen, PATHINFO_EXTENSION);

		$data_update = array(
			'tipo' => $tipoArchivo,
			'nombre' => $nombre_imagen,
			'id_formulario' => $id_formulario,
			'organizaciones_id_organizacion' => $datos_organizacion->id_organizacion
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
			echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envío el correo."));
		}
	}
	public function cargar_informacionModal()
	{
		$informacionModal = $this->db->select("valor")->from("opciones")->where("nombre", "informacionModal")->get()->row()->valor;
		return $informacionModal;
	}
	// TODO: Ver Documentos
	public function verDocumento (){
		$archivo = $this->db->select('*')->from('archivos')->where('id_registro', $this->input->post('id'))->get()->row();
		switch($this->input->post('formulario')){
			case 8:
				$file = base_url()."uploads/instructivoEnLinea" . "/" . $archivo->nombre;
				echo json_encode(array('file' => $file));
				break;
			case 2.1:
				$file = base_url()."uploads/certificadoExistencia" . "/" . $archivo->nombre;
				echo json_encode(array('file' => $file));
				break;
			case 2.2:
				$file = base_url()."uploads/registrosEducativos" . "/" . $archivo->nombre;
				echo json_encode(array('file' => $file));
				break;
			default:
		}
	}
}
// Depurar errores
function var_dump_pre($mixed = null) {
  echo '<pre>';
  	var_dump($mixed);
  echo '</pre>';
  return null;
}
