<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<?php

$orders = OrderFunctions::GetOrders(UserFunctions::get_user_id(UserFunctions::get_user_from_session()));
$spendings = [];

?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container content-holder">

        <section class="d-flex flex-column w-100 gap-2">
            <div class="card d-flex p-3">
                <h3>Twoje zamówienia</h3>
            </div>
            <?php if (count($orders) == 0) : ?>
                <div class="card p-3 d-flex flex-column align-items-center">
                    <h3>Brak zamówień</h3>
                    <span>Na chwilę obecną nie wykonałeś żadnych zamówień, udaj się do <span><a href="/pitcernia/">Menu</a></span> i wybierz pizze które chcesz zamówić.</span>
                </div>
            <?php endif; ?>
            <?php foreach ($orders as $order) : ?>
                <?php
                $pizzas = array_map(function ($pizza) {
                    return ['pizza' => MenuFunctions::get_pizza_by_id($pizza->pizzaId), 'count' => $pizza->pizzaCount];
                }, $order->pizzas);
                $total_price = round(array_reduce($pizzas, function ($c, $pizza) {
                    $c += $pizza['pizza']->price * $pizza['count'];
                    return $c;
                }), 2);
                if ($order->status != 0)
                    array_push($spendings, $total_price);
                $full_address = "{$order->city}, {$order->street} {$order->building_num}" . (is_null($order->apartment_num) ? "" : "/{$order->apartment_num}");
                $order_date = new DateTime($order->order_date);
                $order_date = $order_date->format('d.m.Y, H:i');
                ?>
                <div class="card p-3 d-flex gap-1">
                    <div class="d-flex flex-row align-items-center gap-2">
                        <h5 class="h5 flex-fill">Numer zamówienia: <?= $order->order_num ?></h3>
                            <h6 class="h6 price-badge"><span id="order-price"><?= $total_price ?></span> zł
                        </h5>
                    </div>
                    <hr class="dotted-hr">
                    <div id="ordered-pizzas" class="d-flex flex-column gap-2">
                        <?php foreach ($pizzas as $pizza) : ?>
                            <div class="cart-item d-flex flex-column flex-md-row align-items-md-center p-2 gap-2">
                                <img src="./assets/<?= $pizza['pizza']->img_src ?>" alt="<?= $pizza['pizza']->img_src ?>" class="cart-item-img d-none d-md-block">
                                <div class="cart-item-separator d-none d-md-block"></div>
                                <div class="flex-md-fill text-md-start d-flex flex-column">
                                    <span class="cart-item-name"><a href="pizza?id=<?= $pizza['pizza']->id ?>" class="h6 text-dark text-decoration-none">Pizza <?= $pizza['pizza']->name ?></a></span>
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
                    </div>
                    <hr class="dotted-hr">
                    <section id="info-section" class="d-flex flex-column gap-2">
                        <div class="d-flex flex-row align-items-center gap-2">
                            <h6 class="h6">Adres zamówienia: </h6>
                            <span id="full-address"><?= $full_address ?></span>
                        </div>
                        <div class="d-flex flex-row align-items-center gap-2">
                            <h6 class="h6">Data i godzina złożenia zamówienia: </h6>
                            <span id="full-address"><?= $order_date ?></span>
                        </div>
                        <div class="d-flex flex-row align-items-center gap-2">
                            <h6 class="h6">Status zamówienia: </h6>
                            <?php if ($order->status == 1) : ?>
                                <div class="d-flex flex-row align-items-center">
                                    <h6 class="h6 badge bg-warning p-2">W trakcie realizacji</h6>
                                    <div class="d-flex">
                                        <div class="modal" id="cancel-<?= $order->order_num ?>-modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Anulowanie zamówienia</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Czy jesteś pewien, że chcesz anulować zamówienie?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="cancel-order.php?on=<?= $order->order_num ?>" class="btn btn-primary"><i class="bi bi-trash3-fill"></i> Anuluj zamówienie</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#cancel-<?= $order->order_num ?>-modal"><i class="bi bi-trash3-fill"></i></button>
                                    </div>
                                </div>
                            <?php elseif ($order->status == 2) : ?>
                                <h6 class="h6 badge bg-success p-2">Wykonane</h6>
                            <?php elseif ($order->status == 0) : ?>
                                <h6 class="h6 badge bg-danger p-2">Anulowane</h6>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            <?php endforeach; ?>
            <div class="card d-flex flex-column flex-md-row gap-2 align-items-start align-items-md-center p-3">
                <h5>Łączna kwota wydana w naszej Pitcernii:</h5>
                <span class="price-badge h6"><span><?= round(array_sum($spendings), 2) ?></span> zł</span>
            </div>
        </section>

    </div>

    <div class="spacer"></div>
    <?php require "partials/footer.php" ?>

</body>

</html>