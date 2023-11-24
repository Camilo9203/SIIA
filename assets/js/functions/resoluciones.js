/**
 * Ver resoluciones
 *  */
$(".ver_resolucion_org").click(function () {
	let idOrganizacion = $(this).attr("data-organizacion");
	window.open(baseURL + "resoluciones/organizacion/" + idOrganizacion, '_self');
});
/**
 * Acciones de menú
 */
// Ver administradores
$('#verResolucionesRegistradas').click(function () {
	if ($('#tabla_resoluciones_organizacion').css('display') === 'none'){
		$('#tabla_resoluciones_organizacion').show('swing');
		$('#formulario_resolucion_organizacion').hide('linear');
	}
	else {
		$('#tabla_resoluciones_organizacion').hide('linear');
	}
});
// Ver usuarios
$('#verFormularioResolucion').click(function () {
	if ($('#formulario_resolucion_organizacion').css('display') == 'none'){
		$('#formulario_resolucion_organizacion').show('swing');
		$('#tabla_resoluciones_organizacion').hide('linear');
	}
	else {
		$('#formulario_resolucion_organizacion').hide('linear');
	}
});
// Habilitar Input Años
$("#fechaResolucionInicial").change( function (){
	$("#anosResolucion").attr('disabled', false);
});
// Años de resolución automaticos
$("#anosResolucion").change( function (){
	let years = $("#anosResolucion").val();
	let fechaFin = moment($("#fechaResolucionInicial").val())
	fechaFin = fechaFin.add(years, 'year')
	fechaFin = fechaFin.format('YYYY-MM-DD');
	$("#fechaResolucionFinal").val(fechaFin);
	$("#numeroResolucion").attr('disabled', false);
});
// Acciones si es resolución vieja o vigente
$("input[name=tipoResolucion]").change(function () {
	if($(this).val() == 'vieja') {
		$('#resolucionVieja').show('swing');
		$('#resolucionVigente').hide('linear');
	}
	else {
		$('#resolucionVigente').show('swing');
		$('#resolucionVieja').hide('linear');
	}
})
/**
 * Adjuntar Resolución
 * */
$("#cargarResolucion").on("click", function () {
	validarFormularios();
	//if($("#formulario_resolucion_organizacion").valid()){
		var file = $("#resolucion").prop("files")[0];
		var formData = new FormData();
		// Si es resolución antigua
		if($("input:radio[name=tipoResolucion]:checked").val() == 'vieja') {
			let cursos_aprobados = '';
			let modalidades = '';
			// Recorrer motivos de la solicitud y guardar variables
			$("#formulario_resoluciones_organizacion input[name=motivos]").each(function (){
				if (this.checked){
					switch ($(this).val()) {
						case '1':
							cursos_aprobados += 'Acreditación Curso Básico de Economía Solidaria' + ', ';
							break;
						case '2':
							cursos_aprobados += 'Aval de Trabajo Asociado' + ', ';
							break;
						case '3':
							cursos_aprobados += 'Acreditación Curso Medio de Economía Solidaria' + ', ';
							break;
						case '4':
							cursos_aprobados += 'Acreditación Curso Avanzado de Economía Solidaria' + ', ';
							break;
						case '5':
							cursos_aprobados += 'Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria' + ', ';
							break;
						default:
					}
				}
			});
			// Recorrer motivos de la solicitud y guardar variables
			$("#formulario_resoluciones_organizacion input[name=modalidades]").each(function (){
				if (this.checked){
					switch ($(this).val()) {
						case '1':
							modalidades += 'Presencial' + ', ';
							break;
						case '2':
							modalidades += 'Virtual' + ', ';
							break;
						case '3':
							modalidades += 'En Linea' + ', ';
							break;
						default:
					}
				}
			});
			formData.append("cursoAprobado", cursos_aprobados.substring(0, cursos_aprobados.length -2));
			formData.append("modalidadAprobada", modalidades.substring(0, modalidades.length -2));
		}
		formData.append("file", file);
		formData.append("fechaResolucionInicial", $("#fechaResolucionInicial").val());
		formData.append("fechaResolucionFinal", $("#fechaResolucionFinal").val());
		formData.append("anosResolucion",$("#anosResolucion").val());
		formData.append("numeroResolucion", $("#numeroResolucion").val());
		formData.append("tipoResolucion", $("input:radio[name=tipoResolucion]:checked").val());
		formData.append("id_organizacion", $(this).attr("data-id-org"));
		formData.append("idSolicitud", $("#idSolicitud").val());
		$.ajax({
			url: baseURL + "resoluciones/cargarResolucionOrganizacion",
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			type: "post",
			dataType: "html",
			beforeSend: function () {
				procesando("info", "Espere...");
			},
			success: function (response) {
				response = JSON.parse(response);
				if(response.status == 'success') {
					alertaResolucion(response.title, response.msg, response.status);
				}
				else {
					procesando(response.status, response.msg)
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	//}
});
/**
 * Eliminar resolución
 */
$(document).on("click", ".eliminarResolucion", function () {
	var idResolucion = $(this).attr("data-id-res");
	var idOrganizacion = $(this).attr("data-id-org");
	var data = {
		id_resolucion: idResolucion,
		id_organizacion: idOrganizacion,
	};
	$.ajax({
		url: baseURL + "resoluciones/eliminarResolucion",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			procesando('info', 'Espere...');
		},
		success: function (response) {
			alertaResolucion(response.title, response.msg, response.status);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Editar resolución
 */
$(document).on("click", ".editarResolucion", function () {
	var $id_resolucion = $(this).attr("data-id-res");
	var $id_organizacion = $(this).attr("data-id-org");
	var data = {
		id_resolucion: $id_resolucion,
		id_organizacion: $id_organizacion,
	};

	$.ajax({
		url: baseURL + "admin/editarResolucion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$("#adjuntar_resolucion").hide();
			$("#actualizarDatosResolucion").show();
			$("#actualizarDatosResolucion").attr("id-res", $id_resolucion);
			$("#actualizarDatosResolucion").attr("id-org", $id_organizacion);
			$("#res_fech_inicio").val(response.resolucion.fechaResolucionInicial);
			$("#res_fech_fin").val(response.resolucion.fechaResolucionFinal);
			$("#res_anos").val(response.resolucion.anosResolucion);
			$("#num_res_org").val(response.resolucion.numeroResolucion);
			$("#cursoAprobado").selectpicker(
				"val",
				response.resolucion.cursoAprobado
			);
			$("#modalidadAprobada").selectpicker(
				"val",
				response.resolucion.modalidadAprobada
			);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Actualizar datos de la resolución
 */
$(document).on("click", "#actualizarDatosResolucion", function () {
	$id_res = $(this).attr("id-res");
	$id_org = $(this).attr("id-org");
	$res_fech_inicio = $("#res_fech_inicio").val();
	$res_fech_fin = $("#res_fech_fin").val();
	$res_anos = $("#res_anos").val();
	$num_res_org = $("#num_res_org").val();
	$cursoAprobado = $("#cursoAprobado").val();
	$modalidadAprobada = $("#modalidadAprobada").val();

	var data = {
		id_res: $id_res,
		id_organizacion: $id_org,
		res_fech_inicio: $res_fech_inicio,
		res_fech_fin: $res_fech_fin,
		res_anos: $res_anos,
		num_res_org: $num_res_org,
		cursoAprobado: $cursoAprobado,
		modalidadAprobada: $modalidadAprobada,
	};

	$.ajax({
		url: baseURL + "admin/actualizarResolucion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Validar formularios
 */
function validarFormularios(){
	$("form[id='formulario_resolucion_organizacion']").validate({
		rules: {
			fechaResolucionInicial: {
				required: true,
			},
			anosResolucion: {
				required: true,
			},
			numeroResolucion: {
				required: true,
			},
			resolucion: {
				required: true,
			},
		},
		messages: {
			fechaResolucionInicial: {
				required: "Por favor, ingrese una fecha de inicio.",
			},
			anosResolucion: {
				required: "Por favor, ingrese cantidad de años.",
			},
			numeroResolucion: {
				required: "Por favor, ingrese un numero de resolución",
			},
			resolucion: {
				required: "Por favor, cargar archivo",
			},
		},
	});
}
// Toast procesando
function procesando(status, msg){
	Toast.fire({
		icon: status,
		text: 'msg'
	});
}
// Alerta de formulario guardado
function alertaResolucion(title, msg, status){
	Alert.fire({
		title: title,
		html: msg,
		text: msg,
		icon: status,
		allowOutsideClick: false,
		customClass: {
			popup: 'popup-swalert-list',
			confirmButton: 'button-swalert',
		},
	}).then((result) => {
		if (result.isConfirmed) {
			setInterval(function () {
				reload();
			}, 2000);
		}
	})
}
