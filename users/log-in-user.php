<?php

require 'user.functions.php';

if($_POST){
    $res = UserFunctions::log_in_user($_POST['email'], $_POST['passwd']);
    $s = json_encode($res->status);
    echo json_encode(["s" => $res->status,"m" => $res->message]);
}