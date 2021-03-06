<?php

include_once './Service/Formation_Service.php';
$testFormation = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES (FORMACION) ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_IMPFORMATS: ACCIONES (FORMACION) ---
 */

// La Formación no existe
$_POST = array('formacion_id' => '1111111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'ACCION', 'La Formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES ---
 */

// ID de cumplimentación no numérico
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'CUMPLIMENTACION_ID', 'ID de cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Estado no permitido
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'estado');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'ESTADO', 'Estado no permitido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación inicial no válida
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FECHA_PLANIFICACION_INICIO', 'Fecha Planificación inicial no válida',
    'START_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación final no válida
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
                    'fecha_planificacion_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FECHA_PLANIFICACION_FIN', 'Fecha Planificación final no válida',
    'END_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Vencimiento inicial no válida
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_INICIO', 'Fecha Vencimiento inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Vencimiento final no válida
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_FIN', 'Fecha Vencimiento final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID Edificio no numérico
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25', 'edificio_id' => 'aa');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo (más de 60 caracteres)',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Nombre Edificio con caracteres no permitidos
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombr+ Edificio');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo (más de 60 caracteres)',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Cumplimentación inicial no válida
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombrê Edificio', 'fecha_cumplimentacion_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha Cumplimentación inicial no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Cumplimentación final no válida
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombrê Edificio', 'fecha_cumplimentacion_inicio' => '2014/12/25', 'fecha_cumplimentacion_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha Cumplimentación final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: ACCIONES ---
 */

// La búsqueda de cumplimentaciones se realiza correctamente
$_POST = array('formacion_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombre Edificio', 'fecha_cumplimentacion_inicio' => '2014/12/25', 'fecha_cumplimentacion_fin' => '2014/12/25');
$format_service = new Formation_Service();
$feedback = $format_service->searchCompletions();
$respTest = obtenerRespuesta('Formation', 'SEARCH_COMPLETIONS', 'ACCION', 'La búsqueda de cumplimentaciones se realiza correctamente',
    'IMPFORMAT_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- SEARCH_FORMATION: VALIDACIONES (Formación y Edificio) ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio vacío
$_POST = array('formacion_id' => '1', 'edificio_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio no numérico
$_POST = array('formacion_id' => '1', 'edificio_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_FORMATION: ACCIONES (Formación y Edificio) ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111111111111', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ACCION', 'La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El edificio no existe
$_POST = array('formacion_id' => '1', 'edificio_id' => '1111111111111111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El plan de la formación no está asignado al edificio
$_POST = array('formacion_id' => '1', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ACCION', 'El plan de la formación no está asignado al edificio',
    'BLDFORMAT_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos para buscar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('formacion_id' => '4', 'edificio_id' => '2');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ACCION', 'El usuario no tiene permisos para buscar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_FORMATION: VALIDACIONES ---
 */

$_SESSION['username'] = 'sg2ped2';

// ID de cumplimentación no numérico
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'CUMPLIMENTACION_ID', 'ID de cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Estado no permitido
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'estado');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ESTADO', 'Estado no permitido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación inicial no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FECHA_PLANIFICACION_INICIO', 'Fecha Planificación inicial no válida',
    'START_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación final no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
                'fecha_planificacion_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FECHA_PLANIFICACION_FIN', 'Fecha Planificación final no válida',
    'END_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Vencimiento inicial no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FECHA_VENCIMIENTO_INICIO', 'Fecha Vencimiento inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Vencimiento final no valida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FECHA_VENCIMIENTO_FIN', 'Fecha Vencimiento final no valida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Cumplimentación inical no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12-25',
    'fecha_cumplimentacion_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha Cumplimentación inical no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Cumplimentación final no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12-25',
    'fecha_cumplimentacion_inicio' => '2014/12/25', 'fecha_cumplimentacion_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha Cumplimentación final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEARCH_FORMATION: ACCIONES ---
 */

// La búsqueda se realiza correctamente
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_planificacion_inicio' => '2014/12/25',
    'fecha_planificacion_fin' => '2014/12/25', 'fecha_vencimiento_inicio' => '2014/12/25', 'fecha_vencimiento_fin' => '2014/12/25',
    'fecha_cumplimentacion_inicio' => '2014/12/25', 'fecha_cumplimentacion_fin' => '2014/12/25');
$format_service = new Formation_Service();
$feedback = $format_service->searchFormation();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ACCION', 'La búsqueda se realiza correctamente',
    'IMPFORMAT_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- SEEK_PORTAL_FORMATION: VALIDACIONES (Formación y Edificio) ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio vacío
$_POST = array('formacion_id' => '1', 'edificio_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio no numérico
$_POST = array('formacion_id' => '1', 'edificio_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- SEEK_PORTAL_FORMATION: ACCIONES (Formación y Edificio) ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111111111111', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'ACCION', 'La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El edificio no existe
$_POST = array('formacion_id' => '1', 'edificio_id' => '1111111111111111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El plan de la formación no está asignado al edificio
$_POST = array('formacion_id' => '1', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'ACCION', 'El plan de la formación no está asignado al edificio',
    'BLDFORMAT_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La asignación del plan con el edificio está vencida
$_POST = array('formacion_id' => '5', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'ACCION', 'La asignación del plan con el edificio está vencida',
    'BLDFORMAT_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La formación se encuentra vencida en el edificio
$_POST = array('formacion_id' => '6', 'edificio_id' => '2');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'ACCION', 'La formación se encuentra vencida en el edificio',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEEK_PORTAL_FORMATION: VALIDACIONES ---
 */

// Fecha Planificación inicial no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'FECHA_PLANIFICACION_INICIO', 'Fecha Planificación inicial no válida',
    'START_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación final no válida
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '2014/12/25', 'fecha_planificacion_fin' => '2014/12-25');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'FECHA_PLANIFICACION_FIN', 'Fecha Planificación final no válida',
    'END_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- SEEK_PORTAL_FORMATION: ACCIONES ---
 */

// Consulta de los detalles de la formación del portal Ok
$_POST = array('formacion_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '2014/12/25', 'fecha_planificacion_fin' => '2014/12/25');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_FORMATION', 'ACCION', 'Consulta de los detalles de la formación del portal Ok',
    'PRTL_IMPFORMAT_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- SEEK_FORMATION: VALIDACIONES ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->seekFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_FORMATION', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->seekFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_FORMATION', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEEK_FORMATION: ACCIONES ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->seekFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_FORMATION', 'ACCION', 'La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La formación existe
$_POST = array('formacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seekFormation();
$respTest = obtenerRespuesta('Formation', 'SEEK_FORMATION', 'ACCION', 'La formación existe',
    'DFFRMTID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- ADD_IMPFORMAT_FORM: VALIDACIONES ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormatForm();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT_FORM', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormatForm();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT_FORM', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- ADD_IMPFORMAT_FORM: ACCIONES ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormatForm();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT_FORM', 'ACCION', 'La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El plan de la formación no está asignado a ningún edificio
$_POST = array('formacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormatForm();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT_FORM', 'ACCION', 'El plan de la formación no está asignado a ningún edificio',
    'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El plan de la formacion tiene edificios asignados
$_POST = array('formacion_id' => '4');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormatForm();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT_FORM', 'ACCION', 'El plan de la formacion tiene edificios asignados',
    'BLDPLAN_ASSIGN_ACTIVES_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- FORMATION_FORM: ACCIONES ---
 */


// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio vacío
$_POST = array('formacion_id' => '1', 'edificio_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio no numérico
$_POST = array('formacion_id' => '1', 'edificio_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- FORMATION_FORM: ACCIONES ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111111111111', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'ACCION', 'La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El edificio no existe
$_POST = array('formacion_id' => '1', 'edificio_id' => '1111111111111111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'ACCION', 'La formación no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El plan de la formación no está asignado al edificio
$_POST = array('formacion_id' => '1', 'edificio_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'ACCION', 'El plan de la formación no está asignado al edificio',
    'BLDFORMAT_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos sobre el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('formacion_id' => '4', 'edificio_id' => '2');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'FORMATION_FORM', 'ACCION', 'El usuario no tiene permisos sobre el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// FORMATION_FORM OK
$_SESSION['username'] = 'sg2ped2';

$_POST = array('formacion_id' => '4', 'edificio_id' => '2');
$format_service = new Formation_Service();
$feedback = $format_service->formationForm();
$respTest = obtenerRespuesta('Formation', 'SEARCH_FORMATION', 'ACCION', 'FORMATION_FORM OK',
    'BLDFORMAT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- ADD_IMPFORMAT: VALIDACIONES ---
 */

// ID de Formación vacío
$_POST = array('formacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'FORMACION_ID', 'ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'FORMACION_ID', 'ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio vacío
$_POST = array('formacion_id' => '1', 'buildings' => array());
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'BUILDINGS', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Edificio no numérico
$_POST = array('formacion_id' => '1', 'buildings' => array('1', 'AA'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'BUILDINGS', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- ADD_IMPFORMAT: ACCIONES ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111111111111111111111111111111', 'buildings' => array('1'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'ACCION', 'La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El edificio no existe
$_POST = array('formacion_id' => '1', 'buildings' => array('11111111111111111111111111111111111111'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos para añadir cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('formacion_id' => '1', 'buildings' => array('1'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'ACCION', 'El usuario no tiene permisos para añadir cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El plan de la formación no está asignado al edificio
$_SESSION['username'] = 'sg2ped';

$_POST = array('formacion_id' => '1', 'buildings' => array('1'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'ACCION', 'El plan de la formación no está asignado al edificio',
    'BLDFORMAT_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La asignación entre el plan de la formación y el edificio está vencida
$_POST = array('formacion_id' => '5', 'buildings' => array('1'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'ACCION', 'La asignación entre el plan de la formación y el edificio está vencida',
    'BLDPLAN_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Cumplimentación añadida correctamente
$_SESSION['username'] = 'sg2ped2';

$_POST = array('formacion_id' => '4', 'buildings' => array('2'));
$format_service = new Formation_Service();
$feedback = $format_service->addImpFormat();
$respTest = obtenerRespuesta('Formation', 'ADD_IMPFORMAT', 'ACCION', 'Cumplimentación añadida correctamente',
    'IMPFORMAT_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

if($feedback['ok']) {
    $edificio_formacion_id = $format_service->impFormat_entity->cumplimentacion_id;
} else {
    $edificio_formacion_id = '';
}

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->seek();
$respTest = obtenerRespuesta('Formation', 'SEEK', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->seek();
$respTest = obtenerRespuesta('Formation', 'SEEK', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '11111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->seek();
$respTest = obtenerRespuesta('Formation', 'SEEK', 'ACCION', 'La cumplimentación no existe',
    'IMPFORMATID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seek();
$respTest = obtenerRespuesta('Formation', 'SEEK', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Consulta de los detalles de la cumplimentación Ok
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seek();
$respTest = obtenerRespuesta('Formation', 'SEEK', 'ACCION', 'Consulta de los detalles de la cumplimentación Ok',
    'IMPFORMAT_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- IMPLEMENT: VALIDACIONES (Cumplimentación) ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);


/*
 *  --- IMPLEMENT: ACCIONES (Cumplimentación) ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '11111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPFORMATID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La cumplimentación está vencida
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '4');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'ACCION', 'La cumplimentación está vencida',
    'COMPL_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES ---
 */

// La URL no es válida
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https:/url_recurso.php');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'URL_RECURSO', 'La URL no es válida',
    'URL_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// URL larga (más de 200 caracteres)
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'URL_RECURSO', 'URL larga (más de 200 caracteres)',
    'URL_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación vacía
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => '');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'FECHA_PLANIFICACION', 'Fecha Planificación vacía',
    'PLANNING_DATE_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Formato Fecha incorrecto
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => '1992/25-12');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'FECHA_PLANIFICACION', 'Formato Fecha incorrecto',
    'PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Fecha Planificación pasada
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => '1992/12/25');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'FECHA_PLANIFICACION', 'Fecha Planificación pasada',
    'PLANNING_DATE_PAST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Destinatarios vacío
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
                    'destinatarios' => '');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'DESTINATARIOS', 'Destinatarios vacío',
    'RECIPIENTS_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Destinatarios largo (más de 200 caracteres)
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
    'destinatarios' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'DESTINATARIOS', 'Destinatarios largo (más de 200 caracteres)',
    'RECIPIENTS_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Destinatarios con caracteres no permitidos
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
    'destinatarios' => 'Destin+tarios');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'DESTINATARIOS', 'Destinatarios con caracteres no permitidos',
    'RECIPIENTS_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- IMPLEMENT: ACCIONES ---
 */

// Cumplimentación completada Ok
$_POST = array('cumplimentacion_id' => $edificio_formacion_id, 'url_recurso' => 'https://url_recurso.php', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
    'destinatarios' => 'Destinatarios.');
$format_service = new Formation_Service();
$feedback = $format_service->implement();
$respTest = obtenerRespuesta('Formation', 'IMPLEMENT', 'ACCION', 'Cumplimentación completada Ok',
    'IMPFORMAT_IMPL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- EXPIRE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->expire();
$respTest = obtenerRespuesta('Formation', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->expire();
$respTest = obtenerRespuesta('Formation', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- EXPIRE: ACCIONES ---
 */


// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '11111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->expire();
$respTest = obtenerRespuesta('Formation', 'EXPIRE', 'ACCION', 'La cumplimentación no existe',
    'IMPFORMATID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->expire();
$respTest = obtenerRespuesta('Formation', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Cumplimentación vencida correctamente
$_SESSION['username'] = 'sg2ped2';
$_POST = array('cumplimentacion_id' => $edificio_formacion_id);
$format_service = new Formation_Service();
$feedback = $format_service->expire();
$respTest = obtenerRespuesta('Formation', 'EXPIRE', 'ACCION', 'Cumplimentación vencida correctamente',
    'IMPFORMAT_EXPIRE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->DELETE();
$respTest = obtenerRespuesta('Formation', 'DELETE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->DELETE();
$respTest = obtenerRespuesta('Formation', 'DELETE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '11111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->DELETE();
$respTest = obtenerRespuesta('Formation', 'DELETE', 'ACCION', 'La cumplimentación no existe',
    'IMPFORMATID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->DELETE();
$respTest = obtenerRespuesta('Formation', 'DELETE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La cumplimentación a eliminar es la única cumplimentación de la formación en el edificio
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->DELETE();
$respTest = obtenerRespuesta('Formation', 'DELETE', 'ACCION', 'La cumplimentación a eliminar es la única cumplimentación de la formación en el edificio',
    'IMPFORMAT_UNIQ', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Cumplimentación eliminada correctamente
$_POST = array('cumplimentacion_id' => $edificio_formacion_id);
$format_service = new Formation_Service();
$feedback = $format_service->DELETE();
$respTest = obtenerRespuesta('Formation', 'DELETE', 'ACCION', 'Cumplimentación eliminada correctamente',
    'IMPFORMAT_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK_PORTAL_IMPFORMAT: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalImpFormat();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_IMPFORMAT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalImpFormat();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_IMPFORMAT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

/*
 *  --- SEEK_PORTAL_IMPFORMAT: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '11111111111111111');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalImpFormat();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_IMPFORMAT', 'ACCION', 'La cumplimentación no existe',
    'IMPFORMATID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// La cumplimentación está vencida
$_POST = array('cumplimentacion_id' => '4');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalImpFormat();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_IMPFORMAT', 'ACCION', 'La cumplimentación está vencida',
    'IMPFORMATID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

// Consulta de los detalles de la cumplimentación de la formación en el portal Ok
$_POST = array('cumplimentacion_id' => '1');
$format_service = new Formation_Service();
$feedback = $format_service->seekPortalImpFormat();
$respTest = obtenerRespuesta('Formation', 'SEEK_PORTAL_IMPFORMAT', 'ACCION', 'Consulta de los detalles de la cumplimentación de la formación en el portal Ok',
    'PRTL_IMPFORMAT_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testFormation, $respTest);

//------------------------------------------------------------------------------
//Fin test Formaciones
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Formaciones'] = $testFormation;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;