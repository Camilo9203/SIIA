<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper align-items-center auth px-0">
			<div class="row w-100 mx-0">
				<div class="col-lg-6 mx-auto">
					<div class="auth-form-light text-left py-5 px-4 px-sm-5">
						<div class="brand-logo">
							<img src="https://acreditacion.uaeos.gov.co/siia/assets/img/siia_logo.png" alt="logo">
						</div>
						<h4>Bienvenido!</h4>
						<h6 class="font-weight-light">Inicia sesión para continuar.</h6>
						<?php echo form_open('', array('id' => 'formulario_login')); ?>
							<div class="form-group">
								<input type="text" class="form-control form-control-lg" name="usuario" id="usuario" placeholder="Nombre de usuario">
							</div>
							<div class="form-group">
								<input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="" size="10" autocomplete="off">
							</div>
							<div class="form-group">
								<form>
									<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
								</form>
							</div>
							<div class="mt-3">
								<button type="button" name="inicioSesion" id="inicio_sesion" class="btn btn-block btn-primary btn-md font-weight-medium auth-form-btn submit">INICIAR SESIÓN <i class="mdi mdi-account-check" aria-hidden="true"></i></button>
							</div>
							<div class="my-2 d-flex justify-content-between align-items-center">
<!--								<div class="form-check">-->
<!--									<label class="form-check-label text-muted">-->
<!--										<input type="checkbox" class="form-check-input">-->
<!--										Mantenerme registrado-->
<!--									</label>-->
<!--								</div>-->
								<a href="#" data-toggle="modal" data-target="#recordar_contrasena" id="recordar_contraseña" class="auth-link text-black">Has olvidado tu contraseña?</a>
							</div>
<!--							<div class="mb-2">-->
<!--								<button type="button" class="btn btn-block btn-facebook auth-form-btn">-->
<!--									<i class="ti-facebook mr-2"></i>Connect using facebook-->
<!--								</button>-->
<!--							</div>-->
							<div class="text-center mt-4 font-weight-light">
								No tengo una cuenta? <a href="" class="text-primary registrar">Crear</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- content-wrapper ends -->
	</div>
	<!-- page-body-wrapper ends -->
</div>

<!-- Modal Recordar - Inicio -->
<div class="modal fade" id="recordar_contrasena" tabindex="-1" role="dialog" aria-labelledby="recordarContrasena">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="recordarContrasena">Recordar la contraseña.</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe title="Recordar" src="<?php echo base_url(); ?>recordar" class="embed-responsive-item"></iframe>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Recordar - FIN -->


<!-- Anterior Login-->

<!--<div class="container-fluid">-->
<!--	<div class="row justify-content-md-center">-->
<!--		<div id="login" class="col-md-4">-->
<!--			<div class="card p-4 mb-3">-->
<!--				<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#ayuda_login">?</button>-->
<!--				<h3>Iniciar Sesión</h3>-->
<!--				<hr/>-->
<!--				<div class="form-group">-->
<!--					<label for="usuario"><i class="fa fa-user" aria-hidden="true"></i> Nombre de usuario: <span class="spanRojo">*</span></label>-->
<!--					<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de usuario..." required="" autofocus>-->
<!--				</div>-->
<!--				<div class="form-group">-->
<!--					<label for="password"><i class="fa fa-key" aria-hidden="true"></i> Contraseña: <span class="spanRojo">*</span></label>-->
<!--					<input type="password" name="password" class="form-control" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="" size="10" autocomplete="off">-->
<!--				</div>-->
<!--				<hr />-->
<!--				<div class="form-group">-->
<!--					<form>-->
<!--						<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>-->
<!--					</form>-->
<!--				</div>-->
<!--				<div class="form-group">-->
<!--					<button type="button" n class="btn btn btn-round btn-high text-capitalize btn-sm pull-right submit">INICIAR SESIÓN <i class="fa fa-sign-in" aria-hidden="true"></i></button>-->
<!--					<button type="button" class="btn btn-danger btn-sm registrar text-capitalize">Registrarme <i class="fa fa-file-text" aria-hidden="true"></i></button>-->
<!--				</div>-->
<!--				<hr/>-->
<!--				<label class="underlined"><a href="#" data-toggle="modal" data-target="#recordar_contrasena" id="recordar_contraseña"><small><i>¿Has olvidado la contraseña?</i></small></a></label>-->
<!--						<img src="--><?php //echo base_url(); ?><!--assets/img/loading.gif" id="loading" class="img-responsive col-md-2">-->
<!--				<div class="form-group">-->
<!--					<div id="mensaje" class="col-md-12 alert" role="alert"></div>-->
<!--				</div>-->
<!--				</form>-->
<!--			</div>-->
<!---->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->