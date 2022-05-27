/** Capturar BaseUrl */
var url = unescape(window.location.href);
var activate = url.split("/");
var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
ValidarFormLogin();
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
	alert('entra en función');
	if ($("#formulario_login").valid()) {
		var usuario = $("#usuario").val();
		var password = $("#password").val();
		var response_captcha = grecaptcha.getResponse();
		alert(password);
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
