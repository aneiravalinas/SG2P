<?php

class ShowCurrent_DefDoc {
    var $doc;

    function __construct($doc) {
        $this->doc = $doc;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-current-defDoc">Detalles de la def. del Documento</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->doc['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="documento_id" class="i18n-documento_id">ID Documento</label>
                                    <input type="text" value="<?php echo $this->doc['documento_id'] ?>" class="form-control" id="documento_id" name="documento_id" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" value="<?php echo $this->doc['nombre'] ?>" class="form-control" id="nombre" name="nombre" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="visible" class="i18n-visible">Visible</label>
                                    <select id="visible" name="visible" class="form-select" disabled>
                                        <option value="yes" class="i18n-yes" <?php if($this->doc['visible'] == 'yes') echo "selected" ?>>Sí</option>
                                        <option value="no" class="i18n-no" <?php if($this->doc['visible'] == 'no') echo "selected" ?>>No</option>
                                    </select>
                                </div>
                            </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'plan_id','<?php echo $this->doc['plan_id'] ?>');
                                    insertacampo(document.formenviar,'controller','DefDoc');
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