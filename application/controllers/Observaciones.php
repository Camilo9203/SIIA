<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Observaciones extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('ObservacionesModel');
	}
	// Traer datos estadisticos
	public function index()
	{
//		$data = array(
//
//			'acreditadas' => $this->EstadisticasModel->organizacionesAcreditadas(),
//			'cursoBasico' => $this->EstadisticasModel->organizacionesBasico(),
//			'avaladas' => $this->EstadisticasModel->organizacionesAvaladas(),
//			'modalidadVirtual' => $this->EstadisticasModel->organizacionesVirtual(),
//
//		);
//		// Json datos estadisticos
//		$this->output->set_header('Content-Type: application/json; charset=utf-8');
//		echo json_encode($data, JSON_UNESCAPED_UNICODE);
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

	public function cambiarEstadoSolicitud()
	{
		$idOrganizacion = $this->input->post('id_organizacion');
		$idSolicitud = $this->input->post('idSolicitud');

		$id_usuario = $this->db->select("usuarios_id_usuario")->from("organizaciones")->where("id_organizacion", $idOrganizacion)->get()->row()->usuarios_id_usuario;
		$nombreOrganizacion = $this->db->select("nombreOrganizacion")->from("organizaciones")->where("id_organizacion", $idOrganizacion)->get()->row()->nombreOrganizacion;
		$nombre_usuario = $this->db->select("usuario")->from("usuarios")->where("id_usuario", $id_usuario)->get()->row()->usuario;

		$numero = $this->db->select("numeroRevisiones")->from("solicitudes")->where("idSolicitud", $this->input->post('idSolicitud'))->get()->row()->numeroRevisiones;
		$data_update = array(
			'numeroRevisiones' => ($numero + 1),
			'fechaUltimaRevision' =>  date('Y/m/d H:i:s')
		);

		$estado = $this->db->select("nombre")->from("estadoOrganizaciones")->where("idSolicitud",  $idSolicitud)->get()->row()->nombre;

		if ($estado == "En Observaciones") {
			$this->db->where('idSolicitud', $idSolicitud);
			if ($this->db->update('solicitudes', $data_update)) {
				echo json_encode(array('url' => "", 'msg' => "Se cambiaron las observaciones."));
				$this->notif_sia->notification('OBSERVACIONES', $nombre_usuario, $nombreOrganizacion);
				$this->envio_mail("obs", $idOrganizacion, 1, "");
				$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' cambio el estado de la organización id: ' . $idOrganizacion . '.');
			}
		}
		else {
			$this->db->where('idSolicitud', $idSolicitud);
			if ($this->db->update('solicitudes', $data_update)) {
				$data_estado = array(
					'nombre' => "En Observaciones",
					'fecha' => date('Y/m/d H:i:s'),
					'estadoAnterior' => "Finalizado",
					'organizaciones_id_organizacion' => $idOrganizacion
				);
				$this->db->where('idSolicitud', $idSolicitud);
				if ($this->db->update('estadoOrganizaciones', $data_estado)) {
					echo json_encode(array('url' => "", 'msg' => "Se cambio de estado la organización y se añadieron las observaciones."));
					$this->envio_mail("obs", $idOrganizacion, 1, "");
					$this->notif_sia->notification('OBSERVACIONES', $nombre_usuario, $nombreOrganizacion);
					$this->logs_sia->session_log('Administrador:' . $this->session->userdata('nombre_usuario') . ' cambio el estado de la organizacion id: ' . $idOrganizacion . '.');
				}
			}
		}
	}

	/**
	Funcion para enviar un correo electronico.
	$this->envio_mail("obs", $id_organizacion, 1);
	 **/
	function envio_mail($type, $id_organizacion, $prioridad, $adj)
	{
		$fromSIA = "Unidad Administrativa Especial de Organizaciones Solidarias UAEOS - Aplicación SIIA.";

		$to_correo = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row();
		$estadoOrganizaciones = $this->db->select("*")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$est = $estadoOrganizaciones->nombre;

		switch ($type) {
			case 'obs':
				$asunto = "Observaciones";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que se realizó la revisión de su solicitud de acreditación. Para verificar la totalidad de los requisitos establecidos en la normatividad vigente es necesario complementar la información presentada. Le invitamos a ingresar al aplicativo SIIA, donde encontrará las observaciones respectivas en cada parte del formulario y desarrollar lo indicado en cada una de ellas. Tenga presente que usted cuenta con un plazo máximo de cinco (5) días hábiles para realizar los ajustes sugeridos y enviar nuevamente la información. De lo contrario su solicitud será archivada aplicando lo establecido en el numeral 4 del artículo 5 de la Resolución 110 de 2016.";
				break;
			case 'plan':
				$asunto = "Plan de mejoramiento";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ", se le creo un plan de mejora el cual debe completar según las fechas acordadas por la persona que le hizo la evaluación.";
				break;
			case 'docentes':
				$asunto = "Docentes";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que se ha realizado la revisión de las hojas de vida presentadas, verificando los requisitos establecidos en el numeral 6 del artículo 4 de la resolución 110 de 2016 y se  actualizó la relación de facilitadores de la entidad acreditada. Le recomendamos revisar este listado donde podrá identificar las hojas de vida aprobadas y aquellas que están pendientes por aprobación dado que no cumplen con algún requisito. Favor verificar en el aplicativo las observaciones  e ingresar la información solicitada en cada caso para proceder a aprobarlas.";
				break;
			case 'estado':
				$asunto = "Cambio de estado en el SIIA";
				if ($est == "Acreditado") {
					$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que se realizó la revisión de su solicitud de acreditación y se pudo constatar el cumplimiento de los establecidos en la normatividad vigente. Se procederá a emitir el respectivo acto resolutorio en los próximos 10 días hábiles. Una vez se cuente con la resolución donde se otorga la acreditación se le informará para realizar el respectivo procedimiento de notificación. Organizaciones Solidarias le recuerda la entidad se acreditó presentando la documentación en el Sistema de Información de Acreditación SIA. Es necesario que se realice la migración de la información al SIIA para facilitar el trámite de renovación de la acreditación. ";
				} else if ($est == "Negada") {
					$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Organizaciones Solidarias le informa que la entidad solicitante  no   cumple con la totalidad de los requisitos establecidos en el artículo 1 de la Resolución 332 de 2017. Por lo anterior, la revisión de la  solicitud de acreditación presentada no es procedente de evaluación por parte de la Unidad. De mantenerse el  interés por la acreditación es necesario que se reúna la documentación requerida en el artículo 4 de la Resolución 110 de 2016  y se presente una nueva solicitud de acreditación.";
				}
				break;
			case 'resolucion':
				$asunto = "Resolución";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Teniendo en cuenta lo establecido en el código de procedimiento administrativo en su artículo 56, referente a la  'Notificación Electrónica', que  prescribe: 'Las autoridades podrán notificar sus actos administrativos a través de medios electrónicos, siempre que el administrado haya aceptado este medio de notificación…' (…) 'La notificación quedará surtida a partir de la fecha y hora en que el administrado accede al acto administrativo, fecha y hora que deberá certificar la administración'. La notificación queda surtida a partir del momento en que usted, envié respuesta aceptando los términos de la resolución. En caso de ser necesario usted tiene 10 días hábiles para presentar recursos de reposición ante la Unidad Administrativa. Para que la diligencia de notificación concluya plenamente es necesario contar con una respuesta a este mensaje. puede dar click aquí <a href='" . base_url() . "uploads/resoluciones/" . $adj . "' target='_blank'>Ver resolución</a>. Organizaciones Solidarias le recuerda la entidad se acreditó presentando la documentación en el Sistema de Información de Acreditación SIA. Es necesario que se realice la migración de la información al SIIA para facilitar el trámite de renovación de la acreditación. ";
				$this->email->cc('jcuy@orgsolidarias.gov.co');
				break;
			case 'resolucionVieja':
				$asunto = "Resolución";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ": Nos encontramos adelantado la actualización del listado de entidades acreditadas por medio del Sistema de Información de Acreditación SIIA. En este proceso ubicamos la resolución de acreditación vigente para su entidad la cual se ingresó al SIIA, para facilitar el acceso a esta documentación. Si desea consultar la resolución de click aquí <a href='" . base_url() . "uploads/resoluciones/" . $adj . "' target='_blank'>Ver resolución</a>. \n Por otra parte le recordamos dar cumplimiento a lo establecido en la circular 001 de 2018, en lo relacionado con la actualización de información de contacto de la entidad (Formulario 1) para poder ingresarla a este listado. Lo anterior se realiza ingresando al SIIA con su usuario y contraseña. Presionando el botón 'Crear, Actualizar solicitud'.";
				$this->email->cc('jcuy@orgsolidarias.gov.co');
				break;
			case 'camara':
				$asunto = "Cámara de comercio";
				$mensaje = "Organización " . $to_correo->nombreOrganizacion . ", su cámara ha sido actualizada, por favor verifique su perfil en la aplicación SIIA o puede la puede mirar dando click aqui <a href='" . base_url() . "uploads/camaraComercio/" . $adj . "' target='_blank'>Ver cámara</a>.";
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
		switch ($prioridad) {
			case 1:
				$num_prioridad = 1;
				break;
			case 2:
				$num_prioridad = 2;
				break;
			case 3:
				$num_prioridad = 3;
				break;
			default:
				$num_prioridad = 3;
				break;
		}

		$this->email->from(CORREO_SIA, "Acreditaciones");
		$this->email->to($to_correo->direccionCorreoElectronicoOrganizacion);
		$this->email->subject('SIIA - : ' . $asunto);
		$this->email->set_priority($num_prioridad);

		$data_msg['mensaje'] = $mensaje;

		$email_view = $this->load->view('email/contacto', $data_msg, true);

		$this->email->message($email_view);

		if ($this->email->send()) {
			// Do nothing.
		} else {
			echo json_encode(array('url' => "login", 'msg' => "Lo sentimos, hubo un error y no se envio el correo."));
		}
	}
	// Eliminar Solicitud
	public function eliminarObservacion()
	{
		$this->db->where('id_observacion', $this->input->post('idObservacion'));
		$this->db->delete('observaciones');
		echo json_encode(array('url' => "panelAdmin", 'msg' => "Se elimino la observación."));
	}
}
function var_dump_pre($mixed = null) {
	echo '<pre>';
	var_dump($mixed);
	echo '</pre>';
	return null;
}
