<?php

require 'user.functions.php';

if($_POST){
    if(UserFunctions::log_in_user($_POST['email'], $_POST['passwd'])){
        header("Location:./");
    }else{
        header("Location:login");
    }
}