let url = unescape(window.location.href);
let activate = url.split("/");
let baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
let funcion = activate[4];
let funcion_ = activate[5];
ValidarFormularioAdministradores();
/**
 * Inicio de sesión súper admin
 */
$("#init_sp").click(function () {
	var $ps_sp = $("#tpssp").val();
	$(window).attr("location", baseURL + "super/?sp:" + $ps_sp);
});
if (funcion == "super" && funcion_ != "panel") {
	var $sp = url.split("?");
	$sp = $sp[1];
	var $spF = $sp.split(":");
	var data = {
		sp: $spF[1],
	};
	// Inicio de sesión súper administrador
	$.ajax({
		url: baseURL + "super/verify",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			if (response.error === 1) {
				Alert.fire({
					title: 'Contraseña invalida!',
					text: response.msg,
					icon: 'error',
					confirmButtonText: 'Aceptar',
				}).then((result) => {
					if (result.isConfirmed) {
						redirect(baseURL + '/super?');
					}
				})
			} else {
				Alert.fire({
					title: 'Bienvenido!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							redirect(response.url);
						}, 1000);
					}
				})
			}
		},
		error: function (ev) {
			console.log(ev)
		},
	});
}
/**
 * Acciones de menú
 */
$('#super-ver-admins').click(function () {
	if ($('#super-view-admins').css('display') == 'none'){
		$('#super-view-admins').show('swing');
		$('#super-ver-admins').val('Ocultar admministradores');
	}
	else {
		$('#super-view-admins').hide('linear');
		$('#super-ver-admins').val('Ver admministradores');
	}
});
/**
 * Modal crear/actualizar administrador
 */
$(".admin-modal").click(function () {
	let funct = $(this).attr('data-funct');
	if (funct === 'crear') {
		$('#super_nuevo_admin').show();
		$('#super_eliminar_admin').hide();
		$('#super_desconectar_admin').hide();
		$('#super_actualizar_admin').hide();
		$("#super_id_admin_modal").html("");
		$("#super_status_adm").html("");
		$("#super_status_adm").css("background-color", "#ffffff");
		$("#super_primernombre_admin").val('');
		$("#super_segundonombre_admin").val('');
		$("#super_primerapellido_admin").val('');
		$("#super_segundoapellido_admin").val('');
		$("#super_numerocedula_admin").val('');
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
		$('#super_eliminar_admin').show();
		$('#super_desconectar_admin').show();
		$('#super_actualizar_admin').show();
		data = {
			id: $(this).attr("data-id"),
		};
		$.ajax({
			url: baseURL + "administradores/cargarDatosAdministrador",
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
/**
 * Crear administrador
 */
$("#super_nuevo_admin").click(function () {
	if ($("#formulario_super_administradores").valid()) {
		//Datos formulario modal
		var data = {
			super_primernombre_admin: $("#super_primernombre_admin").val(),
			super_segundonombre_admin: $("#super_segundonombre_admin").val(),
			super_primerapellido_admin: $("#super_primerapellido_admin").val(),
			super_segundoapellido_admin: $("#super_segundoapellido_admin").val(),
			super_numerocedula_admin: $("#super_numerocedula_admin").val(),
			super_correo_electronico_admin: $("#super_correo_electronico_admin").val(),
			super_nombre_admin: $("#super_nombre_admin").val(),
			super_contrasena_admin: $("#super_contrasena_admin").val(),
			super_acceso_nvl: $("#super_acceso_nvl").val(),
		};
		$.ajax({
			url: baseURL + "administradores/create",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Guardando datos'
				});
			},
			success: function (response) {
				Alert.fire({
					title: 'Administrador creado!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				}).then((result) => {
					if (result.isConfirmed) {
						reload();
					}
				})
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
	else {
		Toast.fire({
			icon: 'warning',
			title: 'Por favor, llene los datos requeridos.'
		});
	}
});
/**
 * Actualizar administrador
 */
$("#super_actualizar_admin").click(function () {
	if ($("#formulario_super_administradores").valid()) {
		let lbl_adm = $("#verAdmin>label").attr("id");
		let id_adm = $("#" + lbl_adm).html();
		var data = {
			id_adm: id_adm,
			super_primernombre_admin: $("#super_primernombre_admin").val(),
			super_segundonombre_admin: $("#super_segundonombre_admin").val(),
			super_primerapellido_admin: $("#super_primerapellido_admin").val(),
			super_segundoapellido_admin: $("#super_segundoapellido_admin").val(),
			super_numerocedula_admin: $("#super_numerocedula_admin").val(),
			super_correo_electronico_admin: $("#super_correo_electronico_admin").val(),
			super_nombre_admin: $("#super_nombre_admin").val(),
			super_contrasena_admin: $("#super_contrasena_admin").val(),
			super_acceso_nvl: $("#super_acceso_nvl").val(),
		};
		$.ajax({
			url: baseURL + "administradores/update",
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
				Alert.fire({
					title: 'Administrador actualizado!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				}).then((result) => {
					if (result.isConfirmed) {
						reload();
					}
				})
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
	else {
		Toast.fire({
			icon: 'warning',
			title: 'Por favor, llene los datos requeridos.'
		});
	}
});
/**
 * Eliminar Administrador
 */
$("#super_eliminar_admin").click(function () {
	let lbl_adm = $("#verAdmin>label").attr("id");
	let id = $("#" + lbl_adm).html();
	let name = $('#super_nombre_admin').val();
	data = {
		id_adm: id,
	};
	Alert.fire({
		title: 'Borrar administrador!',
		text: 'Esta acción no se puede deshacer, realmente desea eliminar al usuario: ' + name + '?' ,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: baseURL + "administradores/delete",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					Alert.fire({
						title: 'Administrador eliminado!',
						text: response.msg,
						icon: 'success',
						confirmButtonText: 'Aceptar',
					}).then((result) => {
						if (result.isConfirmed) {
							reload();
						}
					})
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	})


});
/**
 * Desconectar Administrador
 */
$("#super_desconectar_admin").click(function () {
	let lbl_adm = $("#verAdmin>label").attr("id");
	let id = $("#" + lbl_adm).html();
	data = {
		id: id,
	};
	$.ajax({
		url: baseURL + "administradores/disconnect",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			if(response.status == 1) {
				Alert.fire({
					title: 'Administrador desconectado!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				}).then((result) => {
					if (result.isConfirmed) {
						reload();
					}
				})
			}
			else {
				Toast.fire({
					icon: 'error',
					title: response.msg
				})
			}

		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Cerrar sesión súper administrador
 */
$("#super_cerrar_sesion").click(function () {
	Alert.fire({
		title: 'Esta seguro de cerrar sesión ? ',
		icon: 'info',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: baseURL + "super/logout",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					if (response == "salir") {
						redirect(baseURL);
					}
				},
				error: function (ev) {
					//Do nothing
				},
			});
			redirect(baseURL + 'super?');
		}
	})

});
/**
 * Validar formulario registro
 */
function ValidarFormularioAdministradores () {
	$("form[id='formulario_super_administradores']").validate({
		rules: {
			super_primernombre_admin: {
				required: true,
			},
			super_primerapellido_admin: {
				required: true,
			},
			super_segundoapellido_admin: {
				required: true,
			},
			super_numerocedula_admin: {
				required: true,
				minlength: 4,
				maxlength: 10,
			},
			super_correo_electronico_admin: {
				required: true,
			},
			super_nombre_admin: {
				required: true,
			},
			super_contrasena_admin: {
				required: true,
			},
			super_acceso_nvl: {
				required: true,
			},
		},
		messages: {
			super_primernombre_admin: {
				required: "Digite primer nombre del administrador.",
			},
			super_primerapellido_admin: {
				required: "Digite primer apellido del administrador.",
			},
			super_segundoapellido_admin: {
				required: "Digite segundo apellido del administrador.",
			},
			super_numerocedula_admin: {
				required: "Digite numero de cédula.",
				minlength: "El numero cédula debe tener mínimo 3 caracteres.",
				maxlength: "El numero cédula debe tener máximo 10 caracteres.",
			},
			super_correo_electronico_admin: {
				required: "Digite correo electrónico.",
			},
			super_nombre_admin: {
				required: "Digite usuario para el administrador.",
			},
			super_contrasena_admin: {
				required: "Digite una contraseña.",
			},
			super_acceso_nvl: {
				required: "Seleccione un nivel de la lista.",
			},
		},
	});
}