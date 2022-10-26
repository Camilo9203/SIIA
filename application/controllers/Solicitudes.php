<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Solicitudes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DocentesModel');
		$this->load->model('AdminModel');
	}
	/** Datos Iniciales */
	public function datosSession()
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
			'administradores' => $this->AdminModel->cargarAdministradores(),
			'data_organizacion' => $this->db->select('*')->from('organizaciones')->where('usuarios_id_usuario', $this->session->userdata('usuario_id'))->get()->row(),
			'solicitudes' => $this->cargar_solicitudes(),
			'dataInformacionGeneral' => $this->cargarDatos_informacion_general(),
		);
		return $data;
	}
	/** Vista Inicial */
	public function index()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Solicitudes';
		$data['activeLink'] = 'solicitudes';
		$this->load->view('include/header/main', $data);
		$this->load->view('usuario/paginas/solicitudes', $data);
		$this->load->view('include/footer/main', $data);
		$this->logs_sia->logs('PLACE_USER');
	}


	/** Guardar datos **/
	// Tipo solicitud
	public function guardar_tipoSolicitud()
	{
		if ($this->input->post()) {
			$usuario_id = $this->session->userdata('usuario_id');
			$organizacion = $this->db->select('*')->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
			$nombre_org =  $organizacion->nombreOrganizacion;
			$idSolicitud = date('YmdHis') . $nombre_org[3] . random(2);
			$estado = $this->estadoOrganizacion();
			$solicitudes = $this->cargar_solicitudes();
			$numeroSolicitudes = count($solicitudes);
			if($numeroSolicitudes > 0) {
				if($estado == "Acreditado") {
					$tipoSolicitud = "Renovación de Acreditación";
				}
				else {
					$tipoSolicitud = 'Solicitud Nueva';
				}
			}
			else {
				$tipoSolicitud = 'Acreditación Primera vez';
			}
			$data_solicitud = array(
				'numeroSolicitudes' => $numeroSolicitudes += 1,
				'fecha' =>  date('Y/m/d H:i:s'),
				'idSolicitud' => $idSolicitud,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
			);
			$data_tipoSolicitud = array(
				'tipoSolicitud' =>$tipoSolicitud,
				'motivoSolicitud' => $this->input->post('motivo_solicitud'),
				'modalidadSolicitud' => $this->input->post('modalidad_solicitud'),
				'idSolicitud' => $idSolicitud,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				'motivosSolicitud' => json_encode($this->input->post('motivos_solicitud')),
				'modalidadesSolicitud' => json_encode($this->input->post('modalidades_solicitud'))
			);
			$data_estado = array(
				'nombre' => "En Proceso",
				'fecha' => date('Y/m/d H:i:s'),
				'estadoAnterior' => $estado,
				'tipoSolicitudAcreditado' => $tipoSolicitud,
				'motivoSolicitudAcreditado' => $this->input->post('motivo_solicitud'),
				'modalidadSolicitudAcreditado' => $this->input->post('modalidad_solicitud'),
				'idSolicitudAcreditado' => $idSolicitud,
				'organizaciones_id_organizacion' => $organizacion->id_organizacion,
				'idSolicitud' => $idSolicitud,

			);
			if($this->db->insert('solicitudes', $data_solicitud)) {
				if($this->db->insert('tipoSolicitud', $data_tipoSolicitud)) {
					if($this->db->insert('estadoOrganizaciones', $data_estado)) {
						echo json_encode(array('url' => "panel", 'msg' => "Se creo nueva solicitud.", "est" => $data_tipoSolicitud['idSolicitud']));
						$this->envio_mailcontacto("inicia", 2);
						$this->logs_sia->session_log('Formulario Motivo Solicitud - Tipo Solicitud: ' . '. Motivo Solicitud: ' . $this->input->post('motivo_solicitud') . '. Modalidad Solicitud: ' . $this->input->post('modalidad_solicitud') . '. ID: ' . $data_tipoSolicitud['idSolicitud'] . '. Fecha: ' . date('Y/m/d') . '.');
						$this->logs_sia->logQueries();
					}
					else {
						echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, no se guardo en base de datos el estado de la solicitud."));
					}
				}
				else {
					echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, no se guardo en base de datos el tipo de la solicitud."));
				}
			}
			else {
				echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, no se guardo en base de datos la solicitud."));
			}
		}
	}
	// Cargar solicitudes
	public function cargar_solicitudes()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$solicitudes = $this->db->select("*")->from("solicitudes")->join('tipoSolicitud', "tipoSolicitud.idSolicitud = solicitudes.idSolicitud")->join('estadoOrganizaciones', "estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud")->where('solicitudes.organizaciones_id_organizacion', $organizacion->id_organizacion)->get()->result();
		return $solicitudes;
	}
	// Cargar estado solicitud
	public function estadoOrganizacion()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$estado = $organizacion->estado;
		return $estado;
	}
	// Cargar datos información general
	public function cargarDatos_informacion_general()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $datos_formulario;
	}
	/**  TODO: Enviar Correos a contacto de la solicitud */
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
	/** TODO: Notificaciones Email */
	function envilo_mailadmin($type, $prioridad, $docente)
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// $id_organizacion = $organizacion->id_organizacion;
		$docente = $this->db->select("*")->from("docentes")->where("numCedulaCiudadaniaDocente", $docente)->get()->row();
		switch ($type) {
			// Actualización de facilitadores
			case 'actualizacion':
				$asunto = "Actualización Docente";
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
		 * Datos para envío de Email al administrador
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
		$data_msg['mensaje'] = $mensaje;
		$email_view = $this->load->view('email/contacto', $data_msg, true);
		$this->email->message($email_view);
		if ($this->email->send()) {
			echo json_encode(array("msg" => "Docente " . $docente->primerNombreDocente . " " . $docente->primerApellidoDocente . " Actualizado. Se ha enviado correo para asignar solicitud"));
		} else {
			echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envío el correo."));
		}
	}
}
