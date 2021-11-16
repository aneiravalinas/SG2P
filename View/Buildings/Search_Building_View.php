<?php

include_once './View/Page/header.php';

class Search_Building extends Header {
    var $managers;

    function __construct($managers) {
        parent::__construct();
        $this->managers = $managers;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-search-building">Buscar Edificio</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formulariosearch" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" class="form-control" id="edificio_id" name="edificio_id" onblur="check_EDIFICIO_ID_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_EDIFICIO_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="ciudad" class="i18n-ciudad">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" onblur="check_CIUDAD_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="provincia" class="i18n-provincia">Provincia</label>
                                    <input type="text" class="form-control" id="provincia" name="provincia" onblur="check_PROVINCIA_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="codigo_postal" class="i18n-codigo_postal">Código Postal</label>
                                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" onblur="check_CPOSTAL_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="calle" class="i18n-calle">Calle</label>
                                    <input type="text" class="form-control" id="calle" name="calle" onblur="check_CALLE_SEARCH();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="i18n-telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" onblur="check_TELEFONO_SEARCH();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="username" class="i18n-responsable">Responsable</label>
                                    <select id="username" name="username" class="form-select">
                                        <?php if(es_resp_edificio()): ?>
                                            <option value="<?php echo getUser() ?>" selected><?php echo getUser(); ?></option>
                                        <?php else: ?>
                                            <option value="">Todos</option>
                                            <?php foreach($this->managers as $manager) :?>
                                                <option value="<?php echo $manager['username'] ?>"><?php echo $manager['username'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col d-flex justify-content-between flex-wrap">
                                    <a class="btn-get-started i18n-cancelar" id="btn-cancel" type="button" onclick="
                                        crearform('formenviar', 'post');
                                        <?php foreach($this->currentShow as $key => $value): ?>
                                        insertacampo(document.formenviar, '<?php echo $key; ?>', '<?php echo $value; ?>');
                                        <?php endforeach; ?>
                                        enviaform(document.formenviar);">
                                        Cancelar
                                    </a>
                                    <a class="btn-get-started i18n-enviar" type="button" onclick="
                                            insertacampo(document.formulariosearch,'controller','Building');
                                            insertacampo(document.formulariosearch,'action','search');
                                            enviaformcorrecto(document.formulariosearch,check_SEARCH_EDIFICIO());">
                                        Enviar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


<?php
        include './View/Page/footer.php';
    }
}
?>