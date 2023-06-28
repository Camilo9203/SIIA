<?php
class UsuariosModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	/** Cargar Usuarios */
	public function getUsuarios($id = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer organizaciones
			$query = $this->db->select("*")->from("usuarios")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('usuarios', array('id_usuario' => $id));
		return $query->row();
	}
	/** Cargar Actividad Usuario */
	public function getActividadUsuario($usuario)
	{
		$actividad = $this->db->select('*')->from('session_log')->where('usuario_id', $usuario)->order_by("id_session_log", "desc")->limit(70)->get()->result();
		return $actividad;

	}
}
