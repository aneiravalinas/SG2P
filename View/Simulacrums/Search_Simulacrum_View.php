<?php

class Search_Simulacrum {
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
                                    <input type="text" value="<?php echo $this->building['nombre']?>" class="form-control" id="nombre_edificio" name="nombre_edificio" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="simulacro_id" class="i18n-formacion_id">ID Formación</label>
                                    <input type="text" value="<?php echo $this->simulacrum['simulacro_id'] ?>" class="form-control" id="simulacro_id" name="simulacro_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" value="<?php echo $this->building['edificio_id'] ?>" class="form-control" id="edificio_id" name="edificio_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cumplimentacion_id" class="i18n-cump_id">ID Cumplimentacion</label>
                                    <input type="text" class="form-control" id="cumplimentacion_id" name="edificio_simulacro_id" onblur="check_CUMPLIMENTACION_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="estado" class="i18n-state">Estado</label>
                                    <select id="estado" name="estado" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="pendiente" class="i18n-pendiente">Pendiente</option>
                                        <option value="cumplimentado" class="i18n-cumplimentado">Cumplimentado</option>
                                        <option value="vencido" class="i18n-vencido">Vencido</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fecha_planificacion" class="i18n-planning_date">Fecha Planificación</label>
                                    <input type="date" class="form-control" id="fecha_planificacion" name="fecha_planificacion"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fecha_vencimiento" class="i18n-date_expire">Fecha Vencimiento</label>
                                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                            crearform('formenviar','post');
                                            insertacampo(document.formenviar,'simulacro_id', '<?php echo $this->simulacrum['simulacro_id'] ?>');
                                            insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id']?>');
                                            insertacampo(document.formenviar,'controller','Simulacrum');
                                            insertacampo(document.formenviar,'action','show');
                                            enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                            insertacampo(document.formulariosearch,'simulacro_id', '<?php echo $this->simulacrum['simulacro_id'] ?>');
                                            insertacampo(document.formulariosearch,'edificio_id', '<?php echo $this->building['edificio_id']?>');
                                            insertacampo(document.formulariosearch,'controller','Simulacrum');
                                            insertacampo(document.formulariosearch,'action','show');
                                            enviaformcorrecto(document.formulariosearch, check_CUMPLIMENTACION_ID_SEARCH());">
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