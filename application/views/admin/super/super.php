<?php
/***
 * @var $administradores
 * @var $logged_in
 * @var $tipo_usuario
 */
$CI = &get_instance();
$CI->load->model("AdministradoresModel");
?>
<?php if($logged_in == FALSE && $tipo_usuario == "none"): ?>
	<div class="container">
		<div class="col-md-12">
			<h3>Contraseña:</h3>
			<div class="form-group">
				<input type="password" id="tpssp" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required value="">
			</div>
			<input type="button" class="btn btn-siia" id="init_sp" value="Iniciar">
		</div>
	</div>
<?php endif; ?>
<?php if($logged_in == TRUE && $tipo_usuario == "super"): ?>
	<!-- Menu super administrador -->
	<div class="container" id="menu-super-admin">
		<hr>
		<h3 class="title">Acciones súper administrativas</h3>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<!-- Botón ver administradores -->
				<div class="col-md-3">
					<div class="panel panel-siia">
						<div class="panel-heading">
							<h3 class="panel-title">Ver  administradores <i class="fa fa-users" aria-hidden="true"></i></h3>
						</div>
						<div class="panel-body">
							<input type="button" class="btn btn-default btn-block" data-toggle="modal" id="super-ver-admins" value="Ver administradores">
						</div>
					</div>
				</div>
				<!-- Botón crear administradores -->
				<div class="col-md-3">
					<div class="panel panel-siia">
						<div class="panel-heading">
							<h3 class="panel-title">Crear administradores <i class="fa fa-users" aria-hidden="true"></i></h3>
						</div>
						<div class="panel-body">
							<input type="button" class="btn btn-default btn-block admin-modal" data-funct="crear" data-toggle="modal" data-target="#modal-admin" value="Crear administrador">
						</div>
					</div>
				</div>
				<!-- Botón salir sesión súper -->
				<div class="col-md-3">
					<div class="panel panel-siia">
						<div class="panel-heading">
							<h3 class="panel-title">Salir <i class="fa fa-sign-out" aria-hidden="true"></i></h3>
						</div>
						<div class="panel-body">
							<input type="button" class="btn btn-block btn-danger" id="super_cerrar_sesion" value="Cerrar Sesión Super">
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
	</div>
	<!-- Tabla administradores -->
	<div class="container display-4" id="super-view-admins">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3 class="title">Administradores</h3>
					<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
						<thead>
						<tr>
							<td>Nombre</td>
							<td>Número de cédula</td>
							<td>Nombre usuario</td>
							<td>Correo electrónico</td>
							<td>Rol</td>
							<td>Estado</td>
							<td>Accion</td>
						</tr>
						</thead>
						<tbody id="tbody">
						<?php foreach ($administradores as $administrador):
							echo "<td>$administrador->primerNombreAdministrador" . " " . $administrador->primerApellidoAdministrador . "</td>";
							echo "<td>$administrador->numCedulaCiudadaniaAdministrador</td>";
							echo "<td>$administrador->usuario</td>";
							echo "<td>$administrador->direccionCorreoElectronico</td>";
							echo "<td>"; echo $CI->AdministradoresModel->getNivel($administrador->nivel); echo "</td>";
							echo "<td>";
								if($administrador->logged_in == 1):
									echo 'Conectado';
								else:
									echo" Desconectado";
								endif;
							echo "</td>";
							echo "<td><button class='btn btn-siia admin-modal' data-funct='actualizar' data-toggle='modal' data-id='$administrador->id_administrador' data-target='#modal-admin'>Ver</button></td></tr>";
						endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal formulario administradores -->
	<div class="modal fade" id="modal-admin" tabindex="-1" role="dialog" aria-labelledby="verAdmin">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="verAdmin">Administrador <label id="super_id_admin_modal"></label> <span id="super_status_adm"></span></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<?php echo form_open('', array('id' => 'formulario_super_administradores')); ?>
							<div class="col-md-6">
								<div class="form-group">
									<label>Primer Nombre:</label>
									<input type="text" id="super_primernombre_admin" name="super_primernombre_admin" class="form-control" name="" value="">
								</div>
								<div class="form-group">
									<label>Segundo Nombre:</label>
									<input type="text" id="super_segundonombre_admin" name="super_segundonombre_admin" class="form-control" name="" value="">
								</div>
								<div class="form-group">
									<label>Primer Apellido:</label>
									<input type="text" id="super_primerapellido_admin" name="super_primerapellido_admin" class="form-control" name="" value="">
								</div>
								<div class="form-group">
									<label>Segundo Apellido:</label>
									<input type="text" id="super_segundoapellido_admin" name="super_segundoapellido_admin" class="form-control" name="" value="">
								</div>
								<div class="form-group">
									<label>Numero de cédula:</label>
									<input type="number" id="super_numerocedula_admin" name="super_numerocedula_admin" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nivel de acceso:</label><br/>
									<select class="custom-select show-tick" name="super_acceso_nvl" id="super_acceso_nvl" required>
										<option value="0">Total 0</option>
										<option value="1">Evaluador 1</option>
										<option value="2">Reportes 2</option>
										<option value="3">Cámaras 3</option>
										<option value="4">Histórico 4</option>
										<option value="5">Seguimientos 5</option>
										<option value="6">Asignación 6</option>
									</select>
								</div>
								<div class="form-group">
									<label>Nombre usuario:</label>
									<input type="text" id="super_nombre_admin" name="super_nombre_admin" class="form-control" name="" value="">
								</div>
								<div class="form-group">
									<label>Contraseña:</label>
									<input type="text" id="super_contrasena_admin" name="super_contrasena_admin" class="form-control" name="" value="">
								</div>
								<div class="form-group">
									<label>Direccion correo electronico:</label>
									<input type="text" id="super_correo_electronico_admin" name="super_correo_electronico_admin" class="form-control" name="" value="">
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<div class="btn-group" role='group' aria-label='acciones'>
					<button type="button" class="btn btn-info" id="super_desconectar_admin">Desconectar</button>
					<button type="button" class="btn btn-danger" id="super_eliminar_admin">Eliminar</button>
					<button type="button" class="btn btn-siia" id="super_actualizar_admin">Actualizar</button>
					<button type="button" class="btn btn-success" id="super_nuevo_admin">Crear</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	  </div>
	</div>
<?php endif; ?>
