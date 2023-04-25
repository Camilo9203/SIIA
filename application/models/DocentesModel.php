<?php
class DocentesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Docentes Sin Asignar */
	public function docentesSinAsignar()
	{
		$docentes = $this->db->select("*")->from("organizaciones")->join("docentes", "docentes.organizaciones_id_organizacion = organizaciones.id_organizacion")->where("docentes.valido", 0)->get()->result();
		// echo json_encode($docentes);
		return $docentes;
	}
	/** Cargar Docentes Habilitados */
	public function getDocentesHabilitados()
	{
		$docentes = $this->db->select("*")->from("docentes")->where("valido", 1)->get()->result();
		return $docentes;
	}
}
