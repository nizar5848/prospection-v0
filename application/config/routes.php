<?php

$route['default_controller']   = 'AuthController/login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

// Authentication routes
$route['auth/layouts'] = 'authController/login';

$route['login']         = 'authController/login';
$route['logout']        = 'authController/logout';
$route['register']      = 'authController/register';
$route['register_user'] = 'dashboardController/register';

// Admin routes
$route['dashboard/layouts']       = 'dashboardController/adminDashboard';
$route['dashboard-admin']         = 'dashboardController/adminDashboard';
$route['table-utilisateurs']      = 'dashboardController/usersTable';
$route['table-prospects-globale'] = 'dashboardController/prospectsTableAdmin';


// User routes
$route['dashboard']                      = 'DashboardController/userDashboard';
$route['statistiques']                   = 'DashboardController/statistiques';
$route['table-prospects']                = 'dashboardController/prospectsTableUser';
$route['table-prospects-nouveau']        = 'dashboardController/prospectsTableUserNouveau';
$route['table-prospects-contacte']       = 'dashboardController/prospectsTableUserContacte';
$route['table-prospects-en_negociation'] = 'dashboardController/prospectsTableUserEnNegociation';
$route['table-prospects-converti']       = 'dashboardController/prospectsTableUserConverti';
$route['table-prospects-perdu']          = 'dashboardController/prospectsTableUserPerdu';


$route['register-prospect'] = "ProspectController/registerProspect";

// calendrier
$route['calendar/display_event'] = 'calendar/display_event';
$route['calendar/save_event']    = 'calendar/save_event';
$route['calendrier']             = 'calendar/index';
$route['calendar/update_event']  = 'calendar/update_event';

//Delete User

$route['supprimer-user'] = 'dashboardController/delete_user';

// rappels

$route['rappels']                      = 'rappelsController/rappels';
$route['rappels/create']               = 'rappelsController/create';
$route['rappels/switch_status/(:num)'] = 'rappelsController/switch_status/$1';

//Prospects à contacter

$route['prospects-contacter'] = 'ProspectController/active_prospects';
