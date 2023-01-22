<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Flaticon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="style.css">

    <title>Pitcernia</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a href="#" class="navbar-brand mb-0 h1">
            <i class="fi fi-rr-pizza-slice"></i>
            Pitcernia
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 d-flex">
                <div class="d-md-flex col-lg-8 col-md-6">
                    <li class="nav-item active ">
                        <a href="#" class="nav-link">
                            <i class="fi fi-rr-pizza-slice"></i>
                            Menu
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="fi fi-rr-phone-call"></i>
                            Kontakt
                        </a>
                    </li>
                </div>
                <div class="d-md-flex col-lg-4 col-md-6 justify-content-end">
                    <!--Domyślnie ukryte, aktywuje się po zalogowaniu (usuwanie klasy d-none)-->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fi fi-rr-shopping-cart"></i>
                            Koszyk
                        </a>
                    </li>
                    <!--Domyślnie ukryte, aktywuje się po zalogowaniu (usuwanie klasy d-none)-->
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle nav-link" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-user"></i>
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarUser">
                            <li>
                                <a href="#" class="dropdown-item">
                                    <i class="fi fi-rr-user"></i>
                                    Zobacz profil
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item" role="button">
                                    <i class="fi fi-rr-exit"></i>
                                    Wyloguj się
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
            </ul>
    </div>
    <button type="button" class="btn btn-outline-success" data-bs-target="#loginModal" data-bs-toggle="modal">
        Zaloguj się
    </button>
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
        <i class="fi fi-rr-menu-burger"></i>
    </button>
</nav>
<!-- Formularz logowania -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="Login Modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Zaloguj się</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="login_input" name="login" placeholder="Nazwa użytkownika">
                        <label for="login_input">Nazwa użytkownika</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="passwd_input" name="password" placeholder="Hasło">
                        <label for="passwd_input">Hasło</label>
                    </div>
                    <div class="mb-3 d-flex">
                        <a href="#">Zapomniałeś hasła?</a>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-outline-success">
                            Zaloguj się
                        </button>
                        <hr>
                        <a href="#" type="button" class="btn btn-outline-success">
                            Zarejestruj się
                        </a>
                    </div>
                  </form>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <!-- Div na konent, znaleźć sposób na wyświetlanie dynamicznie html (coś jak angular routing) -->
</div>

</body>
</html>