<div class="col-md-12" id="admin_ver_finalizadas">
<div class="clearfix"></div>
<hr/>
	<h4>Estados:</h4>
	<br/>
	<div class="table">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-2">Nombre</td>
				<td class="col-md-2">NIT</td>
				<td>Representante Legal</td>
				<td>Direccion E-Mail Org</td>
				<td>Direccion E-Mail Rep</td>
				<td>Estado actual</td>
				<td>Estado anterior</td>
				<td>Accion</td>
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
				echo "<td>".$organizaciones_en_proceso[$i] ->nombre."</td>";
				echo "<td>".$organizaciones_en_proceso[$i] ->estadoAnterior."</td>";
				echo "<td><button class='btn btn-siia btn-sm ver_estado_org' id='' data-organizacion='".$organizaciones_en_proceso[$i] ->id_organizacion."'>Ver estado <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
<div class="container" id="v_estado_org">
	<div class="clearfix"></div>
	<hr/>
	<h4>Nombre de la Organización: <label id="resolucion_nombre_org"></label></h4>
	<h4>NIT: <label id="resolucion_nit_org"></label></h4>
	<h4>Nombre del Representante Legal: <label id="resolucion_nombreRep_org"></label></h4>
	<h4>Estado Actual: <label id="estado_actual_org"></label></h4>
	<hr/>
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="estado_org" id="estado1" class="" value="Acreditado">Acreditado</label>
		</div>
	</div>
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="estado_org" id="estado2" class="" value="Archivada">Archivada</label>
		</div>
	</div>
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="estado_org" id="estado3" class="" value="Negada">Negada</label>
		</div>
	</div>
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="estado_org" id="estado4" class="" value="Revocada">Revocada</label>
		</div>
	</div>
	<button class="btn btn-danger pull-left" id="volverEst_org"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</i></button>
	<button class="btn btn-siia pull-right" id="actualizarEstadoOrganizacion">Actualizar estado <i class="fa fa-check" aria-hidden="true"></i></button>
</div>
