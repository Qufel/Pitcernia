<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container mt-3">
        <div class="d-flex flex-column gap-2">
            <section id="sort-section" class="card p-2 d-flex flex-row gap-2">
                <div class="flex-fill">
                    <button type="button" id="clear-btn" class="btn btn-primary"><i class="bi bi-trash3-fill"></i> Wyczyść koszyk</button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="price-sort-btn">Cena <span id="price-sort"><i class="bi bi-caret-down-fill"></i></span></button>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="quantity-sort-btn">Ilość <span id="quantity-sort"><i class="bi bi-caret-down-fill"></i></span></button>
                </div>
            </section>
            <section id="cart-grid" class="d-flex flex-column gap-2">
                <div class="text-center card p-3">
                    <h3>Koszyk jest pusty</h3>
                    <span>Na chwilę obecną twój koszyk jest pusty, udaj się do <span><a href="/pitcernia/">Menu</a></span> i wybierz pizze które chcesz zamówić.</span>
                </div>
            </section>
            <div class="card p-3">
                <form action="make-order.php" method="get">
                    <input type="hidden" id="cart-content" name="cart" value="">
                    <section id="summury-section" class="d-flex align-items-center">
                        <div class="flex-fill d-flex align-items-center">
                            <h5 class="h5">Razem: <span class="price-badge"><span id="total-price">0</span> zł</span></h5>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary p-fit"><i class="bi bi-credit-card-fill"></i> Złóż zamówienie</button>
                        </div>
                    </section>
                    <hr class="dotted-hr">
                    <h5>Dane adresowe</h5>
                    <section id="location-section" class="d-flex flex-column flex-md-row gap-2">
                        <div class="d-flex flex-column flex-md-row gap-2 flex-fill">
                            <div class="mb-2 flex-fill">
                                <label for="city-inp" class="form-label">Miasto</label>
                                <input type="text" name="city" id="city-inp" class="form-control" placeholder="Miasto" required>
                            </div class="mb-2">
                            <div class="mb-2 flex-fill">
                                <label for="street-inp" class="form-label">Ulica</label>
                                <input type="text" name="street" id="street-inp" class="form-control" placeholder="Ulica" required>
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-2">
                            <div class="mb-2">
                                <label for="b-num-inp" class="form-label">Numer domu</label>
                                <input type="text" name="building" id="b-num-inp" class="form-control" placeholder="Numer domu" required>
                            </div class="mb-2">
                            <div class="mb-2">
                                <label for="a-num-inp" class="form-label">Numer mieszkania</label>
                                <input type="text" name="apartment" id="a-num-inp" class="form-control" placeholder="Numer mieszkania">
                            </div>
                        </div>
                    </section>
                    <div id="form-error-box" class="text-danger <?= isset($_GET['s']) ? (($_GET['s'] == "false") ? '' : 'd-none') : 'd-none' ?>">
                        <p id="form-error-text"> <span class="badge bg-danger">!</span> <?= isset($_GET['m']) ? $_GET['m'] : '' ?></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="spacer"></div>

    <script src="js/cart.js"></script>

    <?php require "partials/footer.php" ?>

</body>

</html>