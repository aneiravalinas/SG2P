<?php

include_once './View/Page/header.php';

class Show_Formation extends Header {
    var $imp_formats;
    var $formation;
    var $building;

    function __construct($imp_formats, $formation, $building) {
        parent::__construct();
        $this->imp_formats = $imp_formats;
        $this->formation = $formation;
        $this->building = $building;
        $this->render();
    }

    function render() {
        ?>



        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mt-3">
                        <h1 class="mt-5"><?php echo $this->formation['nombre'] ?></h1>
                        <h2><?php echo $this->building['nombre'] ?></h2>
                    </div>
                </div>
            </div>
        </section>

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2 class="i18n-info_format">Información de la Formación</h2>
                    </div>

                    <div class="row content justify-content-center">
                        <div class="col-xl-8 col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-plan_id">Plan ID</span>
                                            <span class="d-block att-value"><?php echo $this->formation['plan_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-formacion_id">Formacion ID</span>
                                            <span class="d-block att-value"><?php echo $this->formation['formacion_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                            <span class="d-block att-value i18n-<?php echo $this->formation['estado'] ?> <?php echo $this->formation['estado'] ?>">PENDIENTE</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-8 pt-4 pt-lg-0">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-descripcion">Descripción</span>
                                            <p><?php echo $this->formation['descripcion'] ?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End About Section -->

            <!-- ======= Frequently Asked Questions Section ======= -->
            <section id="faq" class="faq section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h3 class="i18n-impformats">Cumplimentaciones de la Formación</h3>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-9 flex-wrap d-flex justify-content-end" id="search_add">
                            <div>
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'formacion_id','<?php echo $this->formation['formacion_id'] ?>');
                                    insertacampo(document.formenviar,'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'controller','Formation');
                                    insertacampo(document.formenviar,'action','searchForm');
                                    enviaform(document.formenviar);">
                                    <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                                </a>
                                <a type="button" onclick="
                                    crearform('formenviar','post');
                                    insertacampo(document.formenviar,'formacion_id','<?php echo $this->formation['formacion_id'] ?>');
                                    insertacampo(document.formenviar,'edificio_id','<?php echo $this->building['edificio_id'] ?>');
                                    insertacampo(document.formenviar,'controller','Formation');
                                    insertacampo(document.formenviar,'action','addForm');
                                    enviaform(document.formenviar);">
                                    <span class="iconify option_button" data-icon="gridicons-add" data-inline="false"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-10 table-responsive" id="col-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="i18n-cump_id text-center">ID Cumplimentacion</th>
                                    <th scope="col" class="i18n-state text-center">Estado</th>
                                    <th scope="col" class="i18n-planning_date text-center">Fecha Planificación</th>
                                    <th scope="col" class="i18n-date_expire text-center">Fecha Vencimiento</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($this->imp_formats as $imp_format): ?>
                                    <tr>
                                        <td class="text-center"><?php echo $imp_format['cumplimentacion_id'] ?></td>
                                        <td class="text-center i18n-<?php echo $imp_format['estado'] ?> <?php echo $imp_format['estado'] ?>"></td>
                                        <td class="text-center"><?php if($imp_format['fecha_planificacion'] != default_data) echo date_format(date_create($imp_format['fecha_planificacion']),'d/m/Y');?></td>
                                        <td class="text-center"><?php if($imp_format['fecha_vencimiento'] != default_data) echo date_format(date_create($imp_format['fecha_vencimiento']),'d/m/Y');?></td>
                                        <td class="text-center">
                                            <div class="btn-group px-md-2">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                    <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item i18n-details" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar,'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                        insertacampo(document.formenviar,'controller','Formation');
                                                        insertacampo(document.formenviar,'action','showCurrent');
                                                        enviaform(document.formenviar);">
                                                        Detalles
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <?php if($imp_format['estado'] != 'vencido') :?>
                                                        <a class="dropdown-item i18n-implement" type="button" onclick="
                                                                crearform('formenviar','post');
                                                                insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                                insertacampo(document.formenviar, 'controller','Formation');
                                                                insertacampo(document.formenviar, 'action', 'implementForm');
                                                                enviaform(document.formenviar);">
                                                            Cumplimentar
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item i18n-expire" type="button" onclick="
                                                            crearform('formenviar','post');
                                                            insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                            insertacampo(document.formenviar, 'controller','Formation');
                                                            insertacampo(document.formenviar, 'action', 'expireForm');
                                                            enviaform(document.formenviar);">
                                                            Vencer
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                    <?php endif; ?>
                                                    <a class="dropdown-item i18n-delete" type="button" onclick="
                                                        crearform('formenviar','post');
                                                        insertacampo(document.formenviar, 'cumplimentacion_id','<?php echo $imp_format['cumplimentacion_id'] ?>');
                                                        insertacampo(document.formenviar, 'controller','Formation');
                                                        insertacampo(document.formenviar, 'action','deleteForm');
                                                        enviaform(document.formenviar);">
                                                        Eliminar
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($this->imp_formats)) :?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <span class="i18n-imp-formats-empty">No se han encontrado cumplimentaciones de la formación</span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-center pb-5">
                        <div class="col text-center">
                            <a class="btn-get-started i18n-back" type="button" onclick="
                                    crearform('formenviar', 'post');
                                    insertacampo(document.formenviar, 'go_back', 'go_back');
                                    <?php foreach($this->previousShow as $key => $value): ?>
                                    insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                    <?php endforeach; ?>
                                    enviaform(document.formenviar);">
                                Volver
                            </a>
                        </div>
                    </div>
            </section><!-- End Frequently Asked Questions Section -->
        </main>



<?php
        include './View/Page/footer.php';
    }
}
?>