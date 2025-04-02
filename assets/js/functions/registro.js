$(document).ready(function () {
	var url = unescape(window.location.href);
	var activate = url.split("/");
	var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
	ValidarFormRegistro();
});
// Aceptar política
$("#acepto_politica").click(function () {
	$("#acepto_cond").prop("checked", true);
	$("#politica_ventana").modal("toggle");
});
// Declinar política
$("#declino_politica").click(function () {
	$("#acepto_cond").prop("checked", false);
	$("#politica_ventana").modal("toggle");
});
// Aceptar condiciones de uso
$("#aceptoComActo").change(function () {
	if ($("#aceptoComActo").is(":checked")) {
		$("#guardar_registro").removeAttr("disabled");
		$("#guardar_registro").attr("disabled", false);
	} else {
		$("#guardar_registro").attr("disabled", true);
	}
});
/**
 * Confirmar registro formulario de registro
 * */
$("#confirmaRegistro").click(function () {
	$("#informacion_previa").slideDown();
	$("#reenvio_email").slideUp();
	/** Data ajax para verificar NIT y Usuario */
	let data = {
		nombre_usuario: $("#nombre_usuario").val(),
		nit: $("#nit").val() + "-" + $("#nit_digito").val(),
	};
	if ($("#formulario_registro").valid()) {
		/** Alerta de verificación datos*/
		Toast.fire({
			icon: "success",
			title: "Verifique su información y correos electrónicos",
		});
		/** Muestra modal con los datos para ser confirmados */
		$("#ayuda_registro").modal("show");
		$("#modalConfOrg").html($("#organizacion").val());
		$("#modalConfNit").html($("#nit").val() + "-" + $("#nit_digito").val());
		$("#modalConfSigla").html($("#sigla").val());
		$("#modalConfPNRL").html($("#nombre").val());
		$("#modalConfSNRL").html($("#nombre_s").val());
		$("#modalConfPARL").html($("#apellido").val());
		$("#modalConfSARL").html($("#apellido_s").val());
		$("#modalConfCOrg").html($("#correo_electronico").val());
		$("#modalConfCRep").html($("#correo_electronico_rep_legal").val());
		$("#modalConfPn").html($("#nombre_p").val());
		$("#modalConfPa").html($("#apellido_p").val());
		$("#modalConfNU").html($("#nombre_usuario").val());
		$("#modalConfPass").html($("#password").val());
		$("#modalConfCorreo").html($("#correo_electronico").val());
	} else {
		/** Alerta de llenar campos requeridos */
		$("#ayuda_registro").modal("hide");
		Toast.fire({
			icon: "warning",
			title: "Por favor, llene los datos requeridos.",
		});
	}
});
/**
 * Guardar registro formulario de registro
 * */
$("#guardar_registro").click(function () {
	grecaptcha.ready(function () {
		grecaptcha
			.execute("6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef", {
				//action: 'submit'
			})
			.then(function (token) {
				// Add your logic to submit to your backend server here.
				$("#formulario_registro").prepend(
					'<input type="hidden" id="token" value="' + token + '">'
				);
				/** Validar formulario registro */
				if ($("#formulario_registro").valid()) {
					/** Data para registrar cuenta */
					let data = {
						token: $("#token").val(),
						organizacion: $("#organizacion").val().trim().toUpperCase(),
						nit: $("#nit").val() + "-" + $("#nit_digito").val(),
						sigla: $("#sigla").val().trim().toUpperCase(),
						nombre: $("#nombre")
							.val()
							.trim()
							.toLowerCase()
							.replace(/\w\S*/g, (w) =>
								w.replace(/^\w/, (c) => c.toUpperCase())
							),
						nombre_s: $("#nombre_s")
							.val()
							.trim()
							.toLowerCase()
							.replace(/\w\S*/g, (w) =>
								w.replace(/^\w/, (c) => c.toUpperCase())
							),
						apellido: $("#apellido")
							.val()
							.trim()
							.toLowerCase()
							.replace(/\w\S*/g, (w) =>
								w.replace(/^\w/, (c) => c.toUpperCase())
							),
						apellido_s: $("#apellido_s")
							.val()
							.trim()
							.toLowerCase()
							.replace(/\w\S*/g, (w) =>
								w.replace(/^\w/, (c) => c.toUpperCase())
							),
						correo_electronico: $("#correo_electronico")
							.val()
							.trim()
							.toLowerCase(),
						correo_electronico_rep_legal: $("#correo_electronico_rep_legal")
							.val()
							.trim()
							.toLowerCase(),
						nombre_p: $("#nombre_p")
							.val()
							.trim()
							.toLowerCase()
							.replace(/\w\S*/g, (w) =>
								w.replace(/^\w/, (c) => c.toUpperCase())
							),
						apellido_p: $("#apellido_p")
							.val()
							.trim()
							.toLowerCase()
							.replace(/\w\S*/g, (w) =>
								w.replace(/^\w/, (c) => c.toUpperCase())
							),
						nombre_usuario: $("#nombre_usuario").val(),
						password: $("#password").val(),
					};
					$.ajax({
						url: baseURL + "registro/registrar_info",
						type: "post",
						dataType: "JSON",
						data: data,
						beforeSend: function () {
							$("#guardar_registro").attr("disabled", true);
							Toast.fire({
								icon: "info",
								title: "Registrando información...",
							});
						},
						success: function (response) {
							$("#ayuda_registro").attr("data-backdrop", "static");
							$("#ayuda_registro").attr("data-keyboard", "false");
							/** Comprobar estado de envío y creación de cuenta */
							if (response.status == "success") {
								Alert.fire({
									title: response.title,
									text: response.msg,
									html: response.msg,
									icon: response.status,
								});
								/** Esconder confirmación y mostrar reenvío de email */
								$("#informacion_previa").slideUp();
								$("#reenvio_email").slideDown();
								$("#seccion-reenvio").show();
								$("#seccion-guardar").hide();
							} else {
								/** Alerta si el correo no se envío */
								Toast.fire({
									icon: "error",
									title:
										"El correo electrónico no fue enviado, intente de nuevo.",
								});
							}
						},
						error: function (ev) {},
					});
				}
			});
	});
});
/**
 * Reenviar correo registro
 * */
$("#btn-cerrar-reenvio").click(function () {
	setInterval(function () {
		redirect("login");
	}, 1000);
});
$("#btn-reenvio").click(function () {
	$correo_electronico = $("#correo_electronico_rese").val();
	data = {
		to: $("#correo_electronico_rese").val(),
		nit: $("#nit").val() + "-" + $("#nit_digito").val(),
	};
	$.ajax({
		url: baseURL + "registro/reenvio",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: "info",
				title: "Registrando información, espere...",
			});
			$("#btn-reenvio").attr("disabled", true);
			$("#correo_electronico_rese").attr("readonly", true);
			$(this).attr("disabled", true);
		},
		success: function (response) {
			Alert.fire({
				title: "Correo enviado!",
				html: response.msg,
				text: response.msg,
				icon: "success",
			});
			$("#btn-reenvio").removeAttr("disabled");
			$("#correo_electronico_rese").removeAttr("readonly");
		},
		error: function (ev) {},
	});
});
/**
 * Validar formulario registro
 * */
function ValidarFormRegistro() {
	$("form[id='formulario_registro']").validate({
		// Elemento que contendrá el mensaje de error (Bootstrap recomienda <div> con invalid-feedback)
		errorElement: "div",
		// Clase que usará el mensaje de error (ya posee estilos de Bootstrap)
		errorClass: "invalid-feedback",
		// Mensaje de error para mantener el layout consistente en input-groups
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
			organizacion: {
				required: true,
				minlength: 3,
			},
			nit: {
				required: true,
				remote: {
					url: baseURL + "registro/verificarNIT", // Endpoint que verifique ambos campos juntos
					type: "post",
					data: {
						nit: function () {
							return (
								$("#nit").val().trim() + "-" + $("#nit_digito").val().trim()
							);
						},
					},
					dataFilter: function (response) {
						// El endpoint devuelve { existe: 1 } o { existe: 0 }
						var res = JSON.parse(response);
						if (res.existe === 1) {
							return '"El NIT ya existe."';
						} else {
							return "true";
						}
					},
				},
				minlength: 3,
				maxlength: 10,
				//regex: "^[^.][0-9]+-[0-9]{1}?$",
			},
			nit_digito: {
				required: true,
				remote: {
					url: baseURL + "registro/verificarNIT", // Endpoint que verifique ambos campos juntos
					type: "post",
					data: {
						nit: function () {
							return (
								$("#nit").val().trim() + "-" + $("#nit_digito").val().trim()
							);
						},
					},
					dataFilter: function (response) {
						// Suponemos que el endpoint devuelve { existe: 1 } o { existe: 0 }
						var res = JSON.parse(response);
						if (res.existe === 1) {
							return '"El NIT ya existe."';
						} else {
							return "true";
						}
					},
				},
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
				//Expresión regular para validar correo y dominio
				regex: /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/,
			},
			correo_electronico_rep_legal: {
				required: true,
				minlength: 3,
				email: true,
				regex: /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/,
			},
			primer_nombre_persona: {
				required: true,
				minlength: 3,
			},
			primer_apellido_persona: {
				required: true,
				minlength: 3,
			},
			nombre_usuario: {
				required: true,
				remote: {
					url: baseURL + "registro/verificarUsuario",
					type: "post",
					data: {
						nombre_usuario: function () {
							return $("#nombre_usuario").val().trim();
						},
					},
					dataFilter: function (response) {
						// El endpoint devuelve un JSON con { existe: 1 } o { existe: 0 }
						var res = JSON.parse(response);
						if (res.existe === 1) {
							// Se retorna un mensaje de error; jQuery Validate lo mostrará
							return '"El nombre de usuario ya existe. Puede usar números."';
						} else {
							return "true";
						}
					},
				},
				minlength: 3,
			},
			password: {
				required: true,
				regex: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?)(?=.*?[#?!@$%^&*-]).{8,}$",
			},
			re_password: {
				required: true,
				regex: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?)(?=.*?[#?!@$%^&*-]).{8,}$",
				equalTo: "#password",
			},
			aceptocond: {
				required: true,
			},
		},
		messages: {
			organizacion: {
				required:
					"<p class='forms-error'>Por favor, escriba el nombre de la organización.",
				minlength:
					"<p class='forms-error'>El nombre de la organización debe tener mínimo 3 caracteres.</p>",
			},
			nit: {
				required:
					"<p class='forms-error'>Por favor, escriba el NIT de la organización.</p>",
				minlength:
					"<p class='forms-error'>El nit debe tener mínimo 3 caracteres.</p>",
				maxlength:
					"<p class='forms-error'>El nit debe tener máximo 10 caracteres.</p>",
				//regex: "Por favor, escriba un NIT válido, sin puntos y con (-)."
			},
			nit_digito: {
				required:
					"<p class='forms-error'>Por favor, escriba el dígito de verificación.</p>",
			},
			sigla: {
				required:
					"<p class='forms-error'>Por favor, escriba la sigla de la organización.</p>",
				minlength:
					"<p class='forms-error'>La Sigla de la organización debe tener mínimo 3 caracteres.</p>",
			},
			primer_nombre_rep_legal: {
				required:
					"<p class='forms-error'>Por favor, escriba el Primer Nombre del Representante Legal.</p>",
				minlength:
					"<p class='forms-error'>El Primer Nombre del Representante Legal debe tener mínimo 3 caracteres.</p>",
			},
			primer_apellido_rep_regal: {
				required:
					"<p class='forms-error'>Por favor, escriba el Primer Apellido del Representante Legal.</p>",
				minlength:
					"<p class='forms-error'>El Primer Apellido del Representante Legal debe tener mínimo 3 caracteres.</p>",
			},
			correo_electronico: {
				required:
					"<p class='forms-error'>Por favor, escriba un correo electrónico de la organización válido.</p>",
				minlength:
					"<p class='forms-error'>El correo electrónico debe tener mínimo 3 caracteres.</p>",
				email:
					"<p class='forms-error'>Por favor, escriba un correo electrónico valido.</p>",
				regex: "<p class='forms-error'>No olvide el @ y el .dominio</p>",
			},
			correo_electronico_rep_legal: {
				required:
					"<p class='forms-error'>Por favor, escriba un correo electrónico del representante legal válido.</p>",
				minlength:
					"<p class='forms-error'>El correo electrónico debe tener mínimo 3 caracteres.</p>",
				email:
					"<p class='forms-error'>Por favor, escriba un correo electrónico valido.</p>",
				regex: "<p class='forms-error'>No olvide el @ y el .dominio</p>",
			},
			primer_nombre_persona: {
				required:
					"<p class='forms-error'>Por favor, escriba su Primer Nombre.</p>",
				minlength:
					"<p class='forms-error'>El Primer Nombre debe tener mínimo 3 caracteres.</p>",
			},
			primer_apellido_persona: {
				required:
					"<p class='forms-error'>Por favor, escriba su Primer Apellido.</p>",
				minlength:
					"<p class='forms-error'>El Primer Apellido debe tener mínimo 3 caracteres.</p>",
			},
			nombre_usuario: {
				required:
					"<p class='forms-error'>Por favor, escriba el Nombre de Usuario.</p>",
				minlength:
					"<p class='forms-error'>El Nombre de Usuario debe tener mínimo 3 caracteres.</p>",
			},
			password: {
				required:
					"<p class='forms-error'>Por favor, escriba la Contraseña.</p>",
				regex:
					"<p class='forms-error'>La contraseña debe cumplir con los siguientes requisitos:</p> <br><br>" +
					"<ul class='forms-error'>" +
					"<li>Al menos <strong>un número</strong>.</li>" +
					"<li>Al menos <strong>una mayúscula</strong>.</li>" +
					"<li>Al menos <strong>letras minúsculas</strong>.</li>" +
					"<li>Al menos <strong>un cáracter especial (#?!@$%^&*-)</strong>.</li>" +
					"<li>Una longitud mínima de <strong>8 caracteres</strong> sin límite máximo.</li>" +
					"</ul>",
			},
			re_password: {
				required:
					"<p class='forms-error'>Por favor, vuela a escribir la Contraseña.",
				regex:
					"<p class='forms-error'>La contraseña debe cumplir con los siguientes requisitos:</p> <br><br>" +
					"<ul class='forms-error'>" +
					"<li>Al menos <strong>un número</strong>.</li>" +
					"<li>Al menos <strong>una mayúscula</strong>.</li>" +
					"<li>Al menos <strong>letras minúsculas</strong>.</li>" +
					"<li>Al menos <strong>un cáracter especial (#?!@$%^&*-)</strong>.</li>" +
					"<li>Una longitud mínima de <strong>8 caracteres</strong> sin límite máximo.</li>" +
					"</ul>",
				equalTo: "<p class='forms-error'>Las contraseñas no coinciden.</p>",
			},
			aceptocond: {
				required:
					"<p class='forms-error'>Para continuar tiene que aceptar las condiciones y restricciones de SIIA.</p>",
			},
		},
	});
}
