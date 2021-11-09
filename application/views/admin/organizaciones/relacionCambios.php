<div class="col-md-12" id="admin_ver_finalizadas">
<div class="clearfix"></div>
<hr/>
	<h4>Relacion de cambios:</h4>
	<br/>
	<div class="table">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td>Titulo</td>
                <td class="col-md-6">Descripcion</td>
                <td>Fecha</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php 
			foreach ($notificaciones as $notificacion) {
				echo "<tr><td>$notificacion->tituloNotificacion</td>";
				echo "<td>$notificacion->descripcionNotificacion</td>";
				echo "<td>$notificacion->fechaNotificacion</td></tr>";
			}	
		?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>