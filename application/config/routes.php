<?php

$route['default_controller']   = 'AuthController/login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

// Authentication routes
$route['auth/layouts'] = 'authController/login';

$route['login']    = 'authController/login';
$route['logout']   = 'authController/logout';
$route['register'] = 'authController/register';

// Admin routes
$route['dashboard/layouts']       = 'dashboardController/adminDashboard';
$route['dashboard-admin']         = 'dashboardController/adminDashboard';
$route['table-utilisateurs']      = 'dashboardController/usersTable';
$route['table-prospects-globale'] = 'dashboardController/prospectsTableAdmin';


// User routes
$route['dashboard']       = 'DashboardController/userDashboard';
$route['table-prospects'] = 'dashboardController/prospectsTableUser';

$route['calendrier']        = 'dashboardController/calendar';
$route['register-prospect'] = "ProspectController/registerProspect";
