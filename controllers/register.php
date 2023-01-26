<?php
require 'medoo/Medoo.php';
require "views/register.view.php";
use Medoo\Medoo;
$db = new Medoo(array(
    'database_type' => 'mysql',
    'database_name' => 'pitcernia',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
));
if (isset($_POST)) {
echo json_encode($_POST);

$pitceria_db_id = $db->insert(
    'users',
    [
        'id' => null,
        'email' =>$_POST['email'],
        'passwd' =>$_POST['passwd'],
        'name' =>$_POST['fname'],
        'surname'=>$_POST['surname'],
        'phone'=>$_POST['dialCode']." ".$_POST['phone'],
        'post_code'=>$_POST['postCode'],
        'city'=>$_POST['city'],
        'address'=>$_POST['street'],
    ]
);
}

//echo $trainers = $db->select('users', array('id')); 
// header("Location:views/register.view.php");

?>