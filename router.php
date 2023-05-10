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
    $baseUri . 'pizza' => 'controllers/pizza.php',
    $baseUri . 'order-summary' => 'controllers/order-summary.php',
    $baseUri . 'orders' => 'controllers/orders.php',
    $baseUri . '9si5tS_admin' => 'controllers/admin.php',
    $baseUri . '9si5tS_admin_pizzas' => 'controllers/admin.pizzas.php',
    $baseUri . '9si5tS_admin_users' => 'controllers/admin.users.php',
];

if(array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    Abort(404);
}

function Abort($code = 404){
    http_response_code($code);
    die();
}