<!--Section: Contact v.2-->
<section class="mb-4 center pt-4" id="contact">
    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center">Contactez moi</h2>
    <!--Section description-->
    <hr class="divider my-4">
    <p class="text-center w-responsive mx-auto mb-5">Envoyez moi un message, je me ferai un plaisir d'y répondre.</p>
    <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mx-auto border rounded p-3">
            <form id="contact-form" name="contact-form" action="index.php?action=mail" method="POST">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name">Votre nom</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <!--Grid column-->
                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Votre mail</label>
                            <input type="text" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="subject" class="pt-3">Objet</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                    </div>
                </div>
                <!--Grid row-->
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form center">
                            <label for="message" class="pt-3">Message</label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" required></textarea>
                        </div>
                    </div>
                </div>
                <!--Grid row-->
                <div class="text-center m-3">
                <button class="btn btn-xl js-scroll-trigger btn-primary text-white">Envoyer</button>
            </div>
            </form>
            
            <div class="status"></div>
        </div>
    </div>
    <hr class="border-primary p-1 m-4">
</section>
<!--Section: Contact v.2-->
