<?php

include './View/Page/header.php';

class Edit_Space extends Header {
    var $space;
    var $floor;

    function __construct($space, $floor) {
        parent::__construct();
        $this->space = $space;
        $this->floor = $floor;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->floor['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-edit-space">Editar Espacio</h2>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <img src="<?php echo space_photos_path . $this->space['foto_espacio'] ?>" id="picture-profile" class="rounded-circle"/>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioedit" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="espacio_id" class="i18n-espacio_id">ID Espacio</label>
                                    <input type="text" class="form-control" id="espacio_id" name="espacio_id" value="<?php echo $this->space['espacio_id'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->space['nombre'] ?>" onblur="check_NOMBRE_ESPACIO();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="foto_espacio" class="i18n-foto_espacio">Foto del Espacio</label>
                                    <input type="file" class="form-control" id="foto_espacio" name="foto_espacio"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" onblur="check_DESCRIPCION_ESPACIO();"><?php echo $this->space['descripcion'] ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="go_current()">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioedit,'espacio_id','<?php echo $this->space['espacio_id'] ?>')
                                        insertacampo(document.formularioedit,'controller','Space');
                                        insertacampo(document.formularioedit,'action','edit');
                                        enviaformcorrecto(document.formularioedit,check_ESPACIO());">
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