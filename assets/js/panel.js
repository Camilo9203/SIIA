/** Ver Solicitudes */
$("#verSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#solicitudesRegistradas").show();
});
/** Volver Solicitudes */
$(".volverSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#solicitudesRegistradas").show();
});
/** Volver Panel */
$(".volverPanel").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").show();
	$("#tipoSolicitud").hide();
	$("#solicitudesRegistradas").hide();
});
/** Ver Solicitud */
$(".verSolicitud").click(function () {
	alert();
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "panel/solicitud/" + idSolicitud, '_blank');
});
/** Ver Solicitud */
$(".verObservaciones").click(function () {
	alert();
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "panel/estadoSolicitud/" + idSolicitud, '_blank');
});
function irSolicitud (data) {
	event.preventDefault();
	$.ajax({
		url: baseURL + "panel/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_blank');
		}
	});
}
/** Crear Solicitud */
$("#nuevaSolicitud").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#solicitudesRegistradas").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").show();
	if (hash_url == "#actualizarSolicitud") {
		//Do Nothing
	}
	$.ajax({
		url: baseURL + "panel/verificar_tipoSolicitud",
		type: "post",
		dataType: "JSON",
		success: function (response) {
			console.log(response);
			if (response.estado == "1") {
				notificacion(response.msg, "success");
				$("#tipoSolicitud").hide();
				$("#estado_solicitud").show();
				$(".side_main_menu").show();
				verificarFormularios();
			} else if (response.estado == "0") {
				$("#div_solicitud").show();
				$("#div_motivo_actualizar").show();
			}
			if (response.est == "En Proceso de Renovación" || response.est == "En Proceso de Actualización"
			) {
				window.location.hash = "enProcesoActualizacion";
			} else if (response.est == "En Proceso" || response.est == "Negada" || response.est == "Revocada" || response.est == "Acreditado"
			) {
				window.location.hash = "enProceso";
				//$("#el_sol").attr("disabled", true);
				//$("#el_sol").remove();
			}
		},
		error: function (ev) {
			notificacion("Seleccione los campos y de click en crear.", "success");
		},
	});
});
