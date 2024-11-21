<?php
/***
 * @var InformeActividadesModel $informes
 */
$CI = &get_instance();
$CI->load->model("InformeActividadesModel");
//echo "<pre>";
//var_dump($informes);
//echo "</pre>";
//die();
?>
<!-- jQuery primero, luego Popper.js, luego Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/functions/user/informe-actividades.js?v=1.1') . time() ?>" type="text/javascript"></script>
<script>
	var informes = '<?= count($informes) ?>';
</script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<hr>
			<h3>Informe de actividades enviados</h3>
			<hr>
			<div id="tabla_informes">
				<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
					<thead>
					<tr>
						<td>Fecha de inicio</td>
						<td>Fecha de finalización</td>
						<td>Ciudad</td>
						<td>Duración</td>
						<td>Cursos</td>
						<td>Modalidades</td>
						<td>Total Asistentes</td>
						<td>Estado</td>
						<td>Asistentes</td>
						<td>Acciones</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php foreach ($informes as $informe): ?>
						<tr>
							<td><?= $informe->fechaInicio ?></td>
							<td><?= $informe->fechaFin ?></td>
							<td><?= $informe->municipio ?></td>
							<td><?= $informe->duracion ?> horas</td>
							<!--						<td>--><?php //= $CI->InformeActividadesModel->getIntencionalidad($informe->intencionalidad); ?><!--</td>-->
							<td><textarea class="text-area-ext" readonly><?= $CI->InformeActividadesModel->getCursos($informe->cursos); ?></textarea>
							</td>
							<td><?= $CI->InformeActividadesModel->getModalidades($informe->modalidades); ?></td>
							<td><?= $informe->totalAsistentes ?></td>
							<td><?= $informe->estado ?></td>
							<td>
								<div class="btn-group-vertical" role="group" >
									<button type="button" class='btn btn-siia verAsistentes' title="Ver | Editar Asistentes" data-id='<?= $informe->id_informeActividades; ?>'>
										<i class='fa fa-users' aria-hidden='true'></i>
									</button>
									<a type="button" class='btn btn-outline-danger' title="Ver PDF Firmas" href="<?= base_url("uploads/asistentes/" . $informe->archivoAsistencia); ?>" target="_blank">
										<i class='fa fa-file-pdf-o' aria-hidden='true'></i>
									</a>
									<?php if ($informe->archivoAsistentes): ?>
										<a type="button" class='btn btn-outline-success' title="Descargar excel" href="<?= base_url("uploads/asistentes/" . $informe->archivoAsistentes); ?>">
											<i class='fa fa-file-excel-o' aria-hidden='true'></i>
										</a>
									<?php endif; ?>
								</div>
							</td>
							<td>
								<div class="btn-group-vertical" role="group">
									<button type="button" class='btn btn-info verCurso' title="Ver Detalle Curso" data-toggle='modal' data-id='<?= $informe->id_informeActividades; ?>' data-target='#modal-curso-informe'>
										<i class='fa fa-book' aria-hidden='true'></i>
									</button>
									<button type="button" class='btn btn-siia crearObservacion' title="Realizar observación" data-toggle="modal" data-target="#modal-crear-observacion" data-id="<?= $informe->id_informeActividades; ?>">
										<i class='fa fa-pencil' aria-hidden='true'></i>
									</button>
									<?php if ($informe->estado == 'Enviado' || $informe->estado == 'Observaciones'): ?>
									<button type="button" class='btn btn-success aprobarInforme' title="Aprobar informe" data-id="<?= $informe->id_informeActividades; ?>">
										<i class='fa fa-check' aria-hidden='true'></i>
									</button>
									<?php endif; ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<button class="btn btn-sm btn-danger pull-left" id="admin_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
			</div>
			<!-- Modal detalle informe -->
			<div class="modal fade" id="modal-curso-informe" tabindex="-1" role="dialog" aria-labelledby="modal-curso-informes">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Detalle | Informe de Actividades</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<div class="col-md-6">
									<!-- Fecha de inicio -->
									<div class="form-group">
										<label for="informe_fecha_incio_v">Fecha de inicio</label>
										<input type="text" class="form-control" name="informe_fecha_incio_v" id="informe_fecha_incio_v" disabled>
									</div>
									<!-- Fecha de fin -->
									<div class="form-group">
										<label for="informe_fecha_fin_v">Fecha de finalización</label>
										<input type="text" class="form-control" name="informe_fecha_fin_v" id="informe_fecha_fin_v" disabled>
									</div>
									<!-- Departamentos -->
									<div class="form-group">
										<label for="informe_departamento_curso_v">Departamento*</label>
										<input type="text" class="form-control" name="informe_departamento_curso_v" id="informe_departamento_curso_v" disabled>
									</div>
									<!-- Municipios -->
									<div class="form-group">
										<label for="informe_municipio_curso_v">Municipio:*</label>
										<input type="text" class="form-control" name="informe_municipio_curso_v" id="informe_municipio_curso_v" disabled>
									</div>
									<!-- Duración Curso -->
									<div class="form-group">
										<label for="informe_duracion_curso_v">Duracion del Curso: <small>Horas</small></label>
										<input type="number" name="informe_duracion_curso_v" class="form-control" id="informe_duracion_curso_v" disabled>
									</div>
									<!-- Docente -->
									<div class="form-group">
										<label for="informe_docente_v">Docente:</label><br>
										<input type="text" class="form-control" name="informe_docente_v" id="informe_docente_v" disabled>
									</div>
									<!-- Intencionalidad Curso -->
									<div class="form-group">
										<label for="informe_intencionalidad_curso_v">Intencionalidad del Curso:</label><br>
										<input type="text" class="form-control" name="informe_intencionalidad_curso_v" id="informe_intencionalidad_curso_v" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<!-- Curso -->
									<div class="form-group">
										<label for="informe_cursos_v">Nombre del curso:</label>
										<input type="text" class="form-control" name="informe_cursos_v" id="informe_cursos_v" disabled>
									</div>
									<!-- Tipo Curso -->
									<div class="form-group">
										<label for="informe_modalidad_v">Modalidad del curso:</label><br>
										<input type="text" class="form-control" name="informe_modalidad_v" id="informe_modalidad_v" disabled>
									</div>
									<!-- Asistentes Curso -->
									<div class="form-group">
										<label for="informe_asistentes_v">Asistentes:</label>
										<input type="number" class="form-control" name="informe_asistentes_v" id="informe_asistentes_v" disabled>
									</div>
									<!-- Asistentes Mujeres Curso -->
									<div class="form-group">
										<label for="informe_numero_mujeres_v">Numero Mujeres:</label>
										<input type="number" class="form-control" name="informe_numero_mujeres_v" id="informe_numero_mujeres_v" disabled>
									</div>
									<!-- Asistentes Hombres Curso -->
									<div class="form-group">
										<label for="informe_numero_hombres_v">Numero Hombres:</label>
										<input type="number" class="form-control" name="informe_numero_hombres_v" id="informe_numero_hombres_v" disabled>
									</div>
									<!-- Asistentes No Binario Curso -->
									<div class="form-group">
										<label for="informe_numero_no_binario_v">No Binario:</label>
										<input type="number" class="form-control" name="informe_numero_no_binario_v" id="informe_numero_no_binario_v" disabled>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal formulario observación -->
			<div class="modal fade" id="modal-crear-observacion" tabindex="-1" role="dialog" aria-labelledby="modal-crear-observacion">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3 class="modal-title">Crear Observación</h3>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<div class="container-fluid">
								<?= form_open('', array('id' => 'formulario_crear_observacion_informe')); ?>
								<div class="col-md-12">
									<p class="tipoLeer">Realice una breve descripción de la observación para ser enviada a la organización</p>
									<div class="form-group">
										<label for="descripcion_observacion_informe_actividades">Realiza la observación:</label>
										<textarea class="form-control" name="descripcion_observacion_informe_actividades" id="descripcion_observacion_informe_actividades" required></textarea>
									</div>
								</div>
								<?= form_close(); ?>
							</div>
							<div class="modal-footer">
								<div class="btn-group" role='group' aria-label='acciones'>
									<button type="button" class="btn btn-md btn-siia" id="crear_observacion_informe">Guardar y Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


