<?php

include_once './View/Page/header.php';

class Show_ImpFormats extends Header {
    var $imp_formats;
    var $formation;

    function __construct($imp_formats, $formation) {
        parent::__construct();
        $this->imp_formats = $imp_formats;
        $this->formation = $formation;
        $this->render();
    }

    function render() {
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->formation['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-impformats">Cumplimentaciones de la Formación</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'formacion_id','<?php echo $this->formation['formacion_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpFormat');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'formacion_id','<?php echo $this->formation['formacion_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpFormat');
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
                                <th scope="col" class="text-center i18n-nombre_edificio">Nombre Edificio</th>
                                <th scope="col" class="text-center i18n-state">Estado</th>
                                <th scope="col" class="text-center i18n-planning_date">Fecha Planificación</th>
                                <th scope="col" class="text-center i18hn-date_expire">Fecha Vencimiento</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->imp_formats as $imp_format): ?>
                                <tr>
                                    <td class="text-center"><?php echo $imp_format['nombre_edificio'] ?></td>
                                    <td class="text-center i18n-<?php echo $imp_format['estado'] ?> <?php echo $imp_format['estado'] ?>"></td>
                                    <td class="text-center"><?php if($imp_format['fecha_planificacion'] != default_data) echo date_format(date_create($imp_format['fecha_planificacion']),'d/m/Y');?></td>
                                    <td class="text-center"><?php if($imp_format['fecha_vencimiento'] != default_data) echo date_format(date_create($imp_format['fecha_vencimiento']),'d/m/Y');?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','ImpFormat');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <?php if($imp_format['estado'] != 'vencido') :?>
                                                    <a class="dropdown-item i18n-implement" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','ImpFormat');
                                                        insertacampo(document.formenviar, 'action', 'implementForm');
                                                        enviaform(document.formenviar);">
                                                        Cumplimentar
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item i18n-expire" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','ImpFormat');
                                                        insertacampo(document.formenviar, 'action', 'expireForm');
                                                        enviaform(document.formenviar);">
                                                        Vencer
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                <?php endif; ?>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','ImpFormat');
                                                    insertacampo(document.formenviar, 'action','deleteForm');
                                                    enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->imp_formats)) :?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="i18n-imp-formats-empty">No se han encontrado cumplimentaciones de la formación</span>
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
                                crearform('formenviar', 'post');
                                insertacampo(document.formenviar, 'go_back', 'go_back');
                                <?php foreach($this->previousShow as $key => $value): ?>
                                insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                <?php endforeach; ?>
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