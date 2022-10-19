$(document).on("click", "#cargar_imagen_perfil", function () {
	ValidarFormPerfil("imagen");
	if ($("#formulario_actualizar_imagen").valid()) {
		let file = $("#imagen_perfil").prop("files")[0];
		let form_data = new FormData();
		form_data.append("file", file);
		$.ajax({
			url: baseURL + "perfil/actualizar_imagen_logo",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Cargando Imagen'
				});
			},
			success: function (response) {
				Toast.fire({
					icon: 'success',
					title: response.msg,
				});
				setInterval(function () {
					reload();
				}, 15000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
	else {
		Toast.fire({
			icon: 'info',
			title: 'Formulario no validado.'
		});
	}
});

// Actualizar Informacion
$("#actualizar_informacion").click(function () {
	ValidarFormPerfil("perfil");
	if ($("#formulario_actualizar_perfil").valid()) {
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
		alert(1);
		$.ajax({
			url: baseURL + "perfil/actualizar_perfil",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Actualizando datos'
				});
			},
			success: function (response) {
				Toast.fire({
					icon: 'success',
					title: response.msg,
				});
				setInterval(function () {
					reload();
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
	else {
		Toast.fire({
			icon: 'info',
			title: 'Formulario no validado.'
		});
	}
});
/**
	 Validar Formularios Modulo Perfil
 **/
function ValidarFormPerfil (form) {
	// Formulario Actualizar Nombre de usuario.
	switch (form) {
		case "imagen":
			// Formulario Imagen Perfil.
			$("form[id='formulario_actualizar_imagen']").validate({
				rules: {
					imagen: {
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
					imagen: {
						required: "Por favor, seleccione una imagen en JPG, PNG, JPEG.",
					},
				},
			});
			break
		case "perfil":
			// Formulario Actualizar.
			$("form[id='formulario_actualizar_perfil']").validate({
				rules: {
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
					nombre_p: {
						required: true,
						minlength: 3,
					},
					apellido_p: {
						required: true,
						minlength: 3,
					},
				},
				messages: {
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
					nombre_p: {
						required: "Por favor, escriba su Primer Nombre.",
						minlength: "Su Primer Nombre debe tener mínimo 3 caracteres.",
					},
					apellido_p: {
						required: "Por favor, escriba su Primer Apellido.",
						minlength: "Su Primer Apellido debe tener mínimo 3 caracteres.",
					},
				},
			});
			break
		default:
	}

}
