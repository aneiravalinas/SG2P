<?php

include_once './Service/Procedure_Service.php';
$testProcedure = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEEK_PROCEDURE: VALIDACIONES ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PROCEDURE', 'PROCEDIMIENTO_ID', 'ID de procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PROCEDURE', 'PROCEDIMIENTO_ID', 'ID de procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEEK_PROCEDURE: ACCIONES ---
 */

// El procedimiento no existe
$_POST = array('procedimiento_id' => '1111111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PROCEDURE', 'ACCION', 'El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El procedimiento existe
$_POST = array('procedimiento_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PROCEDURE', 'ACCION', 'El procedimiento existe',
    'DFPROCID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES (Procedimiento) ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'PROCEDIMIENTO_ID', 'ID de procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'PROCEDIMIENTO_ID', 'ID de procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: ACCIONES (Procedimiento) ---
 */

// El procedimiento no existe
$_POST = array('procedimiento_id' => '1111111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'ACCION', 'El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES ---
 */

// ID de Cumplimentación no numérico
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => 'aaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Estado no permitido
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'estado');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'ESTADO', 'Estado no permitido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha de cumplimentación inicial inválida
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha de cumplimentación inicial inválida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha de cumplimentacion final inválida
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
                    'fecha_cumplimentacion_fin' => '1992-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha de cumplimentacion final inválida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha vencimiento inicial inválida
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12-25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_INICIO', 'Fecha vencimiento inicial inválida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha vencimiento final inválida
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12-25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_FIN', 'Fecha vencimiento final inválida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


// Nombre DOC largo (más de 50 caracteres)
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente',
    'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25',
    'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'NOMBRE_DOC', 'Nombre de Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre DOC formato
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'documento.php');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'NOMBRE_DOC', 'Nombre de Documento con formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio no numérico
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => 'aaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre de Edificio formato incorrecto
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'edific^o');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('procedimiento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'edificio');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchCompletions();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_COMPLETIONS', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPPROC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- SEARCH_PROCEDURE: VALIDACIONES (Edificio y Procedimiento) ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'PROCEDIMIENTO_ID', 'ID Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'PROCEDIMIENTO_ID', 'ID Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio vacío
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio no numérico
$_POST = array('procedimiento_id' => '1', 'edificio_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_PROCEDURE: ACCIONES (Edificio y Procedimiento) ---
 */

// El Procedimiento no existe
$_POST = array('procedimiento_id' => '11111111111111111111111', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ACCION', 'El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El Edificio no existe
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '11111111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El plan del procedimiento no está asignado al edificio
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ACCION', 'El plan del procedimiento no está asignado al edificio',
    'BLDPROC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para consultar procedimientos en el edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped2';

$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ACCION', 'El usuario no tiene permisos para consultar procedimientos en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_PROCEDURE: VALIDACIONES ---
 */

$_SESSION['username'] = 'sg2ped';

// ID de Cumplimentación no numérico
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => 'aaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Estado no contemplado
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'estado');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ESTADO', 'Estado no contemplado',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha cumplimentación inicial no válida
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha cumplimentación inicial no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha cumplimentación final no válida
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012/12/25',
                    'fecha_cumplimentacion_fin' => '2012-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha cumplimentación final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha vencimiento inicial no válido
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012/12/25',
    'fecha_cumplimentacion_fin' => '2012/12/25', 'fecha_vencimiento_inicio' => '2012-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'FECHA_VENCIMIENTO_INICIO', 'Fecha vencimiento inicial no válido',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha vencimiento final no válido
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012/12/25',
    'fecha_cumplimentacion_fin' => '2012/12/25', 'fecha_vencimiento_inicio' => '2012/12/25', 'fecha_vencimiento_fin' => '2012-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'FECHA_VENCIMIENTO_FIN', 'Fecha vencimiento final no válido',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre DOC largo (más de 50 caracteres)
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012/12/25',
    'fecha_cumplimentacion_fin' => '2012/12/25', 'fecha_vencimiento_inicio' => '2012/12/25', 'fecha_vencimiento_fin' => '2012/12/25',
    'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'NOMBRE_DOC', 'Nombre de Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre DOC formato
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012/12/25',
    'fecha_cumplimentacion_fin' => '2012/12/25', 'fecha_vencimiento_inicio' => '2012/12/25', 'fecha_vencimiento_fin' => '2012/12/25',
    'nombre_doc' => 'documento.php');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'NOMBRE_DOC', 'Nombre de Documento con formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_PROCEDURE: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'cumplimentacion_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion_inicio' => '2012/12/25',
    'fecha_cumplimentacion_fin' => '2012/12/25', 'fecha_vencimiento_inicio' => '2012/12/25', 'fecha_vencimiento_fin' => '2012/12/25',
    'nombre_doc' => 'documento.pdf');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPPROC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['rol'], $_SESSION['username']);

/*
 *  --- SEEK_PORTAL_PROCEDURE: VALIDACIONES ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'PROCEDIMIENTO_ID', 'ID Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'PROCEDIMIENTO_ID', 'ID Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio vacío
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio no numérico
$_POST = array('procedimiento_id' => '1', 'edificio_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- SEEK_PORTAL_PROCEDURE: ACCIONES ---
 */

// El Procedimiento no existe
$_POST = array('procedimiento_id' => '11111111111111111111111', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'ACCION', 'El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El Edificio no existe
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '11111111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El plan del procedimiento no está asignado al edificio
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'ACCION', 'El plan del procedimiento no está asignado al edificio',
    'BLDPROC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// La asignación entre el plan del procedimiento y el edificio se encuentra vencida
$_POST = array('procedimiento_id' => '6', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'ACCION', 'La asignación entre el plan del procedimiento y el edificio se encuentra vencida',
    'BLDPROC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El Procedimiento se encuentra vencido en el edificio
$_POST = array('procedimiento_id' => '7', 'edificio_id' => '6');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'ACCION', 'El Procedimiento se encuentra vencido en el edificio',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Búsqueda de cumplimentaciones del portal Ok
$_POST = array('procedimiento_id' => '5', 'edificio_id' => '6');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_PROCEDURE', 'ACCION', 'Búsqueda de cumplimentaciones del portal Ok',
    'PRTL_IMPPROC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- ADD_IMPPROC_FORM: VALIDACIONES ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProcForm();
$respTest = obtenerRespuesta('Procedure', 'ADD_IMPPROC_FORM', 'PROCEDIMIENTO_ID', 'ID de procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProcForm();
$respTest = obtenerRespuesta('Procedure', 'ADD_IMPPROC_FORM', 'PROCEDIMIENTO_ID', 'ID de procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- ADD_IMPPROC_FORM: ACCIONES ---
 */

// El plan del procedimiento no tiene asignaciones con edificios
$_POST = array('procedimiento_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProcForm();
$respTest = obtenerRespuesta('Procedure', 'ADD_IMPPROC_FORM', 'ACCION', 'El plan del procedimiento no tiene asignaciones con edificios',
    'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El plan del procedimiento tiene asignaciones con edificios
$_POST = array('procedimiento_id' => '5');
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProcForm();
$respTest = obtenerRespuesta('Procedure', 'ADD_IMPPROC_FORM', 'ACCION', 'El plan del procedimiento tiene asignaciones con edificios',
    'BLDPLAN_ASSIGN_ACTIVES_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- PROCEDURE_FORM: VALIDACIONES ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'PROCEDIMIENTO_ID', 'ID Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'PROCEDIMIENTO_ID', 'ID Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio vacío
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio no numérico
$_POST = array('procedimiento_id' => '1', 'edificio_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- ADD_PROCEDURE_FORM: ACCIONES ---
 */

// El Procedimiento no existe
$_POST = array('procedimiento_id' => '11111111111111111111111', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'ACCION', 'El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El Edificio no existe
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '11111111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El plan del procedimiento no está asignado al edificio
$_POST = array('procedimiento_id' => '1', 'edificio_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'ACCION', 'El plan del procedimiento no está asignado al edificio',
    'BLDPROC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para consultar procedimientos en el edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped2';

$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'ACCION', 'El usuario no tiene permisos para consultar procedimientos en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Plan del procedimiento asignado al edificio Ok
$_SESSION['username'] = 'sg2ped';

$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7');
$proc_service = new Procedure_Service();
$feedback = $proc_service->procedureForm();
$respTest = obtenerRespuesta('Procedure', 'PROCEDURE_FORM', 'ACCION', 'Plan del procedimiento asignado al edificio Ok',
    'BLDPROC_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- ADD: VALIDACIONES ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'PROCEDIMIENTO_ID', 'ID Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'PROCEDIMIENTO_ID', 'ID Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio vacío
$_POST = array('procedimiento_id' => '1', 'buildings' => array());
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'EDIFICIOS', 'ID Edificios vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio no numérico
$_POST = array('procedimiento_id' => '1', 'buildings' => array('1', 'aaa'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'EDIFICIOS', 'ID Edificios no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- ADD: ACCIONES ---
 */

// El Procedimiento no existe
$_POST = array('procedimiento_id' => '111111', 'buildings' => array('1'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'El Procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El Edificio no existe
$_POST = array('procedimiento_id' => '1', 'buildings' => array('11111111111111111'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'El Edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para añadir cumplimentaciones en el edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped2';

$_POST = array('procedimiento_id' => '4', 'buildings' => array('7'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'El usuario no tiene permisos para añadir cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El plan del procedimiento no está asignado al edificio
$_SESSION['username'] = 'sg2ped';

$_POST = array('procedimiento_id' => '1', 'buildings' => array('1'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'El plan del procedimiento no está asignado al edificio',
    'BLDPROC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// La asignación entre el plan del procedimiento y el edificio está vencida
$_POST = array('procedimiento_id' => '6', 'buildings' => array('1'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'La asignación entre el plan del procedimiento y el edificio está vencida',
    'BLDPLAN_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El edificio tiene cumplimentaciones activas del procedimiento
$_SESSION['username'] = 'sg2ped2';

$_POST = array('procedimiento_id' => '5', 'buildings' => array('6'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'El edificio tiene cumplimentaciones activas del procedimiento',
    'IMPPROC_ACTIVE_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Cumplimentación añadida Ok
$_SESSION['username'] = 'sg2ped';

$_POST = array('procedimiento_id' => '4', 'buildings' => array('7'));
$proc_service = new Procedure_Service();
$feedback = $proc_service->addImpProc();
$respTest = obtenerRespuesta('Procedure', 'ADD', 'ACCION', 'Cumplimentación añadida Ok',
    'IMPPROC_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

if($feedback['ok']) {
    $proc_build_id = $proc_service->impProc_entity->cumplimentacion_id;
} else {
    $proc_build_id = '';
}

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seek();
$respTest = obtenerRespuesta('Procedure', 'SEEK', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seek();
$respTest = obtenerRespuesta('Procedure', 'SEEK', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seek();
$respTest = obtenerRespuesta('Procedure', 'SEEK', 'ACCION', 'La cumplimentación no existe',
    'IMPPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '3');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seek();
$respTest = obtenerRespuesta('Procedure', 'SEEK', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Consulta de la cumplimentación Ok
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '3');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seek();
$respTest = obtenerRespuesta('Procedure', 'SEEK', 'ACCION', 'Consulta de la cumplimentación Ok',
    'IMPPROC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- IMPLEMENT: VALIDACIONES (Cumplimentación) ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- IMPLEMENT: ACCIONES (Cumplimentación) ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '3');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// La cumplimentación se encuentra vencida
$_SESSION['username'] = 'sg2ped2';

$_POST = array('cumplimentacion_id' => '2');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'ACCION', 'La cumplimentación se encuentra vencida',
    'COMPL_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES (Nombre Documento) ---
 */

// Nombre Documento vacío
$_SESSION['username'] = 'sg2ped';

$_POST = array('cumplimentacion_id' => $proc_build_id, 'nombre_doc' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento vacío',
    'FILENAME_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre Documento largo
$_POST = array('cumplimentacion_id' => $proc_build_id, 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre Documento con caracteres no permitidos
$_POST = array('cumplimentacion_id' => $proc_build_id, 'nombre_doc' => 'fich^ro.pdf');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento con caracteres no permitidos',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre Documento con extensión no permitida
$_POST = array('cumplimentacion_id' => $proc_build_id, 'nombre_doc' => 'fichero.php');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento con extensión no permitida',
    'FILENAME_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Cumplimentación completada Ok
$_POST = array('cumplimentacion_id' => $proc_build_id, 'nombre_doc' => 'fichero.pdf');
$proc_service = new Procedure_Service();
$feedback = $proc_service->implement();
$respTest = obtenerRespuesta('Procedure', 'IMPLEMENT', 'ACCION', 'Cumplimentación completada Ok',
    'IMPPROC_IMPL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- EXPIRE: VALIDACIONES ---
 */


// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->expire();
$respTest = obtenerRespuesta('Procedure', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->expire();
$respTest = obtenerRespuesta('Procedure', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- EXPIRE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->expire();
$respTest = obtenerRespuesta('Procedure', 'EXPIRE', 'ACCION', 'La cumplimentación no existe',
    'IMPPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '3');
$proc_service = new Procedure_Service();
$feedback = $proc_service->expire();
$respTest = obtenerRespuesta('Procedure', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Cumplimentación expirada Ok
$_POST = array('cumplimentacion_id' => $proc_build_id);
$proc_service = new Procedure_Service();
$feedback = $proc_service->expire();
$respTest = obtenerRespuesta('Procedure', 'EXPIRE', 'ACCION', 'Cumplimentación expirada Ok',
    'IMPPROC_EXPIRE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->DELETE();
$respTest = obtenerRespuesta('Procedure', 'DELETE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->DELETE();
$respTest = obtenerRespuesta('Procedure', 'DELETE', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- DELETE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->DELETE();
$respTest = obtenerRespuesta('Procedure', 'DELETE', 'ACCION', 'La cumplimentación no existe',
    'IMPPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('cumplimentacion_id' => '3');
$proc_service = new Procedure_Service();
$feedback = $proc_service->DELETE();
$respTest = obtenerRespuesta('Procedure', 'DELETE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// La cumplimentación a eliminar es la única cumplimentación del procedimiento en el edificio
$_POST = array('cumplimentacion_id' => '1');
$proc_service = new Procedure_Service();
$feedback = $proc_service->DELETE();
$respTest = obtenerRespuesta('Procedure', 'DELETE', 'ACCION', 'La cumplimentación a eliminar es la única cumplimentación del procedimiento en el edificio',
    'IMPPROC_UNIQ', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Cumplimentación eliminada Ok
$_POST = array('cumplimentacion_id' => $proc_build_id);
$proc_service = new Procedure_Service();
$feedback = $proc_service->DELETE();
$respTest = obtenerRespuesta('Procedure', 'DELETE', 'ACCION', 'Cumplimentación eliminada Ok',
    'IMPPROC_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK_PORTAL_IMPPROC: VALIDACIONES ---
 */

// ID Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalImpProc();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_IMPPROC', 'CUMPLIMENTACION_ID', 'ID Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalImpProc();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_IMPPROC', 'CUMPLIMENTACION_ID', 'ID Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- SEEK_PORTAL_IMPPROC: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalImpProc();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_IMPPROC', 'ACCION', 'La cumplimentación no existe',
    'IMPPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// La cumplimentación está vencida
$_POST = array('cumplimentacion_id' => '2');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalImpProc();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_IMPPROC', 'ACCION', 'La cumplimentación está vencida',
    'IMPPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Consulta de la cumplimentaciónd el portal Ok
$_POST = array('cumplimentacion_id' => '3');
$proc_service = new Procedure_Service();
$feedback = $proc_service->seekPortalImpProc();
$respTest = obtenerRespuesta('Procedure', 'SEEK_PORTAL_IMPPROC', 'ACCION', 'Consulta de la cumplimentaciónd el portal Ok',
    'PRTL_IMPPROC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


//------------------------------------------------------------------------------
//Fin test Procedimientos
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Procedimientos'] = $testProcedure;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;