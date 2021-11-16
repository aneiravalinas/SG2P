<?php

abstract class Header {
    var $previousShow;
    var $currentShow;
    var $unreadNotifications;

    function __construct() {
        $this->getStackData();
        $this->check_unread_notifications();
        self::render();
    }

    function render() {
        include 'top_page.php';
        ?>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top">
            <div class="container d-flex align-items-center justify-content-between">

                <h1 class="logo"><a href="index.php">SG2P</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" type="button" id="languageDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="i18n-idioma">Idioma</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="languageDropDown">
                                <a class="dropdown-item" href="#" onclick="setLang('ES')">Español</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="setLang('GA')">Galego</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="setLang('EN')">English</a>
                            </div>
                        </li>
                        <?php
                        if(!isAuthenticated()) {
                            ?>
                            <li>
                                <a type="button" class="getstarted i18n-login" onclick=
                                "crearform('formenviar','post');
                                        insertacampo(document.formenviar,'controller','Login');
                                        insertacampo(document.formenviar,'action','loginForm');
                                        enviaform(document.formenviar);">
                                    Iniciar Sesión
                                </a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li>
                                <a type="button" class="nav-link i18n-admin" onclick="
                                    crearform('formenviar','post');
                                        insertacampo(document.formenviar,'action','deshboard');
                                        insertacampo(document.formenviar,'controller','Panel');
                                        enviaform(document.formenviar);">
                                    Panel de Administración
                                </a>
                            </li>
                            <li>
                                <a type="button" class="nav-link" onclick="
                                        crearform('formenviar', 'post');
                                        insertacampo(document.formenviar, 'controller', 'Notification');
                                        insertacampo(document.formenviar, 'action', 'show');
                                        insertacampo(document.formenviar, 'username', '<?php echo $_SESSION['username']; ?>');
                                        enviaform(document.formenviar)">
                                    <?php if($this->unreadNotifications): ?>
                                    <span class="iconify notif_icon_active" id="notif_icon" data-icon="clarity:notification-solid-badged"></span>
                                    <?php else: ?>
                                    <span class="iconify" id="notif_icon" data-icon="clarity:notification-solid"></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li>
                                <a type="button" class="getstarted i18n-logout" onclick="
                                    crearform('formenviar','post');
                                        insertacampo(document.formenviar,'action','logout');
                                        insertacampo(document.formenviar,'controller','Login');
                                        enviaform(document.formenviar);">
                                    Desconectar
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->
<?php
    }

    function getStackData() {
        include_once './Common/Stack.php';
        $this->previousShow = getPreviousShow();
        $this->currentShow = getCurrentShow();
    }

    function check_unread_notifications() {
            include_once './Service/Notification_Service.php';
            $notification_service = new Notification_Service();
            $this->unreadNotifications = $notification_service->check_unread_notifications()['ok'];
    }

}
?>
