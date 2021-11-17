<?php

include_once './View/Page/header.php';

class Portal_Cities extends Header {
    var $cities;

    function __construct($cities) {
        parent::__construct();
        $this->cities = $cities;
        $this->render();
    }

    function render() {
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 id="i18n-app-welcome">¡Bienvenido a SG2P!</h1>
                        <h2 id="i18n-select-city">Selecciona una ciudad para consultar Edificios</h2>
                        <div class="row justify-content-center pt-3">
                            <div class="col-md-9 text-center">
                                <!-- === Select City to list Builds ==== -->
                                <form name="formcities" method="post">
                                    <select id="ciudad" name="ciudad" class="form-select" aria-label="Select a building">
                                        <?php foreach($this->cities as $city) :?>
                                        <option value="<?php echo $city['ciudad'] ?>"><?php echo $city['ciudad'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="text-center">
                            <a class="btn-get-started" type="button" id="i18n-l-buildings" onclick="
                                insertacampo(document.formcities,'controller','Portal');
                                insertacampo(document.formcities,'action','searchBuildingsByCity');
                                enviaform(document.formcities);">
                                Buscar Edificios
                            </a>
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
