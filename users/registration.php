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
    
    echo json_encode(["s" => $res->status,"m" => $res->message]);

}
