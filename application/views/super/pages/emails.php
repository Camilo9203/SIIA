<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $correos
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
						<p class="card-title">Registro correos</p>
						<div class="row">
							<div class="col-12">
								<div class="container">
									<div class="clearfix"></div>
									<hr/>
									<div class="table-responsive">
										<table id="tabla_correos_logs" width="100%" border=0 class="table table-striped table-bordered tabla_form display expandable-table">
											<thead>
											<tr>
												<th>Fecha de envío</th>
												<th>Para</th>
												<th>Tipo</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
											<tbody id="tbody">
											<?php
											foreach ($correos as $correo):
												echo "<td> $correo->fecha </td>";
												echo "<td>$correo->para</td>";
												echo "<td>$correo->tipo</td>";
												if ($correo->error != "Enviado"):
													echo "<td><span class='spanRojo'> Error de envío </span></td>";
													echo "<td><button class='btn btn-primary btn-sm ver-error-envio' data-error='$correo->error'>Ver error</button></td>";
												else:
													echo "<td><span class='spanVerde'> Enviado</span></td>";
													echo "<td><button class='btn btn-success btn-sm disabled' data-error='$correo->error'>Enviado</button></td>";
												endif;
												echo '</tr>';
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
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="verUser">Usuario: <label id="super_usuario_modal"></label> <span id="super_status_usr"></span></h4>
					<input type="hidden" id="super_id_user">
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<?php echo form_open('', array('id' => 'formulario_super_usuario')); ?>
							<div class="col-md-6">
								<div class="form-group">
									<label>Organización</label>
									<input type="text" id="nombre_organizacion" name="nombre_organizacion" class="form-control" disabled>
								</div>
								<div class="form-group">
									<label>NIT</label>
									<input type="text" id="nit_organizacion" name="nit_organizacion" class="form-control" disabled>
								</div>
								<div class="form-group">
									<label>Correo electrónico</label>
									<input type="text" id="correo_electronico_usuario" name="correo_electronico_usuario" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Usuario</label>
									<input type="text" id="username" name="username" class="form-control">
								</div>
								<div class="form-group">
									<label>Contraseña</label>
									<input type="text" id="password" name="password" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Estado</label><br/>
									<select class="custom-select show-tick" name="estado_usuario" id="estado_usuario" required>
										<option value="0">No Verificado</option>
										<option value="1">Verificado</option>
										<option value="2">Bloqueado</option>
									</select>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn-group" role='group' aria-label='acciones'>
						<button type="button" class="btn btn-sm btn-danger" id="super_desconectar_user">Desconectar</button>
						<button type="button" class="btn btn-sm btn-success" id="super_enviar_activacion_cuenta">Enviar Activación</button>
						<button type="button" class="btn btn-sm btn-primary" id="super_actualizar_user">Actualizar</button>
						<button type="button" class="btn btn-sm btn-info" id="super_enviar_info_usuer">Enviar Información</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
