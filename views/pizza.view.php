<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <?php
    $id = 1;
    if(isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    }
    $pizza = MenuFunctions::get_pizza_by_id($id);
    ?>

    <input type="hidden" id="pizza-id" value="<?=$id?>">

    <div class="container d-md-flex gap-3">

        <div class="col-md-4 my-3 p-2 card bg-light text-dark">
            <img class="rounded-corners pizza-image" src="./assets/<?= $pizza->img_src ?>" alt="Zdjęcie pizzy <?= $pizza->name ?>">
        </div>
        <div class="col-md-8 my-3 card bg-light text-dark flex-fill">
            <div class="card-body">
                <div class="card-title">
                    <h3>Pizza <?= $pizza->name ?></h3>
                </div>
                <div class="d-flex flex-column">
                    <hr>
                    <h5>Składniki</h5>
                    <ul class="">
                        <?php foreach ($pizza->toppings as $ingredient) : ?>
                            <li>
                                <?= $ingredient['topping'] ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <h5>Rozmiar</h5>
                    <div class="d-flex gap-3">
                        <?php foreach (MenuFunctions::get_pizza_sizes_with_id_by_name($pizza->name) as $size) : ?>
                            <a href="pizza?id=<?= $size['id'] ?>" class="size-btn flex-fill btn <?= (int)$size['id'] == $pizza->id ? 'btn-primary' : 'btn-outline-primary' ?>">
                                <?= $size['size'] ?> cm
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>  
            </div>
            <div class="card-footer bg-light">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-start col-6 col-md-8">
                        <a href="/pitcernia/" class="btn btn-primary"><i class="bi bi-caret-left-fill"></i> Wróć</a>
                    </div>
                    <div class="d-flex justify-content-end col-6 col-md-4">
                        <?= !isset($_SESSION['user']) ? '' : '<div class="input-group">
                            <a href="/pitcernia/" id="add-to-cart-btn" class="btn btn-primary form-control w-75 text-center align-middle"><i class="bi bi-cart-plus-fill"></i> Dodaj do koszyka</a>
                            <input type="number" name="amount" id="amount-inp" value="1" class="form-control w-25" min="1" max="99">
                        </div>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "partials/footer.php" ?>

    <script src="js/add-to-cart.js"></script>

</body>

</html>