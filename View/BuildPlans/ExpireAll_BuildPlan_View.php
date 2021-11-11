<?php

include './View/Page/header.php';

class ExpireAll_BuildPlan extends Header {
    var $plan;

    function __construct($plan) {
        parent::__construct();
        $this->plan = $plan;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-msg-system">Mensaje del Sistema</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h3 class="mb-4 i18n-expireAll-bldplan-confirm">¿Está seguro que desea vencer TODAS las asignaciones de este Plan? El cambio no será reversible</h3>
                        <h2><?php echo $this->plan['plan_id'] ?> - <?php echo $this->plan['nombre'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="go_current()">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-expire" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar, 'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                            insertacampo(document.formenviar, 'controller', 'BuildPlan');
                            insertacampo(document.formenviar, 'action', 'expireAll');
                            enviaform(document.formenviar);">
                            Vencer
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