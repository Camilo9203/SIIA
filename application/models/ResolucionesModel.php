<?php
class ResolucionesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/**
	 * Cargar resoluciones
	 */
	public function getResoluciones($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer organizaciones
			$query = $this->db->select("*")->from("resoluciones")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('resoluciones', array('organizaciones_id_organizacion' => $id));
		return $query->result();
	}
	/**
	 * Cargar resolución por id
	 */
	public function getResolucion($id = FALSE)
	{
		// Traer organizaciones por ID
		$query = $this->db->get_where('resoluciones', array('id_resoluciones' => $id));
		return $query->row();
	}
	/**
	 * Cargar resolución por id de solicitud
	 */
	public function getResolucionSolicitud($id = FALSE)
	{
		// Traer organizaciones por ID
		$query = $this->db->get_where('resoluciones', array('idSolicitud' => $id));
		return $query->row();
	}
}
