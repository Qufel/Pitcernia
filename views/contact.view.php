<!DOCTYPE html>
<html lang="en">

<?php require "partials/head.php" ?>

<body>

    <?php require "partials/nav.php" ?>

    <div class="container">
        <section class="mb-4 card">

            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center my-4">SKONTAKTUJ SIĘ Z NAMI</h2>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Czy masz jakieś pytania? Nie wahaj się skontaktować z nami bezpośrednio. Nasz zespół skontaktuje się z Państwem w ciągu
                w ciągu kilku godzin, aby Ci pomóc.</p>

            <div class="row">

                <!--Grid column-->
                <div class="col-md-9 mb-md-0 mb-5" style="padding: 100px">
                    <form id="contact-form" name="contact-form" action="mail.php" method="post">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6" style="padding: 10px;">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control">
                                    <label for="name" class="">Twoje imię</label>
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6" style="padding: 10px;">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email" class="form-control">
                                    <label for="email" class="">twój e-mail</label>
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12" style="padding: 10px;">
                                <div class="md-form mb-0">
                                    <input type="text" id="subject" name="subject" class="form-control">
                                    <label for="subject" class="">Temat</label>
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12" style="padding: 10px;">

                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                    <label for="message">Twoja wiadomość</label>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->

                    </form>

                    <div class="text-center text-md-left">
                        <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Wyślij</a>
                    </div>
                    <div class="status"></div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 text-center" style="padding-top: 100px;">
                    <ul class="list-unstyled mb-0">
                        <li><i class="bi bi-geo-alt-fill"></i>
                            <p>Szkolna 17 15-640 Białystok Polska</p>
                        </li>

                        <li><i class="bi bi-telephone-fill"></i></i>
                            <p>+ 48 597 537 577</p>
                        </li>

                        <li><i class="bi bi-envelope-fill"></i></i>
                            <p>elektryk@elektryk.opole.pl</p>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

            </div>

        </section>
    </div>

    <div class="spacer"></div>

    <!--Section: Contact v.2-->
    <?php require_once "partials/footer.php"; ?>
</body>

</html>