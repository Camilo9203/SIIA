/**
 * Acciones administrador
 */
// Modal Asignar Evaluador Organización
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
// Asignar evaluador a solicitud
$("#asignarOrganizacionEvaluador").click(function () {

	let data = {
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
			Toast.fire({
				icon: 'info',
				title: 'Asignando'
			})
			$("#asignarOrganizacionEvaluador").attr("disabled", true);
		},
		success: function (response) {
			$("#asignarOrganizacion").toggle();
			Alert.fire({
				title: response.title,
				html: response.msg,
				text: response.msg,
				icon: response.status,
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
			})
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
