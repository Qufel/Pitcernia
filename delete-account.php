<?php

require_once "user.functions.php";

$user = UserFunctions::get_user_from_session();

$res = UserFunctions::delete_user($user);

if ($res->status) {
    UserFunctions::log_out_user();
    header("Location:./");
} else {
    $s = json_encode($res->status);
    header("Location:profile?s={$s}&m={$res->message}");
}
