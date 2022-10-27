<?php
class SolicitudesModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// Traer solicitudes
	public function solicitudes($id = FALSE)
	{
		if ($id === FALSE) {

			// Consulta para traer organizaciones acreditas
			$query = $this->db->select("*")->from("solicitudes")->get();
			return $query->result_array();
		}
		// Traer solicitudes por id

		$query = $this->db->select("*")->from("solicitudes")->join('tipoSolicitud', "tipoSolicitud.idSolicitud = solicitudes.idSolicitud")->join('estadoOrganizaciones', "estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud")->where('solicitudes.idSolicitud', $id)->get()->row();;
		return $query;
	}

	// Cargar datos solicitudes
	public function cargarSolicitudes()
	{
		$organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $this->session->userdata('usuario_id'))->get()->row();
		$solicitudes = $this->db->select("*")->from("solicitudes")->join('tipoSolicitud', "tipoSolicitud.idSolicitud = solicitudes.idSolicitud")->join('estadoOrganizaciones', "estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud")->where('solicitudes.organizaciones_id_organizacion', $organizacion->id_organizacion)->get()->result();
		return $solicitudes;
	}

}
