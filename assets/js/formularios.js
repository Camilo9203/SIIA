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
/** Formulario 2: Documentación Legal*/
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
// Guardar certificado de existencia
$("#guardar_formulario_certificado_existencia").click(function () {
	//$(this).attr("disabled", true);
	data = {
		numeroExistencia: $("#numeroExistencia").val(),
		fechaExpedicion: $('#fechaExpedicion').val(),
		departamentoCertificado: $('#departamentos2').val(),
		municipioCertificado: $('#municipios2').val(),
	};
	//if($("#formulario_certificado_existencia").valid()){
	$data_name = $(".archivo_form_certificado_existencia").attr("data-name");
	let file_data = $("#" + $data_name).prop("files")[0];
	let form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
	form_data.append("append_name", $data_name);
	$.ajax({
		url: baseURL + "panel/guardarArchivoCertificadoExistencia",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSubmit: function () {
			$("#loading").show();
		},
		success: function (response) {
			$.ajax({
				url: baseURL + "panel/guardar_formulario_certificado_existencia",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					notificacion("Espere...", "success");
				},
				success: function (response) {
					notificacion(response.msg, "success");
					cargarArchivos();
					setInterval(function () {
						reload();
					}, 2000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		},
		error: function (ev) {
			notificacion("Verifique los datos del formulario.", "success");
		},
	});
});
// Guardar registro educativo
$("#guardar_formulario_registro_educativo").click(function (){
	//$(this).attr("disabled", true);

	data = {
		tipoEducacion: $("#tipoEducacion").val(),
		fechaResolucionProgramas: $("#fechaResolucionProgramas").val(),
		numeroResolucionProgramas: $("#numeroResolucion").val(),
		nombrePrograma: $("#nombrePrograma").val(),
		objetoResolucionProgramas: $("#objetoResolucionProgramas").val(),
		entidadResolucion: $("#municipios3").val()
	};
	//if($("#formulario_documentacion_legal").valid()){
	$data_name = $(".archivos_form_registro").attr("data-name");
	let file_data = $("#" + $data_name).prop("files")[0];
	let form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
	form_data.append("append_name", $data_name);
	$.ajax({
		url: baseURL + "panel/guardarArchivoRegistro",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSubmit: function () {
			$("#loading").show();
		},
		success: function (response) {
			$.ajax({
				url: baseURL + "panel/guardar_formulario_registro_educativo",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					notificacion("Espere...", "success");
				},
				success: function (response) {
					notificacion(response.msg, "success");
					cargarArchivos();

				},
				error: function (ev) {
					//Do nothing
				},
			});
		},
		error: function (ev) {
			notificacion("Verifique los datos del formulario.", "success");
		},
	});
});
/** Formulario 6: Programas de Educación */
$("#acepto_programa").click(function () {
	$("#programa_educativo").prop("checked", true);
	$(this).attr("disabled", true);
	data = {
		programa: $(this).attr("data-programa"),
		organizacion:  $("#id_organizacion").val(),
		aceptar: "Si Acepta"
	};
	console.log(data);
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
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
	$("#aceptar_programa").modal("toggle");
});
/** Formulario 8: Modalidad En Línea */
// Aceptar recomendaciones modalidad en linea
$("#acepto_mod_en_linea").click(function () {
	$("#acepta_mod_en_linea").prop("checked", true);
	$("#modalAceptarEnLinea").modal("hide");
});
// Guardar formulario
$("#guardar_formulario_modalidad_en_linea").click(function () {
	//$(this).attr("disabled", true);
	//Datos a guardar
	data = {
		nombreHerramienta: $("#nombre_herramienta").val(),
		descripcionHerramienta: $("#descripcion_herramienta").val(),
		aceptacion:$("#acepta_mod_en_linea").val(),
	};
	// Petifición para guardar datos
	$.ajax({
		url: baseURL + "panel/guardar_formulario_modalidad_en_linea",
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
// Eliminar datos plataforma
$(".eliminarDatosEnlinea").click(function () {
	data = {
		id: $(this).attr("data-id"),
	};
	console.log(data);
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
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
