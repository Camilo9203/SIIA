let hash_url = window.location.hash;
/** Crear Solicitud */
$("#nuevaSolicitud").click(function () {
	$("#crearSolicitudes").hide();
	$("#tipoSolicitud").show();
});
/** Modales modalidades */
$("#virtualCheck").click(function () {
	if(this.checked) {
		$("#ayudaModalidadVirtual").modal("toggle");
	}
});
$("#enLineaCheck").click(function () {
	if(this.checked) {
		$("#ayudaModalidadEnLinea").modal("toggle");
	}
});
/** Opciones modales modalidades */
$("#noModVirtCheck").click(function () {
	$("#virtualCheck").prop("checked", false);
	$("#ayudaModalidadVirtual").modal("hide");
});
$("#siModVirt").click(function () {
	$("#virtualCheck").prop("checked", true);
	$("#ayudaModalidadVirtual").modal("hide");
});
$("#noModEnLinea").click(function () {
	$("#enLineaCheck").prop("checked", false);
	$("#ayudaModalidadEnLinea").modal("hide");
});
$("#siModEnLinea").click(function () {
	$("#enLineaCheck").prop("checked", true);
	$("#ayudaModalidadEnLinea").modal("hide");
});

/** Ver Solicitud */
$(".verDetalleSolicitud").click(function () {
	let html = ''
	let data = {
		idSolicitud: $(this).attr('data-id')
	}
	$.ajax({
		url: baseURL + "solicitudes/cargarDatosSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			html += "<p><label class='font-weight-bold'>Solicitud Número: </label> " + response.solicitud['idSolicitud'] + "</p>";
			html += "<p><label class='font-weight-bold'>Tipo: </label> " + response.solicitud['tipoSolicitud'] + "</p>";
			html += "<p><label class='font-weight-bold'>Motivo: </label> " + response.solicitud['motivoSolicitud'] + "</p>";
			html += "<p><label class='font-weight-bold'>Modalidad: </label> " + response.solicitud['modalidadSolicitud'] + "</p>";
			$("#informacionSolicitudBasico").html(html);
			html = ""
			html += "<p><label class='font-weight-bold'>Fecha de Creación: </label> " + response.solicitud['fecha'] + "</p>";
			html += "<p><label class='font-weight-bold'>Fecha de Finalización: </label> " + response.solicitud['fechaFinalizado'] + "</p>";
			html += "<p><label class='font-weight-bold'>Fecha Ultima Revisión: </label> " +  response.solicitud['fechaUltimaRevision'] + "</p>";
			$("#informacionSolicitudFechas").html(html);
			html = ""
			html += "<p><label class='font-weight-bold'>Estado: </label> <code>" +  response.solicitud['nombre'] + "</code></p>";
			html += "<p><label class='font-weight-bold'>Estado Anterior: </label> " + response.solicitud['estadoAnterior'] + "</p>";
			html += "<p><label class='font-weight-bold'>Asignada: </label> " +  response.solicitud['asignada'] + "</p>";
			html += "<p><label class='font-weight-bold'>Revisiones: </label> " +  response.solicitud['numeroRevisiones'] + "</p>";
			html += "<p><label class='font-weight-bold'>Solicitud: </label> " +  response.solicitud['numeroSolicitudes'] + "</p>";
			$("#informacionSolicitudEstado").html(html);
		},
		error: function (ev) {
			console.log(ev);
		},
	})
});
/** Guardar formulario tipo de solicitud */
$("#guardar_formulario_tipoSolicitud").click(function () {
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
		Toast.fire({
			icon: 'error',
			title: 'Seleccione al menos un motivo.'
		})
	}
	else if (seleccionModalidad == 0){
		Toast.fire({
			icon: 'error',
			title: 'Seleccione al menos una modalidad.'
		})
	}
	else {
		//Si la data es validada se envía al controlador para guardar con ajax
		$(this).attr("disabled", true);
		$.ajax({
			url: baseURL + "solicitudes/guardarTipoSolicitud",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				Toast.fire({
					icon: 'info',
					title: 'Creando Solicitud.'
				})
			},
			success: function (response) {
				Swal.fire({
					title: 'Solicitud Creada!',
					text: response.msg,
					icon: 'success',
					showDenyButton: true,
					confirmButtonText: 'Ir a solicitud',
					denyButtonText: 'No ir'
				}).then((result) => {
					if (result.isConfirmed) {
						setInterval(function () {
							redirect(baseURL + "panel/solicitud/" + response.est);
						}, 2000);
					}
					else {
						setInterval(function () {
							reload();
						}, 2000);
					}
				});
			},
			error: function (ev) {
				console.log(ev);
			},
		});
	}
});

/** Volver Solicitudes */
$(".volverSolicitudes").click(function () {
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
});
/** Volver Panel */
$(".volverPanel").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").show();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
});
/** Ver Solicitud */
$(".verSolicitud").click(function () {
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "panel/solicitud/" + idSolicitud, '_self');
});
/** Ver modal y cargar variable de solicitud */
$(".eliminarSolicitudModal").click(function () {
	let idSolicitud = $(this).attr("data-id");
	$('#eliminarSolicitud').attr('data-id', idSolicitud);
	$('#solicitudAEliminar').html("¿Estas seguro de eliminar la solicitud " + idSolicitud + "?");
});
/** Eliminar Solicitud */
$(".eliminarSolicitud").click(function () {
	let data = {
		idSolicitud: $(this).attr('data-id'),
	};
	$.ajax({
		url: baseURL + "solicitudes/eliminarSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'warning',
				title: 'Borrando....'
			})
		},
		success: function (response) {
			Swal.fire({
				title: 'Solicitud Eliminada!',
				text: response.msg,
				icon: 'success',
				confirmButtonText: 'Finalizar',
			}).then((result) => {
				if (result.isConfirmed) {
					setInterval(function () {
						reload();
					}, 2000);
				}
			});
		},
		error: function (ev) {
			event.preventDefault();
			console.log(ev);
			Toast.fire({
				icon: 'error',
				title: 'Ocurrio un error al borrar'
			})
		},
	});
});
/** Ver estado solicitud */
$(".verObservaciones").click(function () {
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "panel/estadoSolicitud/" + idSolicitud, '_self');
});
function irSolicitud (data) {
	event.preventDefault();
	$.ajax({
		url: baseURL + "panel/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_self');
		}
	});
}


