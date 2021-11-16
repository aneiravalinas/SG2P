<?php

include_once './View/Page/header.php';

class Implement_ImpProc extends Header {
    var $imp_proc;

    function __construct($imp_proc) {
        parent::__construct();
        $this->imp_proc = $imp_proc;
        $this->render();
    }

    function render() {
        ?>



        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->imp_proc['nombre_procedimiento'] ?></h1>
                        <h2 class="mb-4 i18n-cump-proc">Cumplimentar Procedimiento</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cumplimentacion_id" class="i18n-cump_id">ID Cumplimentación</label>
                                    <input type="text" value="<?php echo $this->imp_proc['cumplimentacion_id'] ?>" class="form-control" id="cumplimentacion_id" name="cumplimentacion_id" readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="procedimiento_id" class="i18n-procedimiento_id">ID Procedimiento</label>
                                    <input type="text" value="<?php echo $this->imp_proc['procedimiento_id'] ?>" class="form-control" id="procedimiento_id" name="procedimiento_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" value="<?php echo $this->imp_proc['edificio_id'] ?>" class="form-control" id="nombre" name="nombre" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre del Edificio</label>
                                    <input type="text" class="form-control" value="<?php echo $this->imp_proc['nombre_edificio'] ?>" id="nombre_edificio" name="nombre_edificio" disabled/>
                                </div>
                            </div>

                            <?php if($this->imp_proc['nombre_doc'] != default_doc): ?>
                                <div class="row">
                                    <div class="form-group col">
                                        <span class="d-block pb-2 i18n-actual-imp">Cumplimentación Actual</span>
                                        <a href="<?php echo $this->imp_proc['path'] . '/' . $this->imp_proc['nombre_doc']; ?>">
                                            <span class="iconify icon-pdf-form" data-icon="bi:file-earmark-pdf-fill"></span><span class="name_doc"><?php echo $this->imp_proc['nombre_doc'] ?></span>
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
                                            crearform('formenviar', 'post');
                                            <?php foreach($this->currentShow as $key => $value): ?>
                                            insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                            <?php endforeach; ?>
                                            enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'controller','ImpProc');
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