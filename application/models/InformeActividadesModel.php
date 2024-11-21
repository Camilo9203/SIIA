<?php
class InformeActividadesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/**
	 * Traer informeActividades de actividades
	 */
	public function getInformeActividades($id = FALSE) {
		if ($id === FALSE) {
			// Consulta para traer docentes
			$query = $this->db->select("*")->from("informeActividades")->get();
			return $query->result();
		}
		// Traer docentes por ID
		$query = $this->db->get_where('informeActividades', array('organizaciones_id_organizacion' => $id));
		return $query->result();
	}
	/**
	 * Traer informeActividades de actividades enviadas
	 */
	public function getInformeActividadesEnviadas($id = FALSE) {
		if ($id === FALSE) {
			// Consulta para traer docentes
			$query = $this->db->select("*")->from("informeActividades")->where(array('estado' => 'Enviado'))->get();
			return $query->result();
		}
		// Traer docentes por ID
		$query = $this->db->get_where('informeActividades', array('organizaciones_id_organizacion' => $id, 'estado' => 'Enviado'));
		return $query->result();
	}
	/**
	 * Traer informe de actividad
	 */
	public function getInformeActividad($id = FALSE) {
		if ($id === FALSE) {
			// Consulta para traer el ultimo informe creado
			$query = $this->db->select("*")->from("informeActividades")->order_by('id_informeActividades', 'desc')->get();
			return $query->row();
		}
		// Traer docentes por ID
		$query = $this->db->get_where('informeActividades', array('id_informeActividades' => $id));
		return $query->row();
	}
	public function updateEstadoInformeActividad($id, $data)
	{
		$this->db->where('id_informeActividades', $id);
		$updated = $this->db->update('informeActividades', array('estado' => $data['estado']));
		if ($updated) {
			// Registrar el cambio en el historial
			$this->db->insert('historico_estado_informe', $data);
		}
		return $updated;
	}
	/**
	 * Traer intencionalidad
	 */
	public function getIntencionalidad($intencionalidades) {
		$result = '';
		foreach (json_decode($intencionalidades) as $intencionalidad):
			$intencionalidad = intval($intencionalidad);
			switch ($intencionalidad):
				case 1:
					$result .= "Promoción, ";
					break;
				case 2:
					$result .= "Creación, ";
					break;
				case 3:
					$result .= "Fortalecimiento, ";
					break;
				case 4:
					$result .= "Desarrollo, ";
					break;
				case 5:
					$result .= "Integración, ";
					break;
				case 6:
					$result .= "in, ";
					break;
				default:
					break;
			endswitch;
		endforeach;
		$result = substr($result, 0, -2);
		return $result;
	}
	/**
	 * Traer cursos
	 */
	public function getCursos($cursos) {
		$result = '';
		foreach (json_decode($cursos) as $curso):
			$curso = intval($curso);
			switch ($curso):
				case 1:
					$result .= "Acreditación Curso Básico de Economía Solidaria, ";
					break;
				case 2:
					$result .= "Aval de Trabajo Asociado, ";
					break;
				case 3:
					$result .= "Acreditación Curso Medio de Economía Solidaria, ";
					break;
				case 4:
					$result .= "Acreditación Curso Avanzado de Economía Solidaria, ";
					break;
				case 5:
					$result .= "Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria, ";
					break;
				default:
					break;
			endswitch;
		endforeach;
		$result = substr($result, 0, -2);
		return $result;
	}
	/**
	 * Traer modalidades
	 */
	public function getModalidades($modalidades) {
		$result = '';
		foreach (json_decode($modalidades) as $modalidad):
			$modalidad = intval($modalidad);
			switch ($modalidad):
				case 1:
					$result .= "Presencial, ";
					break;
				case 2:
					$result .= "Virtual, ";
					break;
				case 3:
					$result .= "En Linea, ";
					break;
				default:
					break;
			endswitch;
		endforeach;
		$result = substr($result, 0, -2);
		return $result;
	}
}


