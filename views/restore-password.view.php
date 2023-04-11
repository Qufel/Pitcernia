<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="content-holder container d-flex justify-content-center align-items-center">
        <div class="card col-md-6 col-11 my-auto mx-auto">
            <div class="card-body">
                <h4>Odzyskiwanie hasła</h4>
                <p>Podaj swoje nowe hasło:</p>
                <form action="restore-password" method="post" class="">
                    <input type="hidden" name="em" value="<?= $_GET['em'] ?? "" ?>">
                    <div class="form-floating flex-grow-1 mb-3">
                        <input type="password" class="form-control" name="passwd" placeholder="Hasło" required>
                        <label>Hasło</label>
                    </div>
                    <div class="form-floating flex-grow-1 mb-3">
                        <input type="password" class="form-control" name="passwd_r" placeholder="Powtórz hasło" required>
                        <label>Powtórz hasło</label>
                    </div>
                    <div id="passwd-error-box" class="text-danger d-none">
                        <p><span class="badge bg-danger">!</span> <span id="passwd-error-text"></span></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Zmień hasło</button>
                </form>
            </div>
        </div>
    </div>

    <?php require "partials/footer.php" ?>

    <script src="./js/validation.js"></script>

</body>

</html>