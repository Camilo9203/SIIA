validarFormEstado();
/** Consultar estados */
//Evento consultar estadoSolicitud
$("#consultarEstadoID").click(function () {
	if ($("#formulario_estado").valid()) {
		event.preventDefault();
		data = {
			idSolicitud: $("#numeroID").val(),
		};
		$.ajax({
			url: baseURL + "home/consultarEstado",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				console.log(response);
				if(response.status == 1) {
					$(this).attr("disabled", true);
					$("#idSol").html(response.solicitud.idSolicitud);
					$("#organizacion").html(response.organizacion.nombreOrganizacion);
					$("#estadoOrg").html('<code> ' + response.solicitud.nombre + '</code>');
					$("#estadoAnterio").html(response.solicitud.estadoAnterio);
					$("#fechaCreacion").html(response.solicitud.fecha);
					$("#fechaFin").html(response.solicitud.fechaFinalizado);
					$("#revision").html(response.solicitud.fechaUltimaRevision);
					$("#modSol").html(response.solicitud.modalidadSolicitud);
					$("#motSol").html(response.solicitud.motivoSolicitud);
					$("#tipSol").html(response.solicitud.tipoSolicitud);
					$("#asignadoSol").html(response.solicitud.asignada);
					$("#resConEst").slideDown();
					$("#numeroID").val("");
				}
				else {
					Toast.fire({
						icon: 'error',
						title: response.message,
					});
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}

});
/**
 * Actualizar estado de la solicitud
 */
$("#actualizarEstadoOrganizacion").click(function () {
	let data = {
		idOrganizacion: $(this).attr("data-id-organizacion"),
		idSolicitud: $(this).attr("data-id-solicitud"),
		estadoSolicitud: $("#estadoSolicitud").val()
	};
	$.ajax({
		url: baseURL + "Solicitudes/actualizarEstadoSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			procesando('info', 'Cambiando estado')
		},
		success: function (response) {
			if(response.status == 'success') {
				alertaGuardarEstado(response.title, response.msg, response.status)
			}
			else {
				procesando(response.status, response.msg)
			}
		},
		error: function (ev) {
			console.log(ev);
			procesando('error', ev.evenText);
		},
	});
});
$("#tabla_enProceso_organizacion tbody").on("click", '.ver_estado_org', function () {
	let id_org = $(this).attr("data-organizacion");
	$("#id_org_ver_form").remove();
	$("body").append("<div id='id_org_ver_form' class='hidden' data-id='" + id_org + "'>");
	let data = {
		id_organizacion: id_org,
		idSolicitud: $(this).attr("data-solicitud")
	};
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#admin_ver_finalizadas").slideUp();
			$("#v_estado_org").slideDown();
			$("#actualizarEstadoOrganizacion").attr("data-id-organizacion", id_org);
			$("#actualizarEstadoOrganizacion").attr("data-id-solicitud", data["idSolicitud"]);
			$("#resolucion_nombre_org").html(response.organizaciones.nombreOrganizacion);
			$("#nit_organizacion").html(response.organizaciones.numNIT);
			$("#id_solicitud").html(response.estadoOrganizaciones.idSolicitud);
			$("#estado_actual_org").html(response.estadoOrganizaciones.nombre);
			$("#modalidad_solicitud").html(response.estadoOrganizaciones.modalidadSolicitudAcreditado);
			$("#motivo_solicitud").html(response.estadoOrganizaciones.motivoSolicitudAcreditado);
			$("#fecha_finalización").html(response.estadoOrganizaciones.fechaFinalizado);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Validar formularios */
function validarFormEstado () {
	// Formulario Login.
	$("form[id='formulario_estado']").validate({
		rules: {
			numeroID: 	{
				required: true,
				minlength: 10,
			},
		},
		messages: {
			numeroID: {
				required: "Por favor, digite su numero de solicitud.",
				minlength: "El numero de solicitud tiene 10 dígitos o mas.",
			},
		},
	});
}
function procesando(status, msg){
	Toast.fire({
		icon: status,
		text: msg
	});
}
function alertaGuardarEstado(title, msg, status){
	Alert.fire({
		title: title,
		html: msg,
		text: msg,
		icon: status,
	}).then((result) => {
		if (result.isConfirmed) {
			setInterval(function () {
				reload();
			}, 2000);
		}
	})
}
