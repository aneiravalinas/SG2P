<?php

class Search_User {

    function __construct() {
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-search-users">Búsqueda de Usuario</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dni" class="i18n-dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" onblur="check_DNI_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username" class="i18n-username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" onblur="check_USERNAME_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NAME_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellidos" class="i18n-apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" onblur="check_SURNAME_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="i18n-telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" onblur="check_TELEFONO_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="i18n-email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="example@mail.ext" onblur="check_EMAIL_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="select-rol" class="i18n-rol">Rol</label>
                                    <select id="rol" name="rol" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="registrado" class="i18n-f-registrado">Usuario Registrado</option>
                                        <option value="edificio" class="i18n-f-edificio">Responsable Edificio</option>
                                        <option value="organizacion" class="i18n-f-organizacion">Responsable Organizacion</option>
                                        <option value="administrador" class="i18n-f-administrador">Administrador</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                            insertacampo(document.formenviar,'controller','User');
                                            insertacampo(document.formenviar,'action','show');
                                            enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                            insertacampo(document.formulariosearch,'controller','User');
                                            insertacampo(document.formulariosearch,'action','show');
                                            enviaformcorrecto(document.formulariosearch,check_SEARCH());">
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