<?php

use Core\Database;
use Core\Validation;

use App\Models\User;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database(config('database'));

    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = Validation::validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ], $_POST);

    if ($validation->notValid()) {
        view('login');
        exit();
    }

    $user = $database->query(
        query: "select * from users where email = :email",
        class: User::class,
        params: compact('email')
    )->fetch();

    if ($user && password_verify($_POST['password'], $user->password)) {
        $_SESSION['auth'] = $user;

        flash()->push('message', "Seja bem-vindo " . $user->name . "!");

        header("Location: /dashboard");
        exit();
    } else {
        flash()->push('validations', ['email' => ['Usuário ou senha estão incorretos!']]);
    }
}

view('login');
