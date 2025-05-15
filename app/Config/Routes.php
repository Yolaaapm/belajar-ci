<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::index'); // tampilkan form login
$routes->post('login', 'AuthController::login'); // proses form login
$routes->get('logout', 'AuthController::logout'); // handle logout

$routes->get('produk', 'ProdukController::index', ['filter' => 'auth']);
$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);
$routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth']);
$routes->post('contact', 'Home::submitContact', ['filter' => 'auth']);
