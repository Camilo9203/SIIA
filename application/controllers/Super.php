<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

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
	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'SUP';
		$data['tipo_usuario'] = "none";
		$data['logged_in'] = FALSE;

		$this->load->view('include/header', $data);
		$this->load->view('admin/super/super');
		$this->load->view('include/footer');
		$this->logs_sia->logs('PLACE_USER');
	}

	public function verify(){
		$ps = $this->input->post('sp');
		if($ps == SUPER_PS){
			$data_update = array(
				'valor' => 'TRUE'
			);

			$this->db->where('nombre', 'super');
			if($this->db->update('opciones', $data_update)){
				$usuario_ip = $_SERVER['REMOTE_ADDR'];
				echo json_encode(array("url"=>"panel", "msg" => "SUPER!"));
				$datos_sesion = array(
					'usuario_id'     => "1-666-1", // Number of the beast #-#
					'nombre_usuario'  => "super",
					'type_user' => 'super',
					'logged_in' => 1,
					'usuario_ip' => $usuario_ip,
					'usuario_ip_proxy' => $usuario_ip,
					'user_agent' => $_SERVER['HTTP_USER_AGENT']
				);
				$this->session->set_userdata($datos_sesion);
			}
		}else if($ps == ""){
			// Se sabe si esta ingresando el /?
			$data_update = array(
				'valor' => 'FALSE'
			);

			$this->db->where('nombre', 'super');
			if($this->db->update('opciones', $data_update)){}
		}else{
			$data_update = array(
				'valor' => 'FALSE'
			);

			$this->db->where('nombre', 'super');
			if($this->db->update('opciones', $data_update)){
				echo json_encode(array("url" => "sia"));
			}
		}
	}

	public function panel(){
		verify_session_admin();
		$is = $this->db->select("valor")->from("opciones")->where("nombre","super")->get()->row()->valor;
		if($is == "TRUE"){
			$data['title'] = 'SUPER';
			$data['tipo_usuario'] = $this->session->userdata('type_user');
			$data['logged_in'] = $this->session->userdata('logged_in');
			$data['administradores'] = $this->cargarAdministradores();

			$this->load->view('include/header', $data);
			$this->load->view('admin/super/super', $data);
			$this->load->view('include/footer');
			$this->logs_sia->logs('PLACE_USER');
		}else{
		}
	}

	public function nuevoAdm(){
		$super_primernombre_admin = $this->input->post('super_primernombre_admin');
		$super_segundonombre_admin = $this->input->post('super_segundonombre_admin');
		$super_primerapellido_admin = $this->input->post('super_primerapellido_admin');
		$super_segundoapellido_admin = $this->input->post('super_segundoapellido_admin');
		$super_numerocedula_admin = $this->input->post('super_numerocedula_admin');
		$super_correo_electronico_admin = $this->input->post('super_correo_electronico_admin');
		$super_nombre_admin = $this->input->post('super_nombre_admin');
		$super_contrasena_admin = $this->input->post('super_contrasena_admin');
		$super_acceso_nvl = $this->input->post('super_acceso_nvl');
		$password_rdel = mc_encrypt($super_contrasena_admin, KEY_RDEL);
		$password_hash = generate_hash($super_contrasena_admin);

		$last_id = $this->db->select("id_administrador")->from("administradores")->order_by("id_administrador", "desc")->get()->row()->id_administrador;
		$adm_exist_data = $this->db->select("usuario")->from("administradores")->where("usuario", $super_nombre_admin)->get()->row();

		if($adm_exist_data == ""){
			$data_admin = array(
				'primerNombreAdministrador' => $super_primernombre_admin,
				'segundoNombreAdministrador' => $super_segundonombre_admin,
				'primerApellidoAdministrador' => $super_primerapellido_admin,
				'segundoApellidoAdministrador' => $super_segundoapellido_admin,
				'numCedulaCiudadaniaAdministrador' => $super_numerocedula_admin,
				'direccionCorreoElectronico' => $super_correo_electronico_admin,
				'usuario' => $super_nombre_admin,
				'contrasena' => $password_hash,
				'contrasena_rdel' => $password_rdel,
				'nivel' => $super_acceso_nvl,
			);
			if($this->db->insert('administradores', $data_admin)){
				echo json_encode(array("msg" => "Administador Agregado"));
			}else{
				echo json_encode(array("msg" => "Administador no Agregado"));
			}
		}else{
			echo json_encode(array("msg" => "El nombre de usuario ya esta en uso."));
		}
	}

	public function cargarAdministradores(){
		$administradores = $this->db->select("*")->from("administradores")->get()->result();
		return $administradores;
	}

	public function cargarDatosAdministrador(){
		$datos = array();
		$id_adm = $this->input->post('id_adm');
		$datos_adm = $this->db->select("*")->from("administradores")->where("id_administrador", $id_adm)->get()->row();
		$contrasena_rdel = $datos_adm->contrasena_rdel;
		$password = mc_decrypt($contrasena_rdel, KEY_RDEL);
		array_push($datos, $datos_adm);
		array_push($datos, $password);
		echo json_encode($datos);
	}

	public function eliminarAdministrador(){
		$id_adm = $this->input->post('id_adm');
		$datos = $this->db->select("*")->from("administradores")->where("id_administrador", $id_adm)->get()->row();
		$logged_in = $datos ->logged_in;

		if($logged_in == 1){
			echo json_encode(array("msg" => "El Administador esta en linea."));
		}else{
			$this->db->where('id_administrador', $id_adm);
			if($this->db->delete('administradores')){
				echo json_encode(array("msg" => "El Administador ha sido eliminado."));
			}
		}
	}

	public function actualizarAdministrador(){
		$id_adm = $this->input->post('id_adm');
		$primerNombreAdministrador = $this->input->post('primerNombre');
		$segundoNombreAdministrador = $this->input->post('segundoNombre');
		$primerApellidoAdministrador = $this->input->post('primerApellido');
		$segundoApellidoAdministrador = $this->input->post('segundoApellido');
		$cedula = $this->input->post('cedula');
		$correo_electronico = $this->input->post('correo_electronico');
		$nombre = $this->input->post('nombre');
		$contrasena = $this->input->post('contrasena');
		$super_acceso_nvl = $this->input->post('super_acceso_nvl');
		$password_rdel = mc_encrypt($contrasena, KEY_RDEL);
		$password_hash = generate_hash($contrasena);

		$datos = $this->db->select("*")->from("administradores")->where("id_administrador", $id_adm)->get()->row();
		$logged_in = $datos ->logged_in;

		if($logged_in == 1){
			echo json_encode(array("msg" => "El Administador esta en linea."));
		}else{
			$data_admin = array(
				'primerNombreAdministrador' => $primerNombreAdministrador,
				'segundoNombreAdministrador' => $segundoNombreAdministrador,
				'primerApellidoAdministrador' => $primerApellidoAdministrador,
				'segundoApellidoAdministrador' => $segundoApellidoAdministrador,
				'numCedulaCiudadaniaAdministrador' => $cedula,
				'direccionCorreoElectronico' => $correo_electronico,
				'usuario' => $nombre,
				'contrasena' => $password_hash,
				'contrasena_rdel' => $password_rdel,
				'nivel' => $super_acceso_nvl
			);
			$this->db->where('id_administrador', $id_adm);
			if($this->db->update('administradores', $data_admin)){
				echo json_encode(array("msg" => "El Administador ha sido actualizado."));
			}
		}
	}

	public function logout(){
		$data_update = array(
			'valor' => 'FALSE'
		);

		$this->db->where('nombre', 'super');
		if($this->db->update('opciones', $data_update)){
			echo json_encode("salir");
			delete_cookie('sia_session');
			$this->session->sess_destroy();
		}
	}
}
