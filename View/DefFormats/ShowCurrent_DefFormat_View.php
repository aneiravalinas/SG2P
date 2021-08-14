<?php

class ShowCurrent_DefFormat {
    var $format;

    function __construct($format) {
        $this->format = $format;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-current-defFormat">Detalles de la def. de la Formación</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                <input type="text" value="<?php echo $this->format['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="formacion_id" class="i18n-formacion_id">ID Ruta</label>
                                <input type="text" value="<?php echo $this->format['formacion_id'] ?>" class="form-control" id="formacion_id" name="formacion_id" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="nombre" class="i18n-nombre">Nombre</label>
                                <input type="text" value="<?php echo $this->format['nombre'] ?>" class="form-control" id="nombre" name="nombre" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" disabled><?php echo $this->format['descripcion'] ?></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'plan_id','<?php echo $this->format['plan_id'] ?>');
                                    insertacampo(document.formenviar,'controller','DefFormat');
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