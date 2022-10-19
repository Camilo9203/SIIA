<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		verify_session();
	}

	/**
		Funcion Index para cargar las vistas necesarias.
	**/
	public function index()
	{
		$logged = $this->session->userdata('logged_in');
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$usuario_id = $this->session->userdata('usuario_id');
		$tipo_usuario = $this->session->userdata('type_user');
		$hora = date ("H:i",time());
		$fecha = date('Y/m/d');

		$data['logged_in'] = $logged;
		$data['tipo_usuario'] = $tipo_usuario;
		$data['usuario_id'] = $usuario_id;
		$data['hora'] = $hora;
		$data['fecha'] = $fecha;
		$data['estado'] = $this->estadoOrganizaciones();
		$data['estadoAnterior'] = $this->estadoAnteriorOrganizaciones();
		$data['numeroSolicitudes'] = $this->numeroSolicitudes();
		$data['idSolicitud'] = $this->idSolicitud();
		$data['data_informacion_general'] = $this->cargarDatos_formulario_informacion_general_entidad();
		$data['data_organizacion'] = $this->cargarDatosOrganizacion();

		$datos_registro = $this->db->select('*')->from('organizaciones')->where('usuarios_id_usuario', $usuario_id)->get()->row();
		$datos_usuario = $this->db->select('usuario')->from('usuarios')->where('id_usuario', $usuario_id)->get()->row();
		$data['nombre_usuario'] = $datos_usuario->usuario;

		$data_registro = array(
			'nombreOrganizacion' => $datos_registro->nombreOrganizacion,
			'numNIT' => $datos_registro ->numNIT,
			'sigla' => $datos_registro ->sigla,
			'primerNombreRepLegal' => $datos_registro ->primerNombreRepLegal,
			'segundoNombreRepLegal' => $datos_registro ->segundoNombreRepLegal,
			'primerApellidoRepLegal' => $datos_registro ->primerApellidoRepLegal,
			'segundoApellidoRepLegal' => $datos_registro ->segundoApellidoRepLegal,
			'direccionCorreoElectronicoOrganizacion' => $datos_registro ->direccionCorreoElectronicoOrganizacion,
			'direccionCorreoElectronicoRepLegal' => $datos_registro ->direccionCorreoElectronicoRepLegal,
			'primerNombrePersona' => $datos_registro->primerNombrePersona,
			'primerApellidoPersona' => $datos_registro->primerApellidoPersona,
			'nombre_usuario' => $nombre_usuario,
			'imagen' => $datos_registro->imagenOrganizacion,
			'firma' => $datos_registro->firmaRepLegal,
			'firmaCert' => $datos_registro->firmaCert,
			'personaCert' => $datos_registro->personaCert,
			'cargoCert' => $datos_registro->cargoCert,
		);

		$data['departamentos'] = $this->cargarDepartamentos();
		$data['imagen'] = $datos_registro->imagenOrganizacion;
		$data['activeLink'] = 'perfil';
		$data['title'] = 'Perfil - Información de '.$datos_registro ->nombreOrganizacion;
		$data['actividad'] = $this->actividad();
		$data['mis_notificaciones'] = $this->cargarMisNotificaciones();
		$data_registro["resolucion"] = $this->cargarResolucion();
		$data_registro["camara"] = $this->cargarCamaraComercio();

		$this->load->view('include/header/main', $data);
		$this->load->view('paneles/perfil', $data_registro);
		//$this->load->view('paneles/actividad', $dataActividad);
		$this->load->view('include/footer/main');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function cargarDatosOrganizacion()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		return $datos_organizacion;
	}
	// Variables de Session
	public function datosSession()
	{
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
	public function actividad(){

		$datosActividad = $this->db->select('*')->from('session_log')->where('usuario_id', $this->session->userdata('usuario_id'))->order_by("id_session_log", "desc")->limit(70)->get()->result();

		return $datosActividad;
	}

	public function idSolicitud(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$idSolicitud = $this->db->select("idSolicitud")->from("tipoSolicitud")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$id_Solicitud = $idSolicitud ->idSolicitud;
		return $id_Solicitud;
	}

	public function estadoOrganizaciones(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$estado = $this->db->select("nombre")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$nombreEstado = $estado ->nombre;
		return $nombreEstado;
	}

	public function cargarDepartamentos(){
		$departamentos = $this->db->select("*")->from("departamentos")->get()->result();
		return $departamentos;
	}

	public function cargarMunicipios(){
		$departamento = $this->input->post('departamento');

		$data_departamento = $this->db->select("id_departamento")->from("departamentos")->where('nombre', $departamento)->get()->row();
		$id_departamento = $data_departamento ->id_departamento;
		$municipios = $this->db->select("*")->from("municipios")->where('departamentos_id_departamento', $id_departamento)->get()->result();
		echo json_encode($municipios);
	}

	public function cargarDatos_formulario_informacion_general_entidad(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;
		$datos_formulario = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $datos_formulario;
	}

	public function estadoAnteriorOrganizaciones(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$estado = $this->db->select("estadoAnterior")->from("estadoOrganizaciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$nombreEstado = $estado ->estadoAnterior;
		return $nombreEstado;
	}

	public function numeroSolicitudes(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$solicitudes = $this->db->select("numeroSolicitudes")->from("solicitudes")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		$numeroSolicitudes = $solicitudes ->numeroSolicitudes;
		return $numeroSolicitudes;
	}

	public function cargarMisNotificaciones(){
		$nombre_usuario = $this->session->userdata('nombre_usuario');
		$tipo_usuario = $this->session->userdata('type_user');

		$notificaciones = $this->db->select("*")->from("notificaciones")->where("quienRecibe", $nombre_usuario)->get()->result();
		return $notificaciones;
	}

	public function cargarResolucion(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$resolucion = $this->db->select("*")->from("resoluciones")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();
		return $resolucion;
	}

	public function cargarCamaraComercio(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;

		$resolucion = $this->db->select("*")->from("organizaciones")->where("id_organizacion", $id_organizacion)->get()->row();
		return $resolucion;
	}
	/** Actualizar Logo Organización */
	public function actualizar_imagen_logo()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		$name_random = random(10);
		$size = 10000000;

		$imagen_db = $this->db->select('imagenOrganizacion')->from('organizaciones')->where('usuarios_id_usuario', $usuario_id)->get()->row();
		$imagen_db_nombre = $imagen_db ->imagenOrganizacion;

		if($imagen_db_nombre != 'default.png'){
			$nombre_imagen =  "logo_".$name_random.$_FILES['file']['name'];
			$tipo_imagen = pathinfo($nombre_imagen,PATHINFO_EXTENSION);

			if(0 < $_FILES['file']['error']) {
			    echo json_encode(array('url'=>"perfil", 'msg'=>"Hubo un error al actualizar, intente de nuevo."));
			}else if($_FILES['file']['size'] > $size){
				echo json_encode(array('url'=>"perfil", 'msg'=>"El tamaño supera las 10 Mb, intente con otra imagen."));
			}else if($tipo_imagen != "jpeg" &&  $tipo_imagen != "png" &&  $tipo_imagen != "jpg"){
				echo json_encode(array('url'=>"perfil", 'msg'=>"La extensión de la imagen no es correcta, debe ser JPG, PNG"));
			}else if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/logosOrganizaciones/'.$nombre_imagen)){
				unlink('uploads/logosOrganizaciones/'.$imagen_db_nombre);
				$data_update = array(
					'imagenOrganizacion' => $nombre_imagen
				);

				$this->db->where('usuarios_id_usuario', $usuario_id);
				$this->db->update('organizaciones', $data_update);

				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizo la imagen."));
				$this->logs_sia->session_log('Actualización de Imagen / Logo');
			}
		}else{
			$nombre_imagen =  "logo_".$name_random.$_FILES['file']['name'];
			$tipo_imagen = pathinfo($nombre_imagen,PATHINFO_EXTENSION);

			if(0 < $_FILES['file']['error']) {
			    echo json_encode(array('url'=>"perfil", 'msg'=>"Hubo un error al actualizar, intente de nuevo."));
			}else if($_FILES['file']['size'] > $size){
				 echo json_encode(array('url'=>"perfil", 'msg'=>"El tamaño supera las 10 Mb, intente con otra imagen."));
			}else if($tipo_imagen != "jpeg" &&  $tipo_imagen != "png" &&  $tipo_imagen != "jpg"){
				echo json_encode(array('url'=>"perfil", 'msg'=>"La extensión de la imagen no es correcta, debe ser JPG, PNG"));
			}else if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/logosOrganizaciones/'.$nombre_imagen)){
				$data_update = array(
					'imagenOrganizacion' => $nombre_imagen
				);

				$this->db->where('usuarios_id_usuario', $usuario_id);
				$this->db->update('organizaciones', $data_update);

				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizo la imagen."));
				$this->logs_sia->session_log('Actualización de Imagen / Logo');
			}
		}
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
	/** Actualizar Perfil Organizacion */
	public function actualizar_perfil()
	{
		$this->form_validation->set_rules('organizacion','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('sigla','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('nombre','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('nombre_s','','trim|xss_clean');
		$this->form_validation->set_rules('apellido','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('apellido_s','','trim|xss_clean');
		$this->form_validation->set_rules('correo_electronico','','trim|required|min_length[3]|valid_email|xss_clean');
		$this->form_validation->set_rules('correo_electronico_rep_legal','','trim|required|min_length[3]|valid_email|xss_clean');
		$this->form_validation->set_rules('nombre_p','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('apellido_p','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('tipo_organizacion','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('departamento','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('municipio','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('direccion','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('fax','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('actuacion','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('educacion','','trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('numCedulaCiudadaniaPersona','','trim|required|min_length[3]|xss_clean');

		if ($this->form_validation->run("formulario_actualizar") == FALSE)
		{
			$error = validation_errors();
			echo json_encode(array('url'=>"perfil", 'msg'=>$error));
		}
		else
		{
			$organizacion = $this->input->post('organizacion');
			$nit = $this->input->post('nit');
			$sigla = $this->input->post('sigla');
			$nombre = $this->input->post('nombre');
			$nombre_s = $this->input->post('nombre_s');
			$apellido = $this->input->post('apellido');
			$apellido_s = $this->input->post('apellido_s');
			$correo_electronico = $this->input->post('correo_electronico');
			$correo_electronico_rep_legal = $this->input->post('correo_electronico_rep_legal');
			$nombre_p = $this->input->post('nombre_p');
			$apellido_p = $this->input->post('apellido_p');
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
			$usuario_id = $this->session->userdata('usuario_id');
			$id_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row()->id_organizacion;
			$data_informacion_generalDB = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $id_organizacion)->get()->row();

			$data_update = array(
				'nombreOrganizacion' => $organizacion,
				'numNIT' => $nit,
				'sigla' => $sigla,
				'primerNombreRepLegal' => $nombre,
				'segundoNombreRepLegal' => $nombre_s,
				'primerApellidoRepLegal' => $apellido,
				'segundoApellidoRepLegal' => $apellido_s,
				'direccionCorreoElectronicoOrganizacion' => $correo_electronico,
				'direccionCorreoElectronicoRepLegal' => $correo_electronico_rep_legal,
				'primerNombrePersona' => $nombre_p,
				'primerApellidoPersona' => $apellido_p,
			);

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
				'fecha' => date('Y/m/d H:i:s'),
				'organizaciones_id_organizacion' => $id_organizacion
			);

			$this->db->where('usuarios_id_usuario', $usuario_id);
			if($this->db->update('organizaciones', $data_update)){
				if($data_informacion_generalDB == NULL || $data_informacion_generalDB == ""){
					$this->db->insert('informacionGeneral', $data_informacion_general);
				}else{
					$this->db->where('organizaciones_id_organizacion', $id_organizacion);
					$this->db->update('informacionGeneral', $data_informacion_general);
				}
				$this->envio_mailcontacto("update", 3);
				$this->logs_sia->session_log('Actualizacion de datos básicos');
				$this->logs_sia->logQueries();
				$this->logs_sia->logs('URL_TYPE');
				$this->notif_sia->notification('ACTUALIZAR_DATOS', 'admin', $organizacion);
				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizó la información."));
			}
		}
	}


	public function upload_firma()
	{
		$usuario_id = $this->session->userdata('usuario_id');
    	$firma_contrasena = $this->input->post('firmaContrasena');

		$name_random = random(10);
		$size = 10000000;

		$imagen_db = $this->db->select('firmaRepLegal')->from('organizaciones')->where('usuarios_id_usuario', $usuario_id)->get()->row();
		$imagen_db_nombre = $imagen_db ->firmaRepLegal;

		if($imagen_db_nombre != 'default.png'){
			$nombre_imagen =  "firma_".$name_random.$_FILES['file']['name'];
			$tipo_imagen = pathinfo($nombre_imagen,PATHINFO_EXTENSION);

			if(0 < $_FILES['file']['error']) {
			    echo json_encode(array('url'=>"perfil", 'msg'=>"Hubo un error al actualizar, intente de nuevo."));
			}else if($_FILES['file']['size'] > $size){
				echo json_encode(array('url'=>"perfil", 'msg'=>"El tamaño supera las 10 Mb, intente con otra imagen."));
			}else if($tipo_imagen != "jpeg" &&  $tipo_imagen != "png" &&  $tipo_imagen != "jpg"){
				echo json_encode(array('url'=>"perfil", 'msg'=>"La extensión de la imagen no es correcta, debe ser JPG, PNG"));
			}else if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/logosOrganizaciones/firma/'.$nombre_imagen)){
				unlink('uploads/logosOrganizaciones/firma/'.$imagen_db_nombre);
				$data_update = array(
					'firmaRepLegal' => $nombre_imagen,
					'contrasena_firma' => $firma_contrasena
				);

				$this->db->where('usuarios_id_usuario', $usuario_id);
				$this->db->update('organizaciones', $data_update);

				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizo la firma."));
				$this->logs_sia->session_log('Actualización de Firma');
			}
		}else{
			$nombre_imagen =  "firma_".$name_random.$_FILES['file']['name'];
			$tipo_imagen = pathinfo($nombre_imagen,PATHINFO_EXTENSION);

			if(0 < $_FILES['file']['error']) {
			    echo json_encode(array('url'=>"perfil", 'msg'=>"Hubo un error al actualizar, intente de nuevo."));
			}else if($_FILES['file']['size'] > $size){
				 echo json_encode(array('url'=>"perfil", 'msg'=>"El tamaño supera las 10 Mb, intente con otra imagen."));
			}else if($tipo_imagen != "jpeg" &&  $tipo_imagen != "png" &&  $tipo_imagen != "jpg"){
				echo json_encode(array('url'=>"perfil", 'msg'=>"La extensión de la imagen no es correcta, debe ser JPG, PNG"));
			}else if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/logosOrganizaciones/firma/'.$nombre_imagen)){
				$data_update = array(
					'firmaRepLegal' => $nombre_imagen,
					'contrasena_firma' => $firma_contrasena
				);

				$this->db->where('usuarios_id_usuario', $usuario_id);
				$this->db->update('organizaciones', $data_update);

				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizo la firma."));
				$this->logs_sia->session_log('Actualización de la Firma');
			}
		}
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function upload_firma_certifi()
	{
		$usuario_id = $this->session->userdata('usuario_id');

		$name_random = random(10);
		$size = 10000000;

		$imagen_db = $this->db->select('firmaCert')->from('organizaciones')->where('usuarios_id_usuario', $usuario_id)->get()->row();
		$imagen_db_nombre = $imagen_db ->firmaCert;

		if($imagen_db_nombre != 'default.png'){
			$nombre_imagen =  "firmaCert_".$name_random.$_FILES['file']['name'];
			$tipo_imagen = pathinfo($nombre_imagen,PATHINFO_EXTENSION);

			if(0 < $_FILES['file']['error']) {
			    echo json_encode(array('url'=>"perfil", 'msg'=>"Hubo un error al actualizar, intente de nuevo."));
			}else if($_FILES['file']['size'] > $size){
				echo json_encode(array('url'=>"perfil", 'msg'=>"El tamaño supera las 10 Mb, intente con otra imagen."));
			}else if($tipo_imagen != "png"){
				echo json_encode(array('url'=>"perfil", 'msg'=>"La extensión de la imagen no es correcta, debe ser PNG."));
			}else if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/logosOrganizaciones/firmaCert/'.$nombre_imagen)){
				unlink('uploads/logosOrganizaciones/firmaCert/'.$imagen_db_nombre);
				$data_update = array(
					'firmaCert' => $nombre_imagen
				);

				$this->db->where('usuarios_id_usuario', $usuario_id);
				$this->db->update('organizaciones', $data_update);

				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizo la firma para certificados."));
				$this->logs_sia->session_log('Actualización de la Firma Certificados');
			}
		}else{
			$nombre_imagen =  "firmaCert_".$name_random.$_FILES['file']['name'];
			$tipo_imagen = pathinfo($nombre_imagen,PATHINFO_EXTENSION);

			if(0 < $_FILES['file']['error']) {
			    echo json_encode(array('url'=>"perfil", 'msg'=>"Hubo un error al actualizar, intente de nuevo."));
			}else if($_FILES['file']['size'] > $size){
				 echo json_encode(array('url'=>"perfil", 'msg'=>"El tamaño supera las 10 Mb, intente con otra imagen."));
			}else if($tipo_imagen != "png"){
				echo json_encode(array('url'=>"perfil", 'msg'=>"La extensión de la imagen no es correcta, debe ser PNG."));
			}else if(move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/logosOrganizaciones/firmaCert/'.$nombre_imagen)){
				$data_update = array(
					'firmaCert' => $nombre_imagen
				);

				$this->db->where('usuarios_id_usuario', $usuario_id);
				$this->db->update('organizaciones', $data_update);

				echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizo la firma para certificados."));
				$this->logs_sia->session_log('Actualización de la Firma Certificados');
			}
		}
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}

	public function actualizar_nombreCargo(){
		$usuario_id = $this->session->userdata('usuario_id');
		$datos_organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		$id_organizacion = $datos_organizacion ->id_organizacion;$usuario_id = $this->session->userdata('usuario_id');

		$nombrePersonaCert = $this->input->post('nombrePersonaCert');
		$cargoPersonaCert = $this->input->post('cargoPersonaCert');

		$data_update = array(
			'personaCert' => $nombrePersonaCert,
			'cargoCert' => $cargoPersonaCert
		);

		$this->db->where('id_organizacion', $id_organizacion);
		if($this->db->update('organizaciones', $data_update)){
			echo json_encode(array('url'=>"perfil", 'msg'=>"Se actualizaron los datos de nombre y cargo."));
			$this->logs_sia->session_log('Actualizacion de Nombre y Cargo Certificados');
			$this->logs_sia->logQueries();
		}
	}

	public function eliminar_firma_certifi()
	{
		$usuario_id = $this->session->userdata('usuario_id');

		$data_update = array(
			'firmaCert' => 'default.png'
		);

		$this->db->where('usuarios_id_usuario', $usuario_id);
		$this->db->update('organizaciones', $data_update);

		echo json_encode(array('url'=>"perfil", 'msg'=>"Se elimino la firma para certificados."));
		$this->logs_sia->session_log('Actualización de la Firma Certificados');

		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
}
