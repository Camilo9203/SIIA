<hr />
<button id="desplInfoOrg" class="btn btn-sm btn-success btn-block">Desplegar información de la solicitud <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></button>
<button id="plegInfoOrg" class="btn btn-sm btn-danger btn-block">Plegar información de la solicitud <i class="fa fa-chevron-circle-up" aria-hidden="true"></i></button>
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
			<p>Fecha de creación:</p><label class="tipoLeer" id='fechaSol'></label>
		</div>
		<div class="form-group">
			<p>Fecha de finalización:</p><label class="tipoLeer" id='revFechaFin'></label>
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
			<p>Motivo de la solicitud:</p><textarea style="height: 182px; width: 284px; resize: none;" class="tipoLeer" id='motSol' readonly></textarea>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<p>Fecha de última actualización:</p><label class="tipoLeer" id='revFechaUltimaActualizacion'></label>
		</div>
		<div class="form-group">
			<p>Número de solicitud:</p><label class="tipoLeer" id='numeroSol'></label>
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
			<p>Asignada por :</p><label class="tipoLeer" id='asignada_por'></label>
		</div>
		<div class="form-group">
			<p>Fecha de asignación:</p><label class="tipoLeer" id='fechaAsignacion'></label>
		</div>
		<hr>
		<div class="clearfix"></div>
		<div class="form-group">
			<p>Cámara de comercio: <a href="" id="camaraComercio_org" target="_blank">Clic aquí para ver la cámara de comercio</a></p>
		</div>
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
