<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="tabla_informes">
				<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
					<thead>
					<tr>
						<td>Nombre Curso</td>
						<td>Duración Curso</td>
						<td>Tipo Curso</td>
						<td>En union con</td>
						<td>Fecha del Curso</td>
						<td>Fecha de Ingreso</td>
						<td>Numero Asistentes</td>
						<td>Numero Hombres</td>
						<td>Numero Mujeres</td>
						<td>Accion</td>
					</tr>
					</thead>
					<tbody id="tbody">
					<?php
					foreach ($informes as $informe) {
						echo "<tr><td>$informe->nombreCurso</td>";
						echo "<td>$informe->duracionCurso</td>";
						echo "<td>$informe->tipoCurso</td>";
						echo "<td>$informe->enUnionCon</td>";
						echo "<td>$informe->fechaCurso</td>";
						echo "<td>$informe->fechaIngresoCurso</td>";
						echo "<td>$informe->numeroAsistentes</td>";
						echo "<td>$informe->numeroHombres</td>";
						echo "<td>$informe->numeroMujeres</td>";
						echo "<td><button class='btn btn-siia adminVerInforme' data-nombre='$informe->nombreCurso' data-id='$informe->id_informeActividades'>Descripción <i class='fa fa-bars' aria-hidden='true'></i></button></td></tr>";
					}
					?>
					</tbody>
				</table>
				<button class="btn btn-sm btn-danger pull-left" id="admin_volver"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
			</div>
			<div id="adminInformacionInforme">
				<div class="col-md-12 text-center" id="informacionInforme">
					<h4>Información del Curso:</h4>
					<div class="form-group">
						<label for="">Nombre del Curso:</label>
						<p id="nombre_curso"></p>
					</div>
					<div class="form-group">
						<label for="">Duración del Curso:</label>
						<p id="duracion_curso"></p>
					</div>
					<div class="form-group">
						<label for="">Tipo de Curso:</label>
						<p id="tipo_curso"></p>
					</div>
					<div class="form-group">
						<label for="">Fecha del Curso:</label>
						<p id="fecha_curso"></p>
					</div>
					<div class="form-group">
						<label for="">Fecha de Ingreso del Curso:</label>
						<p id="fecha_ingreso_curso"></p>
					</div>
					<div class="form-group">
						<label for="">Número de Asistentes:</label>
						<p id="numero_asistentes"></p>
					</div>
					<div class="form-group">
						<label for="">Número de Hombres:</label>
						<p id="numero_asistentes_hombres"></p>
					</div>
					<div class="form-group">
						<label for="">Número de Mujeres:</label>
						<p id="numero_asistentes_mujeres"></p>
					</div>
					<div class="form-group">
						<p>Archivo de asistencia</p>
						<a href="#" target="_blank" id="archivoAsistencia"><button class='btn btn-danger'>Ver archivo <i class='fa fa-bars' aria-hidden='true'></i></button></a>
					</div>
					<div class="form-group">
						<p>Archivo de asistentes</p>
						<a href="#" target="_blank" id="archivoAsistentes"><button class='btn btn-danger'>Ver archivo <i class='fa fa-bars' aria-hidden='true'></i></button></a>
					</div>
					<button class="btn btn-warning pull-left" id="volverInforme"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button>
					<button class="btn btn-siia adminVerAsistentes pull-right">Ver Asistentes <i class="fa fa-eye" aria-hidden="true"></i></button>
				</div>
				<br/>
				<br/>
				<div class="col-md-9" id="cursoAsistente">
					<h4>Asistente #<label id="id_asistente_curso">0</label>:</h4>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Primer Nombre:</label>
							<p id="primer_nombre_asistente"></p>
						</div>
						<div class="form-group">
							<label for="">Segundo Nombre:</label>
							<p id="segundo_nombre_asistente"></p>
						</div>
						<div class="form-group">
							<label for="">Primer Apellido:</label>
							<p id="primer_apellido_asistente"></p>
						</div>
						<div class="form-group">
							<label for="">Segundo Apellido:</label>
							<p id="segundo_apellido_asistente"></p>
						</div>
						<div class="form-group">
							<label for="">tipoDocumentoAsistente</label>
							<p id="tipoDocumentoAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">numeroDocumentoAsistente</label>
							<p id="numeroDocumentoAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">nombreOrganizacion</label>
							<p id="nombreOrganizacion"></p>
						</div>
						<div class="form-group">
							<label for="">numNITOrganizacion</label>
							<p id="numNITOrganizacion"></p>
						</div>
						<div class="form-group">
							<label for="">procesoBeneficio</label>
							<p id="procesoBeneficio"></p>
						</div>
						<div class="form-group">
							<label for="">fechaFinalizacion</label>
							<p id="fechaFinalizacion"></p>
						</div>
						<div class="form-group">
							<label for="">departamentoResidencia</label>
							<p id="departamentoResidencia"></p>
						</div>
						<div class="form-group">
							<label for="">municipioResidencia</label>
							<p id="municipioResidencia"></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">faxAsistente</label>
							<p id="faxAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">direccionAsistente</label>
							<p id="direccionAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">direccionCorreoElectronicoAsistente</label>
							<p id="direccionCorreoElectronicoAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">edadAsistente</label>
							<p id="edadAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">sexoAsistente</label>
							<p id="sexoAsistente"></p>
						</div>
						<div class="form-group">
							<label for="">nivelFormacion</label>
							<p id="nivelFormacion"></p>
						</div>
						<div class="form-group">
							<label for="">rolOrganizacion</label>
							<p id="rolOrganizacion"></p>
						</div>
						<div class="form-group">
							<label for="">cabezaFamilia</label>
							<p id="cabezaFamilia"></p>
						</div>
						<div class="form-group">
							<label for="">discapacidad</label>
							<p id="discapacidad"></p>
						</div>
						<div class="form-group">
							<label for="">indigena</label>
							<p id="indigena"></p>
						</div>
						<div class="form-group">
							<label for="">afro</label>
							<p id="afro"></p>
						</div>
						<div class="form-group">
							<label for="">raizal</label>
							<p id="raizal"></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">palenquero</label>
							<p id="palenquero"></p>
						</div>
						<div class="form-group">
							<label for="">romGitano</label>
							<p id="romGitano"></p>
						</div>
						<div class="form-group">
							<label for="">redUnidos</label>
							<p id="redUnidos"></p>
						</div>
						<div class="form-group">
							<label for="">numeroFolioRedUnidos</label>
							<p id="numeroFolioRedUnidos"></p>
						</div>
						<div class="form-group">
							<label for="">victima</label>
							<p id="victima"></p>
						</div>
						<div class="form-group">
							<label for="">numeroRUVVictima</label>
							<p id="numeroRUVVictima"></p>
						</div>
						<div class="form-group">
							<label for="">reintegro</label>
							<p id="reintegro"></p>
						</div>
						<div class="form-group">
							<label for="">numeroCODAReintegro</label>
							<p id="numeroCODAReintegro"></p>
						</div>
						<div class="form-group">
							<label for="">LGTBI</label>
							<p id="LGTBI"></p>
						</div>
						<div class="form-group">
							<label for="">prostitucion</label>
							<p id="prostitucion"></p>
						</div>
						<div class="form-group">
							<label for="">privadoLibertad</label>
							<p id="privadoLibertad"></p>
						</div>
						<button class="btn btn-siia" id="getCert">Ver certificado</button>
					</div>
					<div>
						<div class="clearfix"></div>
						<hr/>
						<button class="pull-left btn btn-danger" id="anteriorAsistente"><i class="fa fa-chevron-left" aria-hidden="true"></i> Anterior</button>
						<button class="pull-right btn btn-danger" id="siguienteAsistente">Siguiente <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


