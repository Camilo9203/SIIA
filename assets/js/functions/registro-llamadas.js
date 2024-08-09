$(".contenedor--menu2").hide();
$(".icono2").click(function () {
	$(".contenedor--menu2").animate({
		width: "toggle",
	});
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
$("#guardarRegistroTelefonico").click(function () {
	// Capturar datos formulario
	data = {
		funcionario: $("#telefonicoFuncionario").val(),
		cargo: $("#telefonicoCargo").val(),
		telefono: $("#telefonicoTelefono").val(),
		tipoLlamada: $("#telefonicoTipoLlamada").val(),
		tipoComunicacion: $("#telefonicoTipoComunicacion").val(),
		idSolicitud: $("#telefonicoIdSolicitud").val(),
		fecha: $("#telefonicoFecha").val(),
		duracion: $("#telefonicoDuracion").val(),
		descripcion: $("#telefonicoDescripcion").val(),
		organizaciones_id_organizacion: $("#telefonicoNitOrganizacion").val(),
		administradores_id_administrador: $("#telefonicoIdAdministrador").val(),
	};
	$.ajax({
		url: baseURL + "RegistroTelefonico/create",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			guardando();
		},
		success: function (response) {
			if(response.status === 'success') {
				clearInputs("formulario-registro-telefonico");
				alertaGuardadoRegistro(response.title, response.msg, response.status)
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
function errorValidacionFormulario() {
	$("html, body").animate({
		scrollTop: 300
	}, 3000);
	Toast.fire({
		icon: 'warning',
		text: 'Registra correctamente los campos obligatorios'
	});
}
// Alerta de formulario guardado
function alertaGuardadoRegistro(title, msg, status){
	msg = msg + '<br> ¿Deseá agregar un nuevo registro?';
	Alert.fire({
		title: title,
		text: msg,
		html: msg,
		icon: status,
		showCancelButton: true,
		confirmButtonText: 'Si',
		cancelButtonText: 'No',
	}).then((result) => {
		if (result.isConfirmed) {
			clearInputs("formulario-registro-telefonico");
		}
		else {
			clearInputs("formulario-registro-telefonico");
			$('#modal_form_registro_llamadas').modal('hide');
		}
	})
}
// Alerta error guardar formulario
function alertaErrorGuardado(msg, status){
	Alert.fire({
		title: 'Error al guardar!',
		text: msg,
		icon: status,
	})
}
// Toast Guardando
function guardando(){
	Toast.fire({
		icon: 'info',
		text: 'Guardando'
	});
}
