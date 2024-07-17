<!-- partial:../../partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
		<a class="navbar-brand brand-logo mr-5" href="<?= base_url('super/panel')?>"><img src="<?= base_url('assets/img/siia_logo.png') ?>" class="mr-2" alt="logo"/></a>
		<a class="navbar-brand brand-logo-mini" href="<?= base_url('super/panel')?>"><img src="<?= base_url('assets/img/siia_logo_ico.png') ?>" class="mr-2" alt="logo"/></a>
	</div>
	<!-- Botón responsive -->
	<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="icon-menu"></span>
		</button>
		<!-- Perfil y cerrar sesión -->
		<ul class="navbar-nav navbar-nav-right">
			<!-- Notifications TODO: Validar según usuario -->
			<li class="nav-item dropdown">
				<!-- Icon -->
				<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
					<i class="icon-bell mx-0"></i> 3
					<span class="count"></span>
				</a>
				<!-- Items TODO: Realizar foreach con notificaciones y tipo -->
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
					<p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
					<a class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-success">
								<i class="ti-info-alt mx-0"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<h6 class="preview-subject font-weight-normal">Solicitudes terminadas</h6>
							<p class="font-weight-light small-text mb-0 text-muted">
								Hace 5 minutos
							</p>
						</div>
					</a>
					<a class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-warning">
								<i class="ti-settings mx-0"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<h6 class="preview-subject font-weight-normal">Alertas</h6>
							<p class="font-weight-light small-text mb-0 text-muted">
								Solicitudes pendientes por evaluar
							</p>
						</div>
					</a>
					<a class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-info">
								<i class="ti-user mx-0"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<h6 class="preview-subject font-weight-normal">Usuarios nuevos</h6>
							<p class="font-weight-light small-text mb-0 text-muted">
								Hace 2 días
							</p>
						</div>
					</a>
				</div>
			</li>
			<!-- Profile -->
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" id="profileDropdown">
					<img src="<?= base_url('assets/img/default.png')?>" alt="profile"/>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
					<a href="<?= base_url('super/perfil')?>" class="dropdown-item">
						<i class="ti-settings text-primary"></i>
						Perfil
					</a>
					<a class="dropdown-item" data-toggle='modal' data-target='#cerrar_sesion'>
						<i class="ti-power-off text-primary"></i>
						Cerrar Sesión
					</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
			<span class="icon-menu"></span>
		</button>
	</div>
</nav>
<!-- Modal Cerrar Sesión - Inicio -->
<div class="modal fade" id="cerrar_sesion" tabindex="-1" role="dialog" aria-labelledby="cerrar_sesion">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="cerrar_sesion">¿Está seguro de cerrar sesión?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-footer">
				<div class="btn-group" role='group' aria-label='cerrar_session'>
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No <i class="fa fa-times" aria-hidden="true"></i></button>
					<button type="button" class="btn btn-sm btn-primary pull-right" id="super_cerrar_sesion">Si <i class="fa fa-check" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>
