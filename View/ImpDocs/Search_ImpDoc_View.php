<?php

class Search_ImpDoc {
    var $document;

    function __construct($document) {
        $this->document = $document;
        $this->render();
    }

    function render() {
        include_once './View/Page/header.php';
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->document['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-search-imps">Buscar Cumplimentaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cumplimentacion_id" class="i18n-cump_id">ID Cumplimentacion</label>
                                    <input type="text" class="form-control" id="cumplimentacion_id" name="cumplimentacion_id" onblur="check_CUMPLIMENTACION_ID_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" class="form-control" id="edificio_id" name="edificio_id" onblur="check_EDIFICIO_ID_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="estado" class="i18n-state">Estado</label>
                                    <select id="estado" name="estado" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="pendiente" class="i18n-pendiente">Pendiente</option>
                                        <option value="cumplimentado" class="i18n-cumplimentado">Cumplimentado</option>
                                        <option value="vencido" class="i18n-vencido">Vencido</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_cumplimentacion_inicio" class="i18n-start_date_comp">Fecha Cumplimentación Inicial</label>
                                    <input type="date" class="form-control" id="fecha_cumplimentacion_inicio" name="fecha_cumplimentacion_inicio"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_cumplimentacion_fin" class="i18n-end_date_comp">Fecha Cumplimentacion Final</label>
                                    <input type="date" class="form-control" id="fecha_cumplimentacion_fin" name="fecha_cumplimentacion_fin"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_vencimiento_inicio" class="i18n-start_date_expire">Fecha Vencimiento Inicial</label>
                                    <input type="date" class="form-control" id="fecha_vencimiento_inicio" name="fecha_vencimiento_inicio"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_vencimiento_fin" class="i18n-end_date_expire">Fecha Vencimiento Final</label>
                                    <input type="date" class="form-control" id="fecha_vencimiento_fin" name="fecha_vencimiento_fin"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_doc_field" class="i18n-nombre_doc">Nombre Documento</label>
                                    <input type="text" class="form-control" id="nombre_doc_field" name="nombre_doc" onblur="check_NOMBRE_DOC_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <input type="text" class="form-control" id="nombre_edificio" name="nombre_edificio" onblur="check_BUILDING_NAME_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'documento_id', '<?php echo $this->document['documento_id'] ?>');
                                        insertacampo(document.formenviar,'controller','ImpDoc');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'documento_id', '<?php echo $this->document['documento_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','ImpDoc');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch, check_CUMP_DOC_PROC_SEARCH());">
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