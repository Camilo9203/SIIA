<div id="cInfO" class="hidden"><?php echo $informacion; ?></div>
<div class="container" id="">
	<div class="panel-group" id="datos_org_final">
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
				Éxito
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
		<div class="clearfix"></div>
		<hr/>
		<button class="btn btn-danger btn-sm pull-left" id="admin_ver_inscritas_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		<button class="btn btn-siia btn-sm pull-right verHistObs" id="hist_org_obs" data-toggle='modal' data-backdrop="false" data-target='#verHistObs'>Historial de observaciones <i class="fa fa-history" aria-hidden="true"></i></button>
		<div class="clearfix"></div>
		<hr/>
		<div class="col-md-12" id="informacion">
		<h3>1. Información General.</h3>
				<div class="form-group">
					<p>Tipo de Organización:</p><label class="tipoLeer" id='tipoOrganizacion'></label>
				</div>
				<div class="form-group">
					<p>Departamento:</p><label class="tipoLeer" id='nomDepartamentoUbicacion'></label>
				</div>
				<div class="form-group">
					<p>Municipio:</p><label class="tipoLeer" id='nomMunicipioNacional'></label>
				</div>
				<div class="form-group">
					<p>Dirección:</p><label class="tipoLeer" id='direccionOrganizacion'></label>
				</div>
				<div class="form-group">
					<p>Telefono - Fax:</p><label class="tipoLeer" id='fax'></label>
				</div>
				<div class="form-group">
					<p>Extensión:</p><label class="tipoLeer" id='extension'></label>
				</div>
				<div class="form-group">
					<p>URL de la Organización:</p><label class="tipoLeer" id='urlOrganizacion'></label>
				</div>
				<div class="form-group">
					<p>Actuación:</p><label class="tipoLeer" id='actuacionOrganizacion'></label>
				</div>
				<div class="form-group">
					<p>Tipo de educación:</p><label class="tipoLeer" id='tipoEducacion'></label>
				</div>
				<div class="form-group">
					<p>Cédula del representante Legal:</p><label class="tipoLeer" id='numCedulaCiudadaniaPersona'></label>
				</div>
				<div class="form-group">
					<p>Presentación institucional:</p><label class="tipoLeer" id='presentacionInstitucional'></label>
				</div>
				<div class="form-group">
					<p>Objeto social:</p><label class="tipoLeer" id='objetoSocialEstatutos'></label>
				</div>
				<div class="form-group">
					<p>Misión:</p><label class="tipoLeer" id='mision'></label>
				</div>
				<div class="form-group">
					<p>Visión:</p><label class="tipoLeer" id='vision'></label>
				</div>
				<div class="form-group">
					<p>Principios:</p><label class="tipoLeer" id='principios'></label>
				</div>
				<div class="form-group">
					<p>Fines:</p><label class="tipoLeer" id='fines'></label>
				</div>
				<div class="form-group">
					<p>Portafolio:</p><label class="tipoLeer" id='portafolio'></label>
				</div>
				<div class="form-group">
					<p>Otros:</p><label class="tipoLeer" id='otros'></label>
				</div>
			<div class="clearfix"></div>
			<hr/>
			<div class="col-md-12" id="archivos_informacionGeneral">
				<p>Archivos:</h4>
			</div>
			<div class="clearfix"></div>
			<hr/>
			<div class="form-group">
				<button class="btn btn-siia btn-sm pull-right" id="sigInf">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
			</div>
		</div>
		<div class="col-md-12" id="documentacion">
			<h3>2. Documentación Legal</h3>
<!-- 			<div class="col-md-6">
				<div class="form-group">
					<p>Certificado de existencia:</p><label class="tipoLeer" id='certificadoExistencia'></label>
				</div>
				<div class="form-group">
					<p>Numero de existencia certificado:</p><label class="tipoLeer" id='numeroExistencia'></label>
				</div>
				<div class="form-group">
					<p>Fecha de expedicion:</p><label class="tipoLeer" id='fechaExpedicion'></label>
				</div>
				<div class="form-group">
					<p>Objeto social:</p><label class="tipoLeer" id='objetoSocial'></label>
				</div>
				<div class="form-group">
					<p>Departamento del certificado:</p><label class="tipoLeer" id='departamentoCertificado'></label>
				</div>
				<div class="form-group">
					<p>Municipio del certificado:</p><label class="tipoLeer" id='municipioCertificado'></label>
				</div>
			</div> -->
			<div class="form-group">
				<p>Registro Educativo:</p><label class="tipoLeer" id='registroEducativo'></label>
			</div>
			<div class="form-group">
				<p>Entindad que registro:</p><label class="tipoLeer" id='entidadRegistro'></label>
			</div>
			<div class="form-group">
				<p>Numero de la resolucion:</p><label class="tipoLeer" id='numeroResolucion'></label>
			</div>
			<div class="form-group">
				<p>Fecha de la resolucion:</p><label class="tipoLeer" id='fechaResolucion'></label>
			</div>
			<div class="form-group">
				<p>Departamento de la resolucion:</p><label class="tipoLeer" id='departamentoResolucion'></label>
			</div>
			<div class="form-group">
				<p>Municipio de la resolucion:</p><label class="tipoLeer" id='municipioResolucion'></label>
			</div>
			<div class="col-md-12 form-group" id="archivos_documentacionLegal">
				<p>Archivos:</h4>
			</div>
			<div id="ll"></div>
			<div class="clearfix"></div>
			<hr/>
			<div class="form-groups">
				<button class="btn btn-siia btn-sm pull-left" id="atrDoc"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
				<button class="btn btn-siia btn-sm pull-right" id="sigDoc">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
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
				</div>
				<div class="form-group">
					<p>Metodología a Utilizar:</p><label class="tipoLeer" id='metodologiaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Material Didáctico y Ayudas Educativas Incorporadas:</p><label class="tipoLeer" id='materialBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Bibliografia:</p><label class="tipoLeer" id='bibliografiaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Duracion del curso:</p><label class="tipoLeer" id='duracionBasicosProgramas'></label>
				</div>
                <input type ="button" id="siguienteProgBasiES1" class="btn btn-siia btn-sm pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES1">
                <label>6.2 Socialización de conceptos funtamentales</label>
                <div class="form-group">
					<p>Etica, valores y principios:</p><label class="tipoLeer" id='eticaValoresBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Solidaridad:</p><label class="tipoLeer" id='solidaridadBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Economía:</p><label class="tipoLeer" id='economiaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Economía Solidaria:</p><label class="tipoLeer" id='economiaSolidariaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Asociatividad y Emprendimiento Solidario:</p><label class="tipoLeer" id='asosiatividadBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Organización Solidaria:</p><label class="tipoLeer" id='organizacionSolidariaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Trabajo en Equipo:</p><label class="tipoLeer" id='trabajoEquipoBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Educacíon Solidaria:</p><label class="tipoLeer" id='educacionSolidariaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Responsabilidad Social:</p><label class="tipoLeer" id='responsabilidadSocialBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Medio Ambiente:</p><label class="tipoLeer" id='medioAmbienteBasicosProgramas'></label>
				</div>
                <input type ="button" id="atrasProgProgBasiES" class="btn btn-siia btn-sm pull-left fa-fa" value='&#xf060 Atrás página'>
                <input type ="button" id="siguienteProgBasiES2" class="btn btn-siia btn-sm pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES2">
                <label>6.3 Contexto socioeconómico para el desarrollo</label>
                <div class="form-group">
					<p>El contexto económico, social, cultural y ambiental que vivimos:</p><label class="tipoLeer" id='contextoEconomicoBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Necesidades del ser humano y sus soluciones:</p><label class="tipoLeer" id='necesidadesBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>¿Por qué y para qué fomentar una organización solidaria?:</p><label class="tipoLeer" id='porqueParaqueBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Principios, valores y fines de la economía solidaria:</p><label class="tipoLeer" id='principiosValoresBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Marco normativo general de la economía solidaria en Colombia:</p><label class="tipoLeer" id='marcoNormativoBasicosProgramas'></label>
				</div>
                <input type ="button" id="atrasProgProgBasiES1" class="btn btn-siia btn-sm pull-left fa-fa" value='&#xf060 Atrás página'>
                <input type ="button" id="siguienteProgBasiES3" class="btn btn-siia btn-sm pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES3">
                <label>6.4 Tipos de organizaciones solidarias</label>
                <div class="form-group">
					<p>Tipos de organizaciones de economía solidaria y solidaria de desarrollo:</p><label class="tipoLeer" id='tiposOrganizacionesBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Antecedentes históricos de la organización solidaria objeto del curso:</p><label class="tipoLeer" id='antecedentesHistoricosBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Características económicas, sociales y culturales de la organización solidaria:</p><label class="tipoLeer" id='caracteristicasEconomicasBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Estructura interna organizativa básica (dirección, control y comités de apoyo):</p><label class="tipoLeer" id='estructuraInternaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Marco jurídico aplicable al tipo de organización:</p><label class="tipoLeer" id='marcoJuridicoBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Fundamentos administrativos de la organización:</p><label class="tipoLeer" id='fundamentosAdministrativosBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Orientación para la elaboración de estatutos, reglamentos y legalización de la organización:</p><label class="tipoLeer" id='estatutosReglamentosBasicosProgramas'></label>
				</div>
                <input type ="button" id="atrasProgProgBasiES2" class="btn btn-siia btn-sm pull-left fa-fa" value='&#xf060 Atrás página'>
                <input type ="button" id="siguienteProgBasiES4" class="btn btn-siia btn-sm pull-right fa-fa" value='Siguiente página &#xf061'>
            </div>
            <div id="divSiguienteProgBasiES4">
                <label>6.5	Entes de control y apoyo al sector solidario</label>
                <div class="form-group">
					<p>Unidad Administrativa Especial de Organizaciones Solidarias:</p><label class="tipoLeer" id='uaeosBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Superintendencia de la Economía Solidaria:</p><label class="tipoLeer" id='superintendenciaBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Fondo de Garantías Cooperativas - FOGACOOP:</p><label class="tipoLeer" id='fondoGarantiasBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Consejo Nacional de la Economía Solidaria - CONES:</p><label class="tipoLeer" id='consejoBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Fondo Nacional de la Economía Solidaria - FONES:</p><label class="tipoLeer" id='fondoNacionalBasicosProgramas'></label>
				</div>
				<div class="form-group">
					<p>Mesas Regionales de Educación Solidaria:</p><label class="tipoLeer" id='mesasRegionalesBasicosProgramas'></label>
				</div>
                <input type ="button" id="atrasProgProgBasiES3" class="btn btn-siia btn-sm pull-left fa-fa" value='&#xf060 Atrás página'>
            </div>
            <div class="clearfix"></div>
			<hr/>
		</div>
		<div class="col-md-12" id="programasAvalEconomia">
			<h3>7. Programas con Aval en Economia</h3>
			<div id="divAtrasProgAvalEcT">
				<div class="form-group">
					<p>7.1.Objetivos:</p><label class="tipoLeer" id='objetivosProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>7.2 Metodología a Utilizar:</p><label class="tipoLeer" id='metodologiaProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>7.3 Material didáctico y ayudas Educativas incorporadas:</p><label class="tipoLeer" id='materialProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>7.4 Bibliografia:</p><label class="tipoLeer" id='bibliografiaProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>7.5 Duración del curso:</p><label class="tipoLeer" id='duracionProgramasAvalEconomia'></label>
				</div>
	        </div>
	        <div id="divSiguienteProgAvalEcT">
	            <h3>7.6 Contextualización general del sector solidario</h3>
	            <div class="form-group">
					<p>Antecedentes y aspectos axiológicos del cooperativismo y del cooperativismo de trabajo asociado:</p><label class="tipoLeer" id='antecedentesProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Diferencias entre trabajo dependiente, independiente y asociado:</p><label class="tipoLeer" id='diferenciasProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Regulación jurídica del trabajo asociado:</p><label class="tipoLeer" id='regulacionProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Desarrollo socioempresarial del trabajo asociado:</p><label class="tipoLeer" id='desarrolloProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Legislación tributaria y su aplicación al trabajo asociado:</p><label class="tipoLeer" id='legislacionProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Administración del trabajo asociado:</p><label class="tipoLeer" id='administracionProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Regímenes de trabajo y compensación:</p><label class="tipoLeer" id='regimenesProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Manejo de Seguridad social integral:</p><label class="tipoLeer" id='manejoProgramasAvalEconomia'></label>
				</div>
				<div class="form-group">
					<p>Inspección, vigilancia y control y prohibiciones:</p><label class="tipoLeer" id='inspeccionProgramasAvalEconomia'></label>
				</div>
	        </div>
	        <button id="atrasProgAvalEcT" class="btn btn-siia btn-sm pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás Página</button>
    		<button id="siguienteProgAvalEcT" class="btn btn-siia btn-sm pull-right" style="display: block;">Siguiente página <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
    		<div class="clearfix"></div>
			<hr/>
		</div>
		<div class="col-md-12" id="programasAvalar">
			<h3>8. Programas a Avalar</h3>
		</div>
		<div class="col-md-12" id="docentes">
			<h3>9. Docentes</h3>
		</div>
		<div class="col-md-12" id="plataforma">
			<h3>10. Plataforma</h3>
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
			<a class="toAncla" id="verAntAcaMenuAdmin">3. Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verJorActMenuAdmin">4. Jornadas de actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verProgBasMenuAdmin">5. Programa básico de economía solidaria <i class="fa fa-server" aria-hidden="true"></i></a><br />
			<!--			<a class="toAncla" id="verProgAvaMenuAdmin">7. <small>Prog. de Economía Solidaria con Énfasis en Trabajo Asociado</small> <i class="fa fa-sitemap" aria-hidden="true"></i></a><br />-->
			<!--			<a class="toAncla" id="verProgsMenuAdmin">8. Programas <i class="fa fa-signal" aria-hidden="true"></i></a><br />-->
			<a class="toAncla" id="verFaciliMenuAdmin">6. Facilitadores <i class="fa fa-users" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verDatPlatMenuAdmin">7. Datos Plataforma Virtual <i class="fa fa-globe" aria-hidden="true"></i></a><br />
			<a class="toAncla" id="verDataEnLinea">8. Datos Plataforma En Linea <i class="fa fa-globe" aria-hidden="true"></i></a><br />
			<hr />
			<button class="btn btn-siia btn-sm btn-block" data-toggle="modal" id="verModTermObs" data-target="#terminarProcObs">Terminar proceso de observaciones <i class="fa fa-check" aria-hidden="true"></i></button>
		</div>
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
						<table id="tabla_historial_obs" width="100%" border=0 class="table table-striped table-bordered tabla_form">
							<thead>
								<tr>
									<td class="col-md-2">Observación</td>
									<td class="col-md-2">Formulario</td>
									<td class="col-md-2">Valor de formulario</td>
									<!--<td class="col-md-2">Valor del usuario</td>-->
									<td class="col-md-2">Fecha de Observacion</td>
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
