<?php
class EstadisticasModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// Traer todas las solicitudes y entidad quien solicita
	public function solicitudesOrganizacion($id = FALSE)
	{
		if ($id === FALSE) {

			// Consulta para traer solicitudes, tipo de solitud y ogranizacion de la solicitud
			$query = $this->db->select("*")->from("viewSolicitudesOrganizacion")->where("nombre", "Negada")->get();
			// get_where('solicitudes', array('fecha' => "solicitudes"));
			// Variables para consultas del tramite
			// $años  = ->join('solicitudes', 'solicitudes.organizaciones_id_organizacion = organizaciones.id_organizacion')->join('tipoSolicitud', 'tipoSolicitud.organizaciones_id_organizacion', 'organizaciones.id_organizacion')


			// 	$data_organizaciones = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes")->where("organizaciones.id_organizacion", $id_org)->where("estadoOrganizaciones.organizaciones_id_organizacion", $id_org)->where("solicitudes.organizaciones_id_organizacion", $id_org)->get()->row();
			// Retornar resultas en forma de array
			return $query->result_array();
		}
		// Traer solicitudes por id
		$query = $this->db->get_where('solicitudes', array('id' => $id));
		return $query->row_array();


		// foreach ($id_organizaciones as $id_organizacion) {
		// 	$id_org = $id_organizacion->organizaciones_id_organizacion;
		// 	array_push($organizaciones, $data_organizaciones);
		// }
		// return $organizaciones;
		// echo json_encode($organizaciones);
		// var_dump($data);

	}
}
