<?php

require 'user.functions.php';

if($_POST){
    $res = UserFunctions::change_user_passwd(UserFunctions::get_user_from_session()->email,$_POST['old_passwd'],$_POST['old_r_passwd'],$_POST['new_passwd']);
}

$s = json_encode($res->status);
header("Location:profile?s=$s&m=$res->message");