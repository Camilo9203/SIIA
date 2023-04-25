<!-- Plantilla de correo de la verificación de Cuenta -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>SIIA - Verificación de Cuenta</title>

	<style type="text/css">
		/* CLIENT-SPECIFIC STYLES */
		body,
		table,
		td,
		a {
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
		}

		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}

		img {
			-ms-interpolation-mode: bicubic;
		}

		.im {
			color: black;
		}

		/* RESET STYLES */
		img {
			border: 0;
			outline: none;
			text-decoration: none;
		}

		table {
			border-collapse: collapse !important;
		}

		body {
			margin: 0 !important;
			padding: 0 !important;
			width: 100% !important;
		}

		/* iOS BLUE LINKS */
		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}

		/* ANDROID CENTER FIX */
		div[style*="margin: 16px 0;"] {
			margin: 0 !important;
		}

		/* MEDIA QUERIES */
		@media all and (max-width:639px) {
			.wrapper {
				width: 320px !important;
				padding: 0 !important;
			}

			.container {
				width: 300px !important;
				padding: 0 !important;
			}

			.mobile {
				width: 300px !important;
				display: block !important;
				padding: 0 !important;
			}

			.img {
				width: 100% !important;
				height: auto !important;
			}

			*[class="mobileOff"] {
				width: 0px !important;
				display: none !important;
			}

			*[class*="mobileOn"] {
				display: block !important;
				max-height: none !important;
			}
		}
	</style>
</head>

<body style="margin:0; padding:0; background-color:#F2F2F2;">

	<span style="display: block; width: 720px !important; max-width: 720px; height: 1px" class="mobileOff"></span>

	<center>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#F2F2F2">
			<tr>
				<td align="center" valign="top">

					<table width="720" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
						<tr>
							<td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" valign="top">

								<table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
									<tr>
										<td align="center" valign="top">
											<img src="<?php echo base_url(); ?>assets/img/siiaheadercorreo.png" width="720" height="157" style="margin:0; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
										</td>
									</tr>
								</table>

							</td>
						</tr>
						<tr>
							<td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
						</tr>
					</table>

					<table width="720" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
						<tr>
							<td height="10" style="height:4px; line-height: 4px; background-color: #0071b9;">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" valign="top">

								<table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
									<tr>
										<td align="center" valign="top">
											<h2>Aplicación SIIA de la Unidad Administrativa Especial Organizaciones Solidarias.</h2>
											<strong><label>Nombre de la organización:</label></strong>
											<p><?php echo $organizacion; ?></p>
											<strong><label>Número NIT:</label></strong>
											<p><?php echo $nit; ?></p>
											<strong><label>Correo de contacto:</label></strong>
											<p><?php echo $to; ?></p>
											<strong><label>Representante legal:</label></strong>
											<p><?php echo $nombre_rep_legal; ?> <?php echo $apellido_rep_legal; ?></p>
											<strong><label>Nombre de usuario:</label></strong>
											<p><?php echo $nombre_usuario; ?></p>
											<p>Organizaciones Solidarias le recuerda que es importante mantener la información básica de contacto de la entidad actualizada, para facilitar el desarrollo procesos derivados de la acreditación. Le recomendamos cada vez que se realice algún cambio sea reportado por medio del SIIA. En razón a la política de manejo de datos institucional y para verificar la identidad de la organización, es necesario activar su cuenta en el siguiente link:</p><br />
											<a target="_blank" style="font-family: Arial, sans-serif; background: #0071b9; color:white; display: inline-block; text-decoration: none; line-height:40px; font-size: 18px; width:200px; box-shadow: 2px 3px #e2e2e2; font-weight: bold;" href=<?php echo base_url(); ?>activate/?tk:<?php echo $token; ?>:<?php echo $nombre_usuario; ?>>Activar mi cuenta</a>
										</td>
									</tr>
								</table>

							</td>
						</tr>
						<tr>
							<td height="30" style="font-size:10px; line-height:30px;">&nbsp;</td>
						</tr>
					</table>

					<table width="720" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#e2e2e2">
						<tr>
							<td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" valign="top">

								<table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
									<tr>
										<td align="center" valign="top">
											<small>Si tiene alguna duda puede comunicarse con nosotros a través de los siguientes canales:
												<br />
												Atención al ciudadano <a target="_blank" href="mailto:<?php echo CORREO_ATENCION ?>"><?php echo CORREO_ATENCION ?></a>
												<br />
												Chat en página web <a target="_blank" href="<?php echo PAGINA_WEB ?>">Organizaciones Solidarias</a> martes y jueves de 9 am a 12 pm.
												<br />
												Atención telefónica al <a target="_blank" href="tel:0313275252">3275252</a> Ext. 301 (Bogotá); línea gratuita nacional <a target="_blank" href="tel:018000122020">018000122020</a>
												<br />
												<a target="_blank" href="https://www.google.com/maps/place/Unidad+Administrativa+Especial+de+Organizaciones+Solidarias/@4.6035029,-74.0778588,17z/data=!3m1!4b1!4m5!3m4!1s0x8e3f99a0936dd021:0x79ff772c3f90b782!8m2!3d4.6035029!4d-74.0756701">Carrera 10 No. 15 - 22</a> Lunes a viernes de 8 a.m. a 5:00 p.m., Bogotá - Colombia.
												<br>
												Para el manual de usuario de la aplicación SIIA de <a target="_blank" href="<?php echo base_url("assets/manuales/Manual_Usuario.pdf"); ?>" target="_blank">Click aquí.</a>
											</small>
										</td>
									</tr>
								</table>

							</td>
						</tr>
						<tr>
							<td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>
	</center>
</body>

</html>
