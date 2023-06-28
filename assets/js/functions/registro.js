/** Capturar BaseUrl */
let url = unescape(window.location.href);
let activate = url.split("/");
let baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
ValidarFormRegistro();
/** Verificación de usuario registrado */
$("#nombre_usuario").change(function () {
	usuario = {
		nombre_usuario: $("#nombre_usuario").val(),
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
/** Verificación de nit registrado */
$("#nit_digito").change(function () {
	organizacion = {
		nit: $("#nit").val() + "-" + $("#nit_digito").val(),
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
/** Aceptar política */
$("#acepto_politica").click(function () {
	$("#acepto_cond").prop("checked", true);
	$("#politica_ventana").modal("toggle");
});
/** Declinar política */
$("#declino_politica").click(function () {
	$("#acepto_cond").prop("checked", false);
	$("#politica_ventana").modal("toggle");
});
/** Aceptar formulario de registro */
$("#aceptoComActo").change(function () {
	if ($("#aceptoComActo").is(":checked")) {
		$("#guardar_registro").removeAttr("disabled");
		$("#guardar_registro").attr("disabled", false);
	} else {
		$("#guardar_registro").attr("disabled", true);
	}
});
/** Confirmar registro formulario de registro */
$("#confirmaRegistro").click(function () {
	$("#informacion_pre").slideDown();
	$("#reenvio_pre").slideUp();
	/** Variables para otras comprobaciones */
	let pass = $("#password").val();
	let pass2 = $("#re_password").val();
	let check = $("#acepto_cond").prop("checked");
	let response_captcha = grecaptcha.getResponse();
	/** Data ajax para verificar NIT y Usuario */
	let data = {
		nombre_usuario: $("#nombre_usuario").val(),
		nit:	$("#nit").val() + "-" + $("#nit_digito").val(),
	};
	/** Validar formulario registro */
	if ($("#formulario_registro").valid()) {
		/** Petición ajax para comprobar NIT */
		$.ajax ({
			url: baseURL + "registro/verificarNIT",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response){
				if (response.existe == 1) {
					Toast.fire({
						/** Alerta cuando NIT ya existe */
						icon: 'warning',
						title: 'El NIT ya existe.'
					});
				} else {
					/** Petición ajax para comprobar usuario */
					$.ajax({
						url: baseURL + "registro/verificarUsuario",
						type: "post",
						dataType: "JSON",
						data: data,
						success: function (response) {
							/** Comprobar si usuario ya */
							if (response.existe == 1) {
								/** Alerta cuando usuario ya existe */
								Toast.fire({
									icon: 'warning',
									title: 'El nombre usuario ya existe. Puede usar números.'
								});
							} else {
								if (pass === pass2) {
									if (check === true) {
										if (response_captcha != 0) {
											/** Alerta de verificación datos*/
											Toast.fire({
												icon: 'success',
												title: 'Verifique su información y correos electrónicos'
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
										} else {
											/** Alerta de captcha no validado */
											Toast.fire({
												icon: 'warning',
												title: 'Por favor valida el captcha.'
											});
										}
									} else {
										/** Alerta de políticas no aceptadas */
										Toast.fire({
											icon: 'warning',
											title: 'Debes leer y aceptar las políticas'
										});
									}
								} else {
									/** Alerta de contraseñas diferentes */
									Toast.fire({
										icon: 'warning',
										title: 'Las contraseñas no coinciden.'
									});
								}
							}
						},
						error: function (ev) {
							//Do nothing
						},
					});
				}
			},
			error: function (ev){
				//Do nothing
			}
		});

	} else {
		/** Alerta de llenar campos requeridos */
		$("#ayuda_registro").modal("toggle");
		Toast.fire({
			icon: 'warning',
			title: 'Por favor, llene los datos requeridos.'
		});
	}
});
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
				// regex:
				// 	"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			re_password: {
				required: true,
				minlength: 8,
				maxlength: 10,
				// regex:
				// 	"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
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
	/** Validar formulario registro */
	if ($("#formulario_registro").valid()) {
		/** Variable grecaptcha */
		let response_captcha = grecaptcha.getResponse();
		/** Comprobar captcha */
		if (response_captcha != 0) {
			/** Data para registrar cuenta */
			let data = {
				organizacion: $("#organizacion").val(),
				nit: $("#nit").val() + "-" + $("#nit_digito").val(),
				sigla: $("#sigla").val(),
				nombre: $("#nombre").val(),
				nombre_s: $("#nombre_s").val(),
				apellido: $("#apellido").val(),
				apellido_s: $("#apellido_s").val(),
				correo_electronico: $("#correo_electronico").val(),
				correo_electronico_rep_legal: $("#correo_electronico_rep_legal").val(),
				nombre_p: $("#nombre_p").val(),
				apellido_p: $("#apellido_p").val(),
				nombre_usuario: $("#nombre_usuario").val(),
				password: $("#password").val(),
			};
			console.log(data);
			/** Verificar si NIT ya existe */
			$.ajax({
				url: baseURL + "registro/verificarNIT",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					if (response.existe == 1) {
						/** Alerta si NIT ya existe*/
						Toast.fire({
							icon: 'error',
							title: 'El NIT ya existe.'
						});
					} else {
						/** Verificar si usuario ya existe */
						$.ajax({
							url: baseURL + "registro/verificarUsuario",
							type: "post",
							dataType: "JSON",
							data: data,
							success: function (response) {
								if (response.existe == 1) {
									/** Alerta si usuario ya existe*/
									Toast.fire({
										icon: 'error',
										title: 'El nombre usuario ya existe. Puede usar números.'
									});
									/** Ejecución de registro de información*/
								} else {
									$.ajax({
										url: baseURL + "registro/registrar_info",
										type: "post",
										dataType: "JSON",
										data: data,
										beforeSend: function () {
											$("#guardar_registro").attr("disabled", true);
											Toast.fire({
												icon: 'info',
												title: 'Registrando información, espere...'
											});
										},
										success: function (response) {
											/** Modal Estático */
											$("#ayuda_registro").attr("data-backdrop", "static");
											$("#ayuda_registro").attr("data-keyboard", "false");
											// $("#correo_electronico_rese").attr(
											// 	"data-org",
											// 	JSON.stringify(response).replace(/'/g, "\\'")
											// );
											/** Comprobar estado de envío y creación de cuenta */
											if (response.status == 1) {
												/** Reset Captcha */
												grecaptcha.reset();
												Toast.fire({
													icon: 'success',
													title: response.msg,
												});
												/** Esconder confirmación y mostrar reenvío de email */
												$("#informacion_previa").slideUp();
												$("#reenvio_email").slideDown();
												$("#reenvio").show();
												$("#guardar_registro").hide();
											} else {
												/** Alerta si el correo no se envío */
												Toast.fire({
													icon: 'error',
													title: 'El correo electrónico no fue enviado, intente de nuevo.'
												});
												/** Cerrar Modal */
												$("#cerr_mod").click();
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
					}
				},
			});

		} else {
			/** Alerta si no se valida la captcha */
			Toast.fire({
				icon: 'warning',
				title: 'Por favor valida el captcha.'
			});
		}

	}
});
