<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $resoluciones
 * @var $organizaciones
 */
$CI = &get_instance();
$CI->load->model("ResolucionesModel");
if($logged_in == TRUE && $tipo_usuario == "super"): ?>
	<script src="<?= base_url('assets/js/functions/super/resolutions.js?v=1.0') . time() ?>" type="text/javascript"></script>
	<!-- partial -->
	<div class="main-panel">
		<div class="content-wrapper">
			<!-- Tabla de resoluciones -->
			<div class="row">
				<div class="col-md-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<input type="button" class="btn btn-primary float-right resoluciones-modal" data-funct='crear' data-toggle='modal' data-target='#modal-resolucion' value="Crear Resolución">
							<br>
							<p class="card-title"><i class="icon-book menu-icon"></i> Resoluciones registradas</p>
							<div class="row">
								<div class="col-12">
									<div class="container">
										<div class="clearfix"></div>
										<hr/>
										<div class="table-responsive">
											<table id="tabla_super_admins" width="100%" class="table table-striped table-bordered tabla_form display expandable-table">
												<thead>
												<tr>
													<th>Organización</th>
													<th>NIT</th>
													<th>Número Resolución</th>
													<th>Años</th>
													<th>Fecha Inicio</th>
													<th>Fecha Fin</th>
													<th>Acción</th>
												</tr>
												</thead>
												<tbody id="tbody">
													<?php
													foreach ($resoluciones as $resolucion):
														echo "<tr><td>$resolucion->sigla</td>";
														echo "<td>$resolucion->numNIT</td>";
														echo "<td>$resolucion->numeroResolucion</td>";
														echo "<td>$resolucion->anosResolucion</td>";
														echo "<td>$resolucion->fechaResolucionInicial</td>";
														echo "<td>$resolucion->fechaResolucionFinal</td>";
														echo "<td><button class='btn btn-outline-primary btn-sm resoluciones-modal' data-funct='actualizar' data-toggle='modal' data-id='$resolucion->id_resoluciones' data-target='#modal-resolucion'>Ver</button></td></tr>";
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
	<!-- Modal formulario crear resolución -->
	<div class="modal fade" id="modal-resolucion" tabindex="-1" role="dialog" aria-labelledby="modal-resolucion">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="resolu">Crear resolución <label id="super_id_admin_modal"></label> <span id="super_status_adm"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?php echo form_open('', array('id' => 'form_resoluciones_super')); ?>
						<!--Select NIT Organización -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label" for="nit-organizacion">NIT <span class="spanRojo">*</span></label>
									<select name="nit-organizacion" id="nit-organizacion" class="selectpicker form-control" required>
										<?php foreach ($organizaciones as $organizacion) : ?>
											<option value="<?= $organizacion->numNIT ?>"><?= $organizacion->numNIT ?> | <?= $organizacion->sigla ?> </option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row align-content-center">
									<input type="number" name="anos-resolucion" id="anos-resolucion" class="form-control" required placeholder="Años Vigencia">
								</div>
							</div>
						</div>
						<!-- Fechas -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label" for="fecha-inicio">Fecha de creación <span class="spanRojo">*</span></label>
									<div class="col-sm-9">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
											</div>
											<input class="form-control datepicker" placeholder="Selecciona la fecha" type="text"  id="fecha-inicio">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label" for="fecha-inicio">Fecha de finalización <span class="spanRojo">*</span></label>
									<div class="col-sm-9">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
											</div>
											<input class="form-control datepicker" placeholder="Selecciona la fecha" type="text"  id="fecha-fin">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Fecha de creación -->
						<div class="form-group row">
							<label class="col-sm-3 col-form-label" for="fecha-creacion">Fecha de creación <span class="spanRojo">*</span></label>
							<div class="col-md-6">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label" for="nit-organizacion">NIT <span class="spanRojo">*</span></label>
									<div class="col-sm-9">
										<select name="nit-organizacion" id="nit-organizacion" class="selectpicker form-control" required>
											<?php foreach ($organizaciones as $organizacion) : ?>
												<option value="<?= $organizacion->numNIT ?>"><?= $organizacion->numNIT ?> | <?= $organizacion->sigla ?> </option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label" for="nit-organizacion">NIT <span class="spanRojo">*</span></label>
									<div class="col-sm-9">
										<select name="nit-organizacion" id="nit-organizacion" class="selectpicker form-control" required>
											<?php foreach ($organizaciones as $organizacion) : ?>
												<option value="<?= $organizacion->numNIT ?>"><?= $organizacion->numNIT ?> | <?= $organizacion->sigla ?> </option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
				<br>
				<div class="modal-footer col-md-12">
					<div class="btn-group" role='group' aria-label='acciones'>
						<button id="btn_crear_solicitud_sp" class="btn btn-success">Crear solicitud <i class="fa fa-check" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
</div>
