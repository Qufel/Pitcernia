<?php

require_once 'order.functions.php';
require_once 'user.functions.php';

$city = isset($_GET["city"]) ? trim($_GET["city"]) : null; 
$street = isset($_GET["street"]) ? trim($_GET["street"]) : null; 
$bNum = isset($_GET["building"]) ? trim($_GET["building"]) : null; 
$aNum = isset($_GET["apartment"]) ? trim($_GET["apartment"]) : null;
$cart = isset($_GET["cart"]) ? json_decode($_GET["cart"]) : null;

$user = UserFunctions::get_user_from_session();

if(is_null($user) || is_null($city) || is_null($street) || is_null($bNum) || is_null($cart) || is_null($cart) ? true : count($cart) == 0) {
    echo "Error";
    exit;
}

function PreDump(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

// $order = new Order($cart, $user, OrderFunctions::GenerateUniqueOrderNum() , $city, $street, $bNum, $aNum);
// OrderFunctions::AddOrder($order);

PreDump(OrderFunctions::GetAllOrders());