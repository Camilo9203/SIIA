/**
 * Volver a panel
 * */
$(".volverPanelPerfil").click(function () {
	window.open(baseURL + "panel", '_self');
});
validarFormulariosPerfil();
$('#configuracion').change(function () {
	let configuracion = $('#configuracion').val();
	switch (configuracion) {
		case '1':
			$("#datosSesion").slideUp();
			$("#certificados").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideDown();
			break;
		case '2':
			$("#datosSesion").slideUp();
			$("#certificados").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#firmaRepLegalPerfil").slideDown();
			break;
		case '3':
			$("#certificados").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#datosSesion").slideDown();
			break
		case '4':
			$("#datosSesion").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#certificados").slideDown();
			break;
		case '5':
			break;
		default:
			notificacion("Selecciona otra opción.");
	}

});
// Actualizar imagen perfil
$("#actualizar_imagen").on("click", function () {
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
	event.preventDefault();
	if ($("#formulario_actualizar").valid()) {
		var organizacion = $("#organizacion").val();
		var nit = $("#nit").val();
		var sigla = $("#sigla").val();
		var nombre = $("#nombre").val();
		var nombre_s = $("#nombre_s").val();
		var apellido = $("#apellido").val();
		var apellido_s = $("#apellido_s").val();
		var correo_electronico = $("#correo_electronico").val();
		var correo_electronico_rep_legal = $(
			"#correo_electronico_rep_legal"
		).val();
		var nombre_p = $("#nombre_p").val();
		var apellido_p = $("#apellido_p").val();

		//___

		var tipo_organizacion = $("#tipo_organizacion").val();
		var departamento = $("#departamentos").val();
		var municipio = $("#municipios").val();
		var direccion = $("#direccion").val();
		var fax = $("#fax").val();

		if ($("input:checkbox[name=extension_checkbox]:checked").val()) {
			var extension = $("#extension").val();
		} else {
			var extension = "No Tiene";
		}
		if ($("#urlOrganizacion").val()) {
			var urlOrganizacion = $("#urlOrganizacion").val();
		} else {
			var urlOrganizacion = "No Tiene";
		}

		var actuacion = $("#actuacion").val();
		var educacion = $("#educacion").val();
		var numCedulaCiudadaniaPersona = $("#numCedulaCiudadaniaPersona").val();

		if (
			organizacion.length > 0 &&
			nit.length > 0 &&
			nombre.length > 0 &&
			apellido.length > 0 &&
			correo_electronico.length > 0
		) {
			var data = {
				organizacion: organizacion,
				nit: nit,
				sigla: sigla,
				nombre: nombre,
				nombre_s: nombre_s,
				apellido: apellido,
				apellido_s: apellido_s,
				correo_electronico: correo_electronico,
				correo_electronico_rep_legal: correo_electronico_rep_legal,
				nombre_p: nombre_p,
				apellido_p: apellido_p, //___
				tipo_organizacion: tipo_organizacion,
				departamento: departamento,
				municipio: municipio,
				direccion: direccion,
				fax: fax,
				extension: extension,
				urlOrganizacion: urlOrganizacion,
				actuacion: actuacion,
				educacion: educacion,
				numCedulaCiudadaniaPersona: numCedulaCiudadaniaPersona,
			};

			$.ajax({
				url: baseURL + "update/update_info",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'warning',
						title: 'Espere... Guardando información...'
					});
				},
				success: function (response) {
					Toast.fire({
						icon: 'success',
						title: response.msg
					});
					setInterval(function () {
						redirect("perfil");
					}, 5000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		} else {
			Toast.fire({
				icon: 'error',
				title: 'Escriba un correo electrónico válido.'
			})
		}
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
