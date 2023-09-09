<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Archivos extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('JornadasActualizacionModel');
	}
	/**
	 * Eliminar archivos
	 */
	public function delete(){
		$tipo = $this->input->post('tipo');
		$nombre = $this->input->post('nombre');
		$id_archivo = $this->input->post('id_archivo');
		$id_formulario = $this->input->post('id_formulario');
		delete_file($tipo, $nombre, $id_archivo, $id_formulario);
	}
}
