<?php

class Login_View {

    function __construct() {
        $this->render();
    }

    function render() {
        include './View/header.php';
        ?>
        <!-- ==== Login Box ===== -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center" id="ext-row-loginbox">
                    <div class="col-lg-5" id="ext-login-box">
                        <div class="row justify-content-center">
                            <div class="col-10" id="int-login-box">
                                <h3 class="text-center">Login</h3>
                                <form>
                                    <div class="form-group login-forms">
                                        <label for="usernameformcontrol">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"/>
                                    </div>
                                    <div class="form-group login-forms">
                                        <label for="pass_usuario">Password</label>
                                        <input type="password" class="form-control" id="pass_usuario" name="pass_usuario"/>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <a class="btn-get-started">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
        include './View/footer.php';
    }

}

?>