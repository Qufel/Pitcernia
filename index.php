<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="style.css">

    <title>Pitcernia</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">
                    Pitcernia
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon">
                     </span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-3">
                            <a href="#" class="nav-link d-flex">
                                <i class="fi fi-rr-pizza-slice"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#" class="nav-link d-flex">
                                <i class="fi fi-rr-shopping-cart"></i>
                                <p>Koszyk</p>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <button class="btn dropdown-toggle text-center" id="user-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fi fi-rr-user"></i>
                                Profil
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="#user-btn" id="user-dropdown">
                                <li>
                                    <a href="#" class="btn dropdown-item d-flex">
                                        <i class="fi fi-rr-user"></i>
                                        <p>Zobacz profil</p>
                                    </a>
                                </li>
                                <li>
                                    <button type="button" class="btn d-flex">
                                        <i class="fi fi-rr-exit"></i>
                                        <p>Wyloguj się</p>
                                    </button>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item mx-3">
                            <button type="button" id="login_btn" class="btn text-center" data-bs-toggle="modal" data-bs-target="#login_modal">
                                <i class="fi fi-rr-enter"></i>
                                Zaloguj się
                            </button>
                            <div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="#login_btn" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Zaloguj się</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <!-- Formularz logowania -->
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
                                        <div class="mb-3 d-grid gap-3">
                                            <button type="submit" class="btn btn-primary">
                                                Zaloguj się
                                            </button>
                                        </div>
                                        <div class="mb-3">
                                        <hr>
                                        </div>
                                        <div class="mb-3 d-grid gap-3">
                                            <button type="button" class="btn btn-primary">
                                                Zarejestruj się
                                            </button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-11"></div>
    </div>
</div>

</body>
</html>