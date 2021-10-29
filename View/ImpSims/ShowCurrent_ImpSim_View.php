<?php

class ShowCurrent_ImpSim {
    var $imp_sim;

    function __construct($imp_sim) {
        $this->imp_sim = $imp_sim;
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
                        <h1 class="mt-5"><?php echo $this->imp_sim['nombre_simulacro'] ?></h1>
                        <h2><?php echo $this->imp_sim['nombre_edificio'] ?></h2>
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
                                <div class="col-lg-6">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-cump_id">ID Cumplimentación</span>
                                            <span class="d-block att-value"><?php echo $this->imp_sim['cumplimentacion_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-simulacro_id">ID Simulacro</span>
                                            <span class="d-block att-value"><?php echo $this->imp_sim['simulacro_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-edificio_id">ID Edificio</span>
                                            <span class="d-block att-value"><?php echo $this->imp_sim['edificio_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                            <span class="d-block att-value i18n-<?php echo $this->imp_sim['estado'] ?> <?php echo $this->imp_sim['estado'] ?>">PENDIENTE</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 pt-4 pt-lg-0">
                                    <ul>
                                        <?php if($this->imp_sim['fecha_planificacion'] != default_data) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-planning_date">Fecha Planificación</span>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->imp_sim['fecha_planificacion']),'d/m/Y');?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($this->imp_sim['fecha_vencimiento'] != default_data) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_expire">Fecha Vencimiento</span>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->imp_sim['fecha_vencimiento']),'d/m/Y');?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($this->imp_sim['url_recurso'] != default_url) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-url_recurso">URL Recurso</span>
                                                <span class="d-block att-value"><a href="<?php echo $this->imp_sim['url_recurso'] ?>"><span class="i18n-enlace_url">Acceder al Recurso</span></a></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($this->imp_sim['destinatarios'] != default_destinatarios) :?>
                                            <li>
                                                <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-destinatarios">Destinatarios</span>
                                                <p><?php echo $this->imp_sim['destinatarios'] ?>
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
                                insertacampo(document.formenviar, 'simulacro_id', '<?php echo $this->imp_sim['simulacro_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpSim');
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