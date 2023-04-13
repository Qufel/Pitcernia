<?php

require_once 'order.functions.php';
require_once 'user.functions.php';

$city = isset($_GET["city"]) ? (trim($_GET["city"]) == "" ? null : trim($_GET["city"])) : null; 
$street = isset($_GET["street"]) ? (trim($_GET["street"]) == "" ? null : trim($_GET["street"])) : null; 
$bNum = isset($_GET["building"]) ? (trim($_GET["building"]) == "" ? null : trim($_GET["building"])) : null; 
$aNum = isset($_GET["apartment"]) ? (trim($_GET["apartment"]) == "" ? null : trim($_GET["apartment"])) : null;
$cart = isset($_GET["cart"]) ? json_decode($_GET["cart"]) : null;

$user = UserFunctions::get_user_from_session();

if(is_null($user) || is_null($city) || is_null($street) || is_null($bNum)) {
    $fail_message = new OrderFunctionsStatus(false, "Brak kluczowych informacji.");
    $s = json_encode($fail_message->status);
    header("Location:cart?s=$s&m={$fail_message->message}");
    exit;
}

if(is_null($cart) || count($cart) == 0) {
    $fail_message = new OrderFunctionsStatus(false, "Koszyk jest pusty.");
    $s = json_encode($fail_message->status);
    header("Location:cart?s=$s&m={$fail_message->message}");
    exit;
}

$order = new Order($cart, $user, OrderFunctions::GenerateUniqueOrderNum() , $city, $street, $bNum, $aNum);
OrderFunctions::AddOrder($order);

$pizzas = json_encode($cart);

header("Location:order-summary?order_num=$order->order_num&pizzas=$pizzas");