<div id="actividad" class="container">
	<div class="clearfix"></div>
	<hr/>
	<h4>Registro de actividad:</h4>
	<table id="tabla_actividad_admin" width="100%" border=0 class="table table-striped table-bordered">
		<thead>
			<tr>
				<td class="col-md-3"><label>Actividad</label></td>
				<td class="col-md-3"><label>Fecha</label></td>
				<td class="col-md-3"><label>Dirección IP</label></td>
				<td class="col-md-3"><label>Explorador</label></td>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($actividad_admin as $row){	
			?>
				<tr>
				<td><?php echo $row->accion; ?></td>
				<td><?php echo $row->fecha; ?></td>
				<td><?php echo $row->usuario_ip; ?></td>
				<td><?php echo $row->user_agent; ?></td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	<a href="<?php echo base_url('panelAdmin/opciones'); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>

