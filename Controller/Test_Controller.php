<?php

class Test {
    var $respuestaTest;

    function __construct() {
        $this->respuestaTest = array();
        $this->respuestaTest['numFallos'] = 0;
        $this->respuestaTest['numTest'] = 0;
    }

    function test() {
        include './Test/User_Test.php';
        include './Test/Building_Test.php';

        session_destroy();

        include './View/Test/Test_View.php';

        new Test_View($this->respuestaTest);
    }

}

function obtenerRespuesta($entidad, $accion, $validacion, $error, $esperado, $datos, $obtenido, &$numTest, &$numFallos) {
    $numTest++;
    if($obtenido != $esperado) $numFallos++;
    return array(
        'entidad' => $entidad,
        'accion' => $accion,
        'validacion' => $validacion,
        'error' => $error,
        'esperado' => $esperado,
        'datos' => $datos,
        'obtenido' => $obtenido,
        'exito' => ($obtenido == $esperado)
    );
}