<div class="container">
	<br><h4>Encuesta de Satisfacción:</h4><br>
	<p>En este espacio puede decirnos que le ha parecido el proceso de acreditación y en que podemos mejorar en el Sistema Integrado de Información de Acreditación.</p>
	<p>Debe diligenciar los campos requeridos y dar clic en enviar. Gracias!.</p><br>
<!--	<form id="formEncuesta">-->
		<!--	Pregunta 1	-->
		<div class="form-group">
			<label>
				<p>1. ¿Cómo califica en general el trámite de acreditación? </p>
			</label><br>
			<div class="form-group select-govco">
				<select id ="selector-normal" class="form-control calificacion_general" title="Por ejemplo: Excelente"> <!--selectpicker-->
					<option selected>Elija una opción</option>
					<option value="Excelente">Excelente</option>
					<option value="Acorde a lo esperado">Acorde a lo esperado</option>
					<option value="Puede mejorar">Puede mejorar</option>
				</select>
			</div>
		</div><br>


		<!--	Pregunta 2	-->
		<div class="form-group">
			<label>
				<p>1. Si su entidad tuvo contacto con el responsable de la evaluación, ¿Cómo califica su atención?</p>
			</label><br>
			<div class="form-group select-govco">
				<select id ="selector-normal" class="form-control calificacion_evaluador" title="Por ejemplo: Excelente"> <!--selectpicker-->
					<option selected>Elija una opción</option>
					<option value="Excelente">Excelente</option>
					<option value="Acorde a lo esperado">Acorde a lo esperado</option>
					<option value="Puede mejorar">Puede mejorar</option>
				</select>
			</div>
		</div><br>
		<!--	Pregunta 3	-->
		<div class="form-group">
			<p>3. Déjenos sus comentarios</p><br>
			<textarea name="comentarios" id="comentario" class="form-control input-govco" required></textarea>
		</div>
		<div class="form-group">
		<!--	Botón de enviar	-->
		<div class="p-2">
			<button class="btn btn-round btn-high text-capitalize" id="enviarEcuesta">Enviar Encuesta <span class="govco-icon govco-icon-right-arrow-n small" ></span></button>
		</div>
	</form>
	<hr/>
</div>


