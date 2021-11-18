<?php

include_once './View/Page/header.php';

class ShowCurrent_Floor extends Header {
    var $floor;
    var $building;

    function __construct($floor, $building) {
        parent::__construct();
        $this->floor = $floor;
        $this->building = $building;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section pb-2">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 mt-4"><?php echo $this->building['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-details-floor">Detalles de la Planta</h2>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <img src="<?php echo floor_photos_path . $this->floor['foto_planta'] ?>" id="picture-profile" class="rounded-circle"/>
                        </div>
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
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-planta_id">ID Planta</span>
                                            <span class="d-block att-value"><?php echo $this->floor['planta_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-nombre">Nombre</span>
                                            <span class="d-block att-value"><?php echo $this->floor['nombre'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-num_planta">Número de Planta</span>
                                            <span class="d-block att-value"><?php echo $this->floor['num_planta'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-descripcion">Descripción</span>
                                            <span class="d-block att-value"><?php echo $this->floor['descripcion'] ?></span>
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