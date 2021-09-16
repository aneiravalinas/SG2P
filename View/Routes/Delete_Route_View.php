<?php

class Delete_Route {
    var $imp_route;

    function __construct($imp_route) {
        $this->imp_route = $imp_route;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
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
                        <h3 class="mb-4 i18n-del-imp-route-confirm">¿Está seguro que desea eliminar la cumplimentación de esta ruta? El cambio no será reversible</h3>
                        <h2><?php echo $this->imp_route['planta_ruta_id'] ?> - <?php echo $this->imp_route['nombre_ruta'] ?> - <?php echo $this->imp_route['nombre_planta'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar,'edificio_id', '<?php echo $this->imp_route['edificio_id'] ?>');
                            insertacampo(document.formenviar,'ruta_id', '<?php echo $this->imp_route['ruta_id'] ?>');
                            insertacampo(document.formenviar,'controller','Route');
                            insertacampo(document.formenviar,'action','show');
                            enviaform(document.formenviar);">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-delete" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar,'planta_ruta_id', '<?php echo $this->imp_route['planta_ruta_id'] ?>');
                            insertacampo(document.formenviar,'controller','Route');
                            insertacampo(document.formenviar,'action','delete');
                            enviaform(document.formenviar);">
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