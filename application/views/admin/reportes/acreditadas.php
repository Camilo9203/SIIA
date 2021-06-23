<?php // echo '<pre>'; var_dump($organizacionesAcreditadas); echo '</pre>';
?>

<div class="col-md-12">
	<div class="clearfix"></div>
	<hr />
	<h3>Organizaciones Acreditadas:</h3>
	<table id="tabla_enProceso_organizacion" width="100%" border=0 class="table table-striped table-bordered tabla_form">
		<thead>
			<tr>
				<td class="col-md-1">NOMBRE DE LA ORGANIZACIÓN</td>
				<!--<td>SIGLA</td>-->
				<td class="col-md-1">NÚMERO NIT</td>
				<!--<td>ESTADO ACTUAL</td>
				<td>FECHA CAMBIO DE ESTADO</td>-->
				<td class="col-md-1">TIPO DE ORGANIZACIÓN</td>
				<td class="col-md-1">CURSOS APROBADOS</td>
				<td class="col-md-1">MODALIDAD APROBADA PARA EL CURSO</td>
				<td class="col-md-1">RESOLUCIÓN</td>
				<td class="col-md-1">FECHA DE VENCIMIENTO DE LA ACREDITACIÓN</td>
				<td>DEPARTAMENTO</td>
				<td class="col-md-1">MUNICIPIO</td>
				<td class="col-md-1">DIRECCIÓN</td>
				<td class="col-md-1">TELÉFONO</td>
				<!--<td>EXTENSIÓN</td>-->
				<td class="col-md-1">DIRECCIÓN URL</td>
				<!--<td>ACTUACIÓN</td>-->
				<!--<td>TIPO DE EDUCACIÓN</td>
				<td>TIPO DE SOLICITUD ACTUAL</td>
				<td>MOTIVO DE LA SOLICITUD ACTUAL</td>
				<td>MODALIDAD APROBADA ACTUAL</td>
				<td>REPRESENTANTE LEGAL</td>-->
				<!--<td>NÚMERO CEDULA REPRESENTANTE LEGAL</td>-->
				<td class="col-md-1">CORREO ELECTRÓNICO ORGANIZACIÓN</td>
				<!--<td>CORREO ELECTRÓNICO REPRESENTANTE LEGAL</td>-->
				<!--<td>FECHA DE INICIO DE LA RESOLUCIÓN</td>-->
				<!-- <td>URL Resolución</td> -->
			</tr>
		</thead>
		<tbody id="tbody">
			<?php
			for ($i = 0; $i < count($organizacionesAcreditadas); $i++) {
				echo "<tr>";
				echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones"]->nombreOrganizacion . "</td>");
				/*if($organizacionesAcreditadas[$i]["data_organizaciones"] ->sigla == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones"] ->sigla."</td>");
				}*/
				if ($organizacionesAcreditadas[$i]["data_organizaciones"]->numNIT == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones"]->numNIT . "</td>");
				}
				//echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_est"] ->nombre."</td>");
				//echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_est"] ->fecha."</td>");
				if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->tipoOrganizacion == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->tipoOrganizacion . "</td>");
				}
				for ($j = 0; $j < count($organizacionesAcreditadas[$i]["resoluciones"]); $j++) {
					//echo json_encode($organizacionesAcreditadas[$j]["resoluciones"]);
					if ($organizacionesAcreditadas[$i]["resoluciones"]->cursoAprobado == "") {
						echo strtoupper("<td>Falta por actualizar datos...</td>");
					} else {
						echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["resoluciones"]->cursoAprobado . "</td>");
					}
				}
				for ($j = 0; $j < count($organizacionesAcreditadas[$i]["resoluciones"]); $j++) {
					if ($organizacionesAcreditadas[$i]["resoluciones"]->modalidadAprobada == "") {
						echo strtoupper("<td>Falta por actualizar datos...</td>");
					} else {
						echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["resoluciones"]->modalidadAprobada . "</td>");
					}
				}
				for ($j = 0; $j < count($organizacionesAcreditadas[$i]["resoluciones"]); $j++) {
					if ($organizacionesAcreditadas[$i]["resoluciones"]->numeroResolucion == "") {
						if ($organizacionesAcreditadas[$i]["resoluciones"]->fechaFinalizacion != "") {
							echo "<td><a href='" . base_url("uploads/resoluciones/" . $organizacionesAcreditadas[$i]["resoluciones"]->resolucion) . "' target='_blank'>RESOLUCIÓN NÚMERO " . $organizacionesAcreditadas[$i]["resoluciones"]->numeroResolucion . "</a></td>";
						} else {
							echo strtoupper("<td>Falta por actualizar datos...</td>");
						}
					} else {
						echo "<td><a href='" . base_url("uploads/resoluciones/" . $organizacionesAcreditadas[$i]["resoluciones"]->resolucion) . "' target='_blank'>RESOLUCIÓN NÚMERO " . $organizacionesAcreditadas[$i]["resoluciones"]->numeroResolucion . " DEL " . date('Y', strtotime($organizacionesAcreditadas[$i]["resoluciones"]->fechaResolucionInicial)) . "</a></td>";
					}
				}
				/*if($organizacionesAcreditadas[$i]["resoluciones"] ->añosResolucion == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["resoluciones"] ->añosResolucion."</td>");
				}
				if($organizacionesAcreditadas[$i]["resoluciones"] ->añosResolucion == "" && $organizacionesAcreditadas[$i]["resoluciones"] ->fechaResolucionInicial == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["resoluciones"] ->fechaResolucionInicial."</td>");
				}*/
				if ($organizacionesAcreditadas[$i]["resoluciones"]->añosResolucion == "" && $organizacionesAcreditadas[$i]["resoluciones"]->fechaResolucionInicial == "") {
					if ($organizacionesAcreditadas[$i]["data_organizaciones"]->fechaFinalizacion != "") {
						echo strtoupper("<td>" . date('Y-m-d', strtotime($organizacionesAcreditadas[$i]["data_organizaciones"]->fechaFinalizacion)) . "</td>");
					} else {
						echo strtoupper("<td>Falta por actualizar datos...</td>");
					}
				} else {
					echo strtoupper("<td>" . date('d-m-Y', strtotime("+" . $organizacionesAcreditadas[$i]["resoluciones"]->añosResolucion . " year", strtotime($organizacionesAcreditadas[$i]["resoluciones"]->fechaResolucionInicial))) . "</td>");
				}
				if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->nomDepartamentoUbicacion == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->nomDepartamentoUbicacion . "</td>");
				}
				if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->nomMunicipioNacional == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->nomMunicipioNacional . "</td>");
				}
				if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->direccionOrganizacion == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->direccionOrganizacion . "</td>");
				}
				if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->fax == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->extension == "No Tiene") {
						echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->fax . "</td>");
					} else {
						echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->fax . " - EXT: " . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->extension . "</td>");
					}
				}
				if ($organizacionesAcreditadas[$i]["data_organizaciones_inf"]->urlOrganizacion == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones_inf"]->urlOrganizacion . "</td>");
				}
				//echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_inf"] ->actuacionOrganizacion."</td>");
				/*if($organizacionesAcreditadas[$i]["data_organizaciones_inf"] ->tipoEducacion == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_inf"] ->tipoEducacion."</td>");
				}*/
				/*if($organizacionesAcreditadas[$i]["data_organizaciones_est"] ->tipoSolicitud == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else if($organizacionesAcreditadas[$i]["data_organizaciones_est"] ->tipoSolicitud == "Eliminar"){
					echo strtoupper ("<td>Actualmente no tiene ninguna solicitud.</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_est"] ->tipoSolicitud."</td>");
				}
				if($organizacionesAcreditadas[$i]["data_organizaciones_est"] ->motivoSolicitud == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else if($organizacionesAcreditadas[$i]["data_organizaciones_est"] ->motivoSolicitud == "Eliminar"){
					echo strtoupper ("<td>Actualmente no tiene ninguna solicitud.</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_est"] ->motivoSolicitud."</td>");
				}
				if($organizacionesAcreditadas[$i]["data_organizaciones_est"] ->modalidadSolicitud == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else if($organizacionesAcreditadas[$i]["data_organizaciones_est"] ->modalidadSolicitud == "Eliminar"){
					echo strtoupper ("<td>Actualmente no tiene ninguna solicitud.</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_est"] ->modalidadSolicitud."</td>");
				}
				if($organizacionesAcreditadas[$i]["data_organizaciones"] ->primerNombreRepLegal == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones"] ->primerNombreRepLegal." ".$organizacionesAcreditadas[$i]["data_organizaciones"] ->segundoNombreRepLegal." ".$organizacionesAcreditadas[$i]["data_organizaciones"] ->primerApellidoRepLegal." ".$organizacionesAcreditadas[$i]["data_organizaciones"] ->segundoApellidoRepLegal."</td>");
				}*/
				/*if($organizacionesAcreditadas[$i]["data_organizaciones_inf"] ->numCedulaCiudadaniaPersona == ""){
					echo strtoupper ("<td>Falta por actualizar datos...</td>");
				}else{
					echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones_inf"] ->numCedulaCiudadaniaPersona."</td>");
				}*/
				if ($organizacionesAcreditadas[$i]["data_organizaciones"]->direccionCorreoElectronicoOrganizacion == "") {
					echo strtoupper("<td>Falta por actualizar datos...</td>");
				} else {
					echo strtoupper("<td>" . $organizacionesAcreditadas[$i]["data_organizaciones"]->direccionCorreoElectronicoOrganizacion . "</td>");
				}
				//echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["data_organizaciones"] ->direccionCorreoElectronicoRepLegal."</td>");
				//echo strtoupper ("<td>".$organizacionesAcreditadas[$i]["resoluciones"] ->fechaResolucionInicial."</td>");
				/*if($organizacionesAcreditadas[$i]["resoluciones"] ->numeroResolucion == ""){
					if($organizacionesAcreditadas[$i]["data_organizaciones"] ->fechaFinalizacion != ""){
						echo "<td>".base_url("uploads/resoluciones/".$organizacionesAcreditadas[$i]["resoluciones"] ->resolucion)."</td>";
					}else{
						echo strtoupper ("<td>Falta por actualizar datos...</td>");
					}
				}else{
					echo "<td>".base_url("uploads/resoluciones/".$organizacionesAcreditadas[$i]["resoluciones"] ->resolucion)."</td>";
				}*/
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<button class="btn btn-danger btn-sm volverReporte">Volver al panel</button>
</div>
