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
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
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
/** Organizaciones inscritas */
// Acciones de botones
$("#verSolicitudesRegistradas").click(function () {
	$("#actividadOrganizacion").slideUp();
	$("#solicitudesOrganizacion").slideDown();
});
$("#verActividadUsuario").click(function () {
	$("#solicitudesOrganizacion").slideUp();
	$("#actividadOrganizacion").slideDown();
});
$("#admin_ver_inscritas_tabla").click(function () {
	$("#solicitudesOrganizacion").hide();
	$("#actividadOrganizacion").hide();
	$("#admin_panel_org_inscritas").slideDown();
	$("#datos_organizaciones_inscritas").slideUp();
});

$(document).on("click", ".verSolicitudAdmin", function () {
	let idSolicitud = $(this).attr("data-id");
	let idOrganizacion = $(this).attr("data-id-org");
	window.open(baseURL + "panelAdmin/organizaciones/solicitudes/informacionSolicitud?idSolicitud=" + idSolicitud + "&idOrganizacion=" + idOrganizacion,'_self' )
});
// Traer datos de la organización inscrita
$(".ver_organizacion_inscrita").click(function () {
	var nit = $(this).attr("data-organizacion");
	var data = {
		id_organizacion: nit,
	};
	$.ajax({
		url: baseURL + "organizaciones/datosOrganzacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response)
			$("#admin_panel_org_inscritas").slideUp();
			$("#datos_organizaciones_inscritas").slideDown();
			$("#datos_organizaciones_inscritas #datos_basicos span").empty();
			$("#tabla_actividad_inscritas  #tbody_actividad").empty();
			$("#tabla_actividad_inscritas  #tbody_actividad").html("");
			$("#tabla_solicitudes_organizacion  #tbody_solicitudes").empty();
			$("#tabla_solicitudes_organizacion  #tbody_solicitudes").html("");
			$("#inscritas_nombre_organizacion").append("<p>" + response.organizacion.nombreOrganizacion + "</p>");
			$("#inscritas_nit_organizacion").append("<p>" + response.organizacion.numNIT + "</p>");
			$("#inscritas_sigla_organizacion").append("<p>" + response.organizacion.sigla + "</p>");
			$("#inscritas_nombreRepLegal_organizacion").append(
				"<p>" +
				response.organizacion.primerNombreRepLegal +
				" " +
				response.organizacion.segundoNombreRepLegal +
				" " +
				response.organizacion.primerApellidoRepLegal +
				" " +
				response.organizacion.segundoApellidoRepLegal +
				"</p>"
			);
			$("#inscritas_direccionCorreoElectronicoOrganizacion_organizacion").append("<p>" + response.organizacion.direccionCorreoElectronicoOrganizacion + "</p>");
			$("#inscritas_direccionCorreoElectronicoRepLegal_organizacion").append("<p>" + response.organizacion.direccionCorreoElectronicoRepLegal + "</p>");
			$("#inscritas_usuario").append("<p>" + response.usuario.usuario + "</p>");
			$("#inscritas_imagenOrganizacion_organizacion").attr("src", baseURL + "uploads/logosOrganizaciones/" + response.organizacion.imagenOrganizacion);
			// Construir tablas
			$("#tbody_solicitudes .odd").remove();
			if(response.solicitudes.length > 0) {
				for (var i = 0; i < response.solicitudes.length; i++) {
					$("#tbody_solicitudes").append("<tr id=" + i + ">");
					$("#tbody_solicitudes>tr#" + i + "").append("<td>" + response.solicitudes[i].idSolicitud + "</td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td>" + response.solicitudes[i].nombre + "</td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td>" + response.solicitudes[i].fechaCreacion + "</td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td>" + response.solicitudes[i].asignada + "</td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td>" + response.solicitudes[i].modalidadSolicitud + "</td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td><textarea style='width: 300px; height: 140px; resize: none; border: hidden' readonly>" + response.solicitudes[i].motivoSolicitud + "</textarea></td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td>" + response.solicitudes[i].tipoSolicitud + "</td>");
					$("#tbody_solicitudes>tr#" + i + "").append("<td> <button class='btn btn-success btn-sm verSolicitudAdmin' data-id='"
						+ response.solicitudes[i].idSolicitud
						+ "' data-id-org='" + response.organizacion.id_organizacion + "'>Ver Solicitud<i class='fa fa-eye' aria-hidden='true' </button></td>");
					$("#tbody_solicitudes").append("</tr>");
				}
				paging("tabla_solicitudes_organizacion");
			}
			else {
				$("#tbody_solicitudes").append("<tr>");
					$("#tbody_solicitudes>tr").append("<td colspan='8'> Sin datos para mostrar </td>");
				$("#tbody_solicitudes").append("</tr>");
			}
			if(response.actividad.length > 0) {
				$("#tbody_actividad .odd").remove();
				for (var i = 0; i < response.actividad.length; i++) {
					$("#tbody_actividad").append("<tr id=" + i + ">");
					$("#tbody_actividad>tr#" + i + "").append("<td>" + response.actividad[i].accion + "</td>");
					$("#tbody_actividad>tr#" + i + "").append("<td>" + response.actividad[i].fecha + "</td>");
					$("#tbody_actividad>tr#" + i + "").append("<td>" + response.actividad[i].usuario_ip + "</td>");
					$("#tbody_actividad>tr#" + i + "").append("<td>" + response.actividad[i].user_agent + "</td>");
					$("#tbody_actividad").append("</tr>");
				}
				paging("tabla_actividad_inscritas");
			}
			else {
				$("#tbody_actividad").append("<tr>");
					$("#tbody_actividad>tr").append("<td colspan='4'> Sin datos para mostrar </td>");
				$("#tbody_actividad").append("</tr>");
			}

		},
		error: function (ev) {
			//Do nothing
		},
	});
});

/**
 * Modal detalle organización
 */
$(".organizacion-modal-detalle").click(function () {
	alert('1')
	data = {
		id: $(this).attr("data-id"),
	};
	$.ajax({
		url: baseURL + "organizaciones/datosOrganzacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#super_id_admin_modal").html("");
			$("#super_status_adm").html("");
			$("#super_status_adm").css("color", "white");
			$("#super_status_adm").css("padding", "5px");
			$("#super_id_admin_modal").html(response.administrador.id_administrador);
			$("#super_primernombre_admin").val(response.administrador.primerNombreAdministrador);
			$("#super_segundonombre_admin").val(response.administrador.segundoNombreAdministrador);
			$("#super_primerapellido_admin").val(response.administrador.primerApellidoAdministrador);
			$("#super_segundoapellido_admin").val(response.administrador.segundoApellidoAdministrador);
			$("#super_numerocedula_admin").val(response.administrador.numCedulaCiudadaniaAdministrador);
			$("#super_ext_admin").val(response.administrador.ext);
			$("#super_nombre_admin").val(response.administrador.usuario);
			$("#super_correo_electronico_admin").val(response.administrador.direccionCorreoElectronico);
			$("#super_acceso_nvl option[value='" + response.administrador.nivel + "']").prop("selected", true);
			$("#super_contrasena_admin").val(response.password);
			// Comprobar conexión de usuario
			if (response.administrador.logged_in == 1) {
				$("#super_status_adm").css("background-color", "#398439");
				$("#super_status_adm").html("Estado: En linea");
				$("#super_id_admin_modal").prop("disabled", true);
				$("#super_eliminar_admin").prop("disabled", true);
				$("#super_actualizar_admin").prop("disabled", true);
				$("#super_nombre_admin_modal").prop("disabled", true);
				$("#super_primernombre_admin").prop("disabled", true);
				$("#super_segundonombre_admin").prop("disabled", true);
				$("#super_primerapellido_admin").prop("disabled", true);
				$("#super_segundoapellido_admin").prop("disabled", true);
				$("#super_numerocedula_admin").prop("disabled", true);
				$("#super_contrasena_admin").prop("disabled", true);
				$("#super_correo_electronico_admin").prop("disabled", true);
				$("#super_acceso_nvl").prop("disabled", true);
			} else {
				$("#super_status_adm").css("background-color", "#c61f1b");
				$("#super_status_adm").html("Estado: No conectado");
				$("#super_id_admin_modal").prop("disabled", false);
				$("#super_eliminar_admin").prop("disabled", false);
				$("#super_actualizar_admin").prop("disabled", false);
				$("#super_primernombre_admin").prop("disabled", false);
				$("#super_segundonombre_admin").prop("disabled", false);
				$("#super_primerapellido_admin").prop("disabled", false);
				$("#super_segundoapellido_admin").prop("disabled", false);
				$("#super_numerocedula_admin").prop("disabled", false);
				$("#super_nombre_admin").prop("disabled", false);
				$("#super_contrasena_admin").prop("disabled", false);
				$("#super_correo_electronico_admin").prop("disabled", false);
				$("#super_acceso_nvl").prop("disabled", false);
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});

});
