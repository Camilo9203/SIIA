<div class="col-md-12" id="admin_ver_finalizadas">
<div class="clearfix"></div>
<hr/>
	<h4>Cámaras de comercio:</h4>
	<br/>
	<p>Ver organizaciones que son prioritarias <a href="<?php echo base_url("recordar/recordarToCamara"); ?>" target="_blank">Ver organizaciones</a>.</p>
	<p>Buscar por el número del NIT para facilidad.</p>
	<div class="table">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-2">Nombre</td>
				<td class="col-md-2">NIT</td>
				<td class="col-md-2">Representante Legal</td>
				<td class="col-md-2">Direccion E-Mail Org</td>
				<td class="col-md-2">Direccion E-Mail Rep</td>
				<td class="col-md-2">Accion</td>
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
				echo "<td><button class='btn btn-siia btn-sm ver_adjuntar_camara' id='' data-organizacion='".$organizaciones_en_proceso[$i] ->id_organizacion."'>Ver organización <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
<div class="container">
	<div id="datos_org_camara">
		<p>Nombre de la organización: <label id="camara_nombre_org"></label></p>
		<p>NIT: <label id="camara_nit_org"></label></p>
		<p>Nombre del representante legal: <label id="camara_nombreRep_org"></label></p>
		<p>Cámara de comercio: <a target="_blank" id="ver_camara_org">Clic aquí para ver la cámara de comercio</a></p>
		<hr/>
		<label>Adjuntar Cámara de Comercio:</label>
		<input type="file" class="form-control" form="formulario_camara_comercio" name="camara" id="camara" required accept="application/pdf">
		<br>
		<button class="btn btn-danger btn-sm pull-left" id="volver_cama_org"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button>
		<button class="btn btn-siia btn-sm pull-right" name="adjuntar_camara" id="adjuntar_camara">Actualizar cámara <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
</div>