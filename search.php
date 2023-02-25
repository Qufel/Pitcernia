<?php
require "menu.functions.php";

$toppings = $_GET['toppings'] ?? null;
$size = $_GET['size'] ?? 25;
//price 

if(!is_null($toppings)){
    foreach ($toppings as $key => $value) {
        $toppings[$key] = (int)$value;
    }
}

$pizzas = MenuFunctions::get_pizzas($size,$toppings);

setcookie('pizzas',json_encode($pizzas),time()+(60*30));

header("Location: ./");