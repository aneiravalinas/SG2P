<?php

include './View/Page/header.php';

class Show_BuildPlan extends Header {
    var $buildPlans;
    var $plan;

    function __construct($buildPlans, $plan) {
        parent::__construct();
        $this->buildPlans = $buildPlans;
        $this->plan = $plan;
        $this->render();
    }

    function render() {
        ?>

        <!-- === SECTION TABLE === -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->plan['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-assign-bldplan">Edificios Asignados</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 flex-wrap d-flex justify-content-between" id="search_add">
                        <div>
                            <button type="button" class="btn btn-outline-secondary i18n-expire_all" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                    insertacampo(document.formenviar,'controller','BuildPlan');
                                    insertacampo(document.formenviar,'action','expireAllForm');
                                    enviaform(document.formenviar);">
                                Vencer TODAS
                            </button>
                        </div>
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                insertacampo(document.formenviar,'controller','BuildPlan');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                insertacampo(document.formenviar,'controller','BuildPlan');
                                insertacampo(document.formenviar,'action','addForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="i18n-building text-center">Edificio</th>
                                <th scope="col" class="i18n-date_assign text-center">Fecha Asignación</th>
                                <th scope="col" class="i18n-state text-center">Estado</th>
                                <th scope="col" class="i18n-date_comp text-center">Fecha Implementación</th>
                                <th scope="col" class="i18n-date_expire text-center">Fecha Vencimiento</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->buildPlans as $buildPlan): ?>
                                <tr>
                                    <td class="text-center"><?php echo $buildPlan['nombre_edificio'] ?></td>
                                    <td class="text-center"><?php echo date_format(date_create($buildPlan['fecha_asignacion']), 'd/m/Y') ?></td>
                                    <td class="i18n-<?php echo $buildPlan['estado'] ?> <?php echo $buildPlan['estado'] ?> text-center"></td>
                                    <td class="text-center"><?php if($buildPlan['fecha_cumplimentacion'] != default_data) echo date_format(date_create($buildPlan['fecha_cumplimentacion']),'d/m/Y');?></td>
                                    <td class="text-center"><?php if($buildPlan['fecha_vencimiento'] != default_data) echo date_format(date_create($buildPlan['fecha_vencimiento']),'d/m/Y');?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <?php if($buildPlan['estado'] != 'vencido'): ?>
                                                <a class="dropdown-item i18n-expire" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'plan_id','<?php echo $buildPlan['plan_id'] ?>');
                                                    insertacampo(document.formenviar, 'edificio_id','<?php echo $buildPlan['edificio_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','BuildPlan');
                                                    insertacampo(document.formenviar, 'action', 'expireForm');
                                                    enviaform(document.formenviar);">
                                                    Vencer
                                                </a>
                                                    <div class="dropdown-divider"></div>
                                                <?php endif; ?>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'plan_id','<?php echo $buildPlan['plan_id'] ?>');
                                                    insertacampo(document.formenviar, 'edificio_id','<?php echo $buildPlan['edificio_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','BuildPlan');
                                                    insertacampo(document.formenviar,'action','deleteForm');
                                                    enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->buildPlans)) :?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <span class="i18n-bldplan-empty">El plan no tiene edificios asignados</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col text-center">
                        <a class="btn-get-started i18n-back" type="button" onclick="go_previous()">
                            Volver
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