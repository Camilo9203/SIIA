<div class="center-block" role="main">
	<div id="login_admin" class="col-md-3 center-block">
		<?php echo form_open('', array('id' => 'formulario_login_admin')); ?>
		<!--<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ayuda_login">?</button>-->
		<h3>Iniciar Sesión</h3>
		<hr />
		<div class="form-group">
			<label for="usuario"><i class="fa fa-user" aria-hidden="true"></i> Nombre de usuario: <span class="spanRojo">*</span></label>
			<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Nombre de usuario..." required="" size="10" autofocus>
		</div>
		<div class="form-group">
			<label for="password"><i class="fa fa-key" aria-hidden="true"></i> Contraseña: <span class="spanRojo">*</span></label>
			<input type="password" name="password" class="form-control" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="" size="10" autocomplete="off">
		</div>
		<hr />
		<a data-toggle="modal" data-target="#recordar_contrasena" id="recordar_contraseña">¿Recordar Contraseña?</a>
		<div class="form-group">
			<form>
				<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
			</form>
		</div>
		<div class="form-group">
			<button type="button" name="inicioSesion" id="inicio_sesion_admin" class="btn btn-siia btn-sm submit">Iniciar Sesión <i class="fa fa-sign-in" aria-hidden="true"></i></button>
		</div>
		<div class="form-group">
			<img src="<?php echo base_url(); ?>assets/img/loading.gif" id="loading" class="img-responsive col-md-2">
			<div id="mensaje" class="col-md-12 alert" role="alert"></div>
		</div>
		</form>
	</div>