<div class="container">
	<div class="clearfix"></div>
	<hr/>
	<h4>Notificaciones antiguas:</h4>
	<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td>Titulo</td>
				<td>Descripcion</td>
				<td>Fecha</td>
				<td>Quien la Envia</td>
				<td>Quien la Recibe</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php 
			foreach ($mis_notificaciones as $notificacion) {
				echo "<tr><td>$notificacion->tituloNotificacion</td>";
				echo "<td>$notificacion->descripcionNotificacion</td>";
				echo "<td>$notificacion->fechaNotificacion</td>";
				echo "<td>$notificacion->quienEnvia</td>";
				echo "<td>$notificacion->quienRecibe</td></tr>";
			}	
		?>
		</tbody>
	</table>
	<a href="<?php echo base_url('panelAdmin/opciones'); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>

