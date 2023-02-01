<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<?php require "partials/nav.php" ?>

<div class="container">
    <?php session_start(); 
    $user = json_decode($_SESSION['user']);
    ?>
    
    <div class="card">
        <div class="card-body">
            <h2>Witaj <?= $user->name ?></h2>
            <hr>
            <h5>Twoje dane</h5>
            <form action="#" method="post">
                <div>
                    <table class="table table-hover table-bordered">
                        <tr class="table-dark">
                            <th class="col-md-3" >Dane kontaktowe</th>
                            <th></th>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Imię</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->name ?>" readonly></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Nazwisko</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->surname ?>" readonly></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Telefon</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->phone ?>" readonly></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Email</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->email ?>" readonly></td>
                        </tr>
                    </table>
                </div>
                <div class="rounded">
                    <table class="table table-hover table-bordered">
                        <tr class="table-dark">
                            <th class="col-md-3">Dane dostawy</th>
                            <th></th>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Miasto</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->city ?>" readonly></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Kod pocztowy</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->post_code ?>" readonly></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Adres</th>
                            <td><input type="text" name="" class="form-control-plaintext" value="<?= $user->address ?>" readonly></td>
                        </tr>
                    </table>
                </div>
                <hr>
                <h5>Zmień hasło</h5>
                <div class="gap-3">
                    <form action="#" method="post">
                        <div class="input-group mb-3">
                            <input type="password" name="oldPasswd" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="newPasswd" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="newPasswdRepeat" class="form-control">
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>

    <?php session_write_close(); ?>
</div>

</body>
</html>