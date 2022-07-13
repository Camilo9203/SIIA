let url = unescape(window.location.href);
let activate = url.split("/");
let baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
let html = "";
let data_orgFinalizada = [];
/** Acciones Menú Observaciones */
$("#verInfGenMenuAdmin").click(function () {
	$("#informacion").show();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verDocLegalMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").show();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verRegAcaMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").show();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verAntAcaMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").show();
	$("#jornadasActualizacion").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verJorActMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").show();
	$("#datosBasicosProgramas").hide();

	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verProgBasMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").show();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verProgsMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verFaciliMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").show();
	$("#plataforma").hide();
	$("#enLinea").hide();
});
$("#verDatPlatMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").hide();
	$("#plataforma").show();
	$("#enLinea").hide();
});
$("#verDataEnLinea").click(function () {
	//Acción mostrar solo formulario 8
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").hide();
	$("#jornadasActualizacion").hide();
	$("#datosBasicosProgramas").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").show();
	/** Formulario 8 (Nuevo) **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion']
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos en línea registrados
			if(response.enLinea.length == 0){

			}
			for (let i = 0; i < response.enLinea.length; i++) {
				html += "<tr><td>" + response.enLinea[i]['nombreHerramienta'] + "</td>";
				html += "<td>" + response.enLinea[i]['descripcionHerramienta'] + "</td>";
				html += "<td>" + response.enLinea[i]['fecha'] + "</td>";
				html += "<td><button class='btn btn-success btn-sm' id='verDocHerrramientasAdmin' data-id=" + response.enLinea[i]['id'] + ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
			}
			$(".datos_herramientas").html(html);
		}
	});
});
/** Ver Información Organizaciones Finalizadas */
$(document).on("click", ".ver_organizacion_finalizada", function () {
	let $id_org = $(this).attr("data-organizacion");
	$("#id_org_ver_form").remove();
	$("body").append("<div id='id_org_ver_form' class='hidden' data-id='" + $id_org + "'>");
	let data = {
		id_organizacion: $id_org,
	};
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$(".icono--div3").show();
			$(".icono--div4").show();
			$("#hist_org_obs").attr("data-id-org", $id_org);
			data_orgFinalizada.push(response);
			console.log(data_orgFinalizada["0"]);
			$("#admin_ver_finalizadas").slideUp();
			$("#admin_panel_ver_finalizada").slideDown();
			/** Solicitud **/
			for (var i = 0; i < response.solicitudes.length; i++) {
				$("#fechaSol").html(response.solicitudes[i].fecha);
				$("#idSol").html(response.tipoSolicitud[i].idSolicitud);
				$("#tipoSol").html(response.tipoSolicitud[i].tipoSolicitud);
				$("#modSol").html(response.tipoSolicitud[i].modalidadSolicitud);
				$("#motSol").html(response.tipoSolicitud[i].motivoSolicitud);
				$("#numeroSol").html(response.solicitudes[i].numeroSolicitudes);
				$("#revFechaFin").html(
					response.estadoOrganizaciones[i].fechaFinalizado
				);
				$("#revSol").html(response.solicitudes[i].numeroRevisiones);
				$("#revFechaSol").html(response.solicitudes[i].fechaUltimaRevision);
				$("#estOrg").html(response.estadoOrganizaciones[i].nombre);
				$("#camaraComercio_org").attr(
					"href",
					baseURL +
					"uploads/camaraComercio/" +
					response.organizaciones[i].camaraComercio
				);
				$("#nOrgSol").html(response.organizaciones[i].nombreOrganizacion);
				$("#sOrgSol").html(response.organizaciones[i].sigla);
				$("#nitOrgSol").html(response.organizaciones[i].numNIT);
				$("#nrOrgSol").html(
					response.organizaciones[i].primerNombreRepLegal +
					" " +
					response.organizaciones[i].primerApellidoRepLegal
				);
				$("#cOrgSol").html(
					response.organizaciones[i].direccionCorreoElectronicoOrganizacion
				);
			}
			/** Formulario 1 **/
			for (var i = 0; i < response.informacionGeneral.length; i++) {
				$("#actuacionOrganizacion").html(
					response.informacionGeneral[i].actuacionOrganizacion
				);
				$("#direccionOrganizacion").html(
					response.informacionGeneral[i].direccionOrganizacion
				);
				$("#extension").html(response.informacionGeneral[i].extension);
				$("#fax").html(response.informacionGeneral[i].fax);
				$("#fines").html(response.informacionGeneral[i].fines);
				$("#mision").html(response.informacionGeneral[i].mision);
				$("#nomDepartamentoUbicacion").html(
					response.informacionGeneral[i].nomDepartamentoUbicacion
				);
				$("#nomMunicipioNacional").html(
					response.informacionGeneral[i].nomMunicipioNacional
				);
				$("#numCedulaCiudadaniaPersona").html(
					response.informacionGeneral[i].numCedulaCiudadaniaPersona
				);
				$("#objetoSocialEstatutos").html(
					response.informacionGeneral[i].objetoSocialEstatutos
				);
				$("#otros").html(response.informacionGeneral[i].otros);
				$("#portafolio").html(response.informacionGeneral[i].portafolio);
				$("#presentacionInstitucional").html(
					response.informacionGeneral[i].presentacionInstitucional
				);
				$("#principios").html(response.informacionGeneral[i].principios);
				$("#tipoEducacion").html(
					response.informacionGeneral[i].tipoEducacion
				);
				$("#tipoOrganizacion").html(
					response.informacionGeneral[i].tipoOrganizacion
				);
				$("#urlOrganizacion").html(
					response.informacionGeneral[i].urlOrganizacion
				);
				$("#vision").html(response.informacionGeneral[i].vision);
				//___
				$("#actuacionOrganizacion")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].actuacionOrganizacion
					);
				$("#direccionOrganizacion")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].direccionOrganizacion
					);
				$("#extension")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].extension);
				$("#fax")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].fax);
				$("#fines")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].fines);
				$("#mision")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].mision);
				$("#nomDepartamentoUbicacion")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].nomDepartamentoUbicacion
					);
				$("#nomMunicipioNacional")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].nomMunicipioNacional
					);
				$("#numCedulaCiudadaniaPersona")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].numCedulaCiudadaniaPersona
					);
				$("#objetoSocialEstatutos")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].objetoSocialEstatutos
					);
				$("#otros")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].otros);
				$("#portafolio")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].portafolio);
				$("#presentacionInstitucional")
					.parent()
					.next()
					.attr(
						"data-text",
						response.informacionGeneral[i].presentacionInstitucional
					);
				$("#principios")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].principios);
				$("#tipoEducacion")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].tipoEducacion);
				$("#tipoOrganizacion")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].tipoOrganizacion);
				$("#urlOrganizacion")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].urlOrganizacion);
				$("#vision")
					.parent()
					.next()
					.attr("data-text", response.informacionGeneral[i].vision);
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
							"<li class='listaArchivos'><a href='" +
							$carpeta +
							data_orgFinalizada["0"].archivos[$a].nombre +
							"' target='_blank'>" +
							data_orgFinalizada["0"].archivos[$a].nombre +
							"</a></li>"
						);
					}
				}
				$("#archivos_informacionGeneral").append(
					'<div class="form-group" id="documentacionLegal-observacionesGeneral' +
					i +
					'">'
				);
				$("#archivos_informacionGeneral>div").append(
					"<p>Observaciones de archivos:</p>"
				);
				$("#archivos_informacionGeneral>div").append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de archivos de informacion general' data-text='Observaciones de archivos de la informacion general' data-type='informacionGeneral' id='obs-inf-gen-ing" +
					i +
					"' rows='3'></textarea>"
				);
				$("#archivos_informacionGeneral").append("</div>");
			}
			/** Formulario 2 **/
			for (var i = 0; i < response.documentacionLegal.length; i++) {
				if (response.documentacionLegal[i].registroEducativo != "No Tiene") {
					$("#departamentoResolucion").html(response.documentacionLegal[i].departamentoResolucion);
					$("#entidadRegistro").html(response.documentacionLegal[i].entidadRegistro);
					$("#fechaResolucion").html(response.documentacionLegal[i].fechaResolucion);
					$("#municipioResolucion").html(response.documentacionLegal[i].municipioResolucion);
					$("#numeroResolucion").html(response.documentacionLegal[i].numeroResolucion);
					$("#registroEducativo").html(response.documentacionLegal[i].registroEducativo);
					$("#departamentoResolucion").parent().next().attr("data-text", response.documentacionLegal[i].departamentoResolucion);
					$("#entidadRegistro").parent().next().attr("data-text", response.documentacionLegal[i].entidadRegistro);
					$("#fechaResolucion").parent().next().attr("data-text", response.documentacionLegal[i].fechaResolucion);
					$("#municipioResolucion").parent().next().attr("data-text", response.documentacionLegal[i].municipioResolucion);
					$("#numeroResolucion").parent().next().attr("data-text", response.documentacionLegal[i].numeroResolucion);
					$("#registroEducativo").parent().next().attr("data-text", response.documentacionLegal[i].registroEducativo);
					for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
						if (data_orgFinalizada["0"].archivos[$a].id_formulario == "2") {
							if (
								data_orgFinalizada["0"].archivos[$a].tipo == "registroEdu"
							) {
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
					$("#archivos_documentacionLegal").append(
						'<div class="form-group" id="documentacionLegal-observacionesGeneral' +
						i +
						'">'
					);
					$("#archivos_documentacionLegal>div").append(
						"<p>Observaciones de archivos:</p>"
					);
					$("#archivos_documentacionLegal>div").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de archivos documentacion legal' data-text='Observaciones de archivos de la documentacion legal' data-type='documentacionLegal' id='obs-inf-gen-docl" +
						i +
						"' rows='3'></textarea>"
					);
					$("#archivos_documentacionLegal").append("</div>");
				} else {
					$("#documentacion>.form-group").empty();

					$("#documentacion>#ll").append(
						'<div class="col-md-12" id="col' + i + '">'
					);
					$("#documentacion>#ll>#col" + i + "").append(
						"<p>Ningún registro educativo.</p>"
					);

					$("#documentacion>#ll>#col" + i + "").append(
						'<div class="form-group" id="documentacionLegal-observacionesGeneral' +
						i +
						'">'
					);
					$("#documentacion>#ll>#col" + i + "").append(
						"<p>Observaciones en general:</p>"
					);
					$("#documentacion>#ll>#col" + i + "").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones en general' data-text='Observaciones de la documentacion legal' data-type='documentacionLegal' id='obs-inf-gen-ja" +
						i +
						"' rows='3'></textarea>"
					);
					$("#documentacion>#ll>#col" + i + "").append("</div>");
					$("#documentacion>#ll").append("</div>");
				}
			}
			/** Formulario 3 **/
			if (response.registroEducativoProgramas.length > 0) {
				for (var i = 0; i < response.registroEducativoProgramas.length; i++) {
					$cols = 12 / parseFloat(response.registroEducativoProgramas.length);
					$("#registroEducativoProgramas").append('<div class="col-md-' + $cols + '" id="col' + i + '">');
					$("#registroEducativoProgramas>#col" + i + "").append('<div class="form-group" id="registroEducativoProgramas-tipoResolucion' + $cols + i + '">');
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-tipoResolucion" + $cols + i + "").append(
						"<p>Tipo de resolucion:</p><label class='tipoLeer'>" +
						response.registroEducativoProgramas[i].tipoEducacion +
						"</label>"
					);
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-tipoResolucion" + $cols + i + "").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Tipo de resolucion' data-text='" +
						response.registroEducativoProgramas[i].tipoEducacion +
						"' data-type='registroEducativo' id='observaciones' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
					);
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-tipoResolucion" + $cols + i + "").append("</div>");
					$("#registroEducativoProgramas>#col" + i + "").append('<div class="form-group" id="registroEducativoProgramas-fechaResolucion' + i + '">');
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-fechaResolucion" + i + "").append(
						"<p>Fecha de la resolucion:</p><label class='tipoLeer'>" +
						response.registroEducativoProgramas[i].fechaResolucion +
						"</label>");
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-fechaResolucion" + i + "").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Fecha de la resolucion' data-text='" +
						response.registroEducativoProgramas[i].fechaResolucion +
						"' data-type='registroEducativo' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
					);
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-fechaResolucion" + i + "").append("</div>");
					$("#registroEducativoProgramas>#col" + i + "").append('<div class="form-group" id="registroEducativoProgramas-numeroResolucion' + $cols + i + '">');
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-numeroResolucion" + $cols + i + "").append(
						"<p>Numero de la resolucion:</p><label class='tipoLeer'>" +
						response.registroEducativoProgramas[i].numeroResolucion +
						"</label>"
					);
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-numeroResolucion" + $cols + i + "").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Numero de la resolucion' data-text='" +
						response.registroEducativoProgramas[i].numeroResolucion +
						"' data-type='registroEducativo' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
					);
					$("#registroEducativoProgramas>#col" + i + ">#registroEducativoProgramas-numeroResolucion" + $cols + i + "").append("</div>");

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
						"<p>Nombre del programa:</p><label class='tipoLeer'>" +
						response.registroEducativoProgramas[i].nombrePrograma +
						"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
						i +
						">#registroEducativoProgramas-nombrePrograma" +
						$cols +
						i +
						""
					).append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Nombre del programa' data-text='" +
						response.registroEducativoProgramas[i].nombrePrograma +
						"' data-type='registroEducativo' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
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
						"<p>Objeto de la resolucion:</p><label class='tipoLeer'>" +
						response.registroEducativoProgramas[i].objetoResolucion +
						"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
						i +
						">#registroEducativoProgramas-objetoResolucion" +
						$cols +
						i +
						""
					).append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Objeto de la resolucion' data-text='" +
						response.registroEducativoProgramas[i].objetoResolucion +
						"' data-type='registroEducativo' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
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
						"<p>Entidad resolucion:</p><label class='tipoLeer'>" +
						response.registroEducativoProgramas[i].entidadResolucion +
						"</label>"
					);
					$(
						"#registroEducativoProgramas>#col" +
						i +
						">#registroEducativoProgramas-entidadResolucion" +
						$cols +
						i +
						""
					).append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Entidad resolucion' data-text='" +
						response.registroEducativoProgramas[i].entidadResolucion +
						"' data-type='registroEducativo' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
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
			}
			else {
				$("#registroEducativoProgramas").append('<div class="col-md-12" id="col' + i + '">');
				$("#registroEducativoProgramas>#col" + i + "").append("<p>Ningún registro educativo.</p>");
				$("#registroEducativoProgramas>#col" + i + "").append('<div class="form-group" id="jornadasActualizacion-observacionesGeneral' + i + '">');
				$("#registroEducativoProgramas>#col" + i + "").append("<p>Observaciones en general:</p>");
				$("#registroEducativoProgramas>#col" + i + "").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones en general' data-text='Observaciones de la registro educativo' data-type='registroEducativo' id='obs-inf-gen-ja" + i + "' rows='3'></textarea>");
				$("#registroEducativoProgramas>#col" + i + "").append("</div>");
				$("#registroEducativoProgramas>#col" + i + "").append('<div class="clearfix"></div>');
				$("#registroEducativoProgramas>#col" + i + "").append("<hr/>");
				$("#registroEducativoProgramas").append("</div>");
			}
			/** Formulario 4 **/
			for (var i = 0; i < response.antecedentesAcademicos.length; i++) {
				$cols = 12 / parseFloat(response.antecedentesAcademicos.length);
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
					"<p>Descripcion del proceso:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].descripcionProceso +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-descripcionProceso" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Descripcion del proceso' data-text='" +
					response.antecedentesAcademicos[i].descripcionProceso +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Justificacion:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].justificacion +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-justificacion" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Justificacion' data-text='" +
					response.antecedentesAcademicos[i].justificacion +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Objetivos:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].objetivos +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-objetivos" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Objetivos' data-text='" +
					response.antecedentesAcademicos[i].objetivos +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Metodologia:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].metodologia +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-metodologia" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Metodologia' data-text='" +
					response.antecedentesAcademicos[i].metodologia +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Material didactico:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].materialDidactico +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-materialDidactico" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Material didactico' data-text='" +
					response.antecedentesAcademicos[i].materialDidactico +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Bibliografia:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].bibliografia +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-bilbiografia" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Bibliografia' data-text='" +
					response.antecedentesAcademicos[i].bibliografia +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Duracion del curso:</p><label class='tipoLeer'>" +
					response.antecedentesAcademicos[i].duracionCurso +
					"</label>"
				);
				$(
					"#antecedentesAcademicos>#col" +
					i +
					">#antecedentesAcademicos-duracionCurso" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Duracion del curso' data-text='" +
					response.antecedentesAcademicos[i].duracionCurso +
					"' data-type='antecedentesAcademicos' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
			for (var i = 0; i < response.jornadasActualizacion.length; i++) {
				if (response.jornadasActualizacion[i].numeroPersonas != 0) {
					console.log(
						"j " + parseFloat(response.jornadasActualizacion.length)
					);
					$cols = 12 / parseFloat(response.jornadasActualizacion.length);
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
						"<p>Fecha de asistencia:</p><label class='tipoLeer'>" +
						response.jornadasActualizacion[i].fechaAsistencia +
						"</label>"
					);
					$(
						"#jornadasActualizacion>#col" +
						i +
						">#jornadasActualizacion-fechaAsistentes" +
						i +
						""
					).append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Fecha de asistencia' data-text='" +
						response.jornadasActualizacion[i].fechaAsistencia +
						"' data-type='jornadasActualizacion' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
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
						"<p>Numero de personas:</p><label class='tipoLeer'>" +
						response.jornadasActualizacion[i].numeroPersonas +
						"</label>"
					);
					$(
						"#jornadasActualizacion>#col" +
						i +
						">#jornadasActualizacion-numeroPersonas" +
						$cols +
						i +
						""
					).append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Numero de personas' data-text='" +
						response.jornadasActualizacion[i].numeroPersonas +
						"' data-type='jornadasActualizacion' id='obs-pnombre-docente" +
						i +
						"' rows='3'></textarea>"
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
						"<p>Observaciones de archivos:</p>"
					);
					$("#archivos_jornadasActualizacion>div").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de archivos jornadas de actualizacion' data-text='Observaciones de archivos jornadas de actualizacion' data-type='jornadasActualizacion' id='obs-inf-gen-jact" +
						i +
						"' rows='3'></textarea>"
					);
					$("#archivos_jornadasActualizacion").append("</div>");
					$("#jornadasActualizacion").append("</div>");
				} else {
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

					$("#jornadasActualizacion>#col" + i + "").append(
						'<div class="form-group" id="jornadasActualizacion-observacionesGeneral' +
						$cols +
						i +
						'">'
					);
					$(
						"#jornadasActualizacion>#col" +
						i +
						">#jornadasActualizacion-observacionesGeneral" +
						$cols +
						i +
						""
					).append("<p>Observaciones en general:</p>");
					$(
						"#jornadasActualizacion>#col" +
						i +
						">#jornadasActualizacion-observacionesGeneral" +
						$cols +
						i +
						""
					).append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones en general' data-text='Observaciones de la Jornadas de actualizacion' data-type='jornadasActualizacion' id='obs-inf-gen-ja" +
						i +
						"' rows='3'></textarea>"
					);
					$(
						"#jornadasActualizacion>#col" +
						i +
						">#jornadasActualizacion-observacionesGeneral" +
						$cols +
						i +
						""
					).append("</div>");

					$("#jornadasActualizacion>#archivos_jornadasActualizacion").append(
						'<div class="clearfix"></div>'
					);
					$("#jornadasActualizacion>#archivos_jornadasActualizacion").append(
						"<hr/>"
					);
				}
			}
			/** Formulario 6 **/
			for (var i = 0; i < response.datosProgramas.length; i++) {
				console.log(response.datosProgramas[0]['nombrePrograma']);
				for (let i = 0; i < response.datosProgramas.length; i++) {
					let programa = response.datosProgramas[i]['nombrePrograma'];
					switch (programa) {
						case "Acreditación Curso Básico de Economía Solidaria":
							$("#curso_basico_es").show();
							break;
						case "Acreditación Aval de Trabajo Asociado":
							$("#curso_basico_aval").show();
							break;
						case "Acreditación Curso Medio de Economía Solidaria":
							$("#curso_medio_es").show();
							break;
						case "Acreditación Curso Avanzado de Economía Solidaria":
							$("#curso_avanzado_es").show();
							break;
						case "Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria":
							$("#curso_economia_financiera").show();
							break;
						default:
					}
				}
			}
			/** Formulario 7 **/
			for (var i = 0; i < response.programasAvalEconomia.length; i++) {
				$("#objetivosProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].objetivos
				);
				$("#metodologiaProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].metodologia
				);
				$("#materialProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].materialDidactico
				);
				$("#bibliografiaProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].bibliografia
				);
				$("#duracionProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].duracionCurso
				);
				$("#antecedentesProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].antecedentesAspectos
				);
				$("#diferenciasProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].diferencias
				);
				$("#regulacionProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].regulacionJuridica
				);
				$("#desarrolloProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].desarrolloSocioempresarial
				);
				$("#legislacionProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].legislacionTributaria
				);
				$("#administracionProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].administracionTrabajo
				);
				$("#regimenesProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].regimenesTrabajo
				);
				$("#manejoProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].manejoSeguridad
				);
				$("#inspeccionProgramasAvalEconomia").html(
					response.programasAvalEconomia[i].inspeccionVigilancia
				);
				//___
				$("#objetivosProgramasAvalEconomia")
					.parent()
					.next()
					.attr("data-text", response.programasAvalEconomia[i].objetivos);
				$("#metodologiaProgramasAvalEconomia")
					.parent()
					.next()
					.attr("data-text", response.programasAvalEconomia[i].metodologia);
				$("#materialProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].materialDidactico
					);
				$("#bibliografiaProgramasAvalEconomia")
					.parent()
					.next()
					.attr("data-text", response.programasAvalEconomia[i].bibliografia);
				$("#duracionProgramasAvalEconomia")
					.parent()
					.next()
					.attr("data-text", response.programasAvalEconomia[i].duracionCurso);
				$("#antecedentesProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].antecedentesAspectos
					);
				$("#diferenciasProgramasAvalEconomia")
					.parent()
					.next()
					.attr("data-text", response.programasAvalEconomia[i].diferencias);
				$("#regulacionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].regulacionJuridica
					);
				$("#desarrolloProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].desarrolloSocioempresarial
					);
				$("#legislacionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].legislacionTributaria
					);
				$("#administracionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].administracionTrabajo
					);
				$("#regimenesProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].regimenesTrabajo
					);
				$("#manejoProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].manejoSeguridad
					);
				$("#inspeccionProgramasAvalEconomia")
					.parent()
					.next()
					.attr(
						"data-text",
						response.programasAvalEconomia[i].inspeccionVigilancia
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

						$(
							"#programasAvalEconomia>#archivos_programasAvalEconomia"
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
				$("#archivos_programasAvalEconomia").append(
					'<div class="form-group" id="programasAvalEconomia-observacionesGeneral' +
					i +
					'">'
				);
				$("#archivos_programasAvalEconomia>div").append(
					"<p>Observaciones de archivos:</p>"
				);
				$("#archivos_programasAvalEconomia>div").append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de archivos aval economia' data-text='Observaciones de archivos de aval economia' data-type='programasAvalEconomia' id='obs-inf-gen-progaeco" +
					i +
					"' rows='3'></textarea>"
				);
				$("#archivos_programasAvalEconomia").append("</div>");
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append(
					'<div class="clearfix"></div>'
				);
				$("#programasAvalEconomia>#archivos_programasAvalEconomia").append(
					"<hr/>"
				);
				$("#programasAvalEconomia").append("</div>");

				/*$cols = 12/(parseFloat(response.programasAvalEconomia.length));
				$("#programasAvalEconomia").append('<div class="col-md-'+$cols+'" id="col'+i+'">');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-bibliografia'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-bibliografia"+$cols+i+"").append("<p>Bibliografía:</p><label class='tipoLeer'>"+response.programasAvalEconomia[i].bibliografia+"</label>");
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-bibliografia"+$cols+i+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Bibliografía' data-text='"+response.programasAvalEconomia[i].bibliografia+"' data-type='programasAvalEconomia' id='obs-pnombre-docente"+i+"' rows='3'></textarea>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-bibliografia"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-duracionCurso'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-duracionCurso"+$cols+i+"").append("<p>Duración del curso:</p><label class='tipoLeer'>"+response.programasAvalEconomia[i].duracionCurso+"</label>");
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-duracionCurso"+$cols+i+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Duración del curso' data-text='"+response.programasAvalEconomia[i].duracionCurso+"' data-type='programasAvalEconomia' id='obs-pnombre-docente"+i+"' rows='3'></textarea>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-duracionCurso"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-materialDidactico'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-materialDidactico"+$cols+i+"").append("<p>Material didactico:</p><label class='tipoLeer'>"+response.programasAvalEconomia[i].materialDidactico+"</label>");
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-materialDidactico"+$cols+i+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Material didactico' data-text='"+response.programasAvalEconomia[i].materialDidactico+"' data-type='programasAvalEconomia' id='obs-pnombre-docente"+i+"' rows='3'></textarea>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-materialDidactico"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-metodologia'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-metodologia"+$cols+i+"").append("<p>Metodología:</p><label class='tipoLeer'>"+response.programasAvalEconomia[i].metodologia+"</label>");
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-metodologia"+$cols+i+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Metodología' data-text='"+response.programasAvalEconomia[i].metodologia+"' data-type='programasAvalEconomia' id='obs-papellido-docente"+i+"' rows='3'></textarea>");
				$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-metodologia"+$cols+i+"").append('</div>');

				$("#programasAvalEconomia>#col"+i+"").append('<div class="form-group" id="programasAvalEconomia-objetivos'+$cols+i+'">');
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-objetivos"+$cols+i+"").append("<p>Objetivos:</p><label class='tipoLeer'>"+response.programasAvalEconomia[i].objetivos+"</label>");
					$("#programasAvalEconomia>#col"+i+">#programasAvalEconomia-objetivos"+$cols+i+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Objetivos' data-text='"+response.programasAvalEconomia[i].objetivos+"' data-type='programasAvalEconomia' id='obs-sapellido-docente"+i+"' rows='3'></textarea>");
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
			for (var i = 0; i < response.programasAvalar.length; i++) {
				console.log(parseFloat(response.programasAvalar.length));
				$cols = 12 / parseFloat(response.programasAvalar.length);
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
					"<p>Bibliografía:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].bibliografia +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-bibliografia" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Bibliografía' data-text='" +
					response.programasAvalar[i].bibliografia +
					"' data-type='programasAvalar' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Contenidos planteados:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].contenidosPlanteados +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-contenidosPlanteados" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Contenidos planteados' data-text='" +
					response.programasAvalar[i].contenidosPlanteados +
					"' data-type='programasAvalar' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Material didactico:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].materialDidactico +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-materialDidactico" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Material didactico' data-text='" +
					response.programasAvalar[i].materialDidactico +
					"' data-type='programasAvalar' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Metodología:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].metodologia +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-metodologia" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Metodología' data-text='" +
					response.programasAvalar[i].metodologia +
					"' data-type='programasAvalar' id='obs-papellido-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Objetivos:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].objetivos +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-objetivos" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Objetivos' data-text='" +
					response.programasAvalar[i].objetivos +
					"' data-type='programasAvalar' id='obs-sapellido-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Intensidad horaria:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].intensidadHoraria +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-intensidadHoraria" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Intensidad horaria' data-text='" +
					response.programasAvalar[i].intensidadHoraria +
					"' data-type='programasAvalar' id='obs-sapellido-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Nombre del programa:</p><label class='tipoLeer'>" +
					response.programasAvalar[i].nombrePrograma +
					"</label>"
				);
				$(
					"#programasAvalar>#col" +
					i +
					">#programasAvalar-nombrePrograma" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Nombre del programa' data-text='" +
					response.programasAvalar[i].nombrePrograma +
					"' data-type='programasAvalar' id='obs-sapellido-docente" +
					i +
					"' rows='3'></textarea>"
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
				$("#archivos_programasAvalar").append(
					'<div class="form-group" id="programasAvalar-observacionesGeneral' +
					i +
					'">'
				);
				$("#archivos_programasAvalar>div").append(
					"<p>Observaciones de archivos:</p>"
				);
				$("#archivos_programasAvalar>div").append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de archivos programas a avalar' data-text='Observaciones de programas a avalar' data-type='programasAvalar' id='obs-inf-gen-progavl" +
					i +
					"' rows='3'></textarea>"
				);
				$("#archivos_programasAvalar").append("</div>");
				//$("#programasAvalar>#archivos_programasAvalar").append('<div class="clearfix"></div>');
				//$("#programasAvalar>#archivos_programasAvalar").append('<hr/>');
				$("#programasAvalar").append("</div>");
			}
			/** Formulario 9 **/
			for (var i = 0; i < response.docentes.length; i++) {
				/*$cols = 12/(parseFloat(response.docentes.length));
				if($cols <= 3){
					$cols = 3;
				}

				$("#docentes").append('<div class="col-md-'+$cols+'" id="col'+i+'">');
				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].id_docente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].id_docente+"").append("<p>ID:</p><label class='tipoLeer'>"+response.docentes[i].id_docente+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].id_docente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].valido+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].valido+"").append("<p>Valido:</p><label class='tipoLeer'>"+response.docentes[i].valido+"</label>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].valido+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].primerNombreDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].primerNombreDocente+"").append("<p>Primer nombre:</p><label class='tipoLeer'>"+response.docentes[i].primerNombreDocente+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].primerNombreDocente+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Primer nombre' data-text='"+response.docentes[i].primerNombreDocente+"' data-type='docente' id='obs-pnombre-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].primerNombreDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].segundoNombreDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].segundoNombreDocente+"").append("<p>Segundo nombre:</p><label class='tipoLeer'>"+response.docentes[i].segundoNombreDocente+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].segundoNombreDocente+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Segundo nombre' data-text='"+response.docentes[i].segundoNombreDocente+"' data-type='docente' id='obs-snombre-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].segundoNombreDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].primerApellidoDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].primerApellidoDocente+"").append("<p>Primer apellido:</p><label class='tipoLeer'>"+response.docentes[i].primerApellidoDocente+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].primerApellidoDocente+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Primer apellido' data-text='"+response.docentes[i].primerApellidoDocente+"' data-type='docente' id='obs-papellido-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].primerApellidoDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].segundoApellidoDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].segundoApellidoDocente+"").append("<p>Segundo apellido:</p><label class='tipoLeer'>"+response.docentes[i].segundoApellidoDocente+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].segundoApellidoDocente+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Segundo apellido' data-text='"+response.docentes[i].segundoApellidoDocente+"' data-type='docente' id='obs-sapellido-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].segundoApellidoDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].numCedulaCiudadaniaDocente+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].numCedulaCiudadaniaDocente+"").append("<p>Número cedula:</p><label class='tipoLeer'>"+response.docentes[i].numCedulaCiudadaniaDocente+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].numCedulaCiudadaniaDocente+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Número cedula' data-text='"+response.docentes[i].numCedulaCiudadaniaDocente+"' data-type='docente' id='obs-ncedula-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].numCedulaCiudadaniaDocente+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].profesion+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].profesion+"").append("<p>Profesion:</p><label class='tipoLeer'>"+response.docentes[i].profesion+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].profesion+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Profesion' data-text='"+response.docentes[i].profesion+"' data-type='docente' id='obs-profesion-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].profesion+"").append('</div>');

				$("#docentes>#col"+i+"").append('<div class="form-group" id="docentes-'+$cols+i+response.docentes[i].horaCapacitacion+'">');
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].horaCapacitacion+"").append("<p>Horas de capacitacion:</p><label class='tipoLeer'>"+response.docentes[i].horaCapacitacion+"</label>");
					$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].horaCapacitacion+"").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Horas de capacitacion' data-text='"+response.docentes[i].horaCapacitacion+"' data-type='docente' id='obs-horas-docente"+i+"' rows='3'></textarea>");
				$("#docentes>#col"+i+">#docentes-"+$cols+i+response.docentes[i].horaCapacitacion+"").append('</div>');

				$("#docentes").append('</div>');*/
				if (i == 0) {
					$(".txtOrgDocen").append(
						"<p>Para ver los documentos de los facilitadores haga click <a href='" +
						baseURL +
						"panelAdmin/organizaciones/docentes#organizacion:" +
						response.organizaciones[i].numNIT +
						"' target='_blank'>aquí.</a> Tambien puede ingresar al módulo de facilitadores y seleccione la organización con el número NIT: <label>" +
						response.organizaciones[i].numNIT +
						"</label>.</label>"
					);
					$(".txtOrgDocen").append(
						"<p id='cantidadDocentesOrg'>Número de facilitadores: " +
						response.docentes.length +
						"</p>"
					);
					$("#frameDocentes").attr(
						"src",
						baseURL +
						"panelAdmin/organizaciones/solodocentes#organizacion:" +
						response.organizaciones[i].numNIT
					);

					setTimeout(function () {
						document
							.getElementById("frameDocentes")
							.contentDocument.location.reload(true);
					}, 2000);

					/*for($i = 0; $i < response.docentes.length; $i++){
						$("#tbody_orgDocentes").append("<tr>");
						$("#tbody_orgDocentes").append("<td class='tDoce"+response.docentes[$i].id_docente+"'>");
						$("#tbody_orgDocentes>.tDoce"+response.docentes[$i].id_docente).append(response.docentes[$i].primerNombreDocente);
						$("#tbody_orgDocentes").append("</td");
						$("#tbody_orgDocentes").append("</tr>");
					}*/
					//$("#docentes").append('<div class="clearfix"></div>');
					//$("#docentes").append('<hr/>');

					$("#docentes").append(
						'<div class="form-group" id="docentes-observacionesGeneral0">'
					);
					$("#docentes>#docentes-observacionesGeneral0").append(
						"<p>Observaciones de los docentes en general:</label>"
					);
					$("#docentes>#docentes-observacionesGeneral0").append(
						"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de los docentes en general' data-text='Observaciones de los docentes en general' data-type='docentes' id='obs-docen-gen-0' rows='3'></textarea>"
					);
					$("#docentes").append("</div>");
				}
			}
			/** TODO: Formulario 10 **/
			for (var i = 0; i < response.plataforma.length; i++) {
				$cols = 12 / parseFloat(response.plataforma.length);
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
					"#plataforma>#col" +
					i +
					">#plataforma-urlAplicacion" +
					$cols +
					i +
					""
				).append(
					"<p>URL de la aplicación:</p><label class='tipoLeer'>" +
					response.plataforma[i].urlAplicacion +
					"</label>"
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-urlAplicacion" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='URL de la aplicación' data-text='" +
					response.plataforma[i].urlAplicacion +
					"' data-type='plataforma' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
				); //<a href='"+response.plataforma[i].urlAplicacion+"' target='_blank'>Ingresar.</a>
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-urlAplicacion" +
					$cols +
					i +
					""
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
					"<p>Nombre de usuario en la aplicación:</p><label class='tipoLeer'>" +
					response.plataforma[i].usuarioAplicacion +
					"</label>"
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-usuarioAplicacion" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Nombre de usuario en la aplicación' data-text='" +
					response.plataforma[i].usuarioAplicacion +
					"' data-type='plataforma' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
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
					"<p>Contraseña en la aplicacion:</p><label class='tipoLeer'>" +
					response.plataforma[i].contrasenaAplicacion +
					"</label>"
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-contrasenaAplicacion" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Contraseña en la aplicacion' data-text='" +
					response.plataforma[i].contrasenaAplicacion +
					"' data-type='plataforma' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-contrasenaAplicacion" +
					$cols +
					i +
					""
				).append("</div>");

				$("#plataforma>#col" + i + "").append(
					'<div class="form-group" id="plataforma-observacionesGeneral' +
					$cols +
					i +
					'">'
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesGeneral" +
					$cols +
					i +
					""
				).append("<p>Observaciones en general:</p>");
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesGeneral" +
					$cols +
					i +
					""
				).append(
					"<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones en general' data-text='Observaciones de la plataforma' data-type='plataforma' id='obs-pnombre-docente" +
					i +
					"' rows='3'></textarea>"
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesGeneral" +
					$cols +
					i +
					""
				).append("</div>");

				$("#plataforma>#col" + i + "").append(
					'<div class="form-group" id="plataforma-observacionesArchivo' +
					$cols +
					i +
					'">'
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesArchivo" +
					$cols +
					i +
					""
				).append("<p>Observaciones de la plataforma:</label>");
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesArchivo" +
					$cols +
					i +
					""
				).append(
					'<input type="file" required accept="application/pdf" class="form-control" data-val="observacionesPlataformaVirtual" name="obsPlataforma" id="obsPlataforma"><br/>'
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesArchivo" +
					$cols +
					i +
					""
				).append(
					'<input type="button" class="btn btn-siia archivos_form_obsPlataforma fa-fa" data-name="obsPlataforma" name="obsPlataforma" id="obsPlataformaV" value="Guardar archivo de observaciones &#xf00c">'
				);
				$(
					"#plataforma>#col" +
					i +
					">#plataforma-observacionesArchivo" +
					$cols +
					i +
					""
				).append("</div>");

				$("#plataforma").append("</div>");
				$("#plataforma").append(
					'<div class="col-md-12" id="archivos_plataforma">'
				);
				$("#plataforma>#archivos_plataforma").append("<p>Archivos:</p>");
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "10") {
						if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"instructivoPlataforma"
						) {
							$carpeta = baseURL + "uploads/instructivosPlataforma/";
						}

						if (
							data_orgFinalizada["0"].archivos[$a].tipo ==
							"observacionesPlataformaVirtual"
						) {
							$carpeta = baseURL + "uploads/observacionesPlataforma/";
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
				$("#archivos_plataforma").append(
					'<div class="form-group" id="plataforma-observacionesGeneral' +
					i +
					'">'
				);
				$("#archivos_plataforma>div").append(
					"<p>Observaciones de archivos:</p>"
				);
				$("#archivos_plataforma>div").append(
					"<textarea class='form-control obs_admin_' data-title='Observaciones de archivos plataforma' data-text='Observaciones de la plataforma' data-type='plataforma' id='obs-inf-gen-pla" +
					i +
					"' rows='3'></textarea>"
				);
				$("#archivos_plataforma").append("</div>");
				$("#plataforma>#archivos_plataforma").append(
					'<div class="clearfix"></div>'
				);
				$("#plataforma>#archivos_plataforma").append("<hr/>");
				$("#plataforma").append("</div>");
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
			$("#plataforma").append("</div>");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/** Terminar proceso de observación */
$(document).on("click", "#terminar_proceso_observacion", function () {
	$id_org = $("#id_org_ver_form").attr("data-id");
	data_org = {
		id_organizacion: $id_org,
	};
	$observaciones_adm = [];
	for ($i = 0; $i < $("#datos_org_final textarea.obs_admin_").length; $i++) {
		$type = $("#datos_org_final textarea.obs_admin_").eq($i).attr("data-type");
		$title = $("#datos_org_final textarea.obs_admin_").eq($i).attr("data-title");
		$texto = $("#datos_org_final textarea.obs_admin_").eq($i).attr("data-text");
		$valor = $("#datos_org_final textarea.obs_admin_").eq($i).val();
		$rev = $("#revSol").html();
		$id_solicitud = $("#idSol").html();
		$numero_rev = parseFloat($rev) + 1;

		data = {
			type: $type,
			title: $title,
			text: $texto,
			valor: $valor,
			numero_rev: $numero_rev,
			id_solicitud: $id_solicitud,
			id_organizacion: $id_org,
		};
		$observaciones_adm.push(data);
	}
	$("#terminar_proceso_observacion").attr("disabled", true);
	$.ajax({
		url: baseURL + "admin/cambiarEstado_Observaciones",
		type: "post",
		dataType: "JSON",
		data: data_org,
		beforeSend: function () {
			notificacion("Espere...", "success");
		},
		success: function (response) {
			notificacion("Proceso terminado, espere 5 segundos...", "success");
			setInterval(function () {
				redirect("finalizadas");
			}, 5000);
			/*for($j = 0; $j < $observaciones_adm.length; $j++){
				console.log($observaciones_adm[$j]);
				if($observaciones_adm[$j].valor == ""){

				}else{
					$.ajax({
						url: baseURL+"admin/guardar_observacion",
						type: "post",
						dataType: "JSON",
						data: $observaciones_adm[$j],
						success:  function (response) {

						},
						error: function(ev){
							//Do nothing
						}
					});
				}
			}*/
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
// Ver Documento
$(document).on("click", "#verDocHerrramientasAdmin", function (){
	data = {
		id: $(this).attr("data-id"),
		formulario: 8,
	}
	$.ajax({
		url: baseURL + "Admin/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_blank');
		}
	});
});
/** Guardar Observaciones */
$(".guardarObservacionesForm8").click(function (){
	let data = {
		observacion: $("#observacionesForm8").val(),
		id_formulario: 8,
		formulario: "Observaciones Modalidad En Linea",
		valueForm: "datosEnLinea",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
function guardarObservacion(data) {
	$.ajax({
		url: baseURL + "admin/guardarObservacion",
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


$("#guardarSiObs").click(function () {
	$id_org = $("#id_org_ver_form").attr("data-id");
	data_org = {
		id_organizacion: $id_org,
	};
	$observaciones_adm = [];
	for ($i = 0; $i < $("#datos_org_final textarea.obs_admin_").length; $i++) {
		$type = $("#datos_org_final textarea.obs_admin_").eq($i).attr("data-type");
		$title = $("#datos_org_final textarea.obs_admin_").eq($i).attr("data-title");
		$texto = $("#datos_org_final textarea.obs_admin_").eq($i).attr("data-text");
		$valor = $("#datos_org_final textarea.obs_admin_").eq($i).val();
		$rev = $("#revSol").html();
		$id_solicitud = $("#idSol").html();
		$numero_rev = parseFloat($rev) + 1;

		data = {
			type: $type,
			title: $title,
			text: $texto,
			valor: $valor,
			numero_rev: $numero_rev,
			id_solicitud: $id_solicitud,
			id_organizacion: $id_org,
		};
		$observaciones_adm.push(data);
	}

	for ($j = 0; $j < $observaciones_adm.length; $j++) {
		if ($observaciones_adm[$j].valor == "") {
			$("#guardarOBSSI").modal("hide");
			notificacion("No hay observaciones que guardar...", "success");
		} else {
			$.ajax({
				url: baseURL + "admin/guardar_observacion",
				type: "post",
				dataType: "JSON",
				data: $observaciones_adm[$j],
				success: function (response) {
					notificacion(response.msg, "success");
					$("#guardarOBSSI").modal("hide");
					for ($i = 0; $i < $("#datos_org_final textarea.obs_admin_").length; $i++) {
						$(".obs_admin_").eq($i).val("");
					}
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	}
});

