<div class="col-md-12">
	<div class="clearfix"></div>
	<hr/>
	<h3>Observaciones:</h3>
	<p>A continuación se describen las <span class="spanRojo">observaciones</span> dadas por el evaluador en el SIIA.</p>
	<p>Encontrará una serie de recuadros donde están los datos de los formularios llenados dependiendo de la solicitud realizada. Debe presionar <span class="spanRojo">Actualizar Solicitud</span> para poder actualizar los datos correspondientes a las observaciones.</p>
	<div class="clearfix"></div>
	<hr/>
	<div class="col-md-6">
		<div class="form-group">
			<h4>Numero de solicitudes:</h4><label><?php echo $estadoSolicitud['numero']; ?></label>
		</div>
		<div class="form-group">
			<h4>Estado de la organización:</h4><label><?php echo $estadoSolicitud['estado']; ?></label>
		</div>
		<div class="form-group">
			<h4>Tipo de solicitud:</h4><label><?php echo $estadoSolicitud['tipoSolicitud']; ?></label>
		</div>
		<div class="form-group">
			<h4>Motivo de la solicitud:</h4><label><?php echo $estadoSolicitud['motivoSolicitud']; ?></label>
		</div>
		<button class="btn btn-danger btn-sm volver_al_panel"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		<?php if($estadoSolicitud['estado'] == "En Observaciones"){ ?>
			<button class="btn btn-siia btn-sm pull-right verHistObsUs" id="hist_org_obs" data-toggle='modal' data-id-org="<?php echo $data_organizacion; ?>" data-target='#verHistObsUs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
		<?php } ?>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<h4>Modalidad de la solicitud:</h4><label><?php echo $estadoSolicitud['modalidadSolicitud']; ?></label>
		</div>
		<div class="form-group">
			<h4>ID de la solicitud:</h4><label><?php echo $idSolicitud; ?></label>
		</div>
		<div class="form-group">
			<h4>Número de revisiones:</h4><label><?php echo $estadoSolicitud['numeroRevisiones']; ?></label>
			<h4>Fecha de la ultima revision:</h4><label><?php echo $estadoSolicitud['fechaUltimaRevision']; ?></label>
		</div>
	<button class="btn btn-success btn-lg btn-block actualizar_solicitud" disabled="true">Actualizar la solicitud <i class="fa fa-repeat" aria-hidden="true"></i></button>
	</div>
	<div class="clearfix"></div>
	<hr/>
	<div id="obs_orgs">
		<?php 
			$opciones = array("informacionGeneral", "documentacionLegal", "registroEducativo", "antecedentesAcademicos", "jornadasActualizacion", "datosBasicosProgramas", "programasAvalEconomia", "programasAvalar", "docentes", "plataforma");
			echo "<h3>1. Información general: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[0]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>2. Documentación legal: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[1]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>3. Registro educativo: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[2]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>4. Antecedentes académicos: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[3]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>5. Jornadas de actualización: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[4]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>6. Programa básico de economía solidaria : </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[5]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>7. Programa de economía solidaria con énfasis en trabajo asociado: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[6]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>8. Aval programas: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[7]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div>";
				}
			}
			echo "<div class='clearfix'></div><hr/></div><h3>9. Equipo de facilitadores: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[8]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
					echo "</div><div class='clearfix'></div><br/>";
				}
			}
			for ($i = 0; $i < 1; $i++) {
				echo "<p>Por favor, verificar las <span class='spanRojo'>observaciones generales</span> de sus facilitadores dando <a href='./docentes' target='_blank'>Clic aquí</a>, o en el módulo de facilitadores.</p>";
			}
			echo "<div class='clearfix'></div><hr/></div><h3>10. Datos plataforma: </h3><div class='col-md-12'>";
			foreach ($observaciones as $observacion) {
				if($observacion->valueForm == $opciones[9]){
					echo "<div class='c_obs_org col-md-2'>";
						echo "<p>Fecha de observación:</p><label>".$observacion->fechaObservacion."</label>";
						echo "<p>Campo del formulario:</p><label>".$observacion->keyForm."</label>";
						echo "<hr/>";
						echo "<p>Valor ingresado:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->observacion."</textarea>";
						echo "<hr/>";
						echo "<p>Observación:</p><textarea class='form-control valUsObs' rows='5' disabled>".$observacion->idForm."</textarea>";
						echo "<p>Archivos de observaciones:</p>";
						foreach ($archivosPlataforma as $archivosPlataforma) {
							echo "<a target='_blank' href=../uploads/observacionesPlataforma/".$archivosPlataforma->nombre.">Archivo de observaciones <i class='fa fa-eye' aria-hidden='true'></i></a><br/>";
						}
					echo "</div>";
				}
			}
		?>
	</div>
</div>
