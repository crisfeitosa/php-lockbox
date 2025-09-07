<?php

use Core\Route;

use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\RegisterController;
use App\Controllers\Notes;

use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;

(new Route())
  // Não autenticado ->
  ->get('/', IndexController::class, GuestMiddleware::class)
  ->get('/login', [LoginController::class, 'index'], GuestMiddleware::class)
  ->post('/login', [LoginController::class, 'login'], GuestMiddleware::class)
  ->get('/register', [RegisterController::class, 'index'], GuestMiddleware::class)
  ->post('/register', [RegisterController::class, 'register'], GuestMiddleware::class)

  // Autenticado ->
  ->get('/logout', LogoutController::class, AuthMiddleware::class)

  ->get('/notes', Notes\IndexController::class, AuthMiddleware::class)
  ->get('/notes/create', [Notes\CreateController ::class, 'index'], AuthMiddleware::class)
  ->post('/notes/create', [Notes\CreateController ::class, 'store'], AuthMiddleware::class)

  ->put('/note', Notes\UpdateController::class, AuthMiddleware::class)
  ->delete('/note', Notes\DeleteController::class, AuthMiddleware::class)

  ->get('/show', [Notes\PreviewController::class, 'show'], AuthMiddleware::class)
  ->get('/hide', [Notes\PreviewController::class, 'hide'], AuthMiddleware::class)

->run();
