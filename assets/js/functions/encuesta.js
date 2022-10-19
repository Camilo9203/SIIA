let encuestas;
$.ajax({
	url: baseURL + "Encuesta/cargar",
	type: "GET",
	success: function (response) {
		encuestas = JSON.parse(response);
	},
});
const ToastEncuesta = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 3000,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})
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
			ToastEncuesta.fire({
				icon: 'success',
				title: 'Un momento. Enviando...'
			});
		},
		success: function (response) {
			if(response.estado === 1) {
				Swal.fire({
					title: 'Encuesta enviada!',
					text: response.msg,
					icon: 'success',
					confirmButtonText: 'Finalizar',
				});
			} else if (response.estado === 2){
				Swal.fire({
					title: 'Encuesta enviada!',
					text: response.msg,
					icon: 'warning',
					confirmButtonText: 'Finalizar',
				});
			} else {
				Swal.fire({
					title: 'Encuesta no enviada!',
					text: response.msg,
					icon: 'error',
					confirmButtonText: 'Finalizar',
				});
			}

		},
		error: function (response){
			Swal.fire({
				title: 'Encuesta no enviada!',
				text: response.msg,
				icon: 'error',
				confirmButtonText: 'Finalizar',
			});
		},
	});
});

