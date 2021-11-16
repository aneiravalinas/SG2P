<?php

include_once './View/Page/header.php';

class Login_View extends Header {

    function __construct() {
        parent::__construct();
        $this->render();
    }

    function render() {
        ?>
        <!-- ==== Login Box ===== -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center" id="ext-row-loginbox">
                    <div class="col-lg-5" id="ext-login-box">
                        <div class="row justify-content-center">
                            <div class="col-10" id="int-login-box">
                                <h3 class="text-center i18n-login">Login</h3>
                                <form name="formulariologin" method="post">
                                    <div class="form-group login-forms">
                                        <label for="username" class="i18n-username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" onblur="check_USERNAME();"/>
                                    </div>
                                    <div class="form-group login-forms">
                                        <label for="password" class="i18n-password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" onblur="check_PASSWORD();"/>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <a class="btn-get-started i18n-login w-60 mt-3 d-block" type="button" onclick=
                                        "insertacampo(document.formulariologin,'controller','Login');
                                         insertacampo(document.formulariologin,'action','login');
                                         enviaformcorrecto(document.formulariologin, check_LOGIN());">
                                            Login
                                    </a>
                                    <a class="btn-get-started i18n-back w-60 mt-3 d-block" type="button" onclick="
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
                    </div>
                </div>

            </div>
        </section>

<?php
        include './View/Page/footer.php';
    }

}

?>