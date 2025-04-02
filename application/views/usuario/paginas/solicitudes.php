<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<?php if($dataInformacionGeneral == null || $dataInformacionGeneral == ""):?>
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
				<div class="col-lg-12 grid-margin stretch-card" id="crearSolicitudes">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Solicitudes</h4>
							<p class="card-description">
								Solicitudes <code>registradas</code>
							</p>
							<hr/>
							<!-- Botón agregar solicitud -->
							<a class="btn btn-primary btn-sm" id="nuevaSolicitud">Agregar nueva solicitud <i class="fa fa-plus" aria-hidden="true"></i></a>
							<?php if($solicitudes): ?>
								<div class="table-responsive">
									<table id="tabla_solicitudes" class="table table-striped">
										<thead>
										<tr>
											<th>IDSolicitud</th>
											<th>Inscripción</th>
											<th>Última Revisión</th>
											<th>Estado</th>
											<th>Acciones</th>
										</tr>
										</thead>
										<tbody id="tbody">
										<?php foreach ($solicitudes as $solicitud) {
											echo "<tr><td>" . $solicitud->idSolicitud . "</td>";
											echo "<td>" . $solicitud->fecha . "</td>";
											echo "<td>" . $solicitud->fechaUltimaRevision . "</td>";
											echo "<td>" . $solicitud->nombre . "</td>";
											if ($solicitud->nombre == "En Proceso") {
												echo "<td><div class='btn-group-vertical' role='group' aria-label='acciones'><button type='button' class='btn btn-primary btn-sm verSolicitud' data-id=" . $solicitud->idSolicitud . " title='Continuar Solicitud'>Continuar <i class='fa fa-check' aria-hidden='true'></i></button>";
												echo "<button type='button' class='btn btn-danger btn-sm eliminarSolicitudModal' data-id='" . $solicitud->idSolicitud . "' data-toggle='modal' data-target='#modalEliminarSolicitud' data-backdrop='static' data-keyboard='false' title='Eliminar Solicitud'>Eliminar <i class='fa fa-trash' aria-hidden='true'></i></button>";
												echo "<button class='btn btn-info btn-sm verDetalleSolicitud' data-toggle='modal' data-target='#modalVerDetalle' data-backdrop='static' data-keyboard='false' data-id=" . $solicitud->idSolicitud . " title='Ver Detalle'>Detalle <i class='fa fa-info' aria-hidden='true'></i></button></div></td></tr>";

											}
											if ($solicitud->nombre == "Acreditado" || $solicitud->nombre == "Archivada" || $solicitud->nombre == "Negada" || $solicitud->nombre == "Revocada" ){
												echo "<td><button id='verDetalle' class='btn btn-info btn-sm verDetalleSolicitud' data-toggle='modal' data-target='#modalVerDetalle' data-backdrop='static' data-keyboard='false' data-id=" . $solicitud->idSolicitud . " title='Ver Detalle'>Detalle <i class='fa fa-info' aria-hidden='true'></i></button></div></td></tr>";
											}
											if ($solicitud->nombre == "Finalizado" || $solicitud->nombre == "En Observaciones"){
												echo "<td><button class='btn btn-success btn-sm verObservaciones' data-id=" . $solicitud->idSolicitud . " title='Ver Estado'>Estado<i class='fa fa-eye' aria-hidden='true'></i></button></td></tr>";
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
				<!-- Formulario de creación de solicitud -->
				<div class="col-lg-12 grid-margin stretch-card" id="tipoSolicitud">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Crear solicitud</h4>
							<p class="card-description">Marca el motivo y la modalidad de la <code>solicitud</code></p>
							<div class="container">
								<?php echo form_open('', array('id' => 'formulario_crear_solicitud')); ?>
								<hr />
								<!-- Motivo de la solicitud -->
								<label for="motivo_solicitud">Motivo de la solicitud:<code>*</code></label><br>
								<!-- CheckBox motivos de la solicitud -->
								<div class="form-group">
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="cursoBasico">
											<input class="form-check-input" type="checkbox" value="1" id="cursoBasico" name="motivos" checked>
											Acreditación Curso Básico de Economía Solidaria
										</label>
									</div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="avalTrabajo">
											<input class="form-check-input" type="checkbox" value="2" id="avalTrabajo" name="motivos">
											Aval de Trabajo Asociado
										</label>
									</div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="cursoMedio">
											<input class="form-check-input" type="checkbox" value="3" id="cursoMedio" name="motivos">
											Acreditación Curso Medio de Economía Solidaria
										</label>
									</div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="cursoAvanzado">
											<input class="form-check-input" type="checkbox" value="4" id="cursoAvanzado" name="motivos">
											Acreditación Curso Avanzado de Economía Solidaria
										</label>
									</div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="finacieraEconomia">
											<input class="form-check-input" type="checkbox" value="5" id="finacieraEconomia" name="motivos">
											Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria
										</label>
									</div>
								</div>
								<hr />
								<!-- Modalidad de la solicitud -->
								<label for="modalidad_solicitud">Modalidad:<code>*</code></label><br>
								<!-- CheckBox modalidades de la solicitud -->
								<div class="form-group">
									<i data-toggle="modal" data-target="#ayudaModalidad" class="fa fa-question-circle pull-right" aria-hidden="true" data-keyboard='false'></i>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="presencial">
											<input class="form-check-input" type="checkbox" value="1" id="presencial" value="Presencial" name="modalidades" checked>
											Presencial
										</label>
									</div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="virtual">
											<input class="form-check-input" type="checkbox" value="2" id="virtualCheck" value="Virtual" name="modalidades">
											Virtual
										</label>
									</div>
									<div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label" for="enLinea">
											<input class="form-check-input" type="checkbox" value="3" id="enLineaCheck" value="En Linea" name="modalidades">
											En Linea
										</label>
									</div>
								</div>
								<hr />
								<br>
								</form>
								<!-- Botones crear y volver -->
								<div class="btn-group">
									<button  class="btn btn-success btn-sm"  data-target="#ayudaCrearSolicitud" data-toggle="modal" data-backdrop="static" data-keyboard="false">Crear solicitud</button>
									<button class="btn btn-secondary btn-sm volverSolicitudes"> Volver a solicitudes</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>

	<!-- Modal Ayuda crear solicitud  -->
	<div class="modal fade" id="ayudaCrearSolicitud" tabindex="-1" role="dialog" aria-labelledby="ayudaCrearSolicitud">
		<div class="modal-dialog modal-xs" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">¿Está seguro de crear la solicitud?</h4>
					<button type="button" class="close" data-dismiss="modal"aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Verifique la modalidad y los motivos registrados en la solicitud. Tenga en cuenta que una vez creada la solicitud no podrá editar los motivos ni las modalidades.</p>
				</div>
				<div class="modal-footer">
					<div class="btn-group">
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, quizá más adelante </button>
						<button type="button" id="guardar_formulario_tipoSolicitud" class="btn btn-success btn-sm" data-dismiss="modal">Si, estoy seguro de crear solicitud <i class="fa fa-check" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Ayuda Modalidad Virtual  -->
	<div class="modal fade" id="ayudaModalidadVirtual" data-backdrop="static" data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="ayudaModalidadVirtual">
		<div class="modal-dialog modal-xs" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">¿Está seguro de presentar la modalidad virtual?</h4>
				</div>
				<div class="modal-body">
					<p>De acuerdo a lo establecido en el parágrafo número 1 del artículo 6 de la resolución 152 del 23 de junio del 2022, las entidades que soliciten la acreditación por la modalidad en línea deben tener en cuenta lo siguiente:</p>
					<p><strong>Parágrafo 1.</strong> Para la acreditación de los programas de educación en economía solidaria bajo modalidad virtual, la entidad solicitante deberá demostrar que el proceso educativo se hace en una <stron>plataforma</stron> (sesiones clase, materiales de apoyo, actividades, evaluaciones) que propicie un Ambiente Virtual de Aprendizaje - AVA y Objetos Virtuales de Aprendizaje- OVAS. </p>
					<p>Recuerde desarrollar el proceso formativo acorde a lo establecido en el anexo técnico.</p>
					<p>La UAEOS realizará seguimiento a las organizaciones acreditadas en el cumplimiento de los programas de educación solidaria acreditados.</p>
					<!--				<a class="pull-right" target="_blank" href="https://www.orgsolidarias.gov.co/sites/default/files/archivos/Res_110%20del%2031%20de%20marzo%20de%202016.pdf">Recurso de la resolución 110</a>-->
				</div>
				<div class="modal-footer">
					<div class="btn-group">
						<button type="button" id="noModVirtCheck" class="btn btn-danger btn-sm">No, quizá más adelante</button>
						<button type="button" id="siModVirt" class="btn btn-success btn-sm " data-dismiss="modal">Si, esto seguro de presentar la modalidad virtual</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Ayuda Modalidad En Línea  -->
	<div class="modal fade" id="ayudaModalidadEnLinea" data-backdrop="static" data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="ayudaModalidadEnLinea">
		<div class="modal-dialog modal-xs" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">¿Está seguro de presentar la modalidad en Línea?</h4>
				</div>
				<div class="modal-body">
					<p>De acuerdo a lo establecido en el parágrafo número 2 del artículo 6 de la resolución 152 del 23 de junio del 2022, las entidades que soliciten la acreditación por la modalidad en línea, deben tener en cuenta lo siguiente:</p>
					<p><strong>Parágrafo 2.</strong> Para la acreditación de los programas de educación en economía solidaria bajo modalidad línea, aquella donde los docentes y participantes interactúan a través de recursos tecnológicos. La mediación tecnológica puede ser a través de herramientas tecnológica (Zoom, Teams, Meet, Good Meet, entre otras) plataformas de comunicación, chats, foros, videoconferencias, grupos de discusión, caracterizadas por encuentros sincrónicos.</strong> </p>
					<p>Recuerde desarrollar el proceso formativo acorde a lo establecido en el anexo técnico.</p>
					<p>La UAEOS realizará seguimiento a las organizaciones acreditadas en el cumplimiento de los programas de educación solidaria acreditados.</p>
					<!--				<a class="pull-right" target="_blank" href="https://www.orgsolidarias.gov.co/sites/default/files/archivos/Res_110%20del%2031%20de%20marzo%20de%202016.pdf">Recurso de la resolución 110</a>-->
				</div>
				<div class="modal-footer">
					<div class="btn-group">
						<button type="button" id="noModEnLinea" class="btn btn-danger btn-sm">No, quizá más adelante</button>
						<button type="button" id="siModEnLinea" class="btn btn-success btn-sm" data-dismiss="modal">Si, esto seguro de presentar la modalidad en linea</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Detalle Solicitud -->
	<div class="modal fade" id="modalVerDetalle" tabindex="-1" role="dialog" aria-labelledby="modalVerDetalle">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Detalles de la solicitud</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="card">
						<div class="card-body">
							<div class="container">
								<div class="row">
									<div class="col-6" style="text-align: left;" id="informacionSolicitudBasico">
									</div>
									<div class="col-6" style="text-align: left;" id="informacionSolicitudFechas">
									</div>
								</div>
								<hr />
								<div id="informacionSolicitudEstado"></div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Eliminar Solicitud  -->
	<div class="modal fade" id="modalEliminarSolicitud" tabindex="-1" role="dialog" aria-labelledby="modalEliminarSolicitud">
		<div class="modal-dialog modal-xs" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="solicitudAEliminar"></h5>
					<button type="button" class="close" data-dismiss="modal"  aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Tenga en cuenta que la información registrada en los formularios de dentro de esta solicitud serán eliminados y no se podrán recuperar.</p>
				</div>
				<div class="modal-footer">
					<div class="btn-group">
						<button type="button" data-dismiss="modal" class="btn btn-danger btn-sm ">No, eliminar <i class="fa fa-times" aria-hidden="true"></i></button>
						<button type="button" id="eliminarSolicitud" class="btn btn-success btn-sm eliminarSolicitud" data-dismiss="modal">Si, eliminar solicitud<i class="fa fa-check" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>





