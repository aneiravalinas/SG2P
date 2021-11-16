<?php

include_once './View/Page/header.php';

class Add_ImpSim extends Header {
    var $buildings;
    var $simulacrum;

    function __construct($buildings, $simulacrum) {
        parent::__construct();
        $this->buildings = $buildings;
        $this->simulacrum = $simulacrum;
        $this->render();
    }

    function render() {;
        ?>


        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->simulacrum['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-add-implements">Añadir Cumplimentaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">Plan ID</label>
                                    <input type="text" value="<?php echo $this->simulacrum['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="simulacro_id" class="i18n-simulacro_id">ID Simulacro</label>
                                    <input type="text" value="<?php echo $this->simulacrum['simulacro_id'] ?>" class="form-control" id="simulacro_id" name="simulacro_id" disabled/>
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
                                        insertacampo(document.formularioadd,'simulacro_id', '<?php echo $this->simulacrum['simulacro_id'] ?>');
                                        insertacampo(document.formularioadd,'controller','ImpSim');
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