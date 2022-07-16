let hash_url = window.location.hash;
/** Ver Solicitudes */
$("#verSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#solicitudesRegistradas").show();
});
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
