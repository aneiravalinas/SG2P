<?php

class Add_ImpFormat {
    var $buildings;
    var $formation;

    function __construct($buildings, $formation) {
        $this->buildings = $buildings;
        $this->formation = $formation;
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
                        <h1><?php echo $this->formation['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-add-implements">Añadir Cumplimentaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">Plan ID</label>
                                    <input type="text" value="<?php echo $this->formation['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="procedimiento_id" class="i18n-formacion_id">ID Formacion</label>
                                    <input type="text" value="<?php echo $this->formation['formacion_id'] ?>" class="form-control" id="formacion_id" name="formacion_id" disabled/>
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
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'formacion_id', '<?php echo $this->formation['formacion_id'] ?>');
                                        insertacampo(document.formenviar,'controller','ImpFormat');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'formacion_id', '<?php echo $this->formation['formacion_id'] ?>');
                                        insertacampo(document.formularioadd,'controller','ImpFormat');
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