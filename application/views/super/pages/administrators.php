<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $administradores
 */
$CI = &get_instance();
$CI->load->model("AdministradoresModel");
$CI->load->model("UsuariosModel");
$CI->load->model("OrganizacionesModel");
$CI->load->model("CorreosRegistroModel");
$CI->load->model("TokenModel");

if($logged_in == TRUE && $tipo_usuario == "super"): ?>
	<!-- partial -->
	<div class="main-panel">
		<div class="content-wrapper">
			<!-- Tabla de usuarios -->
			<div class="row">
				<div class="col-md-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<input type="button" class="btn btn-primary admin-modal float-right" data-funct="crear" data-toggle="modal" data-target="#modal-admin" value="Crear administrador">
							<br>
							<p class="card-title">Administradores registrados</p>
							<div class="row">
								<div class="col-12">
									<div class="container">
										<div class="clearfix"></div>
										<hr/>
										<div class="table-responsive">
											<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form display expandable-table">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>Número de cédula</th>
														<th>Correo electrónico</th>
														<th>Rol</th>
														<th>Estado</th>
														<th>Acción</th>
													</tr>
												</thead>
												<tbody id="tbody">
												<?php foreach ($administradores as $administrador):
													echo "<tr><td>$administrador->primerNombreAdministrador" . " " . $administrador->primerApellidoAdministrador . "</td>";
													echo "<td>$administrador->numCedulaCiudadaniaAdministrador</td>";
													echo "<td>$administrador->direccionCorreoElectronico</td>";
													echo "<td>"; echo $CI->AdministradoresModel->getNivel($administrador->nivel); echo "</td>";
													echo "<td>";
													if($administrador->logged_in == 1):
														echo 'Conectado';
													else:
														echo" Desconectado";
													endif;
													echo "</td>";
													echo "<td><button class='btn btn-primary btn-sm admin-modal' data-funct='actualizar' data-toggle='modal' data-id='$administrador->id_administrador' data-target='#modal-admin'>Ver</button></td></tr>";
												endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal formulario administradores -->
	<div class="modal fade" id="modal-admin" tabindex="-1" role="dialog" aria-labelledby="verAdmin">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="verAdmin">Administrador <label id="super_id_admin_modal"></label> <span id="super_status_adm"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?= form_open('', array('id' => 'formulario_super_administradores')); ?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Primer Nombre:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_primernombre_admin" name="super_primernombre_admin">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Segundo Nombre:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_segundonombre_admin" name="super_segundonombre_admin">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Primer Apellido:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_primerapellido_admin" name="super_primerapellido_admin">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Segundo Apellido:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_segundoapellido_admin" name="super_segundoapellido_admin">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Cédula:</label>
									<div class="col-sm-9">
										<input class="form-control" type="number" id="super_numerocedula_admin" name="super_numerocedula_admin">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Extensión:</label>
									<div class="col-sm-9">
										<input class="form-control" type="number" id="super_ext_admin" name="super_ext_admin">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Nivel de acceso:</label><br/>
									<div class="col-sm-9">
										<select class="custom-select show-tick" name="super_acceso_nvl" id="super_acceso_nvl" required>
											<option value="0">Total 0</option>
											<option value="1">Evaluador 1</option>
											<option value="2">Reportes 2</option>
											<option value="3">Cámaras 3</option>
											<option value="4">Histórico 4</option>
											<option value="5">Seguimientos 5</option>
											<option value="6">Asignación 6</option>
											<option value="7">Atención al ciudadano 7</option>
											<option value="8">Dirección Técnica 8</option>
											<option value="9">Jurídica 9</option>
											<option value="10">Dirección Nacional 10</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Nombre usuario:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_nombre_admin" name="super_nombre_admin">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Contraseña:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_contrasena_admin" name="super_contrasena_admin">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Correo electrónico:</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" id="super_correo_electronico_admin" name="super_correo_electronico_admin">
									</div>
								</div>
							</div>
						</div>
						<?= form_close(); ?>
					</div>
					<div class="modal-footer">
						<div class="btn-group" role='group' aria-label='acciones' id="actions-admins">
							<button type="button" class="btn btn-sm btn-danger" id="super_eliminar_admin">Eliminar</button>
							<button type="button" class="btn btn-sm btn-info" id="super_desconectar_admin">Desconectar</button>
							<button type="button" class="btn btn-sm btn-primary" id="super_actualizar_admin">Actualizar</button>
						</div>
						<button type="button" class="btn btn-md btn-success" id="super_nuevo_admin">Crear</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</div>
