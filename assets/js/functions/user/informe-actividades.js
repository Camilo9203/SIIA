$(document).ready(function() {
	validarFormInformeActividades();
	var progress = 0;
	if (informes > 0) {
		$('#registro_informe_actividades').hide();
	}
	/**
	 * Barra de progreso y acciones de guardado
	 */
	function updateProgressBar(value) {
		// Inicio
		if(value === 0) {
			$('.title-form').hide();
			$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
			$('.form-section').hide(); // Ocultar todos los formularios
			$('#form-' + value).show(); // Mostrar el formulario correspondiente
		}
		// Instructivo y formatos
		if(value === 50) {
			$('.title-form').show();
			$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
			$('.form-section').hide(); // Ocultar todos los formularios
			$('#form-' + value).show(); // Mostrar el formulario correspondiente
		}
		// Formulario informe actividades
		if(value === 100) {
			$('.title-form').show();
			// Validar formulario
			if ($("#formulario_informe_actividades").valid()) {
				console.log('valores:' , $("#informe_asistentes").val())
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
						$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
						$('.form-section').hide(); // Ocultar todos los formularios
						$('#form-' + value).show(); // Mostrar el formulario correspondiente
						$('#back').attr('disabled', true);
						$('#forward').text('Finalizar');
					},
					error: function (ev) {
						value -=50
						progress -=50
						$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
						$('.form-section').hide(); // Ocultar todos los formularios
						$('#form-' + value).show(); // Mostrar el formulario correspondiente
						errorControlador(ev);
					},
				});
			}
			else {
				// Ajustar valores para detener progreso
				value -=50
				progress -=50
				console.log('Value: ',value)
				console.log('Progress: ',value)
				$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
				$('.form-section').hide(); // Ocultar todos los formularios
				$('#form-' + value).show(); // Mostrar el formulario correspondiente
				alertaValidarFomulario('Debe validar los datos del formulario para continuar', 'error')
			}
		}
		// Formulario archivos
		if (value === 150) {
			$('.title-form').show();
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
					if(response.status == 'success') {
						$.ajax({
							url: baseURL + "InformeActividades/cargarUltimoInformeActividad",
							cache: false,
							contentType: false,
							processData: false,
							type: "GET",
							dataType: "JSON",
							success: function (res) {
								console.log(res)
								$('#cantidadAsistentes').html(res.totalAsistentes);
								$("#registrarAsistentes").attr("data-id", res.id_informeActividades);
							},
							error: function (ev) {
								errorControlador(ev);
							},
						});
						alertaProceso(response.title ,response.msg, response.status)
						$('#back').hide();
						$('#forward').hide();
						$('#reload').show();
					}
					else {
						// Ajustar valores para detener progreso
						alertaProceso(response.title ,response.msg, response.status)
						value -=50
						progress -=50
					}
					$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
					$('.form-section').hide(); // Ocultar todos los formularios
					$('#form-' + value).show(); // Mostrar el formulario correspondiente
				},
				error: function (ev) {
					$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
					$('.form-section').hide(); // Ocultar todos los formularios
					$('#form-' + value).show(); // Mostrar el formulario correspondiente
					errorControlador(ev);
				},
			});
		}
	}
	// Botón registrar informe
	$('#registrar_informe').click(function() {
		var progress = 0;
		console.log("Botón registro: ", progress);
		$('#registro_informe_actividades').slideDown();
		$('#tabla_informe_actividades').slideUp();
	});
	// Adelante
	$('#reload').click(function() {
		reload();
	});
	// Adelante
	$('#forward').click(function() {
		console.log("Adelante: ", progress)
		$('#title-form').show();
		if (progress < 150) {
			progress += 50;
			updateProgressBar(progress);
		}
	});
	// Atrás
	$('#back').click(function() {
		console.log("Atrás: ", progress)
		if (progress === 0) {
			$('.title-form').hide();
		}
		if (progress === 0 && informes > 0) {
			$('#registro_informe_actividades').slideUp()
			$('#tabla_informe_actividades').slideDown();
		}
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
	// Validar formulario
	function validarFormInformeActividades () {
		// Formulario informe de actividades.
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
		// Formulario descripción observación.
		$("form[id='formulario_crear_observacion_informe']").validate({
			rules: {
				descripcion_observacion_informe_actividades: {
					required: true,
				},
			},
			messages: {
				descripcion_observacion_informe_actividades: {
					required: 'Ingrese descripción'
				},
			},
		});
	}
	/**
	 * Eliminar informe de actividades
	 */
	$(".eliminar_informe_actividad").click(function () {
		let data = {
			id: $(this).attr("data-id"),
		};
		let textAlert = 'Esta acción no se puede deshacer, eliminará tanto el curso como los archivos y asistentes de este. <br><br> ¿Realmente desea borrar?';
		Alert.fire({
			title: '¡Borrar Informe!',
			html: textAlert,
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
				// Declaración de variables
				let motivo_informe = '';
				let modalidad_informe = '';
				let intencionalidad_informe = '';
				// Recorrer cursos tipo JSON y traducir a string
				$.each(JSON.parse(response.cursos), function (index, item) {
					switch (item) {
						case '1':
							motivo_informe += 'Acreditación Curso Básico de Economía Solidaria' + ', ';
							break;
						case '2':
							motivo_informe += 'Aval de Trabajo Asociado' + ', ';
							break;
						case '3':
							motivo_informe += 'Acreditación Curso Medio de Economía Solidaria' + ', ';
							break;
						case '4':
							motivo_informe += 'Acreditación Curso Avanzado de Economía Solidaria' + ', ';
							break;
						case '5':
							motivo_informe += 'Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria' + ', ';
							break;
						default:
					};
				});
				motivo_informe = motivo_informe.substring(0, motivo_informe.length -2)
				// Recorrer modalidades tipo JSON y traducir a string
				$.each(JSON.parse(response.modalidades), function (index, item) {
					switch (item) {
						case '1':
							modalidad_informe += 'Presencial' + ', ';
							break;
						case '2':
							modalidad_informe += 'Virtual' + ', ';
							break;
						case '3':
							modalidad_informe += 'En Linea' + ', ';
							break;
						default:
					};
				});
				modalidad_informe = modalidad_informe.substring(0, modalidad_informe.length -2)
				// Recorrer intencionalidades tipo JSON y traducir a string
				$.each(JSON.parse(response.intencionalidad), function (index, item) {
					switch (item) {
						case '1':
							intencionalidad_informe += 'Promoción' + ', ';
							break;
						case '2':
							intencionalidad_informe += 'Creación' + ', ';
							break;
						case '3':
							intencionalidad_informe += 'Fortalecimiento' + ', ';
							break;
						case '4':
							intencionalidad_informe += 'Desarrollo' + ', ';
							break;
						case '5':
							intencionalidad_informe += 'Integración' + ', ';
							break;
						case '6':
							intencionalidad_informe += 'Protección' + ', ';
							break;
						default:
					};
				});
				intencionalidad_informe = intencionalidad_informe.substring(0, intencionalidad_informe.length -2)
				$("#informe_fecha_incio_v").val(response.fechaInicio);
				$("#informe_fecha_fin_v").val(response.fechaFin);
				$("#informe_departamento_curso_v").val(response.departamento);
				$("#informe_municipio_curso_v").val(response.municipio);
				$("#informe_duracion_curso_v").val(response.duracion);
				// Traer docente curso
				data_docente = {
					id_docente: response.docentes_id_docente,
				};
				$.ajax({
					url: baseURL + "Docentes/cargarDocente",
					type: "post",
					dataType: "JSON",
					data: data_docente,
					success: function (res) {
						$("#informe_docente_v").val(res.primerNombreDocente  + " " + res.primerApellidoDocente);
					}
				});

				$("#informe_intencionalidad_curso_v").val(intencionalidad_informe);
				$("#informe_cursos_v").val(motivo_informe);
				$("#informe_modalidad_v").val(modalidad_informe);
				$("#informe_asistentes_v").val(response.totalAsistentes);
				$("#informe_numero_mujeres_v").val(response.mujeres);
				$("#informe_numero_hombres_v").val(response.hombres);
				$("#informe_numero_no_binario_v").val(response.noBinario);
			},
			error: function (ev) {
				errorControlador(ev)
			},
		});
	});
	/**
	 * Ver observaciones informe
	 */
	$(".verObservacionesInforme").click(function () {
		data = {
			id: $(this).attr("data-id"),
		};
		$.ajax({
			url: baseURL + "InformeActividades/cargarObservacionesInforme",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				let html = '';
				// Recorrer observaciones
				$.each(response, function (index, item) {
					// Traer administrador
					let data_admin = {
						id: item.administradores_id_administrador,
					};
					$.ajax({
						url: baseURL + "Administradores/cargarDatosAdministrador",
						type: "post",
						dataType: "JSON",
						data: data_admin,
						success: function (res) {
							// Mostrar observaciones luego de buscar administrador que las realizo
							html += "<hr>";
							html += "<p><label class='font-weight-bold'>Creada por: </label> " + res.administrador.primerNombreAdministrador + " " + res.administrador.primerApellidoAdministrador + "</p>";
							html += "<textarea readonly style='resize: none; width: 800px; height: max-content;'>" + item.descripcion + "</textarea>";
							html += "<p>" + item.created_at + "</p>";
							$("#observaciones_informe_actividades").html(html);
						}
					});
				});
			},
			error: function (ev) {
				errorControlador(ev)
			},
		});
	});
	/**
	 * Enviar informe
	 */
	$(".enviarInforme").click(function () {
		let data = {
			id: $(this).attr("data-id"),
		};
		console.log($(this).attr("data-id"));
		let textAlert = 'Esta acción enviará este informe para ser revisado por la unidad. <br><br> ¿Realmente desea enviarlo?';
		Alert.fire({
			title: 'Enviar Informe',
			html: textAlert,
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: baseURL + "InformeActividades/send",
					type: "post",
					dataType: "JSON",
					data: data,
					success: function (response) {
						if (response.status === 'success') {
							Alert.fire({
								title: response.title,
								html: response.msg,
								icon: response.status,
								customClass: {
									popup: 'popup-swalert-lg',
									confirmButton: 'button-swalert',
								},
								confirmButtonText: 'Aceptar',
							}).then((result) => {
								if (result.isConfirmed) {
									reload();
								}
							})
						}
						else {
							alertaInforme(response.title ,response.msg, response.status)
						}
					},
					error: function (ev) {
						errorControlador(ev)
					},
				});
			}
		});
	});
	// Ver asistente a cursos
	$(".verAsistentes").click(function () {
		let curso = $(this).attr("data-id");
		window.open(baseURL + "Asistentes/curso/" + curso, '_self');
	});
	// Funciones Administrador
	/**
	 * Aprobar Informe
	 */
	$(".aprobarInforme").click(function () {
		let data = {
			id: $(this).attr("data-id"),
		};
		console.log($(this).attr("data-id"));
		let textAlert = 'Esta acción aprobará este informe y será notificada la organización. <br><br> ¿Realmente desea aprobarlo?';
		Alert.fire({
			title: 'Aprobar Informe',
			html: textAlert,
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: baseURL + "InformeActividades/approved",
					type: "post",
					dataType: "JSON",
					data: data,
					success: function (response) {
						if (response.status === 'success') {
							Alert.fire({
								title: response.title,
								html: response.msg,
								icon: response.status,
								customClass: {
									popup: 'popup-swalert-lg',
									confirmButton: 'button-swalert',
								},
								confirmButtonText: 'Aceptar',
							}).then((result) => {
								if (result.isConfirmed) {
									reload();
								}
							})
						}
						else {
							alertaInforme(response.title ,response.msg, response.status)
						}
					},
					error: function (ev) {
						errorControlador(ev)
					},
				});
			}
		});
	});
	$(".crearObservacion").click(function () {
		$("#crear_observacion_informe").attr('data-id', $(this).attr("data-id"));
	});
	/**
	 * Realizar observaciones
	 */
	$("#crear_observacion_informe").click(function () {
		let data = {
			id: $(this).attr("data-id"),
			descripcion: $("#descripcion_observacion_informe_actividades").val(),
		};
		if ($("#formulario_crear_observacion_informe").valid()) {
			let textAlert = 'Esta acción enviará este informe para ser revisado por la organización. <br><br> ¿Realmente desea enviarlo?';
			Alert.fire({
				title: 'Enviar Observación',
				html: textAlert,
				icon: 'question',
				showCancelButton: true,
				confirmButtonText: 'Si',
				cancelButtonText: 'No',
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: baseURL + "InformeActividades/crearObservacion",
						type: "post",
						dataType: "JSON",
						data: data,
						success: function (response) {
							if (response.status === 'success') {
								Alert.fire({
									title: response.title,
									html: response.msg,
									icon: response.status,
									customClass: {
										popup: 'popup-swalert-lg',
										confirmButton: 'button-swalert',
									},
									confirmButtonText: 'Aceptar',
								}).then((result) => {
									if (result.isConfirmed) {
										reload();
									}
								})
							}
							else {
								alertaInforme(response.title ,response.msg, response.status)
							}
						},
						error: function (ev) {
							errorControlador(ev)
						},
					});
				}
			});
		}
		else {
			alertaValidarFomulario('Debe validar los datos del formulario para continuar', 'error')
		}
	});
	// Alerta de formulario guardado
	function alertaInforme(title, msg, status){
		Alert.fire({
			title: title,
			html: msg,
			text: msg,
			icon: status,
			customClass: {
				popup: 'popup-swalert-list',
				confirmButton: 'button-swalert',
			},
		})
	}
});
