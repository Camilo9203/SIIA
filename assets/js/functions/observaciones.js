let html = "";
let obsForm = 0;
let data_orgFinalizada = [];
/**
 * Acciones Menú Observaciones
 * */
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
	/** Formulario 1 Tablas **/
	verObservaciones(1);
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
	// Formulario 2 Tablas
	html = "";
	obsForm = 0;
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			// Llenar tabla de datos documentación legal
			if (response.documentacion['tipo'] == 1) {
				html = "";
				html += "<tr><td>La organización registro Cámara de Comercio </td>";
				$(".head_tabla_datos_documentacion_legal").html(html);
				html = "";
				html += "<td>La organización registro Cámara de Comercio </td></tr>";
				$(".tabla_datos_documentacion_legal").html(html);
			}
			if (response.documentacion['tipo'] == 2) {
				html = "";
				html += "<tr><td colspan='5'>Certificado de existencia y representación legal</td></tr>"
				html += "<tr><td>Entidad</td>"
				html += "<td>Fecha Expedición</td>"
				html += "<td>Departamento</td>"
				html += "<td>Municipio</td>"
				html += "<td>Documento</td></tr>"
				$(".head_tabla_datos_documentacion_legal").html(html);
				html = "";
				html += "<tr><td>" + response.certificadoExistencia['entidad'] + "</td>";
				html += "<td>" + response.certificadoExistencia['fechaExpedicion'] + "</td>";
				html += "<td>" + response.certificadoExistencia['departamento'] + "</td>";
				html += "<td>" + response.certificadoExistencia['municipio'] + "</td>";
				html += "<td><button class='btn btn-success btn-sm verDocumentoLegal' data-form='2.1' data-id=" + response.certificadoExistencia['id_certificadoExistencia'] + ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				console.log(response.certificadoExistencia);
				$(".tabla_datos_documentacion_legal").html(html);
			}
			if (response.documentacion['tipo'] == 3) {
				html = "";
				html += "<tr><td colspan='7'>Registro Educativo</td></tr>"
				html += "<tr><td>Entidad</td>"
				html += "<td>Fecha Expedición</td>"
				html += "<td>Nombre Programa</td>"
				html += "<td>Numero Resolución</td>"
				html += "<td>Objeto</td>"
				html += "<td>Tipo Educación</td>"
				html += "<td>Documento</td></tr>"
				$(".head_tabla_datos_documentacion_legal").html(html);
				html = "";
				html += "<tr><td>" + response.registroEducativoProgramas['entidadResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['fechaResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['nombrePrograma'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['numeroResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['objetoResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['tipoEducacion'] + "</td>";
				html += "<td><button class='btn btn-success btn-sm verDocumentoLegal' data-form='2.2' data-id=" + response.registroEducativoProgramas['id_registroEducativoPro'] + ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				console.log(response.registroEducativoProgramas);
				$(".tabla_datos_documentacion_legal").html(html);
			}
			verObservaciones(2);
		}
	});
})
/**
 * Funciones Formulario 2
 * */
// Ver Documento
$(document).on("click", ".verDocumentoLegal", function () {
	let data = {
		id: $(this).attr("data-id"),
		formulario: $(this).attr("data-form"),
	}
	verDocumentos(data);
});
// Función Ver Documentos
function verDocumentos (data) {
	event.preventDefault();
	$.ajax({
		url: baseURL + "panel/verDocumento",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response){
			window.open(response.file, '_blank');
		}
	});
}
$("#verAntAcaMenuAdmin").click(function () {
	$("#informacion").hide();
	$("#documentacion").hide();
	$("#registroEducativoProgramas").hide();
	$("#antecedentesAcademicos").show();
	$("#jornadasActualizacion").hide();
	$("#docentes").hide();
	$("#plataforma").hide();
	$("#enLinea").hide();
	// Formulario 3 Tablas
	html = "";
	obsForm = 0;
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos antecedentes académicos
			if(response.antecedentesAcademicos.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.antecedentesAcademicos.length; i++) {
					html += "<tr><td>" + response.antecedentesAcademicos[i]['descripcionProceso'] + "</td>";
					html += "<td>" + response.antecedentesAcademicos[i]['justificacion'] + "</td>";
					html += "<td>" + response.antecedentesAcademicos[i]['objetivos'] + "</td>";
					html += "<td>" + response.antecedentesAcademicos[i]['metodologia'] + "</td>";
					html += "<td>" + response.antecedentesAcademicos[i]['materialDidactico'] + "</td>";
					html += "<td>" + response.antecedentesAcademicos[i]['bibliografia'] + "</td>";
					html += "<td>" + response.antecedentesAcademicos[i]['duracionCurso'] + "</td>";
				}
			}
			$(".tabla_datos_antecedentes").html(html);
			verObservaciones(3);
		}
	});
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
	/** Formulario 2 Tablas **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 4,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos antecedentes académicos
			if(response.jornadasActualizacion.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				html += "<tr><td>" + response.jornadasActualizacion['asistio'] + "</td>";
				for ($i = 0; $i < response.archivos.length; $i++) {
					if (response.archivos[$i].id_formulario == "3") {
						html += "<td><a class='btn btn-sm btn-siia' href='" + baseURL + 'uploads/jornadas/' + response.archivos[$i]['nombre'] + "' target='_blank'> Ver documento </td></tr>";
					}
				}

			}
			$(".tabla_datos_jornadas").html(html);
			verObservaciones(3);
		}
	});
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
	/** Formulario 6 Tablas **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 5,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			// Llenar tabla de datos en línea registrados
			if(response.datosProgramas.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.datosProgramas.length; i++) {
					html += "<tr><td>" + response.organizaciones['nombreOrganizacion'] + "</td>";
					html += "<td>" + response.organizaciones['numNIT'] + "</td>";
					html += "<td>" + response.datosProgramas[i]['nombrePrograma'] + "</td>";
					html += "<td>" + response.datosProgramas[i]['aceptarPrograma'] + "</td>";
					html += "<td>" + response.datosProgramas[i]['fecha'] + "</td>";
					switch (response.datosProgramas[i]['nombrePrograma']) {
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
			$(".tabla_registro_programas").html(html);
			verObservaciones(4);

		}
	});
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
	/** Formulario 7 Tabla **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 7,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$("#tabla_observaciones_form7").dataTable();
			// Llenar tabla de datos en línea registrados
			if(response.plataforma.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.plataforma.length; i++) {
					html += "<tr><td><a href='" + response.plataforma[i]['urlAplicacion'] + "' target='_blank'>" +response.plataforma[i]['urlAplicacion'] + "</a></td>";
					html += "<td>" + response.plataforma[i]['usuarioAplicacion'] + "</td>";
					html += "<td>" + response.plataforma[i]['contrasenaAplicacion'] + "</td>";
				}
			}
			console.log(response.observaciones);
			$(".tabla_datos_plataforma").html(html);
			verObservaciones(6);
		}
	});
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
	/** Formulario 8 Tabla **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 8,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos en línea registrados
			if(response.enLinea.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.enLinea.length; i++) {
					html += "<tr><td>" + response.enLinea[i]['nombreHerramienta'] + "</td>";
					html += "<td>" + response.enLinea[i]['descripcionHerramienta'] + "</td>";
					html += "<td>" + response.enLinea[i]['fecha'] + "</td>";
				}
			}
			$(".datos_herramientas").html(html);
			verObservaciones(7);
		}
	});
});
function verObservaciones(idForm) {
	html = "";
	obsForm = 0;
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response)
			// Llenar tabla de datos en línea registrados
			for (let i = 0; i < response.observaciones.length; i++) {
				if (response.observaciones[i]['idForm'] == idForm) {
					obsForm += 1;
				}
			}
			if(obsForm != 0){
				$("#tabla_observaciones_form" + idForm).DataTable().destroy();
				html += "<table width='100%' border=0 class='table table-striped table-bordered tabla_observaciones_form"+ idForm +"' id='tabla_observaciones_form" + idForm + "'>";
				html += "<thead><tr>";
				html += "<td>Fecha Observación</td>";
				html += "<td>Revisión</td>";
				html += "<td>Observación</td>";
				if(response.solicitudes['numeroRevisiones'] > 0 && response.estadoOrganizaciones['nombre'] == 'Finalizado')
					html += "<td>Verificada</td>";
				if(response.estadoOrganizaciones['nombre'] === 'Finalizado')
					html += "<td>Acción</td>";
				html += "</tr></thead>";
				html += "<tbody id='tbody'>";
				for (let i = 0; i < response.observaciones.length; i++) {
					if (response.observaciones[i]['idForm'] == idForm) {
						html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
						html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
						html += "<td><textarea style='width: 600px; height: 140px; resize: none; border: hidden' readonly>" + response.observaciones[i]['observacion'] + "</textarea></td>";
						if(response.solicitudes['numeroRevisiones'] > 0 && response.estadoOrganizaciones['nombre'] == 'Finalizado') {
							if (response.observaciones[i]['valida'] == 1) {
								html += "<td><input type='checkbox' class='validarObservacion' data-idform='" + idForm + "' data-id='" + response.observaciones[i]['id_observacion'] + "' checked></td>";
							}
							else {
								html += "<td><input type='checkbox' class='validarObservacion' data-idform='" + idForm + "' data-id='" + response.observaciones[i]['id_observacion'] + "'></td>";
							}
						}
						if(response.estadoOrganizaciones['nombre'] == 'Finalizado')
							html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarObservacionForm' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-file-o' aria-hidden='true'></i></button></td>";
						html += "</tr>";
					}
				}
				html += "</tbody>";
				html += "</table>";
			}
			switch (idForm) {
				case 1:
					$(".observaciones_realizadas_form1").html(html);
					break;
				case 2:
					$(".observaciones_realizadas_form2").html(html);
					break;
				case 3:
					$(".observaciones_realizadas_form3").html(html);
					break;
				case 4:
					$(".observaciones_realizadas_form4").html(html);
					break;
				case 5:
					$(".observaciones_realizadas_form5").html(html);
					break;
				case 6:
					$(".observaciones_realizadas_form6").html(html);
					break;
				case 7:
					$(".observaciones_realizadas_form7").html(html);
					break;
			}
			$("#tabla_observaciones_form" + idForm).DataTable({
				dom: 'ftipr',
				language: {
					url: "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json",
				},
				responsive: true,
				fixedHeader: {
					header: false,
					footer: false,
				},
			});
		}
	});
}
/**
 * Ver Información Organizaciones Finalizadas
 * */
$(document).on("click", ".ver_organizacion_finalizada", function () {
	let $id_org = $(this).attr("data-organizacion");
	let $idSolicitud = $(this).attr("data-solicitud");
	$("#id_org_ver_form").remove();
	$("body").append("<div id='id_org_ver_form' class='hidden' data-id='" + $id_org + "' data-solicitud='"+ $idSolicitud + "'>");
	console.log($(this).attr("data-solicitud"));
	let data = {
		id_organizacion: $id_org,
		idSolicitud: $(this).attr("data-solicitud")
	};
	obsForm = 0;
	html = "";
	$.ajax({
		url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			$(".icono--div3").show();
			$(".icono--div4").show();
			$("#hist_org_obs").attr("data-id-org", $id_org);
			data_orgFinalizada.push(response);
			console.log(data_orgFinalizada["0"]);
			console.log(response);
			if(data_orgFinalizada["0"]["plataforma"].length == 0){
				$("#verDatPlatMenuAdmin").hide();
			}
			if(data_orgFinalizada["0"]["enLinea"].length == 0){
				$("#verDataEnLinea").hide();
			}
			$("#admin_ver_finalizadas").slideUp();
			$("#admin_panel_ver_finalizada").slideDown();
			/** Solicitud **/
			$("#fechaSol").html(response.solicitudes.fechaCreacion);
			$("#idSol").html(response.solicitudes.idSolicitud);
			$("#tipoSol").html(response.estadoOrganizaciones.tipoSolicitudAcreditado);
			$("#modSol").html(response.estadoOrganizaciones.modalidadSolicitudAcreditado);
			$("#motSol").html(response.estadoOrganizaciones.motivoSolicitudAcreditado);
			$("#numeroSol").html(response.solicitudes.numeroSolicitudes);
			$("#revFechaFin").html(response.estadoOrganizaciones.fechaFinalizado);
			$("#revFechaUltimaActualizacion").html(response.estadoOrganizaciones.fechaUltimaActualizacion);
			$("#revSol").html(response.solicitudes.numeroRevisiones);
			$("#revFechaSol").html(response.solicitudes.fechaUltimaRevision);
			$("#estOrg").html(response.estadoOrganizaciones.nombre);
			$("#asignada_por").html(response.solicitudes.asignada_por);
			$("#fechaAsignacion").html(response.solicitudes.fechaAsignacion);
			$("#camaraComercio_org").attr("href", baseURL + "uploads/camaraComercio/" + response.organizaciones.camaraComercio);
			$("#nOrgSol").html(response.organizaciones.nombreOrganizacion);
			$("#sOrgSol").html(response.organizaciones.sigla);
			$("#nitOrgSol").html(response.organizaciones.numNIT);
			$("#nrOrgSol").html(response.organizaciones.primerNombreRepLegal + " " + response.organizaciones.primerApellidoRepLegal);
			$("#cOrgSol").html(response.organizaciones.direccionCorreoElectronicoOrganizacion);
			/** Formulario 1 **/
			$("#actuacionOrganizacion").html(response.informacionGeneral.actuacionOrganizacion);
			$("#direccionOrganizacion").html(response.informacionGeneral.direccionOrganizacion);
			$("#extension").html(response.informacionGeneral.extension);
			$("#fax").html(response.informacionGeneral.fax);
			//$("#fines").html(response.informacionGeneral.fines);
			$("#mision").html(response.informacionGeneral.mision);
			$("#nomDepartamentoUbicacion").html(response.informacionGeneral.nomDepartamentoUbicacion);
			$("#nomMunicipioNacional").html(response.informacionGeneral.nomMunicipioNacional);
			$("#numCedulaCiudadaniaPersona").html(response.informacionGeneral.numCedulaCiudadaniaPersona);
			//$("#objetoSocialEstatutos").html(response.informacionGeneral.objetoSocialEstatutos);
			//$("#otros").html(response.informacionGeneral.otros);
			$("#portafolio").html(response.informacionGeneral.portafolio);
			//$("#presentacionInstitucional").html(response.informacionGeneral.presentacionInstitucional);
			//$("#principios").html(response.informacionGeneral.principios);
			$("#tipoEducacion").html(response.informacionGeneral.tipoEducacion);
			$("#tipoOrganizacion").html(response.informacionGeneral.tipoOrganizacion);
			$("#urlOrganizacion").html(response.informacionGeneral.urlOrganizacion);
			$("#vision").html(response.informacionGeneral.vision);
			$("#actuacionOrganizacion").parent().next().attr(response.informacionGeneral.actuacionOrganizacion);
			$("#direccionOrganizacion").parent().next().attr("data-text", response.informacionGeneral.direccionOrganizacion);
			$("#extension").parent().next().attr("data-text", response.informacionGeneral.extension);
			$("#fax").parent().next().attr("data-text", response.informacionGeneral.fax);
			$("#fines").parent().next().attr("data-text", response.informacionGeneral.fines);
			$("#mision").parent().next().attr("data-text", response.informacionGeneral.mision);
			$("#nomDepartamentoUbicacion").parent().next().attr("data-text", response.informacionGeneral.nomDepartamentoUbicacion);
			$("#nomMunicipioNacional").parent().next().attr("data-text", response.informacionGeneral.nomMunicipioNacional);
			$("#numCedulaCiudadaniaPersona").parent().next().attr("data-text", response.informacionGeneral.numCedulaCiudadaniaPersona);
			$("#objetoSocialEstatutos").parent().next().attr("data-text", response.informacionGeneral.objetoSocialEstatutos);
			$("#otros").parent().next().attr("data-text", response.informacionGeneral.otros);
			$("#portafolio").parent().next().attr("data-text", response.informacionGeneral.portafolio);
			$("#presentacionInstitucional").parent().next().attr("data-text", response.informacionGeneral.presentacionInstitucional);
			$("#principios").parent().next().attr("data-text", response.informacionGeneral.principios);
			$("#tipoEducacion").parent().next().attr("data-text", response.informacionGeneral.tipoEducacion);
			$("#tipoOrganizacion").parent().next().attr("data-text", response.informacionGeneral.tipoOrganizacion);
			$("#urlOrganizacion").parent().next().attr("data-text", response.informacionGeneral.urlOrganizacion);
			$("#vision").parent().next().attr("data-text", response.informacionGeneral.vision);
			// Archivos formulario 1.
			for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
				if (data_orgFinalizada["0"].archivos[$a].id_formulario == "1") {
					if (data_orgFinalizada["0"].archivos[$a].tipo == "carta")
						$carpeta = baseURL + "uploads/cartaRep/";
					if (data_orgFinalizada["0"].archivos[$a].tipo == "certificaciones")
						$carpeta = baseURL + "uploads/certificaciones/";
					if (data_orgFinalizada["0"].archivos[$a].tipo == "lugar")
						$carpeta = baseURL + "uploads/lugarAtencion/";
					if (data_orgFinalizada["0"].archivos[$a].tipo == "autoevaluacion")
						$carpeta = baseURL + "uploads/autoevaluaciones/";
					let fileActive = '';
					if(data_orgFinalizada["0"].archivos[$a].activo == 0)
						fileActive = 'checked disabled';
					$("#archivos_informacionGeneral").append(
						"<ul><li class='listaArchivos'>" +
						"<a href='" + $carpeta + data_orgFinalizada["0"].archivos[$a].nombre + "' target='_blank'>" +
							data_orgFinalizada["0"].archivos[$a].nombre +
						"</a>" +
						" | Revisado <input class='revisarArchivo pull-right' type='checkbox' name='revisarArchivo'" + fileActive +  " data-id='" + data_orgFinalizada["0"].archivos[$a].id_archivo +"'> </li></ul>");
				}
			}
			$("#archivos_informacionGeneral").append('<div class="form-group" id="documentacionLegal-observacionesGeneral' + i + '">');
			// Observaciones formulario 1
			verObservaciones(1);
			/** Formulario 6 Docentes **/
			for (var i = 0; i < response.docentes.length; i++) {
				if (i == 0) {
					$(".txtOrgDocen").append(
						"<p>Para ver y evaluar los documentos de los facilitadores haga clic <a href='" +
						baseURL +
						"panelAdmin/organizaciones/docentes#organizacion:" +
						response.organizaciones.numNIT +
						"' target='_blank'>aquí.</a> También puede ingresar al módulo de facilitadores y seleccioné la organización con el número NIT: <label>" +
						response.organizaciones.numNIT +
						"</label>.</label>"
					);
					$(".txtOrgDocen").append("<p id='cantidadDocentesOrg'>Número de facilitadores: " + response.docentes.length + "</p>");
					$("#irAEvaluarDocente").attr('href', baseURL + "panelAdmin/organizaciones/docentes#organizacion:" + response.organizaciones.numNIT )
					console.log(response.organizaciones.numNIT);
					$("#frameDocentes").attr("src", baseURL + "panelAdmin/organizaciones/solodocentes#organizacion:" + response.organizaciones.numNIT);
					setTimeout(function () {
						document.getElementById("frameDocentes").contentDocument.location.reload(true);
					}, 2000);
					//$("#docentes").append('<div class="form-group" id="docentes-observacionesGeneral0">');
					//$("#docentes>#docentes-observacionesGeneral0").append("<p>Observaciones de los docentes en general:</label>");
					//$("#docentes>#docentes-observacionesGeneral0").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de los docentes en general' data-text='Observaciones de los docentes en general' data-type='docentes' id='obs-docen-gen-0' rows='3'></textarea>");
					$("#docentes").append("</div>");
				}
			}
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Consultar Información Completa de la Solicitud
 * */
if ($("#idSolicitudInfo").html() != undefined) {
	if ($("#idSolicitudInfo").html() != "") {
		let $id_org = $('#idOrganizacion').html();
		let $idSolicitud = $('#idSolicitudInfo').html();
		$("#id_org_ver_form").remove();
		$("body").append("<div id='id_org_ver_form' class='hidden' data-id='" + $id_org + "' data-solicitud='"+ $idSolicitud + "'>");
		let data = {
			id_organizacion: $id_org,
			idSolicitud: $idSolicitud
		};
		obsForm = 0;
		html = "";
		$.ajax({
			url: baseURL + "solicitudes/cargarInformacionCompletaSolicitud",
			type: "post",
			dataType: "JSON",
			data: data,
			success: function (response) {
				$(".icono--div3").show();
				$(".icono--div4").show();
				$("#hist_org_obs").attr("data-id-org", $id_org);
				data_orgFinalizada.push(response);
				if(data_orgFinalizada["0"]["plataforma"].length == 0){
					$("#verDatPlatMenuAdmin").hide();
				}
				if(data_orgFinalizada["0"]["enLinea"].length == 0){
					$("#verDataEnLinea").hide();
				}
				$("#admin_ver_finalizadas").slideUp();
				$("#admin_panel_ver_finalizada").slideDown();
				/** Solicitud **/
				$("#fechaSol").html(response.solicitudes.fecha);
				$("#idSol").html(response.solicitudes.idSolicitud);
				$("#tipoSol").html(response.estadoOrganizaciones.tipoSolicitudAcreditado);
				$("#modSol").html(response.estadoOrganizaciones.modalidadSolicitudAcreditado);
				$("#motSol").html(response.estadoOrganizaciones.motivoSolicitudAcreditado);
				$("#numeroSol").html(response.solicitudes.numeroSolicitudes);
				$("#revFechaFin").html(response.estadoOrganizaciones.fechaFinalizado);
				$("#revSol").html(response.solicitudes.numeroRevisiones);
				$("#revFechaSol").html(response.solicitudes.fechaUltimaRevision);
				$("#revFechaUltimaActualizacion").html(response.estadoOrganizaciones.fechaUltimaActualizacion);
				$("#camaraComercio_org").attr("href", baseURL + "uploads/camaraComercio/" + response.organizaciones.camaraComercio);
				$("#estOrg").html(response.estadoOrganizaciones.nombre);
				$("#nOrgSol").html(response.organizaciones.nombreOrganizacion);
				$("#sOrgSol").html(response.organizaciones.sigla);
				$("#nitOrgSol").html(response.organizaciones.numNIT);
				$("#nrOrgSol").html(response.organizaciones.primerNombreRepLegal + " " + response.organizaciones.primerApellidoRepLegal);
				$("#cOrgSol").html(response.organizaciones.direccionCorreoElectronicoOrganizacion);
				/** Formulario 1 **/
				$("#actuacionOrganizacion").html(response.informacionGeneral.actuacionOrganizacion);
				$("#direccionOrganizacion").html(response.informacionGeneral.direccionOrganizacion);
				$("#extension").html(response.informacionGeneral.extension);
				$("#fax").html(response.informacionGeneral.fax);
				$("#fines").html(response.informacionGeneral.fines);
				$("#mision").html(response.informacionGeneral.mision);
				$("#nomDepartamentoUbicacion").html(response.informacionGeneral.nomDepartamentoUbicacion);
				$("#nomMunicipioNacional").html(response.informacionGeneral.nomMunicipioNacional);
				$("#numCedulaCiudadaniaPersona").html(response.informacionGeneral.numCedulaCiudadaniaPersona);
				$("#objetoSocialEstatutos").html(response.informacionGeneral.objetoSocialEstatutos);
				$("#otros").html(response.informacionGeneral.otros);
				$("#portafolio").html(response.informacionGeneral.portafolio);
				$("#presentacionInstitucional").html(response.informacionGeneral.presentacionInstitucional);
				$("#principios").html(response.informacionGeneral.principios);
				$("#tipoEducacion").html(response.informacionGeneral.tipoEducacion);
				$("#tipoOrganizacion").html(response.informacionGeneral.tipoOrganizacion);
				$("#urlOrganizacion").html(response.informacionGeneral.urlOrganizacion);
				$("#vision").html(response.informacionGeneral.vision);
				$("#actuacionOrganizacion").parent().next().attr(response.informacionGeneral.actuacionOrganizacion);
				$("#direccionOrganizacion").parent().next().attr("data-text", response.informacionGeneral.direccionOrganizacion);
				$("#extension").parent().next().attr("data-text", response.informacionGeneral.extension);
				$("#fax").parent().next().attr("data-text", response.informacionGeneral.fax);
				$("#fines").parent().next().attr("data-text", response.informacionGeneral.fines);
				$("#mision").parent().next().attr("data-text", response.informacionGeneral.mision);
				$("#nomDepartamentoUbicacion").parent().next().attr("data-text", response.informacionGeneral.nomDepartamentoUbicacion);
				$("#nomMunicipioNacional").parent().next().attr("data-text", response.informacionGeneral.nomMunicipioNacional);
				$("#numCedulaCiudadaniaPersona").parent().next().attr("data-text", response.informacionGeneral.numCedulaCiudadaniaPersona);
				$("#objetoSocialEstatutos").parent().next().attr("data-text", response.informacionGeneral.objetoSocialEstatutos);
				$("#otros").parent().next().attr("data-text", response.informacionGeneral.otros);
				$("#portafolio").parent().next().attr("data-text", response.informacionGeneral.portafolio);
				$("#presentacionInstitucional").parent().next().attr("data-text", response.informacionGeneral.presentacionInstitucional);
				$("#principios").parent().next().attr("data-text", response.informacionGeneral.principios);
				$("#tipoEducacion").parent().next().attr("data-text", response.informacionGeneral.tipoEducacion);
				$("#tipoOrganizacion").parent().next().attr("data-text", response.informacionGeneral.tipoOrganizacion);
				$("#urlOrganizacion").parent().next().attr("data-text", response.informacionGeneral.urlOrganizacion);
				$("#vision").parent().next().attr("data-text", response.informacionGeneral.vision);
				// Archivos formulario 1.
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
				$("#archivos_informacionGeneral").append('<div class="form-group" id="documentacionLegal-observacionesGeneral' + i + '">');
				// Observaciones formulario 1
				/** Formulario 4 Archivos **/
				$("#archivosJornadasActualizacion").append('<div class="col-md-12" id="archivos_jornadasActualizacion">');
				$("#archivosJornadasActualizacion>#archivos_jornadasActualizacion").append("<p>Archivos:</p>");
				for ($a = 0; $a < data_orgFinalizada["0"].archivos.length; $a++) {
					if (data_orgFinalizada["0"].archivos[$a].id_formulario == "5") {
						if (data_orgFinalizada["0"].archivos[$a].tipo == "jornadaAct") {
							$carpeta = baseURL + "uploads/jornadas/";
						}
						$("#archivosJornadasActualizacion>#archivos_jornadasActualizacion").append(
							"<li class='listaArchivos'><a href='" + $carpeta + data_orgFinalizada["0"].archivos[$a].nombre + "' target='_blank'>" + data_orgFinalizada["0"].archivos[$a].nombre + "</a></li><br>"
						);
					}
				}
				$("#archivosJornadasActualizacion").append('</div>');
				/** Formulario 6 Docentes **/
				for (var i = 0; i < response.docentes.length; i++) {
					if (i == 0) {
						$(".txtOrgDocen").append(
							"<p>Para ver los documentos de los facilitadores haga clic <a href='" +
							baseURL +
							"panelAdmin/organizaciones/docentes#organizacion:" +
							response.organizaciones.numNIT +
							"' target='_blank'>aquí.</a> También puede ingresar al módulo de facilitadores y seleccioné la organización con el número NIT: <label>" +
							response.organizaciones.numNIT +
							"</label>.</label>"
						);
						$(".txtOrgDocen").append("<p id='cantidadDocentesOrg'>Número de facilitadores: " + response.docentes.length + "</p>");
						console.log(response.organizaciones.numNIT);
						$("#frameDocentes").attr("src", baseURL + "panelAdmin/organizaciones/solodocentes#organizacion:" + response.organizaciones.numNIT);
						setTimeout(function () {
							document.getElementById("frameDocentes").contentDocument.location.reload(true);
						}, 2000);
						//$("#docentes").append('<div class="form-group" id="docentes-observacionesGeneral0">');
						//$("#docentes>#docentes-observacionesGeneral0").append("<p>Observaciones de los docentes en general:</label>");
						//$("#docentes>#docentes-observacionesGeneral0").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de los docentes en general' data-text='Observaciones de los docentes en general' data-type='docentes' id='obs-docen-gen-0' rows='3'></textarea>");
						$("#docentes").append("</div>");
					}
				}
			},
			error: function (ev) {
				//Do nothing
			},
		});
	}

	else {
		redirect(baseURL + "panelAdmin/organizaciones/inscritas");
	}
}
/**
 * Terminar proceso de observación
 * */
$(document).on("click", "#terminar_proceso_observacion", function () {
	let msg = '¿Está seguro de terminar el proceso de observación de la solicitud <strong>' + data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'] + '</strong>?. ' +
			'<br><br>Esto cambiará el estado de la solicitud y ahora pasará a la bandeja de <strong>complementaria</strong>.' +
			'<br><br>Se enviará un correo a la organización.';
	Alert.fire({
		title: 'Enviar observaciones',
		html: msg,
		text: msg,
		icon: 'info',
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
				id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
				idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
			}
			$("#terminar_proceso_observacion").attr("disabled", true);
			$.ajax({
				url: baseURL + "observaciones/cambiarEstadoSolicitud",
				type: "post",
				dataType: "JSON",
				data: data,
				beforeSend: function () {
					procesando('info', 'Enviando observaciones');
				},
				success: function (response) {
					Alert.fire({
						title: response.title,
						html: response.msg,
						text: response.msg,
						icon: response.status,
					}).then((result) => {
						if (result.isConfirmed) {
							setInterval(function () {
								reload();
							}, 2000);
						}
					});
				},
				error: function (ev) {
					//Do nothing
				},
			});
		}
	})
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
/**
 * Observaciones Formularios
 */
 /**
  * Formulario 1*/
$(".guardarObservacionesForm1").click(function (){
	let data = {
		observacion: $("#observacionesForm1").val(),
		id_formulario: 1,
		formulario: "Observaciones Información General",
		valueForm: "datosInformacionGeneral",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm1").val('');

});
/**
 * Formulario 2*/
$(".guardarObservacionesForm2").click(function (){
	let data = {
		observacion: $("#observacionesForm2").val(),
		id_formulario: 2,
		formulario: "Documentación Legal",
		valueForm: "datosDocumentacionLegal",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm2").val('');
});
/** Formulario 3
$(".guardarObservacionesForm3").click(function (){
	let data = {
		observacion: $("#observacionesForm3").val(),
		id_formulario: 3,
		formulario: "Observaciones Antecedentes Académicos",
		valueForm: "datosAntecedentesAcademicos",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm3").val('');
});
 */
/**
 * Formulario 3*/
$(".guardarObservacionesForm3").click(function (){
	let data = {
		observacion: $("#observacionesForm3").val(),
		id_formulario: 3,
		formulario: "Jornadas de Actualización",
		valueForm: "datosJornadasActualizacion",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm3").val('');
});
/**
 * Formulario 4*/
$(".guardarObservacionesForm4").click(function (){
	let data = {
		observacion: $("#observacionesForm4").val(),
		id_formulario: 4,
		formulario: "Observaciones Programas Básicos",
		valueForm: "datosProgramasBasicos",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm4").val('');
});
/**
 * Formulario 6*/
$(".guardarObservacionesForm6").click(function (){
	let data = {
		observacion: $("#observacionesForm6").val(),
		id_formulario: 6,
		formulario: "Observaciones Plataforma Virtual",
		valueForm: "datosPlataformaVirtual",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm6").val('');
});
/**
 * Formulario 7*/
$(".guardarObservacionesForm7").click(function (){
	let data = {
		observacion: $("#observacionesForm7").val(),
		id_formulario: 7,
		formulario: "Observaciones Modalidad En Linea",
		valueForm: "datosEnLinea",
		idSolicitud:  $("#id_org_ver_form").attr("data-solicitud"),
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
	$("#observacionesForm7").val('');
});
// Acción validar archivo
// Acción validar observación
$(document).on('click', '.revisarArchivo', function (){
	if($(this).is(':checked')) {
		let data = {
			idArchivo: $(this).attr("data-id"),
			activo: 0
		};
		let text = "¿Desea marcar como revisado el documento? <br><br> Una vez se recargue la pagína y/o se finalice el proceso de observaciones, esta acción no podrá ser revertida y el documento no podrá ser modificado ni eliminado del sistema."
		Alert.fire({
			title: 'Revisar documento',
			text: text,
			html: text,
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: baseURL + "Archivos/revisarArchivo",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						procesando('info', 'Cambiando estado al archivo');
					},
					success: function (response) {
						procesando(response.status, response.msg)
					},
					error: function (ev) {
						errorControlador(ev);
						$(this).prop('checked', false);
					},
				});
			}
			else{
				$(this).prop('checked', false);
			}
		});
	}
	else {
		let data = {
			idArchivo: $(this).attr("data-id"),
			activo: 1
		};
		$.ajax({
			url: baseURL + "Archivos/revisarArchivo",
			type: "post",
			dataType: "JSON",
			data: data,
		});
	}
})
// Acción validar observación
$(document).on('click', '.validarObservacion', function (){
	if($(this).is(':checked')) {
		let data = {
			idObservacion: $(this).attr("data-id"),
			idForm: $(this).attr("data-idform"),
			valida: 1
		};
		Alert.fire({
			title: 'Aprobar Observación',
			text: '¿Desea aprobar la observación? Si esta casilla esta marcada la observación no se visualizara para la organización',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Si',
			cancelButtonText: 'No',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: baseURL + "Observaciones/validarObservacion",
					type: "post",
					dataType: "JSON",
					data: data,
					beforeSend: function () {
						procesando('info', 'validando');
					},
					success: function (response) {
						procesando(response.status, response.msg)
						verObservaciones(data['idForm']);
					},
					error: function (ev) {
						errorControlador(ev);
					},
				});
			}
			else{
				$(this).prop('checked', false);
			}
		});
	}
	else {
		let data = {
			idObservacion: $(this).attr("data-id"),
			idForm: $(this).attr("data-idform"),
			valida: 0
		};
		$.ajax({
			url: baseURL + "Observaciones/validarObservacion",
			type: "post",
			dataType: "JSON",
			data: data,
		});
	}
})
/**
 * Eliminar observación
 * @param data
 */
$(document).on("click", ".eliminarObservacionForm", function () {
	let data = {
		idObservacion: $(this).attr("data-id")
	}
	eliminarObservacion(data);
});
function eliminarObservacion(data){
	event.preventDefault();
	$.ajax({
		url: baseURL + "observaciones/eliminarObservacion",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			$(this).attr("disabled", true);
			procesando('warning', 'Eliminando')
		},
		success: function (response) {
			alertaGuardarObservacionFormulario(response.msg, response.status)
		},
		error: function (ev) {
			notificacion("Ocurrió un error no se eliminio.");
			console.log(ev);
			event.preventDefault();
		},
	});
}
/**
 * Eliminar datos tabla
 */
$(document).on("click", ".eliminarDataTabla", function () {
	$(this).parent().parent().hide();
});
/**
 * Guardar observación
 * @param data
 */
function guardarObservacion(data) {
	$.ajax({
		url: baseURL + "Observaciones/create",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			procesando('info', 'Guardando');
		},
		success: function (response) {
			alertaGuardarObservacionFormulario(response.msg, response.status, data.id_formulario)
		},
		error: function (ev) {
			notificacion("Ocurrió un error no se guardo.");
		},
	});
}
/**
 * Ver Observaciones */
// Ver historial evaluador
$(".verHistObs").click(function () {
	$id_organizacion = $(this).attr("data-id-org");
	let $formulario = '';
	data = {
		id_organizacion: $id_organizacion,
	};
	$.ajax({
		url: baseURL + "admin/cargarObservaciones",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#tbody_hist_obs").empty();
			for (var i = 0; i < response.observaciones.length; i++) {
				switch (response.observaciones[i].valueForm) {
					case "datosInformacionGeneral":
						$formulario = "Formulario 1. Información general";
						break;
					case "documentacionLegal":
						$formulario = "Formulario 2. Documentacion legal";
						break;
					case "registroEducativo":
						$formulario = "Formulario 3. Registro educativo";
						break;
					case "antecedentesAcademicos":
						$formulario = "Formulario 4. Antecedentes academicos";
						break;
					case "jornadasActualizacion":
						$formulario = "Formulario 5. Jornadas actualización";
						break;
					case "datosBasicosProgramas":
						$formulario =
							"Formulario 6. Programa básico de economía solidaria";
						break;
					case "programasAvalEconomia":
						$formulario =
							"Formulario 7. Prog. de Economía Solidaria con Énfasis en Trabajo Asociado";
						break;
					case "programasAvalar":
						$formulario = "Formulario 8. Programas";
						break;
					case "docentes":
						$formulario = "Formulario 9. Facilitadores";
						break;
					case "datosPlataformaVirtual":
						$formulario = "Formulario 10. Plataforma";
						break;
				}
				$("#tbody_hist_obs").append("<tr id=" + i + " class='obsCampo' data-search-term='" + response.observaciones[i].keyForm.toLowerCase() + "'>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + $formulario + "</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + response.observaciones[i].keyForm + "</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td class='obsCopy'>" + response.observaciones[i].observacion + "</td>");
				//$("#tbody_hist_obs>tr#"+i+"").append("<td>"+response.observaciones[i].observacion+"</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + response.observaciones[i].fechaObservacion + "</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + response.observaciones[i].numeroRevision + "</td>");
				//$("#tbody_hist_obs>tr#"+i+"").append("<td>"+response.observaciones[i].idSolicitud+"</td>");
				$("#tbody_hist_obs").append("</tr>");
			}
			$("#tbody_hist_obsPlataforma").empty();
			for (var i = 0; i < response.archivosPlataforma.length; i++) {
				$("#tbody_hist_obsPlataforma").append("<tr id=" + i + ">");
				$("#tbody_hist_obsPlataforma").append(
					"<a target='_blank' href=" +
					response.archivosPlataforma[i].nombre +
					"../../../uploads/observacionesPlataforma>Archivo de observaciones <i class='fa fa-eye' aria-hidden='true'></i></a><br/>"
				);
				$("#tbody_hist_obsPlataforma").append("</tr>");
			}
			paging("tabla_historial_obs");
			paging("tabla_historial_obsPlataforma");
			$("#verObsFiltrada").attr("href", baseURL + "admin/cargarObservacionesExportar/organizacion:" + $id_organizacion);
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
// Ver Historial Usuario
$(".verHistObsUs").click(function () {
	let $id_organizacion = $(this).attr("data-id-org");
	let $formulario = '';
	data = {
		id_organizacion: $id_organizacion,
	};
	$.ajax({
		url: baseURL + "panel/cargarObservacionesUsuario",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			console.log(response);
			$("#tbody_hist_obs").empty();
			for (var i = 0; i < response.observaciones.length; i++) {
				switch (response.observaciones[i].valueForm) {
					case "datosInformacionGeneral":
						$formulario = "Formulario 1. Informacion general";
						break;
					case "datosDocumentacionLegal":
						$formulario = "Formulario 2. Documentacion legal";
						break;
					case "datosAntecedentesAcademicos":
						$formulario = "Formulario 3. Antecedentes academicos";
						break;
					case "datosJornadasActualizacion":
						$formulario = "Formulario 4. Jornadas actualización";
						break;
					case "datosProgramasBasicos":
						$formulario = "Formulario 5. ProgramaS Economía Solidaria";
						break;
					case "docentes":
						$formulario = "Formulario 6. Facilitadores";
						break;
					case "datosPlataformaVirtual":
						$formulario = "Formulario 7. Datos modalidad virtual";
						break;
					case "datosEnLinea":
						$formulario = "Formulario 8. Datos modalidad en linea";
						break;
				}
				$("#tbody_hist_obs").append("<tr id=" + i + ">");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + $formulario + "</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + response.observaciones[i].keyForm + "</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + response.observaciones[i].observacion + "</td>");
				//$("#tbody_hist_obs>tr#"+i+"").append("<td>"+response.observaciones[i].observacion+"</td>");
				$("#tbody_hist_obs>tr#" + i + "").append("<td>" + response.observaciones[i].fechaObservacion + "</td>");
				$("#tbody_hist_obs>tr#" + i + "").append(
					"<td>" + response.observaciones[i].numeroRevision + "</td>"
				);
				//$("#tbody_hist_obs>tr#"+i+"").append("<td>"+response.observaciones[i].idSolicitud+"</td>");
				$("#tbody_hist_obs").append("</tr>");
			}
			paging("tabla_historial_obs");
		},
		error: function (ev) {
			//Do nothing
		},
	});
});
/**
 * Actualizar Solicitud */
$("#actualizar_solicitud").click(function () {
	let idSolicitud = $(this).attr("data-solicitud");
	window.open(baseURL + "solicitudes/solicitud/" + idSolicitud, '_self');
});
function alertaGuardarObservacionFormulario(msg, status, form){
	Toast.fire({
		icon: status,
		text: msg
	});
	verObservaciones(form);
}
function procesando(status, msg){
	Toast.fire({
		icon: status,
		text: msg
	});
}
// Error 505
function errorControlador(ev){
	Alert.fire({
		title: ev.statusText,
		html: ev.responseText,
		text: ev.responseText,
		icon: 'error',
		allowOutsideClick: false,
		customClass: {
			popup: 'popup-swalert-list',
			confirmButton: 'button-swalert',
		},
	})
}
