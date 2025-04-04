<?php
defined('BASEPATH') OR exit('No direct script access allowed');
setlocale(LC_TIME, 'es_CO.UTF-8');
$nombre = strftime("%B",mktime(0, 0, 0, date('m'), 1, 2000));
$fecha = date('d')." de ".$nombre." del ".date('Y');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="refresh" content="7200" />
    <meta name="application-name" content="Sistema Integrado de Información de Acreditación - SIIA" />
    <meta name="description" content="Sistema Integrado de Información de Acreditación (SIIA) para entidades con interés de acreditarse en cursos de economía solidaria. Unidad Administrativa Especial de Organizaciones Solidarias." />
    <meta name="keywords" content="Organizaciones Solidarias,Sector Solidario,Cooperativas,Economía solidaria,Empresa,Social,Asociatividad,Emprendimiento,Proyectos productivos,Negocios inclusivos,Productores,Empresarios,Campesinos,Asociativo,Comercio justo,Agro,Ley 454" />
    <meta name="author" content="Unidad Solidaria" />
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery.validate.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/main.js')?>" type="text/javascript"></script>
    <meta name="revisit-after" content="30 days" />
    <meta name="distribution" content="web" />
    <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW" />
    <meta name="theme-color" content="#09476E"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="white-translucent" />
    <meta name="google-site-verification" content="DloHloB2_mQ9o7BPTd9xXEYHUeXrnWQqKGGKeuGrkLk" />
    <!-- Google -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WHVM3FM');
    </script>
    <!-- End Google Tag Manager -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-99079478-1', 'auto');
        ga('send', 'pageview');
    </script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<title>En mantenimiento</title>
<style type="text/css">

::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
<div class="container-fluid">
<div class="row-fluid">
<!-- page content -->
<div class="col-md-12">
    <a href="<?php echo PAGINA_WEB ?>"><img alt="Logo Organización Solidarias" id="logo_mantenimiento" class="img-responsive center-block" src="<?php echo base_url(); ?>assets/img/logoHeader_j9rcK84myYnuevoLogo_0.png"></a>
    <a href="<?php echo base_url(); ?>"><img alt="Logo SIIA" id="logo_mantenimiento_sia" class="img-responsive center-block" src="<?php echo base_url(); ?>assets/img/siia_logo.png"></a>
</div>
<hr/>
<div class="col-md-12">
  	<div class="col-middle">
    <div class="text-center text-center">
      <h1>SIIA en Mantenimiento.</h1>
      <h3>La Unidad Administrativa Especial de Organizaciones Solidarias, informa que las actividades relacionadas con el proceso de acreditación estarán temporalmente pausadas del 26 al 7 de diciembre de 2024. Ya que la plataforma estará en un mantenimiento preventivo.</h3>
      <h4 >Agradecemos su comprensión y los invitamos a reanudar el envío de solicitudes a partir del 8 de diciembre de 2024. Atentamente,</h4>
      <h5>Unidad Administrativa Especial de Organizaciones Solidarias</h5>
      </p>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>
<?php exit(); ?>
