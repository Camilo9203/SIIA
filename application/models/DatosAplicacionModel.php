<?php
class DatosAplicacionModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Usuarios */
	public function getDatosAplicacion($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer organizaciones
			$query = $this->db->select("*")->from("datosaplicacion")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('datosaplicacion', array('idSolicitud' => $id));
		return $query->row();
	}
}
