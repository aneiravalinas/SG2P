<?php

include_once './View/Page/header.php';

class Show_Buildings extends Header {
    var $buildings;

    function __construct($buildings) {
        parent::__construct();
        $this->buildings = $buildings;
        $this->render();
    }

    function render() {
        ?>

        <!-- === SECTION TABLE === -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-buildings">Edificios</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'controller','Building');
                                    insertacampo(document.formenviar,'action','searchForm');
                                    enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'controller','Building');
                                    insertacampo(document.formenviar,'action','addForm');
                                    enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="i18n-responsable text-center">Responsable</th>
                                <th scope="col" class="i18n-nombre text-center">Nombre</th>
                                <th scope="col" class="i18n-city text-center">Ciudad</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->buildings as $building): ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $building['username'] ?></td>
                                    <td class="text-center align-middle"><?php echo $building['nombre'] ?></td>
                                    <td class="text-center align-middle"><?php echo $building['ciudad'] ?></td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'edificio_id','<?php echo $building['edificio_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','Building');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <?php if(!es_resp_edificio()) :?>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item i18n-edit" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'edificio_id', '<?php echo $building['edificio_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','Building');
                                                        insertacampo(document.formenviar, 'action', 'editForm');
                                                        enviaform(document.formenviar);">
                                                        Editar
                                                    </a>
                                                    <a class="dropdown-item i18n-delete" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $building['edificio_id'] ?>');
                                                        insertacampo(document.formenviar,'controller','Building');
                                                        insertacampo(document.formenviar,'action','deleteForm');
                                                        enviaform(document.formenviar);">
                                                        Eliminar
                                                    </a>
                                                <?php endif;?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-view-floors" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $building['edificio_id'] ?>');
                                                        insertacampo(document.formenviar,'controller','Floor');
                                                        insertacampo(document.formenviar,'action','show');
                                                        enviaform(document.formenviar);">
                                                    Ver Plantas
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->buildings)) :?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <span class="i18n-buildings-empty">No hay edificios registrados</span>
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