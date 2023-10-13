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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Pagination principal
$route['(:num)'] = 'main/index/$1';


//inmuebles
$route['inmuebles'] = 'main/categoryProduct/inmuebles';
$route['inmuebles/(:num)'] = 'main/categoryProduct/inmuebles/$1';

$route['inmuebles/comprar-casa'] = 'main/serviceProduct/inmuebles/comprar-casa';
$route['inmuebles/comprar-casa/(:num)'] = 'main/serviceProduct/inmuebles/comprar-casa/$1';
$route['inmuebles/comprar-casa/(:any)'] = 'main/detailProduct/inmuebles/comprar-casa/$1';
$route['inmuebles/arrendar-casa'] = 'main/serviceProduct/inmuebles/arrendar-casa';
$route['inmuebles/arrendar-casa/(:num)'] = 'main/serviceProduct/inmuebles/arrendar-casa/$1';
$route['inmuebles/arrendar-casa/(:any)'] = 'main/detailProduct/inmuebles/arrendar-casa/$1';

$route['inmuebles/comprar-departamento'] = 'main/serviceProduct/inmuebles/comprar-departamento';
$route['inmuebles/comprar-departamento/(:num)'] = 'main/serviceProduct/inmuebles/comprar-departamento/$1';
$route['inmuebles/comprar-departamento/(:any)'] = 'main/detailProduct/inmuebles/comprar-departamento/$1';
$route['inmuebles/arrendar-departamento'] = 'main/serviceProduct/inmuebles/arrendar-departamento';
$route['inmuebles/arrendar-departamento/(:num)'] = 'main/serviceProduct/inmuebles/arrendar-departamento/$1';
$route['inmuebles/arrendar-departamento/(:any)'] = 'main/detailProduct/inmuebles/arrendar-departamento/$1';


//vehiculos
$route['vehiculos'] = 'main/categoryProduct/vehiculos';
$route['vehiculos/(:num)'] = 'main/categoryProduct/vehiculos/$1';
$route['vehiculos/comprar-auto'] = 'main/serviceProduct/vehiculos/comprar-auto';
$route['vehiculos/comprar-auto/(:num)'] = 'main/serviceProduct/vehiculos/comprar-auto/$1';
$route['vehiculos/comprar-auto/(:any)'] = 'main/detailProduct/vehiculos/comprar-auto/$1';





$route['Vehiculos/buses_camiones_furgones/(:any)'] = 'main/detailProduct/$1';
$route['Vehiculos/motos/(:any)'] = 'main/detailProduct/$1';
$route['Vehiculos/Autos_camionetas_4x4/(:any)'] = 'main/detailProduct/$1';

$route['Moda/Hombres/(:any)'] = 'main/detailProduct/$1';
$route['Moda/Mujeres/(:any)'] = 'main/detailProduct/$1';
$route['Moda/Niñas/(:any)'] = 'main/detailProduct/$1';
$route['Moda/Niños/(:any)'] = 'main/detailProduct/$1';
$route['Moda/Bebes/(:any)'] = 'main/detailProduct/$1';
$route['Moda/Futura_Mama/(:any)'] = 'main/detailProduct/$1';

$route['Hogar/Muebles/(:any)'] = 'main/detailProduct/$1';

$route['Empleos_y_Servicios/Oferta_de_Empleo/(:any)'] = 'main/detailProduct/$1';

$route['Deportes/Futbol/(:any)'] = 'main/detailProduct/$1';


$route['Vehiculos/(:any)'] = 'main/serviceProduct/$1';
$route['Moda/(:any)'] = 'main/serviceProduct/$1';
$route['Hogar/(:any)'] = 'main/serviceProduct/$1';
$route['Empleos_y_Servicios/(:any)'] = 'main/serviceProduct/$1';
$route['Deportes/(:any)'] = 'main/detailProduct/$1';


$route['Vehiculos'] = 'main/categoryProduct/Vehiculos';
$route['Moda'] = 'main/categoryProduct/Moda';
$route['Muebles'] = 'main/categoryProduct/Muebles';
$route['Empleos_y_Servicios'] = 'main/categoryProduct/Empleos_y_Servicios';
$route['Deportes'] = 'main/categoryProduct/Deportes';

$route['publicar'] = 'product/form';
$route['ingresar'] = 'user/login';
$route['salir'] = 'user/logout';
$route['registrar'] = 'user/register';
$route['productos'] = 'product';

$route['/'] = 'user/process';

$route['chatear'] = 'chat';
$route['chatear/(:any)'] = 'chat/$1';

$route['ayuda'] = 'help';

$route['email'] = 'Sendingemail';
