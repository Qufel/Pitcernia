<?php
require 'medoo/Medoo.php';
use medoo\Medoo;

$db = new Medoo(array(
    'database_type' => 'mysql',
    'database_name' => 'pitcernia',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
));

if (isset($_POST)) {
    $pitceria_db_id = $db->insert(
        'users',
        [
            'id' => null,
            'email' => $_POST['email'] ?? null,
            'passwd' => base64_encode($_POST['passwd'] ?? null),
            'name' => $_POST['fname'] ?? null,
            'surname' => $_POST['surname'] ?? null,
            'phone' => ($_POST['dialCode'] ?? null) . " " . ($_POST['phone'] ?? null),
            'post_code' => $_POST['postCode'] ?? null,
            'city' => $_POST['city'] ?? null,
            'address' => $_POST['street'] ?? null,
            'is_verified' => 0,
            'is_admin' => 0
        ]
    );
}
header("Location:register");