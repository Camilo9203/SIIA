<?php
/***
 * @var $activeLink
 * @var $tipo_usuario
 */
?>
<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<?php
			if($tipo_usuario == 'super'):
				$this->load->view('include\partial\menu\_super.php', $activeLink);
			endif;
		?>
	</ul>
</nav>

