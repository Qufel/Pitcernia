<?php

require_once "menu.functions.php";

if(isset($_GET['to-delete'])) {
    $res = MenuFunctions::DeleteTopping(intval($_GET['to-delete']));
    
    if($res->status) {
        header("Location:../9si5tS_admin_pizzas");
    } else {
        $s = json_encode($res->status);
        header("Location:../9si5tS_admin_pizzas?s={$s}&m={$res}");
    }
}