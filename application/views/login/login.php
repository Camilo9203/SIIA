<div class="center-block" role="main">
	<div id="login" class="col-md-3 center-block">
		<?php echo form_open('', array('id' => 'formulario_login')); ?>
		<!--<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ayuda_login">?</button>-->
		<h3>Iniciar Sesión</h3>
		<hr />
		<div class="form-group">
			<label for="usuario"><i class="fa fa-user" aria-hidden="true"></i> Nombre de usuario: <span class="spanRojo">*</span></label>
			<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de usuario..." required="" autofocus>
		</div>
		<div class="form-group">
			<label for="password"><i class="fa fa-key" aria-hidden="true"></i> Contraseña: <span class="spanRojo">*</span></label>
			<div class="pw-cont">
				<input type="password" name="password" class="form-control" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="" size="10" autocomplete="off">
				<span id="show-pass3"><i class="fa fa-eye" aria-hidden="true"></i></span>
			</div>
		</div>
		<hr />
		<div class="form-group">
			<form>
				<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
			</form>
		</div>
		<div class="form-group">
			<button type="button" name="inicioSesion" id="inicio_sesion" class="btn btn-siia btn-sm pull-right submit">Iniciar Sesión <i class="fa fa-sign-in" aria-hidden="true"></i></button>
			<button type="button" class="btn btn-danger btn-sm registrar">Registrarme <i class="fa fa-file-text" aria-hidden="true"></i></button>
		</div>
		<label class="underlined"><a href="#" data-toggle="modal" data-target="#recordar_contrasena" id="recordar_contraseña"><small><i>¿Has olvidado la contraseña?</i></small></a></label>
		<img src="<?php echo base_url(); ?>assets/img/loading.gif" id="loading" class="img-responsive col-md-2">
		<div class="form-group">
			<div id="mensaje" class="col-md-12 alert" role="alert"></div>
		</div>
		</form>
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
