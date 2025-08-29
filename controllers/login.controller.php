<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = Validation::validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ], $_POST);

    if ($validation->notValid()) {
        header("Location: /login");
        exit();
    }

    $user = $database->query(
        query: "select * from users where email = :email",
        class: User::class,
        params: compact('email')
    )->fetch();

    if ($user) {
        $passwordPost = $_POST['password'];
        $passwordDB = $user->password;

        if (! password_verify($passwordPost, $passwordDB)) {
            flash()->push('validations_login', ['Usuário ou senha estão incorretos!']);

            header('Location: /login');
            exit();
        }

        $_SESSION['auth'] = $user;

        flash()->push('message', "Seja bem-vindo " . $user->name . "!");

        header("Location: /");
        exit();
    }
}

view('login');
