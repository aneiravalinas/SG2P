<?php

class Portal_Cities {
    var $cities;

    function __construct($cities) {
        $this->cities = $cities;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <section id="hero" class="d-flex align-items-center">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 id="i18n-app-welcome">¡Bienvenido a SG2P!</h1>
                        <h2 id="i18n-select-building">Selecciona una ciudad para consultar Edificios</h2>
                        <!-- === Select City to list Builds ==== -->
                        <form name="formcities" method="post">
                            <select id="ciudad" name="ciudad" class="form-select" aria-label="Select a building">
                                <?php foreach($this->cities as $city) :?>
                                <option value="<?php echo $city['ciudad'] ?>"><?php echo $city['ciudad'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                        <div class="text-center">
                            <a class="btn-get-started" type="button" id="i18n-l-buildings" onclick="
                                insertacampo(document.formcities,'Controller','Portal');
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
