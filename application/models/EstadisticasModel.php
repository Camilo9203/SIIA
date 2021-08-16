<?php
class EstadisticasModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// Traer todas las solicitudes y entidad quien solicita
	public function get_solicitudes($id = FALSE)
	{
		if ($id === FALSE) {

			// Consulta para traer solicitudes, tipo de solitud y ogranizacion de la solicitud
			$query = $this->db->select("QUARTER(fecha)")->from("solicitudes")->join('organizaciones', 'organizaciones.id_organizacion = solicitudes.organizaciones_id_organizacion')->get_where('solicitudes', array('fecha' => "solicitudes"));
			// Variables para consultas del tramite
			// $años  = 


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

	// Traer todas los tipos de solicitud y entidad quien solicita
	public function get_tipoSolicitud($id = FALSE)
	{
		if ($id === FALSE) {
			// Traer tabla completa$query = $this->db->get('solicitudes');
			// Consulta para traer solicitudes y ogranizaciones de la solicitud
			$query = $this->db->select("*")->from("tipoSolicitud")->join('solicitudes', 'tipoSolicitud.organizaciones_id_organizacion = solicitudes.organizaciones_id_organizacion')->get();
			// 	$data_organizaciones = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes")->where("organizaciones.id_organizacion", $id_org)->where("estadoOrganizaciones.organizaciones_id_organizacion", $id_org)->where("solicitudes.organizaciones_id_organizacion", $id_org)->get()->row();
			// Retornar resultas en forma de array
			return $query->result_array();
		}
		// Traer solicitudes por id
		$query = $this->db->get_where('tipoSolicitud', array('id' => $id));
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
