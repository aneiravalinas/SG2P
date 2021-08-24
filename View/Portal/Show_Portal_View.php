<?php

class Show_Portal {
    var $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1><?php echo $this->building['nombre'] ?></h1>
                        <h2 class="i18n-select-option">Selecciona una opción</h2>
                    </div>
                </div>

                <div class="row icon-boxes justify-content-center text-center">
                    <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                        insertacampo(document.formenviar,'username','<?php echo $this->building['username'] ?>');
                                        insertacampo(document.formenviar,'action','seekPortalManager');
                                        insertacampo(document.formenviar,'controller','Portal');
                                        enviaform(document.formenviar);">
                                <div>
                                    <div class="icon"><i class="iconify icon-portal" data-icon="bx:bxs-user-circle" data-inline="false"></i></div>
                                    <h4 class="title i18n-responsable">Responsable</h4>
                                    <span class="i18n-resp-info">Consulta la información relativa al responsable del edificio</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'action','showPortalFloors');
                                    insertacampo(document.formenviar,'controller','Portal');
                                    enviaform(document.formenviar);">
                                <div>
                                    <div class="icon"><i class="iconify icon-portal" data-icon="vs:floors" data-inline="false"></i></div>
                                    <h4 class="title i18n-floors">Plantas</h4>
                                    <span class="i18n-floors-info">Consulta la información de las plantas y de los espacios del edificio</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch panel-option" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'action','showPortalPlans');
                                    insertacampo(document.formenviar,'controller','Portal');
                                    enviaform(document.formenviar);">
                                <div>
                                    <div class="icon"><i class="iconify icon-portal" data-icon="fluent:document-16-filled" data-inline="false"></i></div>
                                    <h4 class="title i18n-prevent_plans">Planes de Prevención</h4>
                                    <span class="i18n-prevent_plans-info">Consulta la información de los Planes de Prevención del Edificio</span>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </section>

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title pb-0">
                    <h2 class="i18n-contact">Contacto</h2>
                </div>

                <div class="row mt-5 justify-content-center">
                    <div class="col-lg-3 mx-lg-5">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4 class="i18n-address">Dirección</h4>
                                <p><?php echo $this->building['calle'] . ', ' . $this->building['codigo_postal'] . ' ' . $this->building['ciudad'] . ' ' . $this->building['provincia'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 pt-sm-3 pt-lg-0">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-phone"></i>
                                <h4 class="i18n-telefono">Teléfono</h4>
                                <p><?php echo $this->building['telefono'] ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Contact Section -->


<?php
        include './View/Page/footer.php';
    }
}
?>