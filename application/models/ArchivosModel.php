<?php
class ArchivosModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function getArchivos($id = FALSE, $form = FALSE)
	{
		if ($id === FALSE) {
			// Consulta para traer administradores
			$query = $this->db->select("*")->from("archivos")->get();
			return $query->result();
		}
		// Traer organizaciones por ID
		$query = $this->db->get_where('archivos', array('id_formulario' => $form, 'id_registro' => $id));
		return $query->row();
	}

	/**
	 *  Comprobar extensiones de archivos
	 */
	public function checkExtensionImagenes($extension)
	{
		// Aquí podemos añadir las extensiones que deseemos permitir
		$extensiones = array("jpg", "png", "jpeg");
		if (in_array(strtolower($extension), $extensiones)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function checkExtensionPDF($extension)
	{
		// Aquí podemos añadir las extensiones que deseemos permitir
		$extensiones = array("pdf", "PDF");
		if (in_array(strtolower($extension), $extensiones)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
