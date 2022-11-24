// Variables para detectar url
let funcion = activate[4];
let funcion_ = activate[5];
let inicio_bread = 4;
/** Acción de inicio de sesión */
$("#init_sp").click(function () {
	//http://54.202.78.126/sia/activate/?tk:$2a$60$Ae3aCGTfmdxIxABpERW9vOHg6qWG4IRdauEo6a424X4bq8gXldOCbAAj6oW5pZEa6f0=:iop
	let ps_sp = $("#tpssp").val();
	$(window).attr("location", baseURL + "super/?sp:" + ps_sp);
});
if (funcion == "super" && funcion_ != "panel") {
	let sp = url.split("?");
	sp = sp[1];
	let spF = sp.split(":");
	let data = {sp: spF[1],};
	$.ajax({
		url: baseURL + "super/verify",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			if (response.url == "siia") {
				redirect(baseURL);
			} else {
				redirect(response.url);
			}
		},
		error: function (ev) {
			Toast.fire({
				icon: 'warning',
				title: 'Ingresa contraseña valida'
			})
		},
	});
}
else {
	/** No hay nada que hacer aquí. **/
}
/** Acción de cierre de sesión */
$("#super_cerrar_sesion").click(function () {
	$.ajax({
		url: baseURL + "super/logout",
		type: "post",
		dataType: "JSON",
		success: function (response) {
			if (response == "salir") {
				redirect(baseURL);
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Agregar administrador */
$("#super_nuevo_admin").click(function () {
	var super_primernombre_admin = $("#super_primernombre_admin").val();
	var super_segundonombre_admin = $("#super_segundonombre_admin").val();
	var super_primerapellido_admin = $("#super_primerapellido_admin").val();
	var super_segundoapellido_admin = $("#super_segundoapellido_admin").val();
	var super_numerocedula_admin = $("#super_numerocedula_admin").val();
	var super_correo_electronico_admin = $(
		"#super_correo_electronico_admin"
	).val();
	var super_nombre_admin = $("#super_nombre_admin").val();
	var super_contrasena_admin = $("#super_contrasena_admin").val();
	var super_acceso_nvl = $("#super_acceso_nvl").val();

	data = {
		super_primernombre_admin: super_primernombre_admin,
		super_segundonombre_admin: super_segundonombre_admin,
		super_primerapellido_admin: super_primerapellido_admin,
		super_segundoapellido_admin: super_segundoapellido_admin,
		super_numerocedula_admin: super_numerocedula_admin,
		super_correo_electronico_admin: super_correo_electronico_admin,
		super_nombre_admin: super_nombre_admin,
		super_acceso_nvl: super_acceso_nvl,
		super_contrasena_admin: super_contrasena_admin,
	};

	$.ajax({
		url: baseURL + "super/nuevoAdm",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Ver administrador */
$(".super_ver_admin_modal").click(function () {
	let id_adm = $(this).attr("data-id");
	let data = {
		id_adm: id_adm,
	};
	$.ajax({
		url: baseURL + "super/cargarDatosAdministrador",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$("#super_id_admin_modal").html("");
			$("#super_status_adm").html("");
			$("#super_status_adm").css("color", "white");
			$("#super_status_adm").css("padding", "5px");
			$("#super_id_admin_modal").html(id_adm);
			$("#super_primernombre_admin_modal").val(response[0].primerNombreAdministrador);
			$("#super_segundonombre_admin_modal").val(response[0].segundoNombreAdministrador);
			$("#super_primerapellido_admin_modal").val(response[0].primerApellidoAdministrador);
			$("#super_segundoapellido_admin_modal").val(response[0].segundoApellidoAdministrador);
			$("#super_numerocedula_admin_modal").val(response[0].numCedulaCiudadaniaAdministrador);
			$("#super_nombre_admin_modal").val(response[0].usuario);
			$("#super_correo_electronico_admin_modal").val(response[0].direccionCorreoElectronico);

			$("#super_contrasena_admin_modal").val(response[1]);
			if (response[0].logged_in == 1) {
				$("#super_status_adm").css("background-color", "#398439");
				$("#super_status_adm").html("Estado: En linea");
				$("#super_id_admin_modal").prop("disabled", true);
				$("#super_eliminar_admin").prop("disabled", true);
				$("#super_actualizar_admin").prop("disabled", true);
				$("#super_nombre_admin_modal").prop("disabled", true);
				$("#super_primernombre_admin_modal").prop("disabled", true);
				$("#super_segundonombre_admin_modal").prop("disabled", true);
				$("#super_primerapellido_admin_modal").prop("disabled", true);
				$("#super_segundoapellido_admin_modal").prop("disabled", true);
				$("#super_numerocedula_admin_modal").prop("disabled", true);
				$("#super_contrasena_admin_modal").prop("disabled", true);
				$("#super_correo_electronico_admin_modal").prop("disabled", true);
			} else {
				$("#super_status_adm").css("background-color", "#c61f1b");
				$("#super_status_adm").html("Estado: No conectado");
				$("#super_id_admin_modal").prop("disabled", false);
				$("#super_eliminar_admin").prop("disabled", false);
				$("#super_actualizar_admin").prop("disabled", false);
				$("#super_primernombre_admin_modal").prop("disabled", false);
				$("#super_segundonombre_admin_modal").prop("disabled", false);
				$("#super_primerapellido_admin_modal").prop("disabled", false);
				$("#super_segundoapellido_admin_modal").prop("disabled", false);
				$("#super_numerocedula_admin_modal").prop("disabled", false);
				$("#super_nombre_admin_modal").prop("disabled", false);
				$("#super_contrasena_admin_modal").prop("disabled", false);
				$("#super_correo_electronico_admin_modal").prop("disabled", false);
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Eliminar administrador */
$("#super_eliminar_admin").click(function () {
	let lblAdmin = $("#verAdmin>label").attr("id");
	let idAdmin = $("#" + lblAdmin).html();
	let data = {
		id_adm: idAdmin,
	};
	$.ajax({
		url: baseURL + "super/eliminarAdministrador",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'warning',
				title: 'Eliminado administrador'
			});
		},
		success: function (response) {
			Swal.fire({
				title: 'Administrador eliminado!',
				text: response.msg,
				icon: 'success',
				confirmButtonText: 'Aceptar',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
				else {
					setInterval(function () {
						reload();
					}, 2000);
				}
			});
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Actualizar administrador */
$("#super_actualizar_admin").click(function () {
	$lbl_adm = $("#verAdmin>label").attr("id");
	$id_adm = $("#" + $lbl_adm).html();
	$primerNombre = $("#super_primernombre_admin_modal").val();
	$segundoNombre = $("#super_segundonombre_admin_modal").val();
	$primerApellido = $("#super_primerapellido_admin_modal").val();
	$segundoApellido = $("#super_segundoapellido_admin_modal").val();
	$correo_electronico = $("#super_correo_electronico_admin_modal").val();
	$nombre = $("#super_nombre_admin_modal").val();
	$cedula = $("#super_numerocedula_admin_modal").val();
	$contrasena = $("#super_contrasena_admin_modal").val();
	$super_acceso_nvl = $("#super_acceso_nvl_modal").val();

	data = {
		id_adm: $id_adm,
		primerNombre: $primerNombre,
		segundoNombre: $segundoNombre,
		primerApellido: $primerApellido,
		segundoApellido: $segundoApellido,
		nombre: $nombre,
		cedula: $cedula,
		contrasena: $contrasena,
		correo_electronico: $correo_electronico,
		super_acceso_nvl: $super_acceso_nvl,
	};

	$.ajax({
		url: baseURL + "super/actualizarAdministrador",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'info',
				title: 'Actualizando administrador'
			});
		},
		success: function (response) {
			Swal.fire({
				title: 'Administrador actualizado!',
				text: response.msg,
				icon: 'success',
				confirmButtonText: 'Aceptar',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
				else {
					setInterval(function () {
						reload();
					}, 2000);
				}
			});
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
