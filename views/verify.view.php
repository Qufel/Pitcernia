<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<?php require "partials/nav.php" ?>

<div class="container content-holder d-flex justify-content-center">
    
    <div class="card p-3 mx-auto my-auto">
        <h3 class="card-title text-center">Zweryfikuj swój email</h3>
        <div class="card-body">
            <p class="text-center">Dziękujemy za rejestrację konta w naszym serwisie. Aby w pełni ukończyć proces rejestracji, musisz jeszcze zweryfikować swój email.</p>
            <form id="send-verification" class="text-center">
                <input type="hidden" name="email" value="<?= $_GET['email'] ?>">
                <button type="submit" class="btn btn-primary">Wyślij link weryfikacyjny</button>
            </form>
        </div>
    </div>

</div>

<script src="./js/users/send-verification.js"></script>

</body>
</html>