<?php

include './View/Page/header.php';

class Search_Space extends Header {
    var $floor;

    function __construct($floor) {
        parent::__construct();
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
                        <h2 class="mb-4 i18n-search-space">Buscar Espacio</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="planta_id" class="i18n-planta_id">ID Planta</label>
                                    <input type="text" class="form-control" id="planta_id" name="planta_id" value="<?php echo $this->floor['planta_id'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="espacio_id" class="i18n-espacio_id">ID del Espacio</label>
                                    <input type="text" class="form-control" id="espacio_id" name="espacio_id" onblur="check_ESPACIO_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_ESPACIO_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="go_current()">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'planta_id','<?php echo $this->floor['planta_id'] ?>')
                                        insertacampo(document.formulariosearch,'controller','Space');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_ESPACIO_SEARCH());">
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