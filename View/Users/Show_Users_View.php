<?php

include_once './View/Page/header.php';

class Show_Users extends Header {
    var $users;

    function __construct($users) {
        $this->users = $users;
        parent::__construct();
        $this->render();
    }

    function render() {
        ?>

        <!-- === SECTION TABLE === -->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-users">Usuarios</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'controller','User');
                                    insertacampo(document.formenviar,'action','searchForm');
                                    enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                            <?php if(es_admin()): ?>
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'controller','User');
                                    insertacampo(document.formenviar,'action','addForm');
                                    enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="i18n-dni text-center">DNI</th>
                                    <th scope="col" class="i18n-nombre text-center">Nombre</th>
                                    <th scope="col" class="i18n-username text-center">Usuario</th>
                                    <th scope="col" class="i18n-rol text-center">Rol</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->users as $user): ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $user['dni']?></td>
                                    <td class="text-center align-middle"><?php echo $user['nombre'] ?></td>
                                    <td class="text-center align-middle"><?php echo $user['username']?></td>
                                    <td class="i18n-f-<?php echo $user['rol']?> text-center align-middle"></td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                        insertacampo(document.formenviar,'username','<?php echo $user['username'] ?>');
                                                        insertacampo(document.formenviar,'controller','User');
                                                        insertacampo(document.formenviar,'action','showCurrent');
                                                        enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                            <?php if(es_admin()) :?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-edit" type="button" onclick="
                                                    crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'username', '<?php echo $user['username'] ?>');
                                                        insertacampo(document.formenviar, 'controller','User');
                                                        insertacampo(document.formenviar, 'action', 'editForm');
                                                        enviaform(document.formenviar);">
                                                    Editar
                                                </a>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                        insertacampo(document.formenviar,'username', '<?php echo $user['username'] ?>');
                                                        insertacampo(document.formenviar,'controller','User');
                                                        insertacampo(document.formenviar,'action','deleteForm');
                                                        enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            <?php endif;?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
