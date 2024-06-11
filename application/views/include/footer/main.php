<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 */
?>					<!-- Modals -->
					<?php $this->load->view('include/footer/modals'); ?>
			<?php if ($logged_in != FALSE && $tipo_usuario != "none"): ?>
					<footer class="footer">
						<div class="d-sm-flex justify-content-center justify-content-sm-between">
							<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= date('Y'); ?> <a href="<?= base_url(PAGINA_WEB) ?>" target="_blank">Unidad Administrativa Especial Organizaciones Solidarias - UAEOS</a></span>
							<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sistema Integrado de Información de Acreditación <i class="ti-bookmark-alt text-danger ml-1"></i></span>
						</div>
					</footer>
				<!-- partial -->
				</div>
			<!-- main-panel ends -->
			</div>
			<?php endif; ?>
		<!-- page-body-wrapper ends -->
		</div>
		<!-- scripts -->
		<div class="hidden" id="scripts-siia">
			<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
			<!-- plugins:js -->
			<script src="<?= base_url('assets/js/dashboard/vendors/js/vendor.bundle.base.js') ?>"></script>
			<!-- endinject -->
			<!-- Plugin js for this page -->
			<script src="<?= base_url('assets/js/dashboard/vendors/chart.js/Chart.min.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/vendors/typeahead.js/typeahead.bundle.min.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/vendors/select2/select2.min.js') ?>"></script>
			<!-- End plugin js for this page -->
			<!-- inject:js -->
			<script src="<?= base_url('assets/js/dashboard/js/off-canvas.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/js/hoverable-collapse.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/js/template.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/js/settings.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/js/todolist.js') ?>"></script>
			<!-- endinject -->
			<!-- Custom js for this page-->
			<script src="<?= base_url('assets/js/dashboard/js/file-upload.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/js/typeahead.js') ?>"></script>
			<script src="<?= base_url('assets/js/dashboard/js/select2.js') ?>"></script>
			<!-- End custom js for this page-->
			<!-- Custom js for this page-->
			<script src="<?= base_url('assets/js/dashboard/js/chart.js') ?>"></script>
			<!-- End custom js for this page-->
			<!-- Sweet Alert -->
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<!-- Scripts -->
			<script src="<?= base_url('assets/js/notifIt.js') ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/jquery.validate.js') ?>" type="text/javascript"></script>
			<!-- Script propio -->
			<script src="<?= base_url('assets/js/functions/main.js?v=1.0.8.61219') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/registro.js?v=1.0.0.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/login.js?v=1.0.7.61342') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/super.js?v=1.0.0.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/perfil.js?v=1.0.1.61342') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/solicitudes.js?v=1.0') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/docentes.js?v=1.61342') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/contacto.js?v=1.0.8.61') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/estadisticas.js?v=1.0.8.62') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/encuesta.js?v=1.0.8.62') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/observaciones.js?v=1.1.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/estados.js?v=1.2.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/resoluciones.js?v=1.4.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/nits.js?v=1.5.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/panel.js?v=1.0.1') . time() ?>" type="text/javascript"></script>
			<script src="<?= base_url('assets/js/functions/formularios.js?v=1.0.1') . time() ?>" type="text/javascript"></script>
			<script type="text/javascript">
				$(window).on('load', function() {
					$(".se-pre-con").fadeOut("slow");
				});
			</script>
		</div>
	</body>
</html>
