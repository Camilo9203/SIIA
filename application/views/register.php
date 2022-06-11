<?php echo validation_errors('formulario_registro'); ?>
<?php echo form_open('', array('id' => 'formulario_registro')); ?>
<!--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ayuda_registro">?</button>-->
<!-- Start Form Register-->
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper align-items-center auth px-0">
			<div class="row w-100 mx-0">
				<div class="col-lg-5 mx-auto m-2">
					<h3>Información básica de la organización a acreditar:</h3><small class="pull-right"><span class="spanRojo">*</span> Requerido</small>
					<hr/>
					<div class="form-group">
						<label for="organizacion">Nombre de la organización: <span class="spanRojo">*</span></label>
						<input type="text" class="form-control" form="formulario_registro" name="organizacion" id="organizacion" placeholder="Nombre de la organización..." required="" autofocus value="<?php echo  set_value('organizacion');  ?>">
					</div>
					<div class="form-group">
						<label for="nit">NIT de la organización: <span class="spanRojo">*</span></label>
						<div class="input-group">
							<input type="number" class="form-control" form="formulario_registro" name="nit" id="nit" placeholder="Numero de NIT" required="" maxlength="10" minlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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
				<div class="col-lg-5 mx-auto m-2">
					<h3>Información de la persona encargada del trámite:</h3><small class="pull-right"><span class="spanRojo">*</span> Requerido</small>
					<hr/>
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
					<div class="form-group">
						<label for="nombre_usuario">Nombre de usuario (Incio de sesión): <span class="spanRojo">*</span></label>
						<input type="text" class="form-control has-danger" form="formulario_registro" name="nombre_usuario" id="nombre_usuario" placeholder="Nombre de usuario..." required="">
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
					<hr/>
					<!--	Sección política y recaptcha	-->
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label" for="acepto_cond">
								<input type="checkbox" class="form-check-input " id="acepto_cond" form="formulario_registro" name="acepto_cond" value="* Acepto condiciones y restricciones en SIIA." disabled required>
							</label>
								<a href="" data-toggle="modal" data-target="#politica_ventana" data-backdrop="static" data-keyboard="false">* Política de tratamiento de la información.</a>
						</div>
					</div>
					<div class="form-group">
						<form>
							<div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LfCESEUAAAAAOemaQmmGTGJeiKvLmPkY7as9zPj"></div>
						</form>
					</div>
					<!--	Buttons Form	-->
					<div class="form-group">
						<a class="btn btn-primary" id="confirmaRegistro">Registrarme <i class="mdi mdi-account" aria-hidden="true"></i></a>
						<a class="btn btn-danger" href="<?php echo base_url('login'); ?>" >Iniciar Sesión <i class="mdi mdi-account-check" aria-hidden="true"></i></i></a>
					</div>
					<!--	<img src="--><?php //echo base_url(); ?><!--assets/img/loading.gif" id="loading" class="img-responsive col-md-2">-->
					<div class="form-group">
						<div id="mensaje" class="col-md-12 alert" role="alert"></div>
					</div>
<!--					<button class="btn btn-primary" data-toggle="modal" data-target="#politica_ventana" data-backdrop="static" data-keyboard="false">Modal</button>-->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Form Register-->
<!-- Modal Política de Privacidad -->
<div class="modal fade" id="politica_ventana" tabindex="-1" role="dialog" aria-labelledby="politica">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="container">
					<div class="row">
						<div id="header_politicas" class="col-md-12 text-center">
							<img alt="logo" id="imagen_header_politicas" class="img-responsive">
							<hr />
							<h4>POLÍTICA DE PROTECCIÓN DE DATOS PERSONALES DE LA UNIDAD ADMINISTRATIVA ESPECIAL DE ORGANIZACIONES SOLIDARIAS</h4>
							<hr />
						</div>
						<hr />
						<div class="col-md-12 text-justify">
							<!-- I. ANTECEDENTES -->
							<div class="p-3 border bg-light">
								<br><h5>I. ANTECEDENTES</h5><br>
								<p>
									La Ley de Protección de Datos Personales reconoce y protege el derecho que tienen todas las personas a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bases de datos o archivos que sean susceptibles de tratamiento por entidades de naturaleza pública o privada.<br><br>
									Al hablar de datos personales nos referimos a toda información asociada a una persona y que permite su identificación, como su documento de identidad, lugar de nacimiento, estado civil, edad, lugar de residencia, trayectoria académica, laboral, o profesional. Existe también información más sensible como su estado de salud, sus características físicas, ideología política, vida sexual, entre otros aspectos.<br><br>
									La protección de datos personales tiene un desarrollo constitucional consagrado en el artículo 15 y 20, es así que mediante la Ley 1581 de 2012, en su artículo primero desarrolla este derecho constitucional que tienen todas las personas a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bases de datos o archivos, y los demás derechos, libertades y garantías constitucionales a que se refiere el artículo 15 de la Constitución Política; así como el derecho a la información consagrado en el artículo 20 de la misma.<br><br>
									La protección de datos son todas las medidas que se toman, tanto a nivel técnico como jurídico, para garantizar que la información de los usuarios de una compañía, entidad o de cualquier base de datos, esté segura de cualquier ataque o intento de acceder a ésta, por parte de personas no autorizadas.<br><br>
									En desarrollo y en concordancia con los preceptos legales y constitucionales, la Unidad Administrativa Especial de Organizaciones Solidarias presenta la siguiente Política de Protección de Datos Personales.<br><br>
								</p>
								<h5>PRINCIPIOS DE LA PROTECCIÓN DE DATOS: </h5><br>
								<p>
									En el desarrollo, interpretación y aplicación de la presente Política, en la Entidad se tendrán en cuenta de manera armónica e integral, los principios que a continuación se establecen:
								</p>
								<ol type="A">
									<li>
										Principio de legalidad en materia de Tratamiento de datos: El tratamiento de datos es una actividad reglada, la cual deberá estar sujeta a las disposiciones legales vigentes y aplicables que rigen el tema. br
									</li>
									<li>
										Principio de veracidad o calidad de los registros o datos: La información contenida en los Bancos de Datos debe ser veraz, completa, exacta, actualizada, comprobable y comprensible. Se prohíbe el registro y divulgación de datos parciales, incompletos, fraccionados o que induzcan a error.
									</li>
									<li>
										Principio de finalidad: La administración de datos personales debe obedecer a una finalidad legítima de acuerdo con la Constitución y la ley. La finalidad debe informársele al titular de la información previa o concomitantemente con el otorgamiento de la autorización, cuando ella sea necesaria o en general siempre que el titular solicite información al respecto.
									</li>
									<li>
										Principio de acceso y circulación restringida: La administración de datos personales se sujeta a los límites que se derivan de la naturaleza de los datos, de las disposiciones de la ley y de los principios de la administración de datos personales especialmente de los principios de temporalidad de la información y la finalidad del Banco de Datos. Los datos personales, salvo la información pública, no podrán ser accesibles por Internet o por otros medios de divulgación o comunicación masiva, salvo que el acceso sea técnicamente controlable para brindar un conocimiento restringido sólo a los titulares o los usuarios autorizados conforme a la ley.
									</li>
									<li>
										Principio de temporalidad de la información: La información del titular no podrá ser suministrada a usuarios o terceros cuando deje de servir para la finalidad del Banco de Datos.
									</li>
									<li>
										Principio de interpretación integral de derechos constitucionales: Se interpretará en el sentido de que se amparen adecuadamente los derechos constitucionales, como son el Hábeas Data, el derecho al buen nombre, el derecho a la honra, el derecho a la intimidad y el derecho a la información. Los derechos de los titulares se interpretarán en armonía y en un plano de equilibrio con el derecho a la información previsto en el artículo 20 de la Constitución y con los demás derechos constitucionales aplicables.
									</li>
									<li>
										Principio de seguridad: La información que conforma los registros individuales constitutivos de los Bancos de Datos a que se refiere la ley, así como la resultante de las consultas que de ella hagan sus usuarios, se deberá manejar con las medidas técnicas que sean necesarias para garantizar la seguridad de los registros evitando su adulteración, pérdida, consulta o uso no autorizado.
									</li>
									<li>
										Principio de confidencialidad. Todas las personas naturales o jurídicas que intervengan en la administración de datos personales que no tengan la naturaleza de públicos están obligadas en todo tiempo a garantizar la reserva de la información, inclusive después de finalizada su relación con alguna de las labores que comprende la administración de datos, pudiendo sólo realizar suministro o comunicación de datos cuando ello corresponda al desarrollo de las actividades autorizadas por la ley y en los términos de la misma.
									</li>
									<li>
										Principio de transparencia: En el tratamiento de datos personales, la Entidad garantizará al titular su derecho de obtener en cualquier momento y sin restricciones, información acerca de la existencia de cualquier tipo de información o dato personal que sea de su interés o titularidad.
									</li>
									<li>
										Principio de libertad: el tratamiento de los datos personales sólo puede realizarse con el consentimiento, previo, expreso e informado del titular. Los datos personales no podrán ser obtenidos o divulgados sin previa autorización, o en ausencia de mandato legal, estatutario, o judicial que releve el consentimiento.</p>
									</li>
								</ol>
							</div>
							<hr />
							<!-- II. PROPÓSITO -->
							<div class="p-3 border bg-light">
								<br><h5>II. PROPÓSITO</h5><br>
								<p>Suministrar los lineamientos generales para la protección de los datos personales y sensibles a todos los usuarios de la Unidad Administrativa Especial de Organizaciones Solidarias, brindando herramientas que garanticen la autenticidad, integridad y confidencialidad de la información.</p>
							</div>
							<hr />
							<!-- III. DEFINICIONES -->
							<div class="p-3 border bg-light">
								<br><h5>III. DEFINICIONES</h5><br>
								<p>Para los efectos de la presente política y al tenor de la normatividad vigente en materia de protección de datos personales, se tendrán en cuenta las siguientes definiciones: Autorización: Consentimiento previo, expreso e informado del Titular para llevar a cabo el Tratamiento de datos personales.</p>
								<br>
								<h6>Aviso de privacidad:</h6>
								<p>Comunicación verbal o escrita generada por el Responsable, dirigida al Titular para el tratamiento de sus datos personales, mediante la cual se le informa acerca de la existencia de las políticas de tratamiento de información que le serán aplicables, la forma de acceder a las mismas y las finalidades del tratamiento que se pretende dar a los datos personales.</p>
								<h6>Base de Datos: </h6>
								<p>Conjunto organizado de datos personales que sea objeto de tratamiento.</p>
								<h6>Causahabiente: </h6>
								<p>persona que ha sucedido a otra por causa del fallecimiento de ésta (heredero).</p>
								<h6>Dato personal: </h6>
								<p>Cualquier información vinculada o que pueda asociarse a una o varias personas naturales determinadas o determinables.</p>
								<h6>Dato público: </h6>
								<p>Es el dato que no sea semiprivado, privado o sensible. Son considerados datos públicos, entre otros, los datos relativos al estado civil de las personas, a su profesión u oficio, a su calidad de comerciante o de servidor público. Por su naturaleza, los datos públicos pueden estar contenidos, entre otros, en registros públicos, documentos públicos, gacetas y boletines oficiales y sentencias judiciales debidamente ejecutoriadas que no estén sometidas a reserva.</p>
								<h6>Datos sensibles: </h6>
								<p>Se entiende por datos sensibles aquellos que afectan la intimidad del titular o cuyo uso indebido puede generar su discriminación, tales como que revelen el origen racial o étnico, la orientación política, las convicciones religiosas o filosóficas, la pertenencia a sindicatos, organizaciones sociales, de derechos humanos o que promueva intereses de cualquier partido político o que garanticen los derechos y garantías.</p>
								<h6>Encargado del Tratamiento: </h6>
								<p>Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, realice el Tratamiento de datos personales por cuenta del responsable del tratamiento.</p>
								<h6>Responsable del Tratamiento: </h6>
								<p>Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, decida sobre la base de datos y/o el tratamiento de los datos.</p>
								<h6>Titular: </h6>
								<p>Persona natural cuyos datos personales sean objeto de tratamiento.</p>
								<h6>Tratamiento: </h6>
								<p> Cualquier operación o conjunto de operaciones sobre datos personales, tales como la recolección, almacenamiento, uso, circulación o supresión.</p>
								<h6>Transferencia: </h6>
								<p>La transferencia de datos tiene lugar cuando el responsable y/o encargado del tratamiento de datos personales, ubicado en Colombia, envía la información o los datos personales a un receptor, que a su vez es responsable del tratamiento y se encuentra dentro o fuera del país.</p>
								<h6>Transmisión: </h6>
								<p>Tratamiento de datos personales que implica la comunicación de los mismos dentro o fuera del territorio de la República de Colombia cuando tenga por objeto la realización de un tratamiento por el encargado por cuenta del responsable.</p>
							</div>
							<hr />
							<!-- IV. DECLARACIÓN -->
							<div class="p-3 border bg-light">
								<br><h5>IV. DECLARACIÓN</h5><br>
								<p>
									La Entidad reconoce la titularidad que de los datos personales ostentan las personas y en consecuencia ellas de manera exclusiva pueden decidir sobre los mismos. Por lo tanto, La Entidad utilizará los datos personales para el cumplimiento de las finalidades autorizadas expresamente por el titular o por las normas vigentes. En el tratamiento y protección de datos personales, La Entidad tendrá los siguientes deberes, sin perjuicio de otros previstos en las disposiciones que regulen o lleguen a regular esta materia:
								</p><br>
								<ol type="A">
									<li>Garantizar al titular, en todo tiempo, el pleno y efectivo ejercicio del derecho de hábeas data</li>
									<li>Solicitar y conservar, copia de la respectiva autorización otorgada por el titular para el tratamiento de datos personales.</li>
									<li>Informar debidamente al titular sobre la finalidad de la recolección y los derechos que le asisten en virtud de la autorización otorgada</li>
									<li>Conservar la información bajo las condiciones de seguridad necesarias para impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento.</li>
									<li>Garantizar que la información sea veraz, completa, exacta, actualizada, comprobable y comprensible.</li>
									<li>Actualizar oportunamente la información, atendiendo de esta forma todas las novedades respecto de los datos del titular. Adicionalmente, se deberán implementar todas las medidas necesarias para que la información se mantenga actualizada.</li>
									<li>Rectificar la información cuando sea incorrecta y comunicar lo pertinente.</li>
									<li>Respetar las condiciones de seguridad y privacidad de la información del titular</li>
									<li>Tramitar las consultas y reclamos formulados en los términos señalados por la ley</li>
									<li>Identificar cuando determinada información se encuentra en discusión por parte del titular.</li>
									<li>Informar a solicitud del titular sobre el uso dado a sus datos</li>
									<li>Informar a la autoridad de protección de datos cuando se presenten violaciones a los códigos de seguridad y existan riesgos en la administración de la información de los titulares.</li>
									<li>Cumplir los requerimientos e instrucciones que imparta la Superintendencia de Industria y Comercio sobre el tema en particular</li>
									<li>Usar únicamente datos cuyo tratamiento esté previamente autorizado de conformidad con lo previsto en la ley 1581 de 2012.</li>
									<li>Velar por el uso adecuado de los datos personales de los niños, niñas y adolescentes, en aquellos casos en que se entra autorizado el tratamiento de sus datos.</li>
									<li>Registrar en la base de datos las leyenda "reclamo en trámite" en la forma en que se regula en la ley.</li>
									<li>Insertar en la base de datos la leyenda "información en discusión judicial" una vez notificado por parte de la autoridad competente sobre procesos judiciales relacionados con la calidad del dato personal</li>
									<li>Abstenerse de circular información que esté siendo controvertida por el titular y cuyo bloqueo haya sido ordenado por la Superintendencia de Industria y Comercio</li>
									<li>Permitir el acceso a la información únicamente a las personas que pueden tener acceso a ella</li>
									<li>Usar los datos personales del titular sólo para aquellas finalidades para las que se encuentre facultada debidamente y respetando en todo caso la normatividad vigente sobre protección de datos personales.</li>
								</ol><br>
							</div>
							<hr />
							<!-- V. RESPONSABLE DE IMPLEMENTACIÓN -->
							<div class="p-3 border bg-light">
								<br><h5>V. RESPONSABLE DE IMPLEMENTACIÓN</h5><br>
								<p>Responsable de las bases de datos: Es La Unidad Administrativa Especial de Organizaciones Solidarias a través del área responsable de la información Dirección de Investigaciones y Planeación – Grupo de Planeación y Estadística. El rol del responsable consiste en tomar las decisiones sobre las bases de datos y/o el tratamiento de los datos. Define la finalidad y la forma en que se recolectan, almacenan y administran los datos. Asimismo, está obligado a solicitar y conservar la autorización en la que conste el consentimiento expreso del titular de la información.</p>
							</div>
							<hr />
							<!-- VI. PROCESOS INVOLUCRADOS EN LA IMPLEMENTACIÓN -->
							<div class="p-3 border bg-light">
								<br><h5>VI. PROCESOS INVOLUCRADOS EN LA IMPLEMENTACIÓN</h5><br>
								<p>La presente política será aplicable a los datos personales registrados en cualquier base de datos de La Entidad cuyo titular sea una persona natural.</p>
								<p>La Entidad en todas sus actuaciones incorpora el respeto a la Protección de Datos, dando cumplimiento a cada uno de los principios establecidos en la Ley.</p>
								<p>La Entidad implementará todas las acciones y estrategias necesarias para el efectivo cumplimiento y garantía del Derechoi consagrado en la Ley Estatutaria 1581 de 2012.</p>
								<p>La Entidad dará a conocer a todos sus usuarios los derechos que se derivan de la protección de los datos personales.</p>
							</div>
							<hr />
							<!-- VII. INDICADORES -->
							<div class="p-3 border bg-light">
								<br><h5>VII. INDICADORES</h5><br>
								<ol type="1">
									<li>Uso de información por personal autorizado.</li>
									<li>Tratamiento de datos personales.</li>
								</ol>
							</div>
							<hr />
							<!-- VIII. CRONOGRAMA GENERAL DE IMPLEMENTACIÓN -->
							<div class="p-3 border bg-light">
								<br><h5>VIII. CRONOGRAMA GENERAL DE IMPLEMENTACIÓN</h5><br>
								<p>El presente documento de política de protección de datos personales entrará en vigencia desde la expedición del acto administrativo que así lo disponga.</p>
								<p>NOTA: El área responsable del tratamiento de los datos personales definirá los funcionarios y colaboradores que accederán a las bases de datos; así como, las contraseñas y procedimientos que sean necesarios. Así mismo, los colaboradores deberán seguir los lineamientos dados por el responsable del tratamiento y las políticas de tratamiento de datos personales de La Unidad.</p>
							</div>
							<hr />
							<!-- IX. ANEXOS -->
							<div class="p-3 border bg-light">
								<h5>IX. ANEXOS</h5><br>
								<p>N/A.</p>
							</div>
							<small><a title="Recurso de Politica" target="_blank" href="https://www.uaeos.gov.co/sites/default/files/archivos/POLITICA%20PROTECCION%20DE%20DATOS%20V1.pdf">Recurso de la política.</a></small>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="declino_politica">No, declino. <i class="fa fa-times" aria-hidden="true"></i></button>
				<button type="button" class="btn btn-round btn-primary text-capitalize btn-sm" id="acepto_politica">Sí, acepto. <i class="fa fa-check"></i></button>
			</div>
		</div>
	</div>
</div>
<!-- Modal confirmación Registro -->
<div class="modal fade" id="ayuda_registro" tabindex="-1" role="dialog" aria-labelledby="ayuda_registro">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="ayuda_registro">¿La información ingresada es correcta?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row" id="informacion_previa">
					<div class="col-md-6">
						<div class="form-group">
							<h6>Organización:</h6>
							<p id="modalConfOrg"></p>
						</div>
						<div class="form-group">
							<h6>NIT de la organización:</h6>
							<p id="modalConfNit"></p>
						</div>
						<div class="form-group">
							<h6>Sigla de la organización:</h6>
							<p id="modalConfSigla"></p>
						</div>
						<div class="form-group">
							<h6>Primer nombre del representante legal:</h6>
							<p id="modalConfPNRL"></p>
						</div>
						<div class="form-group">
							<h6>Segundo nombre del representante legal:</h6>
							<p id="modalConfSNRL"></p>
						</div>
						<div class="form-group">
							<h6>Primer apellido del representante legal:</h6>
							<p id="modalConfPARL"></p>
						</div>
						<div class="form-group">
							<h6>Segundo apellido del representante legal:</h6>
							<p id="modalConfSARL"></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<h6>Correo electrónico de organización:(Notificaciones)</h6>
							<p id="modalConfCOrg"></p>
						</div>
						<div class="form-group">
							<h6>Correo electrónico del representante legal:</h6>
							<p id="modalConfCRep"></p>
						</div>
						<div class="form-group">
							<h6>Primer nombre:</h6>
							<p id="modalConfPn"></p>
						</div>
						<div class="form-group">
							<h6>Primer apellido:</h6>
							<p id="modalConfPa"></p>
						</div>
						<div class="form-group">
							<h6>Nombre de usuario:</h6>
							<p id="modalConfNU"></p>
						</div>
						<div class="form-check form-check-success">
							<label class="form-check-label" for="aceptoComActo">
								<input type="checkbox" class="form-check-input " id="aceptoComActo">
								Acepto que se envíen comunicaciones y actos administrativos vía correo electrónico
							</label>
						</div>
					</div>
				</div>
				<div class="row" id="reenvio_email" style="display: none">
					<div class="container">
						<div class="jumbotron">
							<p>Si el correo no le llega en los próximos 5 minutos, y no está en la bandeja de spam, por favor, escriba otro correo electrónico (Gmail.com, Outlook.com, Yahoo.com, Hotmail.com), y de click en "Volver a enviar el correo". Si el problema persiste, contáctese con <a href="mailto:atencionalciudadano@uaeos.gov.co">atencionalciudadano@uaeos.gov.co</a></p>
							<div class="clearfix"></div>
							<hr />
							<div class="form-group">
								<label for="correo_electronico_rese">Correo electrónico de organización:*</label>
								<input type="email" class="form-control" name="correo_electronico_rese" id="correo_electronico_rese" placeholder="Correo electrónico organización">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" name="registro" disabled="disabled" id="guardar_registro" class="btn btn-success btn-sm btn-icon-text" value="Registrarme">Sí, Registrarme <i class="mdi mdi-account-check" aria-hidden="true"></i></button>
				<button type="button" id="reenvio" class="btn btn-info btn-sm btn-icon-text" value="Volver a enviar" style="display: none">Volver a enviar el correo <i class="mdi mdi-email" aria-hidden="true"></i></button>
				<button type="button" id="cerr_mod" class="btn btn-danger btn-sm btn-icon-text submit" data-dismiss="modal">No, voy a verificar <i class="mdi mdi-account-remove" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
