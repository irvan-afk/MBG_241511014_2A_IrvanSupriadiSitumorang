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
$routes->get('/gudang/create', 'GudangController::create', ['filter' => 'auth:gudang']);
$routes->post('/gudang/Store', 'GudangController::Store', ['filter' => 'auth:gudang']);

$routes->get('gudang/edit/(:num)', 'GudangController::edit/$1', ['filter' => 'auth:gudang']);
$routes->post('gudang/update/(:num)', 'GudangController::update/$1', ['filter' => 'auth:gudang']);

$routes->get('gudang/delete/(:num)', 'GudangController::deleteConfirm/$1', ['filter' => 'auth:gudang']);
$routes->post('gudang/delete/(:num)', 'GudangController::delete/$1', ['filter' => 'auth:gudang']);

$routes->get('gudang/permintaan', 'GudangController::permintaanList', ['filter' => 'auth:gudang']);
$routes->post('gudang/permintaan/setujui/(:num)', 'GudangController::setujuiPermintaan/$1', ['filter' => 'auth:gudang']);
$routes->post('gudang/permintaan/tolak/(:num)', 'GudangController::tolakPermintaan/$1', ['filter' => 'auth:gudang']);

$routes->get('dapur/permintaan/status', 'DapurController::status', ['filter' => 'auth:dapur']);
$routes->get('dapur/permintaan/create', 'DapurController::create', ['filter' => 'auth:dapur']);
$routes->post('dapur/permintaan/store', 'DapurController::store', ['filter' => 'auth:dapur']);
