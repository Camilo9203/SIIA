<?php
//echo '<pre>';
//var_dump($organizacion);
//echo '</pre>';
//die();
/***
 * @var $organizacion
 * @var $usuario
 *
 */
?>
<div class="container">
	<div class="row" id="">
		<h4>Datos Básicos de la Organización:</h4>
		<div class="col-12 card" id="datos_basicos" style="padding: 10px">
			<!-- Información resumen -->
			<div class="col-4" style="float: left; margin-right: 20px">
				<img class="img-responsive thumbnail" src="<?php echo base_url(); ?>uploads/logosOrganizaciones/<?php echo $organizacion->imagenOrganizacion; ?>" height="200" width="200">
			</div>
			<div class="col-6 pl-5" style="display: inline-block; vertical-align:top;">
				<label>Organización:</label><br>
				<p><?php echo $organizacion->nombreOrganizacion; ?></p>
				<label>NIT</label><br>
				<p><?php echo $organizacion->numNIT; ?></p>
				<label>Sigla</label><br>
				<p><?php echo $organizacion->sigla; ?></p>
				<label>Representante legal</label><br>
				<p><?php echo $organizacion->primerNombreRepLegal; ?> <?php echo $organizacion->primerApellidoRepLegal; ?></p>
			</div>
			<div class="col-6 pl-5" style="display: inline-block; vertical-align:top;">
				<label>Correo electrónico</label><br>
				<p><?php echo $organizacion->direccionCorreoElectronicoOrganizacion; ?></p>
				<label>Correo electrónico del representante</label><br>
				<p><?php echo $organizacion->direccionCorreoElectronicoRepLegal; ?></p>
				<label>Nombre de suario:</label><br>
				<p><?php echo $usuario->usuario; ?></p>
			</div>
			<hr>
			<!-- Configuración select -->
			<h5>Configuración</h5>
			<select id="configuracion" class="selectpicker form-control show-tick" autocomplete="off">
				<option value="1">Información básica</option>
				<option value="2">Firma representante legal</option>
				<option value="3">Datos inicio de sesión</option>
				<option value="4">Certificados</option>
				<option value="5">Actividad</option>
			</select>
			<hr>
		</div>
		<!-- Información básica -->
		<div class="col-12 card" id="informacionBasicaPerfil">
			<div class="container">
				<div class="col-md-12 p-5">
					<?php echo form_open_multipart('', array('id' => 'formulario_actualizar_imagen')); ?>
					<h4>Cambio de imagen / logo de la organizacion:</h4><small>La imagen tiene que ser de 240px x 95px (Ancho x Alto) para el certificado.</small>
					<div class="form-group">
						<input type="file" class="form-control" form="formulario_actualizar_usuario" name="imagen" id="imagen" required="" accept="image/jpeg, image/png">
					</div>
					</form>
					<button class="btn btn-siia btn-sm pull-right submit" name="actualizar_imagen" id="actualizar_imagen">Actualizar imagen / logo <i class="fa fa-check" aria-hidden="true"></i></button>
					<?php echo form_open('', array('id' => 'formulario_actualizar')); ?>
				</div>
				<hr>
				<div class="col-md-6 p-5">
					<hr/>
					<h4>Actualizar información básica:</h4>
					<div class="form-group">
						<label for="organizacion">Organizacion: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="organizacion" id="organizacion" placeholder="Nombre Organización" required="" value="<?php echo $nombreOrganizacion; ?>">
					</div>
					<div class="form-group">
						<label for="nit">NIT de la organización: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="nit" id="nit" placeholder="Numero NIT" required="" value="<?php echo $numNIT; ?>">
					</div>
					<div class="form-group">
						<label for="sigla">Sigla de la organización: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="sigla" id="sigla" placeholder="Sigla de la organización" required="" value="<?php echo $sigla; ?>">
					</div>
					<div class="form-group">
						<label for="primer_nombre_rep_legal">Primer nombre del representante legal: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="primer_nombre_rep_legal" id="nombre" placeholder="Primer nombre representante" required="" value="<?php echo $primerNombreRepLegal; ?>">
					</div>
					<div class="form-group">
						<label for="segundo_nombre_rep_legal">Segundo nombre del representante legal:</label>
						<input type="text" class="form-control" form="formulario_actualizar" name="segundo_nombre_rep_legal" id="nombre_s" placeholder="Segundo nombre representante" value="<?php echo $segundoNombreRepLegal; ?>">
					</div>
					<div class="form-group">
						<label for="primer_apellido_rep_regal">Primer apellido del representante legal: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="primer_apellido_rep_regal" id="apellido" placeholder="Primer apellido representante" required="" value="<?php echo $primerApellidoRepLegal; ?>">
					</div>
					<div class="form-group">
						<label for="segundo_apellido_rep_regal">Segundo apellido del representante legal:</label>
						<input type="text" class="form-control" form="formulario_actualizar" name="segundo_apellido_rep_regal" id="apellido_s" placeholder="Segundo apellido representante" value="<?php echo $segundoApellidoRepLegal; ?>">
					</div>
					<div class="form-group">
						<label for="numCedulaCiudadaniaPersona">Numero de Cédula: <span class="spanRojo">*</span></label>
						<input type="text" name="numCedulaCiudadaniaPersona" id="numCedulaCiudadaniaPersona" placeholder="Numero de cédula..." class="form-control" required="" value="<?php echo $data_informacion_general ->numCedulaCiudadaniaPersona; ?>">
					</div>
				</div>
				<div class="col-md-6 p-5">
					<div class="form-group">
						<label for="correo_electronico">Correo electrónico de la organización: <span class="spanRojo">*</span></label>
						<input type="email" class="form-control" form="formulario_actualizar" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico de la organización" required="" value="<?php echo $direccionCorreoElectronicoOrganizacion ?>">
					</div>
					<div class="form-group">
						<label for="correo_electronico_rep_legal">Correo electrónico del representante legal: <span class="spanRojo">*</span></label>
						<input type="email" class="form-control" form="formulario_actualizar" name="correo_electronico_rep_legal" id="correo_electronico_rep_legal" placeholder="Correo electrónico del representante legal" required="" value="<?php echo $direccionCorreoElectronicoRepLegal ?>">
					</div>
					<div class="form-group">
						<label for="tipo_organizacion">Tipo de Organización: <span class="spanRojo">*</span></label>
						<br>
						<select name="tipo_organizacion" id="tipo_organizacion" class="selectpicker form-control show-tick" required="">
							<optgroup label="Actual">
								<option id="0" value="<?php echo $data_informacion_general->tipoOrganizacion; ?>" selected><?php echo $data_informacion_general->tipoOrganizacion; ?></option>
							</optgroup>
							<optgroup label="Actualizar">
								<option id="1" value="Asociación">Asociación</option>
								<option id="2" value="Asociación Mutual">Asociación Mutual</option>
								<option id="3" value="Cooperativa de Trabajo Asociado">Cooperativa de Trabajo Asociado</option>
								<option id="4" value="Cooperativa Especializada">Cooperativa Especializada</option>
								<option id="5" value="Cooperativa Integral">Cooperativa Integral</option>
								<option id="6" value="Cooperativa Multiactiva">Cooperativa Multiactiva</option>
								<option id="7" value="Corporación">Corporación</option>
								<option id="8" value="Empresa asociativa de trabajo">Empresa asociativa de trabajo</option>
								<option id="9" value="Empresa Comunitaria">Empresa Comunitaria</option>
								<option id="10" value="Empresa de servicios en forma de administración pública">Empresa de servicios en forma de administración pública</option>
								<option id="11" value="Empresa Solidaria de Salud">Empresa Solidaria de Salud</option>
								<option id="12" value="Federación y Confederación">Federación y Confederación</option>
								<option id="13" value="Fondo de empleados">Fondo de empleados</option>
								<option id="14" value="Fundación">Fundación</option>
								<option id="15" value="Institución Universitaria">Institución Universitaria</option>
								<option id="16" value="Instituciones auxiliares de Economía Solidaria">Instituciones auxiliares de Economía Solidaria</option>
								<option id="17" value="Precooperativa">Precooperativa</option>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="departamentos">Departamento: <span class="spanRojo">*</span></label>
						<br>
						<select name="departamentos" id="departamentos" data-id-dep="1" class="selectpicker form-control show-tick departamentos" required="">
							<optgroup label="Actual">
								<option id="0" value="<?php echo $data_informacion_general->nomDepartamentoUbicacion; ?>" selected><?php echo $data_informacion_general->nomDepartamentoUbicacion; ?></option>
							</optgroup>
							<optgroup label="Actualizar">
								<?php
								foreach($departamentos as $departamento){
									?>
									<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
									<?php
								}
								?>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<div id="div_municipios">
							<label for="municipios">Municipio: <span class="spanRojo">*</span></label>
							<br>
							<select name="municipios" id="municipios" class="selectpicker form-control show-tick municipios" required="">
								<optgroup label="Actual">
									<option id="0" value="<?php echo $data_informacion_general->nomMunicipioNacional; ?>" selected><?php echo $data_informacion_general->nomMunicipioNacional; ?></option>
								</optgroup>
								<optgroup label="Actualizar">
									<?php
									foreach($municipios as $municipio){
										?>
										<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
										<?php
									}
									?>
								</optgroup>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="direccion">Dirección: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" name="direccion" id="direccion" required="" placeholder="Dirección" value="<?php echo $data_informacion_general ->direccionOrganizacion; ?>">
					</div>
					<div class="form-group">
						<label>Fax - Teléfono: <span class="spanRojo">*</span></label>
						<input type="text" name="fax" id="fax" class="form-control" required="" placeholder="Fax - Teléfono" value="<?php echo $data_informacion_general ->fax; ?>">
					</div>
					<div class="checkbox">
						<label for="extension_checkbox"><input type="checkbox" name="extension_checkbox" id="extension_checkbox" class=""> ¿Tiene Extensión?</label>
					</div>
					<div class="form-group">
						<div  id="div_extension">
							<label for="extension">Extensión:</label>
							<input type="text" name="extension" id="extension" class="form-control" placeholder="Extensión" value="<?php echo $data_informacion_general ->extension; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Dirección Web:</label>
						<input type="text" name="urlOrganizacion" id="urlOrganizacion" placeholder="www.orgsolidarias.gov.co" class="form-control" value="<?php echo $data_informacion_general ->urlOrganizacion; ?>">
					</div>
					<div class="form-group">
						<label for="actuacion">Ámbito de Actuación de la Entidad: <span class="spanRojo">*</span></label>
						<br>
						<select name="actuacion" id="actuacion" class="selectpicker form-control show-tick" required="">
							<optgroup label="Actual">
								<option id="0" value="<?php echo $data_informacion_general->actuacionOrganizacion; ?>" selected><?php echo $data_informacion_general->actuacionOrganizacion; ?></option>
							</optgroup>
							<optgroup label="Actualizar">
								<option id="1" value="Departamental">Departamental</option>
								<option id="2" value="Municipal">Municipal</option>
								<option id="3" value="Nacional">Nacional</option>
								<option id="4" value="Regional">Regional</option>
							</optgroup>
						</select>
					</div>
					<div class="form-group">
						<label for="educacion">Tipo de Educación: <span class="spanRojo">*</span></label>
						<br>
						<select name="educacion" id="educacion" class="selectpicker form-control show-tick" required="">
							<optgroup label="Actual">
								<option id="0" value="<?php echo $data_informacion_general->tipoEducacion; ?>" selected><?php echo $data_informacion_general->tipoEducacion; ?></option>
							</optgroup>
							<optgroup label="Actualizar">
								<option id="1" value="Educacion para el trabajo y el desarrollo humano">Educacion para el trabajo y el desarrollo humano</option>
								<option id="2" value="Formal">Formal</option>
								<option id="3" value="Informal">Informal</option>
							</optgroup>
						</select>
					</div>
					<h4>¿Quien actualiza la información?</h4>
					<div class="form-group">
						<label for="primer_nombre_persona">Primer nombre: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="primer_nombre_persona" id="nombre_p" placeholder="Primer Nombre" required="">
					</div>
					<div class="form-group">
						<label for="primer_apellido_persona">Primer apellido: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_actualizar" name="primer_apellido_persona" id="apellido_p" placeholder="Primer Apellido" required="">
					</div>
					</form>
					<button class="btn btn-siia btn-sm pull-right submit" name="actualizar_informacion" id="actualizar_informacion">Actualizar información <i class="fa fa-check" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
		<!-- Firma representante legal -->
		<div class="col-12 card" id="firmaRepLegalPerfil">
			<div class="container">
				<div class="form-group">
					<h4>Firma del representante legal.</h4>
					<label>Contraseña de la firma: <span class="spanRojo">*</span></label><br>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" form="" name="contrasena_firma_rep" id="contrasena_firma_rep" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required=""><br>
					<button class="btn btn-siia btn-sm pull-right" id="ver_fir_rep_legal">Ver firma representante <i class="fa fa-check" aria-hidden="true"></i></button>
					<img src="<?php echo base_url('uploads/logosOrganizaciones/firma/'.$firma.'')?>" class="center-block img-responsive thumbnail" id="firma_rep_legal">
				</div>
				<hr/>
				<?php echo form_open_multipart('', array('id' => 'formulario_actualizar_firma')); ?>
				<h4>Cambio de firma del representante legal:</h4><small>La imagen actual se reemplazara con la nueva, asimismo la contraseña.</small>
				<div class="form-group">
					<input type="file" class="form-control" form="formulario_actualizar_firma" name="firma" id="firma" required="" accept="image/jpeg, image/png">
					<label>Contraseña de la firma: <span class="spanRojo">*</span></label>
					<input type="password" class="form-control" form="" name="contrasena_firma" id="contrasena_firma" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="">
				</div>
				<div class="form-group">
					<label>Vuelva a escribir la contraseña de la firma: <span class="spanRojo">*</span></label><br>
					<input type="password" class="form-control" form="" name="re_contrasena_firma" id="re_contrasena_firma" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="">
				</div>
				</form>
				<button class="btn btn-siia btn-sm pull-right submit" name="actualizar_firma" id="actualizar_firma">Actualizar firma representante <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
		</div>
		<div class="col-12 card" id="datosSesion">
			<div class="container">
				<hr/>
				<!--<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ayuda_login">?</button>-->
				<?php echo form_open('', array('id' => 'formulario_actualizar_contrasena')); ?>
				<h4>Cambio de contraseña:</h4>
				<div class="form-group">
					<label for="contrasena_anterior">Contraseña anterior: <span class="spanRojo">*</span></label>
					<div class="pw-cont">
						<input type="password" class="form-control" form="formulario_actualizar_contrasena" name="contrasena_anterior" id="contrasena_anterior" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="">
						<span id="show-pass4"><i class="fa fa-eye" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="form-group">
					<label for="contrasena_nueva">Contraseña nueva: <span class="spanRojo">*</span></label>
					<div class="pw-cont">
						<input type="password" class="form-control" form="formulario_actualizar_contrasena" name="contrasena_nueva" id="contrasena_nueva" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="">
						<span id="show-pass5"><i class="fa fa-eye" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="form-group">
					<label for="re_contrasena_nueva">Vuelva a escribir la contraseña nueva: <span class="spanRojo">*</span></label>
					<div class="pw-cont">
						<input type="password" class="form-control" form="formulario_actualizar_contrasena" name="re_contrasena_nueva" id="re_contrasena_nueva" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="">
						<span id="show-pass6"><i class="fa fa-eye" aria-hidden="true"></i></span>
					</div>
				</div>
				</form>
				<button class="btn btn-siia btn-sm pull-right submit" name="actualizar_contrasena" id="actualizar_contrasena">Actualizar contraseña <i class="fa fa-check" aria-hidden="true"></i></button>
				<div class="clearfix"></div>
				<hr/>
				<?php echo form_open('', array('id' => 'formulario_actualizar_usuario')); ?>
				<h4>Cambio de nombre de usuario:</h4>
				<div class="form-group">
					<label for="usuario_nuevo">Usuario nuevo: <span class="spanRojo">*</span></label>
					<input type="text" class="form-control" form="formulario_actualizar_usuario" name="usuario_nuevo" id="usuario_nuevo" placeholder="Nuevo Nombre de Usuario" required="">
				</div>
				</form>
				<button class="btn btn-siia btn-sm pull-right submit" name="actualizar_usuario" id="actualizar_usuario">Actualizar nombre de usuario <i class="fa fa-check" aria-hidden="true"></i></button>
				<div class="clearfix"></div>
				<hr/>
			</div>
		</div>
		<div class="col-12 card" id="certificados">
			<div class="container">
				<?php echo form_open_multipart('', array('id' => 'formulario_firma_certifi')); ?>
				<h4>Firma de certificados:</h4><small>Solamente se aceptan imagenes en formato png (fondo transparente), con 450px x 300px (Ancho x Alto) para el certificado.</small>
				<div class="form-group">
					<input type="file" class="form-control" form="formulario_firma_certifi" name="firmaCert" id="firmaCert" required="" accept="image/png">
				</div>
				</form>
				<button class="btn btn-siia btn-sm pull-left submit" name="eliminar_firma_certifi" id="eliminar_firma_certifi">Eliminar firma certificados <i class="fa fa-check" aria-hidden="true"></i></button>
				<button class="btn btn-siia btn-sm pull-right submit" name="actualizar_firma_certifi" id="actualizar_firma_certifi">Actualizar firma certificados <i class="fa fa-check" aria-hidden="true"></i></button>
				<div class="clearfix"></div>
				<hr/>
				<a href="<?php echo base_url("uploads/logosOrganizaciones/firmaCert/$firmaCert"); ?>" target="_blank">Ver firma de certificados</a>
				<div class="clearfix"></div>
				<hr/>
				<div class="form-group">
					<label for="nombrePersonaCert">Persona que firmara los certificados: <span class="spanRojo">*</span></label>
					<input type="text" class="form-control" name="nombrePersonaCert" id="nombrePersonaCert" placeholder="Nombre..." value="<?php echo $personaCert; ?>">
				</div>
				<div class="form-group">
					<label for="cargoPersonaCert">Cargo de la persona que firmara los certificados: <span class="spanRojo">*</span></label>
					<input type="text" class="form-control" name="cargoPersonaCert" id="cargoPersonaCert" placeholder="Cargo..." value="<?php echo $cargoCert; ?>">
				</div>
				<button class="btn btn-siia btn-sm pull-right" name="actualizar_nombreCargo" id="actualizar_nombreCargo">Actualizar nombre y cargo <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
		</div>
		<br>
	</div>
</div>
