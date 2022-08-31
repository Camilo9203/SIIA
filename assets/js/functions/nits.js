/** Campos automaticos por NIT de resolución automaticos */
$("#nit_acre_org").change( function (){
	let html = "";
	let data = {
		id: $("#nit_acre_org").val()
	};
	$.ajax({
		url: baseURL + "Nit/cargarDatosOrganizacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
			let nombreOrganizacion = response.organizacion[0].nombreOrganizacion;
			let resoluciones = response.resoluciones;
			$("#nombre_acre_org").val(nombreOrganizacion);
			html += "<option selected> Seleccionar Resolución</option>"
			// Recorrer respuesta del controlador
			$.each(resoluciones, function (key, resolucion) {
				// Guardar opción html en variable
				html +=
					"<option value=" +
					resolucion.numeroResolucion +
					">" +
					resolucion.numeroResolucion +
					"</option>";
			});
			// Añadir varible de opción html al select de municipio
			$("#res_acre_org").html(html);
			$("#res_acre_org").prop('disabled', false);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Campo automatico fecha fin de resolución */
$("#res_acre_org").change( function (){
	$("#fech_fin_acre_org").val('');
	let data = {
		idResolucion: $("#res_acre_org").val()
	};
	$.ajax({
		url: baseURL + "Nit/cargarDatosResolucion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
			if(response.resolucion.fechaResolucionFinal){
				$("#fech_fin_acre_org").val(response.resolucion.fechaResolucionFinal);
			}else {
				notificacion("Resolución sin fecha de finalización")
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});

$("#guardar_nit_org_acre").click(function () {
	$nit_org = ;
	$nombreOrganizacion = $("#nombre_acre_org").val();
	$numeroResolucion = $("#res_acre_org").val();
	$fechaFinalizacion = $("#fech_fin_acre_org").val();

	data = {
		nit_org: $nit_org,
		nombreOrganizacion: $nombreOrganizacion,
		numeroResolucion: $numeroResolucion,
		fechaFinalizacion: $fechaFinalizacion,
	};

	$.ajax({
		url: baseURL + "admin/guardarNitAcreditadas",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});

$(".eliminarNitAcreOrg").click(function () {
	$id_nit = $(this).attr("data-id-nit");

	data = {
		id_nit: $id_nit,
	};

	$.ajax({
		url: baseURL + "admin/eliminarNitAcreditadas",
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
