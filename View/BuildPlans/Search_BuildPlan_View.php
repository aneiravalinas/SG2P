<?php

include './View/Page/header.php';

class Search_BuildPlan extends Header {
    var $plan;

    function __construct($plan) {
        parent::__construct();
        $this->plan = $plan;
        $this->render();
    }

    function render() {
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
                                <div class="form-group col-md-4">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->plan['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
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
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <input type="text" class="form-control" id="nombre_edificio" name="nombre_edificio" onblur="check_BUILDING_NAME_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_asignacion_inicio" class="i18n-start_date_assign">Fecha Asignación Inicial</label>
                                    <input type="date" class="form-control" id="fecha_asignacion_inicio" name="fecha_asignacion_inicio"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_asignacion_fin" class="i18n-end_date_assign">Fecha Asignación Final</label>
                                    <input type="date" class="form-control" id="fecha_asignacion_fin" name="fecha_asignacion_fin"/>
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
                                <div class="col d-flex justify-content-between flex-wrap mt-3">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="go_current()">
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