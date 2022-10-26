<div class="col-md-12" id="admin_ver_finalizadas">
	<div class="clearfix"></div>
	<hr />
	<h3>Docentes en evaluación:</h3>
	<br />
	<div class="table">
		<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td class="col-md-2">Organización</td>
					<td class="col-md-2">NIT Org</td>
					<td class="col-md-2">Cédula Docente</td>
					<td class="col-md-2">Nombre</td>
					<td class="col-md-2">Horas De Capacitación</td>
					<td class="col-md-2">Aprobado</td>
					<td class="col-md-2">Asignado</td>
					<td class="col-md-2">Observaciones</td>
					<td class="col-md-2">Acción</td>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php
				foreach ($docentes as $docente) {
					if ($docente->asignado == $nombre_usuario && $nivel == 1) {
						echo "<tr>";
						echo "<td>" . $docente->nombreOrganizacion . "</td>";
						echo "<td>" . $docente->numNIT . "</td>";
						echo "<td>" . $docente->numCedulaCiudadaniaDocente . "</td>";
						echo "<td>" . $docente->primerNombreDocente . " " . $docente->segundoNombreDocente . " " . $docente->primerApellidoDocente . " " . $docente->segundoApellidoDocente . "</td>";
						echo "<td>" . $docente->horaCapacitacion . "</td>";
						if ($docente->valido == '0') {
							echo "<td>No</td>";
						} else if ($docente->valido == '1') {
							echo "<td>Si</td>";
						}
						echo "<td>" . $docente->asignado . "</td>";
						echo "<td>" . $docente->observacion . "</td>";
						echo "<td><button class='btn btn-siia btn-sm ver_organizacion_docentes' data-organizacion='" . $docente->id_organizacion . "'>Ver facilitador <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
						echo "</tr>";
					} else if ($nivel == 0 || $nivel == 6) {
						if ($docente->asignado != "No" && $docente->asignado != NULL) {
							echo "<tr>";
							echo "<td>" . $docente->nombreOrganizacion . "</td>";
							echo "<td>" . $docente->numNIT . "</td>";
							echo "<td>" . $docente->numCedulaCiudadaniaDocente . "</td>";
							echo "<td>" . $docente->primerNombreDocente . " " . $docente->segundoNombreDocente . " " . $docente->primerApellidoDocente . " " . $docente->segundoApellidoDocente . "</td>";
							echo "<td>" . $docente->horaCapacitacion . "</td>";
							if ($docente->valido == '0') {
								echo "<td>No</td>";
							} else if ($docente->valido == '1') {
								echo "<td>Si</td>";
							}
							echo "<td>" . $docente->asignado . "</td>";
							echo "<td>" . $docente->observacion . "</td>";
							echo "<td><button class='btn btn-siia btn-sm ver_organizacion_docentes' data-organizacion='" . $docente->id_organizacion . "'>Ver facilitador <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
							echo "</tr>";
						}
					}
				}
				?>
			</tbody>
		</table></div>
	<!-- Iframe Docentes -->
	<div id="docentes_organizaciones">
		<hr />
		<table id="tabla_historial_obs" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td>Nombre</td>
					<td>Cédula</td>
					<td>Profesión</td>
					<td>Horas</td>
					<td>Aprobado</td>
					<td>Acción</td>
				</tr>
			</thead>
			<tbody id="tbody_orgDocentes">
			</tbody>
		</table>
		<div class="col-md-12" id="informacion_docentes">
			<h4>Docente #<label id="id_docente"></label>:</h4>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Primer Nombre:</label>
					<p id="primer_nombre_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Segundo Nombre:</label>
					<p id="segundo_nombre_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Primer Apellido:</label>
					<p id="primer_apellido_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Segundo Apellido:</label>
					<p id="segundo_apellido_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Número de Cédula:</label>
					<p id="numero_cedula_docente"></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Profesión:</label>
					<p id="profesion_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Horas de Capacitación:</label>
					<p id="horas_cap_docente"></p>
				</div>
				<div class="form-group">
					<label for="">¿Aprobado?:</label>
					<p class="text-center" id="valido_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Observación actual:</label>
					<p id="obs_val_docente"></p>
				</div>
				<div class="form-group">
					<label for="">Observación anterior:</label>
					<p id="obs_valAnt_docente"></p>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr />
			<div class="col-md-12">
				<label>Documentos:</label>
				<table id="tabla_archivos_formulario" width="100%" border=0 class="table table-striped table-bordered tabla_form">
					<thead>
						<tr>
							<td class="col-md-4">Nombre</td>
							<td class="col-md-3">Tipo</td>
							<td class="col-md-4">Observación archivo</td>
							<td class="col-md-4">Acción</td>
						</tr>
					</thead>
					<tbody id="tbodyArchivosDocen">
					</tbody>
				</table>
				<!--<div id="documentos_docente"></div>-->
			</div>
			<div class="clearfix"></div>
			<hr />
			<div class="col-md-2">
				<label>¿El docente es aprobado?</label>
				<div class="radio">
					<label class="radio-inline"><input type="radio" name="validoDocente" class="validoDocente" value="1">Sí</label>
					<label class="radio-inline"><input type="radio" name="validoDocente" class="validoDocente" value="0" checked>No</label>
				</div>
			</div>
			<div class="col-md-10">
				<label>Observaciones si el docente no es aprobado:</label>
				<textarea id="docente_val_obs" class="form-control"></textarea><br />
				<button class="docente_ btn btn-siia btn-sm guardarValidoDocente" data-id="" disabled="true">Guardar y enviar notificación <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
			<div class="clearfix"></div>
			<hr />
			<!--<div>
				<button class="pull-left btn btn-danger btn-sm" id="anteriorDocente"><i class="fa fa-chevron-left" aria-hidden="true"></i> Anterior docente</button>
				<button class="pull-right btn btn-danger btn-sm" id="siguienteDocente">Siguiente docente <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
			</div>-->
		</div>
	</div>
	<!-- Boton volver -->
	<div class="clearfix"></div>
	<hr/>
	<button class="btn btn-danger btn-sm pull-left admin_volver_docentes"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>	
</div>
