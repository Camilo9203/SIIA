let hash_url = window.location.hash;
/**
 * Ver Solicitudes
 * */
$("#verSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
	$("#solicitudesRegistradas").show();
});
/**
 * Volver Solicitudes
 * */
$(".volverSolicitudes").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").hide();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").show();
	$("#solicitudesRegistradas").show();
});
/**
 * Volver Panel
 * */
$(".volverPanel").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$(".formulario_panel").hide();
	$("#panel_inicial").show();
	$("#tipoSolicitud").hide();
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
});
/**
 * Crear Solicitud
 * */
$("#nuevaSolicitud").click(function () {
	$("#ayudaModalidad").modal({ backdrop: "static", keyboard: false });
	$("#ayudaModalidad").modal("hide");
	$("#crearSolicitudes").hide();
	$("#solicitudesRegistradas").hide();
	$("#tipoSolicitud").show();
});
/**
 * Guardar formulario tipo de solicitud
 * */
$("#guardar_formulario_tipoSolicitud").click(function () {
	Alert.fire({
		title: '¿Está seguro de crear la solicitud?',
		text: 'Verifique la modalidad y los motivos registrados en la solicitud. Tenga en cuenta que una vez creada la solicitud no modificarla.',
		icon: 'question',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
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
					Toast.fire({
						icon: 'error',
						title: 'Seleccione al menos un motivo'
					});
				}
				else if (seleccionModalidad == 0){
					Toast.fire({
						icon: 'error',
						title: 'Seleccione al menos una modalidad'
					});
				}
				else {
					//Si la data es validada se envía al controlador para guardar con ajax
					$.ajax({
						url: baseURL + "Solicitudes/crearSolicitud",
						type: "post",
						dataType: "JSON",
						data: data,
						beforeSend: function () {
							Toast.fire({
								icon: 'info',
								title: 'Guardando Información'
							});
						},
						success: function (response) {
							console.log(response)
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
											redirect(baseURL + "solicitudes/solicitud/" + response.id);
										}, 2000);
									}
								})
							}
							else if(response.status = 'error'){
								Alert.fire({
									title: response.title,
									html: response.msg,
									text: response.msg,
									icon: response.status,
									allowOutsideClick: false,
									customClass: {
										popup: 'popup-swalert-list',
										confirmButton: 'button-swalert',
									},
								})
							}
						},
						error: function (ev) {
							//Do nothing
						},
					});
				}
			}
		}
	});
});
/**
 * Modales modalidades
 * */
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
/**
 * Opciones modales modalidades
 * */
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
/**
 * Ver Solicitud
 *  */
$(".verSolicitud").click(function () {
	let idSolicitud = $(this).attr("data-id");
	window.open(baseURL + "solicitudes/solicitud/" + idSolicitud, '_self');
});
/**
 * Eliminar solicitud
 * */
$(".eliminarSolicitud").click(function () {
	let idSolicitud = $(this).attr("data-id");
	let text = "¿Estás seguro de eliminar la solicitud: <strong>" +
		idSolicitud +
		"</strong>? <br><br> Esta acción no se puede revertir y eliminara el contenido de todos los formularios a excepción de los formularios: " +
		"<br><br> <strong>1. Información General </strong>" +
		"<br> <strong>6. Facilitadores.</strong>";
	Alert.fire({
		title: 'Eliminar solicitud',
		html: text,
		text: text,
		icon: 'question',
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
		allowOutsideClick: false,
		customClass: {
			popup: 'popup-swalert-list',
			confirmButton: 'button-swalert',
		},
	}).then((result) => {
		if (result.isConfirmed) {
			let data = {
				idSolicitud: idSolicitud,
			};
			$.ajax({
				url: baseURL + "Solicitudes/eliminarSolicitud",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					Toast.fire({
						icon: 'danger',
						title: 'Eliminando solitud'
					});
				},
				success: function (response) {
					Alert.fire({
						title: 'Solicitud eliminada!',
						html: response.msg,
						text: response.msg,
						icon: response.status,
						confirmButtonText: 'Aceptar',
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
					console.log(ev);
					notificacion("Ocurrió un error y no se elimino solicitud");
				},
			});
		}
	})
	$('#eliminarSolicitud').attr('data-id', idSolicitud);
	$('#solicitudAEliminar').html();

});
/**
 * Ver Solicitud
 * */
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
/**
 * Ver estado solicitud
 * */
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
