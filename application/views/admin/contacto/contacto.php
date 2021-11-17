<!-- Division -->
<div class="container">
	<div class="clearfix"></div>
	<hr />
</div>
<div class="container">
	<div class="col-md-12">
		<h4>Seleccione la Prioridad del mensaje, escriba el asunto del mensaje y por ultimo escriba el mensaje.</h4>
		<hr />
		<form>
			<div class="checkbox">
				<label><input type="checkbox" id="contacto_enviar_copia_admin_todos" name="contaco_enviar"> Enviar comunicado a todas la entidades en el SIIA</label>
				<br>
				<label><input type="checkbox" id="contacto_enviar_copia_admin_todos_acre" name="contaco_enviar"> Enviar comunicado a todas la entidades <strong>Acreditadas</strong> en el SIIA</label>
				<br>
				<label><input type="checkbox" disabled id="envioHTML" name="envioHTML" checked> Copiar correo con HTML Tags</label>
			</div>
			<div id="comunicado">
				<div class="form-group">
					<label>Correo Electronico de la Organización:</label>
					<!-- <input type="text" id="contacto_correo_electronico_admin" class="form-control" name="" value="" placeholder="Correo Electronico de la Organización"> -->
					<select class="selectpicker form-control show-tick" aria-label="contacto_correo_electronico_admin" id="contacto_correo_electronico_admin" name="contacto_correo_electronico_admin" required>
						<option selected>Seleccione una opción</option>
						<?php foreach ($emails as $email) : ?>
							<option value="<?php echo $email->direccionCorreoElectronicoOrganizacion ?>"><?php echo $email->direccionCorreoElectronicoOrganizacion ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" id="contacto_enviar_copia_admin" class="" name="contacto_enviar_copia_admin" disabled> Enviar con copia al correo del representante legal</label>
				</div>
				<div id="contacto_copia_admin" class="form-group">
					<label>Correo Electronico del Representante Legal:</label>
					<input type="text" id="contacto_correo_electronico_rep_admin" class="form-control" name="" value="" placeholder="Correo Electronico del Representante Legal">
				</div>
			</div>
			<div class="form-group">
				<label>Prioridad:*</label>
				<br>
				<select id="contacto_prioridad_admin" class="selectpicker form-control show-tick" required>
					<option value="Urgente">Urgente</option>
					<option value="Importante">Importante</option>
					<option value="Ninguna">Ninguna</option>
				</select>
			</div>
			<div class="form-group">
				<label>Asunto:*</label>
				<input class="form-control" id="contacto_asunto_admin" type="text" name="" placeholder="Asunto..." required>
			</div>
			<div class="form-group">
				<label>Mensaje:*</label>
				<textarea id="contacto_mensaje_admin" class="form-control" placeholder="Mensaje..."></textarea>
			</div>
			<button class="btn btn-danger btn-sm pull-left" id="admin_contacto_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
			<button class="btn btn-siia btn-sm pull-right" id="enviar_correo_contacto_admin" name="">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		</form>
	</div>
</div>
<!-- Tabla Usuarios en linea -->
<div class="container">
	<div class="clearfix"></div>
	<hr />
	<h4>Usuarios en linea:</h4>
	<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td>Id Usuario</td>
				<td>Usuario</td>
			</tr>
		</thead>
		<tbody id="tbody">
			<?php
			foreach ($usuarios as $usuario) {
				echo "<tr><td>$usuario->id_usuario</td>";
				echo "<td>$usuario->usuario</td></tr>";
			}
			?>
		</tbody>
	</table>
</div>
