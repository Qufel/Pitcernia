<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<?php require "partials/nav.php" ?>

<div class="container d-flex">
    <div class="card mx-auto my-auto">
        <div class="card-body">
            <h3 class="card-title">Zarejestruj się</h3>
            <form action="register" method="post">

                <hr>

                <div class="input-group d-flex mb-3">
                    <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-user"></i></span>
                    <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control" id="login_input" name="login" placeholder="Nazwa użytkownika">
                        <label for="login_input">Nazwa użytkownika</label>
                    </div>
                </div>

                <div class="input-group d-flex mb-3">
                    <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-at"></i></span>
                    <div class="form-floating flex-grow-1">
                        <input type="email" class="form-control" id="email_input" name="email" placeholder="Email">
                        <label for="email_input">Email</label>
                    </div>
                </div>

                <div class="d-md-flex gap-3">
                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="passwd_input" name="passwd" placeholder="Hasło">
                            <label for="passwd_input">Hasło</label>
                        </div>
                    </div>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-lock"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="passwd_r_input" name="passwdRepeat" placeholder="Powtórz hasło">
                            <label for="passwd_input">Powtórz hasło</label>
                        </div>
                    </div>
                </div>
                
                <hr>

                <div class="d-flex gap-3">
                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-user"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="fname_input" name="fname" placeholder="Imię">
                            <label for="fname_input">Imię</label>
                        </div>
                    </div>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-user"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="surname_input" name="surname" placeholder="Nazwisko">
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
                        <input type="tel" class="form-control" id="phone_input" name="phone" placeholder="Numer telefonu">
                        <label for="">Numer telefonu</label>
                    </div>
                </div>

                <div class="d-md-flex gap-3 ">
                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-mailbox"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="p_code_input" name="postCode" placeholder="Kod pocztowy">
                            <label for="p_code_input">Kod pocztowy</label>
                        </div>
                    </div>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-building"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="city_input" name="city" placeholder="Miejscowość">
                            <label for="city_input">Miejscowość</label>
                        </div>
                    </div>
                </div>
                
                <div class="input-group d-flex mb-3">
                    <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-road"></i></span>
                    <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control" id="street_input" name="street" placeholder="Ulica">
                        <label for="street_input">Ulica</label>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-home"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="b_num_input" name="buildingNumber" placeholder="Numer domu">
                            <label for="b_num_input">Numer domu</label>
                        </div>
                    </div>

                    <div class="input-group d-flex mb-3">
                        <span class="input-group-text d-none d-md-flex"><i class="fi fi-rr-home"></i></span>
                        <div class="form-floating flex-grow-1">
                            <input type="text" class="form-control" id="a_num_input" name="apartmentNumber" placeholder="Numer mieszkania">
                            <label for="a_num_input">Numer mieszkania</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="checkbox" class="form-check-input" name="terms" id="terms_input">
                    <label for="terms_input" class="form-check-label">Zapoznałem(am) się i akceptuje <a href="terms">Regulamin</a></label>
                </div>

                <div class="d-grid mb-3">
                    <!-- Przekieruj do verify.php (czy coś takiego) -->
                    <button type="submit" class="btn btn-outline-primary">Zarejestruj się</button>
                </div>

            </form>
        </div>
    </div>
</div>

</body>
</html>