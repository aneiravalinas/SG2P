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
        include './Test/Floor_Test.php';
        include './Test/Space_Test.php';
        include './Test/DefPlan_Test.php';
        include './Test/DefDoc_Test.php';
        include './Test/DefProc_Test.php';
        include './Test/DefRoute_Test.php';
        include './Test/DefFormat_Test.php';
        include './Test/DefSim_Test.php';
        include './Test/BuildPlan_Test.php';
        include './Test/Plan_Test.php';
        include './Test/Document_Test.php';
        include './Test/Procedure_Test.php';
        include './Test/Route_Test.php';
        include './Test/Formation_Test.php';

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