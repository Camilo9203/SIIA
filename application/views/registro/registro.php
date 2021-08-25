<div id="registro" class="center-block col-md-7">
	<?php echo form_open('', array('id' => 'formulario_registro')); ?>
	<!--<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#ayuda_registro">?</button>-->
	<div class="col-md-6">
		<h3>Información básica de la organización:</h3><small class="pull-right"><span class="spanRojo">*</span> Requerido</small>
		<div class="form-group">
			<label for="organizacion">Nombre de la organizacion: <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="organizacion" id="organizacion" placeholder="Nombre de la organización..." required="" autofocus>
		</div>
		<div class="form-group">
			<label for="nit">NIT de la organización (sin puntos + digito de verificación): <span class="spanRojo">*</span></label>
			<div class="input-group">
				<input type="number" class="form-control" form="formulario_registro" name="nit" id="nit" placeholder="Numero de NIT" required="" maxlength="10" minlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
				<!-- Digito de verificación //TODO: Pendiente por terminar -->
				<span class="input-group-addon">-</span>
				<input type="number" class="form-control" form="formulario_registro" name="nit_digito" id="nit_digito" placeholder=" Dígito de verificación" required="" maxlength="1" minlength="1" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
			</div>
		</div>
		<div class="form-group">
			<label for="sigla">Sigla de la organización: <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="sigla" id="sigla" placeholder="Sigla de la organización..." required="">
		</div>
		<div class="form-group">
			<label for="primer_nombre_rep_legal">Primer nombre del representante legal: <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="primer_nombre_rep_legal" id="nombre" placeholder="Primer nombre del representante..." required="">
		</div>
		<div class="form-group">
			<label for="segundo_nombre_rep_legal">Segundo nombre del representante legal:</label>
			<input type="text" class="form-control" form="formulario_registro" name="segundo_nombre_rep_legal" id="nombre_s" placeholder="Segundo nombre del representante...">
		</div>
		<div class="form-group">
			<label for="primer_apellido_rep_regal">Primer apellido del representante legal: <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="primer_apellido_rep_regal" id="apellido" placeholder="Primer apellido del representante..." required="">
		</div>
		<div class="form-group">
			<label for="segundo_apellido_rep_regal">Segundo apellido del representante legal:</label>
			<input type="text" class="form-control" form="formulario_registro" name="segundo_apellido_rep_regal" id="apellido_s" placeholder="Segundo apellido del representante...">
		</div>
		<div class="form-group">
			<label for="correo_electronico_rep_legal">Correo electrónico del representante legal: <span class="spanRojo">*</span></label>
			<input type="email" class="form-control" form="formulario_registro" name="correo_electronico_rep_legal" id="correo_electronico_rep_legal" placeholder="Correo electrónico del representante legal..." required="">
		</div>
	</div>
	<div class="col-md-6" id="left_registro">
		<h3>Información de quien se encargara del tramite:</h3><small class="pull-right"><span class="spanRojo">*</span> Requerido</small>
		<div class="form-group">
			<label for="primer_nombre_persona">Primer nombre: <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="primer_nombre_persona" id="nombre_p" placeholder="Primer nombre..." required="">
		</div>
		<div class="form-group">
			<label for="primer_apellido_persona">Primer apellido: <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="primer_apellido_persona" id="apellido_p" placeholder="Primer apellido..." required="">
		</div>
		<div class="form-group">
			<label for="correo_electronico">Correo electrónico de organización (Notificaciones): <span class="spanRojo">*</span></label>
			<input type="email" class="form-control" form="formulario_registro" name="correo_electronico" id="correo_electronico" placeholder="Correo electrónico de la organización..." required="">
		</div>
		<!-- <h3>Datos de la cuenta de usuario:</h3><small class="pull-right"><span class="spanRojo">*</span> Requerido</small> -->
		<div class="form-group">
			<label for="nombre_usuario">Nombre de usuario (Incio de sesión): <span class="spanRojo">*</span></label>
			<input type="text" class="form-control" form="formulario_registro" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre de usuario..." required="">
		</div>
		<div class="form-group">
			<label for="password">Contraseña: <span class="spanRojo">*</span></label>
			<div class="pw-cont">
				<input type="password" class="form-control" form="formulario_registro" name="password" id="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="" autocomplete="off">
				<span id="show-pass1"><i class="fa fa-eye" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label for="re_password">Vuelve a escribir la contraseña: <span class="spanRojo">*</span></label>
			<div class="pw-cont">
				<input type="password" class="form-control" form="formulario_registro" name="re_password" id="re_password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;" required="" autocomplete="off">
				<span id="show-pass2"><i class="fa fa-eye" aria-hidden="true"></i></span>
			</div>
		</div>
		<div class="form-group">
			<label class="underlined"><input type="checkbox" id="acepto_cond" form="formulario_registro" name="aceptocond" value="* Acepto condiciones y restricciones en SIA." disabled required><label for="aceptocond">&nbsp;</label> <a data-toggle="modal" data-target="#politica_ventana" data-backdrop="static" data-keyboard="false"><span class="spanRojo">*</span> Política de tratamiento de la información.</a></label> <small class="pull-right"><i><span class="spanRojo">*</span> Clic en el texto para ver política</i></small>
		</div>
		<div class="form-group">
			<form>
				<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
			</form>
		</div>
		<div class="form-group">
			<button type="button" id="confirmaRegistro" class="btn btn-siia btn-sm pull-right" data-toggle="modal" data-target="#ayuda_registro">Registrarme <i class="fa fa-check"></i></button>
			<button type="button" class="btn btn-danger btn-sm submit ingresar" value="Iniciar Sesion">Iniciar Sesión <i class="fa fa-sign-in" aria-hidden="true"></i></button>
		</div>
		<img src="<?php echo base_url(); ?>assets/img/loading.gif" id="loading" class="img-responsive col-md-2">
		<div class="form-group">
			<div id="mensaje" class="col-md-12 alert" role="alert"></div>
		</div>
	</div>
	</form>
	<div class="col-md-6">
	</div>
</div>
<!-- Modal Politica de Privacidad -->
<div class="modal fade" id="politica_ventana" tabindex="-1" role="dialog" aria-labelledby="politica">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div id="header_politicas" class="col-md-12">
						<img alt="logo" id="imagen_header_politicas" class="img-responsive">
						<h2>POLÍTICA DE PROTECCIÓN DE DATOS PERSONALES DE LA UNIDAD ADMINISTRATIVA ESPECIAL DE ORGANIZACIONES SOLIDARIAS</h2>
					</div>
					<div class="clearfix"></div>
					<hr />
					<div class="col-md-12">
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>I. ANTECEDENTES</label>
							</div>
							<p>
								La Ley de Protección de Datos Personales reconoce y protege el derecho que tienen todas las personas a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bases de datos o archivos que sean susceptibles de tratamiento por entidades de naturaleza pública o privada.</p>
							<p>
								Al hablar de datos personales nos referimos a toda información asociada a una persona y que permite su identificación, como su documento de identidad, lugar de nacimiento, estado civil, edad, lugar de residencia, trayectoria académica, laboral, o profesional. Existe también información más sensible como su estado de salud, sus características físicas, ideología política, vida sexual, entre otros aspectos.
							</p>
							<p>
								La protección de datos personales tiene un desarrollo constitucional consagrado en el artículo 15 y 20, es así que mediante la Ley 1581 de 2012, en su artículo primero desarrolla este derecho constitucional que tienen todas las personas a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bases de datos o archivos, y los demás derechos, libertades y garantías constitucionales a que se refiere el artículo 15 de la Constitución Política; así como el derecho a la información consagrado en el artículo 20 de la misma.
							</p>
							<p>
								La protección de datos son todas las medidas que se toman, tanto a nivel técnico como jurídico, para garantizar que la información de los usuarios de una compañía, entidad o de cualquier base de datos, esté segura de cualquier ataque o intento de acceder a ésta, por parte de personas no autorizadas.
							</p>
							<p>
								En desarrollo y en concordancia con los preceptos legales y constitucionales, la Unidad Administrativa Especial de Organizaciones Solidarias presenta la siguiente Política de Protección de Datos Personales.
							</p>
							<label>PRINCIPIOS DE LA PROTECCIÓN DE DATOS: </label>
							<p>En el desarrollo, interpretación y aplicación de la presente Política, en la Entidad se tendrán en cuenta de manera armónica e integral, los principios que a continuación se establecen:
							<div class="col-md-12 c_pol">
								<p>
									a) Principio de legalidad en materia de Tratamiento de datos: El tratamiento de datos es una actividad reglada, la cual deberá estar sujeta a las disposiciones legales vigentes y aplicables que rigen el tema.
								</p>
								<p>
									b) Principio de veracidad o calidad de los registros o datos: La información contenida en los Bancos de Datos debe ser veraz, completa, exacta, actualizada, comprobable y comprensible. Se prohíbe el registro y divulgación de datos parciales, incompletos, fraccionados o que induzcan a error.
								<p>
									c) Principio de finalidad: La administración de datos personales debe obedecer a una finalidad legítima de acuerdo con la Constitución y la ley. La finalidad debe informársele al titular de la información previa o concomitantemente con el otorgamiento de la autorización, cuando ella sea necesaria o en general siempre que el titular solicite información al respecto.
								</p>
								<p>
									d) Principio de acceso y circulación restringida: La administración de datos personales se sujeta a los límites que se derivan de la naturaleza de los datos, de las disposiciones de la ley y de los principios de la administración de datos personales especialmente de los principios de temporalidad de la información y la finalidad del Banco de Datos. Los datos personales, salvo la información pública, no podrán ser accesibles por Internet o por otros medios de divulgación o comunicación masiva, salvo que el acceso sea técnicamente controlable para brindar un conocimiento restringido sólo a los titulares o los usuarios autorizados conforme a la ley.
								</p>
								<p>
									e) Principio de temporalidad de la información: La información del titular no podrá ser suministrada a usuarios o terceros cuando deje de servir para la finalidad del Banco de Datos.
								</p>
								<p>
									f) Principio de interpretación integral de derechos constitucionales: Se interpretará en el sentido de que se amparen adecuadamente los derechos constitucionales, como son el Hábeas Data, el derecho al buen nombre, el derecho a la honra, el derecho a la intimidad y el derecho a la información. Los derechos de los titulares se interpretarán en armonía y en un plano de equilibrio con el derecho a la información previsto en el artículo 20 de la Constitución y con los demás derechos constitucionales aplicables.
								</p>
								<p>
									g) Principio de seguridad: La información que conforma los registros individuales constitutivos de los Bancos de Datos a que se refiere la ley, así como la resultante de las consultas que de ella hagan sus usuarios, se deberá manejar con las medidas técnicas que sean necesarias para garantizar la seguridad de los registros evitando su adulteración, pérdida, consulta o uso no autorizado.
								</p>
								<p>
									h) Principio de confidencialidad. Todas las personas naturales o jurídicas que intervengan en la administración de datos personales que no tengan la naturaleza de públicos están obligadas en todo tiempo a garantizar la reserva de la información, inclusive después de finalizada su relación con alguna de las labores que comprende la administración de datos, pudiendo sólo realizar suministro o comunicación de datos cuando ello corresponda al desarrollo de las actividades autorizadas por la ley y en los términos de la misma.
								</p>
								<p>
									i) Principio de transparencia: En el tratamiento de datos personales, la Entidad garantizará al titular su derecho de obtener en cualquier momento y sin restricciones, información acerca de la existencia de cualquier tipo de información o dato personal que sea de su interés o titularidad.
								</p>
								<p>
									j) Principio de libertad: el tratamiento de los datos personales sólo puede realizarse con el consentimiento, previo, expreso e informado del titular. Los datos personales no podrán ser obtenidos o divulgados sin previa autorización, o en ausencia de mandato legal, estatutario, o judicial que releve el consentimiento.</p>
							</div>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>II. PROPÓSITO</label>
							</div>
							<p>Suministrar los lineamientos generales para los protección de los datos personales y sensibles a todos los usuarios de la Unidad Administrativa Especial de Organizaciones Solidarias, brindando herramientas que garanticen la autenticidad, integridad y confidencialidad de la información.</p>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>III. DEFINICIONES</label>
							</div>
							<p>Para los efectos de la presente política y al tenor de la normatividad vigente en materia de protección de datos personales, se tendrán en cuenta las siguientes definiciones: Autorización: Consentimiento previo, expreso e informado del Titular para llevar a cabo el Tratamiento de datos personales.</p>

							<label>Aviso de privacidad:</label>
							<p>Comunicación verbal o escrita generada por el Responsable, dirigida al Titular para el tratamiento de sus datos personales, mediante la cual se le informa acerca de la existencia de las políticas de tratamiento de información que le serán aplicables, la forma de acceder a las mismas y las finalidades del tratamiento que se pretende dar a los datos personales.</p>
							<label>Base de Datos: </label>
							<p>Conjunto organizado de datos personales que sea objeto de tratamiento.</p>
							<label>Causahabiente: </label>
							<p>persona que ha sucedido a otra por causa del fallecimiento de ésta (heredero).</p>
							<label>Dato personal: </label>
							<p>Cualquier información vinculada o que pueda asociarse a una o varias personas naturales determinadas o determinables.</p>
							<label>Dato público: </label>
							<p>Es el dato que no sea semiprivado, privado o sensible. Son considerados datos públicos, entre otros, los datos relativos al estado civil de las personas, a su profesión u oficio, a su calidad de comerciante o de servidor público. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros, en registros públicos, documentos públicos, gacetas y boletines oficiales y sentencias judiciales debidamente ejecutoriadas que no estén sometidas a reserva.</p>
							<label>Datos sensibles: </label>
							<p>Se entiende por datos sensibles aquellos que afectan la intimidad del titular o cuyo uso indebido puede generar su discriminación, tales como que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías.</p>
							<label>Encargado del Tratamiento: </label>
							<p>Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, realice el Tratamiento de datos personales por cuenta del responsable del tratamiento.</p>
							<label>Responsable del Tratamiento: </label>
							<p>Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, decida sobre la base de datos y/o el tratamiento de los datos.</p>
							<label>Titular: </label>
							<p>Persona natural cuyos datos personales sean objeto de tratamiento.</p>
							<label>Tratamiento: </label>
							<p> Cualquier operación o conjunto de operaciones sobre datos personales, tales como la recolección, almacenamiento, uso, circulación o supresión.</p>
							<label>Transferencia: </label>
							<p>La transferencia de datos tiene lugar cuando el responsable y/o encargado del tratamiento de datos personales, ubicado en Colombia, envía la información o los datos personales a un receptor, que a su vez es responsable del tratamiento y se encuentra dentro o fuera del país.</p>
							<label>Transmisión: </label>
							<p>Tratamiento de datos personales que implica la comunicación de los mismos dentro o fuera del territorio de la República de Colombia cuando tenga por objeto la realización de un tratamiento por el encargado por cuenta del responsable.</p>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>IV. DECLARACION</label>
							</div>
							<p>
								La Entidad reconoce la titularidad que de los datos personales ostentan las personas y en consecuencia ellas de manera exclusiva pueden decidir sobre los mismos. Por lo tanto, La Entidad utilizará los datos personales para el cumplimiento de las finalidades autorizadas expresamente por el titular o por las normas vigentes. En el tratamiento y protección de datos personales, La Entidad tendrá los siguientes deberes, sin perjuicio de otros previstos en las disposiciones que regulen o lleguen a regular esta materia:
							</p>
							<div class="col-md-12 c_pol">
								<p>a. Garantizar al titular, en todo tiempo, el pleno y efectivo ejercicio del derecho de hábeas data</p>
								<p>b. Solicitar y conservar, copia de la respectiva autorización otorgada por el titular para el tratamiento de datos personales.</p>
								<p>c. Informar debidamente al titular sobre la finalidad de la recolección y los derechos que le asisten en virtud de la autorización otorgada</p>
								<p>d. Conservar la información bajo las condiciones de seguridad necesarias para impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento.</p>
								<p>e. Garantizar que la información sea veraz, completa, exacta, actualizada, comprobable y comprensible.</p>
								<p>f. Actualizar oportunamente la información, atendiendo de esta forma todas las novedades respecto de los datos del titular. Adicionalmente, se deberán implementar todas las medidas necesarias para que la información se mantenga actualizada.</p>
								<p>g. Rectificar la información cuando sea incorrecta y comunicar lo pertinente.</p>
								<p>h. Respetar las condiciones de seguridad y privacidad de la información del titular</p>
								<p>i. Tramitar las consultas y reclamos formulados en los términos señalados por la ley</p>
								<p>j. Identificar cuando determinada información se encuentra en discusión por parte del titular.</p>
								<p>k. Informar a solicitud del titular sobre el uso dado a sus datos</p>
								<p>l. Informar a la autoridad de protección de datos cuando se presenten violaciones a los códigos de seguridad y existan riesgos en la administración de la información de los titulares.</p>
								<p>m. Cumplir los requerimientos e instrucciones que imparta la Superintendencia de Industria y Comercio sobre el tema en particular</p>
								<p>n. Usar únicamente datos cuyo tratamiento esté previamente autorizado de conformidad con lo previsto en la ley 1581 de 2012.</p>
								<p>o. Velar por el uso adecuado de los datos personales de los niños, niñas y adolescentes, en aquellos casos en que se entra autorizado el tratamiento de sus datos.</p>
								<p>p. Registrar en la base de datos las leyenda "reclamo en trámite" en la forma en que se regula en la ley.</p>
								<p>q. Insertar en la base de datos la leyenda "información en discusión judicial" una vez notificado por parte de la autoridad competente sobre procesos judiciales relacionados con la calidad del dato personal</p>
								<p>r. Abstenerse de circular información que esté siendo controvertida por el titular y cuyo bloqueo haya sido ordenado por la Superintendencia de Industria y Comercio</p>
								<p>s. Permitir el acceso a la información únicamente a las personas que pueden tener acceso a ella</p>
								<p>t. Usar los datos personales del titular sólo para aquellas finalidades para las que se encuentre facultada debidamente y respetando en todo caso la normatividad vigente sobre protección de datos personales.</p>
							</div>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>V. RESPONSABLE DE IMPLEMENTACION</label>
							</div>
							<p>Responsable de las bases de datos: Es La Unidad Administrativa Especial de Organizaciones Solidarias a través del área responsable de la información Dirección de Investigaciones y Planeación – Grupo de Planeación y Estadística. El rol del responsable consiste en tomar las decisiones sobre las bases de datos y/o el tratamiento de los datos. Define la finalidad y la forma en que se recolectan, almacenan y administran los datos. Asimismo, está obligado a solicitar y conservar la autorización en la que conste el consentimiento expreso del titular de la información.</p>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>VI. PROCESOS INVOLUCRADOS EN LA IMPLEMENTACIÓN</label>
							</div>
							<p>La presente política será aplicable a los datos personales registrados en cualquier base de datos de La Entidad cuyo titular sea una persona natural.</p>
							<p>La Entidad en todas sus actuaciones incorpora el respeto a la Protección de Datos, dando cumplimiento a cada uno de los principios establecidos en la Ley.</p>
							<p>La Entidad implementará todas las acciones y estrategias necesarias para el efectivo cumplimiento y garantía del Derechoi consagrado en la Ley Estatutaria 1581 de 2012.</p>
							<p>La Entidad dará a conocer a todos sus usuarios los derechos que se derivan de la protección de los datos personales.</p>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>VII. INDICADORES</label>
							</div>
							<p>1. Uso de información por personal autorizado.</p>
							<p>2. Tratamiento de datos personales.</p>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>VIII. CRONOGRAMA GENERAL DE IMPLEMENTACIÓN</label>
							</div>
							<p>El presente documento de política de protección de datos personales entrará en vigencia desde la expedición del acto administrativo que así lo disponga.</p>
							<p>NOTA: El área responsable del tratamiento de los datos personales definirá los funcionarios y colaboradores que accederán a las bases de datos; así como, las contraseñas y procedimientos que sean necesarios. Así mismo, los colaboradores deberán seguir los lineamientos dados por el responsable del tratamiento y las políticas de tratamiento de datos personales de La Unidad.</p>
						</div>
						<hr />
						<div class="panel-body c_pol">
							<div class="t_pol">
								<label>IX. ANEXOS</label>
							</div>
							<p>N/A.</p>
						</div>
						<small><a class="pull-right" title="Recurso de Politica" target="_blank" href="http://www.orgsolidarias.gov.co/sites/default/files/archivos/POLITICA%20PROTECCION%20DE%20DATOS%20V1.pdf">Recurso de la política.</a></small>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-siia btn-sm pull-right" id="acepto_politica">Sí, acepto. <i class="fa fa-check"></i></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Ayuda en Registro - INICIO -->
<div class="modal fade" id="ayuda_registro" tabindex="-1" role="dialog" aria-labelledby="ayudaRegistro">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ayudaRegistro">¿La información ingresada es correcta?</h4>
				<small>Por favor, verifique los correos electrónicos en este momento, se le notificara cualquier comunicación del sistema por este medio y se enviara un link de activación de la cuenta en el SIIA. ***</small>
			</div>
			<div class="modal-body">
				<div class="row">
					<div id="informacion_pre">
						<div class="col-md-6">
							<div class="form-group">
								<label>Organización:</label>
								<p id="modalConfOrg"></p>
							</div>
							<div class="form-group">
								<label>NIT de la organización:</label>
								<p id="modalConfNit"></p>
							</div>
							<div class="form-group">
								<label>Sigla de la organización:</label>
								<p id="modalConfSigla"></p>
							</div>
							<div class="form-group">
								<label>Primer nombre del representante legal:</label>
								<p id="modalConfPNRL"></p>
							</div>
							<div class="form-group">
								<label>Segundo nombre del representante legal:</label>
								<p id="modalConfSNRL"></p>
							</div>
							<div class="form-group">
								<label>Primer apellido del representante legal:</label>
								<p id="modalConfPARL"></p>
							</div>
							<div class="form-group">
								<label>Segundo apellido del representante legal:</label>
								<p id="modalConfSARL"></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Correo electrónico de organización:(Notificaciones)</label>
								<p id="modalConfCOrg"></p>
							</div>
							<div class="form-group">
								<label>Correo electrónico del representante legal:</label>
								<p id="modalConfCRep"></p>
							</div>
							<div class="form-group">
								<label>Primer nombre:</label>
								<p id="modalConfPn"></p>
							</div>
							<div class="form-group">
								<label>Primer apellido:</label>
								<p id="modalConfPa"></p>
							</div>
							<div class="form-group">
								<label>Nombre de usuario:</label>
								<p id="modalConfNU"></p>
							</div>
							<div class="form-group">
								<label>Contraseña:</label>
								<p>Su contraseña.</p>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="aceptoComActo">
								<label class="form-check-label" for="aceptoComActo"><span class="underlined"><a>Acepto que se envíen comunicaciones y actos administrativos vía correo electrónico <span class="spanRojo">*</span></a></span></label>
							</div>
						</div>
					</div>
					<div id="reenvio_pre">
						<div class="container">
							<div class="jumbotron">
								<p>Si el correo no le llega en los próximos 5 minutos, y no está en la bandeja de spam, por favor, escriba otro correo electrónico (Gmail.com, Outlook.com, Yahoo.com, Hotmail.com), y de click en "Volver a enviar el correo". Si el problema persiste, contactese con <a href="mailto:atencionalciudadano@uaeos.gov.co">atencionalciudadano@uaeos.gov.co</a></p>
								<div class="clearfix"></div>
								<hr />
								<div class="form-group">
									<label for="correo_electronico_rese">Correo electrónico de organización:*</label>
									<input type="email" class="form-control" name="correo_electronico_rese" id="correo_electronico_rese" placeholder="Correo electrónico organización">
								</div>
							</div>
							<!--<div class="jumbotron">
				<small>Estamos teniendo inconvenientes con nuestro sistema de correos y lo estaremos solucionando lo mas pronto posible.</small>
				<p>El registro se ha creado satisfactoriamente, ahora puede ingresar al sistema con su usuario y contraseña dando click <a href="<?php echo base_url("/login"); ?>">aquí</a>.</p>
			</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" name="registro" disabled="disabled" id="guardar_registro" class="btn btn-success btn-sm submit" value="Registrarme">Sí, Registrarme. <i class="fa fa-check"></i></button>
				<button type="button" id="reenvio" class="btn btn-info btn-sm submit" value="Volver a enviar">Volver a enviar el correo. <i class="fa fa-paper-plane"></i></button>
				<!--<button type="button" id="cerr_reen" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar. <i class="fa fa-times"></i></button>-->
				<button type="button" id="cerr_mod" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">No, voy a verificar. <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
