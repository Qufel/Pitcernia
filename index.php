<?php
require 'router.php';

function Abort($code = 404){
    http_response_code($code);
    require "views/errors/$code.php";
    die();
}
