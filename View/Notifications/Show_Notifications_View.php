<?php

include_once './View/Page/header.php';

class Show_Notifications extends Header {
    var $notifications;
    var $user;

    function __construct($notifications, $user) {
        parent::__construct();
        $this->notifications = $notifications;
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
                        <h2 class="i18n-show_notifications">Listado de Notificaciones</h2>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 flex-wrap d-flex justify-content-end" id="search_add">
                        <div>
                            <a type="button" onclick="
                                crearform('formenviar','post');
                                insertacampo(document.formenviar,'username','<?php echo $this->user['username']; ?>');
                                insertacampo(document.formenviar,'controller','Notification');
                                insertacampo(document.formenviar,'action','searchForm');
                                enviaform(document.formenviar);">
                                <span class="iconify option_button" data-icon="fluent:search-square-24-filled" data-inline="false"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-10 table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center i18n-nombre_edificio">Nombre Edificio</th>
                                <th scope="col" class="text-center i18n-nombre_plan">Nombre Plan</th>
                                <th scope="col" class="text-center i18n-read">Leído</th>
                                <th scope="col" class="text-center i18n-date">Fecha</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($this->notifications as $notification): ?>
                                <tr class="notif_<?php echo $notification['leido'] ?>">
                                    <td class="text-center"><?php echo $notification['nombre_edificio'] ?></td>
                                    <td class="text-center"><?php echo $notification['nombre_plan'] ?></td>
                                    <td class="text-center i18n-<?php echo $notification['leido'] ?>"></td>
                                    <td class="text-center"><?php echo date_format(date_create($notification['fecha']),'d/m/Y');?></td>
                                    <td class="text-center">
                                        <div class="btn-group px-md-2">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                                <span class="iconify" data-icon="icon-park-outline:config" data-inline="false"></span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item i18n-details" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'id_notificacion','<?php echo $notification['id_notificacion'] ?>');
                                                    insertacampo(document.formenviar,'controller','Notification');
                                                    insertacampo(document.formenviar,'action','showCurrent');
                                                    enviaform(document.formenviar);">
                                                    Detalles
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item i18n-delete" type="button" onclick="
                                                    crearform('formenviar','post');
                                                    insertacampo(document.formenviar,'id_notificacion','<?php echo $notification['id_notificacion'] ?>');
                                                    insertacampo(document.formenviar, 'controller','Notification');
                                                    insertacampo(document.formenviar, 'action','deleteForm');
                                                    enviaform(document.formenviar);">
                                                    Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if(empty($this->notifications)) :?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="i18n-notifications-empty">No se han encontrado notificaciones</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row justify-content-center">
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

            </div>
        </section>

<?php
        include './View/Page/footer.php';
    }
}
?>