<?php
/***
 * @var $activeLink
 */
?>
<!-- Dashboard -->
<li class="nav-item <?php if ($activeLink == 'dashboard') {echo 'active';}  ?>">
	<a class="nav-link" href="<?= base_url('panelAdmin');?>">
		<i class="ti-home menu-icon"></i>
		<span class="menu-title">Panel principal</span>
	</a>
</li>
<!-- Organizaciones -->
<li class="nav-item <?php if ($activeLink == 'organizaciones') {echo 'active';} ?>">
	<a class="nav-link" data-toggle="collapse" href="#organizaciones-menu-collapse" aria-expanded="false" aria-controls="organizaciones-menu-collapse">
		<i class="ti-user menu-icon"></i>
		<span class="menu-title">Organizaciones</span>
		<i class="menu-arrow"></i>
	</a>
	<div class="collapse" id="organizaciones-menu-collapse">
		<ul class="nav flex-column sub-menu">
			<li class="nav-item"><a href="<?= base_url('panelAdmin/organizaciones/inscritas')?>" class="nav-link">Inscritas</a></li>
		</ul>
	</div>
</li>
<!-- Solicitudes -->
<li class="nav-item <?php if ($activeLink == 'solicitudes') {echo 'active';} ?>">
	<a class="nav-link" data-toggle="collapse" href="#solicitudes-menu-collapse" aria-expanded="false" aria-controls="solicitudes-menu-collapse">
		<i class="icon-folder menu-icon"></i>
		<span class="menu-title">Solicitudes</span>
		<i class="menu-arrow"></i>
	</a>
	<div class="collapse" id="solicitudes-menu-collapse">
		<ul class="nav flex-column sub-menu">
			<li class="nav-item"><a href="<?= base_url('super/solicitudes');?>" class="nav-link">Inscritas</a></li>
		</ul>
	</div>
</li>

<!-- Reportes -->
<li class="nav-item <?php if ($activeLink == 'reportes') {echo 'active';} ?>">
	<a class="nav-link" data-toggle="collapse" href="#reportes-menu-collapse" aria-expanded="false" aria-controls="reportes-menu-collapse">
		<i class="icon-folder menu-icon"></i>
		<span class="menu-title">Reportes</span>
		<i class="menu-arrow"></i>
	</a>
	<div class="collapse" id="reportes-menu-collapse">
		<ul class="nav flex-column sub-menu">
			<li class="nav-item"><a href="<?= base_url('panelAdmin/reportes/telefonico');?>" class="nav-link">Telefónico</a></li>
		</ul>
	</div>
</li>

