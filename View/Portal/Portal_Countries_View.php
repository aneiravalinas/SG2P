<?php

class Portal_Countries {

    function __construct() {
        $this->render();
    }

    function render() {
        include './View/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1>¡Bienvenido a SG2P!</h1>
                        <h2>Selecciona una ciudad para consultar Edificios</h2>
                        <!-- === Select City to list Builds ==== -->
                        <select id="select-city" name="city" class="form-select" aria-label="Select a building">
                            <option value="1">Ourense</option>
                            <option value="2">Vigo</option>
                            <option value="3">Lugo</option>
                            <option value="3">A Coruña</option>
                            <option value="3">Santiago</option>
                        </select>
                        <div class="text-center">
                            <a class="btn-get-started">Buscar Edificios</a>
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
