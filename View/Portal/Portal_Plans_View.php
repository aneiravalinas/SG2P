<?php

class Portal_Plans {
    var $buildPlans;
    var $building;

    function __construct($buildPlans, $building) {
        $this->buildPlans = $buildPlans;
        $this->building = $building;
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
                        <h1><?php echo $this->building['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-list-plans">Listado de Planes</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <form class="form-inline" name="formulariosearch" method="post">
                            <input class="form-control-sm" type="search" name="nombre_plan" id="nombre_plan" placeholder="Nombre del Plan" onblur="check_NOMBRE_PLAN_SEARCH();"/>
                            <a type="button" onclick="
                                insertacampo(document.formulariosearch, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                insertacampo(document.formulariosearch, 'controller', 'Portal');
                                insertacampo(document.formulariosearch, 'action','showPortalPlans');
                                enviaformcorrecto(document.formulariosearch,check_NOMBRE_PLAN_SEARCH())">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="i18n-plan">Plan</th>
                                <th scope="col" class="i18n-date_assign">Fecha Asignación</th>
                                <th scope="col" class="i18n-state">Estado</th>
                                <th scope="col" class="i18n-date_impl">Fecha Implementación</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->buildPlans as $buildPlan): ?>
                                <tr>
                                    <td><?php echo $buildPlan['nombre_plan'] ?></td>
                                    <td><?php echo date_format(date_create($buildPlan['fecha_asignacion']), 'd/m/Y') ?></td>
                                    <td class="i18n-<?php echo $buildPlan['estado'] ?> <?php echo $buildPlan['estado'] ?>"></td>
                                    <td><?php if($buildPlan['fecha_implementacion'] != default_data) echo date_format(date_create($buildPlan['fecha_implementacion']), 'd/m/Y'); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                            <span class="iconify" data-icon="fluent:textbox-more-24-filled" data-inline="false"></span>
                                        </button>
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
                            insertacampo(document.formenviar,'controller','Portal');
                            insertacampo(document.formenviar,'action','getPortal');
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