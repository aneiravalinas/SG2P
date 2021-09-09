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
 *  --- SEARCH_IMPPROCS: VALIDACIONES (Procedimiento) ---
 */

// ID Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'PROCEDIMIENTO_ID', 'ID de procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'PROCEDIMIENTO_ID', 'ID de procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_IMPPROCS: ACCIONES (Procedimiento) ---
 */

// El procedimiento no existe
$_POST = array('procedimiento_id' => '1111111111111111111');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'ACCION', 'El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


/*
 *  --- SEARCH_IMPPROCS: VALIDACIONES ---
 */

// ID de Cumplimentación no numérico
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => 'aaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'EDIFICIO_PROCEDIMIENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Estado no permitido
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'estado');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'ESTADO', 'Estado no permitido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha de cumplimentación no válida
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'FECHA_CUMPLIMENTACION', 'Fecha de cumplimentación no válida',
    'DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre DOC largo (más de 50 caracteres)
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
                    'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'NOMBRE_DOC', 'Nombre de Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre DOC formato
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'documento.php');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'NOMBRE_DOC', 'Nombre de Documento con formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// ID Edificio no numérico
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => 'aaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre Edificio corto (menos de 3 caracteres)
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'aa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'NOMBRE_EDIFICIO', 'Nombre Edificio corto',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre de Edificio formato incorrecto
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'edific^o');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

/*
 *  --- SEARCH_IMPPROCS: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('procedimiento_id' => '1', 'edificio_procedimiento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'documento.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'edificio');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchImpProcs();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_IMPPROCS', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
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
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'edificio_procedimiento_id' => 'aaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'IMPPROC_ID_NOT_NUMERIC', 'ID de Cumplimentación no numérico',
    'IMPPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Estado no contemplado
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'edificio_procedimiento_id' => '2', 'estado' => 'estado');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'IMPPROC_ID_NOT_NUMERIC', 'Estado no contemplado',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Fecha Cumplimentación no válida
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'edificio_procedimiento_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion' => '2012-12/25');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'IMPPROC_ID_NOT_NUMERIC', 'Fecha Cumplimentación no válida',
    'DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


// Nombre DOC largo (más de 50 caracteres)
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'edificio_procedimiento_id' => '2', 'estado' => 'vencido', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'NOMBRE_DOC', 'Nombre de Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);

// Nombre DOC formato
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'edificio_procedimiento_id' => '2', 'estado' => 'vencido',
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
$_POST = array('procedimiento_id' => '4', 'edificio_id' => '7', 'edificio_procedimiento_id' => '2', 'estado' => 'vencido',
    'nombre_doc' => 'documento.pdf');
$proc_service = new Procedure_Service();
$feedback = $proc_service->searchProcedure();
$respTest = obtenerRespuesta('Procedure', 'SEARCH_PROCEDURE', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPPROC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testProcedure, $respTest);


//------------------------------------------------------------------------------
//Fin test Procedimientos
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Procedimientos'] = $testProcedure;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;