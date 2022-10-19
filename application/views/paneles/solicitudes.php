<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<?php if($solicitudes == null || $solicitudes == ""):?>
				<!-- Tarjeta si no existe información en formulario 1 -->
				<div class="col-lg-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Información general:</h4>
							<p class="card-description">Por favor primero llene el formulario número 1 de <strong>Información General</strong> en el <strong>panel principal</strong> de <strong>Crear/Continuar Solicitud</strong> para continuar actualizando los docentes.</p>
							<button class="btn btn-danger btn-sm volver_al_panel" id="informe_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
						</div>
					</div>
				</div>
			<?php else:?>
				<!-- Tarjeta si existe información en formulario 1 -->
				<!-- Información General -->
				<div class="col-lg-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Información a tener en cuenta:</h4>
							<p class="card-description">En este espacio podrás encontrar las solicitudes creadas anteriormente o podrás crear una nueva.</p>
							<p class="card-description">Antes de iniciar con el proceso te recomendamos leas el manual con atención, el cual se encuentra en el siguiente enlace<a href="#"> <code>Manual SIIA</code></a></p>
						</div>
					</div>
				</div>
				<!-- Tabla y botón de creación de facilitadores -->
				<div class="col-lg-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Solicitudes</h4>
							<p class="card-description">
								Solicitudes <code>registradas</code>
							</p>
							<hr/>
							<a class="btn btn-primary btn-sm" id="verDivAgregarSolicitud" href="#verDivAgregarSolicitud">Agregar nueva solicitud <i class="fa fa-plus" aria-hidden="true"></i></a>
							<?php if($solicitudes): ?>
							<div class="table-responsive">
								<table id="tabla_solicitudes" class="table table-striped">
									<thead>
									<tr>
										<th>IDSolicitud</th>
										<th>Fecha de Inscripción</th>
										<th>Fecha de Última Revisión</th>
										<th>Estado Solicitud</th>
										<th>Motivo</th>
										<th>Modalidad</th>
										<th>Acciones</th>
									</tr>
									</thead>
									<tbody id="tbody">
									<?php foreach ($solicitudes as $solicitud) {
										echo "<tr><td>" . $solicitud->idSolicitud . "</td>";
										echo "<td>" . $solicitud->fecha . "</td>";
										echo "<td>" . $solicitud->fechaUltimaRevision . "</td>";
										echo "<td>" . $solicitud->nombre . "</td>";
										echo "<td>" . $solicitud->motivoSolicitudAcreditado . "</td>";
										echo "<td>" . $solicitud->modalidadSolicitudAcreditado . "</td>";
										if ($solicitud->nombre == "En Proceso") {
											echo "<td><div class='btn-group-vertical' role='group' aria-label='acciones'><button type='button' class='btn btn-siia btn-sm verSolicitud' data-id=" . $solicitud->idSolicitud . " title='Continuar Solicitud'>Continuar <i class='fa fa-check' aria-hidden='true'></i></button>";
											echo "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalEliminarSolicitud' data-backdrop='static' data-keyboard='false' title='Eliminar Solicitud'>Eliminar <i class='fa fa-trash' aria-hidden='true'></i></button></div></td></tr>";
										}
										if ($solicitud->nombre == "Acreditado" || $solicitud->nombre == "Archivada" || $solicitud->nombre == "Negada" || $solicitud->nombre == "Revocada" ){
											echo "<td><button id='verDetalle' class='btn btn-info btn-sm' data-toggle='modal' data-target='#modalVerDetalle' data-backdrop='static' data-keyboard='false' data-id=" . $solicitud->idSolicitud . " title='Ver Detalle'>Detalle <i class='fa fa-info' aria-hidden='true'></i></button></div></td></tr>";
										}
										if ($solicitud->nombre == "Finalizado"){
											echo "<td><button class='btn btn-success btn-sm verObservaciones' data-id=" . $solicitud->idSolicitud . " title='Ver Estado'>Estado<i class='fa fa-eye' aria-hidden='true'></i></button></td></tr>";
										}
										if ($solicitud->nombre == "En Observaciones"){
											echo "<td><button class='btn btn-warning btn-sm verObservaciones' data-id=" . $solicitud->idSolicitud . " title='Ver Observaciones'>Observaciones<i class='fa fa-eye' aria-hidden='true'></i></button></td></tr>";
										}
									}
									?>
									</tbody>
								</table>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
				<!-- Formulario de creación de usuario -->
				<div class="col-lg-12 grid-margin stretch-card" id="divAgregarSolicitud">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Crear Facilitador</h4>
							<p class="card-description">Diligencia los datos básicos del <code>docente</code></p>
							<?php echo form_open('', array('id' => 'formulario_docentes')); ?>
								<div class="row">
									<!-- Número de cédula -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Número de cédula o NUIP: <code>*</code></label>
												<input type="text" class="form-control" name="docentes_cedula" id="docentes_cedula" placeholder="Cédula o NUIP...">
											</div>
										</div>
									</div>
									<!-- Primer nombre -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Primer nombre: <code>*</code></label>
												<input type="text" class="form-control" name="docentes_primer_nombre" id="docentes_primer_nombre" placeholder="Primer nombre...">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!-- Segundo nombre -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Segundo nombre:</label>
												<input type="text" class="form-control" name="docentes_segundo_nombre" id="docentes_segundo_nombre" placeholder="Segundo nombre...">
											</div>
										</div>
									</div>
									<!-- Primer apellido -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Primer apellido: <code>*</code></label>
												<input type="text" class="form-control" name="docentes_primer_apellido" id="docentes_primer_apellido" placeholder="Primer apellido...">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!-- Segundo apellido -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Segundo apellido:</label>
												<input type="text" class="form-control" name="docentes_segundo_apellido" id="docentes_segundo_apellido" placeholder="Segundo apellido...">
											</div>
										</div>
									</div>
									<!-- Profesión -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Profesión: <code>*</code></label>
												<input type="text" class="form-control" name="docentes_profesion" id="docentes_profesion" placeholder="Profesión: Sociólogo, Licenciatura en Educación Infantil...">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!-- Horas de capacitación -->
									<div class="col-md-6">
										<div class="form-group row">
											<div class="col-sm-12">
												<label class="col-sm-12 col-form-label">Horas de capacitación del facilitador: <code>*</code></label>
												<input type="number" class="form-control" min="60" name="docentes_horas" id="docentes_horas" value="" placeholder="60">
											</div>
										</div>
									</div>
								</div>
								<button  class="btn btn-primary btn-sm" name="añadirNuevoDocente" id="añadirNuevoDocente">Crear facilitador <i class="fa fa-check" aria-hidden="true"></i></button>
								<button class="btn btn-danger btn-sm" id="cancelarNuevoDocente"><i class="fa fa-arrow-left" aria-hidden="true"></i>Cancelar</button>
							</form>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>
	<!-- Modal: Ver Docente -->
	<div class="modal fade" id="verDocenteOrg" tabindex="-1" role="dialog" aria-labelledby="verdocenteorg">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="verdocenteorg">Facilitador: <label id="nombre_doc"></label>.</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<h6>¿Aprobado? <code id="valido_doc"></code></h6>
					<small>Los archivos y campos marcados con asterisco (<code>*</code>) son <strong>requeridos</strong> en la solicitud.</small><br/>
					<small>Los archivos deben estar en <strong>formato/extensión</strong> (<code>pdf</code>) en <strong>minúscula</strong>.</small><br/>
					<small>Los archivos deben tener un <strong>tamaño maximo</strong> de (<code>10</code>) Mb (megabytes).</small><br/> <br/>
					<hr />
					<h5>Datos Básicos:</h5>
					<hr />
					<?php echo form_open_multipart('', array('id' => 'formulario_actualizar_docente')); ?>
					<div class="row">
						<!-- Primer Nombre -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Primer Nombre:<code>*</code></label>
									<input type="text" class="form-control" id="primer_nombre_doc">
								</div>
							</div>
						</div>
						<!-- Segundo Nombre -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Segundo Nombre:</label>
									<input type="text" class="form-control" id="segundo_nombre_doc">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Primer Apellido -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Primer Apellido:<code>*</code></label>
									<input type="text" class="form-control" id="primer_apellido_doc">
								</div>
							</div>
						</div>
						<!-- Segundo Apellido -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Segundo Apellido:</label>
									<input type="text" class="form-control" id="segundo_apellido_doc">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Número de Cédula -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Número de Cédula:<code>*</code></label>
									<input type="text" class="form-control" id="numero_cedula_doc">
								</div>
							</div>
						</div>
						<!-- Profesión -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Profesión:<code>*</code></label>
									<input type="text" class="form-control" id="profesion_doc">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Número de Cédula -->
						<div class="col-md-6">
							<div class="form-group row">
								<div class="col-sm-12">
									<label class="col-sm-12 col-form-label">Horas de Capacitación:<code>*</code></label>
									<input type="text" class="form-control" id="horas_doc">
								</div>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary btn-sm actualizar_docente" value="No">Actualizar datos básicos facilitador<i class="fa fa-refresh" aria-hidden="true"></i></button>
					</ form>
					<hr />
					<h5>Cargar documentos:</h5>
					<hr />
					<br>
					<div class="row">
						<div class="col-md-6">
							<!-- Hoja de vida -->
							<?php echo form_open_multipart('', array('id' => 'formulario_archivo_docente_hojavida')); ?>
								<label>Hoja de vida (PDF)<code>*</code></label>
								<br/><small>Solo adjuntar la hoja de vida <strong>sin soporte alguno</strong>.</small><br/><br/>
								<div class="form-group">
									<input type="file" form="formulario_archivo_docente_hojavida" required accept="application/pdf" class="file-upload-default" data-val="docenteHojaVida" name="docenteHojaVida" id="docenteHojaVida">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled="" placeholder="Cargar hoja de vida">
										<span class="input-group-append">
											  <button class="file-upload-browse btn btn-sm btn-primary" type="button">Buscar</button>
										</span>
									</div>
								</div>
								<input type="button" class="btn btn-primary btn-sm archivos_form_hojaVidaDocente" data-name="docenteHojaVida" name="hojaVidaDocente" id="hojaVidaDocente" value="Cargar archivo">
							</form>
							<hr/>
							<!-- Certificados exp -->
							<?php echo form_open_multipart('', array('id' => 'formulario_archivo_docente_certificados')); ?>
							<label>Certificados de experiencia <code>(3)</code>(PDF):<span class="spanRojo">*</span></label>
							<br/>
							<small>Solo adjuntar certificados como <strong>conferensista</strong>, <strong>docente</strong>, <strong>tallerista</strong>, <strong>instructor</strong>, entre otros, evitar relacionar como <strong>asesor</strong>, <strong>cargos directivos</strong>, entre otros.</small><br/><br/>
							<div class="form-group">
								<input type="file" required accept="application/pdf" class="file-upload-default" data-val="docenteCertificados" name="docenteCertificados" id="docenteCertificados">
								<div class="input-group col-xs-12">
									<input type="text" class="form-control file-upload-info" disabled="" placeholder="Cargar certificado experiencia">
									<span class="input-group-append">
										  <button class="file-upload-browse btn btn-sm btn-primary" type="button">Buscar</button>
									</span>
								</div>
							</div>
							<div>
								<input type="button" class="btn btn-primary btn-sm archivos_form_certificadoDocente" data-name="docenteCertificados" name="certificadoDocente" id="certificadoDocente" value="Cargar archivo">
							</div>
							</form>
						</div>
						<div class="col-md-6">
							<!-- Certificados titulo -->
							<?php echo form_open_multipart('', array('id' => 'formulario_archivo_docente_titulo')); ?>
							<label>Titulo Profesional (PDF):<code>*</code></label>
							<br/>
							<small>Solo adjuntar el <strong>diploma ó acta de grado</strong>.</small><br>
							<br/>
							<div class="form-group">
								<input type="file" required accept="application/pdf" class="file-upload-default" data-val="docenteTitulo" name="docenteTitulo" id="docenteTitulo">
								<div class="input-group col-xs-12">
									<input type="text" class="form-control file-upload-info" disabled="" placeholder="Cargar titulo profesional">
									<span class="input-group-append">
										  <button class="file-upload-browse btn btn-sm btn-primary" type="button">Buscar</button>
									</span>
								</div>
							</div>
							<input type="button" class="btn btn-primary btn-sm archivos_form_tituloDocente" data-name="docenteTitulo" name="tituloDocente" id="tituloDocente" value="Cargar archivo">
							</form>
							<hr/>
							<!-- Certificados economía solidaria -->
							<?php echo form_open_multipart('', array('id' => 'formulario_archivo_docente_certificados')); ?>
							<label>Certificados de economía solidaria (PDF):<code>*</code></label>
							<br/>
							<small>Solo adjuntar certificados de <strong>economía solidaria, verificando las horas</strong>.</small><br/><br/><br/>
							<div class="form-group">
								<input type="file" required accept="application/pdf" class="file-upload-default" data-val="docenteCertificadosEconomia" name="docenteCertificadosEconomia" id="docenteCertificadosEconomia">
								<div class="input-group col-xs-12">
									<input type="text" class="form-control file-upload-info" disabled="" placeholder="Cargar certificado economía">
									<span class="input-group-append">
										  <button class="file-upload-browse btn btn-sm btn-primary" type="button">Buscar</button>
									</span>
								</div>
								<br/>
								<label>¿Horas que tiene el certificado?:<code>*</code></label><br>
								<input type="number" id="horasCertEcoSol" class="form-control" name="horasCertEcoSol" min="60" placeholder="60">
							</div>
							<input type="button" class="btn btn-primary btn-sm archivos_form_certificadoEconomiaDocente" data-name="docenteCertificadosEconomia" name="certificadoDocenteEconomia" id="certificadoDocenteEconomia" value="Cargar archivo">
							</form>
						</div>
						<div class="col-md-12">
							<hr/>
							<h5>Archivos adjuntos al docente</h5>
							<hr />
							<!--<a class="dataReloadDocente">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
							<div class="table-responsive">
								<table id="tabla_archivos_formulario" width="100%" border=0 class="table table-striped tabla_form">
									<thead>
									<tr>
										<th	class="col-md-3">Nombre</th>
										<th	class="col-md-3">Tipo</th>
										<th	class="col-md-3">Observación archivo</th>
										<th	class="col-md-3">Acción</th>
									</tr>
									</thead>
									<tbody id="tbody">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="btn-group">
						<button type="button" class="btn btn-danger btn-sm pull-left" data-toggle='modal' data-target='#eliminarDocente'>Eliminar facilitador <i class="fa fa-trash-o" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-warning btn-sm actualizar_docente" value="Si">Enviar actualización como solicitud <i class="fa fa-refresh" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal: Eliminar Docente -->
	<div class="modal fade" id="eliminarDocente" tabindex="-2" role="dialog" aria-labelledby="eliminardocente">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="eliminardocente">¿Está seguro de eliminar el facilitador?</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Por favor, confirmar la eliminación del facilitador. Esta acción no se puede revertir, se eliminarán todos los datos registrados del facilitador incluyendo los documentos cargados para él</p><br>
					<div class="btn-group">
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No borrar facilitador <i class="fa fa-times" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-success btn-sm" id="siEliminarDocente" >Si, estoy seguro, confirmo la eliminación<i class="fa fa-check" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>





