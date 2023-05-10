<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<?php require "partials/nav.php" ?>

<div class="container mt-3" style="min-height: calc(90vh - 20rem);">
    <div class="card form-card col-11 col-md-10 col-lg-8 col-xl-6 my-auto mx-auto">
        <div class="card-body">
            <div class="my-auto mx-auto p-3">
                <h3 class="card-title text-center">Zarejestruj się</h3>
                <form action="registration.php" method="post" class="needs-validation">
                    <br>
                    
                    <div class="d-flex gap-3">
                        <div class="mb-3 flex-fill">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="fname_input" name="name" placeholder="Imię" required>
                                <label for="fname_input">Imię</label>
                            </div>
                        </div>

                        <div class="mb-3 flex-fill">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="surname_input" name="surname" placeholder="Nazwisko" required>
                                <label for="">Nazwisko</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email_input" name="email" placeholder="Email" required>
                            <label for="email_input">Email</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="phone_input" name="phone" placeholder="Numer telefonu" required>
                            <label for="">Numer telefonu</label>
                        </div>
                    </div>

                    <div class="d-md-flex gap-3">
                        <div class="mb-3 flex-fill">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="passwd_input" name="passwd" placeholder="Hasło" required>
                                <label for="passwd_input">Hasło</label>
                            </div>
                        </div>

                        <div class="mb-3 flex-fill">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="passwd_r_input" name="passwdRepeat" placeholder="Powtórz hasło" required>
                                <label for="passwd_input">Powtórz hasło</label>
                            </div>
                        </div>
                    </div>

                    <div id="passwd-error-box" class="text-danger d-none">
                        <p><span class="badge bg-danger">!</span> <span id="passwd-error-text"></span></p>
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" class="form-check-input" name="terms" id="terms_input" required>
                        <label for="terms_input" class="form-check-label">Zapoznałem(am) się i akceptuje <a href="terms" class="text-dark">Regulamin</a></label>
                        <div class="invalid-feedback">
                            Musisz zaakceptować regulamin w celu zakończenia rejestracji.
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Zarejestruj się</button>
                    </div>

                    <div id="form-error-box" class="text-danger <?= isset($_GET['s']) ? (($_GET['s'] == "false") ? '' : 'd-none') : 'd-none' ?>">
                        <p id="form-error-text"> <span class="badge bg-danger">!</span> <?= isset($_GET['m']) ? $_GET['m'] : '' ?></p>
                    </div>

                    <p>Masz już konto? <a href="login" class="text-dark">Zaloguj się</a></p>

                </form>
                </div>
        </div>
    </div>

    <div class="spacer"></div>

</div>

<?php require_once "partials/footer.php"?>

<script src="./js/validation.js"></script>

</body>
</html>