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
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
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
			console.log(response);
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
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
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
			console.log(response);
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
				html += "<td><button class='btn btn-success btn-sm verDocCertificadoExistenciaEvaluador' data-form='2' data-id=" + response.certificadoExistencia['id_certificadoExistencia'] + ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td></tr>";
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
})
/** Todo: Funciones Formulario 2 */
// Ver Documento
$(".verDocCertificadoExistenciaEvaluador").click(function (){
	alert();
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
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
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
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
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
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
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
		id_organizacion: data_orgFinalizada["0"].organizaciones['id_organizacion'],
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
			$("#fechaSol").html(response.solicitudes.fecha);
			$("#idSol").html(response.solicitudes.idSolicitud);
			$("#tipoSol").html(response.estadoOrganizaciones.tipoSolicitudAcreditado);
			$("#modSol").html(response.estadoOrganizaciones.modalidadSolicitudAcreditado);
			$("#motSol").html(response.estadoOrganizaciones.motivoSolicitudAcreditado);
			$("#numeroSol").html(response.solicitudes.numeroSolicitudes);
			$("#revFechaFin").html(response.estadoOrganizaciones.fechaFinalizado);
			$("#revSol").html(response.solicitudes.numeroRevisiones);
			$("#revFechaSol").html(response.solicitudes.fechaUltimaRevision);
			$("#estOrg").html(response.estadoOrganizaciones.nombre);
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
			/** Formulario 4 Archivos **/
			for (var i = 0; i < response.jornadasActualizacion.length; i++) {
				if (response.jornadasActualizacion[i].numeroPersonas != 0) {
					$("#archivosJornadasActualizacion").append('<div class="col-md-12" id="archivos_jornadasActualizacion">');
					$("#archivosJornadasActualizacion>#archivos_jornadasActualizacion").append("<p>Archivos:</p>");
					console.log(data_orgFinalizada["0"].archivos.length);

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
			/** Formulario 6 Docentes **/
			for (var i = 0; i < response.docentes.length; i++) {
				if (i == 0) {
					$(".txtOrgDocen").append(
						"<p>Para ver los documentos de los facilitadores haga click <a href='" +
						baseURL +
						"panelAdmin/organizaciones/docentes#organizacion:" +
						response.organizaciones.numNIT +
						"' target='_blank'>aquí.</a> Tambien puede ingresar al módulo de facilitadores y seleccione la organización con el número NIT: <label>" +
						response.organizaciones.numNIT +
						"</label>.</label>"
					);
					$(".txtOrgDocen").append("<p id='cantidadDocentesOrg'>Número de facilitadores: " + response.docentes.length + "</p>");
					$("#frameDocentes").attr("src", baseURL + "panelAdmin/organizaciones/solodocentes#organizacion:" + response.organizaciones.numNIT);
					setTimeout(function () {
						document.getElementById("frameDocentes").contentDocument.location.reload(true);
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
					$("#docentes").append('<div class="form-group" id="docentes-observacionesGeneral0">');
					$("#docentes>#docentes-observacionesGeneral0").append("<p>Observaciones de los docentes en general:</label>");
					$("#docentes>#docentes-observacionesGeneral0").append("<textarea class='form-control obs_admin_' placeholder='Observación...' data-title='Observaciones de los docentes en general' data-text='Observaciones de los docentes en general' data-type='docentes' id='obs-docen-gen-0' rows='3'></textarea>");
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
						success:  functions (response) {

						},
						error: functions(ev){
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
		observacion: $("#observacionesForm3").val(),
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
		observacion: $("#observacionesForm4").val(),
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
		observacion: $("#observacionesForm7").val(),
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
/** Ver Observaciones */
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
			$("#tbody_hist_obs").empty();
			for (var i = 0; i < response.observaciones.length; i++) {
				switch (response.observaciones[i].valueForm) {
					case "informacionGeneral":
						$formulario = "Formulario 1. Informacion general";
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
					case "plataforma":
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
			$("#verObsFiltrada").attr(
				"href",
				baseURL +
				"admin/cargarObservacionesExportar/organizacion:" +
				$id_organizacion
			);
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
/** Actualizar Solicitud */
$("#actualizar_solicitud").click(function () {
	let idSolicitud = $(this).attr("data-solicitud");
	window.open(baseURL + "panel/solicitud/" + idSolicitud, '_self');
});

