<?php

class Implement_Document {
    var $imp_doc;

    function __construct($imp_doc) {
        $this->imp_doc = $imp_doc;
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
                        <h1><?php echo $this->imp_doc['nombre_documento'] ?></h1>
                        <h2 class="mb-4 i18n-cump-doc">Cumplimentar Documento</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="edificio_documento_id" class="i18n-impdoc_id">ID Cumplimentación</label>
                                    <input type="text" value="<?php echo $this->imp_doc['edificio_documento_id'] ?>" class="form-control" id="edificio_documento_id" name="edificio_documento_id" readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="documento_id" class="i18n-documento_id">ID Documento</label>
                                    <input type="text" value="<?php echo $this->imp_doc['documento_id'] ?>" class="form-control" id="documento_id" name="documento_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" value="<?php echo $this->imp_doc['edificio_id'] ?>" class="form-control" id="nombre" name="nombre" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre del Edificio</label>
                                    <input type="text" class="form-control" value="<?php echo $this->imp_doc['nombre_edificio'] ?>" id="nombre_edificio" name="nombre_edificio" disabled/>
                                </div>
                            </div>

                            <?php if($this->imp_doc['nombre_doc'] != default_doc): ?>
                            <div class="row">
                                <div class="form-group col">
                                    <span class="d-block pb-2 i18n-actual-imp">Cumplimentación Actual</span>
                                    <a href="<?php echo $this->imp_doc['path'] . '/' . $this->imp_doc['nombre_doc']; ?>">
                                        <span class="iconify icon-pdf-form" data-icon="bi:file-earmark-pdf-fill"></span><span class="name_doc"><?php echo $this->imp_doc['nombre_doc'] ?></span>
                                    </a>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_doc" class="i18n-file_doc">Fichero de la Cumplimentación</label>
                                    <input type="file" class="form-control" id="nombre_doc" name="nombre_doc" accept=".pdf"/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'documento_id', '<?php echo $this->imp_doc['documento_id'] ?>');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->imp_doc['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Document');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'controller','Document');
                                        insertacampo(document.formularioadd,'action','implement');
                                        enviaformcorrecto(document.formularioadd,check_NOMBRE_DOC());">
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