<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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