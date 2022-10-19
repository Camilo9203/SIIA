ValidarFormLogin();
/** Notificación Toast SweetAlert */
const ToastLogin = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 4000,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})
/**
	 Validar Formulario Registro
 **/
function ValidarFormLogin () {
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
				maxlength: 10,
				// regex:
				// 	"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
		},
		messages: {
			usuario: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
				//maxlength: "El Nombre de Usuario debe tener máximo 10 caracteres."
			},
			password: {
				required: "Por favor, escriba la contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
		},
	});
}
/**
		Click en inicio de Sesion.
 **/
$("#inicio_sesion").click(function () {
	if ($("#formulario_login").valid()) {
		var usuario = $("#usuario").val();
		var password = $("#password").val();
		var response_captcha = grecaptcha.getResponse();
		if (usuario.length > 0 && password.length > 0) {
			var data = {
				usuario: usuario,
				password: password,
			};
			$.ajax({
				url: baseURL + "sesion/login",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					$(this).attr("disabled", true);
					ToastLogin.fire({
						icon: 'info',
						title: 'Iniciando Sesión.'
					})
				},
				success: function (response) {
					if (response.url == "login") {
						Swal.fire({
							title: 'No se logro Iniciar!',
							text: response.msg,
							icon: 'warning',
							confirmButtonText: 'Finalizar',
						});
						clearInputs("formulario_login");
					}
					if (response.url == "panel") {
						ToastLogin.fire({
							icon: 'success',
							title: 'Sesión Iniciada.'
						})
						redirect(response.url);
					}
					$("#loading").toggle();
					grecaptcha.reset();
				},
				error: function (ev) {
					//Do nothing
				},

				// 	if(response_captcha != 0){
				// 	    });
				// 	}else{
				// 		mensaje(texto_validacaptcha, alert_danger);
				// 	}
				// }else{
				// 	mensaje("Escriba el usuario y la contraseña.", alert_danger);
				// }
			});
		}
	}
	else {
		alert('arregla el formulario');
	}
});

/**
		Clic en Recordar Contraseña
 **/
$("#recordar_contrasena").click(function () {
	if ($("#formulario_recordar").valid()) {
		let nit = $("#numeroNIT").val() + "-" + $("#digitoVerificacion").val();
		$.ajax({
			url: baseURL + "registro/verificarNIT",
			type: "post",
			dataType: "JSON",
			data: nit,
			success: function (response) {
				if (response.existe == 1) {
					$.ajax({
						url: baseURL + "recordar/recordar",
						type: "post",
						dataType: "JSON",
						data: nit,
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
					/** Alerta si NIT ya existe*/
					Toast.fire({
						icon: 'error',
						title: 'El NIT no existe.'
					});

				}
			}
		});

	}
});



/**
		Click en Salir de Sesión.
 **/
$("#salir").click(function () {
	$(this).attr("disabled", true);
	$.ajax({
		url: baseURL + "sesion/logout",
		type: "post",
		dataType: "JSON",
		beforeSend: function () {
			ToastLogin.fire({
				icon: 'error',
				title: 'Cerrando Sesión.'
			})
		},
		success: function (response) {
			ToastLogin.fire({
				icon: 'success',
				title: 'La sesión ha terminado.'
			})
			setInterval(function () {
				redirect(baseURL + "login");
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
