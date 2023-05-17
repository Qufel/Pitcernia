<?php

require_once 'medoo/Medoo.php';

use medoo\Medoo;

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
            $pizzas[] = new Pizza($pizza['id'], $pizza['name'], $pizza['size'], $pizza['price'], self::GetToppings($pizza['id']), $pizza['img_src']);
        }

        return $pizzas;
    }

    public static function get_pizza_by_id(int $id): Pizza
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

        return new Pizza($pizza['id'], $pizza['name'], $pizza['size'], $pizza['price'], self::GetToppings($pizza['id']), $pizza['img_src']);
    }

    public static function GetPizzaSizesWithIdByName(string $name): array
    {

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

    public static function GetAllToppings()
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

    public static function AddTopping(string $topping): MenuFunctionStatus
    {

        if ($topping == "") {
            return new MenuFunctionStatus(false, "Składnik musi mieć nazwę.");
        }

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $toppings = self::GetAllToppings();

        $is_topping = array_search($topping, $toppings, true);

        if (!$is_topping) {
            return new MenuFunctionStatus(false, "Składnik już istnieje.");
        }

        $id = $db->insert(
            'toppings',
            [
                null,
                $topping
            ]
        );

        unset($db);
        return new MenuFunctionStatus(true, "Pomyślnie dodano składnik.");
    }

    public static function DeleteTopping(int $id): MenuFunctionStatus
    {
        $toppings = self::GetAllToppings();
        $exist = array_search($id, array_column($toppings, 'id'));
        if (!$exist) {
            return new MenuFunctionStatus(false, "Składnik nie istnieje.");
        }

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $pizza_toppings = $db->select(
            'pizza_toppings',
            '*'
        );

        foreach ($pizza_toppings as $d) {
            if ($d['toppings_id'] == $id) {
                return new MenuFunctionStatus(false, "Nie można usunąć składnika. Składnik jest w składzie pizzy : {$d['pizzas_id']}");
            }
        }

        unset($db);
        return new MenuFunctionStatus(true, "Pomyślnie usunięto składnik.");
    }

    public static function GetAllSizes()
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

    public static function AlterPizzas(array $pizzas) : MenuFunctionStatus
    {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));


        foreach ($pizzas as $pizza) {
            $dbPizza = self::get_pizza_by_id($pizza->id);
            $db->update(
                "pizzas",
                [
                    "name" => $pizza->name,
                    "size" => $pizza->size,
                    "price" => $pizza->price,
                    "img_src" => $pizza->img_src
                ],
                [
                    "id" => $pizza->id
                ]
            );

            $toppingsSource = (array) $dbPizza->toppings;
            $toppingsAltered = (array) $pizza->toppings;

            $toppingsDeleted = array_map(function ($t) {
                return (array) $t;
            }, $toppingsSource);
            $toppingsAdded = array_map(function ($t) {
                return (array) $t;
            }, $toppingsAltered);

            $flattenArray1 = array_map('serialize', $toppingsDeleted);
            $flattenArray2 = array_map('serialize', $toppingsAdded);

            $common = array_intersect($flattenArray1, $flattenArray2);

            $common = array_map('unserialize', $common);

            foreach($common as $c) {
                if(($key = array_search($c, $toppingsAdded)) !== false) {
                    unset($toppingsAdded[$key]);
                }
                if(($key = array_search($c, $toppingsDeleted)) !== false) {
                    unset($toppingsDeleted[$key]);
                }
            }

            foreach($toppingsDeleted as $td) {
                $db->delete(
                    'pizza_toppings',
                    [
                        "pizzas_id" => $pizza->id,
                        "toppings_id" => $td['id']
                    ]
                );
            }
            foreach($toppingsAdded as $ta) {
                $db->insert(
                    'pizza_toppings',
                    [
                        'pizzas_id' => $pizza->id,
                        'toppings_id' => $ta['id']
                    ]
                );
            }

        }

        unset($db);

        return new MenuFunctionStatus(true, "Poprawna edycja pizz.");
    }

    private static function GetToppings(int $pizza_id): array
    {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $toppings = $db->select(
            "toppings",
            [
                "[>]pizza_toppings" => ["id" => "toppings_id"],
                "[>]pizzas" => ["pizza_toppings.pizzas_id" => "id"]
            ],
            [
                "toppings.id",
                "topping"
            ],
            [
                "pizzas.id" => $pizza_id
            ]
        );

        if ($toppings == null) {
            return [];
        }

        unset($db);

        return $toppings;
    }
}
