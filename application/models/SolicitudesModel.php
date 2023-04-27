<?php
class SolicitudesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/** Cargar Solicitudes Finalizadas Histórico */
	public function getSolicitudesFinalizadas()
	{
		$solicitudesFinalizadas = array();
		$solicitudes = $this->db->select("*")->from("estadoOrganizaciones")->where("nombre", "Finalizado")->get()->result();
		foreach ($solicitudes as $idSolicitud) {
			$idOrg = $idSolicitud->organizaciones_id_organizacion;
			$idSolicitud = $idSolicitud->idSolicitud;
			$data_organizaciones = $this->db->select('*')->from('organizaciones')->join('solicitudes', 'solicitudes.organizaciones_id_organizacion = organizaciones.id_organizacion')->join('estadoOrganizaciones', 'estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud')->join('tipoSolicitud', 'tipoSolicitud.idSolicitud = solicitudes.idSolicitud')->where('organizaciones.id_organizacion', $idOrg)->get()->result();
			array_push($solicitudesFinalizadas, $data_organizaciones);
		}
		return $solicitudesFinalizadas;
		// echo json_encode($organizaciones);
	}
}

