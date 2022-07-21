<div class="col-md-12">
	<div class="clearfix"></div>
	<hr/>
	<h3>Observaciones:</h3>
	<p>A continuación se describen las <span class="spanRojo">observaciones</span> dadas por el evaluador en el SIIA.</p>
	<p>Encontrará una serie de tablas donde están registradas las observaciones por cada formulario. De clic en <span class="spanRojo">Actualizar Solicitud</span> para corregir los datos registrados en el SIIA.</p>
	<div class="clearfix"></div>
	<hr/>
	<div class="col-md-6">
		<div class="form-group">
			<h4>Fecha creación:</h4><label><?php echo $solicitud->fecha; ?></label>
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
			<button class="btn btn-siia btn-sm pull-right verHistObsUs" id="hist_org_obs" data-toggle='modal' data-id-org="<?php echo $data_organizacion; ?>" data-target='#verHistObsUs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
		<?php } ?>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<h4>Modalidad de la solicitud:</h4><label><?php echo $solicitud->modalidadSolicitud; ?></label>
		</div>
		<div class="form-group">
			<h4>ID de la solicitud:</h4><label><?php echo  $solicitud->idSolicitudAcreditado; ?></label>
		</div>
		<div class="form-group">
			<h4>Número de revisiones:</h4><label><?php echo  $solicitud->numeroRevisiones; ?></label>
			<h4>Fecha de la última revision:</h4><label><?php echo $solicitud->fechaUltimaRevision; ?></label>
		</div>
		<?php if($solicitud->nombre == "En Observaciones"){ ?>
			<button class="btn btn-success btn-lg btn-block" id="actualizar_solicitud" data-solicitud="<?php echo $solicitud->idSolicitudAcreditado ?>">Actualizar la solicitud <i class="fa fa-repeat" aria-hidden="true"></i></button>
		<?php } ?>
	</div>
	<div class="clearfix"></div>
	<hr/>
	<?php if($solicitud->nombre == "En Observaciones"){ ?>
	<div id="obs_orgs">
		<?php 
			$opciones = array("informacionGeneral", "documentacionLegal", "registroEducativo", "antecedentesAcademicos", "jornadasActualizacion", "datosBasicosProgramas", "programasAvalEconomia", "programasAvalar", "docentes", "plataforma");
			/** Observaciones fomulario 1 */
			echo "<h3>1. Información general: </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form1' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 1){

					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			/** Observaciones formulario 2 */
			echo "<div class='clearfix'></div><hr/></div><h3>2. Documentación legal: </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form2' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 2){

					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			/** Observaciones formulario 3 */
			echo "<div class='clearfix'></div><hr/></div><h3>3. Antecedentes académicos: </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form3' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 3){
					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			/** Observaciones formulario 4 */
			echo "<div class='clearfix'></div><hr/></div><h3>4. Jornadas de actualización: </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form4' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 4){

					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			/** Observaciones formulario 5 */
			echo "<div class='clearfix'></div><hr/></div><h3>5. Programas de educación : </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form5' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 5){

					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			/** Observaciones formulario 6 */
			echo "<div class='clearfix'></div><hr/></div><h3>6. Equipo de facilitadores: </h3><div class='col-md-12'>";
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
			/** Observaciones formulario 7 */
			echo "<div class='clearfix'></div><hr/></div><h3>7. Datos modalidad virtual: </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form7' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 7){

					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			/** Observaciones formulario 8 */
			echo "<div class='clearfix'></div><hr/></div><h3>7. Datos modalidad en linea: </h3><div class='col-md-12'>";
			echo "<div class=''>";
			echo "<table id='tabla_observaciones_form8' width='100%' border=0 class='table table-striped table-bordered'>";
			echo "<thead>";
			echo "<tr><td> Fecha Observación</td>";
			echo "<td> Numero de Revisión</td>";
			echo "<td> Formulario </td>";
			echo "<td> Observación</td>";
			echo "<td> Acciones </td>";
			echo "</thead>";
			echo "<tbody id='tbody'>";
			foreach ($observaciones as $observacion) {
				if($observacion->idForm == 8){

					echo "<tr><td>" . $observacion->fechaObservacion . "</td>";
					echo "<td>" . $observacion->numeroRevision . "</td>";
					echo "<td>" . $observacion->keyForm . "</td>";
					echo "<td>" . $observacion->observacion . "</td>";
					echo "<td><button class='btn btn-info btn-sm verDetalleObservacion' data-id=" . $observacion->id_observacion . ">Detalle <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
		?>
	</div>
	<?php } ?>
</div>
