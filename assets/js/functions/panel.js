let hash_url = window.location.hash;
/**
 * Ver Solicitudes
 * */
$("#verSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
	$("#solicitudesRegistradas").show();
});
/**
 * Volver Solicitudes
 * */
$(".volverSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
	$("#solicitudesRegistradas").show();
});
/**
 * Volver Panel
 * */
$(".volverPanel").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").show();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
});
/**
 * Ver Solicitud
 *  */
$(".verSolicitud").click(function () {
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "solicitudes/solicitud/" + idSolicitud, '_self');
});
/**
 * Ver modal y cargar variable de solicitud
 * */
$(".eliminarSolicitudModal").click(function () {
	let idSolicitud = $(this).attr("data-id");
	$('#eliminarSolicitud').attr('data-id', idSolicitud);
	$('#solicitudAEliminar').html("¿Estás seguro de eliminar la solicitud<span class='spanRojo'>" + idSolicitud + "</span>?");
});
/**
 * Ver Solicitud
 * */
$(".verDetalleSolicitud").click(function () {
	let html = ''
	let data = {
		idSolicitud: $(this).attr('data-id')
	}
	$.ajax({
		url: baseURL + "solicitudes/cargarDatosSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			html += "<p><label class='font-weight-bold'>Solicitud Número: </label> " + response.solicitud['idSolicitud'] + "</p>";
			html += "<p><label class='font-weight-bold'>Tipo: </label> " + response.solicitud['tipoSolicitud'] + "</p>";
			html += "<p><label class='font-weight-bold'>Motivo: </label> " + response.solicitud['motivoSolicitud'] + "</p>";
			html += "<p><label class='font-weight-bold'>Modalidad: </label> " + response.solicitud['modalidadSolicitud'] + "</p>";
			$("#informacionSolicitudBasico").html(html);
			html = ""
			html += "<p><label class='font-weight-bold'>Fecha de Creación: </label> " + response.solicitud['fecha'] + "</p>";
			html += "<p><label class='font-weight-bold'>Fecha de Finalización: </label> " + response.solicitud['fechaFinalizado'] + "</p>";
			html += "<p><label class='font-weight-bold'>Fecha Ultima Revisión: </label> " +  response.solicitud['fechaUltimaRevision'] + "</p>";
			$("#informacionSolicitudFechas").html(html);
			html = ""
			html += "<p><label class='font-weight-bold'>Estado: </label> <code>" +  response.solicitud['nombre'] + "</code></p>";
			html += "<p><label class='font-weight-bold'>Estado Anterior: </label> " + response.solicitud['estadoAnterior'] + "</p>";
			html += "<p><label class='font-weight-bold'>Asignada: </label> " +  response.solicitud['asignada'] + "</p>";
			html += "<p><label class='font-weight-bold'>Revisiones: </label> " +  response.solicitud['numeroRevisiones'] + "</p>";
			html += "<p><label class='font-weight-bold'>Solicitud: </label> " +  response.solicitud['numeroSolicitudes'] + "</p>";
			$("#informacionSolicitudEstado").html(html);
		},
		error: function (ev) {
			console.log(ev);
		},
	})
});
/**
 * Ver eliminar
 * */
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
			Toast.fire({
				icon: 'danger',
				title: 'Eliminando solitud'
			});
		},
		success: function (response) {
			Alert.fire({
				title: 'Solicitud eliminada!',
				html: response.msg,
				text: response.msg,
				icon: 'success',
				confirmButtonText: 'Aceptar',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
			})
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
/**
 * Ver estado solicitud
 * */
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
/**
 * Crear Solicitud
 * */
$("#nuevaSolicitud").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
	$("#tipoSolicitud").show();
});
