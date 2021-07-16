<?php

class Login_View {

    function __construct() {
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
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
                                        <input type="text" class="form-control" id="username" name="username" onblur="if(not_empty('username')) check_letters_numbers('username',20);"/>
                                    </div>
                                    <div class="form-group login-forms">
                                        <label for="password" class="i18n-password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" onblur="not_empty('password');"/>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <a class="btn-get-started i18n-login" type="button" onclick=
                                        "insertacampo(document.formulariologin,'controller','Login');
                                         insertacampo(document.formulariologin,'action','login');
                                         enviaformcorrecto(document.formulariologin, check_login());">
                                            Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            var username = document.getElementById("username");
            username.addEventListener("keydown", function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    insertacampo(document.formulariologin,'action','login');
                    insertacampo(document.formulariologin,'controller','Login');
                    enviaformcorrecto(document.formulariologin, check_login());
                }
            });
            var password = document.getElementById("password");
            password.addEventListener("keydown", function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    insertacampo(document.formulariologin,'action','login');
                    insertacampo(document.formulariologin,'controller','Login');
                    enviaformcorrecto(document.formulariologin, check_login());
                }
            });
        </script>

<?php
        include './View/Page/footer.php';
    }

}

?>