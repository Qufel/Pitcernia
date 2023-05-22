<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles/admin-panel.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" media="all">

    <title>Pitcernia - Panel Zarządzania</title>
</head>

<?php

require_once "admin.functions.php";
require_once "menu.functions.php";
require_once "order.functions.php";
require_once "user.functions.php";
$orders = OrderFunctions::GetOrders();

$date = $_GET['search-date'] ?? null;
if($date == "") {
    $date = null;
}

$activeOrders = array_values(array_filter($orders, function ($order) {
    if (isset($_GET['search-date']) && $_GET['search-date'] != "") {
        $date = $_GET['search-date'];
        $s = $order->status == 1;
        $d = date_format(new DateTime($order->order_date), "Y-m-d") == $date;

        return $d && $s == true;
    }
    return $order->status == 1;
}));
$historicOrders = array_values(array_filter($orders, function ($order) {
    if (isset($_GET['search-date']) && $_GET['search-date'] != "") {
        $date = $_GET['search-date'];
        $s = $order->status == 0 || $order->status == 2;
        $d = date_format(new DateTime($order->order_date), "Y-m-d") == $date;

        return $d && $s == true;
    }
    return $order->status == 0 || $order->status == 2;
}));

$earnings = AdminFunctions::GetIncomeFrom("CURRENT_DAY");

if (!is_null($date)) {

    $historicEarnings = 0;
    $activeEarnings = 0;

    foreach ($historicOrders as $order) {
        if ($order->status == 2) {
            $od = date_format(new DateTime($order->order_date), "Y-m-d");
            if ($od == $date) {
                foreach ($order->pizzas as $pizza) {
                    $count = $pizza->pizzaCount;
                    $pizza = MenuFunctions::get_pizza_by_id($pizza->pizzaId);

                    $historicEarnings += $pizza->price * $count;
                }
            }
        }
    }

    foreach ($activeOrders as $order) {
        $od = date_format(new DateTime($order->order_date), "Y-m-d");
        if ($od == $date) {
            foreach ($order->pizzas as $pizza) {
                $count = $pizza->pizzaCount;
                $pizza = MenuFunctions::get_pizza_by_id($pizza->pizzaId);

                $activeEarnings += $pizza->price * $count;
            }
        }
    }

    $earnings = $historicEarnings + $activeEarnings;
}

?>

<body>
    <nav class="navbar p-2 navbar-expand-md navbar-light">
        <div class="container">
            <a href="/pitcernia/" class="navbar-brand mb-0 justify order-md-0 order-1">
                <img src="assets/logo.webp" alt="" srcset="" style="height: 3rem;">
            </a>
            <div class="collapse navbar-collapse" id="navbar-nav">
                <ul class="w-100 navbar-nav d-flex gap-2 justify-content-md-end">
                    <a type="button" href="9si5tS_admin_pizzas" class="btn btn-primary"><i class="bi bi-grid-fill"></i> Zarządzaj menu</a>
                    <a type="button" href="9si5tS_admin_users" class="btn btn-primary"><i class="bi bi-people-fill"></i> Zarządzaj użytkownikami</a>
                </ul>
            </div>
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbar-nav" aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler order-3">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container mt-3 d-flex flex-column gap-2">
        <section class="card">
            <div class="card-body">
                <div class="d-flex flex-row align-items-center position-relative w-100">
                    <h4 class="h4 card-title">Aktywne zamówienia</h4>
                    <div class="position-absolute end-0 w-25">
                        <form action="9si5tS_admin" id="select-orders-by-date-form" class="d-flex flex-row gap-2">
                            <button class="btn btn-primary" id="reset-date-btn"><i class="bi bi-trash3-fill"></i></button>
                            <input type="date" class="form-control form-control-sm" value="<?= date_format(new DateTime($date), "Y-m-d"); ?>" name="search-date" id="search-date">
                            <button type="submit" id="search-by-date" class="btn btn-primary d-flex gap-2"><i class="bi bi-search"></i> Szukaj</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-sm centered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numer zamówienia</th>
                                <th scope="col">Pizze w zamówieniu</th>
                                <th scope="col">Data złożenia</th>
                                <th scope="col">Adres</th>
                                <th scope="col">Użytkownik</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($activeOrders); $i++) : ?>
                                <tr>
                                    <td scope="row"><?= $i + 1 ?></td>
                                    <td><?= $activeOrders[$i]->order_num ?></td>
                                    <td>
                                        <ul>
                                            <?php foreach ($activeOrders[$i]->pizzas as $pizza) : ?>
                                                <li class="d-flex justify-content-between">
                                                    <a href="9si5tS_admin_pizzas#pizza-id-<?= $pizza->pizzaId ?>">Pizza <?= MenuFunctions::get_pizza_by_id($pizza->pizzaId)->name ?> - <?= MenuFunctions::get_pizza_by_id($pizza->pizzaId)->size ?> cm</a>
                                                    <span class="align-middle text-center">x<?= $pizza->pizzaCount ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <?= date_format(new DateTime($activeOrders[$i]->order_date), "d.m.Y, H:i") ?>
                                    </td>
                                    <td>
                                        <?= $activeOrders[$i]->city ?>, <?= $activeOrders[$i]->street ?> <?= $activeOrders[$i]->building_num ?><?= !is_null($activeOrders[$i]->apartment_num) ? "/" . $activeOrders[$i]->apartment_num : "" ?>
                                    </td>
                                    <td>
                                        <a href="9si5tS_admin_users#user-id-<?= $activeOrders[$i]->user ?>">
                                            <?php $user = UserFunctions::get_user_by_id($activeOrders[$i]->user); ?> <?= $user->name ?> <?= $user->surname ?></a>
                                    </td>
                                    <td>
                                        <?= array_reduce($activeOrders[$i]->pizzas, function ($c, $pizza) {
                                            $c += MenuFunctions::get_pizza_by_id($pizza->pizzaId)->price * $pizza->pizzaCount;
                                            return $c;
                                        }, 0) ?> zł
                                    </td>
                                    <td>
                                        <form id="finalize-order-form">
                                            <button class="btn btn-success finalize-order-btn" data-order-value="done" data-order-id="<?= OrderFunctions::GetOrderID($activeOrders[$i]) ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="Oznacz jako wykonane"><i class="bi bi-check2-circle"></i></button>
                                            <button class="btn btn-danger finalize-order-btn" data-order-value="canceled" data-order-id="<?= OrderFunctions::GetOrderID($activeOrders[$i]) ?>" data-bs-toggle="tooltip" data-bs-placement="right" title="Oznacz jako anulowane"><i class="bi bi-x-circle"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <h4 class="h4 card-title">Historia zamówień</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-sm centered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numer zamówienia</th>
                                <th scope="col">Pizze w zamówieniu</th>
                                <th scope="col">Data złożenia</th>
                                <th scope="col">Adres</th>
                                <th scope="col">Użytkownik</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($historicOrders); $i++) : ?>
                                <tr>
                                    <td scope="row"><?= $i + 1 ?></td>
                                    <td><?= $historicOrders[$i]->order_num ?></td>
                                    <td>
                                        <ul>
                                            <?php foreach ($historicOrders[$i]->pizzas as $pizza) : ?>
                                                <li class="d-flex justify-content-between">
                                                    <a href="9si5tS_admin_pizzas#pizza-id-<?= $pizza->pizzaId ?>">Pizza <?= MenuFunctions::get_pizza_by_id($pizza->pizzaId)->name ?> - <?= MenuFunctions::get_pizza_by_id($pizza->pizzaId)->size ?> cm</a>
                                                    <span class="align-middle text-center">x<?= $pizza->pizzaCount ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <?= date_format(new DateTime($historicOrders[$i]->order_date), "d.m.Y, H:i") ?>
                                    </td>
                                    <td>
                                        <?= $historicOrders[$i]->city ?>, <?= $historicOrders[$i]->street ?> <?= $historicOrders[$i]->building_num ?><?= !is_null($historicOrders[$i]->apartment_num) ? "/" . $historicOrders[$i]->apartment_num : "" ?>
                                    </td>
                                    <td>
                                        <a href="9si5tS_admin_users#user-id-<?= $historicOrders[$i]->user ?>">
                                            <?php $user = UserFunctions::get_user_by_id($historicOrders[$i]->user) ?> <?= $user->name ?> <?= $user->surname ?></a>
                                    </td>
                                    <td>
                                        <?= array_reduce($historicOrders[$i]->pizzas, function ($c, $pizza) {
                                            $c += MenuFunctions::get_pizza_by_id($pizza->pizzaId)->price * $pizza->pizzaCount;
                                            return $c;
                                        }, 0) ?> zł
                                    </td>
                                    <td>
                                        <?php if ($historicOrders[$i]->status == 0) : ?>
                                            <span class="badge bg-danger p-2">Anulowane</span>
                                        <?php elseif ($historicOrders[$i]->status == 2) : ?>
                                            <span class="badge bg-success p-2">Wykonane</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <div>
                    <h4 class="h4 card-title">Statysyki zamówień</h4>
                </div>
                <hr>
                <h5>Zyski z zamówień</h5>
                <ul class="d-flex flex-column gap-2">
                    <li>Za ten dzień: <span class="badge bg-primary p-2 fs-6"><?= number_format((float)$earnings, 2, '.', ''); ?> zł</span></li>
                    <li>Za ten miesiąc: <span class="badge bg-primary p-2 fs-6"><?= number_format((float)AdminFunctions::GetIncomeFrom("CURRENT_MONTH"), 2, '.', '') ?> zł</span></li>
                    <li>Za poprzednie 12 miesięcy: <span class="badge bg-primary p-2 fs-6"><?= number_format((float)AdminFunctions::GetIncomeFrom("TWELVE_PRIOR"), 2, '.', '') ?> zł</span></li>
                </ul>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/tooltip.js"></script>
    <script src="js/admin/finalize-order.js"></script>
    <script src="js/admin/reset-date-search.js"></script>

</body>

</html>