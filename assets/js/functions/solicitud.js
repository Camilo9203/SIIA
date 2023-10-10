$(document).ready(function () {
	var url = unescape(window.location.href);
	var solicitud = url.substr(url.lastIndexOf('/') + 1);
	var activate = url.split("/");
	var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
	var siValidadForm = solicitud.substring(0,2);
	if (siValidadForm == 20) {
		verificarFormularios(solicitud);
		cargarArchivos()
	}
});
// Recarga tabla de archivos
$(".dataReload").click(function () {
	cargarArchivos();
	Toast.fire({
		icon: 'success',
		text: 'Archivos cargados'
	});
});
// Botón para ocultar y mostrar menu
$(".hide-sidevar").click(function () {
	if ($(".side_main_menu").css("display") == "none") {
		$(".side_main_menu").css("display", "block");
		$(".formularios").removeClass("col-md-12");
		$(".formularios").addClass("col-md-9");
		$(".hide-sidevar > .fa").removeClass("fa-arrows-alt");
		$(".hide-sidevar > .fa").addClass("fa-window-close-o");
		$(".hide-sidevar > v").html("Ocultar menú");
		$(".side_main_menu").addClass("bounceInLeft animated");
	} else {
		$(".side_main_menu").css("display", "none");
		$(".formularios").removeClass("col-md-9");
		$(".formularios").addClass("col-md-12");
		$(".hide-sidevar > .fa").removeClass("fa-window-close-o");
		$(".hide-sidevar > .fa").addClass("fa-arrows-alt");
		$(".hide-sidevar > v").html("Ver menú");
		$(".side_main_menu").addClass("bounceInLeft animated");
	}
});
// Eventos del menu
$("#sidebar-menu>.menu_section>#wizard_verticle>.side-menu>li>a").click(function () {
		$(".formulario_panel").hide();
		$("#panel_inicial").hide();
		$("#estado_solicitud").hide();
		$(".archivos").toggle();
		let id_form = $(this).attr("data-form");
		let step = $("#sidebar-menu>.menu_section>#wizard_verticle>.side-menu>li>a>span#" + id_form);
		step.addClass("menu-sel");
		step.removeClass("keyStep");
		$("#idDataForm").remove();
		$("body").append("<div id='idDataForm' class='hidden' data-form='" + id_form + "'>");
		switch (id_form) {
			case "1":
				$("#informacion_general_entidad").show();
				break;
			case "2":
				$("#documentacion_legal").show();
				break;
			case "3":
				$("#antecedentes_academicos").show();
				break;
			case "4":
				$("#jornadas_de_actualizacion").show();
				break;
			case "5":
				$("#programa_basico_de_economia_solidaria").show();
				break;
			case "6":
				$("#docentes").show();
				break;
			case "7":
				$("#datos_plataforma").show();
				break;
			case "8":
				$("#datos_en_linea").show();
				break;
			case "0":
				$("#finalizar_proceso").show();
				break;
			default:
				notificacion("Selecciona otra opción.");
		}
		cargarArchivos();
	}
);
/**
 * Formulario 1: formularios información general
 * */
// Guardar formulario 1
$("#guardar_formulario_informacion_general_entidad").click(function () {
	validFroms(1);
	event.preventDefault();
	if ($("#formulario_informacion_general_entidad").valid()) {
		$(this).attr("disabled", true);
		data = {
			tipo_organizacion: $("#tipo_organizacion").val(),
			departamento: $("#departamentos").val(),
			municipio: $("#municipios").val(),
			direccion: $("#direccion").val(),
			fax: $("#fax").val(),
			extension:  $("#extension").val(),
			urlOrganizacion: $("#urlOrganizacion").val(),
			actuacion: $("#actuacion").val(),
			educacion: $("#educacion").val(),
			numCedulaCiudadaniaPersona: $("#numCedulaCiudadaniaPersona").val(),
			presentacion: $("#presentacion").val(),
			objetoSocialEstatutos: $("#objetoSocialEstatutos").val(),
			mision: $("#mision").val(),
			vision: $("#vision").val(),
			principios: $("#principios").val(),
			fines: $("#fines").val(),
			portafolio: $("#portafolio").val(),
			otros: $("#otros").val(),
		};
		$.ajax({
			url: baseURL + "InformacionGeneral/create",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					text: 'Guardando'
				});
			},
			success: function (response) {
				if(response.status == 1) {
					Alert.fire({
						title: 'Guardado!',
						text: response.msg,
						icon: 'success',
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 2000);
						}
					})
				}
				else{
					Alert.fire({
						title: 'Error al guardar!',
						text: response.msg,
						icon: 'error',
					})
				}
			},
			error: function (ev) {
				event.preventDefault();
				Toast.fire({
					icon: 'error',
					text: ev.responseText
				});
			},
		});
	}
});
// Eliminar archivos
$(document).on("click", ".eliminar_archivo", function () {
	Alert.fire({
		title: 'Eliminar archivo ',
		text: '¿Realmente desea eliminar este archivo?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			let data = {
				id_formulario: $(this).attr("data-id-formulario"),
				id_archivo: $(this).attr("data-id-archivo"),
				tipo: $(this).attr("data-id-tipo"),
				nombre: $(this).attr("data-nombre-ar"),
			};
			$.ajax({
				url: baseURL + "Archivos/delete",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'info',
						title: 'Eliminando'
					})
				},
				success: function (response) {
					Alert.fire({
						title: 'Archivo eliminado!',
						html: response.msg,
						text: response.msg,
						icon: 'success',
					}).then((result) => {
						if (result.isConfirmed) {
							cargarArchivos();
						}
					});
				},
				error: function (ev) {
					Toast.fire({
						icon: 'error',
						title: 'Error en el controlador consulta al administrador'
					})
				},
			});
		}
	});
});
// Guardar archivos tipo carta
$(".archivos_form_carta").on("click", function () {
	let data_name = $(".archivos_form_carta").attr("data-name");
	let form_data = new FormData();
	form_data.append("file", $("#" + data_name).prop("files")[0]);
	form_data.append("tipoArchivo", $("#" + data_name).attr("data-val"));
	form_data.append("append_name", data_name);
	form_data.append("id_form", $(".archivos_form_carta").attr("data-form"));
	form_data.append("idSolicitud", $(".archivos_form_carta").attr("data-solicitud"));
	$.ajax({
		url: baseURL + "Archivos/create",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSubmit: function () {
			Toast.fire({
				icon: 'info',
				text: 'Guardando'
			})
		},
		success: function (response) {
			console.log(response);
			if (response.icon == "success") {
				Alert.fire({
					title: 'Archivo guardado!',
					text: response.msg,
					icon: response.icon,
					confirmButtonText: 'Aceptar',
				})
			}
			else if (response.icon == "error") {
				Alert.fire({
					title: 'Error al guardar!',
					text: response.msg,
					icon: response.icon,
					confirmButtonText: 'Aceptar',
				})
			}
			clearInputs('formulario_carta');
			cargarArchivos();
		},
		error: function (ev) {
			event.preventDefault();
			Toast.fire({
				icon: 'error',
				text: ev.responseText
			});
		},
	});
});
// Guardar archivos tipo certificaciones
$(".archivos_form_certificacion").on("click", function () {
	let data_name = $(".archivos_form_certificacion").attr("data-name");
	var form_data = new FormData();
	let count = 0;
	$.each(
		$("#formulario_certificaciones input[type='file']"),
		function (obj, v) {
			var file = v.files[0];
			if (file != undefined) {
				form_data.append("file[" + obj + "]", file);
				count ++;
			}
		}
	);
	if (count === 3) {
		form_data.append("tipoArchivo", $("#" + data_name + "1").attr("data-val"));
		form_data.append("append_name", data_name);
		$.ajax({
			url: baseURL + "archivos/uploadFiles",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				Toast.fire({
					icon: 'info',
					text: 'Cargando archivos'
				})
			},
			success: function (response) {
				console.log(response);
				if (response.icon == "success") {
					Alert.fire({
						title: 'Archivos guardados!',
						html: response.msg,
						text: response.msg,
						icon: response.icon,
					})
				}
				else if (response.icon == "error") {
					Alert.fire({
						title: 'Error al guardar!',
						html: response.msg,
						text: response.msg,
						icon: response.icon,
					})
				}
				clearInputs('formulario_certificaciones');
				cargarArchivos();
			},
			error: function (ev) {
				Alert.fire({
					title: 'Error al guardar, consulta al administrador!',
					icon: 'error',
					confirmButtonText: 'Aceptar',
				})
				cargarArchivos();
			},
		});
	}
	else {
		Alert.fire({
			title: 'No se examinaron los 3 archivos!',
			text: 'Debes cargar 3 archivos para continuar',
			icon: 'warning',
		})
	}
});
// Guardar imágenes del lugar
$(".archivos_form_lugar").on("click", function () {
	$data_name = $(".archivos_form_lugar").attr("data-name");
	var form_data = new FormData();
	let count = 0;
	$.each($("#formulario_lugar input[type='file']"), function (obj, v) {
		var file = v.files[0];
		if (file != undefined) {
			form_data.append("file[" + obj + "]", file);
			count++;
		}
	});
	if (count > 0) {
		form_data.append("tipoArchivo", $("#" + $data_name + "1").attr("data-val"));
		form_data.append("append_name", $data_name);
		$.ajax({
			url: baseURL + "archivos/uploadFiles",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				Toast.fire({
					icon: 'info',
					text: 'Cargando archivos'
				})
			},
			success: function (response) {
				if (response.icon == "success") {
					Alert.fire({
						title: 'Archivos guardados!',
						html: response.msg,
						text: response.msg,
						icon: response.icon,
					})
				}
				else if (response.icon == "error") {
					Alert.fire({
						title: 'Error al guardar!',
						html: response.msg,
						text: response.msg,
						icon: response.icon,
					})
				}
				clearInputs('formulario_lugar');
				cargarArchivos();
			},
			error: function (ev) {
				event.preventDefault();
				Alert.fire({
					title: 'Error al guardar, consulta al administrador!',
					icon: 'error',
				})
			},
		});
	}
	else {
		Alert.fire({
			title: 'No se selecciono ninguna imagen!',
			text: 'Debes cargar al menos una imagen para continuar',
			icon: 'warning',
		})
	}

});
/**
 * Formulario 2: Formularios documentación legal
 * */
// Camara de comercio
$(".camaraComercio").click(function () {
	if ($("input:radio[name=camaraComercio]:checked").val() == "Si") {
		$("#div_camara_comercio").show();
		$("#reg_doc_cond").show();
		$("#reg_doc_cond>a").removeAttr("style");
		$("#reg_doc_cond>a").html('<span id="3" class="step_no">3</span> Camara de Comercio Entidad <i class="fa fa-newspaper-o" aria-hidden="true"></i>');
		$("input:radio[name=registroEducativo]").attr("disabled", true);
		$("#div_registro_educativo").hide();
		$("input:radio[name=certificadoExistencia]").attr("disabled", true);
		$("#div_certificado_existencia").hide();
	} else {
		$("input:radio[name=registroEducativo]").attr("disabled", false);
		$("input:radio[name=certificadoExistencia]").attr("disabled", false);
		$("#div_camara_comercio").hide();
		$("#reg_doc_cond").hide();
	}
});
// Certificado de existencia
$(".certificadoExistencia").click(function () {
	if ($("input:radio[name=certificadoExistencia]:checked").val() == "Si") {
		$("#div_certificado_existencia").show();
		$("#reg_doc_cond").show();
		$("#reg_doc_cond>a").removeAttr("style");
		$("#reg_doc_cond>a").html('<span id="3" class="step_no">3</span> Certificado Existencia <i class="fa fa-newspaper-o" aria-hidden="true"></i>');
		$("input:radio[name=registroEducativo]").attr("disabled", true);
		$("#div_registro_educativo").hide();
		$("input:radio[name=camaraComercio]").attr("disabled", true);
		$("#div_camara_comercio").hide();
	} else {
		$("input:radio[name=registroEducativo]").attr("disabled", false);
		$("input:radio[name=camaraComercio]").attr("disabled", false);
		$("#div_certificado_existencia").hide();
		$("#reg_doc_cond").hide();
	}
});
// Registro educativo
$(".registroEducativo").click(function () {
	if ($("input:radio[name=registroEducativo]:checked").val() == "Si") {
		$("#div_registro_educativo").show();
		$("#reg_doc_cond").show();
		$("#reg_doc_cond>a").removeAttr("style");
		$("#reg_doc_cond>a").html('<span id="3" class="step_no">3</span> Registros Educativos de Programas <i class="fa fa-newspaper-o" aria-hidden="true"></i>'); //('<small>(Finalizado)</small> <i class="fa fa-check" aria-hidden="true"></i>');
		$("input:radio[name=camaraComercio]").attr("disabled", true);
		$("#div_camara_comercio").hide();
		$("input:radio[name=certificadoExistencia]").attr("disabled", true);
		$("#div_certificado_existencia").hide();
	} else {
		$("input:radio[name=camaraComercio]").attr("disabled", false);
		$("input:radio[name=certificadoExistencia]").attr("disabled", false);
		$("#div_registro_educativo").hide();
		$("#reg_doc_cond").hide();
	}
});
// Guardar formulario certificado camara de comercio
$("#guardar_formulario_camara_comercio").click(function () {
	event.preventDefault();
	// Capturar datos formulario
	let data = {
		tipo: 1,
		idSolicitud: $(this).attr('data-id'),
		id_organizacion: $(this).attr('data-idOrg')
	};
	// Petición para guardar datos
	$.ajax({
		url: baseURL + "panel/guardar_formulario_documentacion_legal",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'info',
				title: 'Guardando'
			})
		},
		success: function (response) {
			Alert.fire({
				title: 'Guardado!',
				text: response.msg,
				icon: 'success',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
			})
		},
		error: function (ev) {
			event.preventDefault();
			Toast.fire({
				icon: 'error',
				text: ev.responseText
			});
		},
	});

});
// Eliminar datos camara de comercio
$(".eliminarDatosCamaraComercio").click(function () {
	let data = {
		id: $(this).attr("data-id"),
		ruta: 'uploads//',
		tipo: 2
	};
	eliminarFormularioDocumentacionLegal(data);
});
// Guardar certificado de existencia
$("#guardar_formulario_certificado_existencia").click(function () {
	//$(this).attr("disabled", true);
	event.preventDefault();
	validFroms (2.1);
	if($("#formulario_certificado_existencia_legal").valid()) {
		let formData = new FormData();
		formData.append("file", $("#archivoCertifcadoExistencia").prop("files")[0]);
		formData.append("append_name", "CertificadoExistencia");
		formData.append("entidadCertificadoExistencia", $("#entidadCertificadoExistencia").val());
		formData.append("fechaExpedicion", $('#fechaExpedicion').val());
		formData.append("departamentoCertificado", $('#departamentos2').val());
		formData.append("municipioCertificado", $('#municipios2').val());
		formData.append("tipo", 2);
		formData.append("idSolicitud", $(this).attr('data-id'));
		console.log(formData);
		// Petición para guardar datos
		$.ajax({
			url: baseURL + "panel/guardar_formulario_documentacion_legal",
			cache: false,
			contentType: false,
			processData: false,
			type: "post",
			dataType: "JSON",
			data: formData,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Guardando'
				})
			},
			success: function (response) {
				Alert.fire({
					title: 'Guardado!',
					text: response.msg,
					icon: 'success',
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							reload();
						}, 2000);
					}
				})
			},
			error: function (ev) {
				event.preventDefault();
				Toast.fire({
					icon: 'error',
					text: ev.responseText
				});
			},
		});
	}
});
// Ver Documento Certificado Existencia
$(".verDocCertificadoExistencia").click(function (){
	let data = {
		id: $(this).attr("data-id"),
		formulario: 2.1,
	}
	verDocumentos(data);
});
// Eliminar datos certificado existencia
$(".eliminarDatosCertificadoExistencia").click(function () {
	data = {
		id: $(this).attr("data-id"),
		ruta: 'uploads/certificadoExistencia/',
		tipo: 2.1
	};
	eliminarFormularioDocumentacionLegal(data);
});
// Guardar registro educativo
$("#guardar_formulario_registro_educativo").click(function (){
	//$(this).attr("disabled", true);
	event.preventDefault();
	validFroms (2.2);
	if($("#formulario_registro_educativo").valid()) {
		let formData = new FormData();
		formData.append("tipoEducacion", $("#tipoEducacion").val());
		formData.append("fechaResolucionProgramas", $('#fechaResolucionProgramas').val());
		formData.append("numeroResolucionProgramas", $('#numeroResolucionProgramas').val());
		formData.append("nombrePrograma", $('#nombreProgramaResolucion').val());
		formData.append("objetoResolucionProgramas", $('#objetoResolucionProgramas').val());
		formData.append("entidadResolucion", $('#entidadResolucion').val());
		formData.append("file", $("#archivoRegistroEdu").prop("files")[0]);
		formData.append("append_name", "registroEdu");
		formData.append("tipo", 3);
		formData.append("idSolicitud", $(this).attr('data-id'));
		// Petición para guardar datos
		$.ajax({
			url: baseURL + "panel/guardar_formulario_documentacion_legal",
			cache: false,
			contentType: false,
			processData: false,
			type: "post",
			dataType: "JSON",
			data: formData,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Guardando'
				})
			},
			success: function (response) {
				Alert.fire({
					title: 'Guardado!',
					text: response.msg,
					icon: 'success',
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							reload();
						}, 2000);
					}
				})
			},
			error: function (ev) {
				event.preventDefault();
				Toast.fire({
					icon: 'error',
					text: ev.responseText
				});
			},
		});
	}
});
// Ver Documento Registro Educativo
$(".verDocRegistro").click(function (){
	let data = {
		id: $(this).attr("data-id"),
		formulario: 2.2,
	}
	verDocumentos(data);
});
// Eliminar datos registro educativo
$(".eliminarDatosRegistro").click(function () {
	data = {
		id: $(this).attr("data-id"),
		ruta: 'uploads/registrosEducativos/',
		tipo: 2.2
	};
	eliminarFormularioDocumentacionLegal(data);
});
// Funciones formulario 2
// Función Ver Documentos
function verDocumentos (data) {
	event.preventDefault();
	$.ajax({
		url: baseURL + "panel/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_blank');
		}
	});
}
// Función Eliminar Datos Form 2
function  eliminarFormularioDocumentacionLegal (data) {
	Alert.fire({
		title: 'Eliminar documentación legal',
		text: '¿Realmente desea eliminar este registro?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: baseURL + "panel/eliminarDocumentacionLegal",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'info',
						title: 'Elinando'
					})
				},
				success: function (response) {
					Alert.fire({
						title: 'Eliminado!',
						text: response.msg,
						icon: 'success',
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 2000);
						}
					})
				},
				error: function (ev) {
					event.preventDefault();
					Toast.fire({
						icon: 'error',
						text: ev.responseText
					});
				},
			});
		}
	});
}
/**
 * Formulario 3: Antecedentes Académicos
 * */
// Guardar formulario antecedentes académicos
$("#guardar_formulario_antecedentes_academicos").click(function () {
	validFroms(3);
	if($("#formulario_antecedentes_academicos").valid()){
		let data = {
			descripcionProceso: $("#descripcionProceso").val(),
			justificacionAcademicos: $("#justificacionAcademicos").val(),
			objetivosAcademicos: $("#objetivosAcademicos").val(),
			metodologiaAcademicos: $("#metodologiaAcademicos").val(),
			materialDidacticoAcademicos: $("#materialDidacticoAcademicos").val(),
			bibliografiaAcademicos: $("#bibliografiaAcademicos").val(),
			duracionCursoAcademicos: $("#duracionCursoAcademicos").val(),
			idSolicitud: $(this).attr('data-id')
		};
		event.preventDefault();
		$.ajax({
			url: baseURL + "panel/guardar_formulario_antecedentes_academicos",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				$(this).attr("disabled", true);
				Toast.fire({
					icon: 'info',
					title: 'Guardando'
				})
			},
			success: function (response) {
				Alert.fire({
					title: 'Guardado!',
					text: response.msg,
					icon: 'success',
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							reload();
						}, 2000);
					}
				})
			},
			error: function (ev) {
				event.preventDefault();
				Toast.fire({
					icon: 'error',
					text: ev.responseText
				});
			},
		});
	}
	else {
		Toast.fire({
			icon: 'info',
			title: 'Validar campos'
		})
	}
});
// Eliminar antecedentes académicos
$(".eliminarAntecedentes").click(function () {
	Alert.fire({
		title: 'Eliminar antecedente acádemico',
		text: '¿Realmente desea eliminar este registro?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			let data = {
				id_antecedentes: $(this).attr("data-id-antecedentes"),
			};
			$.ajax({
				url: baseURL + "panel/eliminarAntecedentes",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'info',
						title: 'Elimiando'
					})
				},
				success: function (response) {
					Alert.fire({
						title: 'Guardado!',
						text: response.msg,
						icon: 'success',
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 2000);
						}
					})
				},
				error: function (ev) {
					event.preventDefault();
					Toast.fire({
						icon: 'error',
						text: ev.responseText
					});
				},
			});
		}
	});
});
/**
 * Formulario 4: Jornadas de actualización
 * */
// Guardar formulario jórnada de actualización
$(".guardar_formulario_jornadas_actualizacion").click(function () {
	//$(this).attr("disabled", true);
	var form_data = new FormData();
	form_data.append('file', $('#fileJornadas').prop('files')[0]);
	form_data.append('tipoArchivo', $(this).attr('data-name'));
	form_data.append('append_name', $(this).attr('data-name'));
	form_data.append('numeroPersonas', $('#jornadasNumeroPersonas').val());
	form_data.append('fechaAsistencia', $('#jornadasFechaAsistencia').val());
	form_data.append('idSolicitud', $(this).attr('data-id'));
	event.preventDefault();
	$.ajax({
		url: baseURL + "JornadasActualizacion/create", // guardarArchivoJornada
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "POST",
		beforeSend: function () {
			Toast.fire({
				icon: 'info',
				title: 'Guardando'
			})
		},
		success: function (response) {
			response = JSON.parse(response);
			if (response.icon == "success") {
				Alert.fire({
					title: 'Guardado!',
					text: response.msg,
					icon: response.icon,
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							reload();
						}, 2000);
					}
				})
			}
			else if (response.icon == "error") {
				Alert.fire({
					title: 'Error al guardar!',
					text: response.msg,
					icon: response.icon,
				})
			}
		},
		error: function (ev) {
			console.log(ev);
		},
	});
});
// Eliminar jornada actualización
$(".eliminarJornadaActualizacion").click(function () {
	Alert.fire({
		title: 'Eliminar jornada de actualización',
		text: '¿Realmente desea eliminar este registro?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			let data = {
				id_jornada: $(this).attr("data-id-jornada"),
			};
			$.ajax({
				url: baseURL + "JornadasActualizacion/delete",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'info',
						title: 'Eliminando'
					})
				},
				success: function (response) {
					Alert.fire({
						title: 'Registro eliminado!',
						html: response.msg,
						text: response.msg,
						icon: 'success',
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 2000);
						}
					})
				},
				error: function (ev) {
					event.preventDefault()
					Toast.fire({
						icon: 'error',
						title: 'Error en el controlador consulta al administrador'
					})
				},
			});
		}
	});
});
/**
 * Formulario 5: Programas de Educación
 * */
// Acciones de cada modal de aceptación
$("#aceptar_curso_basico_es").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	let idSolicitud = $(this).attr("data-id");
	guardarDatosProgramas(curso,modal,check, idSolicitud);
});
$("#aceptar_aval_trabajo").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	let idSolicitud = $(this).attr("data-id");
	guardarDatosProgramas(curso,modal,check, idSolicitud);
});
$("#aceptar_curso_medio_es").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	let idSolicitud = $(this).attr("data-id");
	guardarDatosProgramas(curso,modal,check, idSolicitud);
});
$("#aceptar_avanzado_medio_es").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	let idSolicitud = $(this).attr("data-id");
	guardarDatosProgramas(curso,modal,check, idSolicitud);
});
$("#aceptar_educacion_financiera").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	let idSolicitud = $(this).attr("data-id");
	guardarDatosProgramas(curso,modal,check, idSolicitud);
});
// Función para guardar datos al aceptar programa
function guardarDatosProgramas (curso,modal, check, idSolicitud){
	$("#" + modal).modal("toggle");
	$("#" + check).prop("checked", true);
	$(this).attr("disabled", true);
	event.preventDefault();
	data = {
		programa: curso,
		organizacion:  $("#id_organizacion").val(),
		idSolicitud: idSolicitud
	};
	$.ajax({
		url: baseURL + "panel/guardar_formulario_datos_programas",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'info',
				title: 'Guardando'
			})
		},
		success: function (response) {
			Alert.fire({
				title: 'Guardado!',
				text: response.msg,
				icon: 'success',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
			})
		},
		error: function (ev) {
			event.preventDefault();
			Toast.fire({
				icon: 'error',
				text: ev.responseText
			});
		},
	});
}
// Eliminar datos plataforma
$(".eliminarDatosProgramas").click(function () {
	Alert.fire({
		title: 'Eliminar programa de acreditacion',
		text: '¿Realmente desea eliminar este registro?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			data = {
				id: $(this).attr("data-id"),
			};
			$.ajax({
				url: baseURL + "panel/eliminarDatosProgramas",
				type: "post",
				dataType: "JSON",
				data: data,
                beforeSend: function () {
                    Toast.fire({
                        icon: 'info',
                        title: 'Eliminando'
                    })
                },
                success: function (response) {
                    Alert.fire({
                        title: 'Registro eliminado!',
                        text: response.msg,
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setInterval(function () {
                                reload();
                            }, 2000);
                        }
                    })
                },
                error: function (ev) {
                    event.preventDefault()
                    Toast.fire({
                        icon: 'error',
                        title: 'Error en el controlador consulta al administrador'
                    })
                },
			});
		}
	});
});
/**
 * Formulario 6: Llevar a modulo docentes
 * */
$("#irDocentes").click(function () {
	event.preventDefault();
	window.open(baseURL + "panel/docentes/", '_blank');
});
/**
 * Formulario 7: Modalidad Virtual
 * */
// Aceptar recomendaciones modalidad virtual
$("#acepto_mod_virtual").click(function () {
	$("#acepta_mod_en_virtual").prop("checked", true);
	$("#modalAceptarVirtual").modal("hide");
});
// Guardar datos de plataforma
$("#guardar_formulario_plataforma").click(function () {
	validFroms(7);
	if ($("#formulario_modalidad_virtual").valid()) {
		if ($("#acepta_mod_en_virtual").prop("checked") == true) {
			event.preventDefault();
			let data = {
				datos_plataforma_url: $("#datos_plataforma_url").val(),
				datos_plataforma_usuario: $("#datos_plataforma_usuario").val(),
				datos_plataforma_contrasena: $("#datos_plataforma_contrasena").val(),
				idSolicitud: $(this).attr('data-id')
			};
			$.ajax({
				url: baseURL + "panel/guardar_formulario_aplicacion",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'info',
						title: 'Guardando'
					})
				},
				success: function (response) {
					Alert.fire({
						title: 'Guardado!',
						text: response.msg,
						icon: 'success',
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 2000);
						}
					})
				},
				error: function (ev) {
					event.preventDefault();
					Toast.fire({
						icon: 'error',
						text: ev.responseText
					});
				},
			});
		}
		else {
			Toast.fire({
				icon: 'info',
				title: 'Acepte modalidad virtual'
			})
			event.preventDefault();
		}
	}
	else {
		Toast.fire({
			icon: 'info',
			title: 'Validar los campos'
		})
		event.preventDefault();
	}
});
// Eliminar datos de plataforma
$(".eliminarDatosPlataforma").click(function () {
	Alert.fire({
		title: 'Eliminar datos modalidad virtual',
		text: '¿Realmente desea eliminar este registro?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			$id_plataforma = $(this).attr("data-id-datosPlataforma");
			data = {
				id_plataforma: $id_plataforma,
			};
			$.ajax({
				url: baseURL + "panel/eliminarDatosPlataforma",
				type: "post",
				dataType: "JSON",
				data: data,
                beforeSend: function () {
                    Toast.fire({
                        icon: 'info',
                        title: 'Eliminando'
                    })
                },
                success: function (response) {
                    Alert.fire({
                        title: 'Registro eliminado!',
                        text: response.msg,
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setInterval(function () {
                                reload();
                            }, 2000);
                        }
                    })
                },
                error: function (ev) {
                    event.preventDefault()
                    Toast.fire({
                        icon: 'error',
                        title: 'Error en el controlador consulta al administrador'
                    })
                },
			});
		}
	});
});
/**
 * Formulario 8: Modalidad En Línea
 * */
// Aceptar recomendaciones modalidad en línea
$("#acepto_mod_en_linea").click(function () {
	$("#acepta_mod_en_linea").prop("checked", true);
	$("#modalAceptarEnLinea").modal("hide");
});
// Guardar formulario
$("#guardar_formulario_modalidad_en_linea").click(function () {
	// Validar formulario
	validFroms(8);
	if ($("#formulario_modalidad_en_linea").valid()) {
		event.preventDefault();
		if ($("#acepta_mod_en_linea").prop("checked") == true) {
			// Capturar datos formulario
			let form_data = new FormData();
			form_data.append("tipoArchivo", $("#instructivoEnLinea").attr("data-val"));
			form_data.append("append_name", $("#instructivoEnLinea").attr("data-val"));
			form_data.append("nombreHerramienta",  $("#nombre_herramienta").val());
			form_data.append("descripcionHerramienta", $("#descripcion_herramienta").val());
			form_data.append("aceptacion", $("#acepta_mod_en_linea").val());
			form_data.append("idSolicitud", $(this).attr('data-id'));
			// Petición para guardar datos
			$.ajax({
				url: baseURL + "panel/guardar_formulario_modalidad_en_linea",
				cache: false,
				contentType: false,
				processData: false,
				type: "post",
				dataType: "JSON",
				data: form_data,
                beforeSend: function () {
                    Toast.fire({
                        icon: 'info',
                        title: 'Guardando'
                    })
                },
                success: function (response) {
                    Alert.fire({
                        title: 'Guardado!',
                        text: response.msg,
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setInterval(function () {
                                reload();
                            }, 2000);
                        }
                    })
                },
                error: function (ev) {
                    event.preventDefault();
                    Toast.fire({
                        icon: 'error',
                        text: ev.responseText
                    });
                },
			});
		}
		else {
            Toast.fire({
                icon: 'info',
                title: 'Acepte modalidad en línea'
            })
		}
	}
	else {
        Toast.fire({
            icon: 'info',
            title: 'Validar los campos'
        })
        event.preventDefault();
	}

});
// Ver Documento
$(".verDocDatosEnlinea").click(function (){
	data = {
		id: $(this).attr("data-id"),
		formulario: 8,
	}
	$.ajax({
		url: baseURL + "panel/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_blank');
		}
	});
});
// Eliminar datos en línea
$(".eliminarDatosEnlinea").click(function () {
	Alert.fire({
		title: 'Eliminar datos programa en línea',
		text: '¿Realmente desea eliminar este registro?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			data = {
				id: $(this).attr("data-id"),
			};
			$.ajax({
				url: baseURL + "panel/eliminarDatosEnLinea",
				type: "post",
				dataType: "JSON",
				data: data,
                beforeSend: function () {
                    Toast.fire({
                        icon: 'info',
                        title: 'Eliminando'
                    })
                },
                success: function (response) {
                    Alert.fire({
                        title: 'Registro eliminado!',
                        text: response.msg,
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setInterval(function () {
                                reload();
                            }, 2000);
                        }
                    })
                },
                error: function (ev) {
                    event.preventDefault()
                    Toast.fire({
                        icon: 'error',
                        title: 'Error en el controlador consulta al administrador'
                    })
                },
			});
		}
	});
});
/**
 * Finalizar Solicitud
 *
 */
$("#finalizar_si").click(function () {
	Alert.fire({
		title: 'Finalizar solicitud',
		text: '¿Realmente desea enviar solicitud a la unidad solidaría?',
		icon: 'info',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			let idSolicitud = $(this).attr('data-id');
			let data = {
				idSolicitud: idSolicitud,
			};
			$.ajax({
				url: baseURL + "Solicitudes/enviarSolicitud",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'info',
						title: 'Enviando solicitud a unidad Solidaria.'
					});
				},
				success: function (response) {
					if(response.status == 'success'){
						Alert.fire({
							title: response.title,
							html: response.msg,
							text: response.msg,
							icon: response.status,
							allowOutsideClick: false,
						}).then((result) => {
							if (result.isConfirmed) {
								setInterval(function () {
									redirect(baseURL + "panel/estadoSolicitud/" + idSolicitud);
								}, 2000);
							}
						})
					}
					else  {
						$("#sidebar-menu>.menu_section>a").attr('data-id', idSolicitud);
						$("#sidebar-menu>.menu_section>a").click();
					}
				},
				error: function (ev) {
					Toast.fire({
						icon: 'error',
						title: 'Error',
						text: ev.responseText
					});
				},
			});
		}
	});
});
// Si no se validad todos los formularios
$("#sidebar-menu>.menu_section>a").click(function () {
	switch ($(this).attr("data-form")) {
		case "inicio":
			$("#estado_solicitud").show();
			$("#estado_solicitud").addClass("shake animated");
			$("#informacion_general_entidad").hide();
			$("#documentacion_legal").hide();
			$("#antecedentes_academicos").hide();
			$("#jornadas_de_actualizacion").hide();
			$("#programa_basico_de_economia_solidaria").hide();
			$("#docentes").hide();
			$("#datos_plataforma").hide();
			$("#datos_en_linea").hide();
			$("#finalizar_proceso").hide();
			$(".archivos").toggle();
			break;
	}
	verificarFormularios($(this).attr("data-id"));
});
/**
 * Validaciones formularios
 * */
function validFroms (form){
	switch (form) {
		case 1:
			// Formulario Información General
			$("form[id='formulario_informacion_general_entidad']").validate({
				rules: {
					tipo_organizacion: {
						required: true,
					},
					departamentos: {
						required: true,
					},
					municipios: {
						required: true,
					},
					direccion: {
						required: true,
						minlength: 3,
					},
					fax: {
						required: true,
						minlength: 3,
					},
					actuacion: {
						required: true,
					},
					educacion: {
						required: true,
					},
					numCedulaCiudadaniaPersona: {
						required: true,
						minlength: 3,
					},
					presentacion: {
						required: true,
						minlength: 20,
					},
					objetoSocialEstatutos: {
						required: true,
						minlength: 20,
					},
					mision: {
						required: true,
						minlength: 20,
					},
					vision: {
						required: true,
						minlength: 20,
					},
					principios: {
						required: true,
						minlength: 20,
					},
					fines: {
						required: true,
						minlength: 20,
					},
					portafolio: {
						required: true,
						minlength: 20,
					}
				},
				messages: {
					tipo_organizacion: {
						required: "Por favor, seleccione un tipo de la lista.",
					},
					departamentos: {
						required: "Por favor, seleccione un departamento de la lista.",
					},
					municipios: {
						required: "Por favor, seleccione un municipio de la lista.",
					},
					direccion: {
						required: "Por favor, escriba la direccion.",
						minlength: "La dirección debe tener mínimo 3 caracteres.",
					},
					fax: {
						required: "Por favor, escriba el fax/numero.",
						minlength: "El numero debe tener mínimo 3 caracteres.",
					},
					actuacion: {
						required: "Por favor, seleccione una actuación de la lista.",
					},
					educacion: {
						required: "Por favor, seleccione un tipo de la lista.",
					},
					numCedulaCiudadaniaPersona: {
						required: "Por favor, escriba la cédula del Representante Legal.",
						minlength: "La cédula debe tener mínimo 3 caracteres.",
					},
					presentacion: {
						required: "Por favor, escriba la presentación institucional.",
						minlength: "La presentación institucional debe tener mínimo 20 caracteres.",
					},
					objetoSocialEstatutos: {
						required: "Por favor, escriba el objeto social.",
						minlength: "El objeto social  debe tener mínimo 20 caracteres.",
					},
					mision: {
						required: "Por favor, escriba la misión.",
						minlength: "La misión debe tener mínimo 20 caracteres.",
					},
					vision: {
						required: "Por favor, escriba la visión.",
						minlength: "La visión debe tener mínimo 20 caracteres.",
					},
					principios: {
						required: "Por favor, escriba los principios.",
						minlength: "Los principios deben tener mínimo 20 caracteres.",
					},
					fines: {
						required: "Por favor, escriba los fines.",
						minlength: "Los fines deben tener mínimo 20 caracteres.",
					},
					portafolio: {
						required: "Por favor, escriba el portafolio.",
						minlength: "El portafolio  debe tener mínimo 20 caracteres.",
					}
				},
			});
			break;
		case 2.1:
			// Formulario Certificado de existencia
			$("form[id='formulario_certificado_existencia_legal']").validate({
				rules: {
					entidadCertificadoExistencia: {
						required: true,
					},
					fechaExpedicion: {
						required: true,
					},
					departamentos2: {
						required: true,
					},
					municipios2: {
						required: true,
					},
					archivoCertifcadoExistencia: {
						required: true
					}
				},
				messages: {
					entidadCertificadoExistencia: {
						required: "Entidad requerida, por favor ingresarlo.",
					},
					fechaExpedicion: {
						required: "Fecha requerida, por favor ingresarlo.",
					},
					departamentos2: {
						required: "Departamento requerido, por favor ingresarlo.",
					},
					municipios2: {
						required: "Municipio requerido, por favor ingresarlo.",
					},
					archivoCertifcadoExistencia: {
						required: "Archivo requerido, por favor ingresarlo.",
					},
				},
			});
			break;
		case 2.2:
			$("form[id='formulario_registro_educativo']").validate({
				rules: {
					tipoEducacion: {
						required: true,
					},
					fechaResolucionProgramas: {
						required: true,
					},
					numeroResolucionProgramas: {
						required: true,
					},
					nombreProgramaResolucion: {
						required: true,
					},
					objetoResolucionProgramas: {
						required: true
					},
					entidadResolucion: {
						required: true
					},
					archivoRegistroEdu: {
						required: true
					}
				},
				messages: {
					tipoEducacion: {
						required: "Tipo educación requerida, por favor ingresarla.",
					},
					fechaResolucionProgramas: {
						required: "Fecha requerida, por favor ingresarla.",
					},
					numeroResolucionProgramas: {
						required: "Numero de resolución requerida, por favor ingresarlo.",
					},
					nombreProgramaResolucion: {
						required: "Nombre del programa requerido, por favor ingresarlo.",
					},
					objetoResolucionProgramas: {
						required: "Objeto de la resolución requerida, por favor ingresarlo.",
					},
					entidadResolucion: {
						required: "Entidad quien emite la resolución requerida, por favor ingresarla.",
					},
					archivoRegistroEdu: {
						required: "Archivo requerido, por favor adjuntarlo.",
					},
				},
			});
			break;
		case 3:
			$("form[id='formulario_antecedentes_academicos']").validate({
				rules: {
					descripcionProceso: {
						required: true,
					},
					justificacionAcademicos: {
						required: true,
					},
					objetivosAcademicos: {
						required: true,
					},
					metodologiaAcademicos: {
						required: true,
					},
					materialDidacticoAcademicos: {
						required: true
					},
					bibliografiaAcademicos: {
						required: true
					},
					duracionCursoAcademicos: {
						required: true
					}
				},
				messages: {
					descripcionProceso: {
						required: "Descripción del proceso requerida, por favor ingresarla.",
					},
					justificacionAcademicos: {
						required: "Justificación requerida, por favor ingresarla.",
					},
					objetivosAcademicos: {
						required: "Objetivos requeridos, por favor ingresarlos.",
					},
					metodologiaAcademicos: {
						required: "Metodología requerida, por favor ingresarlo.",
					},
					materialDidacticoAcademicos: {
						required: "Material didáctico requerido, por favor ingresarlo.",
					},
					bibliografiaAcademicos: {
						required: "Bibliografía requerida, por favor ingresarla.",
					},
					duracionCursoAcademicos: {
						required: "Duración del cursos requerida, por favor ingresarla.",
					},
				},
			});
			break;
		case 7:
			$("form[id='formulario_modalidad_virtual']").validate({
				rules: {
					datos_plataforma_url: {
						required: true,
						minlength: 10,
					},
					datos_plataforma_usuario: {
						required: true,
						minlength: 5,
					},
					datos_plataforma_contrasena: {
						required: true,
						minlength: 5,
					}
				},
				messages: {
					datos_plataforma_url: {
						required: "Por favor, ingrese la url de la plataforma virtual.",
						minlength: "Mínimo 10 caracteres"
					},
					datos_plataforma_usuario: {
						required: "Por favor, ingrese usuario para ingresar a la plataforma.",
						minlength: "Mínimo 5 caracteres"

					},
					datos_plataforma_contrasena: {
						required: "Por favor, ingrese contraseña para ingresar a la plataforma.",
						minlength: "Mínimo 5 caracteres"
					},
				},
			});
			break;
		case 8:
			$("form[id='formulario_modalidad_en_linea']").validate({
				rules: {
					nombre_herramienta: {
						required: true,
						minlength: 5,
					},
					descripcion_herramienta: {
						required: true,
						minlength: 210,
						maxlength: 420,
					},

				},
				messages: {
					nombre_herramienta: {
						required: "Por favor, ingrese el nombre de la herramienta.",
						minlength: "Mínimo 5 caracteres"
					},
					descripcion_herramienta: {
						required: "Por favor, ingrese descripción de la herramienta.",
						minlength: "Mínimo 210 caracteres",
						maxlength: "Máximo 420 caracteres"
					},
				},
			});
			break;
		default:
	}
}
/**
 * Verificar solicitud
 */
function verificarFormularios(solicitud) {
	$("#formulariosFaltantes").empty();
	let data = {
		'solicitud': solicitud
	};
	$.ajax({
		url: baseURL + "solicitudes/cargarEstadoSolicitud",
		data: data,
		type: "post",
		dataType: "JSON",
		success: function (response) {
			console.log(response)
			for (let i = 0; i < response.formularios.length; i++) {
				let step_sel = response.formularios[i].split(".");
				if (i != step_sel[0]) {
					$("span#" + step_sel[0] + ".step_no").removeClass("menu-sel");
					$("span#" + step_sel[0] + ".step_no").addClass("NOmenu-sel");
				}
				$("#formulariosFaltantes").append("<p>" + response.formularios[i] + "</p>");
			}
			Alert.fire({
				title: response.title,
				html: response.msg + $("#formulariosFaltantes").html(),
				text: response.msg + $("#formulariosFaltantes").html(),
				icon: response.icon,
				allowOutsideClick: false,
				customClass: {
					popup: 'popup-swalert-lg',
					confirmButton: 'button-swalert',
				},
			})
			$("li.step-no>a>span.step_no.menu-sel").parent().css("background", "#008000");
			$("li.step-no>a>span.step_no.menu-sel").parent().css("color", "white");
			$("li.step-no>a>span.step_no.menu-sel").parent().css("border-radius", "10px");
			$("li.step-no>a>span.step_no.menu-sel").parent().css("programasAvalar-materialDidacticong", "4px");
			$("li.step-no>a>span.step_no.menu-sel").parent().css("text-decoration", "underline white");

			if (!$("li.step-no>a").children("span.completo").length > 0) {
				$("li.step-no>a>span.step_no.menu-sel").parent().append('<span class="completo"><small>(Completado)</small> <i class="fa fa-check" aria-hidden="true"></i></span>');
			}
			if ($("#modalFinalizarProceso").css("display") == "block") {
				$("#modalFinalizarProceso").modal("toggle");
				$("#finalizar_si").removeAttr("disabled");
				$("li.step-no>a>span.step_no.NOmenu-sel").addClass("keyStep");
			}
			/** Formularios virtual y en linea */
			//Comprobación modalidad y mostrar los formularios correspondientes
			if(response.solicitud.modalidadSolicitud === "Presencial, Virtual, En Linea" || response.solicitud.modalidadSolicitud === "Virtual, En Linea") {
				$("#itemPlataforma").show();
				$("#itemEnLinea").show();
			}
			if (response.solicitud.modalidadSolicitud === "Presencial, Virtual" || response.solicitud.modalidadSolicitud === "Virtual" ){
				$("#itemPlataforma").show();
			}
			if (response.solicitud.modalidadSolicitud === "Presencial, En Linea" || response.solicitud.modalidadSolicitud === "En Linea") {
				$("#itemEnLinea").show();
			}
			/** Formulario 6 */
			// Visualización checkbox de aceptación según los motivos registrados en tipoSolicitud
			for (let i = 0; i < response.motivos.length; i++) {
				let motivos = response.motivos[i];
				switch (motivos) {
					case "1":
						$("#curso_basico_es").show();
						break;
					case "2":
						$("#curso_basico_aval").show();
						break;
					case "3":
						$("#curso_medio_es").show();
						break;
					case "4":
						$("#curso_avanzado_es").show();
						break;
					case "5":
						$("#curso_economia_financiera").show();
						break;
					default:
				}
			}
			// Check activo si el curso ya se encuentra en base de datos.
			for (let i = 0; i < response.programas.length; i++) {
				let programa = response.programas[i].nombrePrograma;
				switch (programa) {
					case "Acreditación Curso Básico de Economía Solidaria":
						$("#check_curso_basico_es").prop("checked", true);
						break;
					case "Acreditación Aval de Trabajo Asociado":
						$("#check_curso_basico_aval").prop("checked", true);
						break;
					case "Acreditación Curso Medio de Economía Solidaria":
						$("#check_curso_medio_aval").prop("checked", true);
						break;
					case "Acreditación Curso Avanzado de Economía Solidaria":
						$("#check_curso_avanzado_es").prop("checked", true);
						break;
					case "Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria":
						$("#check_curso_economia_financiera").prop("checked", true);
						break;
					default:
				}
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
}
/**
 * Cargar tabla de archivos
 */
function cargarArchivos() {
	$(".tabla_form > #tbody").empty();
	let data = {
		id_form: $("#idDataForm").attr("data-form"),
	};
	$.ajax({
		url: baseURL + "panel/cargarDatosArchivos",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			let url;
			let carpeta;
			if (response.length == 0) {
				$("<tr>").appendTo(".tabla_form > tbody");
				$("<td>Ningún dato</td>").appendTo(".tabla_form > tbody");
				$("<td>Ningún dato</td>").appendTo(".tabla_form > tbody");
				$("<td>Ningún dato</td>").appendTo(".tabla_form > tbody");
				$(".tabla_form > tbody > tr.odd").remove();
			} else {
				for (var i = 0; i < response.length; i++) {
					if (response[i].tipo == "carta") {
						carpeta = "cartaRep";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "certificaciones") {
						carpeta = "certificaciones";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "lugar") {
						carpeta = "lugarAtencion";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "registroEdu") {
						carpeta = "registrosEducativos";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "jornadaAct") {
						carpeta = "jornadas";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "materialDidacticoProgBasicos") {
						carpeta = "materialDidacticoProgBasicos";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "materialDidacticoAvalEconomia") {
						carpeta = "materialDidacticoAvalEconomia";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "formatosEvalProgAvalar") {
						carpeta = "formatosEvalProgAvalar";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "materialDidacticoProgAvalar") {
						carpeta = "materialDidacticoProgAvalar";
						url = baseURL + "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "instructivoPlataforma") {
						carpeta = "instructivosPlataforma";
						url = baseURL + "uploads/" + carpeta + "/";
					}

					$("<tr>").appendTo(".tabla_form > tbody");
					var nombre_r = response[i].nombre.replace('"', "").replace('"', "");
					var tipo_r = response[i].tipo.replace('"', "").replace('"', "");
					switch (tipo_r) {
						case "carta":
							$tipo = "Carta de solicitud";
							break;
						case "certificaciones":
							$tipo = "Certificado de procesos educativos";
							break;
						case "lugar":
							$tipo = "Lugar de atención";
							break;
						case "registroEdu":
							$tipo = "Registro educativo";
							break;
						case "materialDidacticoProgBasicos":
							$tipo = "Material didactico P. Básicos";
							break;
						case "materialDidacticoAvalEconomia":
							$tipo = "Material didactico P. Aval";
							break;
						case "formatosEvalProgAvalar":
							$tipo = "Formato de evaluación de P. Aval";
							break;
						case "materialDidacticoProgAvalar":
							$tipo = "Material didactico P. Aval";
							break;
						case "instructivoPlataforma":
							$tipo = "Instructivo de plataforma";
							break;
						case "jornadaAct":
							$tipo = "Archivo de jornada ó Carta de compromiso";
							break;
					}
					$("<td><small>" + nombre_r + "</small></td>").appendTo(".tabla_form > tbody");
					$("<td>" + $tipo + "</td>").appendTo(".tabla_form > tbody");
					$(
						'<td><a target="_blank" href="' +
						url +
						response[i].nombre +
						'"><button class="btn btn-success btn-sm">Ver <i class="fa fa-eye" aria-hidden="true"></i></button></a> - <button class="btn btn-danger btn-sm eliminar_archivo" data-id-tipo="' +
						response[i].tipo +
						'" data-nombre-ar="' +
						response[i].nombre +
						'" data-id-formulario="' +
						response[i].id_formulario +
						'" data-id-archivo="' +
						response[i].id_archivo +
						'">Eliminar <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'
					).appendTo(".tabla_form > tbody");
					$("</tr>").appendTo(".tabla_form > tbody");
				}
				$(".tabla_form > tbody > tr.odd").remove();
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
}
