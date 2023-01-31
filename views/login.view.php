<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<?php require "partials/nav.php" ?>

<div class="container">
    
    <div class="card form-card">
        <div class="card-body d-flex">
            <div class="col-md-6 mx-auto d-flex">
                <div class="mx-md-auto my-md-auto">
                    <h3 class="card-title text-center ">Zaloguj się</h3>
                    <br>
                    <form action="log-in-user.php" method="post">
                            <div class="mb-3 input-group d-flex">
                                <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-at"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="email" class="form-control" id="email_input" name="email" placeholder="Email" required>
                                    <label for="email_input">Email</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control" id="passwd_input" name="passwd" placeholder="Hasło" required>
                                    <label for="passwd_input">Hasło</label>
                                </div>
                            </div>
                            <div class="mx-auto my-3 d-flex">
                                
                                <a href="reset-password" class="text-muted">Zapomniałeś hasła?</a>
                            </div>
                            <div class="d-grid mb-3 gap-3">
                                <button type="submit" class="btn btn-dark ">
                                    Zaloguj się
                                </button>
                                <p>Nie masz jeszcze konta? <a href="register" class="link-primary text-dark">
                                    Zarejestruj się
                                </a></p>
                            </div>
                          </form>
                    </div>
                </div>
            <div class="col-md-6"></div>
        </div>
    </div>

</div>

</body>
</html>