<?php

include_once './View/Page/header.php';

class Deshboard extends Header {

    function __construct() {
        parent::__construct();
        $this->render();
    }

    function render() {
        ?>

        <!-- ===== Panel Section ==== -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-admin pt-3 mt-5">Panel de Administración</h1>
                        <h2 class="i18n-select-option">Selecciona una opción</h2>
                    </div>
                </div>

                <div class="row icon-boxes justify-content-center text-center">
                    <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                        insertacampo(document.formenviar,'action','show');
                                        insertacampo(document.formenviar,'controller','User');
                                        enviaform(document.formenviar);">
                                <div>
                                    <div class="icon"><i class="iconify" data-icon="mono-icons:users" data-inline="false"></i></div>
                                    <h4 class="title i18n-users">Usuarios</h4>
                                    <span class="i18n-info_users">Gestión los Usuarios registrados en el sistema</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-xl-3 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                        insertacampo(document.formenviar,'username','<?php echo $_SESSION['username']; ?>');
                                        insertacampo(document.formenviar,'action','profileForm');
                                        insertacampo(document.formenviar,'controller','User');
                                        enviaform(document.formenviar);">
                                <div>
                                    <div class="icon"><i class="iconify" data-icon="carbon:user-profile"></i></div>
                                    <h4 class="title i18n-profile">Mi Perfil</h4>
                                    <span class="i18n-info_profile">Gestión de los datos de tu Usuario</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php if(!es_registrado()): ?>
                    <div class="col-lg-4 col-sm-6 col-xl-3 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'action','show');
                                    insertacampo(document.formenviar,'controller','Building');
                                    enviaform(document.formenviar);">
                                <div>
                                    <div class="icon"><i class="iconify" data-icon="bi:building"></i></div>
                                    <h4 class="title i18n-buildings">Edificios</h4>
                                    <span class="i18n-info_buildings">Gestión de los datos de los Edificios, Plantas y Espacios</span>
                                </div>
                            </a>
                        </div>
                    </div>
                        <div class="col-lg-4 col-sm-6 col-xl-3 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box">
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'action','show');
                                    insertacampo(document.formenviar,'controller','Plan');
                                    enviaform(document.formenviar);">
                                    <div>
                                        <div class="icon"><i class="iconify" data-icon="carbon:document-attachment"></i></div>
                                        <h4 class="title i18n-manage-plans">Gestionar Planes</h4>
                                        <span class="i18n-info_impplans">Gestión de las cumplimentaciones de los Planes en los Edificios</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(es_resp_organizacion() || es_admin()): ?>
                        <div class="col-lg-4 col-sm-6 col-xl-3 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box">
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'action','show');
                                    insertacampo(document.formenviar,'controller','DefPlan');
                                    enviaform(document.formenviar);">
                                    <div>
                                        <div class="icon"><i class="iconify" data-icon="et:document"></i></div>
                                        <h4 class="title i18n-admin-plans">Administración de Planes</h4>
                                        <span class="i18n-info_defplans">Gestión las definiciones de los Planes y sus asignaciones con Edificios</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
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