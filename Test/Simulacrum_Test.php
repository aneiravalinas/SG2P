<?php

include_once './Service/Simulacrum_Service.php';
$testSimulacrum = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES (Simulacro) ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEARCH_IMPSIMS: ACCIONES (Simulacro) ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '111111111111111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEARCH_IMPSIMS: VALIDACIONES ---
 */

// Fecha Planificación inicial no válida
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'FECHA_PLANIFICACION_INICIO', 'Fecha Planificación inicial no válida',
    'START_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Planificación final no válida
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'FECHA_PLANIFICACION_FIN', 'Fecha Planificación final no válida',
    'END_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Estado no válido
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
                'estado' => 'estado');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'ESTADO', 'Estado no válido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Vencimiento inicial no válida
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_INICIO', 'Fecha Vencimiento inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Vencimiento final no válida
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_FIN', 'Fecha Vencimiento final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio no numérico
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'edificio_id' => 'a');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Nombre de Edificio corto (menos de 3 caracteres)
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'edificio_id' => '1', 'nombre_edificio' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre de Edificio corto (menos de 3 caracteres)',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Nombre de Edificio largo (más de 60 caracteres)
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre de Edificio largo (más de 60 caracteres)',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Nombre de Edificio con caracteres no permitidos
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombre ^Difico');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre de Edificio con caracteres no permitidos',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('simulacro_id' => '1', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'edificio_id' => '1',
    'nombre_edificio' => 'Nombre Edificio');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchCompletions();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_COMPLETIONS', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPSIM_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEARCH_SIMULACRUM: VALIDACIONES (Edificio y Simulacro) ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio vacío
$_POST = array('simulacro_id' => '1', 'edificio_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio no numérico
$_POST = array('simulacro_id' => '1', 'edificio_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEARCH_SIMULACRUM: ACCIONES (Edificio y Simulacro) ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '11111111111111111111111111', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El edificio no existe
$_POST = array('simulacro_id' => '1', 'edificio_id' => '11111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El plan del simulacro no está asignado al edificio
$_POST = array('simulacro_id' => '1', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'ACCION', 'El plan del simulacro no está asignado al edificio',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEARCH_SIMULACRUM: ACCIONES (Edificio y Simulacro) ---
 */

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('simulacro_id' => '4', 'edificio_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEARCH_SIMULACRUM: VALIDACIONES ---
 */

$_SESSION['username'] = 'sg2ped2';

// Fecha Planificación inicial no válida
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'FECHA_PLANIFICACION_INICIO', 'Fecha Planificación inicial no válida',
    'START_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Planificación final no válida
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'FECHA_PLANIFICACION_FIN', 'Fecha Planificación final no válida',
    'END_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Estado no válido
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'estado');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'ESTADO', 'Estado no válido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Vencimiento inicial no válida
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'FECHA_VENCIMIENTO_INICIO', 'Fecha Vencimiento inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Vencimiento final no válida
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'FECHA_VENCIMIENTO_FIN', 'Fecha Vencimiento final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEARCH_SIMULACRUM: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25', 'cumplimentacion_id' => '1',
    'estado' => 'pendiente', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_SIMULACRUM', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPSIM_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- SEEK_PORTAL_SIMULACRUM: VALIDACIONES (Edificio y Simulacro) ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio vacío
$_POST = array('simulacro_id' => '1', 'edificio_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio no numérico
$_POST = array('simulacro_id' => '1', 'edificio_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEEK_PORTAL_SIMULACRUM: ACCIONES (Edificio y Simulacro) ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '11111111111111111111111111', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El edificio no existe
$_POST = array('simulacro_id' => '1', 'edificio_id' => '11111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El plan del simulacro no está asignado al edificio
$_POST = array('simulacro_id' => '1', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'ACCION', 'El plan del simulacro no está asignado al edificio',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// La asignación entre el plan del simulacro y el edificio está vencida
$_POST = array('simulacro_id' => '5', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'ACCION', 'La asignación entre el plan del simulacro y el edificio está vencida',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEEK_PORTAL_SIMULACRUM: VALIDACIONES ---
 */

// Fecha Planificación inicial no válida
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'FECHA_PLANIFICACION_INICIO', 'Fecha Planificación inicial no válida',
    'START_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Planificación final no válida
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12-25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'FECHA_PLANIFICACION_FIN', 'Fecha Planificación final no válida',
    'END_PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEEK_PORTAL_SIMULACRUM: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2', 'fecha_planificacion_inicio' => '1992/12/25', 'fecha_planificacion_fin' => '1992/12/25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'PRTL_IMPSIM_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEARCH_PORTAL_SIMULACRUM_FORM: VALIDACIONES ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio vacío
$_POST = array('simulacro_id' => '1', 'edificio_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio no numérico
$_POST = array('simulacro_id' => '1', 'edificio_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEARCH_PORTAL_SIMULACRUM_FORM: ACCIONES ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '11111111111111111111111111', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El edificio no existe
$_POST = array('simulacro_id' => '1', 'edificio_id' => '11111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El plan del simulacro no está asignado al edificio
$_POST = array('simulacro_id' => '1', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'ACCION', 'El plan del simulacro no está asignado al edificio',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// La asignación entre el plan del simulacro y el edificio está vencida
$_POST = array('simulacro_id' => '5', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'ACCION', 'La asignación entre el plan del simulacro y el edificio está vencida',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// SEARCH_PORTAL_SIMULACRUM_FORM Ok
$_POST = array('simulacro_id' => '4', 'edificio_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->searchPortalSimulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEARCH_PORTAL_SIMULACRUM_FORM', 'ACCION', 'SEARCH_PORTAL_SIMULACRUM_FORM Ok',
    'BLDSIM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- ADD_IMPSIM_FORM: VALIDACIONES ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSimForm();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM_FORM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSimForm();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM_FORM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- ADD_IMPSIM_FORM: ACCIONES ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSimForm();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM_FORM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El plan del simulacro no tiene asignaciones activas con edificios
$_POST = array('simulacro_id' => '5');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSimForm();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM_FORM', 'ACCION', 'El plan del simulacro no tiene asignaciones activas con edificios',
    'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ADD_IMPSIM_FORM Ok
$_POST = array('simulacro_id' => '4');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSimForm();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM_FORM', 'ACCION', 'ADD_IMPSIM_FORM Ok',
    'BLDPLAN_ASSIGN_ACTIVES_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SIMULACRUM_FORM: VALIDACIONES ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio vacío
$_POST = array('simulacro_id' => '1', 'edificio_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio no numérico
$_POST = array('simulacro_id' => '1', 'edificio_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SIMULACRUM_FORM: ACCIONES ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '11111111111111111111111111', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_SIMULACRUM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El edificio no existe
$_POST = array('simulacro_id' => '1', 'edificio_id' => '11111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El plan del simulacro no está asignado al edificio
$_POST = array('simulacro_id' => '1', 'edificio_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'ACCION', 'El plan del simulacro no está asignado al edificio',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El usuario no tiene permisos sobre el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('simulacro_id' => '4', 'edificio_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'ACCION', 'El usuario no tiene permisos sobre el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// SIMULACRUM_FORM Ok
$_SESSION['username'] = 'sg2ped2';

$_POST = array('simulacro_id' => '4', 'edificio_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->simulacrumForm();
$respTest = obtenerRespuesta('Simulacrum', 'SIMULACRUM_FORM', 'ACCION', 'SIMULACRUM_FORM Ok',
    'BLDSIM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- ADD_IMPSIM: VALIDACIONES ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio vacío
$_POST = array('simulacro_id' => '1', 'buildings' => array());
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'BUILDINGS', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Edificio no numérico
$_POST = array('simulacro_id' => '1', 'buildings' => array('1', 'aa'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'BUILDINGS', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- ADD_IMPSIM: ACCIONES ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '111111111111111111111', 'buildings' => array('1'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El edificio no existe
$_POST = array('simulacro_id' => '1', 'buildings' => array('1111111111111111111111111111111'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'ACCION', 'El simulacro no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El usuario no tiene permisos sobre el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('simulacro_id' => '1', 'buildings' => array('1'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'ACCION', 'El usuario no tiene permisos sobre el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El plan del simulacro no está asignado al edificio
$_SESSION['username'] = 'sg2ped';

$_POST = array('simulacro_id' => '1', 'buildings' => array('1'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'ACCION', 'El plan del simulacro no está asignado al edificio',
    'BLDSIM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// La asignación entre el plan del simulacro y el edificio está vencida
$_POST = array('simulacro_id' => '5', 'buildings' => array('1'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'ACCION', 'La asignación entre el plan del simulacro y el edificio está vencida',
    'BLDPLAN_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Cumplimentación añadida Ok
$_SESSION['username'] = 'sg2ped2';

$_POST = array('simulacro_id' => '4', 'buildings' => array('2'));
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->addImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'ADD_IMPSIM', 'ACCION', 'Cumplimentación añadida Ok',
    'IMPSIM_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

if($feedback['ok']) {
    $edificio_simulacro_id = $sim_service->impSim_entity->cumplimentacion_id;
} else {
    $edificio_simulacro_id = '';
}

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- IMPLEMENT: VALIDACIONES (Cumplimentación) ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- IMPLEMENT: ACCIONES (Cumplimentación) ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// La cumplimentación está vencida
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '3');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'ACCION', 'La cumplimentación está vencida',
    'COMPL_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES ---
 */

// URL larga (más de 200 caracteres)
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'URL_RECURSO', 'URL larga (más de 200 caracteres)',
    'URL_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// URL formato no válido
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http:url');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'URL_RECURSO', 'URL formato no válido',
    'URL_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Planificación vacía
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'FECHA_PLANIFICACION', 'Fecha Planificación vacía',
    'PLANNING_DATE_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Planificación formato no válido
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => '2012/25-12');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'FECHA_PLANIFICACION', 'Fecha Planificación formato no válido',
    'PLANNING_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Fecha Planificación anterior a la fecha actual
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => '2012/12/25');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'FECHA_PLANIFICACION', 'Fecha Planificación anterior a la fecha actual',
    'PLANNING_DATE_PAST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Destinatarios vacío
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
                    'destinatarios' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'DESTINATARIOS', 'Destinatarios vacío',
    'RECIPIENTS_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Destinatarios largo (más de 200 caracteres)
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
    'destinatarios' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'DESTINATARIOS', 'Destinatarios largo (más de 200 caracteres)',
    'RECIPIENTS_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Destinatarios con caracteres no permitidos
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
    'destinatarios' => 'Destin+tarios');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'DESTINATARIOS', 'Destinatarios largo (más de 200 caracteres)',
    'RECIPIENTS_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- IMPLEMENT: ACCIONES ---
 */

// Cumplimentación completada correctamente
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id, 'url_recurso' => 'http://url', 'fecha_planificacion' => date_format(new DateTime(), 'Y-m-d'),
                    'destinatarios' => 'Todos.');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->implement();
$respTest = obtenerRespuesta('Simulacrum', 'IMPLEMENT', 'ACCION', 'Cumplimentación completada correctamente',
    'IMPSIM_IMPL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- EXPIRE: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->expire();
$respTest = obtenerRespuesta('Simulacrum', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->expire();
$respTest = obtenerRespuesta('Simulacrum', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- EXPIRE: ACCIONES ---
 */


// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->expire();
$respTest = obtenerRespuesta('Simulacrum', 'EXPIRE', 'ACCION', 'La cumplimentación no existe',
    'IMPSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->expire();
$respTest = obtenerRespuesta('Simulacrum', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Cumplimentación vencida correctamente
$_SESSION['username'] = 'sg2ped2';
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id);
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->expire();
$respTest = obtenerRespuesta('Simulacrum', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'IMPSIM_EXPIRE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->DELETE();
$respTest = obtenerRespuesta('Simulacrum', 'DELETE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->DELETE();
$respTest = obtenerRespuesta('Simulacrum', 'DELETE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->DELETE();
$respTest = obtenerRespuesta('Simulacrum', 'DELETE', 'ACCION', 'La cumplimentación no existe',
    'IMPSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->DELETE();
$respTest = obtenerRespuesta('Simulacrum', 'DELETE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// La cumplimentación a eliminar es la única cumplimentación del simulacro en el edificio
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->DELETE();
$respTest = obtenerRespuesta('Simulacrum', 'DELETE', 'ACCION', 'La cumplimentación a eliminar es la única cumplimentación del simulacro en el edificio',
    'IMPSIM_UNIQ', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Cumplimentación eliminada correctamente
$_POST = array('cumplimentacion_id' => $edificio_simulacro_id);
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->DELETE();
$respTest = obtenerRespuesta('Simulacrum', 'DELETE', 'ACCION', 'Cumplimentación eliminada correctamente',
    'IMPSIM_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seek();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seek();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seek();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK', 'ACCION', 'La cumplimentación no existe',
    'IMPSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seek();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Consulta de los detalles de la cumplimentación Ok
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seek();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK', 'ACCION', 'Consulta de los detalles de la cumplimentación Ok',
    'IMPSIM_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK_PORTAL_IMPSIM: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_IMPSIM', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_IMPSIM', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEEK_PORTAL_IMPSIM: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_IMPSIM', 'ACCION', 'La cumplimentación no existe',
    'IMPSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// La cumplimentación está vencida
$_POST = array('cumplimentacion_id' => '3');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_IMPSIM', 'ACCION', 'La cumplimentación está vencida',
    'IMPSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// Consulta de los detalles de la cumplimentacion OK
$_POST = array('cumplimentacion_id' => '2');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekPortalImpSim();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_PORTAL_IMPSIM', 'ACCION', 'Consulta de los detalles de la cumplimentacion OK',
    'PRTL_IMPSIM_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

/*
 *  --- SEEK_SIMULACRUM: VALIDACIONES ---
 */

// ID Simulacro vacío
$_POST = array('simulacro_id' => '');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_SIMULACRUM', 'SIMULACRO_ID', 'ID Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// ID Simulacro no numérico
$_POST = array('simulacro_id' => 'aaa');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_SIMULACRUM', 'SIMULACRO_ID', 'ID Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


/*
 *  --- SEEK_SIMULACRUM: ACCIONES ---
 */

// El simulacro no existe
$_POST = array('simulacro_id' => '111111111111111');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_SIMULACRUM', 'ACCION', 'El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);

// SEEK_SIMULACRUM Ok
$_POST = array('simulacro_id' => '1');
$sim_service = new Simulacrum_Service();
$feedback = $sim_service->seekSimulacrum();
$respTest = obtenerRespuesta('Simulacrum', 'SEEK_SIMULACRUM', 'ACCION', 'SEEK_SIMULACRUM Ok',
    'DFSIMID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testSimulacrum, $respTest);


//------------------------------------------------------------------------------
//Fin test Simulacros
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Simulacros'] = $testSimulacrum;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;