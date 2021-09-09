<?php

class Portal_ShowCurrent_ImpProc {
    var $imp_proc;

    function __construct($imp_proc) {
        $this->imp_proc = $imp_proc;
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
                        <h1 class="mt-5"><?php echo $this->imp_proc['nombre_procedimiento'] ?></h1>
                        <h2><?php echo $this->imp_proc['nombre_edificio'] ?></h2>
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
                                            <span class="d-block att-value"><?php echo $this->imp_proc['edificio_procedimiento_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-procedimiento_id">ID Procedimiento</span>
                                            <span class="d-block att-value"><?php echo $this->imp_proc['procedimiento_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-edificio_id">ID Edificio</span>
                                            <span class="d-block att-value"><?php echo $this->imp_proc['edificio_id'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-5 pt-4 pt-lg-0">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                            <span class="d-block att-value i18n-<?php echo $this->imp_proc['estado'] ?> <?php echo $this->imp_proc['estado'] ?>">PENDIENTE</span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_comp">Fecha Cumplimentación</span>
                                            <?php if($this->imp_proc['fecha_cumplimentacion'] != default_data) :?>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->imp_proc['fecha_cumplimentacion']),'d/m/Y');?></span>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-file_doc">Fichero de la Cumplimentación</span>
                                            <?php if($this->imp_proc['nombre_doc'] != default_doc) :?>
                                                <a href="<?php echo $this->imp_proc['path'] . '/' . $this->imp_proc['nombre_doc']; ?>" class="d-block">
                                                    <span class="iconify icon-pdf" data-icon="bi:file-earmark-pdf-fill"></span><span class="name_doc"><?php echo $this->imp_proc['nombre_doc'] ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center pb-5 pt-3">
                        <div class="col text-center">
                            <a class="btn-get-started i18n-back" type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->imp_proc['edificio_id'] ?>');
                                insertacampo(document.formenviar, 'procedimiento_id', '<?php echo $this->imp_proc['procedimiento_id'] ?>');
                                insertacampo(document.formenviar,'controller','Portal');
                                insertacampo(document.formenviar,'action','seekPortalProcedure');
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