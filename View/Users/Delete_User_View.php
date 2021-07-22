<?php

class Delete_User {
    var $user;

    function __construct($user) {
        $this->user = $user;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4">Mensaje del Sistema</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h3 class="mb-4 i18n-del-confirm">¿Está seguro que desea eliminar a este usuario? El cambo no será reversible</h3>
                        <h2><?php echo $this->user['username'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="
                                        crearform('formenviar','post');
                                            insertacampo(document.formenviar,'controller','User');
                                            insertacampo(document.formenviar,'action','show');
                                            enviaform(document.formenviar);">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-delete" onclick="
                            crearform('formenviar','post');
                                insertacampo(document.formenviar, 'username', '<?php echo $this->user['username'] ?>');
                                insertacampo(document.formenviar, 'controller', 'User');
                                insertacampo(document.formenviar, 'action', 'delete');
                                enviaform(document.formenviar)">
                            Eliminar
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