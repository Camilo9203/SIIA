<!--<nav class="navbar">-->
		<!-- Brand and toggle get grouped for better mobile display -->
<!--	<div class="navbar-header">-->
<!--		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">-->
<!--			<span class="sr-only">Toggle navigation</span>-->
<!--			<span class="icon-bar"></span>-->
<!--			<span class="icon-bar"></span>-->
<!--			<span class="icon-bar"></span>-->
<!--		</button>-->
<!--	</div>-->
	<!-- Collect the nav links, forms, and other content for toggling -->
<!--	<div class="" id="bs-example-navbar-collapse-1">-->
<!--		<ul class="nav navbar-nav">-->
<!--			<li><a class="active" href="--><?php //echo base_url('home'); ?><!--">Home <i class="fa fa-home" aria-hidden="true"></i></a></li>-->
<!--			<li><a href="--><?php //echo base_url('estado'); ?><!--">Estado de la solicitud <i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
<!--			<li><a href="--><?php //echo base_url('facilitadores'); ?><!--">Facilitadores válidos <i class="fa fa-users" aria-hidden="true"></i></a></li>-->
<!--		</ul>-->
<!--		<ul class="nav navbar-nav navbar-right">-->
<!--			<li><a href="--><?php //echo base_url('login'); ?><!--">Iniciar sesión <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>-->
<!--			<li><a href="--><?php //echo base_url('registro'); ?><!--">Registrarme <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>-->
<!--		</ul>-->
<!--	</div>-->
<!--</nav>-->

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3 ">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarGuest" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarGuest">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item active mr-1">
				<a class="nav-link" href="<?php echo base_url('home'); ?>">Home <i class="fa fa-home" aria-hidden="true"></i> <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item mr-1">
				<a class="nav-link" href="<?php echo base_url('estado'); ?>">Estado de la solicitud <i class="fa fa-eye" aria-hidden="true"></i></a>
			</li>
			<li class="nav-item mr-1 ">
				<a class="nav-link" href="<?php echo base_url('home'); ?>" tabindex="-1" aria-disabled="true">Facilitadores válidos <i class="fa fa-users" aria-hidden="true"></i></a>
			</li>
		</ul>
<!--		<form class="form-inline my-2 my-lg-0">-->
<!--			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
<!--			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
<!--		</form>-->
		<ul class="navbar-nav mt-2 mt-lg-0">
			<li class="nav-item active mr-1">
				<a class="nav-link" href="<?php echo base_url('login'); ?>">Iniciar sesión <i class="fa fa-sign-in" aria-hidden="true"></i></a>
			</li>
			<li class="nav-item mr-1">
				<a class="nav-link" href="<?php echo base_url('registro'); ?>" tabindex="-1" aria-disabled="true">Registrarme <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></a>
			</li>
		</ul>
	</div>
</nav>
