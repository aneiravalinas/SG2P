<?php

include_once './View/Page/header.php';

class ShowCurrent_Notification extends Header {
    var $notification;

    function __construct($notification) {
        parent::__construct();
        $this->notification = $notification;
        $this->render();
    }

    function render() {
        ?>


        !-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mt-3">
                        <h1 class="mt-5 i18n-notifications">Notificaciones</h1>
                    </div>
                </div>
            </div>
        </section>

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h4 class="i18n-notification-details">Detalles de la Notificación</h4>
                    </div>

                    <div class="row content justify-content-center">
                        <div class="col-xl-7 col-lg-8">
                            <div class="row">
                                <div class="col-5 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-notification_id">ID Notificación</span>
                                            <span class="d-block att-value"><?php echo $this->notification['id_notificacion'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-nombre_edificio">Nombre Edificio</span>
                                            <span class="d-block att-value"><?php echo $this->notification['nombre_edificio'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-read">Leído</span>
                                            <span class="d-block att-value i18n-<?php echo $this->notification['leido'] ?>">Yes</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-nombre_plan">Nombre Plan</span>
                                            <span class="d-block att-value"><?php echo $this->notification['nombre_plan'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date">Fecha</span>
                                            <span class="d-block att-value"><?php echo date_format(date_create($this->notification['fecha']), 'd-m-Y'); ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-msg">Mensaje</span>
                                            <span class="d-block att-value"><?php echo $this->notification['mensaje'] ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center pb-5 pt-3">
                        <div class="col-xl-5 col-lg-9 d-flex justify-content-between flex-wrap">
                            <a class="btn-get-started i18n-back" type="button" onclick="
                                crearform('formenviar', 'post');
                                insertacampo(document.formenviar, 'go_back', 'go_back');
                                <?php foreach($this->previousShow as $key => $value): ?>
                                insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                <?php endforeach; ?>
                                enviaform(document.formenviar);">
                                Volver
                            </a>
                            <a class="btn-get-started" type="button" onclick="
                                    crearform('formenviar', 'post');
                                    insertacampo(document.formenviar, 'controller', 'Plan');
                                    insertacampo(document.formenviar, 'action', 'showCurrent');
                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->notification['edificio_id'] ?>');
                                    insertacampo(document.formenviar, 'plan_id', '<?php echo $this->notification['plan_id'] ?>');
                                    enviaform(document.formenviar);">
                                Ver Plan
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