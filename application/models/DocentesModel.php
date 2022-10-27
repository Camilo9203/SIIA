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
	/** Cargar Información Docentes */
	public function cargarDocentes()
	{
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $this->session->userdata('usuario_id'))->get()->row();
		$docentes = $this->db->select("*")->from("docentes")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->result();
		return $docentes;
	}
}
