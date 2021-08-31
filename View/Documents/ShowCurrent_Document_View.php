<?php

class ShowCurrent_Document {
    var $imp_doc;

    function __construct($imp_doc) {
        $this->imp_doc = $imp_doc;
        $this->render();
    }

    function render() {
        include_once './View/Page/header.php';
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mt-3">
                        <h1 class="mt-5"><?php echo $this->imp_doc['nombre_documento'] ?></h1>
                        <h2><?php echo $this->imp_doc['nombre_edificio'] ?></h2>
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
                                        <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-impdoc_id">ID Cumplimentación</span>
                                        <span class="d-block att-value"><?php echo $this->imp_doc['edificio_documento_id'] ?></span>
                                    </li>
                                    <li>
                                        <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-documento_id">ID Documento</span>
                                        <span class="d-block att-value"><?php echo $this->imp_doc['documento_id'] ?></span>
                                    </li>
                                    <li>
                                        <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-edificio_id">ID Edificio</span>
                                        <span class="d-block att-value"><?php echo $this->imp_doc['edificio_id'] ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-5 pt-4 pt-lg-0">
                                <ul>
                                    <li>
                                        <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                        <span class="d-block att-value i18n-<?php echo $this->imp_doc['estado'] ?> <?php echo $this->imp_doc['estado'] ?>">PENDIENTE</span>
                                    </li>
                                    <li>
                                        <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_comp">Fecha Cumplimentación</span>
                                        <?php if($this->imp_doc['fecha_cumplimentacion'] != default_data) :?>
                                        <span class="d-block att-value"><?php echo date_format(date_create($this->imp_doc['fecha_cumplimentacion']),'d/m/Y');?></span>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-file_doc">Fichero de la Cumplimentación</span>
                                        <?php if($this->imp_doc['nombre_doc'] != default_doc) :?>
                                        <a href="<?php echo $this->imp_doc['path'] . '/' . $this->imp_doc['nombre_doc']; ?>" class="d-block">
                                            <span class="iconify icon-pdf" data-icon="bi:file-earmark-pdf-fill"></span><span class="name_doc"><?php echo $this->imp_doc['nombre_doc'] ?></span>
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
                            insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->imp_doc['edificio_id'] ?>');
                            insertacampo(document.formenviar, 'documento_id', '<?php echo $this->imp_doc['documento_id'] ?>');
                            insertacampo(document.formenviar,'controller','Document');
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