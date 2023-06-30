function tablaResoluciones (response, $id_org) {
	event.preventDefault();
	if (response.resoluciones.length) {
		for (var i = 0; i < response.resoluciones.length; i++) {
			$("#tbodyResoluciones").append("<tr id=" + i + ">");
			$("#tbodyResoluciones>tr#" + i + "").append("<td>" + response.resoluciones[i].fechaResolucionInicial + "</td>");
			$("#tbodyResoluciones>tr#" + i + "").append("<td>" + response.resoluciones[i].fechaResolucionFinal + "</td>");
			$("#tbodyResoluciones>tr#" + i + "").append("<td>" + response.resoluciones[i].anosResolucion + "</td>");
			$("#tbodyResoluciones>tr#" + i + "").append("<td><a href='" + baseURL + "uploads/resoluciones/" + response.resoluciones[i].resolucion + "' target='_blank'>Ver resolución</a></td>");
			$("#tbodyResoluciones>tr#" + i + "").append("<td>" + response.resoluciones[i].numeroResolucion + "</td>");
			$("#tbodyResoluciones>tr#" + i + "").append("<td>" + response.resoluciones[i].cursoAprobado + "</td>");
			$("#tbodyResoluciones>tr#" + i + "").append("<td>" + response.resoluciones[i].modalidadAprobada + "</td>");
			$("#tbodyResoluciones>tr#" + i + "").append(
				"<td><div class='btn-group-vertical' role='group' aria-label='acciones'><button class='btn btn-siia btn-sm editarResolucion' data-id-org='" + $id_org + "' data-id-res='" + response.resoluciones[i].id_resoluciones + "'>Editar <i class='fa fa-pencil' aria-hidden='true'></i></button>" +
				"<button class='btn btn-danger btn-sm eliminarResolucion' data-id-org='" + $id_org + "' data-id-res='" + response.resoluciones[i].id_resoluciones + "'>Eliminar <i class='fa fa-times' aria-hidden='true'></i></button></div></td>"
			);
			$("#tbodyResoluciones").append("</tr>");
		}
		paging("tabla_resoluciones");
	}else {
		$("#tbodyResoluciones").append("<tr id=" + i + ">");
		$("#tbodyResoluciones>tr#" + i + "").append("<td colspan='8'>No hay datos</td>");
		$("#tbodyResoluciones").append("</tr>");
	}
}

$("#tabla_enProceso_organizacion tbody").on("click", '.ver_resolucion_org', function () {
	let $id_org = $(this).attr("data-organizacion");
	$("#id_org_ver_form").remove();
	$("body").append("<div id='id_org_ver_form' class='hidden' data-id='" + $id_org + "'>");
	let data = {
		id_organizacion: $id_org,
		idSolicitud: $(this).attr("data-solicitud")
	};
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#admin_ver_finalizadas").slideUp();
			$("#datos_org_resolucion").slideDown();
			$("#adjuntar_resolucion").attr("data-id-org", $id_org);
			$("#resolucion").attr("data-id-org", $id_org);
			$("#resolucion_nombre_org").html(response.organizaciones.nombreOrganizacion);
			$("#resolucion_nit_org").html(response.organizaciones.numNIT);
			$("#resolucion_nombreRep_org").html(response.organizaciones.primerNombreRepLegal + " " + response.organizaciones.segundoNombreRepLegal + " " + response.organizaciones.primerApellidoRepLegal + " " + response.organizaciones.segundoApellidoRepLegal);
			$("#tbodyResoluciones").empty();
			$("#tbodyResoluciones>.odd").remove();
			tablaResoluciones(response, $id_org);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Habilitar Input Años */
$("#res_fech_inicio").change( function (){
	$("#res_anos").attr('disabled', false);
});
/** Años de resolución automaticos */
$("#res_anos").change( function (){
	let years = $("#res_anos").val();
	let fechaFin = moment($("#res_fech_inicio").val())
	fechaFin = fechaFin.add(years, 'year')
	fechaFin = fechaFin.format('YYYY-MM-DD');
	$("#res_fech_fin").attr('disabled', false);
	$("#res_fech_fin").val(fechaFin);
	$("#num_res_org").attr('disabled', false);
});
/** Adjuntar Resolución */
$("#adjuntar_resolucion").on("click", function () {
	event.preventDefault();
	//if($("#formulario_actualizar_imagen").valid()){
	let cursos_aprobados = '';
	let modalidades = '';
	// Recorrer motivos de la solicitud y guardar variables
	$("#formulario_resoluciones input[name=motivos]").each(function (){
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
	$("#formulario_resoluciones input[name=modalidades]").each(function (){
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
	var file_data = $("#resolucion").prop("files")[0];
	var form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("fechaResolucionInicial", $("#res_fech_inicio").val());
	form_data.append("fechaResolucionFinal", $("#res_fech_fin").val());
	form_data.append("cursoAprobado", cursos_aprobados.substring(0, cursos_aprobados.length -2));
	form_data.append("modalidadAprobada", modalidades.substring(0, modalidades.length -2));
	form_data.append("anosResolucion",$("#res_anos").val());
	form_data.append("numeroResolucion", $("#num_res_org").val());
	form_data.append("tipoResolucion", $("input:radio[name=tipoResolucion]:checked").val());
	form_data.append("id_organizacion",$(this).attr("data-id-org"));
	$.ajax({
		url: baseURL + "admin/upload_resolucion",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			//setInterval(functions(){ redirect('resoluciones') }, 2000);
			$.ajax({
				url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
				dataType: "text",
				cache: false,
				contentType: false,
				processData: false,
				type: "post",
				dataType: "JSON",
				data: form_data,
				success: function (response) {
					console.log(response);
					$("#tbodyResoluciones").empty();
					$("#tbodyResoluciones>.odd").remove();
					tablaResoluciones(response, $(this).attr("data-id-org"));
				},
				error: function (ev) {
					//Do nothing
				},
			});
		},
		error: function (ev) {
			//Do nothing
		},
	});
	//}
});

$(document).on("click", ".eliminarResolucion", function () {
	var $id_resolucion = $(this).attr("data-id-res");
	var $id_organizacion = $(this).attr("data-id-org");
	var data = {
		id_resolucion: $id_resolucion,
		id_organizacion: $id_organizacion,
	};

	$.ajax({
		url: baseURL + "admin/eliminarResolucion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
			$.ajax({
				url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					$("#tbodyResoluciones").empty();
					$("#tbodyResoluciones>.odd").remove();
					tablaResoluciones(response, $id_organizacion);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		},
		error: function (ev) {
			//Do nothing
		},
	});
});

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
			$.ajax({
				url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					$("#tbodyResoluciones").empty();
					$("#tbodyResoluciones>.odd").remove();
					tablaResoluciones(response, $(this).attr("id-org"));
				},
				error: function (ev) {
					//Do nothing
				},
			});
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
