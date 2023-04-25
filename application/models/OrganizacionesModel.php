<?php
class OrganizacionesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Organizaciones */
	public function getOrganizaciones()
	{
		$organizaciones = $this->db->select("*")->from("organizaciones")->get()->result();
		return $organizaciones;
	}
	/** Cargar Organizaciones Acreditadas */
	public function getOrganizacionesAcreditadas()
	{
		$organizaciones = array();
		$nits = $this->db->select(("distinct(numNIT), numNIT"))->from("nits_db")->get()->result();
		foreach ($nits as $nit) {
			$organizacion = $this->db->select("*")->from("organizaciones")->where("numNIT", $nit->numNIT)->get()->row();
			$informacion = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->row();
			$resoluciones = $this->db->select("*")->from("resoluciones")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->result();
				foreach ($resoluciones as $resolucion) {
					$organizacion_resolucion = $this->db->select("*")->from("resoluciones")->where("id_resoluciones", $resolucion->id_resoluciones)->get()->row();
					if($organizacion_resolucion->fechaResolucionFinal >= date("Y-m-d")):
						array_push($organizaciones, array("data_organizaciones" => $organizacion, "data_organizaciones_inf" => $informacion, "resoluciones" => $organizacion_resolucion));
					endif;
				}
			}
		return $organizaciones;
	}
	/** Cargar Organizaciones Histórico */
	public function getOrganizacionesHistorico()
	{
		$data_organizaciones = $this->db->select("*")->from("organizacionesHistorial")->get()->result();
		return $data_organizaciones;
	}
}
