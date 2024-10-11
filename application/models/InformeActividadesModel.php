<?php
class InformeActividadesModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/**
	 * Cargar informes de actividades
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
	 * Traer intencionalidad
	 */
	public function getIntencionalidad($intencionalidades) {
		$result = '';
		foreach (json_decode($intencionalidades) as $intencionalidad):
			$intencionalidad = intval($intencionalidad);
			switch ($intencionalidad):
				case 1:
					$result .= "Fortalecimiento, ";
					break;
				case 2:
					$result .= "Creación, ";
					break;
				case 3:
					return "Cámaras";
					break;
				case 4:
					return "Histório";
					break;
				case 5:
					return "Segumiendo";
					break;
				case 6:
					return "Asignación";
					break;
				default:
					break;
			endswitch;
			$result = substr($result, 0, -2);
			return $result;
		endforeach;
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
					return "Acreditación Curso Medio de Economía Solidaria, ";
					break;
				case 4:
					return "Acreditación Curso Avanzado de Economía Solidaria, ";
					break;
				case 5:
					return "Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria, ";
					break;
				default:
					break;
			endswitch;
			$result = substr($result, 0, -2);
			return $result;
		endforeach;
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
					return "En Linea, ";
					break;
				default:
					break;
			endswitch;
			$result = substr($result, 0, -2);
			return $result;
		endforeach;
	}
}


