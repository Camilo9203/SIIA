<?php
class InformacionGeneralModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Usuarios */
	public function getInformacionGeneral($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer organizaciones
			$query = $this->db->select("*")->from("informaciongeneral")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('informaciongeneral', array('organizaciones_id_organizacion' => $id));
		return $query->row();
	}
}
