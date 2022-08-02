<!-- Menu Formularios -->
<div class="col-md-3 formularios">
	<div class="left_col scroll-view">
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu sidebar-menu">
			<div class="menu_section">
				<a data-form="inicio">
					<h3 class="underlined text-center">Inicio - Ver solicitud <i class="fa fa-home" aria-hidden="true"></i></h3>
				</a>
				<div id="wizard_verticle" class="form_wizard wizard_verticle">
					<ul class="nav side-menu list-unstyled wizard_steps">
						<li class="step-no"><a data-form="1" data-form-name="informacion_general"><span id="1" class="step_no menu-sel">1</span> Información General de la Entidad <i class="fa fa-home" aria-hidden="true"></i></a></li>
						<li class="step-no"><a data-form="2" data-form-name="documentacion_legal"><span id="2" class="step_no menu-sel">2</span> Documentación Legal <i class="fa fa-book" aria-hidden="true"></i></a></li>
						<!--												<li class="step-no" id="reg_doc_cond"><a data-form="3" data-form-name="registros_educativos"><span id="3" class="step_no menu-sel">3</span> Registros Educativos de Programas <i class="fa fa-newspaper-o" aria-hidden="true"></i></a></li>-->
						<li class="step-no"><a data-form="4" data-form-name="antecedentes_academicos"><span id="3" class="step_no menu-sel">3</span> Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></a></li>
						<li class="step-no"><a data-form="5" data-form-name="jornadas_actualizacion"><span id="4" class="step_no menu-sel">4</span> Jornadas de Actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></a></li>
						<li class="step-no"><a data-form="6" data-form-name="programa_economia"><span id="5" class="step_no menu-sel">5</span> Programas de Educación en Economía Solidaria <i class="fa fa-server" aria-hidden="true"></i></a></li>
						<!--												<li class="step-no"><a data-form="7" data-form-name="programa_economia" style="text-align: left;"><span id="7" class="step_no menu-sel">7</span> <small>Prog. de Economía Solidaria con Énfasis en Trabajo Asociado <i class="fa fa-sitemap" aria-hidden="true"></i></a></small></li>-->
						<!-- //TODO: Formulario 8, antes comentado -->
						<!--												<li class="step-no"><a data-form="8" data-form-name="aval_personas"><span id="8" class="step_no menu-sel">8</span> Aval de Programas <i class="fa fa-signal" aria-hidden="true"></i></a></li>-->
						<li class="step-no"><a data-form="9" data-form-name="equipo_docente"><span id="6" class="step_no menu-sel">6</span> Equipo de Facilitadores <i class="fa fa-users" aria-hidden="true"></i></a></li>
						<li class="step-no" id="itemPlataforma" style="display: none;"><a data-form="10" data-form-name="plataforma"><span id="7" class="step_no menu-sel">7</span> Datos modalidad virtual <i class="fa fa-globe" aria-hidden="true"></i></a></li>
						<li class="step-no" id="itemEnLinea" style="display: none"><a data-form="11" data-form-name="en_linea"><span id="8" class="step_no menu-sel">8</span> Datos modalidad en linea<i class="fa fa-globe" aria-hidden="true"></i></a></li>
						<li id="act_datos_sol_org" class="step-no"><a data-form="0" data-form-name="finalizar_proceso"><span class="step_no"><i class="fa fa-check" aria-hidden="true"></i></span> Finalizar Proceso <i class="fa fa-check" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-12">
		<hr />
		<a class="col-md-1 ayuda" title="Ayuda">
			<span class="fa fa-question" aria-hidden="true"></span>
		</a>
		<a class="col-md-1 contacto" title="Contacto">
			<i class="fa fa-envelope" aria-hidden="true"></i>
		</a>
		<a class="col-md-1" title="Informe de Actividades">
			<i class="fa fa-file-text" aria-hidden="true"></i>
		</a>
		<a class="col-md-1" title="Plan de Mejoramiento">
			<i class="fa fa-thumbs-up" aria-hidden="true"></i>
		</a>
		<a class="col-md-1" title="Docentes">
			<i class="fa fa-users" aria-hidden="true"></i>
		</a>
		<a class="col-md-1 ver_perfil" title="Perfil">
			<span class="fa fa-user" aria-hidden="true"></span>
		</a>
		<a data-toggle='modal' data-target='#cerrar_sesion' class="col-md-1" title="Cerrar Sesión">
			<span class="fa fa-sign-out" aria-hidden="true"></span>
		</a>
	</div> -->
	</div>
</div>
<!-- Formularios -->
<div class="col-md-9 formularios" role="main">
	<!-- Inicio del Panel Inicial -->
	<div id="estado_solicitud">
		<hr />
		<div class="form-group">
			<h3>Datos de la solicitud: <small>Los archivos y campos marcados en los formularios con asterisco (<span class="spanRojo">*</span>) son requeridos en la solicitud.</small></h3>
			<label>ID Solicitud:</label>
			<p><?php echo $data_solicitud->idSolicitud ?></p>
			<label>Estado de la organización:</label>
			<p><?php echo $data_solicitud->nombre ?></p>
			<label>Tipo de Solicitud:</label>
			<p><?php echo $data_solicitud->tipoSolicitud ?></p>
			<label>Motivo de Solicitud:</label>
			<p><?php echo $data_solicitud->motivoSolicitudAcreditado ?></p>
			<label>Modalidad de Solicitud:</label>
			<p><?php echo $data_solicitud->modalidadSolicitudAcreditado ?></p>
			<hr />
			<label>Estado anterior:</label>
			<p><?php echo $data_solicitud->estadoAnterior ?></p>

			<hr />
			<button class="btn btn-siia btn-sm verHistObsUs pull-right" id="hist_org_obs" data-toggle='modal' data-id-org="<?php echo $data_solicitud->organizaciones_id_organizacion; ?>" data-target='#verHistObsUs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
<!--			<button class="btn btn-siia btn-sm pull-right" data-toggle="modal" data-target="#modalEliminarSolicitud" id="el_sol">Actualizar/Cambiar el tipo de solicitud actual <i class="fa fa-refresh" aria-hidden="true"></i></button>-->
			<hr />
		</div>
		<div class="form-group">
			<button class="btn btn-danger btn-sm pull-left volver_al_panel"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		</div>
		<div class="clearfix"></div>
		<hr />
		<div class="form-group">
			<label>Formularios por llenar:</label>
			<div id="formulariosFaltantes"></div>
		</div>
		<hr />
	</div>
	<!-- Modal - Inicio - Eliminar Solicitud -->
	<div class="modal fade" id="modalEliminarSolicitud" tabindex="-1" role="dialog" aria-labelledby="eliminarSolicitudT">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="eliminarSolicitudT">Actualizar tipo de solicitud</h4>
				</div>
				<div class="modal-body">
					<h4>Atención:</h4>
					<ul>
						<li>Se borrarán todos los datos de la solicitud actual.</li>
						<li>Se borrara la solicitud actual.</li>
						<li>Los datos y archivos de los formularios <strong>permanecen guardados en el sistema</strong>.</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">No <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="eliminarSolicitud">Si y guardar información <i class="fa fa-check" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
	</div>
	<!-- Formulario de información general de la entidad 1 - INICIO -->
	<div id="informacion_general_entidad" data-form="1" class=" formulario_panel">
		<?php echo form_open('', array('id' => 'formulario_informacion_general_entidad')); ?>
		<h3>1. Información General de la Entidad <i class="fa fa-home" aria-hidden="true"></i></h3>
		<p>Usted debe llenar todos y cada uno de los campos requeridos y posteriormente presionar el botón Guardar y Continuar, los Campos marcados con (*) son obligatorios</p>
		<div class="col-md-4">
			<hr />
			<label>1. Información General:</label>
			<br>
			<div class="form-group">
				<label class="" for="nombre_organizacion">Nombre de la Organización:<span class="spanRojo">*</span></label>
				<input type="text" name="nombre_organizacion" id="nombre_organizacion" placeholder="Nombre de la Organización" class="form-control" value="<?php echo $data_organizacion->nombreOrganizacion; ?>">
			</div>
			<div class="form-group">
				<label for="sigla">Sigla:<span class="spanRojo">*</span></label>
				<input type="text" class="form-control" name="sigla" id="sigla" placeholder="Sigla" value="<?php echo $data_organizacion->sigla; ?>">
			</div>
			<div class="form-group">
				<label>NIT de la Organizacion:<span class="spanRojo">*</span></label>
				<input type="text" name="" id="" class="form-control" placeholder="NIT de la Organizacion" value="<?php echo $data_organizacion->numNIT; ?>">
			</div>
			<div class="form-group">
				<label for="tipo_organizacion">Tipo de Organización:<span class="spanRojo">*</span></label>
				<br>
				<select name="tipo_organizacion" id="tipo_organizacion" class="selectpicker form-control show-tick" required="">
					<optgroup label="Actual">
						<option id="0" value="<?php echo $data_informacion_general->tipoOrganizacion; ?>" selected><?php echo $data_informacion_general->tipoOrganizacion; ?></option>
					</optgroup>
					<optgroup label="Actualizar">
						<option id="1" value="Asociación">Asociación</option>
						<option id="2" value="Asociación Mutual">Asociación Mutual</option>
						<option id="4" value="Cooperativa">Cooperativa</option>
						<option id="5" value="Cooperativa de Trabajo Asociado">Cooperativa de Trabajo Asociado</option>
						<option id="6" value="Cooperativa Especializada">Cooperativa Especializada</option>
						<option id="7" value="Cooperativa Integral">Cooperativa Integral</option>
						<option id="8" value="Cooperativa Multiactiva">Cooperativa Multiactiva</option>
						<option id="9" value="Cooperativa de Ahorro y Credito">Cooperativa de Ahorro y Credito</option>
						<option id="10" value="Corporación">Corporación</option>
						<option id="11" value="Empresa asociativa de trabajo">Empresa asociativa de trabajo</option>
						<option id="12" value="Empresa Comunitaria">Empresa Comunitaria</option>
						<option id="13" value="Empresa de servicios en forma de administración pública">Empresa de servicios en forma de administración pública</option>
						<option id="14" value="Empresa Solidaria de Salud">Empresa Solidaria de Salud</option>
						<option id="15" value="Federación y Confederación">Federación y Confederación</option>
						<option id="16" value="Fondo de empleados">Fondo de empleados</option>
						<option id="17" value="Fundación">Fundación</option>
						<option id="18" value="Institución Universitaria">Institución Universitaria</option>
						<option id="19" value="Instituciones auxiliares de Economía Solidaria">Instituciones auxiliares de Economía Solidaria</option>
						<option id="20" value="Precooperativa">Precooperativa</option>
					</optgroup>
				</select>
			</div>
			<div class="form-group">
				<label for="departamentos">Departamento:<span class="spanRojo">*</span></label>
				<br>
				<select name="departamentos" id="departamentos" data-id-dep="1" class="selectpicker form-control show-tick departamentos" required="">
					<optgroup label="Actual">
						<option id="0" value="<?php echo $data_informacion_general->nomDepartamentoUbicacion; ?>" selected><?php echo $data_informacion_general->nomDepartamentoUbicacion; ?></option>
					</optgroup>
					<optgroup label="Actualizar">
						<?php
						foreach ($departamentos as $departamento) {
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
					<label for="municipios">Municipio:<span class="spanRojo">*</span></label>
					<br>
					<select name="municipios" id="municipios" class="selectpicker form-control show-tick municipios" required="">
						<optgroup label="Actual">
							<option id="0" value="<?php echo $data_informacion_general->nomMunicipioNacional; ?>" selected><?php echo $data_informacion_general->nomMunicipioNacional; ?></option>
						</optgroup>
						<optgroup label="Actualizar">
							<?php
							foreach ($municipios as $municipio) {
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
				<label for="direccion">Dirección:<span class="spanRojo">*</span></label>
				<input type="text" class="form-control" name="direccion" id="direccion" required="" placeholder="Dirección" value="<?php echo $data_informacion_general->direccionOrganizacion; ?>">
			</div>
			<div class="form-group">
				<label>Teléfono de Contacto:<span class="spanRojo">*</span></label>
				<input type="text" name="fax" id="fax" class="form-control" required="" placeholder="Fax - Teléfono" value="<?php echo $data_informacion_general->fax; ?>">
			</div>
			<div class="checkbox">
				<label for="extension_checkbox"><input type="checkbox" name="extension_checkbox" id="extension_checkbox" class=""> ¿Tiene Extensión?</label>
			</div>
			<div class="form-group">
				<div id="div_extension">
					<label for="extension">Extensión:<span class="spanRojo">*</span></label>
					<input type="text" name="extension" id="extension" class="form-control" placeholder="Extensión" value="<?php echo $data_informacion_general->extension; ?>">
				</div>
			</div>
			<div class="form-group">
				<label>Correo Electrónico de la Organizacion:<span class="spanRojo">*</span></label>
				<input type="text" name="" id="" class="form-control" placeholder="Correo Electrónico de la Organizacion" value="<?php echo $data_organizacion->direccionCorreoElectronicoOrganizacion; ?>">
			</div>
		</div>
		<div class="col-md-4">
			<hr />
			<div class="form-group">
				<label>Dirección Web:</label>
				<input type="text" name="urlOrganizacion" id="urlOrganizacion" placeholder="www.orgsolidarias.gov.co" class="form-control" value="<?php echo $data_informacion_general->urlOrganizacion; ?>">
			</div>
			<div class="form-group">
				<label for="actuacion">Ámbito de Actuación de la Entidad:<span class="spanRojo">*</span></label>
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
				<label for="educacion">Tipo de Educación:<span class="spanRojo">*</span></label>
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
			<hr />
			<label>Información Representante Legal:</label>
			<div class="form-group">
				<label for="primerNombreRepLegal">Primer Nombre:<span class="spanRojo">*</span></label>
				<input type="text" name="primerNombreRepLegal" id="primerNombreRepLegal" class="form-control" value="<?php echo $data_organizacion->primerNombreRepLegal; ?>">
			</div>
			<div class="form-group">
				<label for="segundoNombreRepLegal">Segundo Nombre:</label>
				<input type="text" name="segundoNombreRepLegal" id="segundoNombreRepLegal" class="form-control" value="<?php echo $data_organizacion->segundoNombreRepLegal; ?>">
			</div>
			<div class="form-group">
				<label for="primerApellidoRepLegal">Primer Apellido:<span class="spanRojo">*</span></label>
				<input type="text" name="primerApellidoRepLegal" id="primerApellidoRepLegal" class="form-control" value="<?php echo $data_organizacion->primerApellidoRepLegal; ?>">
			</div>
			<div class="form-group">
				<label for="segundoApellidoRepLegal">Segundo Apellido:</label>
				<input type="text" name="segundoApellidoRepLegal" id="segundoApellidoRepLegal" class="form-control" value="<?php echo $data_organizacion->segundoApellidoRepLegal; ?>">
			</div>
			<div class="form-group">
				<label>Correo Electrónico del Representante Legal:<span class="spanRojo">*</span></label>
				<input type="text" name="" id="" class="form-control" value="<?php echo $data_organizacion->direccionCorreoElectronicoRepLegal; ?>">
			</div>
			<div class="form-group">
				<label for="numCedulaCiudadaniaPersona">Numero de Cédula:<span class="spanRojo">*</span></label>
				<input type="text" name="numCedulaCiudadaniaPersona" id="numCedulaCiudadaniaPersona" class="form-control" required="" value="<?php echo $data_informacion_general->numCedulaCiudadaniaPersona; ?>">
			</div>
		</div>
		<div class="col-md-4">
			<hr />
			<label>1.2. Identificación y Presentación Institucional</label>
			<div class="form-group">
				<label for="presentacion">Presentación Institucional:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="presentacion" id="presentacion" placeholder="Presentación Institucional..."><?php echo $data_informacion_general->presentacionInstitucional; ?></textarea>
			</div>
			<div class="form-group">
				<label for="objetoSocialEstatutos">Objeto Social Segun Estatutos:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="objetoSocialEstatutos" id="objetoSocialEstatutos" placeholder="Objeto Social Segun Estatutos..."><?php echo $data_informacion_general->objetoSocialEstatutos; ?></textarea>
			</div>
			<div class="form-group">
				<label for="mision">Misión:<span class="spanRojo">*</span></label>
				<textarea class="form-control" id="mision" name="mision" placeholder="Misión..."><?php echo $data_informacion_general->mision; ?></textarea>
			</div>
			<div class="form-group">
				<label for="vision">Visión:<span class="spanRojo">*</span></label>
				<textarea class="form-control" id="vision" name="vision" placeholder="Visión..."><?php echo $data_informacion_general->vision; ?></textarea>
			</div>
			<div class="form-group">
				<label for="principios">Principios:<span class="spanRojo">*</span></label>
				<textarea class="form-control" id="principios" name="principios" placeholder="Principios..."><?php echo $data_informacion_general->principios; ?></textarea>
			</div>
			<div class="form-group">
				<label for="fines">Fines:<span class="spanRojo">*</span></label>
				<textarea class="form-control" id="fines" name="fines" placeholder="Fines..."><?php echo $data_informacion_general->fines; ?></textarea>
			</div>
			<div class="form-group">
				<label for="portafolio">Portafolio de Servicios:<span class="spanRojo">*</span></label>
				<textarea class="form-control" id="portafolio" name="portafolio" placeholder="Portafolio de Servicios..."><?php echo $data_informacion_general->portafolio; ?></textarea>
			</div>
			<div class="form-group">
				<label for="otros">Otros:</label>
				<textarea class="form-control" id="otros" name="otros" placeholder="Otros..."><?php echo $data_informacion_general->otros; ?></textarea>
			</div>
		</div>
		</form>
		<div class="col-md-12">
			<hr />
			<label>Anexar Solicitud de representante legal, fotografías de lugar de atención al público y 3 certificaciones de procesos educativos realizados por la entidad solicitante.* (Solamente se admiten formatos PDF, PNG, JPG)</label>
			<p>Anexar las certificaciones emitidas a nombre de la entidad solicitante, para verificar el requisito de experiencia y adjuntar fotografías del espacio físico de operación y atención al público.</p>
			<div class="form-group col-md-4">
				<?php echo form_open_multipart('', array('id' => 'formulario_carta')); ?>
				<h4>Carta de solicitud de representante legal <small>PDF (1)</small></h4>
				<input type="file" required accept="application/pdf" class="form-control" data-val="carta" name="carta" id="carta">
				<input type="button" class="btn btn-siia btn-sm archivos_form_carta fa-fa center-block" data-name="carta" name="cartaRep" id="cartaRep" value="Guardar archivo(s) &#xf0c7">
				</form>
			</div>
			<div class="form-group div_certificaciones col-md-4">
				<?php echo form_open_multipart('', array('id' => 'formulario_certificaciones')); ?>
				<h4>Certificaciones <small>PDF (3)</small></h4>
				<input type="file" required accept="application/pdf" class="form-control" data-val="certificaciones" name="certificaciones[]" id="certificaciones1">
				<input type="file" required accept="application/pdf" class="form-control" data-val="certificaciones" name="certificaciones[]" id="certificaciones2">
				<input type="file" required accept="application/pdf" class="form-control" data-val="certificaciones" name="certificaciones[]" id="certificaciones3">
				<input type="button" class="btn btn-siia btn-sm archivos_form_certificacion fa-fa center-block" data-name="certificaciones" name="certificaciones_organizacion" id="certificaciones_organizacion" value="Guardar archivo(s) &#xf0c7">
				</form>
			</div>
			<div class="form-group div_imagenes_lugar col-md-4">
				<h4>Imagenes <small>PNG, JPG (Max:10)</small> <a id="mas_files_imagenes"><i class="fa fa-plus" aria-hidden="true"></i></a><a id="menos_files_imagenes"> <i class="fa fa-minus" aria-hidden="true"></i></a></h4>
				<?php echo form_open_multipart('', array('id' => 'formulario_lugar')); ?>
				<div id="div_imagenes">
					<input type="file" required accept="image/jpeg, image/png" class="form-control" data-val="lugar" name="lugar[]" id="lugar1">
				</div>
				<input type="button" class="btn btn-siia btn-sm fa-fa center-block archivos_form_lugar" data-name="lugar" name="lugar_organizacion" id="lugar_organizacion" value="Guardar archivo(s) &#xf0c7">
				</form>
			</div>
			<div class="clearfix"></div>
			<hr />
			<div class="table">
				<label>Archivos:</label>
				<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>
				<table id="tabla_archivos_formulario" width="100%" border=0 class="table table-striped table-bordered tabla_form">
					<thead>
					<tr>
						<td class="col-md-4">Nombre</td>
						<td class="col-md-4">Tipo</td>
						<td class="col-md-4">Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					</tbody>
				</table>
			</div>
			<hr />
			<button class="btn btn-siia btn-sm pull-right guardar" name="guardar_formulario_informacion_general_entidad" id="guardar_formulario_informacion_general_entidad">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		</div>
	</div>
	<!-- Formulario de documentacion legal 2 - INICIO -->
	<div id="documentacion_legal" data-form="2" class=" formulario_panel">
		<h3>2. Documentación Legal <i class="fa fa-book" aria-hidden="true"></i></h3>
		<p>Los Campos marcados con (*) son obligatorios.</p>
		<small>Si no tiene el registro educativo, seleccione la opción "No", y de clic  en guardar.</small>
		<!-- Camara de comercio -->
		<div class="col-md-12">
			<hr />
			<label>2.1. Certificado de Camara de Comercio.</label>
			<div class="checkbox">
				<label for="camaraComercio">La entidad cuenta con Certificado de Camara de Comercio:</label>
				<?php if ($data_documentacion_legal): ?>
					<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="Si" disabled> Si</label>
					<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="No" disabled> No</label>
				<?php else: ?>
					<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="Si"> Si</label>
					<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="No" checked> No</label>
				<?php endif; ?>
			</div>
			<div id="div_camara_comercio" hidden>
				<?php echo form_open('', array('id' => 'formulario_certificado_existencia')); ?>
				<p>En caso que el Certificado de Existencia y Representación Legal sea emitido por Cámara de Comercio, la Unidad Administrativa realizará la verificación de este requisito por medio de consulta directa a la base de datos del Registro Único Empresarial Y Social RUES. Por tal motivo no es necesario anexar el certificado. Es responsabilidad de la entidad mantener renovado el registro mercantil en el certificado. Los Campos marcados con (*) son obligatorios.</p>
				<button name="guardar_formulario_camara_comercio" id="guardar_formulario_camara_comercio" class="btn btn-siia btn-sm pull-right" data-id="<?php  echo $data_solicitud->idSolicitud;?>">
					Guardar datos <i class="fa fa-check" aria-hidden="true"></i>
				</button>
				</form>
			</div>
		</div>
		<hr />
		<!-- Certificado de existencia y representación legal -->
		<div class="col-md-12">
			<label>2.2. Certificado de Existencia y Representación Legal.</label>
			<div class="checkbox">
				<label for="certificadoExistencia">La entidad presenta Certificado de Existencia y Representación Legal:</label>
				<!-- Opciones radio -->
				<?php if($data_documentacion_legal): ?>
					<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="Si" disabled> Si</label>
					<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="No" disabled> No</label>
				<?php else: ?>
					<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="Si"> Si</label>
					<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="No" checked> No</label>
				<?php endif ?>
			</div>
			<!-- Formulario: Certificado de Existencia y Representación Legal -->
			<div id="div_certificado_existencia">
				<?php echo form_open_multipart('', array('id' => 'formulario_certificado_existencia_legal')); ?>
				<!-- Entidad -->
				<div class="form-group">
					<label for="entidadCertificadoExistencia">Entidad que expide certificado existencia:<span class="spanRojo">*</span></label>
					<br>
					<input class="form-control" type="text" name="entidadCertificadoExistencia" id="entidadCertificadoExistencia" placeholder="Entidad que expide certificado existencia" required>
				</div>
				<!-- Fecha de expedición-->
				<div class="form-group">
					<label for="fechaExpedicion">Fecha de Expedición:<span class="spanRojo">*</span></label>
					<input type="date" class="form-control" name="fechaExpedicion" id="fechaExpedicion" required>
				</div>
				<!-- Departamento-->
				<div class="form-group">
					<label for="departamentoCertificado">Departamento:<span class="spanRojo">*</span></label>
					<br>
					<select name="departamentos2" data-id-dep="2" id="departamentos2" class="selectpicker form-control show-tick departamentos" required="">
						<?php foreach ($departamentos as $departamento):?>
							<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
						<?php endforeach;?>
					</select>
				</div>
				<!-- Municicipio -->
				<div class="form-group">
					<div id="div_municipios2">
						<label for="municipios2">Municipio:<span class="spanRojo">*</span></label>
						<br>
						<select name="municipios2" id="municipios2" class="selectpicker form-control show-tick municipios" required>
							<?php foreach ($municipios as $municipio): ?>
								<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<!-- Archivo adjunto -->
				<div class="form-group">
					</br><label>Certificado de existencia (PDF):<span class="spanRojo"> *</span></label>
					</br>
					<div class="col-md-4">
						<input type="file" required accept="application/pdf" class="form-control" name="archivoCertifcadoExistencia" id="archivoCertifcadoExistencia" required>
					</div>
					</br></br>
				</div>
				<!-- Botón guardar -->
				<button name="guardar_formulario_certificado_existencia" id="guardar_formulario_certificado_existencia" class="btn btn-siia btn-sm pull-right" data-id="<?php  echo $data_solicitud->idSolicitud;?>">
					Guardar datos <i class="fa fa-check" aria-hidden="true"></i>
				</button>
				</form>
			</div>
		</div>
		<hr />
		<!-- Registro educativo -->
		<div class="col-md-12">
			<label>2.3. Registro Educativo.</label>
			<small> Estos datos aplican solamente a Entidades Educativas (Opcional)*.</small>
			<!-- Opciones radio -->
			<div class="checkbox">
				<label for="registroEducativo">La entidad presenta registro educativo:</label>
				<?php if ($data_documentacion_legal): ?>
					<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="Si" disabled>Si</label>
					<label><input type="radio" class="registroEducativo" name="registroEducativo" id="" value="No" disabled>No</label>
				<?php else: ?>
					<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="Si">Si</label>
					<label><input type="radio" class="registroEducativo" name="registroEducativo" id="" value="No" checked>No</label>
				<?php endif ?>
			</div>
			<!-- Formulario: Registro educativo -->
			<div id="div_registro_educativo">
				<?php echo form_open('', array('id' => 'formulario_registro_educativo')); ?>
				<!-- Entidad -->
				<div class="form-group">
					<label for="tipoEducacion">Tipo de educación:<span class="spanRojo">*</span></label>
					<br>
					<select name="tipoEducacion" id="tipoEducacion" class="selectpicker form-control show-tick">
						<option id="1" value="Educacion para el trabajo y el desarrollo humano">Educacion para el trabajo y el desarrollo humano</option>
						<option id="2" value="Formal">Formal</option>
						<option id="3" value="Informal">Informal</option>
					</select>
				</div>
				<div class="form-group">
					<label for="fechaResolucionProgramas">Fecha de resolución:<span class="spanRojo">*</span></label>
					<input class="form-control" type="date" name="fechaResolucionProgramas" id="fechaResolucionProgramas">
				</div>
				<div class="form-group">
					<label for="numeroResolucionProgramas">Número de Resolución:<span class="spanRojo">*</span></label>
					<input class="form-control" type="text" name="numeroResolucionProgramas" id="numeroResolucionProgramas" placeholder="Número de Resolución...">
				</div>
				<div class="form-group">
					<label for="nombrePrograma">Nombre del Programa:<span class="spanRojo">*</span></label>
					<input type="text" name="nombreProgramaResolucion" class="form-control"  id="nombreProgramaResolucion" placeholder="Nombre del Programa...">
				</div>
				<div class="form-group">
					<label for="objetoResolucionProgramas">Objeto resolución:<span class="spanRojo">*</span></label>
					<textarea class="form-control" name="objetoResolucionProgramas" id="objetoResolucionProgramas" placeholder="Objeto resolución..."></textarea>
				</div>
				<div class="form-group">
					<label for="entidadResolucion">Entidad que expide la resolución:<span class="spanRojo">*</span></label>
					<br>
					<select name="entidadResolucion" id="entidadResolucion" class="selectpicker form-control show-tick">
						<option id="1" value="Ministerio De Educación">Ministerio De Educación</option>
						<option id="2" value="Secretaria De Educación Departamental">Secretaria De Educación Departamental</option>
						<option id="3" value="Secretaria De Educación Municipal">Secretaria De Educación Municipal</option>
					</select>
				</div>
				<!-- Archivo adjunto -->
				<div class="form-group">
					</br><label>Registro Educativo (PDF):<span class="spanRojo"> *</span></label>
					</br>
					<div class="col-md-4">
						<input type="file" required accept="application/pdf" class="form-control"name="archivoRegistroEdu" id="archivoRegistroEdu">
					</div>
					</br></br>
				</div>
				<button name="guardar_formulario_registro_educativo" id="guardar_formulario_registro_educativo" class="btn btn-siia btn-sm pull-right " data-id="<?php  echo $data_solicitud->idSolicitud;?>">
					Guardar datos <i class="fa fa-check" aria-hidden="true"></i>
				</button>
				</form>
				<hr />
				<!-- Tabla herramientas -->
				<?php if($data_documentacion_legal): ?>
					<div class="">
						<label>Datos de herramientas:</label>
						<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
						<table id="" width="100%" border=0 class="table table-striped table-bordered">
							<thead>
							<tr>
								<td>Herramienta</td>
								<td>Descripción</td>
								<td>Fecha de registro</td>
								<td>Fecha de registro</td>
								<td>Acción</td>
							</tr>
							</thead>
							<tbody id="tbody">
							<?php
							foreach ($data_modalidad_en_linea as $data) {
								echo "<tr><td>" . $data->nombreHerramienta . "</td>";
								echo "<td>" . $data->descripcionHerramienta . "</td>";
								echo "<td>" . $data->fecha . "</td>";
								echo "<td><button class='btn btn-primary btn-sm verDocDatosEnlinea' data-id=" . $data->id . ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td>";
								echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosEnlinea' data-id=" . $data->id . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
							}
							?>
							</tbody>
						</table>
					</div>
				<?php endif	?>
			</div>
		</div>
		</form>
		<div class="clearfix"></div>
		<br><br>
		<!-- Tabla Documentación Legal -->
		<?php if($data_documentacion_legal): ?>
			<?php if($data_documentacion_legal->entidad): ?>
				<div class="">
					<label>Datos Certificado existencia:</label>
					<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
					<table id="" width="100%" border=0 class="table table-striped table-bordered">
						<thead>
						<tr>
							<td>Entidad</td>
							<td>Fecha Expedición</td>
							<td>Departamento</td>
							<td>Municipio</td>
							<td>Documento</td>
							<td>Acción</td>
						</tr>
						</thead>
						<tbody id="tbody">
						<?php
							echo "<tr><td>" . $data_documentacion_legal->entidad . "</td>";
							echo "<td>" . $data_documentacion_legal->fechaExpedicion . "</td>";
							echo "<td>" . $data_documentacion_legal->departamento . "</td>";
							echo "<td>" . $data_documentacion_legal->municipio . "</td>";
							echo "<td><button class='btn btn-primary btn-sm verDocCertificadoExistencia' data-id=" . $data_documentacion_legal->id_certificadoExistencia . ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td>";
							echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosCertificadoExistencia' data-id=" . $data_documentacion_legal->id_certificadoExistencia . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
						?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
			<?php if($data_documentacion_legal->numeroResolucion): ?>
				<div class="">
					<label>Datos Registro Educativo:</label>
					<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
					<table id="" width="100%" border=0 class="table table-striped table-bordered">
						<thead>
						<tr>
							<td>Tipo Educación</td>
							<td>Fecha Resolución</td>
							<td>Numero Resolución</td>
							<td>Nombre Programa</td>
							<td>Objeto</td>
							<td>Entidad</td>
							<td>Documento</td>
							<td>Acción</td>
						</tr>
						</thead>
						<tbody id="tbody">
						<?php
						echo "<tr><td>" . $data_documentacion_legal->tipoEducacion . "</td>";
						echo "<td>" . $data_documentacion_legal->fechaResolucion . "</td>";
						echo "<td>" . $data_documentacion_legal->numeroResolucion . "</td>";
						echo "<td>" . $data_documentacion_legal->nombrePrograma . "</td>";
						echo "<td>" . $data_documentacion_legal->objetoResolucion . "</td>";
						echo "<td>" . $data_documentacion_legal->entidadResolucion . "</td>";
						echo "<td><button class='btn btn-primary btn-sm verDocRegistro' data-id=" . $data_documentacion_legal->id_registroEducativoPro . ">Ver Documento <i class='fa fa-file-o' aria-hidden='true'></i></button></td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosRegistro' data-id=" . $data_documentacion_legal->id_registroEducativoPro . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
						?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
			<?php if($data_documentacion_legal->id_tipoDocumentacion): ?>
				<div class="">
					<label>Registraste Camara de Comercio:</label>
					<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
					<table id="" width="100%" border=0 class="table table-striped table-bordered">
						<thead>
						<tr>
							<td>Documento</td>
							<td>Acción</td>
						</tr>
						</thead>
						<tbody id="tbody">
						<?php
						echo "<tr><td>Camara de comercio </td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosCamaraComercio' data-id=" . $data_documentacion_legal->id_tipoDocumentacion . ">Deshacer <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
						?>
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		<?php endif	?>
	</div>
	<!-- Formulario de antecedentes academicos 3 - INICIO -->
	<div id="antecedentes_academicos" data-form="3" class=" formulario_panel">
		<div class="">
			<?php echo form_open('', array('id' => 'formulario_antecedentes_academicos')); ?>
			<h3>3. Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></h3>
			<p>Relacione la experiencia en materia educativa, formativa y pedagógica. Los Campos marcados con (*) son obligatorios</p>
			<div class="form-group">
				<label for="descripcionProceso">Describa de manera cualitativa los procesos de formación que ha realizado:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="descripcionProceso" id="descripcionProceso" placeholder="Descripción cualitativa de los procesos de formación que ha realizado..."></textarea>
			</div>
			<div class="form-group">
				<label for="justificacionAcademicos">Justificación:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="justificacionAcademicos" id="justificacionAcademicos" placeholder="Justificación..."></textarea>
			</div>
			<div class="form-group">
				<label for="objetivosAcademicos">Objetivos:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="objetivosAcademicos" id="objetivosAcademicos" placeholder="Objetivos..."></textarea>
			</div>
			<div class="form-group">
				<label for="metodologiaAcademicos">Metodología:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="metodologiaAcademicos" id="metodologiaAcademicos" placeholder="Metodología..."></textarea>
			</div>
			<div class="form-group">
				<label for="materialDidacticoAcademicos">Describa el material didáctico y las ayudas educativas utilizadas:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="materialDidacticoAcademicos" id="materialDidacticoAcademicos" placeholder="Material didáctico y ayudas Educativas incorporadas..."></textarea>
			</div>
			<div class="form-group">
				<label for="bibliografiaAcademicos">Bibliografia:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="bibliografiaAcademicos" id="bibliografiaAcademicos" placeholder="Bibliografia..."></textarea>
			</div>
			<div class="form-group">
				<label for="duracionCursoAcademicos">Duración del curso:<span class="spanRojo">*</span> (Horas)</label>
				<input type="number" class="form-control" name="duracionCursoAcademicos" id="duracionCursoAcademicos" placeholder="">
			</div>
			<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_antecedentes_academicos" id="guardar_formulario_antecedentes_academicos" data-id="<?php  echo $data_solicitud->idSolicitud;?>">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
			</form>
			<div class="clearfix"></div>
			<?php if($data_antecedentes_academicos): ?>
				<hr />
				<label>Antecedentes:</label>
				<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
				<table id="" width="100%" border=0 class="table table-striped table-bordered ">
					<thead>
					<tr>
						<td>Descripcion proceso</td>
						<td>Justificación</td>
						<td>Objetivos</td>
						<td>Metodología</td>
						<td>Material didactico</td>
						<td>Bibliografía</td>
						<td>Duración curso</td>
						<td>Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($data_antecedentes_academicos as $antecedentes) {
						echo "<tr><td>" . $antecedentes->descripcionProceso . "</td>";
						echo "<td>" . $antecedentes->justificacion . "</td>";
						echo "<td>" . $antecedentes->objetivos . "</td>";
						echo "<td>" . $antecedentes->metodologia . "</td>";
						echo "<td>" . $antecedentes->materialDidactico . "</td>";
						echo "<td>" . $antecedentes->bibliografia . "</td>";
						echo "<td>" . $antecedentes->duracionCurso . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarAntecedentes' data-id-antecedentes=" . $antecedentes->id_antecedentesAcademicos . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
	</div>
	<!-- Formulario de jornadas de actualización 4 - INICIO -->
	<div id="jornadas_de_actualizacion" data-form="4" class=" formulario_panel">
		<div class="">
			<?php echo form_open('', array('id' => 'formulario_jornadas_actualizacion')); ?>
			<h3>4. Jornadas de actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></h3>
			<p>Registre los datos de la última jornada de actualización, organizada por UAEOS, a la que asistió. Si selecciona "No", de clic  en guardar y adjunte la carta de compromiso.</p>
			<div class="form-group">
				<label for="">5.1 Ha participado en jornadas de actualización organizadas por la UAEOS?</label>
				<div class="checkbox">
					<label for="jornaSelect">La entidad participo en la jornada de actualización pedagógica:</label>
					<label><input type="radio" class="jornaSelect" name="jornaSelect" id="jornaSelect" value="Si">Si</label>
					<label><input type="radio" class="jornaSelect" name="jornaSelect" id="" value="No" checked>No</label>
				</div>
			</div>
			<div id="divIngJor">
				<div class="form-group">
					<label for="jornadasNumeroPersonas">5.2 Número de personas que asistieron:</label>
					<input class="form-control" type="text" name="jornadasNumeroPersonas" id="jornadasNumeroPersonas" placeholder="43">
				</div>
				<div class="form-group">
					<label for="jornadasFechaAsistencia">5.3 Fecha de la última actualización a la que asistió:</label>
					<input class="form-control" type="date" name="jornadasFechaAsistencia" id="jornadasFechaAsistencia">
				</div>
			</div>
			</form>
			<div class="clearfix"></div>
			<hr />
			<div class="form-group">
				<label>Documento de la Jornada de Actualización o carta de compromiso </label>
				<p>En caso de haber participado en la jornada de actualización adjunte el certificado. En caso de no haber participado adjunte una carta de compromiso de participación en la jornada de actualización. (PDF)</p>
				<br />
				<?php echo form_open_multipart('', array('id' => 'formulario_jornada_actualizacion')); ?>
				<label>Archivo (PDF):<span class="spanRojo">*</span></label>
				<br />
				<div class="col-md-4">
					<input type="file" required accept="application/pdf" class="form-control" data-val="jornadaAct" name="jornadaAct" id="jornadaAct">
				</div>
				<div class="col-md-3">
					<input type="button" class="btn btn-siia btn-sm archivos_form_jornada fa-fa center-block" data-name="jornadaAct" name="jornadaAc" id="jornadaAc" value="Guardar archivo(s) &#xf0c7">
				</div>
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="archivoss">
				<hr />
				<label>Jornadas:</label>
				<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
				<table id="" width="100%" border=0 class="table table-striped table-bordered">
					<thead>
					<tr>
						<td class="col-md-4">Número personas</td>
						<td class="col-md-4">Fecha asistencia</td>
						<td class="col-md-4">Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($data_jornadas_actualizacion as $jornada) {
						echo "<tr><td>" . $jornada->numeroPersonas . "</td>";
						echo "<td>" . $jornada->fechaAsistencia . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarJornadaActualizacion' data-id-jornada=" . $jornada->id_jornadasActualizacion . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
			<div class="">
				<hr />
				<label>Archivos:</label>
				<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>
				<table id="tabla_archivos_formulario" width="100%" border=0 class="table table-striped table-bordered tabla_form">
					<thead>
					<tr>
						<td class="col-md-4">Nombre</td>
						<td class="col-md-4">Tipo</td>
						<td class="col-md-4">Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					</tbody>
				</table>
			</div>
			<hr />
			<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_jornadas_actualizacion" id="guardar_formulario_jornadas_actualizacion" data-id="<?php  echo $data_solicitud->idSolicitud;?>">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		</div>
	</div>
	<!-- Formulario de programas de educación en economía solidaria 5 - INICIO -->
	<div id="programa_basico_de_economia_solidaria" data-form="5" class=" formulario_panel">
		<?php // echo form_open('', array('id' => 'formulario_programa_basico')); ?>
		<h3>5. Programas de educación en economía solidaria <i class="fa fa-server" aria-hidden="true"></i></h3>
		<p>Le invitamos a leer atentamente el anexo técnico del curso o los cursos a acreditar, seguido de la lectura es importante dar clic en <strong>aceptar</strong>. Esta aceptación compromete a su organización a desarrollar el programa de economía solidaria establecido en la resolución 152 de 2022, es importante que su organización cree y desarrolle las metodologías y materiales adecuados para el proceso de enseñanza y aprendizaje.</p>
		<p>Recuerde que al  <strong>aceptar</strong> se registrara automáticamente el compromiso y este quedara en nuestra base de datos.</p>
		<p> Pulsé en el enlace del curso para ver los temas, objetivo y contenidos a desarrollar y <strong>acepté</strong> en la parte inferior del cuadro emergente para poder continuar con el registro del trámite de acreditación</p>
		<hr />
		<!-- Grupo de check con los diferentes cursos -->
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Check Curso Básico -->
					<div class="form-group" id="curso_basico_es" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="check_curso_basico_es" form="formulario_programas" name="curso_basico_es" value="* Acreditación Curso Básico de Economía Solidaria" disabled>
							<label for="modalCursoBasico">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoBasico" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Curso Básico de Economía Solidaria
							</a>
						</label>
					</div>
					<!-- Check Curso Aval -->
					<div class="form-group" id="curso_basico_aval" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="check_curso_basico_aval" form="formulario_programas" name="curso_basico_aval" value="* Acreditación Aval de Trabajo Asociado" disabled required>
							<label for="modalAval">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalAval" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Aval de Trabajo Asociado
							</a>
						</label>
					</div>
					<!-- Check Curso Medio -->
					<div class="form-group" id="curso_medio_es" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="check_curso_medio_aval" form="formulario_programas" name="check_curso_medio_aval" value="* Acreditación Curso Medio de Economía Solidaria" disabled required>
							<label for="modalCursoMedio">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoMedio" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Curso Medio de Economía Solidaria
							</a>
						</label>
					</div>
					<!-- Check Curso Avanzando -->
					<div class="form-group" id="curso_avanzado_es" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="check_curso_avanzado_es" form="formulario_programas" name="check_curso_avanzado_es" value="* Acreditación Curso Avanzado de Economía Solidaria" disabled required>
							<label for="modalCursoAvanzado">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoAvanzado" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Curso Avanzado de Economía Solidaria
							</a>
						</label>
					</div>
					<!-- Check Curso Economía Financiera -->
					<div class="form-group" id="curso_economia_financiera" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="check_curso_economia_financiera" form="formulario_programas" name="check_curso_economia_financiera" value="* Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria" disabled required>
							<label for="modalCursoFinanciera">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoFinanciera" data-backdrop="static" data-keyboard="false" data-programa="Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria" data-id="<?php  echo $data_solicitud->idSolicitud;?>">
								<span class="spanRojo">*</span> Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria
							</a>
					</div>
					<!-- Campo oculto con ID de la organización -->
					<input type="text" name="id_organizacion" id="id_organizacion" value="<?php echo $data_organizacion->id_organizacion;?>" style="display: none">
				</div>
			</div>
		</div>
		<!-- Tabla programas aceptados -->
		<?php if($data_programas): ?>
			<div class="">
				<label>Datos programas aceptados</label>
				<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
				<table id="" width="100%" border=0 class="table table-striped table-bordered">
					<thead>
					<tr>
						<td>Nombre programa</td>
						<td>Acepta</td>
						<td>Fecha</td>
						<td>Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($data_programas as $data) {
						echo "<tr><td>" . $data->nombrePrograma . "</td>";
						echo "<td>" . $data->aceptarPrograma . "</td>";
						echo "<td>" . $data->fecha . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosProgramas' data-id=" . $data->id . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		<?php endif	?>
	</div>
	<!-- Formulario de docentes 6 - INICIO -->
	<div id="docentes" data-form="6" class=" formulario_panel">
		<h3>6. Facilitadores <i class="fa fa-users" aria-hidden="true"></i></h3>
		<div class="container">
			<div class="jumbotron">
				<h3>Facilitadores</h3>
				<p>Para crear facilitadores y actualizar o adjuntar archivos como hojas de vida, certificaciones, por favor, de <a href="" id="irDocentes">clic  aquí.</a></p>
			</div>
		</div>
		<!--<h4 id="act_doc_sol"></h4>
			<div id="div_cont_frm_doc">
			<p>Ingrese solo la información del equipo docente que desarrollará los cursos. Recuerde anexar los soportes de estudios y de experiencia relacionados con el sector de la economía solidaria. Para adicionar un nuevo registro presione sobre adicionar y para terminar presione en finalizar.</p>
			<div class="form-group col-md-12">
				<p>Aqui puede buscar si el docente ya se encuentra registrado en nuestra base de datos los datos se añadiran en los campos.</p>
				<div class="col-md-6">
					<input type="text" class="form-control" name="" placeholder="Cedula">
				</div>
				<div class="col-md-6">
					<input type="button" class="btn btn-siia" name="" value="Buscar">
				</div>
			</div>
			<div class="clearfix"></div>
			 <a id=""><i class="fa fa-plus" aria-hidden="true"></i></a><a id=""><i class="fa fa-minus" aria-hidden="true"></i></a>-->
		<!--<div class="" id="">
				<?php echo form_open_multipart('', array('id' => 'formulario_docentes')); ?>
					<div class="form-group">
						<label for="docentes_cedula">Cedula:<span class="spanRojo">*</span></label>
						<input type="text" class="form-control" name="docentes_cedula" id="docentes_cedula">
					</div>
					<div class="form-group">
						<label for="docentes_primer_nombre">Primer Nombre:<span class="spanRojo">*</span></label>
						<input type="text" class="form-control" name="docentes_primer_nombre" id="docentes_primer_nombre">
					</div>
					<div class="form-group">
						<label for="docentes_segundo_nombre">Segundo Nombre:</label>
						<input type="text" class="form-control" name="docentes_segundo_nombre" id="docentes_segundo_nombre">
					</div>
					<div class="form-group">
						<label for="docentes_primer_apellido">Primer Apellido:<span class="spanRojo">*</span></label>
						<input type="text" class="form-control" name="docentes_primer_apellido" id="docentes_primer_apellido">
					</div>
					<div class="form-group">
						<label for="docentes_segundo_apellido">Segundo Apellido:</label>
						<input type="text" class="form-control" name="docentes_segundo_apellido" id="docentes_segundo_apellido">
					</div>
					<div class="form-group">
						<label for="docentes_profesion">Profesión:<span class="spanRojo">*</span></label>
						<input type="text" class="form-control" name="docentes_profesion" id="docentes_profesion">
					</div>
					<div class="form-group">
						<label for="docentes_horas">Horas de capacitación del docente:<span class="spanRojo">*</span></label>
						<input type="number" class="form-control" min="30" name="docentes_horas" id="docentes_horas" value="30">
					</div>
				</form>
				<a target="_blank" href="panel/docentes"><button class="btn btn-info pull-left" id="">Ir a facilitadores <i class="fa fa-arrow-right" aria-hidden="true"></i></button></a>
				<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_docentes" id="guardar_formulario_docentes">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>-->
	</div>
	<!-- Formulario Datos Plataforma 7 - INICIO -->
	<div id="datos_plataforma" data-form="7" class=" formulario_panel">
		<h3>7. Datos modalidad virtual<i class="fa fa-globe" aria-hidden="true"></i></h3>
		<p>Relacione los datos para ingresar a la plataforma y verificar su funcionamiento.</p>
		<?php echo form_open('', array('id' => 'formulario_modalidad_virtual')); ?>
		<!-- URL Plataforma -->
		<div class="form-group">
			<label for="datos_plataforma_url">URL:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_url" id="datos_plataforma_url" placeholder="EJ: https://www.orgsolidarias.gov.co/" required>
		</div>
		<!-- Usuario -->
		<div class="form-group">
			<label for="datos_plataforma_usuario">Usuario:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_usuario" id="datos_plataforma_usuario" placeholder="EJ: usuario.aplicacion" required>
		</div>
		<!-- Contraseña -->
		<div class="form-group">
			<label for="datos_plataforma_contrasena">Contraseña:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_contrasena" id="datos_plataforma_contrasena" placeholder="EJ: contraseña123@" required>
		</div>
		<!-- Check Aceptar Modalidad Virtual -->
		<div class="form-group">
			<label class="underlined">
				<input type="checkbox" id="acepta_mod_en_virtual" form="formulario_programas" name="acepta_mod_en_virtual" value="Si Acepto" disabled required>
				<label for="acepta_mod_en_linea">&nbsp;</label>
				<a data-toggle="modal" data-target="#modalAceptarVirtual" data-backdrop="static" data-keyboard="false">
					<span class="spanRojo">*</span>¿Acepta modalidad virtual?
				</a>
			</label>
		</div>
		<hr />
		<!-- Modal Aceptar Modalidad Virtual -->
		<div class="modal fade" id="modalAceptarVirtual" tabindex="-1" role="dialog" aria-labelledby="modalAceptarVirtual">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="row">
							<div id="header_politicas" class="col-md-12">
								<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="http://localhost/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">
							</div>
							<div class="clearfix"></div>
							<hr />
							<div class="col-md-12">
								Texto Recomendaciones Modalidad Virtual
							</div>
						</div>
					</div>
					<div class="modal-body">
						<p>De acuerdo a lo establecido en el parágrafo número 1 del artículo 6 de la resolución 152 del 23 de junio del 2022, las entidades que soliciten la acreditación por la modalidad en línea deben tener en cuenta lo siguiente:</p>
						<p><strong>Parágrafo 1.</strong> Para la acreditación de los programas de educación en economía solidaria bajo modalidad virtual, la entidad solicitante deberá demostrar que el proceso educativo se hace en una <stron>plataforma</stron> (sesiones clase, materiales de apoyo, actividades, evaluaciones) que propicie un Ambiente Virtual de Aprendizaje - AVA y Objetos Virtuales de Aprendizaje- OVAS. </p>
						<p>Recuerde desarrollar el proceso formativo acorde a lo establecido en el anexo técnico.</p>
						<p>La UAEOS realizará seguimiento a las organizaciones acreditadas en el cumplimiento de los programas de educación solidaria acreditados.</p>
						<!--				<a class="pull-right" target="_blank" href="https://www.orgsolidarias.gov.co/sites/default/files/archivos/Res_110%20del%2031%20de%20marzo%20de%202016.pdf">Recurso de la resolución 110</a>-->
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_mod_virtual">Sí, acepto. <i class="fa fa-check"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<hr />
		<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_plataforma" id="guardar_formulario_plataforma" data-id="<?php  echo $data_solicitud->idSolicitud;?>">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		</form>
		<div class="clearfix"></div>
		<?php if($data_plataforma): ?>
			<div class="">
				<hr />
				<label>Plataforma:</label>
				<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
				<table id="" width="100%" border=0 class="table table-striped table-bordered">
					<thead>
					<tr>
						<td>URL aplicación</td>
						<td>Usuario aplicación</td>
						<td>Contraseña aplicación</td>
						<td>Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($data_plataforma as $datosPlataforma) {
						echo "<tr><td>" . $datosPlataforma->urlAplicacion . "</td>";
						echo "<td>" . $datosPlataforma->usuarioAplicacion . "</td>";
						echo "<td>" . $datosPlataforma->contrasenaAplicacion . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosPlataforma' data-id-datosPlataforma=" . $datosPlataforma->id_datosAplicacion . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		<?php endif; ?>
	</div>
	<!-- Formulario Datos En Lina 8 - INICIO -->
	<div id="datos_en_linea" data-form="8" class="formulario_panel">
		<h3>8. Datos modalidad en linea<i class="fa fa-globe" aria-hidden="true"></i></h3>
		<p>Ingrese los datos de las herramientas a utilizar en esta modalidad dentro del curso.</p>
		<?php echo form_open('', array('id' => 'formulario_modalidad_en_linea')); ?>
		<!-- Nombre de la herramienta-->
		<div class="form-group">
			<label for="nombre_herramienta">Nombre de la herramienta:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="nombre_herramienta" id="nombre_herramienta" placeholder="Ej: MSTeams, Meet, Zoom, Skype, WhastApp, entre otros..." required>
		</div>
		<!-- Descripción de la herramienta-->
		<div class="form-group">
			<label for="descripcion_herramienta">Breve descripción de la utilización educativa de la herramienta en línea:<span class="spanRojo">*</span></label>
			<textarea type="text" class="form-control" name="descripcion_herramienta" id="descripcion_herramienta" placeholder="Registre la descripción de la herramienta" required></textarea>
		</div>
		<!-- Check Aceptar Modalidad En Linea -->
		<div class="form-group">
			<label class="underlined">
				<input type="checkbox" id="acepta_mod_en_linea" form="formulario_programas" name="acepta_mod_en_linea" value="Si Acepto" disabled required>
				<label for="acepta_mod_en_linea">&nbsp;</label>
				<a data-toggle="modal" data-target="#modalAceptarEnLinea" data-backdrop="static" data-keyboard="false">
					<span class="spanRojo">*</span>¿Acepta modalidad en línea?
				</a>
			</label>
		</div>
		<hr />
		<!-- Modal Aceptar Modalidad En Línea -->
		<div class="modal fade" id="modalAceptarEnLinea" tabindex="-1" role="dialog" aria-labelledby="modalAceptarEnLinea">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<div class="row">
							<div id="header_politicas" class="col-md-12">
								<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="http://localhost/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">
							</div>
							<div class="clearfix"></div>
							<hr />
							<div class="col-md-12">
								Texto Recomendaciones Modalidad En Línea
							</div>
						</div>
					</div>
					<div class="modal-body">
						<p>De acuerdo a lo establecido en los parágrafos número 2 y número 3 del artículo 9 de la resolución 110 del 31 de marzo del 2016, las entidades que soliciten la acreditación por la modalidad en linea deben tener en cuenta lo siguiente:</p>
						<p><strong>Parágrafo 2.</strong> Para la acreditación de los programas de educación en economía solidaria bajo modalidad línea, aquella donde los docentes y participantes interactúan a través de recursos tecnológicos. La mediación tecnológica puede ser a través de herramientas tecnológica (Zoom, Teams, Meet, Good Meet, entre otras) plataformas de comunicación, chats, foros, videoconferencias, grupos de discusión, <strong>caracterizadas por encuentros sincrónicos.</strong> </p>
						<p>Recuerde desarrollar el proceso formativo acorde a lo establecido en el anexo técnico.</p>
						<p>La UAEOS realizará seguimiento a las organizaciones acreditadas en el cumplimiento de los programas de educación solidaria acreditados.</p>
						<!--				<a class="pull-right" target="_blank" href="https://www.orgsolidarias.gov.co/sites/default/files/archivos/Res_110%20del%2031%20de%20marzo%20de%202016.pdf">Recurso de la resolución 110</a>-->
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_mod_en_linea" value="Si Acepta">Sí, acepto. <i class="fa fa-check"></i></button>
					</div>
				</div>
			</div>
		</div>
		<!-- Botón para guardar datos -->
		<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_modalidad_en_linea" id="guardar_formulario_modalidad_en_linea" data-id="<?php  echo $data_solicitud->idSolicitud;?>">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		<div class="clearfix"></div>
		<hr />
		</form>
		<!-- Tabla herramientas -->
		<?php if($data_modalidad_en_linea): ?>
			<div class="">
				<label>Datos de herramientas:</label>
				<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
				<table id="" width="100%" border=0 class="table table-striped table-bordered">
					<thead>
					<tr>
						<td>Herramienta</td>
						<td>Descripción</td>
						<td>Fecha de registro</td>
						<td>Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($data_modalidad_en_linea as $data) {
						echo "<tr><td>" . $data->nombreHerramienta . "</td>";
						echo "<td>" . $data->descripcionHerramienta . "</td>";
						echo "<td>" . $data->fecha . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDatosEnlinea' data-id=" . $data->id . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		<?php endif	?>
	</div>
	<!-- Continuar para finalizar Acreditación - INICIO -->
	<div id="finalizar_proceso" data-form="0" class="col-md-9 formulario_panel">
		<div id="verificacion_formularios"></div>
		<div class="container">
			<div class="jumbotron" id="verificar_btn">
				<h4>¿Desea finalizar el proceso?</h4>
				<p>Si ya adjunto todos los documentos e información necesaria para la solicitud, de clic en si, y espere a las observaciones si existen por parte del evaluador.</p>
				<button class="btn btn-danger btn-sm" id="finalizar_no">No, voy a verificar <i class="fa fa-times" aria-hidden="true"></i></button>
				<button class="btn btn-siia btn-sm" id="siFinSol" data-toggle="modal" data-target="#modalFinalizarProceso">Si, terminar la solicitud <i class="fa fa-check-square-o" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
	<a id="hide-sidevar" class="btn btn-siia btn-sm hide-sidevar" role="button" title="Ocultar Menú" data-toggle="tooltip" data-placement="left"><i class="fa fa-window-close-o" aria-hidden="true"></i>
		<v>Ocultar menú</v>
	</a>
	<!-- Modal Finalizar Proceso -->
	<div class="modal fade" id="modalFinalizarProceso" tabindex="-1" role="dialog" aria-labelledby="finalizarSeguro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="finalizarSeguro">¿Está seguro de finalizar el proceso de solicitud?</h4>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">No, voy a verificar <i class="fa fa-times" aria-hidden="true"></i></button>
					<button class="btn btn-siia btn-sm pull-right" id="finalizar_si" data-id="<?php echo $data_solicitud->idSolicitud ?>">Si, estoy completamente seguro de terminar y enviar la solicitud <i class="fa fa-check-square-o" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Cursos -->
	<div class="modal fade" id="modalCursoBasico" tabindex="-1" role="dialog" aria-labelledby="modalCursoBasico">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="row">
						<div id="header_politicas" class="col-md-12">
							<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="https://acreditacion.uaeos.gov.co/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">
						</div>
						<div class="clearfix"></div>
						<hr />
						<div class="col-md-12" style="text-align: center">
							<object data="https://acreditacion.uaeos.gov.co/siia/assets/metodologiaResolucion/CursoBasico.html" type="text/html" width="750" height="1220"></object>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="aceptar_curso_basico_es" data-programa="Acreditación Curso Básico de Economía Solidaria" data-modal="modalCursoBasico" data-check="check_curso_basico_es"  data-id="<?php echo $data_solicitud->idSolicitud;?>">Sí, acepto. <i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalAval" tabindex="-1" role="dialog" aria-labelledby="modalAval">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="row">
						<div id="header_politicas" class="col-md-12">
							<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="https://acreditacion.uaeos.gov.co/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">
						</div>
						<div class="clearfix"></div>
						<hr />
						<div class="col-md-12" style="text-align: center">
							<object data="https://acreditacion.uaeos.gov.co/siia/assets/metodologiaResolucion/CursoAval.html" type="text/html" width="750" height="1220"></object>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="aceptar_aval_trabajo" data-programa="Acreditación Aval de Trabajo Asociado"  data-modal="modalAval" data-check="check_curso_basico_aval"  data-id="<?php  echo $data_solicitud->idSolicitud;?>">Sí, acepto. <i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalCursoMedio" tabindex="-1" role="dialog" aria-labelledby="modalCursoMedio">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="row">
						<div id="header_politicas" class="col-md-12">
							<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="https://acreditacion.uaeos.gov.co/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">
						</div>
						<div class="clearfix"></div>
						<hr />
						<!-- Tablas de cursos -->
						<div class="col-md-12" style="text-align: center">
							<object data="https://acreditacion.uaeos.gov.co/siia/assets/metodologiaResolucion/CursoMedio.html" type="text/html" width="750" height="1100"></object>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="aceptar_curso_medio_es" data-programa="Acreditación Curso Medio de Economía Solidaria"  data-modal="modalCursoMedio" data-check="check_curso_medio_es"  data-id="<?php  echo $data_solicitud->idSolicitud;?>">Sí, acepto. <i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalCursoAvanzado" tabindex="-1" role="dialog" aria-labelledby="modalCursoAvanzado">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="row">
						<div id="header_politicas" class="col-md-12">
							<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="http://localhost/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">
						</div>
						<div class="clearfix"></div>
						<hr />
						<!-- Tablas de cursos -->
						<div class="col-md-12" style="text-align: center">
							<object data="https://acreditacion.uaeos.gov.co/siia/assets/metodologiaResolucion/CursoAvanzado.html" type="text/html" width="750" height="1220"></object>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="aceptar_avanzado_medio_es" data-programa="Acreditación Curso Avanzado de Economía Solidaria" data-modal="modalCursoAvanzado" data-check="check_curso_avanzado_es"  data-id="<?php  echo $data_solicitud->idSolicitud;?>">Sí, acepto. <i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalCursoFinanciera" tabindex="-1" role="dialog" aria-labelledby="modalCursoFinanciera">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="row">
						<div id="header_politicas" class="col-md-12">
							<img alt="logo" id="imagen_header_politicas" class="img-responsive" src="https://acreditacion.uaeos.gov.co/siia/assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png">

						</div>
						<div class="clearfix"></div>
						<hr />
						<!-- Tablas de cursos -->
						<div class="col-md-12" style="text-align: center">
							<object data="https://acreditacion.uaeos.gov.co/siia/assets/metodologiaResolucion/CursoFinanciera.html" type="text/html" width="750" height="1000"></object>
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="aceptar_educacion_financiera" data-programa="Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria" data-modal="modalCursoFinanciera" data-check="check_curso_economia_financiera" data-id="<?php  echo $data_solicitud->idSolicitud;?>">Sí, acepto. <i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
