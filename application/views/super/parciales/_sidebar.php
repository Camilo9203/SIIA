<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<!-- Administradores -->
		<li class="nav-item <?php if ($activeLink == 'administradores') {echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url('super')?>">
				<i class="ti-user menu-icon"></i>
				<span class="menu-title">Administradores</span>
			</a>
		</li>
		<!-- Organizaciones -->
		<li class="nav-item <?php if ($activeLink == 'organizaciones') {echo 'active';} ?>">
			<a class="nav-link" href="<?php echo base_url('super/organizaciones')?>">
				<i class="icon-head menu-icon"></i>
				<span class="menu-title">Organizaciones</span>
			</a>
		</li>

	</ul>
</nav>

