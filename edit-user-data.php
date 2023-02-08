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
      $_POST['city'],
      $_POST['address'],
      $_POST['post_code'],
      $oldUser->email === $_POST['email'] ? 1 : 0
    );

    $res = UserFunctions::edit_user_data($oldUser, $newUser);
}

setcookie('edit','',time()-1);
unset($_COOKIE['edit']);

$s = json_encode($res->status);
header("Location:profile?s=$s&m=$res->message");