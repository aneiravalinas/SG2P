<?php

include './View/Page/header.php';

class Edit_User extends Header {
    var $user;

    function __construct($user) {
        parent::__construct();
        $this->user = $user;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 mt-4 i18n-edit-user">Editar Usuario</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <label for="foto_perfil">
                                <img src="<?php echo profile_photos_path . $this->user['foto_perfil'] ?>" id="picture-profile" class="rounded-circle"/>
                            </label>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioedit" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dni" class="i18n-dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $this->user['dni'] ?>" onblur="check_DNI();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username" class="i18n-username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $this->user['username'] ?>" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password" class="i18n-password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" onblur="check_PASSWORD_EDIT();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="i18n-email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $this->user['email'] ?>" onblur="check_EMAIL();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->user['nombre'] ?>" onblur="check_NAME();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellidos" class="i18n-apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $this->user['apellidos'] ?>" onblur="check_SURNAME();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="i18n-telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $this->user['telefono'] ?>" onblur="check_TELEFONO();"/>
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
                                        <option value="edificio" class="i18n-f-edificio" <?php if($this->user['rol'] == 'edificio') echo "selected"; ?>> Responsable de Edificio</option>
                                        <option value="registrado" class="i18n-f-registrado" <?php if($this->user['rol'] == 'registrado') echo "selected"; ?>>Usuario Registrado</option>
                                        <option value="organizacion" class="i18n-f-organizacion" <?php if($this->user['rol'] == 'organizacion') echo "selected"; ?>>Responsable Organizacion</option>
                                        <option value="administrador" class="i18n-f-administrador" <?php if($this->user['rol'] == 'administrador') echo "selected"; ?>>Administrador</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center">
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
                                            insertacampo(document.formularioedit,'username', '<?php echo $this->user['username']; ?>')
                                            insertacampo(document.formularioedit,'controller','User');
                                            insertacampo(document.formularioedit,'action','edit');
                                            enviaformcorrecto(document.formularioedit,check_EDIT());">
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
