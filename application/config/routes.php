<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/

// $route['default_controller'] = 'auth/login';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

$route['login']   = 'auth/login';
$route['logout']  = 'auth/logout';
$route['register']   = 'auth/register';
$route['forgot-password'] = 'auth/forgot_password';
$route['reset-password/(:any)'] = 'auth/reset_password/$1';
$route['set-password/(:any)'] = 'auth/set_password/$1';

$route['profile']  = 'profile';
$route['profile/(:any)']  = 'profile/$1';

$route['launch']   = 'launch';
$route['launch/(:any)'] = 'launch/$1';

$route['places']   = 'places';
$route['places/(:any)'] = 'places/$1';

$route['counters']   = 'counters';
$route['counters/(:any)'] = 'counters/$1';

$route['companies']   = 'companies';
$route['companies/(:any)'] = 'companies/$1';

$route['booking']   = 'booking';
$route['booking/(:any)'] = 'booking/$1';

$route['accounts']   = 'accounts';
$route['accounts/(:any)'] = 'accounts/$1';
// $route['booking/launch-cabin/(:any)'] = 'booking/launch_cabin/$1';
// $route['booking/launch-cabin-request/(:any)'] = 'booking/launch_cabin_request/$1';

// $route['news/create'] = 'news/create';
// $route['news/(:any)'] = 'news/view/$1';
// $route['news'] = 'news';

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

//$route['default_controller'] = 'pages/view';
