<?php

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