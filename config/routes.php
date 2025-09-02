<?php

use Core\Route;
use App\Controllers\DashboardController;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notes;

(new Route())
  ->get('/', IndexController::class)

  ->get('/login', [LoginController::class, 'index'])
  ->post('/login', [LoginController::class, 'login'])

  ->get('/dashboard', DashboardController::class)
  ->get('/notes/create', [Notes\CreateController ::class, 'index'])
  ->post('/notes/create', [Notes\CreateController ::class, 'store'])

  ->get('/logout', LogoutController::class)

  ->get('/register', [RegisterController::class, 'index'])
  ->post('/register', [RegisterController::class, 'register'])

->run();
