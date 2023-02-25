<?php

require 'user.functions.php';

if (isset($_POST) && $_POST) {
    
    $user = new User(
        $_POST['email'] ?? "",
        password_hash($_POST['passwd'], PASSWORD_DEFAULT),
        $_POST['name'] ?? "",
        $_POST['surname'] ?? "",
        $_POST['phone'] ?? ""
    );

    $res = UserFunctions::register_user($user);
    $s = json_encode($res->status);
    if($res->status){
        header("Location:verify?email={$user->email}");
    }else{
        header("Location:register?s={$s}&m={$res->message}");
    }
}