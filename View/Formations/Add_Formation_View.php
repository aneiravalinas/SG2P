<?php

class Add_Formation {
    var $formation;
    var $building;

    function __construct($formation, $building) {
        $this->formation = $formation;
        $this->building = $building;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-msg-system">Mensaje del Sistema</h1>
                        <h2 class="mb-4 i18n-add-implement-confirm">¿Está seguro que desea añadir la siguiente cumplimentación?</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" class="form-control" value="<?php echo $this->formation['plan_id'] ?>" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="procedimiento_id" class="i18n-formacion_id">ID Formación</label>
                                    <input type="text" class="form-control" value="<?php echo $this->formation['formacion_id'] ?>" id="formacion_id" name="formacion_id" readonly/>
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
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'formacion_id', '<?php echo $this->formation['formacion_id'] ?>');
                                    insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'controller','Formation');
                                    insertacampo(document.formenviar,'action','show');
                                    enviaform(document.formenviar);">
                                    Cancelar
                                </a>
                                <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'controller','Formation');
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