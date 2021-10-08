<?php

class Show_Plans {
    var $buildPlans;

    function __construct($buildPlans) {
        $this->buildPlans = $buildPlans;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <!-- === SECTION TABLE === -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-list-plans">Listado de Planes</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'controller','Plan');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="i18n-building text-center">Edificio</th>
                                <th scope="col" class="i18n-plan text-center">Plan</th>
                                <th scope="col" class="i18n-state text-center">Estado</th>
                                <th scope="col" class="i18n-date_assign text-center">Fecha Asignación</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->buildPlans as $buildPlan): ?>
                                <tr>
                                    <td class="text-center"><?php echo $buildPlan['nombre_edificio'] ?></td>
                                    <td class="text-center"><?php echo $buildPlan['nombre_plan'] ?></td>
                                    <td class="i18n-<?php echo $buildPlan['estado'] ?> <?php echo $buildPlan['estado'] ?> text-center"></td>
                                    <td class="text-center"><?php echo date_format(date_create($buildPlan['fecha_asignacion']), 'd/m/Y') ?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm" data-boundary="window" aria-haspopup="true" aria-expanded="false"
                                                    onclick="
                                                            crearform('formenviar','post');
                                                            insertacampo(document.formenviar, 'edificio_id', '<?php echo $buildPlan['edificio_id'] ?>');
                                                            insertacampo(document.formenviar, 'plan_id', '<?php echo $buildPlan['plan_id'] ?>');
                                                            insertacampo(document.formenviar, 'controller', 'Plan');
                                                            insertacampo(document.formenviar, 'action', 'showCurrent');
                                                            enviaform(document.formenviar);">
                                                <span class="iconify" data-icon="fluent:textbox-more-24-filled" data-inline="false"></span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm" data-boundary="window" aria-haspopup="true" aria-expanded="false"
                                                    onclick="
                                                            crearform('formenviar','post');
                                                            insertacampo(document.formenviar, 'edificio_id', '<?php echo $buildPlan['edificio_id'] ?>');
                                                            insertacampo(document.formenviar, 'plan_id', '<?php echo $buildPlan['plan_id'] ?>');
                                                            insertacampo(document.formenviar, 'controller', 'Plan');
                                                            insertacampo(document.formenviar, 'action', 'expireForm');
                                                            enviaform(document.formenviar);">
                                                <span class="iconify" data-icon="ant-design:clock-circle-outlined" data-inline="false"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->buildPlans)) :?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="i18n-list-plans-empty">No se encontraron asignaciones de Planes</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col text-center">
                        <a class="btn-get-started i18n-back" type="button" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar,'controller','Panel');
                            insertacampo(document.formenviar,'action','deshboard');
                            enviaform(document.formenviar);">
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