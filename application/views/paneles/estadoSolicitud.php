<?php
/***
 * @var $solicitud
 * @var $organizacion
 * @var $observaciones
 *
 */
$CI = &get_instance();
$CI->load->model("AdministradoresModel");
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="clearfix"></div>
			<hr/>
			<!-- Titulo solicitud -->
			<h3>Observaciones:</h3>
			<p>A continuación se describen las <span class="spanRojo">observaciones</span> dadas por el evaluador en el SIIA.</p>
			<p>Encontrará una serie de tablas donde están registradas las observaciones por cada formulario. De clic en <span class="spanRojo">Actualizar Solicitud</span> para corregir los datos registrados en el SIIA.</p>
			<hr/>
			<!-- Resumen solicitud -->
			<div class="col-md-6">
				<div class="form-group">
					<h4>Fecha creación:</h4><label><?php echo $solicitud->fechaCreacion; ?></label>
				</div>
				<div class="form-group">
					<h4>Fecha finalización:</h4><label><?php echo $solicitud->fechaFinalizado; ?></label>
				</div>
				<div class="form-group">
					<h4>Estado de la organización:</h4><label><?php echo $solicitud->nombre; ?></label>
				</div>
				<div class="form-group">
					<h4>Tipo de solicitud:</h4><label><?php echo $solicitud->tipoSolicitud; ?></label>
				</div>
				<div class="form-group">
					<h4>Motivo de la solicitud:</h4><label><?php echo  $solicitud->motivoSolicitud; ?></label>
				</div>
				<button class="btn btn-danger btn-sm volver_al_panel"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
				<?php if($solicitud->nombre == "En Observaciones"){ ?>
					<button class="btn btn-siia btn-sm pull-right verHistObsUs" id="hist_org_obs" data-toggle='modal' data-id-org="<?php echo $organizacion->id_organizacion; ?>" data-target='#verHistObsUs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
				<?php } ?>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<h4>Modalidad de la solicitud:</h4><label><?php echo $solicitud->modalidadSolicitud; ?></label>
				</div>
				<div class="form-group">
					<h4>ID de la solicitud:</h4><label><?php echo  $solicitud->idSolicitud; ?></label>
				</div>
				<div class="form-group">
					<h4>Número de revisiones:</h4><label><?php echo  $solicitud->numeroRevisiones; ?></label>
				</div>
				<div class="form-group">
					<h4>Fecha de la última revision:</h4><label><?php echo $solicitud->fechaUltimaRevision; ?></label>
				</div>
				<div class="form-group">
					<h4>Asignada al evaluador:</h4><label><?php echo $solicitud->asignada; ?></label>
				</div>

			</div>
			<div class="clearfix"></div>
			<hr/>
			<?php if($solicitud->nombre == "En Observaciones"): ?>
				<?php if($observaciones): ?>
					<button class="btn btn-success btn-lg btn-block" id="actualizar_solicitud" data-solicitud="<?php echo $solicitud->idSolicitud ?>">Actualizar la solicitud: <?php echo $solicitud->idSolicitud ?> <i class="fa fa-repeat" aria-hidden="true"></i></button>
					<?php if($observaciones['formulario1']): ?>
						<div id="observacionesFormulario1">
							<h3>1. Información general: </h3>
							<table id='tabla_observaciones_form1' width='100%' border=0 class='table table-striped table-bordered'>
								<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
								</thead>
								<tbody id='tbody'>
									<?php
										foreach ($observaciones['formulario1'] as $observacion):
											echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
											echo "<td>" . $observacion->numeroRevision . "</td>";
											echo "<td>" . $observacion->keyForm . "</td>";
											echo "<td>" . $observacion->observacion . "</td>";
											echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
										endforeach;
									?>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
					<?php if($observaciones['formulario2']): ?>
						<div id="observacionesFormulario2">
							<h3>2. Documentación legal: </h3>
								<table id='tabla_observaciones_form2' width='100%' border=0 class='table table-striped table-bordered'>
									<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
									</thead>
									<tbody id='tbody'>
									<?php
									foreach ($observaciones['formulario2'] as $observacion):
										echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
										echo "<td>" . $observacion->numeroRevision . "</td>";
										echo "<td>" . $observacion->keyForm . "</td>";
										echo "<td>" . $observacion->observacion . "</td>";
										echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
									endforeach;
									?>
									</tbody>
								</table>
						</div>
					<?php endif; ?>
					<?php if($observaciones['formulario3']): ?>
						<div id="observacionesFormulario3">
							<h3>3. Jornadas de actualización: </h3>
								<table id='tabla_observaciones_form3' width='100%' border=0 class='table table-striped table-bordered'>
									<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
									</thead>
									<tbody id='tbody'>
									<?php
									foreach ($observaciones['formulario3'] as $observacion):
										echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
										echo "<td>" . $observacion->numeroRevision . "</td>";
										echo "<td>" . $observacion->keyForm . "</td>";
										echo "<td>" . $observacion->observacion . "</td>";
										echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
									endforeach;
									?>
									</tbody>
								</table>
						</div>
					<?php endif; ?>
					<?php if($observaciones['formulario4']): ?>
						<div id="observacionesFormulario4">
							<h3>4. Programas de educación:  </h3>
								<table id='tabla_observaciones_form4' width='100%' border=0 class='table table-striped table-bordered'>
									<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
									</thead>
									<tbody id='tbody'>
									<?php
									foreach ($observaciones['formulario4'] as $observacion):
										echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
										echo "<td>" . $observacion->numeroRevision . "</td>";
										echo "<td>" . $observacion->keyForm . "</td>";
										echo "<td>" . $observacion->observacion . "</td>";
										echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
									endforeach;
									?>
									</tbody>
								</table>
						</div>
					<?php endif; ?>
					<?php if($observaciones['formulario5']): ?>
						<div id="observacionesFormulario5">
							<h3>5. Equipo de facilitadores:  </h3>
								<table id='tabla_observaciones_form5' width='100%' border=0 class='table table-striped table-bordered'>
									<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
									</thead>
									<tbody id='tbody'>
									<?php
									foreach ($observaciones['formulario5'] as $observacion):
										echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
										echo "<td>" . $observacion->numeroRevision . "</td>";
										echo "<td>" . $observacion->keyForm . "</td>";
										echo "<td>" . $observacion->observacion . "</td>";
										echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
									endforeach;
									?>
									</tbody>
								</table>
						</div>
					<?php endif; ?>
					<?php if($observaciones['formulario6']): ?>
						<div id="observacionesFormulario6">
							<h3>6. Datos modalidad virtual:  </h3>
								<table id='tabla_observaciones_form6' width='100%' border=0 class='table table-striped table-bordered'>
									<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
									</thead>
									<tbody id='tbody'>
									<?php
									foreach ($observaciones['formulario6'] as $observacion):
										echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
										echo "<td>" . $observacion->numeroRevision . "</td>";
										echo "<td>" . $observacion->keyForm . "</td>";
										echo "<td>" . $observacion->observacion . "</td>";
										echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
									endforeach;
									?>
									</tbody>
								</table>
						</div>
					<?php endif; ?>
					<?php if($observaciones['formulario7']): ?>
						<div id="observacionesFormulario7">
							<h3>7. Datos modalidad en línea:  </h3>
								<table id='tabla_observaciones_form7' width='100%' border=0 class='table table-striped table-bordered'>
									<thead>
									<tr>
										<td> Fecha Observación</td>
										<td> Número de Revisión</td>
										<td> Formulario </td>
										<td> Observación</td>
										<td> Realizada por</td>
									</tr>
									</thead>
									<tbody id='tbody'>
									<?php
									foreach ($observaciones['formulario7'] as $observacion):
										echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
										echo "<td>" . $observacion->numeroRevision . "</td>";
										echo "<td>" . $observacion->keyForm . "</td>";
										echo "<td>" . $observacion->observacion . "</td>";
										echo "<td>" . $CI->AdministradoresModel->getNameComplete($observacion->realizada) . "</td></tr>";
									endforeach;
									?>
									</tbody>
								</table>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
