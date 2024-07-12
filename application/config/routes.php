<?php

$route['default_controller']   = 'AuthController/login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

// Authentication routes
$route['auth/register_admin'] = 'authController/register_admin';
$route['auth/register_user']  = 'authController/register_user';
$route['auth/login']          = 'authController/login';
$route['auth/logout']         = 'authController/logout';

// Admin routes
$route['dashboard/layouts'] = 'adminController/dashboard';


// User routes
$route['user/dashboard'] = 'userController/dashboard';
