<?php

class Show_ImpRoutes {
    var $imp_routes;
    var $route;

    function __construct($imp_routes, $route) {
        $this->imp_routes = $imp_routes;
        $this->route = $route;
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
                        <h2 class="mb-4 i18n-improutes">Cumplimentaciones de la Ruta</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'ruta_id','<?php echo $this->route['ruta_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpRoute');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'ruta_id','<?php echo $this->route['ruta_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpRoute');
                                insertacampo(document.formenviar,'action','addForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center i18n-nombre_edificio">Nombre Edificio</th>
                                <th scope="col" class="text-center i18n-nombre_planta">Nombre Planta</th>
                                <th scope="col" class="text-center i18n-nombre_doc">Nombre Documento</th>
                                <th scope="col" class="text-center i18n-state">Estado</th>
                                <th scope="col" class="text-center i18n-date_comp">Fecha Cumplimentación</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->imp_routes as $imp_route): ?>
                                <tr>
                                    <td class="text-center"><?php echo $imp_route['nombre_edificio'] ?></td>
                                    <td class="text-center"><?php echo $imp_route['nombre_planta'] ?></td>
                                    <td class="text-center"><?php if($imp_route['nombre_doc'] != default_doc) echo $imp_route['nombre_doc']; ?></td>
                                    <td class="text-center i18n-<?php echo $imp_route['estado'] ?> <?php echo $imp_route['estado'] ?>"></td>
                                    <td class="text-center"><?php if($imp_route['fecha_cumplimentacion'] != default_data) echo date_format(date_create($imp_route['fecha_cumplimentacion']),'d/m/Y');?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'planta_ruta_id','<?php echo $imp_route['planta_ruta_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','ImpRoute');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <?php if($imp_route['estado'] != 'vencido') :?>
                                                    <a class="dropdown-item i18n-implement" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'planta_ruta_id','<?php echo $imp_route['planta_ruta_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','ImpRoute');
                                                        insertacampo(document.formenviar, 'action', 'implementForm');
                                                        enviaform(document.formenviar);">
                                                        Cumplimentar
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item i18n-expire" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'planta_ruta_id','<?php echo $imp_route['planta_ruta_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','ImpRoute');
                                                        insertacampo(document.formenviar, 'action', 'expireForm');
                                                        enviaform(document.formenviar);">
                                                        Vencer
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                <?php endif; ?>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'planta_ruta_id','<?php echo $imp_route['planta_ruta_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','ImpRoute');
                                                    insertacampo(document.formenviar, 'action','deleteForm');
                                                    enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->imp_routes)) :?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <span class="i18n-imp-routes-empty">No se han encontrado cumplimentaciones de la ruta</span>
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
                            insertacampo(document.formenviar,'plan_id',<?php echo $this->route['plan_id'] ?>);
                            insertacampo(document.formenviar,'controller','DefRoute');
                            insertacampo(document.formenviar,'action','show');
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