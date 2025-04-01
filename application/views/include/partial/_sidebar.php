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
		if ($tipo_usuario == 'super'):
			$this->load->view('include/partial/menu/_super', $activeLink);
		endif;
		if ($tipo_usuario == 'admin'):
			$this->load->view('include/partial/menu/_admin', $activeLink);
		endif;
		?>
	</ul>
</nav>