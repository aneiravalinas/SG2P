<?php

class Search_BuildPlan {
    var $plan;

    function __construct($plan) {
        $this->plan = $plan;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->plan['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-search-bldplan">Buscar asignaciones con Edificios</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->plan['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Simulacro</label>
                                    <input type="text" class="form-control" id="edificio_id" name="edificio_id" onblur="check_EDIFICIO_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <input type="text" class="form-control" id="nombre_edificio" name="nombre_edificio" onblur="check_BLDPLAN_NOMBRE_EDIFICIO_SEARCH();"/>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="estado" class="i18n-state">Estado</label>
                                    <select id="estado" name="estado" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="pendiente" class="i18n-pendiente">Pendiente</option>
                                        <option value="implementado" class="i18n-implementado">Implementado</option>
                                        <option value="vencido" class="i18n-vencido">Vencido</option>
                                    </select>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_asignacion" class="i18n-fecha_asignacion">Fecha Asignación</label>
                                    <input type="date" class="form-control" id="fecha_asignacion" name="fecha_asignacion"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_implementacion" class="i18n-fecha_implementacion">Fecha Implementación</label>
                                    <input type="date" class="form-control" id="fecha_implementación" name="fecha_implementación"/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap mt-3">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formenviar,'controller','BuildPlan');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','BuildPlan');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_BLDPLAN_SEARCH());">
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