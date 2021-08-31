<?php
class DocentesModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// TODO:Cargar docentes no asignados
	public function docentesSinAsignar()
	{
		$docentes = $this->db->select("*")->from("organizaciones")->join("docentes", "docentes.organizaciones_id_organizacion = organizaciones.id_organizacion")->where("docentes.valido", 0)->get()->result();
		// echo json_encode($docentes);
		return $docentes;
	}
}
