<?php
/***
 * @var $asistentes
 * @var $curso
 * @var $departamentos
 * @var $municipios
 */
$CI = &get_instance();
$CI->load->model("AsistentesModel");
//echo "<pre>";
//var_dump($curso);
//echo "</pre>";
//die();
?>
<!-- jQuery primero, luego Popper.js, luego Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/functions/user/asistentes.js?v=1.0') . time() ?>" type="text/javascript"></script>
<!-- Variables PHP -->
<script>
	var curso_id = '<?=$curso->id_informeActividades?>';
</script>
<div class="container" id="tabla_informe_actividades">
	<div class="row">
		<div class="col-md-12" id="div_informe_cursos">
			<hr>
			<h3 id="title-form">Informe de actividades registrados</h3>
			<!-- Botón registrar asistentes curso -->
			<div class="from-group btn-group pull-right" role="group">
				<button class="btn btn-outline-success ml-3" data-toggle='modal' data-target='#modal-excel-asistentes'>
					<i class="fa fa-file-excel-o" aria-hidden="true"></i> Cargar asistentes masivamente
				</button>
				<button class="btn btn-outline-primary asistente-modal" data-funct='crear' data-toggle='modal' data-target='#modal-asistente-curso'>
					<i class="fa fa-user-circle" aria-hidden="true"></i> Crear asistente
				</button>
			</div>
			<br><br>
			<!-- Asistentes Cursos -->
			<table id="tabla_asistentes_curso" width="100%" border=0 class="table table-striped table-bordered">
				<thead>
					<tr>
						<td><label>Primer Nombre</label></td>
						<td><label>Primer Apellido</label></td>
						<td><label>Número de Documento</label></td>
						<td><label>Ciudad</label></td>
						<td><label>Edad</label></td>
						<td><label>Genero</label></td>
						<td><label>Escolaridad</label></td>
						<td><label>Discapacidad</label></td>
						<td><label>Vulnerabilidad</label></td>
						<td><label>Acciones</label></td>
					</tr>
				</thead>
				<tbody id="tbody_asistentes_curso">
				<?php foreach ($asistentes as $asistente): ?>
					<tr>
						<td><?= $asistente->primerNombreAsistente; ?></td>
						<td><?= $asistente->primerApellidoAsistente; ?></td>
						<td><?= $asistente->numeroDocumentoAsistente; ?></td>
						<td><?= $asistente->departamentoResidencia; ?></td>
						<td><?= $asistente->edad; ?></td>
						<td><?= $asistente->genero; ?></td>
						<td><?= $asistente->escolaridad; ?></td>
						<td><?= $asistente->discapacidad; ?></td>
						<td><?= $asistente->condicionVulnerabilidad; ?></td>
						<td>
							<div class="btn-group-vertical" role="group" >
								<button type="button" class='btn btn-primary asistente-modal' title="Editar asistente" data-toggle='modal' data-funct='actualizar' data-id='<?= $asistente->id_asistentes ?>' data-target='#modal-asistente-curso'>
									<i class='fa fa-edit' aria-hidden='true'></i>
								</button>
								<button type="button" class='btn btn-danger eliminar_asistente' title="Eliminar asistente" data-id='<?= $asistente->id_asistentes ?>'>
									<i class='fa fa-trash-o' aria-hidden='true'></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Modal formulario cargar excel asistente -->
	<div class="modal fade" id="modal-excel-asistentes" tabindex="-1" role="dialog" aria-labelledby="modal-excel-asistentes">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Cargar masivamente asistentes al curso</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?= form_open('', array('id' => 'formulario_archivo_excel_asistentes')); ?>
						<div class="col-md-12">
							<p>Para ingresar los asistentes de forma automática en excel debe diligenciar el siguiente
								<a target="_blank" href="<?php echo base_url("assets/manuales/FO003_REGIST_GRAL_PROC_FORMAC_ENTIDAD_ACREDITADA_V1.xlsx"); ?>">
									FORMATO<i class="fa fa-file-excel-o" aria-hidden="true"></i>.
								</a>Si ya lo diligencio, seleccione el archivo y de clic en <strong>cargar archivo</strong>.
								Recuerde diligenciar muy bien cada dato solicitado en este archivo, de ello dependerá que la información de cada participante en el curso se registre correctamente en el sistema.</p>
							<div class="form-group">
								<label for="archivoExcelAsistentes">Archivo de Asistentes:</label>
								<input type="file" class="form-control archivoAsistentes" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="archivoExcelAsistentes" id="archivoExcelAsistentes" data-name="archivoExcelAsistentes" required>
							</div>
						</div>
						<?= form_close(); ?>
					</div>
					<div class="modal-footer">
						<div class="btn-group" role='group' aria-label='acciones'>
							<button type="button" class="btn btn-md btn-siia" id="cargar_archivo_excel_asistentes">Cargar archivo</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal formulario asistente -->
	<div class="modal fade" id="modal-asistente-curso" tabindex="-1" role="dialog" aria-labelledby="modal-asistente-curso">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="title-modal-asistentes"></h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<?= form_open('', array('id' => 'formulario_asistente')); ?>
						<div class="col-md-12">
							<div class="form-group">
								<label for="numeroDocumentoAsistente">Número documento</label>
								<input type="number" class="form-control" id="numeroDocumentoAsistente" name="numeroDocumentoAsistente" required>
							</div>
						</div>
						<div class="col-md-6">
							<!-- Primer Nombre -->
							<div class="form-group">
								<label for="primerNombreAsistente">Primer Nombre</label>
								<input type="text" class="form-control" id="primerNombreAsistente" name="primerNombreAsistente" required>
							</div>
							<!-- Segundo Nombre -->
							<div class="form-group">
								<label for="segundoNombreAsistente">Segundo Nombre</label>
								<input type="text" class="form-control" id="segundoNombreAsistente" name="segundoNombreAsistente">
							</div>
							<!-- Primer Apellido -->
							<div class="form-group">
								<label for="primerApellidoAsistente">Primer Apellido</label>
								<input type="text" class="form-control" id="primerApellidoAsistente" name="primerApellidoAsistente" required>
							</div>
							<!-- Segundo Apellido -->
							<div class="form-group">
								<label for="segundoApellidoAsistentes">Segundo Apellido</label>
								<input type="text" class="form-control" id="segundoApellidoAsistentes" name="segundoApellidoAsistente">
							</div>
							<!-- NIT Organización -->
							<div class="form-group">
								<label for="numNITOrganizacion">NIT Organización</label>
								<input type="number" class="form-control" id="numNITOrganizacion" name="numNITOrganizacion">
							</div>
							<!-- Nombre Organización -->
							<div class="form-group">
								<label for="nombreOrganizacion">Nombre Organización</label>
								<input type="text" class="form-control" id="nombreOrganizacion" name="nombreOrganizacion">
							</div>
							<!-- Departamentos -->
							<div class="form-group">
								<label for="informe_departamento_curso">Departamento*</label>
								<br>
								<select name="informe_departamento_curso" id="informe_departamento_curso" data-id-dep="4" class="form-control show-tick departamentos" required="">
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
									<select name="informe_municipio_curso" id="informe_municipio_curso" class="form-control show-tick" required="">
										<?php foreach ($municipios as $municipio) : ?>
											<option id="<?= $municipio->id_municipio ?>" value="<?= $municipio->nombre ?>"><?= $municipio->nombre ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<!-- Teléfono -->
							<div class="form-group">
								<label for="telefono">Teléfono</label>
								<input type="number" class="form-control" id="telefono" name="telefono">
							</div>
							<!-- Correo -->
							<div class="form-group">
								<label for="correoElectronico">Dirección Correo Electrónico</label>
								<input type="email" class="form-control" id="correoElectronico" name="correoElectronico">
							</div>
							<!-- Edad -->
							<div class="form-group">
								<label for="edad">Edad</label>
								<input type="number" pattern="\d{2}" class="form-control" id="edad" name="edad" maxlength="2" required>
							</div>
							<!-- Genero -->
							<div class="form-group">
								<label for="genero">Genero</label><br>
								<select name="genero" id="genero" class="form-control show-tick" required>
									<option value="Masculino">Masculino</option>
									<option value="Femenino">Femenino</option>
									<option value="No Binario">No Binario</option>
								</select>
							</div>
							<!-- Escolaridad -->
							<div class="form-group">
								<label for="escolaridad">Escolaridad</label><br>
								<select name="escolaridad" id="escolaridad" class="form-control show-tick" required>
									<option value="PREESCOLAR">PREESCOLAR</option>
									<option value="BÁSICA PRIMARIA">BÁSICA PRIMARIA</option>
									<option value="BÁSICA SECUNDARIA">BÁSICA SECUNDARIA</option>
									<option value="PREGRADO">PREGRADO</option>
									<option value="POSGRADO EN EL NIVEL DE ESPECIALIZACIÓN">POSGRADO EN EL NIVEL DE ESPECIALIZACIÓN</option>
									<option value="POSGRADO EN EL NIVEL DE MAESTRÍA">POSGRADO EN EL NIVEL DE MAESTRÍA</option>
									<option value="POSGRADO EN EL NIVEL DE DOCTORADO">POSGRADO EN EL NIVEL DE DOCTORADO</option>
									<option value="NINGUNO" selected>NINGUNO</option>
								</select>
							</div>
							<!-- Enfoque Diferencial -->
							<div class="form-group">
								<label for="enfoqueDiferencial">Enfoque Diferencial</label><br>
								<select name="enfoqueDiferencial" id="enfoqueDiferencial" class="form-control show-tick" required>
									<option value="INDIGENAS">INDIGENAS</option>
									<option value="NARP">NARP</option>
									<option value="ROM">ROM</option>
									<option value="NINGUNO" selected>NINGUNO</option>
								</select>
							</div>
							<!-- Condición Vulnerabilidad -->
							<div class="form-group">
								<label for="condicionVulnerabilidad">Condición Vulnerabilidad</label><br>
								<select name="condicionVulnerabilidad" id="condicionVulnerabilidad" class="form-control show-tick" required>
									<option value="DESPLAZADO">DESPLAZADO</option>
									<option value="VICTIMA">VICTIMA</option>
									<option value="REINCORPORADO">REINCORPORADO</option>
									<option value="POBREZA EXTREMA">POBREZA EXTREMA</option>
									<option value="NINGUNO" selected>NINGUNO</option>
								</select>
							</div>
							<!-- Discapacidad -->
							<div class="form-group">
								<label for="discapacidad">Discapacidad</label><br>
								<select name="discapacidad" id="discapacidad" class="form-control show-tick" required>
									<option value="AUDITIVA">AUDITIVA</option>
									<option value="FÍSICA">FÍSICA</option>
									<option value="VISUAL">VISUAL</option>
									<option value="MULTIPLE">MULTIPLE</option>
									<option value="NINGUNO" selected>NINGUNO</option>
								</select>
							</div>
						</div>
						<?= form_close(); ?>
					</div>
					<div class="modal-footer">
						<div class="btn-group" role='group' aria-label='acciones'>
							<button class="btn btn-siia" id="guardarAsistente"></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('include/partial/buttons/_back_user'); ?>
</div>
