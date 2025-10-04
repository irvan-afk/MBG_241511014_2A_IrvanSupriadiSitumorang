<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->post('/checklogin', 'AuthController::LoginAuth');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/gudang', 'GudangController::index', ['filter' => 'auth:gudang']);
$routes->get('/BahanBaku/create', 'GudangController::create', ['filter' => 'auth:gudang']);
$routes->post('/BahanBaku/Store', 'GudangController::Store', ['filter' => 'auth:gudang']);