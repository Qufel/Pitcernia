<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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