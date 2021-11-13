<?php

include './View/Page/header.php';

class Show_DefDocs extends Header {
    var $docs;
    var $plan;

    function __construct($docs, $plan) {
        parent::__construct();
        $this->docs = $docs;
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
                        <h2 class="mb-4 i18n-def-docs">Definiciones de Documentos</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                insertacampo(document.formenviar,'controller','DefDoc');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'plan_id','<?php echo $this->plan['plan_id'] ?>');
                                insertacampo(document.formenviar,'controller','DefDoc');
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
                                <th scope="col" class="i18n-documento_id">ID Documento</th>
                                <th scope="col" class="i18n-nombre">Nombre</th>
                                <th scope="col" class="i18n-visible">Visible</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->docs as $doc): ?>
                                <tr>
                                    <td><?php echo $doc['documento_id'] ?></td>
                                    <td><?php echo $doc['nombre'] ?></td>
                                    <td class="i18n-<?php echo $doc['visible'] ?>"></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'documento_id','<?php echo $doc['documento_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','DefDoc');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-edit" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'documento_id','<?php echo $doc['documento_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','DefDoc');
                                                    insertacampo(document.formenviar, 'action', 'editForm');
                                                    enviaform(document.formenviar);">
                                                    Editar
                                                </a>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'documento_id','<?php echo $doc['documento_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','DefDoc');
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
                                                            insertacampo(document.formenviar,'documento_id','<?php echo $doc['documento_id'] ?>');
                                                            insertacampo(document.formenviar,'controller','ImpDoc');
                                                            insertacampo(document.formenviar,'action','show');
                                                            enviaform(document.formenviar);">
                                                <span class="iconify" data-icon="fluent:textbox-more-24-filled" data-inline="false"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->docs)) :?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <span class="i18n-def-docs-empty">No hay definiciones de documentos registradas</span>
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