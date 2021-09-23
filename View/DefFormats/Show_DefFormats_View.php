<?php

class Show_DefFormats {
    var $formats;
    var $plan;

    function __construct($formats, $plan) {
        $this->formats = $formats;
        $this->plan = $plan;
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
                        <h1><?php echo $this->plan['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-def-formats">Definiciones de Formaciones</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                insertacampo(document.formenviar,'controller','DefFormat');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                insertacampo(document.formenviar,'controller','DefFormat');
                                insertacampo(document.formenviar,'action','addForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="i18n-formacion_id">ID Formacion</th>
                                <th scope="col" class="i18n-nombre">Nombre</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->formats as $format): ?>
                                <tr>
                                    <td><?php echo $format['formacion_id'] ?></td>
                                    <td><?php echo $format['nombre'] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'formacion_id','<?php echo $format['formacion_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','DefFormat');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-edit" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'formacion_id','<?php echo $format['formacion_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','DefFormat');
                                                    insertacampo(document.formenviar, 'action', 'editForm');
                                                    enviaform(document.formenviar);">
                                                    Editar
                                                </a>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'formacion_id','<?php echo $format['formacion_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','DefFormat');
                                                    insertacampo(document.formenviar,'action','deleteForm');
                                                    enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm" data-boundary="window" aria-haspopup="true" aria-expanded="false"
                                                    onclick="
                                                            crearform('formenviar','post');
                                                            insertacampo(document.formenviar,'formacion_id','<?php echo $format['formacion_id'] ?>');
                                                            insertacampo(document.formenviar,'controller','ImpFormat');
                                                            insertacampo(document.formenviar,'action','show');
                                                            enviaform(document.formenviar);">
                                                <span class="iconify" data-icon="fluent:textbox-more-24-filled" data-inline="false"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->formats)) :?>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <span class="i18n-def-formats-empty">No hay definiciones de formaciones registradas</span>
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
                            insertacampo(document.formenviar,'controller','DefPlan');
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