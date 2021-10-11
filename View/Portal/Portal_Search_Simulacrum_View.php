<?php

class Portal_Search_Simulacrum {
    var $simulacrum;
    var $building;

    function __construct($simulacrum, $building) {
        $this->simulacrum = $simulacrum;
        $this->building = $building;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->simulacrum['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-search-imps">Buscar Cumplimentaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <input type="text" class="form-control" value="<?php echo $this->building['nombre'] ?>" id="nombre_edificio" name="nombre_edificio" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_planificacion_inicio" class="i18n-start_planning_date">Fecha Planificación Inicial</label>
                                    <input type="date" class="form-control" id="fecha_planificacion_inicio" name="fecha_planificacion_inicio"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_planificacion_fin" class="i18n-end_planning_date">Fecha Planificación Final</label>
                                    <input type="date" class="form-control" id="fecha_planificacion_fin" name="fecha_planificacion_fin"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'simulacro_id', '<?php echo $this->simulacrum['simulacro_id'] ?>');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Portal');
                                        insertacampo(document.formenviar,'action','seekPortalSimulacrum');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'simulacro_id', '<?php echo $this->simulacrum['simulacro_id'] ?>');
                                        insertacampo(document.formulariosearch,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','Portal');
                                        insertacampo(document.formulariosearch,'action','seekPortalSimulacrum');
                                        enviaform(document.formulariosearch);">
                                        Enviar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



<?php
        include './View/Page/footer.php';
    }
}
?>