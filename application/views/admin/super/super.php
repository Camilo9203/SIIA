<?php
    if($logged_in == FALSE && $tipo_usuario == "none"){
?>
<div class="container">
	<div class="col-md-12">
		<h3>Contraseña:</h3>
		<div class="form-group">
			<input type="password" id="tpssp" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required value="">
		</div>
		<input type="button" class="btn btn-siia" id="init_sp" value="Iniciar">
	</div>
</div>
<?php 
}
?>
<?php
    if($logged_in == TRUE && $tipo_usuario == "super"){
?>
<div class="container">
	<br>
	<input type="button" class="btn btn-danger pull-right" id="super_cerrar_sesion" value="Cerrar Sesión Super">
	<div class="col-md-12">
		<h3>Nuevo Administrador</h3>
		<div class="col-md-6">
			<div class="form-group">
				<label>Primer Nombre:</label>
				<input type="text" id="super_primernombre_admin" class="form-control" placeholder="Primer nombre...">
			</div>
			<div class="form-group">
				<label>Segundo Nombre:</label>
				<input type="text" id="super_segundonombre_admin" class="form-control" placeholder="Segundo nombre...">
			</div>
			<div class="form-group">
				<label>Primer Apellido:</label>
				<input type="text" id="super_primerapellido_admin" class="form-control" placeholder="Primer apellido...">
			</div>
			<div class="form-group">
				<label>Segundo Apellido:</label>
				<input type="text" id="super_segundoapellido_admin" class="form-control" placeholder="Segundo apellido...">
			</div>
			<div class="form-group">
				<label>Numero de Cedula:</label>
				<input type="text" id="super_numerocedula_admin" class="form-control" placeholder="Numero de cedula...">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Direccion correo electronico:</label>
				<input type="text" id="super_correo_electronico_admin" class="form-control" placeholder="Direccion correo electronico...">
			</div>
			<div class="form-group">
				<label>Nombre usuario:</label>
				<input type="text" id="super_nombre_admin" class="form-control" placeholder="Nombre usuario...">
			</div>
			<div class="form-group">
				<label>Contraseña:</label>
				<input type="text" id="super_contrasena_admin" class="form-control" placeholder="Contraseña...">
			</div>
			<div class="form-group">
				<label ofr="super_acceso_nvl">Nivel de acceso:</label><br/>
				<select name="super_acceso_nvl" id="super_acceso_nvl" class="selectpicker form-control show-tick" required="">
				  <option id="1" value="0">Total 0</option>
				  <option id="2" value="1">Evaluador 1</option>
				  <option id="3" value="2">Reportes 2</option>
				  <option id="4" value="3">Cámaras 3</option>
				  <option id="5" value="4">Historico 4</option>
				  <option id="6" value="5">Seguimientos 5</option>
				</select>
			</div>
			<input type="button" class="btn btn-siia" id="super_nuevo_admin" value="Ingresar Nuevo Administrador">
		</div>
	</div>
</div>
<div class="container">
<div class="clearfix"></div>
<hr/>
<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
	<thead>
		<tr>
			<td>Id</td>
			<td>Primer Nombre</td>
			<td>Segundo Nombre</td>
			<td>Primer Apellido</td>
			<td>Segundo Apellido</td>
			<td>Numero de Cedula</td>
			<td>Nombre Usuario</td>
			<td>Correo elecctronico</td>
			<td>Nivel</td>
<!-- 		<td>Contraseña</td>
			<td>Contraseña rdel</td> -->
			<!-- <td>logged_in</td> -->
			<td>Accion</td>
		</tr>
	</thead>
	<tbody id="tbody">
	<?php 
		foreach ($administradores as $administrador) {
			echo "<tr><td>$administrador->id_administrador</td>";
			echo "<td>$administrador->primerNombreAdministrador</td>";
			echo "<td>$administrador->segundoNombreAdministrador</td>";
			echo "<td>$administrador->primerApellidoAdministrador</td>";
			echo "<td>$administrador->segundoApellidoAdministrador</td>";
			echo "<td>$administrador->numCedulaCiudadaniaAdministrador</td>";
			echo "<td>$administrador->usuario</td>";
			echo "<td>$administrador->direccionCorreoElectronico</td>";
			echo "<td>$administrador->nivel</td>";
/*			echo "<td>$administrador->contrasena</td>";
			echo "<td>$administrador->contrasena_rdel</td>";*/
			/*echo "<td>$administrador->logged_in</td>";*/
			echo "<td><button class='btn btn-siia super_ver_admin_modal' data-toggle='modal' data-id='$administrador->id_administrador' data-target='#super_ver_admin'>Ver</button></td></tr>";
		}
	?>
	</tbody>
</table>
</div>
<div class="modal fade" id="super_ver_admin" tabindex="-1" role="dialog" aria-labelledby="verAdmin">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="verAdmin">Administrador <label id="super_id_admin_modal"></label> <span id="super_status_adm"></span></h4>
    </div>
    <div class="modal-body">
    	<div class="form-group">
			<label>Primer Nombre:</label>
			<input type="text" id="super_primernombre_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Segundo Nombre:</label>
			<input type="text" id="super_segundonombre_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Primer Apellido:</label>
			<input type="text" id="super_primerapellido_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Segundo Apellido:</label>
			<input type="text" id="super_segundoapellido_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Numero de Cedula:</label>
			<input type="text" id="super_numerocedula_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Nivel de acceso:</label><br/>
			<select name="super_acceso_nvl_modal" id="super_acceso_nvl_modal" class="selectpicker form-control show-tick" required="">
			  <option id="1" value="0">Total 0</option>
			  <option id="2" value="1">Evaluador 1</option>
			  <option id="3" value="2">Reportes 2</option>
			  <option id="4" value="3">Cámaras 3</option>
			  <option id="5" value="4">Historico 4</option>
			  <option id="6" value="5">Seguimientos 5</option>
			  <option id="7" value="6">Asignación 6</option>
			</select>
		</div>
    	<div class="form-group">
			<label>Nombre usuario:</label>
			<input type="text" id="super_nombre_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Contraseña:</label>
			<input type="text" id="super_contrasena_admin_modal" class="form-control" name="" value="">
		</div>
		<div class="form-group">
			<label>Direccion correo electronico:</label>
			<input type="text" id="super_correo_electronico_admin_modal" class="form-control" name="" value="">
		</div>
    </div>
    <div class="modal-footer">
    	<button type="button" class="btn btn-warning" id="super_eliminar_admin">Eliminar</button>
    	<button type="button" class="btn btn-siia" id="super_actualizar_admin">Actualizar</button>
    	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
    </div>
    </div>
  </div>
</div>
<?php 
}
?>