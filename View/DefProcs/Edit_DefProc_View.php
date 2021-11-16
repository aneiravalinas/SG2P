<?php

include_once './View/Page/header.php';

class Edit_DefProc extends Header {
    var $proc;

    function __construct($proc) {
        parent::__construct();
        $this->proc = $proc;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-edit-defProc">Editar def. del Procedimiento</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioedit" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->proc['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="procedimiento_id" class="i18n-procedimiento_id">ID Procedimiento</label>
                                    <input type="text" value="<?php echo $this->proc['procedimiento_id'] ?>" class="form-control" id="procedimiento_id" name="procedimiento_id" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" value="<?php echo $this->proc['nombre'] ?>" class="form-control" id="nombre" name="nombre" onblur="check_DEFINITION_NAME();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" onblur="check_DESCRIPTION();"><?php echo $this->proc['descripcion'] ?></textarea>
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
                                        insertacampo(document.formularioedit,'procedimiento_id','<?php echo $this->proc['procedimiento_id'] ?>');
                                        insertacampo(document.formularioedit,'controller','DefProc');
                                        insertacampo(document.formularioedit,'action','edit');
                                        enviaformcorrecto(document.formularioedit,check_DEFINITION());">
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