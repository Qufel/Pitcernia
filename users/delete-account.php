<?php

require_once "user.functions.php";

$user = UserFunctions::get_user_from_session();

$res = UserFunctions::delete_user($user);

echo json_encode(["s" => $res->status,"m" => $res->message]);
