<?php

class Portal_Buildings {
    var $buildings;

    function __construct($buildings) {
        $this->buildings = $buildings;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center mt-5 pt-5">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1>Selecciona un Edificio</h1>
                    </div>
                </div>

                <div class="row d-flex flex-wrap icon-boxes justify-content-center text-center">
                <?php foreach($this->buildings as $building) :?>
                    <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                        insertacampo(document.formenviar,'edificio_id',<?php echo $building['edificio_id'] ;?>);
                                        insertacampo(document.formenviar,'action','getPortal');
                                        insertacampo(document.formenviar,'controller','Portal');
                                        enviaform(document.formenviar);">
                                <div>
                                    <div class="icon">
                                        <img src="<?php echo building_photos_path . $building['foto_edificio']; ?>" class="rounded-circle img-card"/>
                                    </div>
                                    <h2 class="title" style="color: #124265;">
                                        <?php echo $building['nombre'] ?>
                                    </h2>
                                    <span>
                                        <?php echo $building['ciudad'] ?>
                                    </span>
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