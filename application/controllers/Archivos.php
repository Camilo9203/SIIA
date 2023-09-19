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
		verify_session();
		$this->load->model('ArchivosModel');
	}
    /**
     * Crear archivos
     */
    public function create () {
        // Traer datos organizaciones
        $usuario_id = $this->session->userdata('usuario_id');
        $organizacion = $this->db->select("*")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
        // Capturar datos de archivo
        $file = $_FILES['file'];
        $metadata = array(
            'tipo' => $this->input->post('tipoArchivo'),
            'nombre' => $this->input->post('append_name') . "_" . random(10) . "_" . $file['name'],
            'id_formulario' => $this->input->post('id_form'),
            'id_registro' => $this->input->post('idSolicitud'),
            'organizaciones_id_organizacion' => $organizacion->id_organizacion
        );
        // Crear y cargar archivo
        $fileCreated = create_file($file, $metadata);
        if ($fileCreated == "true"):
            echo json_encode(array('icon' => 'success', 'msg' => 'Se guardo archivo correctamente'));
        else:
            echo json_encode(array('icon' => 'error', 'msg' => $fileCreated));
        endif;
    }
	/**
	 * Crear archivos
	 */
	// Guardar certificados e imágenes formulario 1
	public function uploadFiles()
	{
		$tipoArchivo = $this->input->post('tipoArchivo');
		$append_name = $this->input->post('append_name');
		$size = 100000000;
		$usuario_id = $this->session->userdata('usuario_id');
		$organizacion = $this->db->select("id_organizacion")->from("organizaciones")->where("usuarios_id_usuario", $usuario_id)->get()->row();
		// Inicializamos un contador para recorrer los archivos
		$i = 0;
		$msg = '';
		$files = $_FILES['file']['name'];
		// Guardar archivo formulario 1 certificaciones
		if ($tipoArchivo == "certificaciones") {
			$count = 0;
			$ruta = 'uploads/certificaciones';
			foreach ($files as $file):
				// Separamos los trozos del archivo, nombre extension
				$trozos[$i] = explode(".", $_FILES["file"]["name"][$i]);
				// Obtenemos la extensión
				$extension[$i] = end($trozos[$i]);
				$tipo_archivo = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
				if ($tipo_archivo == "pdf" && $this->ArchivosModel->checkExtensionPDF($extension[$i]) === TRUE):
					$count ++;
				else:
					$msg .= "Extensión erronea en archivo: <span class='upper'>" . ($i+1)  . "</span>. <i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
				endif;
				$i++;
			endforeach;
			$i = 0;
			// Comprobar extensión del archivo
			if ($count == 3):
				foreach ($files as $file):
					$randomIni = random(10);
					$randomFinal = random(5);
					$data_update = array(
						'tipo' => $tipoArchivo,
						'nombre' => $append_name . "_" . $randomIni . $randomFinal . "_" . $_FILES['file']['name'][$i],
						'id_formulario' => 1,
						'organizaciones_id_organizacion' => $organizacion->id_organizacion
					);
					if ($this->db->insert('archivos', $data_update)):
						if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $ruta . '/' . $append_name . "_" . $randomIni . $randomFinal . "_" . $_FILES['file']['name'][$i])):
							// Se cargó el archivo correctamente
						else:
							$errores .= "Archivo : <span class='upper'>" . ($i+1)  . "</span>. <i class='fa fa-times spanRojo' aria-hidden='true'></i> no cargado<br/>";
						endif;
					endif;
					$i++;
				endforeach;
				$i = 0;
			endif;
		}
		else if ($tipoArchivo == "lugar") {
			$ruta = 'uploads/lugarAtencion';
			foreach ($files as $file):
				// Separamos los trozos del archivo, nombre extension
				$trozos[$i] = explode(".", $_FILES["file"]["name"][$i]);
				// Obtenemos la extensión
				$extension[$i] = end($trozos[$i]);
				$tipo_archivo = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
				$randomIni = random(10);
				$randomFinal = random(5);
				// Comprobar si el archivo es una imagen
				if (($tipo_archivo == "jpg" || $tipo_archivo == "png" || $tipo_archivo == "jpeg") && $this->ArchivosModel->checkExtensionImagenes($extension[$i]) === TRUE):
					$data_update = array(
						'tipo' => $tipoArchivo,
						'nombre' => $append_name . "_" . $randomIni . $randomFinal . "_" . $_FILES['file']['name'][$i],
						'id_formulario' => 1,
						'organizaciones_id_organizacion' => $organizacion->id_organizacion
					);
					if ($this->db->insert('archivos', $data_update)):
						if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $ruta . '/' . $append_name . "_" . $randomIni . $randomFinal . "_" . $_FILES['file']['name'][$i])):
							// Se cargó el archivo correctamente
						else:
							$msg .= "Archivo : <span class='upper'>" . $_FILES['file']['name'][$i]  . "</span>. <i class='fa fa-times spanRojo' aria-hidden='true'></i> no cargado<br/>";
						endif;
					endif;
				else:
					$msg .= "Extensión erronea en archivo: <span class='upper'>" . $_FILES['file']['name'][$i]  . "</span>. <i class='fa fa-times spanRojo' aria-hidden='true'></i><br/>";
				endif;
				$i++;
			endforeach;
		}
		if ($msg == ''):
			echo json_encode(array('icon' => 'success', 'msg' => 'Se cargaron correctamente los archivos'));
		else:
			echo json_encode(array('icon' => 'error', 'msg' => 'No se cargaron los archivos: <br/><strong><small><i>' . $msg . '</i></small></strong>'));
		endif;
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
