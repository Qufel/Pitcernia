<?php

require_once "menu.functions.php";

if(isset($_GET['new-topping']) && $_GET['new-topping'] == "") {
    $res = MenuFunctions::AddTopping($_GET['new-topping']);
    if($res->status == false) {
        $s = json_encode($res->status);
        header("Location:../9si5tS_admin_pizzas?s={$s}&m={$res->message}");
    } else {
        header("Location:../9si5tS_admin_pizzas");
    }
}