<?php

require_once 'order.functions.php';

$order_num = isset($_GET['on']) ? $_GET['on'] : "";

OrderFunctions::CancelOrder($order_num);

header("Location:orders");