/* PLEASE DO NOT COPY AND PASTE THIS CODE. */
/**
	@Autor Camilo Rios
	@Date 2022
**/
$(document).ready(function () {
	initJS();
	/**
		Variables del Script.
	**/
	var texto_validacaptcha = "Por favor valida el captcha.";
	var alert_danger = "alert-danger";
	var alert_info = "alert-info";
	var alert_warning = "alert-warning";
	var alert_success = "alert-success";
	var numero_formularios = 9;
	var theme = {};
	var hash_url = window.location.hash;
	/**
		Función para activar cuenta.
	**/
	var url = unescape(window.location.href);
	var activate = url.split("/");
	var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
	var funcion = activate[4];
	var funcion_ = activate[5];
	var inicio_bread = 4;
	/*var inicio_bread = 3;
	var funcion_ = activate[4];
	var baseURL = activate[0]+'//'+activate[2]+'/';
	var funcion = activate[3];*/

	let dataStyle = {
		normal: {
			label: {
				show: false,
			},
			labelLine: {
				show: false,
			},
		},
	};

	let placeHolderStyle = {
		normal: {
			color: "rgba(0,0,0,0)",
			label: {
				show: false,
			},
			labelLine: {
				show: false,
			},
		},
		emphasis: {
			color: "rgba(0,0,0,0)",
		},
	};
	let hashUrl = window.location.hash;
	hash = hashUrl.split(":");
	if (hash[0] == "#organizacion") {
		var table = $("#tabla_enProceso_organizacion").DataTable();
		table.column(1).search(hash[1]).draw();
		setTimeout(function () {
			$(".ver_organizacion_docentes").click();
		}, 500);
	} else if (hash[0] == "#idUsuario") {
		var table = $("#tablaUsuarios").DataTable();
		table.column(0).search(hash[1]).draw();
		var table2 = $("#tablaInusuarios").DataTable();
		table2.column(0).search(hash[1]).draw();
	}

	if (funcion_ == "verRelacionCambiosVista") {
		var table = $("#tabla_enProceso_organizacion").DataTable();
		table.column(1).search("solicitud").draw();
	}

	// Opciones del sistema
	$.ajax({
		url: baseURL + "home/cargarOpcionesSistema",
		type: "post",
		dataType: "JSON",
		success: function (response) {
			for (let i = 0; i < response.length; i++) {
				if (response[i].nombre == "titulo") {
					$("#titulo_sistema").html(response[i].valor);
				}
				if (response[i].nombre == "logo") {
					$("#imagen_header_politicas").attr(
						"src",
						baseURL + response[i].valor
					);
					$("#imagen_header").attr("src", baseURL + response[i].valor);
					$("#logo_mantenimiento").attr("src", baseURL + response[i].valor);
				}
				if (response[i].nombre == "logo_app") {
					$("#imagen_header_sia").attr("src", baseURL + response[i].valor);
					$("#logo_mantenimiento_sia").attr("src", baseURL + response[i].valor);
				}
				if (
					response[i].nombre == "modal" &&
					response[i].valor == 1 &&
					funcion == "panel" &&
					funcion_ == undefined
				) {
					$("#panelPrincipal").modal("show");
				}
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});

	/**
		ATENCION CUANDO TENGAMOS EL DOMINIO LA BASE URL CAMBIA A
		var baseURL = activate[0]+'//'+activate[2]+'/';  <----
		PUES YA NO APARECE http://localhost/sia/panel si no http://sia.orgsolidarias/panel

		TAMBIEN
		var inicio_bread = 4;
		a
		var inicio_bread = 3;
		PARA LA RUTA DEL BREADCRUM

		Tambien
		var funcion = activate[4];
		por
		var funcion = activate[3];
	**/
	//$(".breadcrumb").append('<li class="breadcrumb-item"><a id="lbl-sia" href="'+baseURL+'">'+activate[(inicio_bread-1)]+'</a></li>');
	//$titulo = $("#tPg").attr("titulo");
	for (var i = inicio_bread; i < activate.length; i++) {
		activate[i] = activate[i].replace(/([A-Z])/g, " $1").trim();
		$(".breadcrumb").append(
			'<li class="breadcrumb-item"><label>' + activate[i] + "</label></li>"
		);
		$(".breadcrumb-item").first().removeClass("active");
		$(".breadcrumb-item").last().addClass("active");
	}
	//$(".breadcrumb").append('<li class="breadcrumb-item"><label>'+$titulo+'</label></li>');
	//$(".breadcrumb").append('<li class="breadcrumb-item"><a href="'+activate[2]+'">'+activate[2]+'</a></li>');
	if (funcion == "activate") {
		var $tk = url.split("?");
		$tk = $tk[1];
		var $tkF = $tk.split(":");
		var data = {
			tk: $tkF[1],
			user: $tkF[2],
		};
		$.ajax({
			url: "verification",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				mensaje(
					"<h3>" +
						response.msg +
						" Sera redireccionado en 5 Segundos, por favor espere...</h3>",
					"alert-info"
				);
				setInterval("redirect('" + response.url + "')", 5000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		/** No hay nada que hacer aqui. **/
	}

	$(".panel").on("click", function () {
		$data_target = $(this).children().attr("data-id");
		for ($i = 0; $i < 10; $i++) {
			$(".panel-heading").removeClass("active-pnl");
			$(".panel-heading").addClass("collapsed");
			$("#" + $data_target + $i).css("height", "0px");
			$("#" + $data_target + $i).removeClass("in");
			if ($(this).children().hasClass("active-pnl")) {
				$(this).children(".panel-heading").removeClass("active-pnl");
			} else {
				$(this).children(".panel-heading").addClass("active-pnl");
			}
		}
	});
	// TODO: Permisos de visualización panel usuario
	if (funcion == "panel") {
		$.ajax({
			url: baseURL + "panel/cargarEstadoSolicitud",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				console.log(response);
				if (response.estado == "Finalizado" || response.estado == "En Observaciones") {
					$(".nuevaSolicitud").parent().css("display", "none");
					$(".ver_estado_solicitud").parent().css("display", "block");
					$(".ver_plan_mejoramiento").parent().css("display", "none");
					$(".ver_informe_actividades").parent().css("display", "none");
				}
				else if (response.estado == "Acreditado") {
					$(".nuevaSolicitud").parent().css("display", "block");
					$(".ver_docentes").parent().css("display", "block");
					$(".ver_informe_actividades").parent().css("display", "block");
					$(".ver_estado_solicitud").parent().css("display", "none");
				}
				else {
					$(".nuevaSolicitud").parent().css("display", "block");
					$(".ver_estado_solicitud").parent().css("display", "none");
					$(".ver_docentes").parent().css("display", "none");
					$(".ver_plan_mejoramiento").parent().css("display", "none");
					$(".ver_informe_actividades").parent().css("display", "none");
				}

				if (response.estado == "Finalizado") {
					if (response.tipo == "Eliminar") {
						$(".nuevaSolicitud").parent().css("display", "block");
						$(".ver_estado_solicitud").parent().css("display", "none");
						$(".ver_docentes").parent().css("display", "none");
						$(".ver_plan_mejoramiento").parent().css("display", "none");
						$(".ver_informe_actividades").parent().css("display", "none");
					}
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		/** No hay nada que hacer aqui. **/
	}
	//TODO: Permisos panel admin
	if (funcion == "panelAdmin") {
		// 0 tot - 1 ev - 2 rep - 3 cam - 4 hist - 5 seg - 6 asignar
		$nivel = $("#data_logg").attr("nvl");
		console.log($("#data_logg").attr("nvl"));
		if ($nivel == 0) {
			/** No hay nada que hacer aqui. **/
		} else if ($nivel == 1) {
			$("#adjCamara").remove();
			$(".cambiar_img_hd").remove();
			$("#asigOrg").remove();
			// Docentes
			$("#asigDocentes").remove();
		} else if ($nivel == 2) {
			$(".admin_informeActividades").remove();
			$(".admin_historico").remove();
			$(".admin_seguimiento").remove();
			$(".datos_abiertos").remove();
			$(".admin_contacto").remove();
			$(".admin_opciones_sis").remove();
			//Organizaciones
			$("#adjResolucion").remove();
			$("#camEstOrg").remove();
			$("#verOrgObs").remove();
			$("#adjCamara").remove();
			$(".cambiar_img_hd").remove();
			$(".guardarValidoDocente").remove();
			$("#verModTermObs").remove();
			$("#asigOrg").remove();
			// Docentes
			$("#asigDocentes").remove();
		} else if ($nivel == 3) {
			//Principal
			$(".admin_informeActividades").remove();
			$(".admin_historico").remove();
			$(".admin_seguimiento").remove();
			$(".datos_abiertos").remove();
			$(".admin_contacto").remove();
			$(".admin_opciones_sis").remove();
			//Organizaciones
			$("#adjResolucion").remove();
			$("#camEstOrg").remove();
			$("#verFacili").remove();
			$(".admin_verorganizaciones_docentes").remove();
			$("#verOrgObs").remove();
			$(".admin_organizaciones_enproceso").remove();
			$(".admin_organizaciones_inscritas").remove();
			$(".cambiar_img_hd").remove();
			$("#asigOrg").remove();
			// Docentes
			$("#asigDocentes").remove();
		} else if ($nivel == 4) {
			//Principal
			$(".admin_informeActividades").remove();
			$(".admin_seguimiento").remove();
			$(".datos_abiertos").remove();
			$(".admin_contacto").remove();
			$(".admin_opciones_sis").remove();
			//Organizaciones
			$("#adjResolucion").remove();
			$("#camEstOrg").remove();
			$("#verOrgObs").remove();
			$("#verFacili").remove();
			$("#adjCamara").remove();
			$(".cambiar_img_hd").remove();
			$(".guardarValidoDocente").remove();
			$("#verModTermObs").remove();
			$("#asigOrg").remove();
			// Docentes
			$("#asigDocentes").remove();
		} else if ($nivel == 5) {
			//Principal
			$(".admin_informeActividades").remove();
			$(".datos_abiertos").remove();
			//$(".admin_historico").remove();
			$(".admin_contacto").remove();
			$(".admin_opciones_sis").remove();
			//Organizaciones
			$("#adjResolucion").remove();
			$("#camEstOrg").remove();
			$(".admin_verorganizaciones_docentes").remove();
			$(".admin_organizaciones_finalizadas").remove();
			$(".admin_organizaciones_enproceso").remove();
			$(".admin_organizaciones_inscritas").remove();
			$(".admin_camaracomercio").remove();
			$(".cambiar_img_hd").remove();
			$("#asigOrg").remove();
			// Docentes
			$("#asigDocentes").remove();
		} else if ($nivel == 6) {
			/** No hay nada que hacer aqui. **/
		} else {
			/** No hay nada que hacer aqui. **/
		}
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (hash_url == "#actualizarSolicitud") {
		$.ajax({
			url: baseURL + "panel/cargarEstadoSolicitud",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				if (response.estado == "En Observaciones") {
					$("#nuevaSolicitud").click();
					$("#el_sol").attr("disabled", true);
					$("#el_sol").show();
					$("#div_cont_frm_doc").remove();
					$("#act_doc_sol").show();
					$(".hide-sidevar").show();
				} else {
					//redirect(baseURL+"panel");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		$("#el_sol").show();
	}

	if (hash_url == "#info") {
		notificacion("Esta organización no ha ingresado información.", "success");
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (hash_url == "#enProceso") {
		$.ajax({
			url: baseURL + "panel/cargarEstadoSolicitud",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				if (response.estado == "En Proceso") {
					$("#nuevaSolicitud").click();
					//$("#el_sol").attr("disabled", true);
					//$("#el_sol").remove();
					$("#div_cont_frm_doc").remove();
					$("#act_doc_sol").show();
					$(".hide-sidevar").show();
				} else {
					redirect(baseURL + "panel");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (hash_url == "#enProcesoActualizacion") {
		$.ajax({
			url: baseURL + "panel/cargarEstadoSolicitud",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				if (response.estado == "En Proceso de Actualización") {
					$("#nuevaSolicitud").click();
					$("#div_cont_frm_doc").remove();
					$("#act_doc_sol").show();
					$(".hide-sidevar").show();
				}
				if (response.estado == "En Proceso de Renovación") {
					$("#nuevaSolicitud").click();
					$("#div_cont_frm_doc").remove();
					$("#act_doc_sol").show();
					$(".hide-sidevar").show();
				} else {
					//redirect(baseURL+"panel");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (funcion_ == "estadoSolicitud") {
		$.ajax({
			url: baseURL + "panel/cargarEstadoSolicitud",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				console.log(response);
				if (response.estado == "En Observaciones") {
				} else {
					$(".actualizar_solicitud").attr("disabled", false);
					//$(".actualizar_solicitud").attr("disabled", true);
					//$(".actualizar_solicitud").remove();
					//$("#obs_orgs").remove();
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (
		funcion == "panelAdmin" &&
		(funcion_ == "contacto" || funcion_ == "modalInformacion")
	) {
		initCK();
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (funcion_ == "reportes") {
		$int_rep = setInterval(function () {
			$("#verReportes").click();
			clearInterval($int_rep);
		}, 1000);
	} else {
		/** No hay nada que hacer aqui. **/
	}

	if (funcion == "super" && funcion_ != "panel") {
		var $sp = url.split("?");
		$sp = $sp[1];
		var $spF = $sp.split(":");
		var data = {
			sp: $spF[1],
		};

		$.ajax({
			url: baseURL + "super/verify",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				if (response.url == "sia") {
					redirect(baseURL);
				} else {
					redirect(response.url);
				}
			},
			error: function (ev) {
				notificacion("Ingresa la contraseña valida.", "success");
			},
		});
	} else {
		/** No hay nada que hacer aqui. **/
	}

	$("#super_cerrar_sesion").click(function () {
		$.ajax({
			url: baseURL + "super/logout",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				if (response == "salir") {
					redirect(baseURL);
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	if (funcion == "evaluacion" && funcion != "panel") {
		var $sp = url.split("?");
		$sp = $sp[1];
		var $spF = $sp.split(":");
		var data = {
			org: $spF[1],
		};

		$("body").append(
			"<div class='hidden' data-id='" +
				$spF[1] +
				"' data-id-visita='" +
				$spF[2] +
				"' id='id_org_visita_eval'></div>"
		);
		/*$.ajax({
			url: baseURL+"super/verify",
			type: "post",
			dataType: "JSON",
			data: data,
		beforeSend: functions(){
			notificacion("Espere...", "success");
		},
		success:  functions (response) {
			if(response.url == "sia"){
				redirect(baseURL);
			}else{
				redirect(response.url);
			}
		},
		error: functions(ev){
			notificacion("Ingresa la contraseña valida.", "success");
		}
		});*/
	}

	if (funcion == "mapa") {
		$sp = url.split("?");

		data = {
			nombre_de_la_entidad: decodeURIComponent(escape($sp[1])),
			$$app_token: "34gNFwkJaEVjZQdRRrCPBHwGk",
		};

		$.ajax({
			url: "https://www.datos.gov.co/resource/2tsa-2de2.json",
			type: "get",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#tabla_d_a").show();
				notificacion("Datos cargados", "success");
				$("#datos_organizaciones_inscritas>#datos_basicos>span").empty();
				$("#tabla_datos_s_org>tbody#tbody_d_socrata").empty();
				$("#tabla_datos_s_org>tbody#tbody_d_socrata").html("");
				$("#tbody_d_socrata>.odd").remove();
				for (var i = 0; i < response.length; i++) {
					$("#tbody_d_socrata").append("<tr id=" + i + ">");
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].nombre_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].n_mero_nit + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].sigla_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].estado_actual_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].fecha_cambio_de_estado + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].tipo_de_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].direcci_n_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].departamento_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].municipio_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].tel_fono_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].extensi_n + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].url_de_la_entidad.url + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].actuaci_n_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].tipo_de_educaci_n_de_la_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].primer_nombre_representante_legal + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].segundo_nombre_representante_legal + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].primer_apellido_representante_legal + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].segundo_apellido_representante_legal + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].n_mero_c_dula_representante_legal + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].correo_electr_nico_entidad + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" +
							response[i].correo_electr_nico_representante_legal +
							"</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].n_mero_de_la_resoluci_n + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].fecha_de_inicio_de_la_resoluci_n + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].a_os_de_la_resoluci_n + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].tipo_de_solicitud + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].motivo_de_la_solicitud + "</td>"
					);
					$("#tbody_d_socrata>tr#" + i + "").append(
						"<td>" + response[i].modalidad_de_la_solicitud + "</td>"
					);
					$("#tbody_d_socrata").append("</tr>");
				}
				$(".tabla_form > #tbody_d_socrata > tr.odd").remove();
				paging("tabla_datos_s_org");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}

	if (funcion == "panel#") {
		if (hash_url == "#") {
		} else {
			if (window.history.pushState) {
				window.history.pushState("", "/", window.location.pathname);
			} else {
				window.location.hash = "";
				reloadH();
			}
		}
		$.ajax({
			url: baseURL + "panel/cargarEstadoSolicitud",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				if (
					response.estado == "Finalizado" ||
					response.estado == "En Observaciones"
				) {
					$(".nuevaSolicitud").parent().css("display", "none");
					$(".ver_estado_solicitud").parent().css("display", "block");
					$(".ver_plan_mejoramiento").parent().css("display", "none");
					$(".ver_informe_actividades").parent().css("display", "none");
				} else if (response.estado == "Acreditado") {
					$(".nuevaSolicitud").parent().css("display", "block");
					$(".ver_docentes").parent().css("display", "block");
					$(".ver_informe_actividades").parent().css("display", "block");
					$(".ver_estado_solicitud").parent().css("display", "none");
				} else {
					$(".nuevaSolicitud").parent().css("display", "block");
					$(".ver_estado_solicitud").parent().css("display", "none");
					$(".ver_docentes").parent().css("display", "none");
					$(".ver_plan_mejoramiento").parent().css("display", "none");
					$(".ver_informe_actividades").parent().css("display", "none");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}

	notificaciones(baseURL);

	/**
		Eventos Clicks TODO
	**/

	//Evento consultar estadoSolicitud
	$("#consultarEstadoID").click(function () {
		$numero = $("#numeroID").val();
		var response_captcha = grecaptcha.getResponse();

		data = {
			idoNit: $numero,
		};

		if (response_captcha != 0) {
			$.ajax({
				url: baseURL + "home/consultarEstado",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					console.log(response);
					$("#fechaFin").html(response.estado.fechaFinalizado);
					$("#estadoOrg").html(response.estado.nombre);
					//___________
					$("#idSol").html(response.tipoSolicitud.idSolicitud);
					$("#modSol").html(response.tipoSolicitud.modalidadSolicitud);
					$("#motSol").html(response.tipoSolicitud.motivoSolicitud);
					$("#tipSol").html(response.tipoSolicitud.tipoSolicitud);
					grecaptcha.reset();
					$("#resConEst").slideDown();
					$("#numeroID").val("");
				},
				error: function (ev) {
					//Do nothing
				},
			});
		} else {
			notificacion("Por favor, valide el captcha...");
		}
	});

	$("#consultarFacilitadores").click(function () {
		$numero = $("#facilitadoresNIT").val();
		var response_captcha = grecaptcha.getResponse();

		data = {
			numeroNIT: $numero,
		};

		if (response_captcha != 0) {
			$.ajax({
				url: baseURL + "home/consultarFacilitadores",
				type: "post",
				dataType: "JSON",
				data: data,
				success: function (response) {
					console.log(response);
					grecaptcha.reset();
					$("#resConEst").slideDown();
					$("#resConEst").empty();
					$("#resConEst").html("");
					$("#facilitadoresNIT").val("");
					$("#resConEst").append(
						"<h4>Lista de facilitadores válidos de la organización consultada:</h4>"
					);
					for ($i = 0; $i < response.facilitadores.length; $i++) {
						$("#resConEst").append(
							"<div id='doc" +
								response.facilitadores[$i].id_docente +
								"' class='col-md-4'>"
						);
						$("#resConEst>#doc" + response.facilitadores[$i].id_docente).append(
							"<hr/>"
						);
						$("#resConEst>#doc" + response.facilitadores[$i].id_docente).append(
							"<p>Nombre completo:</p><label class='tipoLeer'>" +
								response.facilitadores[$i].primerNombreDocente +
								" " +
								response.facilitadores[$i].segundoNombreDocente +
								" " +
								response.facilitadores[$i].primerApellidoDocente +
								" " +
								response.facilitadores[$i].segundoApellidoDocente +
								"</label>"
						);
						$("#resConEst>#doc" + response.facilitadores[$i].id_docente).append(
							"<p>Número único de identificación:</p><label class='tipoLeer'>" +
								response.facilitadores[$i].numCedulaCiudadaniaDocente +
								"</label>"
						);
						$("#resConEst>#doc" + response.facilitadores[$i].id_docente).append(
							"<p>Número de horas de capacitación:</p><label class='tipoLeer'>" +
								response.facilitadores[$i].horaCapacitacion +
								"</label>"
						);
						$("#resConEst>#doc" + response.facilitadores[$i].id_docente).append(
							"<p>Profesión:</p><label class='tipoLeer'>" +
								response.facilitadores[$i].profesion +
								"</label>"
						);
						$("#resConEst").append("</div>");
					}
					if (response.facilitadores.length == 0) {
						$("#resConEst").append(
							"<p>Ningún facilitador encontrado ó válido hasta el momento para la organización consultada.</p>"
						);
					}
				},
				error: function (ev) {
					//Do nothing
				},
			});
		} else {
			notificacion("Por favor, valide el captcha...");
		}
	});


	if (funcion == "panelAdmin" && funcion_ == "organizaciones") {
		$.ajax({
			url: baseURL + "admin/cargarBateriaObservacionesE",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				opciones = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
				console.log(response);
				for (var i = 0; i < response.length; i++) {
					for (var j = 0; j < opciones.length; j++) {
						if (response[i].tipo == opciones[j]) {
							//$("#divBateriaObservaciones").append('<li>');
							//$("#divBateriaObservaciones>li"+response[i].tipo+"").append('<a class="menu__enlace" id="'+response[i].tipo+'bat" href="#">1. Información General de la Entidad <i class="fa fa-home" aria-hidden="true"></i></a>');
							$(
								"#divBateriaObservaciones>li#" + response[i].tipo + "bat"
							).append('<ul class="submenu">');
							$(
								"#divBateriaObservaciones>li#" + response[i].tipo + "bat>ul"
							).append(
								'<li data-search-term="' +
									response[i].titulo.toLowerCase() +
									" " +
									response[i].observacion.toLowerCase() +
									'"><label>' +
									response[i].titulo +
									'</label><p class="obsCopy">' +
									response[i].observacion +
									"</p></li>"
							);
							$(
								"#divBateriaObservaciones>li#" + response[i].tipo + "bat"
							).append("</ul>");
							//$("#divBateriaObservaciones>li"+response[i].tipo+"").append('</li>');
							//$("#divBateriaObservaciones").append('</li>');
						}
					}
				}
				submenu();
			},
			error: function (ev) {
				//Do nothing
			},
		});
	} else {
		submenu();
		$(".icono--div").remove();
	}

	// Click en boton Ingresar.
	$(".ingresar").click(function () {
		redirect(baseURL + "login");
	});

	//Click en boton Registrar.
	$(".registrar").click(function () {
		redirect(baseURL + "registro");
	});

	//Click en boton Contacto.
	$(".contacto").click(function () {
		redirect(baseURL + "panel/contacto");
	});

	//Atras en solicitud
	$("#atras_solicitud").click(function () {
		redirect("panel");
	});
	$("#ver_docentes").click(function () {
		redirect(baseURL + "panel/docentes");
	});
	$("#ir_docentes").click(function () {
		redirect(baseURL + "panel/docentes");
	});
	//Click en ver perfil.
	$(".ver_perfil").click(function () {
		redirect(baseURL + "panel/perfil");
	});

	$(".certificaciones").click(function () {
		redirect(baseURL + "panel/certificaciones");
	});

	$("#obtenerCertificado").click(function () {
		redirect(baseURL + "panel/obtenerCertificado");
	});

	$(".ayuda").click(function () {
		redirect(baseURL + "panel/contacto/ayuda");
	});
	$(".volver_al_panel").click(function () {
		redirect(baseURL + "panel");
	});
	//Click en volver al panel.
	$("#ver_estado_solicitud").click(function () {
		redirect(baseURL + "panel/estadoSolicitud");
	});
	$("#ver_informe_actividades").click(function () {
		redirect(baseURL + "panel/informeActividades");
	});
	$("#ver_plan_mejoramiento").click(function () {
		redirect(baseURL + "panel/planMejora");
	});
	// Click admin INICIO
	// Se manejan id's en botones.
	//Reportes
	$("#admin_reportes").click(function () {
		redirect(baseURL + "panelAdmin/reportes");
	});
	// TODO: Menu panel docentes
	$("#admin_docentes_panel").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/docentes/panel");
	});
	$("#admin_docentes_asignar").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/docentes/asignar");
	});
	$("#admin_docentes_evaluar").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/docentes/evaluar");
	});
	$(".admin_volver_docentes").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/docentes/panel");
	});
	// TODO: Estadisticas
	$("#admin_estadisticas").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas");
	});
	$("#estadisticas_tramite").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/tramite");
	});
	$("#estadisticas_acreditacion").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/acreditacion");
	});
	$("#estadisticas_tramite").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/tramite");
	});
	$("#estadisticas_personas").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/personas");
	});
	$("#estadisticas_historico").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/historico");
	});
	$("#estadisticas_seguimiento").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/seguimiento");
	});
	$("#estadisticas_facilitadores").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas/facilitadores");
	});
	$("#volver_estadisticas").click(function () {
		redirect(baseURL + "panelAdmin/estadisticas");
	});

	//Atras en reportes
	$("#admin_volver_reportes").click(function () {
		redirect(baseURL + "panelAdmin");
	});
	//Ver organizaciones
	$("#admin_organizaciones").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones");
	});
	$("#admin_ver_org_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones");
	});
	$("#admin_panel_org_inscritas_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones");
	});

	$("#admin_enproceso_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones");
	});
	$(".admin_volver_org").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones");
	});
	$("#admin_contacto_volver").click(function () {
		redirect(baseURL + "panelAdmin");
	});
	$("#admin_volver_opciones").click(function () {
		redirect(baseURL + "panelAdmin");
	});
	$("#datos_abiertos").click(function () {
		redirect(baseURL + "panelAdmin/socrata");
	});
	// Volver organizaciones
	$("#admin_volver").click(function () {
		redirect(baseURL + "panelAdmin");
	});
	$(".admin_volver").click(function () {
		redirect(baseURL + "panelAdmin");
	});
	$("#admin_asignar_org").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/asignar");
	});
	$("#admin_organizaciones_inscritas").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/inscritas");
	});
	$("#admin_ver_inscritas_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/inscritas");
	});
	$("#admin_organizaciones_enproceso").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/en_Proceso");
	});
	$("#admin_ver_finalizadas_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/finalizadas");
	});
	$("#admin_ver_observaciones_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/observaciones");
	});
	$("#admin_organizaciones_finalizadas").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/finalizadas");
	});
	$("#admin_organizaciones_observaciones").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/observaciones");
	});
	$("#admin_camaracomercio").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/camaraComercio");
	});
	$("#admin_resoluciones").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/resoluciones");
	});
	$("#admin_estadoorg").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/estadoOrganizaciones");
	});
	$("#admin_contacto").click(function () {
		redirect(baseURL + "panelAdmin/contacto");
	});
	$("#admin_opciones_sis").click(function () {
		redirect(baseURL + "panelAdmin/opciones");
	});
	$("#admin_historico").click(function () {
		redirect(baseURL + "panelAdmin/historico");
	});
	$("#admin_informeActividades").click(function () {
		redirect(baseURL + "panelAdmin/informes");
	});
	$("#volverInforme").click(function () {
		redirect(baseURL + "panelAdmin/informes");
	});
	$(".volverReporte").click(function () {
		redirect(baseURL + "panelAdmin/reportes");
	});
	$("#reportes_ver_asistentes").click(function () {
		redirect(baseURL + "panelAdmin/reportes/asistentes");
	});
	$("#reporte_org_acreditadas").click(function () {
		redirect(baseURL + "panelAdmin/reportes/acreditadas");
	});
	$("#reporte_org_acreditadasSin").click(function () {
		redirect(baseURL + "panelAdmin/reportes/acreditadasSin");
	});
	$("#reporte_org_historico").click(function () {
		redirect(baseURL + "panelAdmin/reportes/historico");
	});
	$("#reporte_doc_habi").click(function () {
		redirect(baseURL + "panelAdmin/reportes/docentesHabilitados");
	});
	$("#reporte_reg_tele").click(function () {
		redirect(baseURL + "panelAdmin/reportes/registroTelefonico");
	});
	$("#admin_verorganizaciones_docentes").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/docentes");
	});
	$("#volver_docentes_organizaciones").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/docentes");
	});
	$("#admin_seguimiento").click(function () {
		redirect(baseURL + "panelAdmin/seguimiento");
	});

	$("#guardar_org_historica").on("click", function () {
		//if($("#formulario_actualizar_imagen").valid()){
		$personeria = "-"; //$("#personeria").val();
		$nombresSeries = $("#nombresSeries").val();
		$regional = $("#regional").val();
		$fechaExtremaInicial = $("#fechaExtremaInicial").val();
		$fechaExtremaFinal = $("#fechaExtremaFinal").val();
		$caja = $("#caja").val();
		$carpeta = $("#carpeta").val();
		$tomo = $("#tomo").val();
		$otro = $("#otro").val();
		$numeroFolios = $("#numeroFolios").val();
		$soporte = $("#soporte").val();
		$observaciones = $("#observaciones").val();
		$organizacion = $("#organizacion").val();
		$nit = $("#nit").val();
		$sigla = $("#sigla").val();
		$nombre = $("#nombre").val();
		$nombre_s = $("#nombre_s").val();
		$apellido = $("#apellido").val();
		$apellido_s = $("#apellido_s").val();
		$correo_electronico = $("#correo_electronico").val();
		$correo_electronico_rep_legal = $("#correo_electronico_rep_legal").val();
		$hist_fech_inicio = $("#hist_fech_inicio").val();
		$hist_fech_fin = $("#hist_fech_fin").val();
		$hist_anos = $("#hist_anos").val();
		$hist_num_res = $("#hist_num_res").val();

		var file_data = $("#resolucion").prop("files")[0];
		$id_organizacion = $("#id_org_ver_form").attr("data-id-org");
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("personeria", $personeria);
		form_data.append("nombresSeries", $nombresSeries);
		form_data.append("regional", $regional);
		form_data.append("fechaExtremaInicial", $fechaExtremaInicial);
		form_data.append("fechaExtremaFinal", $fechaExtremaFinal);
		form_data.append("caja", $caja);
		form_data.append("carpeta", $carpeta);
		form_data.append("tomo", $tomo);
		form_data.append("otro", $otro);
		form_data.append("numeroFolios", $numeroFolios);
		form_data.append("soporte", $soporte);
		form_data.append("observaciones", $observaciones);
		form_data.append("organizacion", $organizacion);
		form_data.append("nit", $nit);
		form_data.append("sigla", $sigla);
		form_data.append("nombre", $nombre);
		form_data.append("nombre_s", $nombre_s);
		form_data.append("apellido", $apellido);
		form_data.append("apellido_s", $apellido_s);
		form_data.append("correo_electronico", $correo_electronico);
		form_data.append(
			"correo_electronico_rep_legal",
			$correo_electronico_rep_legal
		);
		form_data.append("hist_fech_inicio", $hist_fech_inicio);
		form_data.append("hist_fech_fin", $hist_fech_fin);
		form_data.append("hist_anos", $hist_anos);
		form_data.append("hist_num_res", $hist_num_res);

		$.ajax({
			url: baseURL + "admin/guardar_organizacionHistorial",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Espere ingresando organización historica...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("historico");
				}, 3000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
		//}
	});

	$("#actualizar_hist_org").on("click", function () {
		//if($("#formulario_actualizar_imagen").valid()){
		$id_organizacion = $("#data_hist_org_ver").attr("data-id-org");
		$id_historial = $("#data_hist_org_ver").attr("data-id-hist");
		$personeria = "-"; //$("#ver_hist_perso").val();
		$nombresSeries = $("#ver_hist_nombres_ser").val();
		$regional = $("#ver_hist_regional").val();
		$fechaExtremaInicial = $("#ver_hist_fech_ei").val();
		$fechaExtremaFinal = $("#ver_hist_fech_ef").val();
		$caja = $("#ver_hist_caja").val();
		$carpeta = $("#ver_hist_carpeta").val();
		$tomo = $("#ver_hist_tomo").val();
		$otro = $("#ver_hist_otro").val();
		$numeroFolios = $("#ver_hist_folios").val();
		$soporte = $("#ver_hist_soporte").val();
		$observaciones = $("#ver_hist_obser").val();

		$organizacion = $("#nombre_org_hist").val();
		$nit = $("#nit_org_hist").val();
		$sigla = $("#sigla_org_hist").val();
		$nombre_completo = $("#rep_org_hist").val().split(" ");
		$nombre = $nombre_completo[0];
		$nombre_s = $nombre_completo[1];
		$apellido = $nombre_completo[2];
		$apellido_s = $nombre_completo[3];
		$correo_electronico = $("#direccion_org_org_hist").val();
		$correo_electronico_rep_legal = $("#direccion_rep_org_hist").val();

		$hist_fech_inicio = $("#res_fech_inicio").val();
		$hist_fech_fin = $("#res_fech_fin").val();
		$hist_anos = $("#res_anos").val();
		$res_num_res = $("#res_num_res").val();
		$ver_hist_tipo_org = $("#ver_hist_tipo_org").val();

		if ($ver_hist_tipo_org == "" || $ver_hist_tipo_org == null) {
			var file_data = $("#ver_org_resolucion").prop("files")[0];
		} else {
			var file_data = $("#ver_org_resolucion_otro").prop("files")[0];
		}

		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("id_organizacion", $id_organizacion);
		form_data.append("id_historial", $id_historial);
		form_data.append("personeria", $personeria);
		form_data.append("nombresSeries", $nombresSeries);
		form_data.append("regional", $regional);
		form_data.append("fechaExtremaInicial", $fechaExtremaInicial);
		form_data.append("fechaExtremaFinal", $fechaExtremaFinal);
		form_data.append("caja", $caja);
		form_data.append("carpeta", $carpeta);
		form_data.append("tomo", $tomo);
		form_data.append("otro", $otro);
		form_data.append("numeroFolios", $numeroFolios);
		form_data.append("soporte", $soporte);
		form_data.append("observaciones", $observaciones);
		form_data.append("organizacion", $organizacion);
		form_data.append("nit", $nit);
		form_data.append("sigla", $sigla);
		form_data.append("nombre", $nombre);
		form_data.append("nombre_s", $nombre_s);
		form_data.append("apellido", $apellido);
		form_data.append("apellido_s", $apellido_s);
		form_data.append("correo_electronico", $correo_electronico);
		form_data.append(
			"correo_electronico_rep_legal",
			$correo_electronico_rep_legal
		);
		form_data.append("hist_fech_inicio", $hist_fech_inicio);
		form_data.append("hist_fech_fin", $hist_fech_fin);
		form_data.append("hist_anos", $hist_anos);
		form_data.append("res_num_res", $res_num_res);
		form_data.append("ver_hist_tipo_org", $ver_hist_tipo_org);

		$.ajax({
			url: baseURL + "admin/actualizar_organizacionHistorial",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Espere actualizando organización...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("historico");
				}, 3000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
		//}
	});

	$(".ver_organizacion_inscrita").click(function () {
		var $id_org = $(this).attr("data-organizacion");
		var data = {
			id_organizacion: $id_org,
		};
		$.ajax({
			url: baseURL + "admin/cargar_datosBasicosOrganizacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#admin_panel_org_inscritas").slideUp();
				$("#datos_organizaciones_inscritas").slideDown();
				$("#datos_organizaciones_inscritas>#datos_basicos>span").empty();
				$("#tabla_actividad_inscritas>tbody#tbody_actividad").empty();
				$("#tabla_actividad_inscritas>tbody#tbody_actividad").html("");
				$("#inscritas_nombre_organizacion").append(
					"<p>" + response.data_organizacion.nombreOrganizacion + "</p>"
				);
				$("#inscritas_nit_organizacion").append(
					"<p>" + response.data_organizacion.numNIT + "</p>"
				);
				$("#inscritas_sigla_organizacion").append(
					"<p>" + response.data_organizacion.sigla + "</p>"
				);
				$("#inscritas_nombreRepLegal_organizacion").append(
					"<p>" +
						response.data_organizacion.primerNombreRepLegal +
						" " +
						response.data_organizacion.segundoNombreRepLegal +
						" " +
						response.data_organizacion.primerApellidoRepLegal +
						" " +
						response.data_organizacion.segundoApellidoRepLegal +
						"</p>"
				);
				$(
					"#inscritas_direccionCorreoElectronicoOrganizacion_organizacion"
				).append(
					"<p>" +
						response.data_organizacion.direccionCorreoElectronicoOrganizacion +
						"</p>"
				);
				$("#inscritas_direccionCorreoElectronicoRepLegal_organizacion").append(
					"<p>" +
						response.data_organizacion.direccionCorreoElectronicoRepLegal +
						"</p>"
				);
				$("#inscritas_estadoActual_organizacion").append(
					"<p>" + response.estado.nombre + "</p>"
				);
				$("#inscritas_estadoAnterior_organizacion").append(
					"<p>" + response.estado.estadoAnterior + "</p>"
				);
				$("#inscritas_usuario").append(
					"<p>" + response.usuario.usuario + "</p>"
				);
				$("#inscritas_imagenOrganizacion_organizacion").attr(
					"src",
					baseURL +
						"uploads/logosOrganizaciones/" +
						response.data_organizacion.imagenOrganizacion
				);
				$("#verTodaInformacion").attr(
					"data-idOrg",
					response.data_organizacion.id_organizacion
				);
				$("#tbody_actividad>.odd").remove();
				for (var i = 0; i < response.registro_actividad.length; i++) {
					$("#tbody_actividad").append("<tr id=" + i + ">");
					$("#tbody_actividad>tr#" + i + "").append(
						"<td>" + response.registro_actividad[i].accion + "</td>"
					);
					$("#tbody_actividad>tr#" + i + "").append(
						"<td>" + response.registro_actividad[i].fecha + "</td>"
					);
					$("#tbody_actividad>tr#" + i + "").append(
						"<td>" + response.registro_actividad[i].usuario_ip + "</td>"
					);
					$("#tbody_actividad>tr#" + i + "").append(
						"<td>" + response.registro_actividad[i].user_agent + "</td>"
					);
					$("#tbody_actividad").append("</tr>");
				}
				paging("tabla_actividad_inscritas");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	var data_orgFinalizada = [];

	/*
	---------------------------------------------
		Cargar información de la org en inscritas
		------------------------------------------------
	*/
	$("#verTodaInformacion").click(function () {
		$idOrg = $(this).attr("data-idOrg");
		redirect(baseURL + "panelAdmin/organizaciones/informacion?id=" + $idOrg);
	});

	if ($("#cInfO").html() != undefined) {
		$jsonInformacion = $.parseJSON($("#cInfO").html());

		if ($jsonInformacion.organizaciones != "") {
			$id_org = $jsonInformacion.organizaciones["0"].id_organizacion;
			console.log($jsonInformacion.informacionGeneral);
			if ($jsonInformacion.informacionGeneral.length == 0) {
				redirect(baseURL + "panelAdmin/organizaciones/inscritas#info");
			}
			$("#hist_org_obs").attr(
				"data-id-org",
				$jsonInformacion.organizaciones["0"].id_organizacion
			);
			data_orgFinalizada.push($jsonInformacion);

			/** Solicitud **/
			for (var i = 0; i < $jsonInformacion.solicitudes.length; i++) {
				$("#fechaSol").html($jsonInformacion.solicitudes[i].fecha);
				$("#idSol").html($jsonInformacion.tipoSolicitud[i].idSolicitud);
				$("#tipoSol").html($jsonInformacion.tipoSolicitud[i].tipoSolicitud);
				$("#modSol").html($jsonInformacion.tipoSolicitud[i].modalidadSolicitud);
				$("#motSol").html($jsonInformacion.tipoSolicitud[i].motivoSolicitud);
				$("#numeroSol").html($jsonInformacion.solicitudes[i].numeroSolicitudes);
				$("#revFechaFin").html(
					$jsonInformacion.estadoOrganizaciones[i].fechaFinalizado
				);
				$("#revSol").html($jsonInformacion.solicitudes[i].numeroRevisiones);
				$("#revFechaSol").html(
					$jsonInformacion.solicitudes[i].fechaUltimaRevision
				);
				$("#estOrg").html($jsonInformacion.estadoOrganizaciones[i].nombre);
				$("#camaraComercio_org").attr(
					"href",
					baseURL +
						"uploads/camaraComercio/" +
						$jsonInformacion.organizaciones[i].camaraComercio
				);
				$("#nOrgSol").html(
					$jsonInformacion.organizaciones[i].nombreOrganizacion
				);
				$("#sOrgSol").html($jsonInformacion.organizaciones[i].sigla);
				$("#nitOrgSol").html($jsonInformacion.organizaciones[i].numNIT);
				$("#nrOrgSol").html(
					$jsonInformacion.organizaciones[i].primerNombreRepLegal +
						" " +
						$jsonInformacion.organizaciones[i].primerApellidoRepLegal
				);
				$("#cOrgSol").html(
					$jsonInformacion.organizaciones[i]
						.direccionCorreoElectronicoOrganizacion
				);
			}
			/** Formulario 1 **/
			for (var i = 0; i < $jsonInformacion.informacionGeneral.length; i++) {
				$("#actuacionOrganizacion").html($jsonInformacion.informacionGeneral[i].actuacionOrganizacion);
				$("#direccionOrganizacion").html($jsonInformacion.informacionGeneral[i].direccionOrganizacion);
				$("#extension").html($jsonInformacion.informacionGeneral[i].extension);
				$("#fax").html($jsonInformacion.informacionGeneral[i].fax);
				$("#fines").html($jsonInformacion.informacionGeneral[i].fines);
				$("#mision").html($jsonInformacion.informacionGeneral[i].mision);
				$("#nomDepartamentoUbicacion").html($jsonInformacion.informacionGeneral[i].nomDepartamentoUbicacion);
				$("#nomMunicipioNacional").html($jsonInformacion.informacionGeneral[i].nomMunicipioNacional);
				$("#numCedulaCiudadaniaPersona").html($jsonInformacion.informacionGeneral[i].numCedulaCiudadaniaPersona);
				$("#objetoSocialEstatutos").html($jsonInformacion.informacionGeneral[i].objetoSocialEstatutos);
				$("#otros").html($jsonInformacion.informacionGeneral[i].otros);
				$("#portafolio").html($jsonInformacion.informacionGeneral[i].portafolio);
				$("#presentacionInstitucional").html($jsonInformacion.informacionGeneral[i].presentacionInstitucional);
				$("#principios").html($jsonInformacion.informacionGeneral[i].principios);
				$("#tipoEducacion").html($jsonInformacion.informacionGeneral[i].tipoEducacion);
				$("#tipoOrganizacion").html($jsonInformacion.informacionGeneral[i].tipoOrganizacion);
				$("#urlOrganizacion").html($jsonInformacion.informacionGeneral[i].urlOrganizacion);
				$("#vision").html($jsonInformacion.informacionGeneral[i].vision);
				//___
				$("#actuacionOrganizacion").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].actuacionOrganizacion);
				$("#direccionOrganizacion").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].direccionOrganizacion);
				$("#extension").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].extension);
				$("#fax").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].fax);
				$("#fines").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].fines);
				$("#mision").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].mision);
				$("#nomDepartamentoUbicacion").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].nomDepartamentoUbicacion);
				$("#nomMunicipioNacional").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].nomMunicipioNacional);
				$("#numCedulaCiudadaniaPersona").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].numCedulaCiudadaniaPersona);
				$("#objetoSocialEstatutos").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].objetoSocialEstatutos);
				$("#otros").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].otros);
				$("#portafolio").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].portafolio);
				$("#presentacionInstitucional").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].presentacionInstitucional);
				$("#principios").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].principios);
				$("#tipoEducacion").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].tipoEducacion);
				$("#tipoOrganizacion").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].tipoOrganizacion);
				$("#urlOrganizacion").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].urlOrganizacion);
				$("#vision").parent().next().attr("data-text", $jsonInformacion.informacionGeneral[i].vision);
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "1") {
						if (data_orgFinalizada["0"].archivos[$a].tipo == "carta") {
							$carpeta = baseURL + "uploads/cartaRep/";
						} else if (
							data_orgFinalizada["0"].archivos[$a].tipo == "certificaciones"
						) {
							$carpeta = baseURL + "uploads/certificaciones/";
						} else if (data_orgFinalizada["0"].archivos[$a].tipo == "lugar") {
							$carpeta = baseURL + "uploads/lugarAtencion/";
						}

						$("#archivos_informacionGeneral").append(
							"<li class='listaArchivos'><a href='" + $carpeta +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"' target='_blank'>" +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"</a></li>"
						);
					}
				}
			}
			/** Formulario 2 **/
			for (var i = 0; i < $jsonInformacion.documentacionLegal.length; i++) {
				if ($jsonInformacion.documentacionLegal[i].registroEducativo != "No Tiene") {
					$("#departamentoResolucion").html($jsonInformacion.documentacionLegal[i].departamentoResolucion);
					$("#entidadRegistro").html($jsonInformacion.documentacionLegal[i].entidadRegistro);
					$("#fechaResolucion").html($jsonInformacion.documentacionLegal[i].fechaResolucion);
					$("#municipioResolucion").html($jsonInformacion.documentacionLegal[i].municipioResolucion);
					$("#numeroResolucion").html($jsonInformacion.documentacionLegal[i].numeroResolucion);
					$("#registroEducativo").html($jsonInformacion.documentacionLegal[i].registroEducativo);

					//__
					$("#departamentoResolucion")
						.parent()
						.next()
						.attr(
							"data-text",
							$jsonInformacion.documentacionLegal[i].departamentoResolucion
						);
					$("#entidadRegistro")
						.parent()
						.next()
						.attr(
							"data-text",
							$jsonInformacion.documentacionLegal[i].entidadRegistro
						);
					$("#fechaResolucion")
						.parent()
						.next()
						.attr(
							"data-text",
							$jsonInformacion.documentacionLegal[i].fechaResolucion
						);
					$("#municipioResolucion")
						.parent()
						.next()
						.attr(
							"data-text",
							$jsonInformacion.documentacionLegal[i].municipioResolucion
						);
					$("#numeroResolucion")
						.parent()
						.next()
						.attr(
							"data-text",
							$jsonInformacion.documentacionLegal[i].numeroResolucion
						);
					$("#registroEducativo")
						.parent()
						.next()
						.attr(
							"data-text",
							$jsonInformacion.documentacionLegal[i].registroEducativo
						);
					for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
						if (data_orgFinalizada["0"].archivos[$a].id_formulario == "2") {
							if (data_orgFinalizada["0"].archivos[$a].tipo == "registroEdu") {
								$carpeta = baseURL + "uploads/registrosEducativos/";
							}

							$("#archivos_documentacionLegal").append(
								"<li class='listaArchivos'><a href='" +
									$carpeta +
									data_orgFinalizada["0"].archivos[$a].nombre +
									"' target='_blank'>" +
									data_orgFinalizada["0"].archivos[$a].nombre +
									"</a></li>"
							);
						}
					}
					/*$("#archivos_documentacionLegal").append('<div class="form-group" id="documentacionLegal-observacionesGeneral'+i+'">');
						$("#archivos_documentacionLegal>div").append("<h4>Observaciones de archivos:</h4>");
					$("#archivos_documentacionLegal").append('</div>');*/
				} else {
					$("#documentacion>.form-group").empty();

					$("#documentacion>#ll").append(
						'<div class="col-md-12" id="col' + i + '">'
					);
					$("#documentacion>#ll>#col" + i + "").append(
						"<p>Ningún registro educativo.</p>"
					);
					$("#documentacion>#ll").append("</div>");
				}
			}
			/** Formulario 3 **/
			if ($jsonInformacion.registroEducativoProgramas.length > 0) {
				for (
					var i = 0;
					i < $jsonInformacion.registroEducativoProgramas.length;
					i++
				) {
					$cols =
						12 / parseFloat($jsonInformacion.registroEducativoProgramas.length);
					$("#registroEducativoProgramas").append(
						'<div class="col-md-' + $cols + '" id="col' + i + '">'
					);

					$("#registroEducativoProgramas>#col" + i + "").append(
						'<div class="form-group" id="registroEducativoProgramas-tipoResolucion' +
							$cols +
							i +
							'">'
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-tipoResolucion" +
							$cols +
							i +
							""
					).append(
						"<p>Tipo de resolucion: </p><label class='tipoLeer'>" +
							$jsonInformacion.registroEducativoProgramas[i].tipoEducacion +
							"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-tipoResolucion" +
							$cols +
							i +
							""
					).append("</div>");

					$("#registroEducativoProgramas>#col" + i + "").append(
						'<div class="form-group" id="registroEducativoProgramas-fechaResolucion' +
							i +
							'">'
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-fechaResolucion" +
							i +
							""
					).append(
						"<p>Fecha de la resolucion: </p><label class='tipoLeer'>" +
							$jsonInformacion.registroEducativoProgramas[i].fechaResolucion +
							"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-fechaResolucion" +
							i +
							""
					).append("</div>");

					$("#registroEducativoProgramas>#col" + i + "").append(
						'<div class="form-group" id="registroEducativoProgramas-numeroResolucion' +
							$cols +
							i +
							'">'
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-numeroResolucion" +
							$cols +
							i +
							""
					).append(
						"<p>Numero de la resolucion: </p><label class='tipoLeer'>" +
							$jsonInformacion.registroEducativoProgramas[i].numeroResolucion +
							"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-numeroResolucion" +
							$cols +
							i +
							""
					).append("</div>");

					$("#registroEducativoProgramas>#col" + i + "").append(
						'<div class="form-group" id="registroEducativoProgramas-nombrePrograma' +
							$cols +
							i +
							'">'
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-nombrePrograma" +
							$cols +
							i +
							""
					).append(
						"<p>Nombre del programa: </p><label class='tipoLeer'>" +
							$jsonInformacion.registroEducativoProgramas[i].nombrePrograma +
							"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-nombrePrograma" +
							$cols +
							i +
							""
					).append("</div>");

					$("#registroEducativoProgramas>#col" + i + "").append(
						'<div class="form-group" id="registroEducativoProgramas-objetoResolucion' +
							$cols +
							i +
							'">'
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-objetoResolucion" +
							$cols +
							i +
							""
					).append(
						"<p>Objeto de la resolucion: </p><label class='tipoLeer'>" +
							$jsonInformacion.registroEducativoProgramas[i].objetoResolucion +
							"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-objetoResolucion" +
							$cols +
							i +
							""
					).append("</div>");

					$("#registroEducativoProgramas>#col" + i + "").append(
						'<div class="form-group" id="registroEducativoProgramas-entidadResolucion' +
							$cols +
							i +
							'">'
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-entidadResolucion" +
							$cols +
							i +
							""
					).append(
						"<p>Entidad resolucion: </p><label class='tipoLeer'>" +
							$jsonInformacion.registroEducativoProgramas[i].entidadResolucion +
							"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
							i +
							">#registroEducativoProgramas-entidadResolucion" +
							$cols +
							i +
							""
					).append("</div>");

					$("#registroEducativoProgramas").append("</div>");
				}
			} else {
				$("#registroEducativoProgramas").append(
					'<div class="col-md-12" id="col' + i + '">'
				);
				$("#registroEducativoProgramas>#col" + i + "").append(
					"<p>Ningún registro educativo.</p>"
				);

				$("#registroEducativoProgramas>#col" + i + "").append(
					'<div class="clearfix"></div>'
				);
				$("#registroEducativoProgramas>#col" + i + "").append("<hr/>");

				$("#registroEducativoProgramas").append("</div>");
			}

			/** Formulario 4 **/
			for (var i = 0; i < $jsonInformacion.antecedentesAcademicos.length; i++) {
				$cols = 12 / parseFloat($jsonInformacion.antecedentesAcademicos.length);
				if ($cols < 3) {
					$cols = 4;
				}

				$("#antecedentesAcademicos").append(
					'<div class="col-md-' + $cols + '" id="col' + i + '">'
				);

				$("#antecedentesAcademicos>#col" + i + "").append(
					"<h3>Antecendente # " + (i + 1) + "</h3>"
				);

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-descripcionProceso' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-descripcionProceso" +
						$cols +
						i +
						""
				).append(
					"<p>Descripcion del proceso: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].descripcionProceso +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-descripcionProceso" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-justificacion' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-justificacion" +
						$cols +
						i +
						""
				).append(
					"<p>Justificacion: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].justificacion +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-justificacion" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-objetivos' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-objetivos" +
						$cols +
						i +
						""
				).append(
					"<p>Objetivos: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].objetivos +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-objetivos" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-metodologia' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-metodologia" +
						$cols +
						i +
						""
				).append(
					"<p>Metodologia: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].metodologia +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-metodologia" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-materialDidactico' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-materialDidactico" +
						$cols +
						i +
						""
				).append(
					"<p>Material didactico: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].materialDidactico +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-materialDidactico" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-bilbiografia' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-bilbiografia" +
						$cols +
						i +
						""
				).append(
					"<p>Bibliografia: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].bibliografia +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-bilbiografia" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="form-group" id="antecedentesAcademicos-duracionCurso' +
						$cols +
						i +
						'">'
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-duracionCurso" +
						$cols +
						i +
						""
				).append(
					"<p>Duracion del curso: </p><label class='tipoLeer'>" +
						$jsonInformacion.antecedentesAcademicos[i].duracionCurso +
						"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
						i +
						">#antecedentesAcademicos-duracionCurso" +
						$cols +
						i +
						""
				).append("</div>");

				$("#antecedentesAcademicos>#col" + i + "").append(
					'<div class="clearfix"></div>'
				);
				$("#antecedentesAcademicos>#col" + i + "").append("<hr/>");
				$("#antecedentesAcademicos").append("</div>");
			}
			/** Formulario 5 **/
			for (var i = 0; i < $jsonInformacion.jornadasActualizacion.length; i++) {
				if ($jsonInformacion.jornadasActualizacion[i].numeroPersonas != 0) {
					console.log(
						"j " + parseFloat($jsonInformacion.jornadasActualizacion.length)
					);
					$cols =
						12 / parseFloat($jsonInformacion.jornadasActualizacion.length);
					$("#jornadasActualizacion").append(
						'<div class="col-md-' + $cols + '" id="col' + i + '">'
					);

					$("#jornadasActualizacion>#col" + i + "").append(
						'<div class="form-group" id="jornadasActualizacion-fechaAsistentes' +
							i +
							'">'
					);
					$(
						"#jornadasActualizacion>#col" +
							i +
							">#jornadasActualizacion-fechaAsistentes" +
							i +
							""
					).append(
						"<p>Fecha de asistencia: </p><label class='tipoLeer'>" +
							$jsonInformacion.jornadasActualizacion[i].fechaAsistencia +
							"</label>"
					);
					$(
						"#jornadasActualizacion>#col" +
							i +
							">#jornadasActualizacion-fechaAsistentes" +
							i +
							""
					).append("</div>");

					$("#jornadasActualizacion>#col" + i + "").append(
						'<div class="form-group" id="jornadasActualizacion-numeroPersonas' +
							$cols +
							i +
							'">'
					);
					$(
						"#jornadasActualizacion>#col" +
							i +
							">#jornadasActualizacion-numeroPersonas" +
							$cols +
							i +
							""
					).append(
						"<p>Numero de personas: </p><label class='tipoLeer'>" +
							$jsonInformacion.jornadasActualizacion[i].numeroPersonas +
							"</label>"
					);
					$(
						"#jornadasActualizacion>#col" +
							i +
							">#jornadasActualizacion-numeroPersonas" +
							$cols +
							i +
							""
					).append("</div>");

					$("#jornadasActualizacion").append("</div>");
					$("#jornadasActualizacion").append(
						'<div class="col-md-12" id="archivos_jornadasActualizacion">'
					);
					$("#jornadasActualizacion>#archivos_jornadasActualizacion").append(
						"<p>Archivos:</p>"
					);
					for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
						if (data_orgFinalizada["0"].archivos[$a].id_formulario == "5") {
							if (data_orgFinalizada["0"].archivos[$a].tipo == "jornadaAct") {
								$carpeta = baseURL + "uploads/jornadas/";
							}

							$(
								"#jornadasActualizacion>#archivos_jornadasActualizacion"
							).append(
								"<li class='listaArchivos'><a href='" +
									$carpeta +
									data_orgFinalizada["0"].archivos[$a].nombre +
									"' target='_blank'>" +
									data_orgFinalizada["0"].archivos[$a].nombre +
									"</a></li>"
							);
						}
					}
					$("#archivos_jornadasActualizacion").append(
						'<div class="form-group" id="jornadasActualizacion-observacionesGeneral' +
							i +
							'">'
					);
					$("#archivos_jornadasActualizacion>div").append(
						"<p>Observaciones de archivos:</h4>"
					);
					$("#archivos_jornadasActualizacion").append("</div>");
					$("#jornadasActualizacion").append("</div>");
				} else {
					$cols = 12;
					$("#jornadasActualizacion").append(
						'<div class="col-md-' + $cols + '" id="col' + i + '">'
					);
					$("#jornadasActualizacion>#col" + i + "").append(
						"<p>No ha asistido a ninguna jornada.</p>"
					);
					$("#jornadasActualizacion").append("</div>");

					$("#jornadasActualizacion").append(
						'<div class="col-md-12" id="archivos_jornadasActualizacion">'
					);
					$("#jornadasActualizacion>#archivos_jornadasActualizacion").append(
						"<p>Archivos:</p>"
					);

					for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
						if (data_orgFinalizada["0"].archivos[$a].id_formulario == "5") {
							if (data_orgFinalizada["0"].archivos[$a].tipo == "jornadaAct") {
								$carpeta = baseURL + "uploads/jornadas/";
							}

							$(
								"#jornadasActualizacion>#archivos_jornadasActualizacion"
							).append(
								"<li class='listaArchivos'><a href='" +
									$carpeta +
									data_orgFinalizada["0"].archivos[$a].nombre +
									"' target='_blank'>" +
									data_orgFinalizada["0"].archivos[$a].nombre +
									"</a></li>"
							);
						}
					}

					$("#jornadasActualizacion>#archivos_jornadasActualizacion").append(
						'<div class="clearfix"></div>'
					);
					$("#jornadasActualizacion>#archivos_jornadasActualizacion").append(
						"<hr/>"
					);
				}
			}
			/** Formulario 6 **/
			for (var i = 0; i < $jsonInformacion.datosBasicosProgramas.length; i++) {
				$("#objetivosBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].objetivos
				);
				$("#metodologiaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].metodologia
				);
				$("#materialBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].materialDidactico
				);
				$("#bibliografiaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].bibliografia
				);
				$("#duracionBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].duracionCurso
				);
				$("#eticaValoresBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].eticaValoresPrincipios
				);
				$("#solidaridadBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].solidaridad
				);
				$("#economiaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].economia
				);
				$("#economiaSolidariaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].economiaSolidaria
				);
				$("#asosiatividadBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].asosiatividadEmprendimiento
				);
				$("#organizacionSolidariaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].organizacionSolidaria
				);
				$("#trabajoEquipoBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].trabajoEquipo
				);
				$("#educacionSolidariaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].educacionSolidaria
				);
				$("#responsabilidadSocialBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].responsabilidadSocial
				);
				$("#medioAmbienteBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].medioAmbiente
				);
				$("#contextoEconomicoBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].contextoEconomicoSocial
				);
				$("#necesidadesBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].necesidadesSerHumano
				);
				$("#porqueParaqueBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].porqueFomentar
				);
				$("#principiosValoresBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].principiosValoresFines
				);
				$("#marcoNormativoBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].marcoNormativo
				);
				$("#tiposOrganizacionesBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i]
						.tiposOrganizacionesEconomiaSolidaria
				);
				$("#antecedentesHistoricosBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].antecedentesHistoricos
				);
				$("#caracteristicasEconomicasBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].caracteristicasEconomicas
				);
				$("#estructuraInternaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].estructuraInterna
				);
				$("#marcoJuridicoBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].marcoJuridicoAplicable
				);
				$("#fundamentosAdministrativosBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].fundamentosAdministrativos
				);
				$("#estatutosReglamentosBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i]
						.orientacionElaboracionEstatutos
				);
				$("#uaeosBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].unidadAdministrativa
				);
				$("#superintendenciaBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].superintendencia
				);
				$("#fondoGarantiasBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].fondoGarantias
				);
				$("#consejoBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].consejoNacional
				);
				$("#fondoNacionalBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].fondoNacional
				);
				$("#mesasRegionalesBasicosProgramas").html(
					$jsonInformacion.datosBasicosProgramas[i].mesasRegionales
				);
				//___
				$("#objetivosBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].objetivos
					);
				$("#metodologiaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].metodologia
					);
				$("#materialBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].materialDidactico
					);
				$("#bibliografiaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].bibliografia
					);
				$("#duracionBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].duracionCurso
					);
				$("#eticaValoresBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].eticaValoresPrincipios
					);
				$("#solidaridadBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].solidaridad
					);
				$("#economiaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].economia
					);
				$("#economiaSolidariaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].economiaSolidaria
					);
				$("#asosiatividadBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i]
							.asosiatividadEmprendimiento
					);
				$("#organizacionSolidariaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].organizacionSolidaria
					);
				$("#trabajoEquipoBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].trabajoEquipo
					);
				$("#educacionSolidariaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].educacionSolidaria
					);
				$("#responsabilidadSocialBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].responsabilidadSocial
					);
				$("#medioAmbienteBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].medioAmbiente
					);
				$("#contextoEconomicoBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].contextoEconomicoSocial
					);
				$("#necesidadesBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].necesidadesSerHumano
					);
				$("#porqueParaqueBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].porqueFomentar
					);
				$("#principiosValoresBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].principiosValoresFines
					);
				$("#marcoNormativoBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].marcoNormativo
					);
				$("#tiposOrganizacionesBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i]
							.tiposOrganizacionesEconomiaSolidaria
					);
				$("#antecedentesHistoricosBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].antecedentesHistoricos
					);
				$("#caracteristicasEconomicasBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].caracteristicasEconomicas
					);
				$("#estructuraInternaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].estructuraInterna
					);
				$("#marcoJuridicoBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].marcoJuridicoAplicable
					);
				$("#fundamentosAdministrativosBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].fundamentosAdministrativos
					);
				$("#estatutosReglamentosBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i]
							.orientacionElaboracionEstatutos
					);
				$("#uaeosBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].unidadAdministrativa
					);
				$("#superintendenciaBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].superintendencia
					);
				$("#fondoGarantiasBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].fondoGarantias
					);
				$("#consejoBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].consejoNacional
					);
				$("#fondoNacionalBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].fondoNacional
					);
				$("#mesasRegionalesBasicosProgramas")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.datosBasicosProgramas[i].mesasRegionales
					);

				$("#datosBasicosProgramas").append(
					'<div class="col-md-12" id="archivos_datosBasicosProgramas">'
				);
				$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append(
					"<p>Archivos:</p>"
				);
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "6") {
						if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"materialDidacticoProgBasicos"
						) {
							$carpeta = baseURL + "uploads/materialDidacticoProgBasicos/";
						}

						$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append(
							"<li class='listaArchivos'><a href='" +
								$carpeta +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"' target='_blank'>" +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"</a></li>"
						);
					}
				}
				$("#datosBasicosProgramas").append("</div>");
				$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append(
					'<div class="clearfix"></div>'
				);
				$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append(
					"<hr/>"
				);

				/*$cols = 12/(parseFloat($jsonInformacion.datosBasicosProgramas.length));
				$("#datosBasicosProgramas").append('<div class="col-md-'+$cols+'" id="col'+i+'">');

				$("#datosBasicosProgramas>#col"+i+"").append('<div class="form-group" id="datosBasicosProgramas-bibliografia'+$cols+i+'">');
					$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-bibliografia"+$cols+i+"").append("<p>Bibliografía: </p><label class='tipoLeer'>"+$jsonInformacion.datosBasicosProgramas[i].bibliografia+"</label>");
				$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-bibliografia"+$cols+i+"").append('</div>');

				$("#datosBasicosProgramas>#col"+i+"").append('<div class="form-group" id="datosBasicosProgramas-duracionCurso'+$cols+i+'">');
					$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-duracionCurso"+$cols+i+"").append("<p>Duracion del curso: </p><label class='tipoLeer'>"+$jsonInformacion.datosBasicosProgramas[i].duracionCurso+"</label>");
				$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-duracionCurso"+$cols+i+"").append('</div>');

				$("#datosBasicosProgramas>#col"+i+"").append('<div class="form-group" id="datosBasicosProgramas-materialDidactico'+$cols+i+'">');
					$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-materialDidactico"+$cols+i+"").append("<p>Material didactico: </p><label class='tipoLeer'>"+$jsonInformacion.datosBasicosProgramas[i].materialDidactico+"</label>");
				$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-materialDidactico"+$cols+i+"").append('</div>');

				$("#datosBasicosProgramas>#col"+i+"").append('<div class="form-group" id="datosBasicosProgramas-metodologia'+$cols+i+'">');
					$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-metodologia"+$cols+i+"").append("<p>Metodología: </p><label class='tipoLeer'>"+$jsonInformacion.datosBasicosProgramas[i].metodologia+"</label>");
				$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-metodologia"+$cols+i+"").append('</div>');

				$("#datosBasicosProgramas>#col"+i+"").append('<div class="form-group" id="datosBasicosProgramas-objetivos'+$cols+i+'">');
					$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-objetivos"+$cols+i+"").append("<p>Objetivos: </p><label class='tipoLeer'>"+$jsonInformacion.datosBasicosProgramas[i].objetivos+"</label>");
				$("#datosBasicosProgramas>#col"+i+">#datosBasicosProgramas-objetivos"+$cols+i+"").append('</div>');

				$("#datosBasicosProgramas").append('</div>');
				$("#datosBasicosProgramas").append('<div class="col-md-12" id="archivos_datosBasicosProgramas">');
				$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append("<p>Archivos:</p>");
				for($a = 0; $a < data_orgFinalizada['0'].archivos.length; $a++){
					if(data_orgFinalizada['0'].archivos[$a].id_formulario == "6"){
						if(data_orgFinalizada['0'].archivos[$a].tipo == "materialDidacticoProgBasicos"){
							$carpeta = baseURL+"uploads/materialDidacticoProgBasicos/";
						}

						$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append("<li class='listaArchivos'><a href='"+$carpeta+data_orgFinalizada['0'].archivos[$a].nombre+"' target='_blank'>"+data_orgFinalizada['0'].archivos[$a].nombre+"</a></li>");
					}
				}
				$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append('<div class="clearfix"></div>');
				$("#datosBasicosProgramas>#archivos_datosBasicosProgramas").append('<hr/>');
				$("#datosBasicosProgramas").append('</div>');*/
			}
			/** Formulario 7 **/
			for (var i = 0; i < $jsonInformacion.programasAvalEconomia.length; i++) {
				$("#objetivosProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].objetivos
				);
				$("#metodologiaProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].metodologia
				);
				$("#materialProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].materialDidactico
				);
				$("#bibliografiaProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].bibliografia
				);
				$("#duracionProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].duracionCurso
				);
				$("#antecedentesProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].antecedentesAspectos
				);
				$("#diferenciasProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].diferencias
				);
				$("#regulacionProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].regulacionJuridica
				);
				$("#desarrolloProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].desarrolloSocioempresarial
				);
				$("#legislacionProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].legislacionTributaria
				);
				$("#administracionProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].administracionTrabajo
				);
				$("#regimenesProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].regimenesTrabajo
				);
				$("#manejoProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].manejoSeguridad
				);
				$("#inspeccionProgramasAvalEconomia").html(
					$jsonInformacion.programasAvalEconomia[i].inspeccionVigilancia
				);
				//___
				$("#objetivosProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].objetivos
					);
				$("#metodologiaProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].metodologia
					);
				$("#materialProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].materialDidactico
					);
				$("#bibliografiaProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].bibliografia
					);
				$("#duracionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].duracionCurso
					);
				$("#antecedentesProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].antecedentesAspectos
					);
				$("#diferenciasProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].diferencias
					);
				$("#regulacionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].regulacionJuridica
					);
				$("#desarrolloProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].desarrolloSocioempresarial
					);
				$("#legislacionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].legislacionTributaria
					);
				$("#administracionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].administracionTrabajo
					);
				$("#regimenesProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].regimenesTrabajo
					);
				$("#manejoProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].manejoSeguridad
					);
				$("#inspeccionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						$jsonInformacion.programasAvalEconomia[i].inspeccionVigilancia
					);

				$("#programasAvalEconomia").append(
					'<div class="col-md-12" id="archivos_programasAvalEconomia">'
				);
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append(
					"<p>Archivos:</p>"
				);
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "7") {
						if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"materialDidacticoAvalEconomia"
						) {
							$carpeta = baseURL + "uploads/materialDidacticoAvalEconomia/";
						}

						$("#programasAvalEconomia>#archivos_programasAvalEconomia").append(
							"<li class='listaArchivos'><a href='" +
								$carpeta +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"' target='_blank'>" +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"</a></li>"
						);
					}
				}
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append(
					'<div class="clearfix"></div>'
				);
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append(
					"<hr/>"
				);
				$("#programasAvalEconomia").append("</div>");

				/*$cols = 12/(parseFloat($jsonInformacion.programasAvalEconomia.length));
				$("#programasAvalEconomia").append('<div class="col-md-'+$cols+'" id="col'+i+'">');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-bibliografia'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-bibliografia"+$cols+i+"").append("<p>Bibliografía: </p><label class='tipoLeer'>"+$jsonInformacion.programasAvalEconomia[i].bibliografia+"</label>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-bibliografia"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-duracionCurso'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-duracionCurso"+$cols+i+"").append("<p>Duración del curso: </p><label class='tipoLeer'>"+$jsonInformacion.programasAvalEconomia[i].duracionCurso+"</label>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-duracionCurso"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-materialDidactico'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-materialDidactico"+$cols+i+"").append("<p>Material didactico: </p><label class='tipoLeer'>"+$jsonInformacion.programasAvalEconomia[i].materialDidactico+"</label>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-materialDidactico"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-metodologia'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-metodologia"+$cols+i+"").append("<p>Metodología: </p><label class='tipoLeer'>"+$jsonInformacion.programasAvalEconomia[i].metodologia+"</label>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-metodologia"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-objetivos'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-objetivos"+$cols+i+"").append("<p>Objetivos: </p><label class='tipoLeer'>"+$jsonInformacion.programasAvalEconomia[i].objetivos+"</label>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-objetivos"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia").append('</div>');
				$("#programasAvalEconomia").append('<div class="col-md-12" id="archivos_programasAvalEconomia">');
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append("<p>Archivos:</p>");
				for($a = 0; $a < data_orgFinalizada['0'].archivos.length; $a++){
					if(data_orgFinalizada['0'].archivos[$a].id_formulario == "7"){
						if(data_orgFinalizada['0'].archivos[$a].tipo == "materialDidacticoAvalEconomia"){
							$carpeta = baseURL+"uploads/materialDidacticoAvalEconomia/";
						}

						$("#programasAvalEconomia>#archivos_programasAvalEconomia").append("<li class='listaArchivos'><a href='"+$carpeta+data_orgFinalizada['0'].archivos[$a].nombre+"' target='_blank'>"+data_orgFinalizada['0'].archivos[$a].nombre+"</a></li>");
					}
				}
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append('<div class="clearfix"></div>');
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append('<hr/>');
				$("#programasAvalEconomia").append('</div>');*/
			}
			/** Formulario 8 **/
			for (var i = 0; i < $jsonInformacion.programasAvalar.length; i++) {
				console.log(parseFloat($jsonInformacion.programasAvalar.length));
				$cols = 12 / parseFloat($jsonInformacion.programasAvalar.length);
				if ($cols < 3) {
					$cols = 4;
				}
				$("#programasAvalar").append(
					'<div class="col-md-' + $cols + '" id="col' + i + '">'
				);
				$("#programasAvalar>#col" + i + "").append(
					"<h3>Programa # " + (i + 1) + "</h3>"
				);

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-bibliografia' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-bibliografia" +
						$cols +
						i +
						""
				).append(
					"<p>Bibliografía: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].bibliografia +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-bibliografia" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-contenidosPlanteados' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-contenidosPlanteados" +
						$cols +
						i +
						""
				).append(
					"<p>Contenidos planteados: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].contenidosPlanteados +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-contenidosPlanteados" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-materialDidactico' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-materialDidactico" +
						$cols +
						i +
						""
				).append(
					"<p>Material didactico: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].materialDidactico +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-materialDidactico" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-metodologia' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-metodologia" +
						$cols +
						i +
						""
				).append(
					"<p>Metodología: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].metodologia +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-metodologia" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-objetivos' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-objetivos" +
						$cols +
						i +
						""
				).append(
					"<p>Objetivos: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].objetivos +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-objetivos" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-intensidadHoraria' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-intensidadHoraria" +
						$cols +
						i +
						""
				).append(
					"<p>Intensidad horaria: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].intensidadHoraria +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-intensidadHoraria" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar>#col" + i + "").append(
					'<div class="form-group" id="programasAvalar-nombrePrograma' +
						$cols +
						i +
						'">'
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-nombrePrograma" +
						$cols +
						i +
						""
				).append(
					"<p>Nombre del programa: </p><label class='tipoLeer'>" +
						$jsonInformacion.programasAvalar[i].nombrePrograma +
						"</label>"
				);
				$(
					"#programasAvalar>#col" +
						i +
						">#programasAvalar-nombrePrograma" +
						$cols +
						i +
						""
				).append("</div>");

				$("#programasAvalar").append("</div>");
			}
			for (var i = 0; i < 1; i++) {
				$("#programasAvalar").append(
					'<div class="col-md-12" id="archivos_programasAvalar">'
				);
				$("#programasAvalar>#archivos_programasAvalar").append(
					"<p>Archivos:</p>"
				);
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "8") {
						if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"materialDidacticoProgAvalar"
						) {
							$carpeta = baseURL + "uploads/materialDidacticoProgAvalar/";
						} else if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"formatosEvalProgAvalar"
						) {
							$carpeta = baseURL + "uploads/formatosEvalProgAvalar/";
						}

						$("#programasAvalar>#archivos_programasAvalar").append(
							"<li class='listaArchivos'><a href='" +
								$carpeta +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"' target='_blank'>" +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"</a></li>"
						);
					}
				}
				$("#programasAvalar>#archivos_programasAvalar").append(
					'<div class="clearfix"></div>'
				);
				$("#programasAvalar>#archivos_programasAvalar").append("<hr/>");
				$("#programasAvalar").append("</div>");
			}
			/** Formulario 9 **/
			for (var i = 0; i < $jsonInformacion.docentes.length; i++) {
				/*$cols = 12/(parseFloat($jsonInformacion.docentes.length));
				if($cols <= 3){
					$cols = 3;
				}

				$("#docentes").append('<div class="col-md-'+$cols+'" id="col'+i+'">');
				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].id_docente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].id_docente+"").append("<p>ID: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].id_docente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].id_docente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].valido+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].valido+"").append("<p>Valido: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].valido+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].valido+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].primerNombreDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].primerNombreDocente+"").append("<p>Primer nombre: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].primerNombreDocente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].primerNombreDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].segundoNombreDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].segundoNombreDocente+"").append("<p>Segundo nombre: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].segundoNombreDocente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].segundoNombreDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].primerApellidoDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].primerApellidoDocente+"").append("<p>Primer apellido: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].primerApellidoDocente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].primerApellidoDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].segundoApellidoDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].segundoApellidoDocente+"").append("<p>Segundo apellido: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].segundoApellidoDocente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].segundoApellidoDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].numCedulaCiudadaniaDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].numCedulaCiudadaniaDocente+"").append("<p>Número cedula: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].numCedulaCiudadaniaDocente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].numCedulaCiudadaniaDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].profesion+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].profesion+"").append("<p>Profesion: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].profesion+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].profesion+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+$jsonInformacion.docentes[i].horaCapacitacion+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].horaCapacitacion+"").append("<p>Horas de capacitacion: </p><label class='tipoLeer'>"+$jsonInformacion.docentes[i].horaCapacitacion+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+$jsonInformacion.docentes[i].horaCapacitacion+"").append('</div>');

				$("#docentes").append('</div>');*/
				if (i == 0) {
					$("#docentes").append(
						"<p>Para ver los documentos de los facilitadores haga click <a href='" +
							baseURL +
							"panelAdmin/organizaciones/docentes#organizacion:" +
							$jsonInformacion.organizaciones[i].numNIT +
							"' target='_blank'>aquí.</a> Tambien puede ingresar al módulo de facilitadores y seleccione la organización con el número NIT: <label>" +
							$jsonInformacion.organizaciones[i].numNIT +
							"</label>.</h4>"
					);
					$("#docentes").append('<div class="clearfix"></div>');
					$("#docentes").append("<hr/>");
				}
			}
			/** Formulario 10 **/ //TODO: Inicio formulario 10 observaciones
			for (var i = 0; i < $jsonInformacion.plataforma.length; i++) {
				$cols = 12 / parseFloat($jsonInformacion.plataforma.length);
				$("#plataforma").append(
					'<div class="col-md-' + $cols + '" id="col' + i + '">'
				);

				$("#plataforma>#col" + i + "").append(
					'<div class="form-group" id="plataforma-urlAplicacion' +
						$cols +
						i +
						'">'
				);
				$(
					"#plataforma>#col" + i + ">#plataforma-urlAplicacion" + $cols + i + ""
				).append(
					"<p>URL de la aplicación: </p><label class='tipoLeer'>" +
						$jsonInformacion.plataforma[i].urlAplicacion +
						"</label>"
				);
				$(
					"#plataforma>#col" + i + ">#plataforma-urlAplicacion" + $cols + i + ""
				).append("</div>");

				$("#plataforma>#col" + i + "").append(
					'<div class="form-group" id="plataforma-usuarioAplicacion' +
						$cols +
						i +
						'">'
				);
				$(
					"#plataforma>#col" +
						i +
						">#plataforma-usuarioAplicacion" +
						$cols +
						i +
						""
				).append(
					"<p>Nombre de usuario en la aplicación: </p><label class='tipoLeer'>" +
						$jsonInformacion.plataforma[i].usuarioAplicacion +
						"</label>"
				);
				$(
					"#plataforma>#col" +
						i +
						">#plataforma-usuarioAplicacion" +
						$cols +
						i +
						""
				).append("</div>");

				$("#plataforma>#col" + i + "").append(
					'<div class="form-group" id="plataforma-contrasenaAplicacion' +
						$cols +
						i +
						'">'
				);
				$(
					"#plataforma>#col" +
						i +
						">#plataforma-contrasenaAplicacion" +
						$cols +
						i +
						""
				).append(
					"<p>Contraseña en la aplicacion: </p><label class='tipoLeer'>" +
						$jsonInformacion.plataforma[i].contrasenaAplicacion +
						"</label>"
				);
				$(
					"#plataforma>#col" +
						i +
						">#plataforma-contrasenaAplicacion" +
						$cols +
						i +
						""
				).append("</div>");

				$("#plataforma").append("</div>");
				$("#plataforma").append(
					'<div class="col-md-12" id="archivos_plataforma">'
				);
				//TODO: Error formulario 10
				$("#plataforma>#archivos_plataforma").append("<p>Archivos:</p>");
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "10") {
						if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"instructivoPlataforma"
						) {
							$carpeta = baseURL + "uploads/instructivosPlataforma/";
						}
						$("#plataforma>#archivos_plataforma").append(
							"<li class='listaArchivos'><a href='" +
								$carpeta +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"' target='_blank'>" +
								data_orgFinalizada["0"].archivos[$a].nombre +
								"</a></li>"
						);
					}
				}
				$("#plataforma>#archivos_plataforma").append(
					'<div class="clearfix"></div>'
				);
				$("#plataforma>#archivos_plataforma").append("<hr/>");
				$("#plataforma").append("</div>");
				//Fin Error
			}
			// Botones
			$("#registroEducativoProgramas").append('<div class="btns">');
			//$().attr("data-text-form", "registroEducativoProgramas");
			$("#registroEducativoProgramas>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrReg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#registroEducativoProgramas>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigReg">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#registroEducativoProgramas").append("</div>");

			$("#antecedentesAcademicos").append('<div class="btns">');
			//$().attr("data-text-form", "antecedentesAcademicos");
			$("#antecedentesAcademicos>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrAntA"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#antecedentesAcademicos>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigAntA">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#antecedentesAcademicos").append("</div>");

			$("#jornadasActualizacion").append('<div class="btns">');
			//$().attr("data-text-form", "jornadasActualizacion");
			$("#jornadasActualizacion>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrJrA"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#jornadasActualizacion>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigJrA">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#jornadasActualizacion").append("</div>");

			$("#datosBasicosProgramas").append('<div class="btns">');
			//$().attr("data-text-form", "datosBasicosProgramas");
			$("#datosBasicosProgramas>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrDBas"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#datosBasicosProgramas>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigDBas">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#datosBasicosProgramas").append("</div>");

			$("#programasAvalEconomia").append('<div class="btns">');
			//$().attr("data-text-form", "programasAvalEconomia");
			$("#programasAvalEconomia>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrPAvalE"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#programasAvalEconomia>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigPAvalE">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#programasAvalEconomia").append("</div>");

			$("#programasAvalar").append('<div class="btns">');
			//$().attr("data-text-form", "programasAvalar");
			$("#programasAvalar>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrPAvalar"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#programasAvalar>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigPAvalar">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#programasAvalar").append("</div>");

			$("#docentes").append('<div class="btns col-md-12">');
			//$().attr("data-text-form", "docentes");
			$("#docentes>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrDoce"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			$("#docentes>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigDoce">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>'
			);
			$("#docentes").append("</div>");

			$("#plataforma").append('<div class="btns">');
			//$().attr("data-text-form", "plataforma");
			$("#plataforma>.btns").append(
				'<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrPlat"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>'
			);
			//$("#plataforma>.btns").append('<button class="btn btn-siia pull-right" id="terminar_proceso_observacion">Terminar proceso de observaciones <i class="fa fa-check" aria-hidden="true"></i></button>');
			$("#plataforma").append("</div>");
		} else {
			redirect(baseURL + "panelAdmin/organizaciones/inscritas");
		}
	}

	// $(document).on("click", ".verUnaObs", functions (){

	// });

	// $(".obs_admin_").parent().append('<button class="verUnaObs btn btn-siia fa fa-angle-left"></button>');

	$("#verFrameDocentes").click(function () {
		$("#frameDocDiv").slideDown();
		document.getElementById("frameDocentes").contentDocument.location.reload(true);
	});

	$(".actualizar_tipocurso").click(function () {
		$numero_cursos = $("#numero_tiposCurso").attr("data-num-cursos");
		for ($i = 1; $i <= $numero_cursos; $i++) {
			$nombreCurso = $("#nombretipocurso_" + $i).val();
			$id_curso = $("#nombretipocurso_" + $i).attr("data-id");

			data = {
				id_tiposCursoInformes: $id_curso,
				nombre: $nombreCurso,
			};

			$.ajax({
				url: baseURL + "admin/actualizarTiposCursoInforme",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					notificacion("Espere...", "success");
				},
				success: function (response) {
					notificacion(response.msg, "success");
					setInterval(function () {
						redirect("opciones");
					}, 2000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	});

	$(".eliminarCursoInforme").click(function () {
		$id_curso = $(this).attr("data-id");

		data = {
			id_curso: $id_curso,
		};

		$.ajax({
			url: baseURL + "admin/eliminarCursoInforme",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("opciones");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#crearTipoCurso").click(function () {
		$nombreCurso = $("#nuevoNombreTipoCurso").val();

		data = {
			nombre: $nombreCurso,
		};

		$.ajax({
			url: baseURL + "admin/crearTiposCursoInforme",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("opciones");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".ver_adjuntar_camara").click(function () {
		var $id_org = $(this).attr("data-organizacion");
		$("#id_org_ver_form").remove();
		$("body").append(
			"<div id='id_org_ver_form' class='hidden' data-id='" + $id_org + "'>"
		);
		var data = {
			id_organizacion: $id_org,
		};
		$.ajax({
			url: baseURL + "admin/cargar_todaInformacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#admin_ver_finalizadas").slideUp();
				$("#datos_org_camara").slideDown();
				$("#adjuntar_camara").attr("data-id-org", $id_org);
				$("#camara").attr("data-id-org", $id_org);
				$("#camara_nombre_org").html(
					response.organizaciones["0"].nombreOrganizacion
				);
				$("#camara_nit_org").html(response.organizaciones["0"].numNIT);
				$("#camara_nombreRep_org").html(
					response.organizaciones["0"].primerNombreRepLegal +
						" " +
						response.organizaciones["0"].segundoNombreRepLegal +
						" " +
						response.organizaciones["0"].primerApellidoRepLegal +
						" " +
						response.organizaciones["0"].segundoApellidoRepLegal
				);
				$("#ver_camara_org").attr(
					"href",
					baseURL +
						"uploads/camaraComercio/" +
						response.organizaciones["0"].camaraComercio
				);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#volver_cama_org").click(function () {
		$("#admin_ver_finalizadas").slideDown();
		$("#datos_org_camara").slideUp();
	});


	$("#volver_cama_org").click(function () {
		$("#admin_ver_finalizadas").slideDown();
		$("#datos_org_resolucion").slideUp();
	});

	$(".eliminarDocumentacionLegal").click(function () {
		$documentacion = $(this).attr("data-id-documentacion");

		data = {
			documentacion: $documentacion,
		};

		$.ajax({
			url: baseURL + "panel/eliminarDocumentacionLegal",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#actualizar_nombreCargo").click(function () {
		$nombrePersonaCert = $("#nombrePersonaCert").val();
		$cargoPersonaCert = $("#cargoPersonaCert").val();

		data = {
			nombrePersonaCert: $nombrePersonaCert,
			cargoPersonaCert: $cargoPersonaCert,
		};

		$.ajax({
			url: baseURL + "perfil/actualizar_nombreCargo",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("perfil");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".eliminarRegistroPrograma").click(function () {
		$id_programa = $(this).attr("data-id-registro");

		data = {
			id_programa: $id_programa,
		};

		$.ajax({
			url: baseURL + "panel/eliminarRegistroPrograma",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".eliminarProgramasBasicos").click(function () {
		$id_programa = $(this).attr("data-id-programasbasicos");

		data = {
			id_programa: $id_programa,
		};

		$.ajax({
			url: baseURL + "panel/eliminarProgramasBasicos",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".eliminarProgramasAval").click(function () {
		$id_programa = $(this).attr("data-id-programasAval");

		data = {
			id_programa: $id_programa,
		};

		$.ajax({
			url: baseURL + "panel/eliminarProgramasAvalEconomia",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".eliminarProgramasAvalar").click(function () {
		$id_programa = $(this).attr("data-id-programasAvalar");

		data = {
			id_programa: $id_programa,
		};

		$.ajax({
			url: baseURL + "panel/eliminarProgramasAvalar",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(document).on("click", ".collapsed", function () {
		if ($(this).siblings("div.collapse").hasClass("in")) {
			$(this).siblings("div.collapse").removeClass("in");
			$(this).siblings("div.collapse").css("height", "0%");
			$(this).siblings("div.collapse").slideUp();
		} else {
			$(this).siblings("div.collapse").addClass("in");
			$(this).siblings("div.collapse").css("height", "100%");
			$(this).siblings("div.collapse").slideDown();
		}
	});



	$("#guardarRegistroTelefonico").click(function () {
		$telefonicoNombre = $("#telefonicoNombre").val();
		$telefonicoApellidos = $("#telefonicoApellidos").val();
		$telefonicoCedula = $("#telefonicoCedula").val();
		$telefonicoNit = $("#telefonicoNit").val();
		$telefonicoTipoPersona = $("#telefonicoTipoPersona").val();
		$telefonicoGenero = $("#telefonicoGenero").val();
		$telefonicoMunicipio = $("#telefonicoMunicipio").val();
		$telefonicoDepartamento = $("#telefonicoDepartamento").val();
		$telefonicoNumeroContacto = $("#telefonicoNumeroContacto").val();
		$telefonicoCorreoContacto = $("#telefonicoCorreoContacto").val();
		$telefonicoNombreOrganizacion = $("#telefonicoNombreOrganizacion").val();
		$telefonicoTipoOrganizacion = $("#telefonicoTipoOrganizacion").val();
		$telefonicoTemaConsulta = $("#telefonicoTemaConsulta").val();
		$telefonicoDescripcionConsulta = $("#telefonicoDescripcionConsulta").val();
		$telefonicoTipoSolicitud = $("#telefonicoTipoSolicitud").val();
		$telefonicoCanalRecepcion = $("#telefonicoCanalRecepcion").val();
		$telefonicoCanalRespuesta = $("#telefonicoCanalRespuesta").val();
		$telefonicoFecha = $("#telefonicoFecha").val();
		$telefonicoDuracion = $("#telefonicoDuracion").val();
		$telefonicoHora = $("#telefonicoHora").val();

		data = {
			telefonicoNombre: $telefonicoNombre,
			telefonicoApellidos: $telefonicoApellidos,
			telefonicoCedula: $telefonicoCedula,
			telefonicoNit: $telefonicoNit,
			telefonicoTipoPersona: $telefonicoTipoPersona,
			telefonicoGenero: $telefonicoGenero,
			telefonicoMunicipio: $telefonicoMunicipio,
			telefonicoDepartamento: $telefonicoDepartamento,
			telefonicoNumeroContacto: $telefonicoNumeroContacto,
			telefonicoCorreoContacto: $telefonicoCorreoContacto,
			telefonicoNombreOrganizacion: $telefonicoNombreOrganizacion,
			telefonicoTipoOrganizacion: $telefonicoTipoOrganizacion,
			telefonicoTemaConsulta: $telefonicoTemaConsulta,
			telefonicoDescripcionConsulta: $telefonicoDescripcionConsulta,
			telefonicoTipoSolicitud: $telefonicoTipoSolicitud,
			telefonicoCanalRecepcion: $telefonicoCanalRecepcion,
			telefonicoCanalRespuesta: $telefonicoCanalRespuesta,
			telefonicoFecha: $telefonicoFecha,
			telefonicoDuracion: $telefonicoDuracion,
			telefonicoHora: $telefonicoHora,
		};

		$.ajax({
			url: baseURL + "admin/guardarRegistroTelefonico",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				clearInputs("noRegisSiste");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(document).on("click", ".eliminar_archivo_docente", function () {
		$id_archivoDocente = $(this).attr("data-id-archivoDocente");
		$id_docente = $(this).attr("data-id-docente");
		$tipo = $(this).attr("data-id-tipo");
		$nombre = $(this).attr("data-nombre-ar");

		data = {
			id_archivoDocente: $id_archivoDocente,
			id_docente: $id_docente,
			tipo: $tipo,
			nombre: $nombre,
		};

		$.ajax({
			url: baseURL + "panel/eliminarArchivoDocente",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivosDocente($id_docente);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#admin_buscar_organizacion").click(function () {
		if ($("#admin_buscar_nombre").val().length == 0) {
			$("#admin_buscar_nombre").val("*");
		}
		var $nombre_org = $("#admin_buscar_nombre").val();
		var $sigla_org = $("#admin_buscar_sigla").val();
		var $nit_org = $("#admin_buscar_nit").val();
		var $nombre_rep_org = $("#admin_buscar_nombre_rep").val();
		var $split_nombre = $nombre_rep_org.split(" ");

		var data = {
			nombre_organizacion: $nombre_org,
			sigla_organizacion: $sigla_org,
			nit_organizacion: $nit_org,
			primer_nombre: $split_nombre[0],
			segundo_nombre: $split_nombre[1],
			primer_apellido: $split_nombre[2],
			segundo_apellido: $split_nombre[3],
		};
		$.ajax({
			url: baseURL + "admin/buscar_organizacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				clearInputs("buscar_org");
				$("#buscar_org").slideUp();
				$("#organizaciones_encontradas").slideDown();
				$("#tabla_buscar_organizacion>tbody#tbody_encontradas").empty();
				$("#tabla_buscar_organizacion>tbody#tbody_encontradas").html("");
				$("#tbody_encontradas>.odd").remove();
				for (var i = 0; i < response.organizaciones.length; i++) {
					$("#tbody_encontradas").append("<tr id=" + i + ">");
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].nombreOrganizacion + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].numNIT + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].sigla + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" +
							response.organizaciones[i]
								.direccionCorreoElectronicoOrganizacion +
							"</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" +
							response.organizaciones[i].direccionCorreoElectronicoRepLegal +
							"</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].primerNombreRepLegal + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].segundoNombreRepLegal + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].primerApellidoRepLegal + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" +
							response.organizaciones[i].segundoApellidoRepLegal +
							"</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].primerNombrePersona + "</td>"
					);
					$("#tbody_encontradas>tr#" + i + "").append(
						"<td>" + response.organizaciones[i].primerApellidoPersona + "</td>"
					);
					$("#tbody_encontradas").append("</tr>");
				}
				//paging("tabla_buscar_organizacion");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});
	// Click admin FIN

	/**
		Click en inicio de Sesion.
	**/
	$("#inicio_sesion").click(function () {
		if ($("#formulario_login").valid()) {
			var usuario = $("#usuario").val();
			var password = $("#password").val();
			var response_captcha = grecaptcha.getResponse();

			if (usuario.length > 0 && password.length > 0) {
				var data = {
					usuario: usuario,
					password: password,
				};
				$.ajax({
					url: baseURL + "sesion/login",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						$("#loading").show();
						$(this).attr("disabled", true);
					},
					success: function (response) {
						if (response.url == "login") {
							mensaje(response.msg, "alert-warning");
							clearInputs("formulario_login");
						}
						if (response.url == "panel") {
							redirect(response.url);
						}
						$("#loading").toggle();
						grecaptcha.reset();
					},
					error: function (ev) {
						//Do nothing
					},

					// 	if(response_captcha != 0){
					// 	    });
					// 	}else{
					// 		mensaje(texto_validacaptcha, alert_danger);
					// 	}
					// }else{
					// 	mensaje("Escriba el usuario y la contraseña.", alert_danger);
					// }
				});
			}
		}
	});

	/**
		Click en inicio de Sesion Administrador.
	**/
	$("#inicio_sesion_admin").click(function () {
		if ($("#formulario_login_admin").valid()) {
			var usuario = $("#usuario").val();
			var password = $("#password").val();
			// var response_captcha = grecaptcha.getResponse();

			if (usuario.length > 0 && password.length > 0) {
				var data = {
					usuario: usuario,
					password: password,
				};
				$.ajax({
					url: baseURL + "sesion/log_in_admin",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						$("#loading").show();
						$(this).attr("disabled", true);
					},
					success: function (response) {
						if (response.url == "admin") {
							mensaje(response.msg, "alert-warning");
							clearInputs("formulario_login_admin");
						}
						if (response.url == "panel_admin") {
							redirect("panelAdmin");
						}
						$("#loading").toggle();
						// grecaptcha.reset();
						notificacion(response.msg, "success");
					},
					error: function (ev) {
						//Do nothing
					},
				});
			}
			// 	if (response_captcha != 0) {
			// 	} else {
			// 		mensaje(texto_validacaptcha, alert_danger);
			// 	}
			// } else {
			// 	mensaje("Escriba el usuario y la contraseña.", alert_danger);
			// }
		}
	});

	/**
		TODO: Click en Recordar Contraseña
	**/
	$("#recordar_contrasena").click(function () {
		if ($("#formulario_recordar").valid()) {
			var usuario = $("#nombre_usuario_rec").val();
			var correo_electronico = $("#correo_electronico_rec").val();
			var check = $("#acepto_cond_rec").prop("checked");
			var response_captcha = grecaptcha.getResponse();

			if (usuario.length > 0 && correo_electronico.length > 0) {
				if (check == true) {
					if (response_captcha != 0) {
						var data = {
							usuario: usuario,
							correo_electronico: correo_electronico,
						};
						$.ajax({
							url: baseURL + "recordar/recordar",
							type: "post",
							dataType: "JSON",
							data: data,
							beforeSend: function () {
								$("#loading").show();
								$(this).attr("disabled", true);
							},
							success: function (response) {
								mensaje(response.msg, "alert-success");
								$("#loading").toggle();
								clearInputs("formulario_recordar");
								grecaptcha.reset();
							},
							error: function (ev) {
								//Do nothing
							},
						});
					} else {
						mensaje(texto_validacaptcha, alert_danger);
					}
				} else {
					mensaje(
						"Aceptas que eres el usuario del correo electronico?",
						alert_warning
					);
				}
			} else {
				mensaje("No hay valores.", alert_danger);
			}
		}
	});

	// TODO: Confirmar formulario de registro
	$("#confirmaRegistro").click(function () {
		$("#informacion_pre").slideDown();
		$("#reenvio_pre").slideUp();

		var organizacion = $("#organizacion").val();
		var nit = $("#nit").val() + "-" + $("#nit_digito").val();
		var sigla = $("#sigla").val();
		var nombre = $("#nombre").val();
		var nombre_s = $("#nombre_s").val();
		var apellido = $("#apellido").val();
		var apellido_s = $("#apellido_s").val();
		var correo_electronico = $("#correo_electronico").val();
		var correo_electronico_rep_legal = $("#correo_electronico_rep_legal").val();
		var nombre_p = $("#nombre_p").val();
		var apellido_p = $("#apellido_p").val();
		var nombre_usuario = $("#nombre_usuario").val();
		var pass = $("#password").val();
		var pass2 = $("#re_password").val();
		var check = $("#acepto_cond").prop("checked");
		var response_captcha = grecaptcha.getResponse();

		datas = {
			nombre: nombre_usuario,
			nit: nit,
		};

		if ($("#formulario_registro").valid()) {
			$.ajax({
				url: baseURL + "home/verificarUsuario",
				type: "post",
				dataType: "JSON",
				data: datas,
				success: function (response) {
					if (response.existe === 1) {
						notificacion(
							"El nombre usuario ya existe... Puede usar números...",
							"success"
						);
						$("#ayuda_registro").modal("toggle");
					} else {
						if (
							organizacion.length > 0 &&
							nit.length > 0 &&
							nombre.length > 0 &&
							apellido.length > 0 &&
							correo_electronico.length > 0 &&
							nombre_usuario.length > 0 &&
							pass.length > 0 &&
							pass2.length > 0
						) {
							if (pass === pass2) {
								if (check === true) {
									if (response_captcha != 0) {
										notificacion(
											"Verifique su información y correos electronicos.",
											"success"
										);
										$("#modalConfOrg").html($("#organizacion").val());
										$("#modalConfNit").html(nit);
										$("#modalConfSigla").html(sigla);
										$("#modalConfPNRL").html(nombre);
										$("#modalConfSNRL").html(nombre_s);
										$("#modalConfPARL").html(apellido);
										$("#modalConfSARL").html(apellido_s);
										$("#modalConfCOrg").html(correo_electronico);
										$("#modalConfCRep").html(correo_electronico_rep_legal);
										$("#modalConfPn").html(nombre_p);
										$("#modalConfPa").html(apellido_p);
										$("#modalConfNU").html(nombre_usuario);
									} else {
										$("#ayuda_registro").modal("toggle");
										mensaje(texto_validacaptcha, alert_danger);
									}
								} else {
									mensaje(
										"¿Aceptas condiciones y restricciones?",
										alert_danger
									);
								}
							} else {
								$("#ayuda_registro").modal("toggle");
								mensaje(
									"La contraseña no coincide, verifiquela...",
									alert_warning
								);
							}
						} else {
							$("#ayuda_registro").modal("toggle");
							mensaje("Por favor, llene los datos requeridos.", alert_danger);
						}
					}
				},
				error: function (ev) {
					//Do nothing
				},
			});
		} else {
			$("#ayuda_registro").modal("toggle");
		}
	});
	// TODO: Guardar registro validado.
	$("#guardar_registro").click(function () {
		if ($("#formulario_registro").valid()) {
			var organizacion = $("#organizacion").val();
			var nit = $("#nit").val() + "-" + $("#nit_digito").val();
			var sigla = $("#sigla").val();
			var nombre = $("#nombre").val();
			var nombre_s = $("#nombre_s").val();
			var apellido = $("#apellido").val();
			var apellido_s = $("#apellido_s").val();
			var correo_electronico = $("#correo_electronico").val();
			var correo_electronico_rep_legal = $(
				"#correo_electronico_rep_legal"
			).val();
			var nombre_p = $("#nombre_p").val();
			var apellido_p = $("#apellido_p").val();
			var nombre_usuario = $("#nombre_usuario").val();
			var pass = $("#password").val();
			var pass2 = $("#re_password").val();
			var check = $("#acepto_cond").prop("checked");
			var response_captcha = grecaptcha.getResponse();
			console.log(response_captcha);

			if (
				organizacion.length > 0 &&
				nit.length > 0 &&
				nombre.length > 0 &&
				apellido.length > 0 &&
				correo_electronico.length > 0 &&
				nombre_usuario.length > 0 &&
				pass.length > 0 &&
				pass2.length > 0
			) {
				if (pass == pass2) {
					if (check == true) {
						if (response_captcha != 0) {
							var data = {
								organizacion: organizacion,
								nit: nit,
								sigla: sigla,
								nombre: nombre,
								nombre_s: nombre_s,
								apellido: apellido,
								apellido_s: apellido_s,
								correo_electronico: correo_electronico,
								correo_electronico_rep_legal: correo_electronico_rep_legal,
								nombre_p: nombre_p,
								apellido_p: apellido_p,
								nombre_usuario: nombre_usuario,
								password: pass,
							};
							console.log(data);
							$.ajax({
								url: baseURL + "home/verificarUsuario",
								type: "post",
								dataType: "JSON",
								data: data,
								success: function (response) {
									if (response.existe == 1) {
										notificacion(
											"El nombre usuario ya existe... Puede usar números...",
											"success"
										);
									} else {
										$.ajax({
											url: baseURL + "registro/registrar_info",
											type: "post",
											dataType: "JSON",
											data: data,
											beforeSend: function () {
												$("#loading").show();
												$(this).attr("disabled", true);
												//notificacion("Enviando correo electrónico, espere...");
												notificacion("Registrando información, espere...");
												$(this).attr("disabled", true);
											},
											success: function (response) {
												$("#ayuda_registro").attr("data-backdrop", "static");
												$("#ayuda_registro").attr("data-keyboard", "false");
												$("#correo_electronico_rese").attr(
													"data-org",
													JSON.stringify(response).replace(/'/g, "\\'")
												);
												mensaje(response.msg, "alert-success");
												$("#loading").toggle();
												if (response.status == 0) {
													notificacion(
														"El correo electrónico no fue enviado, intente de nuevo."
													);
													$("#cerr_mod").click();
												} else {
													grecaptcha.reset();
													//clearInputs('formulario_registro');
													notificacion("El correo electrónico enviado.");
													//$('#ayuda_registro').modal('toggle');
													$("#informacion_pre").slideUp();
													$("#reenvio_pre").slideDown();
													$("#reenvio").show();
													$("#guardar_registro").hide();
													$(this).attr("disabled", true);
												}
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
						} else {
							mensaje(texto_validacaptcha, alert_danger);
							$("#ayuda_registro").modal("toggle");
						}
					} else {
						mensaje("¿Aceptas condiciones y restricciones?", alert_danger);
					}
				} else {
					mensaje("La contraseña no coincide, verifiquela...", alert_warning);
				}
			} else {
				mensaje("Por favor, llene los datos requeridos...", alert_danger);
			}
		}
	});
	// Aceptar
	$("#aceptoComActo").change(function () {
		if ($("#aceptoComActo").is(":checked")) {
			$("#guardar_registro").removeAttr("disabled");
			$("#guardar_registro").attr("disabled", false);
		} else {
			$("#guardar_registro").attr("disabled", true);
		}
	});

	$("#nombre_usuario").change(function () {
		$nombre = $("#nombre_usuario").val();

		datas = {
			nombre: $nombre,
		};

		$.ajax({
			url: baseURL + "home/verificarUsuario",
			type: "post",
			dataType: "JSON",
			data: datas,
			success: function (response) {
				if (response.existe == 1) {
					notificacion(
						"El nombre de usuario ya existe... Puede usar números...",
						"success"
					);
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#reenvio").click(function () {
		$correo_electronico = $("#correo_electronico_rese").val();
		$data = $("#correo_electronico_rese").attr("data-org");
		$datos = JSON.parse($data);
		$tk = $datos.token.token;
		$usuario = $datos.token.usuario_token;
		$organizacion = $datos.organizacion.nombreOrganizacion;
		$primerNombre = $datos.organizacion.primerNombreRepLegal;
		$primerApellido = $datos.organizacion.primerApellidoRepLegal;
		$nit = $datos.organizacion.numNIT;

		datas = {
			to: $correo_electronico,
			tk: $tk,
			usuario: $usuario,
			organizacion: $organizacion,
			primerNombre: $primerNombre,
			primerApellido: $primerApellido,
			nit: $nit,
		};

		console.log(datas);

		$.ajax({
			url: baseURL + "registro/reenvio",
			type: "post",
			dataType: "JSON",
			data: datas,
			beforeSend: function () {
				$("#loading").show();
				notificacion("Reenviando correo electrónico...");
				$("#reenvio").attr("disabled", true);
				$("#correo_electronico_rese").attr("readonly", true);
				$("#cerr_mod").hide();
				$("#cerr_reen").show();
				$(this).attr("disabled", true);
			},
			success: function (response) {
				notificacion(response.msg);
				$("#reenvio").removeAttr("disabled");
				$("#correo_electronico_rese").removeAttr("readonly");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	// Actualizar Informacion
	$("#actualizar_informacion").click(function () {
		if ($("#formulario_actualizar").valid()) {
			var organizacion = $("#organizacion").val();
			var nit = $("#nit").val();
			var sigla = $("#sigla").val();
			var nombre = $("#nombre").val();
			var nombre_s = $("#nombre_s").val();
			var apellido = $("#apellido").val();
			var apellido_s = $("#apellido_s").val();
			var correo_electronico = $("#correo_electronico").val();
			var correo_electronico_rep_legal = $(
				"#correo_electronico_rep_legal"
			).val();
			var nombre_p = $("#nombre_p").val();
			var apellido_p = $("#apellido_p").val();

			//___

			var tipo_organizacion = $("#tipo_organizacion").val();
			var departamento = $("#departamentos").val();
			var municipio = $("#municipios").val();
			var direccion = $("#direccion").val();
			var fax = $("#fax").val();

			if ($("input:checkbox[name=extension_checkbox]:checked").val()) {
				var extension = $("#extension").val();
			} else {
				var extension = "No Tiene";
			}
			if ($("#urlOrganizacion").val()) {
				var urlOrganizacion = $("#urlOrganizacion").val();
			} else {
				var urlOrganizacion = "No Tiene";
			}

			var actuacion = $("#actuacion").val();
			var educacion = $("#educacion").val();
			var numCedulaCiudadaniaPersona = $("#numCedulaCiudadaniaPersona").val();

			if (
				organizacion.length > 0 &&
				nit.length > 0 &&
				nombre.length > 0 &&
				apellido.length > 0 &&
				correo_electronico.length > 0
			) {
				var data = {
					organizacion: organizacion,
					nit: nit,
					sigla: sigla,
					nombre: nombre,
					nombre_s: nombre_s,
					apellido: apellido,
					apellido_s: apellido_s,
					correo_electronico: correo_electronico,
					correo_electronico_rep_legal: correo_electronico_rep_legal,
					nombre_p: nombre_p,
					apellido_p: apellido_p, //___
					tipo_organizacion: tipo_organizacion,
					departamento: departamento,
					municipio: municipio,
					direccion: direccion,
					fax: fax,
					extension: extension,
					urlOrganizacion: urlOrganizacion,
					actuacion: actuacion,
					educacion: educacion,
					numCedulaCiudadaniaPersona: numCedulaCiudadaniaPersona,
				};

				$.ajax({
					url: baseURL + "update/update_info",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						notificacion("Espere... Guardando información...", "success");
					},
					success: function (response) {
						mensaje(response.msg, alert_success);
						notificacion(response.msg, "success");
						setInterval(function () {
							redirect("perfil");
						}, 2000);
					},
					error: function (ev) {
						//Do nothing
					},
				});
			} else {
				mensaje("Escriba un correo electronico válido.", alert_danger);
			}
		}
	});

	/**
		Click en Actualizar Contraseña.
	**/
	$("#actualizar_contrasena").click(function () {
		if ($("#formulario_actualizar_contrasena").valid()) {
			var contrasena_anterior = $("#contrasena_anterior").val();
			var contrasena_nueva = $("#contrasena_nueva").val();
			var re_contrasena_nueva = $("#re_contrasena_nueva").val();

			if (contrasena_nueva == re_contrasena_nueva) {
				var data = {
					contrasena_anterior: contrasena_anterior,
					contrasena_nueva: contrasena_nueva,
				};

				$.ajax({
					url: baseURL + "update/update_password",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						notificacion("Espere...", "success");
					},
					success: function (response) {
						mensaje(response.msg, alert_success);
						notificacion(response.msg, "success");
						setInterval(function () {
							redirect("perfil");
						}, 2000);
					},
					error: function (ev) {
						//Do nothing
					},
				});
			} else {
				mensaje("La contraseña nueva no coincide.", alert_warning);
			}
		}
	});

	/**
		Click en Actualizar Nombre de Usuario.
	**/

	$("#adjuntar_camara").on("click", function () {
		//if($("#formulario_actualizar_imagen").valid()){
		var file_data = $("#camara").prop("files")[0];
		$id_organizacion = $(this).attr("data-id-org");
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("id_organizacion", $id_organizacion);
		$.ajax({
			url: baseURL + "admin/upload_camara",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("camaraComercio");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
		//}
	});

	$("#actualizar_usuario").click(function () {
		if ($("#formulario_actualizar_usuario").valid()) {
			var usuario_nuevo = $("#usuario_nuevo").val();

			var data = {
				usuario_nuevo: usuario_nuevo,
			};

			$.ajax({
				url: baseURL + "update/update_user",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					notificacion("Espere...", "success");
				},
				success: function (response) {
					mensaje(response.msg, alert_success);
					notificacion(response.msg, "success");
					setInterval(function () {
						redirect("perfil");
					}, 2000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	});

	$("#actualizar_imagen").on("click", function () {
		if ($("#formulario_actualizar_imagen").valid()) {
			var file_data = $("#imagen").prop("files")[0];
			var form_data = new FormData();
			form_data.append("file", file_data);
			$.ajax({
				url: baseURL + "perfil/upload_imagen_logo",
				dataType: "text",
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: "post",
				dataType: "JSON",
				beforeSubmit: function () {
					$("#loading").show();
				},
				beforeSend: function () {
					notificacion("Cargando...", "success");
				},
				success: function (response) {
					mensaje(response.msg, alert_success);
					$("#loading").toggle();
					notificacion(response.msg, "success");
					setInterval(function () {
						redirect("perfil");
					}, 2000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	});

	$(".imagen_header_der").on("click", function () {
		//if($("#formulario_actualizar_imagen").valid()){
		var file_data = $("#imagen_h_der").prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		$.ajax({
			url: baseURL + "admin/upload_imagen_header_der",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Cargando...", "success");
			},
			success: function (response) {
				mensaje(response.msg, alert_success);
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
		//}
	});

	$(".imagen_header_izq").on("click", function () {
		//if($("#formulario_actualizar_imagen").valid()){
		var file_data = $("#imagen_h_izq").prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		$.ajax({
			url: baseURL + "admin/upload_imagen_header_izq",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Cargando...", "success");
			},
			success: function (response) {
				mensaje(response.msg, alert_success);
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
		//}
	});

	$("#actualizar_firma").on("click", function () {
		var file_data = $("#firma").prop("files")[0];
		$f1 = $("#contrasena_firma").val();
		$f2 = $("#re_contrasena_firma").val();
		console.log($f1);
		console.log($f2);
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("firmaContrasena", $f2);
		if ($f1 == $f2) {
			$.ajax({
				url: baseURL + "perfil/upload_firma",
				dataType: "text",
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: "post",
				dataType: "JSON",
				beforeSubmit: function () {
					notificacion("Espere...", "success");
				},
				success: function (response) {
					mensaje(response.msg, alert_success);
					$("#loading").toggle();
					notificacion(response.msg, "success");
					setInterval(function () {
						redirect("perfil");
					}, 2000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		} else {
			notificacion("Verifique las contraseñas.");
		}
	});

	$("#actualizar_firma_certifi").on("click", function () {
		var file_data = $("#firmaCert").prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);

		$.ajax({
			url: baseURL + "perfil/upload_firma_certifi",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect("perfil");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#eliminar_firma_certifi").on("click", function () {
		$.ajax({
			url: baseURL + "perfil/eliminar_firma_certifi",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg);
				setInterval(function () {
					redirect("perfil");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#ver_fir_rep_legal").click(function () {
		$contrasena = $("#contrasena_firma_rep").val();

		data = {
			contrasena: $contrasena,
		};

		$.ajax({
			url: baseURL + "panel/verFirmaRepLegal",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				if (response.estado == "1") {
					$("#firma_rep_legal").show();
				} else {
					notificacion("Contraseña no válida.");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});
	/**
		Click en Salir de Sesion.
	**/
	$("#salir").click(function () {
		$(this).attr("disabled", true);
		$.ajax({
			url: baseURL + "sesion/logout",
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion("La sesión ha terminado.", "success");
				setInterval(function () {
					redirect(baseURL + "login");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	/**
		Click en Salir de Sesion Administrador.
	**/
	$("#salir_admin").click(function () {
		$(this).attr("disabled", true);
		$.ajax({
			url: baseURL + "admin/logout",
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				redirect(response.url);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	/**
		Eventos para guardar formularios
	**/

	$("input:radio[name=tipo_solicitud]").change(function () {
		$valor = $(this).val();

		if ($valor == "Actualización de datos") {
			$("#motivo1").parent().toggle();
			$("#motivo2").parent().toggle();
			$("#motivo3").parent().toggle();
			$("#motivo4").parent().toggle();
			$("#motivo5").attr("checked", true);
		} else if ($valor != "Actualización de datos") {
			$("#motivo1").parent().show();
			$("#motivo2").parent().show();
			$("#motivo3").parent().show();
			$("#motivo4").parent().show();
			$("#motivo5").attr("checked", false);
			$("#motivo1").attr("checked", true);
		}
	});



	$("#guardar_formulario_docentes").click(function () {
		var cedula = $("#docentes_cedula").val();
		var primer_nombre = $("#docentes_primer_nombre").val();
		var segundo_nombre = $("#docentes_segundo_nombre").val();
		var primer_apellido = $("#docentes_primer_apellido").val();
		var segundo_apellido = $("#docentes_segundo_apellido").val();
		var profesion = $("#docentes_profesion").val();
		var horas = $("#docentes_horas").val();

		data = {
			cedula: cedula,
			primer_nombre: primer_nombre,
			segundo_nombre: segundo_nombre,
			primer_apellido: primer_apellido,
			segundo_apellido: segundo_apellido,
			profesion: profesion,
			horas: horas,
			valido: 0,
		};

		$.ajax({
			url: baseURL + "panel/guardar_formulario_docentes",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				clearInputs("formulario_docentes");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});



	$(".archivos_form_basico_economia").on("click", function () {
		$data_name = $(".archivos_form_basico_economia").attr("data-name");
		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		$.ajax({
			url: baseURL + "panel/guardarArchivoMaterialProgBasic",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivos();
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(".archivos_form_aval_economia").on("click", function () {
		$data_name = $(".archivos_form_aval_economia").attr("data-name");
		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		$.ajax({
			url: baseURL + "panel/guardarArchivoMaterialAvalEco",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivos();
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(".archivos_form_formatosEvalProgAva").on("click", function () {
		$data_name = $(".archivos_form_formatosEvalProgAva").attr("data-name");
		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		$.ajax({
			url: baseURL + "panel/guardarArchivoFormatosEvalProgAval",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivos();
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(".archivos_form_materialDidacProgAvalar").on("click", function () {
		$data_name = $(".archivos_form_materialDidacProgAvalar").attr("data-name");
		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		$.ajax({
			url: baseURL + "panel/guardarArchivoMaterialDicProgAvalar",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivos();
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

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
			url: baseURL + "panel/guardarArchivoHojaVidaDocente",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivosDocente($id_docente);
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

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
			url: baseURL + "panel/guardarArchivoTituloDocente",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivosDocente($id_docente);
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(document).on("click", ".archivos_form_obsPlataforma", function () {
		$data_name = $(".archivos_form_obsPlataforma").attr("data-name");
		$id_organizacion = $("#id_org_ver_form").attr("data-id");

		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		form_data.append("id_organizacion", $id_organizacion);

		$.ajax({
			url: baseURL + "admin/guardarArchivoObsPlataforma",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				notificacion("Guardando archivo de observaciones...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(".archivos_form_certificadoDocente").on("click", function () {
		$data_name = $(".archivos_form_certificadoDocente").attr("data-name");
		$id_docente = $("#docente_arch_id").attr("data-docente-id");
		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		form_data.append("id_docente", $id_docente);
		$.ajax({
			url: baseURL + "panel/guardarArchivoCertificadoDocente",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivosDocente($id_docente);
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(".archivos_form_certificadoEconomiaDocente").on("click", function () {
		$data_name = $(".archivos_form_certificadoEconomiaDocente").attr(
			"data-name"
		);
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
			url: baseURL + "panel/guardarArchivoCertificadoEconomiaDocente",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivosDocente($id_docente);
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	$(".archivos_form_instructivoPlataforma").on("click", function () {
		$data_name = $(".archivos_form_instructivoPlataforma").attr("data-name");
		var file_data = $("#" + $data_name).prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("tipoArchivo", $("#" + $data_name).attr("data-val"));
		form_data.append("append_name", $data_name);
		$.ajax({
			url: baseURL + "panel/guardarArchivoInstructivoPlataforma",
			dataType: "text",
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: "post",
			dataType: "JSON",
			beforeSubmit: function () {
				$("#loading").show();
			},
			success: function (response) {
				notificacion(response.msg, "success");
				cargarArchivos();
			},
			error: function (ev) {
				notificacion("Verifique los datos del formulario.", "success");
			},
		});
	});

	// TODO: Modal Asignar Evaluador Organizacion
	$(document).on("click", "#verModalAsignar", function () {
		$id_organizacion = $(this).attr("data-organizacion");
		$nombreOrganizacion = $(this).attr("data-nombre");
		$numNIT = $(this).attr("data-nit");

		$("#idAsigOrg").html($id_organizacion);
		$("#nombreAsigOrg").html($nombreOrganizacion);
		$("#nitAsigOrg").html($numNIT);
	});
	// TODO: Asignar evaluador a organización
	$("#asignarOrganizacionEvaluador").click(function () {
		$id_organizacion = $("#idAsigOrg").html();
		$evaluadorAsignar = $("#evaluadorAsignar").val();

		data = {
			id_organizacion: $id_organizacion,
			evaluadorAsignar: $evaluadorAsignar,
		};

		$.ajax({
			url: baseURL + "admin/asignarOrganizacion",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere, asignando...", "success");
				$("#asignarOrganizacionEvaluador").attr("disabled", true);
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(baseURL + response.url);
				}, 3500);
				$("#asignarOrganizacion").toggle();
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});
	// TODO: Modal Asignar Evaluador Docente
	$(document).on("click", "#verModalAsignarDocente", function () {
		$idDocente = $(this).attr("data-id");
		$cedulaDocente = $(this).attr("data-docente");
		$nombreDocente = $(this).attr("data-nombre");
		$apellidoDocente = $(this).attr("data-apellido");

		$nombre = $nombreDocente + " " + $apellidoDocente;

		$("#idDocente").html($idDocente);
		$("#cedulaDocente").html($cedulaDocente);
		$("#nombreDocente").html($nombre);
	});
	// TODO: Asignar evaluador a docente
	$("#asignarDocenteEvaluador").click(function () {
		$id_docente = $("#idDocente").html();
		$evaluadorAsignar = $("#evaluadorAsignar").val();

		data = {
			id_docente: $id_docente,
			evaluadorAsignar: $evaluadorAsignar,
		};

		$.ajax({
			url: baseURL + "admin/asignarDocenteEvaluador",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere, asignando...", "success");
				$("#asignarDocenteEvaluador").attr("disabled", true);
			},
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(baseURL + response.url);
				}, 3500);
				$("#asignarDocente").toggle();
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});
	$("#admin_actualizar_nombre_aplicacion").click(function () {
		var $titulo = $("#admin_nombre_aplicacion").val();
		var data = {
			titulo: $titulo,
		};
		$.ajax({
			url: baseURL + "admin/actualizarOpciones",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".verDatosHistoricos").click(function () {
		$id_organizacion_historial = $(this).attr("data-id-org");
		$id_historial = $(this).attr("data-id");
		$("body").append(
			"<div class='hidden' data-id-hist='" +
				$id_historial +
				"' data-id-org='" +
				$id_organizacion_historial +
				"' id='data_hist_org_ver'></div>"
		);

		data = {
			id_organizacion_historial: $id_organizacion_historial,
			id_historial: $id_historial,
		};

		$.ajax({
			url: baseURL + "admin/informacionOrganizacionHistorial",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#ver_hist_perso").val(response.historial["0"].personeriaJuridica);
				$("#ver_hist_nombres_ser").val(
					response.historial["0"].nombresSeriesAsuntos
				);
				$("#ver_hist_regional").append(
					"<option id='0' value='" +
						response.historial["0"].regional +
						"' selected>" +
						response.historial["0"].regional +
						"</option>"
				);
				$("#ver_hist_regional").selectpicker("refresh");
				$("#ver_hist_fech_ei").val(response.historial["0"].fechaExtremaInicial);
				$("#ver_hist_fech_ef").val(response.historial["0"].fechaExtremaFinal);
				$("#ver_hist_caja").val(response.historial["0"].caja);
				$("#ver_hist_carpeta").val(response.historial["0"].carpeta);
				$("#ver_hist_tomo").val(response.historial["0"].tomo);
				$("#ver_hist_otro").val(response.historial["0"].otros);
				$("#ver_hist_folios").val(response.historial["0"].numeroFolios);
				$("#ver_hist_soporte").append(
					"<option id='0' value='" +
						response.historial["0"].soporte +
						"' selected>" +
						response.historial["0"].soporte +
						"</option>"
				);
				$("#ver_hist_soporte").selectpicker("refresh");
				$("#ver_hist_obser").val(response.historial["0"].observaciones);

				$("#lbl_nombre_org_hist").html(
					response.organizacion["0"].nombreOrganizacion
				);
				$("#nombre_org_hist").val(
					response.organizacion["0"].nombreOrganizacion
				);
				$("#direccion_org_org_hist").val(
					response.organizacion["0"].direccionCorreoElectronicoOrganizacion
				);
				$("#direccion_rep_org_hist").val(
					response.organizacion["0"].direccionCorreoElectronicoRepLegal
				);
				$("#nit_org_hist").val(response.organizacion["0"].numNIT);
				$("#rep_org_hist").val(
					response.organizacion["0"].primerNombreRepLegal +
						" " +
						response.organizacion["0"].segundoNombreRepLegal +
						" " +
						response.organizacion["0"].primerApellidoRepLegal +
						" " +
						response.organizacion["0"].segundoApellidoRepLegal
				);
				$("#sigla_org_hist").val(response.organizacion["0"].sigla);
				$("#res_fech_inicio").val(
					response.resolucion_historial["0"].fechaResolucionInicial
				);
				$("#res_fech_fin").val(
					response.resolucion_historial["0"].fechaResolucionFinal
				);
				$("#demas_res_hist").empty();
				for (var $i = 0; $i < response.resolucion_historial.length; $i++) {
					$("#demas_res_hist").append(
						'<div class="col-md-2" id="hist_res' + $i + '">'
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_i_inicio" +
							$i +
							"'><label> Fecha inicial <p>" +
							response.resolucion_historial[$i].fechaResolucionInicial +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_f_fin" +
							$i +
							"'><label> Fecha final <p>" +
							response.resolucion_historial[$i].fechaResolucionFinal +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_anos" +
							$i +
							"'><label> Años resolución: <p>" +
							response.resolucion_historial[$i].añosResolucion +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_num_res" +
							$i +
							"'><label>Número: <p>" +
							response.resolucion_historial[$i].numeroResolucion +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_tipo_hist" +
							$i +
							"'><label>Tipo resolución: <p>" +
							response.resolucion_historial[$i].tipoResolucion +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='ver_res_hist_org" +
							$i +
							"'><a href='" +
							baseURL +
							"uploads/resoluciones/" +
							response.resolucion_historial[$i].resolucion +
							"' target='_blank'>Ver resolución</a></div>"
					);
					$("#demas_res_hist").append("</div>");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".verDatosHistoricosLinea").click(function () {
		var $events = [];
		$id_organizacion_historial = $(this).attr("data-id-org");
		$id_historial = $(this).attr("data-id");
		$("body").append(
			"<div class='hidden' data-id-hist='" +
				$id_historial +
				"' data-id-org='" +
				$id_organizacion_historial +
				"' id='data_hist_org_ver'></div>"
		);

		data = {
			id_organizacion_historial: $id_organizacion_historial,
			id_historial: $id_historial,
		};

		$.ajax({
			url: baseURL + "admin/informacionOrganizacionHistorial",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#lineaTiempo").html("");
				$("#ver_hist_perso").val(response.historial["0"].personeriaJuridica);
				$("#ver_hist_nombres_ser").val(
					response.historial["0"].nombresSeriesAsuntos
				);
				$("#ver_hist_regional").append(
					"<option id='0' value='" +
						response.historial["0"].regional +
						"' selected>" +
						response.historial["0"].regional +
						"</option>"
				);
				$("#ver_hist_regional").selectpicker("refresh");
				$("#ver_hist_fech_ei").val(response.historial["0"].fechaExtremaInicial);
				$("#ver_hist_fech_ef").val(response.historial["0"].fechaExtremaFinal);
				$("#ver_hist_caja").val(response.historial["0"].caja);
				$("#ver_hist_carpeta").val(response.historial["0"].carpeta);
				$("#ver_hist_tomo").val(response.historial["0"].tomo);
				$("#ver_hist_otro").val(response.historial["0"].otros);
				$("#ver_hist_folios").val(response.historial["0"].numeroFolios);
				$("#ver_hist_soporte").append(
					"<option id='0' value='" +
						response.historial["0"].soporte +
						"' selected>" +
						response.historial["0"].soporte +
						"</option>"
				);
				$("#ver_hist_soporte").selectpicker("refresh");
				$("#ver_hist_obser").val(response.historial["0"].observaciones);

				$("#lbl_nombre_org_hist").html(
					response.organizacion["0"].nombreOrganizacion
				);
				$("#nombre_org_hist").val(
					response.organizacion["0"].nombreOrganizacion
				);
				$("#direccion_org_org_hist").val(
					response.organizacion["0"].direccionCorreoElectronicoOrganizacion
				);
				$("#direccion_rep_org_hist").val(
					response.organizacion["0"].direccionCorreoElectronicoRepLegal
				);
				$("#nit_org_hist").val(response.organizacion["0"].numNIT);
				$("#rep_org_hist").val(
					response.organizacion["0"].primerNombreRepLegal +
						" " +
						response.organizacion["0"].segundoNombreRepLegal +
						" " +
						response.organizacion["0"].primerApellidoRepLegal +
						" " +
						response.organizacion["0"].segundoApellidoRepLegal
				);
				$("#sigla_org_hist").val(response.organizacion["0"].sigla);
				$("#res_fech_inicio").val(
					response.resolucion_historial["0"].fechaResolucionInicial
				);
				$("#res_fech_fin").val(
					response.resolucion_historial["0"].fechaResolucionFinal
				);
				$("#demas_res_hist").empty();
				for (var $i = 0; $i < response.resolucion_historial.length; $i++) {
					$("#demas_res_hist").append(
						'<div class="col-md-2" id="hist_res' + $i + '">'
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_i_inicio" +
							$i +
							"'><label> Fecha inicial <p>" +
							response.resolucion_historial[$i].fechaResolucionInicial +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_f_fin" +
							$i +
							"'><label> Fecha final <p>" +
							response.resolucion_historial[$i].fechaResolucionFinal +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_anos" +
							$i +
							"'><label> Años resolución: <p>" +
							response.resolucion_historial[$i].añosResolucion +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_num_res" +
							$i +
							"'><label>Número: <p>" +
							response.resolucion_historial[$i].numeroResolucion +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='res_fech_tipo_hist" +
							$i +
							"'><label>Tipo resolución: <p>" +
							response.resolucion_historial[$i].tipoResolucion +
							"</p></label></div>"
					);
					$("#demas_res_hist > #hist_res" + $i).append(
						"<div class='form-group' id='ver_res_hist_org" +
							$i +
							"'><a href='" +
							baseURL +
							"uploads/resoluciones/" +
							response.resolucion_historial[$i].resolucion +
							"' target='_blank'>Ver resolución</a></div>"
					);
					$("#demas_res_hist").append("</div>");

					$fecha = {
						id: $i,
						content:
							"Tipo: " + response.resolucion_historial[$i].tipoResolucion,
						start: response.resolucion_historial[$i].fechaResolucionInicial,
						end: response.resolucion_historial[$i].fechaResolucionFinal,
					};

					$events.push($fecha);
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});

		var container = document.getElementById("verLineaTiempo");
		// Create a DataSet (allows two way data-binding)
		console.log($events);

		items = new vis.DataSet($events);
		console.log(items);
		var options = { start: "2000-01-01" };
		var timeline = new vis.Timeline(container, items, options);

		$("#verLineaTiempo").slideDown();
	});

	/*$("#verHistObs").draggable({
		handle: ".modal-dialog"
	});*/

	dragDivFormById("verHistObs");

	$("#verHistObs").on("shown.bs.modal", function () {
		$(document).off("focusin.modal");
	});

	$("#verHistObs>div>div>.modal-body").resizable({ alsoResize: "#verHistObs" });

	/**
		Termina Eventos Cliks
	**/
	// ____________________________________________________________________________________________________________
	// ____________________________________________________________________________________________________________

	/**
		Se añade a JqueryValdate el metodo para aceptar regex en rules.
	**/
	$.validator.addMethod(
		"regex",
		function (value, element, regexp) {
			var re = new RegExp(regexp);
			return this.optional(element) || re.test(value);
		},
		"Please check your input."
	);

	$("#archivoExcelAsistentes").click(function () {
		$("#guardarArchivoAsistentes").attr("disabled", false);
	});

	$("#guardarArchivoAsistentes").attr("disabled", true);

	/**
		Cambiar el Municipio segun seleccion de departamento.
	**/
	$(".departamentos").change(function () {
		var data_id = $(this).attr("data-id-dep");

		if (data_id == "1") {
			select_mun = $("#municipios");
			data_depto = $("#departamentos").val();
			div_mun = $("#div_municipios");
		}
		if (data_id == "2") {
			data_depto = $("#departamentos2").val();
			select_mun = $("#municipios2");
			div_mun = $("#div_municipios2");
		}
		if (data_id == "3") {
			data_depto = $("#departamentos3").val();
			select_mun = $("#municipios3");
			div_mun = $("#div_municipios3");
		}
		if (data_id == "4") {
			data_depto = $("#informe_departamento_curso").val();
			select_mun = $("#informe_municipio_curso");
			div_mun = $("#div_municipios4");
		}
		if (data_id == "5") {
			data_depto = $("#informe_departamento_asistente").val();
			select_mun = $("#informe_municipio_asistente");
			div_mun = $("#div_municipios5");
		}
		if (data_id == "6") {
			data_depto = $("#telefonicoDepartamento").val();
			select_mun = $("#telefonicoMunicipio");
			div_mun = $("#div_municipios6");
		}
		var data_de = {
			departamento: data_depto,
		};
		$.ajax({
			url: baseURL + "panel/cargarMunicipios",
			type: "post",
			dataType: "JSON",
			data: data_de,
			success: function (response) {
				select_mun.empty();
				div_mun.show();
				for (var i = 0; i < response.length; i++) {
					var responseNombreMunicipio = response[i].nombreMunicipio.replace(
						/ /g,
						"&nbsp;"
					);
					select_mun.append(
						"<option id=" +
							response[i].id_municipio +
							" value=" +
							responseNombreMunicipio +
							">" +
							response[i].nombreMunicipio +
							"</option>"
					);
				}
				select_mun.selectpicker("refresh");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	/**
		Para mostrar extension
	**/
	$("#extension_checkbox").click(function () {
		if ($("#extension_checkbox").prop("checked")) {
			$("#div_extension").show();
		} else {
			$("#div_extension").hide();
		}
	});

	$(".dataReload").click(function () {
		cargarArchivos();
		notificacion("Archivos cargados...");
	});

	$(".guardar").click(function () {
		$(".archivos").toggle();
	});

	$("#finalizar_no").click(function () {
		$("#sidebar-menu>.menu_section>a").click();
	});

	$("#fechaVisita").val("2017-01-01T18:59:59");
	$("#telefonicoFecha").val("2017-01-01T18:59:59");

	cont_desc = 2;
	$("#nueva_desc").click(function () {
		console.log(cont_desc);
		if (cont_desc >= 2 && cont_desc != 12) {
			$(".div_desc").append('<div class="descripciones" id="descrp_' + cont_desc + '">');
			$(".div_desc>#descrp_" + cont_desc + "").append('<div class="form-group txt_descripcion" id="form-group-desc-' + cont_desc + '">');
			$(".div_desc>#descrp_" + cont_desc + ">#form-group-desc-" + cont_desc + "").append("<label>" + cont_desc + ". Descripcion:</label>");
			$(".div_desc>#descrp_" + cont_desc + ">#form-group-desc-" + cont_desc + "").append('<textarea class="form-control" rows="3" placeholder="Escriba aquí la descripción..."></textarea>');
			$(".div_desc>#descrp_" + cont_desc + ">#form-group-desc-" + cont_desc + "").append("</div>");
			$(".div_desc>#descrp_" + cont_desc + "").append('<div class="form-group txt_fecha" id="form-group-fecha-' + cont_desc + '">');
			$(".div_desc>#descrp_" + cont_desc + ">#form-group-fecha-" + cont_desc + "").append("<label>" + cont_desc + ". Fecha:</label>");
			$(".div_desc>#descrp_" + cont_desc + ">#form-group-fecha-" + cont_desc + "").append('<input type="date" name="" id="" class="form-control" value="">');
			$(".div_desc>#descrp_" +
					cont_desc +
					">#form-group-fecha-" +
					cont_desc +
					""
			).append("</div>");

			$(".div_desc>#descrp_" + cont_desc + "").append("</div>");
			$(".div_desc>#descrp_" + cont_desc + "").append("<hr/>");
			$(".div_desc").append("</div>");
			cont_desc++;
			if (cont_desc == 12) {
				$(".div_desc>div").last().remove();
				cont_desc--;
			}
		} else {
			$(".div_desc>div").last().remove();
			cont_desc--;
		}
	});

	$("#presionar_firma_eval").click(function () {
		$id_organizacion = $("#id_org_visita_eval").attr("data-id");

		data = {
			id_organizacion: $id_organizacion,
		};

		$(this).remove();

		$.ajax({
			url: baseURL + "admin/cargar_datosBasicosOrganizacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#eval_firma_rep_legal").attr(
					"src",
					baseURL +
						"uploads/logosOrganizaciones/firma/" +
						response.data_organizacion.firmaRepLegal
				);
				$("#eval_firma_rep_legal").show();
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#terminar_eval").click(function () {
		$(this).prop("disabled", true);
		$id_organizacion = $("#id_org_visita_eval").attr("data-id");
		$id_visita = $("#id_org_visita_eval").attr("data-id-visita");
		$certificadoExistencia = $(
			"input:radio[name=certificadoExistencia]:checked"
		).val();
		$matriculaMercantil = $(
			"input:radio[name=matriculaMercantil]:checked"
		).val();
		$actividadesEducacion = $(
			"input:radio[name=actividadesEducacion]:checked"
		).val();
		$domicilio = $("input:radio[name=domicilio]:checked").val();
		$datosRepLegal = $("input:radio[name=datosRepLegal]:checked").val();
		$fechaVigenciaCertificado = $(
			"input:radio[name=fechaVigenciaCertificado]:checked"
		).val();
		$metodologiaAcreditada = $(
			"input:radio[name=metodologiaAcreditada]:checked"
		).val();
		$materialDidactico = $("input:radio[name=materialDidactico]:checked").val();
		$contenidosEducativo = $(
			"input:radio[name=contenidosEducativo]:checked"
		).val();
		$socializacionConceptos = $(
			"input:radio[name=socializacionConceptos]:checked"
		).val();
		$contextoSocioEconomico = $(
			"input:radio[name=contextoSocioEconomico]:checked"
		).val();
		$tiposOrganizacionesSolidarias = $(
			"input:radio[name=tiposOrganizacionesSolidarias]:checked"
		).val();
		$entesControlyApoyo = $(
			"input:radio[name=entesControlyApoyo]:checked"
		).val();
		$avalCursos = $("input:radio[name=avalCursos]:checked").val();
		$otrosProgramas = $("input:radio[name=otrosProgramas]:checked").val();
		$contenidosProgramas = $(
			"input:radio[name=contenidosProgramas]:checked"
		).val();
		$actualizacionDatosUnidad = $(
			"input:radio[name=actualizacionDatosUnidad]:checked"
		).val();
		$suministroInformacionVisitas = $(
			"input:radio[name=suministroInformacionVisitas]:checked"
		).val();
		$entregaInformesActividades = $(
			"input:radio[name=entregaInformesActividades]:checked"
		).val();
		$docentesHabilitados = $(
			"input:radio[name=docentesHabilitados]:checked"
		).val();
		$archivoHistoricoEducacion = $(
			"input:radio[name=archivoHistoricoEducacion]:checked"
		).val();
		$cursosSolidaridadEducativa = $(
			"input:radio[name=cursosSolidaridadEducativa]:checked"
		).val();
		$subcontratacionTerceros = $(
			"input:radio[name=subcontratacionTerceros]:checked"
		).val();
		$cotejoCertificacionesCurso = $(
			"input:radio[name=cotejoCertificacionesCurso]:checked"
		).val();
		$actualizacionHojaVidaDocentes = $(
			"input:radio[name=actualizacionHojaVidaDocentes]:checked"
		).val();
		$hallazgos = $("#hallazgos").val();

		data = {
			certificadoExistencia: $certificadoExistencia,
			matriculaMercantil: $matriculaMercantil,
			actividadesEducacion: $actividadesEducacion,
			domicilio: $domicilio,
			datosRepLegal: $datosRepLegal,
			fechaVigenciaCertificado: $fechaVigenciaCertificado,
			metodologiaAcreditada: $metodologiaAcreditada,
			materialDidactico: $materialDidactico,
			contenidosEducativo: $contenidosEducativo,
			socializacionConceptos: $socializacionConceptos,
			contextoSocioEconomico: $contextoSocioEconomico,
			tiposOrganizacionesSolidarias: $tiposOrganizacionesSolidarias,
			entesControlyApoyo: $entesControlyApoyo,
			avalCursos: $avalCursos,
			otrosProgramas: $otrosProgramas,
			contenidosProgramas: $contenidosProgramas,
			actualizacionDatosUnidad: $actualizacionDatosUnidad,
			suministroInformacionVisitas: $suministroInformacionVisitas,
			entregaInformesActividades: $entregaInformesActividades,
			docentesHabilitados: $docentesHabilitados,
			archivoHistoricoEducacion: $archivoHistoricoEducacion,
			cursosSolidaridadEducativa: $cursosSolidaridadEducativa,
			subcontratacionTerceros: $subcontratacionTerceros,
			cotejoCertificacionesCurso: $cotejoCertificacionesCurso,
			actualizacionHojaVidaDocentes: $actualizacionHojaVidaDocentes,
			hallazgos: $hallazgos,
			id_visita: $id_visita,
		};

		$div_desc = $(".div_desc div.descripciones");
		$data_descripciones = [];
		for ($i = 1; $i < $div_desc.length + 1; $i++) {
			$txt_descripcion = $(
				".descripciones#descrp_" +
					$i +
					">.txt_descripcion#form-group-desc-" +
					$i +
					">textarea"
			).val();
			$txt_fecha = $(
				".descripciones#descrp_" +
					$i +
					">.txt_fecha#form-group-fecha-" +
					$i +
					">input"
			).val();

			data_descripciones = {
				txt_descripcion: $txt_descripcion,
				txt_fecha: $txt_fecha,
				id_organizacion: $id_organizacion,
				id_visita: $id_visita,
			};

			$data_descripciones.push(data_descripciones);
		}

		$.ajax({
			url: baseURL + "admin/guardarSeguimiento",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				for ($i = 0; $i < $data_descripciones.length; $i++) {
					$.ajax({
						url: baseURL + "admin/guardarPlanMejoramiento",
						type: "post",
						dataType: "JSON",
						data: $data_descripciones[$i],
						beforeSend: function () {
							notificacion("Espere, guardando...", "success");
						},
						success: function (response) {
							notificacion(response.msg, "success");
							setInterval(function () {
								window.close();
							}, 5000);
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

		console.log($data_descripciones);
	});

	$("#eliminar_desc").click(function () {
		console.log(cont_desc);
		if (cont_desc >= 3) {
			$(".div_desc>div").last().remove();
			cont_desc--;
		}
	});

	cont_img = 2;
	$("#mas_files_imagenes").click(function () {
		console.log(cont_img);
		if (cont_img >= 2 && cont_img != 12) {
			$("#div_imagenes").append(
				'<input type="file" class="form-control"  accept="image/jpeg, image/png" data-val="lugar" name="lugar[]" id="lugar' +
					cont_img +
					'">'
			);
			cont_img++;
			if (cont_img == 12) {
				$("#div_imagenes>input").last().remove();
				cont_img--;
			}
		} else {
			$("#div_imagenes>input").last().remove();
			cont_img--;
		}
	});

	$("#menos_files_imagenes").click(function () {
		console.log(cont_img);
		if (cont_img >= 3) {
			$("#div_imagenes>input").last().remove();
			cont_img--;
		}
	});

	$("#admin_buscar_org").click(function () {
		$("#panel_admin_organizaciones").slideUp();
		$("#buscar_org").slideDown();
	});
	$("#admin_buscar_org_volver").click(function () {
		$("#panel_admin_organizaciones").slideDown();
		$("#buscar_org").slideUp();
	});
	$("#admin_org_encontradas_volver").click(function () {
		$("#buscar_org").slideDown();
		$("#organizaciones_encontradas").slideUp();
	});
	/**
		Back to top Scroll page :3
	**/

	/**$('input[type=file]').change(functions () {
	        var val = $(this).val().toLowerCase();
	        var regex = new RegExp("(.*?)\.(jpg|png)$");
	        if (!(regex.test(val))) {
	            $(this).val('');
	            mensaje("Selecciona un archivo JPG o PNG.", alert_warning);
	        }
        });**/
	$("#init_sp").click(function () {
		//http://54.202.78.126/sia/activate/?tk:$2a$60$Ae3aCGTfmdxIxABpERW9vOHg6qWG4IRdauEo6a424X4bq8gXldOCbAAj6oW5pZEa6f0=:iop
		var $ps_sp = $("#tpssp").val();
		$(window).attr("location", baseURL + "super/?sp:" + $ps_sp);
	});

	$("#super_nuevo_admin").click(function () {
		var super_primernombre_admin = $("#super_primernombre_admin").val();
		var super_segundonombre_admin = $("#super_segundonombre_admin").val();
		var super_primerapellido_admin = $("#super_primerapellido_admin").val();
		var super_segundoapellido_admin = $("#super_segundoapellido_admin").val();
		var super_numerocedula_admin = $("#super_numerocedula_admin").val();
		var super_correo_electronico_admin = $(
			"#super_correo_electronico_admin"
		).val();
		var super_nombre_admin = $("#super_nombre_admin").val();
		var super_contrasena_admin = $("#super_contrasena_admin").val();
		var super_acceso_nvl = $("#super_acceso_nvl").val();

		data = {
			super_primernombre_admin: super_primernombre_admin,
			super_segundonombre_admin: super_segundonombre_admin,
			super_primerapellido_admin: super_primerapellido_admin,
			super_segundoapellido_admin: super_segundoapellido_admin,
			super_numerocedula_admin: super_numerocedula_admin,
			super_correo_electronico_admin: super_correo_electronico_admin,
			super_nombre_admin: super_nombre_admin,
			super_acceso_nvl: super_acceso_nvl,
			super_contrasena_admin: super_contrasena_admin,
		};

		$.ajax({
			url: baseURL + "super/nuevoAdm",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".super_ver_admin_modal").click(function () {
		$id_adm = $(this).attr("data-id");

		data = {
			id_adm: $id_adm,
		};

		$.ajax({
			url: baseURL + "super/cargarDatosAdministrador",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#super_id_admin_modal").html("");
				$("#super_status_adm").html("");
				$("#super_status_adm").css("color", "white");
				$("#super_status_adm").css("padding", "5px");
				$("#super_id_admin_modal").html($id_adm);
				$("#super_primernombre_admin_modal").val(
					response[0].primerNombreAdministrador
				);
				$("#super_segundonombre_admin_modal").val(
					response[0].segundoNombreAdministrador
				);
				$("#super_primerapellido_admin_modal").val(
					response[0].primerApellidoAdministrador
				);
				$("#super_segundoapellido_admin_modal").val(
					response[0].segundoApellidoAdministrador
				);
				$("#super_numerocedula_admin_modal").val(
					response[0].numCedulaCiudadaniaAdministrador
				);
				$("#super_nombre_admin_modal").val(response[0].usuario);
				$("#super_correo_electronico_admin_modal").val(
					response[0].direccionCorreoElectronico
				);

				$("#super_contrasena_admin_modal").val(response[1]);
				if (response[0].logged_in == 1) {
					$("#super_status_adm").css("background-color", "#398439");
					$("#super_status_adm").html("Estado: En linea");
					$("#super_id_admin_modal").prop("disabled", true);
					$("#super_eliminar_admin").prop("disabled", true);
					$("#super_actualizar_admin").prop("disabled", true);
					$("#super_nombre_admin_modal").prop("disabled", true);
					$("#super_primernombre_admin_modal").prop("disabled", true);
					$("#super_segundonombre_admin_modal").prop("disabled", true);
					$("#super_primerapellido_admin_modal").prop("disabled", true);
					$("#super_segundoapellido_admin_modal").prop("disabled", true);
					$("#super_numerocedula_admin_modal").prop("disabled", true);
					$("#super_contrasena_admin_modal").prop("disabled", true);
					$("#super_correo_electronico_admin_modal").prop("disabled", true);
				} else {
					$("#super_status_adm").css("background-color", "#c61f1b");
					$("#super_status_adm").html("Estado: No conectado");
					$("#super_id_admin_modal").prop("disabled", false);
					$("#super_eliminar_admin").prop("disabled", false);
					$("#super_actualizar_admin").prop("disabled", false);
					$("#super_primernombre_admin_modal").prop("disabled", false);
					$("#super_segundonombre_admin_modal").prop("disabled", false);
					$("#super_primerapellido_admin_modal").prop("disabled", false);
					$("#super_segundoapellido_admin_modal").prop("disabled", false);
					$("#super_numerocedula_admin_modal").prop("disabled", false);
					$("#super_nombre_admin_modal").prop("disabled", false);
					$("#super_contrasena_admin_modal").prop("disabled", false);
					$("#super_correo_electronico_admin_modal").prop("disabled", false);
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#super_eliminar_admin").click(function () {
		$lbl_adm = $("#verAdmin>label").attr("id");
		$id_adm = $("#" + $lbl_adm).html();

		data = {
			id_adm: $id_adm,
		};
		$.ajax({
			url: baseURL + "super/eliminarAdministrador",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#super_actualizar_admin").click(function () {
		console.log("asdsad");
		$lbl_adm = $("#verAdmin>label").attr("id");
		$id_adm = $("#" + $lbl_adm).html();
		$primerNombre = $("#super_primernombre_admin_modal").val();
		$segundoNombre = $("#super_segundonombre_admin_modal").val();
		$primerApellido = $("#super_primerapellido_admin_modal").val();
		$segundoApellido = $("#super_segundoapellido_admin_modal").val();
		$correo_electronico = $("#super_correo_electronico_admin_modal").val();
		$nombre = $("#super_nombre_admin_modal").val();
		$cedula = $("#super_numerocedula_admin_modal").val();
		$contrasena = $("#super_contrasena_admin_modal").val();
		$super_acceso_nvl = $("#super_acceso_nvl_modal").val();

		data = {
			id_adm: $id_adm,
			primerNombre: $primerNombre,
			segundoNombre: $segundoNombre,
			primerApellido: $primerApellido,
			segundoApellido: $segundoApellido,
			nombre: $nombre,
			cedula: $cedula,
			contrasena: $contrasena,
			correo_electronico: $correo_electronico,
			super_acceso_nvl: $super_acceso_nvl,
		};

		$.ajax({
			url: baseURL + "super/actualizarAdministrador",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#guardar_curso_informe").click(function () {
		$informe_asistentes = $("#informe_asistentes").val();
		$informe_numero_mujeres = $("#informe_numero_mujeres").val();
		$informe_numero_hombres = $("#informe_numero_hombres").val();
		$docente_valido = $("#informe_docente").val();

		$suma_asis =
			parseFloat($informe_numero_hombres) + parseFloat($informe_numero_mujeres);
		$informe_asistentes_num = parseFloat($informe_asistentes);

		if (
			($suma_asis != $informe_asistentes_num && $docente_valido == "") ||
			$informe_asistentes == 0 ||
			$informe_asistentes == ""
		) {
			notificacion(
				"Los numeros de los asistentes no coinciden y/o el docente no fue seleccionado, verifique.",
				"success"
			);
			$("#informe_asistentes_numero").html("");
			$("#informe_asistentes_modal").html("");
			$("#llenar_asistentes").prop("disabled", true);
		} else if (
			$informe_asistentes_num > 0 &&
			$docente_valido != "" &&
			$suma_asis == $informe_asistentes_num
		) {
			//if($("#div_llenar_curso").valid()){

			notificacion(
				"Se creo el curso, llene la información de los asistentes.",
				"success"
			);
			$("#div_llenar_curso").slideUp();
			$("#div_btn_asistentes").slideDown();
			$("#numero_asistentes").remove();
			$("body").append(
				"<div class='hidden' id='numero_asistentes' data-numero='" +
					$suma_asis +
					"'></div>"
			);
			$("#informe_asistentes_numero").html($suma_asis);
			$("#informe_asistentes_modal").html($suma_asis);
			$("#asistentes_faltantes").html("1");
			$("#llenar_asistentes").prop("disabled", false);
			$("#informe_atras").prop("disabled", true);
			$asistentes_totales = $("#numero_asistentes").attr("data-numero");
			$asistentes_faltantes = $("#asistentes_faltantes").html();
			if ($asistentes_faltantes == $asistentes_totales) {
				$("#informe_terminar").removeClass("hidden");
				$("#informe_siguiente").prop("disabled", true);
				notificacion("Presione terminar para guardar todo.");
			} else {
				$("#informe_terminar").addClass("hidden");
			}
			//}
		} else {
			notificacion(
				"Los numeros de los asistentes no coinciden y/o el docente no fue seleccionado, verifique.",
				"success"
			);
		}
	});

	$("#volver_div_llenar").click(function () {
		$("#div_btn_asistentes").slideUp();
		$("#div_llenar_curso").slideDown();
	});

	$("#guardarArchivoAsistentes").click(function () {
		$(this).attr("disabled", true);
		$(".informe_restaurar").attr("disabled", true);
		$("#informe_terminar").attr("disabled", true);
		$("#informe_atras").attr("disabled", true);
		$("#informe_siguiente").attr("disabled", true);
		$("#manualAsistentes").slideUp();

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

		$.ajax({
			url: baseURL + "panel/guardar_cursoInformeActividades",
			type: "post",
			dataType: "JSON",
			data: data_curso,
			success: function (response) {
				console.log(response);
				$data_name = $(".archivoAsistencia").attr("data-name");
				var file_data = $("#" + $data_name).prop("files")[0];
				var form_data = new FormData();
				form_data.append("file", file_data);
				form_data.append("append_name", $data_name);

				$.ajax({
					url: baseURL + "panel/archivoAsistencia",
					dataType: "text",
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: "post",
					dataType: "JSON",
					beforeSubmit: function () {
						notificacion(
							"Espere... Subiendo asistencia y verificando...",
							"success"
						);
					},
					success: function (response) {
						$data_name = $(".archivoAsistentes").attr("data-name");
						var file_data = $("#" + $data_name).prop("files")[0];
						var form_data = new FormData();
						form_data.append("file", file_data);
						form_data.append("append_name", $data_name);

						$.ajax({
							url: baseURL + "panel/excelAsistentes",
							dataType: "text",
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,
							type: "post",
							dataType: "JSON",
							beforeSubmit: function () {
								notificacion(
									"Espere... Subiendo asistentes y verificando...",
									"success"
								);
							},
							success: function (response) {
								console.log(response);
								notificacion(response.msg, "success");
								setInterval(function () {
									redirect(baseURL + "panel/informeActividades");
								}, 2000);
							},
							error: function (ev) {
								notificacion(
									"Verifique los datos del formulario de excel.",
									"success"
								);
							},
						});
					},
					error: function (ev) {
						notificacion(
							"Verifique los datos del formulario de excel.",
							"success"
						);
					},
				});
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

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

	$(document).on("click", ".verEsteDocente", function () {
		$posicion = parseFloat($(this).attr("data-pos"));

		$("#id_docente").html($posicion + 1);
		$("#primer_nombre_docente").html(
			$dataDocentes["0"].data[$posicion].primerNombreDocente
		);
		$("#segundo_nombre_docente").html(
			$dataDocentes["0"].data[$posicion].segundoNombreDocente
		);
		$("#primer_apellido_docente").html(
			$dataDocentes["0"].data[$posicion].primerApellidoDocente
		);
		$("#segundo_apellido_docente").html(
			$dataDocentes["0"].data[$posicion].segundoApellidoDocente
		);
		$("#numero_cedula_docente").html(
			$dataDocentes["0"].data[$posicion].numCedulaCiudadaniaDocente
		);
		$("#profesion_docente").html($dataDocentes["0"].data[$posicion].profesion);
		$("#horas_cap_docente").html(
			$dataDocentes["0"].data[$posicion].horaCapacitacion
		);
		if ($dataDocentes["0"].data[$posicion].valido == 1) {
			$("#valido_docente").html("Sí");
			$("#valido_docente").css("background-color", "green");
		} else {
			$("#valido_docente").html("No");
			$("#valido_docente").css("background-color", "orange");
			$("#obs_val_docente").html(
				$dataDocentes["0"].data[$posicion].observacion
			);
			$("#obs_valAnt_docente").html(
				$dataDocentes["0"].data[$posicion].observacionAnterior
			);
		}
		$(".docente_").attr(
			"data-id",
			$dataDocentes["0"].data[$posicion].id_docente
		);

		$("#tbodyArchivosDocen").html("");
		$("#tbodyArchivosDocen").empty();
		for (
			$j = 0;
			$j < $dataArchivos["0"].data_archivos[$posicion].length;
			$j++
		) {
			if (
				$dataArchivos["0"].data_archivos[$posicion][$j].tipo ==
				"docenteHojaVida"
			) {
				$carpeta = baseURL + "uploads/docentes/hojasVida/";
			} else if (
				$dataArchivos["0"].data_archivos[$posicion][$j].tipo == "docenteTitulo"
			) {
				$carpeta = baseURL + "uploads/docentes/titulos/";
			} else if (
				$dataArchivos["0"].data_archivos[$posicion][$j].tipo ==
				"docenteCertificados"
			) {
				$carpeta = baseURL + "uploads/docentes/certificados/";
			} else if (
				$dataArchivos["0"].data_archivos[$posicion][$j].tipo ==
				"docenteCertificadosEconomia"
			) {
				$carpeta = baseURL + "uploads/docentes/certificadosEconomia/";
			}

			var tipo_r = $dataArchivos["0"].data_archivos[$posicion][$j].tipo
				.replace('"', "")
				.replace('"', "");
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
			$("<tr>").appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				"<td><small>" +
					"<button class='btn btn-sm btn-siia'><a class='docVistoArch' href='" +
					$carpeta +
					$dataArchivos["0"].data_archivos[$posicion][$j].nombre +
					"' target='_blank'>" +
					$dataArchivos["0"].data_archivos[$posicion][$j].nombre +
					"</a></button>" +
					"</small></td>"
			).appendTo(".tabla_form > #tbodyArchivosDocen");
			$("<td>" + $tipo + "</td>").appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				'<td><textarea id="archivoDoc' +
					$dataArchivos["0"].data_archivos[$posicion][$j].id_archivosDocente +
					'" class="form-control">' +
					$dataArchivos["0"].data_archivos[$posicion][$j].observacionArchivo +
					"</textarea></td>"
			).appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				'<td><button data-id="' +
					$dataArchivos["0"].data_archivos[$posicion][$j].id_archivosDocente +
					'" class="btn btn-success btn-sm guardarObsArchivoDoc">Guardar <i class="fa fa-check-circle-o" aria-hidden="true"></i></button></td>'
			).appendTo(".tabla_form > #tbodyArchivosDocen");

			$("</tr>").appendTo(".tabla_form > #tbodyArchivosDocen");

			//$("#documentos_docente").append("<a class='docVistoArch' href='"+$carpeta+$dataArchivos['0'].data_archivos[$posicion][$j].nombre+"' target='_blank'>"+$dataArchivos['0'].data_archivos[$posicion][$j].nombre+"</a><br>");
		}
		$("#informacion_docentes").addClass("animated slideInUp");
		setTimeout(function () {
			$("#informacion_docentes").removeClass("animated slideInUp");
		}, 1000);
	});

	$(document).on("click", ".docVistoArch", function () {
		$(this).append(
			' - <i class="fa fa-eye" aria-hidden="true" style="background-color:orange;color:white;font-size:1.7rem;padding:2px;"></i>'
		);
	});

	var $dataDocentes = [];
	var $dataArchivos = [];
	$(".ver_organizacion_docentes").click(function () {
		var $id_org = $(this).attr("data-organizacion");
		console.log($id_org);

		data = {
			id_organizacion: $id_org,
		};
		$.ajax({
			url: baseURL + "admin/cargar_docentesOrganizacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#organizaciones_docentes").slideUp();
				$("#docentes_organizaciones").slideDown();
				$("#cantidadDocentesOrg").html(response.numeroDocentes);
				$dataDocentes.push({ data: response.docentes });
				$dataArchivos.push({ data_archivos: response.archivos });
				console.log($dataDocentes);
				console.log($dataArchivos);
				$("#tbody_orgDocentes").html("");
				$("#tbody_orgDocentes").empty();
				for ($i = 0; $i < $dataDocentes["0"].data.length; $i++) {
					//tbody_orgDocentes
					console.log();
					$("#tbody_orgDocentes").append(
						"<tr id='tDocentT" + $dataDocentes["0"].data[$i].id_docente + "'>"
					);
					$(
						"#tbody_orgDocentes>tr#tDocentT" +
							$dataDocentes["0"].data[$i].id_docente
					).append(
						"<td>" +
							$dataDocentes["0"].data[$i].primerNombreDocente +
							" " +
							$dataDocentes["0"].data[$i].primerApellidoDocente +
							"</td>"
					);
					$(
						"#tbody_orgDocentes>tr#tDocentT" +
							$dataDocentes["0"].data[$i].id_docente
					).append(
						"<td>" +
							$dataDocentes["0"].data[$i].numCedulaCiudadaniaDocente +
							"</td>"
					);
					$(
						"#tbody_orgDocentes>tr#tDocentT" +
							$dataDocentes["0"].data[$i].id_docente
					).append("<td>" + $dataDocentes["0"].data[$i].profesion + "</td>");
					$(
						"#tbody_orgDocentes>tr#tDocentT" +
							$dataDocentes["0"].data[$i].id_docente
					).append(
						"<td>" + $dataDocentes["0"].data[$i].horaCapacitacion + "</td>"
					);
					if ($dataDocentes["0"].data[$i].valido == 1) {
						$(
							"#tbody_orgDocentes>tr#tDocentT" +
								$dataDocentes["0"].data[$i].id_docente
						).append("<td style='background-color:green;color:white;'>Sí</td>");
					} else {
						$(
							"#tbody_orgDocentes>tr#tDocentT" +
								$dataDocentes["0"].data[$i].id_docente
						).append(
							"<td style='background-color:orange;color:white;'>Pendiente por cumplimiento de requisitos</td>"
						);
					}
					$(
						"#tbody_orgDocentes>tr#tDocentT" +
							$dataDocentes["0"].data[$i].id_docente
					).append(
						"<td><button class='btn btn-sm btn-siia verEsteDocente' data-total='" +
							$dataDocentes["0"].data.length +
							"' data-pos='" +
							$i +
							"' data-id='" +
							$dataDocentes["0"].data[$i].id_docente +
							"'>Ver <i class='fa fa-eye' aria-hidden='true'></i></button></td>"
					);
					//$("#tbody_orgDocentes>tr#"+i+"").append("<td>"+response.observaciones[i].idSolicitud+"</td>");
					$("#tbody_orgDocentes").append("</tr>");
				}
				//$("#informacion_organizacion").removeClass("col-md-12");
				//$("#informacion_organizacion").addClass("col-md-3");
				setInterval(function () {
					$("#informacion_docentes").show(
						"slide",
						{ direction: "right" },
						1000
					);
				}, 500);
				$("#anteriorDocente").prop("disabled", true);
				$("#id_docente").html("1");
				$("#nombre_organizacion").html(
					response.organizacion["0"].nombreOrganizacion
				);
				$("#numero_nit").html(response.organizacion["0"].numNIT);
				$("#sigla_org").html(response.organizacion["0"].sigla);
				$("#dir_cor_org").html(
					response.organizacion["0"].direccionCorreoElectronicoOrganizacion
				);
				$("#dir_cor_rep").html(
					response.organizacion["0"].direccionCorreoElectronicoRepLegal
				);
				$("#nombre_rep_legal").html(
					response.organizacion["0"].primerNombreRepLegal +
						" " +
						response.organizacion["0"].segundoNombreRepLegal +
						" " +
						response.organizacion["0"].primerApellidoRepLegal +
						" " +
						response.organizacion["0"].segundoApellidoRepLegal
				);

				$("#primer_nombre_docente").html(
					$dataDocentes["0"].data["0"].primerNombreDocente
				);
				$("#segundo_nombre_docente").html(
					$dataDocentes["0"].data["0"].segundoNombreDocente
				);
				$("#primer_apellido_docente").html(
					$dataDocentes["0"].data["0"].primerApellidoDocente
				);
				$("#segundo_apellido_docente").html(
					$dataDocentes["0"].data["0"].segundoApellidoDocente
				);
				$("#numero_cedula_docente").html(
					$dataDocentes["0"].data["0"].numCedulaCiudadaniaDocente
				);
				$("#profesion_docente").html($dataDocentes["0"].data["0"].profesion);
				$("#horas_cap_docente").html(
					$dataDocentes["0"].data["0"].horaCapacitacion
				);

				if ($dataDocentes["0"].data["0"].valido == 1) {
					$("#valido_docente").html("Sí");
					$("#valido_docente").css("background-color", "green");
				} else {
					$("#valido_docente").html("Pendiente por cumplimiento de requisitos");
					$("#valido_docente").css("background-color", "orange");
					$("#obs_val_docente").html($dataDocentes["0"].data["0"].observacion);
					$("#obs_valAnt_docente").html(
						$dataDocentes["0"].data["0"].observacionAnterior
					);
				}
				$(".docente_").attr("data-id", $dataDocentes["0"].data["0"].id_docente);
				if ($dataDocentes["0"].data.length == 1) {
					$("#siguienteDocente").prop("disabled", true);
				}

				$("#tbodyArchivosDocen").html("");
				$("#tbodyArchivosDocen").empty();
				for ($j = 0; $j < $dataArchivos["0"].data_archivos["0"].length; $j++) {
					if (
						$dataArchivos["0"].data_archivos["0"][$j].tipo == "docenteHojaVida"
					) {
						$carpeta = baseURL + "uploads/docentes/hojasVida/";
					} else if (
						$dataArchivos["0"].data_archivos["0"][$j].tipo == "docenteTitulo"
					) {
						$carpeta = baseURL + "uploads/docentes/titulos/";
					} else if (
						$dataArchivos["0"].data_archivos["0"][$j].tipo ==
						"docenteCertificados"
					) {
						$carpeta = baseURL + "uploads/docentes/certificados/";
					} else if (
						$dataArchivos["0"].data_archivos["0"][$j].tipo ==
						"docenteCertificadosEconomia"
					) {
						$carpeta = baseURL + "uploads/docentes/certificadosEconomia/";
					}
					var tipo_r = $dataArchivos["0"].data_archivos["0"][$j].tipo
						.replace('"', "")
						.replace('"', "");
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
					$("<tr>").appendTo(".tabla_form > #tbodyArchivosDocen");
					$(
						"<td><small>" +
							"<button class='btn btn-sm btn-siia'><a class='docVistoArch' href='" +
							$carpeta +
							$dataArchivos["0"].data_archivos["0"][$j].nombre +
							"' target='_blank'>" +
							$dataArchivos["0"].data_archivos["0"][$j].nombre +
							"</a></button>" +
							"</small></td>"
					).appendTo(".tabla_form > #tbodyArchivosDocen");
					$("<td>" + $tipo + "</td>").appendTo(
						".tabla_form > #tbodyArchivosDocen"
					);
					$(
						'<td><textarea id="archivoDoc' +
							$dataArchivos["0"].data_archivos["0"][$j].id_archivosDocente +
							'" class="form-control">' +
							$dataArchivos["0"].data_archivos["0"][$j].observacionArchivo +
							"</textarea></td>"
					).appendTo(".tabla_form > #tbodyArchivosDocen");
					$(
						'<td><button data-id="' +
							$dataArchivos["0"].data_archivos["0"][$j].id_archivosDocente +
							'" class="btn btn-success btn-sm guardarObsArchivoDoc">Guardar <i class="fa fa-check-circle-o" aria-hidden="true"></i></button></td>'
					).appendTo(".tabla_form > #tbodyArchivosDocen");

					//$("#documentos_docente").append("<a class='docVistoArch' href='"+$carpeta+$dataArchivos['0'].data_archivos['0'][$j].nombre+"' target='_blank'>"+$dataArchivos['0'].data_archivos['0'][$j].nombre+"</a><br>");
					$("</tr>").appendTo(".tabla_form > #tbodyArchivosDocen");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#anteriorDocente").click(function () {
		$num_doc = $("#id_docente").html();
		$num_doc = parseFloat($num_doc) - 2;
		$("#id_docente").html($num_doc + 1);
		console.log($num_doc);
		$("#primer_nombre_docente").html(
			$dataDocentes["0"].data[$num_doc].primerNombreDocente
		);
		$("#segundo_nombre_docente").html(
			$dataDocentes["0"].data[$num_doc].segundoNombreDocente
		);
		$("#primer_apellido_docente").html(
			$dataDocentes["0"].data[$num_doc].primerApellidoDocente
		);
		$("#segundo_apellido_docente").html(
			$dataDocentes["0"].data[$num_doc].segundoApellidoDocente
		);
		$("#numero_cedula_docente").html(
			$dataDocentes["0"].data[$num_doc].numCedulaCiudadaniaDocente
		);
		$("#profesion_docente").html($dataDocentes["0"].data[$num_doc].profesion);
		$("#horas_cap_docente").html(
			$dataDocentes["0"].data[$num_doc].horaCapacitacion
		);
		if ($dataDocentes["0"].data[$num_doc].valido == 1) {
			$("#valido_docente").html("Sí");
			$("#valido_docente").css("background-color", "green");
		} else {
			$("#valido_docente").html("No");
			$("#valido_docente").css("background-color", "orange");
			$("#obs_val_docente").html($dataDocentes["0"].data[$num_doc].observacion);
			$("#obs_valAnt_docente").html(
				$dataDocentes["0"].data[$num_doc].observacionAnterior
			);
		}
		$(".docente_").attr(
			"data-id",
			$dataDocentes["0"].data[$num_doc].id_docente
		);
		if ($num_doc + 1 == 1) {
			$(this).prop("disabled", true);
			$("#siguienteDocente").prop("disabled", false);
		} else {
			$(this).prop("disabled", false);
			$("#siguienteDocente").prop("disabled", true);
		}

		$("#tbodyArchivosDocen").html("");
		$("#tbodyArchivosDocen").empty();
		for ($j = 0; $j < $dataArchivos["0"].data_archivos[$num_doc].length; $j++) {
			if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo == "docenteHojaVida"
			) {
				$carpeta = baseURL + "uploads/docentes/hojasVida/";
			} else if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo == "docenteTitulo"
			) {
				$carpeta = baseURL + "uploads/docentes/titulos/";
			} else if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo ==
				"docenteCertificados"
			) {
				$carpeta = baseURL + "uploads/docentes/certificados/";
			} else if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo ==
				"docenteCertificadosEconomia"
			) {
				$carpeta = baseURL + "uploads/docentes/certificadosEconomia/";
			}

			var tipo_r = $dataArchivos["0"].data_archivos[$num_doc][$j].tipo
				.replace('"', "")
				.replace('"', "");
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
			$("<tr>").appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				"<td><small>" +
					"<button class='btn btn-sm btn-siia'><a class='docVistoArch' href='" +
					$carpeta +
					$dataArchivos["0"].data_archivos[$num_doc][$j].nombre +
					"' target='_blank'>" +
					$dataArchivos["0"].data_archivos[$num_doc][$j].nombre +
					"</a></button>" +
					"</small></td>"
			).appendTo(".tabla_form > #tbodyArchivosDocen");
			$("<td>" + $tipo + "</td>").appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				'<td><textarea id="archivoDoc' +
					$dataArchivos["0"].data_archivos[$num_doc][$j].id_archivosDocente +
					'" class="form-control">' +
					$dataArchivos["0"].data_archivos[$num_doc][$j].observacionArchivo +
					"</textarea></td>"
			).appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				'<td><button data-id="' +
					$dataArchivos["0"].data_archivos[$num_doc][$j].id_archivosDocente +
					'" class="btn btn-success btn-sm guardarObsArchivoDoc">Guardar <i class="fa fa-check-circle-o" aria-hidden="true"></i></button></td>'
			).appendTo(".tabla_form > #tbodyArchivosDocen");

			$("</tr>").appendTo(".tabla_form > #tbodyArchivosDocen");

			//$("#documentos_docente").append("<a class='docVistoArch' href='"+$carpeta+$dataArchivos['0'].data_archivos[$num_doc][$j].nombre+"' target='_blank'>"+$dataArchivos['0'].data_archivos[$num_doc][$j].nombre+"</a><br>");
		}
	});

	$("#siguienteDocente").click(function () {
		$num_doc = $("#id_docente").html();
		$("#id_docente").html(parseFloat($num_doc) + 1);
		$("#primer_nombre_docente").html(
			$dataDocentes["0"].data[$num_doc].primerNombreDocente
		);
		$("#segundo_nombre_docente").html(
			$dataDocentes["0"].data[$num_doc].segundoNombreDocente
		);
		$("#primer_apellido_docente").html(
			$dataDocentes["0"].data[$num_doc].primerApellidoDocente
		);
		$("#segundo_apellido_docente").html(
			$dataDocentes["0"].data[$num_doc].segundoApellidoDocente
		);
		$("#numero_cedula_docente").html(
			$dataDocentes["0"].data[$num_doc].numCedulaCiudadaniaDocente
		);
		$("#profesion_docente").html($dataDocentes["0"].data[$num_doc].profesion);
		$("#horas_cap_docente").html(
			$dataDocentes["0"].data[$num_doc].horaCapacitacion
		);
		if ($dataDocentes["0"].data[$num_doc].valido == 1) {
			$("#valido_docente").html("Sí");
			$("#valido_docente").css("background-color", "green");
		} else {
			$("#valido_docente").html("No");
			$("#valido_docente").css("background-color", "orange");
			$("#obs_val_docente").html($dataDocentes["0"].data[$num_doc].observacion);
			$("#obs_valAnt_docente").html(
				$dataDocentes["0"].data[$num_doc].observacionAnterior
			);
		}
		$(".docente_").attr(
			"data-id",
			$dataDocentes["0"].data[$num_doc].id_docente
		);
		if (parseFloat($num_doc) + 1 == $dataDocentes["0"].data.length) {
			$(this).prop("disabled", true);
			$("#anteriorDocente").prop("disabled", false);
		} else {
			$(this).prop("disabled", false);
			$("#anteriorDocente").prop("disabled", false);
		}

		$("#tbodyArchivosDocen").html("");
		$("#tbodyArchivosDocen").empty();
		for ($j = 0; $j < $dataArchivos["0"].data_archivos[$num_doc].length; $j++) {
			if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo == "docenteHojaVida"
			) {
				$carpeta = baseURL + "uploads/docentes/hojasVida/";
			} else if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo == "docenteTitulo"
			) {
				$carpeta = baseURL + "uploads/docentes/titulos/";
			} else if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo ==
				"docenteCertificados"
			) {
				$carpeta = baseURL + "uploads/docentes/certificados/";
			} else if (
				$dataArchivos["0"].data_archivos[$num_doc][$j].tipo ==
				"docenteCertificadosEconomia"
			) {
				$carpeta = baseURL + "uploads/docentes/certificadosEconomia/";
			}

			var tipo_r = $dataArchivos["0"].data_archivos[$num_doc][$j].tipo
				.replace('"', "")
				.replace('"', "");
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
			$("<tr>").appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				"<td><small>" +
					"<button class='btn btn-sm btn-siia'><a class='docVistoArch' href='" +
					$carpeta +
					$dataArchivos["0"].data_archivos[$num_doc][$j].nombre +
					"' target='_blank'>" +
					$dataArchivos["0"].data_archivos[$num_doc][$j].nombre +
					"</a></button>" +
					"</small></td>"
			).appendTo(".tabla_form > #tbodyArchivosDocen");
			$("<td>" + $tipo + "</td>").appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				'<td><textarea id="archivoDoc' +
					$dataArchivos["0"].data_archivos[$num_doc][$j].id_archivosDocente +
					'" class="form-control">' +
					$dataArchivos["0"].data_archivos[$num_doc][$j].observacionArchivo +
					"</textarea></td>"
			).appendTo(".tabla_form > #tbodyArchivosDocen");
			$(
				'<td><button data-id="' +
					$dataArchivos["0"].data_archivos[$num_doc][$j].id_archivosDocente +
					'" class="btn btn-success btn-sm guardarObsArchivoDoc">Guardar <i class="fa fa-check-circle-o" aria-hidden="true"></i></button></td>'
			).appendTo(".tabla_form > #tbodyArchivosDocen");

			$("</tr>").appendTo(".tabla_form > #tbodyArchivosDocen");

			//$("#documentos_docente").append("<a class='docVistoArch' href='"+$carpeta+$dataArchivos['0'].data_archivos[$num_doc][$j].nombre+"' target='_blank'>"+$dataArchivos['0'].data_archivos[$num_doc][$j].nombre+"</a><br>");
		}
	});

	$(document).on("click", ".guardarObsArchivoDoc", function () {
		$id_archivoDocente = $(this).attr("data-id");
		$observacionArchivo = $(this)
			.parent("td")
			.siblings("td")
			.children("textarea#archivoDoc" + $id_archivoDocente)
			.val();

		console.log($id_archivoDocente);
		console.log($observacionArchivo);

		data = {
			id_archivoDocente: $id_archivoDocente,
			observacionArchivo: $observacionArchivo,
		};

		$.ajax({
			url: baseURL + "admin/actualizarArchivoDocente",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".verDocenteOrg").click(function () {
		$nombre_docente = $(this).attr("data-nombre");
		$id_docente = $(this).attr("data-id");

		data = {
			id_docente: $id_docente,
		};

		$.ajax({
			url: baseURL + "panel/cargarInformacionDocente",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#nombre_doc").html($nombre_docente);
				$("#nombre_doc").attr("data-id", $id_docente);
				$("#siEliminarDocente").attr("data-id", $id_docente);
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
				$("body").append(
					"<div data-docente-id='" +
						$id_docente +
						"' id='docente_arch_id'></div>"
				);
				cargarArchivosDocente($id_docente);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});


	$("#crr_hist_obs").click(function () {
		$("#tbody_hist_obs").empty();
		$("#tbody_hist_obs").html("");
	});
	// TODO: Actualizar docente
	$("#actualizar_docente").click(function () {
		$id_docente = $("#nombre_doc").attr("data-id");
		$primer_nombre_doc = $("#primer_nombre_doc").val();
		$segundo_nombre_doc = $("#segundo_nombre_doc").val();
		$primer_apellido_doc = $("#primer_apellido_doc").val();
		$segundo_apellido_doc = $("#segundo_apellido_doc").val();
		$numero_cedula_doc = $("#numero_cedula_doc").val();
		$profesion_doc = $("#profesion_doc").val();
		$horas_doc = $("#horas_doc").val();
		$solicitud = $(".actualizar_docente").val();

		data = {
			id_docente: $id_docente,
			primer_nombre_doc: $primer_nombre_doc,
			segundo_nombre_doc: $segundo_nombre_doc,
			primer_apellido_doc: $primer_apellido_doc,
			segundo_apellido_doc: $segundo_apellido_doc,
			numero_cedula_doc: $numero_cedula_doc,
			profesion_doc: $profesion_doc,
			horas_doc: $horas_doc,
			solicitud: $solicitud,
		};

		$.ajax({
			url: baseURL + "panel/actualizarDocente",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Actualizando docente, espere...", "success");
			},
			success: function (response) {
				notificacion(response.msg + " Espere...", "success");
				setInterval(function () {
					redirect(baseURL + "panel/docentes");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#añadirNuevoDocente").click(function () {
		if ($("#formulario_docentes").valid()) {
			var cedula = $("#docentes_cedula").val();
			var primer_nombre = $("#docentes_primer_nombre").val();
			var segundo_nombre = $("#docentes_segundo_nombre").val();
			var primer_apellido = $("#docentes_primer_apellido").val();
			var segundo_apellido = $("#docentes_segundo_apellido").val();
			var profesion = $("#docentes_profesion").val();
			var horas = $("#docentes_horas").val();

			data = {
				cedula: cedula,
				primer_nombre: primer_nombre,
				segundo_nombre: segundo_nombre,
				primer_apellido: primer_apellido,
				segundo_apellido: segundo_apellido,
				profesion: profesion,
				horas: horas,
				valido: 0,
			};

			$.ajax({
				url: baseURL + "panel/anadirNuevoDocente",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					notificacion("Añadiendo docente, espere...", "success");
				},
				success: function (response) {
					notificacion(response.msg + " Espere...", "success");
					setInterval(function () {
						redirect(baseURL + "panel/docentes");
					}, 2000);
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	});

	$("#siEliminarDocente").click(function () {
		$id_docente = $(this).attr("data-id");

		data = {
			id_docente: $id_docente,
		};

		$.ajax({
			url: baseURL + "panel/eliminarDocente",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg + " Espere...", "success");
				setInterval(function () {
					redirect(baseURL + "panel/docentes");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});
	// TODO: Validar docente
	$(".guardarValidoDocente").click(function () {
		$(".guardarObsArchivoDoc").each(function () {
			$(this).click();
		});
		$id_docente = $(this).attr("data-id");
		$valido = $("input:radio[name=validoDocente]:checked").val();
		$docente_val_obs = $("#docente_val_obs").val();

		console.log($id_docente);
		console.log($valido);

		data = {
			id_docente: $id_docente,
			valido: $valido,
			docente_val_obs: $docente_val_obs,
		};

		$.ajax({
			url: baseURL + "admin/validarDocentes",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Cargando...", "success");
			},
			success: function (response) {
				notificacion(response.msg, "success");
				$("#docente_val_obs").val("");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#llenar_asistente").modal({
		show: false,
		backdrop: "static",
		keyboard: false,
	});
	$("#verCurso").modal({
		show: false,
		backdrop: "static",
		keyboard: false,
	});

	$("#adminCrearSeguimiento").click(function () {
		$nombreOrganizacion = $("#organizacionSeguimiento").val();
		$id_organizacion = $("option:selected", "#organizacionSeguimiento").attr(
			"data-id"
		);
		$descripcionSeguimiento = $("#descripcionSeguimiento").val();

		data = {
			id_organizacion: $id_organizacion,
			nombreOrganizacion: $nombreOrganizacion,
			descripcionSeguimiento: $descripcionSeguimiento,
		};

		$.ajax({
			url: baseURL + "admin/crearSeguimiento",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(baseURL + "panelAdmin/seguimiento");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".adminVerllamada").click(function () {
		$idLlamada = $(this).attr("data-id");

		data = {
			idLlamada: $idLlamada,
		};

		$.ajax({
			url: baseURL + "admin/obtenerLlamada",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				console.log(response);
				$("#llamadaID").html($idLlamada);
				$("#telefonicoNombreModal").val(response.llamada.telefonicoNombre);
				$("#telefonicoApellidosModal").val(
					response.llamada.telefonicoApellidos
				);
				$("#telefonicoCedulaModal").val(response.llamada.telefonicoCedula);
				$("#telefonicoNitModal").val(response.llamada.telefonicoNit);
				$("#telefonicoTipoPersonaModal").selectpicker(
					"val",
					response.llamada.telefonicoTipoPersona
				);
				$("#telefonicoGeneroModal").selectpicker(
					"val",
					response.llamada.telefonicoGenero
				);
				$("#telefonicoMunicipioModal").val(
					response.llamada.telefonicoMunicipio
				);
				$("#telefonicoDepartamentoModal").val(
					response.llamada.telefonicoDepartamento
				);
				$("#telefonicoNumeroContactoModal").val(
					response.llamada.telefonicoNumeroContacto
				);
				$("#telefonicoCorreoContactoModal").val(
					response.llamada.telefonicoCorreoContacto
				);
				$("#telefonicoNombreOrganizacionModal").val(
					response.llamada.telefonicoNombreOrganizacion
				);
				$("#telefonicoTipoOrganizacionModal").val(
					response.llamada.telefonicoTipoOrganizacion
				);
				$("#telefonicoTemaConsultaModal").val(
					response.llamada.telefonicoTemaConsulta
				);
				$("#telefonicoDescripcionConsultaModal").val(
					response.llamada.telefonicoDescripcionConsulta
				);
				$("#telefonicoTipoSolicitudModal").val(
					response.llamada.telefonicoTipoSolicitud
				);
				$("#telefonicoCanalRecepcionModal").val(
					response.llamada.telefonicoCanalRecepcion
				);
				$("#telefonicoCanalRespuestaModal").val(
					response.llamada.telefonicoCanalRespuesta
				);
				$("#telefonicoFechaModal").val(response.llamada.telefonicoFecha);
				$("#telefonicoDuracionModal").val(response.llamada.telefonicoDuracion);
				$("#telefonicoHoraModal").val(response.llamada.telefonicoHora);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#actualizarLlamada").click(function () {
		$idLlamada = $("#llamadaID").html();
		$telefonicoNombre = $("#telefonicoNombreModal").val();
		$telefonicoApellidos = $("#telefonicoApellidosModal").val();
		$telefonicoCedula = $("#telefonicoCedulaModal").val();
		$telefonicoNit = $("#telefonicoNitModal").val();
		$telefonicoTipoPersona = $("#telefonicoTipoPersonaModal").val();
		$telefonicoGenero = $("#telefonicoGeneroModal").val();
		$telefonicoMunicipio = $("#telefonicoMunicipioModal").val();
		$telefonicoDepartamento = $("#telefonicoDepartamentoModal").val();
		$telefonicoNumeroContacto = $("#telefonicoNumeroContactoModal").val();
		$telefonicoCorreoContacto = $("#telefonicoCorreoContactoModal").val();
		$telefonicoNombreOrganizacion = $(
			"#telefonicoNombreOrganizacionModal"
		).val();
		$telefonicoTipoOrganizacion = $("#telefonicoTipoOrganizacionModal").val();
		$telefonicoTemaConsulta = $("#telefonicoTemaConsultaModal").val();
		$telefonicoDescripcionConsulta = $(
			"#telefonicoDescripcionConsultaModal"
		).val();
		$telefonicoTipoSolicitud = $("#telefonicoTipoSolicitudModal").val();
		$telefonicoCanalRecepcion = $("#telefonicoCanalRecepcionModal").val();
		$telefonicoCanalRespuesta = $("#telefonicoCanalRespuestaModal").val();
		$telefonicoFecha = $("#telefonicoFechaModal").val();
		$telefonicoDuracion = $("#telefonicoDuracionModal").val();
		$telefonicoHora = $("#telefonicoHoraModal").val();

		data = {
			idLlamada: $idLlamada,
			telefonicoNombre: $telefonicoNombre,
			telefonicoApellidos: $telefonicoApellidos,
			telefonicoCedula: $telefonicoCedula,
			telefonicoNit: $telefonicoNit,
			telefonicoTipoPersona: $telefonicoTipoPersona,
			telefonicoGenero: $telefonicoGenero,
			telefonicoMunicipio: $telefonicoMunicipio,
			telefonicoDepartamento: $telefonicoDepartamento,
			telefonicoNumeroContacto: $telefonicoNumeroContacto,
			telefonicoCorreoContacto: $telefonicoCorreoContacto,
			telefonicoNombreOrganizacion: $telefonicoNombreOrganizacion,
			telefonicoTipoOrganizacion: $telefonicoTipoOrganizacion,
			telefonicoTemaConsulta: $telefonicoTemaConsulta,
			telefonicoDescripcionConsulta: $telefonicoDescripcionConsulta,
			telefonicoTipoSolicitud: $telefonicoTipoSolicitud,
			telefonicoCanalRecepcion: $telefonicoCanalRecepcion,
			telefonicoCanalRespuesta: $telefonicoCanalRespuesta,
			telefonicoFecha: $telefonicoFecha,
			telefonicoDuracion: $telefonicoDuracion,
			telefonicoHora: $telefonicoHora,
		};

		$.ajax({
			url: baseURL + "admin/actualizarLlamada",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".respuestaAseguimiento").click(function () {
		$("#modalDescDarRespuesta").html("");
		$("#id_segModal").html("");

		$id_seguimiento = $(this).attr("data-id");
		$descripcion = $(this).attr("data-desc");

		$("#id_segModal").html($id_seguimiento);
		$("#modalDescDarRespuesta").html($descripcion);
	});

	$(".adminrespuestaAseguimiento").click(function () {
		$("#modalDescDarRespuesta").html("");
		$("#id_segModal").html("");

		$id_seguimiento = $(this).attr("data-id");
		$respuesta = $(this).attr("data-resp");

		$("#id_segModal").html($id_seguimiento);
		$("#modalDescDarRespuesta").html($respuesta);
	});

	$("#darRespuestaSeguimiento").click(function () {
		$id_seguimiento = $("#id_segModal").html();
		$respuestaSeguimiento = $("#respuestaSeguimiento").val();

		data = {
			id_seguimiento: $id_seguimiento,
			respuestaSeguimiento: $respuestaSeguimiento,
		};
		console.log(data);

		$.ajax({
			url: baseURL + "panel/darRespuestaSeguimiento",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#darRespuesta").toggle();
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(baseURL + "panel/planMejora");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#darRespuestaSeguimientoAdmin").click(function () {
		$id_seguimiento = $("#id_segModal").html();
		$preguntaSeguimiento = $("#preguntaSeguimiento").val();
		$cumpleSeguimiento = $("input:radio[name=cumpleSeguimiento]:checked").val();

		data = {
			id_seguimiento: $id_seguimiento,
			preguntaSeguimiento: $preguntaSeguimiento,
			cumpleSeguimiento: $cumpleSeguimiento,
		};

		$.ajax({
			url: baseURL + "admin/darRespuestaSeguimiento",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#darRespuesta").toggle();
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(baseURL + "panelAdmin/seguimiento");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#adminCrearVisita").click(function () {
		$nombreOrganizacion = $("#organizacionVisita").val();
		$id_organizacion = $("option:selected", "#organizacionVisita").attr(
			"data-id"
		);
		$dataVisita = $("#fechaVisita").val();
		$dataVisita = $dataVisita.split("T");
		$fechaVisita = $dataVisita[0];
		$horaVisita = $dataVisita[1];
		$encargadoVisita = $("#encargadoVisita").val();

		data = {
			id_organizacion: $id_organizacion,
			nombreOrganizacion: $nombreOrganizacion,
			fechaVisita: $fechaVisita,
			horaVisita: $horaVisita,
			encargadoVisita: $encargadoVisita,
		};

		$.ajax({
			url: baseURL + "admin/crearVisita",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
				setInterval(function () {
					redirect(baseURL + "panelAdmin/seguimiento");
				}, 2000);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".adminVerVisita").click(function () {
		$id_visita = $(this).attr("data-id");
		$fecha = $(this).attr("data-fecha");
		$hora = $(this).attr("data-hora");
		$terminada = $(this).attr("data-terminada");
		$id_organizacion = $(this).attr("data-idOrg");

		data = {
			id_organizacion: $id_organizacion,
			id_visita: $id_visita,
		};
		$.ajax({
			url: baseURL + "admin/cargar_informacionVisita",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#resultados_seguimiento").empty();
				$("#resultados_seguimiento").html("");
				$("#resultados_plan").empty();
				$("#resultados_plan").html("");
				$("#modalFechaVisita").html($fecha);
				$("#modalHoraVisita").html($hora);
				$("#comenzarEval").attr("data-id", $id_organizacion);
				$("#comenzarEval").attr("data-id-visita", $id_visita);
				$("#modalDirecionOrg").html(response.informacion.direccionOrganizacion);
				if (response.seguimiento.length == 1) {
					$("#noHayResultados_seg").hide();
					$("#noHayResultados_plan").hide();
					$("#div_btn_comenzar").hide();
					$("#comenzarEval").prop("disabled", true);
				} else {
					$("#noHayResultados_seg").show();
					$("#noHayResultados_plan").show();
					$("#div_btn_comenzar").show();
					$("#comenzarEval").prop("disabled", false);
				}
				for ($i = 0; $i < response.seguimiento.length; $i++) {
					$("#resultados_seguimiento").append("<h4>Seguimiento:</h4>");
					$("#resultados_seguimiento").append(
						"<div id='res_segumiento_" + $i + "'>"
					);
					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Actividades Educacion:</h4>"
					);
					if (response.seguimiento["0"].actividadesEducacion == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Actualizacion de Datos en la Unidad:</h4>"
					);
					if (response.seguimiento["0"].actualizacionDatosUnidad == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Actualizacion de Hojas de Vida de Docentes:</h4>"
					);
					if (response.seguimiento["0"].actualizacionHojaVidaDocentes == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Archivo Historico Educacion:</h4>"
					);
					if (response.seguimiento["0"].archivoHistoricoEducacion == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Aval de Cursos:</h4>"
					);
					if (response.seguimiento["0"].avalCursos == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Certificado de Existencia:</h4>"
					);
					if (response.seguimiento["0"].certificadoExistencia == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Contenidos Educativos:</h4>"
					);
					if (response.seguimiento["0"].contenidosEducativo == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Contenidos de Programas:</h4>"
					);
					if (response.seguimiento["0"].contenidosProgramas == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Contexto Socio-economico:</h4>"
					);
					if (response.seguimiento["0"].contextoSocioEconomico == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Cotejo de Certificaciones de Curso:</h4>"
					);
					if (response.seguimiento["0"].cotejoCertificacionesCurso == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Cursos Solidaridad Educativa:</h4>"
					);
					if (response.seguimiento["0"].cursosSolidaridadEducativa == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Datos Representante Legal:</h4>"
					);
					if (response.seguimiento["0"].datosRepLegal == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Docentes Habilitados:</h4>"
					);
					if (response.seguimiento["0"].docentesHabilitados == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Domicilio:</h4>"
					);
					if (response.seguimiento["0"].domicilio == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Entes de Control y Apoyo:</h4>"
					);
					if (response.seguimiento["0"].entesControlyApoyo == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Entrega de Informes de Actividades:</h4>"
					);
					if (response.seguimiento["0"].entregaInformesActividades == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Fecha de la Vigencia del Certificado:</h4>"
					);
					if (response.seguimiento["0"].fechaVigenciaCertificado == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Material Didactico:</h4>"
					);
					if (response.seguimiento["0"].materialDidactico == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Matricula Mercantil:</h4>"
					);
					if (response.seguimiento["0"].matriculaMercantil == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Metodologia Acreditada:</h4>"
					);
					if (response.seguimiento["0"].metodologiaAcreditada == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Otros Programas:</h4>"
					);
					if (response.seguimiento["0"].otrosProgramas == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Socializacion de Conceptos:</h4>"
					);
					if (response.seguimiento["0"].socializacionConceptos == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Subcontratacion de Terceros:</h4>"
					);
					if (response.seguimiento["0"].subcontratacionTerceros == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Suministro de Informacion de Visitas:</h4>"
					);
					if (response.seguimiento["0"].suministroInformacionVisitas == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Tipos Organizaciones Solidarias:</h4>"
					);
					if (response.seguimiento["0"].tiposOrganizacionesSolidarias == "1") {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>Si</label>"
						);
					} else {
						$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
							"<label>No</label>"
						);
					}

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<br/>"
					);

					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<h4>Hallazgos:</h4>"
					);
					$("#resultados_seguimiento>#res_segumiento_" + $i + "").append(
						"<label>" + response.seguimiento["0"].hallazgos + "</label>"
					);
					$("#resultados_seguimiento").append("</div>");
				}
				for ($i = 0; $i < response.plan.length; $i++) {
					if ($i == 0) {
						$("#resultados_plan").append("<h4>Plan de Mejora:</h4>");
					}
					$("#resultados_plan").append(
						"<div class='cont_res_plan' id='res_plan_" + $i + "'>"
					);
					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<h4>Descripcion:</h4>"
					);
					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<label>" + response.plan[$i].descripcionMejora + "</label>"
					);

					$("#resultados_plan>#res_plan_" + $i + "").append("<br/>");

					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<h4>Fecha de Mejora:</h4>"
					);
					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<label>" + response.plan[$i].fechaMejora + "</label>"
					);

					$("#resultados_plan>#res_plan_" + $i + "").append("<br/>");

					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<h4>¿Cumple?:</h4>"
					);

					$("#resultados_plan>#res_plan_" + $i + "").append(
						'<label><input type="radio" name="planCumple_' +
							$i +
							'" id="planCumple1_' +
							$i +
							'" class="radio_plan_act" value="1">Sí</label>'
					);
					$("#resultados_plan>#res_plan_" + $i + "").append(
						'<label><input type="radio" name="planCumple_' +
							$i +
							'" id="planCumple2_' +
							$i +
							'" class="radio_plan_act" value="0">No</label>'
					);

					if (response.plan[$i].cumple == "1") {
						$("#planCumple1_" + $i + "").prop("checked", true);
					} else {
						$("#planCumple2_" + $i + "").prop("checked", true);
					}

					$("#resultados_plan>#res_plan_" + $i + "").append("<br/>");

					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<h4>Observaciones:</h4>"
					);
					$("#resultados_plan>#res_plan_" + $i + "").append(
						"<textarea class='form-control' rows='3' data-id-plan='" +
							response.plan[$i].id_planMejoramiento +
							"' data-id='" +
							response.plan[$i].visitas_id_visitas +
							"' id='obs_plan_act_" +
							$i +
							"'>" +
							response.plan[$i].observaciones +
							"</textarea>"
					);

					$("#resultados_plan>#res_plan_" + $i + "").append("<br/>");
					$("#resultados_plan").append("</div>");
					if ($i <= response.plan.length) {
						$("#resultados_plan").append(
							"<button class='btn btn-success actualizarPlanMejora' id='actualizar_plan_" +
								$i +
								"'>Actualizar este Plan</button>"
						);
					}
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(document).on("click", ".actualizarPlanMejora", function () {
		$id_actualizar = $(this).attr("id");
		console.log($id_actualizar);
		for ($i = 0; $i < $("#resultados_plan div.cont_res_plan").length; $i++) {
			if ($id_actualizar == "actualizar_plan_" + $i) {
				$observaciones_plan = $("#obs_plan_act_" + $i + "").val();
				$id_visita = $("#obs_plan_act_" + $i + "").attr("data-id");
				$id_plan = $("#obs_plan_act_" + $i + "").attr("data-id-plan");
				$cumple_plan = $(
					"input:radio[name=planCumple_" + $i + "]:checked"
				).val();

				data = {
					observaciones_plan: $observaciones_plan,
					id_visita: $id_visita,
					id_plan: $id_plan,
					cumple_plan: $cumple_plan,
				};

				$.ajax({
					url: baseURL + "admin/actualizarPlanMejoramiento",
					type: "post",
					dataType: "JSON",
					data: data,
					success: function (response) {
						notificacion(response.msg, "success");
					},
					error: function (ev) {
						//Do nothing
					},
				});
			}
		}
	});

	$(document).on("click", "#getCert", function () {
		$id_asistente = $(this).attr("data-id-ass");
		window.open(baseURL + "Certificado/?id:" + $id_asistente, "_blank");
	});

	$("#comenzarEval").click(function () {
		$id_organizacion = $(this).attr("data-id");
		$id_visita = $(this).attr("data-id-visita");
		console.log($id_organizacion);
		window.open(
			baseURL + "evaluacion/?id:" + $id_organizacion + ":" + $id_visita,
			"_blank"
		);
	});


	$("#volverEst_org").click(function () {
		$("#admin_ver_finalizadas").slideDown();
		$("#v_estado_org").slideUp();
	});




	$("#crearBateriaObservacion").click(function () {
		$tipoBateriaObservacion = $("#tipoBateriaObservacion").val();
		$tituloBateriaObservacion = $("#tituloBateriaObservacion").val();
		$observacionBateriaObservacion = $("#observacionBateriaObservacion").val();

		var data = {
			tipoBateriaObservacion: $tipoBateriaObservacion,
			tituloBateriaObservacion: $tituloBateriaObservacion,
			observacionBateriaObservacion: $observacionBateriaObservacion,
		};

		$.ajax({
			url: baseURL + "admin/crearBateriaObservacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
				$("#tituloBateriaObservacion").val("");
				$("#observacionBateriaObservacion").val("");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	// Helper
	$screen_width = $(window).width();
	if ($screen_width <= 767) {
		$("#dropdown_menu_header").hide();
		$("#sia_carrousel").css("left", "0px");
		$("#sia_preg").css("left", "0px");
		$("#imagen_header").removeClass("pull-left");
		$("#imagen_header").addClass("center-block");
		$("#imagen_header_sia").removeClass("pull-right");
		$("#imagen_header_sia").addClass("center-block");
		$("#imagen_header").css("max-width", "100%");
		$("#icons-redes").css("top", "0px");
		$(".form-control").css("width", "100%");
		$("#left_registro").css("width", "100%");
	} else if ($screen_width >= 768 && $screen_width <= 991) {
		$("#dropdown_menu_header > .dropdown-inline").css("left", "0px");
		$("#dropdown_menu_header").css("font-size", "14px");
		$("#sia_carrousel").css("left", "0px");
		$("#sia_preg").css("left", "0px");
		$("#ln_i_r").css("width", "27%");
		$(".ln_i").css("padding", "0px 20px");
		$(".ln_r").css("padding", "0px 20px");
		$("#imagen_header").removeClass("pull-left");
		$("#imagen_header").addClass("center-block");
		$("#imagen_header_sia").removeClass("pull-right");
		$("#imagen_header_sia").addClass("center-block");
		$("#imagen_header").css("max-width", "100%");
		$("#icons-redes").css("top", "0px");
		$(".form-control").css("width", "100%");
		$("#left_registro").css("width", "100%");
	} else if ($screen_width >= 994 && $screen_width <= 1200) {
		$("#dropdown_menu_header > .dropdown-inline").css("left", "7%");
		$("#dropdown_menu_header").css("font-size", "16px");
		$("#sia_carrousel").css("left", "-30px");
		$("#sia_preg").css("left", "-30px");
		$("#ln_i_r").css("width", "18%");
		$(".ln_i").css("padding", "0px 12px");
		$(".ln_r").css("padding", "0px 12px");
		$("#login_admin").removeClass("col-md-3");
		$("#login_admin").addClass("col-md-4");
		$("#login").removeClass("col-md-3");
		$("#login").addClass("col-md-4");
		$("#registro").removeClass("col-md-6");
		$("#registro").addClass("col-md-8");
	} else {
		$("#dropdown_menu_header").show();
		$("#sia_carrousel").css("left", "-30px");
		$("#sia_preg").css("left", "-30px");
		$("#ln_i_r").css("width", "24.4%");
		$(".ln_i").css("padding", "0px 40px");
		$(".ln_r").css("padding", "0px 40px");
	}
	// Disable scroll when focused on a number input.
	$(document).on("focus", "input[type=number]", function (e) {
		$(this).on("wheel", function (e) {
			e.preventDefault();
		});
	});
	// Restore scroll on number inputs.
	$(document).on("blur", "input[type=number]", function (e) {
		$(this).off("wheel");
	});

	// Disable up and down keys.
	$(document).on("keydown", "input[type=number]", function (e) {
		if (
			e.which == 38 ||
			e.which == 40 ||
			e.which == 69 ||
			e.which == 187 ||
			e.which == 189
		)
			e.preventDefault();
	});

	//TODO: Leer Notificaciones
	$(".notificaciones").click(function () {
		$.ajax({
			url: baseURL + "notificaciones/leerNotificaciones",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				$(".badge").html("");
				$(".badge").html("0");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#guardarContrasenaAdmin").click(function () {
		$nuevaContrasena = $("#nuevaContrasenaAdmin").val();

		data = {
			nuevaContrasena: $nuevaContrasena,
		};

		$.ajax({
			url: baseURL + "admin/guardarContrasenaAdmin",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
				$("#nuevaContrasenaAdmin").val("");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".editarBateriaObservacion").click(function () {
		$id_observacion = $(this).attr("data-id");

		data = {
			id_observacion: $id_observacion,
		};

		$.ajax({
			url: baseURL + "admin/verBateriaObservacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$("#tipoBateriaObservacion").val(response.tipo);
				$("#tipoBateriaObservacion").selectpicker("refresh");
				$("#tituloBateriaObservacion").val(response.titulo);
				$("#observacionBateriaObservacion").val(response.observacion);
				$("#crearBateriaObservacion").hide();
				$("#actualizarBateriaObservacion").show();
				$("body").append(
					"<div id='obsBatId' data-id-obsB='" + $id_observacion + "'></div>"
				);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#actualizarBateriaObservacion").click(function () {
		$id_observacion = $("#obsBatId").attr("data-id-obsB");
		$tipoBateriaObservacion = $("#tipoBateriaObservacion").val();
		$tituloBateriaObservacion = $("#tituloBateriaObservacion").val();
		$observacionBateriaObservacion = $("#observacionBateriaObservacion").val();

		var data = {
			id_observacion: $id_observacion,
			tipoBateriaObservacion: $tipoBateriaObservacion,
			tituloBateriaObservacion: $tituloBateriaObservacion,
			observacionBateriaObservacion: $observacionBateriaObservacion,
		};

		$.ajax({
			url: baseURL + "admin/actualizarBateriaObservacion",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
				$("#tituloBateriaObservacion").val("");
				$("#observacionBateriaObservacion").val("");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#radioBtn a").on("click", function () {
		var sel = $(this).data("title");
		var tog = $(this).data("toggle");
		$("#" + tog).prop("value", sel);

		$('a[data-toggle="' + tog + '"]')
			.not('[data-title="' + sel + '"]')
			.removeClass("active")
			.addClass("notActive");
		$('a[data-toggle="' + tog + '"][data-title="' + sel + '"]')
			.removeClass("notActive")
			.addClass("active");
	});

	$("#show-pass1").hover(function () {
		$(this).attr("title", "Aquí puedes ver tu contraseña.");
		if ($("#password").attr("type") === "text") {
			$("#password").attr("type", "password");
		} else {
			$("#password").attr("type", "text");
		}
	});
	$("#show-pass2").hover(function () {
		$(this).attr("title", "Aquí puedes ver tu contraseña.");
		if ($("#re_password").attr("type") === "text") {
			$("#re_password").attr("type", "password");
		} else {
			$("#re_password").attr("type", "text");
		}
	});
	$("#show-pass3").hover(function () {
		$(this).attr("title", "Aquí puedes ver tu contraseña.");
		if ($("#password").attr("type") === "text") {
			$("#password").attr("type", "password");
		} else {
			$("#password").attr("type", "text");
		}
	});
	$("#show-pass4").hover(function () {
		$(this).attr("title", "Aquí puedes ver tu contraseña.");
		if ($("#contrasena_anterior").attr("type") === "text") {
			$("#contrasena_anterior").attr("type", "password");
		} else {
			$("#contrasena_anterior").attr("type", "text");
		}
	});
	$("#show-pass5").hover(function () {
		$(this).attr("title", "Aquí puedes ver tu contraseña.");
		if ($("#contrasena_nueva").attr("type") === "text") {
			$("#contrasena_nueva").attr("type", "password");
		} else {
			$("#contrasena_nueva").attr("type", "text");
		}
	});
	$("#show-pass6").hover(function () {
		$(this).attr("title", "Aquí puedes ver tu contraseña.");
		if ($("#re_contrasena_nueva").attr("type") === "text") {
			$("#re_contrasena_nueva").attr("type", "password");
		} else {
			$("#re_contrasena_nueva").attr("type", "text");
		}
	});

	$(".clearInput").click(function () {
		$(this).siblings("input").val("");
	});

	$("#act_datos_abiertos").click(function () {
		$.ajax({
			url: baseURL + "clean_socrata",
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Cargando...", "success");
			},
			success: function (response) {
				// Do nothing
			},
			error: function (ev) {
				$.ajax({
					url: baseURL + "socrata",
					type: "post",
					dataType: "JSON",
					beforeSend: function () {
						$("#loading").show();
					},
					success: function (response) {
						notificacion("Datos abiertos actualizados.");
						$("#loading").toggle();
					},
					error: function (ev) {
						//Do nothing
					},
				});
			},
		});
	});

	$("#consultar_datos_abiertos").click(function () {
		$.ajax({
			url: baseURL + "get_socrata",
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Cargando...", "success");
			},
			success: function (response) {
				if (response.length == 1) {
					notificacion("Ningún dato...", "success");
				} else {
					$("#tabla_d_a").show();
					notificacion("Datos cargados", "success");
					$("#datos_organizaciones_inscritas>#datos_basicos>span").empty();
					$("#tabla_datos_s_org>tbody#tbody_d_socrata").empty();
					$("#tabla_datos_s_org>tbody#tbody_d_socrata").html("");
					$("#tbody_d_socrata>.odd").remove();
					for (var i = 1; i < response.length; i++) {
						$("#tbody_d_socrata").append("<tr id=" + i + ">");
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].nombre_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].n_mero_nit + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].sigla_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].estado_actual_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].fecha_cambio_de_estado + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].tipo_de_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].direcci_n_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].departamento_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].municipio_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].tel_fono_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].extensi_n + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].url_de_la_entidad.url + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].actuaci_n_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].tipo_de_educaci_n_de_la_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].primer_nombre_representante_legal + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].segundo_nombre_representante_legal + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].primer_apellido_representante_legal + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" +
								response[i].segundo_apellido_representante_legal +
								"</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].n_mero_c_dula_representante_legal + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].correo_electr_nico_entidad + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" +
								response[i].correo_electr_nico_representante_legal +
								"</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].n_mero_de_la_resoluci_n + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].fecha_de_inicio_de_la_resoluci_n + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].a_os_de_la_resoluci_n + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].tipo_de_solicitud + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].motivo_de_la_solicitud + "</td>"
						);
						$("#tbody_d_socrata>tr#" + i + "").append(
							"<td>" + response[i].modalidad_de_la_solicitud + "</td>"
						);
						$("#tbody_d_socrata").append("</tr>");
					}
					$(".tabla_form > #tbody_d_socrata > tr.odd").remove();
					paging("tabla_datos_s_org");
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#comentario_encuesta").click(function () {
		var maxChars = $("#comentario_encuesta");
		var max_length = maxChars.attr("maxlength");
		if (max_length > 0) {
			maxChars.bind("keyup", function (e) {
				length = new Number(maxChars.val().length);
				counter = max_length - length;
				$(".conteo_chars").text(counter);
			});
		}
	});

	$(document).on("click", ".buttons-flash", function () {
		notificacion(
			"Después de dar click en 'Guardar', verifique en la carpeta seleccionada.",
			"success"
		);
	});

	$(document).on("click", ".buttons-copy", function () {
		notificacion("Copiado al portapapeles...", "success");
	});

	$("#guardar_encuesta").click(function () {
		$estrellas = $("input:radio[name=estrellas]:checked").val();
		$comentario = $("#comentario_encuesta").val();

		data = {
			estrellas: $estrellas,
			comentario: $comentario,
		};

		$.ajax({
			url: baseURL + "contacto/guardarEncuesta",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
				$("#comentario_encuesta").val("");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});


	//Botones para fomulario 7
	$("#atrasProgAvalEcT").click(function () {
		$("#divAtrasProgAvalEcT").slideDown();
		$("#divSiguienteProgAvalEcT").slideUp();
		$("#siguienteProgAvalEcT").show();
		$("#atrasProgAvalEcT").hide();
		$("#guardar_formulario_programas_aval").hide();
	});

	$("#siguienteProgAvalEcT").click(function () {
		$("#divAtrasProgAvalEcT").slideUp();
		$("#divSiguienteProgAvalEcT").slideDown();
		$("#atrasProgAvalEcT").show();
		$("#siguienteProgAvalEcT").hide();
		$("#guardar_formulario_programas_aval").show();
	});

	$("input:radio[name=jornaSelect]").change(function () {
		if ($("input:radio[name=jornaSelect]:checked").val() == "Si") {
			$("#divIngJor").show();
		} else {
			$("#divIngJor").hide();
		}
	});

	$("#docente_val_obs").change(function () {
		$(".guardarValidoDocente").attr("disabled", false);
	});

	$(".validoDocente").change(function () {
		$(".guardarValidoDocente").attr("disabled", false);
	});

	//Politica
	$("#acepto_politica").click(function () {
		$("#acepto_cond").prop("checked", true);
		$("#aceptar_programa").modal("toggle");
	});

	$("#verRelacionCambios").click(function () {
		$id_organizacion = $("#id_org_ver_form").attr("data-id");
		console.log($id_organizacion);

		data = {
			id_organizacion: $id_organizacion,
		};

		$.ajax({
			url: baseURL + "admin/verRelacionCambios",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				console.log(response);
				$("#tbody_relacionCambios").empty();
				for (var i = 0; i < response.length; i++) {
					$("#tbody_relacionCambios").append("<tr id=" + i + ">");
					$("#tbody_relacionCambios>tr#" + i + "").append(
						"<td>" + response[i].tituloNotificacion + "</td>"
					);
					$("#tbody_relacionCambios>tr#" + i + "").append(
						"<td>" + response[i].descripcionNotificacion + "</td>"
					);
					$("#tbody_relacionCambios>tr#" + i + "").append(
						"<td>" + response[i].fechaNotificacion + "</td>"
					);
					$("#tbody_relacionCambios").append("</tr>");
				}
				paging("tabla_relacionCambio");

				$("#verRelacionFiltrada").attr(
					"href",
					baseURL +
						"admin/verRelacionCambiosVista/organizacion:" +
						$id_organizacion
				);
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#desplInfoOrg").click(function () {
		$("#verInfoOrg").slideDown();
		$("#plegInfoOrg").show();
		$(this).hide();
	});

	$("#plegInfoOrg").click(function () {
		$("#verInfoOrg").slideUp();
		$("#desplInfoOrg").show();
		$(this).hide();
	});

	$(".toAncla").click(function () {
		var element = $("#anclaInicio");
		$("html,body").animate(
			{ scrollTop: element.offset().top },
			"normal",
			"swing"
		);
	});

	$(".submenu li").each(function () {
		$(this).attr("data-search-term", $(this).text().toLowerCase());
	});

	$("#buscarObsText").on("keyup", function () {
		var searchTerm = $(this).val().toLowerCase();
		$(".submenu li").each(function () {
			if (
				$(this).filter("[data-search-term *= " + searchTerm + "]").length > 0 ||
				searchTerm.length < 1
			) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});

	$("#buscarObsTextOrg").on("keyup", function () {
		var searchTerm = $(this).val().toLowerCase();
		$(".obsCampo").each(function () {
			if (
				$(this).filter("[data-search-term *= " + searchTerm + "]").length > 0 ||
				searchTerm.length < 1
			) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});

	$("#guardarModalInformacion").click(function () {
		$habilitarModal = $("#habilitarModal").val();
		$mensajeInformativo = CKEDITOR.instances.contacto_mensaje_admin.getData();

		data = {
			habilitarModal: $habilitarModal,
			mensajeInformativo: $mensajeInformativo,
		};

		$.ajax({
			url: baseURL + "admin/modalInformacionUpdate",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				notificacion(response.msg, "success");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$("#volverPedirCamara").click(function () {
		$id_organizacion = $("#id_org_ver_form").attr("data-id");
		data = {
			id_organizacion: $id_organizacion,
		};
		$.ajax({
			url: baseURL + "recordar/pedirCamara",
			type: "post",
			dataType: "JSON",
			data: data,
			beforeSend: function () {
				notificacion("Espere enviado correo...", "success");
				$("#volverPedirCamara").attr("disabled", true);
			},
			success: function (response) {
				notificacion("Se pidió la cámara de comercio.", "success");
				$("#modalPedirCamara").modal("toggle");
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	//$('.g-recaptcha').append('<div id="txt_greca"></div>');
	//$('#txt_greca').text("No soy un robot.");
	//$('#txt_greca').css({"position":"relative", "width":"160px", "top":"-50px", "left":"53px", "background-color":"#f9f9f9"});

	//Reportes

	$("#verReportes").click(function () {
		//gene
		var $numeroMujeres = 0;
		var $numeroHombres = 0;
		//edades
		var $ed = "";
		var edT = [];
		var ed_num = [];
		//datos
		var $lgbti = 0;
		var $afro = 0;
		var $cabezaFamilia = 0;
		var $indigena = 0;
		var $palenquero = 0;
		var $privadoLibertad = 0;
		var $prostitucion = 0;
		var $redUnidos = 0;
		var $reintegro = 0;
		var $romGitano = 0;
		var $victima = 0;
		var $raizal = 0;
		var $depRes = "";
		var $munRes = "";
		//mun
		var data_mun = [];
		var $mun = "";
		var data_mun_num = [{ value: 0, name: "" }];
		//dep
		var data_dep = [];
		var $dep = "";
		var data_dep_num = [{ value: 0, name: "" }];

		$.ajax({
			url: baseURL + "reportes/verInformacion",
			type: "post",
			dataType: "JSON",
			beforeSend: function () {
				notificacion("Espere...", "success");
			},
			success: function (response) {
				if (response.informe.length <= 0) {
					$("#rep").slideUp();
					notificacion("No hay datos para mostrar.", "success");
				} else {
					$("#rep").slideDown();
					notificacion("Datos cargados.", "success");
					for ($i = 0; $i < response.informe.length; $i++) {
						//generos
						$numeroMujeres += parseFloat(response.informe[$i].numeroMujeres);
						$numeroHombres += parseFloat(response.informe[$i].numeroHombres);
						//datos
						for ($j = 0; $j < response.asistentes[$i].length; $j++) {
							if (response.asistentes[$i][$j].LGTBI == "Si") {
								$lgbti += 1;
							}
							if (response.asistentes[$i][$j].afro == "Si") {
								$afro += 1;
							}
							if (response.asistentes[$i][$j].cabezaFamilia == "Si") {
								$cabezaFamilia += 1;
							}
							if (response.asistentes[$i][$j].indigena == "Si") {
								$indigena += 1;
							}
							if (response.asistentes[$i][$j].palenquero == "Si") {
								$palenquero += 1;
							}
							if (response.asistentes[$i][$j].privadoLibertad == "Si") {
								$privadoLibertad += 1;
							}
							if (response.asistentes[$i][$j].prostitucion == "Si") {
								$prostitucion += 1;
							}
							if (response.asistentes[$i][$j].redUnidos == "Si") {
								$redUnidos += 1;
							}
							if (response.asistentes[$i][$j].reintegro == "Si") {
								$reintegro += 1;
							}
							if (response.asistentes[$i][$j].romGitano == "Si") {
								$romGitano += 1;
							}
							if (response.asistentes[$i][$j].victima == "Si") {
								$victima += 1;
							}
							if (response.asistentes[$i][$j].raizal == "Si") {
								$raizal += 1;
							}
							//edades
							$ed = response.asistentes[$i][$j].edadAsistente;
							edT.push($ed);
							ed_num.push({ value: 1, name: $ed });
						}
						//MunRes
						$mun = response.informe[$i].municipioCurso;
						data_mun.push($mun);
						data_mun_num.push({ value: 1, name: $mun });
						//DepRes
						$dep = response.informe[$i].departamentoCurso;
						data_dep.push($dep);
						data_dep_num.push({ value: 1, name: $dep });

						//Barras Horizontal
						if ($("#echart_bar_horizontal").length) {
							var echartBar = echarts.init(
								document.getElementById("echart_bar_horizontal"),
								theme
							);
							echartBar.setOption({
								title: {
									text: "Géneros",
									subtext:
										"Géneros de Cursos \n\nTotal: " +
										($numeroMujeres + $numeroHombres) +
										" Personas",
								},
								tooltip: {
									trigger: "axis",
								},
								legend: {
									x: "center",
									y: "bottom",
									data: ["Mujeres", "Hombres"],
								},
								toolbox: {
									show: true,
									feature: {
										saveAsImage: {
											show: true,
											title: "Guardar Imagen",
										},
									},
								},
								calculable: true,
								xAxis: [
									{
										type: "value",
										boundaryGap: [0, 0.01],
									},
								],
								yAxis: [
									{
										type: "category",
										data: ["Género"],
									},
								],
								series: [
									{
										name: "Mujeres",
										type: "bar",
										data: [$numeroMujeres],
									},
									{
										name: "Hombres",
										type: "bar",
										data: [$numeroHombres],
									},
								],
							});
						} //Fin barras
						//Donut
						if ($("#echart_donut").length) {
							var echartDonut = echarts.init(
								document.getElementById("echart_donut"),
								theme
							);

							echartDonut.setOption({
								title: {
									text: "Edades",
									subtext: "Edades de los asistentes",
								},
								tooltip: {
									trigger: "item",
									formatter: "{a} <br/>{b} : {c} ({d}%)",
								},
								calculable: true,
								legend: {
									x: "center",
									y: "bottom",
									data: edT,
								},
								toolbox: {
									show: true,
									feature: {
										magicType: {
											show: true,
											type: ["pie", "funnel"],
											option: {
												funnel: {
													x: "25%",
													width: "50%",
													funnelAlign: "left",
													max: response.asistentes.length,
												},
											},
										},
										restore: {
											show: true,
											title: "Restaurar",
										},
										saveAsImage: {
											show: true,
											title: "Guardar Imagen",
										},
									},
								},
								series: [
									{
										name: "Edades",
										type: "pie",
										radius: ["40%", "87%"],
										itemStyle: {
											normal: {
												label: {
													show: true,
												},
												labelLine: {
													show: true,
												},
											},
											emphasis: {
												label: {
													show: true,
													position: "center",
													textStyle: {
														fontSize: "14",
														fontWeight: "normal",
													},
												},
											},
										},
										data: ed_num,
									},
								],
							});
						} //Fin donut
						//echart Pie
						if ($("#echart_pie").length) {
							var echartPie = echarts.init(
								document.getElementById("echart_pie"),
								theme
							);
							echartPie.setOption({
								title: {
									text: "Datos de los asistentes",
									subtext: "Datos",
								},
								tooltip: {
									trigger: "item",
									formatter: "{a} <br/>{b}: {c} ({d}%)",
								},
								legend: {
									x: "center",
									y: "bottom",
									data: [
										"LGBTI",
										"Afro",
										"Cabeza de familia",
										"Raizal",
										"Indígena",
										"Palenquero",
										"Privado de la libertad",
										"Prostitucioón",
										"Prostitución",
										"Red Unidos",
										"Reintegro",
										"Rom o Gitano",
										"Víctima",
									],
								},
								toolbox: {
									show: true,
									feature: {
										magicType: {
											show: true,
											type: ["pie", "funnel"],
											option: {
												funnel: {
													x: "25%",
													width: "50%",
													funnelAlign: "left",
													max: $numeroMujeres + $numeroHombres,
												},
											},
										},
										restore: {
											show: true,
											title: "Restaurar",
										},
										saveAsImage: {
											show: true,
											title: "Guardar Imagen",
										},
									},
								},
								calculable: true,
								series: [
									{
										name: "Minorías",
										type: "pie",
										radius: "70%",
										center: ["50%", "48%"],
										data: [
											{
												value: $lgbti,
												name: "LGBTI",
											},
											{
												value: $afro,
												name: "Afro",
											},
											{
												value: $cabezaFamilia,
												name: "Cabeza de familia",
											},
											{
												value: $raizal,
												name: "Raizal",
											},
											{
												value: $indigena,
												name: "Indígena",
											},
											{
												value: $palenquero,
												name: "Palenquero",
											},
											{
												value: $privadoLibertad,
												name: "Privado de la libertad",
											},
											{
												value: $prostitucion,
												name: "Prostitución",
											},
											{
												value: $redUnidos,
												name: "Red Unidos",
											},
											{
												value: $reintegro,
												name: "Reintegro",
											},
											{
												value: $romGitano,
												name: "Rom o Gitano",
											},
											{
												value: $victima,
												name: "Víctima",
											},
										],
									},
								],
							});
						} // Fin pie
						// Pie 2 _ Depto	   data_mun data_dep
						if ($("#echart_pie2").length) {
							var echartPieCollapse = echarts.init(
								document.getElementById("echart_pie2"),
								theme
							);
							echartPieCollapse.setOption({
								title: {
									text: "Departamentos",
									subtext: "Cursos por departamentos",
								},
								tooltip: {
									trigger: "item",
									formatter: "{a} <br/>{b} : {c} ({d}%)",
								},
								legend: {
									x: "center",
									y: "bottom",
									data: data_dep,
								},
								toolbox: {
									show: true,
									feature: {
										magicType: {
											show: true,
											type: ["pie", "funnel"],
										},
										restore: {
											show: true,
											title: "Restaurar",
										},
										saveAsImage: {
											show: true,
											title: "Guardar Imagen",
										},
									},
								},
								calculable: true,
								series: [
									{
										name: "Departamentos",
										type: "pie",
										radius: [70, 150],
										center: ["50%", 170],
										roseType: "area",
										x: "50%",
										max: response.informe.length,
										sort: "ascending",
										data: data_dep_num,
									},
								],
							});
						}

						// Pie 2 _ Mun
						if ($("#echart_pie2_2").length) {
							var echartPieCollapse = echarts.init(
								document.getElementById("echart_pie2_2"),
								theme
							);
							echartPieCollapse.setOption({
								title: {
									text: "Municipios",
									subtext: "Cursos por municipios",
								},
								tooltip: {
									trigger: "item",
									formatter: "{a} <br/>{b} : {c} ({d}%)",
								},
								legend: {
									x: "center",
									y: "bottom",
									data: data_mun,
								},
								toolbox: {
									show: true,
									feature: {
										magicType: {
											show: true,
											type: ["pie", "funnel"],
										},
										restore: {
											show: true,
											title: "Restaurar",
										},
										saveAsImage: {
											show: true,
											title: "Guardar Imagen",
										},
									},
								},
								calculable: true,
								series: [
									{
										name: "Municipios",
										type: "pie",
										radius: [70, 150],
										center: ["50%", 170],
										roseType: "area",
										x: "50%",
										max: response.informe.length,
										sort: "ascending",
										data: data_mun_num,
									},
								],
							});
						}
					}

					//echart Mini Pie
					if ($("#echart_mini_pie").length) {
						var echartMiniPie = echarts.init(
							document.getElementById("echart_mini_pie"),
							theme
						);

						echartMiniPie.setOption({
							title: {
								text: "Chart #2",
								subtext: "From ExcelHome",
								sublink: "http://e.weibo.com/1341556070/AhQXtjbqh",
								x: "center",
								y: "center",
								itemGap: 20,
								textStyle: {
									color: "#0062AB", //c61f1b
									fontFamily: "微软雅黑",
									fontSize: 35,
									fontWeight: "bolder",
								},
							},
							tooltip: {
								show: true,
								formatter: "{a} <br/>{b} : {c} ({d}%)",
							},
							legend: {
								orient: "vertical",
								x: 170,
								y: 45,
								itemGap: 12,
								data: ["68%Something #1", "29%Something #2", "3%Something #3"],
							},
							toolbox: {
								show: true,
								feature: {
									mark: {
										show: true,
									},
									dataView: {
										show: true,
										title: "Vista Texto",
										lang: ["Text View", "Cerrar", "Actualizar"],
										readOnly: false,
									},
									restore: {
										show: true,
										title: "Restaurar",
									},
									saveAsImage: {
										show: true,
										title: "Guardar Imagen",
									},
								},
							},
							series: [
								{
									name: "1",
									type: "pie",
									clockWise: false,
									radius: [105, 130],
									itemStyle: dataStyle,
									data: [
										{
											value: 68,
											name: "68%Something #1",
										},
										{
											value: 32,
											name: "invisible",
											itemStyle: placeHolderStyle,
										},
									],
								},
								{
									name: "2",
									type: "pie",
									clockWise: false,
									radius: [80, 105],
									itemStyle: dataStyle,
									data: [
										{
											value: 29,
											name: "29%Something #2",
										},
										{
											value: 71,
											name: "invisible",
											itemStyle: placeHolderStyle,
										},
									],
								},
								{
									name: "3",
									type: "pie",
									clockWise: false,
									radius: [25, 80],
									itemStyle: dataStyle,
									data: [
										{
											value: 3,
											name: "3%Something #3",
										},
										{
											value: 97,
											name: "invisible",
											itemStyle: placeHolderStyle,
										},
									],
								},
							],
						});
					}
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	});

	$(".verPage").click(function () {
		$page = $(this).attr("target");
		if (funcion == "home") {
			$(".pages").hide();
			$("#" + $page).show();
		} else if (activate[3] == "sia" && funcion == "") {
			$(".pages").hide();
			$("#" + $page).show();
		} else {
			redirect("home#" + $page);
			$(".pages").hide();
			$("#" + $page).show();
		}
	});
	(function () {
		var _z = console;
		Object.defineProperty(window, "console", {
			get: function () {
				if (_z._commandLineAPI) {
					throw "Sorry, Can't exceute scripts!";
				}
				return _z;
			},
			set: function (val) {
				_z = val;
			},
		});
	})();

	$(".hide-sidevar").click(function () {
		if ($(".side_main_menu").css("display") == "none") {
			$(".side_main_menu").css("display", "block");
			$(".formularios").removeClass("col-md-12");
			$(".formularios").addClass("col-md-9");
			$(".hide-sidevar > .fa").removeClass("fa-arrows-alt");
			$(".hide-sidevar > .fa").addClass("fa-window-close-o");
			//$(".hide-sidevar > v").html("Ver menú");
			$(".hide-sidevar > v").html("Ocultar menú");
			$(".side_main_menu").addClass("bounceInLeft animated");
		} else {
			$(".side_main_menu").css("display", "none");
			$(".formularios").removeClass("col-md-9");
			$(".formularios").addClass("col-md-12");
			$(".hide-sidevar > .fa").removeClass("fa-window-close-o");
			$(".hide-sidevar > .fa").addClass("fa-arrows-alt");
			//$(".hide-sidevar > v").html("Ocultar menú");
			$(".hide-sidevar > v").html("Ver menú");
			$(".side_main_menu").addClass("bounceInLeft animated");
		}
	});

	$(".eliminarDataTabla").click(function () {
		$(this).parent().parent().hide();
	});

	$("input").keypress(function (e) {
		if (e.which === 39) {
			return false;
		} else if (e.which === 34) {
			return false;
		} else if (e.which === 38) {
			return false;
		} else if (e.which === 60) {
			return false;
		} else if (e.which === 62) {
			return false;
		} else if (e.which === 59) {
			return false;
		} else if (e.which === 58) {
			return false;
		}
	});

	$("textarea").keypress(function (e) {
		if (e.which === 39) {
			return false;
		} else if (e.which === 34) {
			return false;
		} else if (e.which === 38) {
			return false;
		} else if (e.which === 60) {
			return false;
		} else if (e.which === 62) {
			return false;
		} else if (e.which === 59) {
			return false;
		} else if (e.which === 58) {
			return false;
		}
	});

	$(document).on("click", ".obsCopy", function () {
		var $texto = $(this).text();
		copyTextToClipboard($texto);
	});

	$("body").bind("paste", function (e) {
		if ($("#envioHTML").prop("checked")) {
			//Nothing
		} else {
			//e.stopPropagation();
			//e.preventDefault();

			var cd = e.originalEvent.clipboardData;
			var texto = cd.getData("text/plain");

			//var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
			var specialChars = "<>;'\\/";

			for (i = 0; i < specialChars.length; i++) {
				if (texto.indexOf(specialChars[i]) > -1) {
					nuevo = texto.replace(/"/g, " ");
					nuevo = nuevo.replace(/</g, " ");
					nuevo = nuevo.replace(/'/g, " ");
					nuevo = nuevo.replace(/>/g, " ");
					nuevo = nuevo.replace(/\//g, " ");
					nuevo = nuevo.replace(/"\//g, " ");
					nuevo = nuevo.replace(/;/g, " ");
					nuevo = nuevo.replace(/:/g, " ");
					nuevo = nuevo.replace(/=/g, " ");
					console.log(nuevo);
					copyTextToClipboard(nuevo);
					console.log("Contiene caracteres especiales");
				} else {
					//console.log("Clear");
				}
			}
		}
	});

	$(".contenedor--menu2").hide();
	$(".icono2").click(function () {
		$(".contenedor--menu2").animate({
			width: "toggle",
		});
	});
	//TODO: Menu formularios
	$(".contenedor--menu3").hide();
	$(".icono3").click(function () {
		$(".contenedor--menu3").animate({
			width: "toggle",
		});
	});

	/*
	var check = functions(string){
		for(i = 0; i < specialChars.length;i++){
			if(string.indexOf(specialChars[i]) > -1){
				return true
			}
		}
		return false;
	}

	if(check($('input').val()) == false){
		// Code that needs to execute when none of the above is in the string
	}else{
		alert('Your search string contains illegal characters.');
	} */

	dragDivForm("contenedor--menu2");
	//dragDivForm("contenedor--menu");

	$("#verDivAgregarDoc").click(function () {
		$(".divAgregarDoc").slideDown();
		$(this).hide();
	});

	$("#verDivAgregarOrgHist").click(function () {
		$(".divAgregarOrgHist").slideDown();
		$(".tablaOrgHist").slideUp();
		$(this).hide();
	});

	$(".dropdown-item").click(function () {
		$(".dt-button-background").remove();
	});
});
/**
	Comienza Funciones del archivo.
**/

/**
	Funcion para redireccionar URL's usando Jquery, no funciono redirect MVC :c.
	@param response = string url con comillas
**/
function redirect(response) {
	$url = response.replace('"', "").replace('"', "");
	$(window).attr("location", $url);
}

function copyTextToClipboard($texto) {
	var copiarDesde = $("<textarea/>");
	copiarDesde.text($texto);
	$("body").append(copiarDesde);
	copiarDesde.select();
	document.execCommand("copy", true);
	copiarDesde.remove();
	notificacion(
		"El texto ha sido formateado y copiado, intente pegarlo en una caja de texto...",
		"success"
	);
}

/**
	Recargar la pagina, en false para cache, en true para cargar desde 0.
**/
function reload() {
	location.reload(false);
}

function reloadH() {
	location.reload(true);
}

/**
	@param response = string json
	Limpia si la cadena JSON encode de php que tiene doble comilla.
**/
function clearJSON(response) {
	$res = response.replace('"', "").replace('"', "");
	return $res;
}
//TODO: Cargar notificaciones
function notificaciones(baseURL) {
	//Notificaciones
	$data_logg = $("#data_logg").attr("data-log");
	if ($data_logg == 1) {
		$.ajax({
			url: baseURL + "notificaciones/cargarNotificaciones",
			type: "post",
			dataType: "JSON",
			success: function (response) {
				$(".badge").html("");
				$(".badge").html(response.count);
				$for_count = parseFloat(response.count);
				$("li.notificaciones").append(
					'<ul id="notificacion" class="dropdown-menu list-unstyled msg_list col-md-6 msg_list_notifications" role="menu">'
				);
				for ($i = 0; $i < $for_count; $i++) {
					$("li.notificaciones>ul#notificacion").append(
						"<li id='not_" + $i + "'>"
					);
					$("li.notificaciones>ul#notificacion>li#not_" + $i).append(
						"<a id='link_" + $i + "'>"
					);
					$(
						"li.notificaciones>ul#notificacion>li#not_" + $i + ">a#link_" + $i
					).append("<span id='span_" + $i + "'>");
					$(
						"li.notificaciones>ul#notificacion>li#not_" +
							$i +
							">a#link_" +
							$i +
							">span#span_" +
							$i
					).append("<span class='title'>");
					$(
						"li.notificaciones>ul#notificacion>li#not_" +
							$i +
							">a#link_" +
							$i +
							">span#span_" +
							$i +
							">span.title"
					).append(response.notificaciones_tit[$i] + "</span>");
					$(
						"li.notificaciones>ul#notificacion>li#not_" +
							$i +
							">a#link_" +
							$i +
							">span#span_" +
							$i
					).append("<span class='time'>");
					$(
						"li.notificaciones>ul#notificacion>li#not_" +
							$i +
							">a#link_" +
							$i +
							">span#span_" +
							$i +
							">span.time"
					).append(response.fecha[$i] + "</span>");
					$("li.notificaciones>ul#notificacion>li#not_" + $i).append("</span>");
					$(
						"li.notificaciones>ul#notificacion>li#not_" + $i + ">a#link_" + $i
					).append("<span class='message'>");
					$(
						"li.notificaciones>ul#notificacion>li#not_" +
							$i +
							">a#link_" +
							$i +
							">span.message"
					).append(response.notificaciones_desc[$i] + "</span>");
					$("li.notificaciones>ul#notificacion>li#not_" + $i).append("</a>");
					$("li.notificaciones>ul#notificacion").append("</li>");
				}
				$("li.notificaciones").append("</ul>");
			},
			error: function (ev) {
				notificacion(
					"Hubo un error al cargar las notificaciones, por favor, vuelva a iniciar sesión.",
					"success"
				);
			},
		});
		/*interval_notificacion = setInterval(functions() {
		$.ajax({
	        url: baseURL+"notificaciones/cargarNotificaciones",
	        type: "post",
	        dataType: "JSON",
		    success:  functions (response) {
		    	$(".badge").html("");
		    	$(".badge").html(response.count);
		    	$for_count = parseFloat(response.count);
		    	$("li.notificaciones").append('<ul id="notificacion" class="dropdown-menu list-unstyled msg_list col-md-6 msg_list_notifications" role="menu">');
		    	for($i = 0; $i < $for_count; $i++){
		    		$("li.notificaciones>ul#notificacion").append("<li id='not_"+$i+"'>");
		    			$("li.notificaciones>ul#notificacion>li#not_"+$i).append("<a id='link_"+$i+"'>");
				    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i).append("<span id='span_"+$i+"'>");
					    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i+">span#span_"+$i).append("<span class='title'>");
					    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i+">span#span_"+$i+">span.title").append(response.notificaciones_tit[$i]+"</span>");
					    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i+">span#span_"+$i).append("<span class='time'>");
					    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i+">span#span_"+$i+">span.time").append(response.fecha[$i]+"</span>");
				    		$("li.notificaciones>ul#notificacion>li#not_"+$i).append("</span>");
					    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i).append("<span class='message'>");
					    		$("li.notificaciones>ul#notificacion>li#not_"+$i+">a#link_"+$i+">span.message").append(response.notificaciones_desc[$i]+"</span>");
			    		$("li.notificaciones>ul#notificacion>li#not_"+$i).append("</a>");
		    		$("li.notificaciones>ul#notificacion").append("</li>");
		    	}
		    	$("li.notificaciones").append("</ul>");
		    },
		    error: functions(ev){
		    	notificacion("Hubo un error al cargar las notificaciones, por favor, vuelva a iniciar sesión.", "success");
		    }
		    });
		}, 60000);*/
	}

	$(".fa-eye").click(function () {
		//window.open('https://password.kaspersky.com/es/', '_blank');
	});
}
/**
	@param mensaje = mensaje a mostrar en html
	@param clase = clase a añadir en mensaje
	Funcion para mostrar mensaje en el #mensaje en html.
**/
function mensaje(mensaje, clase) {
	$("#mensaje").html(
		mensaje +
			'<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>'
	);
	$("#mensaje").addClass(clase);
	$("#mensaje .close").click(function (e) {
		$("#mensaje").html("");
		$("#mensaje").removeClass(
			"alert-warning alert-danger alert-success alert-info"
		);
	});
}

/**
	@param id = id del div a resetear inputs
	Limpia los inputs de un DIV en el DOM.
**/
function clearInputs(id) {
	$("#" + id + " :input").each(function () {
		$(this).val("");
	});
}

/**
	Funcion de notificaciones.
	@param msg = Mensaje a mostrar.
	@param type = "warning","info","success","error",
**/
function notificacion($msg, $type) {
	notif({
		type: $type,
		msg: $msg,
		position: "right",
		width: 350,
		height: 60,
		autohide: false,
		multiline: true,
		fade: true,
		bgcolor: "#0e3b5e",
		color: "#fff",
		opacity: 1,
	});
}

/**
	Boton para volver al inicio.
**/
function back_to_top() {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 50) {
			$("#back-to-top").fadeIn();
		} else {
			$("#back-to-top").fadeOut();
		}
	});
	// scroll body to 0px on click
	$("#back-to-top").click(function () {
		$("#back-to-top").tooltip("hide");
		$("body,html").animate(
			{
				scrollTop: 0,
			},
			800
		);
		return false;
	});

	$("#back-to-top").tooltip("show");
}

function sleep(milliseconds) {
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
		if (new Date().getTime() - start > milliseconds) {
			break;
		}
	}
}

/**
	TODO: Validaciones para los formularios.
**/
function validaciones() {
	/**
		Forms validations TODO.
	 	Formulario Registro
	**/
	$("form[id='formulario_registro']").validate({
		rules: {
			organizacion: {
				required: true,
				minlength: 3,
			},
			nit: {
				required: true,
				minlength: 3,
				maxlength: 10,
				//regex: "^[^.][0-9]+-[0-9]{1}?$",
			},
			nit_digito: {
				required: true,
			},
			sigla: {
				required: true,
				minlength: 3,
			},
			primer_nombre_rep_legal: {
				required: true,
				minlength: 3,
			},
			primer_apellido_rep_regal: {
				required: true,
				minlength: 3,
			},
			correo_electronico: {
				required: true,
				minlength: 3,
				email: true,
			},
			correo_electronico_rep_legal: {
				required: true,
				minlength: 3,
				email: true,
			},
			primer_nombre_persona: {
				required: true,
				minlength: 3,
			},
			primer_apellido_persona: {
				required: true,
				minlength: 3,
			},
			nombre_usuario: {
				required: true,
				minlength: 3,
				maxlength: 10,
			},
			password: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			re_password: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			aceptocond: {
				required: true,
			},
		},
		messages: {
			organizacion: {
				required: "Por favor, escriba el nombre de la organización.",
				minlength:
					"El nombre de la organización debe tener mínimo 3 caracteres.",
			},
			nit: {
				required: "Por favor, escriba el NIT de la organización.",
				minlength: "El nit debe tener mínimo 3 caracteres.",
				maxlength: "El nit debe tener maximo 10 caracteres.",
				//regex: "Por favor, escriba un NIT válido, sin puntos y con (-)."
			},
			nit_digito: {
				required: "Por favor, escriba el digito de verificación.",
			},
			sigla: {
				required: "Por favor, escriba la Sigla de la organización.",
				minlength:
					"La Sigla de la organización debe tener mínimo 3 caracteres.",
			},
			primer_nombre_rep_legal: {
				required:
					"Por favor, escriba el Primer Nombre del Representante Legal.",
				minlength:
					"El Primer Nombre del Representante Legal debe tener mínimo 3 caracteres.",
			},
			primer_apellido_rep_regal: {
				required:
					"Por favor, escriba el Primer Apellido del Representante Legal.",
				minlength:
					"El Primer Apellido del Representante Legal debe tener mínimo 3 caracteres.",
			},
			correo_electronico: {
				required:
					"Por favor, escriba un Correo Electrónico de la organizacion válido.",
				minlength: "El Correo Electrónico debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			correo_electronico_rep_legal: {
				required:
					"Por favor, escriba un Correo Electrónico del representante legal válido.",
				minlength: "El Correo Electrónico debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			primer_nombre_persona: {
				required: "Por favor, escriba su Primer Nombre.",
				minlength: "El Primer Nombre debe tener mínimo 3 caracteres.",
			},
			primer_apellido_persona: {
				required: "Por favor, escriba su Primer Apellido.",
				minlength: "El Primer Apellido debe tener mínimo 3 caracteres.",
			},
			nombre_usuario: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
				maxlength: "El Nombre de Usuario debe tener máximo 10 caracteres.",
			},
			password: {
				required: "Por favor, escriba la Contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
			re_password: {
				required: "Por favor, vuela a escribir la Contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
			aceptocond: {
				required:
					"Para continuar tiene que aceptar las condiciones y restricciones de SIA.",
			},
		},
	});
	// Formulario Login.
	$("form[id='formulario_login']").validate({
		rules: {
			usuario: {
				required: true,
				minlength: 3,
				//maxlength: 10,
			},
			password: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
		},
		messages: {
			usuario: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
				//maxlength: "El Nombre de Usuario debe tener máximo 10 caracteres."
			},
			password: {
				required: "Por favor, escriba la contraseña.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
		},
	});
	$("form[id='formulario_crear_solicitud']").validate({
		rules: {
			tipo_solicitud: {
				required: true,
			},
			motivo_solicitud: {
				required: true,
			},
			modalidad_solicitud: {
				required: true,
			},
		},
		messages: {
			tipo_solicitud: {
				required: "Seleccione un Tipo de Solicitud",
			},
			motivo_solicitud: {
				required: "Seleccione un Motivo de Solicitud",
			},
			modalidad_solicitud: {
				required: "Seleccione una Modalidad",
			},
		},
	});
	// Formulario Login Administradores.
	$("form[id='formulario_login_admin']").validate({
		rules: {
			usuario: {
				required: true,
				minlength: 3,
			},
			password: {
				required: true,
				minlength: 3,
			},
		},
		messages: {
			usuario: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
			},
			password: {
				required: "Por favor, escriba la contraseña.",
				minlength: "La Contraseña debe tener mínimo 3 caracteres.",
			},
		},
	});
	// Formulario Recordar Contraseña.
	$("form[id='formulario_recordar']").validate({
		rules: {
			nombre_usuario_rec: {
				required: true,
				minlength: 3,
			},
			correo_electronico_rec: {
				required: true,
				minlength: 3,
				email: true,
			},
			aceptocond_rec: {
				required: true,
			},
		},
		messages: {
			nombre_usuario_rec: {
				required: "Por favor, escriba el Nombre de Usuario.",
				minlength: "El Nombre de Usuario debe tener mínimo 3 caracteres.",
			},
			correo_electronico_rec: {
				required: "Por favor, escriba un Correo Electrónico valido.",
				minlength: "El Correo Electrónico debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			aceptocond_rec: {
				required:
					"Para continuar tiene que aceptar que usted es el usuario del correo.",
			},
		},
	});
	// Formulario Actualizar.
	$("form[id='formulario_actualizar']").validate({
		rules: {
			organizacion: {
				required: true,
				minlength: 3,
			},
			nit: {
				required: true,
				minlength: 3,
				regex: "^[^.][0-9]+-[0-9]{1}?$",
			},
			sigla: {
				required: true,
				minlength: 3,
			},
			primer_nombre_rep_legal: {
				required: true,
				minlength: 3,
			},
			primer_apellido_rep_regal: {
				required: true,
				minlength: 3,
			},
			correo_electronico: {
				required: true,
				minlength: 3,
				email: true,
			},
			correo_electronico_rep_legal: {
				required: true,
				minlength: 3,
				email: true,
			},
			primer_nombre_persona: {
				required: true,
				minlength: 3,
			},
			primer_apellido_persona: {
				required: true,
				minlength: 3,
			},
		},
		messages: {
			organizacion: {
				required: "Por favor, escriba el nombre de la organización.",
				minlength:
					"El nombre de la organización debe tener mínimo 3 caracteres.",
			},
			nit: {
				required: "Por favor, escriba el NIT de la organización.",
				minlength: "El nit debe tener mínimo 3 caracteres.",
				regex: "Por favor, escriba un NIT válido, sin puntos y con (-).",
			},
			sigla: {
				required: "Por favor, escriba la Sigla de la organización.",
				minlength:
					"El nombre de la organización debe tener mínimo 3 caracteres.",
			},
			primer_nombre_rep_legal: {
				required:
					"Por favor, escriba el Primer Nombre del Representante Legal.",
				minlength:
					"El Primer Nombre del Representante Legal debe tener mínimo 3 caracteres.",
			},
			primer_apellido_rep_regal: {
				required:
					"Por favor, escriba el Primer Apellido del Representante Legal.",
				minlength:
					"El Primer Apellido del Representante Legal debe tener mínimo 3 caracteres.",
			},
			correo_electronico: {
				required: "Por favor, escriba un Correo Electrónico válido.",
				minlength:
					"El Correo Electrónico de la organización debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			correo_electronico_rep_legal: {
				required: "Por favor, escriba un Correo Electrónico válido.",
				minlength:
					"El Correo Electrónico del Representante Legal debe tener mínimo 3 caracteres.",
				email: "Por favor, escriba un Correo Electrónico valido.",
			},
			primer_nombre_persona: {
				required: "Por favor, escriba su Primer Nombre.",
				minlength: "Su Primer Nombre debe tener mínimo 3 caracteres.",
			},
			primer_apellido_persona: {
				required: "Por favor, escriba su Primer Apellido.",
				minlength: "Su Primer Apellido debe tener mínimo 3 caracteres.",
			},
		},
	});
	// Formulario Actualizar Contraseña.
	$("form[id='formulario_actualizar_contrasena']").validate({
		rules: {
			contrasena_anterior: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			contrasena_nueva: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
			re_contrasena_nueva: {
				required: true,
				minlength: 8,
				maxlength: 10,
				regex:
					"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,10}$",
			},
		},
		messages: {
			contrasena_anterior: {
				required: "Por favor, escriba la contraseña anterior.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
			contrasena_nueva: {
				required: "Por favor, escriba la contraseña nueva.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
			re_contrasena_nueva: {
				required: "Por favor, vuelva a escribir la contraseña nueva.",
				minlength: "La Contraseña debe tener mínimo 8 caracteres.",
				maxlength: "La Contraseña debe tener máximo 10 caracteres.",
				regex:
					"Debe tener mínimo 8 y máximo 10 caracteres, al menos una mayúscula, una minúscula, un número, y un cáracter especial (#?!@$%^&*-).",
			},
		},
	});
	// Formulario Actualizar Nombre de usuario.
	$("form[id='formulario_actualizar_usuario']").validate({
		rules: {
			usuario_nuevo: {
				required: true,
				minlength: 3,
			},
		},
		messages: {
			usuario_nuevo: {
				required: "Por favor, escriba el nombre de usuario nuevo.",
				minlength: "La Contraseña debe tener mínimo 3 caracteres.",
			},
		},
	});
	// Formulario Actualizar Nombre de usuario.
	$("form[id='formulario_actualizar_imagen']").validate({
		rules: {
			imagen: {
				required: true,
				validators: {
					notEmpty: {
						message: "Por favor, seleccione una imagen en JPG, PNG, JPEG.",
					},
					file: {
						extension: "jpeg,jpg,png",
						type: "image/jpeg,image/png",
						maxSize: 20000, // 2048 * 1024 1024 * 2
						message: "La imagen selecionada no es válida, seleccione otra.",
					},
				},
			},
		},
		messages: {
			imagen: {
				required: "Por favor, seleccione una imagen en JPG, PNG, JPEG.",
			},
		},
	});
	// Fomulario Docentes
	$("form[id='formulario_docentes']").validate({
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
	})
	/*$("form[id='div_llenar_curso']").validate({
		rules: {
	      informe_nombre_curso: {
	        required: true,
	        minlength: 3
	      },
	      informe_tipo_curso: {
	        required: true
	      },
	      informe_intencionalidad_curso: {
	        required: true
	      },
	      unionOrg: {
	        required: true
	      },
	      informe_duracion_curso: {
	        required: true
	      },
	      informe_departamento_curso: {
	        required: true
	      },
	      informe_municipio_curso: {
	        required: true
	      },
	      gratisCurso: {
	        required: true
	      },
	      informe_docente: {
	        required: true
	      },
	      informe_fecha_curso: {
	        required: true
	      },
	      informe_asistentes: {
	        required: true
	      },
	      informe_numero_mujeres: {
	        required: true
	      },
	      informe_numero_hombres: {
	        required: true
	      }
	    },
	    messages: {
	      informe_nombre_curso: {
	         required: "Por favor, escriba el nombre del curso"
	      },
	      informe_tipo_curso: {
	         required: "Por favor, seleccione el tipo de curso"
	      },
	      informe_intencionalidad_curso: {
	         required: "Por favor, seleccione la intencionalidad del curso"
	      },
	      unionOrg: {
	         required: "Por favor, seleccione y existio alguna union para hacer el curso"
	      },
	      informe_duracion_curso: {
	         required: "Por favor, escriba la duracion de horas del curso"
	      },
	      informe_departamento_curso: {
	         required: "Por favor, seleccione el departamento donde se realizo el curso"
	      },
	      informe_municipio_curso: {
	         required: "Por favor, seleccione el municipio donde se realizo el curso"
	      },
	      gratisCurso: {
	         required: "Por favor, seleccione si el curso fue gratis o no"
	      },
	      informe_docente: {
	         required: "Por favor, seleccione un docente válido en el sistema para impartir los cursos"
	      },
	      informe_fecha_curso: {
	         required: "Por favor, seleccione la fecha de realización del curso"
	      },
	      informe_asistentes: {
	         required: "Por favor, escriba el total de asistentes al curso"
	      },
	      informe_numero_mujeres: {
	         required: "Por favor, escriba el total de mujeres"
	      },
	      informe_numero_hombres: {
	         required: "Por favor, escriba el total de hombres"
	      }
	    }
	});*/



	/**
		Termina Forms validations
	**/
}

function paging(tabla) {
	$("#" + tabla + "tbody").empty();
	$("#" + tabla).paging({ limit: 10 });
}

/**
	TODO: Tablas a iniciarlizar con Data Table, si se van añadir mas tablas a inicializar escribir el id sin el # en el array "tablas".
**/
function tablas() {
	if (typeof $.fn.DataTable === "undefined") {
		return;
	}

	var tablas = [
		"tabla_asginadas",
		"tabla_sinasignar",
		"tabla_actividad",
		"tabla_bateriaObs",
		"tabla_enProceso_organizacion",
		"tabla_seguimientos",
		"tabla_actividad_admin",
		"tabla_super_admins",
		"tabla_verdocentes",
		"tabla_docentes",
		"tabla_docentes_no_asignados",
		"tabla_docentes_asignados",
		"tabla_visitas",
		"tabla_plan",
		"tabla_solicitudes",
		"tabla_observaciones_form1",
		"tabla_observaciones_form2",
		"tabla_observaciones_form3",
		"tabla_observaciones_form4",
		"tabla_observaciones_form5",
		"tabla_observaciones_form7",
		"tabla_observaciones_form8",
		"tabla_registro_programas",
	];

	for (i = 0; i < tablas.length; i++) {
		var handleDataTableButtons = function () {
			if ($("#" + tablas[i] + "").length) {
				$("#" + tablas[i] + "").DataTable({
					dom: "Bfrtip",
					buttons: [
						{
							extend: "pageLength",
							className: "btn-sm",
							text: "Ver Filas",
						},
						{
							extend: "copy",
							className: "btn-sm",
							text: "Copiar Tabla",
						},
						{
							extend: "csv",
							className: "btn-sm",
							text: "Descargar a CSV",
						},
						/*{
					  	extend: "print",
					  	className: "btn-sm",
					  	text: "Imprimir Todo"
					},*/
						{
							extend: "excelHtml5",
							autoFilter: true,
							className: "btn-sm",
							text: "Descargar a Excel",
							/*header: "Unidad Administrativa especial de organizaciones Solidarias",
						footer: "Unidad Administrativa especial de organizaciones Solidarias",*/
							//messageBottom: "Unidad Administrativa Especial de Organizaciones Solidarias | SIIA",
							messageTop:
								"Registro de ____________________________ por la Unidad Administrativa Especial de Organizaciones Solidarias | SIIA " +
								$.datepicker.formatDate("dd/mm/yy", new Date()),
							sheetName: "Datos SIIA",
							//title: "Datos",
							filename: document.title,
							customize: function (xlsx) {
								var sheet = xlsx.xl.worksheets["sheet1.xml"];
								$("row n", sheet).each(function () {
									// if cell starts with http
									if ($("is t", this).text().indexOf("http") === 0) {
										// (2.) change the type to `str` which is a formula
										$(this).attr("t", "str");
										//append the formula
										$(this).append(
											"<f>" +
												'HYPERLINK("' +
												$("is t", this).text() +
												'","' +
												$("is t", this).text() +
												'")' +
												"</f>"
										);
										//remove the inlineStr
										$("is", this).remove();
										// (3.) underline
										$(this).attr("s", "4");
									}
								});
								$("row:nth-child(3) c", sheet).attr("s", "7");
								$("row:nth-child(2) a", sheet).attr("s", "55");
							},
							exportOptions: {
								stripHtml: true,
							},
						},
						{
							extend: "pdfHtml5",
							className: "btn-sm",
							text: "PDF",
							orientation: "landscape",
							pageSize: "A0",
							exportOptions: {
								stripHtml: true,
							},
							customize: function (doc) {
								doc.defaultStyle.fontSize = 12; //2,3,4,etc
								doc.styles.tableHeader.fontSize = 14; //2, 3, 4, etc
								doc.content.splice(1, 0, {
									margin: [0, 0, 0, 12],
									alignment: "center",
									image:
										"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAWgAAACKCAYAAACHHtDoAAAVf0lEQVR4nO2d3XGrOheGTwcrJVBCSuDyu0wJVHDGpwM6SAkuwdf7yiW4BJeQEvKFbSksxJIQ+kPA+8xoJsEgLQl4jIUE//wDAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADsC/rfv29bxwAAAKdnkPFP6n7S7Sd9/aRvIz1/0vUnfWwdKwAAnIYf6fYWKdvSIOtu67gBAOCw/Ej2/Sc9VojZTHd0gwAAQGKUnNdcNdvSA5IGAIBEeMj5obo9dPpcuNKGpAEAIJYFOQ83CBvHtq1D1JA0AACEsiDnbkU+V0gaAAASkUrOLD9IGgAAYkktZ5YvJA0AAKHkkjPLH5KORO2joX//Ytyc1alVqdk6VgBAInLLmZUDSa9A7ZdBvHfHyJil8efDyJo2YUx9YCzeMZQoIwZ6TcDyjQnHNQinlJxZeZD0AvSaSh8zMUhKX0rWTWRspxY0vX6hrImpyx0TOCil5czKhaQFfur+sfLqLDRdQ0UNQVuPXVt65I4JHJCt5MzKh6QV9HoA1a2AmM10CYj17IIOmVXb5I4LHIit5cziOL2kKf45J7HpvqatzyxoenU9hcTV54wLHIha5MziOa2kF/ZFyTS09btnzGcWdOivnGfOuMBBqE3OLK7TSZpe3RpbXjkH7f+zClrtr5j29foCBCelVjmz+E4laUd9q5Wzivusgr5EtvE1V2xg59QuZ81ZJE3rh2pVIWcV+1kFHftr5ytXbGDH7EXOmjNImsInnmwqZxX76QT9k2+TqL3xGjgwsjc5a44sabVPthZz8P4/qaA/E7X5LUd8YIfsVc6ao0o6wck+7NMbyc/iuJHfT/EuIv4zCvqZSNDfez52QSL2LmfNESUdcbJ/+e47eo04uFjK8srDkfepBE3p7xd0qWMEO+IoctYcSdIUPlRr2J9Bw7QM2XUJ6nA2QduOv9CEqd9n5Why1hxF0hFXY11kue+p9v8JBZ1jIlGTOk5QOaXlTK9przdW5iDL6KelOcrbvaTp9TCktSdzVcOzziRoCp/avZT6lHGCyikpZ/KbAZe0TFb2riUdKJ771nFzTiboXA+wwtTvs1ChnBfLVvkMV5OXtSfVniUdKB5cQW8gaIqf2r2UMPX76JSUsypv7Ykzi0Ed+E/zimJNvHuVdIR4uq1j15xI0LFTu5cSpn4fmdJyVmWaYh3SnV59z16xLJx8Q16NZyy7kzSF3yT8SimfGE4k6NwPsqrqlxFIyEZylqa73tjnXjF5nHzeQ8r2JukIQfMvsM63fTLV4fCCthzrORKmfh+N0nJWQrhbymzXxqYOfp+hS1512aGkU57gTxp/wQxSa3PL+ySCDpnt+fA8rnnC1O8jUVLO5HdDcHaAeUr6TcmkJfeDg7zqtCdJe7RpqqSHPX6kbIMS8ixRxkL5z4CyL47j0JWqOj5BID7iS1yer0ja2FjJfUPGq26Ok6MqSS/UNWe6phBYCXmWKMNRdshY9SE1gdt2sTGDjVkrvIW8hgOpdUlr5QnSp4h5Yf3Ws27VS5rK9W/a0p0iJhOVkGeJMhxl244hV3qobUOG5mHq955ZKzpHPh80vyr+tKz7tJzY0mgN642OtbE71h+WeQnWcYLVJOkQCaRM3g9eEmI/rKCVYEOmdl9YHiGTW5qYuMFGrBWcJY/hoLs7Do53YX1znZvx+VXluRjD2jo41vceN0qVS5r8b5TmTl1A7EcWdBdYbhOZRx8TN9iAtWKz5NF6iKBV6+rRGjkO/LWStg1H846D6pd0qAw2lXQJeZYow1JuyNXvw8gjpJsDU7/3xFqhWfLwEcCTXldzq0dr5K6T5SRdFQdB0j5p2CfNipgPKWgKvzdwEfK6B+SDqd97YK3ILHm4Tvy7OgGG0QRJnq2RqG6zA5TkvvBmZZl7kPTW3R1ruo+OKujQ0TVNorww9bt2FgTWeebhkvPFWDd6tEbCOs7yt9RldsXiUWbtkh6u3u6JZBuaGs9YjyrokPHp4ggMCrsax9TvmnGIa42cbeMwxenTZB+t0QufJZuWaqmr+BNPWC9oWBJVLukBevW953rE5VISR/QIMR5O0BT+Il/rxQKFCR9Tv2vEIqy1craNDLA+20JYN3i0xlpUvDp/11C9mVgjyqxe0gOq7YdfD/yFCLmT1xdfCXmWKMMoL/RFvo0jz5BuDkz9rg1KN875Lmw/kzO5R2t4l1cKkrs52oj8diFpDo1T4y9KXnfKM2V8sf4HFfQzoCznFxqFX5VXeQyekoRyliQ2kTMFPltjaywHeheZ5+4kbYPGmaF9Amm3HuUdStAUPrV78V4IBT7TY20dQAZSyVnlJR0I5g3BYqM1UiPE2CfI8zCS5ijhhHaL+EjnaIK2HQdLqfHIO+ipeGvrABKTWM7SFcDdWKf4aI2U5IrxwJIOFVyfMe+2QPzeZahyQqd2507NmnqAhKSUs8pPkkxrrPMU1rlT5tEaqRBi7BPmfThJU/j79HqPvI8kaNeQ1C2T14gakJjUclZ5Lg5DE8oyR2t8UqbRGimg+U3NPnH+R5Q0BL1czlZDGpcSpn6XhtwPyOkC82yFvKSpp4vr1ExuQasybJK+L29dHxD0Yhkhk0lKJu+6gAQIkomSs8pTGmspTUjZtXRCRBJYjk3SXY7yjHKTPYshQj69R95HEfRWL07wTZj6XQqy93V1kfnO7hJb1pNGcOzmACglaFWWJOlsPzlZeV+p6uX4ollKi/cfDiToUq8eC02Y+l0Ky8EQ3c1A86ty8cqY7F8Qu5B0SUGr8qT9lfzmqe3LQAmqCcjvzZKnb1q8ij+CoCl8Eknp1Pm2GQiE5J+bSboYfAVtWXc3kt5A0FLfftJ28hSpfvFrR5bXlNE4UUV6282a5PUrIbc8S5RB4VO7S6fqJo4dDpKvXrtEeZvSte5Qcs8krFrSQrx9gTKfpiwT5u0j59LJ6xjILc8SZQj7tua0y1FEu8FysCVpdFo5uoF2Kmkh1r5AmV79+wH51ijnIXndpMwtz9xlUPjU7q3SrkZc7Q7pYEuY9ypBq212J+kt4syx36heOXt3ueWUZ4kyKt4HtoSp3znJcaKzvE1Be/VZ0c4kLdRzSF3mMpPut8rF0MS0i2dqty6D4qZ29wnSM/f+ASuxHGy5ujjWXAntRtJkH7PaZSxzJtSUeVWUVv2EthzPexG0bTTTUkpys85xHC8lTP3OheWg6BLlHSxotf0uJL0QZ5epzKdRTvBPzQgx5E6r93EueZYog8Kndndr28lSvjSiyydh6ncuLDslSYNTpKBZfLaffaeUNGUYZkf1STqoPrnkmbuMCDkOKdlICscxnKz9wEoEkQ6pz5Bv0Phqcv/0Op2kLWVET1Sh1wSJ58Zijjr2csizRBkLx7grJR2LHFG3as7Dw0HyFVm0VCiRoFVerm/2ag4OyixpyjzVm8anB24h5ucaUVri36ugQ69cu5j2EuIIncWIqd85EWQafQAIB12MoG1fIqeRtEXOQ8oxzbtxlJdDzEnG0+5R0BFSHFLyiSIU/iuqSx0LUJB7iE8XkJ90ckfd7SX7l8jhJe2QZdbptjS+wXup7UPSLfVJvVNBh/5iybLva4sHKCjdS2JtMom60iO/G1nVPMQ+laQd7Vm0rqo+H0pQN0fdpDQcV3d18n/kipvGL5O1yftxqqnLUPs3JL8sbxdSHgiJ517LuXdYYiVN9qmqSWYcOWIzZVDFq7EckvZqj1rkvASND0UyU7LnSAMA/kki6WcumdC6saLDuk2KciNjliTdeWy3CzkDAAoTI2madkUklQnN+/8eDpHpq+l+a6EZkl4cdQE5AwCcREr6kUMmgqDvavnSONKhHps+eYtJul1YD3IGACwTKmm1XY4hQGYXx5V99i50JZjp6dO9kIulNoGcAQCriLmSzhCHWb70lvCLI14u6rZU7D5AzgCAIGqQNMmTVURxkf/77+5Ux41EyBkAEM7Wkqb5ZJreYxufGXGb9k9DzgCAJFQg6UZ1Yawa50x+D6MpPhMRcgYAJGVrSa9lId7NJA05AwCysBdJL8S52XOmIWcAQFZql/RSfKq7pPgbW8gx/bsWOau2u7H2G2L7nfBD4w3bfuNQo6BxXH27dSypSL1vjrKvT0mtkvaNyyHL0pKuTc5fKl2VxO78JKXxgTqdZ55/t88Zdwghgq61LhoIGkyoTdIL0p3Fk13S//15+5vs5VYj5wEau19aY3krb+GVZ5VSg6DL5wc2oBZJr5Wz53bhkn7J+aGSTdLVyHnAR0DSFTS9nmR4U8uv+jN6dSc99UmuZajqflHrD9t9GGUMyz9pfLznTcnC3K4ztmtpfISn85nTpqBZWR8sj08au3bEurDPdP2lCVS8Hh86b0e5vapro2K467z5MaPW0b9yrjSOWOqNdT7J0tZGnD758ZiGdfDUwtrZWtKhcvbcfv3LBkY5f6skSro2aHxg+3DiNZZ1JldVND4g66FO2qc6Ft5Vfvq4+JU6a2u9vikB3fZPtc4X+//LWKbjaIxtZvka9TAF3bNy7zxG1jZSXXSbPcxtjPYx63IXyn2w9GbUV8r7StO21/noNtF5mG0tjv33yK+hsQuM16V1Hlhge2gjSZNbrn2ifPzjn8t5N5I2TmguK+tNQi0PI5+G/f33RGf/a2FdjHW+WBnfxv+tsExPXnqyfCYvBFB1EZ8gSHZB92bsuj5CXfSXws2Rr85Dx62fm24Kmper1x3OqXe2/GrE883bnsYvC71v9BVwZ7SJ+B5Bj/x0+e/GPgh+pR0oSGlJL0h1dfdEtKTtct6NpAeURPVPXS3sm/rMFLQe8XEh4UH9gtSu/H+1TEurVf9PrhQdy+5mXr6fOwTdOtaxfdnwbd6M9nHWRSrXUZ/fdc39oD6X9o3Z1joPcz/55PcU6vLp2gegMkpJOrWcPfO1x78s5yF9/aTd9dkRu5IUTlrpSYJPGq+yTKndLW0bJWga+1pnx56lTikE3TvqotsnWND0+tIzf9GsEfTsC8pWnmd+trpC0Hsit6Rzydkz/2a2wYHlPEALV25sveGzju8HQWo3Iy+eeBfHWkHrGC8sv0dmQV+EMnVq1DrDecC7DfQVtlPQrJ2vLM/rSkGnvoL+Um0623dSG4OKySlpss/GSzZ+mcYbIu64DyRnJdcrzUcKPFRbvAkn7TtN+5y1gHSXiE1qnbEN72sNEbS+Mjf7oHMKWj8G92rkzfO4WcpZErRe/sGWXY28vqlsH7TuzuL7Ksvz30EBcki6hJxZWTz+brbCseT8RtPuh7vxf6fW+xU0zUcJ3Mm4s88k8VBfAPzXCd/mSXFX0Lof+0nTvvOUgp7URS27smW8XN3Fo9tLJ9sojtaIT18gmKM4eDxm2frznu1Tvn/036GjON6NmPQ6Nyk/sAMooaSpoJxZme9HlzNHCaVnJ+Dwd8M+n4yDViLh618F2fTGNnw885B+xxurz/8uM/KQln1yadN0PHZvfm5s26n13qX/HcsmdWHr8XHgZvdBo+p7oXkXx6wMo62vLN+LEbM5brkTYosZBy3l15AxNtuWH9gJKSS9hZytHFTOID80Ds0rf9wCYCNG0g45l58qDTmDFbBfHPqGmu6qaLeODYAJoZIm+V2DkDOoHtXtwo/dL99fjQAUJ0LSDY03JSBnsCvYFTRGPIC6iezuKH+QQ84AgDOR4sZhESDn6mEjD5qtYwFu2C/hfutYwALVS7pSOeuunpXbDG2tx8G2mULLhq3OND6wp89Q5u9wuMh8fif6pIgrMIbf9qMCz3m2tZ36Mt20LcAKqpV0pXIeCBS0lsRkXPNeIMuYZlWfh7RNgjKjBU3jsLpNj2dD0OZY9uTCJnncuv4ytY7FBhVSnaQrlvNAoKCTXA2eiUSC1jMFh+N7sxl3rmOmxBU12DkWSU/m/RehcjkPmCcbjTO7hhNNz2jjz1vWknjyK2iaz1STZtFJb/q4U6Y3ntB0Vt4ni3V2BU3TmYPmbERnm1jalddn8txm9TmfRTdpL0eeT5X0WP7G+NycVfn71hRbOwttOak7+/zG8hSvoFWddGyTvmGaz5BsjTJ4e0z2p47LqKc4o5HFc6HpTEbc16kJmkp6Luf//nRZA9iBnAf4ycb/p/EZCbqvubd8/k7jg37Mt2PoacRa6npYo05vbPnT2PYp5KdjaIxtJjGqdT5ZeTrmu6XOFyM//febT5sIbdpZ6qTLb2jl20RYGw/10sK/GOvw55I8aNpm/EJFl9nR/Lkjeh1d94bkus/6oGn6uNgnq69ujwcJ9RXa42l8ztvO+UwQmj6vhO979FXXBo03s0w5X5Ug80yR3YmcBwRZ3Y2TQ3rbiHk1qJ+y1qj/9Umtn0KnBd2zbbK98cQsXy17J0O47DMzby2UC1/f1SZSm7LyzDef6KtM77eJCNv8fVynLWbdluzvWZvydhPavzf23QeLVRS09D+Pj/2t949+jOykbpbYdds5n6rHyufHZ29uA2pllPN3FknvSM4DNkEvrGOeADO5qG30SaNPkFYo/1vYVlo2i8v2OZPVrDxhXX1l2gsxiI85XYpnqU4U8DYR4UvEFPZ1YXsppsZS9weL1Vl3X0G74pHaw7HuTYhHH1/vUvm+MYGtmcs5raR3JueBRIJ2CjW1oGnhjSeu8oS8bFd8XAqpBf1tS5b89BX4p22ZxxeYFFPriCWZoNUXwc1Rxiw2R9tJ8fzubwh6r/z353NBnHGS3qGcBxIJuugVNMtPfOMJ1X8F/UUr3iZikZtOulsn5Ar69yUBQizia8aE9vMR9F3V+cOQKK6ggWK4KeiWZ7ikdyrngUSC9u2DboXyQwR9V+uIbzwxy1fLovugXW0ifUb2Pugbeb5NhMY+36dqR550OR9mzGrblv0tXqXS+GXxZtlO77vgPmj1P+8vb2jaHlct2KXYyb8PmpcPQe+CHJLesZwHEgnadxRHK5QfIujFN55QhlEcrjYxPuuM/MxRHN5vE5HEK7S7vtm2NIpDErQZ64OXRytGcbA8f+tm2RdLo1p0Ga0ZO/mP4uDxQNC7IaWkdy7nAZq/SUQaI2yuM5wY5swun3HQ0ps+pLykZWYMi288ocTjoF3xCPXSddbjoCd1Is+3ibB1GsvnN0NeznHQljxamo4p/xA+5+OgP1mZk5mEbNlvXGoZj2upPVKMgzbjmSwDNZNC0geQMwAA1EmMpCFnAADITIikIWcAACjEGklDzgAAUBhfSUPOAACwAX6ShpwBAGATwiUNOQMAQHbWSxpyBgCAYvhLGnIGAIDiLEsacgYAgM2wSxpyBgCAzZlLGnIGAIBqGCUNOQMAQHW8JA05AwAAAAAAAAAAAAAAAAAAAAAAACCO/wPN+GcgOVq6YQAAAABJRU5ErkJggg==",
								});
								// Image Data URL generada en http://dataurl.net/#dataurlmaker SIIA
							},
						},
						/*{
					  	extend: "pdf",
					  	className: "btn-sm",
					  	text: "PDF"
					},*/
					],
					lengthMenu: [
						[10, 25, 50, -1],
						["10 filas - ", "25 filas - ", "50 filas -", "Mostrar todo"],
					],
					language: {
						url: "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json",
					},
					order: [[0, "asc"]],
					rowGroup: {
						dataSrc: 0,
					},
					responsive: true,
					rowGroup: true,
					//autoFill: true,
					//fixedColumns: true,
					colReorder: true,
					//rowReorder: true,
					select: true,
					fixedHeader: {
						header: true,
						footer: true,
					},
				});
			}
		};
		TableManageButtons = (function () {
			"use strict";
			return {
				init: function () {
					handleDataTableButtons();
				},
			};
		})();
		TableManageButtons.init();
	}
	mensajeConsola();
	selects();
	paging("tabla_encuestas");
	$(".selectpicker").selectpicker("refresh");
}
// TODO: CargarArchivosDocentes
function cargarArchivosDocente($id) {
	$(".tabla_form > #tbody").empty();
	$id_docente = $id;
	var data = {
		id_docente: $id_docente,
	};
	$.ajax({
		url: "cargarDatosArchivosDocente",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			var url;
			var carpeta;
			if (response.length == 0) {
				$("<tr>").appendTo(".tabla_form > tbody");
				$("<td>Ningún dato</td>").appendTo(".tabla_form > tbody");
				$("<td>Ningún dato</td>").appendTo(".tabla_form > tbody");
				$("<td>Ningún dato</td>").appendTo(".tabla_form > tbody");
				$(".tabla_form > tbody > tr.odd").remove();
			} else {
				for (var i = 0; i < response.length; i++) {
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
					$("<td><small>" + nombre_r + "</small></td>").appendTo(
						".tabla_form > tbody"
					);
					$("<td>" + $tipo + "</td>").appendTo(".tabla_form > tbody");
					$(
						'<td><textarea class="form-control" rows="4">' +
							response[i].observacionArchivo +
							"</textarea></td>"
					).appendTo(".tabla_form > tbody");
					$(
						'<td><a target="_blank" href="' +
							url +
							response[i].nombre +
							'"><button class="btn btn-success btn-sm">Ver <i class="fa fa-eye" aria-hidden="true"></i></button></a> - <button class="btn btn-danger btn-sm eliminar_archivo_docente" data-id-tipo="' +
							response[i].tipo +
							'" data-nombre-ar="' +
							response[i].nombre +
							'" data-id-archivoDocente="' +
							response[i].id_archivosDocente +
							'" data-id-docente="' +
							response[i].docentes_id_docente +
							'">Eliminar <i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'
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
	Parametros de los selects options.
	@URL: https://silviomoreto.github.io/bootstrap-select/
**/
function selects() {
	$(".selectpicker").selectpicker({
		size: 9,
		width: "fit",
		title: "Seleccione una opción...",
		noneSelectedText: "Por favor, seleccione uno.",
		liveSearch: true,
		liveSearchNormalize: true,
		liveSearchPlaceholder: "Buscar...",
	});
}

function submenu() {
	$(".submenu").hide();
	$(".contenedor--menu").hide();

	$(".icono").click(function () {
		$(".contenedor--menu").animate({width: "toggle",});
	});

	//$( ".submenu" ).before(innerHTML = "\u25bc");
	$(".submenu");
	//despliega solo el submenu de ese menu concreto
	$(document).on("click", ".menu__enlace", function (event) {
		//$('.menu__enlace').click(functions(event){
		var elem = $(this).next();
		if (elem.is("ul")) {
			event.preventDefault();
			elem.slideToggle();
		}
	});
}

/**
	Muestra mensaje en consola :#.
**/
function mensajeConsola() {
	//console.clear();
	//console.log("%cATENCIÓN:\n*Esta consola es solo para desarrolladores.\n*Si tiene algún inconveniente comuníquese con nosotros.\n*Si tiene instalado algún AdBlock por favor deshabilitelo para esta aplicación.\nUnidad Administrativa Especial de Organizaciones Solidarias (U.A.E.O.S).\nLinea gratuita:01 8000 12 2020\nPBX:57+1 3275252\nFax:3275248\nCorreo:atencionalciudadano@orgsolidarias.gov.co", "font: 2em consolas; color: #c61f1b; background-color: #EEF3FB;");
}
/** Inicializa funciones principales **/
function initJS() {
	validaciones();
	tablas();
	back_to_top();
	init_echarts();
}

function dragElemento(elmnt) {
	var pos1 = 0,
		pos2 = 0,
		pos3 = 0,
		pos4 = 0;
	if (document.getElementById(elmnt.id + "header")) {
		// if present, the header is where you move the DIV from:
		document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
	} else {
		// otherwise, move the DIV from anywhere inside the DIV:
		elmnt.onmousedown = dragMouseDown;
	}

	function dragMouseDown(e) {
		e = e || window.event;
		e.preventDefault();
		// get the mouse cursor position at startup:
		pos3 = e.clientX;
		pos4 = e.clientY;
		document.onmouseup = closeDragElement;
		// call a functions whenever the cursor moves:
		document.onmousemove = elementDrag;
	}

	function elementDrag(e) {
		e = e || window.event;
		e.preventDefault();
		// calculate the new cursor position:
		pos1 = pos3 - e.clientX;
		pos2 = pos4 - e.clientY;
		pos3 = e.clientX;
		pos4 = e.clientY;
		// set the element's new position:
		elmnt.style.top = elmnt.offsetTop - pos2 + "px";
		elmnt.style.left = elmnt.offsetLeft - pos1 + "px";
	}

	function closeDragElement() {
		// stop moving when mouse button is released:
		document.onmouseup = null;
		document.onmousemove = null;
	}
}

function dragDivForm(div) {
	$("." + div).draggable({
		start: function (event, ui) {
			$(this).data("preventBehaviour", true);
		},
	});
	$("." + div + " :input")
		.on("mousedown", function (e) {
			var mdown = document.createEvent("MouseEvents");
			mdown.initMouseEvent(
				"mousedown",
				false,
				true,
				window,
				0,
				e.screenX,
				e.screenY,
				e.clientX,
				e.clientY,
				true,
				false,
				false,
				true,
				0,
				null
			);
			$(this)
				.closest("." + div)[0]
				.dispatchEvent(mdown);
		})
		.on("click", function (e) {
			var $draggable = $(this).closest("." + div);
			if ($draggable.data("preventBehaviour")) {
				e.preventDefault();
				$draggable.data("preventBehaviour", false);
			}
		});
}

function dragDivFormById(div) {
	$("#" + div).draggable({
		start: function (event, ui) {
			$(this).data("preventBehaviour", true);
		},
	});
	$("#" + div + " :input")
		.on("mousedown", function (e) {
			var mdown = document.createEvent("MouseEvents");
			mdown.initMouseEvent(
				"mousedown",
				false,
				true,
				window,
				0,
				e.screenX,
				e.screenY,
				e.clientX,
				e.clientY,
				true,
				false,
				false,
				true,
				0,
				null
			);
			$(this)
				.closest("#" + div)[0]
				.dispatchEvent(mdown);
		})
		.on("click", function (e) {
			var $draggable = $(this).closest("." + div);
			if ($draggable.data("preventBehaviour")) {
				e.preventDefault();
				$draggable.data("preventBehaviour", false);
			}
		});
}
/**
	Termina funciones del archivo.
**/

//TODO: Echarts
function init_echarts() {
	/**
	81 14 0 = 510E00
	120 23 14 = 78170E
	148 37 27 = 94251B
	209 80 57 = D15039
	211 117 94 = D3755E
	237 237 237 = EDEDED
	0 0 0 0 =  000000
	112 111 111 = 706F6F
	157 157 156 = 9D9D9C
	218 218 218 = DADADA
	198 31 27 = C61F1B

	**/
	if (typeof echarts === "undefined") {
		return;
	}
	theme = {
		color: [
			"#0062AB",
			"#8f1a0f",
			"#9D9D9C",
			"#23397F",
			"#c61f1b",
			"#706F6F",
			"#94251B",
			"#D15039",
		],
		title: {
			itemGap: 8,
			textStyle: {
				fontWeight: "normal",
				color: "#bc0000",
			},
		},
		dataRange: {
			color: ["#0062AB", "#706F6F"],
		},
		toolbox: {
			color: ["#000000", "#000000", "#000000", "#000000"],
		},
		tooltip: {
			backgroundColor: "rgba(0,0,0,0.5)",
			axisPointer: {
				type: "line",
				lineStyle: {
					color: "#000000",
					type: "dashed",
				},
				crossStyle: {
					color: "#000000",
				},
				shadowStyle: {
					color: "rgba(200,200,200,0.3)",
				},
			},
		},
		dataZoom: {
			dataBackgroundColor: "#eee",
			fillerColor: "rgba(64,136,41,0.2)",
			handleColor: "#706F6F",
		},
		grid: {
			borderWidth: 0,
		},
		categoryAxis: {
			axisLine: {
				lineStyle: {
					color: "#706F6F",
				},
			},
			splitLine: {
				lineStyle: {
					color: ["#eee"],
				},
			},
		},
		valueAxis: {
			axisLine: {
				lineStyle: {
					color: "#706F6F",
				},
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: ["rgba(250,250,250,0.1)", "rgba(200,200,200,0.1)"],
				},
			},
			splitLine: {
				lineStyle: {
					color: ["#eee"],
				},
			},
		},
		timeline: {
			lineStyle: {
				color: "#706F6F",
			},
			controlStyle: {
				normal: { color: "#706F6F" },
				emphasis: { color: "#706F6F" },
			},
		},
		k: {
			itemStyle: {
				normal: {
					color: "#68a54a",
					color0: "#a9cba2",
					lineStyle: {
						width: 1,
						color: "#706F6F",
						color0: "#86b379",
					},
				},
			},
		},
		map: {
			itemStyle: {
				normal: {
					areaStyle: {
						color: "#ddd",
					},
					label: {
						textStyle: {
							color: "#c12e34",
						},
					},
				},
				emphasis: {
					areaStyle: {
						color: "#99d2dd",
					},
					label: {
						textStyle: {
							color: "#c12e34",
						},
					},
				},
			},
		},
		force: {
			itemStyle: {
				normal: {
					linkStyle: {
						strokeColor: "#706F6F",
					},
				},
			},
		},
		chord: {
			padding: 4,
			itemStyle: {
				normal: {
					lineStyle: {
						width: 1,
						color: "rgba(128, 128, 128, 0.5)",
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: "rgba(128, 128, 128, 0.5)",
						},
					},
				},
				emphasis: {
					lineStyle: {
						width: 1,
						color: "rgba(128, 128, 128, 0.5)",
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: "rgba(128, 128, 128, 0.5)",
						},
					},
				},
			},
		},
		textStyle: {
			fontFamily: "Open Sans, sans-serif",
		},
	};

	//echart Bar

	if ($("#mainb").length) {
		var echartBar = echarts.init(document.getElementById("mainb"), theme);

		echartBar.setOption({
			title: {
				text: "Graph title",
				subtext: "Graph Sub-text",
			},
			tooltip: {
				trigger: "axis",
			},
			legend: {
				data: ["sales", "purchases"],
			},
			toolbox: {
				show: false,
			},
			calculable: false,
			xAxis: [
				{
					type: "category",
					data: [
						"1?",
						"2?",
						"3?",
						"4?",
						"5?",
						"6?",
						"7?",
						"8?",
						"9?",
						"10?",
						"11?",
						"12?",
					],
				},
			],
			yAxis: [
				{
					type: "value",
				},
			],
			series: [
				{
					name: "sales",
					type: "bar",
					data: [
						2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3,
					],
					markPoint: {
						data: [
							{
								type: "max",
								name: "???",
							},
							{
								type: "min",
								name: "???",
							},
						],
					},
					markLine: {
						data: [
							{
								type: "average",
								name: "???",
							},
						],
					},
				},
				{
					name: "purchases",
					type: "bar",
					data: [
						2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3,
					],
					markPoint: {
						data: [
							{
								name: "sales",
								value: 182.2,
								xAxis: 7,
								yAxis: 183,
							},
							{
								name: "purchases",
								value: 2.3,
								xAxis: 11,
								yAxis: 3,
							},
						],
					},
					markLine: {
						data: [
							{
								type: "average",
								name: "???",
							},
						],
					},
				},
			],
		});
	}

	//echart Radar

	if ($("#echart_sonar").length) {
		var echartRadar = echarts.init(
			document.getElementById("echart_sonar"),
			theme
		);

		echartRadar.setOption({
			title: {
				text: "Budget vs spending",
				subtext: "Subtitle",
			},
			tooltip: {
				trigger: "item",
			},
			legend: {
				orient: "vertical",
				x: "right",
				y: "bottom",
				data: ["Allocated Budget", "Actual Spending"],
			},
			toolbox: {
				show: true,
				feature: {
					restore: {
						show: true,
						title: "Restaurar",
					},
					saveAsImage: {
						show: true,
						title: "Guardar Imagen",
					},
				},
			},
			polar: [
				{
					indicator: [
						{
							text: "Sales",
							max: 6000,
						},
						{
							text: "Administration",
							max: 16000,
						},
						{
							text: "Information Techology",
							max: 30000,
						},
						{
							text: "Customer Support",
							max: 38000,
						},
						{
							text: "Development",
							max: 52000,
						},
						{
							text: "Marketing",
							max: 25000,
						},
					],
				},
			],
			calculable: true,
			series: [
				{
					name: "Budget vs spending",
					type: "radar",
					data: [
						{
							value: [4300, 10000, 28000, 35000, 50000, 19000],
							name: "Allocated Budget",
						},
						{
							value: [5000, 14000, 28000, 31000, 42000, 21000],
							name: "Actual Spending",
						},
					],
				},
			],
		});
	}

	//echart Funnel

	if ($("#echart_pyramid").length) {
		var echartFunnel = echarts.init(
			document.getElementById("echart_pyramid"),
			theme
		);

		echartFunnel.setOption({
			title: {
				text: "Echart Pyramid Graph",
				subtext: "Subtitle",
			},
			tooltip: {
				trigger: "item",
				formatter: "{a} <br/>{b} : {c}%",
			},
			toolbox: {
				show: true,
				feature: {
					restore: {
						show: true,
						title: "Restaurar",
					},
					saveAsImage: {
						show: true,
						title: "Guardar Imagen",
					},
				},
			},
			legend: {
				data: [
					"Something #1",
					"Something #2",
					"Something #3",
					"Something #4",
					"Something #5",
				],
				orient: "vertical",
				x: "left",
				y: "bottom",
			},
			calculable: true,
			series: [
				{
					name: "漏斗图",
					type: "funnel",
					width: "40%",
					data: [
						{
							value: 60,
							name: "Something #1",
						},
						{
							value: 40,
							name: "Something #2",
						},
						{
							value: 20,
							name: "Something #3",
						},
						{
							value: 80,
							name: "Something #4",
						},
						{
							value: 100,
							name: "Something #5",
						},
					],
				},
			],
		});
	}

	//echart Line

	if ($("#echart_line").length) {
		var echartLine = echarts.init(
			document.getElementById("echart_line"),
			theme
		);

		echartLine.setOption({
			title: {
				text: "Line Graph",
				subtext: "Subtitle",
			},
			tooltip: {
				trigger: "axis",
			},
			legend: {
				x: 220,
				y: 40,
				data: ["Intent", "Pre-order", "Deal"],
			},
			toolbox: {
				show: true,
				feature: {
					magicType: {
						show: true,
						title: {
							line: "Line",
							bar: "Bar",
							stack: "Stack",
							tiled: "Tiled",
						},
						type: ["line", "bar", "stack", "tiled"],
					},
					restore: {
						show: true,
						title: "Restaurar",
					},
					saveAsImage: {
						show: true,
						title: "Guardar Imagen",
					},
				},
			},
			calculable: true,
			xAxis: [
				{
					type: "category",
					boundaryGap: false,
					data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
				},
			],
			yAxis: [
				{
					type: "value",
				},
			],
			series: [
				{
					name: "Deal",
					type: "line",
					smooth: true,
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default",
							},
						},
					},
					data: [10, 12, 21, 54, 260, 830, 710],
				},
				{
					name: "Pre-order",
					type: "line",
					smooth: true,
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default",
							},
						},
					},
					data: [30, 182, 434, 791, 390, 30, 10],
				},
				{
					name: "Intent",
					type: "line",
					smooth: true,
					itemStyle: {
						normal: {
							areaStyle: {
								type: "default",
							},
						},
					},
					data: [1320, 1132, 601, 234, 120, 90, 20],
				},
			],
		});
	}

	//echart Scatter

	if ($("#echart_scatter").length) {
		var echartScatter = echarts.init(
			document.getElementById("echart_scatter"),
			theme
		);

		echartScatter.setOption({
			title: {
				text: "Scatter Graph",
				subtext: "Heinz  2003",
			},
			tooltip: {
				trigger: "axis",
				showDelay: 0,
				axisPointer: {
					type: "cross",
					lineStyle: {
						type: "dashed",
						width: 1,
					},
				},
			},
			legend: {
				data: ["Data2", "Data1"],
			},
			toolbox: {
				show: true,
				feature: {
					saveAsImage: {
						show: true,
						title: "Guardar Imagen",
					},
				},
			},
			xAxis: [
				{
					type: "value",
					scale: true,
					axisLabel: {
						formatter: "{value} cm",
					},
				},
			],
			yAxis: [
				{
					type: "value",
					scale: true,
					axisLabel: {
						formatter: "{value} kg",
					},
				},
			],
			series: [
				{
					name: "Data1",
					type: "scatter",
					tooltip: {
						trigger: "item",
						formatter: function (params) {
							if (params.value.length > 1) {
								return (
									params.seriesName +
									" :<br/>" +
									params.value[0] +
									"cm " +
									params.value[1] +
									"kg "
								);
							} else {
								return (
									params.seriesName +
									" :<br/>" +
									params.name +
									" : " +
									params.value +
									"kg "
								);
							}
						},
					},
					data: [
						[161.2, 51.6],
						[167.5, 59.0],
						[159.5, 49.2],
						[157.0, 63.0],
						[155.8, 53.6],
						[170.0, 59.0],
						[159.1, 47.6],
						[166.0, 69.8],
						[176.2, 66.8],
						[160.2, 75.2],
						[172.5, 55.2],
						[170.9, 54.2],
						[172.9, 62.5],
						[153.4, 42.0],
						[160.0, 50.0],
						[147.2, 49.8],
						[168.2, 49.2],
						[175.0, 73.2],
						[157.0, 47.8],
						[167.6, 68.8],
						[159.5, 50.6],
						[175.0, 82.5],
						[166.8, 57.2],
						[176.5, 87.8],
						[170.2, 72.8],
						[174.0, 54.5],
						[173.0, 59.8],
						[179.9, 67.3],
						[170.5, 67.8],
						[160.0, 47.0],
						[154.4, 46.2],
						[162.0, 55.0],
						[176.5, 83.0],
						[160.0, 54.4],
						[152.0, 45.8],
						[162.1, 53.6],
						[170.0, 73.2],
						[160.2, 52.1],
						[161.3, 67.9],
						[166.4, 56.6],
						[168.9, 62.3],
						[163.8, 58.5],
						[167.6, 54.5],
						[160.0, 50.2],
						[161.3, 60.3],
						[167.6, 58.3],
						[165.1, 56.2],
						[160.0, 50.2],
						[170.0, 72.9],
						[157.5, 59.8],
						[167.6, 61.0],
						[160.7, 69.1],
						[163.2, 55.9],
						[152.4, 46.5],
						[157.5, 54.3],
						[168.3, 54.8],
						[180.3, 60.7],
						[165.5, 60.0],
						[165.0, 62.0],
						[164.5, 60.3],
						[156.0, 52.7],
						[160.0, 74.3],
						[163.0, 62.0],
						[165.7, 73.1],
						[161.0, 80.0],
						[162.0, 54.7],
						[166.0, 53.2],
						[174.0, 75.7],
						[172.7, 61.1],
						[167.6, 55.7],
						[151.1, 48.7],
						[164.5, 52.3],
						[163.5, 50.0],
						[152.0, 59.3],
						[169.0, 62.5],
						[164.0, 55.7],
						[161.2, 54.8],
						[155.0, 45.9],
						[170.0, 70.6],
						[176.2, 67.2],
						[170.0, 69.4],
						[162.5, 58.2],
						[170.3, 64.8],
						[164.1, 71.6],
						[169.5, 52.8],
						[163.2, 59.8],
						[154.5, 49.0],
						[159.8, 50.0],
						[173.2, 69.2],
						[170.0, 55.9],
						[161.4, 63.4],
						[169.0, 58.2],
						[166.2, 58.6],
						[159.4, 45.7],
						[162.5, 52.2],
						[159.0, 48.6],
						[162.8, 57.8],
						[159.0, 55.6],
						[179.8, 66.8],
						[162.9, 59.4],
						[161.0, 53.6],
						[151.1, 73.2],
						[168.2, 53.4],
						[168.9, 69.0],
						[173.2, 58.4],
						[171.8, 56.2],
						[178.0, 70.6],
						[164.3, 59.8],
						[163.0, 72.0],
						[168.5, 65.2],
						[166.8, 56.6],
						[172.7, 105.2],
						[163.5, 51.8],
						[169.4, 63.4],
						[167.8, 59.0],
						[159.5, 47.6],
						[167.6, 63.0],
						[161.2, 55.2],
						[160.0, 45.0],
						[163.2, 54.0],
						[162.2, 50.2],
						[161.3, 60.2],
						[149.5, 44.8],
						[157.5, 58.8],
						[163.2, 56.4],
						[172.7, 62.0],
						[155.0, 49.2],
						[156.5, 67.2],
						[164.0, 53.8],
						[160.9, 54.4],
						[162.8, 58.0],
						[167.0, 59.8],
						[160.0, 54.8],
						[160.0, 43.2],
						[168.9, 60.5],
						[158.2, 46.4],
						[156.0, 64.4],
						[160.0, 48.8],
						[167.1, 62.2],
						[158.0, 55.5],
						[167.6, 57.8],
						[156.0, 54.6],
						[162.1, 59.2],
						[173.4, 52.7],
						[159.8, 53.2],
						[170.5, 64.5],
						[159.2, 51.8],
						[157.5, 56.0],
						[161.3, 63.6],
						[162.6, 63.2],
						[160.0, 59.5],
						[168.9, 56.8],
						[165.1, 64.1],
						[162.6, 50.0],
						[165.1, 72.3],
						[166.4, 55.0],
						[160.0, 55.9],
						[152.4, 60.4],
						[170.2, 69.1],
						[162.6, 84.5],
						[170.2, 55.9],
						[158.8, 55.5],
						[172.7, 69.5],
						[167.6, 76.4],
						[162.6, 61.4],
						[167.6, 65.9],
						[156.2, 58.6],
						[175.2, 66.8],
						[172.1, 56.6],
						[162.6, 58.6],
						[160.0, 55.9],
						[165.1, 59.1],
						[182.9, 81.8],
						[166.4, 70.7],
						[165.1, 56.8],
						[177.8, 60.0],
						[165.1, 58.2],
						[175.3, 72.7],
						[154.9, 54.1],
						[158.8, 49.1],
						[172.7, 75.9],
						[168.9, 55.0],
						[161.3, 57.3],
						[167.6, 55.0],
						[165.1, 65.5],
						[175.3, 65.5],
						[157.5, 48.6],
						[163.8, 58.6],
						[167.6, 63.6],
						[165.1, 55.2],
						[165.1, 62.7],
						[168.9, 56.6],
						[162.6, 53.9],
						[164.5, 63.2],
						[176.5, 73.6],
						[168.9, 62.0],
						[175.3, 63.6],
						[159.4, 53.2],
						[160.0, 53.4],
						[170.2, 55.0],
						[162.6, 70.5],
						[167.6, 54.5],
						[162.6, 54.5],
						[160.7, 55.9],
						[160.0, 59.0],
						[157.5, 63.6],
						[162.6, 54.5],
						[152.4, 47.3],
						[170.2, 67.7],
						[165.1, 80.9],
						[172.7, 70.5],
						[165.1, 60.9],
						[170.2, 63.6],
						[170.2, 54.5],
						[170.2, 59.1],
						[161.3, 70.5],
						[167.6, 52.7],
						[167.6, 62.7],
						[165.1, 86.3],
						[162.6, 66.4],
						[152.4, 67.3],
						[168.9, 63.0],
						[170.2, 73.6],
						[175.2, 62.3],
						[175.2, 57.7],
						[160.0, 55.4],
						[165.1, 104.1],
						[174.0, 55.5],
						[170.2, 77.3],
						[160.0, 80.5],
						[167.6, 64.5],
						[167.6, 72.3],
						[167.6, 61.4],
						[154.9, 58.2],
						[162.6, 81.8],
						[175.3, 63.6],
						[171.4, 53.4],
						[157.5, 54.5],
						[165.1, 53.6],
						[160.0, 60.0],
						[174.0, 73.6],
						[162.6, 61.4],
						[174.0, 55.5],
						[162.6, 63.6],
						[161.3, 60.9],
						[156.2, 60.0],
						[149.9, 46.8],
						[169.5, 57.3],
						[160.0, 64.1],
						[175.3, 63.6],
						[169.5, 67.3],
						[160.0, 75.5],
						[172.7, 68.2],
						[162.6, 61.4],
						[157.5, 76.8],
						[176.5, 71.8],
						[164.4, 55.5],
						[160.7, 48.6],
						[174.0, 66.4],
						[163.8, 67.3],
					],
					markPoint: {
						data: [
							{
								type: "max",
								name: "Max",
							},
							{
								type: "min",
								name: "Min",
							},
						],
					},
					markLine: {
						data: [
							{
								type: "average",
								name: "Mean",
							},
						],
					},
				},
				{
					name: "Data2",
					type: "scatter",
					tooltip: {
						trigger: "item",
						formatter: function (params) {
							if (params.value.length > 1) {
								return (
									params.seriesName +
									" :<br/>" +
									params.value[0] +
									"cm " +
									params.value[1] +
									"kg "
								);
							} else {
								return (
									params.seriesName +
									" :<br/>" +
									params.name +
									" : " +
									params.value +
									"kg "
								);
							}
						},
					},
					data: [
						[174.0, 65.6],
						[175.3, 71.8],
						[193.5, 80.7],
						[186.5, 72.6],
						[187.2, 78.8],
						[181.5, 74.8],
						[184.0, 86.4],
						[184.5, 78.4],
						[175.0, 62.0],
						[184.0, 81.6],
						[180.0, 76.6],
						[177.8, 83.6],
						[192.0, 90.0],
						[176.0, 74.6],
						[174.0, 71.0],
						[184.0, 79.6],
						[192.7, 93.8],
						[171.5, 70.0],
						[173.0, 72.4],
						[176.0, 85.9],
						[176.0, 78.8],
						[180.5, 77.8],
						[172.7, 66.2],
						[176.0, 86.4],
						[173.5, 81.8],
						[178.0, 89.6],
						[180.3, 82.8],
						[180.3, 76.4],
						[164.5, 63.2],
						[173.0, 60.9],
						[183.5, 74.8],
						[175.5, 70.0],
						[188.0, 72.4],
						[189.2, 84.1],
						[172.8, 69.1],
						[170.0, 59.5],
						[182.0, 67.2],
						[170.0, 61.3],
						[177.8, 68.6],
						[184.2, 80.1],
						[186.7, 87.8],
						[171.4, 84.7],
						[172.7, 73.4],
						[175.3, 72.1],
						[180.3, 82.6],
						[182.9, 88.7],
						[188.0, 84.1],
						[177.2, 94.1],
						[172.1, 74.9],
						[167.0, 59.1],
						[169.5, 75.6],
						[174.0, 86.2],
						[172.7, 75.3],
						[182.2, 87.1],
						[164.1, 55.2],
						[163.0, 57.0],
						[171.5, 61.4],
						[184.2, 76.8],
						[174.0, 86.8],
						[174.0, 72.2],
						[177.0, 71.6],
						[186.0, 84.8],
						[167.0, 68.2],
						[171.8, 66.1],
						[182.0, 72.0],
						[167.0, 64.6],
						[177.8, 74.8],
						[164.5, 70.0],
						[192.0, 101.6],
						[175.5, 63.2],
						[171.2, 79.1],
						[181.6, 78.9],
						[167.4, 67.7],
						[181.1, 66.0],
						[177.0, 68.2],
						[174.5, 63.9],
						[177.5, 72.0],
						[170.5, 56.8],
						[182.4, 74.5],
						[197.1, 90.9],
						[180.1, 93.0],
						[175.5, 80.9],
						[180.6, 72.7],
						[184.4, 68.0],
						[175.5, 70.9],
						[180.6, 72.5],
						[177.0, 72.5],
						[177.1, 83.4],
						[181.6, 75.5],
						[176.5, 73.0],
						[175.0, 70.2],
						[174.0, 73.4],
						[165.1, 70.5],
						[177.0, 68.9],
						[192.0, 102.3],
						[176.5, 68.4],
						[169.4, 65.9],
						[182.1, 75.7],
						[179.8, 84.5],
						[175.3, 87.7],
						[184.9, 86.4],
						[177.3, 73.2],
						[167.4, 53.9],
						[178.1, 72.0],
						[168.9, 55.5],
						[157.2, 58.4],
						[180.3, 83.2],
						[170.2, 72.7],
						[177.8, 64.1],
						[172.7, 72.3],
						[165.1, 65.0],
						[186.7, 86.4],
						[165.1, 65.0],
						[174.0, 88.6],
						[175.3, 84.1],
						[185.4, 66.8],
						[177.8, 75.5],
						[180.3, 93.2],
						[180.3, 82.7],
						[177.8, 58.0],
						[177.8, 79.5],
						[177.8, 78.6],
						[177.8, 71.8],
						[177.8, 116.4],
						[163.8, 72.2],
						[188.0, 83.6],
						[198.1, 85.5],
						[175.3, 90.9],
						[166.4, 85.9],
						[190.5, 89.1],
						[166.4, 75.0],
						[177.8, 77.7],
						[179.7, 86.4],
						[172.7, 90.9],
						[190.5, 73.6],
						[185.4, 76.4],
						[168.9, 69.1],
						[167.6, 84.5],
						[175.3, 64.5],
						[170.2, 69.1],
						[190.5, 108.6],
						[177.8, 86.4],
						[190.5, 80.9],
						[177.8, 87.7],
						[184.2, 94.5],
						[176.5, 80.2],
						[177.8, 72.0],
						[180.3, 71.4],
						[171.4, 72.7],
						[172.7, 84.1],
						[172.7, 76.8],
						[177.8, 63.6],
						[177.8, 80.9],
						[182.9, 80.9],
						[170.2, 85.5],
						[167.6, 68.6],
						[175.3, 67.7],
						[165.1, 66.4],
						[185.4, 102.3],
						[181.6, 70.5],
						[172.7, 95.9],
						[190.5, 84.1],
						[179.1, 87.3],
						[175.3, 71.8],
						[170.2, 65.9],
						[193.0, 95.9],
						[171.4, 91.4],
						[177.8, 81.8],
						[177.8, 96.8],
						[167.6, 69.1],
						[167.6, 82.7],
						[180.3, 75.5],
						[182.9, 79.5],
						[176.5, 73.6],
						[186.7, 91.8],
						[188.0, 84.1],
						[188.0, 85.9],
						[177.8, 81.8],
						[174.0, 82.5],
						[177.8, 80.5],
						[171.4, 70.0],
						[185.4, 81.8],
						[185.4, 84.1],
						[188.0, 90.5],
						[188.0, 91.4],
						[182.9, 89.1],
						[176.5, 85.0],
						[175.3, 69.1],
						[175.3, 73.6],
						[188.0, 80.5],
						[188.0, 82.7],
						[175.3, 86.4],
						[170.5, 67.7],
						[179.1, 92.7],
						[177.8, 93.6],
						[175.3, 70.9],
						[182.9, 75.0],
						[170.8, 93.2],
						[188.0, 93.2],
						[180.3, 77.7],
						[177.8, 61.4],
						[185.4, 94.1],
						[168.9, 75.0],
						[185.4, 83.6],
						[180.3, 85.5],
						[174.0, 73.9],
						[167.6, 66.8],
						[182.9, 87.3],
						[160.0, 72.3],
						[180.3, 88.6],
						[167.6, 75.5],
						[186.7, 101.4],
						[175.3, 91.1],
						[175.3, 67.3],
						[175.9, 77.7],
						[175.3, 81.8],
						[179.1, 75.5],
						[181.6, 84.5],
						[177.8, 76.6],
						[182.9, 85.0],
						[177.8, 102.5],
						[184.2, 77.3],
						[179.1, 71.8],
						[176.5, 87.9],
						[188.0, 94.3],
						[174.0, 70.9],
						[167.6, 64.5],
						[170.2, 77.3],
						[167.6, 72.3],
						[188.0, 87.3],
						[174.0, 80.0],
						[176.5, 82.3],
						[180.3, 73.6],
						[167.6, 74.1],
						[188.0, 85.9],
						[180.3, 73.2],
						[167.6, 76.3],
						[183.0, 65.9],
						[183.0, 90.9],
						[179.1, 89.1],
						[170.2, 62.3],
						[177.8, 82.7],
						[179.1, 79.1],
						[190.5, 98.2],
						[177.8, 84.1],
						[180.3, 83.2],
						[180.3, 83.2],
					],
					markPoint: {
						data: [
							{
								type: "max",
								name: "Max",
							},
							{
								type: "min",
								name: "Min",
							},
						],
					},
					markLine: {
						data: [
							{
								type: "average",
								name: "Mean",
							},
						],
					},
				},
			],
		});
	}

	//echart Map

	if ($("#echart_world_map").length) {
		var echartMap = echarts.init(
			document.getElementById("echart_world_map"),
			theme
		);

		echartMap.setOption({
			title: {
				text: "World Population (2010)",
				subtext:
					"from United Nations, Total population, both sexes combined, as of 1 July (thousands)",
				x: "center",
				y: "top",
			},
			tooltip: {
				trigger: "item",
				formatter: function (params) {
					var value = (params.value + "").split(".");
					value =
						value[0].replace(/(\d{1,3})(?=(?:\d{3})+(?!\d))/g, "$1,") +
						"." +
						value[1];
					return params.seriesName + "<br/>" + params.name + " : " + value;
				},
			},
			toolbox: {
				show: true,
				orient: "vertical",
				x: "right",
				y: "center",
				feature: {
					mark: {
						show: true,
					},
					dataView: {
						show: true,
						title: "Vista Texto",
						lang: ["Text View", "Cerrar", "Actualizar"],
						readOnly: false,
					},
					restore: {
						show: true,
						title: "Restaurar",
					},
					saveAsImage: {
						show: true,
						title: "Guardar Imagen",
					},
				},
			},
			dataRange: {
				min: 0,
				max: 1000000,
				text: ["High", "Low"],
				realtime: false,
				calculable: true,
				color: ["#087E65", "#bc0000", "#CBEAE3"],
			},
			series: [
				{
					name: "World Population (2010)",
					type: "map",
					mapType: "world",
					roam: false,
					mapLocation: {
						y: 60,
					},
					itemStyle: {
						emphasis: {
							label: {
								show: true,
							},
						},
					},
					data: [
						{
							name: "Afghanistan",
							value: 28397.812,
						},
						{
							name: "Angola",
							value: 19549.124,
						},
						{
							name: "Albania",
							value: 3150.143,
						},
						{
							name: "United Arab Emirates",
							value: 8441.537,
						},
						{
							name: "Argentina",
							value: 40374.224,
						},
						{
							name: "Armenia",
							value: 2963.496,
						},
						{
							name: "French Southern and Antarctic Lands",
							value: 268.065,
						},
						{
							name: "Australia",
							value: 22404.488,
						},
						{
							name: "Austria",
							value: 8401.924,
						},
						{
							name: "Azerbaijan",
							value: 9094.718,
						},
						{
							name: "Burundi",
							value: 9232.753,
						},
						{
							name: "Belgium",
							value: 10941.288,
						},
						{
							name: "Benin",
							value: 9509.798,
						},
						{
							name: "Burkina Faso",
							value: 15540.284,
						},
						{
							name: "Bangladesh",
							value: 151125.475,
						},
						{
							name: "Bulgaria",
							value: 7389.175,
						},
						{
							name: "The Bahamas",
							value: 66402.316,
						},
						{
							name: "Bosnia and Herzegovina",
							value: 3845.929,
						},
						{
							name: "Belarus",
							value: 9491.07,
						},
						{
							name: "Belize",
							value: 308.595,
						},
						{
							name: "Bermuda",
							value: 64.951,
						},
						{
							name: "Bolivia",
							value: 716.939,
						},
						{
							name: "Brazil",
							value: 195210.154,
						},
						{
							name: "Brunei",
							value: 27.223,
						},
						{
							name: "Bhutan",
							value: 716.939,
						},
						{
							name: "Botswana",
							value: 1969.341,
						},
						{
							name: "Central African Republic",
							value: 4349.921,
						},
						{
							name: "Canada",
							value: 34126.24,
						},
						{
							name: "Switzerland",
							value: 7830.534,
						},
						{
							name: "Chile",
							value: 17150.76,
						},
						{
							name: "China",
							value: 1359821.465,
						},
						{
							name: "Ivory Coast",
							value: 60508.978,
						},
						{
							name: "Cameroon",
							value: 20624.343,
						},
						{
							name: "Democratic Republic of the Congo",
							value: 62191.161,
						},
						{
							name: "Republic of the Congo",
							value: 3573.024,
						},
						{
							name: "Colombia",
							value: 46444.798,
						},
						{
							name: "Costa Rica",
							value: 4669.685,
						},
						{
							name: "Cuba",
							value: 11281.768,
						},
						{
							name: "Northern Cyprus",
							value: 1.468,
						},
						{
							name: "Cyprus",
							value: 1103.685,
						},
						{
							name: "Czech Republic",
							value: 10553.701,
						},
						{
							name: "Germany",
							value: 83017.404,
						},
						{
							name: "Djibouti",
							value: 834.036,
						},
						{
							name: "Denmark",
							value: 5550.959,
						},
						{
							name: "Dominican Republic",
							value: 10016.797,
						},
						{
							name: "Algeria",
							value: 37062.82,
						},
						{
							name: "Ecuador",
							value: 15001.072,
						},
						{
							name: "Egypt",
							value: 78075.705,
						},
						{
							name: "Eritrea",
							value: 5741.159,
						},
						{
							name: "Spain",
							value: 46182.038,
						},
						{
							name: "Estonia",
							value: 1298.533,
						},
						{
							name: "Ethiopia",
							value: 87095.281,
						},
						{
							name: "Finland",
							value: 5367.693,
						},
						{
							name: "Fiji",
							value: 860.559,
						},
						{
							name: "Falkland Islands",
							value: 49.581,
						},
						{
							name: "France",
							value: 63230.866,
						},
						{
							name: "Gabon",
							value: 1556.222,
						},
						{
							name: "United Kingdom",
							value: 62066.35,
						},
						{
							name: "Georgia",
							value: 4388.674,
						},
						{
							name: "Ghana",
							value: 24262.901,
						},
						{
							name: "Guinea",
							value: 10876.033,
						},
						{
							name: "Gambia",
							value: 1680.64,
						},
						{
							name: "Guinea Bissau",
							value: 10876.033,
						},
						{
							name: "Equatorial Guinea",
							value: 696.167,
						},
						{
							name: "Greece",
							value: 11109.999,
						},
						{
							name: "Greenland",
							value: 56.546,
						},
						{
							name: "Guatemala",
							value: 14341.576,
						},
						{
							name: "French Guiana",
							value: 231.169,
						},
						{
							name: "Guyana",
							value: 786.126,
						},
						{
							name: "Honduras",
							value: 7621.204,
						},
						{
							name: "Croatia",
							value: 4338.027,
						},
						{
							name: "Haiti",
							value: 9896.4,
						},
						{
							name: "Hungary",
							value: 10014.633,
						},
						{
							name: "Indonesia",
							value: 240676.485,
						},
						{
							name: "India",
							value: 1205624.648,
						},
						{
							name: "Ireland",
							value: 4467.561,
						},
						{
							name: "Iran",
							value: 240676.485,
						},
						{
							name: "Iraq",
							value: 30962.38,
						},
						{
							name: "Iceland",
							value: 318.042,
						},
						{
							name: "Israel",
							value: 7420.368,
						},
						{
							name: "Italy",
							value: 60508.978,
						},
						{
							name: "Jamaica",
							value: 2741.485,
						},
						{
							name: "Jordan",
							value: 6454.554,
						},
						{
							name: "Japan",
							value: 127352.833,
						},
						{
							name: "Kazakhstan",
							value: 15921.127,
						},
						{
							name: "Kenya",
							value: 40909.194,
						},
						{
							name: "Kyrgyzstan",
							value: 5334.223,
						},
						{
							name: "Cambodia",
							value: 14364.931,
						},
						{
							name: "South Korea",
							value: 51452.352,
						},
						{
							name: "Kosovo",
							value: 97.743,
						},
						{
							name: "Kuwait",
							value: 2991.58,
						},
						{
							name: "Laos",
							value: 6395.713,
						},
						{
							name: "Lebanon",
							value: 4341.092,
						},
						{
							name: "Liberia",
							value: 3957.99,
						},
						{
							name: "Libya",
							value: 6040.612,
						},
						{
							name: "Sri Lanka",
							value: 20758.779,
						},
						{
							name: "Lesotho",
							value: 2008.921,
						},
						{
							name: "Lithuania",
							value: 3068.457,
						},
						{
							name: "Luxembourg",
							value: 507.885,
						},
						{
							name: "Latvia",
							value: 2090.519,
						},
						{
							name: "Morocco",
							value: 31642.36,
						},
						{
							name: "Moldova",
							value: 103.619,
						},
						{
							name: "Madagascar",
							value: 21079.532,
						},
						{
							name: "Mexico",
							value: 117886.404,
						},
						{
							name: "Macedonia",
							value: 507.885,
						},
						{
							name: "Mali",
							value: 13985.961,
						},
						{
							name: "Myanmar",
							value: 51931.231,
						},
						{
							name: "Montenegro",
							value: 620.078,
						},
						{
							name: "Mongolia",
							value: 2712.738,
						},
						{
							name: "Mozambique",
							value: 23967.265,
						},
						{
							name: "Mauritania",
							value: 3609.42,
						},
						{
							name: "Malawi",
							value: 15013.694,
						},
						{
							name: "Malaysia",
							value: 28275.835,
						},
						{
							name: "Namibia",
							value: 2178.967,
						},
						{
							name: "New Caledonia",
							value: 246.379,
						},
						{
							name: "Niger",
							value: 15893.746,
						},
						{
							name: "Nigeria",
							value: 159707.78,
						},
						{
							name: "Nicaragua",
							value: 5822.209,
						},
						{
							name: "Netherlands",
							value: 16615.243,
						},
						{
							name: "Norway",
							value: 4891.251,
						},
						{
							name: "Nepal",
							value: 26846.016,
						},
						{
							name: "New Zealand",
							value: 4368.136,
						},
						{
							name: "Oman",
							value: 2802.768,
						},
						{
							name: "Pakistan",
							value: 173149.306,
						},
						{
							name: "Panama",
							value: 3678.128,
						},
						{
							name: "Peru",
							value: 29262.83,
						},
						{
							name: "Philippines",
							value: 93444.322,
						},
						{
							name: "Papua New Guinea",
							value: 6858.945,
						},
						{
							name: "Poland",
							value: 38198.754,
						},
						{
							name: "Puerto Rico",
							value: 3709.671,
						},
						{
							name: "North Korea",
							value: 1.468,
						},
						{
							name: "Portugal",
							value: 10589.792,
						},
						{
							name: "Paraguay",
							value: 6459.721,
						},
						{
							name: "Qatar",
							value: 1749.713,
						},
						{
							name: "Romania",
							value: 21861.476,
						},
						{
							name: "Russia",
							value: 21861.476,
						},
						{
							name: "Rwanda",
							value: 10836.732,
						},
						{
							name: "Western Sahara",
							value: 514.648,
						},
						{
							name: "Saudi Arabia",
							value: 27258.387,
						},
						{
							name: "Sudan",
							value: 35652.002,
						},
						{
							name: "South Sudan",
							value: 9940.929,
						},
						{
							name: "Senegal",
							value: 12950.564,
						},
						{
							name: "Solomon Islands",
							value: 526.447,
						},
						{
							name: "Sierra Leone",
							value: 5751.976,
						},
						{
							name: "El Salvador",
							value: 6218.195,
						},
						{
							name: "Somaliland",
							value: 9636.173,
						},
						{
							name: "Somalia",
							value: 9636.173,
						},
						{
							name: "Republic of Serbia",
							value: 3573.024,
						},
						{
							name: "Suriname",
							value: 524.96,
						},
						{
							name: "Slovakia",
							value: 5433.437,
						},
						{
							name: "Slovenia",
							value: 2054.232,
						},
						{
							name: "Sweden",
							value: 9382.297,
						},
						{
							name: "Swaziland",
							value: 1193.148,
						},
						{
							name: "Syria",
							value: 7830.534,
						},
						{
							name: "Chad",
							value: 11720.781,
						},
						{
							name: "Togo",
							value: 6306.014,
						},
						{
							name: "Thailand",
							value: 66402.316,
						},
						{
							name: "Tajikistan",
							value: 7627.326,
						},
						{
							name: "Turkmenistan",
							value: 5041.995,
						},
						{
							name: "East Timor",
							value: 10016.797,
						},
						{
							name: "Trinidad and Tobago",
							value: 1328.095,
						},
						{
							name: "Tunisia",
							value: 10631.83,
						},
						{
							name: "Turkey",
							value: 72137.546,
						},
						{
							name: "United Republic of Tanzania",
							value: 44973.33,
						},
						{
							name: "Uganda",
							value: 33987.213,
						},
						{
							name: "Ukraine",
							value: 46050.22,
						},
						{
							name: "Uruguay",
							value: 3371.982,
						},
						{
							name: "United States of America",
							value: 312247.116,
						},
						{
							name: "Uzbekistan",
							value: 27769.27,
						},
						{
							name: "Venezuela",
							value: 236.299,
						},
						{
							name: "Vietnam",
							value: 89047.397,
						},
						{
							name: "Vanuatu",
							value: 236.299,
						},
						{
							name: "West Bank",
							value: 13.565,
						},
						{
							name: "Yemen",
							value: 22763.008,
						},
						{
							name: "South Africa",
							value: 51452.352,
						},
						{
							name: "Zambia",
							value: 13216.985,
						},
						{
							name: "Zimbabwe",
							value: 13076.978,
						},
					],
				},
			],
		});
	}
}
