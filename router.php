<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

/*
/pitcernia jest tymczasowe
jest to nazwa folderu w którym macie projekt
później podczas przenoszenia na localhosta wywalić
dlatego WAŻNE żeby folder z projektem nazywał sie u każdego tak samo!!!
*/

$routes = [
    '/pitcernia/' => 'controllers/home.php',
    '/pitcernia/menu' => 'controllers/menu.php',
    '/pitcernia/contact' => 'controllers/contact.php',
    '/pitcernia/cart' => 'controllers/cart.php',
    '/pitcernia/profile' => 'controllers/profile.php',
    '/pitcernia/register' => 'controllers/register.php',
    '/pitcernia/login' => 'controllers/login.php'
];

function RouteToController($uri, $routes){
    if( array_key_exists($uri, $routes)){
        require $routes[$uri];
    }else{
        Abort(404);
    }
} 

RouteToController($uri, $routes);