<?php

$baseUri = '/pitcernia/';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

/*
/pitcernia jest tymczasowe
jest to nazwa folderu w którym macie projekt
później podczas przenoszenia na localhosta wywalić
dlatego WAŻNE żeby folder z projektem nazywał sie u każdego tak samo!!!
*/

$routes = [
    $baseUri . '' => 'controllers/menu.php',
    $baseUri . 'contact' => 'controllers/contact.php',
    $baseUri . 'cart' => 'controllers/cart.php',
    $baseUri . 'profile' => 'controllers/profile.php',
    $baseUri . 'register' => 'controllers/register.php',
    $baseUri . 'verify' => 'controllers/verify.php',
    $baseUri . 'login' => 'controllers/login.php',
    $baseUri . 'confirm-verification' => 'controllers/confirm-verification.php'
];

function RouteToController($uri, $routes){
    if( array_key_exists($uri, $routes)){
        require $routes[$uri];
    }else{
        Abort(404);
    }
} 

RouteToController($uri, $routes);