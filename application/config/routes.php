<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'repositorio/Ctrl_Usuario/View_Login'; // CODE IGNITER 3, POR DEFECTO NO TE PERMITE CARGAR CON SUBDIRECTORIOS EN EL COTROLLER TIENES QUE USAR MY_Router.php
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['repositorio/(:any)/(:any)'] = 'repositorio/$1/$2';
$route['repositorio/(:any)'] = 'repositorio/$1/index';

$route['brain/([a-z]+)/(:any)'] = 'brain/Ctrl_Principal/$1/$2';

$route['Principal'] = 'brain/Ctrl_Principal/index';

$route['Ingresar'] = 'brain/Ctrl_Usuario/View_Login';
$route['CuentaDetalle'] = 'brain/Ctrl_Operaciones_Creditos/View_Cuenta_Detalle';
