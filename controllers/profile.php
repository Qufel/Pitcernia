<?php

require "views/profile.view.php";

if(isset($_GET['edit'])){
    setcookie('edit', $_GET['edit'], time()+600);
}
