<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <?php require "partials/nav.php" ?>

    <div class="content-holder container d-flex justify-content-center align-items-center">
        <div class="card form-card col-lg-6 col-md-8 col-11 my-auto mx-auto">
            <div class="card-body">
                <h4 class="card-title">Zresetuj swoje hasło</h4>
                <p>Podaj nam adres email przypisany do twojego konta, a my wyślemy ci link do zresetowania swojego hasła.</p>
                <form action="forgot-password" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-at"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex col-6"><button type="submit" class="btn btn-dark">Wyślij email</button></div>
                        <div class="d-flex col-6 justify-content-end"><a href="login" class="btn btn-dark">Wróć</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>