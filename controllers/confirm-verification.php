<?php
require 'user.functions.php';

$user = UserFunctions::get_user_by_email($_GET['email']);
$code = $_GET['code'];

if(!$user->status){
    header("Location:confirm-verification?s={$s}&m={$res->message}");
}

$res = UserFunctions::verify_user($user, $code);
$s = json_encode($res->status);

if(!$res->status){
    header("Location:confirm-verification?s={$s}&m={$res->message}");
}

require 'views/confirm-verification.view.php';