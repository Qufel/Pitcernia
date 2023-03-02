<?php
require 'user.functions.php';

if(isset($_POST['passwd']) && isset($_POST['em'])){
    $passwd = $_POST['passwd'] ?? "";
    $b64email = $_POST['em'] ?? "";
    $res = UserFunctions::restore_user_passwd($b64email, $passwd);
    $s = json_encode($res->status);

    if(!$res->status){
        header("Location:restore-password?s={$s}&m={$res->message}");
    }else{
        header("Location:./");
    }
}



require_once 'views/restore-password.view.php';
