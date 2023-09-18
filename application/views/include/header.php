<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta http-equiv="refresh" content="7200" />
	<meta name="application-name" content="Sistema Integrado de Información de Acreditación - SIIA" />
	<meta name="description" content="Sistema Integrado de Información de Acreditación (SIIA) para entidades con interés de acreditarse en cursos de economía solidaria. Unidad Administrativa Especial de Organizaciones Solidarias." />
	<meta name="keywords" content="Organizaciones Solidarias,Sector Solidario,Cooperativas,Economía solidaria,Empresa,Social,Asociatividad,Emprendimiento,Proyectos productivos,Negocios inclusivos,Productores,Empresarios,Campesinos,Asociativo,Comercio justo,Agro,Ley 454" />
	<meta name="author" content="Unidad Solidaria" />
	<meta name="revisit-after" content="30 days" />
	<meta name="distribution" content="web" />
	<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW" />
	<!-- Styles -->
	<link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/styles.css?v=1.0.8.1919') ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/img/favicon16.png') ?>" type="image/png" sizes="16x16" rel="icon" />
	<link href="<?php echo base_url('assets/img/favicon32.png') ?>" type="image/png" sizes="32x32" rel="icon" />
	<link href="<?php echo base_url('assets/img/favicon64.png') ?>" type="image/png" sizes="64x64" rel="icon" />
	<link href="<?php echo base_url('assets/img/favicon128.png') ?>" type="image/png" sizes="128x128" rel="shortcut icon" />
	<link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
	<!-- Graficas //TODO: Charts Graficas para las estadisticas -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.js" integrity="sha512-XcsV/45eM/syxTudkE8AoKK1OfxTrlFpOltc9NmHXh3HF+0ZA917G9iG6Fm7B6AzP+UeEzV8pLwnbRNPxdUpfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<meta name="theme-color" content="#09476E" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" />
	<meta name="google-site-verification" content="DloHloB2_mQ9o7BPTd9xXEYHUeXrnWQqKGGKeuGrkLk" />
	<!-- Google -->
	<script src="https://www.google.com/recaptcha/api.js?render=6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef"></script>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-WHVM3FM');
	</script>
	<!-- Google Optimize -->
	<style>
		.async-hide {
			opacity: 0 !important
		}
	</style>
	<script>
		(function(a, s, y, n, c, h, i, d, e) {
			s.className += ' ' + y;
			h.start = 1 * new Date;
			h.end = i = function() {
				s.className = s.className.replace(RegExp(' ?' + y), '')
			};
			(a[n] = a[n] || []).hide = h;
			setTimeout(function() {
				i();
				h.end = null
			}, c);
			h.timeout = c;
		})(window, document.documentElement, 'async-hide', 'dataLayer', 4000, {
			'GTM-MX4WGRN': true
		});
	</script>
	<!-- End Google Tag Manager -->
	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-99079478-1', 'auto');
		ga('require', 'GTM-MX4WGRN');
		ga('send', 'pageview');
	</script>
	<!-- Title -->
	<title>Sistema Integrado de Información de Acreditación | <?php echo $title; ?></title>
</head>

<body class="nav-md">
	<div class="se-pre-con"></div>
	<!-- Cabecera y Navbar -->
	<header>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHVM3FM" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<section class="top-nav">
			<div class="container">
				<!-- <div class="row">
					<div class="col-md-12">
                    <h3 id="titulo_sistema"></h3>
                </div> -->
				<div class="col-md-12">
					<a href="https://www.gov.co/home/" target="_blank"><img src="<?php echo base_url(); ?>assets/img/govco.png" class="img-responsive" style="width: 1903px;margin-bottom: 2%;"></a>
				</div>
				<div class="col-md-6">
					<a href="<?php echo PAGINA_WEB ?>"><img alt="Unidad Solidaria" id="imagen_header" height="170px" width="350px" class="pull-left img-responsive" src="<?php echo base_url(); ?>assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png"></a>
				</div>
				<div class="col-md-6">
					<a href="<?php echo base_url(); ?>"><img alt="SIIA" id="imagen_header_sia" class="pull-right img-responsive" src="<?php echo base_url(); ?>assets/img/siia_logo.png"></a>
				</div>
			</div>
		</section>
		<div id="tPg" titulo="<?php echo $title; ?>"></div>
		<!-- Navbar Usuario no registrado //TODO: Navbar de usuario no registrado -->
		<?php
		if (!$logged_in && $tipo_usuario == "none") {
			echo "<div class='hidden' id='data_logg' data-log='$logged_in'></div>";
		?>
			<nav class="navbar navbar-dark">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a class="active" href="<?php echo base_url('home'); ?>">Home <i class="fa fa-home" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo base_url('estado'); ?>">Estado de la solicitud <i class="fa fa-eye" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo base_url('facilitadores'); ?>">Facilitadores válidos <i class="fa fa-users" aria-hidden="true"></i></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="<?php echo base_url('login'); ?>">Iniciar sesión <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo base_url('registro'); ?>">Registrarme <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		<?php
		}
		?>
		<!-- Cuerpo -->
		<div class="body">
			<div class="main_container" role="main">
				<!-- Navar Bar Usuario //TODO: Navbar usuario (Orgaizaciones) -->
				<?php
				if ($logged_in && $tipo_usuario == "user") {
					echo "<div class='hidden' id='data_logg' data-log='$logged_in'></div>";
				?>
					<div class="container">
						<ol class="breadcrumb col-md-12"></ol>
					</div>
					<!-- Navabar Contenido -->
					<div class="top_nav container">
						<div class="nav_menu">
							<h3 class="text-center col-md-7"><?php echo $title; ?></h3>
							<nav>
								<ul class="nav navbar-nav col-md-4 text-center nav-sia-panel">
									<!-- Fecha -->
									<li class="noSpaceLi"><a>| Fecha: <?php echo $fecha . " " . $hora; ?> |</a></li>
									<!-- Menu -->
									<li class="noSpaceLi">
										<a class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">| <?php echo $nombre_usuario; ?> <span class=" fa fa-angle-down"></span> |</a>
										<ul class="dropdown-menu dropdown-usermenu pull-right">
											<br>
											<li><a>Soporte ID: <strong><?php echo $usuario_id; ?></strong><br /> Nombre Usuario: <strong><?php echo $nombre_usuario; ?></strong></a></li>
											<hr />
											<caption> Menú:</caption>
											<li><a href="<?php echo base_url('panel'); ?>">Panel Principal <i class="fa fa-header" aria-hidden="true"></i></a></li>
											<li><a href="<?php echo base_url('panel/perfil'); ?>">Perfil <i class="fa fa-address-book-o" aria-hidden="true"></i></a></li>
											<li><a href="<?php echo base_url('panel/docentes'); ?>">Facilitadores <i class="fa fa-graduation-cap" aria-hidden="true"></i></a></li>
											<!-- <li><a href="javascript:;">Plan de Mejoramiento</a></li>
										<li><a href="javascript:;">Informe de Actividades</a></li> -->
											<li><a href="<?php echo base_url('panel/contacto/ayuda'); ?>">Ayuda <i class="fa fa-info" aria-hidden="true"></i></a></li>
											<hr />
											<li><a class='center-block' data-toggle='modal' data-target='#cerrar_sesion'>Cerrar Sesión <i class="fa fa-sign-out pull-right"></i></a></li>
											<br>
										</ul>
									</li>
									<!-- Notificaciones -->
									<li role="presentation" class="dropdown notificaciones noSpaceLi">
										<a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
											|
											<i class="fa fa-envelope-o"></i>
											<span class="badge bg-green">0</span>
											|
										</a>
										<!--<button class="btn btn-danger" data-toggle='modal' data-target='#cerrar_sesion'>Cerrar Sesión <i class="fa fa-sign-out"></i></button>-->
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<!-- Menu formulario acreditación //TODO: Menu Formulario para acreditación-->
					<?php if ($tipo_usuario == "user") { ?>

								<!-- <div class="col-md-12">
								<hr />
								<a class="col-md-1 ayuda" title="Ayuda">
									<span class="fa fa-question" aria-hidden="true"></span>
								</a>
								<a class="col-md-1 contacto" title="Contacto">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</a>
								<a class="col-md-1" title="Informe de Actividades">
									<i class="fa fa-file-text" aria-hidden="true"></i>
								</a>
								<a class="col-md-1" title="Plan de Mejoramiento">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i>
								</a>
								<a class="col-md-1" title="Docentes">
									<i class="fa fa-users" aria-hidden="true"></i>
								</a>
								<a class="col-md-1 ver_perfil" title="Perfil">
									<span class="fa fa-user" aria-hidden="true"></span>
								</a>
								<a data-toggle='modal' data-target='#cerrar_sesion' class="col-md-1" title="Cerrar Sesión">
									<span class="fa fa-sign-out" aria-hidden="true"></span>
								</a>
							</div> -->
							</div>
						</div>
					<?php } else {
						/** Nothing to do now **/
					} ?>
					<!-- Administrador   //TODO: Navbar para  Administradores-->
				<?php } else if ($logged_in && $tipo_usuario == "admin") {
					echo "<div class='hidden' id='data_logg' data-log='$logged_in' nvl='$nivel'></div>";
				?>
					<div class="container">
						<ol class="breadcrumb col-md-12"></ol>
					</div>
					<!-- Botón desblear observaciones -->
					<div class="icono--div">
						<a class="btn btn-siia btn-sm icono desOptSiia" role="button" title="Desplegar observaciones" data-toggle="tooltip" data-placement="right">Bateria de observaciones <i class="fa fa-expand" aria-hidden="true"></i></a>
					</div>
					<!-- Botón desblear registro de llamadas -->
					<div class="icono--div2">
						<a class="btn btn-siia btn-sm icono2 desOptSiia" role="button" title="Registro telefonico" data-toggle="tooltip" data-placement="right">Registro telefonico <i class="fa fa-phone" aria-hidden="true"></i></a>
					</div>
					<!-- Registro de llamadas //TODO: Registro de llamas para dividir de este archivo -->
					<div class="contenedor--menu2">
						<h3>Registro telefónico: <a class="icono2 desOptSiia pull-right" role="button" title="Registro telefonico"><i class="fa fa-times" aria-hidden="true"></i></a></h3>
						<br>
						<ul>
							<li><small><a class="underlined" target="_blank" href="<?php echo base_url("llamadas"); ?>">Editar llamadas <i class="fa fa-phone" aria-hidden="true"></i></a></small></li>
						</ul>
						<!-- <div class="radio">
							<label><input type="radio" name="registradoSistema" checked>No registrado en el sistema</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="registradoSistema">Registrado en el sistema</label>
						</div> -->
						<div class="formRegistroTelefonico" id="noRegisSiste">
							<div class="clearfix"></div>
							<!--<h3>No registrado en el sistema:</h3>-->
							<div class="form-group">
								<label>Nombres:</label>
								<input type="text" class="form-control" name="telefonicoNombre" id="telefonicoNombre" placeholder="Nombre...">
							</div>
							<div class="form-group">
								<label>Apellidos:</label>
								<input type="text" class="form-control" name="telefonicoApellidos" id="telefonicoApellidos" placeholder="Apellidos...">
							</div>
							<div class="form-group">
								<label>Cédula:</label>
								<input type="text" class="form-control" name="telefonicoCedula" id="telefonicoCedula" placeholder="Cédula...">
							</div>
							<div class="form-group">
								<label>Numero NIT:</label>
								<input type="text" class="form-control" name="telefonicoNit" id="telefonicoNit" placeholder="Numero de NIT...">
							</div>
							<div class="form-group">
								<label>Tipo de persona:</label>
								<select name="telefonicoTipoPersona" id="telefonicoTipoPersona" class="selectpicker form-control show-tick telefonicoTipoPersona" required="">
									<option id="1Natural" value="Natural">Natural</option>
									<option id="2Juridica" value="Juridica">Juridica</option>
								</select>
							</div>
							<div class="form-group">
								<label>Genéro:</label>
								<select name="telefonicoGenero" id="telefonicoGenero" class="selectpicker form-control show-tick telefonicoGenero" required="">
									<option id="1Hombre" value="Hombre">Hombre</option>
									<option id="2Mujer" value="Mujer">Mujer</option>
								</select>
							</div>
							<div class="form-group">
								<label>Departamento:</label>
								<!--<input type="text" class="form-control" name="telefonicoDepartamento" id="telefonicoDepartamento" placeholder="Departamento...">-->
								<select name="telefonicoDepartamento" id="telefonicoDepartamento" data-id-dep="6" class="selectpicker form-control show-tick departamentos" required="">
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
								<label>Municipio:</label>
								<!--<input type="text" class="form-control" name="telefonicoMunicipio" id="telefonicoMunicipio" placeholder="Municipio...">-->
								<div id="div_municipios6">
									<select name="telefonicoMunicipio" id="telefonicoMunicipio" class="selectpicker form-control show-tick municipios" required="">
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
								<label>Numero de contacto:</label>
								<input type="text" class="form-control" name="telefonicoNumeroContacto" id="telefonicoNumeroContacto" placeholder="Numero de contacto...">
							</div>
							<div class="form-group">
								<label>Correo de contacto:</label>
								<input type="text" class="form-control" name="telefonicoCorreoContacto" id="telefonicoCorreoContacto" placeholder="Correo de contacto...">
							</div>
							<div class="form-group">
								<label>Nombre de la organización:</label>
								<input type="text" class="form-control" name="telefonicoNombreOrganizacion" id="telefonicoNombreOrganizacion" placeholder="Nombre de la organización...">
							</div>
							<div class="form-group">
								<label>Tipo de organización:</label>
								<!--<input type="text" class="form-control" name="telefonicoTipoOrganizacion" id="telefonicoTipoOrganizacion" placeholder="Tipo de organización...">-->
								<select name="telefonicoTipoOrganizacion" id="telefonicoTipoOrganizacion" class="selectpicker form-control show-tick" required="">
									<option id="1" value="Asociación">Asociación</option>
									<option id="2" value="Asociación Mutual">Asociación Mutual</option>
									<option id="3" value="Cooperativa de Trabajo Asociado">Cooperativa de Trabajo Asociado</option>
									<option id="4" value="Cooperativa Especializada">Cooperativa Especializada</option>
									<option id="5" value="Cooperativa Integral">Cooperativa Integral</option>
									<option id="6" value="Cooperativa Multiactiva">Cooperativa Multiactiva</option>
									<option id="7" value="Corporación">Corporación</option>
									<option id="8" value="Empresa asociativa de trabajo">Empresa asociativa de trabajo</option>
									<option id="9" value="Empresa Comunitaria">Empresa Comunitaria</option>
									<option id="10" value="Empresa de servicios en forma de administración pública">Empresa de servicios en forma de administración pública</option>
									<option id="11" value="Empresa Solidaria de Salud">Empresa Solidaria de Salud</option>
									<option id="12" value="Federación y Confederación">Federación y Confederación</option>
									<option id="13" value="Fondo de empleados">Fondo de empleados</option>
									<option id="14" value="Fundación">Fundación</option>
									<option id="15" value="Institución Universitaria">Institución Universitaria</option>
									<option id="16" value="Instituciones auxiliares de Economía Solidaria">Instituciones auxiliares de Economía Solidaria</option>
									<option id="17" value="Precooperativa">Precooperativa</option>
								</select>
							</div>
							<div class="form-group">
								<label>Tema de consulta:</label>
								<input type="text" class="form-control" name="telefonicoTemaConsulta" id="telefonicoTemaConsulta" placeholder="Tema de consulta...">
							</div>
							<div class="form-group">
								<label>Descripcion de la consulta:</label>
								<textarea class="form-control" name="telefonicoDescripcionConsulta" id="telefonicoDescripcionConsulta" rows="8" placeholder="Descripcion de la consulta..."></textarea>
							</div>
							<div class="form-group">
								<label>Tipo de solicitud:</label>
								<input type="text" class="form-control" name="telefonicoTipoSolicitud" id="telefonicoTipoSolicitud" placeholder="Tipo de solicitud...">
							</div>
							<div class="form-group">
								<label>Canal de recepción:</label>
								<!--<input type="text" class="form-control" name="telefonicoCanalRecepcion" id="telefonicoCanalRecepcion" placeholder="Canal de recepción...">-->
								<select name="telefonicoCanalRecepcion" id="telefonicoCanalRecepcion" class="selectpicker form-control show-tick" required="">
									<option id="1" value="TELEFÓNICO">TELEFÓNICO</option>
									<option id="2" value="CORREO ELECTRÓNICO">CORREO ELECTRÓNICO</option>
								</select>
							</div>
							<div class="form-group">
								<label>Canal de respuesta:</label>
								<!--<input type="text" class="form-control" name="telefonicoCanalRespuesta" id="telefonicoCanalRespuesta" placeholder="Canal de recepción...">-->
								<select name="telefonicoCanalRespuesta" id="telefonicoCanalRespuesta" class="selectpicker form-control show-tick" required="">
									<option id="1" value="TELEFÓNICO">TELEFÓNICO</option>
									<option id="2" value="CORREO ELECTRÓNICO">CORREO ELECTRÓNICO</option>
								</select>
							</div>
							<div class="form-group">
								<label>Fecha:</label>
								<input type="date" class="form-control" name="telefonicoFecha" id="telefonicoFecha" value="<?php echo date('Y-m-d'); ?>">
							</div>
							<div class="form-group">
								<label>Duración (05 45):</label>
								<input type="text" class="form-control" name="telefonicoDuracion" id="telefonicoDuracion" placeholder="Duración...">
							</div>
							<div class="form-group">
								<label>Hora (10 56 PM):</label>
								<input type="text" class="form-control" name="telefonicoHora" id="telefonicoHora" placeholder="Hora...">
							</div>
							<button id="guardarRegistroTelefonico" class="btn btn-siia btn-sm btn-block">Guardar registro <i class="fa fa-check" aria-hidden="true"></i></button>
						</div>
					</div>
					<!-- Bateria de Observaciones //TODO: Bateria de observaciones para dividir de estar archivo -->
					<div class="contenedor--menu">
						<ul class="menu">
							<h4>Bateria de observaciones:</h4>
							<hr />
							<div class="col-md-12">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Buscar..." id="buscarObsText" />
									<span class="clearInput"><i class="fa fa-times" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="clearfix"></div>
							<hr />
							<div id="divBateriaObservaciones">
								<li id="1bat"><a class="menu__enlace">1. Información General de la Entidad <i class="fa fa-home" aria-hidden="true"></i></a></li>
								<li id="2bat"><a class="menu__enlace">2. Documentación Legal <i class="fa fa-book" aria-hidden="true"></i></a></li>
								<li id="3bat"><a class="menu__enlace">3. Registros educativos de Programas <i class="fa fa-book" aria-hidden="true"></i></a></li>
								<li id="4bat"><a class="menu__enlace">4. Antecedentes Académicos <i class="fa fa-id-card" aria-hidden="true"></i></a></li>
								<li id="5bat"><a class="menu__enlace">5. Jornadas de actualización <i class="fa fa-handshake-o" aria-hidden="true"></i></a></li>
								<li id="6bat"><a class="menu__enlace">6. Programa básico de economía solidaria <i class="fa fa-server" aria-hidden="true"></i></a></li>
								<li id="7bat"><a class="menu__enlace">7. Programas Aval <i class="fa fa-sitemap" aria-hidden="true"></i></a></li>
								<li id="8bat"><a class="menu__enlace">8. Programas <i class="fa fa-signal" aria-hidden="true"></i></a></li>
								<li id="9bat"><a class="menu__enlace">9. Facilitadores <i class="fa fa-users" aria-hidden="true"></i></a></li>
								<li id="10bat"><a class="menu__enlace">10. Datos Plataforma Virtual <i class="fa fa-globe" aria-hidden="true"></i></a></li>
								<li id="11bat"><a class="menu__enlace">Observaciones Generales</a>
							</div>
						</ul>
					</div>
					<!-- Navbar Administrador //TODO: Navbar para administrador :Corregir permisos según tipo de administrador -->
					<div class="top_nav container">
						<div class="nav_menu">
							<!-- Titulo -->
							<h3 class="text-center col-md-7"><?php echo $title; ?></h3>
							<nav>
								<ul class="nav navbar-nav col-md-4 text-center nav-sia-panel">
									<!-- Fecha -->
									<li class="noSpaceLi"><a>| Fecha: <?php echo $fecha . " " . $hora; ?> |</a></li>
									<!-- Menu -->
									<li class="noSpaceLi">
										<a class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">| <?php echo $nombre_usuario; ?> <span class=" fa fa-angle-down"></span> |</a>
										<ul class="dropdown-menu dropdown-usermenu pull-right">
											<br>
											<li><a>Soporte ID: <strong><?php echo $usuario_id; ?></strong> <br /> Nombre Usuario: <strong><?php echo $nombre_usuario; ?></strong></a></li>
											<hr />
											<caption> Menú:</caption>
											<li><a href="<?php echo base_url('panelAdmin'); ?>">Panel principal</a></li>
											<li><a href="<?php echo base_url('panelAdmin/reportes'); ?>">Reportes</a></li>
											<li><a href="<?php echo base_url('panelAdmin/organizaciones'); ?>">Organizaciones</a></li>
											<ul>
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/inscritas'); ?>">Organizaciones inscritas</a></li>
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/solicitudes/finalizadas'); ?>">Organizaciones en evaluación</a></li>
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/solicitudes/observaciones'); ?>">Organizaciones en complementaria</a></li>
												<hr />
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/docentes'); ?>">Facilitadores</a></li>
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/estadoOrganizaciones'); ?>">Estado organizaciones</a></li>
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/resoluciones'); ?>">Resoluciones</a></li>
												<li><a href="<?php echo base_url('panelAdmin/organizaciones/camaraComercio'); ?>">Camara de comercio</a></li>
											</ul>
											<li><a href="<?php echo base_url('panelAdmin/historico'); ?>">Histórico</a></li>
											<li><a href="<?php echo base_url('panelAdmin/seguimiento'); ?>">Seguimientos</a></li>
											<li><a href="<?php echo base_url('panelAdmin/opciones'); ?>">Operaciones</a></li>
											<li><a href="<?php echo base_url('panelAdmin/socrata'); ?>">Datos abiertos</a></li>
											<li><a href="<?php echo base_url('panelAdmin/contacto'); ?>">Contacto</a></li>
											<hr />
											<li><a class='center-block' data-toggle='modal' data-target='#cerrar_sesion_admin'>Cerrar Sesión <i class="fa fa-sign-out pull-right"></i></a></li>
											<br>
										</ul>
									</li>
									<!-- Notificaciones -->
									<li role="presentation" class="dropdown notificaciones noSpaceLi">
										<a class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
											|
											<i class="fa fa-envelope-o"></i>
											<span class="badge bg-green">0</span>
											|
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				<?php } ?>
	</header>
