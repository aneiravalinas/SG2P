<?php

include './View/Page/header.php';

class Add_Building extends Header {

    var $candidates;

    function __construct($candidates) {
        parent::__construct();
        $this->candidates = $candidates;
        $this->render();
    }

    function render() {
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-add-building">Añadir Edificio</h1>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                        <form name="formularioadd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" onblur="check_NOMBRE_EDIFICIO();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="calle" class="i18n-calle">Calle</label>
                                    <input type="text" class="form-control" id="calle" name="calle" onblur="check_CALLE();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="ciudad" class="i18n-ciudad">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" onblur="check_CIUDAD();"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="provincia" class="i18n-provincia">Provincia</label>
                                    <input type="text" class="form-control" id="provincia" name="provincia" onblur="check_PROVINCIA();"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="codigo_postal" class="i18n-codigo_postal">Código Postal</label>
                                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" onblur="check_CPOSTAL();"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="i18n-telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" onblur="check_TELEFONO();"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="foto_edificio" class="i18n-foto_edificio">Foto del Edificio</label>
                                    <input type="file" class="form-control-sm" id="foto_edificio" name="foto_edificio"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="username" class="i18n-responsable">Responsable</label>
                                    <select id="username" name="username" class="form-select">
                                        <?php foreach($this->candidates as $candidate) :?>
                                        <option value="<?php echo $candidate['username'] ?>"><?php echo $candidate['username'] ?></option>
                                        <?php endforeach; ?>
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
                                            insertacampo(document.formularioadd,'controller','Building');
                                            insertacampo(document.formularioadd,'action','add');
                                            enviaformcorrecto(document.formularioadd,check_ADD_EDIFICIO());">
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