<?php

class RegistroTelefonicoModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Registros Telefónicos */
	public function getRegistrosTelefonicos()
	{
		$reportes = $this->db->select("*")->from("registroTelefonico")->get()->result();
		return $reportes;
	}
}
