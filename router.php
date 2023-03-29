<?php

$baseUri = '/pitcernia/';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    $baseUri . '' => 'controllers/menu.php',
    $baseUri . 'contact' => 'controllers/contact.php',
    $baseUri . 'cart' => 'controllers/cart.php',
    $baseUri . 'profile' => 'controllers/profile.php',
    $baseUri . 'register' => 'controllers/register.php',
    $baseUri . 'verify' => 'controllers/verify.php',
    $baseUri . 'login' => 'controllers/login.php',
    $baseUri . 'confirm-verification' => 'controllers/confirm-verification.php',
    $baseUri . 'restore-password' => 'controllers/restore-password.php',
    $baseUri . 'forgot-password' => 'controllers/forgot-password.php',
    $baseUri . 'pizza' => 'controllers/pizza.php'
];

$forbidennRoutes = [
    $baseUri . 'pizzas.txt',
];

if(array_key_exists($uri, $routes)) {
    require $routes[$uri];
} elseif(in_array($uri,$forbidennRoutes)) {
    Abort(403);
} else {
    Abort(404);
}

function Abort($code = 404){
    http_response_code($code);
    require "views/errors/$code.php";
    die();
}