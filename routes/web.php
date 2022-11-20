<?php

use App\Controllers\HomeController;
use App\Controllers\AuthenticateController;
use App\Controllers\NotebookController;
use App\Controllers\OpsystemController;
use App\Controllers\ProcessorController;
use App\Controllers\MNBController;
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