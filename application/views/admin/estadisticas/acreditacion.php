<!-- Division -->
<div class="container">
	<div class="clearfix"></div>
	<hr />
</div>
<!-- Dashboard Menu -->
<div class="container center-block">
	<!-- Reportes -->
	<!-- <div class="col-md-3 admin_reportes">
		<div class="panel panel-siia">
			<div class="panel-heading">
				<h3 class="panel-title">Reportes SIIA <i class="fa fa-flag" aria-hidden="true"></i></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-default btn-block form-control" id="admin_reportes">Reportes </button>
			</div>
		</div>
	</div> -->
	<!-- <div class="col-lg-4 col-md-4 col-sm-6">
		<div class="card">
			<div class="card-image"></div>
			<div class="card-text">
				<span class="date">4 days ago</span>
				<h2>Entidades acreditadas</h2>
				<p>Lorem ipsum dolor sit amet consectetur, Ducimus, repudiandae temporibus omnis illum maxime quod deserunt eligendi dolor</p>
			</div>
			<div class="card-stats">
				<div class="stat">
					<div class="value">4<sup>m</sup></div>
					<div class="type">read</div>
				</div>
				<div class="stat border">
					<div class="value">5123</div>
					<div class="type">views</div>
				</div>
				<div class="stat">
					<div class="value">32</div>
					<div class="type">comments</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="col-sm-10">
		<div class="row" style="text-align: justify;">
			<div class="col-sm-12">
				<p>Procedimiento administrativo mediante el cual la UAEOS - Unidad Administrativa Especial de Organizaciones Solidarias, autoriza a las organizaciones que cumplen los requisitos establecidos, para impartir el curso de economía solidaria y expedir los certificados válidos para cumplir con el requisito previo al registro de las organizaciones de economía solidaria ante los entes. Numeral 3 del artículo 2 de la resolución 110 de 2016.</p>
			</div>
			<div class="filtrosAcreditacion row">
				<div class="form-group col-lg-2">
					<label>Tipo de información</label>
					<select name="tipoInformacion" class="form-control" id="tipoInformacion">
						<option value="">Seleccione una opción</option>
						<option value="acreditadas">Acreditadas</option>
						<option value="cursoBasico">Curso Basico</option>
						<option value="avaladas">Avaladas</option>
						<option value="modalidadVirtual">Modalidad Virtual</option>
					</select>
				</div>
				<div class="form-group col-lg-2">
					<label>Departamento</label>
					<select name="departamentoAcreditacion" class="form-control departamentoAcreditacion">
						<option value="">Seleccione una opción</option>
					</select>
				</div>
				<div class="form-group col-lg-2">
					<label>Municipio</label>
					<select name="municipioAcreditacion" class="form-control municipioAcreditacion">
						<option value="">Seleccione una opción</option>
					</select>
				</div>
				<div class="form-group col-lg-2">
					<label>Tipo Organización</label>
					<select name="tipoOrgAcreditacion" class="form-control tipoOrgAcreditacion">
						<option value="">Seleccione una opción</option>
					</select>
				</div>
				<div class="col-lg-2">
					<button class="btn btn-info reinciarFiltro" style="margin-top:30px;">Reiniciar Filtros</button>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<section class="col-sm-12">
					<!-- Custom tabs (Charts with tabs)-->
					<div class="card">
						<div class="card-header" style="background: #3266cc;color: white;">
							<h3 class="card-title">
								<a class="verOrganizaciones">Datos</a>
							</h3>
						</div><!-- /.card-header -->
						<div class="bodyChart row card-body">
							<section class="fichaUno col-lg-6">
								<div class="card">
									<div class="card-header" style="background: #d6e0f5;"><strong>Total Organizaciones</strong></div>
									<div class="card-body">
										<p class="textoStats totalOrgAcreditacion"></p>
									</div>
								</div>

								<div class="card cardFichaTipoOrg">
									<div class="card-header" style="background: #d6e0f5;"><strong>Tipo de Organización</strong></div>
									<div class="card-body orgTipo"></div>
								</div>
							</section>

							<section class="col-lg-6 fichaDos" style="">
								<div class="card">
									<div class="card-header" style="background: #d6e0f5;"><strong>Organizaciones por Ubicación</strong></div>
									<div class="card-body orgDpto"></div>
								</div>
							</section>

						</div>
					</div>
				</section>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" role="dialog" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
						<table class="table">
							<thead>
								<tr>
									<th>Nombre Organización</th>
								</tr>
							</thead>
							<tbody class="tableStats">
								<tr>
									<td>CENTRAL DE INTEGRACIÓN Y CAPACITACIÓN COOPERATIVA</td>
								</tr>
								<tr>
									<td>FUNDACIÓN DE COPIDROGAS PARA LA EDUCACIÓN Y LA ASESORÍA TÉCNICA</td>
								</tr>
								<tr>
									<td>Fundación CSE Progresa</td>
								</tr>
								<tr>
									<td>Cooperativa de Trabajadores de Avianca</td>
								</tr>
								<tr>
									<td>Fundación Centro de Educación y Desarrollo Solidario</td>
								</tr>
								<tr>
									<td>Fundación Coopcentral</td>
								</tr>
								<tr>
									<td>CORPORACIÓN UNIVERSITARIA MINUTO DE DIOS</td>
								</tr>
								<tr>
									<td>Organismo Cooperativo Microempresarial de Colombia - Emprender</td>
								</tr>
								<tr>
									<td>Cooperativa de profesionales COASMEDAS</td>
								</tr>
								<tr>
									<td>GRUPO EMPRESARIAL SOLIDARIO</td>
								</tr>
								<tr>
									<td>CORPORACIÓN LATINOAMERICANA PARA EL DESARROLLO DEL EMPRENDIMIENTO ASOCIATIVO LA CIENCIA Y LA TECNOLOGIA</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>



	</div>


</div>



<!-- <canvas id="myChart" width="40" height="40"></canvas>

<script>
	var ctx = document.getElementById('myChart');
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ['2018', '2019', '2020', '2021'],
			datasets: [{
				label: '# of Votes',
				data: [2, 4, 3, 5],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script> -->
