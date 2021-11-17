<?php

include_once './View/Page/header.php';

class Portal_ShowCurrent_Space extends Header {
    var $space;

    function __construct($space) {
        parent::__construct();
        $this->space = $space;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center pt-5 mt-5">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-details-space">Detalles del Espacio</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <img src="<?php echo space_photos_path . $this->space['foto_espacio'] ?>" id="picture-profile" class="rounded-circle"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about pt-2">
                <div class="container" data-aos="fade-up">
                    <div class="row content justify-content-center">
                        <div class="col-xl-8 col-lg-9">
                            <div class="row">
                                <div class="col-5 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-espacio_id">ID Espacio</span>
                                            <span class="d-block att-value"><?php echo $this->space['espacio_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-nombre">Nombre</span>
                                            <span class="d-block att-value"><?php echo $this->space['nombre'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-descripcion">Descripcion</span>
                                            <span class="d-block att-value"><?php echo $this->space['descripcion'] ?></span>
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
