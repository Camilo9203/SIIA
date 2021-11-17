<div class="container">
	<div class="clearfix"></div>
	<hr/>
	<h4>Nit de organizaciones ya acreditadas</h4>
	<p>Se deben escribir los nits de las organizaciones que ya estan acreditadas para cuando hagan el registro quede con estado "Acreditado".</p>
	<div class="col-md-12">
		<div class="form-group">
			<label>Nit:</label>
			<input type="text" class="form-control" name="" id="nit_acre_org">
		</div>
		<div class="form-group">
			<label>Nombre de la organización:</label>
			<input type="text" class="form-control" name="" id="nombre_acre_org">
		</div>
		<div class="form-group">
			<label>Número de la resolución:</label>
			<input type="text" class="form-control" name="" id="res_acre_org">
		</div>
		<div class="form-group">
			<label>Finalización de la acreditación:</label>
			<input type="date" class="form-control" name="" id="fech_fin_acre_org">
		</div>
		<button class="btn btn-siia btn-sm pull-right" id="guardar_nit_org_acre">Guardar <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
	<div class="clearfix"></div>
	<h4>Lista de NIT de organizaciones acreditadas</h4>
	<table id="tabla_actividad" width="100%" border=0 class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Número NIT</td>
				<td>Nombre de la Organzación</td>
				<td>Número de la Resolución</td>
				<td>Fecha de finalización</td>
				<td>Accion</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php 
			foreach ($nits as $nit) {
				echo "<tr><td>".$nit->numNIT."</td>";
				echo "<td>".$nit->nombreOrganizacion."</td>";
				echo "<td>".$nit->numeroResolucion."</td>";
				echo "<td>".$nit->fechaFinalizacion."</td>";
				echo "<td><button class='btn btn-danger btn-sm eliminarNitAcreOrg' data-id-nit=".$nit->idnits_db.">Eliminar</button></td></tr>";
			}
		?>
		</tbody>
	</table>
	<a href="<?php echo base_url('panelAdmin/opciones'); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>

