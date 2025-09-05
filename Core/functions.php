<?php

function base_path($path) {
    return __DIR__ . "/../" . $path;
}

function redirect($uri) {
    return header('Location: ' . $uri);
}

function view($view, $data = [], $template = 'app') {
    foreach($data as $key => $value) {
        $$key = $value;
    }

    require base_path("views/template/$template.php");
}

function dd(...$dump) {
    dump($dump);
    die();
}

function dump(...$dump) {
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
}

function abort($code) {
    http_response_code($code);
    view($code);
    die();
}

function flash() {
    return new Core\Flash;
}

function config($key = null) {
    $config = require base_path('/config/config.php');

    if (strlen($key) > 0) {
        return $config[$key];
    }

    return $config;
}

function auth() {
    if(! isset($_SESSION['auth'])) {
        return null;
    }

    return $_SESSION['auth'];
}

function old($field) {
    $post = $_POST;

    if (isset($post[$field])) {
        return $post[$field];
    }

    return '';
}

function request() {
    return new Core\Request();
}
