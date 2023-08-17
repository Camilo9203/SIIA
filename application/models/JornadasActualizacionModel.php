<?php
class JornadasActualizacionModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Usuarios */
	public function getJornadasActualizacion($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer organizaciones
			$query = $this->db->select("*")->from("jornadasactualizacion")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('jornadasactualizacion', array('idSolicitud' => $id));
		return $query->row();
	}
}
