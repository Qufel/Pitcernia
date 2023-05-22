<?php
session_start();

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
                <div class="d-flex flex-row align-items-center position-relative">
                    <h2 class="card-title flex-fill">Witaj <?= $user->name ?></h2>
                    <?= $user->is_admin == 1 ? '<a href="9si5tS_admin" type="button" class="btn btn-primary"><i class="bi bi-database-fill"></i> Panel zarządzania</a>' : '' ?>
                </div>
                <hr class="dotted-hr">
                <?= $user->is_verified == 0 ? '<div class="d-flex flex-column">
                                                    <h5>Zweryfikuj swoje konto</h5>
                                                    <p>Aby móc skorzystać ze wszystkich funkcji naszej strony musisz zweryfikować swoje konto.</p>
                                                    <form id="send-verification">
                                                        <input id="verification-email-inp" type="hidden" name="email" value="' . $user->email . '">
                                                        <button class="btn btn-primary"><i class="bi bi-send-fill"></i> Wyślij link weryfikacyjny</button>
                                                    </form>
                                                </div><hr class="dotted-hr">' : '' ?>
                <section id="user-data-section">
                    <div class="row d-flex mb-3">
                        <div class="col-6 justify-content-start align-items-center d-flex">
                            <h5 class="my-auto">Twoje dane</h5>
                        </div>
                        <div class="form-floating col-6 justify-content-end d-flex my-auto>">
                            <button type="button" class="btn btn-primary align-middle" id="edit-user-btn"><i class="bi bi-pencil-square"></i> Zmień dane</button>
                        </div>
                    </div>
                    <form id="edit-user-data">
                        <div class="mb-3">
                            <table class="table table-hover table-bordered">
                                <tr class="table-light">
                                    <th class="align-middle" scope="row">Imię</th>
                                    <td><input type="text" name="name" class="form-control-plaintext" value="<?= $user->name ?>" readonly></td>
                                </tr>
                                <tr class="table-light">
                                    <th class="align-middle" scope="row">Nazwisko</th>
                                    <td><input type="text" name="surname" class="form-control-plaintext" value="<?= $user->surname ?>" readonly></td>
                                </tr>
                                <tr class="table-light">
                                    <th class="align-middle" scope="row">Telefon</th>
                                    <td><input type="text" name="phone" class="form-control-plaintext" value="<?= $user->phone ?>" readonly></td>
                                </tr>
                                <tr class="table-light">
                                    <th class="align-middle" scope="row">Email</th>
                                    <td><input type="text" name="email" class="form-control-plaintext" value="<?= $user->email ?>" readonly></td>
                                </tr>
                            </table>
                        </div>
                        <div id="edit-btns-group" class="d-flex gap-2 d-none">
                            <button id="save-data-btn" type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Zapisz</button>
                            <button type="reset" id="reset_edit_form" class="btn btn-primary"><i class="bi bi-x-lg"></i> Anuluj</button>
                        </div>
                    </form>
                </section>
                <hr class="dotted-hr">
                <section id="change-passwd-section" class="gap-3">
                    <h5>Zmień hasło</h5>
                    <form id="ch-passwd">
                        <div class="mb-3">
                            <div class="form-floating flex-grow-1">
                                <input type="password" class="form-control" id="old-passwd" name="old_passwd" placeholder="Podaj stare hasło" required>
                                <label for="old-passwd">Podaj stare hasło</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating flex-grow-1">
                                <input type="password" class="form-control" id="old-passwd-repeat" name="old_r_passwd" placeholder="Powtórz stare hasło" required>
                                <label for="old-passwd-repeat">Powtórz stare hasło</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating flex-grow-1">
                                <input type="password" class="form-control" id="new-passwd" name="new_passwd" placeholder="Podaj nowe hasło" required>
                                <label for="new-passwd">Podaj nowe hasło</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-key-fill"></i> Zmień hasło</button>
                    </form>
                </section>
                <?= $user->is_admin == 0 ? '
                <hr class="dotted-hr">
                <section id="delete-account-section">
                    <form id="delete-account">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-trash3-fill"></i> Usuń konto</button>
                    </form>
                </section>' : '' ?>
                <div id="form-error-box" class="text-danger d-none">
                    <p><span class="badge bg-danger">!</span> <span id="form-error-text"></span></p>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="spacer"></div>

    <?php require_once "partials/footer.php" ?>

    <script src="./js/reset-edit-form.js"></script>
    <script src="./js/users/edit-user-data.js"></script>
    <script src="./js/users/change-user-passwd.js"></script>
    <script src="./js/users/delete-account.js"></script>
    <script src="./js/users/send-verification.js"></script>

</body>

</html>