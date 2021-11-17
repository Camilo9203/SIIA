<div id="bateriaObs" class="container">
	<div class="clearfix"></div>
	<hr/>
	<h4>Bateria de observaciones:</h4>
	<button class="btn btn-sm btn-siia pull-right" data-toggle='modal' data-target='#modalBateriaObservaciones'>Crear nueva observación <i class="fa fa-search-plus" aria-hidden="true"></i></button>
	<div class="clearfix"></div>
	<table id="tabla_bateriaObs" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td>ID</td>
				<td>Tipo</td>
				<td>Titulo</td>
				<td>Observación</td>
				<td class="col-md-2">Acción</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php 
			foreach ($bateria as $observacion) {
				echo "<tr><td>$observacion->id_bateriaObservaciones</td>";
				echo "<td>$observacion->tipo</td>";
				echo "<td>$observacion->titulo</td>";
				echo "<td>$observacion->observacion</td>";
				echo "<td><button class='btn btn-sm btn-siia editarBateriaObservacion' data-toggle='modal' data-target='#modalBateriaObservaciones' data-id='$observacion->id_bateriaObservaciones'>Editar <i class='fa fa-pencil' aria-hidden='true'></i></button> - <button class='btn btn-sm btn-danger' data-id='$observacion->id_bateriaObservaciones'>Eliminar <i class='fa fa-pencil' aria-hidden='true'></i></button></td></tr>";
			}	
		?>
		</tbody>
	</table>
	<a href="<?php echo base_url('panelAdmin/opciones'); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button></a>
</div>