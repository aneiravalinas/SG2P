<?php

include_once './View/Page/header.php';

class ShowCurrent_DefDoc extends Header {
    var $doc;

    function __construct($doc) {
        parent::__construct();
        $this->doc = $doc;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center hero-section pb-2">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-current-defDoc pt-5 pb-5 mt-5">Detalles de la def. del Documento</h1>
                    </div>
                </div>
            </div>
        </section>

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="row content justify-content-center">
                        <div class="col-xl-8 col-lg-9">
                            <div class="row justify-content-center">
                                <div class="col-5 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-plan_id">ID Plan</span>
                                            <span class="d-block att-value"><?php echo $this->doc['plan_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-documento_id">ID Documento</span>
                                            <span class="d-block att-value"><?php echo $this->doc['documento_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-nombre">Nombre</span>
                                            <span class="d-block att-value"><?php echo $this->doc['nombre'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-visible">Visible</span>
                                            <span class="d-block att-value i18n-<?php echo $this->doc['visible'] ?>">No</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-descripcion">Descripción</span>
                                            <span class="d-block att-value"><?php echo $this->doc['descripcion'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center pb-5 pt-3">
                        <div class="col text-center">
                            <a class="btn-get-started i18n-back" type="button" onclick="
                                    crearform('formenviar', 'post');
                                    insertacampo(document.formenviar, 'go_back', 'go_back');
                                    <?php foreach($this->previousShow as $key => $value): ?>
                                    insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                    <?php endforeach; ?>
                                    enviaform(document.formenviar);">
                                Volver
                            </a>
                        </div>
                    </div>
                </div>
            </section><!-- End About Section -->
        </main>


<?php
        include './View/Page/footer.php';
    }
}
?>