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
