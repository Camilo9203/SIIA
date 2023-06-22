<div class="col-md-12" id="admin_panel_org_inscritas">
<div class="clearfix"></div>
<hr/>
	<h4>Organizaciones Inscritas:</h4>
	<br/>
	<div class="table">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td>NIT</td>
				<td>Nombre</td>
				<td>Representante Legal</td>
				<td>Dirección E-Mail Org</td>
				<td>Dirección E-Mail Rep</td>
				<td>Estado actual</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php
			foreach ($organizaciones as $organizacion) {
				echo "<tr>";
				echo "<td>" . $organizacion->numNIT . "</td>";
				echo "<td>" . $organizacion->nombreOrganizacion . "</td>";
				echo "<td>" . $organizacion->primerNombreRepLegal . " " . $organizacion->segundoNombreRepLegal . " " . $organizacion->primerApellidoRepLegal . " " . $organizacion->segundoApellidoRepLegal . "</td>";
				echo "<td>" . $organizacion->direccionCorreoElectronicoOrganizacion . "</td>";
				echo "<td>" . $organizacion->direccionCorreoElectronicoRepLegal."</td>";
				echo "<td>" . $organizacion->estado . "</td>";
				echo "<td><button class='btn btn-siia btn-sm ver_organizacion_inscrita' id='' data-organizacion='" . $organizacion->id_organizacion."'>Ver organizacion <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
		<button class="btn btn-danger btn-sm pull-left" id="admin_panel_org_inscritas_volver btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver al panel principal</button>
	</div>
</div>
<div class="col-md-12" id="datos_organizaciones_inscritas">
	<div class="col-md-4" id="datos_basicos">
		<h4>Datos Básicos de la Organización:</h4>
		<img class="center-block img-responsive thumbnail" src="" id="inscritas_imagenOrganizacion_organizacion">
		<label>Nombre de la organizacion:</label><br>
		<span id="inscritas_nombre_organizacion"></span>
		<label>Numero Nit de la Organizacion:</label><br>
		<span id="inscritas_nit_organizacion"></span>
		<label>Sigla de la Organizacion:</label><br>
		<span id="inscritas_sigla_organizacion"></span>
		<label>Nombre del Representante Legal de la Organizacion:</label><br>
		<span id="inscritas_nombreRepLegal_organizacion"></span>
		<label>Correo Electronico de la Organizacion:</label><br>
		<span id="inscritas_direccionCorreoElectronicoOrganizacion_organizacion"></span>
		<label>Correo Electronico del Representante de la Organizacion:</label><br>
		<span id="inscritas_direccionCorreoElectronicoRepLegal_organizacion"></span>
		<label>Estado actual:</label><br>
		<span id="inscritas_estadoActual_organizacion"></span>
		<label>Estado anterior:</label><br>
		<span id="inscritas_estadoAnterior_organizacion"></span>
		<label>Nombre de Usuario:</label><br>
		<span id="inscritas_usuario"></span>
		<button class="btn btn-danger pull-left btn-sm" id="admin_ver_inscritas_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
		<button class="btn btn-siia pull-right btn-sm" id="verTodaInformacion">Ver toda la información registrada <i class="fa fa-eye" aria-hidden="true"></i></button>
	</div>
	<div class="col-md-8">
	<h4>Registro de Actividad</h4>
	<p>Aqui se muestran los ultimos 70 Registros del usuario.</p>
	<table id="tabla_actividad_inscritas" width="100%" border=0 class="table table-striped table-bordered">
		<thead>
			<tr>
				<td class="col-md-3"><label>Actividad</label></td>
				<td class="col-md-3"><label>Fecha</label></td>
				<td class="col-md-3"><label>Dirección IP</label></td>
				<td class="col-md-3"><label>Explorador</label></td>
			</tr>
		</thead>
		<tbody id="tbody_actividad">
		</tbody>
	</table>
	</div>
</div>
