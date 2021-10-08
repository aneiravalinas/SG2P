<?php

class ShowCurrent_ImpRoute {
    var $imp_route;

    function __construct($imp_route) {
        $this->imp_route = $imp_route;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>



        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mt-3">
                        <h1 class="mt-5"><?php echo $this->imp_route['nombre_ruta'] ?></h1>
                        <h2><?php echo $this->imp_route['nombre_planta'] ?></h2>
                    </div>
                </div>
            </div>
        </section>

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h4 class="i18n-imp-details">Detalles de la Cumplimentación</h4>
                    </div>

                    <div class="row content justify-content-center">
                        <div class="col-xl-7 col-lg-8">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-cump_id">ID Cumplimentación</span>
                                            <span class="d-block att-value"><?php echo $this->imp_route['planta_ruta_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-ruta_id">ID Ruta</span>
                                            <span class="d-block att-value"><?php echo $this->imp_route['ruta_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-planta_id">ID Planta</span>
                                            <span class="d-block att-value"><?php echo $this->imp_route['planta_id'] ?></span>
                                        </li>
                                        <?php if($this->imp_route['fecha_vencimiento'] != default_data) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_expire">Fecha Vencimiento</span>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->imp_route['fecha_vencimiento']),'d/m/Y');?></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="col-lg-5 pt-4 pt-lg-0">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                            <span class="d-block att-value i18n-<?php echo $this->imp_route['estado'] ?> <?php echo $this->imp_route['estado'] ?>">PENDIENTE</span>
                                        </li>
                                        <?php if($this->imp_route['fecha_cumplimentacion'] != default_data) :?>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_comp">Fecha Cumplimentación</span>
                                            <span class="d-block att-value"><?php echo date_format(date_create($this->imp_route['fecha_cumplimentacion']),'d/m/Y');?></span>
                                        </li>
                                        <?php endif; ?>
                                        <?php if($this->imp_route['nombre_doc'] != default_doc) :?>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-file_doc">Fichero de la Cumplimentación</span>
                                                <a href="<?php echo $this->imp_route['path'] . '/' . $this->imp_route['nombre_doc']; ?>" class="d-block">
                                                    <span class="iconify icon-pdf" data-icon="bi:file-earmark-pdf-fill"></span><span class="name_doc"><?php echo $this->imp_route['nombre_doc'] ?></span>
                                                </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center pb-5 pt-3">
                        <div class="col text-center">
                            <a class="btn-get-started i18n-back" type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar, 'ruta_id', '<?php echo $this->imp_route['ruta_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpRoute');
                                insertacampo(document.formenviar,'action','show');
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