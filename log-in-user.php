<?php

require 'user.functions.php';

if($_POST){
    $res = UserFunctions::log_in_user($_POST['email'], $_POST['passwd']);
    $s = json_encode($res->status);
    if($res->status){
        header("Location:./");
    }else{
        header("Location:login?s={$s}&m={$res->message}");
    }
}