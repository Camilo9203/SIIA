<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


if ($this->config->item('mantenimiento') == TRUE) {
	$route['default_controller'] = "Home/mantenimiento";
	$route['(:any)'] = "Home/mantenimiento";
} else {
	$route['default_controller'] = 'Home';
}

// HOME
$route['estado'] = 'Home/estadoSolicitud';
$route['facilitadores'] = 'Home/facilitadores';
// Super
$route['super/?'] = 'Super';
$route['super/panel'] = 'Super/panel';

/** Usuarios */
$route['login'] = 'Sesion';
$route['panel'] = 'Panel';
$route['registro'] = 'Registro';

//Recordar para cron por si existe algún error
$route['tiempo'] = 'Recordar/calculo_tiempo';
$route['tiempoAdmin'] = 'Recordar/recordarToAdmin';
$route['tiempoUser'] = 'Recordar/recordarToUser';
$route['tiempoUserActivation'] = 'Recordar/recordarToUserActivation';

$route['admin'] = 'Sesion/login_admin';
$route['socrata'] = 'Admin/socrata';
$route['clean_socrata'] = 'Admin/clean_socrata';
$route['get_socrata'] = 'Admin/get_socrata';
$route['llamadas'] = 'Admin/llamadas';
$route['panelAdmin/socrata'] = 'Admin/socrataPanel';
$route['panelAdmin'] = 'Admin/panel';
$route['panelAdmin/reportes'] = 'Admin/panel_reportes';
/** Administrador Organizaciones */
$route['panelAdmin/organizaciones'] = 'Organizaciones';
$route['panelAdmin/organizaciones/asignar'] = 'Organizaciones/asignar';
$route['panelAdmin/organizaciones/inscritas'] = 'Organizaciones/inscritas';
// Solicitudes
$route['panelAdmin/organizaciones/solicitudes/asignar'] = 'Solicitudes/asignar';
$route['panelAdmin/organizaciones/solicitudes/finalizadas'] = 'Solicitudes/finalizadas';
$route['panelAdmin/organizaciones/solicitudes/proceso'] = 'Solicitudes/proceso';
$route['panelAdmin/organizaciones/solicitudes/observaciones'] = 'Solicitudes/observaciones';
$route['panelAdmin/organizaciones/solicitudes/informacionSolicitud'] = 'Solicitudes/informacionSolicitud';
// Facilitadores
$route['panelAdmin/organizaciones/docentes'] = 'Admin/docentes'; // TODO: Pendiente por cambiar
$route['panelAdmin/organizaciones/docentes/asignar'] = 'Docentes/asignarDocentes';
$route['panelAdmin/organizaciones/docentes/evaluar'] = 'Docentes/evaluarDocentes';
$route['panelAdmin/contacto'] = 'Admin/contacto';
$route['panelAdmin/opciones'] = 'Admin/opciones';
$route['panelAdmin/notificacionesAntiguas'] = 'Admin/notificacionesAntiguas';
$route['panelAdmin/cambioContrasena'] = 'Admin/cambioContrasena';
$route['panelAdmin/bateriaObservaciones'] = 'Admin/bateriaObservaciones';
$route['panelAdmin/registroActividad'] = 'Admin/registroActividad';
$route['panelAdmin/opcionesSistema'] = 'Admin/opcionesSistema';
$route['panelAdmin/tiposCursos'] = 'Admin/tiposCursos';
$route['panelAdmin/nitEntidades'] = 'Nit/nitEntidades';
$route['panelAdmin/resultadosEncuesta'] = 'Admin/resultadosEncuesta';
$route['panelAdmin/modalInformacion'] = 'Admin/modalInformacion';
$route['panelAdmin/historico'] = 'Admin/historico';
$route['panelAdmin/informes'] = 'Admin/informes';
$route['panelAdmin/reportes/acreditadas'] = 'Reportes/entidadesAcreditadas';
$route['panelAdmin/reportes/historico'] = 'Reportes/entidadesHistorico';
$route['panelAdmin/reportes/asistentes'] = 'Reportes/verAsistentes';
$route['panelAdmin/reportes/docentesHabilitados'] = 'Reportes/docentesHabilitados';
$route['panelAdmin/reportes/registroTelefonico'] = 'Reportes/registroTelefonico';
$route['panelAdmin/organizaciones/solodocentes'] = 'Admin/solodocentes';
$route['panelAdmin/organizaciones/camaraComercio'] = 'Organizaciones/camara';
$route['panelAdmin/organizaciones/resoluciones/(:idOrganizacion)'] = 'Resoluciones/organizacion/$idOrganizacion';
$route['panelAdmin/organizaciones/estadoOrganizaciones'] = 'Admin/estadoOrg';
$route['panelAdmin/seguimiento'] = 'Admin/seguimiento';
// Estadísticas
$route['panelAdmin/estadisticas'] = 'Estadisticas/panel';
$route['panelAdmin/estadisticas/acreditacion'] = 'Estadisticas/acreditacion';
// Activar cuenta con token
$route['activate'] = 'Activate';
// Actualización de datos
$route['actualizacion'] = 'Update/update_info_user';
//Recodar Contrasena
$route['recordar'] = 'Recordar';
//Panel usuario
//$route['panel/contacto'] = 'Contacto';
$route['panel/contacto'] = 'Contacto';
$route['panel/contacto/ayuda'] = 'Contacto/ayuda';
$route['panel/solicitud/(:idSolicitud)'] = 'Solicitudes/solicitud/$idSolicitud';
$route['Certificado'] = 'Certificaciones/crearCertificacion';
// $route['panel/obtenerCertificado'] = 'Certificaciones/obtenerCertificado';
$route['panel/estadoSolicitud/(:idSolicitud)'] = 'Solicitudes/estadoSolicitud/$idSolicitud';
$route['panel/informeActividades'] = 'Panel/informeActividades';
$route['panel/docentes'] = 'Docentes/index';
$route['panel/planMejora'] = 'Panel/planMejora';
//Perfil Usuario
$route['panel/perfil'] = 'Perfil';
//Mapa Gestion
$route['mapa'] = 'home/mapa';
// 404 ...
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
