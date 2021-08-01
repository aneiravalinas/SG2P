<?php

class Search_Floor {
    var $building;

    function __construct($building) {
        $this->building = $building;
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
                        <h1><?php echo $this->building['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-search-floor">Buscar Plantas</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" class="form-control" id="edificio_id" name="edifico_id" value="<?php echo $this->building['edificio_id'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="planta_id" class="i18n-planta_id">ID Planta</label>
                                    <input type="text" class="form-control" id="planta_id" name="planta_id" onblur="check_ID_PLANTA_SEARCH()"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_PLANTA_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="num_planta" class="i18n-num_planta">Número de Planta</label>
                                    <input type="text" class="form-control" id="num_planta" name="num_planta" onblur="check_NUM_PLANTA_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar, 'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Floor');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'edificio_id','<?php echo $this->building['edificio_id'] ?>')
                                        insertacampo(document.formulariosearch,'controller','Floor');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_SEARCH_PLANTA());">
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