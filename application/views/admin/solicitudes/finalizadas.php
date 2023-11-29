<?php
/***
 * @var $solicitudesAsignadas
 * @var Solicitudes $this
 * @var $nombre_usuario
 * @var $nivel
 */
?>
<!-- Solicitudes a evaluar-->
<div class="container">
	<div class="row">
		<div class="col-md-12" id="admin_ver_finalizadas">
			<div class="clearfix"></div>
			<hr />
			<h3>Solicitudes en evaluación:</h3>
			<br>
			<!-- Tabla de solicitudes en evaluación	-->
			<div class="table">
				<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
					<thead>
					<tr>
						<td class="col-md-2">Nombre</td>
						<td class="col-md-2">NIT</td>
						<td class="col-md-2">ID Solicitud</td>
						<td class="col-md-2">Tipo</td>
						<td class="col-md-2">Motivo</td>
						<td class="col-md-2">Modalidad</td>
						<td class="col-md-2">Fecha de finalización</td>
						<td class="col-md-2">Fecha última revisión</td>
						<td class="col-md-2">Asignada a</td>
						<td class="col-md-2">Acción</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($solicitudesAsignadas as $solicitud) :
						if (($solicitud->asignada == $nombre_usuario && $nivel == 1) || ($nivel == 0 || $nivel == 6) ):
							echo "<tr>";
							echo "<td>" . $solicitud->nombreOrganizacion . "</td>";
							echo "<td>" . $solicitud->numNIT . "</td>";
							echo "<td>" . $solicitud->idSolicitud . "</td>";
							echo "<td>" . $solicitud->tipoSolicitud . "</td>";
							echo "<td>" . $solicitud->motivoSolicitud . "</td>";
							echo "<td>" . $solicitud->modalidadSolicitud . "</td>";
							echo "<td>" . $solicitud->fechaFinalizado . "</td>";
							echo "<td>" . $solicitud->fechaUltimaRevision . "</td>";
							echo "<td>" . $solicitud->asignada . "</td>";
							echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm ver_organizacion_finalizada' id='' data-organizacion='" . $solicitud->id_organizacion . "' data-solicitud='" . $solicitud->idSolicitud . "'>Ver información <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
							echo "</tr>";
						endif;
					endforeach;
					?>
					</tbody>
				</table>
				<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>
<!-- Registro de observaciones por formulario -->
<div class="container" id="admin_panel_ver_finalizada">
	<div class="panel-group" id="datos_org_final">
		<hr />
		<button id="desplInfoOrg" class="btn btn-sm btn-success btn-block">Desplegar información de la organización <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></button>
		<button id="plegInfoOrg" class="btn btn-sm btn-danger btn-block">Plegar información de la organización <i class="fa fa-chevron-circle-up" aria-hidden="true"></i></button>
		<div id="verInfoOrg">
			<hr />
			<div class="col-md-4">
				<div class="form-group">
					<p>Nombre de la organización:</p><label class="tipoLeer" id='nOrgSol'></label>
				</div>
				<div class="form-group">
					<p>Sigla:</p><label class="tipoLeer" id='sOrgSol'></label>
				</div>
				<div class="form-group">
					<p>Número NIT:</p><label class="tipoLeer" id='nitOrgSol'></label>
				</div>
				<div class="form-group">
					<p>Nombre del representante:</p><label class="tipoLeer" id='nrOrgSol'></label>
				</div>
				<div class="form-group">
					<p>Correo de la organización:</p><label class="tipoLeer" id='cOrgSol'></label>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<p>Fecha de creación de la cuenta:</p><label class="tipoLeer" id='fechaSol'></label>
				</div>
				<div class="form-group">
					<p>ID de la solicitud:</p><label class="tipoLeer" id='idSol'></label>
				</div>
				<div class="form-group">
					<p>Tipo de solicitud:</p><label class="tipoLeer" id='tipoSol'></label>
				</div>
				<div class="form-group">
					<p>Modalidad de la solicitud:</p><label class="tipoLeer" id='modSol'></label>
				</div>
				<div class="form-group">
					<p>Motivo de la solicitud:</p><label class="tipoLeer" id='motSol'></label>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<p>Fecha de finalización de la solicitud:</p><label class="tipoLeer" id='revFechaFin'></label>
				</div>
				<div class="form-group">
					<p>Numero de solicitudes:</p><label class="tipoLeer" id='numeroSol'></label>
				</div>
				<div class="form-group">
					<p>Revisión #:</p><label class="tipoLeer" id='revSol'></label>
				</div>
				<div class="form-group">
					<p>Fecha de última revisión:</p><label class="tipoLeer" id='revFechaSol'></label>
				</div>
				<div class="form-group">
					<p>Estado de la organización:</p><label class="tipoLeer" id='estOrg'></label>
				</div>
				<div class="form-group">
					<p>Cámara de comercio: <a href="" id="camaraComercio_org" target="_blank">Clic aquí para ver la cámara de comercio</a></p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<hr />
		<button class="btn btn-danger btn-sm pull-left" id="admin_ver_finalizadas_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		<button class="btn btn-sm btn-warning pull-right" id="verRelacionCambios" data-toggle='modal' data-target='#modalRelacionCambios'>Ver relacion de cambios <i class="fa fa-eye" aria-hidden="true"></i></button>
		<button class="btn btn-sm btn-info pull-right" data-toggle='modal' data-target='#modalPedirCamara'>Pedir cámara de comercio <i class="fa fa-refresh" aria-hidden="true"></i></button>
		<button class="btn btn-siia btn-sm pull-right verHistObs" id="hist_org_obs" data-backdrop="false" data-toggle='modal' data-target='#verHistObs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
		<div class="clearfix"></div>
		<hr />
		<div id="anclaInicio"></div>
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
	</div>
</div>
<!-- Botón Menu de formulario -->
<div class="icono--div4">
	<a class="btn btn-siia btn-sm icono3 desOptSiia" role="button" title="Menu Formulario" data-toggle="tooltip" data-placement="right">Menu Formulario <i class="fa fa-bars" aria-hidden="true"></i></a>
</div>
<!-- Menu de formularios -->
<div class="contenedor--menu3">
	<div class="icono--div3">
		<div class="center-block" id="menuObsAdmin">
			<label>Menú de formularios:</label>
			<a class="icono3 desOptSiia pull-right" role="button" title="Menu Formulario"><i class="fa fa-times" aria-hidden="true"></i></a>
			<hr />
			<a class="toAncla" id="verInfGenMenuAdmin">1. Información General de la Entidad <i class="fa fa-home" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verDocLegalMenuAdmin">2. Documentación Legal <i class="fa fa-book" aria-hidden="true"></i></a><br />
<!--			<a class="toAncla" id="verRegAcaMenuAdmin">3. Registros educativos de Programas <i class="fa fa-newspaper-o" aria-hidden="true"></i></a><br />-->
			<!-- <a class="toAncla" id="verAntAcaMenuAdmin">3. Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></a><br /> -->
			<a class="toAncla" id="verJorActMenuAdmin">3. Jornadas de actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verProgBasMenuAdmin">4. Programa básico de economía solidaria <i class="fa fa-server" aria-hidden="true"></i></a><br />
<!--			<a class="toAncla" id="verProgAvaMenuAdmin">7. <small>Prog. de Economía Solidaria con Énfasis en Trabajo Asociado</small> <i class="fa fa-sitemap" aria-hidden="true"></i></a><br />-->
<!--			<a class="toAncla" id="verProgsMenuAdmin">8. Programas <i class="fa fa-signal" aria-hidden="true"></i></a><br />-->
			<a class="toAncla" id="verFaciliMenuAdmin">5. Facilitadores <i class="fa fa-users" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verDatPlatMenuAdmin">6. Datos Plataforma Virtual <i class="fa fa-globe" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verDataEnLinea">7. Datos Plataforma En Linéa <i class="fa fa-globe" aria-hidden="true"></i></a><br />
			<hr />
			<button class="btn btn-siia btn-sm btn-block" data-toggle="modal" id="terminar_proceso_observacion">Terminar proceso de observaciones <i class="fa fa-check" aria-hidden="true"></i></button>
		</div>
	</div>
</div>
<!-- Modal ver historial de observaciones -->
<div class="modal fade" id="verHistObs" tabindex="-1" role="dialog" aria-labelledby="verhistobs">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
				<h3 class="modal-title" id="verhistobs">Observaciones</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label>Historial de observaciones:</label>
<!--						<label><a id="verObsFiltrada" target="_blank" class="pull-right">Ver tabla de observaciones para filtrar y descargar <i class="fa fa-table" aria-hidden="true"></i></a></label>-->
<!--						<div class="input-group">-->
<!--							<input type="text" class="form-control" placeholder="Buscar una observación..." id="buscarObsTextOrg" />-->
<!--							<div class="clearfix"></div>-->
<!--							<br />-->
<!--						</div>-->
<!--						<table id="tabla_historial_obsPlataforma" width="100%" border=0 class="table table-striped table-bordered tabla_form">-->
<!--							<thead>-->
<!--								<tr>-->
<!--									<td class="col-md-12">Archivos de observaciones de la plataforma</td>-->
<!--								</tr>-->
<!--							</thead>-->
<!--							<tbody id="tbody_hist_obsPlataforma">-->
<!--							</tbody>-->
<!--						</table>-->
						<div class="clearfix"></div>
						<br />
						<table id="tabla_historial_obs" width="100%" border=0 class="table table-striped table-bordered tabla_form">
							<thead>
								<tr>
									<td class="col-md-3">Formulario</td>
									<td class="col-md-1">Campo de formulario</td>
									<td class="col-md-6">Observación del campo</td>
									<!--<td class="col-md-2">Valor del usuario</td>-->
									<td class="col-md-1">Fecha de Observación</td>
									<td class="col-md-1">Número de Revision</td>
									<!--<td class="col-md-1">Id de Solicitud</td>-->
								</tr>
							</thead>
							<tbody id="tbody_hist_obs">
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm pull-left" id="crr_hist_obs" data-dismiss="modal">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
