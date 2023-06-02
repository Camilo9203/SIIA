<?php
class NitsModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar NITS */
	public function getNits($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer nits
			$query = $this->db->select("*")->from("nits_db")->get();
			return $query->result_array();
		}
		// Traer nits por id
		$query = $this->db->get_where('nits_db', array('id' => $id));
		return $query->row_array();
	}
}
