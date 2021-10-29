<?php

class Implement_Formation {
    var $imp_format;

    function __construct($imp_format) {
        $this->imp_format = $imp_format;
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
                        <h1><?php echo $this->imp_format['nombre_formacion'] ?></h1>
                        <h2 class="mb-4 i18n-cump-form">Cumplimentar Formación</h2>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cumplimentacion_id" class="i18n-cump_id">ID Cumplimentación</label>
                                    <input type="text" value="<?php echo $this->imp_format['cumplimentacion_id'] ?>" class="form-control" id="cumplimentacion_id" name="cumplimentacion_id" readonly/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="formacion_id" class="i18n-formacion_id">ID Formacion</label>
                                    <input type="text" value="<?php echo $this->imp_format['formacion_id'] ?>" class="form-control" id="formacion_id" name="formacion_id" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" value="<?php echo $this->imp_format['edificio_id'] ?>" class="form-control" id="edificio_id" name="edificio_id" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="nombre_edificio" class="i18n-nombre_edificio">Nombre del Edificio</label>
                                    <input type="text" class="form-control" value="<?php echo $this->imp_format['nombre_edificio'] ?>" id="nombre_edificio" name="nombre_edificio" disabled/>
                                </div>
                            </div>

                            <?php if($this->imp_format['fecha_planificacion'] != default_data): ?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="current_date" class="i18n-current_planning_date">Fecha de Planificación Actual</label>
                                        <input type="text" class="form-control" value="<?php echo date_format(date_create($this->imp_format['fecha_planificacion']),'d/m/Y'); ?>" id="current_date" name="current_date" disabled/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fecha_planificacion" class="i18n-planning_date"> Fecha de Planificación</label>
                                        <input type="date" class="form-control" id="fecha_planificacion" name="fecha_planificacion" min="<?php echo date("Y-m-d")?>" onblur="check_FECHA_PLANIFICACION();"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="url_recurso" class="i18n-url_recurso">URL Recuerso</label>
                                        <input type="text" class="form-control" id="url_recurso" name="url_recurso" onblur="check_RECURSO();"/>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="fecha_planificacion" class="i18n-planning_date"> Fecha de Planificación</label>
                                        <input type="date" class="form-control" id="fecha_planificacion" name="fecha_planificacion" min="<?php echo date("Y-m-d")?>" onblur="check_FECHA_PLANIFICACION();"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="url_recurso" class="i18n-url_recurso">URL Recuerso</label>
                                        <input type="text" class="form-control" id="url_recurso" name="url_recurso" onblur="check_RECURSO();"/>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="destinatarios" class="i18n-destinatarios">Destinatarios</label>
                                    <textarea class="form-control" id="destinatarios" name="destinatarios" rows="3" onblur="check_DESTINATARIOS();"></textarea>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'formacion_id', '<?php echo $this->imp_format['formacion_id'] ?>');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->imp_format['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Formation');
                                        insertacampo(document.formenviar,'action','show');
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                        insertacampo(document.formularioadd,'controller','Formation');
                                        insertacampo(document.formularioadd,'action','implement');
                                        enviaformcorrecto(document.formularioadd,check_SIM_FORMAT_IMPLEMENT());">
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