<?php

class Search_Plans {

    function __construct() {
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-search-plans">Búsqueda de Planes</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" class="form-control" id="plan_id" name="plan_id" onblur="check_ID_PLAN_SEARCH();"/>
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
                                        <option value="cumplimentado" class="i18n-cumplimentado">cumplimentado</option>
                                        <option value="vencido" class="i18n-vencido">Vencido</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <input type="text" class="form-control" id="nombre_edificio" name="nombre_edificio" onblur="check_BLDPLAN_NOMBRE_EDIFICIO_SEARCH();"/>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="nombre_plan" class="i18n-nombre_plan">Nombre Plan</label>
                                    <input type="text" class="form-control" id="nombre_plan" name="nombre_plan" onblur="check_NOMBRE_PLAN_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_asignacion" class="i18n-fecha_asignacion">Fecha Asignación</label>
                                    <input type="date" class="form-control" id="fecha_asignacion" name="fecha_asignacion"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_cumplimentacion" class="i18n-fecha_cumplimentacion">Fecha Implementación</label>
                                    <input type="date" class="form-control" id="fecha_implementación" name="fecha_implementación"/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap mt-3">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'controller','Plan');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'controller','Plan');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_PLAN_SEARCH());">
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