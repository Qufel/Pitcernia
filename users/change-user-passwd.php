<?php

require 'user.functions.php';

if($_POST){
    $res = UserFunctions::change_user_passwd(UserFunctions::get_user_from_session()->email,$_POST['old-passwd'],$_POST['old-r-passwd'],$_POST['new-passwd']);
}

echo json_encode(["s" => $res->status,"m" => $res->message]);
