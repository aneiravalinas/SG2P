<?php

class Cities_Empty {
    var $msg;

    function __construct($msg) {
        $this->msg = $msg;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 id="i18n-app-welcome">¡Bienvenido a SG2P!</h1>
                        <h2 id="<?php echo $this->msg ?>"></h2>
                    </div>
                </div>
            </div>
        </section>

<?php
        include './View/Page/footer.php';
    }
}
?>