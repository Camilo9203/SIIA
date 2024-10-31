$(document).ready(function() {
	validarFormInformeActividades();
	var progress = 0;
	/**
	 * Barra de progreso y acciones de guardado
	 */
	function updateProgressBar(value) {
		// alert(value);
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
					alertaProceso(response.title ,response.msg, response.status)
					$('#back').hide();
					$('#forward').hide();
					$('#reload').show();
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
	/**
	 * Eliminar informe de actividades
	 */
	$(".eliminar_informe_actividad").click(function () {
		let data = {
			id: $(this).attr("data-id"),
		};
		Alert.fire({
			title: 'Borrar Informe!',
			text: 'Esta acción no se puede deshacer, eliminara tanto el curso como los archivos y asistentes del mismo, desea borrar realmente ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: baseURL + "InformeActividades/delete",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSubmit: function () {
						procesando("info", 'Eliminado curso')
					},
					success: function (response) {
						if(response.status === 'success') {
							Alert.fire({
								title: response.title,
								text: response.msg,
								icon: response.status,
								confirmButtonText: 'Aceptar',
							}).then((result) => {
								if (result.isConfirmed) {
									reload();
								}
							})
						}
						else {
							alertaProceso(response.title ,response.msg, response.status)
						}
					},
					error: function (ev) {
						errorControlador(ev);
					},
				});
			}
		})
	});
	/**
	 * Editar curso
	 */
	$(".verCurso").click(function () {
		data = {
			id: $(this).attr("data-id"),
		};
		$.ajax({
			url: baseURL + "InformeActividades/cargarInformeActividad",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				console.log(response);
				$("#informe_fecha_incio").val(response.fechaInicio);
				$("#informe_fecha_fin").val(response.fechaFin);
				$("#informe_departamento_curso").val(response.departamento);
				$("#informe_duracion_curso").val(response.duracion);
				$("#informe_intencionalidad_curso").val(null);
				$("#informe_intencionalidad_curso").val(response.intencionalidad);
				$("#informe_docente option[value='" + response.docentes_id_docente + "']").prop("selected", true);
				$("#informe_intencionalidad_curso option[value='" + response.intencionalidad + "']").prop("selected", true);
				$("#informe_cursos option[value='" + response.cursos + "']").prop("selected", true);
				$("#informe_modalidad option[value='" + response.modalidades + "']").prop("selected", true);
				$("#informe_asistentes").val(response.totalAsistentes);
				$("#informe_numero_mujeres").val(response.mujeres);
				$("#informe_numero_hombres").val(response.hombres);
				$("#informe_numero_no_binario").val(response.noBinario);
			},
			error: function (ev) {
				errorControlador(ev)
			},
		});
	});
	// Ver asistente a cursos
	$(".verAsistentes").click(function () {
		let curso = $(this).attr("data-id");
		window.open(baseURL + "Asistentes/curso/" + curso, '_self');
	});
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
