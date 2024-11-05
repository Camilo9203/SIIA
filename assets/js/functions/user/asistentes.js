$(document).ready(function() {
	validarFormAsistente();
	/**
	 * Modal crear/actualizar administrador
	 */
	$(".asistente-modal").click(function () {
		let funct = $(this).attr('data-funct');
		if (funct === 'crear') {
			$('#title-modal-asistentes').text('Crear asistente');
			$('#guardarAsistente').html('Crear Asistente <i class="fa fa-check" aria-hidden="true"></i>');
			$('#guardarAsistente').attr('data-func', 'crear');
			$("#primerApellidoAsistente").val('');
			$("#segundoApellidoAsistente").val('');
			$("#primerNombreAsistente").val('');
			$("#segundoNombreAsistente").val('');
			$("#numeroDocumentoAsistente").val('');
			$("#numNITOrganizacion").val('');
			$("#nombreOrganizacion").val('');
			$("#informe_departamento_curso option[value='']").prop('selected', true);
			$("#informe_municipio_curso option[value='']").prop('selected', true);
			$("#telefono").val('');
			$("#correoElectronico").val('');
			$("#edad").val('');
			$("#genero option[value='']").prop('selected', true);
			$("#escolaridad option[value='']").prop('selected', true);
			$("#enfoqueDiferencial option[value='']").prop('selected', true);
			$("#condicionVulnerabilidad option[value='']").prop('selected', true);
			$("#discapacidad option[value='']").prop('selected', true);
		}
		else {
			$('#title-modal-asistentes').text('Actualizar asistente');
			$('#guardarAsistente').html('Actualizar Asistente <i class="fa fa-check" aria-hidden="true"></i>');
			$('#guardarAsistente').attr('data-func', 'actualizar');
			$('#guardarAsistente').attr('data-id', $(this).attr("data-id"));
			// Data asistente
			data = {
				id: $(this).attr("data-id"),
			};
			$.ajax({
				url: baseURL + "Asistentes/cargarDatosAsistente",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					console.log(response);
					$("#primerApellidoAsistente").val(response.primerApellidoAsistente);
					$("#segundoApellidoAsistente").val(response.segundoApellidoAsistente);
					$("#primerNombreAsistente").val(response.primerNombreAsistente);
					$("#segundoNombreAsistente").val(response.segundoNombreAsistente);
					$("#numeroDocumentoAsistente").val(response.numeroDocumentoAsistente);
					$("#numNITOrganizacion").val(response.numNITOrganizacion);
					$("#nombreOrganizacion").val(response.nombreOrganizacion);
					$("#informe_departamento_curso option[value='" + response.departamentoResidencia + "']").prop("selected", true);
					$("#telefono").val(response.telefono);
					$("#correoElectronico").val(response.correoElectronico);
					$("#edad").val(response.edad);
					$("#genero option[value='" + response.genero + "']").prop("selected", true);
					$("#escolaridad option[value='" + response.escolaridad + "']").prop("selected", true);
					$("#enfoqueDiferencial option[value='" + response.enfoqueDiferencial + "']").prop("selected", true);
					$("#condicionVulnerabilidad option[value='" + response.condicionVulnerabilidad + "']").prop("selected", true);
					$("#discapacidad option[value='" + response.discapacidad + "']").prop("selected", true);
				},
				error: function (ev) {
					errorControlador(ev)
				},
			});
		}

	});
	/**
	 * Crear administrador
	 */
	$("#guardarAsistente").click(function () {
		if ($("#formulario_asistente").valid()) {
			//Datos formulario modal
			var data = {
				primerApellidoAsistente: $("#primerApellidoAsistente").val(),
				segundoApellidoAsistente: $("#segundoApellidoAsistente").val(),
				primerNombreAsistente: $("#primerNombreAsistente").val(),
				segundoNombreAsistente: $("#segundoNombreAsistente").val(),
				numeroDocumentoAsistente: $("#numeroDocumentoAsistente").val(),
				numNITOrganizacion: $("#numNITOrganizacion").val(),
				nombreOrganizacion: $("#nombreOrganizacion").val(),
				departamentoResidencia: $("#informe_departamento_curso").val(),
				municipioResidencia: $("#informe_municipio_curso").val(),
				telefono: $("#telefono").val(),
				correoElectronico: $("#correoElectronico").val(),
				edad: $("#edad").val(),
				genero: $("#genero").val(),
				escolaridad: $("#escolaridad").val(),
				enfoqueDiferencial: $("#enfoqueDiferencial").val(),
				condicionVulnerabilidad: $("#condicionVulnerabilidad").val(),
				discapacidad: $("#discapacidad").val(),
				id_informe: curso_id,
			};
			let funct = $(this).attr('data-func');
			if (funct === 'crear') {
				$.ajax({
					url: baseURL + "Asistentes/create",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						Toast.fire({
							icon: 'info',
							title: 'Guardando datos'
						});
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
			else {
				data['id_asistente'] = $(this).attr('data-id');
				$.ajax({
					url: baseURL + "Asistentes/update",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						Toast.fire({
							icon: 'info',
							title: 'Guardando datos'
						});
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

		}
		else {
			Toast.fire({
				icon: 'warning',
				title: 'Por favor, llene los datos requeridos.'
			});
		}
	});
	// Validar formulario
	function validarFormAsistente () {
		// Formulario Login.
		$("form[id='formulario_asistente']").validate({
			rules: {
				primerApellidoAsistente: {
					required: true,
				},
				primerNombreAsistente: {
					required: true,
				},
				numeroDocumentoAsistente: {
					required: true,
				},
				informe_departamento_curso: {
					required: true,
				},
				informe_municipio_curso: {
					required: true,
				},
				edad: {
					required: true,
					maxlength: 2,
				},
				genero: {
					required: true,
				},
				escolaridad: {
					required: true,
				},
				enfoqueDiferencial: {
					required: true,
				},
				condicionVulnerabilidad: {
					required: true,
				},
				discapacidad: {
					required: true,
				},
			},
			messages: {
				primerApellidoAsistente: {
					required: 'Ingrese primer apellido'
				},
				primerNombreAsistente: {
					required: "Ingrese primer nombre",
				},
				numeroDocumentoAsistente: {
					required: "Ingrese número de documento",
				},
				informe_departamento_curso: {
					required: "Ingrese el departamento de residencia",
				},
				informe_municipio_curso: {
					required: "Ingrese el municipio de residencia",
				},
				edad: {
					required: "Ingrese la edad",
					maxlength: "Solo se permiten 2 dígitos"
				},
				genero: {
					required: "Ingrese genero",
				},
				escolaridad: {
					required: "Ingrese escolaridad",
				},
				enfoqueDiferencial: {
					required: "Ingrese enfoque diferencial",
				},
				condicionVulnerabilidad: {
					required: "Ingrese condición",
				},
				discapacidad: {
					required: "Ingrese discapacidad",
				},
			},
		});

	}
	// Ver asistente a cursos
	$("#cargar_archivo_excel_asistentes").click(function () {
		var data_name = $(".archivoAsistentes").attr("data-name");
		var file_data = $("#" + data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("append_name", data_name);
		form_data.append("curso_id", curso_id);
		$.ajax({
			url: baseURL + "Asistentes/excelAsistentes",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				procesando("info", 'Cargando asistentes')
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
					alertaProceso(response.title ,response.msg, response.status);
				}
			},
			error: function (ev) {
				errorControlador(ev);
			},
		});
	});
	/**
	 * Eliminar asistente
	 */
	$(".eliminar_asistente").click(function () {
		let data = {
			id: $(this).attr("data-id"),
		};
		Alert.fire({
			title: 'Borrar Asistente!',
			text: 'Esta acción no se puede deshacer, eliminara el asistente al curso, desea borrar realmente ?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: baseURL + "Asistentes/delete",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSubmit: function () {
						procesando("info", 'Eliminado asistente')
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
	 * Editar asistente
	 */
	$(".editar_asistente").click(function () {
		let data = {
			id: $(this).attr("data-id"),
		};
		$.ajax({
			url: baseURL + "Asistentes/delete",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSubmit: function () {
				procesando("info", 'Eliminado curso')
			},
			success: function (response) {
				if(response.status === 'success') {
					alertaProceso(response.title ,response.msg, response.status)
					reload();
				}
				else {
					alertaProceso(response.title ,response.msg, response.status)
				}
			},
			error: function (ev) {
				errorControlador(ev);
			},
		});
	});
	// TODO: Terminar edición informe
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
});
