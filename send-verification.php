<?php
require 'user.functions.php';

echo $user = UserFunctions::get_user_by_email($_GET['email']);
echo $user->send_verification_mail();

header("Location:./");