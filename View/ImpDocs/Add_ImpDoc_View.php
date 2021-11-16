<?php

include_once './View/Page/header.php';

class Add_ImpDoc extends Header {
    var $buildings;
    var $document;

    function __construct($buildings, $document) {
        parent::__construct();
        $this->buildings = $buildings;
        $this->document = $document;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->document['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-add-impdoc">Añadir Cumplimentaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">Plan ID</label>
                                    <input type="text" value="<?php echo $this->document['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="documento_id" class="i18n-documento_id">ID Documento</label>
                                    <input type="text" value="<?php echo $this->document['documento_id'] ?>" class="form-control" id="documento_id" name="documento_id" disabled/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <label for="buildings" class="i18n-buildings">Edificios</label>
                                    <select class="form-control selectpicker" size="4" id="buildings" name="buildings[]"
                                            multiple
                                            data-live-search="true"
                                            data-live-search-placeholder="Search...">
                                        <?php foreach($this->buildings as $building): ?>
                                        <option value="<?php echo $building['edificio_id'] ?>">
                                            <?php echo $building['nombre_edificio'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
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
                                        insertacampo(document.formularioadd,'documento_id', '<?php echo $this->document['documento_id'] ?>');
                                        insertacampo(document.formularioadd,'controller','ImpDoc');
                                        insertacampo(document.formularioadd,'action','add');
                                        enviaformcorrecto(document.formularioadd,check_BUILDINGS());">
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