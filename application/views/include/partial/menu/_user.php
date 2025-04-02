<?php

/***
 * @var $activeLink
 */
?>
<!-- Dashboard -->
<li class="nav-item <?php if ($activeLink == 'dashboard') echo 'active'; ?>">
	<a class="nav-link" href="<?= base_url('organizacion/panel') ?>">
		<i class="ti-home menu-icon"></i>
		<span class="menu-title">Panel principal</span>
	</a>
</li>
<!-- Perfil -->
<li class="nav-item <?php if ($activeLink == 'perfil') echo 'active'; ?>">
	<a class="nav-link" href="<?= base_url('organizacion/perfil') ?>">
		<i class="ti-user menu-icon"></i>
		<span class="menu-title">Perfil</span>
	</a>
</li>
<!-- Solicitudes -->
<li class="nav-item <?php if ($activeLink == 'solicitudes') echo 'active'; ?>">
	<a class="nav-link" href="<?= base_url('organizacion/solicitudes') ?>">
		<i class="icon-layout menu-icon"></i>
		<span class="menu-title">Solicitudes</span>
	</a>
</li>
<!-- Facilitadores -->
<li class="nav-item <?php if ($activeLink == 'facilitadores') echo 'active'; ?>">
	<a class="nav-link" href="<?= base_url('organizacion/facilitadores') ?>">
		<i class="icon-head menu-icon"></i>
		<span class="menu-title">Facilitadores</span>
	</a>
</li>
<!-- Resoluciones -->
<li class="nav-item <?php if ($activeLink == 'resoluciones') echo 'active'; ?>">
	<a class="nav-link" href="<?= base_url('organizacion/resoluciones') ?>">
		<i class="icon-folder menu-icon"></i>
		<span class="menu-title">Resoluciones</span>
	</a>
</li>
<!-- Ayuda -->
<li class="nav-item <?php if ($activeLink == 'ayuda') echo 'active'; ?>">
	<a class="nav-link" href="<?= base_url('organizacion/ayuda') ?>">
		<i class="icon-help menu-icon"></i>
		<span class="menu-title">Ayuda</span>
	</a>
</li>