<?php
/***
 * @var $logged_in
 * @var $tipo_usuario
 * @var $solicitudes
 * @var $registros
 */
$CI = &get_instance();
$CI->load->model("RegistroTelefonicoModel");
$CI->load->model("OrganizacionesModel");
$CI->load->model("AdministradoresModel");

?>
<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<!-- Tabla de usuarios -->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
<!--						<input type="button" class="btn btn-primary float-right solicitudes-modal" data-toggle='modal' data-target='#modal-crear-solicitud' value="Crear registro">-->
						<br>
						<p class="card-title">Registro llamadas</p>
						<div class="row">
							<div class="col-12">
								<div class="clearfix"></div>
								<hr/>
								<div class="table-responsive">
									<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form display expandable-table">
										<thead>
										<tr>
											<th>Organización</th>
											<th>NIT</th>
											<th>Con quien se habló</th>
											<th>Cargo</th>
											<th>Teléfono</th>
											<th>Tipo Llamada</th>
											<th>Tipo Comunicación</th>
											<th>ID Solicitud</th>
											<th>Fecha</th>
											<th>Duración</th>
											<th>Descripción</th>
											<th>Evaluador</th>
											<th>Acciones</th>
										</tr>
										</thead>
										<tbody id="tbody">
										<?php
										foreach ($registros as $registro) {
											echo "<tr><td>"; echo $CI->OrganizacionesModel->getOrganizacion($registro->organizaciones_id_organizacion)->nombreOrganizacion; echo "</td>";
											echo "<td>"; echo $CI->OrganizacionesModel->getOrganizacion($registro->organizaciones_id_organizacion)->numNIT; echo "</td>";
											echo "<td>$registro->funcionario</td>";
											echo "<td>$registro->cargo</td>";
											echo "<td>$registro->telefono</td>";
											echo "<td>$registro->tipoLlamada</td>";
											echo "<td>$registro->tipoComunicacion</td>";
											echo "<td>$registro->idSolicitud</td>";
											echo "<td>$registro->fecha</td>";
											echo "<td>$registro->duracion</td>";
											echo "<td><textarea class='text-area-ext' readonly>$registro->descripcion</textarea></td>";
											echo "<td>"; echo $CI->AdministradoresModel->getAdministradores($registro->administradores_id_administrador)->primerNombreAdministrador . ' ' . $CI->AdministradoresModel->getAdministradores($registro->administradores_id_administrador)->primerApellidoAdministrador ; echo "</td>";
											echo "<td><button class='btn btn-outline-primary btn-sm admin-modal' data-funct='actualizar' data-toggle='modal' data-id='$registro->id_registroTelefonico' data-target='#modal-detalle'>Detalle</button></td></tr>";
										}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal formulario crear solicitud -->
<div class="modal fade" id="modal-detalle" tabindex="-1" role="dialog" aria-labelledby="modal-detalle">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="verAdmin">Detalle de la llamada</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="container">

				</div>
			</div>
			<br>
			<div class="modal-footer col-md-12">
				<div class="btn-group" role='group' aria-label='acciones'>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
