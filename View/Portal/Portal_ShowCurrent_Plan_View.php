<?php

class Portal_ShowCurrent_Plan {
    var $build_plan;
    var $building;
    var $plan;
    var $definitions;

    function __construct($build_plan, $building, $plan, $definitions) {
        $this->build_plan = $build_plan;
        $this->building = $building;
        $this->plan = $plan;
        $this->definitions = $definitions;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <!-- ======= FORM SECTION ====== --->


        <section id="hero" class="d-flex align-items-center hero-section">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mt-3">
                        <h1 class="mt-5"><?php echo $this->plan['nombre'] ?></h1>
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
                        <h2 class="i18n-info_plan">Información del Plan</h2>
                    </div>

                    <div class="row content justify-content-center">
                        <div class="col-xl-8 col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-plan_id">ID Plan</span>
                                            <span class="d-block att-value"><?php echo $this->build_plan['plan_id'] ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-state">Estado</span>
                                            <span class="d-block att-value i18n-<?php echo $this->build_plan['estado'] ?> <?php echo $this->build_plan['estado'] ?>">PENDIENTE</span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_assign">Fecha Asignación</span>
                                            <span class="d-block att-value"><?php echo date_format(date_create($this->build_plan['fecha_asignacion']), 'd/m/Y') ?></span>
                                        </li>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-date_comp">Fecha Implementación</span>
                                            <?php if($this->build_plan['fecha_cumplimentacion'] != default_data): ?>
                                                <span class="d-block att-value"><?php echo date_format(date_create($this->build_plan['fecha_cumplimentacion']), 'd/m/Y') ?></span>
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-8 pt-4 pt-lg-0">
                                    <ul>
                                        <li>
                                            <i class="bx bx-chevron-right att-icon"></i><span class="att-field i18n-descripcion">Descripción</span>
                                            <p><?php echo $this->plan['descripcion'] ?></p>
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
                        <h3 class="i18n-elements_plan">Elementos del Plan</h3>
                    </div>

                    <div class="faq-list">
                        <div class="row justify-content-center">
                            <div class="col-xl-9 col-lg-10">
                                <ul>
                                    <!-- DOCUMENTOS -->
                                    <?php if(!empty($this->definitions['documentos']['elementos'])): ?>
                                        <li data-aos="fade-up">
                                            <?php if($this->definitions['documentos']['estado'] == 'pendiente') :?>
                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1"><span class="pendiente i18n-documentos"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php elseif($this->definitions['documentos']['estado'] == 'cumplimentado'): ?>
                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1"><span class="cumplimentado i18n-documentos"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php else: ?>
                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1"><span class="vencido i18n-documentos"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php endif; ?>
                                            <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
                                                <ul class="mt-3">
                                                    <?php foreach($this->definitions['documentos']['elementos'] as $documento) :?>
                                                        <li class="border-top">
                                                            <?php if($documento['estado'] == 'pendiente'): ?>
                                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'documento_id', '<?php echo $documento['documento_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Portal');
                                                                    insertacampo(document.formenviar, 'action', 'seekPortalDocument');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="pendiente"><?php echo $documento['nombre'] ?></span>
                                                                </a>
                                                            <?php elseif($documento['estado'] == 'cumplimentado'): ?>
                                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'documento_id', '<?php echo $documento['documento_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Portal');
                                                                    insertacampo(document.formenviar, 'action', 'seekPortalDocument');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="cumplimentado"><?php echo $documento['nombre'] ?></span>
                                                                </a>
                                                            <?php else: ?>
                                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'documento_id', '<?php echo $documento['documento_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Portal');
                                                                    insertacampo(document.formenviar, 'action', 'seekPortalDocument');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="vencido"><?php echo $documento['nombre'] ?></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </li> <!-- FIN DOCUMENTOS -->
                                    <?php endif; ?>

                                    <!-- PROCEDIMIENTOS -->
                                    <?php if(!empty($this->definitions['procedimientos']['elementos'])): ?>
                                        <li data-aos="fade-up">
                                            <?php if($this->definitions['procedimientos']['estado'] == 'pendiente') :?>
                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-2"><span class="pendiente i18n-procedimientos"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php elseif($this->definitions['procedimientos']['estado'] == 'cumplimentado'): ?>
                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-2"><span class="cumplimentado i18n-procedimientos"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php else: ?>
                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-2"><span class="vencido i18n-procedimientos"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php endif; ?>
                                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                                <ul class="mt-3">
                                                    <?php foreach($this->definitions['procedimientos']['elementos'] as $procedimiento) :?>
                                                        <li class="border-top">
                                                            <?php if($procedimiento['estado'] == 'pendiente'): ?>
                                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'procedimiento_id', '<?php echo $procedimiento['procedimiento_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Procedure');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="pendiente"><?php echo $procedimiento['nombre'] ?></span>
                                                                </a>
                                                            <?php elseif($procedimiento['estado'] == 'cumplimentado'): ?>
                                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'procedimiento_id', '<?php echo $procedimiento['procedimiento_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Procedure');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="cumplimentado"><?php echo $procedimiento['nombre'] ?></span>
                                                                </a>
                                                            <?php else: ?>
                                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'procedimiento_id', '<?php echo $procedimiento['procedimiento_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Procedure');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="vencido"><?php echo $procedimiento['nombre'] ?></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </li> <!-- FIN PROCEDIMIENTOS -->
                                    <?php endif; ?>

                                    <!-- RUTAS -->
                                    <?php if(!empty($this->definitions['rutas']['elementos'])): ?>
                                        <li data-aos="fade-up">
                                            <?php if($this->definitions['rutas']['estado'] == 'pendiente') :?>
                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-3"><span class="pendiente i18n-rutas"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php elseif($this->definitions['rutas']['estado'] == 'cumplimentado'): ?>
                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-3"><span class="cumplimentado i18n-rutas"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php else: ?>
                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-3"><span class="vencido i18n-rutas"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php endif; ?>
                                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                                <ul class="mt-3">
                                                    <?php foreach($this->definitions['rutas']['elementos'] as $ruta) :?>
                                                        <li class="border-top">
                                                            <?php if($ruta['estado'] == 'pendiente'): ?>
                                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'ruta_id', '<?php echo $ruta['ruta_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Route');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="pendiente"><?php echo $ruta['nombre'] ?></span>
                                                                </a>
                                                            <?php elseif($ruta['estado'] == 'cumplimentado'): ?>
                                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'ruta_id', '<?php echo $ruta['ruta_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Route');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="cumplimentado"><?php echo $ruta['nombre'] ?></span>
                                                                </a>
                                                            <?php else: ?>
                                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'ruta_id', '<?php echo $ruta['ruta_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Route');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="vencido"><?php echo $ruta['nombre'] ?></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </li> <!-- FIN RUTAS -->
                                    <?php endif; ?>

                                    <!-- FORMACIONES -->
                                    <?php if(!empty($this->definitions['formaciones']['elementos'])): ?>
                                        <li data-aos="fade-up">
                                            <?php if($this->definitions['formaciones']['estado'] == 'pendiente') :?>
                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-4"><span class="pendiente i18n-formaciones"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php elseif($this->definitions['formaciones']['estado'] == 'cumplimentado'): ?>
                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-4"><span class="cumplimentado i18n-formaciones"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php else: ?>
                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-4"><span class="vencido i18n-formaciones"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php endif; ?>
                                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                                <ul class="mt-3">
                                                    <?php foreach($this->definitions['formaciones']['elementos'] as $formacion) :?>
                                                        <li class="border-top">
                                                            <?php if($formacion['estado'] == 'pendiente'): ?>
                                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'formacion_id', '<?php echo $formacion['formacion_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Formation');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="pendiente"><?php echo $formacion['nombre'] ?></span>
                                                                </a>
                                                            <?php elseif($formacion['estado'] == 'cumplimentado'): ?>
                                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'formacion_id', '<?php echo $formacion['formacion_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Formation');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="cumplimentado"><?php echo $formacion['nombre'] ?></span>
                                                                </a>
                                                            <?php else: ?>
                                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'formacion_id', '<?php echo $formacion['formacion_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Formation');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="vencido"><?php echo $formacion['nombre'] ?></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </li> <!-- FIN FORMACIONES -->
                                    <?php endif; ?>

                                    <!-- SIMULACROS -->
                                    <?php if(!empty($this->definitions['simulacros']['elementos'])): ?>
                                        <li data-aos="fade-up">
                                            <?php if($this->definitions['simulacros']['estado'] == 'pendiente') :?>
                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-5"><span class="pendiente i18n-simulacros"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php elseif($this->definitions['simulacros']['estado'] == 'cumplimentado'): ?>
                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-5"><span class="cumplimentado i18n-simulacros"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php else: ?>
                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-5"><span class="vencido i18n-simulacros"></span><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                            <?php endif; ?>
                                            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                                                <ul class="mt-3">
                                                    <?php foreach($this->definitions['simulacros']['elementos'] as $simulacro) :?>
                                                        <li class="border-top">
                                                            <?php if($simulacro['estado'] == 'pendiente'): ?>
                                                                <i class="iconify icon-help pendiente" data-icon="ant-design:exclamation-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'simulacro_id', '<?php echo $simulacro['simulacro_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Simulacrum');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="pendiente"><?php echo $simulacro['nombre'] ?></span>
                                                                </a>
                                                            <?php elseif($simulacro['estado'] == 'cumplimentado'): ?>
                                                                <i class="iconify icon-help cumplimentado" data-icon="akar-icons:circle-check"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'simulacro_id', '<?php echo $simulacro['simulacro_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Simulacrum');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="cumplimentado"><?php echo $simulacro['nombre'] ?></span>
                                                                </a>
                                                            <?php else: ?>
                                                                <i class="iconify icon-help vencido" data-icon="ant-design:clock-circle-outlined"></i>
                                                                <a onclick="
                                                                    crearform('formenviar', 'post');
                                                                    insertacampo(document.formenviar, 'simulacro_id', '<?php echo $simulacro['simulacro_id'] ?>');
                                                                    insertacampo(document.formenviar, 'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                                                    insertacampo(document.formenviar, 'controller', 'Simulacrum');
                                                                    insertacampo(document.formenviar, 'action', 'show');
                                                                    enviaform(document.formenviar);">
                                                                    <span class="vencido"><?php echo $simulacro['nombre'] ?></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </li> <!-- FIN SIMULACROS -->
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col text-center">
                                <a class="btn-get-started i18n-back" type="button" onclick="
                                        crearform('formenviar','post');
                                        insertacampo(document.formenviar,'edificio_id', '<?php echo $this->building['edificio_id'] ?>');
                                        insertacampo(document.formenviar,'controller','Portal');
                                        insertacampo(document.formenviar,'action','showPortalPlans');
                                        enviaform(document.formenviar);">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
            </section><!-- End Frequently Asked Questions Section -->
        </main>


        <?php
        include './View/Page/footer.php';
    }
}
?>
}