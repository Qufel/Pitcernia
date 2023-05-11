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

require_once "menu.functions.php";

$toppings = MenuFunctions::GetAllToppings();
?>

<body>
    <nav class="navbar p-2 navbar-expand-md navbar-light">
        <div class="container">
            <a href="/pitcernia/" class="navbar-brand mb-0 justify order-md-0 order-1">
                <img src="assets/logo.webp" alt="" srcset="" style="height: 3rem;">
            </a>
            <div class="collapse navbar-collapse" id="navbar-nav">
                <ul class="w-100 navbar-nav d-flex gap-2 justify-content-md-end">
                    <a type="button" href="9si5tS_admin" class="btn btn-primary"><i class="bi bi-ui-checks"></i> Zarządzaj zamówieniami</a>
                    <a type="button" href="9si5tS_admin_users" class="btn btn-primary"><i class="bi bi-people-fill"></i> Zarządzaj użytkownikami</a>
                </ul>
            </div>
            <button type="button" data-bs-toggle="collapse" data-bs-target="#navbar-nav" aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler order-3">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="container d-flex flex-column gap-2 my-3">
        <section class="card">
            <div class="card-body">
                <h4 class="h4 card-title">Pizze</h4>
                <div class="table-responsive">
                    <form action="" method="">
                        <table class="table table-sm">
                            <thead>
                                <th>Zdjęcie</th>
                                <th>Nazwa</th>
                                <th>Rozmiar</th>
                                <th>Składniki</th>
                                <th>Cena</th>
                            </thead>
                            <tbody>
                                <td style="width: 10rem;">
                                    <div class="img-input">
                                        <img class="pizza-img" src="./assets/margaritha.webp" alt="margaritha.webp" srcset="">
                                        <input type="file" id="pizza-id-1"></input>
                                        <label for="pizza-id-1" class="img-inp-btn">
                                            <div>
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-text">Pizza</span>
                                        <input value="Margaritha" class="form-control form-control" type="text" placeholder="Nazwa">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input value="25" class="form-control form-control" type="number" min="0" placeholder="Rozmiar">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </td>
                                <td>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span>Mozzarella</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Sos pomidorowy</span>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-primary dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dodaj składnik</a>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($toppings as $topping) : ?>
                                                        <li>
                                                            <a class="topping-btn dropdown-item" href="#" role="button"><?= $topping['topping'] ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input value="19.99" class="form-control form-control" type="number" min="0" step=".01" placeholder="Cena">
                                        <span class="input-group-text">zł</span>
                                    </div>
                                </td>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <h4 class="h4 card-title">Składniki</h4>
                <div class="table-responsive">
                    <table class="table table-sm centered">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Składnik</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($toppings); $i++) : ?>
                                <tr>
                                    <th><?= $i + 1 ?></th>
                                    <td><?= $toppings[$i]['topping'] ?></td>
                                    <td>
                                        <form action="admin/delete-topping.php" method="get">
                                            <button type="submit" name="to-delete" value="<?= $toppings[$i]['id'] ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Usuń składnik"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <form action="admin/add-topping.php" method="get">
                                    <th scope="row">#</th>
                                    <td>
                                        <input class="w-100 form-control" type="text" name="new-topping" id="new-topping-inp" placeholder="Nowy składnik">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Dodaj składnik"><i class="bi bi-plus-lg"></i></button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <div id="error-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="h4 modal-title text-danger"><span class="badge bg-danger">!</span> Błąd</h4>
                    </div>
                    <div class="modal-body">
                        <div id="form-error-box" class="<?= isset($_GET['s']) ? (($_GET['s'] == "false") ? '' : 'd-none') : 'd-none' ?>">
                            <p id="form-error-text"><?= isset($_GET['m']) ? $_GET['m'] : '' ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="js/error-modal.js"></script>
    <script src="js/tooltip.js"></script>
    <script src="js/get-pizzas.js"></script>
</body>

</html>