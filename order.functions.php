<?php

require_once 'medoo/Medoo.php';
require_once 'menu.functions.php';
require_once 'user.functions.php';

use medoo\Medoo;

class Order {
    //pizzas that were ordered
    public $pizzas;
    //user that made an order  
    public $user;
    //order details
    public $order_num; //random unique code - AB1234
    public $order_date;
    public $city;
    public $street;
    public $building_num;
    public $apartment_num;
    public $status; //0 - aborted; 1 - in progress; 2 - finished;

    function __construct($pizzas, $user, $order_num, $order_date = null, $city, $street, $building_num, $apartment_num = null, $status = 1) {
        $this->pizzas = $pizzas;
        $this->user = $user;

        $this->order_num = $order_num;
        $this->order_date = $order_date;
        $this->city = $city;
        $this->street = $street;
        $this->building_num = $building_num;
        $this->apartment_num = $apartment_num;
        $this->status = $status;
    }

}

class OrderFunctionsStatus {
    public $status;
    public $message;

    function __construct(bool $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    function __toString()
    {
        return $this->message;
    }
}

final class OrderFunctions {

    private static $db_name = 'pitcernia';
    private static $db_server = 'localhost';
    private static $db_user = 'root';
    private static $db_passwd = '';

    public static function AddOrder (Order $order) {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $user_id = UserFunctions::get_user_id($order->user);

        $db->insert(
            'orders',
            [
                'id' => null,
                'order_num' => $order->order_num,
                'user_id' => $user_id,
                'city' => $order->city,
                'street' => $order->street,
                'building_num' => $order->building_num,
                'apartment_num' => $order->apartment_num,
                'status' => $order->status 
            ]
        );

        $inserted_id = $db->id();

        foreach($order->pizzas as $pizza) {
            $db->insert(
                'pizzas_in_order',
                [
                    'orders_id' => $inserted_id,
                    'pizzas_id' => $pizza->pizzaId,
                    'count' => $pizza->pizzaCount
                ]
            );
        }

        unset($db);
    }

    public static function GetOrders (int $user_id = -1) {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $orders_db = $user_id == -1 ? 
        $db->select(
            'orders',
            '*',
            ''
        ) :
        $db->select(
            'orders',
            '*',
            [
                'user_id' => $user_id
            ]
        );

        $pizzas = $db->select(
            'pizzas_in_order',
            '*',
            ''
        );

        $users = UserFunctions::get_all_users();

        $orders = [];

        unset($db);

        foreach($orders_db as $order_db) {
            $id = $order_db['id'];
            $ordered_pizzas = [];

            $user_id = -1;

            $pizzas_of_id = [];

            foreach($pizzas as $pizza) {
                if($pizza['orders_id'] == $id) {
                    array_push($pizzas_of_id, $pizza);
                }
            } 

            foreach($users as $user) {
                if($user['id'] == $order_db['user_id']) {
                    $user_id = $user['id'];
                    break;
                }
            }

            foreach($pizzas_of_id as $pizza) {
                array_push($ordered_pizzas, (object) array('pizzaId' => $pizza['pizzas_id'], 'pizzaCount' => $pizza['count']));
            }

            array_push(
                $orders,
                new Order(
                    $ordered_pizzas, 
                    $user_id,
                    $order_db['order_num'],
                    $order_db['order_date'],
                    $order_db['city'], 
                    $order_db['street'], 
                    $order_db['building_num'], 
                    $order_db['apartment_num'], 
                    $order_db['status'] 
                )
            );
        }


        return $orders;
    }

    public static function GetOrderByID (int $id) : Order {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $order = $db->select(
            'orders',
            '*',
            [
                'id' => $id
            ]
        )[0];

        $pizzas = $db->select(
            'pizzas_in_order',
            '*',
            [
                'orders_id' => $id
            ]
        );

        $ordered_pizzas = [];

        foreach($pizzas as $pizza) {
            array_push($ordered_pizzas, (object) array('pizzaId' => $pizza['pizzas_id'], 'pizzaCount' => $pizza['count']));
        }

        return new Order(
            $ordered_pizzas,
            $order['user_id'],
            $order['order_num'],
            $order['order_date'],
            $order['city'],
            $order['street'],
            $order['building_num'],
            $order['apartment_num'],
            $order['status'],
        );
    }

    public static function GetOrderID (Order $order) : int {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $id = $db->select(
            'orders',
            'id',
            [
                'order_num' => $order->order_num
            ]
        )[0];

        unset($db);

        return intval($id);
    }

    public static function CancelOrder (string $order_num) {
        
        if($order_num == ""){
            return;
        }
        
        echo $order_num;

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $data = $db->update(
            'orders',
            [
                'status' => 0
            ],
            [
                'order_num' => $order_num
            ]
        );

        unset($db);
    }

    public static function GetOrdersByDate (string $date) {
        $date = date($date);
        echo $date;
    }

    public static function FinalizeOrder (int $id) {

        if($id == -1){
            return;
        }

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $db->update(
            'orders',
            [
                'status' => 2
            ],
            [
                'id' => $id
            ]
        );

        unset($db);
    }

    public static function GenerateUniqueOrderNum () {
        
        $orders = self::GetOrders();
        $char_arr = str_split('ABCDEFGHIJKLMNOPRSTQUVWXYZ1234567890');

        shuffle($char_arr);
        $randomStart = rand(0,count($char_arr) - 6);
        
        $order_num = implode('',array_splice($char_arr,$randomStart,6));

        foreach($orders as $order) {
            if($order->order_num == $order_num) {
                self::GenerateUniqueOrderNum();
            }
        }
        
        return $order_num;
    }

} 