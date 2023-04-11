<?php

require_once "menu.functions.php";

file_put_contents("./pizzas.txt",json_encode(MenuFunctions::get_pizzas()));

require_once "views/cart.view.php";
