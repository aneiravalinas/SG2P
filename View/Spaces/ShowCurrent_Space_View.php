<?php

class ShowCurrent_Space {
    var $space;
    var $floor;

    function __construct($space, $floor) {
        $this->space = $space;
        $this->floor = $floor;
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
                        <h1><?php echo $this->floor['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-details-space">Detalles del Espacio</h2>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <img src="<?php echo space_photos_path . $this->space['foto_espacio'] ?>" id="picture-profile" class="rounded-circle"/>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-9">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="espacio_id" class="i18n-espacio_id">ID del Espacio</label>
                                <input type="text" class="form-control" id="espacio_id" name="espacio_id" value="<?php echo $this->space['espacio_id'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre" class="i18n-nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->space['nombre'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" disabled><?php echo $this->space['descripcion'] ?></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'planta_id',<?php echo $this->space['planta_id'] ?>);
                                    insertacampo(document.formenviar,'controller','Space');
                                    insertacampo(document.formenviar,'action','show');
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