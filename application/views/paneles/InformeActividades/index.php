<?php
/***
 * @var Docentes $docentes
 * @var Solicitudes $dolicitudes
 * @var $departamentos
 * @var $municipios
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
<!-- Tabla de cursos registrados -->
<?php if ($informes): ?>
<div class="container" id="tabla_informe_actividades">
	<div class="row">
		<div class="col-md-12" id="div_informe_cursos">
			<hr>
			<h3>Informe de actividades registrados</h3>
			<!-- Botón registrar informe -->
			<div class="btn-group pull-right">
				<button class="btn btn-siia ml-3" id="registrar_informe"><i class="fa fa-archive" aria-hidden="true"></i> Registrar informe </button>
				<button class="btn btn-info" title="Ayuda informe actividades" data-toggle='modal' data-target='#modal-ayuda-informe-actividades'>
					<i class="fa fa-question" aria-hidden="true"></i> Ayuda
				</button>
			</div>
			<br><br>
			<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
				<thead>
					<tr>
						<td>Fecha de registro</td>
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
						<td><?= $informe->created_at ?></td>
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
								<?php if ($informe->estado == 'Creado' || $informe->estado == 'Observaciones'): ?>
								<button type="button" class='btn btn-primary enviarInforme' title="Enviar Informe" data-id='<?= $informe->id_informeActividades; ?>'>
									<i class='fa fa-send' aria-hidden='true'></i>
								</button>
								<?php endif; ?>
								<button type="button" class='btn btn-info verCurso' title="Ver Detalle Curso" data-toggle='modal' data-id='<?= $informe->id_informeActividades; ?>' data-target='#modal-curso-informe'>
									<i class='fa fa-book' aria-hidden='true'></i>
								</button>
								<?php if ($informe->estado == 'Observaciones'): ?>
								<button type="button" class='btn btn-warning verObservacionesInforme' title="Ver Observaciones" data-toggle='modal' data-id='<?= $informe->id_informeActividades; ?>' data-target='#modal-observaciones-informe'>
									<i class='fa fa-eye' aria-hidden='true'></i>
								</button>
								<?php endif; ?>
								<?php if ($informe->estado != 'Aprobado' && $informe->estado != 'Observaciones' && $informe->estado != 'Enviado'): ?>
								<button type="button" class='btn btn-danger eliminar_informe_actividad' title="Eliminar curso" data-id="<?= $informe->id_informeActividades; ?>">
									<i class='fa fa-trash' aria-hidden='true'></i>
								</button>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php $this->load->view('include/partial/buttons/_back_user'); ?>
</div>
<!-- Modal observaciones informe -->
<div class="modal fade" id="modal-observaciones-informe" tabindex="-1" role="dialog" aria-labelledby="modal-observaciones-informe">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Observaciones | Informe de Actividades</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p class="tipoLeer">
					Por favor lee la observación realizada a su informe, realice la corrección indicada y envíe nuevamente dando clic en <strong>Enviar </strong><span class="spanAzul"><i class='fa fa-send' aria-hidden='true'></i></span>
				</p>
				<div class="container-fluid text-center" id="observaciones_informe_actividades">
				</div>
			</div>
		</div>
	</div>
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
				<p class="tipoLeer">
					Si los datos aquí registrado no son correctos, por favor dar clic en <strong>Eliminar  </strong><span class="spanRojo"><i class='fa fa-trash' aria-hidden='true'></i></span>
					Y vuelve a crear tu informe
				</p>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- Proceso de registro informeActividades -->
<div class="container" id="registro_informe_actividades">
	<div class="row">
		<div class="col-md-12">
			<hr>
			<button class="btn btn-info pull-right" title="Ayuda informe actividades" data-toggle='modal' data-target='#modal-ayuda-informe-actividades'>
				<i class="fa fa-question" aria-hidden="true"></i> Ayuda
			</button>
			<div id="form-0" class="form-section">
				<h3>Información para diligenciar este informe de actividades</h3><br><br>
				<div class="tipoLeer">
					<p>Por favor lea atentamente la siguiente información la cual le ayudara a diligenciar su informe de actividades:</p><br>
					<ul>
						<li>Recuerde contar con la información detallada de los asistentes y todas las especificaciones del curso impartido.</li>
						<li>Los facilitadores así como los cursos en cursos, deben estar previamente aprobados y/o acreditados por la Unidad Solidaria.</li>
						<li>Debe tener en su computador los siguientes documentos correctamente diligenciados para su respectivo cargue:</li>
							<ol>
								<li>Archivo de asistencia (Entregar en PDF Único con firmas reales) <a target="_blank" href="<?= base_url("assets/manuales/FO002_LIST_ASIST_ENTI_ACRED_USOL_V1.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a></li>
								<li>
									Archivo con el detalle de cada asistente (Excel) <a target="_blank" href="<?= base_url("assets/manuales/FO003_REGIST_GRAL_PROC_FORMAC_ENTIDAD_ACREDITADA_V1.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
									<br>Recuerde leer detenidamente las instrucciones que se encuentran en el archivo excel, de ello dependerá que sea cargada correctamente la información de los asistentes al curso impartido.
								</li>
							</ol>
						<li>Recuerde diligenciar y verificar toda la información suministrada antes de finalizar.</li>
					</ul>
				</div>
			</div>
			<!-- Titulo sección -->
			<h3 class="title-form" style="display: none">Informe de actividades</h3>
			<br>
			<!-- Barra de progreso -->
			<div class="progress">
				<div id="progress-bar" class="progress-bar " role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
			</div>
			<br>
			<!-- Formulario informe de actividades -->
			<div id="form-50" class="form-section" style="display: none;">
				<h4>Información del curso impartido:</h4>
				<div class="clearfix"></div>
				<hr />
				<?= form_open('', array('id' => 'formulario_informe_actividades')); ?>
				<div class="col-md-6">
					<!-- Fecha de inicio -->
					<div class="form-group">
						<label for="informe_fecha_incio">Fecha de inicio</label>
						<input type="date" class="form-control" name="informe_fecha_incio" id="informe_fecha_incio" required>
					</div>
					<!-- Fecha de fin -->
					<div class="form-group">
						<label for="informe_fecha_fin">Fecha de finalización</label>
						<input type="date" class="form-control" name="informe_fecha_fin" id="informe_fecha_fin" required>
					</div>
					<!-- Departamentos -->
					<div class="form-group">
						<label for="informe_departamento_curso">Departamento*</label>
						<br>
						<select name="informe_departamento_curso" id="informe_departamento_curso" data-id-dep="4" class="selectpicker form-control show-tick departamentos" required="">
							<?php foreach ($departamentos as $departamento): ?>
								<option id="<?= $departamento->id_departamento ?>" value="<?= $departamento->nombre ?>"><?= $departamento->nombre ?></option>
							<?php endforeach;?>
						</select>
					</div>
					<!-- Municipios -->
					<div class="form-group">
						<div id="div_municipios4">
							<label for="informe_municipio_curso">Municipio:*</label>
							<br>
							<select name="informe_municipio_curso" id="informe_municipio_curso" class="selectpicker form-control show-tick" required="">
								<?php foreach ($municipios as $municipio) : ?>
									<option id="<?= $municipio->id_municipio ?>" value="<?= $municipio->nombre ?>"><?= $municipio->nombre ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!-- Duración Curso -->
					<div class="form-group">
						<label for="informe_duracion_curso">Duracion del Curso: <small>Horas</small></label>
						<input type="number" name="informe_duracion_curso" class="form-control" id="informe_duracion_curso" min="20" placeholder="20" required>
					</div>
					<!-- Docente -->
					<div class="form-group">
						<label for="informe_docente">Docente:</label><br>
						<select name="informe_docente" id="informe_docente" class="selectpicker form-control show-tick" required>
							<?php foreach ($docentes as $docente): ?>
								<option id='<?= $docente->id_docente ?>' value='<?= $docente->id_docente ?>'>
									<?= $docente->primerNombreDocente ?>  <?= $docente->primerApellidoDocente ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<!-- Intencionalidad Curso -->
					<div class="form-group">
						<label for="informe_intencionalidad_curso">Intencionalidad del Curso:</label><br>
						<select name="informe_intencionalidad_curso" id="informe_intencionalidad_curso" class="selectpicker form-control show-tick" required multiple>
							<option value="1">Promoción</option>
							<option value="2">Creación</option>
							<option value="3">Fortalecimiento</option>
							<option value="4">Desarrollo</option>
							<option value="5">Integración</option>
							<option value="6">Protección</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<!-- Curso -->
					<div class="form-group">
						<label for="informe_cursos">Nombre del curso:</label>
						<select name="informe_cursos" id="informe_cursos" class="selectpicker form-control show-tick" required multiple>
							<option value="1">Acreditación Curso Básico de Economía Solidaria</option>
							<option value="2">Aval de Trabajo Asociado</option>
							<option value="3">Acreditación Curso Medio de Economía Solidaria</option>
							<option value="4">Acreditación Curso Avanzado de Economía Solidaria</option>
							<option value="5">Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria</option>
						</select>
					</div>
					<!-- Tipo Curso -->
					<div class="form-group">
						<label for="informe_modalidad">Modalidad del curso:</label><br>
						<select name="informe_modalidad" id="informe_modalidad" class="selectpicker form-control show-tick" required="" multiple>
							<option value="1">Presencial</option>
							<option value="2">Virtual</option>
							<option value="3">En Linea</option>
						</select>
					</div>
					<!-- Asistentes Curso -->
					<div class="form-group">
						<label for="informe_asistentes">Asistentes:</label>
						<input type="number" class="form-control" name="informe_asistentes" id="informe_asistentes" value="35" disabled>
					</div>
					<!-- Asistentes Mujeres Curso -->
					<div class="form-group">
						<label for="informe_numero_mujeres">Numero Mujeres:</label>
						<input type="number" class="form-control" name="informe_numero_mujeres" id="informe_numero_mujeres" value="13" required>
					</div>
					<!-- Asistentes Hombres Curso -->
					<div class="form-group">
						<label for="informe_numero_hombres">Numero Hombres:</label>
						<input type="number" class="form-control" name="informe_numero_hombres" id="informe_numero_hombres" value="12" required>
					</div>
					<!-- Asistentes No Binario Curso -->
					<div class="form-group">
						<label for="informe_numero_no_binario">No Binario:</label>
						<input type="number" class="form-control" name="informe_numero_no_binario" id="informe_numero_no_binario" value="10" required>
					</div>
				</div>
				<?= form_close(); ?>
				<div class="clearfix"></div>
				<hr />
			</div>
			<!-- Formulario cargar archivos de informe  -->
			<div id="form-100" class="form-section" style="display: none;">
				<h4>Cargar archivo con los asistentes:</h4>
				<div class="clearfix"></div>
				<hr />
				<div class="col-md-6">
					<p>El archivo de asistencia del curso debe estar en formato único pdf. (Se requiere solo un archivo si son varios archivos por favor unirlos en uno solo para hacer una consolidación de la asistencia)</p>
				</div>
				<?= form_open('', array('id' => 'formulario_archivo_informe_actividades')); ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Archivo de Asistencia del curso:</label>
						<input type="file" class="form-control archivoAsistencia" accept="application/pdf" name="archivoPdfAsistencia" id="archivoPdfAsistencia" data-name="archivoPdfAsistencia" required>
					</div>
				</div>
				<?= form_close(); ?>
				<div class="clearfix"></div>
				<hr />
			</div>
			<div id="form-150" class="form-section" style="display: none;">
				<h3>¡Información cargada con éxito!</h3><br><br>
				<div class="tipoLeer">
					<p>La información ha sido cargada con éxito, por favor recuerde revisar que la información coincida con lo registrado.</p>
					<p>A continuación debe diligenciar los asistentes a este curso, los cuales deben coincidir con la cantidad registrada anteriormente: <strong id="cantidadAsistentes"></strong></p>
					<br>
					<div class="text-center">
						<button class="btn btn-success verAsistentes" id="registrarAsistentes"><i class="fa fa-user-circle" aria-hidden="true"></i> Registrar Asistentes</button>
					</div>
					<br>
				</div>
				<br>
				<button class="btn btn-siia" id="reload"><i class="fa fa-window-restore" aria-hidden="true"></i> Volver</button>
			</div>
			<button class="btn btn-siia" id="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
			<button class="btn btn-siia" id="forward">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			<br><br>
		</div>
	</div>
</div>
<!-- Modal ayuda informe de actividades -->
<div class="modal fade" id="modal-ayuda-informe-actividades" tabindex="-1" role="dialog" aria-labelledby="modal-ayuda-informe-actividades">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ayuda Informe de actividad</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<iframe src="https://scribehow.com/embed/Informe_de_actividades__tvG455w0QlORuB3Q6dL0Ww?as=video" width="100%" height="540" allowfullscreen frameborder="0"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
