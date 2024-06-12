<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $usuarios
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
		<!-- Tabla de administradores -->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<p class="card-title">Usuarios registrados</p>
						<div class="row">
							<div class="col-12">
								<div class="container">
									<div class="clearfix"></div>
									<hr/>
									<div class="table-responsive">
										<table id="tabla_super_usuarios" width="100%" border=0 class="table table-striped table-bordered tabla_form display expandable-table">
											<thead>
											<tr>
												<th>Organización</th>
												<th>NIT</th>
												<th>Usuario</th>
												<th>Contraseña</th>
												<th>Estado</th>
												<th>Conectado</th>
												<th>Acciones</th>
											</tr>
											</thead>
											<tbody id="tbody">
											<?php
											foreach ($usuarios as $usuario):
												echo "<td> $usuario->sigla </td>";
												echo "<td>$usuario->numNIT</td>";
												echo "<td>$usuario->usuario</td>";
												echo "<td>"; echo $CI->UsuariosModel->getPassword($usuario->contrasena_rdel); echo "</td>";
												echo "<td>"; echo $CI->TokenModel->getState($usuario->verificado); echo "</td>";
												echo "<td>"; echo $CI->UsuariosModel->getConnection($usuario->logged_in); echo "</td>";
												echo "<td><button class='btn btn-primary btn-sm admin-usuario' data-toggle='modal' data-id='$usuario->id_usuario' data-target='#modal-user'>Ver</button></td></tr>";
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
	<!-- Modal formulario usuarios -->
	<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="verUsuarios">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="verUser">Usuario: <label id="super_usuario_modal"></label> <span id="super_status_usr"></span></h4>
					<input type="hidden" id="super_id_user">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?php echo form_open('', array('id' => 'formulario_super_usuario')); ?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Organización</label>
									<div class="col-sm-9">
										<input type="text" id="nombre_organizacion" name="nombre_organizacion" class="form-control" disabled>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">NIT</label>
									<div class="col-sm-9">
										<input type="text" id="nit_organizacion" name="nit_organizacion" class="form-control" disabled>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Correo electrónico</label>
									<div class="col-sm-9">
										<input type="text" id="correo_electronico_usuario" name="correo_electronico_usuario" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Usuario</label>
									<div class="col-sm-9">
										<input type="text" id="username" name="username" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Contraseña</label>
									<div class="col-sm-9">
										<input type="text" id="password" name="password" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Estado</label><br/>
									<div class="col-sm-9">
										<select class="custom-select show-tick" name="estado_usuario" id="estado_usuario" required>
										<option value="0">No Verificado</option>
										<option value="1">Verificado</option>
										<option value="2">Bloqueado</option>
									</select>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
					<div class="modal-footer">
						<div class="btn-group" role='group' aria-label='acciones' id="actions_users">
							<button type="button" class="btn btn-danger" id="super_desconectar_user">Desconectar</button>
							<button type="button" class="btn btn-success" id="super_enviar_activacion_cuenta">Enviar Activación</button>
							<button type="button" class="btn btn-primary" id="super_actualizar_user">Actualizar</button>
							<button type="button" class="btn btn-info" id="super_enviar_info_usuer">Enviar Información</button>
						</div>
					</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php endif; ?>
</div>
