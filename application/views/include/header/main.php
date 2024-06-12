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
	<!-- DataTables	-->
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
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
				<!-- partial:../../partials/_settings-panel.html -->
				<div class="theme-setting-wrapper">
					<!--	Botón ajustes visuales-->
					<!--	<div id="settings-trigger"><i class="ti-settings"></i></div>-->
					<div id="theme-settings" class="settings-panel">
						<i class="settings-close ti-close"></i>
						<p class="settings-heading">SIDEBAR SKINS</p>
						<div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
						<div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
						<p class="settings-heading mt-2">HEADER SKINS</p>
						<div class="color-tiles mx-0 px-4">
							<div class="tiles success"></div>
							<div class="tiles warning"></div>
							<div class="tiles danger"></div>
							<div class="tiles info"></div>
							<div class="tiles dark"></div>
							<div class="tiles default"></div>
						</div>
					</div>
				</div>
				<div id="right-sidebar" class="settings-panel">
					<i class="settings-close ti-close"></i>
					<ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
						</li>
					</ul>
					<div class="tab-content" id="setting-content">
						<div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
							<div class="add-items d-flex px-3 mb-0">
								<form class="form w-100">
									<div class="form-group d-flex">
										<input type="text" class="form-control todo-list-input" placeholder="Add To-do">
										<button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
									</div>
								</form>
							</div>
							<div class="list-wrapper px-3">
								<ul class="d-flex flex-column-reverse todo-list">
									<li>
										<div class="form-check">
											<label class="form-check-label">
												<input class="checkbox" type="checkbox">
												Team review meeting at 3.00 PM
											</label>
										</div>
										<i class="remove ti-close"></i>
									</li>
									<li>
										<div class="form-check">
											<label class="form-check-label">
												<input class="checkbox" type="checkbox">
												Prepare for presentation
											</label>
										</div>
										<i class="remove ti-close"></i>
									</li>
									<li>
										<div class="form-check">
											<label class="form-check-label">
												<input class="checkbox" type="checkbox">
												Resolve all the low priority tickets due today
											</label>
										</div>
										<i class="remove ti-close"></i>
									</li>
									<li class="completed">
										<div class="form-check">
											<label class="form-check-label">
												<input class="checkbox" type="checkbox" checked>
												Schedule meeting for next week
											</label>
										</div>
										<i class="remove ti-close"></i>
									</li>
									<li class="completed">
										<div class="form-check">
											<label class="form-check-label">
												<input class="checkbox" type="checkbox" checked>
												Project review
											</label>
										</div>
										<i class="remove ti-close"></i>
									</li>
								</ul>
							</div>
							<h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
							<div class="events pt-4 px-3">
								<div class="wrapper d-flex mb-2">
									<i class="ti-control-record text-primary mr-2"></i>
									<span>Feb 11 2018</span>
								</div>
								<p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
								<p class="text-gray mb-0">The total number of sessions</p>
							</div>
							<div class="events pt-4 px-3">
								<div class="wrapper d-flex mb-2">
									<i class="ti-control-record text-primary mr-2"></i>
									<span>Feb 7 2018</span>
								</div>
								<p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
								<p class="text-gray mb-0 ">Call Sarah Graves</p>
							</div>
						</div>
						<!-- To do section tab ends -->
						<div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
							<div class="d-flex align-items-center justify-content-between border-bottom">
								<p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
								<small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
							</div>
							<ul class="chat-list">
								<li class="list active">
									<div class="profile"><img src="<?= base_url('assets/img/images/faces/face1.jpg')?>" alt="image"><span class="online"></span></div>
									<div class="info">
										<p>Thomas Douglas</p>
										<p>Available</p>
									</div>
									<small class="text-muted my-auto">19 min</small>
								</li>
								<li class="list">
									<div class="profile"><img src="<?= base_url('assets/img/images/faces/face2.jpg')?>" alt="image"><span class="offline"></span></div>
									<div class="info">
										<div class="wrapper d-flex">
											<p>Catherine</p>
										</div>
										<p>Away</p>
									</div>
									<div class="badge badge-success badge-pill my-auto mx-2">4</div>
									<small class="text-muted my-auto">23 min</small>
								</li>
								<li class="list">
									<div class="profile"><img src="<?= base_url('assets/img/images/faces/face3.jpg')?>" alt="image"><span class="online"></span></div>
									<div class="info">
										<p>Daniel Russell</p>
										<p>Available</p>
									</div>
									<small class="text-muted my-auto">14 min</small>
								</li>
								<li class="list">
									<div class="profile"><img src="<?= base_url('assets/img/images/faces/face4.jpg')?>" alt="image"><span class="offline"></span></div>
									<div class="info">
										<p>James Richardson</p>
										<p>Away</p>
									</div>
									<small class="text-muted my-auto">2 min</small>
								</li>
								<li class="list">
									<div class="profile"><img src="<?= base_url('assets/img/images/faces/face5.jpg')?>" alt="image"><span class="online"></span></div>
									<div class="info">
										<p>Madeline Kennedy</p>
										<p>Available</p>
									</div>
									<small class="text-muted my-auto">5 min</small>
								</li>
								<li class="list">
									<div class="profile"><img src="<?= base_url('assets/img/images/faces/face6.jpg')?>" alt="image"><span class="online"></span></div>
									<div class="info">
										<p>Sarah Graves</p>
										<p>Available</p>
									</div>
									<small class="text-muted my-auto">47 min</small>
								</li>
							</ul>
						</div>
						<!-- chat tab ends -->
					</div>
				</div>
				<!-- partial sidebar -->
				<!-- partial:../../partials/_sidebar.html -->
		<?php
				$this->load->view('include/partial/_sidebar', $data);
			endif; ?>

