<div class="col-md-12" id="admin_ver_finalizadas">
	<div class="clearfix"></div>
	<hr />
	<h3>Solicitudes sin asignar:</h3>
	<br />
	<div class="table">
		<table id="tabla_sinasignar" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td class="col-md-2">Organización</td>
					<td class="col-md-2">ID Solicitud</td>
					<td class="col-md-2">Tipo</td>
					<td class="col-md-2">Motivo</td>
					<td class="col-md-2">Modalidad</td>
					<td class="col-md-2">Fecha de finalización</td>
					<td class="col-md-2">Asignada a</td>
					<td class="col-md-2">Acción</td>
				</tr>
			</thead>
			<tbody id="tbody">
			<?php
				$j = 0;
				for ($i = 0; $i < count($solicitudes); $i++) {
					if ($solicitudes[$i][$j]->asignada == "SIN ASIGNAR") {
						echo "<tr>";
						echo "<td>" . $solicitudes[$i][$j]->nombreOrganizacion . "</td>";
						echo "<td>" . $solicitudes[$i][$j]->idSolicitud . "</td>";
						echo "<td>" . $solicitudes[$i][$j]->tipoSolicitud . "</td>";
						echo "<td>" . $solicitudes[$i][$j]->motivoSolicitud . "</td>";
						echo "<td>" . $solicitudes[$i][$j]->modalidadSolicitud . "</td>";
						echo "<td>" . $solicitudes[$i][$j]->fechaFinalizado . "</td>";
						echo "<td>" . $solicitudes[$i][$j]->asignada . "</td>";
						echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm' id='verModalAsignar' data-organizacion='" . $solicitudes[$i][$j]->id_organizacion . "' data-nombre='" . $solicitudes[$i][$j]->nombreOrganizacion . "' data-nit='" . $solicitudes[$i][$j]->numNIT . "' data-solicitud='" . $solicitudes[$i][$j]->idSolicitud . "' data-toggle='modal' data-target='#asignarOrganizacion'>Asignar <i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
						echo "</tr>";
					}
					$j = $j++;
				}
			?>
			</tbody>
		</table>
		<div class="clearfix"></div>
		<hr />
		<h3>Solicitudes Asignadas:</h3>
		<br />
		<div class="table">
			<table id="tabla_asginadas" width="100%" border=0 class="table table-striped table-bordered tabla_form">
				<thead>
					<tr>
						<td class="col-md-2">Organización</td>
						<td class="col-md-2">ID Solicitud</td>
						<td class="col-md-2">Tipo</td>
						<td class="col-md-2">Motivo</td>
						<td class="col-md-2">Modalidad</td>
						<td class="col-md-2">Fecha de finalización</td>
						<td class="col-md-2">Asignada a</td>
						<td class="col-md-2">Acción</td>
					</tr>
				</thead>
				<tbody id="tbody">
				<?php
					$k = 0;
					//echo '<pre>'; var_dump($solicitudes[0]); echo '</pre>';
					for ($i = 0; $i < count($solicitudes); $i++) {
						if ($solicitudes[$i][$k]->asignada != "SIN ASIGNAR") {
							echo "<tr>";
							echo "<td>" . $solicitudes[$i][$k]->nombreOrganizacion . "</td>";
							echo "<td>" . $solicitudes[$i][$k]->idSolicitud . "</td>";
							echo "<td>" . $solicitudes[$i][$k]->tipoSolicitud . "</td>";
							echo "<td>" . $solicitudes[$i][$k]->motivoSolicitud . "</td>";
							echo "<td>" . $solicitudes[$i][$k]->modalidadSolicitud . "</td>";
							echo "<td>" . $solicitudes[$i][$k]->fechaFinalizado . "</td>";
							echo "<td>" . $solicitudes[$i][$k]->asignada . "</td>";
							echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm' id='verModalAsignar' data-organizacion='" . $solicitudes[$i][$k]->id_organizacion . "' data-nombre='" . $solicitudes[$i][$k]->nombreOrganizacion . "' data-nit='" . $solicitudes[$i][$k]->numNIT . "' data-solicitud='" . $solicitudes[$i][$k]->idSolicitud . "' data-toggle='modal' data-target='#asignarOrganizacion'>Asignar <i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
							echo "</tr>";
						}
						$k = $k++;
					}
				?>
				</tbody>
			</table>
			<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		</div>
	</div>
	<div class="modal fade" id="asignarOrganizacion" tabindex="-1" role="dialog" aria-labelledby="ariaAsignar">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="ariaAsignar">Asignar evaluador a esta solicitud</h3>
					<small>Pueden que existan usuario con diferente rol y tenga que comunicarse con soporte para que el super administrador pueda cambiar este rol.</small>
				</div>
				<div class="modal-body">
					<p>Seleccione de la siguiente lista los usuarios que tienen el rol de evaluadores para que pueda asignarlo a una organización y que pueda verificar la solicitud.</p>
					<hr />
					<select name="evaluadorAsignar" id="evaluadorAsignar" class="selectpicker form-control show-tick" required="">
						<?php foreach ($administradores as $administrador):
								if ($administrador->nivel == 1): ?>
								<option id="<?php echo $administrador->id_administrador; ?>" value="<?php echo $administrador->usuario; ?>"><?php echo $administrador->primerNombreAdministrador . " " . $administrador->primerApellidoAdministrador; ?></option>
						<?php endif; endforeach;?>
					</select>
					<div class="clearfix"></div>
					<hr />
					<p>ID de la organización:</p><label id="idAsigOrg"></label>
					<p>Nombre de la organización:</p><label id="nombreAsigOrg"></label>
					<p>Número NIT:</p><label id="nitAsigOrg"></label>
					<p>ID Solicitud:</p><label id="idSolicitud"></label>
					<hr />
					<p>Luego haber seleccionado al usuario, puede dar clic en asignar para que se haga lo siguiente:</p>
					<ul>
						<li>Se le enviará un correo a la persona con la información de la organización.</li>
						<li>Solamente esa persona podrá acceder a ver la solicitud de la organización.</li>
					</ul>
					<div class="clearfix"></div>
					<hr />
					<button type="button" class="btn btn-sm btn-success btn-block" id="asignarOrganizacionEvaluador">Asignar... <i class="fa fa-check" aria-hidden="true"></i></button>
					<div class="clearfix"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
	</div>
