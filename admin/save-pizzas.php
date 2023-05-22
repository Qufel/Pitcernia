<?php

require_once "menu.functions.php";

if (isset($_POST['data']) && $_POST['data'] != "") {
    $pizzas = json_decode($_POST['data'])->pizzas;

    if (isset($_FILES['imgs'])) {
        $errors = [];
        $path = "../assets/";
        $ext = ['webp'];

        $allFiles = count($_FILES['imgs']['tmp_name']);

        for ($i = 0; $i < $allFiles; $i++) {

            $baseName = $_FILES['imgs']['name'][$i];
            $key = array_search($baseName, array_column($pizzas, "img_src"));

            $file_name = strval(bin2hex(random_bytes(6))) . '_' . $_FILES['imgs']['name'][$i];
            $file_tmp = $_FILES['imgs']['tmp_name'][$i];
            $file_type = $_FILES['imgs']['type'][$i];
            $file_size = $_FILES['imgs']['size'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['imgs']['name'][$i])));

            $pizzas[$key]->img_src = $file_name;

            $file = $path . $file_name;

            if (!in_array($file_ext, $ext)) {
                $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
            }

            if (empty($errors)) {
                move_uploaded_file($file_tmp, $file);
            } else {
                foreach ($errors as $error) {
                    throw new Exception($error);
                }
            }
        }
    }

    $altered = GetAlteredPizzas($pizzas);
    $res = MenuFunctions::AlterPizzas($altered);
}

function GetAlteredPizzas(array $pizzas)
{

    $dbPizzas = MenuFunctions::get_pizzas();
    $toChange = [];

    for ($i = 0; $i < count($dbPizzas); $i++) {
        $pizzaDB = new Pizza($dbPizzas[$i]->id, $dbPizzas[$i]->name, $dbPizzas[$i]->size, $dbPizzas[$i]->price, $dbPizzas[$i]->toppings, $dbPizzas[$i]->img_src);
        $pizzaAT = new Pizza($pizzas[$i]->id, $pizzas[$i]->name, $pizzas[$i]->size, $pizzas[$i]->price, $pizzas[$i]->toppings, $pizzas[$i]->img_src);
        $toChange[] = ComparePizzas($pizzaAT, $pizzaDB);
    }


    $indexes = array_keys($toChange, false);
    $pizzasToAlter = [];

    for ($i = 0; $i < count($indexes); $i++) {
        $pizzasToAlter[] = $pizzas[$indexes[$i]];
    }

    return $pizzasToAlter;
}

function ComparePizzas($pizzaA, $pizzaB)
{
    if ($pizzaA->name != $pizzaB->name) {
        return false;
    }
    if ($pizzaA->size != $pizzaB->size) {
        return false;
    }
    if ($pizzaA->price != $pizzaB->price) {
        return false;
    }
    if ($pizzaA->img_src != $pizzaB->img_src) {
        return false;
    }
    if (count($pizzaA->toppings) != count($pizzaB->toppings)) {
        return false;
    } else {

        ksort($pizzaB->toppings);
        ksort($pizzaA->toppings);

        for ($i = 0; $i < count($pizzaA->toppings); $i++) {
            if ($pizzaA->toppings[$i]->id != $pizzaB->toppings[$i]['id']) {
                return false;
            }
        }
    }

    return true;
}

function PreDump(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}
