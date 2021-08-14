<?php

class Edit_DefRoute {
    var $route;

    function __construct($route) {
        $this->route = $route;
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
                        <h1 class="mb-4 i18n-edit-defRoute">Editar def. de la Ruta</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioedit" method="post">
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
                                    <input type="text" value="<?php echo $this->route['nombre'] ?>" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_DEFROUTE();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" onblur="check_DESCRIPCION_DEFROUTE()"><?php echo $this->route['descripcion'] ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'plan_id','<?php echo $this->route['plan_id'] ?>');
                                        insertacampo(document.formenviar,'controller','DefRoute');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioedit,'ruta_id','<?php echo $this->route['ruta_id'] ?>');
                                        insertacampo(document.formularioedit,'controller','DefRoute');
                                        insertacampo(document.formularioedit,'action','edit');
                                        enviaformcorrecto(document.formularioedit,check_DEFROUTE());">
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