<?php
class AdminModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// TODO:Cargar administradores del sistema
	public function cargarAdministradores()
	{
		$administradores = $this->db->select("*")->from("administradores")->get()->result();
		return $administradores;
	}
}
