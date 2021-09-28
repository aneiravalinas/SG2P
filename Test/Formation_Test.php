<?php

include_once './Service/Formation_Service.php';
$testFormation = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH_IMPFORMATS: VALIDACIONES (FORMACION) ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_IMPFORMATS: ACCIONES (FORMACION) ---
 */

// La Formación no existe
$_POST = array('formacion_id' => '1111111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'ACCION', 'La Formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_IMPFORMATS: VALIDACIONES ---
 */

// ID de cumplimentación no numérico
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'EDIFICIO_FORMACION_ID', 'ID de cumplimentación no numérico',
    'IMPFORMAT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Estado no permitido
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'estado');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'ESTADO', 'Estado no permitido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Formato Fecha incorrecto
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'FECHA_PLANIFICACION', 'Formato Fecha incorrecto',
    'PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID Edificio no numérico
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion' => '2014/12/25', 'edificio_id' => 'aa');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Nombre edificio corto (menos de 3 caracteres)
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion' => '2014/12/25', 'edificio_id' => '1',
                        'nombre_edificio' => 'aa');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'NOMBRE_EDIFICIO', 'Nombre edificio corto (menos de 3 caracteres)',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo (más de 60 caracteres)',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Nombre Edificio con caracteres no permitidos
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombrê Edificio');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo (más de 60 caracteres)',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- SEARCH_IMPFORMATS: ACCIONES ---
 */

// La búsqueda de cumplimentaciones se realiza correctamente
$_POST = array('formacion_id' => '1', 'edificio_formacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombre Edificio');
$format_service = new Formation_Service();
$feedback = $format_service->searchImpFormats();
$respTest = obtenerRespuesta('Formation', 'SEARCH_IMPFORMATS', 'ACCION', 'La búsqueda de cumplimentaciones se realiza correctamente',
    'IMPFORMAT_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

//------------------------------------------------------------------------------
//Fin test Formaciones
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Formaciones'] = $testFormation;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;