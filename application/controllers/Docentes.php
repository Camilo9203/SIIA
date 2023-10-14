
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Docentes extends CI_Controller
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
		//verify_session_admin();
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
			'docentes' => $this->cargar_docentes(),
		);
		return $data;
	}
	/** Vista Inicial */
	public function index()
	{
		$data = $this->datosSession();
		$data['dataInformacionGeneral'] = $this->cargarDatos_informacion_general();
		$data['title'] = 'Panel Principal - Facilitadores';
		$data['activeLink'] = 'facilitadores';
		$this->load->view('include/header', $data);
		$this->load->view('paneles/docentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	/** Añadir nuevo docente */
	public function anadirNuevoDocente()
	{
		$organizacion = $this->datosSession()['data_organizacion'];
		$data_docentes = array(
			'primerNombreDocente' => $this->input->post("primer_nombre"),
			'segundoNombreDocente' => $this->input->post("segundo_nombre"),
			'primerApellidoDocente' => $this->input->post("primer_apellido"),
			'segundoApellidoDocente' => $this->input->post("segundo_apellido"),
			'numCedulaCiudadaniaDocente' => $this->input->post("cedula"),
			'profesion' => $this->input->post("profesion"),
			'horaCapacitacion' => $this->input->post("horas"),
			'valido' => 0,
			'organizaciones_id_organizacion' => $organizacion->id_organizacion
		);
		if($this->db->insert('docentes', $data_docentes)) {
			echo json_encode(array('url' => "panel", 'msg' => "Información de docente guardada exitosamente."));
		};
	}
	/** Actializar docente */
	public function actualizarDocente()
	{
		// Traer datos organanzación, se captura usuario id y se trae organización que pertenece al id del usuario.
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// ID organización & Nombre de la organización
		$id_organizacion = $datos_organizacion->id_organizacion;
		$nombreOrganizacion = $datos_organizacion->nombreOrganizacion;
		// ID docente desde post y solicitud
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
			'primerApellidoDocente' => $this->input->post("primer_apellido_doc"),
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
			// Solo actualización como log
			$this->logs_sia->session_log('Docentes Actualizados');
			// Si se marca actualizar con envio de solicitud
			if ($solicitud == "Si") {
				// Se enviara notificación en caso de no estar aprobado el docente, adicional correo eléctronico en caso de no estar asignado a evaluador
				if ($informacionDocente->valido == "0") {
					// Solo envia notificación si no esta aprobado
					$this->notif_sia->notification('Docentes', 'admin', $nombreOrganizacion);
					// Solo envia correo si no esta asignado
					if ($asignado != NULL || $asignado == "No") {
						$this->envilo_mailadmin("actualizacion", "2", $numero_cedula_doc);
					}
				}
			}
			else {
				echo json_encode(array("msg" => "Docente " . $data_update['primerNombreDocente'] . " " . $data_update['primerApellidoDocente'] . " Actualizado."));
			}
		}
	}
	/** Eliminar docente */
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
			echo json_encode(array("msg" => "Docente eliminado de su organización."));
		}
	}
	/** Guardar archivo HV docente */
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
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo.", "status" => 0));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF.", "status" => 0));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)", "status" => 0));
		} else if ($this->db->insert('archivosDocente', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje, "status" => 1));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s)."));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
	/** Guardar archivo titulo docente */
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
			echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo.", "status" => 0));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF.", "status" => 0));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)", "status" => 0));
		} else if ($this->db->insert('archivosDocente', $data_update)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
				echo json_encode(array('url' => "", 'msg' => $mensaje, "status" => 1));
				//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){
			} else {
				echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s).", "status" => 0));
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
	/** Guardar archivo certificado ES docente */
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
		if ($horas < 40) {
			echo json_encode(array('url' => "", 'msg' => "El certificado debe tener mínimo 40 horas."));
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
				echo json_encode(array('url' => "", 'msg' => "Hubo un error al actualizar, intente de nuevo.", "status" => 0));
			} else if ($_FILES['file']['size'] > $size) {
				echo json_encode(array('url' => "", 'msg' => "El tamaño supera las 10 Mb, intente con otro archivo PDF.", "status" => 0));
			} else if ($tipo_archivo != "pdf") {
				echo json_encode(array('url' => "", 'msg' => "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)", "status" => 0));
			} else if ($this->db->insert('archivosDocente', $data_update)) {
				if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . '/' . $nombre_imagen)) {
					echo json_encode(array('url' => "", 'msg' => $mensaje, "status" => 1));
					//$this->logs_sia->session_log('Actualizacion de Imagen / Logo');){
				} else {
					echo json_encode(array('url' => "", 'msg' => "No se guardo el archivo(s).", "status" => 0));
				}
			}
		}

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
	/** Eliminar archivo docente */
	public function eliminarArchivoDocente()
	{
		$tipo = $this->input->post('tipo');
		$nombre = $this->input->post('nombre');

		if ($tipo == "docenteHojaVida") {
			unlink('uploads/docentes/hojasVida/' . $nombre);
			$msg = "Se elimino el archivo de tipo hoja de vida con éxito";
		}
		if ($tipo == "docenteTitulo") {
			unlink('uploads/docentes/titulos/' . $nombre);
			$msg = "Se elimino el archivo de tipo titulo profesional con éxito";
		}
		if ($tipo == "docenteCertificados") {
			unlink('uploads/docentes/certificados/' . $nombre);
			$msg = "Se elimino el archivo de tipo certificado experiencia con éxito";
		}
		if ($tipo == "docenteCertificadosEconomia") {
			unlink('uploads/docentes/certificadosEconomia/' . $nombre);
			$msg = "Se elimino el archivo de tipo certificado economía solidaria con éxito";
		}

		$this->db->where('id_archivosDocente', $this->input->post('id_archivoDocente'))->where('docentes_id_docente', $this->input->post('id_docente'));
		if ($this->db->delete('archivosDocente')) {
			echo json_encode(array('url' => "", 'msg' => $msg));
		}
	}
	/** Cargar Información Docente Organización */
	public function cargar_docentes()
	{
		$organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $this->session->userdata('usuario_id'))->get()->row();
		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->result();
		return $docentes;
	}
	/** Cargar archivos Docente Organización */
	public function cargarDatosArchivosDocente()
	{
		$id_docente = $this->input->post('id_docente');
		$data_archivos = $this->db->select("*")->from("archivosDocente")->where('docentes_id_docente', $id_docente)->get()->result();
		echo json_encode($data_archivos);
	}
	/** Cargar Información Docente Organización */
	public function cargarDocentesAdmin()
	{
		$docentes = $this->db->select("*")->from("organizaciones")->join("docentes", 'docentes.organizaciones_id_organizacion = organizaciones.id_organizacion')->get()->result();
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
	public function cargarDatos_informacion_general()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $datos_formulario;
	}
	public function panelDocentes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / Facilitadores / Panel';
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/docentes/panelDocentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// TODO: Código nuevo para la asignación de solicitudes de actulización de docentes.
	public function asignarDocentes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / Facilitadores / Asignar';
		$data['docentes'] = $this->cargarDocentesAdmin();
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/docentes/asignarDocentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	// TODO: Código nuevo para la asignación de solicitudes de actulización de docentes.
	public function evaluarDocentes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal / Administrador / Facilitadores / Evaluar';
		$data['docentes'] = $this->cargarDocentesAdmin();
		$this->load->view('include/header', $data);
		$this->load->view('admin/organizaciones/docentes/evaluarDocentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
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
