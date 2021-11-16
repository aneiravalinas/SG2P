<?php

include_once './View/Page/header.php';

class Message extends Header {

    var $msg;

    function __construct($msg) {
        parent::__construct();
        $this->msg = $msg;
        $this->render();
    }

    function render() {
        ?>

        <!-- ==== MESSAGE VIEW ==== -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-msg-system">Mensaje del Sistema</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h2 class="mb-4 <?php echo $this->msg?>"></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <a type="button" class="btn-get-started i18n-back" onclick=
                            "crearform('formenviar','post');
                             <?php foreach($this->currentShow as $key => $value) :?>
                             insertacampo(document.formenviar,'<?php echo $key; ?>', '<?php echo $value; ?>');
                             <?php endforeach; ?>
                             enviaform(document.formenviar);">Volver</a>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include 'footer.php';

    }
} ?>
