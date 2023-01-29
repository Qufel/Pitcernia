<?php
require 'views/confirm-verification.view.php';
require 'user.functions.php';

$user = UserFunctions::get_user_by_email($_GET['email']);
$code = $_GET['code'];

echo UserFunctions::verify_user($user, $code);