<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<!-- Panel -->
		<li class="nav-item <?php if ($activeLink == 'panel') {echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url('panel')?>">
				<i class="icon-grid menu-icon"></i>
				<span class="menu-title">Panel</span>
			</a>
		</li>
		<!-- Perfil -->
		<li class="nav-item <?php if ($activeLink == 'perfil') {echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url('panel/perfil')?>">
				<i class="ti-user menu-icon"></i>
				<span class="menu-title">Perfil</span>
			</a>
		</li>
		<!-- Solicitudes -->
		<li class="nav-item <?php if ($activeLink == 'solicitudes') {echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url('panel/solicitudes')?>" >
				<i class="icon-layout menu-icon"></i>
				<span class="menu-title">Solicitudes</span>
			</a>
		</li>
		<!-- Facilitadores -->
		<li class="nav-item">
			<a class="nav-link <?php if ($activeLink == 'facilitadores') {echo 'active';} ?>" href="<?php echo base_url('panel/facilitadores')?>">
				<i class="icon-head menu-icon"></i>
				<span class="menu-title">Facilitadores</span>
			</a>
		</li>
		<!-- Estadísticas -->
		<li class="nav-item">
			<a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
				<i class="icon-bar-graph menu-icon"></i>
				<span class="menu-title">Estadísticas</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="charts">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"> <a class="nav-link" href="<?php echo base_url('panel/estadisticas')?>">Gráficos</a></li>
				</ul>
			</div>
		</li>
		<!-- Ayuda -->
		<li class="nav-item">
			<a class="nav-link <?php if ($activeLink == 'ayuda') {echo 'active';} ?>" href="<?php echo base_url('panel/contacto/ayuda')?>">
				<i class="icon-help menu-icon"></i>
				<span class="menu-title">Ayuda</span>
			</a>
		</li>

		<!--		<li class="nav-item --><?php //if ($activeLink == 'formularios') {echo 'active';} ?><!--">-->
		<!--			<a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">-->
		<!--				<i class="icon-paper menu-icon"></i>-->
		<!--				<span class="menu-title">Formularios</span>-->
		<!--				<i class="menu-arrow"></i>-->
		<!--			</a>-->
		<!--			<div class="collapse" id="form-elements">-->
		<!--				<ul class="nav flex-column sub-menu">-->
		<!--					<li class="nav-item"><a class="nav-link" href="--><?php //echo base_url('panel/formularios')?><!--">Elementos</a></li>-->
		<!--				</ul>-->
		<!--			</div>-->
		<!--		</li>-->
		<!--		<li class="nav-item">-->
		<!--			<a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">-->
		<!--				<i class="icon-contract menu-icon"></i>-->
		<!--				<span class="menu-title">Icons</span>-->
		<!--				<i class="menu-arrow"></i>-->
		<!--			</a>-->
		<!--			<div class="collapse" id="icons">-->
		<!--				<ul class="nav flex-column sub-menu">-->
		<!--					<li class="nav-item"> <a class="nav-link" href="../../pages/icons/mdi.html">Mdi icons</a></li>-->
		<!--				</ul>-->
		<!--			</div>-->
		<!--		</li>-->
		<!--		<li class="nav-item">-->
		<!--			<a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">-->
		<!--				<i class="icon-head menu-icon"></i>-->
		<!--				<span class="menu-title">User Pages</span>-->
		<!--				<i class="menu-arrow"></i>-->
		<!--			</a>-->
		<!--			<div class="collapse" id="auth">-->
		<!--				<ul class="nav flex-column sub-menu">-->
		<!--					<li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>-->
		<!--					<li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register </a></li>-->
		<!--				</ul>-->
		<!--			</div>-->
		<!--		</li>-->
		<!--		<li class="nav-item">-->
		<!--			<a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">-->
		<!--				<i class="icon-ban menu-icon"></i>-->
		<!--				<span class="menu-title">Error pages</span>-->
		<!--				<i class="menu-arrow"></i>-->
		<!--			</a>-->
		<!--			<div class="collapse" id="error">-->
		<!--				<ul class="nav flex-column sub-menu">-->
		<!--					<li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>-->
		<!--					<li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>-->
		<!--				</ul>-->
		<!--			</div>-->
		<!--		</li>-->

	</ul>
</nav>
