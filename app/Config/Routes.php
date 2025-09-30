<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/', 'Home::landing'); 
$routes->get('home', 'Home::index', ['filter' => 'auth']);
$routes->get('home/getProductData/(:num)', 'Home::getProductData/$1');
$routes->get('cart', 'Cart::viewCart');
$routes->post('cart/add', 'Cart::add');

$routes->get('checkout/(:num)', 'Cart::checkout/$1', ['filter' => 'auth']);
$routes->post('cart/process-payment', 'Cart::processPayment', ['filter' => 'auth','as' => 'checkout.process']);
$routes->get('success', 'Cart::success', ['filter' => 'auth']);


// route login dan register memeber
$routes->get('register', 'Register::index', ['as' => 'register']);
$routes->post('register', 'Register::store', ['as' => 'register.process']);
$routes->get('login', 'Login::index', ['as' => 'login']);
$routes->post('login', 'Login::authenticate', ['as' => 'login.authenticate']);
$routes->get('logout', 'Login::logout', ['as' => 'logout']);


// route admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
  $routes->get('login', 'AuthController::login', ['as' => 'admin.login']);
  $routes->post('login', 'AuthController::authenticate', ['as' => 'admin.login.auth']);
  $routes->get('dashboard', 'DashboardController::index', ['as' => 'admin.dashboard', 'filter' => 'role:admin']);
  $routes->group('products', function($routes) {
    $routes->get('/', 'ProdukController::index',['as' => 'admin.produk']);
    $routes->get('create', 'ProdukController::create');
    $routes->post('store', 'ProdukController::store');
    $routes->get('edit/(:num)', 'ProdukController::edit/$1');
    $routes->post('update/(:num)', 'ProdukController::update/$1');
    $routes->post('delete/(:num)', 'ProdukController::delete/$1');
});

  $routes->get('logout', 'AuthController::logout', ['as' => 'admin.logout']);
});

