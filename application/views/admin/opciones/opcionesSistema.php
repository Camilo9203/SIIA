<div class="container">
	<div class="clearfix"></div>
	<hr/>
	<h4>Opciones del sistema:</h4>
	<!--<div class="form-group">
		<label>Nombre de la aplicacion:</label>
		<input type="text" id="admin_nombre_aplicacion" class="form-control" name="" value="<?php echo $opciones[0]->valor; ?>">
	</div>
	<input type="button" class="btn btn-siia" id="admin_actualizar_nombre_aplicacion" value="Actualizar">-->
	<div class="form-group">
		<h4>Imagen Header Derecha <small>PNG, JPG</small></h4>
		<input type="file" required accept="image/jpeg, image/png" class="form-control" data-val="imagen_h_der" name="imagen_h_der" id="imagen_h_der">
		<input type="button" class="btn btn-siia btn-sm imagen_header_der fa-fa" data-name="imagen_h_der" name="h_der" id="h_der" value="Guardar &#xf00c">
	</div>
	<div class="form-group">
		<h4>Imagen Header Izquierda <small>PNG, JPG</small></h4>
		<input type="file" required accept="image/jpeg, image/png" class="form-control" data-val="imagen_h_izq" name="imagen_h_izq" id="imagen_h_izq">
		<input type="button" class="btn btn-siia btn-sm imagen_header_izq fa-fa" data-name="imagen_h_izq" name="h_izq" id="h_izq" value="Guardar &#xf00c">
	</div>
	<a href="<?php echo base_url('panelAdmin/opciones'); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>