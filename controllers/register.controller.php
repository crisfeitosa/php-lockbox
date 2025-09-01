<?php

use Core\Database;
use Core\Validation;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $database = new Database(config('database'));

    $validation = Validation::validate([
        'name' => ['required'],
        'email' => ['required', 'email', 'confirmed', 'unique:users'],
        'password' => ['required', 'min:8', 'max:30', 'strong']
    ], $_POST);

    if ($validation->notValid()) {
        view('register');
        exit();
    }

    $database->query(
        query: "insert into users (name, email, password) values (:name, :email, :password)",
        params: [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]
    );

    flash()->push('message', 'Registrado com sucesso! 👍');

    header('location: /login');
    exit();
};

view('register');
exit();
