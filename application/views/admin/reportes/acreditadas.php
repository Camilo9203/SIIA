<?php
/***
 * @var $organizacionesAcreditadas
 *
 */
?>
<div class="col-md-12">
	<div class="clearfix"></div>
	<hr />
	<div class="pull-right">
		<a href="<?php echo base_url(); ?>reportes/exportarExcel"  class="btn btn-siia">
			<i class="fa fa-download" aria-hidden="true"></i>
			Excel
		</a>
		<a href="<?php echo base_url(); ?>reportes/exportarDatosAbiertos"  class="btn btn-danger">
			<i class="fa fa-download" aria-hidden="true"></i>
			Datos Abiertos
		</a>
	</div>
	<h3>Organizaciones Acreditadas:</h3>
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-1">NOMBRE DE LA ORGANIZACIÓN</td>
				<td class="col-md-1">NÚMERO NIT</td>
				<td class="col-md-1">TIPO DE ORGANIZACIÓN</td>
				<td class="col-md-1">CURSOS APROBADOS</td>
				<td class="col-md-1">MODALIDAD APROBADA PARA EL CURSO</td>
				<td class="col-md-1">RESOLUCIÓN</td>
				<td class="col-md-1">FECHA DE VENCIMIENTO DE LA ACREDITACIÓN</td>
				<td class="col-md-1">DEPARTAMENTO</td>
				<td class="col-md-1">MUNICIPIO</td>
				<td class="col-md-1">DIRECCIÓN</td>
				<td class="col-md-1">TELÉFONO</td>
				<td class="col-md-1">DIRECCIÓN URL</td>
				<td class="col-md-1">CORREO ELECTRÓNICO ORGANIZACIÓN</td>
			</tr>
		</thead>
		<tbody id="tbody">
			<?php foreach ($organizacionesAcreditadas as $organizacion): ?>
				<tr>
					<td><?php echo (isset($organizacion['data_organizaciones']->nombreOrganizacion)) ? strtoupper($organizacion['data_organizaciones']->nombreOrganizacion) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones']->numNIT)) ? strtoupper($organizacion['data_organizaciones']->numNIT) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones_inf']->tipoOrganizacion)) ? strtoupper($organizacion['data_organizaciones_inf']->tipoOrganizacion) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['resoluciones']->cursoAprobado)) ? strtoupper($organizacion['resoluciones']->cursoAprobado) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['resoluciones']->modalidadAprobada)) ? strtoupper($organizacion['resoluciones']->modalidadAprobada) : strtoupper("Falta por actualizar datos...");?></td>
					<td><a href='<?php echo base_url("uploads/resoluciones/" . $organizacion['resoluciones']->resolucion) ?>' target='_blank'>RESOLUCIÓN NÚMERO " <?php echo $organizacion['resoluciones']->numeroResolucion ?>"</a></td>
<!--					<td>--><?php //echo strtoupper(date('d-m-Y', strtotime("+" . $organizacion["resoluciones"]->añosResolucion . " year", strtotime($organizacion["resoluciones"]->fechaResolucionInicial))))?><!--</td>-->
					<td><?php echo (isset($organizacion["resoluciones"]->fechaResolucionFinal)) ? strtoupper($organizacion["resoluciones"]->fechaResolucionFinal) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones_inf']->nomDepartamentoUbicacion)) ? strtoupper($organizacion['data_organizaciones_inf']->nomDepartamentoUbicacion) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones_inf']->nomMunicipioNacional)) ? strtoupper($organizacion['data_organizaciones_inf']->nomMunicipioNacional) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones_inf']->direccionOrganizacion)) ? strtoupper($organizacion['data_organizaciones_inf']->direccionOrganizacion) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones_inf']->fax)) ? strtoupper($organizacion['data_organizaciones_inf']->fax) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones_inf']->urlOrganizacion)) ? strtoupper($organizacion['data_organizaciones_inf']->urlOrganizacion) : strtoupper("Falta por actualizar datos...");?></td>
					<td><?php echo (isset($organizacion['data_organizaciones']->direccionCorreoElectronicoOrganizacion)) ? strtoupper($organizacion['data_organizaciones']->direccionCorreoElectronicoOrganizacion) : strtoupper("Falta por actualizar datos...");?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm volverReporte">Volver al panel</button>
</div>
