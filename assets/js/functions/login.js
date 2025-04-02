validarFormLogin();

/** Inicio de sesión usuario. */
$("#inicio_sesion").click(function () {
	grecaptcha.ready(function () {
		grecaptcha
			.execute("6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef", {
				//action: 'LOGIN'
			})
			.then(function (token) {
				// Add input google token
				$("#formulario_login").prepend(
					'<input type="hidden" id="token" value="' + token + '">'
				);
				// Validar formulario registro
				if ($("#formulario_login").valid()) {
					var usuario = $("#usuario").val();
					var password = $("#password").val();
					if (usuario.length > 0 && password.length > 0) {
						var data = {
							usuario: usuario,
							password: password,
							token: $("#token").val(),
						};
						$.ajax({
							url: baseURL + "sesion/login",
							type: "post",
							dataType: "JSON",
							data: data,
							beforeSend: function () {
								ingresando();
							},
							success: function (response) {
								if (response.status === "success") {
									Alert.fire({
										title: response.title,
										text: response.msg,
										icon: response.status,
									}).then((result) => {
										if (result.isConfirmed) {
											setInterval(function () {
												redirect(baseURL + "organizacion/panel");
												grecaptcha.reset();
											}, 500);
										}
									});
								} else {
									alertaProceso(response.title, response.msg, response.status);
								}
							},
							error: function (ev) {
								console.log(ev);
								errorControlador(ev);
							},
						});
					}
				}
			});
	});
});
/** Recordar contraseña usuario*/
$("#recordar_contrasena_login").click(function () {
	const { value: email } = Alert.fire({
		title: "Recordar contraseña",
		icon: "info",
		input: "email",
		inputLabel:
			"Ingresa correo electrónico de notificaciones de la organización",
		inputPlaceholder: "Correo electrónico organización",
		focusConfirm: false,
		showCancelButton: true,
		confirmButtonText: `Enviar datos de acceso`,
		allowOutsideClick: false,
		customClass: {
			confirmButton: "button-swalert",
			popup: "popup-swalert",
			input: "input-swalert",
			inputLabel: "input-label-swalert",
		},
	}).then((result) => {
		if (result.isConfirmed) {
			let data = {
				correo_electronico: result.value,
			};
			$.ajax({
				url: baseURL + "recordar/recordar",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					procesando("info", "Enviando datos");
				},
				success: function (response) {
					alertaProceso(response.title, response.msg, response.status);
				},
				error: function (ev) {
					errorControlador(ev);
				},
			});
		}
	});
});
/** Inicio de sesión administrador. */
$("#inicio_sesion_admin").click(function () {
	grecaptcha.ready(function () {
		grecaptcha
			.execute("6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef", {
				//action: 'submit'
			})
			.then(function (token) {
				// Add input google token
				$("#formulario_login_admin").prepend(
					'<input type="hidden" id="token" value="' + token + '">'
				);
				if ($("#formulario_login_admin").valid()) {
					var usuario = $("#usuario").val();
					var password = $("#password").val();
					// var response_captcha = grecaptcha.getResponse();
					if (usuario.length > 0 && password.length > 0) {
						var data = {
							usuario: usuario,
							password: password,
							token: $("#token").val(),
						};
						$.ajax({
							url: baseURL + "sesion/log_in_admin",
							type: "post",
							dataType: "JSON",
							data: data,
							beforeSend: function () {
								ingresando();
							},
							success: function (response) {
								if (response.status === "success") {
									Alert.fire({
										title: response.title,
										text: response.msg,
										icon: response.status,
									}).then((result) => {
										if (result.isConfirmed) {
											setInterval(function () {
												redirect(baseURL + "panelAdmin");
												grecaptcha.reset();
											}, 500);
										}
									});
								} else {
									alertaProceso(response.title, response.msg, response.status);
								}
							},
							error: function (ev) {
								console.log(ev);
								errorControlador(ev);
							},
						});
					}
				}
			});
	});
});

/**
		Click en cerrar sesión.
	**/
$("#salir_sesion").click(function () {
	Alert.fire({
		title: "Cerrar sesión ",
		text: "¿Realmente desea cerrar sesión?",
		icon: "question",
		showCancelButton: true,
		confirmButtonText: "Si",
		cancelButtonText: "No",
		allowOutsideClick: false,
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: baseURL + "sesion/logout",
				type: "post",
				dataType: "JSON",
				beforeSend: function () {
					procesando("info", "Cerrando sesión");
				},
				success: function (response) {
					redirect(response.url);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	});
});
/** Validar formularios */
function validarFormLogin() {
	// Formulario Login.
	$("form[id='formulario_login']").validate({
		// Elemento que contendrá el mensaje de error (Bootstrap recomienda <div> con invalid-feedback)
		errorElement: "div",
		// Clase que usará el mensaje de error (ya posee estilos de Bootstrap)
		errorClass: "invalid-feedback",
		// Configuramos cómo se ubica el mensaje de error para mantener el layout consistente en input-groups
		errorPlacement: function (error, element) {
			// Si el input forma parte de un input-group, insertamos el error después del contenedor
			if (element.closest(".input-group").length) {
				error.insertAfter(element.closest(".input-group"));
			} else {
				error.insertAfter(element);
			}
		},
		// Cuando hay error, agrega la clase 'is-invalid' y remueve 'is-valid'
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		// Cuando el campo es válido, hace lo contrario: agrega 'is-valid' y remueve 'is-invalid'
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid").addClass("is-valid");
		},
		rules: {
			usuario: {
				required: true,
				minlength: 3,
			},
			password: {
				required: true,

				regex: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$",
			},
		},
		messages: {
			usuario: {
				required:
					"<p class='forms-error'>Por favor,escriba el nombre de usuario.</p>",
				minlength:
					"<p class='forms-error'>El nombre de usuario debe tener mínimo 3 caracteres.</p>",
			},
			password: {
				required:
					"<p class='forms-error'>Por favor, escriba la contraseña.</p>",
				regex:
					"<p class='forms-error'>La contraseña debe cumplir con los siguientes requisitos:</p><br>" +
					"<ul class='forms-error'> " +
					"<li>Al menos <strong>un número</strong>.</li>" +
					"<li>Al menos <strong>una mayúscula</strong>.</li>" +
					"<li>Al menos <strong>letras minúsculas</strong>.</li>" +
					"<li>Al menos <strong>un carácter especial (#?!@$%^&*-)</strong>.</li>" +
					"<li>Una longitud mínima de <strong>8 caracteres</strong> sin límite máximo.</li>" +
					"</ul>",
			},
		},
	});
	// Formulario Login Administradores.
	$("form[id='formulario_login_admin']").validate({
		// Elemento que contendrá el mensaje de error (Bootstrap recomienda <div> con invalid-feedback)
		errorElement: "div",
		// Clase que usará el mensaje de error (ya posee estilos de Bootstrap)
		errorClass: "invalid-feedback",
		// Configuramos cómo se ubica el mensaje de error para mantener el layout consistente en input-groups
		errorPlacement: function (error, element) {
			// Si el input forma parte de un input-group, insertamos el error después del contenedor
			if (element.closest(".input-group").length) {
				error.insertAfter(element.closest(".input-group"));
			} else {
				error.insertAfter(element);
			}
		},
		// Cuando hay error, agrega la clase 'is-invalid' y remueve 'is-valid'
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid").removeClass("is-valid");
		},
		// Cuando el campo es válido, hace lo contrario: agrega 'is-valid' y remueve 'is-invalid'
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid").addClass("is-valid");
		},
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
				required:
					"<p class='forms-error'>Por favor, escriba el Nombre de Usuario.</p>",
				minlength:
					"<p class='forms-error'>El Nombre de Usuario debe tener mínimo 3 caracteres.</p>",
			},
			password: {
				required:
					"<p class='forms-error'>Por favor, escriba la contraseña.</p>",
				minlength:
					"<p class='forms-error'>La Contraseña debe tener mínimo 3 caracteres.</p>",
			},
		},
	});
}
function ingresando() {
	Toast.fire({
		icon: "info",
		text: "Ingresando",
	});
}
function alertaValidarFomulario(msg, status) {
	Toast.fire({
		icon: status,
		text: msg,
	});
}
function alertaErrorIngresar(msg, status) {
	Alert.fire({
		title: "!",
		text: msg,
		icon: status,
	});
}
function procesando(status, msg) {
	Toast.fire({
		icon: status,
		text: msg,
	});
}
// Alerta de formulario guardado
function alertaProceso(title, msg, status) {
	Alert.fire({
		title: title,
		html: msg,
		text: msg,
		icon: status,
	});
}
// Error 505
function errorControlador(ev) {
	Alert.fire({
		title: ev.statusText,
		html: ev.responseText,
		text: ev.responseText,
		icon: "error",
		allowOutsideClick: false,
		customClass: {
			popup: "popup-swalert-list",
			confirmButton: "button-swalert",
		},
	});
}
