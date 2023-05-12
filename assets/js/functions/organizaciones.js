/** Solicitud camara de comercio organización. */
$("#volverPedirCamara").click(function () {
	data = {
		id_organizacion: $("#id_org_ver_form").attr("data-id"),
	};
	$.ajax({
		url: baseURL + "organizaciones/solicitarCamara",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Un momento... Registrando solicitud", "success");
			$("#volverPedirCamara").attr("disabled", true);
		},
		success: function (response) {
			notificacion(response.msg, "success");
			$("#modalPedirCamara").modal("toggle");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Ver organización camara de comercio. */
$(".ver_adjuntar_camara").click(function () {
	let $id_org = $(this).attr("data-organizacion");
	$("#id_org_ver_form").remove();
	$("body").append(
		"<div id='id_org_ver_form' class='hidden' data-id='" + $id_org + "'>"
	);
	let data = {
		id_organizacion: $id_org,
	};
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#admin_ver_finalizadas").slideUp();
			$("#datos_org_camara").slideDown();
			$("#adjuntar_camara").attr("data-id-org", $id_org);
			$("#camara").attr("data-id-org", $id_org);
			$("#camara_nombre_org").html(response.organizaciones.nombreOrganizacion);
			$("#camara_nit_org").html(response.organizaciones.numNIT);
			$("#camara_nombreRep_org").html(response.organizaciones.primerNombreRepLegal + " " + response.organizaciones.segundoNombreRepLegal + " " + response.organizaciones.primerApellidoRepLegal + " " + response.organizaciones.segundoApellidoRepLegal);
			$("#ver_camara_org").attr("href", baseURL + "uploads/camaraComercio/" + response.organizaciones.camaraComercio);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Botón regresó a tabla de camara de comercio. */
$("#volver_cama_org").click(function () {
	$("#admin_ver_finalizadas").slideDown();
	$("#datos_org_camara").slideUp();
});
/** Adjuntar camara de comercio organización. */
$("#adjuntar_camara").on("click", function () {
	//if($("#formulario_actualizar_imagen").valid()){
	let file_data = $("#camara").prop("files")[0];
	let form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("id_organizacion", $(this).attr("data-id-org"));
	$.ajax({
		url: baseURL + "organizaciones/subirCamara",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSend: function () {
			notificacion("Subiendo archivo...", "success");
		},
		success: function (response) {
			if(response.estado == 'cargado') {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(response.url);
				}, 3000);
			}
			else {
				notificacion(response.msg, "success");
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
	//}
});
