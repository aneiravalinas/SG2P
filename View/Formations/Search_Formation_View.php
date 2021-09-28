<?php

class Search_Formation {
    var $formation;
    var $building;

    function __construct($formation, $building) {
        $this->formation = $formation;
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
                        <h1><?php echo $this->formation['nombre'] ?></h1>
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
                                    <label for="formacion_id" class="i18n-formacion_id">ID Formación</label>
                                    <input type="text" value="<?php echo $this->formation['formacion_id'] ?>" class="form-control" id="formacion_id" name="formacion_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" value="<?php echo $this->building['edificio_id'] ?>" class="form-control" id="edificio_id" name="edificio_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cumplimentacion_id" class="i18n-cump_id">ID Cumplimentacion</label>
                                    <input type="text" class="form-control" id="cumplimentacion_id" name="edificio_formacion_id" onblur="check_CUMPLIMENTACION_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="estado" class="i18n-state">Estado</label>
                                    <select id="estado" name="estado" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="pendiente" class="i18n-pendiente">Pendiente</option>
                                        <option value="cumplimentado" class="i18n-cumplimentado">Cumplimentado</option>
                                        <option value="vencido" class="i18n-vencido">Vencido</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_planificacion" class="i18n-planning_date">Fecha Planificación</label>
                                    <input type="date" class="form-control" id="fecha_planificacion" name="fecha_cumplimentacion"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'formacion_id', '<?php echo $this->formation['formacion_id'] ?>');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id']?>');
                                        insertacampo(document.formenviar,'controller','Formation');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'formacion_id', '<?php echo $this->formation['formacion_id'] ?>');
                                        insertacampo(document.formulariosearch,'edificio_id', '<?php echo $this->building['edificio_id']?>');
                                        insertacampo(document.formulariosearch,'controller','Formation');
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