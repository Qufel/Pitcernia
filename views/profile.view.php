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
    session_write_close();
    ?>
    <div class="card">
        <div class="card-body">
            <h2>Witaj <?= $user->name ?></h2>
            <hr>
            <div class="row d-flex mb-3">
                <div class="col-6 justify-content-start align-items-center d-flex">
                    <h5 class="my-auto">Twoje dane</h5>
                </div>
                <div class="form-floating col-6 justify-content-end d-flex my-auto <?php if(!isset($_COOKIE['edit'])) {echo 'd-block';} else {echo 'd-none';}?>">
                    <button type="button" class="btn btn-light align-middle" id="edit-user-btn"><i class="fi fi-rr-pencil"></i> Zmień dane</button>
                    <script>
                        document.getElementById("edit-user-btn").onclick = function(){
                            document.cookie = "edit=1";
                            location.reload();
                        }
                    </script>
                </div>
            </div>
            <form action="edit-user-data.php" method="post">
                <div class="mb-3">
                    <table class="table table-hover table-bordered">
                        <tr class="table-dark">
                            <th class="col-md-3" >Dane kontaktowe</th>
                            <th></th>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Imię</th>
                            <td><input type="text" name="name" class="form-control-plaintext" value="<?= $user->name ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Nazwisko</th>
                            <td><input type="text" name="surname" class="form-control-plaintext" value="<?= $user->surname ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Telefon</th>
                            <td><input type="text" name="phone" class="form-control-plaintext" value="<?= $user->phone ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Email</th>
                            <td><input type="text" name="email" class="form-control-plaintext" value="<?= $user->email ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="mb-3">
                    <table class="table table-hover table-bordered">
                        <tr class="table-dark">
                            <th class="col-md-3">Dane dostawy</th>
                            <th></th>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Miasto</th>
                            <td><input type="text" name="city" class="form-control-plaintext" value="<?= $user->city ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Kod pocztowy</th>
                            <td><input type="text" name="post_code" class="form-control-plaintext" value="<?= $user->post_code ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                        <tr class="table-light">
                            <th class="align-middle" scope="row">Adres</th>
                            <td><input type="text" name="address" class="form-control-plaintext" value="<?= $user->address ?>" <?php if(!isset($_COOKIE['edit'])) {echo 'readonly';}?>></td>
                        </tr>
                    </table>
                </div>
                <button type="submit" class="btn btn-dark <?php if(!isset($_COOKIE['edit'])) {echo 'd-none';} else {echo 'd-block';}?>">Zapisz</button>
            </form>
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
        </div>
    </div>
</div>

</body>
</html>