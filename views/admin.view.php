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
                <h4 class="h4 card-title">Aktywne zamówienia</h4>
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
                            <tr>
                                <th scope="row">1</td>
                                <td>JP2137</td>
                                <td>
                                    <ul>
                                        <li class="d-flex justify-content-between">
                                            Pizza watykańska
                                            <span class="align-middle text-center">x3</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            Pizza kremówkowa
                                            <span class="align-middle text-center">x2</span>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    02.04.2005, 21:37
                                </td>
                                <td>
                                    Wadowice, Ul. Jana Pawła 2 21/37
                                </td>
                                <td>
                                    <a href="9si5tS_admin_users#user-id-1">Karol Wojtyła</a>
                                </td>
                                <td>
                                    21.37 zł
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="left" title="Oznacz jako wykonane"><i class="bi bi-check2-circle"></i></button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Oznacz jako anulowane"><i class="bi bi-x-circle"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <h4 class="h4 card-title">Historia zamówień</h4>
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
                    </table>
                </div>
            </div>
        </section>
        <section class="card">
            <div class="card-body">
                <h4 class="h4 card-title">Statysyki zamówień</h4>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="./bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/tooltip.js"></script>

</body>

</html>