<div class="clearfix"></div>
<hr />
<div class="container">
	<h4>
		<label>Información a tener en cuenta:</label>
		<li>Manejar ortografía, mayúsculas, minúsculas y espacios.</li>
		<li>Los facilitadores relacionados en cursos, deben estar aprobados por la Unidad Solidaria.</li>
		<li>Para diligenciar el informe debe tener todos los datos de los asistentes y todas las especificaciones del curso.</li>
		<li>Verificar la información del curso y de los asistentes antes de terminar.</li>
		<li>Si comete un error después de haber creado el curso debe hacer clic en el botón Restaurar y volver a comenzar.</li>
		<li>Si da click en Enviar/Ver para el certificado se le enviará un correo electrónico al asistente (Si el asistente no tiene correo, por favor ingresar el correo electrónico de la organización para que luego le haga entrega del mismo).</li>
		<li>Para ingresar los asistentes de forma automática en excel debe diligenciar el siguiente <a target="_blank" href="<?php echo base_url("assets/manuales/AsistentesCursosOrganizacion.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a> en excel, o si ya lo diligencio, seleccione el archivo y de click en subir asistentes.</li>
		<li>Recuerde diligenciar y verificar toda la información suministrada antes de finalizar.</li>
	</h4>
</div>
<div class="container" id="div_llenar_curso">
	<h3>Información del curso impartido:</h3>
	<div class="clearfix"></div>
	<hr />
	<div class="col-md-6">
		<div class="form-group">
			<label for="informe_nombre_curso">Nombre del curso:</label>
			<input type="text" class="form-control" name="informe_nombre_curso" id="informe_nombre_curso" placeholder="Nombre del curso">
		</div>
		<div class="form-group">
			<label for="informe_tipo_curso">Modalidad del curso:</label><br>
			<select name="informe_tipo_curso" id="informe_tipo_curso" class="selectpicker form-control show-tick" required="">
				<?php
				foreach ($tiposCursos as $tiposCurso) {
				?>
					<option id="<?php echo $tiposCurso->id_tiposCursoInformes; ?>" value="<?php echo $tiposCurso->nombre; ?>"><?php echo $tiposCurso->nombre; ?></option>
				<?php
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="informe_intencionalidad_curso">Intencionalidad del Curso:</label><br>
			<select name="informe_intencionalidad_curso" id="informe_intencionalidad_curso" class="selectpicker form-control show-tick" required="">
				<option id="1" value="Fortalecimiento">Fortalecimiento</option>
				<option id="2" value="Creación">Creación</option>
			</select>
		</div>
		<div class="form-group">
			<label for="unionOrg">Unión?:</label>
			<br>
			<select name="unionOrg" id="unionOrg" class="selectpicker form-control show-tick" required="">
				<optgroup label="No union">
					<option id="0" value="No" selected>No, sin unión...</option>
				</optgroup>
				<optgroup label="Organizaciones">
					<!-- //TODO: Cambiar por organizaciones acreditadas -->
					<?php
					foreach ($organizaciones as $organizacion) {
					?>
						<option id="<?php echo $organizacion->nombreOrganizacion; ?>" value="<?php echo $organizacion->nombreOrganizacion; ?>"><?php echo $organizacion->nombreOrganizacion; ?></option>
					<?php
					}
					?>
				</optgroup>
			</select>
		</div>
		<div class="form-group">
			<label for="informe_duracion_curso">Duracion del Curso: <small>Horas</small></label>
			<input type="number" name="informe_duracion_curso" class="form-control" id="informe_duracion_curso" min="20" value="20">
		</div>
		<div class="form-group">
			<label for="informe_departamento_curso">Departamento*</label>
			<br>
			<select name="informe_departamento_curso" id="informe_departamento_curso" data-id-dep="4" class="selectpicker form-control show-tick departamentos" required="">
				<?php
				foreach ($departamentos as $departamento) {
				?>
					<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
				<?php
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<div id="div_municipios4">
				<label for="informe_municipio_curso">Municipio:*</label>
				<br>
				<select name="informe_municipio_curso" id="informe_municipio_curso" class="selectpicker form-control show-tick" required="">
					<?php
					foreach ($municipios as $municipio) {
					?>
						<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
					<?php
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>¿El curso fue gratis?:</label>
			<div class="radio">
				<label><input type="radio" name="gratisCurso" id="gratisCurso1" class="" value="1">Sí</label>
				<label><input type="radio" name="gratisCurso" id="gratisCurso2" class="" value="0" checked>No</label>
			</div>
		</div>
		<div class="form-group">
			<label for="informe_docente">Docente:</label><br>
			<select name="informe_docente" id="informe_docente" class="selectpicker form-control show-tick" required="">
				<?php
				foreach ($docentes as $docente) {
					echo "<option id='$docente->id_docente' value='$docente->id_docente'>$docente->primerNombreDocente $docente->primerApellidoDocente</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="informe_fecha_curso">Fecha del Curso</label>
			<input type="date" class="form-control" name="informe_fecha_curso" id="informe_fecha_curso">
		</div>
		<div class="form-group">
			<label for="informe_asistentes">Asistentes:</label>
			<input type="number" class="form-control" name="informe_asistentes" id="informe_asistentes" placeholder="25">
		</div>
		<div class="form-group">
			<label for="informe_numero_mujeres">Numero Mujeres:</label>
			<input type="number" class="form-control" name="informe_numero_mujeres" id="informe_numero_mujeres" placeholder="13">
		</div>
		<div class="form-group">
			<label for="informe_numero_hombres">Numero Hombres:</label>
			<input type="number" class="form-control" name="informe_numero_hombres" id="informe_numero_hombres" placeholder="12">
		</div>
		<button class="btn btn-siia pull-right" id="guardar_curso_informe">Crear Curso <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
	<div class="clearfix"></div>
	<hr />
	<button class="btn btn-danger pull-left volver_al_panel"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al panel principal</button>
</div>
<div class="container" id="div_btn_asistentes">
	<div class="clearfix"></div>
	<hr />
	<p>Se debe completar todos los asistentes los cuales son: <label id="informe_asistentes_numero"></label>, para poder terminar el proceso de Informe de Actividades.</p>
	<button class="btn btn-warning pull-left" id="volver_div_llenar"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</button>
	<div class="clearfix"></div>
	<hr />
	<button class="btn btn-siia btn-block" id="llenar_asistentes" data-backdrop="static" data-keyboard="false" data-toggle='modal' data-target='#llenar_asistente' disabled="">Click para llenar los asistentes del curso</button>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12" id="div_informe_cursos">
			<hr>
			<table id="tabla_super_admins" width="100%" border=0 class="table table-striped table-bordered tabla_form">
				<thead>
				<tr>
					<td>Docente</td>
					<td>Nombre Curso</td>
					<td>Modalidad</td>
					<td>Intencionalidad Curso</td>
					<td>Duración Curso</td>
					<td>Asistentes</td>
					<td>Número Mujeres</td>
					<td>Número Hombres</td>
					<td>¿Curso Gratis?</td>
					<td>Departamento</td>
					<td>Municipio</td>
					<td>Archivo</td>
					<td>Accion</td>
				</tr>
				</thead>
				<tbody id="tbody">
				<?php
				foreach ($cursos[0] as $curso) {
					echo "<tr><td>$curso->nombreDocente</td>";
					echo "<td>$curso->nombreCurso</td>";
					echo "<td>$curso->tipoCurso</td>";
					echo "<td>$curso->intencionalidadCurso</td>";
					echo "<td>$curso->duracionCurso</td>";
					echo "<td>$curso->numeroAsistentes</td>";
					echo "<td>$curso->numeroMujeres</td>";
					echo "<td>$curso->numeroHombres</td>";
					if ($curso->cursoGratis == '0') {
						echo "<td>No</td>";
					} else if ($curso->cursoGratis == '1') {
						echo "<td>Si</td>";
					}
					echo "<td>$curso->departamentoCurso</td>";
					echo "<td>$curso->municipioCurso</td>";
					if ($curso->archivoAsistentes != null) {
						echo "<td><a href='" . base_url("uploads/asistentes/" . $curso->archivoAsistentes . "") . "'<button class='btn btn-siia'>Ver archivo <i class='fa fa-bars' aria-hidden='true'></i></button></a></td>";
					} else {
						echo "<td>Ninguno</td>";
					}
					echo "<td><button class='btn btn-siia verCurso' data-toggle='modal' data-nombre='$curso->nombreCurso' data-id='$curso->id_informeActividades' data-target='#verCurso'>Ver Asistentes <i class='fa fa-eye' aria-hidden='true'></i></button></td></tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="llenar_asistente" tabindex="-1" role="dialog" aria-labelledby="llenarAsistente">
	<!-- <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h3 class="modal-title" id="llenarAsistente">Número de Asistente #: <span id="asistentes_faltantes"></span> de <span id="informe_asistentes_modal"></span>.</h3>
		    </div>
		    <div class="modal-body">
			  	<div class="jumbotron">
				  <h1>Bootstrap Tutorial</h1> 
				  <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive,
				  mobile-first projects on the web.</p> 
				</div>
				<div class="container">
				  <p>This is some text.</p> 
				  <p>This is another text.</p> 
				</div>
			</div>
			<div class="modal-footer">
		        <button class="btn btn-danger pull-left informe_restaurar" id="informe_restaurar">Restaurar</button>
		    </div>
		</div>
	</div> -->
	<div id="excelAsistentes" class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Subir asistentes en Excel</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<p>El archivo de asistencia del curso debe estar en formato unico pdf. (Se requiere solo un archivo si son varios archivos por favor unirlos en uno solo para hacer una consolidación de la asistencia)</p>
						<p>Para ingresar los asistentes de forma automatica en excel debe diligenciar el siguiente <a target="_blank" href="<?php echo base_url("assets/manuales/AsistentesCursosOrganizacion.xlsx"); ?>">FORMATO <i class="fa fa-file-excel-o" aria-hidden="true"></i></a> en excel, o si ya lo diligencio, seleccione el archivo y de click en subir asistentes.</p>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Archivo de Asistencia del curso:</label>
							<input type="file" class="form-control archivoAsistencia" accept="application/pdf" name="archivoExcelAsistencia" id="archivoExcelAsistencia" data-name="archivoExcelAsistencia" required>
						</div>
						<div class="form-group">
							<label>Archivo de Asistentes:</label>
							<input type="file" class="form-control archivoAsistentes" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="archivoExcelAsistentes" id="archivoExcelAsistentes" data-name="archivoExcelAsistentes" required>
						</div>
						<button class="btn btn-siia" id="guardarArchivoAsistentes">Subir archivos <i class="fa fa-check" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger pull-left informe_restaurar" id="informe_restaurar">Restaurar</button>
			</div>
		</div>
	</div>
	<!--<div id="manualAsistentes" class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
		    <div class="modal-header">
		        <h3 class="modal-title" id="llenarAsistente">Número de Asistente #: <span id="asistentes_faltantes"></span> de <span id="informe_asistentes_modal"></span>.</h3>
		    </div>
	    	<div class="modal-body">
	    		<div class="row">
	    			<div class="col-md-6">
						<h4>Identificación de la persona beneficiada:</h4>
						<div class="form-group">
						    <label for="">Primer Nombre</label>
							<input type="text" class="form-control" id="informe_primerNombre_asistente">
						</div>
						<div class="form-group">
						    <label for="">Segundo Nombre</label>
							<input type="text" class="form-control" id="informe_segundoNombre_asistente">
						</div>
						<div class="form-group">
						    <label for="">Primer Apellido</label>
							<input type="text" class="form-control" id="informe_primerApellido_asistente">
						</div>
						<div class="form-group">
						    <label for="">Segundo Apellido</label>
							<input type="text" class="form-control" id="informe_segundoApellido_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_sexo_asistente">Sexo:</label><br>
							<select name="informe_sexo_asistente" id="informe_sexo_asistente" class="selectpicker form-control show-tick" required="">
							  <option id="1" value="Hombre">Hombre</option>
							  <option id="2" value="Mujer">Mujer</option>
							</select>
						</div>
						<div class="form-group">
						    <label for="informe_edad_asistente">Edad:</label>
							<input type="number" class="form-control" id="informe_edad_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_tipoDocumento_asistente">Tipo de Documento:</label><br>
							<select name="informe_tipoDocumento_asistente" id="informe_tipoDocumento_asistente" class="selectpicker form-control show-tick" required="">
							  <option id="1" value="CC">Cédula de Ciudadania</option>
							  <option id="2" value="TI">Tarjeta de Identidad</option>
							  <option id="3" value="CE">Cédula de Extranjeria</option>
							  <option id="4" value="PS">Pasaporte</option>
							</select>
						</div>
						<div class="form-group">
						    <label for="informe_numeroDocumento_asistente">Numero del Documento</label>
							<input type="number" class="form-control" id="informe_numeroDocumento_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_formacion_asistente">Nivel de Formación:</label><br>
							<select name="informe_formacion_asistente" id="informe_formacion_asistente" class="selectpicker form-control show-tick" required="">
							  <option id="1" value="Primaria">Primaria</option>
							  <option id="2" value="Secundaria">Secundaria</option>
							  <option id="3" value="Tecnico">Tecnico</option>
							  <option id="4" value="Tecnologo">Tecnologo</option>
							  <option id="5" value="Profesional">Profesional</option>
							  <option id="6" value="Especializacion">Especializacion</option>
							  <option id="7" value="Maestria">Maestria</option>
							  <option id="8" value="Doctorado">Doctorado</option>
							  <option id="9" value="Ninguna">Ninguna</option>
							</select>
						</div>
						<hr/>
						<h4>Identificación de la Organización a la cual pertenece:</h4>
						<div class="form-group">
						    <label for="informe_nit_asistente">NIT</label>
							<input type="number" class="form-control" id="informe_nit_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_razonsocial_asistente">Nombre de Razon Social</label>
							<input type="text" class="form-control" id="informe_razonsocial_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_rolorganizacion_asistente">Rol en la Organización</label>
							<input type="text" class="form-control" id="informe_rolorganizacion_asistente">
						</div>
						<hr/>
						<div class="form-group">
						    <label for="informe_proceso_asistente">Proceso del que se benefició</label>
							<input type="text" class="form-control" id="informe_proceso_asistente">
						</div>
						<div class="form-group">
						    <label for="">Fecha de finalizacion del proceso</label>
							<input type="date" class="form-control" id="informe_fechafinalizacion_asistente">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="informe_departamento_asistente">Departamento*</label>
							<br>
							<select name="informe_departamento_asistente" id="informe_departamento_asistente" data-id-dep="5" class="selectpicker form-control show-tick departamentos" required="">
							<?php
							foreach ($departamentos as $departamento) {
							?>
								<option id="<?php echo $departamento->id_departamento; ?>" value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
							<?php
							}
							?>
							</select>
						</div>
						<div class="form-group">
							<div id="div_municipios5">
								<label for="informe_municipio_asistente">Municipio:*</label>
								<br>
								<select name="informe_municipio_asistente" id="informe_municipio_asistente" class="selectpicker form-control show-tick" required="">
								<?php
								foreach ($municipios as $municipio) {
								?>
									<option id="<?php echo $municipio->id_municipio; ?>" value="<?php echo $municipio->nombre; ?>"><?php echo $municipio->nombre; ?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>
						<div class="form-group">
						    <label for="informe_fax_asistente">Telefono</label>
							<input type="tel" class="form-control" id="informe_fax_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_direccion_asistente">Dirección</label>
							<input type="dir" class="form-control" id="informe_direccion_asistente">
						</div>
						<div class="form-group">
						    <label for="informe_direccionCorreoElectronico_asistente">Correo Electrónico</label>
							<input type="email" class="form-control" id="informe_direccionCorreoElectronico_asistente">
						</div>
						<div class="form-group">
						<h4>Cabeza de familia?</h4>
							<label class="radio-inline"><input type="radio" id="cabezaradiosi" name="cabezaradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="cabezaradiono" name="cabezaradio" value="No" checked>No</label>
						</div>
						<div class="form-group">
						    <label for="informe_discapacidad_asistente">Tiene discapacidad, cual?</label>
							<input type="text" class="form-control" id="informe_discapacidad_asistente" value="No, Ninguna.">
						</div>
						<h4>Pertenenciente a alguna de las minorías étnicas del país?</h4>
						<div class="checkbox">
							<label><input name="indigenas_chekbox" id="indigenas_chekbox" type="checkbox">Indigenas</label>
							<label><input name="Rom_Gitanos_checkbox" id="Rom_Gitanos_checkbox" type="checkbox">Rom o Gitanos</label>
							<hr/>
							<p>AfroColombianos:</p>
							<label><input name="Afro_Negros_Mulatos_checkbox" id="Afro_Negros_Mulatos_checkbox" type="checkbox">Afrodescendientes, negros o mulatos</label>
							<label><input name="raizal_checkbox" id="raizal_checkbox" type="checkbox">Raizales</label>
							<label><input name="palenqueros_checkbox" id="palenqueros_checkbox" type="checkbox">Palenqueros</label>
						</div>
						<hr/>
						<h4>Pertenece a la Red Unidos?</h4>
						<div class="form-group">
							<label class="radio-inline"><input type="radio" id="redradiosi" name="redradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="redradiono" name="redradio" value="No" checked>No</label>
							<br>
						    <label for="">No. de folio Red Unidos</label>
							<input type="number" class="form-control" id="informe_folio_red_asistente" value="0">
						</div>
						<hr/>
						<h4>Esta registrado como víctima?</h4>
						<div class="form-group">
							<label class="radio-inline"><input type="radio" id="victimaradiosi" name="victimaradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="victimaradiono" name="victimaradio" value="No" checked>No</label>
							<br>
						    <label for="">No. RUV (Resgistro Unico  de Víctimas)</label>
							<input type="number" class="form-control" id="informe_ruv_asistente" value="0">
						</div>
						<hr/>
						<h4>Personas en proceso de reintegración?</h4>
						<div class="form-group">
							<label class="radio-inline"><input type="radio" id="reintegracionradiosi" name="reintegracionradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="reintegracionradiono" name="reintegracionradio" value="No" checked>No</label>
							<br>
						    <label for="">Número de certificado CODA (Comité Operativo Dejación de Armas)</label>
							<input type="number" class="form-control" id="informe_coda_asistente" value="0">
						</div>
						<hr/>
						<div class="form-group">
						    <label for="">Pertenece a algún tipo de población LGTBI?</label>
							<label class="radio-inline"><input type="radio" id="lgtbiradiosi" name="lgtbiradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="lgtbiradiono" name="lgtbiradio" value="No" checked>No</label>
						</div>
						<div class="form-group">
						    <label for="">Ejerce la prostitución?</label>
							<label class="radio-inline"><input type="radio" id="prostitucionradiosi" name="prostitucionradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="prostitucionradiono" name="prostitucionradio" value="No" checked>No</label>
						</div>
						<div class="form-group">
						    <label for="">Población privada de la libertad?</label>
							<label class="radio-inline"><input type="radio" id="libertadradiosi" name="libertadradio" value="Si">Si</label>
							<label class="radio-inline"><input type="radio" id="libertadradiono" name="libertadradio" value="No" checked>No</label>
						</div>
					</div>
				</div>
			</div>
		    <div class="modal-footer">
		        <button class="btn btn-danger pull-left informe_restaurar" id="informe_restaurar">Restaurar</button>
		    	<button type="button" class="btn btn-warning" id="informe_atras"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
		    	<button type="button" class="btn btn-siia" id="informe_siguiente">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		    	<button type="button" class="btn btn-danger hidden" id="informe_terminar">Terminar</button>
		    </div>
    	</div>
	</div>-->
</div>
<div class="modal fade" id="verCurso" tabindex="-1" role="dialog" aria-labelledby="vercurso">
	<div class="modal-dialog" role="document" style="width: 100%;">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="vercurso">Asistentes de: <label id="modal_vercurso_nombre"></label> </h3>
			</div>
			<div class="modal-body">
				<table id="tabla_asistentes_curso" width="100%" border=0 class="table table-striped table-bordered">
					<thead>
						<tr>
							<td><label>Primer Nombre</label></td>
							<td><label>Primer Apellido</label></td>
							<td><label>Tipo de Documento</label></td>
							<td><label>Número de Documento</label></td>
							<td><label>Proceso Beneficio</label></td>
							<td><label>Fecha de Finalización</label></td>
							<td><label>Edad</label></td>
							<td><label>Dirección Correo Electrónico</label></td>
							<td><label>Dirección</label></td>
							<td><label>Género</label></td>
							<td><label>Certificado</label></td>
						</tr>
					</thead>
					<tbody id="tbody_asistentes_curso">
					</tbody>
				</table>
				<div class="clearfix"></div>
				<hr />
				<div id="editarAsistenteDiv">
					<div class="container">
						<div class="row">
							<h4>Editando información de asistente: <small>Para el certificado</small></h4>
							<div class="col-md-6">
								<label class="hidden">ID: <span id="EdasisID"></span></label>
								<div class="form-group">
									<label for="editarAsisPN">Primer Nombre</label>
									<input type="text" class="form-control" id="editarAsisPN">
								</div>
								<div class="form-group">
									<label for="editarAsisSN">Segundo Nombre</label>
									<input type="text" class="form-control" id="editarAsisSN">
								</div>
								<div class="form-group">
									<label for="editarAsisPA">Primer Apellido</label>
									<input type="text" class="form-control" id="editarAsisPA">
								</div>
								<div class="form-group">
									<label for="editarAsisSA">Segundo Apellido</label>
									<input type="text" class="form-control" id="editarAsisSA">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tipo de Documento:</label><br>
									<select name="editarAsisTipo" id="editarAsisTipo" class="selectpicker form-control show-tick">
										<option id="1" value="CC">Cédula de Ciudadania</option>
										<option id="2" value="TI">Tarjeta de Identidad</option>
										<option id="3" value="CE">Cédula de Extranjeria</option>
										<option id="4" value="PS">Pasaporte</option>
									</select>
								</div>
								<div class="form-group">
									<label for="editarAsisNumero">Número de Documento</label>
									<input type="number" class="form-control" id="editarAsisNumero">
								</div>
								<div class="form-group">
									<label for="editarAsisDireccion">Dirección Correo Electrónico</label>
									<input type="email" class="form-control" id="editarAsisDireccion">
								</div>
								<button class="btn btn-siia" id="actualizarAsistente">Actualizar Asistente <i class="fa fa-check" aria-hidden="true"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger informe_restaurar">Cerrar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
