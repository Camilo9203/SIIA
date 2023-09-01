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
	public function getAdministrador($id)
	{
		// Traer administrador por numero de cédula
		$query = $this->db->get_where('administradores', array('numCedulaCiudadaniaAdministrador' => $id));
		return $query->row();
	}
}
