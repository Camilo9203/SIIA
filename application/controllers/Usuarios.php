<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller
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
		$this->load->model('UsuariosModel');
		$this->load->model('OrganizacionesModel');
		$this->load->model('TokenModel');
	}
	/**
	 * Cargar datos usuario
	 */
	public function cargarDatosUsuario(){
		$usuario = $this->UsuariosModel->getUsuariosSuperAdmin($this->input->post('id'));
		$contrasena_rdel = $usuario->contrasena_rdel;
		$password = mc_decrypt($contrasena_rdel, KEY_RDEL);
		$datos = array(
			'usuario' => $usuario,
			'password' => $password
		);
		echo json_encode($datos);
	}
	/**
	 * Crear administrador
	 */
	public function create(){
		$pass = $this->input->post('super_contrasena_admin');
		$password_rdel = mc_encrypt($pass, KEY_RDEL);
		$password_hash = generate_hash($pass);
		$administrador = $this->db->select("usuario")->from("administradores")->where("usuario", $this->input->post('super_nombre_admin'))->get()->row();
		if($administrador == ""){
			$data_admin = array(
				'primerNombreAdministrador' => $this->input->post('super_primernombre_admin'),
				'segundoNombreAdministrador' => $this->input->post('super_segundonombre_admin'),
				'primerApellidoAdministrador' => $this->input->post('super_primerapellido_admin'),
				'segundoApellidoAdministrador' => $this->input->post('super_segundoapellido_admin'),
				'numCedulaCiudadaniaAdministrador' => $this->input->post('super_numerocedula_admin'),
				'direccionCorreoElectronico' => $this->input->post('super_correo_electronico_admin'),
				'usuario' => $this->input->post('super_nombre_admin'),
				'nivel' => $this->input->post('super_acceso_nvl'),
				'contrasena' => $password_hash,
				'contrasena_rdel' => $password_rdel,
			);
			if($this->db->insert('administradores', $data_admin)){
				$usuario = $this->input->post('super_nombre_admin');
				$administrador = $this->AdministradoresModel->getAdministrador($usuario);
				$type = "creacionAdministrador";
				if($administrador)
					send_email_super($type, $administrador);
			}
			else{
				echo json_encode(array("status" => 0,"title" => "Administrador no creado!", "icon" => "error","msg" => "Administador no agregado. Error en base de datos"));
			}
		}else{
			echo json_encode(array("status" => 0, "title" => "Administrador no creado!", "icon" => "error","msg" => "El nombre de usuario ya esta en uso."
			));
		}
	}
	/**
	 * Actualizar datos administrador
	 */
	public function update(){
		$id = $this->input->post('id');
		$pass = $this->input->post('password');
		$password_rdel = mc_encrypt($pass, KEY_RDEL);
		$password_hash = generate_hash($pass);
		$usuario = $this->UsuariosModel->getUsuarios($id);
		if($usuario->logged_in == 1){
			echo json_encode(array("status" => "info","msg" => "El usuario esta en linea."));
		}else{
			$data_organizacion = array(
				'direccionCorreoElectronicoOrganizacion' => $this->input->post('correo_electronico_usuario'),
			);
			$data_usuario = array(
				'usuario' => $this->input->post('username'),
				'contrasena' => $password_hash,
				'contrasena_rdel' => $password_rdel,
			);
			$data_token = array(
				'verificado' => $this->input->post('estado_usuario')
			);
			$this->db->where('usuarios_id_usuario', $usuario->id_usuario);
			$this->db->update('organizaciones', $data_organizacion);
			$this->db->where('usuario_token', $usuario->usuario);
			$this->db->update('token', $data_token);
			$this->db->where('id_usuario', $id);
			if($this->db->update('usuarios', $data_usuario)){
				echo json_encode(array("status" => "success", "msg" => "Usuario actualizado"));
			}
		}
	}
	/**
	 * Eliminar administrador
	 */
	public function delete(){
		$id = $this->input->post('id');
		$usuario = $this->UsuariosModel->getUsuarios($id);
		if($usuario->logged_in == 1){
			echo json_encode(array("msg" => "El usuario " . $usuario->usuario . " esta en linea."));
		}else{
			$this->db->where('id_usuario', $id);
			if($this->db->delete('usuarios')){
				echo json_encode(array("msg" => "El usuario " . $usuario->usuario . " ha sido eliminado."));
			}
		}
	}
	/**
	 * Desconectar usuario
	 */
	public function disconnect(){
		$id = $this->input->post('id');
		$usuario = $this->UsuariosModel->getUsuarios($id);
		if($usuario->logged_in == 1){
			$update = array('logged_in' => 0);
			$this->db->where('id_usuario', $id);
			if($this->db->update('usuarios', $update)) {
				echo json_encode(array("status" => "success", "msg" => "El usuario " . $usuario->usuario . " se ha desconectado del sistema con éxito."));
			}
		}else{
			echo json_encode(array("status" => "info",  "msg"=> "El usuario " . $usuario->usuario . " esta desconectado."));
		}
	}
}
