/** Modal Asignar Evaluador Organización */
$(document).on("click", "#verModalAsignar", function () {
	let id_organizacion = $(this).attr("data-organizacion");
	let nombreOrganizacion = $(this).attr("data-nombre");
	let numNIT = $(this).attr("data-nit");
	let idSolicitud = $(this).attr("data-solicitud");

	$("#idAsigOrg").html(id_organizacion);
	$("#nombreAsigOrg").html(nombreOrganizacion);
	$("#nitAsigOrg").html(numNIT);
	$("#idSolicitud").html(idSolicitud);
});
/** Asignar evaluador a solicitud */
$("#asignarOrganizacionEvaluador").click(function () {

	data = {
		id_organizacion: $("#idAsigOrg").html(),
		idSolicitud: $("#idSolicitud").html(),
		evaluadorAsignar: $("#evaluadorAsignar").val(),
	};

	$.ajax({
		url: baseURL + "solicitudes/asignarEvaluadorSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere, asignando...", "success");
			$("#asignarOrganizacionEvaluador").attr("disabled", true);
		},
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				redirect(baseURL + response.url);
			}, 3500);
			$("#asignarOrganizacion").toggle();
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
