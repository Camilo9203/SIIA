<?php
/***
 * @var $activeLink
 * @var $logo
 * @var $data_organizacion
 * @var $title
 * @var $logged_in
 * @var $tipo_usuario
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta http-equiv="refresh" content="7200" />
	<meta name="application-name" content="Sistema Integrado de Información de Acreditación - SIIA" />
	<meta name="description" content="Sistema Integrado de Información de Acreditación (SIIA) para entidades con interés de acreditarse en cursos de economía solidaria. Unidad Administrativa Especial de Organizaciones Solidarias." />
	<meta name="keywords" content="Organizaciones Solidarias,Sector Solidario,Cooperativas,Economía solidaria,Empresa,Social,Asociatividad,Emprendimiento,Proyectos productivos,Negocios inclusivos,Productores,Empresarios,Campesinos,Asociativo,Comercio justo,Agro,Ley 454" />
	<meta name="author" content="Unidad Administrativa Especial Organizaciones Solidarias - UAEOS" />
	<meta name="revisit-after" content="30 days" />
	<meta name="distribution" content="web" />
	<meta name="ROBOTS" content="INDEX, FOLLOW" />
	<!-- Styles -->
	<link href="<?= base_url('assets/css/style.css?v=1.0.8.1919') ?>" rel="stylesheet" type="text/css" />
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url('assets/img/favicon16.png') ?>" type="image/png" sizes="16x16" />
	<link rel="shortcut icon" href="<?= base_url('assets/img/favicon32.png') ?>" type="image/png" sizes="32x32" />
	<link rel="shortcut icon" href="<?= base_url('assets/img/favicon64.png') ?>" type="image/png" sizes="64x64" />
	<link rel="shortcut icon" href="<?= base_url('assets/img/favicon128.png') ?>" type="image/png" sizes="128x128" />
	<link href="https://fonts.googleapis.com/css?family=Dosis&display=swap" rel="stylesheet">
	<meta name="theme-color" content="#09476E" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" />
	<meta name="google-site-verification" content="DloHloB2_mQ9o7BPTd9xXEYHUeXrnWQqKGGKeuGrkLk" />
	<!-- Datapicker	-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<!-- SelectPicker	-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<!-- DataTables	-->
	<link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/date-1.5.2/sl-2.0.3/datatables.min.css" rel="stylesheet">
	<!-- Dashboard	-->
	<link rel="stylesheet" href="<?= base_url('assets/js/dashboard/vendors/feather/feather.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/dashboard/vendors/ti-icons/css/themify-icons.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/dashboard/vendors/css/vendor.bundle.base.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/dashboard/css/vertical-layout-light/style.css') ?>">
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url('assets/js/dashboard/vendors/select2/select2.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/dashboard/vendors/mdi/css/materialdesignicons.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/js/dashboard/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') ?>">
	<!--Start of Tawk.to Script-->
	<?php if ($logged_in == FALSE && $tipo_usuario == "none"): ?>
		<script type="text/javascript">
			var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
				var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
				s1.async=true;
				s1.src='https://embed.tawk.to/624281002abe5b455fc21567/1fv9sfqn8';
				s1.charset='UTF-8';
				s1.setAttribute('crossorigin','*');
				s0.parentNode.insertBefore(s1,s0);
			})();
		</script>
	<?php endif; ?>
	<!--End of Tawk.to Script-->
	<!-- Google -->
	<script src="https://www.google.com/recaptcha/api.js?render=6LeTFnYnAAAAAKl5U_RbOYnUbGFGlhG4Ffn52Sef"></script>
	<!-- Title -->
	<title>Sistema Integrado de Información de Acreditación | <?= $title; ?></title>
</head>
<body class="nav-md">
	<div class="container-scroller">
		<?= "<div class='hidden' id='data_logg' data-log='$logged_in'></div>" ?>
		<!-- Navbar Usuario no registrado -->
		<?php
			// Datos enviados a menu y navbar
			$data = array('tipo_usuario' => $tipo_usuario, 'logged_in' => $logged_in, 'activeLink' => $activeLink, 'organizacion', $data_organizacion);
			// Comprobar si esta iniciada la sesión
			if ($logged_in != FALSE && $tipo_usuario != "none"):
				$this->load->view('include/partial/_navbar', $data); ?>
			<!-- partial ajustes visuales-->
			<div class="container-fluid page-body-wrapper">
			<?php $this->load->view('include/partial/_sidebar', $data); endif; ?>
