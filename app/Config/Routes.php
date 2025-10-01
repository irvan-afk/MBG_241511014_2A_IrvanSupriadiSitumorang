<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Authcontroller::login');
$routes->post('checklogin', 'AuthController::LoginAuth');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('/logout', 'AuthController::logout');