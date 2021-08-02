<?php

class Portal_Manager {
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
                        <h1 class="mb-4 mt-4 i18n-details-manager">Información del Responsable</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <label for="foto_perfil">
                                <img src="<?php echo profile_photos_path . $this->user['foto_perfil'] ?>" id="picture-profile" class="rounded-circle"/>
                            </label>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="dni" class="i18n-dni">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $this->user['dni'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username" class="i18n-username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $this->user['username'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="i18n-nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->user['nombre'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidos" class="i18n-apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $this->user['apellidos'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email" class="i18n-email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $this->user['email'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono" class="i18n-telefono">Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $this->user['telefono'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="rol" class="i18n-rol">Rol</label>
                                <select id="rol" name="rol" class="form-select" disabled>
                                    <option value="<?php echo $this->user['rol'] ?>" class="i18n-f-<?php echo $this->user['rol'] ?>" selected></option>
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="
                                        crearform('formenviar','post');
                                            insertacampo(document.formenviar,'controller','Portal');
                                            insertacampo(document.formenviar,'action','getPortal');
                                            enviaform(document.formenviar);">
                                    Volver
                                </a>
                            </div>
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