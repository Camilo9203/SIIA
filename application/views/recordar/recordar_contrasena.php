<div id="recordar" class="col-md-12">
<?php echo form_open('', array('id' => 'formulario_recordar')); ?>
    <div class="form-group">
        <label for="nombre_usuario_rec">Nombre de usuario: <span class="spanRojo">*</span></label>
        <input type="text" class="form-control" name="nombre_usuario_rec" id="nombre_usuario_rec" placeholder="Nombre de usuario..." required="" autofocus>
    </div>
    <div class="form-group">
        <label for="correo_electronico_rec">Correo electrónico de la organización: <span class="spanRojo">*</span></label>
        <input type="email" class="form-control" name="correo_electronico_rec" id="correo_electronico_rec" placeholder="Correo electronico de la organización..." required="">
    </div>
    <div class="form-group">
	    <label class="underlined"><input type="checkbox" id="acepto_cond_rec" name="aceptocond_rec" class="pull-left" value="*Acepto que yo soy el usuario de este correo." required=""><label for="aceptocond_rec">&nbsp;</label> <a><span class="spanRojo">*</span>Acepto que yo soy el usuario de este correo.</label></a><small class="pull-right"><i>Clic en el texto</i></small>
    </div>
    <div class="form-group">
        <form>
            <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
        </form>
    </div>
	<img src="<?php echo base_url(); ?>assets/img/loading.gif" id="loading" class="img-responsive col-md-2">
    <div class="form-group">
        <button name="recordar_contrasena" id="recordar_contrasena" class="btn btn-block btn-siia submit">Listo, recordar. <i class="fa fa-check"></i></button>
    </div>
    <div class="form-group">
        <div id="mensaje" class="col-md-12 alert" role="alert"></div>
    </div>
</form>
</div>