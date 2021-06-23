<div class="container">
	<div class="clearfix"></div>
	<hr/>
</div>
<div id="panel_admin_organizaciones" class="container center-block">
	<!--<div class="col-md-3" id="busOrg">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Buscar Organizacion <i class="fa fa-search" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_buscar_org">Buscar</button>
		  </div>
		</div>
	</div>-->
	<div class="col-md-3" id="asigOrg">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Asignar solicitudes <i class="fa fa-hand-rock-o" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_asignar_org">Asignación</button>
		  </div>
		</div>
	</div>
	<div class="col-md-3" id="verOrgInscr">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Organizaciones Inscritas <small>(Todas)</small> <i class="fa fa-book" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_organizaciones_inscritas">Inscritas</button>
		  </div>
		</div>
	</div>
	<!--<div class="col-md-3" id="verOrgPro">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Organizaciones en Proceso <i class="fa fa-spinner" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_organizaciones_enproceso">En proceso</button>
		  </div>
		</div>
	</div>-->
	<div class="col-md-3" id="verOrgFin">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Organizaciones en Evaluación <i class="fa fa-flag-checkered" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_organizaciones_finalizadas">En Evaluación</button>
		  </div>
		</div>
	</div>
	<div class="col-md-3" id="verOrgObs">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Organizaciones Complementaria <i class="fa fa-eye" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_organizaciones_observaciones">En complementaria</button>
		  </div>
		</div>
	</div>
	<div class="clearfix"></div>
	<hr/>
	<div class="col-md-3" id="verFacili">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Ver Facilitadores <i class="fa fa-graduation-cap" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_verorganizaciones_docentes">Facilitadores</button>
		  </div>
		</div>
	</div>
	<div class="col-md-3" id="camEstOrg">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Cambiar Estado Organizaciones <i class="fa fa-info-circle" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_estadoorg">Estado</button>
		  </div>
		</div>
	</div>
	<div class="col-md-3" id="adjResolucion">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Adjuntar Resoluciones <i class="fa fa-file" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_resoluciones">Resoluciones</button>
		  </div>
		</div>
	</div>
	<div class="col-md-3" id="adjCamara">
		<div class="panel panel-siia">
		  <div class="panel-heading">
		    <h3 class="panel-title">Adjuntar Cámara de Comercio <i class="fa fa-file-pdf-o" aria-hidden="true"></i></h3>
		  </div>
		  <div class="panel-body">
			<button class="btn btn-default form-control" id="admin_camaracomercio">Cámara de Comercio</button>
		  </div>
		</div>
	</div>
	<div class="clearfix"></div>
	<hr/>
	<button class="btn btn-danger btn-sm" id="admin_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>
<div id="buscar_org" class="col-md-4 center-block">
	<h3>Buscar una organización.</h3>
	<p>Aqui se puede buscar cualquier organizacion que esta en el SIIA actual o historico.</p>
	<div class="form-group">
		<label for="admin_buscar_nombre">Nombre de la Organización:</label>
		<input type="text" class="form-control" name="admin_buscar_nombre" id="admin_buscar_nombre">
	</div>
	<div class="form-group">
		<label for="admin_buscar_sigla">Sigla de la Organización:</label>
		<input type="text" class="form-control" name="admin_buscar_sigla" id="admin_buscar_sigla">
	</div>
	<div class="form-group">
		<label for="admin_buscar_nit">NIT:</label>
		<input type="text" class="form-control" name="admin_buscar_nit" id="admin_buscar_nit">
	</div>
	<div class="form-group">
		<label for="admin_buscar_nombre_rep">Nombre del Representante:</label>
		<input type="text" class="form-control" name="admin_buscar_nombre_rep" id="admin_buscar_nombre_rep">
	</div>
	<button class="btn btn-danger pull-left" id="admin_buscar_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	<button class="btn btn-siia pull-right" id="admin_buscar_organizacion" name="admin_buscar_organizacion">Buscar <i class="fa fa-search" aria-hidden="true"></i></button>
</div>
<div class="clearfix"></div>
<div class="table col-md-12" id="organizaciones_encontradas">
	<label>Organización/es:</label>
	<table id="tabla_buscar_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-1">Nombre Org</td>
				<td class="col-md-1">NIT</td>
				<td class="col-md-1">Sigla</td>
				<td class="col-md-1">Correo Org</td>
				<td class="col-md-1">Correo Rep</td>
				<td class="col-md-1">Primer Nombre Rep</td>
				<td class="col-md-1">Segundo Nombre Rep</td>
				<td class="col-md-1">Primer Apellido Rep</td>
				<td class="col-md-1">Segundo Apellido Rep</td>
				<td class="col-md-1">Primer Nombre Per</td>
				<td class="col-md-1">Primer Apellido Per</td>
			</tr>
		</thead>
		<tbody id="tbody_encontradas">
		</tbody>
	</table>
	<button class="btn btn-danger" id="admin_org_encontradas_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button>
</div>