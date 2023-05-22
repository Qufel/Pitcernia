<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container mt-3">
        <section class="mb-4 card">
            <h2 class="h1-responsive font-weight-bold text-center my-4">Skontaktuj się z nami</h2>
            <p class="text-center w-responsive mx-auto">Czy masz jakieś pytania? Nie wahaj się skontaktować z nami bezpośrednio. Nasz zespół skontaktuje się z Państwem w ciągu
                w ciągu kilku godzin, aby Ci pomóc.</p>

            <div class="row p-3">
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="mail.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="name" class="">Twoje imię</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <label for="email" class="">Twój email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <label for="subject" class="">Temat</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="md-form">
                                    <label for="message">Twoja wiadomość</label>
                                    <textarea type="text" id="message" name="message" rows="6" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>

                    </form>

                    <div class="text-center text-md-left d-md-flex mt-3">
                        <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();"><i class="bi bi-send-fill"></i> Wyślij wiadomość</a>
                    </div>
                    <div class="status"></div>
                </div>

                <div class="col-md-3 text-center" >
                    <ul class="list-unstyled mb-0">
                        <li><i class="bi bi-geo-alt-fill"></i>
                            <p>Szkolna 17 15-640 Białystok Polska</p>
                        </li>

                        <li><i class="bi bi-telephone-fill"></i></i>
                            <p>+ 48 000 000 000</p>
                        </li>

                        <li><i class="bi bi-envelope-fill"></i></i>
                            <p>pitcernia.projekt@gmail.com</p>
                        </li>
                    </ul>
                </div>

            </div>

        </section>
    </div>

    <div class="spacer" ></div>

    <!--Section: Contact v.2-->
    <?php require_once "partials/footer.php"; ?>
</body>

</html>