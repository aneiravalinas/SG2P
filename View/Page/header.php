<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SG2P</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"/>

    <!-- Vendor CSS Files -->
    <link href="./View/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./View/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./View/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./View/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./View/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./View/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./View/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./View/assets/css/style.css" rel="stylesheet">

    <!-- Custom CSS File -->
    <link href="./View/css/mystyle.css" rel="stylesheet"/>

    <!-- Custom JS Files -->
    <script type="text/javascript" src="./Locale/lang.js"></script>
    <script type="text/javascript" src="./Locale/Lang_ES.js"></script>
    <script type="text/javascript" src="./Locale/Lang_EN.js"></script>
    <script type="text/javascript" src="./Locale/Lang_GA.js"></script>
    <script type="text/javascript" src="./View/js/funcionesFormularios.js"></script>
    <script type="text/javascript" src="./View/js/validaciones.js"></script>
    <script type="text/javascript" src="./View/js/validaciones_Usuario.js"></script>
    <script type="text/javascript" src="./View/js/validaciones_Edificio.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_Planta.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_Espacio.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_DefPlan.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_DefDoc.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_DefProc.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_DefRoute.js"></script>
    <script text="text/javascript" src="./View/js/validaciones_DefFormat.js"></script>
    <script type="text/javascript" src="./View/js/md5.js"></script>

</head>
<body onload="setLang()">

<!-- ==== Need a Model here... === -->

<?php
    include 'modal.php';
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