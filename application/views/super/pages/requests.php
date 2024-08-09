<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $solicitudes
 * @var $organizaciones
 */
$CI = &get_instance();
$CI->load->model("SolicitudesModel");
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
							<p class="card-title">Solicitudes registradas</p>
							<div class="row">
								<div class="col-12">
									<div class="container">
										<div class="clearfix"></div>
										<hr/>
										<div class="table-responsive">
											<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form display expandable-table">
												<thead>
													<tr>
														<th>ID Solicitud</th>
														<th>Creación</th>
														<th>Estado</th>
														<th>Asignada</th>
														<th>Tipo</th>
														<th>Acción</th>
													</tr>
												</thead>
												<tbody id="tbody">
												<?php foreach ($solicitudes as $solicitud):
													echo "<tr><td>$solicitud->idSolicitud</td>";
													echo "<td>$solicitud->fechaCreacion</td>";
													echo "<td>$solicitud->nombre</td>";
													echo "<td>$solicitud->asignada</td>";
													echo "<td>$solicitud->tipoSolicitud</td>";
													echo "<td><button class='btn btn-outline-primary btn-sm admin-modal' data-funct='actualizar' data-toggle='modal' data-id='$solicitud->id_solicitudes' data-target='#modal-admin'>Ver</button></td></tr>";
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
	<!-- Modal formulario crear solicitud -->
	<div class="modal fade" id="modal-crear-solicitud" tabindex="-1" role="dialog" aria-labelledby="modal-crear-solicitud">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="verAdmin">Crear Solicitud</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container">
						<?php echo form_open('', array('id' => 'crear_solicitud_sp')); ?>
						<!--Select NIT Organización -->
						<div class="row">
							<div class="col-md-12">
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
						<!-- Tipo de la solicitud -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label">Tipo <span class="spanRojo">*</span></label>
									<div class="col-sm-9">
										<select name="tipo_solicitud" id="tipo_solicitud" class="selectpicker form-control show-tick" required>
											<option value="Solicitud Nueva">Solicitud Nueva</option>
											<option value="Renovación de Acreditación">Renovación de Acreditación</option>
											<option value="Renovación de Acreditación, Solicitud Nueva">Renovación de Acreditación, Solicitud Nueva</option>
											<option value="Acreditación Primera vez">Acreditación Primera vez</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<!-- Fecha de creación -->
						<div class="form-group row">
							<label class="col-sm-3 col-form-label" for="fecha-creacion">Fecha de creación <span class="spanRojo">*</span></label>
							<div class="col-sm-9">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
									</div>
									<input class="form-control datepicker" placeholder="Selecciona la fecha" type="text"  id="fecha-creacion">
								</div>
							</div>
						</div>
						<!-- CheckBox Motivos de la solicitud -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row ">
									<label class="col-sm-3 col-form-label">Motivo <span class="spanRojo">*</span></label><br>
									<div class="col-sm-9">
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="1" id="cursoBasico" name="motivos" checked>
											<label class="form-check-label" for="cursoBasico">Acreditación Curso Básico de Economía Solidaria</label>
										</div>
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="2" id="avalTrabajo" name="motivos">
											<label class="form-check-label" for="avalTrabajo">Aval de Trabajo Asociado</label>
										</div>
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="3" id="cursoMedio" name="motivos">
											<label class="form-check-label" for="cursoMedio">Acreditación Curso Medio de Economía Solidaria</label>
										</div>
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="4" id="cursoAvanzado" name="motivos">
											<label class="form-check-label" for="cursoAvanzado">Acreditación Curso Avanzado de Economía Solidaria</label>
										</div>
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="5" id="finacieraEconomia" name="motivos">
											<label class="form-check-label" for="finacieraEconomia">Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria</label>
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- Modalidad de la solicitud -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Modalidad <span class="spanRojo">*</span></label><br>
									<div class="col-sm-9">
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="1" id="presencial" name="modalidades" checked>
											<label class="form-check-label" for="presencial">Presencial</label>
										</div>
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="2" id="virtual" name="modalidades">
											<label class="form-check-label" for="virtual">Virtual</label>
										</div>
										<div class="form-check radio">
											<input class="form-check-input" type="checkbox" value="3" id="enLinea" name="modalidades">
											<label class="form-check-label" for="enLinea">En Linea</label>
										</div>
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
