<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="content-holder container d-flex justify-content-center align-items-center">
        <div class="card form-card col-lg-6 col-md-8 col-11 my-auto mx-auto">
            <div class="card-body">
                <h4 class="card-title">Zresetuj swoje hasło</h4>
                <p>Podaj nam adres email przypisany do twojego konta, a my wyślemy ci link do zresetowania swojego hasła.</p>
                <form action="forgot-password" method="post">
                    <div class="form-floating flex-grow-1 mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                        <label>Email</label>
                    </div>
                    <div class="row">
                        <div class="d-flex col-6"><button type="submit" class="btn btn-primary">Wyślij mail</button></div>
                        <div class="d-flex col-6 justify-content-end"><a href="login" class="btn btn-primary">Wróć</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>