<?php
require 'user.functions.php';

if(isset($_POST['email'])){

    $email = $_POST['email'];
    $res = UserFunctions::send_passwd_restore_mail($email);
    $s = json_encode($res->status);

    if(!$res->status){
        header("Location:forgot-password?s={$s}&m={$res->message}");
    }else{
        header("Location:./");
    }
    
}

require 'views/forgot-password.view.php';