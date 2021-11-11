<?php

include './View/Page/header.php';

class Add_BuildPlan extends Header {
    var $buildings;
    var $plan;

    function __construct($buildings, $plan) {
        parent::__construct();
        $this->buildings = $buildings;
        $this->plan = $plan;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->plan['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-add-buildPlan">Asociar Edificios</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->plan['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" value="<?php echo $this->plan['nombre'] ?>" class="form-control" id="nombre" name="nombre" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="buildings" class="i18n-buildings">Edificios</label>
                                    <select class="form-control selectpicker" size="4" id="buildings" name="buildings[]"
                                            multiple
                                            data-live-search="true"
                                            data-live-search-placeholder="Search...">
                                        <?php foreach($this->buildings as $building) :?>
                                        <option data-subtext="<?php echo $building['ciudad']?>" value="<?php echo $building['edificio_id'] ?>">
                                            <?php echo $building['edificio_id'] ?> - <?php echo $building['nombre'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="go_current()">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formularioadd,'controller','BuildPlan');
                                        insertacampo(document.formularioadd,'action','add');
                                        enviaformcorrecto(document.formularioadd,check_BUILDINGS())">
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