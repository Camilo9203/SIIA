<?php
class SolicitudesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Solicitudes */
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
	/** Cargar Solicitudes Finalizadas Histórico */
	public function getSolicitudesFinalizadas()
	{
		$solicitudesFinalizadas = array();
		$dataSolicitudesAsignadas = array();
		$dataSolicitudesSinAsignar = array();
		$estados = $this->db->select("*")->from("estadoOrganizaciones")->join('solicitudes', 'estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud')->where("nombre", "Finalizado")->get()->result();
		foreach ($estados as $estado) {
			$idOrg = $estado->organizaciones_id_organizacion;
			$idSolicitud = $estado->idSolicitud;
			if($estado->asignada != "SIN ASIGNAR"):
				$solicitud = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes, tipoSolicitud")->where("organizaciones.id_organizacion", $idOrg)->where("estadoOrganizaciones.idSolicitud", $idSolicitud)->where("solicitudes.idSolicitud", $idSolicitud)->where("tipoSolicitud.idSolicitud", $idSolicitud)->get()->row();
				array_push($dataSolicitudesAsignadas, $solicitud);
			else:
				$solicitud = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes, tipoSolicitud")->where("organizaciones.id_organizacion", $idOrg)->where("estadoOrganizaciones.idSolicitud", $idSolicitud)->where("solicitudes.idSolicitud", $idSolicitud)->where("tipoSolicitud.idSolicitud", $idSolicitud)->get()->row();
				array_push($dataSolicitudesSinAsignar, $solicitud);
			endif;
		}
		array_push($solicitudesFinalizadas, array('solicitudesSinAsignar' => $dataSolicitudesSinAsignar, 'solicitudesAsignadas' => $dataSolicitudesAsignadas));
		return $solicitudesFinalizadas;
		// echo json_encode($organizaciones);
	}
	/** Cargar Solicitudes En Proceso y Proceso de Renovación */
	public function getSolicitudesEnProceso()
	{
		$solicitudesEnProceso = array();
		$estados = $this->db->select("*")->from("estadoOrganizaciones")->join('solicitudes', 'estadoOrganizaciones.idSolicitud = solicitudes.idSolicitud')->where("nombre", "En Proceso" )->or_where("nombre", "En Proceso de Renovación")->get()->result();
		foreach ($estados as $estado) {
			$idOrg = $estado->organizaciones_id_organizacion;
			$idSolicitud = $estado->idSolicitud;
			$solicitud = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes, tipoSolicitud")->where("organizaciones.id_organizacion", $idOrg)->where("estadoOrganizaciones.idSolicitud", $idSolicitud)->where("solicitudes.idSolicitud", $idSolicitud)->where("tipoSolicitud.idSolicitud", $idSolicitud)->get()->row();
			array_push($solicitudesEnProceso, $solicitud);
		}
		return $solicitudesEnProceso;
	}
}
