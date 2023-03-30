<?php session_start(); 
    require_once "user.functions.php";
    $user = UserFunctions::get_user_by_email(json_decode($_SESSION['user'])->email);
    session_write_close();
?>

<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<?php require "partials/nav.php" ?>

<div class="container my-3">
    <div class="card">
        <div class="card-body">
            <h2>Witaj <?= $user->name ?><button type="button" onclick="window.location.href='views/admin.view.php';" class="btn btn-primary align-middle" src>Zarządzanie</button></h2>
            <div class="<?= $user->is_verified == 0 ? 'd-flex' : 'd-none'?> flex-column">   
                <hr>
                <h5>Zweryfikuj swoje konto</h5>
                <p>Aby móc skorzystać ze wszystkich funkcji naszej strony musisz zweryfikować swoje konto.</p>
                <form action="send-verification.php" method="get">
                    <input type="hidden" name="email" value="<?=$user->email ?>">
                    <button class="btn btn-primary <?= $user->is_verified == 0 ? '' : 'disabled'?>" type="submit">Wyślij link weryfikacyjny</button>
                </form>
            </div>
            <hr>
            <div class="row d-flex mb-3">
                <div class="col-6 justify-content-start align-items-center d-flex">
                    <h5 class="my-auto">Twoje dane</h5>
                </div>
                <div class="form-floating col-6 justify-content-end d-flex my-auto <?php if(!isset($_COOKIE['edit'])) {echo 'd-block';} else {echo 'd-none';}?>">
                    <button type="button" class="btn btn-primary align-middle" id="edit-user-btn"><i class="bi bi-pencil-square"></i> Zmień dane</button>
                </div>
            </div>
            <form action="edit-user-data.php" method="post">
                <div class="mb-3">
                    <table class="table table-hover table-bordered">
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
                <div class="d-flex gap-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#saveChangesModal" class="btn btn-primary <?php if(!isset($_COOKIE['edit'])) {echo 'd-none';} else {echo 'd-block';}?>"><i class="bi bi-check-lg"></i> Zapisz</button>
                    <button type="reset" id="reset_edit_form" class="btn btn-primary <?php if(!isset($_COOKIE['edit'])) {echo 'd-none';} else {echo 'd-block';}?>"><i class="bi bi-x-lg"></i> Anuluj</button>
                </div>
                <div id="form-error-box" class="text-danger <?php if(isset($_GET['s'])) { if($_GET['s'] = "false") {echo '';} else {echo 'd-none';}} else {echo 'd-none';}?>">
                   <p id="form-error-text"> <span class="badge bg-danger">!</span> <?php if(isset($_GET['m'])) {echo $_GET['m']; }?></p>
                </div>
                <div class="modal" id="saveChangesModal" tabindex="1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Czy jesteś pewien?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Czy jesteś pewien, że chcesz zapisać dokonane zmiany?
                            </div>
                            <div class="modal-footer d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <h5>Zmień hasło</h5>
            <div class="gap-3">
                <form action="change-user-passwd.php" method="post">
                    <div class="mb-3">
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="old_passwd" name="old_passwd" placeholder="Podaj stare hasło" required>
                            <label for="old_passwd">Podaj stare hasło</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="old_passwd_repeat" name="old_r_passwd" placeholder="Powtórz stare hasło" required>
                            <label for="old_passwd_repeat">Powtórz stare hasło</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="old_passwd_repeat" name="new_passwd" placeholder="Podaj nowe hasło" required>
                            <label for="old_passwd_repeat">Podaj nowe hasło</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswdModal">Zmień hasło</button>
                    <div class="modal" id="changePasswdModal" tabindex="1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Czy jesteś pewien?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Czy jesteś pewien, że chcesz zmienić swoje hasło?
                                </div>
                                <div class="modal-footer d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary">Zmień hasło</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./js/edit-user-data.js"></script>
<script src="./js/reset-edit-form.js"></script>

</body>
</html>