<div class="col-md-12">
	<!-- Tabla Solicitudes Docentes no asignados -->
	<div id="organizaciones_docentes">
		<hr />
		<h3>Docentes pendientes por ser asignados:</h3>
		<br />
		<table id="tabla_docentes_no_asignados" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td class="col-md-2">Organizacion</td>
					<td class="col-md-2">NIT Org</td>
					<td class="col-md-2">Cedula Docente</td>
					<td class="col-md-2">Nombre</td>
					<td class="col-md-2">Apellido</td>
					<td class="col-md-2">Horas de Capacitación</td>
					<td class="col-md-2">Aprobado</td>
					<td class="col-md-2">Asignado</td>
					<td class="col-md-2">Observaciones</td>
					<td class="col-md-2">Acciones</td>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php
				for ($i = 0; $i < count($docentes); $i++) {
					if ($docentes[$i]->asignado == "No") {
						echo "<tr>";
						echo "<td>" . $docentes[$i]->nombreOrganizacion . "</td>";
						echo "<td>" . $docentes[$i]->numNIT . "</td>";
						echo "<td>" . $docentes[$i]->numCedulaCiudadaniaDocente . "</td>";
						echo "<td>" . $docentes[$i]->primerNombreDocente . "</td>";
						echo "<td>" . $docentes[$i]->primerApellidoDocente . "</td>";
						echo "<td>" . $docentes[$i]->horaCapacitacion . "</td>";
						if ($docentes[$i]->valido == '0') {
							echo "<td>No</td>";
						} else if ($docentes[$i]->valido == '1') {
							echo "<td>Si</td>";
						}
						echo "<td>" . $docentes[$i]->asignado . "</td>";
						echo "<td>" . $docentes[$i]->observacion . "</td>";
						echo "<td><button class='btn btn-siia btn-sm' id='verModalAsignarDocente' data-id='" . $docentes[$i]->id_docente . "' data-docente='" . $docentes[$i]->numCedulaCiudadaniaDocente . "' data-nombre='" . $docentes[$i]->primerNombreDocente . "' data-apellido='" . $docentes[$i]->primerApellidoDocente . "' data-toggle='modal' data-target='#asignarDocente'>Asignar <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div><br />
	<!-- Tabla Solicitudes Docentes no asignados -->
	<div id="organizaciones_docentes">
		<hr />
		<h3>Docentes asignados no aprobados:</h3>
		<br />
		<table id="tabla_docentes_asignados" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td class="col-md-2">Organizacion</td>
					<td class="col-md-2">NIT Org</td>
					<td class="col-md-2">Cedula Docente</td>
					<td class="col-md-2">Nombre</td>
					<td class="col-md-2">Apellido</td>
					<td class="col-md-2">Horas de Capacitación</td>
					<td class="col-md-2">Aprobado</td>
					<td class="col-md-2">Asignado</td>
					<td class="col-md-2">Observaciones</td>
					<td class="col-md-2">Acciones</td>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php
				for ($i = 0; $i < count($docentes); $i++) {
					if ($docentes[$i]->asignado != "No" && $docentes[$i]->asignado != NULL) {
						echo "<tr>";
						echo "<td>" . $docentes[$i]->nombreOrganizacion . "</td>";
						echo "<td>" . $docentes[$i]->numNIT . "</td>";
						echo "<td>" . $docentes[$i]->numCedulaCiudadaniaDocente . "</td>";
						echo "<td>" . $docentes[$i]->primerNombreDocente . "</td>";
						echo "<td>" . $docentes[$i]->primerApellidoDocente . "</td>";
						echo "<td>" . $docentes[$i]->horaCapacitacion . "</td>";
						if ($docentes[$i]->valido == '0') {
							echo "<td>No</td>";
						} else if ($docentes[$i]->valido == '1') {
							echo "<td>Si</td>";
						}
						echo "<td>" . $docentes[$i]->asignado . "</td>";
						echo "<td>" . $docentes[$i]->observacion . "</td>";
						echo "<td><button class='btn btn-siia btn-sm' id='verModalAsignarDocente' data-id='" . $docentes[$i]->id_docente . "' data-docente='" . $docentes[$i]->numCedulaCiudadaniaDocente . "' data-nombre='" . $docentes[$i]->primerNombreDocente . "' data-apellido='" . $docentes[$i]->primerApellidoDocente . "' data-toggle='modal' data-target='#asignarDocente'>Asignar <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</div><br />
</div>
<!-- Modol Asignar Evaluador a Docente //TODO:Terminar asignación de docentes-->
<div class="modal fade" id="asignarDocente" tabindex="-1" role="dialog" aria-labelledby="ariaAsignar">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="ariaAsignar">Asignar evaluador a una organización</h3>
				<small>Pueden que existan usuario con diferente rol y tenga que comunicarse con soporte para que el super administrador pueda cambiar este rol.</small>
			</div>
			<div class="modal-body">
				<p>Seleccione de la siguiente lista los usuarios que tienen el rol de evaluadores para que pueda asignarlo a una organización y que pueda verificar la solicitud.</p>
				<hr />
				<select name="evaluadorAsignar" id="evaluadorAsignar" class="selectpicker form-control show-tick" required="">
					<?php
					foreach ($administradores as $administrador) {
						if ($administrador->nivel == 1) {
					?>
							<option id="<?php echo $administrador->id_administrador; ?>" value="<?php echo $administrador->usuario; ?>"><?php echo $administrador->primerNombreAdministrador . " " . $administrador->primerApellidoAdministrador; ?></option>
					<?php
						}
					}
					?>
				</select>
				<div class="clearfix"></div>
				<hr />
				<p>ID Docente:</p><label id="idDocente"></label>
				<p>Cedula del docente:</p><label id="cedulaDocente"></label>
				<p>Nombre del docenete:</p><label id="nombreDocente"></label>
				<!-- <p>Número NIT:</p><label id="nitAsigOrg"></label> -->
				<hr />
				<p>Luego haber seleccionado al usuario, puede dar clic en asignar para que se haga lo siguiente:</p>
				<ul>
					<li>Se le enviara un correo a la persona con la información de la organización.</li>
					<li>Solamente esa persona podrá acceder a ver la solicitud de la organización.</li>
				</ul>
				<div class="clearfix"></div>
				<hr />
				<button type="button" class="btn btn-sm btn-success btn-block" id="asignarDocenteEvaluador">Asignar... <i class="fa fa-check" aria-hidden="true"></i></button>
				<div class="clearfix"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
