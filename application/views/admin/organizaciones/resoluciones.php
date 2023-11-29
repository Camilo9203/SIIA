<?php
/***
 * @var $organizacion
 * @var $resoluciones
 * @var $solicitudes
 */
$CI = &get_instance();
$CI->load->model("AdministradoresModel");
$CI->load->model("UsuariosModel");
$CI->load->model("OrganizacionesModel");
$CI->load->model("ResolucionesModel");
?>
<div class="container">
	<div class="row">
		<hr />
		<div class="col-md-12">
			<div class="card" id="datos_basicos" style="padding: 10px">
				<!-- Información resumen -->
				<div class="col-4" style="float: left; margin-right: 20px">
					<img class="img-responsive thumbnail" src="<?php echo base_url(); ?>uploads/logosOrganizaciones/<?php echo $organizacion->imagenOrganizacion; ?>" height="200" width="200">
				</div>
				<div class="col-6 pl-5" style="display: inline-block; vertical-align:top;">
					<label>Organización:</label><br>
					<p><?php echo $organizacion->nombreOrganizacion; ?></p>
					<label>NIT</label><br>
					<p><?php echo $organizacion->numNIT; ?></p>
					<label>Sigla</label><br>
					<p><?php echo $organizacion->sigla; ?></p>
					<label>Representante legal</label><br>
					<p><?php echo $organizacion->primerNombreRepLegal; ?> <?php echo $organizacion->primerApellidoRepLegal; ?></p>
				</div>
				<div class="col-6 pl-5" style="display: inline-block; vertical-align:top;">
					<label>Correo electrónico</label><br>
					<p><?php echo $organizacion->direccionCorreoElectronicoOrganizacion; ?></p>
					<label>Correo electrónico del representante</label><br>
					<p><?php echo $organizacion->direccionCorreoElectronicoRepLegal; ?></p>
				</div>
				<hr>
				<ul class="nav nav-tabs role="tablist">
					<li class="nav-item" role="presentation">
						<button class="btn btn-siia" id="verResolucionesRegistradas">Resoluciones cargadas  <i class="fa fa-ticket" aria-hidden="true"></i></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="btn btn-siia" id="verFormularioResolucion">Cargar resolución  <i class="fa fa-eye" aria-hidden="true"></i></button>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-12" id="formulario_resolucion_organizacion">
			<div class="card" style="padding: 40px">
				<?php echo form_open_multipart('', array('id' => 'formulario_resoluciones_organizacion')); ?>
					<!-- Tipo de resolución -->
					<div class="form-group">
						<label for="tipoResolucion">Tipo de resolución:*</label><br>
						<div class="radio">
							<label><input type="radio" name="tipoResolucion" id="tipo1" value="nueva" checked>Resolución vigente</label><br />
							<label><input type="radio" name="tipoResolucion" id="tipo2" value="vieja">Resolución vieja</label>
						</div>
					</div>
					<!-- Fecha Inicio -->
					<div class="form-group col-md-3">
						<label>Fecha inicio:</label>
						<input type="date" id="fechaResolucionInicial" class="form-control" name="fechaResolucionInicial">
					</div>
					<!-- Años Resolución -->
					<div class="form-group col-md-3">
						<label>Años de la resolución:</label>
						<input type="number" id="anosResolucion" class="form-control" name="anosResolucion" disabled>
					</div>
					<!-- Fecha Final -->
					<div class="form-group col-md-3">
						<label>Fecha final:</label>
						<input type="date" id="fechaResolucionFinal" class="form-control" name="fechaResolucionFinal" disabled>
					</div>
					<!-- Número de la resolución-->
					<div class="form-group col-md-3">
						<label>Número de la resolución:</label>
						<input type="number" id="numeroResolucion" class="form-control" name="numeroResolucion" disabled>
					</div>
					<!-- Si la resolución requiere añadir motivos -->
					<div id="resolucionVieja">
						<!-- Curso aprobado -->
						<div class="form-group">
							<label>Curso aprobado:</label>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="1" id="cursoBasico" name="motivos" checked>
								<label class="form-check-label" for="cursoBasico">Acreditación Curso Básico de Economía Solidaria</label>
							</div>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="2" id="avalTrabajo" name="motivos">
								<label class="form-check-label" for="avalTrabajo">Aval de Trabajo Asociado</label>
							</div>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="3" id="cursoMedio" name="motivos">
								<label class="form-check-label" for="cursoMedio">Acreditación Curso Medio de Economía Solidaria</label>
							</div>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="4" id="cursoAvanzado" name="motivos">
								<label class="form-check-label" for="cursoAvanzado">Acreditación Curso Avanzado de Economía Solidaria</label>
							</div>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="5" id="finacieraEconomia" name="motivos">
								<label class="form-check-label" for="finacieraEconomia">Acreditación Curso de Educación Económica y Financiera Para La Economía Solidaria</label>
							</div>
						</div>
						<!-- Modalidad aprobada -->
						<div class="form-group">
							<label>Modalidad aprobada:</label>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="1" id="presencial" value="Presencial" name="modalidades" checked>
								<label class="form-check-label" for="presencial">Presencial</label>
							</div>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="2" id="virtual" value="Virtual" name="modalidades">
								<label class="form-check-label" for="virtual">Virtual</label>
							</div>
							<div class="form-check radio">
								<input class="form-check-input" type="checkbox" value="3" id="enLinea" value="En Linea" name="modalidades">
								<label class="form-check-label" for="enLinea">En Linea</label>
							</div>
						</div>
					</div>
					<!-- Resolución vigente anclada a una solicitud -->
					<div id="resolucionVigente">
						<div class="form-group">
							<label>Solicitud</label>
							<select class="form-control" name="idSolicitud" id="idSolicitud" required>
								<option selected>Seleccione una opción</option>
								<?php foreach ($solicitudes as $solicitud): ?>
									<option value="<?= $solicitud->idSolicitud ?>"><?= $solicitud->idSolicitud ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!-- Documento Resolución -->
					<div class="form-group">
						<label>Adjuntar resolución:</label>
						<input type="file" class="form-control" name="resolucion" id="resolucion" required accept="application/pdf"><br />
						<!-- Botones adjunto y actualizar -->
						<a class="btn btn-siia btn-md" style="width: 100%;" name="cargarResolucion" id="cargarResolucion" data-id-org="<?= $organizacion->id_organizacion; ?>">Ingresar resolución <i class="fa fa-check" aria-hidden="true"></i></a>
						<a class="btn btn-siia btn-md" style="width: 100%;" name="actualizarDatosResolucion" id="actualizarDatosResolucion">Actualizar datos resolución <i class="fa fa-check" aria-hidden="true"></i></a>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
		<div class="col-md-12" id="tabla_resoluciones_organizacion">
			<div class="card" style="padding: 40px">
				<h4>Resoluciones</h4>
				<?php if($resoluciones): ?>
				<table id="tabla_resoluciones" width="100%" border=0 class="table table-striped table-bordered tabla_form">
						<thead>
						<tr>
							<td>Fecha inicial</td>
							<td>Fecha final</td>
							<td>Años resolución</td>
							<td>Número resolución</td>
							<td>Curso aprobado</td>
							<td>Modalidad aprobada</td>
							<td>Solicitud</td>
							<td>Acciones</td>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($resoluciones as $resolucion): ?>
							<tr>
								<td><?= $resolucion->fechaResolucionInicial; ?></td>
								<td><?= $resolucion->fechaResolucionFinal; ?></td>
								<td><?= $resolucion->anosResolucion; ?></td>
								<td><?= $resolucion->numeroResolucion; ?></td>
								<td><?= $resolucion->cursoAprobado; ?></td>
								<td><?= $resolucion->modalidadAprobada; ?></td>
								<td><?= $resolucion->idSolicitud; ?></td>
								<td>
									<div class="btn-group-vertical" role="group" aria-label="acciones">
										<a class="btn btn-sm btn-info" style="text-decoration: none; color: #951919;" href="<?= base_url() . 'uploads/resoluciones/' . $resolucion->resolucion; ?>" target='_blank'>
											Ver resolución <i class='fa fa-eye' aria-hidden='true'></i>
										</a>
										<button class="btn btn-sm btn-danger eliminarResolucion" data-id-org="<?= $organizacion->id_organizacion ?>" data-id-res="<?= $resolucion->id_resoluciones ?>">
											Eliminar <i class='fa fa-times' aria-hidden='true'></i>
										</button>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
				</table>
				<?php else: ?>
					<div class="alert alert-success" role="alert">
						<p>La organización <?= $organizacion->nombreOrganizacion ?> no tiene resoluciones cargadas en este momento</p>
						<hr>
						<p class="mb-0">En el momento que se carguen resoluciones, se mostrarán en este espacio.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<button class="btn btn-danger pull-left btn-sm" id="volver_inscritas"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
	</div>
</div>
