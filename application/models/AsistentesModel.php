<?php

class AsistentesModel extends CI_Model {

	function __construct()
	{
		$this->load->database();
	}
	/** Cargar Asistentes */
	public function getAsistentes()
	{
		$asistentes = $this->db->select("*")->from("asistentes")->get()->result();
		return $asistentes;
	}
}
