<?php

class Portal_Search_Route {
    var $floors;
    var $route;
    var $building;

    function __construct($floors, $route, $building) {
        $this->floors = $floors;
        $this->route = $route;
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
                        <h1><?php echo $this->route['nombre'] ?></h1>
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
                                <div class="form-group col-md-4">
                                    <label for="fecha_cumplimentacion" class="i18n-date_comp">Fecha Cumplimentación</label>
                                    <input type="date" class="form-control" id="fecha_cumplimentacion" name="fecha_cumplimentacion"/>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="nombre_planta" class="i18n-nombre_planta">Nombre Planta</label>
                                    <select class="form-select" id="nombre_planta" name="planta_id">
                                        <option value="" class="i18n-todos"></option>
                                        <?php foreach($this->floors as $floor): ?>
                                            <option value="<?php echo $floor['planta_id'] ?>">
                                                <?php echo $floor['nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_doc_field" class="i18n-nombre_doc">Nombre Documento</label>
                                    <input type="text" class="form-control" id="nombre_doc_field" name="nombre_doc" onblur="check_NOMBRE_DOC_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'ruta_id', '<?php echo $this->route['ruta_id'] ?>');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Portal');
                                        insertacampo(document.formenviar,'action','seekPortalRoute');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'ruta_id', '<?php echo $this->route['ruta_id'] ?>');
                                        insertacampo(document.formulariosearch,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','Portal');
                                        insertacampo(document.formulariosearch,'action','seekPortalRoute');
                                        enviaformcorrecto(document.formulariosearch, check_NOMBRE_DOC_SEARCH());">
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
}?>