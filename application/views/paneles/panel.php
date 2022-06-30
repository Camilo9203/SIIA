<!-- Panel Principal -->
<div id="panel_inicial" class="container center-block">
	<div class="clearfix"></div>
	<hr />
	<div class="col-md-3">
		<div class="panel panel-siia ver_estado_solicitud">
			<div class="panel-heading">
				<h3 class="panel-title">Estado de la solicitud <i class="fa fa-certificate" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block ver_estado_solicitud" id="ver_estado_solicitud">Estado de la solicitud </button>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-siia nuevaSolicitud">
			<div class="panel-heading">
				<h3 class="panel-title">Solicitud <i class="fa fa-file" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block form-control nuevaSolicitud" id="nuevaSolicitud">Crear - Continuar - Actualizar la solicitud </button>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-siia ver_perfil">
			<div class="panel-heading">
				<h3 class="panel-title">Perfil <i class="fa fa-user" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block ver_perfil" id="ver_perfil">Perfil de la organización</button>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-siia ver_docentes">
			<div class="panel-heading">
				<h3 class="panel-title">Grupo de facilitadores <i class="fa fa-users" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block ver_docentes" id="ver_docentes">Facilitadores </button>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-siia ver_plan_mejoramiento">
			<div class="panel-heading">
				<h3 class="panel-title">Planes de mejoramiento <i class="fa fa-thumbs-up" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block ver_plan_mejoramiento" id="ver_plan_mejoramiento">Plan de mejoramiento </button>
			</div>
		</div>
	</div>
	<!-- Informate de actividades //TODO: Antes comentado -->
	<div class="col-md-3">
		<div class="panel panel-siia ver_informe_actividades">
			<div class="panel-heading">
				<h3 class="panel-title">Informes <i class="fa fa-flag" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block ver_informe_actividades" id="ver_informe_actividades">Informe de actividades </button>
			</div>
		</div>
	</div>
	<!-- Informate de actividades //TODO: Antes no comentado -->
	<!-- <div class="col-md-3">
		<div class="panel panel-siia">
			<div class="panel-heading">
				<h3 class="panel-title">Informes <i class="fa fa-flag" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default form-control" data-toggle="modal" data-toggle="modal" data-target="#modalInformeAct2019">Informes de Actividades </button>
			</div>
		</div>
	</div> -->
	<!--<div class="col-md-3 hidden">
		<div class="panel panel-siia contacto">
		  <div class="panel-heading">
		    <h3 class="panel-title">Contacto <i class="fa fa-envelope" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
		   	<button class="btn btn-default btn-block contacto" id="contacto">Contacto </button>
		  </div>
		</div>
	</div>-->
	<div class="col-md-3">
		<div class="panel panel-siia ayuda">
			<div class="panel-heading">
				<h3 class="panel-title">Ayudas <i class="fa fa-question-circle" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block ayuda" id="ayuda">Ayuda y manuales </button>
			</div>
		</div>
	</div>
</div>
<!-- Formulario tipo de solicitud //TODO: Formulario tipo de solicitud -->
<div id="tipoSolicitud" class="col-md-5 center-block">
	<?php echo form_open('', array('id' => 'formulario_crear_solicitud')); ?>
	<div class="clearfix"></div>
	<hr />
	<!-- Tipo d solicitud -->
	<label for="tipo_solicitud">Tipo de solicitud:<span class="spanRojo">*</span></label><br>
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="tipo_solicitud" id="tipo1" class="" value="Acreditación Primera vez" checked>Acreditación primera vez.</label>
		</div>
	</div>
	<!-- Solo si la entidad esta o estuvo acreditada //TODO: Solo si la entidad ya fue acreditada-->
	<div id="div_solicitud">
		<div class="form-group">
			<div class="radio">
				<label><input type="radio" name="tipo_solicitud" id="tipo2" class="" value="Renovación de Acreditación">Renovación de acreditación.</label>
			</div>
		</div>
		<div class="form-group">
			<div class="radio">
				<label><input type="radio" name="tipo_solicitud" id="tipo3" class="" value="Actualización de datos">Actualización de datos.</label>
			</div>
		</div>
	</div>
	<hr />
	<!-- Tipo d solicitud -FIN -->
	<!-- Motivo de la solicitud -->
	<label for="motivo_solicitud">Motivo de la solicitud:<span class="spanRojo">*</span></label><br>
	<!-- CheckBox Motivos de la solicitud -->
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="1" id="cursoBasico" name="motivos[]" checked>
		<label class="form-check-label" for="cursoBasico">Acreditación Curso Básico de Economía Solidaria</label>
	</div>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="2" id="avalTrabajo" name="motivos[]">
		<label class="form-check-label" for="avalTrabajo">Aval de Trabajo Asociado</label>
	</div>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="3" id="cursoMedio" name="motivos[]">
		<label class="form-check-label" for="cursoMedio">Acreditación Curso Medio de Economía Solidaria</label>
	</div>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="4" id="cursoAvanzado" name="motivos[]">
		<label class="form-check-label" for="cursoAvanzado">Acreditación Curso Avanzado de Economía Solidaria</label>
	</div>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="5" id="finacieraEconomia" name="motivos[]">
		<label class="form-check-label" for="finacieraEconomia">Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria</label>
	</div>
	<!-- Solo si la entidad esta o estuvo acreditada //TODO: Solo si la entidad ya fue acreditada-->
	<div class="form-group" id="div_motivo_actualizar">
		<div class="radio">
			<label><input type="radio" name="motivo_solicitud" id="motivo5" class="motivo_sol" value="Actualizar Datos">Actualizar datos</label>
		</div>
	</div>
	<hr />
	<!-- Motivo de la solicitud -FIN-->
	<!-- Modalidad de la solicitud -->
	<label for="modalidad_solicitud">Modalidad:<span class="spanRojo">*</span></label><br>
	<!-- Ayuda para modalidad virtual -->
	<i data-toggle="modal" data-target="#ayudaModalidad" class="fa fa-question-circle pull-right" aria-hidden="true"></i>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="1" id="presencial" name="modalidades[]" checked>
		<label class="form-check-label" for="presencial">Presencial</label>
	</div>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="2" id="virtual" name="modalidades[]">
		<label class="form-check-label" for="virtual">Virtual</label>
	</div>
	<div class="form-check radio">
		<input class="form-check-input" type="checkbox" value="3" id="enLinea" name="modalidades[]">
		<label class="form-check-label" for="enLinea">En Linea</label>
	</div>
	<!-- Presencial -->
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="modalidad_solicitud" id="modalidad1" class="" value="Presencial" checked>Presencial</label>
		</div>
	</div>
	<!-- Virtual -->
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="modalidad_solicitud" id="modalidad2" class="" value="Virtual">Virtual</label>
		</div>
	</div>
	<!-- En linea -->
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="modalidad_solicitud" id="modalidad3" class="" value="Virtual">En linea</label>
		</div>
	</div>
	<!-- Ambas -->
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="modalidad_solicitud" id="modalidad4" class="" value="Virtual y Presencial">Virtual y presencial <small>(Ambos)</small></label>
		</div>
	</div>
	<!-- Presencial y en linea -->
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="modalidad_solicitud" id="modalidad5" class="" value="Virtual y Presencial">Presencial y en linea <small>(Ambos)</small></label>
		</div>
	</div>
	<!-- Virtual y en linea -->
	<div class="form-group">
		<div class="radio">
			<label><input type="radio" name="modalidad_solicitud" id="modalidad6" class="" value="Virtual y Presencial">Virtual y en linea<small>(Ambos)</small></label>
		</div>
	</div>
	<hr />
	<!-- Modalidad de la solicitud -FIN -->
	</form>
	<button class="btn btn-siia btn-sm pull-right" name="" id="guardar_formulario_tipoSolicitud">Crear solicitud <i class="fa fa-check" aria-hidden="true"></i></button>
	<button class="btn btn-danger btn-sm volver_al_panel"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>
<!-- Modal Ayuda Modalidad Virtual  -->
<div class="modal fade in" id="ayudaModalidad" tabindex="-1" role="dialog" aria-labelledby="ayudaModalidad">
	<div class="modal-dialog modal-xs" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="guardarOBSSIs">¿Esta seguro de presentar la modalidad virtual?</h4>
			</div>
			<div class="modal-body">
				<p>De acuerdo a lo establecido en los parágrafos número 2 y número 3 del artículo 9 de la resolución 110 del 31 de marzo del 2016, las entidades que soliciten la acreditación por la modalidad virtual deben tener en cuenta lo siguiente:</p>
				<p><strong>Parágrafo 2.</strong> El Curso de economía solidaria podrá ser impartido en las modalidades presencial o virtual. <strong><i>Para el caso de la modalidad virtual la entidad solicitante deberá demostrar contar con una plataforma que permita la interacción permanente y efectiva en el proceso de aprendizaje.</i></strong></p>
				<p><strong>Parágrafo 3.</strong> La entidad acreditada <strong>sólo podrá impartir el curso de economía solidaria</strong> en la modalidad o modalidades (virtual o presencial) que la <strong>Unidad Administrativa señale en la resolución que la acredita.</strong></p>
				<a class="pull-right" target="_blank" href="https://www.orgsolidarias.gov.co/sites/default/files/archivos/Res_110%20del%2031%20de%20marzo%20de%202016.pdf">Recurso de la resolución 110</a>
			</div>
			<div class="modal-footer">
				<button type="button" id="noModVirt" class="btn btn-danger btn-sm pull-left">No, quizá mas adelante <i class="fa fa-times" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-siia btn-sm pull-right" data-dismiss="modal">Si, esto seguro de presentar la modalidad virtual <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
<!-- Formularios //TODO: Formularios usuario -->
<div class="col-md-9 formularios" role="main">
	<!-- Inicio del Panel Inicial -->
	<div id="estado_solicitud">
		<hr />
		<div class="form-group">
			<h3>Datos de la solicitud: <small>Los archivos y campos marcados en los formularios con asterisco (<span class="spanRojo">*</span>) son requeridos en la solicitud.</small></h3>
			<label>Solicitud número:</label>
			<p id="numeroSolicitudesBD"></p>
			<label>Estado de la organización:</label>
			<p id="estadoOrgBD"></p>
			<label>Tipo de Solicitud:</label>
			<p id="tipoSolicitudesBB"></p>
			<label>Motivo de Solicitud:</label>
			<p id="motivoSolicitudesBB"></p>
			<label>Modalidad de Solicitud:</label>
			<p id="modalidadSolicitudesBB"></p>
			<hr />
			<label>Estado anterior:</label>
			<p id="estadoAnteriorBB"></p>
			<hr />
			<button class="btn btn-siia btn-sm verHistObsUs" id="hist_org_obs" data-toggle='modal' data-id-org="<?php echo $data_organizacion->id_organizacion;; ?>" data-target='#verHistObsUs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
			<button class="btn btn-siia btn-sm pull-right" data-toggle="modal" data-target="#modalEliminarSolicitud" id="el_sol">Actualizar/Cambiar el tipo de solicitud actual <i class="fa fa-refresh" aria-hidden="true"></i></button>
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
	<!-- Fin del Panel Inicial -->
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
						<li>Se borraran todos los datos de la solicitud actual.</li>
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
	<!-- Modal - FIN -->
	<!-- Inicio de Formularios Acreditación -->
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
				<label>Fax - Teléfono:<span class="spanRojo">*</span></label>
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
	<!-- Formulario de informacion general de la entidad 1 - FIN -->
	<!-- Formulario de documentacion legal 2 - INICIO -->
	<div id="documentacion_legal" data-form="2" class=" formulario_panel">
		<h3>2. Documentación Legal <i class="fa fa-book" aria-hidden="true"></i></h3>
		<p>Los Campos marcados con (*) son obligatorios.</p>
		<small>Si no tiene el registro educativo, seleccione la opción "No", y de click en guardar.</small>
		<!-- Camara de comercio -->
		<div class="col-md-12">
			<hr />
			<?php echo form_open('', array('id' => 'formulario_documentacion_legal')); ?>
			<label>2.1. Certificado de Camara de Comercio.</label>
			<div class="checkbox">
				<label for="camaraComercio">La entidad cuenta con Certificado de Camara de Comercio:</label>
				<?php foreach ($data_documentacion_legal as $documentacion) : ?>
					<?php if ($documentacion->entidadRegistro == "Camara de Comercio") : ?>
						<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="Si" checked> Si</label>
						<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="No"> No</label>
					<?php elseif ($documentacion->entidadRegistro != "Camara de Comercio") : ?>
						<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="Si" disabled> Si</label>
						<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="No" checked disabled> No</label>
					<?php endif ?>
				<?php endforeach ?>
				<?php if ($data_documentacion_legal == NULL) : ?>
					<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="Si"> Si</label>
					<label><input type="radio" class="camaraComercio" name="camaraComercio" id="camaraComercio" value="No" checked> No</label>
				<?php endif ?>
			</div>
			<div id="div_camara_comercio" hidden>
				<p>En caso que el Certificado de Existencia y Representación Legal sea emitido por Cámara de Comercio, la Unidad Administrativa realizará la verificación de este requisito por medio de consulta directa a la base de datos del Registro Único Empresarial Y Social RUES. Por tal motivo no es necesario anexar el certificado. Es responsabilidad de la entidad mantener renovado el registro mercantil en el certificado. Los Campos marcados con (*) son obligatorios.</p>
			</div>
		</div>
		<!-- Certificado de existencia y representación legal -->
		<div class="col-md-12">
			<hr />
			<?php echo form_open('', array('id' => 'formulario_documentacion_legal')); ?>
			<label>2.2. Certificado de Existencia y Representación Legal.</label>
			<div class="checkbox">
				<label for="certificadoExistencia">La entidad presenta Certificado de Existencia y Representación Legal:</label>

				<?php foreach ($data_documentacion_legal as $documentacion) : ?>
					<?php if ($documentacion->registroEducativo == "certificadoExistencia") : ?>
						<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="Si" checked> Si</label>
						<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="" value="No"> No</label>
					<?php elseif ($documentacion->registroEducativo != "certificadoExistencia") : ?>
						<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="Si" disabled> Si</label>
						<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="" value="No" checked disabled> No</label>
					<?php endif ?>
				<?php endforeach ?>
				<?php if ($data_documentacion_legal == NULL) : ?>
					<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="certificadoExistencia" value="Si"> Si</label>
					<label><input type="radio" class="certificadoExistencia" name="certificadoExistencia" id="" value="No" checked> No</label>
				<?php endif ?>
			</div>
			<div id="div_certificado_existencia">
				<div class="form-group">
					<label for="numeroExistencia">Número del Documento de Existencia y Representación Legal:<span class="spanRojo">*</span></label>
					<input type="text" class="form-control" name="numeroExistencia" id="numeroExistencia" placeholder="Número del Documento de Existencia y Representación Legal" value="<?php echo $data_documentacion_legal->numeroExistencia; ?>">
				</div>
				<div class="form-group">
					<label for="fechaExpedicion">Fecha de Expedición:<span class="spanRojo">*</span></label>
					<input type="date" class="form-control" name="fechaExpedicion" id="fechaExpedicion" value="<?php echo $data_documentacion_legal->fechaExpedicion; ?>">
				</div>
				<!-- //TODO: Quitar de base de datos -->
				<!-- <div class="form-group">
					<label for="objetoSocial">Objeto social según certificado Cámara de Comercio:<span class="spanRojo">*</span></label>
					<textarea name="objetoSocial" class=" form-control" id="objetoSocial" placeholder="Objeto social según certificado Cámara de Comercio" maxlength="300"><?php echo $data_documentacion_legal->objetoSocial; ?></textarea>
				</div>-->
				<div class="form-group">
					<label for="departamentos">Departamento:<span class="spanRojo">*</span></label>
					<br>
					<select name="departamentos" data-id-dep="2" id="departamentos2" class="selectpicker form-control show-tick departamentos" required="">
						<?php
						foreach ($departamentos as $departamento) {
						?>
							<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<div id="div_municipios2">
						<label for="municipios2">Municipio:<span class="spanRojo">*</span></label>
						<br>
						<select name="municipios2" id="municipios2" class="selectpicker form-control show-tick municipios" required="">
							<?php
							foreach ($municipios as $municipio) {
							?>
								<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<!-- Registro educativo -->
		<div class="col-md-12">
			<hr />
			<label>2.3. Registro Educativo.</label>
			<small> Estos datos aplican solamente a Entidades Educativas (Opcional)*.</small>
			<div class="checkbox">
				<label for="registroEducativo">La entidad presenta registro educativo:</label>
				<?php foreach ($data_documentacion_legal as $documentacion) : ?>
					<?php if ($documentacion->registroEducativo == "Si Tiene") : ?>
						<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="Si" checked>Si</label>
						<label><input type="radio" class="registroEducativo" name="registroEducativo" id="" value="No">No</label>
					<?php elseif ($documentacion->registroEducativo != "Si Tiene") : ?>
						<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="Si" disabled>Si</label>
						<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="No" checked disabled>No</label>
					<?php endif ?>
				<?php endforeach ?>
				<?php if ($data_documentacion_legal == NULL) : ?>
					<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="Si"> Si</label>
					<label><input type="radio" class="registroEducativo" name="registroEducativo" id="registroEducativo" value="No" checked> No</label>
				<?php endif ?>
			</div>
			<div id="div_registro_educativo">
				<div class="form-group">
					<label for="entidadRegistro">Entidad que emitió el registro:<span class="spanRojo">*</span></label>
					<br>
					<select name="entidadRegistro" id="entidadRegistro" class="selectpicker form-control show-tick">
						<option id="1" value="Ministerio De Educación">Ministerio De Educación</option>
						<option id="2" value="Secretaria De Educación Departamental">Secretaria De Educación Departamental</option>
						<option id="3" value="Secretaria De Educación Municipal">Secretaria De Educación Municipal</option>
					</select>
				</div>
				<div class="form-group">
					<label for="numeroResolucion">Número de resolución:<span class="spanRojo">*</span></label>
					<input type="text" name="numeroResolucion" id="numeroResolucion" class="form-control" placeholder="Número de resolución...">
				</div>
				<div class="form-group">
					<label for="fechaResolucion">Fecha de resolución:<span class="spanRojo">*</span></label>
					<input type="date" name="fechaResolucion" id="fechaResolucion" class="form-control">
				</div>
				<div class="form-group">
					<label for="departamentos3">Departamento:<span class="spanRojo">*</span></label>
					<br>
					<select name="departamentos3" data-id-dep="3" id="departamentos3" class="selectpicker form-control show-tick departamentos" required="">
						<?php
						foreach ($departamentos as $departamento) {
						?>
							<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<div id="div_municipios3">
						<label for="municipios3">Municipio:<span class="spanRojo">*</span></label>
						<br>
						<select name="municipios3" id="municipios3" class="selectpicker form-control show-tick municipios" required="">
							<?php
							foreach ($municipios as $municipio) {
							?>
								<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<hr />
			</div>
		</div>
		</form>
		<button name="guardar_formulario_documentacion_legal" id="guardar_formulario_documentacion_legal" class="btn btn-siia btn-sm pull-right">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		<div class="clearfix"></div>
		<!-- Tabla de documentación -->
		<?php if (count($data_documentacion_legal) > 0) : ?>
			<div class="">
				<div class="clearfix"></div>
				<!-- Tabla de documentacion -->
				<div class="">
					<hr />
					<label>Documentación:</label>
					<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
					<table id="" width="100%" border=0 class="table table-striped table-bordered">
						<thead>
							<tr>
								<td>Certificado existencia</td>
								<td>Número existencia</td>
								<td>Fecha expedición</td>
								<td>Departamento certificado</td>
								<td>Municipio certificado</td>
								<td>Objeto aocial</td>
								<td>Registro Educativo</td>
								<td>Entidad registro</td>
								<td>Número resolución</td>
								<td>Fecha resolución</td>
								<td>Departamento resolución</td>
								<td>Municipio resolución</td>
								<td>Acción</td>
							</tr>
						</thead>
						<tbody id="tbody">
							<?php
							foreach ($data_documentacion_legal as $documentacion) {
								echo "<tr><td>" . $documentacion->certificadoExistencia . "</td>";
								echo "<td>" . $documentacion->numeroExistencia . "</td>";
								echo "<td>" . $documentacion->fechaExpedicion . "</td>";
								echo "<td>" . $documentacion->departamentoCertificado . "</td>";
								echo "<td>" . $documentacion->municipioCertificado . "</td>";
								echo "<td>" . $documentacion->objetoSocial . "</td>";
								echo "<td>" . $documentacion->registroEducativo . "</td>";
								echo "<td>" . $documentacion->entidadRegistro . "</td>";
								echo "<td>" . $documentacion->numeroResolucion . "</td>";
								echo "<td>" . $documentacion->fechaResolucion . "</td>";
								echo "<td>" . $documentacion->departamentoResolucion . "</td>";
								echo "<td>" . $documentacion->municipioResolucion . "</td>";
								echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarDocumentacionLegal' data-id-documentacion=" . $documentacion->id_documentacionLegal . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>
				<!-- Tabla de archivos -->
				<?php foreach ($data_documentacion_legal as $documentacion) : ?>
					<?php if ($documentacion->entidadRegistro != "Camara de Comercio") : ?>
						<hr />
						<div class="form-group">
							<?php echo form_open_multipart('', array('id' => 'formulario_registro_educativo')); ?>
							<label>Registro Educativo (PDF):<span class="spanRojo"> *</span></label>
							<br />
							<div class="col-md-4">
								<input type="file" required accept="application/pdf" class="form-control" data-val="registroEdu" name="registroEdu" id="registroEdu">
							</div>
							<div class="col-md-3">
								<input type="button" class="btn btn-siia btn-sm archivos_form_registro fa-fa center-block" data-name="registroEdu" name="registro" id="registro" value="Guardar archivo(s) &#xf0c7">
							</div>
							</form></br></br>
						</div>
						<div class="">
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
					<?php endif ?>
				<?php endforeach ?>
			</div>
		<?php endif ?>
	</div>
	<!-- Formulario de documentacion legal 2 - FIN -->
	<!-- Formulario de registro de programas 3 - INICIO -->
	<div id="registros_educativos_de_programas" data-form="2" class="formulario_panel">
		<div class="">
			<?php echo form_open('', array('id' => 'formulario_registro_educativo_de_programas')); ?>
			<h3>3. Registros educativos de Programas <i class="fa fa-newspaper-o" aria-hidden="true"></i></h3>
			<p>Ingrese sólo la información de los programas que cuentan con registro educativo. Para adicionar un nuevo registro presione sobre adicionar y para terminar presione en Continuar, los Campos marcados con (*) son obligatorios</p>
			<hr />
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
				<input type="text" name="" class="form-control" name="nombrePrograma" id="nombrePrograma" placeholder="Nombre del Programa...">
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
			</form>
			<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_registro_educativo" id="guardar_formulario_registro_educativo">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
			<div class="clearfix"></div>
			<hr />
			<label>Registro de programas:</label>
			<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
			<table id="" width="100%" border=0 class="table table-striped table-bordered">
				<thead>
					<tr>
						<td>Tipo</td>
						<td>Fecha</td>
						<td>Número</td>
						<td>Nombre</td>
						<td>Objeto</td>
						<td>Entidad</td>
						<td>Acción</td>
					</tr>
				</thead>
				<tbody id="tbody">
					<?php
					foreach ($data_registro_educativo as $registro) {
						echo "<tr><td>" . $registro->tipoEducacion . "</td>";
						echo "<td>" . $registro->fechaResolucion . "</td>";
						echo "<td>" . $registro->numeroResolucion . "</td>";
						echo "<td>" . $registro->nombrePrograma . "</td>";
						echo "<td>" . $registro->objetoResolucion . "</td>";
						echo "<td>" . $registro->entidadResolucion . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarRegistroPrograma' data-id-registro=" . $registro->id_registroEducativoPro . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Formulario de registro de programas 3 - FIN -->
	<!-- Formulario de antecedentes academicos 4 - INICIO -->
	<div id="antecedentes_academicos" data-form="4" class=" formulario_panel">
		<div class="">
			<?php echo form_open('', array('id' => 'formulario_antecedentes_academicos')); ?>
			<h3>3. Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></h3>
			<p>Se debe hacer un análisis de los niveles de formación, las necesidades y los avances de los procesos adelantados en materia pedagógica. También se deben determinar las áreas en donde se requiera afianzar y profundizar conocimientos. Los Campos marcados con (*) son obligatorios</p>
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
			</form>
			<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_antecedentes_academicos" id="guardar_formulario_antecedentes_academicos">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
			<div class="clearfix"></div>
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
		</div>
	</div>
	<!-- Formulario de antecedentes academicos 4 - FIN -->
	<!-- Formulario de jornadas de actualización 5 - INICIO -->
	<div id="jornadas_de_actualizacion" data-form="5" class=" formulario_panel">
		<div class="">
			<?php echo form_open('', array('id' => 'formulario_jornadas_actualizacion')); ?>
			<h3>4. Jornadas de actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></h3>
			<p>Registre los datos de la última jornada de actualización, organizada por Organizaciones Solidarias, a la que asistió. Si selecciona "No", de click en guardar y adjunte la carta de compromiso.</p>
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
			<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_jornadas_actualizacion" id="guardar_formulario_jornadas_actualizacion">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		</div>
	</div>
	<!-- Formulario de jornadas de actualizacion 5 - FIN -->
	<!-- Formulario de programa básico de economía solidaria 6 - INICIO -->
	<div id="programa_basico_de_economia_solidaria" data-form="6" class=" formulario_panel">
		<?php // echo form_open('', array('id' => 'formulario_programa_basico')); ?>
		<h3>5. Programas de educación en economía solidaria <i class="fa fa-server" aria-hidden="true"></i></h3>
		<p>Por favor lea atentamente los temas a desarrollar en cada curso y <strong>acepte </strong>desarrollarlos, creando las metodologías y materiales adecuados para el proceso de enseñanza y aprendizaje.</p>
		<p>Recuerde que al <strong>aceptar</strong> se registrara un compromiso y este quedara en nuestra base de datos.</p>
		<p>Pulsa en el <strong>enlace</strong> del curso para ver sus temas a desarrollar y acepté en la parte inferior del cuadro emergente para poder continuar.</p>
		<hr />
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="form-group" id="curso_basico_es" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="programa" form="formulario_programas" name="curso_basico_es" value="* Acreditación Curso Básico de Economía Solidaria" disabled required>
							<label for="modalCursoBasico">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoBasico" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Curso Básico de Economía Solidaria
							</a>
						</label>
					</div>
					<div class="form-group" id="curso_basico_aval" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="curso_basico_aval" form="formulario_programas" name="curso_basico_aval" value="* Acreditación, Aval de Trabajo Asociado" disabled required>
							<label for="modalAval">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalAval" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación, Aval de Trabajo Asociado
							</a>
						</label>
					</div>
					<div class="form-group" id="curso_medio_es" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="curso_basico_aval" form="formulario_programas" name="curso_basico" value="* Acreditación Curso Medio de Economía Solidaria" disabled required>
							<label for="modalCursoMedio">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoMedio" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Curso Medio de Economía Solidaria
							</a>
						</label>
					</div>
					<div class="form-group" id="curso_avanzado_es" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="curso_avanzado_es" form="formulario_programas" name="curso_avanzado_es" value="* Acreditación Curso Avanzado de Economía Solidaria" disabled required>
							<label for="modalCursoAvanzado">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoAvanzado" data-backdrop="static" data-keyboard="false">
								<span class="spanRojo">*</span> Acreditación Curso Avanzado de Economía Solidaria
							</a>
						</label>
					</div>
					<div class="form-group" id="curso_economia_financiera" style="display: none;" >
						<label class="underlined">
							<input type="checkbox" id="curso_economia_financiera" form="formulario_programas" name="curso_economia_financiera" value="* Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria" disabled required>
							<label for="modalCursoFinanciera">&nbsp;</label>
							<a data-toggle="modal" data-target="#modalCursoFinanciera" data-backdrop="static" data-keyboard="false" data-programa="Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria">
								<span class="spanRojo">*</span> Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria
							</a>
					</div>
					<input type="text" name="id_organizacion" id="id_organizacion" value="<?php echo $data_organizacion->id_organizacion;?>" style="display: none">
				</div>
			</div>
		</div>
	</div>
	<!-- Formulario de programa basico de economia solidaria 6 - FIN -->
	<!-- Formulario de aval de economia 7 - Inicio -->
	<div id="programas_aval_de_economia_solidaria_con_enfasis_en_trabajo_asociado" data-form="7" class=" formulario_panel">
		<?php echo form_open('', array('id' => 'formulario_programas_aval')); ?>
		<h3>7. Programas Aval de economía solidaria con énfasis en trabajo asociado <i class="fa fa-sitemap" aria-hidden="true"></i></h3>
		<p>Los campos marcados con (<span class="spanRojo">*</span>) son <strong>obligatorios</strong>.</p>
		<p>Recuerde presionar el botón <strong>guardar datos</strong> siempre que actualice o agregue información, se encontrara en la última página del formulario actual.</p>
		<div id="divAtrasProgAvalEcT">
			<div class="form-group">
				<label for="programas_aval_objetivos">7.1.Objetivos:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_aval_objetivos" id="programas_aval_objetivos" placeholder="Objetivos..."><?php echo $data_aval_economia->objetivos; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_aval_metodologia">7.2 Metodología a Utilizar:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_aval_metodologia" id="programas_aval_metodologia" placeholder="Metodología a Utilizar..."><?php echo $data_aval_economia->metodologia; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_aval_material">7.3 Material didáctico y ayudas Educativas incorporadas:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_aval_material" id="programas_aval_material" placeholder="Material didáctico y ayudas Educativas incorporadas..."><?php echo $data_aval_economia->materialDidactico; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_aval_bibliografia">7.4 Bibliografia:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_aval_bibliografia" id="programas_aval_bibliografia" placeholder="Bibliografia..."><?php echo $data_aval_economia->bibliografia; ?></textarea>
			</div>
			<!--<a>Ir al centro de documentacion de Organizaciones Solidarias.</a>-->
			<div class="form-group">
				<label for="programas_aval_duracion">7.5 Duración del curso:<span class="spanRojo">*</span></label>
				<input type="number" class="form-control" name="programas_aval_duracion" id="programas_aval_duracion" value="<?php echo $data_aval_economia->duracionCurso; ?>" placeholder="23">
			</div>
		</div>
		<div id="divSiguienteProgAvalEcT">
			<h3>7.6 Contextualización general del sector solidario</h3>
			<div class="form-group">
				<label for="programas_avalar_antecedentesAspectos">Antecedentes y aspectos axiológicos del cooperativismo y del cooperativismo de trabajo asociado:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_antecedentesAspectos" id="programas_avalar_antecedentesAspectos" class="form-control" placeholder="Antecedentes y aspectos axiológicos del cooperativismo y del cooperativismo de trabajo asociado..."><?php echo $data_aval_economia->antecedentesAspectos; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_diferencias">Diferencias entre trabajo dependiente, independiente y asociado:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_diferencias" id="programas_avalar_diferencias" class="form-control" placeholder="Diferencias entre trabajo dependiente, independiente y asociado..."><?php echo $data_aval_economia->diferencias; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_regulacionJuridica">Regulación jurídica del trabajo asociado:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_regulacionJuridica" id="programas_avalar_regulacionJuridica" class="form-control" placeholder="Regulación jurídica del trabajo asociado..."><?php echo $data_aval_economia->regulacionJuridica; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_desarrolloSocioempresarial">Desarrollo socioempresarial del trabajo asociado:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_desarrolloSocioempresarial" id="programas_avalar_desarrolloSocioempresarial" class="form-control" placeholder="Desarrollo socioempresarial del trabajo asociado..."><?php echo $data_aval_economia->desarrolloSocioempresarial; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_legislacionTributaria">Legislación tributaria y su aplicación al trabajo asociado:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_legislacionTributaria" id="programas_avalar_legislacionTributaria" class="form-control" placeholder="Legislación tributaria y su aplicación al trabajo asociado..."><?php echo $data_aval_economia->legislacionTributaria; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_administracionTrabajo">Administración del trabajo asociado:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_administracionTrabajo" id="programas_avalar_administracionTrabajo" class="form-control" placeholder="Administración del trabajo asociado..."><?php echo $data_aval_economia->administracionTrabajo; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_regimenesTrabajo">Regímenes de trabajo y compensación:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_regimenesTrabajo" id="programas_avalar_regimenesTrabajo" class="form-control" placeholder="Regímenes de trabajo y compensación..."><?php echo $data_aval_economia->regimenesTrabajo; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_manejoSeguridad">Manejo de Seguridad social integral:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_manejoSeguridad" id="programas_avalar_manejoSeguridad" class="form-control" placeholder="Manejo de Seguridad social integral..."><?php echo $data_aval_economia->manejoSeguridad; ?></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_inspeccionVigilancia">Inspección, vigilancia y control y prohibiciones:<span class="spanRojo">*</span></label>
				<textarea name="programas_avalar_inspeccionVigilancia" id="programas_avalar_inspeccionVigilancia" class="form-control" placeholder="Inspección, vigilancia y control y prohibiciones..."><?php echo $data_aval_economia->inspeccionVigilancia; ?></textarea>
			</div>
		</div>
		</form>
		<button id="atrasProgAvalEcT" class="btn btn-warning btn-sm pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Página atrás</button>
		<button id="siguienteProgAvalEcT" class="btn btn-warning btn-sm pull-right">Siguiente página <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
		<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_programas_aval" id="guardar_formulario_programas_aval">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		<div class="clearfix"></div>
		<hr />
		<div class="form-group">
			<?php echo form_open_multipart('', array('id' => 'formulario_material_programas_basicos')); ?>
			<label>Archivos de Material Didactico (PDF):</label>
			<br />
			<div class="col-md-4">
				<input type="file" required accept="application/pdf" class="form-control" data-val="materialDidacticoAvalEconomia" name="materialDidacticoAvalEconomia" id="materialDidacticoAvalEconomia">
			</div>
			<div class="col-md-3">
				<input type="button" class="btn btn-siia btn-sm archivos_form_aval_economia fa-fa center-block" data-name="materialDidacticoAvalEconomia" name="materialDicAvalEco" id="materialDicAvalEco" value="Guardar archivo(s) &#xf0c7">
			</div>
			</form>
		</div>
		<!--<div class="clearfix"></div>
        <hr/>
		<label>Datos:</label>-->
		<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
		<!--<table id="" width="100%" border=0 class="table table-striped table-bordered">
			<thead>
				<tr>
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
			foreach ($data_aval_economia as $programasAvalEconomia) {
				echo "<tr><td>" . $programasAvalEconomia->objetivos . "</td>";
				echo "<td>" . $programasAvalEconomia->metodologia . "</td>";
				echo "<td>" . $programasAvalEconomia->materialDidactico . "</td>";
				echo "<td>" . $programasAvalEconomia->bibliografia . "</td>";
				echo "<td>" . $programasAvalEconomia->duracionCurso . "</td>";
				echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarProgramasAval' data-id-programasAval=" . $programasAvalEconomia->id_programasAvalEconomia . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
			}
			?>
			</tbody>
		</table>-->
		<div class="clearfix"></div>
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
	<!-- Formulario de aval de economia 7 - FIN -->
	<!-- Formulario de programas 8 - INICIO -->
	<div id="programas" data-form="8" class=" formulario_panel">
		<?php echo form_open_multipart('', array('id' => 'formulario_programas_avalar')); ?>
		<h3>8. Programas <i class="fa fa-signal" aria-hidden="true"></i></h3>
		<p>Ingrese solo la información de los programas que desea avalar. Recuerde incluir los archivos del material didáctico y evaluación. Para adicionar un nuevo registro presione sobre adicionar y para terminar presione en continuar, los Campos marcados con (*) son obligatorios</p>
		<div class="col-md-6">
			<div class="form-group">
				<label for="programas_avalar_nombre">8.1 Nombre del programa:<span class="spanRojo">*</span></label>
				<input type="text" class="form-control" name="programas_avalar_nombre" id="programas_avalar_nombre" placeholder="Nombre del programa">
			</div>
			<div class="form-group">
				<label for="programas_avalar_objetivo">8.2 Objetivo:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_avalar_objetivo" id="programas_avalar_objetivo" placeholder="Objetivo..."></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_metodologia">8.3 Metodología:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_avalar_metodologia" id="programas_avalar_metodologia" placeholder="Metodología..."></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_contenidos">8.4 Contenidos planteados:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_avalar_contenidos" id="programas_avalar_contenidos" placeholder="Contenidos planteados..."></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_material">8.5 Material didactico:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_avalar_material" id="programas_avalar_material" placeholder="Material didactico..."></textarea>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="programas_avalar_bibliografia">8.6 Bibliografía:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_avalar_bibliografia" id="programas_avalar_bibliografia" placeholder="Bibliografía..."></textarea>
			</div>
			<div class="form-group">
				<label for="programas_avalar_intensidad">8.7 Intensidad horaria (Horas):<span class="spanRojo">*</span></label>
				<input type="text" class="form-control" name="programas_avalar_intensidad" id="programas_avalar_intensidad" placeholder="15">
			</div>
			<div class="form-group">
				<label for="programas_avalar_evaluacion">8.8 Evaluación:<span class="spanRojo">*</span></label>
				<textarea class="form-control" name="programas_avalar_evaluacion" id="programas_avalar_evaluacion" placeholder="Evaluación..."></textarea>
			</div>
		</div>
		</form>
		<div class="clearfix"></div>
		<hr />
		<div class="col-md-6">
			<?php echo form_open_multipart('', array('id' => 'formulario_formatosEval')); ?>
			<label>Formatos Evaluación (PDF):<span class="spanRojo">*</span></label>
			<br />
			<div class="col-md-6">
				<input type="file" required accept="application/pdf" class="form-control" data-val="formatosEvalProgAvalar" name="formatosEvalProgAvalar" id="formatosEvalProgAvalar">
			</div>
			<div class="col-md-6">
				<input type="button" class="btn btn-siia btn-sm archivos_form_formatosEvalProgAva fa-fa center-block" data-name="formatosEvalProgAvalar" name="materialDicProgAvalar" id="materialDicProgAvalar" value="Guardar archivo(s) &#xf0c7">
			</div>
			</form>
		</div>
		<div class="col-md-6">
			<?php echo form_open_multipart('', array('id' => 'formulario_material_programas_basicos')); ?>
			<label>Material Didáctico (PDF):<span class="spanRojo">*</span></label>
			<br />
			<div class="col-md-6">
				<input type="file" required accept="application/pdf" class="form-control" data-val="materialDidacticoProgAvalar" name="materialDidacticoProgAvalar" id="materialDidacticoProgAvalar">
			</div>
			<div class="col-md-6">
				<input type="button" class="btn btn-siia btn-sm archivos_form_materialDidacProgAvalar fa-fa center-block" data-name="materialDidacticoProgAvalar" name="materialDicAvalEco" id="materialDicAvalEco" value="Guardar archivo(s) &#xf0c7">
			</div>
			</form>
		</div>
		<div class="clearfix"></div>
		<div class="">
			<hr />
			<label>Programas:</label>
			<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
			<table id="" width="100%" border=0 class="table table-striped table-bordered">
				<thead>
					<tr>
						<td>Nombre programa</td>
						<td>objetivos</td>
						<td>Metodología</td>
						<td>Contenidos planteados</td>
						<td>Material didactico</td>
						<td>Bibliografia</td>
						<td>Intensidad horaria</td>
						<td>Evaluación</td>
						<td>Acción</td>
					</tr>
				</thead>
				<tbody id="tbody">
					<?php
					foreach ($data_programas_avalar as $programasAvalar) {
						echo "<tr><td>" . $programasAvalar->nombrePrograma . "</td>";
						echo "<td>" . $programasAvalar->objetivos . "</td>";
						echo "<td>" . $programasAvalar->metodologia . "</td>";
						echo "<td>" . $programasAvalar->contenidosPlanteados . "</td>";
						echo "<td>" . $programasAvalar->materialDidactico . "</td>";
						echo "<td>" . $programasAvalar->bibliografia . "</td>";
						echo "<td>" . $programasAvalar->intensidadHoraria . "</td>";
						echo "<td>" . $programasAvalar->evaluacion . "</td>";
						echo "<td><button class='btn btn-danger btn-sm eliminarDataTabla eliminarProgramasAvalar' data-id-programasAvalar=" . $programasAvalar->id_programasAvalar . ">Eliminar <i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
					}
					?>
				</tbody>
			</table>
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
			<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_programas_avalar" id="guardar_formulario_programas_avalar">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
		</div>
	</div>
	<!-- Formulario de programas 8 - FIN -->
	<!-- Formulario de docentes 9 - INICIO -->
	<div id="docentes" data-form="9" class=" formulario_panel">
		<h3>6. Facilitadores <i class="fa fa-users" aria-hidden="true"></i></h3>
		<div class="container">
			<div class="jumbotron">
				<h3>Facilitadores</h3>
				<p>Para crear facilitadores y actualizar o adjuntar archivos como hojas de vida, certificaciones, por favor, de <a href="<?php base_url() ?>panel/docentes" target="_blank">click aquí.</a></p>
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
	<!-- Formulario de docentes 9 - FIN -->
	<!-- Formulario Datos Plataforma 10 - INICIO -->
	<div id="datos_plataforma" data-form="10" class=" formulario_panel">
		<h3>7. Datos modalidad virtual<i class="fa fa-globe" aria-hidden="true"></i></h3>
		<p>Ingrese los datos de ingreso con un instructivo para poder navegar dentro del curso.</p>
		<div class="form-group">
			<label for="datos_plataforma_url">URL:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_url" id="datos_plataforma_url" placeholder="https://www.orgsolidarias.gov.co/">
		</div>
		<div class="form-group">
			<label for="datos_plataforma_usuario">Usuario:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_usuario" id="datos_plataforma_usuario" placeholder="usuario.aplicacion">
		</div>
		<div class="form-group">
			<label for="datos_plataforma_contrasena">Contraseña:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_contrasena" id="datos_plataforma_contrasena" placeholder="contraseña123@">
		</div>
		<div class="clearfix"></div>
		<hr />
		<div class="">
			<?php echo form_open_multipart('', array('id' => 'formulario_material_programas_basicos')); ?>
			<label>Instructivo (PDF):<span class="spanRojo">*</span></label>
			<br />
			<div class="col-md-4">
				<input type="file" required accept="application/pdf" class="form-control" data-val="instructivoPlataforma" name="instructivoPlataforma" id="instructivoPlataforma">
			</div>
			<div class="col-md-3">
				<input type="button" class="btn btn-siia btn-sm archivos_form_instructivoPlataforma fa-fa center-block" data-name="instructivoPlataforma" name="materialDicAvalEco" id="materialDicAvalEco" value="Guardar archivo(s) &#xf0c7">
			</div>
			</form>
		</div>
		<div class="clearfix"></div>
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
		<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_plataforma" id="guardar_formulario_plataforma">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
	<!-- Formulario Datos Plataforma 10 - FIN -->
	<!-- Formulario Datos Plataforma 9 - INICIO -->
	<div id="datos_en_linea" data-form="11" class=" formulario_panel">
		<h3>8. Datos modalidad en linea<i class="fa fa-globe" aria-hidden="true"></i></h3>
		<p>Ingrese los datos de ingreso con un instructivo para poder navegar dentro del curso.</p>
		<div class="form-group">
			<label for="datos_plataforma_url">URL:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_url" id="datos_plataforma_url" placeholder="https://www.orgsolidarias.gov.co/">
		</div>
		<div class="form-group">
			<label for="datos_plataforma_usuario">Usuario:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_usuario" id="datos_plataforma_usuario" placeholder="usuario.aplicacion">
		</div>
		<div class="form-group">
			<label for="datos_plataforma_contrasena">Contraseña:<span class="spanRojo">*</span></label>
			<input type="text" class="form-control" name="datos_plataforma_contrasena" id="datos_plataforma_contrasena" placeholder="contraseña123@">
		</div>
		<div class="clearfix"></div>
		<hr />
		<div class="">
			<?php echo form_open_multipart('', array('id' => 'formulario_material_programas_basicos')); ?>
			<label>Instructivo (PDF):<span class="spanRojo">*</span></label>
			<br />
			<div class="col-md-4">
				<input type="file" required accept="application/pdf" class="form-control" data-val="instructivoPlataforma" name="instructivoPlataforma" id="instructivoPlataforma">
			</div>
			<div class="col-md-3">
				<input type="button" class="btn btn-siia btn-sm archivos_form_instructivoPlataforma fa-fa center-block" data-name="instructivoPlataforma" name="materialDicAvalEco" id="materialDicAvalEco" value="Guardar archivo(s) &#xf0c7">
			</div>
			</form>
		</div>
		<div class="clearfix"></div>
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
		<button class="btn btn-siia btn-sm pull-right" name="guardar_formulario_plataforma" id="guardar_formulario_plataforma">Guardar datos <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
	<!-- Formulario Datos Plataforma 9 - FIN -->
	<!-- Fin de Formularios -->
	<!-- Continuar para finalizar Acreditacion - INICIO -->
	<div id="finalizar_proceso" data-form="0" class="col-md-9 formulario_panel">
		<div id="verificacion_formularios"></div>
		<div class="container">
			<div class="jumbotron" id="verificar_btn">
				<h4>¿Desea finalizar el proceso?</h4>
				<p>Si ya adjunto todos los documentos e información necesaria para la solicitud, de click en si, y espere a las observaciones si existen por parte del evaluador.</p>
				<button class="btn btn-danger btn-sm" id="finalizar_no">No, voy a verificar <i class="fa fa-times" aria-hidden="true"></i></button>
				<button class="btn btn-siia btn-sm" id="siFinSol" data-toggle="modal" data-target="#modalFinalizarProceso">Si, terminar la solicitud <i class="fa fa-check-square-o" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
	<!-- Continuar para finalizar Acreditacion - FIN -->
	<a id="hide-sidevar" class="btn btn-siia btn-sm hide-sidevar" role="button" title="Ocultar Menú" data-toggle="tooltip" data-placement="left"><i class="fa fa-window-close-o" aria-hidden="true"></i>
		<v>Ocultar menú</v>
	</a>
	<div class="modal fade" id="modalFinalizarProceso" tabindex="-1" role="dialog" aria-labelledby="finalizarSeguro">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="finalizarSeguro">¿Esta seguro de finalizar el proceso de solicitud?</h4>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">No, voy a verificar <i class="fa fa-times" aria-hidden="true"></i></button>
					<button class="btn btn-siia btn-sm pull-right" id="finalizar_si">Si, estoy completamente seguro de terminar y enviar la solicitud <i class="fa fa-check-square-o" aria-hidden="true"></i></button>
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
						<!-- Tablas de cursos -->
						<div class="col-md-12">
							Texto Curso Básico
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_programa" data-programa="Acreditación Curso Básico de Economía Solidaria">Sí, acepto. <i class="fa fa-check"></i></button>
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
						<!-- Tablas de cursos -->
						<div class="col-md-12">
							Texto Acreditación, Aval
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_programa" data-programa="Acreditación, Aval de Trabajo Asociado">Sí, acepto. <i class="fa fa-check"></i></button>
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
						<div class="col-md-12">
							Texto Curso Medio
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_programa" data-programa="Acreditación Curso Medio de Economía Solidaria">Sí, acepto. <i class="fa fa-check"></i></button>
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
						<div class="col-md-12">
							Texto Curso Avanzado
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_programa" data-programa="Acreditación Curso Avanzado de Economía Solidaria">Sí, acepto. <i class="fa fa-check"></i></button>
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
						<div class="col-md-12">
							Texto Curso Financiera
						</div>
					</div>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_programa" data-programa="Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria">Sí, acepto. <i class="fa fa-check"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
