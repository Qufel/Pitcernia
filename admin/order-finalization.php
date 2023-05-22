<?php

require_once "order.functions.php";

if(isset($_POST['id'], $_POST['state'])) {
    
    $orderId = $_POST['id'];
    $orderState = $_POST['state'];
    
    switch ($orderState) {
        case "done":
            OrderFunctions::FinalizeOrder($orderId);
            break;
        case "canceled":
            OrderFunctions::CancelOrder(OrderFunctions::GetOrderByID($orderId)->order_num);
            break;
        default:
            return;
    }
}