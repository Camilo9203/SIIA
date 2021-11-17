<div class="container">
	<div class="clearfix"></div>
	<hr/>
	<h4>Tipos de Curso para Informes de Actividades:</h4>
	<div class="form-group">
		<label>Nombre del nuevo curso:</label>
		<input type="text" id="nuevoNombreTipoCurso" class="form-control" placeholder="Nombre del curso...">
	</div>
	<button class="btn btn-siia btn-sm pull-right" id="crearTipoCurso">Crear nuevo cursos <i class="fa fa-check" aria-hidden="true"></i></button>
	<div class="clearfix"></div>
	<hr/>
	<div id="tipoCursoInforme">
		<h4>Lista de los cursos Actuales:</h4>
		<?php
			echo "<div id='numero_tiposCurso' class='hidden' data-num-cursos='".sizeof($tiposCursoInformes)."'></div>";
			foreach ($tiposCursoInformes as $curso) {
				echo "<i class='fa fa-times pull-right eliminarCursoInforme' data-id='$curso->id_tiposCursoInformes'></i><input type='text' id='nombretipocurso_$curso->id_tiposCursoInformes' data-id='$curso->id_tiposCursoInformes' class='form-control' value='$curso->nombre'>";
				echo "<hr/>";
			}
			echo "<button class='btn btn-siia btn-sm actualizar_tipocurso pull-right'>Actualizar Cursos <i class='fa fa-check' aria-hidden='true'></i></button>";
		?>
	</div>
	<div class="clearfix"></div>
	<a href="<?php echo base_url('panelAdmin/opciones'); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>
