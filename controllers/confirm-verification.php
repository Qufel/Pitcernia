<?php
require 'user.functions.php';

if (isset($_GET['email'], $_GET['code'])) {
    $user = UserFunctions::get_user_by_email($_GET['email']);
    $code = $_GET['code'];

    if ($user instanceof UserFunctionStatus) {
        if (!$user->status) {
            $s = json_encode($user->status);
            exit();
        }
    } else {
        $res = UserFunctions::verify_user($user, $code);
        $s = json_encode($res->status);

        header("Location:confirm-verification?s={$s}&m={$res->message}");
        exit();
    }
}

require_once 'views/confirm-verification.view.php';