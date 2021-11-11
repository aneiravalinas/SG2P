<?php

include './View/Page/header.php';

class Expire_ImpRoute extends Header {
    var $imp_route;

    function __construct($imp_route) {
        parent::__construct();
        $this->imp_route = $imp_route;
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
                        <h3 class="mb-4 i18n-expire-improute-confirm">¿Está seguro que desea vencer la cumplimentación de esta rua? El cambio no será reversible</h3>
                        <h2><?php echo $this->imp_route['cumplimentacion_id'] ?> - <?php echo $this->imp_route['nombre_ruta'] ?> - <?php echo $this->imp_route['nombre_planta'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="go_current()">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-expire" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar, 'cumplimentacion_id', '<?php echo $this->imp_route['cumplimentacion_id'] ?>');
                            insertacampo(document.formenviar, 'controller', 'ImpRoute');
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