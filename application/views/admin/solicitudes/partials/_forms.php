<!-- Información General Organización -->
<div class="col-md-12" id="informacion">
	<h3>1. Información General.</h3><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<!-- Tipo Organización -->
				<h5>Tip Organización: </h5><p class="tipoLeer" id='tipoOrganizacion'></p>
				<!-- Departamento -->
				<h5>Departamento: </h5><p class="tipoLeer" id='nomDepartamentoUbicacion'></p>
				<!-- Municipio -->
				<h5>Municipio: </h5><p class="tipoLeer" id='nomMunicipioNacional'></p>
				<!-- Dirección -->
				<h5>Dirección: </h5><p class="tipoLeer" id='direccionOrganizacion'></p>
				<!-- Teléfono - Fax -->
				<h5>Teléfono - Fax: </h5><p class="tipoLeer" id='fax'></p>
				<!-- Extensión -->
				<h5>Extensión: </h5><p class="tipoLeer" id='extension'></p>
				<!-- URL de la Organización -->
				<h5>URL de la Organización: </h5><p class="tipoLeer" id='urlOrganizacion'></p>
				<!-- Actuación -->
				<h5>Actuación: </h5><p class="tipoLeer" id='actuacionOrganizacion'></p>
				<!-- Tipo Educación -->
				<h5>Tipo de educación: </h5><p class="tipoLeer" id='tipoEducacion'></p>
			</div>
			<div class="col-lg-6">
				<!-- Cédula Representante Legal -->
				<h5>Cédula del representante Legal: </h5><p class="tipoLeer" id='numCedulaCiudadaniaPersona'></p>
				<!-- Presentación Institucional
				<h5>Presentación institucional: </h5><p class="tipoLeer" id='presentacionInstitucional'></p>-->
				<!-- Objeto Social
				<h5>Objeto social: </h5><p class="tipoLeer" id='objetoSocialEstatutos'></p>-->
				<!-- Misión -->
				<h5>Misión: </h5><p class="tipoLeer" id='mision'></p>
				<!-- Visión -->
				<h5>Visión: </h5><p class="tipoLeer" id='vision'></p>
				<!-- Principios
				<h5>Principios: </h5><p class="tipoLeer" id='principios'></p>-->
				<!-- Fines
				<h5>Fines: </h5><p class="tipoLeer" id='fines'></p>-->
				<!-- Portafolio -->
				<h5>Portafolio: </h5><p class="tipoLeer" id='portafolio'></p>
				<!-- Otros
				<h5>Otros: </h5><p class="tipoLeer" id='otros'></p>-->
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<hr />
	<div class="col-md-12" id="archivos_informacionGeneral">
		<p>Archivos:</p>
	</div>
	<div class="clearfix"></div>
	<hr />
	<!-- Formulario Observación form1 -->
	<div class="col-12">
		<?php echo form_open('', array('id' => 'formulario_observacion_form1')); ?>
		<div class="form-group">
			<label for="observacionesForm1">Observaciones Información General</label>
			<textarea class="form-control obs_admin_" name="observacionesForm1" id="observacionesForm1" cols="30" rows="5" required></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-siia guardarObservacionesForm1">Guardar Observación <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<hr />
	<label>Observaciones Realizadas</label>
	<div class="observaciones_realizadas_form1"></div>
</div>
<div class="col-md-12" id="documentacion">
	<h3>2. Documentación Legal</h3>
	<div class="">
		<label>Datos Documentación Legal:</label>
		<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
		<table id="tabla_datos_documentacion_legal" width="100%" border=0 class="table table-striped table-bordered">
			<thead class="head_tabla_datos_documentacion_legal">
			</thead>
			<tbody id="tbody" class="tabla_datos_documentacion_legal"></tbody>
		</table>
	</div>
	<hr />
	<div class="clearfix"></div>
	<hr />
	<!-- Formulario Observación form2 -->
	<div class="col-12">
		<?php echo form_open('', array('id' => 'formulario_observacion_form2')); ?>
		<div class="form-group">
			<label for="observacionesForm2">Observaciones Documentación Legal</label>
			<textarea class="form-control obs_admin_" name="observacionesForm2" id="observacionesForm2" cols="30" rows="5" required></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-siia guardarObservacionesForm2" id="sigInf">Guardar Observación <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<hr />
	<label>Observaciones Realizadas</label>
	<div class="observaciones_realizadas_form2"></div>
</div>
<div class="col-md-12" id="jornadasActualizacion">
	<h3>3. Jornadas de Actualización</h3>
	<!-- Tabla Jornadas de Actualización -->
	<label>Datos de Jornadas de Actualización:</label>
	<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
	<table id="" width="100%" border=0 class="table table-striped table-bordered">
		<thead>
		<tr>
			<td>Participó en jornadas</td>
			<td>Acciones</td>
		</tr>
		</thead>
		<tbody id="tbody" class="tabla_datos_jornadas"></tbody>
	</table>
	<hr />
	<!-- Formulario Observación form3 -->
	<div class="col-12">
		<?php echo form_open('', array('id' => 'formulario_observacion_form3')); ?>
		<div class="form-group">
			<label for="observacionesForm3">Observaciones Jornadas de Actualización</label>
			<textarea class="form-control obs_admin_" name="observacionesForm3" id="observacionesForm3" cols="30" rows="5" required></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-siia guardarObservacionesForm3" id="sigInf">Guardar Observación <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<hr />
	<label>Observaciones Realizadas</label>
	<div class="observaciones_realizadas_form3"></div>
</div>
<div class="col-md-12" id="datosBasicosProgramas">
	<h3>4. Datos Básicos de Programas</h3><br>
	<p>A continuación se relaciona el motivo de la solicitud registrado por la organización.</p><br><br>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="form-group" id="curso_basico_es" style="display: none;" >
					<label class="underlined">
						<input type="checkbox" id="programa" form="formulario_programas" name="curso_basico_es" value="* Acreditación Curso Básico de Economía Solidaria" disabled required checked>
						<label for="modalCursoBasico">&nbsp;</label>
						<a data-toggle="modal" data-target="#modalCursoBasico" data-backdrop="static" data-keyboard="false">
							<span class="spanRojo">*</span> Acreditación Curso Básico de Economía Solidaria
						</a>
					</label>
				</div>
				<br>
				<div class="form-group" id="curso_basico_aval" style="display: none;" >
					<label class="underlined">
						<input type="checkbox" id="curso_basico_aval" form="formulario_programas" name="curso_basico_aval" value="* Acreditación, Aval de Trabajo Asociado" disabled required checked>
						<label for="modalAval">&nbsp;</label>
						<a data-toggle="modal" data-target="#modalAval" data-backdrop="static" data-keyboard="false">
							<span class="spanRojo">*</span> Acreditación, Aval de Trabajo Asociado
						</a>
					</label>
				</div>
				<br>
				<div class="form-group" id="curso_medio_es" style="display: none;" >
					<label class="underlined">
						<input type="checkbox" id="curso_basico_aval" form="formulario_programas" name="curso_basico" value="* Acreditación Curso Medio de Economía Solidaria" disabled required checked>
						<label for="modalCursoMedio">&nbsp;</label>
						<a data-toggle="modal" data-target="#modalCursoMedio" data-backdrop="static" data-keyboard="false">
							<span class="spanRojo">*</span> Acreditación Curso Medio de Economía Solidaria
						</a>
					</label>
				</div>
				<br>
				<div class="form-group" id="curso_avanzado_es" style="display: none;" >
					<label class="underlined">
						<input type="checkbox" id="curso_avanzado_es" form="formulario_programas" name="curso_avanzado_es" value="* Acreditación Curso Avanzado de Economía Solidaria" disabled required checked>
						<label for="modalCursoAvanzado">&nbsp;</label>
						<a data-toggle="modal" data-target="#modalCursoAvanzado" data-backdrop="static" data-keyboard="false">
							<span class="spanRojo">*</span> Acreditación Curso Avanzado de Economía Solidaria
						</a>
					</label>
				</div>
				<br>
				<div class="form-group" id="curso_economia_financiera" style="display: none;" >
					<label class="underlined">
						<input type="checkbox" id="curso_economia_financiera" form="formulario_programas" name="curso_economia_financiera" value="* Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria" disabled required checked>
						<label for="modalCursoFinanciera">&nbsp;</label>
						<a data-toggle="modal" data-target="#modalCursoFinanciera" data-backdrop="static" data-keyboard="false" data-programa="Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria">
							<span class="spanRojo">*</span> Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria
						</a>
				</div>
				<br>
			</div>
			<hr />
			<label>Registro de programas aceptados</label>
			<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
			<table width="100%" border=0 class="table table-striped table-bordered" id="tabla_registro_programas">
				<thead>
				<tr>
					<td>Organización</td>
					<td>Numero NIT</td>
					<td>Nombre Programa</td>
					<td>Acepta</td>
					<td>fecha</td>
				</tr>
				</thead>
				<tbody id="tbody" class="tabla_registro_programas"></tbody>
			</table>
			<div class="col-12">
				<?php echo form_open('', array('id' => 'formulario_observacion_form4')); ?>
				<div class="form-group">
					<label for="observacionesForm4">Observaciones Datos Básicos de Programas</label>
					<textarea class="form-control obs_admin_" name="observacionesForm4" id="observacionesForm4" cols="30" rows="5" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-siia guardarObservacionesForm4">Guardar Observación <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
				</div>
				<?php echo form_close(); ?>
			</div>
			<hr />
			<label>Observaciones Realizadas</label>
			<div class="observaciones_realizadas_form4"></div>
		</div>
	</div>
	<hr />
</div>
<div class="col-md-12" id="docentes">
	<h3>5. Docentes</h3>
	<!-- <button id="verFrameDocentes" class="btn btn-siia btn-sm pull-left">Ver docentes aquí <i class="fa fa-eye" aria-hidden="true"></i></button> -->
	<hr />
	<div class="txtOrgDocen"></div>
	<!-- <div id="frameDocDiv" class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" id="frameDocentes" frameborder="0" allowfullscreen></iframe>
	</div>-->
	<div class="clearfix"></div>
	<hr />
	<a href="" target="_blank" id="irAEvaluarDocente" class="btn btn-siia">Evaluar docentes <i class="fa fa-eye" aria-hidden="true"></i></a>
	<div class="clearfix"></div>
	<hr />
</div>
<div class="col-md-12" id="plataforma">
	<h3>6. Datos modalidad virtual</h3>
	<label>Datos de herramientas:</label>
	<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
	<table id="tabla_datos_plataforma" width="100%" border=0 class="table table-striped table-bordered">
		<thead>
		<tr>
			<td>UrlAplicación</td>
			<td>Usuario</td>
			<td>Contraseña</td>
		</tr>
		</thead>
		<tbody id="tbody" class="tabla_datos_plataforma"></tbody>
	</table>
	<hr />
	<div class="col-12">
		<?php echo form_open('', array('id' => 'formulario_observacion_form6')); ?>
		<div class="form-group">
			<label for="observacionesForm6">Observaciones modalidad virtual</label>
			<textarea class="form-control obs_admin_" name="observacionesForm6" id="observacionesForm6" cols="30" rows="5" required></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-siia guardarObservacionesForm6">Guardar Observación <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<hr />
	<label>Observaciones Realizadas</label>
	<div class="observaciones_realizadas_form6"></div>
</div>
<div class="col-md-12" id="enLinea">
	<h3>7. Datos modalidad en línea</h3>
	<!-- Tabla herramientas -->
	<label>Datos de herramientas:</label>
	<!--<a class="dataReload">Recargar <i class="fa fa-refresh" aria-hidden="true"></i></a>-->
	<table id="" width="100%" border=0 class="table table-striped table-bordered">
		<thead>
		<tr>
			<td>Herramienta</td>
			<td>Descripción</td>
			<td>Fecha de registro</td>
		</tr>
		</thead>
		<tbody id="tbody" class="datos_herramientas"></tbody>
	</table>
	<hr />
	<div class="col-12">
		<?php echo form_open('', array('id' => 'formulario_observacion_form7')); ?>
		<div class="form-group">
			<label for="observacionesForm7">Observaciones modalidad en Línea</label>
			<textarea class="form-control obs_admin_" name="observacionesForm7" id="observacionesForm7" cols="30" rows="5" required></textarea>
		</div>
		<div class="form-group">
			<button class="btn btn-siia guardarObservacionesForm7">Guardar Observación <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<hr />
	<label>Observaciones Realizadas</label>
	<div class="observaciones_realizadas_form7"></div>
</div>
