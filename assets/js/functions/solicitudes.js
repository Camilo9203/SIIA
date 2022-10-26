let hash_url = window.location.hash;
/** Crear Solicitud */
$("#nuevaSolicitud").click(function () {
	$("#crearSolicitudes").hide();
	$("#tipoSolicitud").show();
});
/** Volver Solicitudes */
$(".volverSolicitudes").click(function () {
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
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
			Toast.fire({
				icon: 'warning',
				title: 'Borrando....'
			})
		},
		success: function (response) {
			Swal.fire({
				title: 'Solicitud Eliminada!',
				text: response.msg,
				icon: 'success',
				confirmButtonText: 'Finalizar',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
			});
		},
		error: function (ev) {
			event.preventDefault();
			console.log(ev);
			Toast.fire({
				icon: 'error',
				title: 'Ocurrio un error al borrar'
			})
		},
	});
});
/** Ver estado solicitud */
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


