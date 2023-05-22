<?php session_start(); ?>
<nav class="navbar navbar-expand-md navbar-light sticky-top">
    <div class="container d-flex justify-content-md-start justify-content-between" id="navbar-container">
        <a href="/pitcernia/" class="navbar-brand mb-0 justify order-md-0 order-1">
            <img src="assets/logo.webp" alt="" srcset="" style="height: 3rem;">
        </a>
        <div class="collapse navbar-collapse order-md-1 order-0" id="navbarNav">
            <ul class="navbar-nav w-100 d-flex">
                <div class="d-md-flex col-lg-8 col-md-6 gap-3">
                    <li class="nav-item mb-2 mb-md-0 <?= $_SERVER["REQUEST_URI"] === "/pitcernia/" ? 'active' : '' ?>">
                        <a type="button" href="/pitcernia/" class="nav-link nav-btn btn btn-primary text-light">
                            <i class="bi bi-grid-fill"></i>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2 mb-md-0 <?= $_SERVER["REQUEST_URI"] === "/pitcernia/contact" ? 'active' : '' ?>">
                        <a type="button" href="contact" class="nav-link nav-btn btn btn-primary text-light">
                            <i class="bi bi-telephone-fill"></i>
                            <span>Kontakt</span>
                        </a>
                    </li>
                </div>
                <div class="user-nav d-md-flex col-lg-4 col-md-6 justify-content-end">
                    <li class="nav-item mb-2 mb-md-0 <?= $_SERVER["REQUEST_URI"] === "/pitcernia/cart" ? 'active' : '' ?><?= !isset($_SESSION['user']) ? 'd-none' : 'd-block' ?>">
                        <a id="cart-btn" type="button" href="cart" class="nav-link nav-btn btn btn-primary text-light mx-md-3">
                            <i class="bi bi-cart-fill"></i>
                            <span>Koszyk</span>
                            <span id="cart-items-amount" class="badge bg-light text-primary"></span>
                        </a>
                    </li>
                    <li class="nav-item dropdown <?= $_SERVER["REQUEST_URI"] === "/pitcernia/profile" ? 'active' : '' ?> <?= !isset($_SESSION['user']) ? 'd-none' : 'd-block' ?>">
                        <a type="button" class="dropdown-toggle nav-link nav-btn btn btn-primary text-light" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-fill"></i>
                            <span>Profil</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarUser">
                            <li>
                                <a id="profile-btn" href="profile" class="dropdown-item">
                                <i class="bi bi-person-fill"></i> Zobacz profil
                                </a>
                            </li>
                            <li>
                                <a id="orders-btn" href="orders" class="dropdown-item">
                                <i class="bi bi-ui-checks"></i> Zamówienia
                                </a>
                            </li>
                            <li>
                                <button id="logout-btn" class="dropdown-item" type="button">
                                <i class="bi bi-box-arrow-left"></i> Wyloguj się
                                </button>
                            </li>
                        </ul>
                    </li>
                </div>
            </ul>
        </div>
        <div class="d-flex gap-2 order-2">
            <a type="button" href="register" class="nav-btn btn btn-primary 
            <?= !isset($_SESSION['user']) ? 'd-none d-md-block' : 'd-none' ?>">
                Zarejestruj się
            </a>
            <a type="button" href="login" class="nav-btn btn btn-primary
            <?= !isset($_SESSION['user']) ? 'd-block' : 'd-none' ?> ">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Zaloguj się</span>
            </a>
        </div>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler order-3">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <script src="js/items-in-cart.js"></script>
    <script src="js/reset-cart.js"></script>
    <script src="js/users/log-out-user.js"></script>

</nav>

<?php session_write_close(); ?>