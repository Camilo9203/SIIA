let url = unescape(window.location.href);
let activate = url.split("/");
let baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
let html = "";
// var domainName = window.location.origin + "/beneficiados/public/";
// Guardar formulario tipo de solicitud
$("#guardar_formulario_tipoSolicitud").click(function () {
	if ($("#formulario_crear_solicitud").valid()) {
		$(this).attr("disabled", true);
		let motivos_solicitud = [];
		let motivo_solicitud = '';
		$("#formulario_crear_solicitud input[type=checkbox]").each(function (){
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
		console.log(motivos_solicitud,motivo_solicitud);
		data = {
			tipo_solicitud: $("input:radio[name=tipo_solicitud]:checked").val(),
			motivo_solicitud: motivo_solicitud,
			modalidad_solicitud: $("input:radio[name=modalidad_solicitud]:checked").val(),
			motivos_solicitud: motivos_solicitud
		};
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
				verificarFormularios();
				if (response.est == "En Proceso de Renovación" || response.est == "En Proceso de Actualización") {
					window.location.hash = "enProcesoActualizacion";
				} else if (
					response.est == "En Proceso" ||
					response.est == "Negada" ||
					response.est == "Revocada" ||
					response.est == "Acreditado"
				) {
					window.location.hash = "enProceso";
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}
});
// Eliminar Solicitud
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
/** Formulario 6 */
$("#acepto_programa").click(function () {
	alert("funciona mierda!!!");
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
			//clearInputs("formulario_programa_basico");
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
