<?php

use App\Controllers\ApiOrderController;
use App\Controllers\HomeController;
use App\Controllers\AuthenticateController;
use App\Controllers\OrderController;
use App\Controllers\PizzaController;
use App\Controllers\RegisterController;
use App\Helpers\Route;
use App\Helpers\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', Route::get('/', [HomeController::class, 'index']));

$routes->add('login', Route::get('/login', [AuthenticateController::class, 'index']));
$routes->add('login.post', Route::post('/login/post', [AuthenticateController::class, 'login']));
$routes->add('logout', Route::get('/logout', [AuthenticateController::class, 'logout']));

$routes->add('register', Route::get('/register', [RegisterController::class, 'index']));
$routes->add('register.post', Route::post('/register/post', [RegisterController::class, 'register']));

$routes->add('pizzas.index', Route::get('/pizzas', [PizzaController::class, 'index']));
$routes->add('pizzas.create', Route::get('/pizzas/create', [PizzaController::class, 'create']));
$routes->add('pizzas.store', Route::post('/pizzas/store', [PizzaController::class, 'store']));

$routes->add('api.orders.index', Route::get('/api/orders', [ApiOrderController::class, 'index']));
$routes->add('api.orders.store', Route::post('/api/orders/store', [ApiOrderController::class, 'store']));
$routes->add('api.orders.update', Route::put('/api/orders/update', [ApiOrderController::class, 'update']));
$routes->add('api.orders.delete', Route::put('/api/orders/delete', [ApiOrderController::class, 'delete']));

$routes->add('orders', Route::get('/orders', [OrderController::class, 'index']));
$routes->add('orders.export', Route::get('/orders/export', [OrderController::class, 'export']));
$routes->add('orders.download', Route::post('/orders/download', [OrderController::class, 'download']));
$routes->add('orders.chart', Route::get('/orders/chart', [OrderController::class, 'chart']));
$routes->add('orders.create', Route::get('/orders/create', [OrderController::class, 'create']));