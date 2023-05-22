<?php
require 'user.functions.php';

if (isset($_POST["email"])) {
    $user = UserFunctions::get_user_by_email($_POST['email']);
    $s = $user->send_verification_mail();
}

if ($s) {
    echo json_encode(new UserFunctionStatus(true, "Pomyślnie wysłano."));
} else {
    echo json_encode(new UserFunctionStatus(false, "Błąd podczas wysyłania."));
}
