<?php

include './View/Page/header.php';

class Show_Floors extends Header {
    var $floors;
    var $building;

    function __construct($floors, $building) {
        parent::__construct();
        $this->floors = $floors;
        $this->building = $building;
        $this->render();
    }

    function render() {
        ?>

        <!-- === SECTION TABLE === -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->building['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-floors">Plantas</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'controller','Floor');
                                    insertacampo(document.formenviar,'action','searchForm');
                                    enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'controller','Floor');
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
                                <th scope="col" class="i18n-planta_id">ID Planta</th>
                                <th scope="col" class="i18n-nombre">Nombre</th>
                                <th scope="col" class="i18n-num_planta">Número de Planta</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->floors as $floor): ?>
                                <tr>
                                    <td><?php echo $floor['planta_id'] ?></td>
                                    <td><?php echo $floor['nombre'] ?></td>
                                    <td><?php echo $floor['num_planta'] ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'planta_id','<?php echo $floor['planta_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','Floor');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <?php if(!es_resp_edificio()) :?>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item i18n-edit" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'planta_id','<?php echo $floor['planta_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','Floor');
                                                        insertacampo(document.formenviar, 'action', 'editForm');
                                                        enviaform(document.formenviar);">
                                                        Editar
                                                    </a>
                                                    <a class="dropdown-item i18n-delete" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'planta_id','<?php echo $floor['planta_id'] ?>');
                                                        insertacampo(document.formenviar,'controller','Floor');
                                                        insertacampo(document.formenviar,'action','deleteForm');
                                                        enviaform(document.formenviar);">
                                                        Eliminar
                                                    </a>
                                                <?php endif;?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-view-spaces" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'planta_id', '<?php echo $floor['planta_id'] ?>');
                                                    insertacampo(document.formenviar,'controller','Space');
                                                    insertacampo(document.formenviar,'action','show');
                                                    enviaform(document.formenviar);">
                                                    Ver Espacios
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->floors)) :?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <span class="i18n-floors-empty">No hay plantas registradas</span>
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