<?php

class Delete_ImpSim {
    var $imp_sim;

    function __construct($imp_sim) {
        $this->imp_sim = $imp_sim;
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
                        <h3 class="mb-4 i18n-del-imp-sim-confirm">¿Está seguro que desea eliminar la cumplimentación de este simulacro? El cambio no será reversible</h3>
                        <h2><?php echo $this->imp_sim['cumplimentacion_id'] ?> - <?php echo $this->imp_sim['nombre_simulacro'] ?> - <?php echo $this->imp_sim['nombre_edificio'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar,'simulacro_id', '<?php echo $this->imp_sim['simulacro_id'] ?>');
                            insertacampo(document.formenviar,'controller','ImpSim');
                            insertacampo(document.formenviar,'action','show');
                            enviaform(document.formenviar);">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-delete" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar,'cumplimentacion_id', '<?php echo $this->imp_sim['cumplimentacion_id'] ?>');
                            insertacampo(document.formenviar,'controller','ImpSim');
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