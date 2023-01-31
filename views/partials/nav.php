<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a href="<?php echo "/pitcernia/" ?>" class="navbar-brand mb-0 h1">
            <img src="assets/logo.svg" alt="" srcset="" style="height: 3rem;">
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
                    <li class="nav-item <?php 
                    if($_SERVER["REQUEST_URI"] === "/pitcernia/cart") {echo "active";}
                    if($_SESSION['user'] == "") {echo "d-none";} else {echo "d-block";}?>">
                        <a href="cart" class="nav-link">
                            <i class="fi fi-rr-shopping-cart"></i>
                            Koszyk
                        </a>
                    </li>
                    <li class="nav-item dropdown <?php 
                    if($_SERVER["REQUEST_URI"] === "/pitcernia/profile") {echo "active";} 
                    if($_SESSION['user'] == "") {echo "d-none";} else {echo "d-block";}?>">
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
                                <a href="log-out-user.php" class="dropdown-item" role="button">
                                    <i class="fi fi-rr-exit"></i>
                                    Wyloguj się
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
            </ul>
    </div>
    <a type="button" href="login" class="btn btn-dark <?php if($_SESSION['user'] != "") {echo "d-none";} ?>">
        Zaloguj się
    </a>
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
        <i class="fi fi-rr-menu-burger"></i>
    </button>
</nav>