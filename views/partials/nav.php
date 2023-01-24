<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a href="<?php echo "/pitcernia/" ?>" class="navbar-brand mb-0 h1">
            <i class="fi fi-rr-pizza-slice"></i>
            Pitcernia
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 d-flex">
                <div class="d-md-flex col-lg-8 col-md-6">
                    <li class="nav-item <?php if($_SERVER["REQUEST_URI"] === "/pitcernia/menu") {echo "active";} ?>">
                        <a href="menu" class="nav-link">
                            <i class="fi fi-rr-pizza-slice"></i>
                            Menu
                        </a>
                    </li>
                    <li class="nav-item <?php if($_SERVER["REQUEST_URI"] === "/pitcernia/contact") {echo "active";} ?>">
                        <a href="contact" class="nav-link">
                            <i class="fi fi-rr-phone-call"></i>
                            Kontakt
                        </a>
                    </li>
                </div>
                <div class="d-md-flex col-lg-4 col-md-6 justify-content-end">
                    <!--Domyślnie ukryte, aktywuje się po zalogowaniu (usuwanie klasy d-none)-->
                    <li class="nav-item <?php if($_SERVER["REQUEST_URI"] === "/pitcernia/cart") {echo "active";} ?>">
                        <a href="cart" class="nav-link">
                            <i class="fi fi-rr-shopping-cart"></i>
                            Koszyk
                        </a>
                    </li>
                    <!--Domyślnie ukryte, aktywuje się po zalogowaniu (usuwanie klasy d-none)-->
                    <li class="nav-item dropdown <?php if($_SERVER["REQUEST_URI"] === "/pitcernia/profile") {echo "active";} ?>">
                        <a href="#" class="dropdown-toggle nav-link" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi fi-rr-user"></i>
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarUser">
                            <li>
                                <a href="profile" class="dropdown-item">
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
    <button type="button" class="btn btn-outline-primary" data-bs-target="#loginModal" data-bs-toggle="modal">
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
                <h4 class="modal-title">Zaloguj się</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login" method="post">
                    <div class="mb-3 input-group d-flex">
                        <span class="input-group-text"><i class="fi fi-rr-user"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="login_input" name="login" placeholder="Nazwa użytkownika">
                            <label for="login_input">Nazwa użytkownika</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fi fi-rr-lock"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="passwd_input" name="password" placeholder="Hasło">
                            <label for="passwd_input">Hasło</label>
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <a href="reset-password">Zapomniałeś hasła?</a>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-outline-primary">
                            Zaloguj się
                        </button>
                        <hr>
                        <a href="register" type="button" class="btn btn-outline-primary">
                            Zarejestruj się
                        </a>
                    </div>
                  </form>
            </div>

        </div>
    </div>
</div>