<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Solicitudes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
		$this->load->model('EstadisticasModel');
		$this->load->model('SolicitudesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('AdministradoresModel');
		$this->load->model('OrganizacionesModel');
		$this->load->model('InformacionGeneralModel');
		$this->load->model('DocumentacionLegalModel');
		$this->load->model('AntecedentesAcademicosModel');
		$this->load->model('JornadasActualizacionModel');
		$this->load->model('ArchivosModel');
		$this->load->model('DatosAplicacionModel');
		$this->load->model('DatosEnLineaModel');
		$this->load->model('DatosProgramasModel');
		$this->load->model('ObservacionesModel');
		$this->load->model('ResolucionesModel');
	}
	/**
	 * Funciones Administrador
	 */
	// Datos de sesión administrador
	public function datosSesionAdmin()
	{
		verify_session_admin();
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'activeLink' => 'solicitudes',
			'departamentos' => $this->DepartamentosModel->getDepartamentos(),
		);
		return $data;
	}
	/**
	 * Solicitudes inscritas
	 */
	public function index()
	{
		$data = $this->dataSessionSuper();
		$data['title'] = 'Panel Principal / Organizaciones / Inscritas';
		$data['solicitudes'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesSinAsignar'];
		$this->load->view('include/header/main', $data);
		$this->load->view('super/pages/requests', $data);
		$this->load->view('include/footer/main');
		$this->logs_sia->logs('PLACE_USER');
	}	// Cargar solicitud
	public function cargarDatosSolicitud()
	{
		$solicitud = $this->SolicitudesModel->solicitudes($this->input->post('idSolicitud'));
		$resolucion = $this->ResolucionesModel->getResolucionSolicitud($this->input->post('idSolicitud'));
		echo json_encode(array('solicitud' => $solicitud, 'resolucion' => $resolucion));
	}
	// Cargar todos los datos de una solicitud
	public function cargarInformacionCompletaSolicitud()
	{
		$idSolicitud = $this->input->post('idSolicitud');
		$idOrganizacion = $this->input->post('id_organizacion');
		$solicitud = $this->SolicitudesModel->getAllInformacionSolicitud($idSolicitud, $idOrganizacion);
		echo $solicitud;
	}
	public function asignar()
	{
		$data = $this->datosSesionAdmin();
		$data['title'] = 'Panel Principal / Organizaciones / Asignar';
		$data['solicitudesSinAsignar'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesSinAsignar'];
		$data['solicitudesAsignadas'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesAsignadas'];
		$data['administradores'] = $this->AdministradoresModel->getAdministradores();
		$this->load->view('include/header', $data);
		$this->load->view('admin/solicitudes/asignar', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Asignar en proceso
	public function asignarEvaluadorSolicitud()
	{
		$organizacion = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $this->input->post('id_organizacion'))->get()->row();
		$evaluador = $this->db->select("*")->from("administradores")->where("usuario", $this->input->post('evaluadorAsignar'))->get()->row();
		$nombreEvaluador = $evaluador->primerNombreAdministrador . " " .  $evaluador->primerApellidoAdministrador;
		$data_asignar = array(
			'asignada' => $this->input->post('evaluadorAsignar'),
			'fechaAsignacion' => date('Y/m/d H:i:s'),
			'asignada_por' => $this->session->userdata('nombre_usuario'),
		);
		$this->db->where('idSolicitud', $this->input->post('idSolicitud'));
		if ($this->db->update('solicitudes', $data_asignar)) {
			$this->logs_sia->session_log('Se asigno ' . $organizacion->nombreOrganizacion . ' a ' . $nombreEvaluador . ' en la fecha ' . date("Y/m/d H:m:s") . '.');
			send_email_admin('asignarSolicitud', '2', $evaluador->direccionCorreoElectronico, null, $organizacion, $this->input->post('idSolicitud'));
			send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'asignarEvaluador', $organizacion, $evaluador, null, $this->input->post('idSolicitud'));
		}
	}
	// Solicitudes finalizadas
	public function finalizadas()
	{
		$data = $this->datosSesionAdmin();
		$data['title'] = 'Panel Principal / Administrador / En evaluación';
		$data['solicitudesAsignadas'] = $this->SolicitudesModel->getSolicitudesFinalizadas()[0]['solicitudesAsignadas'];
		$this->load->view('include/header', $data);
		$this->load->view('admin/solicitudes/finalizadas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Solicitudes en observaciones
	public function observaciones()
	{
		$data = $this->datosSesionAdmin();
		$data['title'] = 'Panel Principal / Administrador / En observaciones';
		$data['solicitudesEnObservaciones'] = $this->SolicitudesModel->getSolicitudesEnObservacion();
		$this->load->view('include/header', $data);
		$this->load->view('admin/solicitudes/observaciones', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Cargar información SolicitudesModel
	public function informacionSolicitud()
	{
		$data = $this->datosSesionAdmin();
		$data['title'] = 'Panel Principal - Administrador - Información';
		$data['idSolicitud'] = $this->input->get('idSolicitud');
		$data['idOrganizacion'] = $this->input->get('idOrganizacion');
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/informacion', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Solicitudes en proceso
	public function proceso()
	{
		$data = $this->datosSesionAdmin();
		$data['title'] = 'Panel Principal / Administrador / En proceso';
		$data['solicitudesEnProceso'] = $this->SolicitudesModel->getSolicitudesEnProceso();
		$this->load->view('include/header', $data);
		$this->load->view('admin/solicitudes/proceso', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/**
	 * Funciones Usuario
	 */
	// Datos inicio de sesión Usuario
	public function datosSesionUsuario()
	{
		verify_session();
		date_default_timezone_set("America/Bogota");
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
			'departamentos' => $this->DepartamentosModel->getDepartamentos(),
		);
		return $data;
	}
	// Crear solicitud
	public function crearSolicitud()
	{
		if (!$this->input->post('api'))
			$this->datosSesionUsuario();
		if ($this->input->post()) {
			$estado = 'En Proceso';
			// Comprobar si la solicitud se crea desde el super administrador o desde el usuario
			if ($this->input->post('nit_organizacion')):
				$organizacion = $this->OrganizacionesModel->getOrganizaciones($this->input->post('nit_organizacion'));
			else:
				$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($this->session->userdata('usuario_id'));
			endif;
			$solicitudes = $this->SolicitudesModel->getSolicitudesByOrganizacion($organizacion->id_organizacion);
			// Comprobar si la solicitud se crea desde el super administrador o desde el usuario
			if ($this->input->post('nit_organizacion')):
				$comprobarSolicitud = 'true';
			else:
				$comprobarSolicitud = $this->comprobarSolicitud($solicitudes, $this->input->post('motivos_solicitud'), $this->input->post('modalidades_solicitud'));
			endif;
			if ($comprobarSolicitud == 'true'):
				$idSolicitud = date('YmdHis') . $organizacion->nombreOrganizacion[3] . random(2);
				$numeroSolicitudes = count($solicitudes);
				// Comprobar si la solicitud se crea desde el super administrador o desde el usuario
				if ($this->input->post('tipo_solicitud')):
					$tipoSolicitud = $this->input->post('tipo_solicitud');
				else:
					// Comprobar y asignar estado a la solicitud
					if ($numeroSolicitudes > 0):
						if ($organizacion->estado == "Acreditado"):
							$estado = 'En Renovación';
							$tipoSolicitud = "Renovación de Acreditación";
						else:
							$tipoSolicitud = 'Solicitud Nueva';
						endif;
					else:
						$tipoSolicitud = 'Acreditación Primera vez';
					endif;
				endif;
				if ($this->input->post('fecha_creacion'))
					$fecha = date($this->input->post('fecha_creacion'));
				else
					$fecha = date('Y/m/d H:i:s');
				// Datos para crear solicitud
				$data_solicitud = array(
					'numeroSolicitudes' => $numeroSolicitudes += 1,
					'fechaCreacion' =>  $fecha,
					'idSolicitud' => $idSolicitud,
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				);
				$data_tipoSolicitud = array(
					'tipoSolicitud' => $tipoSolicitud,
					'motivoSolicitud' => $this->input->post('motivo_solicitud'),
					'modalidadSolicitud' => $this->input->post('modalidad_solicitud'),
					'idSolicitud' => $idSolicitud,
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
					'motivosSolicitud' => json_encode($this->input->post('motivos_solicitud')),
					'modalidadesSolicitud' => json_encode($this->input->post('modalidades_solicitud'))
				);
				$data_estado = array(
					'nombre' => $estado,
					'fechaUltimaActualizacion' => $fecha,
					'estadoAnterior' => $organizacion->estado,
					'tipoSolicitudAcreditado' => $tipoSolicitud,
					'motivoSolicitudAcreditado' => $this->input->post('motivo_solicitud'),
					'modalidadSolicitudAcreditado' => $this->input->post('modalidad_solicitud'),
					'idSolicitudAcreditado' => $idSolicitud,
					'organizaciones_id_organizacion' => $organizacion->id_organizacion,
					'idSolicitud' => $idSolicitud,

				);
				// Guardar datos iniciales de la solicitud
				if ($this->db->insert('solicitudes', $data_solicitud)):
					if ($this->db->insert('tipoSolicitud', $data_tipoSolicitud)):
						if ($this->db->insert('estadoOrganizaciones', $data_estado)):
							// Comprobar si lo hace el super
							if (!$this->input->post('nit_organizacion'))
								$this->logs_sia->session_log('Formulario Motivo Solicitud - Tipo Solicitud: ' . '. Motivo Solicitud: ' . $this->input->post('motivo_solicitud') . '. Modalidad Solicitud: ' . $this->input->post('modalidad_solicitud') . '. ID: ' . $idSolicitud . '. Fecha: ' . date('Y/m/d') . '.');
							$this->logs_sia->logQueries();
							send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'crearSolicitud', $organizacion, null, null, $idSolicitud);
						endif;
					endif;
				endif;
			else:
				echo json_encode(array('status' => 'error', 'title' => 'Datos no guardados', 'msg' => "Conflictos en la creación de la solicitud: <br><br><ul class='list-popup'>" . $comprobarSolicitud . "</ul><br>Debes modificar la creación actual. Si cuentas con solicitudes en estado de <strong> Observaciones </strong> o <strong>Finalizado</strong> puedes consultar el estado y/o eliminar las solicitudes en conflicto para continuar"));
			endif;
		}
	}
	// Comprobar solicitud a crear
	public function comprobarSolicitud($solicitudes, $motivosSolicitud, $modalidadesSolicitud)
	{
		$solicitudesFinalizadas = true;
		$motivo = true;
		$modalidad = true;
		$return = '';
		// Recorrer las solicitudes de la organización
		foreach ($solicitudes as $solicitud):
			// Comprobar que la solicitud no se encuentré acreditada, negada o archívada.
			if ($solicitud->nombre != 'Archivada'):
				if ($solicitud->nombre != 'Negada'):
					if ($solicitud->nombre != 'Revocada'):
						// Comprobar si la solicitud se encuentra en estado de observaciones o finalizado
						if ($solicitud->nombre == 'Finalizado' || $solicitud->nombre == 'En Observaciones'):
							$solicitudesFinalizadas = false;
							$return .= "<li>La solicitud con ID: <strong>" . $solicitud->idSolicitud .  "</strong> se escuentra en estado " . $solicitud->nombre . " <i class='fa fa-times spanRojo' aria-hidden='true'></i></li><br><br>";
						endif;
						if ($solicitud->nombre == 'Acreditado'):
							$return .= "<li>La solicitud con ID: <strong>" . $solicitud->idSolicitud .  "</strong> se escuentra en estado " . $solicitud->nombre . " <i class='fa fa-check spanVerde' aria-hidden='true'></i>Si esta habilitada la opción por favor de clic en renovar a esta solicitud.</li><br><br>";
						endif;
						// Capturas mótivos y modalidades de la solicitud
						$motivos = json_decode($solicitud->motivosSolicitud);
						$modalidades = json_decode($solicitud->modalidadesSolicitud);
						// Comprobar datos similares en la solicitud
						$compararMotivo = array_merge(array_intersect($motivos, $motivosSolicitud));
						$compararModalidad = array_merge(array_intersect($modalidades, $modalidadesSolicitud));
						if (!empty($compararMotivo)):
							$motivos = '';
							for ($i = 0; $i < count($compararMotivo); $i++):
								$motivos .= $this->SolicitudesModel->getMotivo($compararMotivo[$i]) . ', ';
							endfor;
							$motivos = substr($motivos, 0, -2);
							$motivo = false;
							$return .= "<li>La solicitud con ID: <strong> " . $solicitud->idSolicitud . " </strong>tiene los siguientes motivos identicos: " . $motivos . " <i class='fa fa-times spanRojo' aria-hidden='false'></i></li><br><br>";
						endif;
						if (!empty($compararModalidad)):
							$modalidades = '';
							for ($i = 0; $i < count($compararModalidad); $i++):
								$modalidades .= $this->SolicitudesModel->getModalidad($compararModalidad[$i]) . ', ';
							endfor;
							$modalidades = substr($modalidades, 0, -2);
							$modalidad = false;
							$return .= "<li>La solicitud con ID: <strong>" . $solicitud->idSolicitud . " </strong>tiene las siguientes modalidades: " . $modalidades . " <i class='fa fa-times spanRojo' aria-hidden='false'></i></li><br>";
						endif;
					endif;
				endif;
			endif;
		endforeach;
		if ($solicitudesFinalizadas == true && $motivo == true && $modalidad == true):
			return 'true';
		else:
			return $return;
		endif;
	}
	// Solicitud
	public function solicitud($idSolicitud)
	{
		$data = $this->datosSesionUsuario();
		$data['title'] = 'Solicitud: ' . $idSolicitud;
		$data['activeLink'] = 'solicitud';
		$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($data['usuario_id']);
		$data['organizacion'] = $organizacion;
		$data['solicitud'] = $this->SolicitudesModel->solicitudes($idSolicitud);
		$data['informacionGeneral'] = $this->InformacionGeneralModel->getInformacionGeneral($organizacion->id_organizacion);
		$data['documentacionLegal'] = $this->DocumentacionLegalModel->getDocumentacionLegal($idSolicitud);
		$data['antecedentesAcademicos'] = $this->AntecedentesAcademicosModel->getAntecedentesAcedemicos($idSolicitud);
		$data['jornadasActualizacion'] = $this->JornadasActualizacionModel->getJornadasActualizacion($idSolicitud);
		$data['archivoJornada'] = $this->ArchivosModel->getArchivos($organizacion->id_organizacion, 3);
		$data['aplicacion'] = $this->DatosAplicacionModel->getDatosAplicacion($idSolicitud);
		$data['datosEnLinea'] = $this->DatosEnLineaModel->getDatosEnLinea($idSolicitud);
		$data['datosProgramas'] = $this->DatosProgramasModel->getDatosProgramas($idSolicitud);
		$this->load->view('include/header', $data);
		$this->load->view('paneles/solicitud', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Enviar solicitud
	public function enviarSolicitud()
	{
		$this->datosSesionUsuario();
		$idSolicitud = $this->input->post('idSolicitud');
		$formularios = $this->verificarFormularios($idSolicitud);
		if (count($formularios) === 0) {
			$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($this->session->userdata('usuario_id'));
			$solicitud = $this->SolicitudesModel->solicitudes($idSolicitud);
			if ($solicitud->nombre  != 'Finalizado'):
				$updateEstado = array(
					'nombre' => "Finalizado",
					'fechaUltimaActualizacion' => date('Y/m/d H:i:s'),
					'estadoAnterior' => $solicitud->nombre,
					'fechaFinalizado' => date('Y/m/d H:i:s')
				);
			endif;
			if ($solicitud->nombre == 'En Observaciones'):
				$updateEstado = array(
					'nombre' => "Finalizado",
					'fechaUltimaActualizacion' => date('Y/m/d H:i:s'),
					'estadoAnterior' => $solicitud->nombre
				);
				send_email_admin('actualizacionSolicitud', 1, $this->AdministradoresModel->getEmail($solicitud->asignada), null, $organizacion, $solicitud->idSolicitud);
			endif;
			$this->db->where('idSolicitud', $idSolicitud);
			$this->db->update('estadoOrganizaciones', $updateEstado);
			if ($solicitud->asignada == "SIN ASIGNAR")
				send_email_admin('enviarSolicitd', 1, CORREO_COORDINADOR, null, $organizacion, $idSolicitud);
			send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'enviarSolicitd', $organizacion, null, null, $idSolicitud);
			$this->logs_sia->session_log('Finalizada la Solicitud ' . $idSolicitud);
			$this->notif_sia->notification('Finalizada', 'admin', $organizacion->nombreOrganizacion);
			$this->logs_sia->logQueries();
		} else {
			echo json_encode(
				array(
					'title' => 'Verifique su solicitud!',
					'status' => 'info',
					'msg' => '<p>Continue diligenciando los formularios, Solicitud: <strong>' .  $idSolicitud . '</strong></p>',
					'formularios' => $formularios,
					'solicitud' => $this->SolicitudesModel->solicitudes($idSolicitud),
					'motivos' => $this->cargarMotivosSolicitud($idSolicitud),
					'programas' => $this->DatosProgramasModel->getDatosProgramas($idSolicitud)
				)
			);
		}
	}
	//Cargar estado de la solicitud
	public function cargarEstadoSolicitud()
	{
		$idSolicitud = $this->input->post('solicitud');
		$solicitud = $this->SolicitudesModel->solicitudes($idSolicitud);
		$programas = $this->DatosProgramasModel->getDatosProgramas($idSolicitud);
		$motivos = $this->cargarMotivosSolicitud($idSolicitud);
		$observaciones = $this->ObservacionesModel->getObservaciones($idSolicitud);
		$formularios = $this->verificarFormularios($idSolicitud);
		switch ($solicitud->nombre) {
			case "En Proceso":
				if (count($formularios) === 0):
					$title = 'Solicitud verificada!';
					$icon = 'success';
					$msg = '<p>Solicitud: <strong>' .  $idSolicitud . '</strong> cuenta con los formularios diligenciados. <br><br>Por favor de clic en <strong>Finaliza Proceso</strong> para enviar la solicitud a la Unidad Solidaria. <br>Gracias!</p>';
				else:
					$title = 'Verifique su solicitud!';
					$icon = 'info';
					$msg = '<p>Continue diligenciando los formularios, Solicitud: <strong>' .  $idSolicitud . '</strong></p>';
				endif;
				echo json_encode(
					array(
						'title' => $title,
						'icon' => $icon,
						'msg' => $msg,
						'formularios' => $formularios,
						'solicitud' => $solicitud,
						'motivos' => $motivos,
						'programas' => $programas
					)
				);
				break;
			case "En Observaciones":
				if (count($formularios) === 0):
					$listaFormularios = '';
					if ($observaciones['formulario1'])
						$listaFormularios .= '<li>Formulario 1 información general.</li>';
					if ($observaciones['formulario2'])
						$listaFormularios .= '<li>Formulario 2 documentación legal.</li>';
					if ($observaciones['formulario3'])
						$listaFormularios .= '<li>Formulario 3 Jornadas de actualización.</li>';
					if ($observaciones['formulario4'])
						$listaFormularios .= '<li>Formulario 4 datos básicos programas.</li>';
					if ($observaciones['formulario5'])
						$listaFormularios .= '<li>Formulario 5 docentes.</li>';
					if ($observaciones['formulario6'])
						$listaFormularios .= '<li>Formulario 6 plataforma virtual.</li>';
					if ($observaciones['formulario7'])
						$listaFormularios .= '<li>Formulario 7 modalidad en línea.</li>';
					if ($listaFormularios != ''):
						$title = '¡Tramite verificado!';
						$icon = 'info';
						$msg = '<p>Solicitud: <strong>' .  $idSolicitud . '</strong> 
								<br><br>El evaluador realizó observaciones para los formularios: <br><br>
								<ul>' . $listaFormularios . '</ul>
								<br><br>Por favor, revise las observaciones y de clic en <strong>Actualizar</strong> la solicitud una vez realizados los ajustes y <strong>Finalice el proceso</strong>  <br><br>
								<br><br>Volverá a llegarle un mensaje con la finalización de la solicitud ajustada.
								<br><br>Si ya realizó los cambios y recibió un correo de finalización, por favor cierre este cuadro y espere una nueva confirmación
								<br><br>¡Gracias!</p>';
					else:
						$title = '¡Tramite verificado!';
						$icon = 'success';
						$msg = '<p>Solicitud: <strong>' .  $idSolicitud . '</strong>. 
								<br><br>El evaluador verificó los datos registrados en la solicitud y se cumplen los requisitos establecidos en el marco normativo del trámite.
								<br><br>Su trámite pasa a revisión por parte del área jurídica para emitir acto administrativo.
								<br><br>¡Gracias!</p>';
					endif;
				else:
					$title = 'Verifique su solicitud!';
					$icon = 'info';
					$msg = '<p>Continue diligenciando los formularios, Solicitud: <strong>' .  $idSolicitud . '</strong></p>';
				endif;
				echo json_encode(
					array(
						'title' => $title,
						'icon' => $icon,
						'msg' => $msg,
						'formularios' => $formularios,
						'solicitud' => $solicitud,
						'motivos' => $motivos,
						'programas' => $programas
					)
				);
				break;
				break;
			case "En Renovación":
				if (count($formularios) === 0):
					$title = 'Solicitud verificada!';
					$icon = 'success';
					$msg = '<p>Solicitud: <strong>' .  $idSolicitud . '</strong> cuenta con los formularios diligenciados. <br><br>Por favor de clic en <strong>Finaliza Proceso</strong> para enviar la solicitud a la Unidad Solidaria. <br>Gracias!</p>';
				else:
					$title = 'Verifique su solicitud!';
					$icon = 'info';
					$msg = '<p>Continue diligenciando los formularios, Solicitud: <strong>' .  $idSolicitud . '</strong></p>';
				endif;
				echo json_encode(
					array(
						'title' => $title,
						'icon' => $icon,
						'msg' => $msg,
						'formularios' => $formularios,
						'solicitud' => $solicitud,
						'motivos' => $motivos,
						'programas' => $programas
					)
				);
				break;
			default:
				break;
		}
	}
	// Cargar motivos de la solicitud para el estado
	public function cargarMotivosSolicitud($idSolicitud)
	{
		$motivosSolicitud = $this->db->select("motivosSolicitud")->from("tipoSolicitud")->where("idSolicitud", $idSolicitud)->get()->row()->motivosSolicitud;
		return json_decode($motivosSolicitud);
	}
	// Validad formularios de la solicitud para el estado
	public function verificarFormularios($idSolicitud)
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;

		$certificacionesForm = NULL;
		$lugar = NULL;
		$autoevaluacion = NULL;
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

		$tipoSolicitud = $this->db->select("*")->from("tipoSolicitud")->where("idSolicitud", $idSolicitud)->get()->row();
		$motivoSolicitud = json_decode($tipoSolicitud->motivosSolicitud);
		$modalidadSolicitud = $tipoSolicitud->modalidadSolicitud;

		$archivosBD = $this->db->select("*")->from("archivos")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		$strFormulario1 = '';
		/** Comprobar archivos en formularios */
		foreach ($archivosBD as $archivo) {
			$tipo = $archivo->tipo;
			$formulario = $archivo->id_formulario;
			switch ($formulario) {
				case 1:
					switch ($tipo) {
						case 'certificaciones':
							$icert += 1;
							if ($icert >= 3)
								$certificacionesForm = TRUE;
							break;
						case 'lugar':
							$lugar = TRUE;
							break;
						case 'autoevaluacion':
							$autoevaluacion = TRUE;
							break;
						case 'carta':
							$carta = TRUE;
							break;
						default:
							$certificacionesForm = FALSE;
							$lugar = FALSE;
							$carta = FALSE;
							$autoevaluacion = FALSE;
							break;
					}
					break;
				case 3:
					if ($tipo == "jornadaAct")
						$jornada = TRUE;
					break;
				case 6:
					if ($tipo == "materialDidacticoProgBasicos")
						$materialProgBasicos = TRUE;
					break;
				case 7:
					if ($tipo == "materialDidacticoAvalEconomia")
						$materialAvalEcon = TRUE;
					break;
				case 8:
					if ($tipo == "formatosEvalProgAvalar")
						$formatosEval = TRUE;
					if ($tipo == "materialDidacticoProgAvalar")
						$materialProgEval = TRUE;
					break;
				case 10:
					if ($tipo == "instructivoPlataforma" || $tipo == "observacionesPlataformaVirtual")
						$instructivo = TRUE;
					break;
				default:
					break;
			}
		}
		if ($certificacionesForm == FALSE)
			$strFormulario1 .= "<span class='upper'>Certificaciones </span><i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
		if ($carta == FALSE)
			$strFormulario1 .= "<span class='upper'>Carta de solicitud </span><i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
		if ($this->SolicitudesModel->solicitudes($idSolicitud)->nombre == 'En Renovación') {
			if ($autoevaluacion == FALSE)
				$strFormulario1 .= "<span class='upper'>Autoevaluación </span><i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
		} else {
			$autoevaluacion = TRUE;
		}
		/** Variables Formularios */
		$informacionGeneral = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$documentacion = $this->db->select("*")->from("documentacion")->where("idSolicitud", $idSolicitud)->get()->row();
		$registroEducativoProgramas = $this->db->select("*")->from("registroEducativoProgramas")->where("idSolicitud", $idSolicitud)->get()->row();
		$antecedentesAcademicos = $this->db->select("*")->from("antecedentesAcademicos")->where("idSolicitud", $idSolicitud)->get()->row();
		$jornadasActualizacion = $this->db->select("*")->from("jornadasActualizacion")->where("idSolicitud", $idSolicitud)->get()->row();
		$datosProgramas = $this->db->select("*")->from("datosProgramas")->where("idSolicitud", $idSolicitud)->get()->row();
		$aplicacion = $this->db->select("*")->from("datosAplicacion")->where("idSolicitud", $idSolicitud)->get()->row();
		$datosEnLinea = $this->db->select("*")->from("datosEnLinea")->where("idSolicitud", $idSolicitud)->get()->row();
		// Comprobación docentes
		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->result();
		$strDocentes = "";
		foreach ($docentes as $docente):
			$hoja = false;
			$titulo = false;
			$certificaciones = false;
			$certificacionesEco = false;
			$hojas = 0;
			$titulos = 0;
			$certEcos = 0;
			$certs = 0;
			$archivos = $this->cargarDatosArchivosDocentes($docente->id_docente);
			for ($i = 0; $i < count($archivos); $i++):
				$tipo = json_encode($archivos[$i]->tipo);
				if ($tipo == '"docenteHojaVida"'):
					$hojas += 1;
					if ($hojas >= 1):
						$hoja = true;
					endif;
				endif;
				if ($tipo == '"docenteTitulo"'):
					$titulos += 1;
					if ($titulos >= 1):
						$titulo = true;
					endif;
				endif;
				if ($tipo == '"docenteCertificadosEconomia"'):
					$certEcos += 1;
					if ($certEcos >= 1):
						$certificacionesEco = true;
					endif;
				endif;
				if ($tipo == '"docenteCertificados"'):
					$certs += 1;
					if ($certs >= 3):
						$certificaciones = true;
					endif;
				endif;
			endfor;
			if ($hoja == true && $titulo == true && $certificacionesEco == true && $certificaciones == true):
			else:
				// TODO: Mostrar que documentos faltan
				$strDocentes .= "Verificar la documentación para el docente: <span class='upper'>" . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . "</span>. <i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
			endif;
		endforeach;
		/**
		 * Comprobación Formularios
		 * @var  $formularios
		 */
		$formularios = array();
		$solicitud = $this->db->select('*')->from('solicitudes')->where("idSolicitud", $idSolicitud)->get()->row();
		$totalProgramas = $this->db->select('*')->from('datosProgramas')->where("idSolicitud", $idSolicitud)->get()->result();
		// Contar programas seleccionados por medio de campo motivos
		$cantProgramasSeleccionados = count(json_decode($tipoSolicitud->motivosSolicitud));
		// Asignar variable para la cantidad de programas actualmente registrados en la solicitud
		$cantProgramasAceptados = count($totalProgramas);
		// Comparar si la cantidad de motivos seleccionados conincide con la cantidad de programas aceptados en la solicitud.
		if ($cantProgramasSeleccionados == $cantProgramasAceptados) {
			$datosProgramasAceptados = 'TRUE';
		}
		/**
		 * Comprobar todos los formularios
		 */
		//if ($informacionGeneral == NULL || $certificacionesForm == NULL || $lugar == NULL || $carta == NULL) {
		if ($informacionGeneral == NULL || $certificacionesForm == NULL || $carta == NULL || $autoevaluacion == NULL) {
			array_push($formularios, "1. Falta el formulario de Informacion General.");
		}
		if ($documentacion == NULL) {
			array_push($formularios, "2. Falta el formulario de Documentacion Legal.");
		}
		if ($antecedentesAcademicos == NULL) {
			//array_push($formularios, "3. Falta el formulario de Antecedentes Academicos.");
		}
		if ($jornadasActualizacion == NULL || $jornada == NULL) {
			array_push($formularios, "3. Falta el formulario de Jornadas Actualización.");
		}
		if ($datosProgramasAceptados == NULL) {
			array_push($formularios, "4. Falta el formulario de Datos Basicos Programas.");
		}
		if ($docentes == NULL || count($docentes) < 3) {
			array_push($formularios, "5. Faltan facilitadores y/o archivos, deben ser tres (3) con sus respectivos documentos. <hr>");
		}
		if (($modalidadSolicitud == "Virtual" || $modalidadSolicitud == "Presencial, Virtual" || $modalidadSolicitud == "Presencial, Virtual, En Linea"  || $modalidadSolicitud == "Virtual, En Linea") && $aplicacion == NULL) {
			array_push($formularios, "6. Falta el formulario de Ingreso a la Plataforma Virtual.");
		}
		if (($modalidadSolicitud == "En Linea" || $modalidadSolicitud == "Presencial, En Linea" || $modalidadSolicitud == "Presencial, Virtual, En Linea"  || $modalidadSolicitud == "Virtual, En Linea") && $datosEnLinea == NULL) {
			array_push($formularios, "7. Falta el formulario de datos modalidad en linea.<hr>");
		}
		if (!empty($strFormulario1)) {
			array_push($formularios, "1. Formulario <strong>Información General</strong> | Documentos por cargar: <br><br><strong><small><i>" . $strFormulario1 . "</i></small></strong>");
		}
		if (!empty($strDocentes)) {
			array_push($formularios, "5. <strong>Facilitadores</strong> | Realice las siguientes acciones:<br><br><strong><small><i>" . $strDocentes . "</i></small></strong>");
		}
		return $formularios;
	}
	// Cargar datos archivos docentes
	public function cargarDatosArchivosDocentes($id)
	{
		$data_archivos = $this->db->select("*")->from("archivosDocente")->where('docentes_id_docente', $id)->get()->result();
		return $data_archivos;
	}
	// Eliminar Solicitud
	public function eliminarSolicitud()
	{
		// TODO: Eliminar archivos de la solicitud
		$this->db->where('idSolicitud', $this->input->post('idSolicitud'));
		$tables = array(
			'estadoOrganizaciones',
			'solicitudes',
			'tipoSolicitud',
			'documentacion',
			'certificadoExistencia',
			'registroEducativoProgramas',
			'jornadasActualizacion',
			'datosProgramas',
			'datosEnLinea',
			'datosAplicacion'
		);
		$this->db->delete($tables);
		$msg = 'Se elimino la solicitud: <strong>' . $this->input->post('idSolicitud') . '<strong>';
		echo json_encode(array('status' => "success", 'msg' => $msg));
	}
	// Estado de la solicitud
	public function estadoSolicitud($idSolicitud)
	{
		$data = $this->datosSesionUsuario();
		$data['title'] = 'Panel Principal - Estado de la Solicitud';
		$data['organizacion'] = $this->OrganizacionesModel->getOrganizacion($data['usuario_id']);
		$data['observaciones'] = $this->ObservacionesModel->getObservaciones($idSolicitud);
		$data['solicitud'] = $this->SolicitudesModel->solicitudes($idSolicitud);
		$this->load->view('include/header', $data);
		$this->load->view('paneles/estadoSolicitud', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// Actualizar estado de la solicitud
	public function actualizarEstadoSolicitud()
	{
		$organizacion = $this->OrganizacionesModel->getOrganizacion($this->input->post('idOrganizacion'));
		$estadoSolicitud = $this->input->post('estadoSolicitud');
		$idSolicitud = $this->input->post('idSolicitud');
		$solicitud = $this->SolicitudesModel->solicitudes($idSolicitud);
		$dataEstado = array(
			'nombre' => $estadoSolicitud,
			'fechaUltimaActualizacion' => date('Y/m/d H:i:s'),
			'estadoAnterior' => $solicitud->nombre,
			'idSolicitudAcreditado' => $idSolicitud,
		);
		if ($estadoSolicitud == $solicitud->nombre):
			echo json_encode(array('status' => 'warning', 'msg' => "Seleccione un estado diferente al actual."));
		elseif ($estadoSolicitud == "Acreditado"):
			$this->db->where('idSolicitud', $idSolicitud);
			if ($this->db->update('estadoOrganizaciones', $dataEstado)):
				$dataOrganizacion = array('estado' => $estadoSolicitud,);
				$this->db->where('id_organizacion', $organizacion->id_organizacion);
				if ($this->db->update('organizaciones', $dataOrganizacion))
					$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' actualizó el estado de la organización con id: ' . $organizacion->id_organizacion . ' y el estado: ' . $estadoSolicitud . '.');
			endif;
			send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'cambioEstadoSolicitud', $organizacion, null, null, $idSolicitud);
		else:
			$this->db->where('idSolicitud', $idSolicitud);
			if ($this->db->update('estadoOrganizaciones', $dataEstado))
				$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' actualizó el estado de la organización con id: ' . $organizacion->id_organizacion . ' y el estado: ' . $estadoSolicitud . '.');
			send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'cambioEstadoSolicitud', $organizacion, null, null, $idSolicitud);
		endif;
	}
	// Renovación solicitud
	public function renovarSolicitud()
	{
		if ($this->input->post()) {
			$solicitud = $this->SolicitudesModel->solicitudes($this->input->post('idSolicitud'));
			$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($this->session->userdata('usuario_id'));
			$idSolicitud = date('YmdHis') . $organizacion->nombreOrganizacion[3] . random(2);
			$data_solicitud = array(
				'numeroSolicitudes' => $solicitud->numeroSolicitudes += 1,
				'fechaCreacion' =>  date('Y/m/d H:i:s'),
				'idSolicitud' => $idSolicitud,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
			);
			$data_tipoSolicitud = array(
				'tipoSolicitud' => 'Renovación de Acreditación',
				'motivoSolicitud' => $solicitud->motivoSolicitud,
				'modalidadSolicitud' => $solicitud->modalidadSolicitud,
				'idSolicitud' => $idSolicitud,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				'motivosSolicitud' => $solicitud->motivosSolicitud,
				'modalidadesSolicitud' => $solicitud->modalidadesSolicitud
			);
			$data_estado = array(
				'nombre' => "En Renovación",
				'fechaUltimaActualizacion' => date('Y/m/d H:i:s'),
				'estadoAnterior' => $organizacion->estado,
				'tipoSolicitudAcreditado' => 'Renovación de Acreditación',
				'motivoSolicitudAcreditado' => $solicitud->motivoSolicitud,
				'modalidadSolicitudAcreditado' => $solicitud->modalidadSolicitud,
				'idSolicitudAcreditado' => $idSolicitud,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				'idSolicitud' => $idSolicitud,

			);
			$data_update = array(
				'nombre' => 'Vencida'
			);
			$this->db->where('idSolicitud', $this->input->post('idSolicitud'));
			if ($this->db->update('estadoOrganizaciones', $data_update)):
				// Guardar datos iniciales de la solicitud
				$this->db->where('idSolicitud', $idSolicitud);
				if ($this->db->insert('solicitudes', $data_solicitud)):
					if ($this->db->insert('tipoSolicitud', $data_tipoSolicitud)):
						if ($this->db->insert('estadoOrganizaciones', $data_estado)):
							$this->logs_sia->session_log('Creación de solicitud renovación' . '. Motivo Solicitud: ' . $solicitud->motivoSolicitud . '. Modalidad Solicitud: ' . $solicitud->modalidadSolicitud . '. ID: ' . $idSolicitud . '. Fecha: ' . date('Y/m/d H:i:s') . '.');
							$this->logs_sia->logQueries();
							send_email_user($organizacion->direccionCorreoElectronicoOrganizacion, 'crearSolicitud', $organizacion, null, null, $idSolicitud);
						endif;
					endif;
				endif;
			endif;
		}
	}
}
function var_dump_pre($mixed = null)
{
	echo '<pre>';
	var_dump($mixed);
	echo '</pre>';
	return null;
}
