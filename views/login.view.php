<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container d-flex mt-3" style="min-height: calc(90vh - 20rem);">

        <div class="card form-card col-10 col-sm-8 col-md-6 col-lg-4 my-auto mx-auto">
            <div class="card-body d-flex">
                <div class="mx-auto d-flex">
                    <div class="mx-auto my-auto p-3">
                        <h3 class="card-title text-center ">Zaloguj się</h3>
                        <br>
                        <form id="log-in-user">
                            <div class="mb-3">
                                <div class="form-floating flex-grow-1">
                                    <input type="email" class="form-control" id="email_input" name="email" placeholder="Email" required>
                                    <label for="email_input">Email</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control" id="passwd_input" name="passwd" placeholder="Hasło" required>
                                    <label for="passwd_input">Hasło</label>
                                </div>
                            </div>
                            <div class="mx-auto my-3 d-flex">

                                <a href="forgot-password" class="text-muted">Zapomniałeś hasła?</a>
                            </div>
                            <div class="d-grid mb-3 gap-3">
                                <button type="submit" class="btn btn-primary ">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Zaloguj się</span>
                                </button>

                                <div id="form-error-box" class="text-danger d-none">
                                    <p><span class="badge bg-danger">!</span> <span  id="form-error-text"></span></p>
                                </div>

                                <p class="text-wrap">Nie masz jeszcze konta?
                                    <a href="register" class="link-primary text-dark">
                                        Zarejestruj się
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="spacer" style="height: 0px;"></div>

    <?php require "partials/footer.php" ?>

    <script src="js/users/log-in-user.js"></script>

</body>

</html>