				<div class="clearfix"></div>
				<!-- Modals -->
				<div class="" id="modals-sia">
					<div class="modal fade in" id="panelPrincipal" tabindex="-1" role="dialog" aria-labelledby="panelprincipalh">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="panelprincipalh">Ayuda <i class="fa fa-info" aria-hidden="true"></i></h4>
								</div>
								<div class="modal-body">
									<img style="margin: 0 auto;" src="<?php echo base_url("assets/img/siia_logo.png"); ?>" class="img-responsive" alt="Banner">
									<hr />
									<?php echo $informacionModal; ?>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" id="cerrarModalpanelPrincipal" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal Informe de actividades -->
					<div class="modal fade in" id="modalInformeAct2019" tabindex="-1" role="dialog" aria-labelledby="modalInformeAct2019j">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="modalInformeAct2019j">Módulo de informe de actividades <i class="fa fa-flag" aria-hidden="true"></i></h4>
								</div>
								<div class="modal-body">
									<p><strong>¡Este módulo estará disponible en el 2019, espéralo!</strong></p>
									<p><small>En cumplimiento de la circular 001 de 2018 este módulo se activará en enero de 2019. En 2018 se emitirán las certificaciones de cursos como tradicionalmente se ha venido realizando.” Esto con el fin de evitar que se emitan certificaciones este año."</small></p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm" id="cerrarModalpanelPrincipal" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal para guardar observaciones -->
					<div class="modal fade in" id="guardarOBSSI" tabindex="-1" role="dialog" aria-labelledby="guardarOBSSI">
						<div class="modal-dialog modal-xs" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="guardarOBSSIs">¿Guardar observaciones del formulario?</h4>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-siia btn-sm" id="guardarSiObs">Si, guardar <i class="fa fa-check" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal para bateria de observaciones -->
					<div class="modal fade in" id="modalBateriaObservaciones" tabindex="-1" role="dialog" aria-labelledby="modalBateriaObservaciones">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4>Observaciones</h4>
									<div class="form-group">
										<label>Tipo de observación:</label>
										<br>
										<select name="tipoBateriaObservacion" id="tipoBateriaObservacion" data-id-dep="1" class="selectpicker form-control show-tick">
											<option id="0" value="1" selected>1. Información General de la Entidad </option>
											<option id="1" value="2">2. Documentación Legal </option>
											<option id="1" value="3">3. Registros educativos de Programas </option>
											<option id="2" value="4">4. Antecedentes Académicos </option>
											<option id="3" value="5">5. Jornadas de actualización </option>
											<option id="4" value="6">6. Programa básico de economía solidaria </option>
											<option id="5" value="7">7. Programas Aval </option>
											<option id="6" value="8">8. Programas </option>
											<option id="7" value="9">9. Facilitadores </option>
											<option id="8" value="10">10. Datos Plataforma Virtual </option>
											<option id="9" value="11">Observaciones Generales </option>
										</select>
									</div>
									<div class="form-group">
										<label>Titulo:</label>
										<input type="text" class="form-control" id="tituloBateriaObservacion" placeholder="Titulo...">
									</div>
									<div class="form-group">
										<label>Observación:</label>
										<textarea class="form-control" id="observacionBateriaObservacion" placeholder="Observación..." rows="7"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-siia btn-sm" id="crearBateriaObservacion">Crear observación <i class="fa fa-check" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-warning btn-sm" id="actualizarBateriaObservacion">Actualizar observación <i class="fa fa-check" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- //Modal relación de cambios -->
					<div class="modal fade" id="modalRelacionCambios" tabindex="-1" role="dialog" aria-labelledby="relacionCambios">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="relacionCambios">Relación de cambios </h4>
									<h4><a id="verRelacionFiltrada" target="_blank" class="pull-right">Ver tabla de relación de cambios para filtrar y descargar <i class="fa fa-table" aria-hidden="true"></i></a></h4>
								</div>
								<div class="modal-body">
									<table id="tabla_relacionCambio" width="100%" border=0 class="table table-striped table-bordered tabla_form">
										<thead>
										<tr>
											<td>Titulo</td>
											<td class="col-md-6">Descripcion</td>
											<td>Fecha</td>
										</tr>
										</thead>
										<tbody id="tbody_relacionCambios">
										</tbody>
									</table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal pedir camara -->
					<div class="modal fade" id="modalPedirCamara" tabindex="-1" role="dialog" aria-labelledby="pedircamara">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="pedircamara">¿Realmente quiere pedir la cámara de comercio? </h4>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">No, cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-success btn-sm pull-right" id="volverPedirCamara">Si, estoy seguro de pedir la cámara <i class="fa fa-check" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Link términos -->
					<div class="modal fade" id="terminosCondiciones" tabindex="-1" role="dialog" aria-labelledby="terminosCondiciones">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title" id="terminosCondiciones">Términos, condiciones y características de uso del trámite</h3>
								</div>
								<div class="modal-body">
									<p>El trámite no tiene costo.</p>
									<hr />
									<label>Características de los anexos:</label>
									<p>Los archivos deben estar en <strong>formato/extensión</strong> (<span class="spanRojo">pdf</span>) en <strong>minúscula</strong>.</p>
									<p>Las imagenes deben estar en <strong>formato/extensión</strong> (<span class="spanRojo">jpg/png/jpeg</span>) en <strong>minúscula</strong>.</p>
									<p>Los archivos deben tener un <strong>tamaño maximo</strong> de (<span class="spanRojo">~ 10</span>) Mb (megabytes).</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Servicio de atención -->
					<div class="modal fade" id="servicioAtencion" tabindex="-1" role="dialog" aria-labelledby="servicioAtencion">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title" id="servicioAtencion">Servicio de atención</h3>
								</div>
								<div class="modal-body">
									<ul>
										<li><a href="https://www.uaeos.gov.co/" target="_blank">Página web de la Unidad Administrativa Especial de Organizaciones Solidarias</a></li>
										<li><a href="mailto:atencionalciudadano@uaeos.gov.co" target="_blank">atencionalciudadano@uaeos.gov.co</a></li>
										<li>Atención telefónica al <strong>3275252</strong> Ext. <strong>192-301</strong> (Bogotá); línea gratuita nacional <strong>018000122020</strong></li>
										<li>Atención personalizada: <strong>Carrera 10 No. 15 - 22</strong> Lunes a viernes de <strong>8 a.m. a 5:00 p.m.</strong>, en la ciudad de Bogotá.</li>
										<li>A través del Chat en la página web los días <strong>martes y jueves</strong> de <strong>9 am a 12 pm</strong></li>
									</ul>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal para ver historial de observaciones -->
					<div class="modal fade" id="verHistObsUs" tabindex="-1" role="dialog" aria-labelledby="verhistobsus">
						<div class="modal-dialog modal-xl" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
									<h3 class="modal-title" id="verhistobsus">Observaciones</h3>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<label>Historial de observaciones:</label>
											<table id="tabla_historial_obs" width="100%" border=0 class="table table-striped table-bordered tabla_form">
												<thead>
												<tr>
													<td class="col-md-2">Formulario</td>
													<td class="col-md-2">Campo del formulario</td>
													<td class="col-md-2">Observación</td>
													<!--<td class="col-md-2">Valor del usuario</td>-->
													<td class="col-md-2">Fecha de Observacion</td>
													<td class="col-md-1">Número de Revision</td>
													<!--<td class="col-md-1">Id de Solicitud</td>-->
												</tr>
												</thead>
												<!-- //TODO: Se cargan todas las observaciones -->
												<tbody id="tbody_hist_obs">
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger btn-sm" id="crr_hist_obs" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal Ayuda en Login- Inicio -->
					<div class="modal fade" id="ayuda_login" tabindex="-1" role="dialog" aria-labelledby="ayudaLogin">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="ayudaLogin">Ayuda </h4>
								</div>
								<div class="modal-body">
									<p>Contenido de ayuda para login</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>

					<!-- Modal Cerrar Sesión - Inicio -->
					<div class="modal fade" id="cerrar_sesion_admin" tabindex="-1" role="dialog" aria-labelledby="cerrarSesionAdmin">
						<div class="modal-dialog modal-sm" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title" id="cerrarSesionAdmin">¿Esta seguro de cerrar sesión <label class="user-profile"><?php echo $nombre_usuario ?></label>?</h5>
								</div>
								<div class="modal-body">
									<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No <i class="fa fa-times" aria-hidden="true"></i></button>
									<button type="button" class="btn btn-siia btn-sm pull-right" id="salir_admin">Si <i class="fa fa-check" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal - Inicio -->
					<div class="modal fade" id="+++++++" tabindex="-1" role="dialog" aria-labelledby="--------------">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="--------------">Ayuda </h4>
								</div>
								<div class="modal-body">
									<!-- Contenido -->
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Modal - FIN -->
				<!-- //TODO: Botón de ir arriba -->
<!--				<div class="backtoTop" id="back-to-top">-->
<!--					<div class="div-star-up" style="">-->
<!--						<button class="btn-up-hover back-to-top-button" aria-label="Volver a arriba" type="button" data-original-title="" title="">-->
<!--							<a class="a-start-up">-->
<!--								<span class="govco-icon govco-icon-shortu-arrow-n btn-svg-up-hover small"></span>-->
<!--								<span class="label-button-star-up">Volver a arriba</span>-->
<!--							</a>-->
<!--						</button>-->
<!--					</div>-->
<!--				</div>-->
				<!-- Footer Content -->
				<!-- Footer -->
				<!-- content-wrapper ends -->
				<!-- partial:../../partials/_footer.html -->
				<footer class="footer">
					<div class="d-sm-flex justify-content-center justify-content-sm-between">
						<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?> <a href="https://www.uaeos.gov.co/" target="_blank">Unidad Administrativa Especial Organizaciones Solidarias - UAEOS</a></span>
						<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sistema Integrado de Información de Acreditación <i class="ti-bookmark-alt text-danger ml-1"></i></span>
					</div>
				</footer>
			<!-- partial -->
			</div>
		<!-- main-panel ends -->
		</div>
	<!-- page-body-wrapper ends -->
	</div>
<!-- container-scroller -->

<div class="hidden" id="scripts-sia">
	<!-- plugins:js -->
	<script src="<?php echo base_url('assets/js/dashboard/vendors/js/vendor.bundle.base.js') ?>"></script>
	<!-- endinject -->
	<!-- Plugin js for this page -->
	<script src="<?php echo base_url('assets/js/dashboard/vendors/chart.js/Chart.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/vendors/typeahead.js/typeahead.bundle.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/vendors/select2/select2.min.js') ?>"></script>
	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="<?php echo base_url('assets/js/dashboard/js/off-canvas.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/js/hoverable-collapse.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/js/template.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/js/settings.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/js/todolist.js') ?>"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="<?php echo base_url('assets/js/dashboard/js/file-upload.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/js/typeahead.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/dashboard/js/select2.js') ?>"></script>
	<!-- End custom js for this page-->
	<!-- Custom js for this page-->
	<script src="<?php echo base_url('assets/js/dashboard/js/chart.js') ?>"></script>
	<!-- End custom js for this page-->

<!--	<link href="https://cdn.www.gov.co/v2/assets/js/utils.js" rel="stylesheet">-->
<!--	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<!--	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
<!--	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--	<link href="--><?php //echo base_url('assets/css/notifIt.css') ?><!--" rel="stylesheet" type="text/css" />-->
<!--	<link href="--><?php //echo base_url('assets/css/dataTables.bootstrap.css') ?><!--" rel="stylesheet" type="text/css" />-->
<!--	<link href="--><?php //echo base_url('assets/css/bootstrap-select.min.css') ?><!--" rel="stylesheet" type="text/css" />-->
<!--	<link href="--><?php //echo base_url('assets/css/animate.min.css') ?><!--" rel="stylesheet" type="text/css" />-->
<!--	<link href="--><?php //echo base_url('assets/css/bootstrap-dropdownhover.min.css') ?><!--" rel="stylesheet" type="text/css" />-->
	<!-- <link href="--><?php //echo base_url('assets/css/mdb.min.css') ?><!--" rel="stylesheet" type="text/css" />-->
<!--	<link href="--><?php //echo base_url('assets/css/vis.min.css') ?><!--" rel="stylesheet" type="text/css" />-->
	<!-- Scripts -->
<!--	<script src="--><?php //echo base_url('assets/js/modernizr.js') ?><!--"></script>-->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="<?php echo base_url('assets/js/notifIt.js') ?>" type="text/javascript"></script>
<!--	<script src="--><?php //echo base_url('assets/js/bootstrap.min.js') ?><!--" type="text/javascript"></script>-->
	<script src="<?php echo base_url('assets/js/jquery.validate.js') ?>" type="text/javascript"></script>
<!--	<script src="--><?php //echo base_url('assets/js/bootstrap-select.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/langs/selector-i18n/defaults-es_ES.js') ?><!--" type="text/javascript"></script>-->
	<!-- Data Tables -->
<!--	<script src="--><?php //echo base_url('assets/js/popper.min.js') ?><!--" type="text/javascript"></script>-->
<!-- 	<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script> -->
<!--	<script src="--><?php //echo base_url('assets/js/jquery.dataTables.nuevo.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/dataTables.buttons.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/dataTables.bootstrap.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/buttons.html5.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/buttons.print.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/buttons.flash.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/buttons.colVis.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/jszip.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/pdfmake.min.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/vfs_fonts.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/buttons.bootstrap.min.js') ?><!--" type="text/javascript"></script>-->
	<!-- Fin Data Tables -->
<!--	<script src="--><?php //echo base_url('assets/js/sidebar-menu.js') ?><!--" type="text/javascript"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/paging.js') ?><!--"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/bootstrap-dropdownhover.min.js') ?><!--"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/echarts.min.js') ?><!--"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/map/js/world.js') ?><!--"></script>-->
<!--	<script src="<?php echo base_url('assets/js/mdbs.min.js') ?>"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/ckeditor.js') ?><!--"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/initck.js') ?><!--"></script>-->
<!--	<script src="--><?php //echo base_url('assets/js/vis.min.js') ?><!--"></script>-->
	<script src="<?php echo base_url('assets/js/functions/script_o.js?v=1.0.8.61219') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/registro.js?v=1.0.0.1') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/login.js?v=1.0.7.61342') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/contacto.js?v=1.0.8.61') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/estadisticas.js?v=1.0.8.62') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/encuesta.js?v=1.0.8.62') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/observaciones.js?v=1.1.1') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/estados.js?v=1.2.1') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/resoluciones.js?v=1.4.1') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/nits.js?v=1.5.1') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/panel.js?v=1.0.1') . time() ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/functions/formularios.js?v=1.0.1') . time() ?>" type="text/javascript"></script>
	<script type="text/javascript">
		$(window).on('load', function() {
			$(".se-pre-con").fadeOut("slow");
		});
	</script>
	<!--Add the following script at the bottom of the web page (immediately before the </body> tag)-->
	<!--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=49054954"></script>-->
</div>
</body>
</html>
