let hash_url = window.location.hash;
/** Ver Solicitudes */
$("#verSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
	$("#solicitudesRegistradas").show();
});
/** Volver Solicitudes */
$(".volverSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
	$("#solicitudesRegistradas").show();
});
/** Volver Panel */
$(".volverPanel").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").show();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
});
/** Ver Solicitud */
$(".verSolicitud").click(function () {
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "panel/solicitud/" + idSolicitud, '_self');
});
/** Ver modal y cargar variable de solicitud */
$(".eliminarSolicitudModal").click(function () {
	let idSolicitud = $(this).attr("data-id");
	$('#eliminarSolicitud').attr('data-id', idSolicitud);
	$('#solicitudAEliminar').html("¿Estás seguro de eliminar la solicitud <span class='spanRojo'>" + idSolicitud + "</span>?");
});
/** Ver Eliminar */
$(".eliminarSolicitud").click(function () {
	let data = {
		idSolicitud: $(this).attr('data-id'),
	};
	$.ajax({
		url: baseURL + "panel/eliminarSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				reload();
			}, 4000);
		},
		error: function (ev) {
			event.preventDefault();
			console.log(ev);
			notificacion("Ocurrió un error y no se elimino solicitud");
		},
	});
});
$("#noEliminarSolicitud").click(function () {
	$("#modalEliminarSolicitud").modal("hide");
});
/** Ver Estado Solicitud */
$(".verObservaciones").click(function () {
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "panel/estadoSolicitud/" + idSolicitud, '_self');
});
function irSolicitud (data) {
	event.preventDefault();
	$.ajax({
		url: baseURL + "panel/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_self');
		}
	});
}
/** Crear Solicitud */
$("#nuevaSolicitud").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
	$("#tipoSolicitud").show();
	// if (hash_url == "#actualizarSolicitud") {
	// 	//Do Nothing
	// }
	// $.ajax({
	// 	url: baseURL + "panel/verificar_tipoSolicitud",
	// 	type: "post",
	// 	dataType: "JSON",
	// 	success: functions (response) {
	// 		console.log(response);
	// 		if (response.estado == "1") {
	// 			notificacion(response.msg, "success");
	// 			$("#tipoSolicitud").hide();
	// 			$("#estado_solicitud").show();
	// 			$(".side_main_menu").show();
	// 			verificarFormularios();
	// 		} else if (response.estado == "0") {
	// 			$("#div_solicitud").show();
	// 			$("#div_motivo_actualizar").show();
	// 		}
	// 		if (response.est == "En Proceso de Renovación" || response.est == "En Proceso de Actualización"
	// 		) {
	// 			window.location.hash = "enProcesoActualizacion";
	// 		} else if (response.est == "En Proceso" || response.est == "Negada" || response.est == "Revocada" || response.est == "Acreditado"
	// 		) {
	// 			window.location.hash = "enProceso";
	// 			//$("#el_sol").attr("disabled", true);
	// 			//$("#el_sol").remove();
	// 		}
	// 	},
	// 	error: functions (ev) {
	// 		notificacion("Seleccione los campos y de click en crear.", "success");
	// 	},
	// });
});
