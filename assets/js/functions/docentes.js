/**
 * Notificación Toast
 * SweetAlert
 * */
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 4000,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	},
	customClass: {
		popup: 'popup-toast'
	},
})
const Alert = Swal.mixin({
	confirmButtonText: 'Aceptar',
	customClass: {
		confirmButton: 'button-swalert',
		popup: 'popup-swalert'
	},
})
/**
 * Añadir nuevo docente
 * */
$("#añadirNuevoDocente").click(function () {
	ValidarFormDocentes("docentes");
	if ($("#formulario_crear_docente").valid()) {
		$(this).attr("disabled", true);
		data = {
			cedula: $("#docentes_cedula").val(),
			primer_nombre: $("#docentes_primer_nombre").val(),
			segundo_nombre: $("#docentes_segundo_nombre").val(),
			primer_apellido: $("#docentes_primer_apellido").val(),
			segundo_apellido: $("#docentes_segundo_apellido").val(),
			profesion: $("#docentes_profesion").val(),
			horas: $("#docentes_horas").val(),
			valido: 0,
		};
		$.ajax({
			url: baseURL + "docentes/anadirNuevoDocente",
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
				Alert.fire({
					title: 'Se creo docente!',
					text: response.msg,
					icon: 'success',
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
				Toast.fire({
					icon: 'error',
					title: 'Error al ingresar información.'
				});
			},
		});
	}
	else {
		Toast.fire({
			icon: 'warning',
			title: 'Formulario no validado.'
		});
	}
});
/**
 * Ver docente
 * */
$(".verDocenteOrg").click(function () {
	let nombre_docente = $(this).attr("data-nombre");
	let id_docente = $(this).attr("data-id");
	let data = {
		id_docente: id_docente,
	};

		$.ajax({
			url: baseURL + "docentes/cargarInformacionDocente",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#nombre_doc").html(nombre_docente);
				$("#nombre_doc").attr("data-id", id_docente);
				$("#siEliminarDocente").attr("data-id", id_docente);
				$("#primer_nombre_doc").val(response.primerNombreDocente);
				$("#segundo_nombre_doc").val(response.segundoNombreDocente);
				$("#primer_apellido_doc").val(response.primerApellidoDocente);
				$("#segundo_apellido_doc").val(response.segundoApellidoDocente);
				$("#numero_cedula_doc").val(response.numCedulaCiudadaniaDocente);
				$("#profesion_doc").val(response.profesion);
				$("#horas_doc").val(response.horaCapacitacion);
				if (response.valido == 1) {
					$("#valido_doc").html("Sí");
				} else {
					$("#valido_doc").html("No");
				}
				$("#docente_arch_id	").remove();
				$("body").append("<div data-docente-id='" + id_docente + "' id='docente_arch_id'></div>"
				);
				cargarArchivosDocente(id_docente);
			},
			error: function (ev) {
				//Do nothing
			},
		});

});
/**
 * Actualizar docente
 * */
$(".actualizar_docente").click(function () {
	let data = {
		id_docente: $("#nombre_doc").attr("data-id"),
		primer_nombre_doc: $("#primer_nombre_doc").val(),
		segundo_nombre_doc: $("#segundo_nombre_doc").val(),
		primer_apellido_doc: $("#primer_apellido_doc").val(),
		segundo_apellido_doc: $("#segundo_apellido_doc").val(),
		numero_cedula_doc: $("#numero_cedula_doc").val(),
		profesion_doc: $("#profesion_doc").val(),
		horas_doc: $("#horas_doc").val(),
		solicitud: $(this).val(),
	};
	console.log(data);
	$.ajax({
		url: baseURL + "docentes/actualizarDocente",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'warning',
				title: 'Actualizando docente'
			});
		},
		success: function (response) {
			Toast.fire({
				icon: 'success',
				title: response.msg
			});
			setInterval(function () {
				reload();
			}, 4000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Eliminar docente
 * */
$("#siEliminarDocente").click(function () {
	$(this).attr("disabled", true);
	data = {
		id_docente: $(this).attr("data-id"),
	};
	$.ajax({
		url: baseURL + "docentes/eliminarDocente",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'warning',
				title: 'Eliminando docente'
			});
		},
		success: function (response) {
			Toast.fire({
				icon: 'success',
				title: response.msg
			});
			setInterval(function () {
				reload();
			}, 2000);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Subir archivo HV docente
 * */
$(".archivos_form_hojaVidaDocente").on("click", function () {
	$data_name = $(".archivos_form_hojaVidaDocente").attr("data-name");
	$id_docente = $("#docente_arch_id").attr("data-docente-id");
	var file_data = $("#" + $data_name).prop("files")[0];
	var form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
	form_data.append("append_name", $data_name);
	form_data.append("id_docente", $id_docente);
	$.ajax({
		url: baseURL + "docentes/guardarArchivoHojaVidaDocente",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSubmit: function () {
			Toast.fire({
				icon: 'info',
				title: 'Guardando archivo'
			});
		},
		success: function (response) {
			if(response.status === 1) {
				Alert.fire({
					title: 'Se cargo archivo!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				})
			}
			else {
				Alert.fire({
					title: 'No se cargo archivo! ',
					text: response.msg,
					icon: 'warning',
					confirmButtonText: 'Aceptar',
				})
			}
			cargarArchivosDocente($id_docente);
		},
		error: function (ev) {
			Toast.fire({
				icon: 'info',
				title: 'No se cargo archivo correctamente'
			});
		},
	});
});
/** Subir archivo titulo docente  */
$(".archivos_form_tituloDocente").on("click", function () {
	$data_name = $(".archivos_form_tituloDocente").attr("data-name");
	$id_docente = $("#docente_arch_id").attr("data-docente-id");
	var file_data = $("#" + $data_name).prop("files")[0];
	var form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
	form_data.append("append_name", $data_name);
	form_data.append("id_docente", $id_docente);
	$.ajax({
		url: baseURL + "docentes/guardarArchivoTituloDocente",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSubmit: function () {
			Toast.fire({
				icon: 'info',
				title: 'Guardando archivo'
			});
		},
		success: function (response) {
			if(response.status === 1) {
				Alert.fire({
					title: 'Se cargo archivo!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				})
			}
			else {
				Alert.fire({
					title: 'No se cargo archivo! ',
					text: response.msg,
					icon: 'warning',
					confirmButtonText: 'Aceptar',
				})
			}
			cargarArchivosDocente($id_docente);
		},
		error: function (ev) {
			notificacion("Verifique los datos del formulario.", "success");
		},
	});
});
/**
 * Subir archivo certifica exp docente
 * */
$(".archivos_form_certificadoDocente").on("click", function () {
	data_name = $(".archivos_form_certificadoDocente").attr("data-name");
	id_docente = $("#docente_arch_id").attr("data-docente-id");
	var form_data = new FormData();
	let count = 0;
	$.each(
		$("#formulario_archivo_docente_certificados input[type='file']"),
		function (obj, v) {
			var file = v.files[0];
			if (file != undefined) {
				form_data.append("file[" + obj + "]", file);
				count ++;
			}
		}
	);
	if (count === 3) {
		form_data.append("append_name", data_name);
		form_data.append("tipoArchivo", $("#" + data_name + "1").attr("data-val"));
		form_data.append("append_name", data_name);
		form_data.append("id_docente", id_docente);
		$.ajax({
			url: baseURL + "archivos/uploadFiles",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				Toast.fire({
					icon: 'info',
					title: 'Guardando archivo'
				});
			},
			success: function (response) {
				if (response.icon === 'success') {
					Alert.fire({
						title: 'Se cargo archivo!',
						text: response.msg,
						icon: response.icon,
						confirmButtonText: 'Aceptar',
					})
				} else {
					Alert.fire({
						title: 'No se cargo archivo! ',
						text: response.msg,
						icon: response.icon,
						confirmButtonText: 'Aceptar',
					})
				}
				cargarArchivosDocente(id_docente);
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	} else {
		Alert.fire({
			title: 'Faltan archivos!',
			text: count + '/3 Debes cargar 3 archivos para continuar',
			icon: 'warning',
		})
	}
});
/**
 * Subir archivo certifica ECS docente
 * */
$(".archivos_form_certificadoEconomiaDocente").on("click", function () {
	$data_name = $(".archivos_form_certificadoEconomiaDocente").attr("data-name");
	$id_docente = $("#docente_arch_id").attr("data-docente-id");
	$horasCertEcoSol = $("#horasCertEcoSol").val();
	var file_data = $("#" + $data_name).prop("files")[0];
	var form_data = new FormData();
	form_data.append("file", file_data);
	form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
	form_data.append("append_name", $data_name);
	form_data.append("id_docente", $id_docente);
	form_data.append("horas", $horasCertEcoSol);
	$.ajax({
		url: baseURL + "docentes/guardarArchivoCertificadoEconomiaDocente",
		dataType: "text",
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: "post",
		dataType: "JSON",
		beforeSubmit: function () {
			Toast.fire({
				icon: 'info',
				title: 'Guardando archivo'
			});
		},
		success: function (response) {
			if(response.status === 1) {
				Alert.fire({
					title: 'Se cargo archivo!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Aceptar',
				})
			}
			else {
				Alert.fire({
					title: 'No se cargo archivo! ',
					text: response.msg,
					icon: 'warning',
					confirmButtonText: 'Aceptar',
				})
			}
			cargarArchivosDocente($id_docente);
		},
		error: function (ev) {
			notificacion("Verifique los datos del formulario.", "success");
		},
	});
});
/**
 * Eliminar archivo docente
 * */
$(document).on("click", ".eliminar_archivo_docente", function () {
	let id_docente = $(this).attr("data-id-docente");
	let data = {
		id_archivoDocente: $(this).attr("data-id-archivoDocente"),
		id_docente: id_docente,
		tipo: $(this).attr("data-id-tipo"),
		nombre: $(this).attr("data-nombre-ar"),
	};
	$.ajax({
		url: baseURL + "docentes/eliminarArchivoDocente",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			Toast.fire({
				icon: 'warning',
				title: 'Eliminando archivo'
			});
		},
		success: function (response) {
			Alert.fire({
				title: 'Se elimino archivo!',
				text: response.msg,
				icon: 'success',
				confirmButtonText: 'Aceptar',
			})
			cargarArchivosDocente(id_docente);
		},
		error: function (ev) {
			Toast.fire({
				icon: 'warning',
				title: 'Archivo no eliminado.'
			});
		},
	});
});
/**
 * Cargar Archivos Docentes
 * */
function cargarArchivosDocente(id) {
	$(".tabla_form > #tbody").empty();
	let id_docente = id;
	let data = {
		id_docente: id_docente,
	};
	$.ajax({
		url: baseURL + "Docentes/cargarDatosArchivosDocente",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			let url;
			let carpeta;
			if (response.length == 0) {
				$("#tabla_archivos_docentes").hide();
			} else {
				$("#tabla_archivos_docentes").show();
				for (var i = 0; i < response.length; i++) {
					// URLs archivos
					if (response[i].tipo == "docenteHojaVida") {
						carpeta = "docentes/hojasVida";
						url = "../uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "docenteTitulo") {
						carpeta = "docentes/titulos";
						url = "../uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "docenteCertificados") {
						carpeta = "docentes/certificados";
						url = "../uploads/" + carpeta + "/";
					}
					if (response[i].tipo == "docenteCertificadosEconomia") {
						carpeta = "docentes/certificadosEconomia";
						url = "../uploads/" + carpeta + "/";
					}
					$("<tr>").appendTo(".tabla_form > tbody");
					var nombre_r = response[i].nombre.replace('"', "").replace('"', "");
					var tipo_r = response[i].tipo.replace('"', "").replace('"', "");
					switch (tipo_r) {
						case "docenteHojaVida":
							$tipo = "Hoja de vida";
							break;
						case "docenteTitulo":
							$tipo = "Titulo profesional";
							break;
						case "docenteCertificadosEconomia":
							$tipo = "Certificado de economía solidaria";
							break;
						case "docenteCertificados":
							$tipo = "Certificado de experiencia";
							break;
					}
					$("<td>" + $tipo + "</td>").appendTo(".tabla_form > tbody");
					$('<td><textarea class="form-control" rows="4" disabled>' + response[i].observacionArchivo + "</textarea></td>").appendTo(".tabla_form > tbody");
					$('<td>' +
						'<div class="btn-group-vertical">' +
							'<a class="btn btn-success btn-sm" target="_blank" href="' + url + response[i].nombre + '"><i class="ti-eye" aria-hidden="true"></i> Ver</a>' +
							'<button type="button"class="btn btn-danger btn-sm eliminar_archivo_docente" data-id-tipo="' + response[i].tipo +
							'" data-nombre-ar="' + response[i].nombre +
							'" data-id-archivoDocente="' + response[i].id_archivosDocente +
							'" data-id-docente="' + response[i].docentes_id_docente +
							'"><i class="ti-trash" aria-hidden="true"></i> Eliminar </button>' +
						'</div>' +
					'</td>'
					).appendTo(".tabla_form > tbody");
					$("</tr>").appendTo(".tabla_form > tbody");
				}
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
}
/**
 * Validar Formularios Modulo Perfil
 * */
function ValidarFormDocentes (form) {
	// Formulario Actualizar Nombre de usuario.
	switch (form) {
		case "docentes":
			// Fomulario Docentes
			$("form[id='formulario_crear_docente']").validate({
				rules: {
					docentes_cedula: {
						required: true,
						minlength: 3,
					},
					docentes_primer_nombre: {
						required: true,
						minlength: 3,
					},
					docentes_primer_apellido: {
						required: true,
						minlength: 3,
					},
					docentes_profesion: {
						required: true,
						minlength: 3,
					},
					docentes_horas: {
						required: true,
					},
				},
				messages: {
					docentes_cedula: {
						required: "Por favor, escriba la cedula del facilitador.",
						minlength: "La Cedula debe tener mínimo 3 caracteres.",
					},
					docentes_primer_nombre: {
						required: "Por favor, escriba el primer nombre del facilitador.",
						minlength: "El primer nombre debe tener mínimo 3 caracteres.",
					},
					docentes_primer_apellido: {
						required: "Por favor, escriba el primer apellido del facilitador.",
						minlength: "El primer apellido debe tener mínimo 3 caracteres.",
					},
					docentes_profesion: {
						required:
							"Por favor, escriba la profesión del facilitador sin abreviación alguna.",
						minlength: "La profesion debe tener mínimo 3 caracteres.",
					},
					docentes_horas: {
						required:
							"Por favor, escriba las horas que tiene de capacitación el facilitador.",
						min: "Por favor, debe tener mínimo 60 horas de capacitación.",
					},
				},
			});
			break
		default:
	}

}
