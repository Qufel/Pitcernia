<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container">
        <form action="" method="get">
            <div class="d-flex flex-column gap-2">
                <section id="cart-grid" class="d-flex flex-column gap-2">
                    <div class="text-center card p-3">
                        <h3>Koszyk jest pusty</h3>
                        <span>Na chwilę obecną twój koszyk jest pusty, udaj się do <span><a href="/pitcernia/">Menu</a></span> i wybierz pizze które chcesz zamówić.</span>
                    </div>
                </section>
                <div class="card p-3">
                    <form action="" method="get">

                    </form>
                </div>
            </div>
        </form>

    </div>

    <div class="spacer"></div>

    <script src="js/cart.js"></script>

    <?php require "partials/footer.php" ?>

</body>

</html>