<?php

include './View/Page/header.php';

class Add_Document extends Header {
    var $document;
    var $building;

    function __construct($document, $building) {
        parent::__construct();
        $this->document = $document;
        $this->building = $building;
        $this->render();
    }

    function render() {
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-msg-system">Mensaje del Sistema</h1>
                        <h2 class="mb-4 i18n-add-imp-doc-confirm">¿Está seguro que desea añadir la siguiente cumplimentación?</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" class="form-control" value="<?php echo $this->document['plan_id'] ?>" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="documento_id" class="i18n-documento_id">ID Documento</label>
                                    <input type="text" class="form-control" value="<?php echo $this->document['documento_id'] ?>" id="documento_id" name="documento_id" readonly/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_defdoc" class="i18n-documento">Documento</label>
                                    <input type="text" class="form-control" value="<?php echo $this->document['nombre'] ?>" id="nombre_defdoc" name="nombre_defdoc" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre del Edificio</label>
                                    <input type="text" value="<?php echo $this->building['nombre'] ?>" class="form-control" id="nombre_edificio" disabled/>
                                    <input type="hidden" id="buildings" name="buildings[]" value="<?php echo $this->building['edificio_id'] ?>"/>
                                </div>
                            </div>
                        </form>
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
                                        insertacampo(document.formularioadd,'controller','Document');
                                        insertacampo(document.formularioadd,'action','add');
                                        enviaform(document.formularioadd);">
                                    Enviar
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