<div class="col-md-12" id="admin_ver_finalizadas">
	<div class="clearfix"></div>
	<hr />
	<h3>Organizaciones SIN ASIGNAR con solicitud:</h3>
	<br />
	<div class="table">
		<table id="tabla_sinasignar" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td class="col-md-2">Nombre</td>
					<td>NIT</td>
					<td class="col-md-2">Representante Legal</td>
					<td class="col-md-2">Correo de la Organización</td>
					<td class="col-md-2">Correo del Representante</td>
					<td class="col-md-2">Fecha de finalización</td>
					<td class="col-md-2">Asignada a</td>
					<td class="col-md-2">Acción</td>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php
				foreach ($organizaciones_en_proceso as $organizaciones) {
					if ($organizaciones->asignada == "SIN ASIGNAR") {
						echo "<tr>";
						echo "<td>" . $organizaciones->nombreOrganizacion . "</td>";
						echo "<td>" . $organizaciones->numNIT . "</td>";
						echo "<td>" . $organizaciones->primerNombreRepLegal . " " . $organizaciones->segundoNombreRepLegal . " " . $organizaciones->primerApellidoRepLegal . " " . $organizaciones->segundoApellidoRepLegal . "</td>";
						echo "<td>" . $organizaciones->direccionCorreoElectronicoOrganizacion . "</td>";
						echo "<td>" . $organizaciones->direccionCorreoElectronicoRepLegal . "</td>";
						echo "<td>" . $organizaciones->fechaFinalizado . "</td>";
						echo "<td>" . $organizaciones->asignada . "</td>";
						echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm' id='verModalAsignar' data-organizacion='" . $organizaciones->id_organizacion . "' data-nombre='" . $organizaciones->nombreOrganizacion . "' data-nit='" . $organizaciones->numNIT . "' data-solicitud='" . $organizaciones->idSolicitud . "' data-toggle='modal' data-target='#asignarOrganizacion'>Asignar <i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
		<div class="clearfix"></div>
		<hr />
		<h3>Organizaciones ASIGNADAS con solicitud:</h3>
		<br />
		<div class="table">
			<table id="tabla_asginadas" width="100%" border=0 class="table table-striped table-bordered tabla_form">
				<thead>
					<tr>
						<td class="col-md-2">Nombre</td>
						<td>NIT</td>
						<td class="col-md-2">Representante Legal</td>
						<td class="col-md-2">Correo de la Organización</td>
						<td class="col-md-2">Correo del Representante</td>
						<td class="col-md-2">Fecha de finalización</td>
						<td class="col-md-2">Asignada a</td>
						<td class="col-md-2">Acción</td>
					</tr>
				</thead>
				<tbody id="tbody">
					<?php
					foreach ($organizaciones_en_proceso as $organizaciones) {
						if ($organizaciones->asignada != "SIN ASIGNAR") {
							echo "<tr>";
							echo "<td>" . $organizaciones->nombreOrganizacion . "</td>";
							echo "<td>" . $organizaciones->numNIT . "</td>";
							echo "<td>" . $organizaciones->primerNombreRepLegal . " " . $organizaciones->segundoNombreRepLegal . " " . $organizaciones->primerApellidoRepLegal . " " . $organizaciones->segundoApellidoRepLegal . "</td>";
							echo "<td>" . $organizaciones->direccionCorreoElectronicoOrganizacion . "</td>";
							echo "<td>" . $organizaciones->direccionCorreoElectronicoRepLegal . "</td>";
							echo "<td>" . $organizaciones->fechaFinalizado . "</td>";
							echo "<td>" . $organizaciones->asignada . "</td>";
							echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm' id='verModalAsignar' data-organizacion='" . $organizaciones->id_organizacion . "' data-nombre='" . $organizaciones->nombreOrganizacion . "' data-nit='" . $organizaciones->numNIT . "' data-solicitud='" . $organizaciones->idSolicitud . "' data-toggle='modal' data-target='#asignarOrganizacion'>Asignar <i class='fa fa-pencil' aria-hidden='true'></i></a></td>";
							echo "</tr>";
						}
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
					<h3 class="modal-title" id="ariaAsignar">Asignar evaluador a una organización</h3>
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
