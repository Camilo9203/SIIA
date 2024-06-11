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
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" id="profileDropdown">
					<img src="<?= base_url('assets/img/default.png')?>" alt="profile"/>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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
				<h5 class="modal-title" id="cerrar_sesion">¿Está seguro de cerrar sesión <label class="user-profile">super administrador</label>?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">No <i class="fa fa-times" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-primary pull-right" id="super_cerrar_sesion">Si <i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
