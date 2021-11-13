<?php

include './View/Page/header.php';

class Search_DefFormat extends Header {
    var $plan;

    function __construct($plan) {
        parent::__construct();
        $this->plan = $plan;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->plan['nombre'] ?></h1>
                        <h2 class="mb-4 i18n-search-defFormat">Buscar Def. de Formaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->plan['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="formacion_id" class="i18n-formacion_id">ID Ruta</label>
                                    <input type="text" class="form-control" id="formacion_id" name="formacion_id" onblur="check_DEFFORMAT_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_DEFINITION_NAME_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar', 'post');
                                        <?php foreach($this->currentShow as $key => $value): ?>
                                        insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                        <?php endforeach;?>
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','DefFormat');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_DEFFORMAT_SEARCH());">
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