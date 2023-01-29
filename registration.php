<?php

require 'user.functions.php';

if (isset($_POST)) {
    
    $user = new User(
        $_POST['email'] ?? "",
        $_POST['passwd'] ?? "",
        $_POST['name'] ?? "",
        $_POST['surname'] ?? "",
        $_POST['phone'] ?? "",
        $_POST['city'] ?? "",
        $_POST['address'] ?? "",
        $_POST['post_code'] ?? ""
    );

    if(UserFunctions::register_user($user)){
        header("Location:verify?email={$user->email}");
    }else{
        header("Location:register");
    }
}