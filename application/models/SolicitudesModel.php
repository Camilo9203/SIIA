<?php
class SolicitudesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		$this->load->model('SolicitudesModel');
		$this->load->model('DepartamentosModel');
		$this->load->model('AdministradoresModel');
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
				$solicitud = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes, tiposolicitud")->where("organizaciones.id_organizacion", $idOrg)->where("estadoOrganizaciones.idSolicitud", $idSolicitud)->where("solicitudes.idSolicitud", $idSolicitud)->where("tiposolicitud.idSolicitud", $idSolicitud)->get()->row();
				array_push($dataSolicitudesAsignadas, $solicitud);
			else:
				$solicitud = $this->db->select("*")->from("organizaciones, estadoOrganizaciones, solicitudes, tiposolicitud")->where("organizaciones.id_organizacion", $idOrg)->where("estadoOrganizaciones.idSolicitud", $idSolicitud)->where("solicitudes.idSolicitud", $idSolicitud)->where("tiposolicitud.idSolicitud", $idSolicitud)->get()->row();
				array_push($dataSolicitudesSinAsignar, $solicitud);
			endif;
		}
		array_push($solicitudesFinalizadas, array('solicitudesSinAsignar' => $dataSolicitudesSinAsignar, 'solicitudesAsignadas' => $dataSolicitudesAsignadas));
		return $solicitudesFinalizadas;
		// echo json_encode($organizaciones);
	}
}

