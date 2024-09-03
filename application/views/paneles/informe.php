<?php
/***
 * @var $docentes
 * @var Solicitudes $dolicitudes
 * @var $departamentos
 */
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		var progress = 0;
		function updateProgressBar(value) {
			if(value === 0) {
				$('#back').attr('disabled', true);
				$('#title-form').hide();
			}
			else if(value === 100) {
				$('#forward').attr('disabled', true);
			}
			else {
				$('#back').attr('disabled', false);
				$('#forward').attr('disabled', false);
				$('#title-form').show();
			}
			$('#progress-bar').css('width', value + '%').attr('aria-valuenow', value).text(value + '%');
			$('.form-section').hide(); // Ocultar todos los formularios
			$('#form-' + value).show(); // Mostrar el formulario correspondiente
		}

		$('#forward').click(function() {
			if (progress < 100) {
				progress += 50;
				updateProgressBar(progress);
			}
		});

		$('#back').click(function() {
			if (progress > 0) {
				progress -= 50;
				updateProgressBar(progress);
			}
		});
	});
</script>
<hr />
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="form-0" class="form-section">
				<h3>Información para diligenciar este informe de actividades</h3><br><br>
				<div class="tipoLeer">
					<p>Por favor lea atentamente la siguiente información la cual le ayudara a diligenciar su informe de actividades:</p><br>
					<ul>
						<li>Recuerde contar con la información detallada de los asistentes y todas las especificaciones del curso impartido.</li>
						<li>Los facilitadores así como los cursos en cursos, deben estar previamente aprobados y/o acreditados por la Unidad Solidaria.</li>
						<li>Debe tener en su computador los siguientes documentos correctamente diligenciados para su respectivo cargue:</li>
							<ol>
								<li>Archivo de asistencia (PDF Único)</li>
								<li>Archivo con el detalle de cada asistente (Excel) <a target="_blank" href="<?php echo base_url("assets/manuales/AsistentesCursosOrganizacion.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a></li>
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
			<div id="form-50" class="form-section" style="display: none;">
				<h4>Información del curso impartido:</h4>
				<div class="clearfix"></div>
				<hr />
				<div class="col-md-6">
					<!-- Curso -->
					<div class="form-group">
						<label for="informe_nombre_curso">Nombre del curso:</label>
						<input type="text" class="form-control" name="informe_nombre_curso" id="informe_nombre_curso" placeholder="Nombre del curso">
					</div>
					<!-- Tipo Curso -->
					<div class="form-group">
						<label for="informe_tipo_curso">Modalidad del curso:</label><br>
						<select name="informe_tipo_curso" id="informe_tipo_curso" class="selectpicker form-control show-tick" required="">
							<?php
							foreach ($tiposCursos as $tiposCurso) {
								?>
								<option id="<?php echo $tiposCurso->id_tiposCursoInformes; ?>" value="<?php echo $tiposCurso->nombre; ?>"><?php echo $tiposCurso->nombre; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<!-- Intencionalidad Curso -->
					<div class="form-group">
						<label for="informe_intencionalidad_curso">Intencionalidad del Curso:</label><br>
						<select name="informe_intencionalidad_curso" id="informe_intencionalidad_curso" class="selectpicker form-control show-tick" required="">
							<option id="1" value="Fortalecimiento">Fortalecimiento</option>
							<option id="2" value="Creación">Creación</option>
						</select>
					</div>
					<div class="form-group">
						<label for="unionOrg">Unión?:</label>
						<br>
						<select name="unionOrg" id="unionOrg" class="selectpicker form-control show-tick" required="">
							<optgroup label="No union">
								<option id="0" value="No" selected>No, sin unión...</option>
							</optgroup>
							<optgroup label="Organizaciones">
								<!-- //TODO: Cambiar por organizaciones acreditadas -->
								<?php
								foreach ($organizaciones as $organizacion) {
									?>
									<option id="<?php echo $organizacion->nombreOrganizacion; ?>" value="<?php echo $organizacion->nombreOrganizacion; ?>"><?php echo $organizacion->nombreOrganizacion; ?></option>
									<?php
								}
								?>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="informe_duracion_curso">Duracion del Curso: <small>Horas</small></label>
						<input type="number" name="informe_duracion_curso" class="form-control" id="informe_duracion_curso" min="20" value="20">
					</div>
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
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>¿El curso fue gratis?:</label>
						<div class="radio">
							<label><input type="radio" name="gratisCurso" id="gratisCurso1" class="" value="1">Sí</label>
							<label><input type="radio" name="gratisCurso" id="gratisCurso2" class="" value="0" checked>No</label>
						</div>
					</div>
					<div class="form-group">
						<label for="informe_docente">Docente:</label><br>
						<select name="informe_docente" id="informe_docente" class="selectpicker form-control show-tick" required="">
							<?php
							foreach ($docentes as $docente) {
								echo "<option id='$docente->id_docente' value='$docente->id_docente'>$docente->primerNombreDocente $docente->primerApellidoDocente</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="informe_fecha_curso">Fecha del Curso</label>
						<input type="date" class="form-control" name="informe_fecha_curso" id="informe_fecha_curso">
					</div>
					<div class="form-group">
						<label for="informe_asistentes">Asistentes:</label>
						<input type="number" class="form-control" name="informe_asistentes" id="informe_asistentes" placeholder="25">
					</div>
					<div class="form-group">
						<label for="informe_numero_mujeres">Numero Mujeres:</label>
						<input type="number" class="form-control" name="informe_numero_mujeres" id="informe_numero_mujeres" placeholder="13">
					</div>
					<div class="form-group">
						<label for="informe_numero_hombres">Numero Hombres:</label>
						<input type="number" class="form-control" name="informe_numero_hombres" id="informe_numero_hombres" placeholder="12">
					</div>
					<button class="btn btn-siia pull-right" id="guardar_curso_informe">Crear Curso <i class="fa fa-check" aria-hidden="true"></i></button>
				</div>
				<div class="clearfix"></div>
				<hr />
			</div>
			<div id="form-100" class="form-section" style="display: none;">
				<h4>Cargar archivo con los asistentes:</h4>
				<div class="clearfix"></div>
				<hr />
				<div class="col-md-6">
					<p>El archivo de asistencia del curso debe estar en formato único pdf. (Se requiere solo un archivo si son varios archivos por favor unirlos en uno solo para hacer una consolidación de la asistencia)</p>
					<p>Para ingresar los asistentes de forma automática en excel debe diligenciar el siguiente <a target="_blank" href="<?php echo base_url("assets/manuales/AsistentesCursosOrganizacion.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a> en excel, o si ya lo diligencio, seleccione el archivo y de click en subir asistentes.</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Archivo de Asistencia del curso:</label>
						<input type="file" class="form-control archivoAsistencia" accept="application/pdf" name="archivoExcelAsistencia" id="archivoExcelAsistencia" data-name="archivoExcelAsistencia" required>
					</div>
					<div class="form-group">
						<label>Archivo de Asistentes:</label>
						<input type="file" class="form-control archivoAsistentes" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="archivoExcelAsistentes" id="archivoExcelAsistentes" data-name="archivoExcelAsistentes" required>
					</div>
					<button class="btn btn-siia" id="guardarArchivoAsistentes">Subir archivos <i class="fa fa-check" aria-hidden="true"></i></button>
				</div>
				<div class="clearfix"></div>
				<hr />
			</div>
			<button class="btn btn-siia" id="back" disabled><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
			<button class="btn btn-siia" id="forward">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			<br><br>
		</div>
	</div>
</div>

<!-- Tabla de cursos registrados -->
<div class="container" style="display: none">
	<div class="row">
		<div class="col-md-12" id="div_informe_cursos">
			<hr>
			<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
				<thead>
				<tr>
					<td>Docente</td>
					<td>Nombre Curso</td>
					<td>Modalidad</td>
					<td>Intencionalidad Curso</td>
					<td>Duración Curso</td>
					<td>Asistentes</td>
					<td>Número Mujeres</td>
					<td>Número Hombres</td>
					<td>¿Curso Gratis?</td>
					<td>Departamento</td>
					<td>Municipio</td>
					<td>Archivo</td>
					<td>Accion</td>
				</tr>
				</thead>
				<tbody id="tbody">
				<?php
				foreach ($cursos[0] as $curso) {
					echo "<tr><td>$curso->nombreDocente</td>";
					echo "<td>$curso->nombreCurso</td>";
					echo "<td>$curso->tipoCurso</td>";
					echo "<td>$curso->intencionalidadCurso</td>";
					echo "<td>$curso->duracionCurso</td>";
					echo "<td>$curso->numeroAsistentes</td>";
					echo "<td>$curso->numeroMujeres</td>";
					echo "<td>$curso->numeroHombres</td>";
					if ($curso->cursoGratis == '0') {
						echo "<td>No</td>";
					} else if ($curso->cursoGratis == '1') {
						echo "<td>Si</td>";
					}
					echo "<td>$curso->departamentoCurso</td>";
					echo "<td>$curso->municipioCurso</td>";
					if ($curso->archivoAsistentes != null) {
						echo "<td><a href='" . base_url("uploads/asistentes/" . $curso->archivoAsistentes . "") . "'<button class='btn btn-siia'>Ver archivo <i class='fa fa-bars' aria-hidden='true'></i></button></a></td>";
					} else {
						echo "<td>Ninguno</td>";
					}
					echo "<td><button class='btn btn-siia verCurso' data-toggle='modal' data-nombre='$curso->nombreCurso' data-id='$curso->id_informeActividades' data-target='#verCurso'>Ver Asistentes <i class='fa fa-eye' aria-hidden='true'></i></button></td></tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
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
