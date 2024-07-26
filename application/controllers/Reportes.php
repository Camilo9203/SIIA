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
		$this->load->model('OrganizacionesModel');
		$this->load->model('SolicitudesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('AsistentesModel');
		$this->load->model('RegistroTelefonicoModel');
		$this->load->model('DocentesModel');
	}
	/** Datos Sesión */
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
			'activeLink' => 'reportes',
			'departamentos' => $this->DepartamentosModel->getDepartamentos(),
		);
		return $data;
	}
	/** Entidades acreditadas */
	public function entidadesAcreditadas()
	{
		$data = $this->datosSession();
		$data['title'] = 'Reportes - Entidades Acreditadas';
		$data['organizacionesAcreditadas'] = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/acreditadas', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
 	// Exportar reporte entidades acreditadas
	/** Registro Solicitudes */
	public function registroSolicitudes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Registro de Solicitudes';
		$data['solicitudes'] = $this->SolicitudesModel->getSolicitudesAndOrganizacion();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/solicitudes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
 	// Exportar reporte entidades acreditadas
	public function exportarExcel() {
		$this->load->library('PHPExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NOMBRE DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NUMERO NIT');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'TIPO DE ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CURSOS APROBADOS');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'MODALIDAD DE LA SOLICITUD');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'RESOLUCIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'FECHA VENCIMIENTO DE LA ACREDITACIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'MUNICIPIO');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'DIRECCIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'TELÉFONO');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'DIRECCIÓN WEB DE LA ENTIDAD ACREDITADA');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'CORREO ELECTRÓNICO ORGANIZACIÓN');
		$rowCount = 2;
		$data = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		foreach ($data as $organizacion) {

			$link = base_url("uploads/resoluciones/" . $organizacion['resoluciones']->resolucion);
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $organizacion['data_organizaciones']->nombreOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $organizacion['data_organizaciones']->numNIT);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $organizacion['data_organizaciones_inf']->tipoOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $organizacion['resoluciones']->cursoAprobado);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $organizacion['resoluciones']->modalidadAprobada);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'RESOLUCIÓN NÚMERO ' . $organizacion['resoluciones']->numeroResolucion);
			$objPHPExcel->getActiveSheet()->getCell('F'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);
			$objPHPExcel->getActiveSheet()->getCell('F'.$rowCount)->getHyperlink()->setUrl(strip_tags($link));
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setUnderline(true);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_BLUE));
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $organizacion['resoluciones']->fechaResolucionFinal);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $organizacion['data_organizaciones_inf']->nomMunicipioNacional);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $organizacion['data_organizaciones_inf']->direccionOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $organizacion['data_organizaciones_inf']->fax);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $organizacion['data_organizaciones_inf']->urlOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $organizacion['data_organizaciones']->direccionCorreoElectronicoOrganizacion);
			foreach(range('A','L') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$rowCount ++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Entidades acreditadas');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="entidades-acreditadas.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	// Exportar reporte entidades acreditadas con estadisticas
	public function exportarExcelConteo() {
		$this->load->library('PHPExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NOMBRE DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NUMERO NIT');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'TIPO DE ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CURSOS APROBADOS');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'BASICO');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'MEDIO');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'AVANZADO');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'FINANCI');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'AVAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'MODALIDAD DE LA SOLICITUD');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'MODALIDAD DE LA SOLICITUD');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'MODALIDAD DE LA SOLICITUD');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'RESOLUCIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'FECHA VENCIMIENTO DE LA ACREDITACIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'MUNICIPIO');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'DIRECCIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'TELÉFONO');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'DIRECCIÓN WEB DE LA ENTIDAD ACREDITADA');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'CORREO ELECTRÓNICO ORGANIZACIÓN');
		$rowCount = 2;
		$data = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		// Cursos
		$basico = 0;
		$medio = 0;
		$avanzado = 0;
		$financi = 0;
		$aval = 0;
		// Modalidades
		$presencial = 0;
		$linea = 0;
		$virtual = 0;

		foreach ($data as $organizacion) {

			$link = base_url("uploads/resoluciones/" . $organizacion['resoluciones']->resolucion);
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $organizacion['data_organizaciones']->nombreOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $organizacion['data_organizaciones']->numNIT);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $organizacion['data_organizaciones_inf']->tipoOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $organizacion['resoluciones']->cursoAprobado);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $organizacion['resoluciones']->modalidadAprobada);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'RESOLUCIÓN NÚMERO ' . $organizacion['resoluciones']->numeroResolucion);
			$objPHPExcel->getActiveSheet()->getCell('F'.$rowCount)->setDataType(PHPExcel_Cell_DataType::TYPE_STRING2);
			$objPHPExcel->getActiveSheet()->getCell('F'.$rowCount)->getHyperlink()->setUrl(strip_tags($link));
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setUnderline(true);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_BLUE));
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $organizacion['resoluciones']->fechaResolucionFinal);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $organizacion['data_organizaciones_inf']->nomMunicipioNacional);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $organizacion['data_organizaciones_inf']->direccionOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $organizacion['data_organizaciones_inf']->fax);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $organizacion['data_organizaciones_inf']->urlOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $organizacion['data_organizaciones']->direccionCorreoElectronicoOrganizacion);
			foreach(range('A','L') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$rowCount ++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Entidades acreditadas');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="entidades-acreditadas.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	// Exportar datos abiertos
	public function exportarDatosAbiertos() {
		$this->load->library('PHPExcel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NOMBRE DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NUMERO NIT');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'SIGLA DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ESTADO ACTUAL DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'FECHA CAMBIO DE ESTADO');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'TIPO DE ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'DIRECCIÓN DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'DEPARTAMENTO DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'MUNICIPIO DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'TELÉFONO DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'EXTENSION');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'URL DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'ACTUACIÓN DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'TIPO DE EDUCACIÓN DE LA ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'PRIMER NOMBRE REPRESENTANTE LEGAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'SEGUNDO NOMBRE REPRESENTANTE LEGAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'PRIMER APELLIDO REPRESENTANTE LEGAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'SEGUNDO APELLIDO REPRESENTANTE LEGAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'NÚMERO CÉDULA REPRESENTANTE LEGAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'CORREO ELECTRÓNICO ENTIDAD');
		$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'CORREO ELECTRÓNICO REPRESENTANTE LEGAL');
		$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'NUMERO DE LA RESOLUCIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'FECHA DE INICIO DE LA RESOLUCIÓN');
		$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'AÑOS DE LA RESOLUCIÓN');
		//$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'TIPO DE SOLICITUD');
		$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'MOTIVO DE LA SOLICITUD');
		$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'MODALIDAD DE LA SOLICITUD');
		$rowCount = 2;
		$data = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		foreach ($data as $organizacion) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $organizacion['data_organizaciones']->nombreOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $organizacion['data_organizaciones']->numNIT);
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $organizacion['data_organizaciones']->sigla);
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $organizacion['data_organizaciones']->estado);
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $organizacion['resoluciones']->fechaResolucionInicial);
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $organizacion['data_organizaciones_inf']->tipoOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $organizacion['data_organizaciones_inf']->direccionOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $organizacion['data_organizaciones_inf']->nomDepartamentoUbicacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $organizacion['data_organizaciones_inf']->nomMunicipioNacional);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $organizacion['data_organizaciones_inf']->fax);
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $organizacion['data_organizaciones_inf']->extension);
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $organizacion['data_organizaciones_inf']->urlOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $organizacion['data_organizaciones_inf']->actuacionOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $organizacion['data_organizaciones_inf']->tipoEducacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $organizacion['data_organizaciones']->primerNombreRepLegal);
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $organizacion['data_organizaciones']->segundoNombreRepLegal);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, $organizacion['data_organizaciones']->primerApellidoRepLegal);
			$objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $organizacion['data_organizaciones']->segundoApellidoRepLegal);
			$objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, $organizacion['data_organizaciones_inf']->numCedulaCiudadaniaPersona);
			$objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, $organizacion['data_organizaciones']->direccionCorreoElectronicoOrganizacion);
			$objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, $organizacion['data_organizaciones']->direccionCorreoElectronicoRepLegal);
			$objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $organizacion['resoluciones']->numeroResolucion);
			$objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, $organizacion['resoluciones']->fechaResolucionInicial);
			$objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, $organizacion['resoluciones']->anosResolucion);
			//$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount, $organizacion['resoluciones']->tipoSolicitud);
			$objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowCount, $organizacion['resoluciones']->cursoAprobado);
			$objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount, $organizacion['resoluciones']->modalidadAprobada);
			foreach(range('A','Z') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
					->setAutoSize(true);
			}
			$rowCount ++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Datos abiertos');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="datos-abiertos.xlsx"');
		header('Cache-Control: max-age=0');
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	public function entidadesAcreditadasSin()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['organizacionesAcreditadas'] = $this->OrganizacionesModel->getOrganizacionesAcreditadas();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/acreditadasSin', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function entidadesHistorico()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes';
		$data['organizacionesHistorico'] = $this->OrganizacionesModel->getOrganizacionesHistorico();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/historico', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function verAsistentes()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes Asistentes';
		$data['asistentes'] = $this->AsistentesModel->getAsistentes();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/asistentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function registroTelefonico()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Registro telefónico';
		$data['registros'] = $this->RegistroTelefonicoModel->getRegistrosTelefonicos();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/telefonicos', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
	}
	public function docentesHabilitados()
	{
		$data = $this->datosSession();
		$data['title'] = 'Panel Principal - Administrador - Reportes Docentes';
		$data['docentes'] = $this->DocentesModel->getDocentesHabilitados();
		$this->load->view('include/header', $data);
		$this->load->view('admin/reportes/docentes', $data);
		$this->load->view('include/footer', $data);
		$this->logs_sia->logs('PLACE_USER');
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
}
