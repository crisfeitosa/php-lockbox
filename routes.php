<?php

use Core\Route;
use App\Controllers\IndexController;
use App\Controllers\LoginController;

(new Route())
  ->get('/', IndexController::class)
  ->get('/login', [LoginController::class, 'index'])
  ->post('/login', [LoginController::class, 'login'])
->run();

die();

$controller = str_replace('/', '', parse_url($_SERVER['REQUEST_URI'])['path']);

if (!$controller) $controller = 'index';

if ( ! file_exists("../controllers/{$controller}.controller.php")) {
    abort(404);
}

require "../controllers/{$controller}.controller.php";
