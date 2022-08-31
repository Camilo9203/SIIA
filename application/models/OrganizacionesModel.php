<?php
class OrganizacionesModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// TODO:Cargar organizaciones
	public function getOrganizaciones()
	{
		$organizaciones = $this->db->select("*")->from("organizaciones")->get()->result();
		return $organizaciones;
	}
	public function getOrganizacionesAcreditadas()
	{
		$organizaciones = $this->db->select("*")->from("organizaciones")->where("estado", "Acreditado")->get()->result();
		return $organizaciones;
	}
}
