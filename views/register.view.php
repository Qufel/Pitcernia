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
            <div class="col-md-6">
                <h3 class="card-title text-center">Zarejestruj się</h3>
                <form action="registration.php" method="post" class="needs-validation" novalidate>

                    <br>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-at"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="email" class="form-control" id="email_input" name="email" placeholder="Email" required>
                            <label for="email_input">Email</label>
                        </div>
                    </div>

                    <div class="d-md-flex gap-3">
                        <div class="input-group d-flex mb-3">
                            <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                            <div class="form-floating flex-grow-1">
                                <input type="password" class="form-control" id="passwd_input" name="passwd" placeholder="Hasło" required>
                                <label for="passwd_input">Hasło</label>
                            </div>
                        </div>

                        <div class="input-group d-flex mb-3">
                            <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                            <div class="form-floating flex-grow-1">
                                <input type="password" class="form-control" id="passwd_r_input" name="passwdRepeat" placeholder="Powtórz hasło" required>
                                <label for="passwd_input">Powtórz hasło</label>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="d-flex gap-3">
                        <div class="input-group d-flex mb-3">
                            <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-user"></i></span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control" id="fname_input" name="name" placeholder="Imię" required>
                                <label for="fname_input">Imię</label>
                            </div>
                        </div>

                        <div class="input-group d-flex mb-3">
                            <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-user"></i></span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control" id="surname_input" name="surname" placeholder="Nazwisko" required>
                                <label for="">Nazwisko</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-phone-call"></i></span>
                        <select name="dialCode" id="" class="form-select">
                            <option selected value="+48">+48</option>
                            <option value="+49">+49</option>
                            <option value="+420">+420</option>
                            <option value="+421">+421</option>
                            <option value="+380">+380</option>
                        </select>
                        <div class="form-floating flex-grow-1 col-md-8">
                            <input type="tel" class="form-control" id="phone_input" name="phone" placeholder="Numer telefonu" required>
                            <label for="">Numer telefonu</label>
                        </div>
                    </div>

                    <div class="d-md-flex gap-3">
                        <div class="input-group d-flex mb-3">
                            <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-mailbox"></i></span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control" id="p_code_input" name="post_code" placeholder="Kod pocztowy" required>
                                <label for="p_code_input">Kod pocztowy</label>
                            </div>
                        </div>

                        <div class="input-group d-flex mb-3 ">
                            <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-building"></i></span>
                            <div class="form-floating flex-grow-1">
                                <input type="text" class="form-control" id="city_input" name="city" placeholder="Miejscowość" required>
                                <label for="city_input">Miejscowość</label>
                            </div>
                        </div>
                    </div>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-road"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="street_input" name="address" placeholder="Adres zamieszkania" required>
                            <label for="street_input">Adres zamieszkania</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" class="form-check-input" name="terms" id="terms_input" required>
                        <label for="terms_input" class="form-check-label">Zapoznałem(am) się i akceptuje <a href="terms" class="text-dark">Regulamin</a></label>
                        <div class="invalid-feedback">
                            Musisz zaakceptować regulamin w celu zakończenia rejestracji.
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-dark">Zarejestruj się</button>
                    </div>
                    <p>Masz już konto? <a href="login" class="text-dark">Zaloguj się</a></p>

                </form>
                </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>

</body>
</html>