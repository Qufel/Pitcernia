<?php

require 'medoo/Medoo.php';

use medoo\Medoo;
use PHPMailer\PHPMailer\PHPMailer;

class Pizza
{

    public $id, $name, $size, $price, $toppings, $img_src;

    public function __construct($id, $name, $size, $price, $toppings, $img_src)
    {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
        $this->price = $price;
        $this->toppings = $toppings;
        $this->img_src = $img_src;
    }

    public function __toString()
    {
        return $this->name;
    }
}

class MenuFunctionStatus
{
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

final class MenuFunctions
{

    private static $db_name = 'pitcernia';
    private static $db_server = 'localhost';
    private static $db_user = 'root';
    private static $db_passwd = '';

    public static function get_pizzas(): array
    {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $pizzasDb = $db->select(
            'pizzas',
            '*',
            []
        );

        unset($db);

        $pizzas = array();

        foreach ($pizzasDb as $pizza) {
            $pizzas[] = new Pizza($pizza['id'], $pizza['name'], $pizza['size'], $pizza['price'], self::get_toppings($pizza['toppings']), $pizza['img_src']);
        }

        return $pizzas;
    }

    public static function get_pizza_by_id(int $id) : Pizza
    {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $pizza = $db->select(
            'pizzas',
            '*',
            [
                'id' => $id
            ]
        )[0];

        unset($db);

        return new Pizza($pizza['id'], $pizza['name'], $pizza['size'], $pizza['price'], self::get_toppings($pizza['toppings']), $pizza['img_src']);
    }

    public static function get_pizza_sizes_with_id_by_name(string $name) : Array {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $pizzas = $db->select(
            'pizzas',
            [
                'id',
                'size'
            ],
            [
                'name' => $name
            ]
        );

        unset($db);

        return $pizzas;

    }

    public static function get_all_toppings()
    {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $toppings = $db->select(
            'toppings',
            '*',
            []
        );

        unset($db);

        return $toppings;
    }

    public static function get_all_sizes()
    {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $sizes = $db->select(
            'pizzas',
            '@size',
            []
        );

        unset($db);

        return $sizes;
    }

    private static function get_toppings(string $toppingIDs): array
    {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $ids = explode(',', $toppingIDs);

        $toppings = $db->select(
            'toppings',
            '*',
            [
                'id' => $ids
            ]
        );

        unset($db);

        return $toppings;
    }
}
