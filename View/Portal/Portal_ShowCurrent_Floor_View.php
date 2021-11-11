<?php

include './View/Page/header.php';

class Portal_ShowCurrent_Floor extends Header {
    var $floor;
    var $spaces;

    function __construct($floor, $spaces) {
        parent::__construct();
        $this->floor = $floor;
        $this->spaces = $spaces;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center pt-5 mt-5">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-details-floor">Detalles de la Planta</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <img src="<?php echo floor_photos_path . $this->floor['foto_planta'] ?>" id="picture-profile" class="rounded-circle"/>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-9">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="planta_id" class="i18n-planta_id">ID de Planta</label>
                                <input type="text" class="form-control" id="planta_id" name="planta_id" value="<?php echo $this->floor['planta_id'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edificio_id" class="i18n-edificio_id">ID de Edificio</label>
                                <input type="text" class="form-control" id="edificio_id" name="edificio_id" value="<?php echo $this->floor['edificio_id'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="i18n-nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->floor['nombre'] ?>" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="num_planta" class="i18n-num_planta">Número de Planta</label>
                                <input type="text" class="form-control" id="num_planta" name="num_planta" value="<?php echo $this->floor['num_planta'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" disabled><?php echo $this->floor['descripcion'] ?></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="go_previous()">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="hero" class="d-flex align-items-center py-0">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <!-- ======= FORM SECTION ====== --->

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-floor-spaces">Espacios de la Planta</h1>
                    </div>
                </div>

                <div class="row d-flex flex-wrap icon-boxes justify-content-center text-center">
                    <?php foreach($this->spaces as $space) :?>
                        <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box">
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'espacio_id',<?php echo $space['espacio_id'] ;?>);
                                    insertacampo(document.formenviar,'action','seekPortalSpace');
                                    insertacampo(document.formenviar,'controller','Portal');
                                    enviaform(document.formenviar);">
                                    <div>
                                        <div class="icon">
                                            <img src="<?php echo space_photos_path . $space['foto_espacio']; ?>" class="rounded-circle img-card"/>
                                        </div>
                                        <h2 class="title title-icon-box">
                                            <?php echo $space['nombre'] ?>
                                        </h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

<?php
        include './View/Page/footer.php';
    }
}
?>