<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<?php

$order_num = isset($_GET["order_num"]) ? (trim($_GET["order_num"]) == "" ? null : trim($_GET["order_num"])) : null;

$pizzas = json_decode(isset($_GET["pizzas"]) ? (trim($_GET["pizzas"]) == "" ? null : trim($_GET["pizzas"])) : null);

function PreDump(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container content-holder d-flex justify-content-center">

        <div class="card p-3 w-100 d-flex gap-2">
            <section id="name-price-section" class="d-flex flex-row align-items-center gap-2">
                <h3 class="h3 flex-fill">Numer zamówienia: <?= $order_num ?></h3>
                <h4 class="h4 price-badge"><span id="order-price">19.99</span> zł</h5>
            </section>
            <hr class="dotted-hr">
            <section id="ordered-pizzas" class="d-flex flex-column">
                <!-- example -->
                <div class="cart-item d-flex flex-column flex-md-row align-items-md-center p-2 gap-2">
                    <img src="./assets/margaritha.webp" alt="${item.pizza.img_src}" class="cart-item-img d-none d-md-block">
                    <div class="cart-item-separator d-none d-md-block"></div>
                    <div class="flex-md-fill text-md-start d-flex flex-column">
                        <span class="cart-item-name"><a href="pizza?id=1" class="h5 text-dark text-decoration-none">Pizza Margaritha</a></span>
                        <div>
                            <span>Rozmiar: <span class="cart-item-size">25</span>cm</span>
                            <span>Składniki: <span class="cart-item-toppings">Mozarella, Sos pomidorowy</span></span>
                        </div>
                    </div>
                    <div class="cart-item-separator d-none d-md-block"></div>
                    <div class="d-flex align-items-center justify-content-evenly gap-2 p-2">
                        <span class="h6"><span class="amount-display">1</span> szt.</span>
                        <div class="cart-item-separator d-none d-md-block"></div>
                        <span class="cart-item-price flex-fill order-1 order-md-0 text-md-center text-end text-md-start h6"><span class="price-badge-bellow-md"><span class="cart-item-total-price">19.99</span> zł</span></span>
                    </div>
                </div>
            </section>
            <hr class="dotted-hr">
            <section>
                <a href="/pitcernia/" class="btn btn-primary">Wróć do strony głównej</a>
            </section>
        </div>

    </div>

    <div class="spacer"></div>

    <?php require "partials/footer.php" ?>

</body>

</html>