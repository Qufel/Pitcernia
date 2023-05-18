<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles/admin-panel.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" media="all">

    <script defer async src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script defer async src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <title>Pitcernia - Panel Zarządzania</title>
</head>

<?php
require_once "user.functions.php";
$users = UserFunctions::get_all_users();
$activeUsers = array_values(array_filter($users, function ($user) {
    return $user['is_deleted'] == 0;
}));
$deletedUsers = array_values(array_filter($users, function ($user) {
    return $user['is_deleted'] == 1;
}));
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
                    <a type="button" href="9si5tS_admin" class="btn btn-primary"><i class="bi bi-ui-checks"></i> Zarządzaj zamówieniami</a>
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
                <h4 class="h4 card-title">Aktywni użytkownicy</h4>
                <div class="table-responsive">
                    <table class="table table-sm centered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Zweryfikowany</th>
                                <th scope="col">Administrator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($activeUsers) > 0) : ?>
                                <?php for ($i = 1; $i <= count($activeUsers); $i++) : ?>
                                    <tr id="user-id-<?= $activeUsers[$i - 1]['id'] ?>">
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $activeUsers[$i - 1]['email'] ?></td>
                                        <td><?= $activeUsers[$i - 1]['name'] ?></td>
                                        <td><?= $activeUsers[$i - 1]['surname'] ?></td>
                                        <td><?= $activeUsers[$i - 1]['phone'] ?></td>
                                        <td><?= $activeUsers[$i - 1]['is_verified'] ? "TAK" : "NIE" ?></td>
                                        <td><?= $activeUsers[$i - 1]['is_admin'] ? "TAK" : "NIE" ?></td>
                                    </tr>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <h4 class="h4 card-title">Usunięci użytkownicy</h4>
                <div class="table-responsive">
                    <table class="table table-sm centered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Email</th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Telefon</th>
                                <th scope="col">Zweryfikowany</th>
                                <th scope="col">Administrator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($deletedUsers) > 0) : ?>        
                                <?php for ($i = 1; $i <= count($deletedUsers); $i++) : ?>
                                    <tr id="user-id-<?= $deletedUsers[$i - 1]['id'] ?>">
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $deletedUsers[$i - 1]['email'] ?></td>
                                        <td><?= $deletedUsers[$i - 1]['name'] ?></td>
                                        <td><?= $deletedUsers[$i - 1]['surname'] ?></td>
                                        <td><?= $deletedUsers[$i - 1]['phone'] ?></td>
                                        <td><?= $deletedUsers[$i - 1]['is_verified'] ? "TAK" : "NIE" ?></td>
                                        <td><?= $deletedUsers[$i - 1]['is_admin'] ? "TAK" : "NIE" ?></td>
                                    </tr>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</body>

</html>