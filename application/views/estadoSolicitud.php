<div class="container">
	<h4>Estado de la organización:</h4>
	<p>Aquí puede consultar el estado de la organización.</p>
	<p>Debe ingresar el número de la solicitud (si lo tiene) ó puede ingresar el número NIT registrado en el SIIA con número de verificación DV (Si tiene).</p>
	<?php echo form_open('', array('id' => 'formulario_estado')); ?>
		<input type="text" class="form-control" id="numeroID" name="numeroID" placeholder="ID Solicitud" autofocus><br/>
		<div class="form-group">
			<button class="btn btn-siia btn-sm pull-right" id="consultarEstadoID">Consultar estado la solicitud <i class="fa fa-eye" aria-hidden="true"></i></button>
		</div>
	<?php echo form_close(); ?>
	<div class="clearfix"></div>
	<hr/>
	<div id="resConEst" class="card p-5">
	<h4>Resultados:</h4>
		<label>ID:</label> <span id="idSol"></span><br/>
		<label>Organización Solicitante:</label> <span id="organizacion"></span><br/>
		<label>Estado:</label> <strong><span id="estadoOrg"></span></strong><br/>
		<label>Estado Anterior:</label> <strong><span id="estadoAnterior"></span></strong><br/>
		<label>Creación:</label> <span id="fechaCreacion"></span><br/>
		<label>Finalización:</label> <span id="fechaFin"></span><br/>
		<label>Última Revisión:</label> <span id="revision"></span><br/>
		<label>Modalidad:</label> <span id="modSol"></span><br/>
		<label>Motivo:</label> <span id="motSol"></span><br/>
		<label>Tipo:</label> <span id="tipSol"></span><br/>
		<label>Asignado a:</label> <span id="asignadoSol"></span><br/>
	</div>
</div>
