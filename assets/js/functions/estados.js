$("#actualizarEstadoOrganizacion").click(function () {
	let data = {
		idOrganizacion: $(this).attr("data-id-organizacion"),
		idSolicitud: $(this).attr("data-id-solicitud"),
		estadoSolicitud: $("#estadoSolicitud").val()
	};
	$.ajax({
		url: baseURL + "admin/actualizarEstadoOrganizacion",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Cargando...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			if(response.estado == 1) {
				setInterval(function () {
					reload();
				}, 2000);
			}else {
				event.preventDefault();
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
$("#tabla_enProceso_organizacion tbody").on("click", '.ver_estado_org', function () {
	let id_org = $(this).attr("data-organizacion");
	$("#id_org_ver_form").remove();
	$("body").append("<div id='id_org_ver_form' class='hidden' data-id='" + id_org + "'>");
	let data = {
		id_organizacion: id_org,
		idSolicitud: $(this).attr("data-solicitud")
	};
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#admin_ver_finalizadas").slideUp();
			$("#v_estado_org").slideDown();
			$("#actualizarEstadoOrganizacion").attr("data-id-organizacion", id_org);
			$("#actualizarEstadoOrganizacion").attr("data-id-solicitud", data["idSolicitud"]);
			$("#resolucion_nombre_org").html(response.organizaciones.nombreOrganizacion);
			$("#id_solicitud").html(response.estadoOrganizaciones.idSolicitud);
			$("#motivo_solicitud").html(response.estadoOrganizaciones.motivoSolicitudAcreditado);
			$("#estado_actual_org").html(response.estadoOrganizaciones.nombre);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
