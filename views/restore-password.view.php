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
            <form action="restore-password" method="post">
                <input type="hidden" name="em" value="<?= $_GET['em'] ?? "" ?>">
                <div class="input-group mb-3">
                    <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                    <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="passwd" placeholder="Hasło" required>
                        <label>Hasło</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                    <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" name="passwd_r" placeholder="Powtórz hasło" required>
                        <label>Powtórz hasło</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Zmień hasło</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>