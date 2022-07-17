$(document).ready(function () {
	verificarFormularios();
	cargarArchivos()
	let url = unescape(window.location.href);
	let activate = url.split("/");
	let baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
});
//TODO: Eventos del menu
$("#sidebar-menu>.menu_section>#wizard_verticle>.side-menu>li>a").click(
	function () {
		$(".formulario_panel").hide();
		$("#panel_inicial").hide();
		$("#estado_solicitud").hide();
		$("#tipoSolicitud").hide();
		$(".archivos").toggle();
		var $id_form = $(this).attr("data-form");
		var $step = $("#sidebar-menu>.menu_section>#wizard_verticle>.side-menu>li>a>span#" + $id_form);
		$step.addClass("menu-sel");
		$step.removeClass("keyStep");
		$("#idDataForm").remove();
		$("body").append("<div id='idDataForm' class='hidden' data-form='" + $id_form + "'>");
		switch ($id_form) {
			case "1":
				$("#informacion_general_entidad").show();
				break;
			case "2":
				$("#documentacion_legal").show();
				break;
			case "3":
				$("#registros_educativos_de_programas").show();
				break;
			case "4":
				$("#antecedentes_academicos").show();
				break;
			case "5":
				$("#jornadas_de_actualizacion").show();
				break;
			case "6":
				$("#programa_basico_de_economia_solidaria").show();
				break;
			case "7":
				$("#programas_aval_de_economia_solidaria_con_enfasis_en_trabajo_asociado").show();
				break;
			case "8":
				$("#programas").show();
				break;
			case "9":
				$("#docentes").show();
				break;
			case "10":
				$("#datos_plataforma").show();
				break;
			case "11":
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
$("#sidebar-menu>.menu_section>a").click(function () {
	var $id_form = $(this).attr("data-form");
	switch ($id_form) {
		case "inicio":
			$("#estado_solicitud").show();
			$("#estado_solicitud").addClass("shake animated");
			$("#informacion_general_entidad").hide();
			$("#documentacion_legal").hide();
			$("#registros_educativos_de_programas").hide();
			$("#antecedentes_academicos").hide();
			$("#jornadas_de_actualizacion").hide();
			$("#programa_basico_de_economia_solidaria").hide();
			$("#programas_aval_de_economia_solidaria_con_enfasis_en_trabajo_asociado").hide();
			$("#programas").hide();
			$("#docentes").hide();
			$("#datos_plataforma").hide();
			$("#tipoSolicitud").hide();
			$("#finalizar_proceso").hide();
			$(".archivos").toggle();
			break;
	}
	/*		for (var i = 0;  i <= numero_formularios; i++) {
				var $step = $("#sidebar-menu>.menu_section>#wizard_verticle>.side-menu>li>a>span#"+i);
				$step.removeClass("menu-sel");
			}*/
	verificarFormularios();
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
		let data = {
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
/** Formulario 1: Formularios Información general */
// Guardar formulario 1
$("#guardar_formulario_informacion_general_entidad").click(function () {
	validFroms(1);
	event.preventDefault();
	if ($("#formulario_informacion_general_entidad").valid()) {
		$(this).attr("disabled", true);
		let tipo_organizacion = $("#tipo_organizacion").val();
		let departamento = $("#departamentos").val();
		let municipio = $("#municipios").val();
		let direccion = $("#direccion").val();
		let fax = $("#fax").val();
		if ($("input:checkbox[name=extension_checkbox]:checked").val()) {
			let extension = $("#extension").val();
		} else {
			var extension = "No Tiene";
		}
		if ($("#urlOrganizacion").val()) {
			let urlOrganizacion = $("#urlOrganizacion").val();
		} else {
			let urlOrganizacion = "No Tiene";
		}
		let actuacion = $("#actuacion").val();
		let educacion = $("#educacion").val();
		let numCedulaCiudadaniaPersona = $("#numCedulaCiudadaniaPersona").val();
		let presentacion = $("#presentacion").val();
		let objetoSocialEstatutos = $("#objetoSocialEstatutos").val();
		let mision = $("#mision").val();
		let vision = $("#vision").val();
		let principios = $("#principios").val();
		let fines = $("#fines").val();
		let portafolio = $("#portafolio").val();
		let otros = $("#otros").val();


		data = {
			tipo_organizacion: tipo_organizacion,
			departamento: departamento,
			municipio: municipio,
			direccion: direccion,
			fax: fax,
			extension: extension,
			urlOrganizacion: urlOrganizacion,
			actuacion: actuacion,
			educacion: educacion,
			numCedulaCiudadaniaPersona: numCedulaCiudadaniaPersona,
			presentacion: presentacion,
			objetoSocialEstatutos: objetoSocialEstatutos,
			mision: mision,
			vision: vision,
			principios: principios,
			fines: fines,
			portafolio: portafolio,
			otros: otros,
		};

		$.ajax({
			url: baseURL + "panel/guardar_formulario_informacion_general_entidad",
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
});
// Eliminar archivo carta
$(document).on("click", ".eliminar_archivo_carta", function () {
	$id_formulario = $(this).attr("data-id-formulario");
	$id_archivo = $(this).attr("data-id-archivo");
	$tipo = $(this).attr("data-id-tipo");
	$nombre = $(this).attr("data-nombre-ar");

	data = {
		id_formulario: $id_formulario,
		id_archivo: $id_archivo,
		tipo: $tipo,
		nombre: $nombre,
	};

	$.ajax({
		url: baseURL + "panel/eliminarArchivo",
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
});
// Guardar archivos tipo carta
$(".archivos_form_carta").on("click", function () {
	$data_name = $(".archivos_form_carta").attr("data-name");
	var file_data = $("#" + $data_name).prop("files")[0];
	var form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
	form_data.append("append_name", $data_name);
	$.ajax({
		url: baseURL + "panel/guardarArchivoCarta",
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
			notificacion(response.msg, "success");
			cargarArchivos();
		},
		error: function (ev) {
			notificacion("Verifique los datos del formulario.", "success");
		},
	});
});
// Guardar archivos tipo certificaciones
$(".archivos_form_certificacion").on("click", function () {
	$data_name = $(".archivos_form_certificacion").attr("data-name");
	var form_data = new FormData();
	$.each(
		$("#formulario_certificaciones input[type='file']"),
		function (obj, v) {
			var file = v.files[0];
			form_data.append("file[" + obj + "]", file);
		}
	);
	form_data.append("tipoArchivo", $("#" + $data_name + "1").attr("data-val"));
	form_data.append("append_name", $data_name);
	$.ajax({
		url: baseURL + "panel/guardarArchivos",
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
			notificacion(response.msg, "success");
			cargarArchivos();
		},
		error: function (ev) {
			cargarArchivos();
			//Do nothing
		},
	});
});
// Guardar imágenes del lugar
$(".archivos_form_lugar").on("click", function () {
	$data_name = $(".archivos_form_lugar").attr("data-name");
	var form_data = new FormData();
	$.each($("#formulario_lugar input[type='file']"), function (obj, v) {
		var file = v.files[0];
		form_data.append("file[" + obj + "]", file);
	});
	form_data.append("tipoArchivo", $("#" + $data_name + "1").attr("data-val"));
	form_data.append("append_name", $data_name);
	$.ajax({
		url: baseURL + "panel/guardarArchivos",
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
			notificacion(response.msg, "success");
			cargarArchivos();
		},
		error: function (ev) {
			cargarArchivos();
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
			$id_organizacion = $("#id_org_ver_form").attr("data-id");
			console.log($id_organizacion);
			idOrg = {
				id_organizacion: $id_organizacion,
			};
			$.ajax({
				url: baseURL + "recordar/pedirCamara",
				type: "post",
				dataType: "JSON",
				data: idOrg,
				beforeSend: function () {
					notificacion("Espere enviado correo...", "success");
					$("#volverPedirCamara").attr("disabled", true);
				},
				success: function (response) {
					notificacion("Se pidio la cámara de comercio.", "success");
				},
				error: function (ev) {
					event.preventDefault();
					console.log(ev);
					notificacion("Ocurrió un error al solicitar camara de comercio");
				},
			});

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
	if($("#formulario_certificado_existencia_legal").valid()) {
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
// Eliminar antecedentes académicos
$(".eliminarAntecedentes").click(function () {
	let data = {
		id_antecedentes: $(this).attr("data-id-antecedentes"),
	};
	$.ajax({
		url: baseURL + "panel/eliminarAntecedentes",
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
			notificacion("Acepte modalidad virtual");
			event.preventDefault();
		}
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
/** Finalizar Solicitud  */
$("#finalizar_si").click(function () {
	$(this).attr("disabled", true);

	$.ajax({
		url: baseURL + "panel/finalizarProceso",
		type: "post",
		dataType: "JSON",
		success: function (response) {
			notificacion(response.msg, "success");
			if (response.estado == "0") {
				$(this).attr("disabled", false);
				$("#sidebar-menu>.menu_section>a").click();
			} else {
				redirect(baseURL + "panel");
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Validaciones formularios */
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
						required: "Por favor, escriba la cedula del Representante Legal.",
						minlength: "La Cedula debe tener mínimo 3 caracteres.",
					},
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
			});
			break;
		default:
	}
}
// TODO: Verificación de formularios
function verificarFormularios() {
	$("#formulariosFaltantes").empty();
	$.ajax({
		url: baseURL + "panel/cargarEstadoSolicitud",
		type: "post",
		dataType: "JSON",
		success: function (response) {
			console.log(response);
			notificacion(response.msg, "success");
			$("#estadoOrgBD").html(response.estado);
			if (response.estado == "En Proceso de Actualización" || response.motivo == "Actualizar Datos") {
				$("#act_datos_sol_org").remove();
				$("#at_txt_act_datos").remove();
				//$("#el_sol").show();
				$("#estado_solicitud").append('<h3 id="at_txt_act_datos"><span>ATENCIÓN: Cuando termine de actualizar los datos elimine la solicitud dando clic en "Cambiar el tipo de solicitud actual" para volver a su estado anterior de "Acreditado".<span></h3>');
			}
			$("#numeroSolicitudesBD").html(response.numero);
			$("#tipoSolicitudesBB").html(response.tipo);
			$("#motivoSolicitudesBB").html(response.motivo);
			$("#modalidadSolicitudesBB").html(response.modalidad);
			$("#estadoAnteriorBB").html(response.estadoAnterior);
			console.log(response.formularios);
			for (let i = 0; i < response.formularios.length; i++) {
				let step_sel = response.formularios[i].split(".");
				if (i != step_sel[0]) {
					$("span#" + step_sel[0] + ".step_no").removeClass("menu-sel");
					$("span#" + step_sel[0] + ".step_no").addClass("NOmenu-sel");
				}
				$("#formulariosFaltantes").append("<p>" + response.formularios[i] + "</p>");
			}
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
			//$("li.step-no>a>span.step_no.menu-sel").remove();
			//$("li.step-no>a>span.step_no.menu-sel").css("background-color", "#07385d !important");
			/** Formularios virtual y en linea */
			//Comprobación modalidad y mostrar los formularios correspondientes
			if(response.modalidad == "Presencial, Virtual, En Linea" || response.modalidad == "Virtual, En Linea") {
				$("#itemPlataforma").show();
				$("#itemEnLinea").show();
			}
			if (response.modalidad == "Presencial, Virtual" || response.modalidad == "Virtual" ){
				$("#itemPlataforma").show();
			}
			if (response.modalidad == "Presencial, En Linea" || response.modalidad == "En Linea") {
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
// TODO: Cargar Archivos
function cargarArchivos() {
	$(".tabla_form > #tbody").empty();
	$data_form = $("#idDataForm").attr("data-form");
	var data = {
		id_form: $data_form,
	};
	$.ajax({
		url: baseURL + "panel/cargarDatosArchivos",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			var url;
			var carpeta;
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
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "certificaciones") {
						carpeta = "certificaciones";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "lugar") {
						carpeta = "lugarAtencion";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "registroEdu") {
						carpeta = "registrosEducativos";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "jornadaAct") {
						carpeta = "jornadas";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "materialDidacticoProgBasicos") {
						carpeta = "materialDidacticoProgBasicos";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "materialDidacticoAvalEconomia") {
						carpeta = "materialDidacticoAvalEconomia";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "formatosEvalProgAvalar") {
						carpeta = "formatosEvalProgAvalar";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "materialDidacticoProgAvalar") {
						carpeta = "materialDidacticoProgAvalar";
						url = "uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "instructivoPlataforma") {
						carpeta = "instructivosPlataforma";
						url = "uploads/" + carpeta + "/";
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
						'"><button class="btn btn-success btn-sm">Ver <i class="fa fa-eye" aria-hidden="true"></i></button></a> - <button class="btn btn-danger btn-sm eliminar_archivo_carta" data-id-tipo="' +
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

