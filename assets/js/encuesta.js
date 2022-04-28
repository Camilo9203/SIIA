var url = unescape(window.location.href);
var activate = url.split("/");
var baseURL = activate[0] + "//" + activate[2] + "/" + activate[3] + "/";
var encuestas;
$.ajax({
	url: baseURL + "Encuesta/cargar",
	type: "GET",
	success: function (response) {
		encuestas = JSON.parse(response);
	},
});

$("#enviarEcuesta").click(function () {
	var data = {
		calificacion_general: $(".calificacion_general").val(),
		calificacion_evaluador: $(".calificacion_evaluador").val(),
		comentario: $("#comentario").val()
	};
	console.log(data);
	$.ajax({
		url: baseURL + "Encuesta/enviarEncuesta",
		type: "POST",
		dataType: "JSON",
		data: data,
		beforeSend: function () {
			notificacion("Un momento. Enviando...", "success");
		},
		success: function (response) {
			notificacion(response.msg, "success");
		},
		error: function (){
			//Do nothing
		},
	});
});

