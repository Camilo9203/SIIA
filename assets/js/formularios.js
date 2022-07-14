/** Modales modalidades */
$("#virtual").click(function () {
	if(this.checked) {
		$("#ayudaModalidadVirtual").modal("toggle");
	}
});
$("#enLinea").click(function () {
	if(this.checked) {
		$("#ayudaModalidadEnLinea").modal("toggle");
	}
});
/** Opciones modales modalidades */
$("#noModVirt").click(function () {
	$("#virtual").prop("checked", false);
	$("#ayudaModalidadVirtual").modal("hide");
});
$("#siModVirt").click(function () {
	$("#virtual").prop("checked", true);
	$("#ayudaModalidadVirtual").modal("hide");
});
$("#noModEnLinea").click(function () {
	$("#enLinea").prop("checked", false);
	$("#ayudaModalidadEnLinea").modal("hide");
});
$("#siModEnLinea").click(function () {
	$("#enLinea").prop("checked", true);
	$("#ayudaModalidadEnLinea").modal("hide");
});
/** Guardar formulario tipo de solicitud */
$("#guardar_formulario_tipoSolicitud").click(function () {
	if ($("#formulario_crear_solicitud").valid()) {
		// Declaración de variables
		let motivos_solicitud = [];
		let motivo_solicitud = '';
		let modalidad_solicitud = '';
		let modalidades_solicitud = [];
		let seleccionModalidad = 0;
		let seleccionMotivo = 0;
		// Recorrer motivos de la solicitud y guardar variables
		$("#formulario_crear_solicitud input[name=motivos]").each(function (){
			if (this.checked){
				switch ($(this).val()) {
					case '1':
						motivo_solicitud += 'Acreditación Curso Básico de Economía Solidaria' + ', ';
						break;
					case '2':
						motivo_solicitud += 'Aval de Trabajo Asociado' + ', ';
						break;
					case '3':
						motivo_solicitud += 'Acreditación Curso Medio de Economía Solidaria' + ', ';
						break;
					case '4':
						motivo_solicitud += 'Acreditación Curso Avanzado de Economía Solidaria' + ', ';
						break;
					case '5':
						motivo_solicitud += 'Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria' + ', ';
						break;
					default:
				}
				motivos_solicitud.push($(this).val());
			}
		});
		// Recorrer motivos de la solicitud y guardar variables
		$("#formulario_crear_solicitud input[name=modalidades]").each(function (){
			if (this.checked){
				switch ($(this).val()) {
					case '1':
						modalidad_solicitud += 'Presencial' + ', ';
						break;
					case '2':
						modalidad_solicitud += 'Virtual' + ', ';
						break;
					case '3':
						modalidad_solicitud += 'En Linea' + ', ';
						break;
					default:
				}
				modalidades_solicitud.push($(this).val());
			}
		});
		// Datos a enviar
		data = {
			tipo_solicitud: $("input:radio[name=tipo_solicitud]:checked").val(),
			motivo_solicitud: motivo_solicitud.substring(0, motivo_solicitud.length -2),
			modalidad_solicitud: modalidad_solicitud.substring(0, modalidad_solicitud.length -2),
			motivos_solicitud: motivos_solicitud,
			modalidades_solicitud: modalidades_solicitud
		};
		// Contar la cantidad de motivos y solicitudes
		$('input[name=modalidades]:checked').each(function() {
			seleccionModalidad += 1;
		});
		$('input[name=motivos]:checked').each(function() {
			seleccionMotivo += 1;
		});
		// Comprobar que si se seleccione algún motivo y/o modalidad
		if (seleccionMotivo == '') {
			notificacion("Seleccione al menos un motivo");
		}
		else if (seleccionModalidad == 0){
			notificacion("Seleccione al menos una modalidad");
		}
		else {
			//Si la data es validada se envía al controlador para guardar con ajax
			$(this).attr("disabled", true);
			$.ajax({
				url: baseURL + "panel/guardar_tipoSolicitud",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					notificacion("Espere...", "success");
				},
				success: function (response) {
					notificacion(response.msg, "success");
					$("#tipoSolicitud").hide();
					$("#estado_solicitud").show();
					$(".side_main_menu").show();
					$(".hide-sidevar").show();
					// Si la data se almacena correctamente se verifican formularios
					verificarFormularios();
					// Comprobación estado de la solicitud
					if (response.est == "En Proceso de Renovación" || response.est == "En Proceso de Actualización") {
						window.location.hash = "enProcesoActualizacion";
					} else if (response.est == "En Proceso" || response.est == "Negada" || response.est == "Revocada" || response.est == "Acreditado"
					) {
						window.location.hash = "enProceso";
					}
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	}
});
/** Eliminar Solicitud */
$("#eliminarSolicitud").click(function () {
	$(this).attr("disabled", true);
	$.ajax({
		url: baseURL + "panel/eliminarSolicitud",
		type: "post",
		dataType: "JSON",
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				redirect(baseURL + "panel");
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Formulario 2: Formularios documentación legal */
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
		tipo: 1
	};
	// Petición para guardar datos
	$.ajax({
		url: baseURL + "panel/guardar_formulario_documentacion_legal",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			event.preventDefault();
			console.log(ev);
			notificacion("Ocurrió un error y no se guardaron los datos");
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
	if($("#formulario_certificado_existencia").valid()) {
		let formData = new FormData();
		formData.append("file", $("#archivoCertifcadoExistencia").prop("files")[0]);
		formData.append("append_name", "CertificadoExistencia");
		formData.append("entidadCertificadoExistencia", $("#entidadCertificadoExistencia").val());
		formData.append("fechaExpedicion", $('#fechaExpedicion').val());
		formData.append("departamentoCertificado", $('#departamentos2').val());
		formData.append("municipioCertificado", $('#municipios2').val());
		formData.append("tipo", 2);
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
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					reload();
				}, 2000);
			},
			error: function (ev) {
				event.preventDefault();
				console.log(ev);
				notificacion("Ocurrió un error y no se guardaron los datos");
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
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					reload();
				}, 2000);
			},
			error: function (ev) {
				event.preventDefault();
				console.log(ev);
				notificacion("Ocurrió un error y no se guardaron los datos");
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
// Funciones
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
	$.ajax({
		url: baseURL + "panel/eliminarDocumentacionLegal",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
}
/** Formulario 3: Antecedentes Académicos */
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
		};
		$.ajax({
			url: baseURL + "panel/guardar_formulario_antecedentes_academicos",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				$(this).attr("disabled", true);
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				clearInputs("formulario_antecedentes_academicos");
				setInterval(function () {
					reload();
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
	else {
		notificacion('Validar campos');
	}
});
/** Formulario 6: Programas de Educación */
// Acciones de cada modal de aceptación
$("#aceptar_curso_basico_es").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	guardarDatosProgramas(curso,modal,check);
});
$("#aceptar_aval_trabajo").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	guardarDatosProgramas(curso,modal,check);
});
$("#aceptar_curso_medio_es").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	guardarDatosProgramas(curso,modal,check);
});
$("#aceptar_avanzado_medio_es").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	guardarDatosProgramas(curso,modal,check);
});
$("#aceptar_educacion_financiera").click(function () {
	let curso = $(this).attr("data-programa");
	let modal = $(this).attr("data-modal");
	let check = $(this).attr("data-check");
	guardarDatosProgramas(curso,modal,check);
});
// Función para guardar datos al aceptar programa
function guardarDatosProgramas (curso,modal, check){
	$("#" + modal).modal("toggle");
	$("#" + check).prop("checked", true);
	$(this).attr("disabled", true);
	event.preventDefault();
	data = {
		programa: curso,
		organizacion:  $("#id_organizacion").val(),
	};
	$.ajax({
		url: baseURL + "panel/guardar_formulario_datos_programas",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			if(response.status == 1) {
				setInterval(function () {
					reload();
				}, 2000);
			}
		},
		error: function (ev) {
			console.log(ev);
			notificacion("Error");
		},
	});
}
// Eliminar datos plataforma
$(".eliminarDatosProgramas").click(function () {
	data = {
		id: $(this).attr("data-id"),
	};
	$.ajax({
		url: baseURL + "panel/eliminarDatosProgramas",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			if(response.status == 1) {
				setInterval(function () {
					reload();
				}, 2000);
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Formulario 7: Modalidad Virtual*/
// Guardar datos de plataforma
$("#guardar_formulario_plataforma").click(function () {
	validFroms(7);
	event.preventDefault();
	if ($("#formulario_modalidad_virtual").valid()) {
		let data = {
			datos_plataforma_url: $("#datos_plataforma_url").val(),
			datos_plataforma_usuario: $("#datos_plataforma_usuario").val(),
			datos_plataforma_contrasena: $("#datos_plataforma_contrasena").val(),
		};
		$.ajax({
			url: baseURL + "panel/guardar_formulario_aplicacion",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				$(this).attr("disabled", true);
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					reload();
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
	else {
		notificacion("No se validaron campos");
		event.preventDefault();
	}
});
// Eliminar datos de plataforma
$(".eliminarDatosPlataforma").click(function () {
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
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Formulario 8: Modalidad En Línea */
// Aceptar recomendaciones modalidad en línea
$("#acepto_mod_en_linea").click(function () {
	$("#acepta_mod_en_linea").prop("checked", true);
	$("#modalAceptarEnLinea").modal("hide");
});
// Guardar formulario
$("#guardar_formulario_modalidad_en_linea").click(function () {
	//$(this).attr("disabled", true);
	// Validar formulario
	validFroms(8);
	if ($("#formulario_modalidad_en_linea").valid()) {
		if ($("#acepta_mod_en_linea").prop("checked") == true) {
			event.preventDefault();
			// Capturar datos formulario
			let form_data = new FormData();
			form_data.append("tipoArchivo", $("#instructivoEnLinea").attr("data-val"));
			form_data.append("append_name", $("#instructivoEnLinea").attr("data-val"));
			form_data.append("nombreHerramienta",  $("#nombre_herramienta").val());
			form_data.append("descripcionHerramienta", $("#descripcion_herramienta").val());
			form_data.append("aceptacion", $("#acepta_mod_en_linea").val());
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
					notificacion("Espere...", "success");
				},
				success: function (response) {
					notificacion(response.msg, "success");
					setInterval(function () {
						reload();
					}, 2000);
				},
				error: function (ev) {
					event.preventDefault();
					console.log(ev);
					notificacion("Ocurrió un error y no se guardaron los datos");
				},
			});
		}
		else {
			notificacion("Acepte modalidad en línea");
			event.preventDefault();
		}
	}
	else {
		notificacion("No se validaron campos");
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
	data = {
		id: $(this).attr("data-id"),
	};
	$.ajax({
		url: baseURL + "panel/eliminarDatosEnLinea",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Validaciones formularios */
function validFroms (form){
	switch (form) {
		case 2.1:
			$("form[id='formulario_certificado_existencia']").validate({
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
			})
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
			})
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
			})
		case 7:
			$("form[id='formulario_modalidad_en_linea']").validate({
				rules: {
					nombre_herramienta: {
						required: true,
						minlength: 3,
					},
					descripcion_herramienta: {
						required: true,
					},
					acepta_mod_en_linea: {
						required: true,
					}
				},
				messages: {
					nombre_herramienta: {
						required: "Por favor, ingrese el nombre de la herramienta.",
						minlength: "Mínimo 3 caracteres"
					},
					descripcion_herramienta: {
						required: "Por favor, ingrese la descripción de la herramienta.",
					},
					acepta_mod_en_linea: {
						required: "Por favor, lea y acepte las recomendaciones de la modalidad en línea.",
					},
					instructivoEnLinea: {
						required: "Adjunte por favor instructivo de la herramienta.",
					},
				},
			})
		case 8:
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
						required: "Por favor, ingrese la url de la plataforma.",
						minlength: "Mínimo 10 caracteres"
					},
					datos_plataforma_usuario: {
						required: "Por favor, ingrese el usuario de la plataforma.",
						minlength: "Mínimo 5 caracteres"
					},
					datos_plataforma_contrasena: {
						required: "Por favor, ingrese la contraseña de la plataforma.",
						minlength: "Mínimo 5 caracteres"
					}
				},
			})
		default:
	}
}
