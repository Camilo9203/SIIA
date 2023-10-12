/**
 * Volver a panel
 * */
$(".volverPanelPerfil").click(function () {
	window.open(baseURL + "panel", '_self');
});
$('#configuracion').change(function () {
	let configuracion = $('#configuracion').val();
	switch (configuracion) {
		case '1':
			Toast.fire({
				icon: 'success',
				text: 'Actualizar información básica'
			});
			$("#datosSesion").slideUp();
			$("#certificados").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#actividad").slideUp();
			$("#informacionBasicaPerfil").slideDown();
			break;
		case '2':
			Toast.fire({
				icon: 'success',
				text: 'Actualizar firma representante legal'
			});
			$("#datosSesion").slideUp();
			$("#certificados").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#actividad").slideUp();
			$("#firmaRepLegalPerfil").slideDown();
			break;
		case '3':
			Toast.fire({
				icon: 'success',
				text: 'Actualizar datos de inicio de sesión'
			});
			$("#certificados").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#actividad").slideUp();
			$("#datosSesion").slideDown();
			break
		case '4':
			Toast.fire({
				icon: 'success',
				text: 'Actualizar certificados'
			});
			$("#datosSesion").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#actividad").slideUp();
			$("#certificados").slideDown();
			break;
		case '5':
			Toast.fire({
				icon: 'success',
				text: 'Ver actividad en el sistema'
			});
			$("#datosSesion").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#certificados").slideUp();
			$("#actividad").slideDown();
			break;
		default:
			Toast.fire({
				icon: 'info',
				text: 'Seleccione una opción valida'
			});
			$("#datosSesion").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#certificados").slideUp();
			$("#actividad").slideUp();
			break;
	}

});
// Actualizar imagen perfil
$("#actualizar_imagen").on("click", function () {
	validarFormulariosPerfil();
	if ($("#formulario_actualizar_logo").valid()) {
		let file_data = $("#logoOrganizacion").prop("files")[0];
		let form_data = new FormData();
		form_data.append("file", file_data);
		$.ajax({
			url: baseURL + "perfil/actualizarLogoOrganizacion",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Cargando...'
				});
			},
			success: function (response) {
				console.log(response)
				Alert.fire({
					title: 'Imagen de perfil actualizada!',
					text: response.msg,
					icon: response.icon,
					confirmButtonText: 'Aceptar',
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							reload();
						}, 2000);
					}
				})
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.log(jqXHR, textStatus, errorThrown);
			},
		});
	}
});
// Actualizar información
$("#actualizar_informacion").click(function () {
	validarFormulariosPerfil();
	if ($("#formulario_actualizar").valid()) {
		let data = {
			organizacion: $("#organizacion").val(),
			nit: $("#nit").val(),
			sigla: $("#sigla").val(),
			nombre: $("#nombre").val(),
			nombre_s: $("#nombre_s").val(),
			apellido: $("#apellido").val(),
			apellido_s: $("#apellido_s").val(),
			correo_electronico: $("#correo_electronico").val(),
			correo_electronico_rep_legal: $("#correo_electronico_rep_legal").val(),
			nombre_p: $("#nombre_p").val(),
			apellido_p: $("#apellido_p").val(),
			tipo_organizacion: $("#tipo_organizacion").val(),
			departamento: $("#departamentos").val(),
			municipio: $("#municipios").val(),
			direccion: $("#direccion").val(),
			fax: $("#fax").val(),
			extension: $("#extension").val(),
			urlOrganizacion: $("#urlOrganizacion").val(),
			actuacion: $("#actuacion").val(),
			educacion: $("#educacion").val(),
			numCedulaCiudadaniaPersona: $("#numCedulaCiudadaniaPersona").val(),
		};
		// Petición ajax para actualizar info
		$.ajax({
			url: baseURL + "Perfil/actualizarInformacionPerfil",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Espere... Guardando información...'
				});
			},
			success: function (response) {
				if(response.status == 'success') {
					Alert.fire({
						title: response.title,
						text: response.msg,
						icon: response.status,
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 1000);
						}
					})
				}
				else{
					Alert.fire({
						title: 'Error al guardar!',
						text: response.msg,
						icon: 'error',
					})
				}
			},
			error: function (ev) {
				console.log(ev)
				Alert.fire({
					title: 'Error interno!',
					text: ev.responseText,
					html: ev.responseText,
					icon: 'error',
				});
			},
		});
	}
});
$("#admin_ver_inscritas_tabla").click(function () {
	$("#solicitudesOrganizacion").hide();
	$("#actividadOrganizacion").hide();
	$("#admin_panel_org_inscritas").slideDown();
	$("#datos_organizaciones_inscritas").slideUp();
});
// Validar formularios
function validarFormulariosPerfil() {
	// Formulario actualizar imagen de perfil
	$("form[id='formulario_actualizar_logo']").validate({
		rules: {
			logoOrganizacion: {
				required: true,
				validators: {
					notEmpty: {
						message: "Por favor, seleccione una imagen en JPG, PNG, JPEG.",
					},
					file: {
						extension: "jpeg,jpg,png",
						type: "image/jpeg,image/png",
						maxSize: 20000, // 2048 * 1024 1024 * 2
						message: "La imagen selecionada no es válida, seleccione otra.",
					},
				},
			},
		},
		messages: {
			logoOrganizacion: {
				required: "Por favor, seleccione una imagen en JPG, PNG, JPEG.",
			},
		},
	});
	// Formulario Actualizar.
	$("form[id='formulario_actualizar']").validate({
		rules: {
			organizacion: {
				required: true,
				minlength: 3,
			},
			nit: {
				required: true,
				minlength: 3,
				regex: "^[^.][0-9]+-[0-9]{1}?$",
			},
			sigla: {
				required: true,
				minlength: 3,
			},
			primer_nombre_rep_legal: {
				required: true,
				minlength: 3,
			},
			primer_apellido_rep_regal: {
				required: true,
				minlength: 3,
			},
			correo_electronico: {
				required: true,
				minlength: 3,
				email: true,
			},
			correo_electronico_rep_legal: {
				required: true,
				minlength: 3,
				email: true,
			},
			primer_nombre_persona: {
				required: true,
				minlength: 3,
			},
			primer_apellido_persona: {
				required: true,
				minlength: 3,
			},
			urlOrganizacion: {
				required: true,
				url: true
			}
		},
		messages: {
			organizacion: {
				required: "Por favor, escriba el nombre de la organización.",
				minlength:
					"El nombre de la organización debe tener mínimo 3 caracteres.",
			},
			nit: {
				required: "Por favor, escriba el NIT de la organización.",
				minlength: "El nit debe tener mínimo 3 caracteres.",
				regex: "Por favor, escriba un NIT válido, sin puntos y con (-).",
			},
			sigla: {
				required: "Por favor, escriba la Sigla de la organización.",
				minlength:
					"El nombre de la organización debe tener mínimo 3 caracteres.",
			},
			primer_nombre_rep_legal: {
				required:
					"Por favor, escriba el Primer Nombre del Representante Legal.",
				minlength:
					"El Primer Nombre del Representante Legal debe tener mínimo 3 caracteres.",
			},
			primer_apellido_rep_regal: {
				required:
					"Por favor, escriba el Primer Apellido del Representante Legal.",
				minlength:
					"El Primer Apellido del Representante Legal debe tener mínimo 3 caracteres.",
			},
			correo_electronico: {
				required: "Por favor, escriba un Correo Electrónico válido.",
				minlength:
					"El Correo Electrónico de la organización debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			correo_electronico_rep_legal: {
				required: "Por favor, escriba un Correo Electrónico válido.",
				minlength:
					"El Correo Electrónico del Representante Legal debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			primer_nombre_persona: {
				required: "Por favor, escriba su Primer Nombre.",
				minlength: "Su Primer Nombre debe tener mínimo 3 caracteres.",
			},
			primer_apellido_persona: {
				required: "Por favor, escriba su Primer Apellido.",
				minlength: "Su Primer Apellido debe tener mínimo 3 caracteres.",
			},
			urlOrganizacion: {
				required: 'Registre su pagina web',
				url: 'Requiere una url valida. Ej: http://www.ejemplo.com'
			}
		},
	});
}
