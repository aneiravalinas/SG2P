<?php

class ShowCurrent_Building {
    var $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }

    function render() {
        include './View/Page/header.php';
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4 i18n-edit-building">Editar Edificio</h1>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-9 my-4 text-center">
                            <img src="<?php echo building_photos_path . $this->building['foto_edificio'] ?>" id="picture-profile" class="rounded-circle"/>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-9">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="edificio_id" class="i18n-edificio_id">ID Edificio</label>
                                    <input type="text" class="form-control" id="edificio_id" name="edificio_id" value="<?php echo $this->building['edificio_id'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombre" class="i18n-nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->building['nombre'] ?>" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="ciudad" class="i18n-ciudad">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $this->building['ciudad'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="provincia" class="i18n-provincia">Provincia</label>
                                    <input type="text" class="form-control" id="provincia" name="provincia" value="<?php echo $this->building['provincia'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="codigo_postal" class="i18n-codigo_postal">Código Postal</label>
                                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?php echo $this->building['codigo_postal'] ?>" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="telefono" class="i18n-telefono">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $this->building['telefono'] ?>" disabled/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="calle" class="i18n-calle">Calle</label>
                                    <input type="text" class="form-control" id="calle" name="calle" value="<?php echo $this->building['calle'] ?>" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <label for="username" class="i18n-responsable">Responsable</label>
                                    <select id="username" name="username" class="form-select" disabled>
                                            <option value="<?php echo $this->building['username'] ?>" selected>
                                                <?php echo $this->building['username'] ?>
                                            </option>

                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col text-center">
                                    <a class="btn-get-started i18n-back" type="button" onclick="
                                        crearform('formenviar','post');
                                            insertacampo(document.formenviar,'controller','Building');
                                            insertacampo(document.formenviar,'action','show');
                                            enviaform(document.formenviar);">
                                        Volver
                                    </a>
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