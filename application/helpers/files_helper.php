<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cargar archivo
 */
function create_file($file, $metadata)
{
	$CI = & get_instance();
	// Comprobar y crear ruta
	switch ($metadata['tipo']):
		case 'jornadaAct':
			$ruta = 'uploads/jornadas/' . $metadata['nombre'];
			break;
		case 'carta':
			$ruta = 'uploads/cartaRep/' . $metadata['nombre'];
			break;
		default:
			break;
	endswitch;
	// Comprobación de errores de archivo
	$size = 100000000;
	$ext = pathinfo($metadata['nombre'], PATHINFO_EXTENSION);
	if (0 < $file['error']) {
		return "Hubo un error al actualizar, intente de nuevo.";
	}
	else if ($file['size'] > $size) {
		return "El tamaño supera las 10 Mb, intente con otro archivo PDF.";
	}
	else if ($ext != "pdf" && $ext != "PDF") {
		return "La extensión del archivo no es correcta, debe ser PDF. (archivo.pdf)";
	}
	// Guardo de metadatos archivo
	else if ($CI->db->insert('archivos', $metadata)) {
		// Mover archivo temporal a carpeta correspondiente en sii/uploads
		if (move_uploaded_file($file['tmp_name'], $ruta)) {
			return true;
		}
		else {
			return "No se logro cargar el archivo en la ruta indicada";
		}
		$this->logs_sia->logs('URL_TYPE');
		$this->logs_sia->logQueries();
	}
}
/**
 * Borrar archivo
 */
function delete_file($tipo, $nombre, $id_archivo, $id_formulario) {
	$CI = & get_instance();
	// Eliminar archivo
	if ($tipo == "carta") {unlink('uploads/cartaRep/' . $nombre);}
	if ($tipo == "certificaciones") {unlink('uploads/certificaciones/' . $nombre);}
	if ($tipo == "lugar") {unlink('uploads/lugarAtencion/' . $nombre);}
	if ($tipo == "registroEdu") {unlink('uploads/registrosEducativos/' . $nombre);}
	if ($tipo == "jornadaAct") {unlink('uploads/jornadas/' . $nombre);}
	if ($tipo == "materialDidacticoProgBasicos") {unlink('uploads/materialDidacticoProgBasicos/' . $nombre);}
	if ($tipo == "materialDidacticoAvalEconomia") {unlink('uploads/materialDidacticoAvalEconomia/' . $nombre);}
	if ($tipo == "formatosEvalProgAvalar") {unlink('uploads/formatosEvalProgAvalar/' . $nombre);}
	if ($tipo == "materialDidacticoProgAvalar") {unlink('uploads/materialDidacticoProgAvalar/' . $nombre);}
	if ($tipo == "instructivoPlataforma") {unlink('uploads/instructivosPlataforma/' . $nombre);}
	// Eliminar registro
	$CI->db->where('id_archivo', $id_archivo)->where('id_formulario', $id_formulario);
	if ($CI->db->delete('archivos'))
		echo json_encode(array('msg' => "Se elimino el archivo."));

}
?>


