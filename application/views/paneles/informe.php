<?php
/***
 * @var Docentes $docentes
 * @var Solicitudes $dolicitudes
 * @var $departamentos
 * @var $municipios
 * @var InformeActividadesModel $informes
 */
?>
<!-- jQuery primero, luego Popper.js, luego Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/functions/user/informe-actividades.js?v=1.0') . time() ?>" type="text/javascript"></script>
<div class="container" id="registro_informe_actividades" <?php if($informes): ?> style="display: none" <?php endif; ?>>
	<div class="row">
		<div class="col-md-12">
			<hr>
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
								<li>Archivo con el detalle de cada asistente (Excel) <a target="_blank" href="<?= base_url("assets/manuales/FO003_REGIST_GRAL_PROC_FORMAC_ENTIDAD_ACREDITADA_V1.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a></li>
							</ol>
						<li>Recuerde diligenciar y verificar toda la información suministrada antes de finalizar.</li>
					</ul>
				</div>
			</div>
			<h3 id="title-form" style="display: none">Informe de actividades</h3>
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
				<?php echo form_open('', array('id' => 'formulario_informe_actividades')); ?>
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
							<?php
							foreach ($departamentos as $departamento) {
								?>
								<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<!-- Municipios -->
					<div class="form-group">
						<div id="div_municipios4">
							<label for="informe_municipio_curso">Municipio:*</label>
							<br>
							<select name="informe_municipio_curso" id="informe_municipio_curso" class="selectpicker form-control show-tick" required="">
								<?php
								foreach ($municipios as $municipio) {
									?>
									<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
									<?php
								}
								?>
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
							<?php
							foreach ($docentes as $docente):
										echo "<option id='$docente->id_docente' value='$docente->id_docente'>$docente->primerNombreDocente $docente->primerApellidoDocente</option>";
							endforeach;
							?>
						</select>
					</div>
					<!-- Intencionalidad Curso -->
					<div class="form-group">
						<label for="informe_intencionalidad_curso">Intencionalidad del Curso:</label><br>
						<select name="informe_intencionalidad_curso" id="informe_intencionalidad_curso" class="selectpicker form-control show-tick" required multiple>
							<option value="1">Fortalecimiento</option>
							<option value="2">Creación</option>
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
				<?php echo form_close(); ?>
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
					<p>Para ingresar los asistentes de forma automática en excel debe diligenciar el siguiente <a target="_blank" href="<?php echo base_url("assets/manuales/AsistentesCursosOrganizacion.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a> en excel, o si ya lo diligencio, seleccione el archivo y de click en subir asistentes.</p>
				</div>
				<?php echo form_open('', array('id' => 'formulario_archivos_informe_actividades')); ?>
				<div class="col-md-6">
					<div class="form-group">
						<label>Archivo de Asistencia del curso:</label>
						<input type="file" class="form-control archivoAsistencia" accept="application/pdf" name="archivoPdfAsistencia" id="archivoPdfAsistencia" data-name="archivoPdfAsistencia" required>
					</div>
					<div class="form-group">
						<label for="archivoExcelAsistentes">Archivo de Asistentes:</label>
						<input type="file" class="form-control archivoAsistentes" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="archivoExcelAsistentes" id="archivoExcelAsistentes" data-name="archivoExcelAsistentes" required>
					</div>
				</div>
				<?php echo form_close(); ?>
				<div class="clearfix"></div>
				<hr />
			</div>
			<div id="form-150" class="form-section" style="display: none;">
				<h3>¡Información cargada con éxito!</h3><br><br>
				<div class="tipoLeer">
					<p>La información ha sido cargada con éxito, por favor recuerde revisar que la información coincida con lo registrado. Gracias por su participación. </p><br><br>
				</div>
				<button class="btn btn-siia mt-6" id="reload" style="display: none">Volver</button>
			</div>
			<button class="btn btn-siia" id="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
			<button class="btn btn-siia" id="forward">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			<br><br>
		</div>
	</div>
</div>
<?php if ($informes): ?>
<!-- Tabla de cursos registrados -->
<div class="container" id="tabla_informe_actividades">
	<div class="row">
		<div class="col-md-12" id="div_informe_cursos">
			<hr>
			<h3 id="title-form">Informe de actividades registrados</h3>
			<button class="btn btn-siia pull-right" id="registrar_informe"><i class="fa fa-archive" aria-hidden="true"></i> Registrar informe </button>
			<br>
			<br>
			<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
				<thead>
					<tr>
						<td>Fecha de inicio</td>
						<td>Fecha de finalización</td>
						<td>Ciudad</td>
						<td>Duración</td>
						<td>Intencionalidad</td>
						<td>Cursos</td>
						<td>Modalidades</td>
						<td>Total Asistentes</td>
						<td>Archivos</td>
						<td>Acciones</td>
					</tr>
				</thead>
				<tbody id="tbody">
					<?php foreach ($informes as $informe): ?>
					<tr>
						<td><?= $informe->fechaInicio ?></td>
						<td><?= $informe->fechaFin ?></td>
						<td><?= $informe->municipio ?></td>
						<td><?= $informe->duracion ?></td>
						<td><?= $informe->intencionalidad ?></td>
						<td><?= $informe->cursos ?></td>
						<td><?= $informe->modalidades ?></td>
						<td><?= $informe->totalAsistentes ?></td>
						<td>
							<div class="btn-group-vertical" role="group" >
							<a type="button" class='btn btn-success' href="<?= base_url("uploads/asistentes/" . $informe->archivoAsistentes) ?>">
								<i class='fa fa-file-excel-o' aria-hidden='true'></i>
							</a>
							<a type="button" class='btn btn-danger' href="<?= base_url("uploads/asistentes/" . $informe->archivoAsistencia) ?>">
								<i class='fa fa-file-pdf-o' aria-hidden='true'></i>
							</a>
							</div>
						</td>
						<td>
							<div class="btn-group-vertical" role="group" >
								<button type="button" class='btn btn-info verCurso' id="editar_informe_actividad" data-toggle='modal' data-nombre='<?= $informe->nombreCurso ?>' data-id='<?= $informe->id_informeActividades ?>' data-target='#verCurso'>
									<i class='fa fa-edit' aria-hidden='true'></i>
								</button>
								<button type="button" class='btn btn-danger' id="eliminar_informe_actividad">
									<i class='fa fa-trash' aria-hidden='true'></i>
								</button>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>


<!-- Modal ver cursos -->
<div class="modal fade" id="verCurso" tabindex="-1" role="dialog" aria-labelledby="vercurso">
	<div class="modal-dialog" role="document" style="width: 100%;">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="vercurso">Asistentes de: <label id="modal_vercurso_nombre"></label> </h3>
			</div>
			<div class="modal-body">
				<table id="tabla_asistentes_curso" width="100%" border=0 class="table table-striped table-bordered">
					<thead>
						<tr>
							<td><label>Primer Nombre</label></td>
							<td><label>Primer Apellido</label></td>
							<td><label>Tipo de Documento</label></td>
							<td><label>Número de Documento</label></td>
							<td><label>Proceso Beneficio</label></td>
							<td><label>Fecha de Finalización</label></td>
							<td><label>Edad</label></td>
							<td><label>Dirección Correo Electrónico</label></td>
							<td><label>Dirección</label></td>
							<td><label>Género</label></td>
							<td><label>Certificado</label></td>
						</tr>
					</thead>
					<tbody id="tbody_asistentes_curso">
					</tbody>
				</table>
				<div class="clearfix"></div>
				<hr />
				<div id="editarAsistenteDiv">
					<div class="container">
						<div class="row">
							<h4>Editando información de asistente: <small>Para el certificado</small></h4>
							<div class="col-md-6">
								<label class="hidden">ID: <span id="EdasisID"></span></label>
								<div class="form-group">
									<label for="editarAsisPN">Primer Nombre</label>
									<input type="text" class="form-control" id="editarAsisPN">
								</div>
								<div class="form-group">
									<label for="editarAsisSN">Segundo Nombre</label>
									<input type="text" class="form-control" id="editarAsisSN">
								</div>
								<div class="form-group">
									<label for="editarAsisPA">Primer Apellido</label>
									<input type="text" class="form-control" id="editarAsisPA">
								</div>
								<div class="form-group">
									<label for="editarAsisSA">Segundo Apellido</label>
									<input type="text" class="form-control" id="editarAsisSA">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tipo de Documento:</label><br>
									<select name="editarAsisTipo" id="editarAsisTipo" class="selectpicker form-control show-tick">
										<option id="1" value="CC">Cédula de Ciudadania</option>
										<option id="2" value="TI">Tarjeta de Identidad</option>
										<option id="3" value="CE">Cédula de Extranjeria</option>
										<option id="4" value="PS">Pasaporte</option>
									</select>
								</div>
								<div class="form-group">
									<label for="editarAsisNumero">Número de Documento</label>
									<input type="number" class="form-control" id="editarAsisNumero">
								</div>
								<div class="form-group">
									<label for="editarAsisDireccion">Dirección Correo Electrónico</label>
									<input type="email" class="form-control" id="editarAsisDireccion">
								</div>
								<button class="btn btn-siia" id="actualizarAsistente">Actualizar Asistente <i class="fa fa-check" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger informe_restaurar">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>

<!--<div class="form-group">-->
<!--	<label for="unionOrg">Unión?:</label>-->
<!--	<br>-->
<!--	<select name="unionOrg" id="unionOrg" class="selectpicker form-control show-tick" required="">-->
<!--		<optgroup label="No union">-->
<!--			<option id="0" value="No" selected>No, sin unión...</option>-->
<!--		</optgroup>-->
<!--		<optgroup label="Organizaciones">-->
<!--			--><?php
//			foreach ($organizaciones as $organizacion) {
//				?>
<!--				<option id="--><?php //echo $organizacion->nombreOrganizacion; ?><!--" value="--><?php //echo $organizacion->nombreOrganizacion; ?><!--">--><?php //echo $organizacion->nombreOrganizacion; ?><!--</option>-->
<!--				--><?php
//			}
//			?>
<!--		</optgroup>-->
<!--	</select>-->
<!--</div>-->
<!--<div class="form-group">-->
<!--	<label>¿El curso fue gratis?:</label>-->
<!--	<div class="radio">-->
<!--		<label><input type="radio" name="gratisCurso" id="gratisCurso1" class="" value="1">Sí</label>-->
<!--		<label><input type="radio" name="gratisCurso" id="gratisCurso2" class="" value="0" checked>No</label>-->
<!--	</div>-->
<!--</div>-->

