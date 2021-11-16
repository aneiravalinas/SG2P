<?php

include_once './View/Page/header.php';

class Search_Notification extends Header {
    var $plans;
    var $buildings;
    var $user;

    function __construct($plans, $buildings, $user) {
        parent::__construct();
        $this->plans = $plans;
        $this->buildings = $buildings;
        $this->user = $user;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="i18n-notifications">Notificaciones</h1>
                        <h2 class="mb-4 i18n-search-notifications">Buscar Notificaciones</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre Edificio</label>
                                    <select id="nombre_edificio" name="edificio_id" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <?php foreach($this->buildings as $building): ?>
                                        <option value="<?php echo $building['edificio_id'] ?>"><?php echo $building['nombre_edificio'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="nombre_plan" class="i18n-nombre_plan">Nombre Plan</label>
                                    <select id="nombre_plan" name="plan_id" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <?php foreach($this->plans as $plan): ?>
                                            <option value="<?php echo $plan['plan_id'] ?>"><?php echo $plan['nombre_plan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="fecha_inicio" class="i18n-fecha_inicio">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"/>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="fecha_fin" class="i18n-fecha_fin">Fecha Fin</label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"/>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="leido" class="i18n-read">Leído</label>
                                    <select id="leido" name="leido" class="form-select">
                                        <option value="" class="i18n-todos">Todos</option>
                                        <option value="yes" class="i18n-yes">Sí</option>
                                        <option value="no" class="i18n-no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar', 'post');
                                        <?php foreach($this->currentShow as $key => $value): ?>
                                        insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                        <?php endforeach; ?>
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formulariosearch,'username', '<?php echo $this->user['username'] ?>');
                                        insertacampo(document.formulariosearch,'controller','Notification');
                                        insertacampo(document.formulariosearch,'action','show');
                                        enviaform(document.formulariosearch);">
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