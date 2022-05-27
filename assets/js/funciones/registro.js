/** Capturar BaseUrl */
var url = unescape(window.location.href);
var activate = url.split("/");
var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
var encuestas;
ValidarFormRegistro();
/** Notificación Toast SweetAlert */
const Toast = Swal.mixin({
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
$.ajax({
	url: baseURL + "Encuesta/cargar",
	type: "GET",
	success: function (response) {
		encuestas = JSON.parse(response);
	},
});

/** Verificación de usuario registrado*/
$("#nombre_usuario").change(function () {
	usuario = {
		nombre: $("#nombre_usuario").val(),
	};
	$.ajax({
		url: baseURL + "registro/verificarUsuario",
		type: "post",
		dataType: "JSON",
		data: usuario,
		success: function (response) {
			if (response.existe == 1) {
				Toast.fire({
					icon: 'error',
					title: 'El nombre de usuario ya existe. Puede usar números.'
				})
			}
			else {
				Toast.fire({
					icon: 'success',
					title: 'Usuario valido'
				})
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});

/** Verificación de nit registrado*/
$("#nit_digito").change(function () {
	nit = $("#nit").val() + "-" + $("#nit_digito").val();
	organizacion = {
		nit: nit,
	};
	$.ajax({
		url: baseURL + "registro/verificarNIT",
		type: "post",
		dataType: "JSON",
		data: organizacion,
		success: function (response) {
			if (response.existe == 1) {
				Toast.fire({
					icon: 'error',
					title: 'El NIT ya se encuentra registrado'
				})
			}
			else {
				Toast.fire({
					icon: 'success',
					title: 'El NIT no se encuentra registrado'
				})
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});

/** Verificación de nit registrado*/
$("#acepto_politica").click(function () {
	$("#acepto_cond").prop("checked", true);
	$("#politica_ventana").modal("toggle");
});

$("#confirmaRegistro").click(function () {
	$("#informacion_pre").slideDown();
	$("#reenvio_pre").slideUp();

	var organizacion = $("#organizacion").val();
	var nit = $("#nit").val() + "-" + $("#nit_digito").val();
	var sigla = $("#sigla").val();
	var nombre = $("#nombre").val();
	var nombre_s = $("#nombre_s").val();
	var apellido = $("#apellido").val();
	var apellido_s = $("#apellido_s").val();
	var correo_electronico = $("#correo_electronico").val();
	var correo_electronico_rep_legal = $("#correo_electronico_rep_legal").val();
	var nombre_p = $("#nombre_p").val();
	var apellido_p = $("#apellido_p").val();
	var nombre_usuario = $("#nombre_usuario").val();
	var pass = $("#password").val();
	var pass2 = $("#re_password").val();
	var check = $("#acepto_cond").prop("checked");
	var response_captcha = grecaptcha.getResponse();

	datas = {
		nombre: nombre_usuario,
		nit: nit,
	};

	if ($("#formulario_registro").valid()) {
		$.ajax({
			url: baseURL + "registro/verificarUsuario",
			type: "post",
			dataType: "JSON",
			data: datas,
			success: function (response) {
				if (response.existe === 1) {
					notificacion(
						"El nombre usuario ya existe... Puede usar números...",
						"success"
					);
					$("#ayuda_registro").modal("toggle");
				} else {
					if (
						organizacion.length > 0 &&
						nit.length > 0 &&
						nombre.length > 0 &&
						apellido.length > 0 &&
						correo_electronico.length > 0 &&
						nombre_usuario.length > 0 &&
						pass.length > 0 &&
						pass2.length > 0
					) {
						if (pass === pass2) {
							if (check === true) {
								if (response_captcha != 0) {
									notificacion(
										"Verifique su información y correos electronicos.",
										"success"
									);
									$("#modalConfOrg").html($("#organizacion").val());
									$("#modalConfNit").html(nit);
									$("#modalConfSigla").html(sigla);
									$("#modalConfPNRL").html(nombre);
									$("#modalConfSNRL").html(nombre_s);
									$("#modalConfPARL").html(apellido);
									$("#modalConfSARL").html(apellido_s);
									$("#modalConfCOrg").html(correo_electronico);
									$("#modalConfCRep").html(correo_electronico_rep_legal);
									$("#modalConfPn").html(nombre_p);
									$("#modalConfPa").html(apellido_p);
									$("#modalConfNU").html(nombre_usuario);
								} else {
									$("#ayuda_registro").modal("toggle");
									mensaje(texto_validacaptcha, alert_danger);
								}
							} else {
								mensaje(
									"¿Aceptas condiciones y restricciones?",
									alert_danger
								);
							}
						} else {
							$("#ayuda_registro").modal("toggle");
							mensaje(
								"La contraseña no coincide, verifiquela...",
								alert_warning
							);
						}
					} else {
						$("#ayuda_registro").modal("toggle");
						mensaje("Por favor, llene los datos requeridos.", alert_danger);
					}
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		$("#ayuda_registro").modal("toggle");
	}
});
// TODO: Guardar registro validado.


/**
	 Validar Formulario Registro
 **/
function ValidarFormRegistro () {
	$("form[id='formulario_registro']").validate({
		rules: {
			organizacion: {
				required: true,
				minlength: 3,
			},
			nit: {
				required: true,
				minlength: 3,
				maxlength: 10,
				//regex: "^[^.][0-9]+-[0-9]{1}?$",
			},
			nit_digito: {
				required: true,
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
			},
			correo_electronico_rep_legal: {
				required: true,
				minlength: 3,
				email: true,
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
				minlength: 3,
				maxlength: 10,
			},
			password: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			re_password: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			aceptocond: {
				required: true,
			},
		},
		messages: {
			organizacion: {
				required: "Por favor, escriba el nombre de la organización.",
				minlength:
					"El nombre de la organización debe tener mínimo 3 caracteres.",
			},
			nit: {
				required: "Por favor, escriba el NIT de la organización.",
				minlength: "El nit debe tener mínimo 3 caracteres.",
				maxlength: "El nit debe tener maximo 10 caracteres.",
				//regex: "Por favor, escriba un NIT válido, sin puntos y con (-)."
			},
			nit_digito: {
				required: "Por favor, escriba el digito de verificación.",
			},
			sigla: {
				required: "Por favor, escriba la Sigla de la organización.",
				minlength:
					"La Sigla de la organización debe tener mínimo 3 caracteres.",
			},
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
				required:
					"Por favor, escriba un Correo Electrónico de la organizacion válido.",
				minlength: "El Correo Electrónico debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			correo_electronico_rep_legal: {
				required:
					"Por favor, escriba un Correo Electrónico del representante legal válido.",
				minlength: "El Correo Electrónico debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			primer_nombre_persona: {
				required: "Por favor, escriba su Primer Nombre.",
				minlength: "El Primer Nombre debe tener mínimo 3 caracteres.",
			},
			primer_apellido_persona: {
				required: "Por favor, escriba su Primer Apellido.",
				minlength: "El Primer Apellido debe tener mínimo 3 caracteres.",
			},
			nombre_usuario: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
				maxlength: "El Nombre de Usuario debe tener máximo 10 caracteres.",
			},
			password: {
				required: "Por favor, escriba la Contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
			re_password: {
				required: "Por favor, vuela a escribir la Contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
			aceptocond: {
				required:
					"Para continuar tiene que aceptar las condiciones y restricciones de SIA.",
			},
		},
	});
}
/**
	 Guardar Registro
 **/
$("#guardar_registro").click(function () {
	if ($("#formulario_registro").valid()) {
		var organizacion = $("#organizacion").val();
		var nit = $("#nit").val() + "-" + $("#nit_digito").val();
		var sigla = $("#sigla").val();
		var nombre = $("#nombre").val();
		var nombre_s = $("#nombre_s").val();
		var apellido = $("#apellido").val();
		var apellido_s = $("#apellido_s").val();
		var correo_electronico = $("#correo_electronico").val();
		var correo_electronico_rep_legal = $("#correo_electronico_rep_legal").val();
		var nombre_p = $("#nombre_p").val();
		var apellido_p = $("#apellido_p").val();
		var nombre_usuario = $("#nombre_usuario").val();
		var pass = $("#password").val();
		var pass2 = $("#re_password").val();
		var check = $("#acepto_cond").prop("checked");
		var response_captcha = grecaptcha.getResponse();
		console.log(response_captcha);

		if (
			organizacion.length > 0 &&
			nit.length > 0 &&
			nombre.length > 0 &&
			apellido.length > 0 &&
			correo_electronico.length > 0 &&
			nombre_usuario.length > 0 &&
			pass.length > 0 &&
			pass2.length > 0
		) {
			if (pass == pass2) {
				if (check == true) {
					if (response_captcha != 0) {
						var data = {
							organizacion: organizacion,
							nit: nit,
							sigla: sigla,
							nombre: nombre,
							nombre_s: nombre_s,
							apellido: apellido,
							apellido_s: apellido_s,
							correo_electronico: correo_electronico,
							correo_electronico_rep_legal: correo_electronico_rep_legal,
							nombre_p: nombre_p,
							apellido_p: apellido_p,
							nombre_usuario: nombre_usuario,
							password: pass,
						};
						console.log(data);
						$.ajax({
							url: baseURL + "home/verificarUsuario",
							type: "post",
							dataType: "JSON",
							data: data,
							success: function (response) {
								if (response.existe == 1) {
									notificacion(
										"El nombre usuario ya existe... Puede usar números...",
										"success"
									);
								} else {
									$.ajax({
										url: baseURL + "registro/registrar_info",
										type: "post",
										dataType: "JSON",
										data: data,
										beforeSend: function () {
											$("#loading").show();
											$(this).attr("disabled", true);
											//notificacion("Enviando correo electrónico, espere...");
											notificacion("Registrando información, espere...");
											$(this).attr("disabled", true);
										},
										success: function (response) {
											$("#ayuda_registro").attr("data-backdrop", "static");
											$("#ayuda_registro").attr("data-keyboard", "false");
											$("#correo_electronico_rese").attr(
												"data-org",
												JSON.stringify(response).replace(/'/g, "\\'")
											);
											mensaje(response.msg, "alert-success");
											$("#loading").toggle();
											if (response.status == 0) {
												notificacion(
													"El correo electrónico no fue enviado, intente de nuevo."
												);
												$("#cerr_mod").click();
											} else {
												grecaptcha.reset();
												//clearInputs('formulario_registro');
												notificacion("El correo electrónico enviado.");
												//$('#ayuda_registro').modal('toggle');
												$("#informacion_pre").slideUp();
												$("#reenvio_pre").slideDown();
												$("#reenvio").show();
												$("#guardar_registro").hide();
												$(this).attr("disabled", true);
											}
										},
										error: function (ev) {
											//Do nothing
										},
									});
								}
							},
							error: function (ev) {
								//Do nothing
							},
						});
					} else {
						mensaje(texto_validacaptcha, alert_danger);
						$("#ayuda_registro").modal("toggle");
					}
				} else {
					mensaje("¿Aceptas condiciones y restricciones?", alert_danger);
				}
			} else {
				mensaje("La contraseña no coincide, verifiquela...", alert_warning);
			}
		} else {
			mensaje("Por favor, llene los datos requeridos...", alert_danger);
		}
	}
});
