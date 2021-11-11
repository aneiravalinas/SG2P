<?php

include './View/Page/header.php';

class Test_View extends Header {
    var $test;

    function __construct($test) {
        parent::__construct();
        $this->test = $test;
        $this->render();
    }

    function render() {
        include_once './Common/Auth.php';
        ?>

        <!-- ======= FORM SECTION ====== --->

        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center pt-3 mt-3">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1 class="mb-4">Tests</h1>
                        <h2>De <?php echo $this->test['numTest'] ?> tests hay <?php echo $this->test['numFallos'] ?> fallidos</h2>
                    </div>
                </div>


                <?php foreach($this->test['resultado'] as $entity => $testEntity) :?>
                    <div class="row mt-5 pt-5">
                        <div class="col-xl-9 col-lg-9">
                            <h3>Entidad <?php echo $entity ?></h3>
                        </div>
                    </div>

                <div class="row justify-content-center">
                    <div class="col table-responsive" id="col-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Entidad</th>
                                <th scope="col">Acción</th>
                                <th scope="col">Validación</th>
                                <th scope="col">Prueba</th>
                                <th scope="col">Valor Esperado</th>
                                <th scope="col">Valor Obtenido</th>
                                <th scope="col">Datos</th>
                                <th scope="col">Exito</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($testEntity as $res) :?>
                            <?php if($res['exito']): ?>
                            <tr class="table-success">
                            <?php else: ?>
                            <tr class="table-danger">
                            <?php endif; ?>
                                <td><?php echo $res['entidad'] ?></td>
                                <td><?php echo $res['accion'] ?></td>
                                <td><?php echo $res['validacion'] ?></td>
                                <td><?php echo $res['error'] ?></td>
                                <td><?php echo $res['esperado'] ?></td>
                                <td><?php echo $res['obtenido'] ?></td>
                                <td>
                                    <?php
                                    if (is_array($res['datos'])) {
                                        foreach ($res['datos'] as $key => $value) {
                                            if (is_array($value)) {
                                                echo $key . ' = [<br>';
                                                foreach ($value as $val) {
                                                    if (strlen($val) > 20) {
                                                        $val = substr($val, 0, 20) . "...";
                                                    }
                                                    echo '\'' . $val . '\'<br>';
                                                }
                                                echo ']';
                                            } elseif (strlen($value) > 20) {
                                                $value = substr($value, 0, 20) . "...";
                                                echo $key . ' = \'' . $value . '\'<br>';
                                            } else {
                                                echo $key . ' = \'' . $value . '\'<br>';
                                            }
                                        }

                                    } else {
                                        if (strlen($res['datos']) > 20) {
                                            echo substr($res['datos'], 0, 20) . "...";
                                        } else echo $res['datos'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($res['exito']) {
                                        echo 'TRUE';
                                    } else {
                                        echo 'FALSE';
                                    } ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        <?php endforeach; ?>
            </div>
        </section>

<?php
        include './View/Page/footer.php';
    }
}
?>