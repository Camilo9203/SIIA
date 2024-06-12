<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $solicitudes
 * @var $organizaciones
 */
$CI = &get_instance();
$CI->load->model("SolicitudesModel");
if($logged_in == TRUE && $tipo_usuario == "super"): ?>
	<!-- partial -->
	<div class="main-panel">
	<div class="content-wrapper">
		<!-- Tabla de usuarios -->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<input type="button" class="btn btn-primary float-right solicitudes-modal" data-toggle='modal' data-target='#modal-crear-solicitud' value="Crear Solicitud">
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
	<!-- Modal formulario crear solicitud -->
	<div class="modal fade" id="modal-crear-solicitud" tabindex="-1" role="dialog" aria-labelledby="modal-crear-solicitud">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="verAdmin">Crear solicitud <label id="super_id_admin_modal"></label> <span id="super_status_adm"></span></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?php echo form_open('', array('id' => 'crear_solicitud_sp')); ?>
							<!--Select NIT Organización -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group row align-content-center">
									<label class="col-sm-3 col-form-label">Nit organización</label><br>
									<div class="col-sm-9">
										<select name="nit-organizacion" id="nit-organizacion" class="selectpicker form-control show-tick" required>
											<?php foreach ($organizaciones as $organizacion) : ?>
												<option value="<?= $organizacion->numNIT ?>"><?= $organizacion->numNIT ?> | <?= $organizacion->sigla ?> </option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<!-- CheckBox Motivos de la solicitud -->
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Motivo de la solicitud <span class="spanRojo">*</span></label><br>
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
							<div class="col-md-4">
								<!-- Modalidad de la solicitud -->
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
						<div class="row">
							<div class="col-md-8">
								<!-- Tipo de la solicitud -->
								<div class="form-group">
									<label class="col-sm-3 col-form-label">Tipo <span class="spanRojo">*</span></label><br>
									<div class="form-check radio">
										<input class="form-check-input" type="radio" value="Solicitud Nueva" id="nueva" name="tipos" checked>
										<label class="form-check-label" for="nueva">Solicitud Nueva</label>
									</div>
									<div class="form-check radio">
										<input class="form-check-input" type="radio" value="Renovación de Acreditación" id="renovacion" name="tipos">
										<label class="form-check-label" for="renovacion">Renovación de Acreditación</label>
									</div>
									<div class="form-check radio">
										<input class="form-check-input" type="radio" value="Acreditación Primera vez" id="acreditacion" name="tipos">
										<label class="form-check-label" for="acreditacion">Acreditación Primera vez</label>
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
