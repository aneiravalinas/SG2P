<?php

class Search_DefDoc {
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
                        <h2 class="mb-4 i18n-search-defDoc">Buscar Def. de Documentos</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="plan_id" class="i18n-plan_id">ID Plan</label>
                                    <input type="text" value="<?php echo $this->plan['plan_id'] ?>" class="form-control" id="plan_id" name="plan_id" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="documento_id" class="i18n-documento_id">ID Documento</label>
                                    <input type="text" class="form-control" id="documento_id" name="documento_id" onblur="check_DEFDOC_ID_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_DEFINITION_NAME_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="visible" class="i18n-visible">Visible</label>
                                    <select id="visible" name="visible" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="yes" class="i18n-yes">Sí</option>
                                        <option value="no" class="i18n-no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formenviar,'controller','DefDoc');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'plan_id', '<?php echo $this->plan['plan_id'] ?>');
                                        insertacampo(document.formulariosearch,'controller','DefDoc');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaformcorrecto(document.formulariosearch,check_DEFDOC_SEARCH());">
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