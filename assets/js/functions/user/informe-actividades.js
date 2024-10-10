$(document).ready(function() {
	validarFormInformeActividades();
	var progress = 0;
	/**
	 * Barra de progreso y acciones de guardado
	 */
	function updateProgressBar(value) {
		// Inicio
		if(value === 0) {
			$('#title-form').hide();
		}
		// Formulario informe actividades
		else if(value === 100) {
			// Validar formulario
			if ($("#formulario_informe_actividades").valid()) {
				// Data para guardar
				data_informe = {
					informe_fecha_incio: $("#informe_fecha_incio").val(),
					informe_fecha_fin: $("#informe_fecha_fin").val(),
					informe_departamento_curso: $("#informe_departamento_curso").val(),
					informe_municipio_curso: $("#informe_municipio_curso").val(),
					informe_duracion_curso: $("#informe_duracion_curso").val(),
					informe_docente: $("#informe_docente").val(),
					informe_intencionalidad_curso: $("#informe_intencionalidad_curso").val(),
					informe_cursos: $("#informe_cursos").val(),
					informe_modalidad: $("#informe_modalidad").val(),
					informe_asistentes: $("#informe_asistentes").val(),
					informe_numero_mujeres: $("#informe_numero_mujeres").val(),
					informe_numero_hombres: $("#informe_numero_hombres").val(),
					informe_numero_no_binario: $("#informe_numero_no_binario").val(),
				};
				$.ajax({
					url: baseURL + "InformeActividades/create",
					type: "post",
					dataType: "JSON",
					data: data_informe,
					beforeSend: function () {
						procesando("info", 'Enviando datos')
					},
					success: function (response) {
						alertaProceso(response.title ,response.msg, response.status)
						$('#back').attr('disabled', true);
						$('#forward').text('Finalizar');
					},
					error: function (ev) {
						errorControlador(ev);
					},
				});
			}
			else {
				// Ajustar valores para detener progreso
				value -=50
				progress -=50
				alertaValidarFomulario('Debe validar los datos del formulario para continuar', 'error')
			}
		}
		// Formulario archivos
		else if (value === 150) {
			var data_name = $(".archivoAsistencia").attr("data-name");
			var file_data = $("#" + data_name).prop("files")[0];
			var form_data = new FormData();
			form_data.append("file", file_data);
			form_data.append("append_name", data_name);
			$.ajax({
				url: baseURL + "InformeActividades/archivoAsistencia",
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: "post",
				dataType: "JSON",
				beforeSubmit: function () {
					procesando("info", 'Enviando archivos')
				},
				success: function (response) {
					var data_name2 = $(".archivoAsistentes").attr("data-name");
					var file_data2 = $("#" + data_name2).prop("files")[0];
					var form_data2 = new FormData();
					form_data2.append("file", file_data2);
					form_data2.append("append_name", data_name2);
					$.ajax({
						url: baseURL + "InformeActividades/excelAsistentes",
						cache: false,
						contentType: false,
						processData: false,
						data: form_data2,
						type: "post",
						dataType: "JSON",
						beforeSubmit: function () {
							procesando("info", 'Enviando archivos')
						},
						success: function (response) {
							alertaProceso(response.title ,response.msg, response.status)
							$('#back').hide();
							$('#forward').hide();
							$('#reload').show();
						},
						error: function (ev) {
							errorControlador(ev);
						},
					});
				},
				error: function (ev) {
					errorControlador(ev);
				},
			});
		}
		else {
			$('#back').attr('disabled', false);
			$('#forward').attr('disabled', false);
			$('#title-form').show();
		}
		$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
		$('.form-section').hide(); // Ocultar todos los formularios
		$('#form-' + value).show(); // Mostrar el formulario correspondiente
	}
	// Adelante
	$('#registrar_informe').click(function() {
		$('#registro_informe_actividades').slideDown();
		$('#tabla_informe_actividades').slideUp();
	});
	// Adelante
	$('#reload').click(function() {
		reload();
	});
	// Adelante
	$('#forward').click(function() {
		if (progress < 150) {
			progress += 50;
			updateProgressBar(progress);
		}
	});
	// Atrás
	$('#back').click(function() {
		if (progress > 0) {
			progress -= 50;
			updateProgressBar(progress);
		}
		if (progress === 0) {
			$('#registro_informe_actividades').slideUp();
			$('#tabla_informe_actividades').slideDown();
		}
	});
	// Validar que las fechas no se salgan de rango
	let today = new  Date().toISOString().split('T')[0];
	$('#informe_fecha_incio').change(function () {
		let starDate =  $(this).val();
		let endDate =  $('#informe_fecha_fin').val();
		if (starDate > today) {
			alertaValidarFomulario('La fecha del curso no puede ser mayor a la de hoy', 'warning');
		}
		else if ((endDate != null || endDate !== '') &&  starDate > endDate) {
			alertaValidarFomulario('La fecha de inicio no puede ser mayor a la fecha final', 'warning')
		}
		else {
			alertaValidarFomulario('Fechas validada', 'success');
		}
	});
	$('#informe_fecha_fin').change(function () {
		let endDate =  $(this).val();
		let starDate =  $('#informe_fecha_incio').val();
		if (endDate > today) {
			alertaValidarFomulario('La fecha fin del curso no puede ser mayor a la de hoy', 'warning');
		}
		else if ((starDate != null || starDate !== '') &&  starDate > endDate) {
			alertaValidarFomulario('La fecha de inicio no puede ser mayor a la fecha final', 'warning')
		}
		else {
			alertaValidarFomulario('Fechas validada', 'success');
		}
	});
	// Conteo de asistentes
	let total_asistentes = 0;
	$('#informe_numero_mujeres').change(function () {
		total_asistentes = parseFloat($('#informe_numero_hombres').val()) + parseFloat($('#informe_numero_no_binario').val()) + parseFloat($(this).val());
		$('#informe_asistentes').val(total_asistentes);
	});
	$('#informe_numero_hombres').change(function () {
		total_asistentes = parseFloat($('#informe_numero_mujeres').val()) + parseFloat($('#informe_numero_no_binario').val()) + parseFloat($(this).val());
		$('#informe_asistentes').val(total_asistentes);
	});
	$('#informe_numero_no_binario').change(function () {
		total_asistentes = parseFloat($('#informe_numero_mujeres').val()) + parseFloat($('#informe_numero_hombres').val()) + parseFloat($(this).val());
		$('#informe_asistentes').val(total_asistentes);
	});
	// Comprobar horas cursos
	$('#informe_duracion_curso').change(function (){
		if(parseFloat($('#informe_duracion_curso').val()) < 20) {
			alertaValidarFomulario('Se esperan 20 o mas horas','warning')
		}
		else {
			alertaValidarFomulario('Horas validas', 'success')
		}
	})
	// Validar formulario
	function validarFormInformeActividades () {
		// Formulario Login.
		$("form[id='formulario_informe_actividades']").validate({
			rules: {
				informe_fecha_incio: {
					required: true,
				},
				informe_fecha_fin: {
					required: true,
				},
				informe_departamento_curso: {
					required: true,
				},
				informe_municipio_curso: {
					required: true,
				},
				informe_duracion_curso: {
					required: true,
				},
				informe_docente: {
					required: true,
				},
				informe_intencionalidad_curso: {
					required: true,
				},
				informe_cursos: {
					required: true,
				},
				informe_modalidad: {
					required: true,
				},
				informe_numero_mujeres: {
					required: true,
				},
				informe_numero_hombres: {
					required: true,
				},
				informe_numero_no_binario: {
					required: true,
				},
			},
			messages: {
				informe_fecha_incio: {
					required: 'Ingrese la fecha de inicio'
				},
				informe_fecha_fin: {
					required: "Ingrese la fecha de finalización",
				},
				informe_departamento_curso: {
					required: "Ingrese el departamento",
				},
				informe_municipio_curso: {
					required: "Ingrese el municipio",
				},
				informe_duracion_curso: {
					required: "Ingrese la duración del curso",
				},
				informe_docente: {
					required: "Ingrese el docente",
				},
				informe_intencionalidad_curso: {
					required: "Ingrese la intencionalidad",
				},
				informe_cursos: {
					required: "Ingrese los cursos",
				},
				informe_modalidad: {
					required: "Ingrese las modalidades",
				},
				informe_numero_mujeres: {
					required: "Ingrese la cantidad de mujeres",
				},
				informe_numero_hombres: {
					required: "Ingrese la cantidad de hombres",
				},
				informe_numero_no_binario: {
					required: "Ingrese la cantidad de no binario",
				},
			},
		});

	}
});
/**
 * Cargar datos de la organización
 */
$("#telefonicoNitOrganizacion").change(function () {
	let html = '';
	let data = {
		id_organizacion: $('#telefonicoNitOrganizacion').val(),
	}
	$.ajax({
		url: baseURL + 'organizaciones/datosOrganzacion',
		type: 'post',
		dataType: 'JSON',
		data: data,
		success: function (response) {
			// Llenar campos
			let funcionario = response.organizacion.primerNombrePersona + ' ' + response.organizacion.primerApellidoPersona;
			$("#telefonicoFuncionario").val(funcionario);
			// Llenar select de la solicitud
			if(response.solicitudes.length > 0) {
				$.each(response.solicitudes, function (key, solicitud) {
					// Guardar opción html en variable
					html += "<option value=" + solicitud.idSolicitud + " data-id=" + solicitud.id_solicitud + ">" + solicitud.idSolicitud + " | " + solicitud.nombre + "</option>";
				});
				// Añadir variable de opción html al select de municipio
				$("#telefonicoIdSolicitud").html(html);
				$("#telefonicoIdSolicitud").prop('disabled', false);
			}
			else {
				html += "<option value=''>N/A</option>";
				$("#telefonicoIdSolicitud").html(html);
				$("#telefonicoIdSolicitud").prop('disabled', true);
			}
		}
	})
});
/**
 * Guardar registro telefónico
 */
var data_informe_asistentes = []; //Datos que se envian
var data_informe_asistentes_history = []; //Historial de datos para actualizar
$("#informe_terminar").click(function () {
	$informe_primerNombre_asistente = $(
		"#informe_primerNombre_asistente"
	).val();
	$informe_segundoNombre_asistente = $(
		"#informe_segundoNombre_asistente"
	).val();
	$informe_primerApellido_asistente = $(
		"#informe_primerApellido_asistente"
	).val();
	$informe_segundoApellido_asistente = $(
		"#informe_segundoApellido_asistente"
	).val();
	$informe_sexo_asistente = $("#informe_sexo_asistente").val();
	$informe_edad_asistente = $("#informe_edad_asistente").val();
	$informe_tipoDocumento_asistente = $(
		"#informe_tipoDocumento_asistente"
	).val();
	$informe_numeroDocumento_asistente = $(
		"#informe_numeroDocumento_asistente"
	).val();
	$informe_formacion_asistente = $("#informe_formacion_asistente").val();
	$informe_nit_asistente = $("#informe_nit_asistente").val();
	$informe_razonsocial_asistente = $("#informe_razonsocial_asistente").val();
	$informe_rolorganizacion_asistente = $(
		"#informe_rolorganizacion_asistente"
	).val();
	$informe_proceso_asistente = $("#informe_proceso_asistente").val();
	$informe_fechafinalizacion_asistente = $(
		"#informe_fechafinalizacion_asistente"
	).val();
	$informe_departamento_asistente = $(
		"#informe_departamento_asistente"
	).val();
	$informe_municipio_asistente = $("#informe_municipio_asistente").val();
	$informe_fax_asistente = $("#informe_fax_asistente").val();
	$informe_direccion_asistente = $("#informe_direccion_asistente").val();
	$informe_direccionCorreoElectronico_asistente = $(
		"#informe_direccionCorreoElectronico_asistente"
	).val();
	$cabeza_radio = $("input:radio[name=cabezaradio]:checked").val();
	$informe_discapacidad_asistente = $(
		"#informe_discapacidad_asistente"
	).val();
	$indigenas_chekbox = $(
		"input:checkbox[name=indigenas_chekbox]:checked"
	).val();
	$Rom_Gitanos_checkbox = $(
		"input:checkbox[name=Rom_Gitanos_checkbox]:checked"
	).val();
	$Afro_Negros_Mulatos_checkbox = $(
		"input:checkbox[name=Afro_Negros_Mulatos_checkbox]:checked"
	).val();
	$raizal_checkbox = $("input:checkbox[name=raizal_checkbox]:checked").val();
	$palenqueros_checkbox = $(
		"input:checkbox[name=palenqueros_checkbox]:checked"
	).val();
	$red_radio = $("input:radio[name=redradio]:checked").val();
	$informe_folio_red_asistente = $("#informe_folio_red_asistente").val();
	$victima_radio = $("input:radio[name=victimaradio]:checked").val();
	$informe_ruv_asistente = $("#informe_folio_red_asistente").val();
	$reintegracion_radio = $(
		"input:radio[name=reintegracionradio]:checked"
	).val();
	$informe_coda_asistente = $("#informe_coda_asistente").val();
	$lgtbi_radio = $("input:radio[name=lgtbiradio]:checked").val();
	$prostitucion_radio = $(
		"input:radio[name=prostitucionradio]:checked"
	).val();
	$libertad_radio = $("input:radio[name=libertadradio]:checked").val();

	data_asistente = {
		informe_primerNombre_asistente: $informe_primerNombre_asistente,
		informe_segundoNombre_asistente: $informe_segundoNombre_asistente,
		informe_primerApellido_asistente: $informe_primerApellido_asistente,
		informe_segundoApellido_asistente: $informe_segundoApellido_asistente,
		informe_sexo_asistente: $informe_sexo_asistente,
		informe_edad_asistente: $informe_edad_asistente,
		informe_tipoDocumento_asistente: $informe_tipoDocumento_asistente,
		informe_numeroDocumento_asistente: $informe_numeroDocumento_asistente,
		informe_formacion_asistente: $informe_formacion_asistente,
		informe_nit_asistente: $informe_nit_asistente,
		informe_razonsocial_asistente: $informe_razonsocial_asistente,
		informe_rolorganizacion_asistente: $informe_rolorganizacion_asistente,
		informe_proceso_asistente: $informe_proceso_asistente,
		informe_fechafinalizacion_asistente: $informe_fechafinalizacion_asistente,
		informe_departamento_asistente: $informe_departamento_asistente,
		informe_municipio_asistente: $informe_municipio_asistente,
		informe_fax_asistente: $informe_fax_asistente,
		informe_direccion_asistente: $informe_direccion_asistente,
		informe_direccionCorreoElectronico_asistente:
		$informe_direccionCorreoElectronico_asistente,
		cabeza_radio: $cabeza_radio,
		informe_discapacidad_asistente: $informe_discapacidad_asistente,
		indigenas_chekbox: $indigenas_chekbox,
		Rom_Gitanos_checkbox: $Rom_Gitanos_checkbox,
		Afro_Negros_Mulatos_checkbox: $Afro_Negros_Mulatos_checkbox,
		raizal_checkbox: $raizal_checkbox,
		palenqueros_checkbox: $palenqueros_checkbox,
		red_radio: $red_radio,
		informe_folio_red_asistente: $informe_folio_red_asistente,
		victima_radio: $victima_radio,
		informe_ruv_asistente: $informe_ruv_asistente,
		reintegracion_radio: $reintegracion_radio,
		informe_coda_asistente: $informe_coda_asistente,
		lgtbi_radio: $lgtbi_radio,
		prostitucion_radio: $prostitucion_radio,
		libertad_radio: $libertad_radio,
	};

	data_informe_asistentes.push(data_asistente);

	$informe_nombre_curso = $("#informe_nombre_curso").val();
	$informe_tipo_curso = $("#informe_tipo_curso").val();
	$informe_intencionalidad_curso = $("#informe_intencionalidad_curso").val();
	$informe_union = $("#unionOrg").val();
	$informe_duracion_curso = $("#informe_duracion_curso").val();
	$informe_departamento_curso = $("#informe_departamento_curso").val();
	$informe_municipio_curso = $("#informe_municipio_curso").val();
	$informe_curso_gratis = $("input:radio[name=gratisCurso]:checked").val();
	$informe_docente = $("#informe_docente").val();
	$informe_fecha_curso = $("#informe_fecha_curso").val();
	$informe_asistentes = $("#informe_asistentes").val();
	$informe_numero_mujeres = $("#informe_numero_mujeres").val();
	$informe_numero_hombres = $("#informe_numero_hombres").val();

	data_curso = {
		informe_nombre_curso: $informe_nombre_curso,
		informe_tipo_curso: $informe_tipo_curso,
		informe_intencionalidad_curso: $informe_intencionalidad_curso,
		informe_union: $informe_union,
		informe_duracion_curso: $informe_duracion_curso,
		informe_departamento_curso: $informe_departamento_curso,
		informe_municipio_curso: $informe_municipio_curso,
		informe_curso_gratis: $informe_curso_gratis,
		informe_docente: $informe_docente,
		informe_fecha_curso: $informe_fecha_curso,
		informe_asistentes: $informe_asistentes,
		informe_numero_mujeres: $informe_numero_mujeres,
		informe_numero_hombres: $informe_numero_hombres,
	};
	console.log(data_curso);
	console.log(data_informe_asistentes);

	$.ajax({
		url: baseURL + "panel/guardar_cursoInformeActividades",
		type: "post",
		dataType: "JSON",
		data: data_curso,
		success: function (response) {
			clearInputs("llenar_asistente");
			for ($i = 0; $i < data_informe_asistentes.length; $i++) {
				console.log(data_informe_asistentes);
				$.ajax({
					url: baseURL + "panel/guardar_asistentesInformeActividades",
					type: "post",
					dataType: "JSON",
					data: data_informe_asistentes[$i],
					success: function (response) {
						notificacion(response.msg, "success");
						setInterval(function () {
							redirect(baseURL + "panel/informeActividades");
						}, 2000);
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
});
$("#informe_siguiente").click(function () {
	$asistentes_totales = $("#numero_asistentes").attr("data-numero");
	$asistentes_faltantes = $("#asistentes_faltantes").html();
	$asistentes_ingresados = parseFloat($asistentes_faltantes) + 1;

	$informe_primerNombre_asistente = $(
		"#informe_primerNombre_asistente"
	).val();
	$informe_segundoNombre_asistente = $(
		"#informe_segundoNombre_asistente"
	).val();
	$informe_primerApellido_asistente = $(
		"#informe_primerApellido_asistente"
	).val();
	$informe_segundoApellido_asistente = $(
		"#informe_segundoApellido_asistente"
	).val();
	$informe_sexo_asistente = $("#informe_sexo_asistente").val();
	$informe_edad_asistente = $("#informe_edad_asistente").val();
	$informe_tipoDocumento_asistente = $(
		"#informe_tipoDocumento_asistente"
	).val();
	$informe_numeroDocumento_asistente = $(
		"#informe_numeroDocumento_asistente"
	).val();
	$informe_formacion_asistente = $("#informe_formacion_asistente").val();
	$informe_nit_asistente = $("#informe_nit_asistente").val();
	$informe_razonsocial_asistente = $("#informe_razonsocial_asistente").val();
	$informe_rolorganizacion_asistente = $(
		"#informe_rolorganizacion_asistente"
	).val();
	$informe_proceso_asistente = $("#informe_proceso_asistente").val();
	$informe_fechafinalizacion_asistente = $(
		"#informe_fechafinalizacion_asistente"
	).val();
	$informe_departamento_asistente = $(
		"#informe_departamento_asistente"
	).val();
	$informe_municipio_asistente = $("#informe_municipio_asistente").val();
	$informe_fax_asistente = $("#informe_fax_asistente").val();
	$informe_direccion_asistente = $("#informe_direccion_asistente").val();
	$informe_direccionCorreoElectronico_asistente = $(
		"#informe_direccionCorreoElectronico_asistente"
	).val();
	$cabeza_radio = $("input:radio[name=cabezaradio]:checked").val();
	$informe_discapacidad_asistente = $(
		"#informe_discapacidad_asistente"
	).val();
	$indigenas_chekbox = $(
		"input:checkbox[name=indigenas_chekbox]:checked"
	).val();
	$Rom_Gitanos_checkbox = $(
		"input:checkbox[name=Rom_Gitanos_checkbox]:checked"
	).val();
	$Afro_Negros_Mulatos_checkbox = $(
		"input:checkbox[name=Afro_Negros_Mulatos_checkbox]:checked"
	).val();
	$raizal_checkbox = $("input:checkbox[name=raizal_checkbox]:checked").val();
	$palenqueros_checkbox = $(
		"input:checkbox[name=palenqueros_checkbox]:checked"
	).val();
	$red_radio = $("input:radio[name=redradio]:checked").val();
	$informe_folio_red_asistente = $("#informe_folio_red_asistente").val();
	$victima_radio = $("input:radio[name=victimaradio]:checked").val();
	$informe_ruv_asistente = $("#informe_folio_red_asistente").val();
	$reintegracion_radio = $(
		"input:radio[name=reintegracionradio]:checked"
	).val();
	$informe_coda_asistente = $("#informe_coda_asistente").val();
	$lgtbi_radio = $("input:radio[name=lgtbiradio]:checked").val();
	$prostitucion_radio = $(
		"input:radio[name=prostitucionradio]:checked"
	).val();
	$libertad_radio = $("input:radio[name=libertadradio]:checked").val();

	data_asistente = {
		informe_primerNombre_asistente: $informe_primerNombre_asistente,
		informe_segundoNombre_asistente: $informe_segundoNombre_asistente,
		informe_primerApellido_asistente: $informe_primerApellido_asistente,
		informe_segundoApellido_asistente: $informe_segundoApellido_asistente,
		informe_sexo_asistente: $informe_sexo_asistente,
		informe_edad_asistente: $informe_edad_asistente,
		informe_tipoDocumento_asistente: $informe_tipoDocumento_asistente,
		informe_numeroDocumento_asistente: $informe_numeroDocumento_asistente,
		informe_formacion_asistente: $informe_formacion_asistente,
		informe_nit_asistente: $informe_nit_asistente,
		informe_razonsocial_asistente: $informe_razonsocial_asistente,
		informe_rolorganizacion_asistente: $informe_rolorganizacion_asistente,
		informe_proceso_asistente: $informe_proceso_asistente,
		informe_fechafinalizacion_asistente: $informe_fechafinalizacion_asistente,
		informe_departamento_asistente: $informe_departamento_asistente,
		informe_municipio_asistente: $informe_municipio_asistente,
		informe_fax_asistente: $informe_fax_asistente,
		informe_direccion_asistente: $informe_direccion_asistente,
		informe_direccionCorreoElectronico_asistente:
		$informe_direccionCorreoElectronico_asistente,
		cabeza_radio: $cabeza_radio,
		informe_discapacidad_asistente: $informe_discapacidad_asistente,
		indigenas_chekbox: $indigenas_chekbox,
		Rom_Gitanos_checkbox: $Rom_Gitanos_checkbox,
		Afro_Negros_Mulatos_checkbox: $Afro_Negros_Mulatos_checkbox,
		raizal_checkbox: $raizal_checkbox,
		palenqueros_checkbox: $palenqueros_checkbox,
		red_radio: $red_radio,
		informe_folio_red_asistente: $informe_folio_red_asistente,
		victima_radio: $victima_radio,
		informe_ruv_asistente: $informe_ruv_asistente,
		reintegracion_radio: $reintegracion_radio,
		informe_coda_asistente: $informe_coda_asistente,
		lgtbi_radio: $lgtbi_radio,
		prostitucion_radio: $prostitucion_radio,
		libertad_radio: $libertad_radio,
	};

	if (
		data_informe_asistentes.length == data_informe_asistentes_history.length
	) {
		data_informe_asistentes.push(data_asistente);
		data_informe_asistentes_history.push(data_asistente);
		$("#informe_primerNombre_asistente").val("");
		$("#informe_segundoNombre_asistente").val("");
		$("#informe_primerApellido_asistente").val("");
		$("#informe_segundoApellido_asistente").val("");
		$("#informe_edad_asistente").val("");
		$("#informe_numeroDocumento_asistente").val("");
		$("#informe_fax_asistente").val("");
		$("#informe_direccion_asistente").val("");
		$("#informe_direccionCorreoElectronico_asistente").val("");
	} else {
		data_informe_asistentes.splice(
			parseFloat($asistentes_ingresados - 2),
			1,
			data_asistente
		);
		data_informe_asistentes_history.splice(
			parseFloat($asistentes_ingresados - 2),
			1,
			data_asistente
		);
	}
	//clearInputs("llenar_asistente");
	console.log($asistentes_ingresados - 1);
	console.log(
		data_informe_asistentes_history.indexOf(
			parseFloat($asistentes_ingresados) - 2
		)
	);
	console.log(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 2]
			.Rom_Gitanos_checkbox
	);
	console.log(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 2]
			.red_radio
	);
	if (
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1] !=
		null
	) {
		$("#informe_primerNombre_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_primerNombre_asistente
		);
		$("#informe_segundoNombre_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_segundoNombre_asistente
		);
		$("#informe_primerApellido_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_primerApellido_asistente
		);
		$("#informe_segundoApellido_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_segundoApellido_asistente
		);
		$("#informe_sexo_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_sexo_asistente
		);
		$("#informe_edad_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_edad_asistente
		);
		$("#informe_tipoDocumento_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_tipoDocumento_asistente
		);
		$("#informe_numeroDocumento_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_numeroDocumento_asistente
		);
		$("#informe_formacion_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_formacion_asistente
		);
		$("#informe_nit_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_nit_asistente
		);
		$("#informe_razonsocial_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_razonsocial_asistente
		);
		$("#informe_rolorganizacion_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_rolorganizacion_asistente
		);
		$("#informe_proceso_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_proceso_asistente
		);
		$("#informe_fechafinalizacion_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_fechafinalizacion_asistente
		);
		$("#informe_departamento_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_departamento_asistente
		);
		$("#informe_municipio_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_municipio_asistente
		);
		$("#informe_fax_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_fax_asistente
		);
		$("#informe_direccion_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_direccion_asistente
		);
		$("#informe_direccionCorreoElectronico_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_direccionCorreoElectronico_asistente
		);
		$("#informe_discapacidad_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_discapacidad_asistente
		);
		$("#informe_folio_red_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_folio_red_asistente
		);
		$("#informe_folio_red_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_folio_red_asistente
		);
		$("#informe_coda_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_coda_asistente
		);
		$("#informe_ruv_asistente").val(
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.informe_ruv_asistente
		);

		$cabeza_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.cabeza_radio;
		if ($cabeza_radio == "Si") {
			$("#cabezaradiosi").prop("checked", true);
		} else {
			$("#cabezaradiono").prop("checked", true);
		}
		$red_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.red_radio;
		if ($red_radio == "Si") {
			$("#redradiosi").prop("checked", true);
		} else {
			$("#redradiono").prop("checked", true);
		}
		$victima_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.victima_radio;
		if ($victima_radio == "Si") {
			$("#victimaradiosi").prop("checked", true);
		} else {
			$("#victimaradiono").prop("checked", true);
		}
		$reintegracion_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.reintegracion_radio;
		if ($reintegracion_radio == "Si") {
			$("#reintegracionradiosi").prop("checked", true);
		} else {
			$("#reintegracionradiono").prop("checked", true);
		}
		$lgtbi_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.lgtbi_radio;
		if ($lgtbi_radio == "Si") {
			$("#lgtbiradiosi").prop("checked", true);
		} else {
			$("#lgtbiradiono").prop("checked", true);
		}
		$prostitucion_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.prostitucion_radio;
		if ($prostitucion_radio == "Si") {
			$("#prostitucionradiosi").prop("checked", true);
		} else {
			$("#prostitucionradiono").prop("checked", true);
		}
		$libertad_radio =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.libertad_radio;
		if ($libertad_radio == "Si") {
			$("#libertadradiosi").prop("checked", true);
		} else {
			$("#libertadradiono").prop("checked", true);
		}

		$indigenas_chekbox =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.indigenas_chekbox;
		if ($indigenas_chekbox == "on") {
			$("#indigenas_chekbox").prop("checked", true);
		}
		$Rom_Gitanos_checkbox =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.Rom_Gitanos_checkbox;
		if ($Rom_Gitanos_checkbox == "on") {
			$("#Rom_Gitanos_checkbox").prop("checked", true);
		}
		$Afro_Negros_Mulatos_checkbox =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.Afro_Negros_Mulatos_checkbox;
		if ($Afro_Negros_Mulatos_checkbox == "on") {
			$("#Afro_Negros_Mulatos_checkbox").prop("checked", true);
		}
		$raizal_checkbox =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.raizal_checkbox;
		if ($raizal_checkbox == "on") {
			$("#raizal_checkbox").prop("checked", true);
		}
		$palenqueros_checkbox =
			data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
				.palenqueros_checkbox;
		if ($palenqueros_checkbox == "on") {
			$("#palenqueros_checkbox").prop("checked", true);
		}

		data_informe_asistentes.splice(parseFloat($asistentes_ingresados), 1);
	}

	console.log(data_informe_asistentes);
	console.log(data_informe_asistentes_history);
	if ($asistentes_ingresados > 1) {
		$("#informe_atras").prop("disabled", false);
	}
	if ($asistentes_faltantes != $asistentes_totales) {
		$("#asistentes_faltantes").html($asistentes_ingresados);
	}
	if ($asistentes_ingresados == $asistentes_totales) {
		$("#informe_terminar").removeClass("hidden");
		$("#informe_siguiente").prop("disabled", true);
		notificacion("Presione terminar para guardar todo.");
	} else {
		$("#informe_terminar").addClass("hidden");
	}
});
$("#informe_atras").click(function () {
	$("#informe_terminar").addClass("hidden");
	$("#informe_siguiente").prop("disabled", false);
	$asistentes_faltantes = $("#asistentes_faltantes").html();
	console.log(data_informe_asistentes);
	$asistentes_ingresados = parseFloat($asistentes_faltantes) - 1;
	$("#informe_primerNombre_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_primerNombre_asistente
	);
	$("#informe_segundoNombre_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_segundoNombre_asistente
	);
	$("#informe_primerApellido_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_primerApellido_asistente
	);
	$("#informe_segundoApellido_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_segundoApellido_asistente
	);
	$("#informe_sexo_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_sexo_asistente
	);
	$("#informe_edad_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_edad_asistente
	);
	$("#informe_tipoDocumento_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_tipoDocumento_asistente
	);
	$("#informe_numeroDocumento_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_numeroDocumento_asistente
	);
	$("#informe_formacion_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_formacion_asistente
	);
	$("#informe_nit_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_nit_asistente
	);
	$("#informe_razonsocial_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_razonsocial_asistente
	);
	$("#informe_rolorganizacion_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_rolorganizacion_asistente
	);
	$("#informe_proceso_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_proceso_asistente
	);
	$("#informe_fechafinalizacion_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_fechafinalizacion_asistente
	);
	$("#informe_departamento_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_departamento_asistente
	);
	$("#informe_municipio_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_municipio_asistente
	);
	$("#informe_fax_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_fax_asistente
	);
	$("#informe_direccion_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_direccion_asistente
	);
	$("#informe_direccionCorreoElectronico_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_direccionCorreoElectronico_asistente
	);
	$("#informe_discapacidad_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_discapacidad_asistente
	);
	$("#informe_folio_red_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_folio_red_asistente
	);
	$("#informe_folio_red_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_folio_red_asistente
	);
	$("#informe_coda_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_coda_asistente
	);
	$("#informe_ruv_asistente").val(
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.informe_ruv_asistente
	);

	$cabeza_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.cabeza_radio;
	if ($cabeza_radio == "Si") {
		$("#cabezaradiosi").prop("checked", true);
	} else {
		$("#cabezaradiono").prop("checked", true);
	}
	$red_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.red_radio;
	if ($red_radio == "Si") {
		$("#redradiosi").prop("checked", true);
	} else {
		$("#redradiono").prop("checked", true);
	}
	$victima_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.victima_radio;
	if ($victima_radio == "Si") {
		$("#victimaradiosi").prop("checked", true);
	} else {
		$("#victimaradiono").prop("checked", true);
	}
	$reintegracion_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.reintegracion_radio;
	if ($reintegracion_radio == "Si") {
		$("#reintegracionradiosi").prop("checked", true);
	} else {
		$("#reintegracionradiono").prop("checked", true);
	}
	$lgtbi_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.lgtbi_radio;
	if ($lgtbi_radio == "Si") {
		$("#lgtbiradiosi").prop("checked", true);
	} else {
		$("#lgtbiradiono").prop("checked", true);
	}
	$prostitucion_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.prostitucion_radio;
	if ($prostitucion_radio == "Si") {
		$("#prostitucionradiosi").prop("checked", true);
	} else {
		$("#prostitucionradiono").prop("checked", true);
	}
	$libertad_radio =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.libertad_radio;
	if ($libertad_radio == "Si") {
		$("#libertadradiosi").prop("checked", true);
	} else {
		$("#libertadradiono").prop("checked", true);
	}

	$indigenas_chekbox =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.indigenas_chekbox;
	if ($indigenas_chekbox == "on") {
		$("#indigenas_chekbox").prop("checked", true);
	}
	$Rom_Gitanos_checkbox =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.Rom_Gitanos_checkbox;
	if ($Rom_Gitanos_checkbox == "on") {
		$("#Rom_Gitanos_checkbox").prop("checked", true);
	}
	$Afro_Negros_Mulatos_checkbox =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.Afro_Negros_Mulatos_checkbox;
	if ($Afro_Negros_Mulatos_checkbox == "on") {
		$("#Afro_Negros_Mulatos_checkbox").prop("checked", true);
	}
	$raizal_checkbox =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.raizal_checkbox;
	if ($raizal_checkbox == "on") {
		$("#raizal_checkbox").prop("checked", true);
	}
	$palenqueros_checkbox =
		data_informe_asistentes_history[parseFloat($asistentes_ingresados) - 1]
			.palenqueros_checkbox;
	if ($palenqueros_checkbox == "on") {
		$("#palenqueros_checkbox").prop("checked", true);
	}

	data_informe_asistentes.splice(parseFloat($asistentes_ingresados) - 1, 1);

	console.log(data_informe_asistentes);
	console.log(data_informe_asistentes_history);
	console.log(
		data_informe_asistentes[parseFloat($asistentes_ingresados) - 1]
	);

	$("#asistentes_faltantes").html($asistentes_ingresados);
	if ($asistentes_ingresados <= 1) {
		$("#informe_atras").prop("disabled", true);
	}
});
$(".verCurso").click(function () {
	$id_curso = $(this).attr("data-id");
	$nombre_curso = $(this).attr("data-nombre");
	data = {
		id_curso: $id_curso,
	};

	$.ajax({
		url: baseURL + "panel/verAsistentesCurso",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$("#tbody_asistentes_curso").html("");
			$("#tbody_asistentes_curso").empty();
			$("#modal_vercurso_nombre").html("");
			$("#modal_vercurso_nombre").html($nombre_curso);
			$("#super_primernombre_admin_modal").val();

			$("#tabla_actividad_inscritas>tbody#tbody_asistentes_curso").empty();
			$("#tabla_actividad_inscritas>tbody#tbody_asistentes_curso").html("");
			$("#tbody_asistentes_curso>.odd").remove();
			for (var i = 0; i < response.length; i++) {
				$("#tbody_asistentes_curso").append("<tr id=" + i + ">");
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].primerNombreAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].primerApellidoAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].tipoDocumentoAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].numeroDocumentoAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].procesoBeneficio + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].fechaFinalizacion + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].edadAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].direccionCorreoElectronicoAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].direccionAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td>" + response[i].sexoAsistente + "</td>"
				);
				$("#tbody_asistentes_curso>tr#" + i + "").append(
					"<td><button class='btn btn-siia editarAsistente' data-id-ass='" +
					response[i].id_asistentes +
					"' id='editarAsistente'>Editar <i class='fa fa-pencil' aria-hidden='true'></i></button> - <button class='btn btn-siia' data-id-ass='" +
					response[i].id_asistentes +
					"' id='getCert'>Ver <i class='fa fa-eye' aria-hidden='true'></i></button></td>"
				);
				$("#tbody_asistentes_curso").append("</tr>");
			}
			paging("tabla_asistentes_curso");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
$(document).on("click", ".editarAsistente", function () {
	$id_asistente = $(this).attr("data-id-ass");
	data = {
		id_asistente: $id_asistente,
	};
	$.ajax({
		url: baseURL + "panel/cargar_informacionAsistente",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$("#editarAsistenteDiv").slideUp();
			$("#EdasisID").html("");
			$("#editarAsisPN").val("");
			$("#editarAsisSN").val("");
			$("#editarAsisPA").val("");
			$("#editarAsisPA").val("");
			$("#editarAsisNumero").val("");
			$("#editarAsisDireccion").val("");
			//*******
			$("#EdasisID").html(response.informacion.id_asistentes);
			$("#editarAsisPN").val(response.informacion.primerNombreAsistente);
			$("#editarAsisSN").val(response.informacion.segundoNombreAsistente);
			$("#editarAsisPA").val(response.informacion.primerApellidoAsistente);
			$("#editarAsisSA").val(response.informacion.segundoApellidoAsistente);
			$("#editarAsisTipo").selectpicker(
				"val",
				response.informacion.tipoDocumentoAsistente
			);
			$("#editarAsisNumero").val(
				response.informacion.numeroDocumentoAsistente
			);
			$("#editarAsisDireccion").val(
				response.informacion.direccionCorreoElectronicoAsistente
			);
			$("#editarAsistenteDiv").slideDown();
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
$("#actualizarAsistente").click(function () {
	$id_asistente = $("#EdasisID").html();
	$editarAsisPN = $("#editarAsisPN").val();
	$editarAsisSN = $("#editarAsisSN").val();
	$editarAsisPA = $("#editarAsisPA").val();
	$editarAsisSA = $("#editarAsisSA").val();
	$editarAsisTipo = $("#editarAsisTipo").val();
	$editarAsisNumero = $("#editarAsisNumero").val();
	$editarAsisDireccion = $("#editarAsisDireccion").val();

	data = {
		id_asistente: $id_asistente,
		editarAsisPN: $editarAsisPN,
		editarAsisSN: $editarAsisSN,
		editarAsisPA: $editarAsisPA,
		editarAsisSA: $editarAsisSA,
		editarAsisTipo: $editarAsisTipo,
		editarAsisNumero: $editarAsisNumero,
		editarAsisDireccion: $editarAsisDireccion,
	};

	$.ajax({
		url: baseURL + "panel/actualizarAsistente",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			notificacion(response.msg, "success");
			$(".verCurso").click();
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
$(".informe_restaurar").click(function () {
	reload();
});
var $dataAsistentes = [];
$(".adminVerInforme").click(function () {
	$id_curso = $(this).attr("data-id");

	data = {
		id_curso: $id_curso,
	};
	$.ajax({
		url: baseURL + "admin/cargar_informacionInforme",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$("#tabla_informes").slideUp();
			$("#adminInformacionInforme").slideDown();
			$dataAsistentes.push({ data: response.asistentes });

			$("#nombre_curso").html(response.curso[0].nombreCurso);
			$("#duracion_curso").html(response.curso[0].tipoCurso);
			$("#tipo_curso").html(response.curso[0].duracionCurso);
			$("#fecha_curso").html(response.curso[0].fechaCurso);
			$("#fecha_ingreso_curso").html(response.curso[0].fechaIngresoCurso);
			$("#numero_asistentes").html(response.curso[0].numeroAsistentes);
			$("#numero_asistentes_hombres").html(response.curso[0].numeroHombres);
			$("#numero_asistentes_mujeres").html(response.curso[0].numeroMujeres);
			if (
				response.curso[0].archivoAsistentes != null ||
				response.curso[0].archivoAsistencia != null
			) {
				$("#archivoAsistentes").attr(
					"href",
					"../uploads/asistentes/" + response.curso[0].archivoAsistentes
				);
				$("#archivoAsistencia").attr(
					"href",
					"../uploads/asistentes/" + response.curso[0].archivoAsistencia
				);
			} else {
				$("#archivoAsistentes").remove();
				$("#archivoAsistencia").remove();
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
$(".adminVerAsistentes").click(function () {
	$num_asis = 0;
	$("#informacionInforme").removeClass("col-md-12");
	$("#informacionInforme").addClass("col-md-3");
	$(this).prop("disabled", true);
	$("#cursoAsistente").show("slide", { direction: "right" }, 1000);
	$("#anteriorAsistente").prop("disabled", true);
	$("#getCert").attr(
		"data-id-ass",
		$dataAsistentes["0"].data[$num_asis].id_asistentes
	);

	$("#id_asistente_curso").html(parseFloat($num_asis) + 1);
	$("#primer_nombre_asistente").html(
		$dataAsistentes["0"].data[$num_asis].primerNombreAsistente
	);
	$("#segundo_nombre_asistente").html(
		$dataAsistentes["0"].data[$num_asis].segundoNombreAsistente
	);
	$("#primer_apellido_asistente").html(
		$dataAsistentes["0"].data[$num_asis].primerApellidoAsistente
	);
	$("#segundo_apellido_asistente").html(
		$dataAsistentes["0"].data[$num_asis].segundoApellidoAsistente
	);
	$("#tipoDocumentoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].tipoDocumentoAsistente
	);
	$("#numeroDocumentoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].numeroDocumentoAsistente
	);
	$("#nombreOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].nombreOrganizacion
	);
	$("#numNITOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].numNITOrganizacion
	);
	$("#procesoBeneficio").html(
		$dataAsistentes["0"].data[$num_asis].procesoBeneficio
	);
	$("#fechaFinalizacion").html(
		$dataAsistentes["0"].data[$num_asis].fechaFinalizacion
	);
	$("#departamentoResidencia").html(
		$dataAsistentes["0"].data[$num_asis].departamentoResidencia
	);
	$("#municipioResidencia").html(
		$dataAsistentes["0"].data[$num_asis].municipioResidencia
	);
	$("#faxAsistente").html($dataAsistentes["0"].data[$num_asis].faxAsistente);
	$("#direccionAsistente").html(
		$dataAsistentes["0"].data[$num_asis].direccionAsistente
	);
	$("#direccionCorreoElectronicoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].direccionCorreoElectronicoAsistente
	);
	$("#edadAsistente").html(
		$dataAsistentes["0"].data[$num_asis].edadAsistente
	);
	$("#sexoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].sexoAsistente
	);
	$("#nivelFormacion").html(
		$dataAsistentes["0"].data[$num_asis].nivelFormacion
	);
	$("#rolOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].rolOrganizacion
	);
	$("#cabezaFamilia").html(
		$dataAsistentes["0"].data[$num_asis].cabezaFamilia
	);
	$("#discapacidad").html($dataAsistentes["0"].data[$num_asis].discapacidad);
	$("#indigena").html($dataAsistentes["0"].data[$num_asis].indigena);
	$("#afro").html($dataAsistentes["0"].data[$num_asis].afro);
	$("#raizal").html($dataAsistentes["0"].data[$num_asis].raizal);
	$("#palenquero").html($dataAsistentes["0"].data[$num_asis].palenquero);
	$("#romGitano").html($dataAsistentes["0"].data[$num_asis].romGitano);
	$("#redUnidos").html($dataAsistentes["0"].data[$num_asis].redUnidos);
	$("#numeroFolioRedUnidos").html(
		$dataAsistentes["0"].data[$num_asis].numeroFolioRedUnidos
	);
	$("#victima").html($dataAsistentes["0"].data[$num_asis].victima);
	$("#numeroRUVVictima").html(
		$dataAsistentes["0"].data[$num_asis].numeroRUVVictima
	);
	$("#reintegro").html($dataAsistentes["0"].data[$num_asis].reintegro);
	$("#numeroCODAReintegro").html(
		$dataAsistentes["0"].data[$num_asis].numeroCODAReintegro
	);
	$("#LGTBI").html($dataAsistentes["0"].data[$num_asis].LGTBI);
	$("#prostitucion").html($dataAsistentes["0"].data[$num_asis].prostitucion);
	$("#privadoLibertad").html(
		$dataAsistentes["0"].data[$num_asis].privadoLibertad
	);
});
$("#anteriorAsistente").click(function () {
	$num_asis = $("#id_asistente_curso").html();
	$num_asis = parseFloat($num_asis) - 2;
	$("#id_asistente_curso").html($num_asis + 1);
	$("#getCert").attr(
		"data-id-ass",
		$dataAsistentes["0"].data[$num_asis].id_asistentes
	);

	$("#primer_nombre_asistente").html(
		$dataAsistentes["0"].data[$num_asis].primerNombreAsistente
	);
	$("#segundo_nombre_asistente").html(
		$dataAsistentes["0"].data[$num_asis].segundoNombreAsistente
	);
	$("#primer_apellido_asistente").html(
		$dataAsistentes["0"].data[$num_asis].primerApellidoAsistente
	);
	$("#segundo_apellido_asistente").html(
		$dataAsistentes["0"].data[$num_asis].segundoApellidoAsistente
	);
	$("#tipoDocumentoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].tipoDocumentoAsistente
	);
	$("#numeroDocumentoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].numeroDocumentoAsistente
	);
	$("#nombreOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].nombreOrganizacion
	);
	$("#numNITOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].numNITOrganizacion
	);
	$("#procesoBeneficio").html(
		$dataAsistentes["0"].data[$num_asis].procesoBeneficio
	);
	$("#fechaFinalizacion").html(
		$dataAsistentes["0"].data[$num_asis].fechaFinalizacion
	);
	$("#departamentoResidencia").html(
		$dataAsistentes["0"].data[$num_asis].departamentoResidencia
	);
	$("#municipioResidencia").html(
		$dataAsistentes["0"].data[$num_asis].municipioResidencia
	);
	$("#faxAsistente").html($dataAsistentes["0"].data[$num_asis].faxAsistente);
	$("#direccionAsistente").html(
		$dataAsistentes["0"].data[$num_asis].direccionAsistente
	);
	$("#direccionCorreoElectronicoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].direccionCorreoElectronicoAsistente
	);
	$("#edadAsistente").html(
		$dataAsistentes["0"].data[$num_asis].edadAsistente
	);
	$("#sexoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].sexoAsistente
	);
	$("#nivelFormacion").html(
		$dataAsistentes["0"].data[$num_asis].nivelFormacion
	);
	$("#rolOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].rolOrganizacion
	);
	$("#cabezaFamilia").html(
		$dataAsistentes["0"].data[$num_asis].cabezaFamilia
	);
	$("#discapacidad").html($dataAsistentes["0"].data[$num_asis].discapacidad);
	$("#indigena").html($dataAsistentes["0"].data[$num_asis].indigena);
	$("#afro").html($dataAsistentes["0"].data[$num_asis].afro);
	$("#raizal").html($dataAsistentes["0"].data[$num_asis].raizal);
	$("#palenquero").html($dataAsistentes["0"].data[$num_asis].palenquero);
	$("#romGitano").html($dataAsistentes["0"].data[$num_asis].romGitano);
	$("#redUnidos").html($dataAsistentes["0"].data[$num_asis].redUnidos);
	$("#numeroFolioRedUnidos").html(
		$dataAsistentes["0"].data[$num_asis].numeroFolioRedUnidos
	);
	$("#victima").html($dataAsistentes["0"].data[$num_asis].victima);
	$("#numeroRUVVictima").html(
		$dataAsistentes["0"].data[$num_asis].numeroRUVVictima
	);
	$("#reintegro").html($dataAsistentes["0"].data[$num_asis].reintegro);
	$("#numeroCODAReintegro").html(
		$dataAsistentes["0"].data[$num_asis].numeroCODAReintegro
	);
	$("#LGTBI").html($dataAsistentes["0"].data[$num_asis].LGTBI);
	$("#prostitucion").html($dataAsistentes["0"].data[$num_asis].prostitucion);
	$("#privadoLibertad").html(
		$dataAsistentes["0"].data[$num_asis].privadoLibertad
	);
	if ($num_asis + 1 == 1) {
		$(this).prop("disabled", true);
		$("#siguienteAsistente").prop("disabled", false);
	} else {
		$(this).prop("disabled", false);
		$("#siguienteAsistente").prop("disabled", true);
	}
});
$("#siguienteAsistente").click(function () {
	$num_asis = $("#id_asistente_curso").html();
	$("#id_asistente_curso").html(parseFloat($num_asis) + 1);
	$("#getCert").attr(
		"data-id-ass",
		$dataAsistentes["0"].data[$num_asis].id_asistentes
	);

	$("#primer_nombre_asistente").html(
		$dataAsistentes["0"].data[$num_asis].primerNombreAsistente
	);
	$("#segundo_nombre_asistente").html(
		$dataAsistentes["0"].data[$num_asis].segundoNombreAsistente
	);
	$("#primer_apellido_asistente").html(
		$dataAsistentes["0"].data[$num_asis].primerApellidoAsistente
	);
	$("#segundo_apellido_asistente").html(
		$dataAsistentes["0"].data[$num_asis].segundoApellidoAsistente
	);
	$("#tipoDocumentoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].tipoDocumentoAsistente
	);
	$("#numeroDocumentoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].numeroDocumentoAsistente
	);
	$("#nombreOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].nombreOrganizacion
	);
	$("#numNITOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].numNITOrganizacion
	);
	$("#procesoBeneficio").html(
		$dataAsistentes["0"].data[$num_asis].procesoBeneficio
	);
	$("#fechaFinalizacion").html(
		$dataAsistentes["0"].data[$num_asis].fechaFinalizacion
	);
	$("#departamentoResidencia").html(
		$dataAsistentes["0"].data[$num_asis].departamentoResidencia
	);
	$("#municipioResidencia").html(
		$dataAsistentes["0"].data[$num_asis].municipioResidencia
	);
	$("#faxAsistente").html($dataAsistentes["0"].data[$num_asis].faxAsistente);
	$("#direccionAsistente").html(
		$dataAsistentes["0"].data[$num_asis].direccionAsistente
	);
	$("#direccionCorreoElectronicoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].direccionCorreoElectronicoAsistente
	);
	$("#edadAsistente").html(
		$dataAsistentes["0"].data[$num_asis].edadAsistente
	);
	$("#sexoAsistente").html(
		$dataAsistentes["0"].data[$num_asis].sexoAsistente
	);
	$("#nivelFormacion").html(
		$dataAsistentes["0"].data[$num_asis].nivelFormacion
	);
	$("#rolOrganizacion").html(
		$dataAsistentes["0"].data[$num_asis].rolOrganizacion
	);
	$("#cabezaFamilia").html(
		$dataAsistentes["0"].data[$num_asis].cabezaFamilia
	);
	$("#discapacidad").html($dataAsistentes["0"].data[$num_asis].discapacidad);
	$("#indigena").html($dataAsistentes["0"].data[$num_asis].indigena);
	$("#afro").html($dataAsistentes["0"].data[$num_asis].afro);
	$("#raizal").html($dataAsistentes["0"].data[$num_asis].raizal);
	$("#palenquero").html($dataAsistentes["0"].data[$num_asis].palenquero);
	$("#romGitano").html($dataAsistentes["0"].data[$num_asis].romGitano);
	$("#redUnidos").html($dataAsistentes["0"].data[$num_asis].redUnidos);
	$("#numeroFolioRedUnidos").html(
		$dataAsistentes["0"].data[$num_asis].numeroFolioRedUnidos
	);
	$("#victima").html($dataAsistentes["0"].data[$num_asis].victima);
	$("#numeroRUVVictima").html(
		$dataAsistentes["0"].data[$num_asis].numeroRUVVictima
	);
	$("#reintegro").html($dataAsistentes["0"].data[$num_asis].reintegro);
	$("#numeroCODAReintegro").html(
		$dataAsistentes["0"].data[$num_asis].numeroCODAReintegro
	);
	$("#LGTBI").html($dataAsistentes["0"].data[$num_asis].LGTBI);
	$("#prostitucion").html($dataAsistentes["0"].data[$num_asis].prostitucion);
	$("#privadoLibertad").html(
		$dataAsistentes["0"].data[$num_asis].privadoLibertad
	);
	if (parseFloat($num_asis) + 1 == $dataAsistentes["0"].data.length) {
		$(this).prop("disabled", true);
		$("#anteriorAsistente").prop("disabled", false);
	} else {
		$(this).prop("disabled", false);
		$("#anteriorAsistente").prop("disabled", false);
	}
});
