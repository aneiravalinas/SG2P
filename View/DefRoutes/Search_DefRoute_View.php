<?php

class Search_DefRoute {
    var $plan;

    function __construct($plan) {
        $this->plan = $plan;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->plan['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-search-defRoute">Buscar Def. de Rutas</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->plan['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ruta_id" class="i18n-ruta_id">ID Ruta</label>
                                    <input type="text" class="form-control" id="ruta_id" name="ruta_id" onblur="check_DEFROUTE_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_DEFROUTE_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formenviar,'controller','DefRoute');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','DefRoute');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_DEFROUTE_SEARCH());">
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