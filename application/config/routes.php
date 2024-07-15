<?php

$route['default_controller']   = 'AuthController/login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

// Authentication routes

$route['login']          = 'authController/login';
$route['logout']         = 'authController/logout';
$route['register']         = 'authController/register';

// Admin routes
$route['dashboard/layouts'] = 'adminController/dashboard';
$route['admin/dashboard'] = 'adminController/dashboard';


// User routes
$route['user/dashboard'] = 'userController/dashboard';
