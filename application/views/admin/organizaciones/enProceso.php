<div class="col-md-12">
<div class="clearfix"></div>
<hr/>
	<h3>Organizaciones en proceso:</h3>
	<div class="table col-md-12">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-2">Nombre</td>
				<td class="col-md-2">NIT</td>
				<td class="col-md-2">Representante Legal</td>
				<td class="col-md-2">Direccion E-Mail Org</td>
				<td class="col-md-2">Direccion E-Mail Rep</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php
			for ($i=0; $i < count($organizaciones_en_proceso); $i++) {
				echo "<tr>";
				echo "<td>".$organizaciones_en_proceso[$i] ->nombreOrganizacion."</td>";
				echo "<td>".$organizaciones_en_proceso[$i] ->numNIT."</td>";
				echo "<td>".$organizaciones_en_proceso[$i] ->primerNombreRepLegal." ".$organizaciones_en_proceso[$i] ->segundoNombreRepLegal." ".$organizaciones_en_proceso[$i] ->primerApellidoRepLegal." ".$organizaciones_en_proceso[$i] ->segundoApellidoRepLegal."</td>";
				echo "<td>".$organizaciones_en_proceso[$i] ->direccionCorreoElectronicoOrganizacion."</td>";
				echo "<td>".$organizaciones_en_proceso[$i] ->direccionCorreoElectronicoRepLegal."</td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
		<button class="btn btn-danger btn-sm pull-left" id="admin_enproceso_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
