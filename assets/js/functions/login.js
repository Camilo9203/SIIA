validarFormLogin();
/** Inicio de sesión usuario. */
$("#inicio_sesion").click(function () {
	grecaptcha.ready(function() {
		grecaptcha.execute('6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef', {
			//action: 'submit'
		}).then(function(token) {
			// Add input google token
			$('#formulario_login').prepend('<input type="hidden" id="token" value="'+ token +'">');
			// Validar formulario registro
			if ($("#formulario_login").valid()) {
				var usuario = $("#usuario").val();
				var password = $("#password").val();
				if (usuario.length > 0 && password.length > 0) {
					var data = {
						usuario: usuario,
						password: password,
						token: $('#token').val(),
					};
					$.ajax({
						url: baseURL + "sesion/login",
						type: "post",
						dataType: "JSON",
						data: data,
						beforeSend: function () {
							$("#loading").show();
							$(this).attr("disabled", true);
						},
						success: function (response) {
							if (response.url == "login") {
								mensaje(response.msg, "alert-warning");
								clearInputs("formulario_login");
							}
							if (response.url == "panel") {
								redirect(response.url);
							}
							$("#loading").toggle();
							grecaptcha.reset();
						},
						error: function (ev) {
							//Do nothing
						},
					});
				}
			}
		});
	});
});
/** Recordar contraseña usuario*/
$("#recordar_contrasena").click(function () {
	if ($("#formulario_recordar").valid()) {
		var usuario = $("#nombre_usuario_rec").val();
		var correo_electronico = $("#correo_electronico_rec").val();
		var check = $("#acepto_cond_rec").prop("checked");
		var response_captcha = grecaptcha.getResponse();

		if (usuario.length > 0 && correo_electronico.length > 0) {
			if (check == true) {
				if (response_captcha != 0) {
					var data = {
						usuario: usuario,
						correo_electronico: correo_electronico,
					};
					$.ajax({
						url: baseURL + "recordar/recordar",
						type: "post",
						dataType: "JSON",
						data: data,
						beforeSend: function () {
							$("#loading").show();
							$(this).attr("disabled", true);
						},
						success: function (response) {
							mensaje(response.msg, "alert-success");
							$("#loading").toggle();
							clearInputs("formulario_recordar");
							grecaptcha.reset();
						},
						error: function (ev) {
							//Do nothing
						},
					});
				} else {
					mensaje(texto_validacaptcha, alert_danger);
				}
			} else {
				mensaje(
					"Aceptas que eres el usuario del correo electronico?",
					alert_warning
				);
			}
		} else {
			mensaje("No hay valores.", alert_danger);
		}
	}
});
/** Inicio de sesión administrador. */
$("#inicio_sesion_admin").click(function () {
	grecaptcha.ready(function() {
		grecaptcha.execute('6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef', {
			//action: 'submit'
		}).then(function(token) {
			// Add input google token
			$('#formulario_login_admin').prepend('<input type="hidden" id="token" value="'+ token +'">');
			if ($("#formulario_login_admin").valid()) {
				var usuario = $("#usuario").val();
				var password = $("#password").val();
				// var response_captcha = grecaptcha.getResponse();
				if (usuario.length > 0 && password.length > 0) {
					var data = {
						usuario: usuario,
						password: password,
						token: $('#token').val(),
					};
					$.ajax({
						url: baseURL + "sesion/log_in_admin",
						type: "post",
						dataType: "JSON",
						data: data,
						beforeSend: function () {
							$("#loading").show();
							ingresando();
						},
						success: function (response) {
							console.log(response);
							if (response.status === "success") {
								Alert.fire({
									title: 'Bienvenido!',
									text: response.msg,
									icon: 'success',
									confirmButtonText: 'Aceptar',
								}).then((result) => {
									if (result.isConfirmed) {
										setInterval(function () {
											redirect(baseURL + "panelAdmin");
										}, 1000);
									}
								})
							}
							else {
								$("#loading").toggle();
								alertaValidarFomulario(response.msg, response.status);
							}
						},
						error: function (ev) {
							//Do nothing
						},
					});
				}

			}
		});
	});
});
/** Validar formularios */
function validarFormLogin () {
	// Formulario Login.
	$("form[id='formulario_login']").validate({
		rules: {
			usuario: {
				required: true,
				minlength: 3,
				//maxlength: 10,
			},
			password: {
				required: true,
				minlength: 8,
				//maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
		},
		messages: {
			usuario: {
				required: "Por favor, escriba el nombre de usuario.",
				minlength: "El nombre de usuario debe tener mínimo 3 caracteres.",
				//maxlength: "El nombre de usuario debe tener máximo 10 caracteres."
			},
			password: {
				required: "Por favor, escriba la contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				//maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
		},
	});
	// Formulario Login Administradores.
	$("form[id='formulario_login_admin']").validate({
		rules: {
			usuario: {
				required: true,
				minlength: 3,
			},
			password: {
				required: true,
				minlength: 3,
			},
		},
		messages: {
			usuario: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
			},
			password: {
				required: "Por favor, escriba la contraseña.",
				minlength: "La Contraseña debe tener mínimo 3 caracteres.",
			},
		},
	});
}
function ingresando(){
	Toast.fire({
		icon: 'info',
		text: 'Ingresando'
	});
}
function alertaValidarFomulario(msg, status){
	Toast.fire({
		icon: status,
		text: msg
	});
}
function alertaErrorIngresar(msg, status){
	Alert.fire({
		title: '!',
		text: msg,
		icon: status,
	})
}
