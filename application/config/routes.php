<?php

$route['default_controller']   = 'AuthController'; // Set the default controller
$route['404_override']         = '';
$route['translate_uri_dashes'] = false; // Disable automatic translation of dashes to underscores

// Authentication routes
$route['auth/register_admin'] = 'authController/register_admin'; // Route for admin registration
$route['auth/register_user']  = 'authController/register_user';  // Route for user registration
$route['auth/login']          = 'authController/login';          // Route for login
$route['auth/logout']         = 'authController/logout';         // Route for logout

// Admin routes
$route['admin/dashboard'] = 'adminController/dashboard';    // Route for the admin dashboard

// User routes
$route['user/dashboard'] = 'userController/dashboard';     // Route for the user dashboard

// Optional: Additional routes
$route['admin/manage_users'] = 'adminController/manage_users';  // Example route for managing users
$route['user/profile']       = 'userController/profile';       // Example route for user profile
