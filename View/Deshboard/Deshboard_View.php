<?php

class Deshboard {

    function __construct() {
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <!-- ===== Panel Section ==== -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-admin">Panel de Administración</h1>
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
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-xl-3 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button">
                                <div>
                                    <div class="icon"><i class="iconify" data-icon="carbon:user-profile"></i></div>
                                    <h4 class="title i18n-profile">Mi Perfil</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php
        include './View/Page/footer.php';
    }
}

?>