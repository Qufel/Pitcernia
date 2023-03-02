<?php

require "menu.functions.php";

file_put_contents("./pizzas.txt",json_encode(MenuFunctions::get_pizzas()));

require "views/menu.view.php";
