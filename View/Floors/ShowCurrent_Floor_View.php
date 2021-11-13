<?php

include './View/Page/header.php';

class ShowCurrent_Floor extends Header {
    var $floor;
    var $building;

    function __construct($floor, $building) {
        parent::__construct();
        $this->floor = $floor;
        $this->building = $building;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->building['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-details-floor">Detalles de la Planta</h2>
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
                </div>
            </div>
        </section>


<?php
        include './View/Page/footer.php';
    }
}
?>