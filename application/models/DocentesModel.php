<?php
class DocentesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/**
	 * Cargar docentes por organización
	 */
	public function getDocentes($id = FALSE) {
		if ($id === FALSE) {
			// Consulta para traer docentes
			$query = $this->db->select("*")->from("docentes")->get();
			return $query->result();
		}
		// Traer docentes por ID
		$query = $this->db->get_where('docentes', array('organizaciones_id_organizacion' => $id));
		return $query->result();
	}
	/**
	 * Cargar Docentes Sin Asignar
	 */
	public function docentesSinAsignar()
	{
		$docentes = $this->db->select("*")->from("organizaciones")->join("docentes", "docentes.organizaciones_id_organizacion = organizaciones.id_organizacion")->where("docentes.valido", 0)->get()->result();
		// echo json_encode($docentes);
		return $docentes;
	}
	/**
	 * Cargar Docentes Habilitados
	 */
	public function getDocentesHabilitados()
	{
		$docentes = $this->db->select("*")->from("docentes")->where("valido", 1)->get()->result();
		return $docentes;
	}
	/**
	 * Cargar Docentes valídos por entidad
	 */
	public function getDocentesValidos($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer docentes
			$query = $this->db->select("*")->from("docentes")->where("valido", 1)->get();
			return $query->result();
		}
		// Traer docentes por ID
		$query = $this->db->get_where('docentes', array('organizaciones_id_organizacion' => $id, 'valido' => 1));
		return $query->result();
	}
}
