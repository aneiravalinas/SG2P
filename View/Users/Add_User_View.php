<?php

include_once './View/Page/header.php';

class Add_User extends Header {

    function __construct() {
        parent::__construct();
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-add-users">Añadir Usuario</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dni" class="i18n-dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" onblur="check_DNI();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username" class="i18n-username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" onblur="check_USERNAME();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password" class="i18n-password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" onblur="check_PASSWORD();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="i18n-email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="example@mail.ext" onblur="check_EMAIL();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NAME();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellidos" class="i18n-apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" onblur="check_SURNAME();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="i18n-telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" onblur="check_TELEFONO();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto_perfil" class="i18n-foto_perfil">Foto de Perfil</label>
                                    <input type="file" class="form-control-sm" id="foto_perfil" name="foto_perfil"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="rol" class="i18n-rol">Rol</label>
                                    <select id="rol" name="rol" class="form-select">
                                        <option value="" class="i18n-selecciona-rol">Selecciona un Rol</option>
                                        <option value="registrado" class="i18n-f-registrado">Usuario Registrado</option>
                                        <option value="organizacion" class="i18n-f-organizacion">Responsable Organizacion</option>
                                        <option value="administrador" class="i18n-f-administrador">Administrador</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                            crearform('formenviar', 'post');
                                            <?php foreach($this->currentShow as $key => $value): ?>
                                            insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                            <?php endforeach; ?>
                                            enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                            insertacampo(document.formularioadd,'controller','User');
                                            insertacampo(document.formularioadd,'action','add');
                                            enviaformcorrecto(document.formularioadd,check_ADD());">
                                        Enviar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



<?php
        include './View/Page/footer.php';
    }
}

?>
