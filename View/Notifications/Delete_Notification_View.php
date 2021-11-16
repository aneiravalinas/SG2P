<?php

include_once './View/Page/header.php';

class Delete_Notification extends Header {
    var $notification;

    function __construct($notification) {
        parent::__construct();
        $this->notification = $notification;
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
                        <h3 class="mb-4 i18n-del-notification-confirm">¿Está seguro que desea eliminar la notificación? El cambio no será reversible</h3>
                        <h2><?php echo $this->notification['id_notificacion'] ?> - <?php echo $this->notification['nombre_edificio'] ?> - <?php echo $this->notification['nombre_plan'] ?></h2>
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
                        <a id="btn-cancel" type="button" class="btn-get-started i18n-delete" onclick="
                            crearform('formenviar','post');
                            insertacampo(document.formenviar,'id_notificacion', '<?php echo $this->notification['id_notificacion'] ?>');
                            insertacampo(document.formenviar,'controller','Notification');
                            insertacampo(document.formenviar,'action','delete');
                            enviaform(document.formenviar);">
                            Eliminar
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