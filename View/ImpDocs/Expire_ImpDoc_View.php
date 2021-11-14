<?php

include './View/Page/header.php';

class Expire_ImpDoc extends Header {
    var $imp_doc;

    function __construct($imp_doc) {
        parent::__construct();
        $this->imp_doc = $imp_doc;
        $this->render();
    }

    function render() {
        ?>


        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-msg-system">Mensaje del Sistema</h1>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h3 class="mb-4 i18n-expire-impdoc-confirm">¿Está seguro que desea vencer la cumplimentación de este documento? El cambio no será reversible</h3>
                        <h2><?php echo $this->imp_doc['cumplimentacion_id'] ?> - <?php echo $this->imp_doc['nombre_documento'] ?> - <?php echo $this->imp_doc['nombre_edificio'] ?></h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 d-flex justify-content-between flex-wrap">
                        <a class="btn-get-started i18n-cancelar" type="button" onclick="
                                crearform('formenviar', 'post');
                                <?php foreach($this->currentShow as $key => $value): ?>
                                insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                <?php endforeach; ?>
                                enviaform(document.formenviar);">
                            Cancelar
                        </a>
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-expire" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar, 'cumplimentacion_id', '<?php echo $this->imp_doc['cumplimentacion_id'] ?>');
                            insertacampo(document.formenviar, 'controller', 'ImpDoc');
                            insertacampo(document.formenviar, 'action', 'expire');
                            enviaform(document.formenviar);">
                            Vencer
                        </a>
                    </div>
                </div>
            </div>
        </section>


<?php
        include './View/Page/footer.php';
    }
}
?>