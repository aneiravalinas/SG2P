<?php

include_once './View/Page/header.php';

class Portal_Floors extends Header {
    var $floors;

    function __construct($floors) {
        parent::__construct();
        $this->floors = $floors;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <?php if(!empty($this->floors)) :?>
                <div class="row justify-content-center mt-5 pt-5">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-select-floor">Selecciona una Planta</h1>
                    </div>
                </div>

                <div class="row d-flex flex-wrap icon-boxes justify-content-center text-center">
                    <?php foreach($this->floors as $floor) :?>
                        <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                            <div class="icon-box">
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'planta_id',<?php echo $floor['planta_id'] ;?>);
                                    insertacampo(document.formenviar,'action','seekPortalFloor');
                                    insertacampo(document.formenviar,'controller','Portal');
                                    enviaform(document.formenviar);">
                                    <div>
                                        <div class="icon">
                                            <img src="<?php echo floor_photos_path . $floor['foto_planta']; ?>" class="rounded-circle img-card"/>
                                        </div>
                                        <h2 class="title title-icon-box">
                                            <?php echo $floor['nombre'] ?>
                                        </h2>
                                        <span class="i18n-piso">Piso: </span><span><?php echo $floor['num_planta'] ?></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <div class="row justify-content-center mt-5 pt-5">
                        <div class="col text-center">
                            <h1 class="i18n-portal-floors-empty">Este edificio no tiene plantas registradas todavía</h1>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row justify-content-center">
                    <div class="col text-center">
                        <a class="btn-get-started i18n-back" type="button" onclick="
                                crearform('formenviar','post');
                                <?php foreach($this->previousShow as $key => $value): ?>
                                insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                <?php endforeach; ?>
                                insertacampo(document.formenviar, 'go_back', 'go_back');
                                enviaform(document.formenviar);">
                            Volver
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