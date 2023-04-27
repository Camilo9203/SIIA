<?php
class AdministradoresModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getAdministradores()
	{
		$administradores = $this->db->select("*")->from("administradores")->get()->result();
		return $administradores;
	}
}
