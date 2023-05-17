<?php

require_once "menu.functions.php";

if(isset($_POST['data']) && $_POST['data'] != "") {
    $pizzas = json_decode($_POST['data'])->pizzas;

    PreDump($_FILES);
    PreDump($pizzas);

    $altered = GetAlteredPizzas($pizzas);
    $res = MenuFunctions::AlterPizzas($altered);
    
}

// if($res->status) {
//     header("Location:../9si5tS_admin_pizzas");
// } else {
//     $s = json_encode($res->status);
//     header("Location:../9si5tS_admin_pizzas?s={$s}&m={$res}");
// }

function GetAlteredPizzas(array $pizzas) {

    $dbPizzas = MenuFunctions::get_pizzas();
    $toChange = [];

    for ($i=0; $i < count($dbPizzas); $i++) { 
        $pizzaDB = new Pizza($dbPizzas[$i]->id,$dbPizzas[$i]->name,$dbPizzas[$i]->size,$dbPizzas[$i]->price,$dbPizzas[$i]->toppings,$dbPizzas[$i]->img_src);
        $pizzaAT = new Pizza($pizzas[$i]->id,$pizzas[$i]->name,$pizzas[$i]->size,$pizzas[$i]->price,$pizzas[$i]->toppings,$pizzas[$i]->img_src);
        $toChange[] = ComparePizzas($pizzaAT, $pizzaDB);
    }
    
    
    $indexes = array_keys($toChange, false);
    $pizzasToAlter = [];
 
    for ($i=0; $i < count($indexes); $i++) { 
        $pizzasToAlter[] = $pizzas[$indexes[$i]];
    }

    return $pizzasToAlter;
}

function ComparePizzas ($pizzaA, $pizzaB) {
    if($pizzaA->name != $pizzaB->name) {
        return false;
    }
    if($pizzaA->size != $pizzaB->size) {
        return false;
    }
    if($pizzaA->price != $pizzaB->price) {
        return false;
    }
    if($pizzaA->img_src != $pizzaB->img_src) {
        return false;
    }
    if(count($pizzaA->toppings) != count($pizzaB->toppings)) {
        return false;
    } else {
        
        ksort($pizzaB->toppings);
        ksort($pizzaA->toppings);

        for ($i=0; $i < count($pizzaA->toppings); $i++) { 
            if($pizzaA->toppings[$i]->id != $pizzaB->toppings[$i]['id']) {
                return false;
            }
        }

    }

    return true;
}

function PreDump(mixed $value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}