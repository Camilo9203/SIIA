<div class="col-md-12" id="admin_ver_finalizadas">
	<div class="clearfix"></div>
	<hr />
	<h4>Resoluciones:</h4>
	<br />
	<div class="table">
		<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
			<thead>
				<tr>
					<td class="col-md-2">Nombre</td>
					<td class="col-md-2">NIT</td>
					<td>Representante Legal</td>
					<td>Direccion E-Mail Org</td>
					<td>Direccion E-Mail Rep</td>
					<td>Estado actual</td>
					<td>Estado anterior</td>
					<td>Accion</td>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php
				for ($i = 0; $i < count($organizaciones_en_proceso); $i++) {
					echo "<tr>";
					echo "<td>" . $organizaciones_en_proceso[$i]->nombreOrganizacion . "</td>";
					echo "<td>" . $organizaciones_en_proceso[$i]->numNIT . "</td>";
					echo "<td>" . $organizaciones_en_proceso[$i]->primerNombreRepLegal . " " . $organizaciones_en_proceso[$i]->segundoNombreRepLegal . " " . $organizaciones_en_proceso[$i]->primerApellidoRepLegal . " " . $organizaciones_en_proceso[$i]->segundoApellidoRepLegal . "</td>";
					echo "<td>" . $organizaciones_en_proceso[$i]->direccionCorreoElectronicoOrganizacion . "</td>";
					echo "<td>" . $organizaciones_en_proceso[$i]->direccionCorreoElectronicoRepLegal . "</td>";
					echo "<td>" . $organizaciones_en_proceso[$i]->nombre . "</td>";
					echo "<td>" . $organizaciones_en_proceso[$i]->estadoAnterior . "</td>";
					echo "<td><button class='btn btn-siia btn-sm ver_resolucion_org' id='' data-organizacion='" . $organizaciones_en_proceso[$i]->id_organizacion . "'>Ver organización <i class='fa fa-eye' aria-hidden='true'></i></a></td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<button class="btn btn-danger btn-sm pull-left" id="admin_ver_org_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
<div id="datos_org_resolucion">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-2">
				<div class="form-group">
					<label>Nombre de la Organización: </label>
					<p id="resolucion_nombre_org"></p>
				</div>
				<div class="form-group">
					<label>NIT:</label>
					<p id="resolucion_nit_org"></p>
				</div>
				<div class="form-group">
					<label>Nombre del Representante Legal:</label>
					<p id="resolucion_nombreRep_org"></p>
				</div>
				<button class="btn btn-danger btn-sm" id="volver_cama_org"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</button>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<label for="tipoResolucion">Tipo de resolución:*</label><br>
					<div class="radio">
						<label><input type="radio" name="tipoResolucion" id="tipo1" value="nueva" checked>Resolución vigente</label><br />
						<label><input type="radio" name="tipoResolucion" id="tipo2" value="vieja">Resolución vieja</label>
					</div>
				</div>
				<div class="form-group col-md-3">
					<label>Fecha inicio:</label>
					<input type="date" id="res_fech_inicio" class="form-control" name="">
				</div>
				<div class="form-group col-md-3">
					<label>Fecha final:</label>
					<input type="date" id="res_fech_fin" class="form-control" name="">
				</div>
				<div class="form-group col-md-3">
					<label>Años de la resolución:</label>
					<input type="number" id="res_anos" class="form-control" name="" placeholder="3">
				</div>
				<div class="form-group col-md-3">
					<label>Número de la resolución:</label>
					<input type="number" id="num_res_org" class="form-control" name="" placeholder="34">
				</div>
				<div class="form-group">
					<label>Curso aprobado:</label>
					<select name="cursoAprobado" id="cursoAprobado" class="selectpicker form-control show-tick" required="">
						<option id="cursoAprobado0" value="CURSO BÁSICO DE ECONOMÍA SOLIDARIA" selected>CURSO BÁSICO DE ECONOMÍA SOLIDARIA</option>
						<option id="cursoAprobado1" value="CURSO BÁSICO DE ECONOMÍA SOLIDARIA Y CURSO CON ENFASIS EN COOPERATIVAS DE TRABAJO ASOCIADO">CURSO BÁSICO DE ECONOMÍA SOLIDARIA Y CURSO CON ENFASIS EN COOPERATIVAS DE TRABAJO ASOCIADO</option>
						<option id="cursoAprobado2" value="CURSO CON ENFASIS EN COOPERATIVAS DE TRABAJO ASOCIADO">CURSO CON ENFASIS EN COOPERATIVAS DE TRABAJO ASOCIADO</option>
					</select>
				</div>
				<div class="form-group">
					<label>Modalidad aprobada:</label>
					<select name="modalidadAprobada" id="modalidadAprobada" class="selectpicker form-control show-tick" required="">
						<option id="modalidadAprobada0" value="PRESENCIAL" selected>PRESENCIAL</option>
						<option id="modalidadAprobada2" value="VIRTUAL">VIRTUAL</option>
						<option id="modalidadAprobada1" value="VIRTUAL Y PRESENCIAL">VIRTUAL Y PRESENCIAL</option>
					</select>
				</div>
				<div class="form-group">
					<label>Adjuntar resolución:</label>
					<input type="file" class="form-control" form="formulario_resoluciones" name="resolucion" id="resolucion" required accept="application/pdf"><br />
					<button class="btn btn-siia btn-sm" name="adjuntar_resolucion" id="adjuntar_resolucion">Ingresar resolución <i class="fa fa-check" aria-hidden="true"></i></button>
					<button class="btn btn-siia btn-sm" name="actualizarDatosResolucion" id="actualizarDatosResolucion">Actualizar datos resolución <i class="fa fa-check" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="clearfix"></div>
					<hr />
					<h4>Resoluciones:</h4>
					<table id="tabla_resoluciones" width="100%" border=0 class="table table-striped table-bordered tabla_form">
						<thead>
							<tr>
								<td>Fecha inicial</td>
								<td>Fecha final</td>
								<td>Años resolución</td>
								<td>Resolución</td>
								<td>Número resolución</td>
								<td>Curso aprobado</td>
								<td>Modalidad aprobada</td>
								<td>Acción</td>
							</tr>
						</thead>
						<tbody id="tbodyResoluciones"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
