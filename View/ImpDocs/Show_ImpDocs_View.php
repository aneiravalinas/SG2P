<?php

include './View/Page/header.php';

class Show_ImpDocs extends Header {
    var $imp_docs;
    var $document;

    function __construct($imp_docs, $document) {
        parent::__construct();
        $this->imp_docs = $imp_docs;
        $this->document = $document;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->document['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-impdocs">Cumplimentaciones del Documento</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'documento_id','<?php echo $this->document['documento_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpDoc');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'documento_id','<?php echo $this->document['documento_id'] ?>');
                                insertacampo(document.formenviar,'controller','ImpDoc');
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
                                <th scope="col" class="text-center i18n-nombre_doc">Nombre Documento</th>
                                <th scope="col" class="text-center i18n-state">Estado</th>
                                <th scope="col" class="text-center i18n-date_comp">Fecha Cumplimentación</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->imp_docs as $imp_doc): ?>
                                <tr>
                                    <td class="text-center"><?php echo $imp_doc['nombre_edificio'] ?></td>
                                    <td class="text-center"><?php if($imp_doc['nombre_doc'] != default_doc) echo $imp_doc['nombre_doc']; ?></td>
                                    <td class="text-center i18n-<?php echo $imp_doc['estado'] ?> <?php echo $imp_doc['estado'] ?>"></td>
                                    <td class="text-center"><?php if($imp_doc['fecha_cumplimentacion'] != default_data) echo date_format(date_create($imp_doc['fecha_cumplimentacion']),'d/m/Y');?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'cumplimentacion_id','<?php echo $imp_doc['cumplimentacion_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','ImpDoc');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <?php if($imp_doc['estado'] != 'vencido') :?>
                                                <a class="dropdown-item i18n-implement" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_doc['cumplimentacion_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','ImpDoc');
                                                        insertacampo(document.formenviar, 'action', 'implementForm');
                                                        enviaform(document.formenviar);">
                                                    Cumplimentar
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-expire" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_doc['cumplimentacion_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','ImpDoc');
                                                    insertacampo(document.formenviar, 'action', 'expireForm');
                                                    enviaform(document.formenviar);">
                                                    Vencer
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <?php endif; ?>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_doc['cumplimentacion_id'] ?>');
                                                    insertacampo(document.formenviar, 'controller','ImpDoc');
                                                    insertacampo(document.formenviar, 'action','deleteForm');
                                                    enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->imp_docs)) :?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="i18n-imp-docs-empty">No se han encontrado cumplimentaciones del documento</span>
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