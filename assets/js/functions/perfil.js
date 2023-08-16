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
	if ($("#formulario_actualizar_imagen").valid()) {
		var file_data = $("#imagen").prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		$.ajax({
			url: baseURL + "perfil/upload_imagen_logo",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				Toast.fire({
					icon: 'alert',
					title: 'Cargando...'
				});
			},
			success: function (response) {
				Toast.fire({
					icon: 'success',
					title: response.msg,
				})
				setInterval(function () {
					redirect("perfil");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
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
}
