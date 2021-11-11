<?php

include './View/Page/header.php';

class ShowCurrent_DefRoute extends Header {
    var $route;

    function __construct($route) {
        parent::__construct();
        $this->route = $route;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-current-defRoute">Detalles de la def. de la Ruta</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                <input type="text" value="<?php echo $this->route['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ruta_id" class="i18n-ruta_id">ID Ruta</label>
                                <input type="text" value="<?php echo $this->route['ruta_id'] ?>" class="form-control" id="ruta_id" name="ruta_id" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="nombre" class="i18n-nombre">Nombre</label>
                                <input type="text" value="<?php echo $this->route['nombre'] ?>" class="form-control" id="nombre" name="nombre" disabled/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" disabled><?php echo $this->route['descripcion'] ?></textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="go_previous()">
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