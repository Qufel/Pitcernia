<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<?php

require_once "menu.functions.php";

$order_num = isset($_GET["order_num"]) ? (trim($_GET["order_num"]) == "" ? null : trim($_GET["order_num"])) : null;

$pizzas = json_decode(isset($_GET["pizzas"]) ? (trim($_GET["pizzas"]) == "" ? null : trim($_GET["pizzas"])) : null);

$pizzas = array_map(function ($pizza) {
    return ['pizza' => MenuFunctions::get_pizza_by_id($pizza->pizzaId), 'count' => $pizza->pizzaCount];
}, $pizzas);

$total_price = round(array_reduce($pizzas, function ($c, $pizza) {
    $c += $pizza['pizza']->price * $pizza['count'];
    return $c;
}), 2);

?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container content-holder d-flex justify-content-center">

        <div class="card p-3 w-100 d-flex gap-2">
            <section id="name-price-section" class="d-flex flex-row align-items-center gap-2">
                <h3 class="h3 flex-fill">Numer zamówienia: <?= $order_num ?></h3>
                <h4 class="h4 price-badge"><span id="order-price"><?= $total_price ?></span> zł</h5>
            </section>
            <hr class="dotted-hr">
            <section id="ordered-pizzas" class="d-flex flex-column gap-2">
                <?php foreach ($pizzas as $pizza) : ?>
                    <div class="cart-item d-flex flex-column flex-md-row align-items-md-center p-2 gap-2">
                        <img src="./assets/<?= $pizza['pizza']->img_src ?>" alt="<?= $pizza['pizza']->img_src ?>" class="cart-item-img d-none d-md-block">
                        <div class="cart-item-separator d-none d-md-block"></div>
                        <div class="flex-md-fill text-md-start d-flex flex-column">
                            <span class="cart-item-name"><a href="pizza?id=<?= $pizza['pizza']->id ?>" class="h5 text-dark text-decoration-none">Pizza <?= $pizza['pizza']->name ?></a></span>
                            <div>
                                <span>Rozmiar: <span class="cart-item-size"><?= $pizza['pizza']->size ?></span>cm</span>
                                <span>Składniki: <span class="cart-item-toppings"><?= implode(', ', array_map(function ($topping) {
                                                                                        return $topping['topping'];
                                                                                    }, $pizza['pizza']->toppings)) ?></span></span>
                            </div>
                        </div>
                        <div class="cart-item-separator d-none d-md-block"></div>
                        <div class="d-flex align-items-center justify-content-evenly gap-2 p-2">
                            <span class="h6"><span class="amount-display"><?= $pizza['count'] ?></span> szt.</span>
                            <div class="cart-item-separator d-none d-md-block"></div>
                            <span class="cart-item-price flex-fill order-1 order-md-0 text-md-center text-end text-md-start h6"><span class="price-badge-bellow-md"><span class="cart-item-total-price"><?= round($pizza['pizza']->price * $pizza['count'], 2) ?></span> zł</span></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>
            <hr class="dotted-hr">
            <section>
                <a href="/pitcernia/" class="btn btn-primary">Wróć do strony głównej</a>
            </section>
        </div>

    </div>

    <div class="spacer"></div>

    <?php require "partials/footer.php" ?>

    <script>
        sessionStorage.setItem("cart", JSON.stringify([]));

        var cart = JSON.parse(sessionStorage.getItem("cart"));
        var amount = cart.reduce((acc, pizza) => acc + pizza.pizzaCount, 0);

        var amountDisplay = document.querySelector("#cart-items-amount");

        if (amount > 0) {
            amountDisplay.innerHTML = amount;
        }

        UpdateNav(amount);
    </script>

</body>

</html>