<?php

include_once './View/Page/header.php';

class Expire_BuildPlan extends Header {
    var $plan;
    var $edificio;

    function __construct($plan,$edificio) {
        parent::__construct();
        $this->plan = $plan;
        $this->edificio = $edificio;
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
                        <h3 class="mb-4 i18n-expire-bldplan-confirm">¿Está seguro que desea vencer esta asignación? El cambio no será reversible</h3>
                        <h2><?php echo $this->edificio['nombre'] ?> - <?php echo $this->plan['nombre'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="
                            crearform('formenviar', 'post');
                            <?php foreach($this->currentShow as $key => $value): ?>
                            insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                            <?php endforeach; ?>
                            enviaform(document.formenviar);">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-expire" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar, 'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                            insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->edificio['edificio_id'] ?>');
                            insertacampo(document.formenviar, 'controller', 'BuildPlan');
                            insertacampo(document.formenviar, 'action', 'expire');
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