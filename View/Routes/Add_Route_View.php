<?php

class Add_Route {
    var $floors;
    var $route;
    var $building;

    function __construct($floors, $route, $building) {
        $this->floors = $floors;
        $this->route = $route;
        $this->building = $building;
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
                        <h1><?php echo $this->route['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-add-implements">Añadir Cumplimentaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">Plan ID</label>
                                    <input type="text" value="<?php echo $this->route['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ruta_id" class="i18n-ruta_id">ID Ruta</label>
                                    <input type="text" value="<?php echo $this->route['ruta_id'] ?>" class="form-control" id="ruta_id" name="ruta_id" readonly/>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <input type="text" value="<?php echo $this->building['nombre'] ?>" class="form-control" id="nombre_edificio" name="nombre_edificio" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre_planta" class="i18n-nombre_planta">Nombre Planta</label>
                                    <select class="form-select" id="nombre_planta" name="planta_id">
                                        <?php foreach($this->floors as $floor): ?>
                                            <option value="<?php echo $floor['planta_id'] ?>">
                                                <?php echo $floor['nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'ruta_id', '<?php echo $this->route['ruta_id'] ?>');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Route');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'controller','Route');
                                        insertacampo(document.formularioadd,'action','add');
                                        enviaformcorrecto(document.formularioadd,check_PLANTA());">
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