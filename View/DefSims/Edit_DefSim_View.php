<?php

include './View/Page/header.php';

class Edit_DefSim extends Header {
    var $sim;

    function __construct($sim) {
        parent::__construct();
        $this->sim = $sim;
        $this->render();
    }

    function render() {
        ?>


        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-edit-defSim">Editar def. de la Formación</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioedit" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->sim['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="simulacro_id" class="i18n-simulacro_id">ID Ruta</label>
                                    <input type="text" value="<?php echo $this->sim['simulacro_id'] ?>" class="form-control" id="simulacro_id" name="simulacro_id" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" value="<?php echo $this->sim['nombre'] ?>" class="form-control" id="nombre" name="nombre" onblur="check_DEFINITION_NAME();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" onblur="check_DESCRIPTION();"><?php echo $this->sim['descripcion'] ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="go_current()">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioedit,'simulacro_id','<?php echo $this->sim['simulacro_id'] ?>');
                                        insertacampo(document.formularioedit,'controller','DefSim');
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