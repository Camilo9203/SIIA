$(".resoluciones-modal").click(function () {
	let funct = $(this).attr('data-funct');
	if (funct === 'crear') {
		$('#super_nuevo_admin').show();
		$('#actions-admins').hide();
		$("#super_id_admin_modal").html("");
		$("#super_status_adm").html("");
		$("#super_status_adm").css("background-color", "#ffffff");
		$("#super_primernombre_admin").val('');
		$("#super_segundonombre_admin").val('');
		$("#super_primerapellido_admin").val('');
		$("#super_segundoapellido_admin").val('');
		$("#super_numerocedula_admin").val('');
		$("#super_ext_admin").val('');
		$("#super_nombre_admin").val('');
		$("#super_correo_electronico_admin").val('');
		$("#super_contrasena_admin").val('');
		$("#super_acceso_nvl option[value='seleccione']").prop('selected', true);
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
	else {
		$('#super_nuevo_admin').hide();
		$('#actions-admins').show();
		data = {
			id: $(this).attr("data-id"),
		};
		$.ajax({
			url: baseURL + "resoluciones/cargarDatosAdministrador",
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
	}

});
