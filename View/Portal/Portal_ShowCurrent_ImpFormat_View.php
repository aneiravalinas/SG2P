<?php

include_once './View/Page/header.php';

class Portal_ShowCurrent_ImpFormat extends Header {
    var $imp_format;

    function __construct($imp_format) {
        parent::__construct();
        $this->imp_format = $imp_format;
        $this->render();
    }

    function render() {
        ?>


        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mt-3">
                        <h1 class="mt-5"><?php echo $this->imp_format['nombre_formacion'] ?></h1>
                        <h2><?php echo $this->imp_format['nombre_edificio'] ?></h2>
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
                        <div class="col-xl-8 col-lg-9">
                            <div class="row justify-content-center">
                                <div class="col-5 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-cump_id">ID Cumplimentación</span>
                                            <span class="d-block att-value"><?php echo $this->imp_format['cumplimentacion_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-formacion_id">ID Formación</span>
                                            <span class="d-block att-value"><?php echo $this->imp_format['formacion_id'] ?></span>
                                        </li>
                                        <?php if($this->imp_format['fecha_planificacion'] != default_data) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-planning_date">Fecha Planificación</span>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->imp_format['fecha_planificacion']),'d/m/Y');?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($this->imp_format['fecha_vencimiento'] != default_data) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_expire">Fecha Vencimiento</span>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->imp_format['fecha_vencimiento']),'d/m/Y');?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($this->imp_format['url_recurso'] != default_url) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-url_recurso">URL Recurso</span>
                                                <span class="d-block att-value"><a href="<?php echo $this->imp_format['url_recurso'] ?>"><span class="i18n-enlace_url">Acceder al Recurso</span></a></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-edificio_id">ID Edificio</span>
                                            <span class="d-block att-value"><?php echo $this->imp_format['edificio_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                            <span class="d-block att-value i18n-<?php echo $this->imp_format['estado'] ?> <?php echo $this->imp_format['estado'] ?>">PENDIENTE</span>
                                        </li>
                                        <?php if($this->imp_format['destinatarios'] != default_destinatarios) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-destinatarios">Destinatarios</span>
                                                <p><?php echo $this->imp_format['destinatarios'] ?>
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