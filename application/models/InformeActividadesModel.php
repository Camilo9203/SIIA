<?php
class InformeActividadesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/**
	 * Cargar docentes por organización
	 */
	public function getInformeActividades($id = FALSE) {
		if ($id === FALSE) {
			// Consulta para traer docentes
			$query = $this->db->select("*")->from("informeActividades")->get();
			return $query->result();
		}
		// Traer docentes por ID
		$query = $this->db->get_where('informeActividades', array('organizaciones_id_organizacion' => $id));
		return $query->result();
	}

}


