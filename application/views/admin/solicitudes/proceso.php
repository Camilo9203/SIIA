<?php
/***
 * @var $solicitudesEnProceso
 * @var Solicitudes $this
 *
 */
?>
<div class="col-md-12">
<div class="clearfix"></div>
<hr/>
	<h3>Solicitudes en proceso:</h3>
	<div class="table col-md-12">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-2">Organización</td>
				<td class="col-md-2">ID Solicitud</td>
				<td class="col-md-2">Fecha de creación</td>
				<td class="col-md-2">Tipo Solicitud</td>
				<td class="col-md-2">Motivo Solicitud</td>
				<td class="col-md-2">Estado</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php
			foreach ($solicitudesEnProceso as $solicitud):
				echo "<tr>";
				echo "<td>" . $solicitud->nombreOrganizacion . "</td>";
				echo "<td>" . $solicitud->idSolicitud . "</td>";
				echo "<td>" . $solicitud->fecha . "</td>";
				echo "<td>" . $solicitud->tipoSolicitud . "</td>";
				echo "<td>" . $solicitud->motivoSolicitud . "</td>";
				echo "<td>" . $solicitud->nombre . "</td>";
				echo "</tr>";
			endforeach;
		?>
		</tbody>
	</table>
		<button class="btn btn-danger btn-sm pull-left" id="admin_enproceso_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
