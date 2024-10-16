<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InformeActividades extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welco7me
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
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
		$this->load->model('AdministradoresModel');
		$this->load->model('InformeActividadesModel');
		$this->load->model('OrganizacionesModel');
		$this->load->model('SolicitudesModel');
		$this->load->model('DocentesModel');
		$this->load->model('DepartamentosModel');
	}
	/**
	 * Datos sesión súper administrador
	 */
	public function dataSessionAdministrador() {
		date_default_timezone_set("America/Bogota");
		$data = array(
			'logged_in' => $this->session->userdata('logged_in'),
			'tipo_usuario' => $this->session->userdata('type_user'),
			'nivel' => $this->session->userdata('nivel'),
			'nombre_usuario' => $this->session->userdata('nombre_usuario'),
			'usuario_id' => $this->session->userdata('usuario_id'),
			'hora' => date("H:i", time()),
			'fecha' => date('Y/m/d'),
		);
		return $data;
	}
	public function index()
	{
		$data = $this->dataSessionAdministrador();
		$data['title'] = 'Panel Principal - Informe de Actividades';
		$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($data['usuario_id']);
		$data['organizaciones'] = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		$data['docentes'] = $this->DocentesModel->getDocentesValidos($organizacion->id_organizacion);
		$data['solicitudes'] = $this->SolicitudesModel->getSolicitudesAcreditadasOrganizacion($organizacion->id_organizacion);
		$data['informes'] = $this->InformeActividadesModel->getInformeActividades($organizacion->id_organizacion);
		$data['departamentos'] = $this->DepartamentosModel->getDepartamentos();
		$this->load->view('include/header', $data);
		$this->load->view('paneles/informe', $data);
		$this->load->view('include/footer', $data);
	}
	/**
	 * Cargar datos administrador
	 */
	public function cargarDatosAdministrador(){
		$administrador = $this->AdministradoresModel->getAdministradores($this->input->post('id'));
		$contrasena_rdel = $administrador->contrasena_rdel;
		$password = mc_decrypt($contrasena_rdel, KEY_RDEL);
		$datos = array(
			'administrador' => $administrador,
			'password' => $password
		);
		echo json_encode($datos);
	}
	/**
	 * Crear Informe Actividades
	 */
	// Informe de actividades
	public function create()
	{
		// Traer datos organización
		$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($this->session->userdata('usuario_id'));
		// Capturar datos de formulario
		$data_curso = array(
			"fechaInicio" => $this->input->post("informe_fecha_incio"),
			"fechaFin" => $this->input->post("informe_fecha_fin"),
			"departamento" => $this->input->post("informe_departamento_curso"),
			"municipio" => $this->input->post("informe_municipio_curso"),
			"duracion" => $this->input->post("informe_duracion_curso"),
			"intencionalidad" => json_encode($this->input->post("informe_intencionalidad_curso")),
			"cursos" => json_encode($this->input->post("informe_cursos")),
			"modalidades" => json_encode($this->input->post("informe_modalidad")),
			"totalAsistentes" => $this->input->post("informe_asistentes"),
			"mujeres" => $this->input->post("informe_numero_mujeres"),
			"hombres" => $this->input->post("informe_numero_hombres"),
			"noBinario" => $this->input->post("informe_numero_no_binario"),
			"created_at" => date('Y-m-d H:i:s'),
			"docentes_id_docente" => $this->input->post("informe_docente"),
			"organizaciones_id_organizacion" => $organizacion->id_organizacion
		);
		// Insertar datos de curso dictado
		if ($this->db->insert('informeActividades', $data_curso)) {
			echo json_encode(array('title' =>'Guardado exitoso!', "msg" => "El curso se ha registrado exitosamente.", 'status' => 'success'));
			$this->logs_sia->session_log('Informe de actividad');
			$this->notif_sia->notification('Informe', 'admin', $organizacion->nombreOrganizacion);
		}
	}
	/**
	 * Cargar archivo asistentes pdf
	 */
	public function archivoAsistencia()
	{
		$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($this->session->userdata('usuario_id'));
		$append_name = $this->input->post('append_name');
		$name_random = random(10);
		$name =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($name, PATHINFO_EXTENSION);
		$ruta = 'uploads/asistentes/';
		$size = 60000000;
		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "El tamaño supera las 50 Mb, intente con otro pdf."));
		} else if ($tipo_archivo != "pdf") {
			echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "La extensión de la imagen no es correcta, debe ser PDF"));
		} else if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . $name)) {
			$id_curso = $this->db->select_max("id_informeActividades")->from("informeActividades")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->row()->id_informeActividades;
			$data_insert = array('archivoAsistencia' => $name);
			$this->db->where('id_informeActividades', $id_curso);
			if ($this->db->update('informeActividades', $data_insert)) {
				echo json_encode(array('title' =>'Archivo asistencia cargado','status' =>'success','msg' => "Se ingreso la asistencia."));
				$this->logs_sia->session_log('Ingreso de archivo de asistencia curso');
			}
		}
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
	/**
	 * Cargar archivo masivo excel
	 */
	public function excelAsistentes()
	{
		$organizacion = $this->OrganizacionesModel->getOrganizacionUsuario($this->session->userdata('usuario_id'));
		$append_name = $this->input->post('append_name');
		$name_random = random(10);
		$name =  $append_name . "_" . $name_random . "_" . $_FILES['file']['name'];
		$tipo_archivo = pathinfo($name, PATHINFO_EXTENSION);
		$this->load->library('PHPExcel'); // Load PHPExcel library
		$ruta = 'uploads/asistentes/';
		$size = 60000000;
		if (0 < $_FILES['file']['error']) {
			echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "Hubo un error al actualizar, intente de nuevo."));
		} else if ($_FILES['file']['size'] > $size) {
			echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "El tamaño supera las 60 Mb, intente con otro archivo xlsx."));
		} else if ($tipo_archivo != "xlsx") {
			echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "La extensión del archivo no es correcta, debe ser xlsx. (archivo.xlsx)"));
		} else if (1 == 1) {
			if (move_uploaded_file($_FILES['file']['tmp_name'], $ruta . $name)) {
				$fileName = $ruta . $name;
				$excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);
				$excelObj = $excelReader->load($fileName);
				$worksheet = $excelObj->getSheet(0);
				$lastRow = $worksheet->getHighestRow();
				// Recorrer excel y capturar data para guardar
				$curso = $this->db->select_max("id_informeActividades")->from("informeActividades")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->row();
				$data = array();
				for ($row = 5; $row <= $lastRow; $row++) {
					$data[] = [
						'primerApellidoAsistente' => $worksheet->getCell('A' . $row)->getValue(),
						'segundoApellidoAsistente' => $worksheet->getCell('B' . $row)->getValue(),
						'primerNombreAsistente' => $worksheet->getCell('C' . $row)->getValue(),
						'segundoNombreAsistente' => $worksheet->getCell('D' . $row)->getValue(),
						'numeroDocumentoAsistente' => $worksheet->getCell('E' . $row)->getValue(),
						'numNITOrganizacion' => $worksheet->getCell('F' . $row)->getValue(),
						'nombreOrganizacion' => $worksheet->getCell('G' . $row)->getValue(),
						'tipoFormacion' => $worksheet->getCell('H' . $row)->getValue(),
						'finalidadFormacion' => $worksheet->getCell('I' . $row)->getValue(),
						'fechaInicio' => $worksheet->getCell('J' . $row)->getValue(),
						'fechaFin' => $worksheet->getCell('K' . $row)->getValue(),
						'departamentoResidencia' => $worksheet->getCell('L' . $row)->getValue(),
						'municipioResidencia' => $worksheet->getCell('M' . $row)->getValue(),
						'telefono' => $worksheet->getCell('N' . $row)->getValue(),
						'correoElectronico' => $worksheet->getCell('O' . $row)->getValue(),
						'edad' => $worksheet->getCell('P' . $row)->getValue(),
						'genero' => $worksheet->getCell('Q' . $row)->getValue(),
						'escolaridad' => $worksheet->getCell('R' . $row)->getValue(),
						'enfoqueDiferencial' => $worksheet->getCell('S' . $row)->getValue(),
						'condicionVulnerabilidad' => $worksheet->getCell('T' . $row)->getValue(),
						'discapacidad' => $worksheet->getCell('U' . $row)->getValue(),
						'informeActividades_id_informeActividades' => $curso->id_informeActividades,
					];
				}
				// Actualizar dato de archivo en informe de actividades
				$data_archivoAsistentes = ['archivoAsistentes' => $name];
				$this->db->where('id_informeActividades', $curso->id_informeActividades);
				if ($this->db->update('informeActividades', $data_archivoAsistentes)) {
					// Insertar datos a tabla de asistentes
					foreach ($data as $row) {
						$this->db->insert('asistentes', $row);
					}
					echo json_encode(array('title' => 'Archivos cargados','status' => "success", 'msg' => "Se guardaron los asistentes del curso, espere 5 segundos."));
					//unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .
				} else {
					echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "No se actualizo la tabla."));
				}
			} else {
				echo json_encode(array('title' => "Error", 'status' => 'error', 'msg' => "No se guardo el archivo(s)."));
			}
		}
	}
	/**
	 * Actualizar datos informe de actividades
	 */
	public function update(){
		$id = $this->input->post('id_adm');
		$pass = $this->input->post('super_contrasena_admin');
		$password_rdel = mc_encrypt($pass, KEY_RDEL);
		$password_hash = generate_hash($pass);
		$administrador = $this->AdministradoresModel->getAdministradores($id);
		if($administrador->logged_in == 1){
			echo json_encode(array("msg" => "El administador esta en linea."));
		}else{
			$data_admin = array(
				'primerNombreAdministrador' => $this->input->post('super_primernombre_admin'),
				'segundoNombreAdministrador' => $this->input->post('super_segundonombre_admin'),
				'primerApellidoAdministrador' => $this->input->post('super_primerapellido_admin'),
				'segundoApellidoAdministrador' => $this->input->post('super_segundoapellido_admin'),
				'numCedulaCiudadaniaAdministrador' =>  $this->input->post('super_numerocedula_admin'),
				'ext' =>  $this->input->post('super_ext_admin'),
				'direccionCorreoElectronico' => $this->input->post('super_correo_electronico_admin'),
				'usuario' => $this->input->post('super_nombre_admin'),
				'contrasena' => $password_hash,
				'contrasena_rdel' => $password_rdel,
				'nivel' => $this->input->post('super_acceso_nvl')
			);
			$this->db->where('id_administrador', $id);
			if($this->db->update('administradores', $data_admin)){
				echo json_encode(array("msg" => "El administador ha sido actualizado."));
			}
		}
	}
	/**
	 * Eliminar informe de actividades
	 */
	public function delete(){
		$id = $this->input->post('id_adm');
		$administrador = $this->AdministradoresModel->getAdministradores($id);
		if($administrador->logged_in == 1){
			echo json_encode(array("msg" => "El administrador " . $administrador->usuario . " esta en linea."));
		}else{
			$this->db->where('id_administrador', $id);
			if($this->db->delete('administradores')){
				echo json_encode(array("msg" => "El administador " . $administrador->usuario . " ha sido eliminado."));
			}
		}
	}
}

