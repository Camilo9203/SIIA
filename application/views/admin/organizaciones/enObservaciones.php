<div class="col-md-12" id="admin_ver_finalizadas">
<div class="clearfix"></div>
<hr/>
	<h3>Organizaciones en observaciones:</h3>
	<br/>
	<div class="table">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-2">Nombre</td>
				<td>NIT</td>
				<td class="col-md-2">Representante Legal</td>
				<td class="col-md-2">Direccion E-Mail Org</td>
				<td class="col-md-2">Direccion E-Mail Rep</td>
				<td class="col-md-2">Fecha de finalización</td>
				<td class="col-md-2">Fecha última revisión</td>
				<td class="col-md-2">Asignada a</td>
				<td class="col-md-2">Acción</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php
			foreach ($organizaciones_en_proceso as $organizaciones) {
				if($organizaciones->asignada == $nombre_usuario && $nivel == 1){
					echo "<tr>";
					echo "<td>".$organizaciones->nombreOrganizacion."</td>";
					echo "<td>".$organizaciones->numNIT."</td>";
					echo "<td>".$organizaciones->primerNombreRepLegal." ".$organizaciones->segundoNombreRepLegal." ".$organizaciones->primerApellidoRepLegal." ".$organizaciones->segundoApellidoRepLegal."</td>";
					echo "<td>".$organizaciones->direccionCorreoElectronicoOrganizacion."</td>";
					echo "<td>".$organizaciones->direccionCorreoElectronicoRepLegal."</td>";
					echo "<td>".$organizaciones->fechaFinalizado."</td>";
					echo "<td>".$organizaciones->fechaUltimaRevision."</td>";
					echo "<td>".$organizaciones->asignada."</td>";
					echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm ver_organizacion_finalizada' id='' data-organizacion='".$organizaciones->id_organizacion."'>Ver información <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
					echo "</tr>";
				}else if($nivel == 0 || $nivel == 6){
					echo "<tr>";
					echo "<td>".$organizaciones->nombreOrganizacion."</td>";
					echo "<td>".$organizaciones->numNIT."</td>";
					echo "<td>".$organizaciones->primerNombreRepLegal." ".$organizaciones->segundoNombreRepLegal." ".$organizaciones->primerApellidoRepLegal." ".$organizaciones->segundoApellidoRepLegal."</td>";
					echo "<td>".$organizaciones->direccionCorreoElectronicoOrganizacion."</td>";
					echo "<td>".$organizaciones->direccionCorreoElectronicoRepLegal."</td>";
					echo "<td>".$organizaciones->fechaFinalizado."</td>";
					echo "<td>".$organizaciones->fechaUltimaRevision."</td>";
					echo "<td>".$organizaciones->asignada."</td>";
					echo "<td class='verFinOrgInf'><button class='btn btn-siia btn-sm ver_organizacion_finalizada' id='' data-organizacion='".$organizaciones->id_organizacion."'>Ver información <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
					echo "</tr>";
				}
			}
		?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
<div class="clearfix"></div>
<div class="container" id="admin_panel_ver_finalizada">
	<div class="panel-group" id="datos_org_final">
		<hr/>
		<button id="desplInfoOrg" class="btn btn-sm btn-success btn-block">Desplegar información de la organización <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></button>
		<button id="plegInfoOrg" class="btn btn-sm btn-danger btn-block">Plegar información de la organización <i class="fa fa-chevron-circle-up" aria-hidden="true"></i></button>
		<div id="verInfoOrg">
			<hr/>
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
					<p>Fecha de creación de la solicitud:</p><label class="tipoLeer" id='fechaSol'></label>
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
		<hr/>
		<button class="btn btn-danger btn-sm pull-left" id="admin_ver_observaciones_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		<button class="btn btn-sm btn-warning pull-right" id="verRelacionCambios" data-toggle='modal' data-target='#modalRelacionCambios'>Ver relacion de cambios <i class="fa fa-eye" aria-hidden="true"></i></button>
		<button class="btn btn-sm btn-info pull-right" data-toggle='modal' data-target='#modalPedirCamara'>Pedir cámara de comercio <i class="fa fa-refresh" aria-hidden="true"></i></button>
		<button class="btn btn-siia btn-sm pull-right verHistObs" id="hist_org_obs" data-toggle='modal' data-backdrop="false" data-target='#verHistObs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
		<div class="clearfix"></div>
		<hr/>
		<div id="anclaInicio"></div>
		<div class="col-md-12" id="informacion">
		<h3>1. Información General.</h3>
			<div class="col-md-12">
				<div class="form-group">
					<p>Tipo de Organización:</p><label class="tipoLeer" id='tipoOrganizacion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Tipo de Organización" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Departamento:</p><label class="tipoLeer" id='nomDepartamentoUbicacion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Departamento" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Municipio:</p><label class="tipoLeer" id='nomMunicipioNacional'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Municipio" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Dirección:</p><label class="tipoLeer" id='direccionOrganizacion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Dirección" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Telefono - Fax:</p><label class="tipoLeer" id='fax'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Telefono" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Extensión:</p><label class="tipoLeer" id='extension'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Extensión" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>URL de la Organización:</p><label class="tipoLeer" id='urlOrganizacion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="URL" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Actuación:</p><label class="tipoLeer" id='actuacionOrganizacion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Actuación" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Tipo de educación:</p><label class="tipoLeer" id='tipoEducacion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Tipo de Educación" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Cédula del representante Legal:</p><label class="tipoLeer" id='numCedulaCiudadaniaPersona'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Cédula del representante legal" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Presentación institucional:</p><label class="tipoLeer" id='presentacionInstitucional'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Presentación" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Objeto social:</p><label class="tipoLeer" id='objetoSocialEstatutos'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Objeto social" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Misión:</p><label class="tipoLeer" id='mision'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Misión" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Visión:</p><label class="tipoLeer" id='vision'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Visión" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Principios:</p><label class="tipoLeer" id='principios'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Principios" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Fines:</p><label class="tipoLeer" id='fines'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Fines" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Portafolio:</p><label class="tipoLeer" id='portafolio'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Portafolio" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Otros:</p><label class="tipoLeer" id='otros'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="informacionGeneral" data-title="Otros" id="" rows="3"></textarea>
				</div>
			</div>
			<div class="clearfix"></div>
			<hr/>
			<div class="col-md-12" id="archivos_informacionGeneral">
				<p>Archivos:</label>
			</div>
			<div class="clearfix"></div>
			<hr/>
			<div class="form-group">
				<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigInf">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			</div>
		</div>
		<div class="col-md-12" id="documentacion">
			<h3>2. Documentación Legal</h3>
<!-- 			<div class="col-md-6">
				<div class="form-group">
					<p>Certificado de existencia:</p><label class="tipoLeer" id='certificadoExistencia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Certificacdo" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Numero de existencia certificado:</p><label class="tipoLeer" id='numeroExistencia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Numero existencia" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Fecha de expedicion:</p><label class="tipoLeer" id='fechaExpedicion'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Fecha de expedicion" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Objeto social:</p><label class="tipoLeer" id='objetoSocial'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Objeto" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Departamento del certificado:</p><label class="tipoLeer" id='departamentoCertificado'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Departamento" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Municipio del certificado:</p><label class="tipoLeer" id='municipioCertificado'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Municipio" id="" rows="3"></textarea>
				</div>
			</div> -->
			<div class="form-group">
				<p>Registro Educativo:</p><label class="tipoLeer" id='registroEducativo'></label>
				<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Registro" id="" rows="3"></textarea>
			</div>
			<div class="form-group">
				<p>Entindad que registro:</p><label class="tipoLeer" id='entidadRegistro'></label>
				<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Entindad" id="" rows="3"></textarea>
			</div>
			<div class="form-group">
				<p>Numero de la resolucion:</p><label class="tipoLeer" id='numeroResolucion'></label>
				<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Numero resolucion" id="" rows="3"></textarea>
			</div>
			<div class="form-group">
				<p>Fecha de la resolucion:</p><label class="tipoLeer" id='fechaResolucion'></label>
				<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Fecha" id="" rows="3"></textarea>
			</div>
			<div class="form-group">
				<p>Departamento de la resolucion:</p><label class="tipoLeer" id='departamentoResolucion'></label>
				<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Departamento" id="" rows="3"></textarea>
			</div>
			<div class="form-group">
				<p>Municipio de la resolucion:</p><label class="tipoLeer" id='municipioResolucion'></label>
				<textarea class="form-control obs_admin_" placeholder="Observación..." data-type='documentacionLegal' data-title="Municipio" id="" rows="3"></textarea>
			</div>
			<div class="col-md-12 form-group" id="archivos_documentacionLegal">
				<p>Archivos:</label>
			</div>
			<div id="ll"></div>
			<div class="clearfix"></div>
			<hr/>
			<div class="form-groups">
				<button class="btn btn-siia btn-sm guardarObservaciones pull-left" id="atrDoc"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
				<button class="btn btn-siia btn-sm guardarObservaciones pull-right" id="sigDoc">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			</div>
		</div>
		<div class="col-md-12" id="registroEducativoProgramas">
			<h3>3. Registro Educativo de Programas</h3>
		</div>
		<div class="col-md-12" id="antecedentesAcademicos">
			<h3>4. Antecedentes Academico</h3>
		</div>
		<div class="col-md-12" id="jornadasActualizacion">
			<h3>5. Jornadas de Actualizacion</h3>
		</div>
		<div class="col-md-12" id="datosBasicosProgramas">
			<h3>6. Datos Basicos de Programas</h3>
			<div id="divAtrasProgBasiES">
			    <label>6.1 Datos Básicos del Programa</label>
			    <div class="form-group">
					<p>Objetivos:</p><label class="tipoLeer" id='objetivosBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Objetivos" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Metodología a Utilizar:</p><label class="tipoLeer" id='metodologiaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Metodología a Utilizar" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Material Didáctico y Ayudas Educativas Incorporadas:</p><label class="tipoLeer" id='materialBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Material Didáctico y Ayudas Educativas Incorporadas" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Bibliografia:</p><label class="tipoLeer" id='bibliografiaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Bibliografia" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Duracion del curso:</p><label class="tipoLeer" id='duracionBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Duracion del curso" id="" rows="3"></textarea>
				</div>
                <input type ="button" id="siguienteProgBasiES1" class="btn btn-siia btn-sm guardarObservaciones pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES1">
                <label>6.2 Socialización de conceptos funtamentales</label>
                <div class="form-group">
					<p>Etica, valores y principios:</p><label class="tipoLeer" id='eticaValoresBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Etica, valores y principios" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Solidaridad:</p><label class="tipoLeer" id='solidaridadBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Solidaridad" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Economía:</p><label class="tipoLeer" id='economiaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Economía" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Economía Solidaria:</p><label class="tipoLeer" id='economiaSolidariaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Economía Solidaria" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Asociatividad y Emprendimiento Solidario:</p><label class="tipoLeer" id='asosiatividadBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Asociatividad y Emprendimiento Solidario" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Organización Solidaria:</p><label class="tipoLeer" id='organizacionSolidariaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Organización Solidaria" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Trabajo en Equipo:</p><label class="tipoLeer" id='trabajoEquipoBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Trabajo en Equipo" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Educacíon Solidaria:</p><label class="tipoLeer" id='educacionSolidariaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Educacíon Solidaria" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Responsabilidad Social:</p><label class="tipoLeer" id='responsabilidadSocialBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Responsabilidad Social" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Medio Ambiente:</p><label class="tipoLeer" id='medioAmbienteBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Medio Ambiente" id="" rows="3"></textarea>
				</div>
                <input type ="button" id="atrasProgProgBasiES" class="btn btn-siia btn-sm guardarObservaciones pull-left fa-fa" value='&#xf060 Atrás página'>
                <input type ="button" id="siguienteProgBasiES2" class="btn btn-siia btn-sm guardarObservaciones pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES2">
                <label>6.3 Contexto socioeconómico para el desarrollo</label>
                <div class="form-group">
					<p>El contexto económico, social, cultural y ambiental que vivimos:</p><label class="tipoLeer" id='contextoEconomicoBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="El contexto económico, social, cultural y ambiental que vivimos" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Necesidades del ser humano y sus soluciones:</p><label class="tipoLeer" id='necesidadesBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Necesidades del ser humano y sus soluciones" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>¿Por qué y para qué fomentar una organización solidaria?:</p><label class="tipoLeer" id='porqueParaqueBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="¿Por qué y para qué fomentar una organización solidaria?" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Principios, valores y fines de la economía solidaria:</p><label class="tipoLeer" id='principiosValoresBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Principios, valores y fines de la economía solidaria" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Marco normativo general de la economía solidaria en Colombia:</p><label class="tipoLeer" id='marcoNormativoBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Marco normativo general de la economía solidaria en Colombia" id="" rows="3"></textarea>
				</div>
                <input type ="button" id="atrasProgProgBasiES1" class="btn btn-siia btn-sm guardarObservaciones pull-left fa-fa" value='&#xf060 Atrás página'>
                <input type ="button" id="siguienteProgBasiES3" class="btn btn-siia btn-sm guardarObservaciones pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES3">
                <label>6.4 Tipos de organizaciones solidarias</label>
                <div class="form-group">
					<p>Tipos de organizaciones de economía solidaria y solidaria de desarrollo:</p><label class="tipoLeer" id='tiposOrganizacionesBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Tipos de organizaciones de economía solidaria y solidaria de desarrollo" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Antecedentes históricos de la organización solidaria objeto del curso:</p><label class="tipoLeer" id='antecedentesHistoricosBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Antecedentes históricos de la organización solidaria objeto del curso" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Características económicas, sociales y culturales de la organización solidaria:</p><label class="tipoLeer" id='caracteristicasEconomicasBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Características económicas, sociales y culturales de la organización solidaria" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Estructura interna organizativa básica (dirección, control y comités de apoyo):</p><label class="tipoLeer" id='estructuraInternaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Estructura interna organizativa básica (dirección, control y comités de apoyo)" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Marco jurídico aplicable al tipo de organización:</p><label class="tipoLeer" id='marcoJuridicoBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Marco jurídico aplicable al tipo de organización" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Fundamentos administrativos de la organización:</p><label class="tipoLeer" id='fundamentosAdministrativosBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Fundamentos administrativos de la organización" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Orientación para la elaboración de estatutos, reglamentos y legalización de la organización:</p><label class="tipoLeer" id='estatutosReglamentosBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Orientación para la elaboración de estatutos, reglamentos y legalización de la organización" id="" rows="3"></textarea>
				</div>
                <input type ="button" id="atrasProgProgBasiES2" class="btn btn-siia btn-sm guardarObservaciones pull-left fa-fa" value='&#xf060 Atrás página'>
                <input type ="button" id="siguienteProgBasiES4" class="btn btn-siia btn-sm guardarObservaciones pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES4">
                <label>6.5	Entes de control y apoyo al sector solidario</label>
                <div class="form-group">
					<p>Unidad Administrativa Especial de Organizaciones Solidarias:</p><label class="tipoLeer" id='uaeosBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Unidad Administrativa Especial de Organizaciones Solidarias" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Superintendencia de la Economía Solidaria:</p><label class="tipoLeer" id='superintendenciaBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Superintendencia de la Economía Solidaria" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Fondo de Garantías Cooperativas - FOGACOOP:</p><label class="tipoLeer" id='fondoGarantiasBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Fondo de Garantías Cooperativas - FOGACOOP" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Consejo Nacional de la Economía Solidaria - CONES:</p><label class="tipoLeer" id='consejoBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Consejo Nacional de la Economía Solidaria - CONES" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Fondo Nacional de la Economía Solidaria - FONES:</p><label class="tipoLeer" id='fondoNacionalBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Fondo Nacional de la Economía Solidaria - FONES" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Mesas Regionales de Educación Solidaria:</p><label class="tipoLeer" id='mesasRegionalesBasicosProgramas'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="datosBasicosProgramas" data-title="Mesas Regionales de Educación Solidaria" id="" rows="3"></textarea>
				</div>
                <input type ="button" id="atrasProgProgBasiES3" class="btn btn-siia btn-sm guardarObservaciones pull-left fa-fa" value='&#xf060 Atrás página'>
            </div>
            <div class="clearfix"></div>
			<hr/>
		</div>
		<div class="col-md-12" id="programasAvalEconomia">
			<h3>7. Programas con Aval en Economia</h3>
			<div id="divAtrasProgAvalEcT">
				<div class="form-group">
					<p>7.1.Objetivos:</p><label class="tipoLeer" id='objetivosProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Objetivos" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>7.2 Metodología a Utilizar:</p><label class="tipoLeer" id='metodologiaProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Metodología a Utilizar" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>7.3 Material didáctico y ayudas Educativas incorporadas:</p><label class="tipoLeer" id='materialProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Material didáctico y ayudas Educativas incorporadas" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>7.4 Bibliografia:</p><label class="tipoLeer" id='bibliografiaProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Bibliografia" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>7.5 Duración del curso:</p><label class="tipoLeer" id='duracionProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Duración del curso" id="" rows="3"></textarea>
				</div>
	        </div>
	        <div id="divSiguienteProgAvalEcT">
	            <h3>7.6 Contextualización general del sector solidario</h3>
	            <div class="form-group">
					<p>Antecedentes y aspectos axiológicos del cooperativismo y del cooperativismo de trabajo asociado:</p><label class="tipoLeer" id='antecedentesProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Antecedentes y aspectos axiológicos del cooperativismo y del cooperativismo de trabajo asociado" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Diferencias entre trabajo dependiente, independiente y asociado:</p><label class="tipoLeer" id='diferenciasProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Diferencias entre trabajo dependiente, independiente y asociado" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Regulación jurídica del trabajo asociado:</p><label class="tipoLeer" id='regulacionProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Regulación jurídica del trabajo asociado" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Desarrollo socioempresarial del trabajo asociado:</p><label class="tipoLeer" id='desarrolloProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Desarrollo socioempresarial del trabajo asociado" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Legislación tributaria y su aplicación al trabajo asociado:</p><label class="tipoLeer" id='legislacionProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Legislación tributaria y su aplicación al trabajo asociado" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Administración del trabajo asociado:</p><label class="tipoLeer" id='administracionProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Administración del trabajo asociado" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Regímenes de trabajo y compensación:</p><label class="tipoLeer" id='regimenesProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Regímenes de trabajo y compensación" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Manejo de Seguridad social integral:</p><label class="tipoLeer" id='manejoProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Manejo de Seguridad social integral" id="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<p>Inspección, vigilancia y control y prohibiciones:</p><label class="tipoLeer" id='inspeccionProgramasAvalEconomia'></label>
					<textarea class="form-control obs_admin_" placeholder="Observación..." data-type="programasAvalEconomia" data-title="Inspección, vigilancia y control y prohibiciones" id="" rows="3"></textarea>
				</div>
	        </div>
	        <button id="atrasProgAvalEcT" class="btn btn-siia btn-sm guardarObservaciones pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás Página</button>
    		<button id="siguienteProgAvalEcT" class="btn btn-siia btn-sm guardarObservaciones pull-right" style="display: block;">Siguiente página <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    		<div class="clearfix"></div>
			<hr/>
		</div>
		<div class="col-md-12" id="programasAvalar">
			<h3>8. Programas a Avalar</h3>
		</div>
		<div class="col-md-12" id="docentes">
			<h3>9. Docentes</h3>
			<button id="verFrameDocentes" class="btn btn-siia btn-sm pull-left">Ver docentes aquí <i class="fa fa-eye" aria-hidden="true"></i></button>
			<div class="clearfix"></div>
			<hr/>
			<div class="txtOrgDocen"></div>
			<div id="frameDocDiv" class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" id="frameDocentes" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="clearfix"></div>
			<hr/>
		</div>
		<div class="col-md-12" id="plataforma">
			<h3>10. Plataforma</h3>
		</div>
	</div>
</div>
<div class="icono--div3">
	<div id="menuObsAdmin">
		<p>Menú de formularios:</label>
		<hr/>
		<a class="toAncla" id="verInfGenMenuAdmin">1. Información General de la Entidad <i class="fa fa-home" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verDocLegalMenuAdmin">2. Documentación Legal <i class="fa fa-book" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verRegAcaMenuAdmin">3. Registros educativos de Programas <i class="fa fa-newspaper-o" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verAntAcaMenuAdmin">4. Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verJorActMenuAdmin">5. Jornadas de actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verProgBasMenuAdmin">6. Programa básico de economía solidaria <i class="fa fa-server" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verProgAvaMenuAdmin">7. <small>Prog. de Economía Solidaria con Énfasis en Trabajo Asociado</small> <i class="fa fa-sitemap" aria-hidden="true"></i></a><br/>
<!-- 		<a class="toAncla" id="verProgsMenuAdmin">8. Programas <i class="fa fa-signal" aria-hidden="true"></i></a><br/>
 -->		<a class="toAncla" id="verFaciliMenuAdmin">9. Facilitadores <i class="fa fa-users" aria-hidden="true"></i></a><br/>
		<a class="toAncla" id="verDatPlatMenuAdmin">10. Datos Plataforma Virtual <i class="fa fa-globe" aria-hidden="true"></i></a><br/>
		<hr/>
		<a class="btn btn-siia btn-sm btn-block" id="guardarObservacionesModal" role="button" title="Guardar observaciones" data-toggle="tooltip" data-placement="right">Guardar observaciones <i class="fa fa-save" aria-hidden="true"></i></a>
		<hr/>
		<button class="btn btn-siia btn-sm btn-block" data-toggle="modal" id="verModTermObs" data-target="#terminarProcObs">Terminar proceso de observaciones <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
</div>
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
        			<label><a id="verObsFiltrada" target="_blank" class="pull-right">Ver tabla de observaciones para filtrar y descargar <i class="fa fa-table" aria-hidden="true"></i></a></label>
						<div class="input-group">
			                <input type="text" class="form-control" placeholder="Buscar una observación..." id="buscarObsTextOrg"/>
			                <div class="clearfix"></div>
							<br/>
			            </div>
						<table id="tabla_historial_obsPlataforma" width="100%" border=0 class="table table-striped table-bordered tabla_form">
							<thead>
								<tr>
									<td class="col-md-12">Archivos de observaciones de la plataforma</td>
								</tr>
							</thead>
							<tbody id="tbody_hist_obsPlataforma">
							</tbody>
						</table>
						<div class="clearfix"></div>
						<br/>
						<table id="tabla_historial_obs" width="100%" border=0 class="table table-striped table-bordered tabla_form">
							<thead>
								<tr>
									<td class="col-md-3">Formulario</td>
									<td class="col-md-1">Campo de formulario</td>
									<td class="col-md-6">Observación del campo</td>
									<!--<td class="col-md-2">Valor del usuario</td>-->
									<td class="col-md-1">Fecha de Observacion</td>
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

<div class="modal fade" id="terminarProcObs" tabindex="-1" role="dialog" aria-labelledby="termprocobs">
  	<div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
		        <label class="modal-title" id="termprocobs">¿Terminar proceso de observaciones?</label>
		    </div>
		    <div class="modal-footer">
		    	<button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">No, voy a verificar <i class="fa fa-times" aria-hidden="true"></i></button>
		    	<button type="button" class="btn btn-siia btn-sm" id="terminar_proceso_observacion">Si, terminar <i class="fa fa-check" aria-hidden="true"></i></button>
		    </div>
	  	</div>
	</div>
</div>