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
				<button type="button" name="inicioSesion" id="inicio_sesion" class="btn btn-siia btn-sm pull-right submit">Iniciar Sesión <i class="fa fa-sign-in" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-danger btn-sm registrar">Registrarme <i class="fa fa-file-text" aria-hidden="true"></i></button>
			</div>
			<label class="underlined"><a id="recordar_contrasena_login"><small><i>¿Has olvidado la contraseña?</i></small></a></label>
			<img src="<?php echo base_url(); ?>assets/img/loading.gif" id="loading" class="img-responsive col-md-2">
			<div class="form-group">
				<div id="mensaje" class="col-md-12 alert" role="alert"></div>
			</div>
		<?php echo form_close(); ?>
	</div>
