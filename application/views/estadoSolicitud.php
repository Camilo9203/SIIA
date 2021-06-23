<div class="container">
	<h4>Estado de la organización:</h4>
	<p>Aquí puede consultar el estado de la organización.</p>
	<p>Debe ingresar el número de la solicitud (si lo tiene) ó puede ingresar el número NIT registrado en el SIIA con número de verificación DV (Si tiene).</p>
	<input type="text" class="form-control" id="numeroID" placeholder="ID de la solicitud o número NIT..." name="" autofocus><br/>
	<div class="form-group">
        <form>
            <div class="g-recaptcha pull-left" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
        </form>
		<button class="btn btn-siia btn-sm pull-right" id="consultarEstadoID">Consultar estado la solicitud <i class="fa fa-eye" aria-hidden="true"></i></button>
    </div>
	<div class="clearfix"></div>
	<hr/>
	<div id="resConEst">
	<h4>Resultados:</h4>
		<label>Estado de la organización:</label> <strong><span id="estadoOrg"></span></strong><br/>
		<label>Fecha de finalización:</label> <span id="fechaFin"></span><br/>
		<label>ID de la solicitud:</label> <span id="idSol"></span><br/>
		<label>Modalidad:</label> <span id="modSol"></span><br/>
		<label>Motivo:</label> <span id="motSol"></span><br/>
		<label>Tipo:</label> <span id="tipSol"></span><br/>
	</div>
</div>