<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $solicitudes
 * @var $organizaciones
 */
$CI = &get_instance();
$CI->load->model("SolicitudesModel");
$CI->load->model("UsuariosModel");
if($logged_in == TRUE && ($tipo_usuario == "super" || $tipo_usuario == "admin")): ?>
	<!-- partial -->
	<div class="main-panel">
		<div class="content-wrapper">
			<!-- Tabla de usuarios -->
			<div class="row">
				<div class="col-md-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<?php if($tipo_usuario == "super"): ?>
								<input type="button" class="btn btn-primary float-right solicitudes-modal" data-toggle='modal' data-target='#modal-crear-solicitud' value="Crear Solicitud">
							<?php endif; ?>
							<br>
							<p class="card-title">Organizaciones registradas</p>
							<div class="row">
								<div class="col-12">
									<div class="clearfix"></div>
									<hr/>
									<div class="table-responsive">
										<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form display expandable-table">
											<thead>
											<tr>
												<th>Organización</th>
												<th>NIT</th>
												<th>Correo Notificaciones</th>
												<th>Usuario</th>
												<th>Acción</th>
											</tr>
											</thead>
											<tbody id="tbody">
											<?php foreach ($organizaciones as $organizacion):
												echo "<tr><td>$organizacion->nombreOrganizacion</td>";
												echo "<td>$organizacion->numNIT</td>";
												echo "<td>$organizacion->direccionCorreoElectronicoOrganizacion</td>";
												echo "<td>"; echo $CI->UsuariosModel->getUsuarios($organizacion->usuarios_id_usuario)->usuario; echo "</td>";
												echo "<td><button class='btn btn-outline-primary btn-sm organizacion-modal-detalle' data-funct='ver' data-toggle='modal' data-id='$organizacion->id_organizacion' data-target='#modal-organizaciones-detalle'>Detalle</button></td></tr>";
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
	<!-- Modal formulario crear solicitud -->
	<div class="modal fade" id="modal-organizaciones-detalle" tabindex="-1" role="dialog" aria-labelledby="modal-organizaciones-detalle">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="verAdmin">Detalle Organización</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container">
						<div class="row">
							<div class="col-4">
								<label for="organizacion">Organización</label>
							</div>
							<div class="col-4">
								<label for="nit">NIT</label>
							</div>
							<div class="col-4">Sigla</div>
						</div>
					</div>
				</div>
				<br>
				<div class="modal-footer col-md-12">
					<div class="btn-group" role='group' aria-label='acciones'>
<!--						<button id="btn_crear_solicitud_sp" class="btn btn-success">Crear solicitud <i class="fa fa-check" aria-hidden="true"></i></button>-->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</div>

