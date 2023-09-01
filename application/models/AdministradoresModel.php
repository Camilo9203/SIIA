<?php
class AdministradoresModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getAdministradores($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer administradores
			$query = $this->db->select("*")->from("administradores")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('administradores', array('id_administrador' => $id));
		return $query->row();
	}
	public function getAdministrador($usuario)
	{
		// Traer administrador por usuario
		$query = $this->db->get_where('administradores', array('usuario' => $usuario));
		return $query->row();
	}
}
