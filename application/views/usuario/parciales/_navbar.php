<!-- partial:../../partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
		<a class="navbar-brand brand-logo mr-5" href="<?php echo base_url('panel')?>"><img src="<?php echo base_url('assets/img/siia_logo.png') ?>" class="mr-2" alt="logo"/></a>
		<a class="navbar-brand brand-logo-mini" href="<?php echo base_url('panel')?>">SIIA</a>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="icon-menu"></span>
		</button>
		<ul class="navbar-nav mr-lg-2">
			<li class="nav-item nav-search d-none d-lg-block">
				<div class="input-group">
					<div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
					</div>
					<input type="text" class="form-control" id="navbar-search-input" placeholder="Buscar" aria-label="search" aria-describedby="search">
				</div>
			</li>
		</ul>
		<ul class="navbar-nav navbar-nav-right">
			<li class="nav-item dropdown">
				<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
					<i class="icon-bell mx-0"></i>
					<span class="count"></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
					<p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
					<a class="dropdown-item preview-item">
						<div class="preview-thumbnail">
							<div class="preview-icon bg-success">
								<i class="ti-info-alt mx-0"></i>
							</div>
						</div>
						<div class="preview-item-content">
							<h6 class="preview-subject font-weight-normal">Observaciones</h6>
							<p class="font-weight-light small-text mb-0 text-muted">
								Justo ahora
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
							<h6 class="preview-subject font-weight-normal">Configuración</h6>
							<p class="font-weight-light small-text mb-0 text-muted">
								Ajustar datos
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
							<h6 class="preview-subject font-weight-normal">Nuevo Evaluador</h6>
							<p class="font-weight-light small-text mb-0 text-muted">
								2 días atrás
							</p>
						</div>
					</a>
				</div>
			</li>
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
					<img src="<?php echo base_url('assets/img/default.png') ?>" alt="profile"/>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
					<a class="dropdown-item">
						<i class="ti-user text-primary"></i>
						<?php echo $data_organizacion->nombreOrganizacion ?>
					</a>
					<a class="dropdown-item">
						<i class="ti-settings text-primary"></i>
						Configuración
					</a>
					<a class="dropdown-item" data-toggle='modal' data-target='#cerrar_sesion'>
						<i class="ti-power-off text-primary"></i>
						Cerrar Sesión
					</a>
				</div>
			</li>
<!--			<li class="nav-item nav-settings d-none d-lg-flex">-->
<!--				<a class="nav-link" href="#">-->
<!--					<i class="icon-ellipsis"></i>-->
<!--				</a>-->
<!--			</li>-->
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
			<span class="icon-menu"></span>
		</button>
	</div>
</nav>
<!-- Modal Cerrar Sesión - Inicio -->
<div class="modal fade" id="cerrar_sesion" tabindex="-1" role="dialog" aria-labelledby="cerrarSesion">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cerrarSesion">¿Está seguro de cerrar sesión <label class="user-profile"><?php echo $data_organizacion->nombreOrganizacion ?></label>?</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">No <i class="fa fa-times" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-primary pull-right" id="salir">Si <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
