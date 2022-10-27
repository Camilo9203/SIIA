<?php
class InformacionGeneralModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// Traer entidades acreditadas
	public function informacionGeneral($id = FALSE)
	{
		if ($id === FALSE) {

			// Consulta para traer organizaciones acreditas
			$query = $this->db->select("*")->from("informacionGeneral")->get();
			return $query->result_array();
		}
		// Traer solicitudes por id
		$query = $this->db->get_where('informacionGeneral', array('id' => $id));
		return $query->row_array();
	}

	// Cargar datos información general
	public function cargarDatosInformacionGeneral()
	{
		$organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $this->session->userdata('usuario_id'))->get()->row();
		$datos = $this->db->select("*")->from("informacionGeneral")->where("organizaciones_id_organizacion", $organizacion->id_organizacion)->get()->row();
		return $datos;
	}

}


// get_where('solicitudes', array('fecha' => "solicitudes"));
	// Variables para consultas del tramite
	// $años  = ->join('solicitudes', 'solicitudes.organizaciones_id_organizacion = organizaciones.id_organizacion')->join('tipoSolicitud', 'tipoSolicitud.organizaciones_id_organizacion', 'organizaciones.id_organizacion')
	// $data_organizaciones = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes")->where("organizaciones.id_organizacion", $id_org)->where("estadoOrganizaciones.organizaciones_id_organizacion", $id_org)->where("solicitudes.organizaciones_id_organizacion", $id_org)->get()->row();
	// Retornar resultas en forma de array
	// foreach ($id_organizaciones as $id_organizacion) {
	// 	$id_org = $id_organizacion->organizaciones_id_organizacion;
	// 	array_push($organizaciones, $data_organizaciones);
	// }
	// return $organizaciones;
	// echo json_encode($organizaciones);
	// var_dump($data);
