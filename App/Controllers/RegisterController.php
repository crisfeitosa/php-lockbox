<?php

namespace App\Controllers;

class RegisterController {
  public function index() {
    return view('register');
  }

  public function register() {
    echo "registerController.register";
  }
}