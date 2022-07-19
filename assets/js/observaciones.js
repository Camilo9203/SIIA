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
/** Formulario 1 Tablas **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 1,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos en línea registrados
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			$(".tabla_observaciones_form1").html(html);

		}
	});
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
/** Formulario 2 Tablas **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 2,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos documentación legal
			let tipo = response.documentacion['tipo'];
			if (tipo == 1){
				html = "";
				html += "<tr><td>La organización registro Cámara de Comercio </td>";
				$(".head_tabla_datos_documentacion_legal").html(html);
				html = "";
				html += "<td>La organización registro Cámara de Comercio </td></tr>";
				$(".tabla_datos_documentacion_legal").html(html);
			}
			if (tipo == 2){
				html = "";
				html +=	"<tr><td colspan='5'>Certificado de existencia y representación legal</td></tr>"
				html +=	"<tr><td>Entidad</td>"
				html +=	"<td>Fecha Expedición</td>"
				html +=	"<td>Departamento</td>"
				html +=	"<td>Municipio</td>"
				html +=	"<td>Documento</td></tr>"
				$(".head_tabla_datos_documentacion_legal").html(html);
				html = "";
				html += "<tr><td>" + response.certificadoExistencia['entidad'] + "</td>";
				html += "<td>" + response.certificadoExistencia['fechaExpedicion'] + "</td>";
				html += "<td>" + response.certificadoExistencia['departamento'] + "</td>";
				html += "<td>" + response.certificadoExistencia['municipio'] + "</td>";
				html += "<td><button class='btn btn-success btn-sm' id='verDocCertificadoExperiencia' data-id=" + response.certificadoExistencia['id_certificadoExistencia'] + ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				console.log(response.certificadoExistencia);
				$(".tabla_datos_documentacion_legal").html(html);
			}
			if (tipo == 3){
				html = "";
				html +=	"<tr><td colspan='7'>Registro Educativo</td></tr>"
				html +=	"<tr><td>Entidad</td>"
				html +=	"<td>Fecha Expedición</td>"
				html +=	"<td>Nombre Programa</td>"
				html +=	"<td>Numero Resolución</td>"
				html +=	"<td>Objeto</td>"
				html +=	"<td>Tipo Educación</td>"
				html +=	"<td>Documento</td></tr>"
				$(".head_tabla_datos_documentacion_legal").html(html);
				html = "";
				html += "<tr><td>" + response.registroEducativoProgramas['entidadResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['fechaResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['nombrePrograma'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['numeroResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['objetoResolucion'] + "</td>";
				html += "<td>" + response.registroEducativoProgramas['tipoEducacion'] + "</td>";
				html += "<td><button class='btn btn-success btn-sm' id='verDocRegistroEducativo' data-id=" + response.registroEducativoProgramas['id_registroEducativoPro'] + ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				console.log(response.registroEducativoProgramas);
				$(".tabla_datos_documentacion_legal").html(html);
			}
			html = "";
			// Llenar tabla de datos documentación legal
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			$(".tabla_observaciones_form2").html(html);

		}
	});
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
	/** Formulario 3 Tablas **/
	let html = "";
	let data = {
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 3,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
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
			console.log(response.observaciones);
			$(".tabla_datos_antecedentes").html(html);
			html = "";
			// Llenar tabla de datos en línea registrados
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			$(".tabla_observaciones_form3").html(html);

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
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 4,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos antecedentes académicos
			if(response.jornadasActualizacion.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.jornadasActualizacion.length; i++) {
					html += "<tr><td>" + response.jornadasActualizacion[i]['numeroPersonas'] + "</td>";
					html += "<td>" + response.jornadasActualizacion[i]['fechaAsistencia'] + "</td>";
				}
			}
			$(".tabla_datos_jornadas").html(html);
			html = "";
			// Llenar tabla de datos en línea registrados
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			$(".tabla_observaciones_form4").html(html);

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
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 5,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
		type: "post",
		dataType: "JSON",
		data: data,
		success: function (response) {
			// Llenar tabla de datos en línea registrados
			if(response.datosProgramas.length == 0){
				alert("1");
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.datosProgramas.length; i++) {
					html += "<tr><td>" + response.datosProgramas[i]['nombrePrograma'] + "</td>";
					html += "<td>" + response.datosProgramas[i]['aceptarPrograma'] + "</td>";
					html += "<td>" + response.datosProgramas[i]['fecha'] + "</td>";
				}
			}
			$(".tabla_registro_programas").html(html);
			html = "";
			// Llenar tabla de datos en línea registrados
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			$(".tabla_observaciones_form5").html(html);
			// Mostrar check
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
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 7,
	}
	// Consultar datos por ajax
	$.ajax({
		url: baseURL + "admin/cargar_todaInformacion",
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
					html += "<tr><td><a href='http://" + response.plataforma[i]['urlAplicacion'] + "' target='_blank'>" +response.plataforma[i]['urlAplicacion'] + "</a></td>";
					html += "<td>" + response.plataforma[i]['usuarioAplicacion'] + "</td>";
					html += "<td>" + response.plataforma[i]['contrasenaAplicacion'] + "</td>";
				}
			}
			console.log(response.observaciones);
			$(".tabla_datos_plataforma").html(html);
			html = "";
			// Llenar tabla de datos en línea registrados
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm7' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar</button></td></tr>";
				}
			}
			$(".tabla_observaciones_form7").html(html);

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
		id_organizacion: data_orgFinalizada["0"].organizaciones['0']['id_organizacion'],
		idSolicitud: data_orgFinalizada["0"].tipoSolicitud['0']['idSolicitud'],
		keyForm: 8,
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
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.enLinea.length; i++) {
					html += "<tr><td>" + response.enLinea[i]['nombreHerramienta'] + "</td>";
					html += "<td>" + response.enLinea[i]['descripcionHerramienta'] + "</td>";
					html += "<td>" + response.enLinea[i]['fecha'] + "</td>";
				}
			}
			console.log(response.observaciones);
			$(".datos_herramientas").html(html);
			html = "";
			// Llenar tabla de datos en línea registrados
			if(response.observaciones.length == 0){
				html += "<td colspan='4'>No hay datos </td></tr>";
			}
			else {
				for (let i = 0; i < response.observaciones.length; i++) {
					html += "<tr><td>" + response.observaciones[i]['fechaObservacion'] + "</td>";
					html += "<td>" + response.observaciones[i]['numeroRevision'] + "</td>";
					html += "<td>" + response.observaciones[i]['observacion'] + "</td>";
					html += "<td><button class='btn btn-danger btn-sm eliminarDataTabla' id='eliminarObservacionForm8' data-id=" + response.observaciones[i]['id_observacion'] + ">Eliminar <i class='fa fa-thras-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			$(".datos_observacion_form8").html(html);

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
		idSolicitud: $(this).attr("data-solicitud")
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
				$("#revFechaFin").html(response.estadoOrganizaciones[i].fechaFinalizado);
				$("#revSol").html(response.solicitudes[i].numeroRevisiones);
				$("#revFechaSol").html(response.solicitudes[i].fechaUltimaRevision);
				$("#estOrg").html(response.estadoOrganizaciones[i].nombre);
				$("#camaraComercio_org").attr("href", baseURL + "uploads/camaraComercio/" + response.organizaciones[i].camaraComercio);
				$("#nOrgSol").html(response.organizaciones[i].nombreOrganizacion);
				$("#sOrgSol").html(response.organizaciones[i].sigla);
				$("#nitOrgSol").html(response.organizaciones[i].numNIT);
				$("#nrOrgSol").html(response.organizaciones[i].primerNombreRepLegal + " " + response.organizaciones[i].primerApellidoRepLegal);
				$("#cOrgSol").html(response.organizaciones[i].direccionCorreoElectronicoOrganizacion);
			}
			/** Formulario 1 **/
			for (var i = 0; i < response.informacionGeneral.length; i++) {
				$("#actuacionOrganizacion").html(response.informacionGeneral[i].actuacionOrganizacion);
				$("#direccionOrganizacion").html(response.informacionGeneral[i].direccionOrganizacion);
				$("#extension").html(response.informacionGeneral[i].extension);
				$("#fax").html(response.informacionGeneral[i].fax);
				$("#fines").html(response.informacionGeneral[i].fines);
				$("#mision").html(response.informacionGeneral[i].mision);
				$("#nomDepartamentoUbicacion").html(response.informacionGeneral[i].nomDepartamentoUbicacion);
				$("#nomMunicipioNacional").html(response.informacionGeneral[i].nomMunicipioNacional);
				$("#numCedulaCiudadaniaPersona").html(response.informacionGeneral[i].numCedulaCiudadaniaPersona);
				$("#objetoSocialEstatutos").html(response.informacionGeneral[i].objetoSocialEstatutos);
				$("#otros").html(response.informacionGeneral[i].otros);
				$("#portafolio").html(response.informacionGeneral[i].portafolio);
				$("#presentacionInstitucional").html(response.informacionGeneral[i].presentacionInstitucional);
				$("#principios").html(response.informacionGeneral[i].principios);
				$("#tipoEducacion").html(response.informacionGeneral[i].tipoEducacion);
				$("#tipoOrganizacion").html(response.informacionGeneral[i].tipoOrganizacion);
				$("#urlOrganizacion").html(response.informacionGeneral[i].urlOrganizacion);
				$("#vision").html(response.informacionGeneral[i].vision);
				$("#actuacionOrganizacion").parent().next().attr(response.informacionGeneral[i].actuacionOrganizacion);
				$("#direccionOrganizacion").parent().next().attr("data-text", response.informacionGeneral[i].direccionOrganizacion);
				$("#extension").parent().next().attr("data-text", response.informacionGeneral[i].extension);
				$("#fax").parent().next().attr("data-text", response.informacionGeneral[i].fax);
				$("#fines").parent().next().attr("data-text", response.informacionGeneral[i].fines);
				$("#mision").parent().next().attr("data-text", response.informacionGeneral[i].mision);
				$("#nomDepartamentoUbicacion").parent().next().attr("data-text", response.informacionGeneral[i].nomDepartamentoUbicacion);
				$("#nomMunicipioNacional").parent().next().attr("data-text", response.informacionGeneral[i].nomMunicipioNacional);
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
			}
			/** Formulario 3 **/

			/** Formulario 4 Archivos **/
			for (var i = 0; i < response.jornadasActualizacion.length; i++) {
				if (response.jornadasActualizacion[i].numeroPersonas != 0) {
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
				}
			}
			/** Formulario 6 **/
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
/** Observaciones Formularios */
/** Formulario 1*/
$(".guardarObservacionesForm1").click(function (){
	let data = {
		observacion: $("#observacionesForm1").val(),
		id_formulario: 1,
		formulario: "Observaciones Información General",
		valueForm: "datosInformacionGeneral",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
/** Formulario 2*/
$(".guardarObservacionesForm2").click(function (){
	let data = {
		observacion: $("#observacionesForm2").val(),
		id_formulario: 2,
		formulario: "Documentación Legal",
		valueForm: "datosDocumentacionLegal",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
/** Formulario 3*/
$(".guardarObservacionesForm3").click(function (){
	let data = {
		observacion: $("#observacionesForm8").val(),
		id_formulario: 3,
		formulario: "Observaciones Antecedentes Académicos",
		valueForm: "datosAntecedentesAcademicos",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
/** Formulario 4*/
$(".guardarObservacionesForm4").click(function (){
	let data = {
		observacion: $("#observacionesForm8").val(),
		id_formulario: 4,
		formulario: "Jornadas de Actualización",
		valueForm: "datosJornadasActualizacion",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
/** Formulario 5*/
$(".guardarObservacionesForm5").click(function (){
	let data = {
		observacion: $("#observacionesForm5").val(),
		id_formulario: 5,
		formulario: "Observaciones Programas Básicos",
		valueForm: "datosProgramasBasicos",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
/** Formulario 7*/
$(".guardarObservacionesForm7").click(function (){
	let data = {
		observacion: $("#observacionesForm8").val(),
		id_formulario: 7,
		formulario: "Observaciones Plataforma Virtual",
		valueForm: "datosPlataformaVirtual",
		id: $("#id_org_ver_form").attr("data-id"),
	}
	guardarObservacion(data);
});
/** Formulario 8*/
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
	event.preventDefault();
	$.ajax({
		url: baseURL + "admin/guardarObservacion",
		type: "post",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			$(this).attr("disabled", true);
			notificacion("Espere...", "success");
		},
		success: function (response) {
			event.preventDefault();
			notificacion(response.msg, "success");
		},
		error: function (ev) {
			notificacion("Ocurrio un error no se guardo.");
			console.log(ev);
			event.preventDefault();
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

