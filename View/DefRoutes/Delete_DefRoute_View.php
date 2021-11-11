<?php

include './View/Page/header.php';

class Delete_DefRoute extends Header {
    var $route;

    function __construct($route) {
        parent::__construct();
        $this->route = $route;
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
                        <h3 class="mb-4 i18n-del-def-route-confirm">¿Está seguro que desea eliminar la definición de esta ruta? El cambio no será reversible</h3>
                        <h2><?php echo $this->route['ruta_id'] ?> - <?php echo $this->route['nombre'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="go_current()">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-delete" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar, 'ruta_id', '<?php echo $this->route['ruta_id'] ?>');
                            insertacampo(document.formenviar, 'controller', 'DefRoute');
                            insertacampo(document.formenviar, 'action', 'delete');
                            enviaform(document.formenviar)">
                            Eliminar
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