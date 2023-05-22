<?php

require 'user.functions.php';

$oldUser = UserFunctions::get_user_from_session();
if($_POST){

    $newUser = new User(
      $_POST['email'],
      $oldUser->passwd,
      $_POST['name'],
      $_POST['surname'],
      $_POST['phone'],
      $oldUser->email === $_POST['email'] ? 1 : 0
    );

    $res = UserFunctions::edit_user_data($oldUser, $newUser);
}

echo json_encode(["s" => $res->status,"m" => $res->message]);

