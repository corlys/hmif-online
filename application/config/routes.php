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
$route['default_controller'] = 'welcome';
// $route['default_controller'] = 'pemilwa/Form/init_pemilwa';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//PEMIWLA
$route['pemilwa'] = 'pemilwa/Pemilwa/beginPemilwa';
$route['pemilwa/vote'] = 'pemilwa/Pemilwa/pote';
$route['pemilwa/register'] = 'pemilwa/Form/register';
$route['pemilwa/process_register'] = 'pemilwa/Form/process_register';
$route['pemilwa/init'] = 'pemilwa/Form/init_pemilwa';
$route['pemilwa/login'] = 'pemilwa/Form/login_pemilwa';
$route['pemilwa/test'] = 'pemilwa/Form/test';
$route['pemilwa/qc'] = 'pemilwa/Pemilwa/testqc';
$route['pemilwa/result'] = 'pemilwa/Pemilwa/result';
$route['pemilwa/farewell'] = 'pemilwa/Pemilwa/farewallPage';
$route['pemilwa/register/add'] = 'pemilwa/Form/register_pemilwa';

//Projek PIP
$route["projekpip"] = 'projekpip/Projekpip/index';
$route["projekpip/(:num)"] = 'projekpip/Projekpip/index/$1';
$route['projekpip/form'] = 'projekpip/Projekpip/form';
$route['projekpip/login'] = 'projekpip/Projekpip/loginInit';
$route['projekpip/loginAuth'] = 'projekpip/Projekpip/loginAuth';
$route['projekpip/register'] = 'projekpip/Projekpip/registerInit';
$route['projekpip/registerAuth'] = 'projekpip/Projekpip/registerAuth';
$route['projekpip/logout'] = 'projekpip/Projekpip/logoutAuth';
$route['projekpip/newpost'] = 'projekpip/Projekpip/newPost';
$route['projekpip/handlenewpost'] = 'projekpip/Projekpip/reqNewPost';
// $route['projekpip/ajaxPaginationData'] = 'projekpip/Projekpip/ajaxPaginationData';
$route['projekpip/test'] = 'projekpip/Projekpip/test';
