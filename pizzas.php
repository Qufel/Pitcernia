<?php

require_once "menu.functions.php";

$json = [
    "pizzas" => MenuFunctions::get_pizzas(),
    "toppings" => MenuFunctions::GetAllToppings()
];

echo json_encode($json);