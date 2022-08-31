<!-- Tabla de solicitudes -->
<div class="col-md-12" id="admin_ver_finalizadas">
<div class="clearfix"></div>
<hr/>
	<h4>Estado de la solicitud:</h4>
	<br/>
	<div class="table">
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td>Organización</td>
				<td>NIT</td>
				<td>ID Solicitud</td>
				<td>Fecha de Creación</td>
				<td>Motivo</td>
				<td>Modalidad</td>
				<td>Estado actual</td>
				<td>Fecha Finalización</td>
				<td>Acción</td>
			</tr>
		</thead>
		<tbody id="tbody">
		<?php
		foreach ($solicitudes as $solicitud) {
			echo "<tr>";
			echo "<td>" . $solicitud->nombreOrganizacion . "</td>";
			echo "<td>" . $solicitud->numNIT . "</td>";
			echo "<td>" . $solicitud->idSolicitud . "</td>";
			echo "<td>" . $solicitud->fecha . "</td>";
			echo "<td>" . $solicitud->motivoSolicitudAcreditado . "</td>";
			echo "<td>" . $solicitud->modalidadSolicitudAcreditado . "</td>";
			echo "<td>" . $solicitud->nombre . "</td>";
			echo "<td>" . $solicitud->fechaFinalizado . "</td>";
			echo "<td><button class='btn btn-siia btn-sm ver_estado_org' data-organizacion='" . $solicitud->id_organizacion . "' data-solicitud='" . $solicitud->idSolicitud . "'>Ver estado <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
			echo "</tr>";
		}
		?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
<!-- Ver estado de la solicitud-->
<div class="container" id="v_estado_org">
	<div class="clearfix"></div>
	<hr/>
	<br>
	<h4>Estado de la solicitud: </h4>
	<hr/>
	<div class="card">
		<div class="card-body">
			<h4>Nombre de la Organización: <label id="resolucion_nombre_org"></label></h4>
			<h4>NIT: <label id="nit_organizacion"></label></h4>
			<h4>ID Solicitud: <label id="id_solicitud"></label></h4>
			<h4>Estado Actual: <label id="estado_actual_org"></label></h4>
			<h4>Modalidad: <label id="modalidad_solicitud"></label></h4>
			<h4>Motivo: <label id="motivo_solicitud"></label></h4>
			<h4>Fecha de Finalización: <label id="fecha_finalización"></label></h4>
		</div>
	</div>
	<hr/>
	<!-- Select cambiar estado organización-->
	<div class="form-group">
		<label for="estadoSolicitud">Seleccionar nuevo estado</label>
		<select class="form-control" name="estadoSolicitud" id="estadoSolicitud">
			<option value="Acreditado">Acreditado</option>
			<option value="Archivada">Archivada</option>
			<option value="Negada">Negada</option>
			<option value="Revocada">Revocada</option>
		</select>
	</div>
	<hr/>
	<button class="btn btn-danger pull-left" id="volverEst_org"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</i></button>
	<button class="btn btn-siia pull-right" id="actualizarEstadoOrganizacion">Actualizar estado <i class="fa fa-check" aria-hidden="true"></i></button>
</div>
