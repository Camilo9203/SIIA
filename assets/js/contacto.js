var url = unescape(window.location.href);
var activate = url.split("/");
var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
var correos;
var correosAcreditadas;
var correosTodos;
$.ajax({
	url: baseURL + "Admin/cargarCorreos",
	type: "GET",
	success: function (response) {
		correos = JSON.parse(response);
	},
});
$.ajax({
	url: baseURL + "Admin/cargarCorreosAcreditadas",
	type: "GET",
	success: function (response) {
		correosAcreditadas = JSON.parse(response);
	},
});

$("#enviar_correo_contacto_admin").click(function () {
	if ($("#contacto_enviar_copia_admin_todos").prop("checked")) {
		data = {
			masivo: correosTodos,
			prioridad: $("#contacto_prioridad_admin").val(),
			asunto: $("#contacto_asunto_admin").val(),
			mensaje: CKEDITOR.instances.contacto_mensaje_admin.getData(),
		};
		console.log(data.correo_electronico);
	} else if ($("#contacto_enviar_copia_admin_todos_acre").prop("checked")) {
		data = {
			masivo: correosAcreditadas,
			prioridad: $("#contacto_prioridad_admin").val(),
			asunto: $("#contacto_asunto_admin").val(),
			mensaje: CKEDITOR.instances.contacto_mensaje_admin.getData(),
		};
	} else {
		data = {
			correo_electronico: $("#contacto_correo_electronico_admin").val(),
			prioridad: $("#contacto_prioridad_admin").val(),
			asunto: $("#contacto_asunto_admin").val(),
			mensaje: CKEDITOR.instances.contacto_mensaje_admin.getData(),
		};
		if ($("#contacto_copia_admin").is(":visible")) {
			data.correo_electronico_rep = $(
				"#contacto_correo_electronico_rep_admin"
			).val();
			console.log(data.correo_electronico_rep);
		} else {
			data.correo_electronico_rep = "";
		}
	}

	// if ($("#comunicado").is(":visible")) {
	// 	data.todos = "";
	// } else {
	// 	if ($("#contacto_enviar_copia_admin_todos").prop("checked")) {
	// 		data.todos = 1;
	// 	} else if ($("#contacto_enviar_copia_admin_todos_acre").prop("checked")) {
	// 		data.todos = 2;
	// 	} else {
	// 		data.todos = 1;
	// 	}
	// }

	$.ajax({
		url: baseURL + "admin/enviomail_contacto",
		type: "POST",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere, enviando...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
// TODO: Formulario de contacto administrador
$("#enviar_correo_contacto").click(function () {
	$correo_electronico = $("#contacto_correo_electronico").val();
	$nombre = $("#contacto_nombre").val();
	$prioridad = $("#contacto_prioridad").val();
	$asunto = $("#contacto_asunto").val();
	$mensaje = $("#contacto_mensaje").val();
	data = {
		correo_electronico: $correo_electronico,
		nombre: $nombre,
		prioridad: $prioridad,
		asunto: $asunto,
		mensaje: $mensaje,
	};
	if ($("#contacto_copia").is(":visible")) {
		data.correo_electronico_rep = $("#contacto_correo_electronico_rep").val();
	} else {
		data.correo_electronico_rep = "";
	}

	$.ajax({
		url: baseURL + "contacto/enviomail_contacto",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere, enviando...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});

$("#contaco_enviar_copia").click(function () {
	if ($("#contaco_enviar_copia").prop("checked")) {
		$("#contacto_copia").show();
	} else {
		$("#contacto_copia").hide();
	}
});

// Cheked Correo a todas las entidades.
$("#contacto_enviar_copia_admin_todos").click(function () {
	// Si esta check
	if ($("#contacto_enviar_copia_admin_todos").prop("checked")) {
		// Deshabilitar y deschequear el envio a todas las entidades
		$("#contacto_enviar_copia_admin_todos_acre").prop("cheked", false);
		$("#contacto_enviar_copia_admin_todos_acre").prop("disabled", true);
		// Ocultar select de emails
		$("#comunicado").hide();
		// Asignar asunto automaticamente
		$("#contacto_asunto_admin").val("Comunicado SIIA: ");
		// Capturar todos los correos de las organizaciones y convertirlo en archivo separado por ;
		for (i = 0; i < correos.length; i++) {
			if (correosTodos == "") {
				// Si el archivo esta vacio carga el primer correo evitando que se carga un ; adicional
				correosTodos = correos[$i].direccionCorreoElectronicoOrganizacion;
			} else {
				// Se llena variable de texto, con los emails sepados por ; (Solo Emails de la organizacion)
				correosTodos =
					correosTodos +
					";" +
					correos[i].direccionCorreoElectronicoOrganizacion;
			}
		}
		console.log(correosTodos);
	} else {
		// Habilitar checkbox de envio correo a todas las entidades acreditadas
		$("#contacto_enviar_copia_admin_todos_acre").prop("disabled", false);
		// Ver seccion comunicado
		$("#comunicado").show();
		// Dejar asunto en blanco
		$("#contacto_asunto_admin").val("");
		correosTodos = "";
	}
});
// Cheked a todas las entidades acreditadas.
$("#contacto_enviar_copia_admin_todos_acre").click(function () {
	// Si esta check
	if ($("#contacto_enviar_copia_admin_todos_acre").prop("checked")) {
		// Deshabilitar y deschequear el envio a todas las entidades
		$("#contacto_enviar_copia_admin_todos").prop("cheked", false);
		$("#contacto_enviar_copia_admin_todos").prop("disabled", true);
		// Ocultar select de emails
		$("#comunicado").hide();
		// Asignar asunto automaticamente
		$("#contacto_asunto_admin").val("Entidades acreditadas en el SIIA: ");
		// Capturar todos los correos de las organizaciones y convertirlo en archivo separado por ;
		for (i = 0; i < correos.length; i++) {
			if (correosAcreditadas == "") {
				// Si el archivo esta vacio carga el primer correo evitando que se carga un ; adicional
				correosAcreditadas = correos[$i].direccionCorreoElectronicoOrganizacion;
			} else {
				// Se llena variable de texto, con los emails sepados por ; (Solo Emails de la organizacion)
				correosAcreditadas =
					correosAcreditadas +
					";" +
					correos[i].direccionCorreoElectronicoOrganizacion;
			}
		}
		console.log(correosAcreditadas);
	} else {
		// Habilitar checkbox de envio correo a todas las entidades
		$("#contacto_enviar_copia_admin_todos").prop("disabled", false);
		// Ver seccion comunicado
		$("#comunicado").show();
		// Dejar asunto en blanco
		$("#contacto_asunto_admin").val("");
		correosAcreditadas = "";
	}
});
// TODO: Falta por comentar
$("#contacto_correo_electronico_admin").change(function () {
	$("#contacto_enviar_copia_admin").prop("checked", false);
	$("#contacto_copia_admin").hide();
	if (
		$("#contacto_correo_electronico_admin").val() == "Seleccione una opción"
	) {
		$("#contacto_enviar_copia_admin").prop("disabled", true);
		$("#contacto_enviar_copia_admin").prop("checked", false);
		$("#contacto_enviar_copia_admin_todos").prop("cheked", false);
		$("#contacto_enviar_copia_admin_todos").prop("disabled", false);
		$("#contacto_enviar_copia_admin_todos_acre").prop("cheked", false);
		$("#contacto_enviar_copia_admin_todos_acre").prop("disabled", false);
		$("#contacto_copia_admin").hide();
	} else {
		$("#contacto_enviar_copia_admin").prop("disabled", false);
		$("#contacto_enviar_copia_admin_todos").prop("disabled", true);
		$("#contacto_enviar_copia_admin_todos_acre").prop("disabled", true);
	}
});
// TODO: Buscar correo representante legal por medio de checked box
$("#contacto_enviar_copia_admin").click(function () {
	if ($("#contacto_enviar_copia_admin").prop("checked")) {
		// Variable correo admin
		$correoAdmin = $("#contacto_correo_electronico_admin").val();
		// Mostrar campo con representante legal
		$("#contacto_copia_admin").show();
		// Buscar Correo Rep Legal por medio de variable correos (ajax)
		for (i = 0; i < correos.length; i++) {
			if (correos[i].direccionCorreoElectronicoOrganizacion == $correoAdmin) {
				$correoRepLegal = correos[i].direccionCorreoElectronicoRepLegal;
			}
		}
		// Llevar valor de correo Rep Legal a campo input y deshabilitar campo
		$("#contacto_correo_electronico_rep_admin").val($correoRepLegal);
		$("#contacto_correo_electronico_rep_admin").prop("disabled", true);
		// Pruebas
		console.log(correos);
		console.log($("#contacto_correo_electronico_rep_admin").val());
	} else {
		$("#contacto_copia_admin").hide();
	}
});
