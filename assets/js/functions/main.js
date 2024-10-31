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
		/** No hay nada que hacer aquí. **/
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

	//TODO: Permisos panel admin
	if (funcion == "panelAdmin") {
		// 0 tot - 1 ev - 2 rep - 3 cam - 4 hist - 5 seg - 6 asignar
		$nivel = $("#data_logg").attr("nvl");
		console.log($("#data_logg").attr("nvl"));
		switch ($nivel) {
			case "0": // Total
				/** No hay nada que hacer aquí. **/
				break;
			case "1": // Evaluador
				$("#adjCamara").remove();
				$(".cambiar_img_hd").remove();
				$("#asigOrg").remove();
				// Docentes
				$("#asigDocentes").remove();
				break;
			case "2": // Reportes
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
				break;
			case "3": // Cámaras
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
				break;
			case "4": // Histórico
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
				break;
			case "5": // Seguimientos
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
				break;
			case "6": // Asignar
				break;
			case "7": // Atención al ciudadano
				// Panel admin
				$(".admin_informeActividades").remove();
				$(".admin_historico").remove();
				$(".admin_seguimiento").remove();
				$(".datos_abiertos").remove();
				$(".admin_contacto").remove();
				$(".admin_opciones_sis").remove();
				$(".estadisticas").remove();
				// Organizaciones
				$("#operaciones_menu").remove();
				$("#docentesEvaluar").remove();
				$("#asigDocentes").remove();
				$("#solicitudes_menu").remove();
				$("#verOrgPro").remove();
				$("#verFacili").remove();
				break;
			default:

				break;
		}
	}
	if (funcion == "panelAdmin" && (funcion_ == "contacto" || funcion_ == "modalInformacion")) {
		initCK();
	} else {
		/** No hay nada que hacer aquí. **/
	}
	if (funcion_ == "reportes") {
		$int_rep = setInterval(function () {
			$("#verReportes").click();
			clearInterval($int_rep);
		}, 1000);
	} else {
		/** No hay nada que hacer aquí. **/
	}
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
	notificaciones(baseURL);
	/**
		Eventos Clicks TODO
	**/

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
	$("#volver_panel_usuario").click(function () {
		window.history.back();
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

	$("#ver_informe_actividades").click(function () {
		redirect(baseURL + "panel/informe-actividades");
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
		redirect(baseURL + "panelAdmin/organizaciones/solicitudes/asignar");
	});
	$("#admin_organizaciones_inscritas").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/inscritas");
	});
	$("#admin_organizaciones_enproceso").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/solicitudes/proceso");
	});
	$("#admin_ver_finalizadas_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/solicitudes/finalizadas");
	});
	$("#admin_ver_inscritas_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/inscritas");
	});
	$("#admin_ver_observaciones_volver").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/solicitudes/observaciones");
	});
	$("#admin_organizaciones_finalizadas").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/solicitudes/finalizadas");
	});
	$("#admin_organizaciones_observaciones").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/solicitudes/observaciones");
	});
	$("#admin_camaracomercio").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/camaraComercio");
	});
	$("#admin_resoluciones").click(function () {
		redirect(baseURL + "panelAdmin/organizaciones/inscritas");
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
	$("#registro_solicitudes").click(function () {
		redirect(baseURL + "panelAdmin/reportes/solicitudes");
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
	var data_orgFinalizada = [];
	// $(document).on("click", ".verUnaObs", functions (){
	// });
	// $(".obs_admin_").parent().append('<button class="verUnaObs btn btn-siia fa fa-angle-left"></button>');
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

	/**
		Termina Eventos Cliks
	**/
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
	$("#crr_hist_obs").click(function () {
		$("#tbody_hist_obs").empty();
		$("#tbody_hist_obs").html("");
	});
	$("#llenar_asistente").modal({
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
	$("#show-pass3").click(function () {
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

	$("#docente_val_obs").change(function () {
		$(".guardarValidoDocente").attr("disabled", false);
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

	$(".eliminarDataTabla").click(function () {
		$(this).parent().parent().hide();
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
				/** notificacion(
					"Hubo un error al cargar las notificaciones, por favor, vuelva a iniciar sesión.",
					"success"
				);**/
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
	// Tablas inicializadas
	var tablas = [
		"tabla_asginadas",
		"tabla_sinasignar",
		"tabla_actividad",
		"tabla_bateriaObs",
		"tabla_enProceso_organizacion",
		"tabla_seguimientos",
		"tabla_actividad_admin",
		"tabla_super_admins",
		"tabla_super_usuarios",
		"tabla_correos_logs",
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
		"tabla_observaciones_form6",
		"tabla_observaciones_form7",
		"tabla_registro_programas",
		"tabla_organizaciones_inscritas",
		"tabla_organizaciones_resolucion",
		"tabla_asistentes_curso"
	];
	// Iniciar tablas
	for (i = 0; i < tablas.length; i++) {
		var handleDataTableButtons = function () {
			if ($("#" + tablas[i] + "").length) {
				$("#" + tablas[i] + "").DataTable({
					dom: "Bfrtip",
					buttons: [
						{
							extend: "pageLength",
							className: "btn-sm btn-danger",
							text: "Ver Filas",
						},
						{
							extend: "copy",
							className: "btn-sm",
							text: "Copiar Tabla",
						},
						/**{
							extend: "csv",
							className: "btn-sm",
							text: "Descargar a CSV",
						},*/
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
							/* header: "Unidad Administrativa especial de organizaciones Solidarias",
								footer: "Unidad Administrativa especial de organizaciones Solidarias",*/
							//messageBottom: "Unidad Administrativa Especial de Organizaciones Solidarias | SIIA",
							messageTop:
								"Registro de ____________________________ por la Unidad Administrativa Especial de Organizaciones Solidarias | SIIA ",
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
										"data:image/png;base64,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",
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
						url: "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-ES.json",
					},
					order: [[0, "desc"]],
					rowGroup: {
						dataSrc: 0,
					},
					responsive: true,
					//autoFill: true,
					//fixedColumns: true,
					//colReorder: true,
					//rowReorder: true,
					select: true,
					fixedHeader: {
						header: false,
						footer: false,
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

/** Inicializa funciones principales **/
function initJS() {
	validaciones();
	tablas();
	back_to_top();
	selects();
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
function mayus(e) {
	e.value = e.value.toUpperCase();
}
