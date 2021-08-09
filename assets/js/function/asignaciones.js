$(document).on("click", "#verModalAsignarDocente", function () {
	$id_docente = $(this).attr("data-docente");
	$nombreDocente = $(this).attr("data-nombre");

	$("#idDocente").html($id_docente);
	$("#nombreDocente").html($nombreDocente);
});
// TODO:Pendiente por enlazar
$("#asignarOrganizacionEvaluador").click(function () {
	$id_organizacion = $("#idDocente").html();
	$evaluadorAsignar = $("#evaluadorAsignar").val();

	data = {
		id_organizacion: $id_organizacion,
		evaluadorAsignar: $evaluadorAsignar,
	};

	$.ajax({
		url: baseURL + "admin/asignarOrganizacion",
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
