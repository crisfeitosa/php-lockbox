<?php

namespace App\Controllers;

use App\Models\User;
use Core\Database;
use Core\Validation;

class LoginController {
  public function index() {
    return view('login', template: 'guest');
  }

  public function login() {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = Validation::validate([
      'email' => ['required', 'email'],
      'password' => ['required']
    ], $_POST);

    if ($validation->notValid()) {
      return view('login', template: 'guest');
    }

    $database = new Database(config('database'));

    $user = $database->query(
      query: "select * from users where email = :email",
      class: User::class,
      params: compact('email')
    )->fetch();

    if (! ($user && password_verify($_POST['password'], $user->password)) ) {
      flash()->push('validations', ['email' => ['Usuário ou senha estão incorretos!']]);

      return view('login', template: 'guest');
    }

    $_SESSION['auth'] = $user;

    flash()->push('message', "Seja bem-vindo " . $user->name . "!");

    return redirect('/notes');
  }
}