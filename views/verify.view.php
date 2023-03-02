<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<?php require "partials/nav.php" ?>

<div class="container">
    
    <div class="card d-flex p-3">
        <h3 class="card-title text-center">Zweryfikuj swój email</h3>
        <div class="card-body">
            <p class="text-center">Dziękujemy za rejestrację konta w naszym serwisie. Aby w pełni ukończyć proces rejestracji, musisz jeszcze zweryfikować swój email.</p>
            <form action="send-verification.php" method="get" class="text-center">
                <input type="hidden" name="email" value="<?= $_GET['email'] ?>">
                <button type="submit" class="btn btn-dark">Wyślij link weryfikacyjny</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>