<?php
class ArchivosModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getArchivos($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer administradores
			$query = $this->db->select("*")->from("archivos")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('archivos', array('id_administrador' => $id));
		return $query->row();
	}
	public function getAdministrador($usuario)
	{
		// Traer administrador por usuario
		$query = $this->db->get_where('archivos', array('id' => $usuario));
		return $query->row();
	}
	/**
	 * Traer nombre de nivel administradores
	 */
	public function getNivel($id) {
		switch ($id):
			case 0:
				return "Total";
				break;
			case 1:
				return "Evaluador";
				break;
			case 2:
				return "Reportes";
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
	}

	/**
	 * @return $password administrator
	 */
	public function getPassword ($pass) {
		$password = mc_decrypt($pass, KEY_RDEL);
		return $password;
	}
}
