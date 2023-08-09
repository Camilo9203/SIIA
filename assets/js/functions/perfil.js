$('#configuracion').change(function () {
	let configuracion = $('#configuracion').val();
	switch (configuracion) {
		case '1':
			$("#datosSesion").slideUp();
			$("#certificados").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideDown();
			break;
		case '2':
			$("#datosSesion").slideUp();
			$("#certificados").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#firmaRepLegalPerfil").slideDown();
			break;
		case '3':
			$("#certificados").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#datosSesion").slideDown();
			break
		case '4':
			$("#datosSesion").slideUp();
			$("#firmaRepLegalPerfil").slideUp();
			$("#informacionBasicaPerfil").slideUp();
			$("#certificados").slideDown();
			break;
		case '5':
			break;
		default:
			notificacion("Selecciona otra opción.");
	}

});

// Acciones de botones
$("#verSolicitudesRegistradas").click(function () {

});
$("#verActividadUsuario").click(function () {

});
$("#admin_ver_inscritas_tabla").click(function () {
	$("#solicitudesOrganizacion").hide();
	$("#actividadOrganizacion").hide();
	$("#admin_panel_org_inscritas").slideDown();
	$("#datos_organizaciones_inscritas").slideUp();
});
