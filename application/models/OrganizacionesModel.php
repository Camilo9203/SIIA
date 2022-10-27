<?php
class OrganizacionesModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	// TODO:Cargar organizaciones
	public function organizaciones()
	{
		if ($id === FALSE) {

			$query = $this->db->select("*")->from("organizaciones")->get();
			return $query->result_array();
		}
		$query = $this->db->get_where('organizaciones', array('id' => $id));
		return $query->row_array();
	}
	public function getOrganizacion()
	{
		$organizaciones = $this->db->select('*')->from('organizaciones')->where('usuarios_id_usuario', $this->session->userdata('usuario_id'))->get()->row();
		return $organizaciones;
	}
}
