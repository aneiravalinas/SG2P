<?php

include_once './View/Page/header.php';

class Portal_ShowCurrent_Floor extends Header {
    var $floor;
    var $spaces;

    function __construct($floor, $spaces) {
        parent::__construct();
        $this->floor = $floor;
        $this->spaces = $spaces;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center pt-5 mt-5">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-details-floor">Detalles de la Planta</h1>
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
            <section id="about" class="about pt-2 pb-0">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h4 class="i18n-floor_details">Información de la Planta</h4>
                    </div>

                    <div class="row content justify-content-center">
                        <div class="col-xl-8 col-lg-9">
                            <div class="row">
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
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-edificio_id">ID Edificio</span>
                                            <span class="d-block att-value"><?php echo $this->floor['edificio_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-descripcion">Descripción</span>
                                            <span class="d-block att-value"><?php echo $this->floor['descripcion'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End About Section -->
        </main>

        <section id="hero" class="d-flex align-items-center mt-3 hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <!-- ======= FORM SECTION ====== --->

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h3 class="i18n-floor-spaces title-icon-box">Espacios de la Planta</h3>
                    </div>
                </div>

                <div class="row d-flex flex-wrap icon-boxes justify-content-center text-center">
                    <?php foreach($this->spaces as $space) :?>
                        <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box">
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'espacio_id',<?php echo $space['espacio_id'] ;?>);
                                    insertacampo(document.formenviar,'action','seekPortalSpace');
                                    insertacampo(document.formenviar,'controller','Portal');
                                    enviaform(document.formenviar);">
                                    <div>
                                        <div class="icon">
                                            <img src="<?php echo space_photos_path . $space['foto_espacio']; ?>" class="rounded-circle img-card"/>
                                        </div>
                                        <h2 class="title title-icon-box">
                                            <?php echo $space['nombre'] ?>
                                        </h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
        </section>

<?php
        include './View/Page/footer.php';
    }
}
?>
