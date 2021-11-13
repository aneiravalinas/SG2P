<?php

include './View/Page/header.php';

class Add_Floor extends Header {
    var $building;

    function __construct($building) {
        parent::__construct();
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
                        <h2 class="mb-4 i18n-add-floor">Añadir Planta</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" class="form-control" id="edificio_id" name="edifico_id" value="<?php echo $this->building['edificio_id'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_PLANTA();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="num_planta" class="i18n-num_planta">Número de Planta</label>
                                    <input type="text" class="form-control" id="num_planta" name="num_planta" onblur="check_NUM_PLANTA();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto_planta" class="i18n-foto_planta">Foto de la Planta</label>
                                    <input type="file" class="form-control-sm" id="foto_planta" name="foto_planta"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" onblur="check_DESCRIPCION_PLANTA();"></textarea>
                                </div>
                            </div>

                            <div class="row">
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
                                            insertacampo(document.formularioadd,'edificio_id','<?php echo $this->building['edificio_id'] ?>')
                                            insertacampo(document.formularioadd,'controller','Floor');
                                            insertacampo(document.formularioadd,'action','add');
                                            enviaformcorrecto(document.formularioadd,check_ADD_PLANTA());">
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