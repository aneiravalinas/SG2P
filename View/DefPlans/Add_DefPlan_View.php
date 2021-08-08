<?php

class Add_DefPlan {

    function __construct() {
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
                        <h1 class="mb-4 i18n-add-defPlan">Definir Plan</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_DEFPLAN();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="descripcion" class="i18n-descripcion">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="5" onblur="check_DESCRIPCION_DEFPLAN()"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                            insertacampo(document.formenviar,'controller','DefPlan');
                                            insertacampo(document.formenviar,'action','show');
                                            enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                            insertacampo(document.formularioadd,'controller','DefPlan');
                                            insertacampo(document.formularioadd,'action','add');
                                            enviaformcorrecto(document.formularioadd,check_DEFPLAN());">
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