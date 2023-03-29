<?php

session_start(); 

if(!isset($_SESSION["user"])){
    header("Location:./");
}

session_write_close();

require_once "views/profile.view.php";