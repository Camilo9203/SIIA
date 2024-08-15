<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 */
if($logged_in == FALSE && $tipo_usuario == "none"): ?>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth px-0 admin-login">
				<div class="row w-100 mx-0">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left py-5 px-4 px-sm-5">
							<div class="brand-logo">
								<a href="<?= base_url()?>"><img src="<?= base_url('assets/img/siia_logo.png') ?>" alt="logo"></a>
							</div>
							<h4>Módulo Administradores </h4>
							<h6 class="font-weight-light">Inicia sesión para continuar.</h6>
							<?= form_open('', array('id' => 'formulario_login_admin', 'class' => 'pt-3')); ?>
								<div class="form-group">
									<label for="usuario"><i class="fa fa-user" aria-hidden="true"></i> Nombre de usuario: <span class="spanRojo">*</span></label>
									<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de usuario..." required="" size="10" autofocus>
								</div>
								<div class="form-group">
									<label for="password"><i class="fa fa-key" aria-hidden="true"></i> Contraseña: <span class="spanRojo">*</span></label>
									<div class="input-group mb-4">
										<div class="input-group-prepend">
											<span class="input-group-text" id="show-pass3"><a href="#"><i class="icon-eye"></i></a></span>
										</div>
										<input type="password" name="password" class="form-control" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required size="10" autocomplete="off">
									</div>
								</div>
								<div class="mt-3">
									<a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="inicio_sesion_admin">Iniciar Sesión</a>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<div class="form-check">
										<label class="form-check-label text-muted">
											<input type="checkbox" class="form-check-input">
											Recordarme
										</label>
									</div>
									<a href="#" class="auth-link text-black">Recordar contraseña?</a>
								</div>
								<div class="text-center mt-4 font-weight-light">
									No tienes cuenta? <a href="<?= base_url('registro') ?>" class="text-primary">Registrate</a>
								</div>
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<!-- Corrección footer -->
</div>

