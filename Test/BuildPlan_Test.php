<?php

include_once './Service/BuildPlan_Service.php';
$testBuildPlan = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH: VALIDACIONES (Plan) ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEARCH: ACCIONES (Plan) ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID Edificio no numérico
$_POST = array('plan_id' => '1', 'edificio_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
    $respTest = obtenerRespuesta('BuildPlan','SEARCH','EDIFICIO_ID','ID del edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Estado no válido
$_POST = array('plan_id' => '1', 'edificio_id' => '1', 'estado' => 'randomword');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','ESTADO','Estado no permitido',
    'BLDPLAN_STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('plan_id' => '1', 'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','NOMBRE_EDIFICIO','Nombre Edificio largo',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Nombre Edificio Formato
$_POST = array('plan_id' => '1', 'nombre_edificio' => 'edifici^+');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','NOMBRE_EDIFICIO','Nombre Edificio con caracteres no permitidos',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Fecha Asignación Inicial no válida
$_POST = array('plan_id' => '1', 'fecha_asignacion_inicio' => '2012/12-25');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','FECHA_ASIGNACION_INICIO','Fecha Asignación Inicial no válida',
    'START_DATEASSIGN_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Fecha Asignación Final no válida
$_POST = array('plan_id' => '1', 'fecha_asignacion_fin' => '2012/12-25');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','FECHA_ASIGNACION_FIN','Fecha Asignación Final no válida',
    'END_DATEASSIGN_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Fecha Cumplimentación Inicial no válida
$_POST = array('plan_id' => '1', 'fecha_cumplimentacion_inicio' => '2012/12-25');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','FECHA_CUMPLIMENTACION_INICIO','Fecha Cumplimentación Inicial no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Fecha Cumplimentación Final no válida
$_POST = array('plan_id' => '1', 'fecha_cumplimentacion_fin' => '2012/12-25');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','FECHA_CUMPLIMENTACION_FIN','Fecha Cumplimentación Final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Fecha Vencimiento Inicial no válida
$_POST = array('plan_id' => '1', 'fecha_vencimiento_inicio' => '2012/12-25');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','FECHA_VENCIMIENTO_INICIO','Fecha Vencimiento Inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Fecha Vencimiento Final no válida
$_POST = array('plan_id' => '1', 'fecha_vencimiento_fin' => '2012/12-25');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','FECHA_VENCIMIENTO_FIN','Fecha Vencimiento Final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);


/*
 *  --- SEARCH: ACCION ---
 */

// Búsqueda de edificios asignados Ok
$_POST = array('plan_id' => '1', 'edificio_id' => '1', 'fecha_asignacion' => '2012/12/25', 'fecha_cumplimentacion' => '2012/12/30', 'estado' => 'pendiente');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->SEARCH();
$respTest = obtenerRespuesta('BuildPlan','SEARCH','ACCION','Búsqueda de edifcios asignados Ok',
    'BLDPLAN_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- ADD_FORM: VALIDACIONES (Plan) ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->addForm();
$respTest = obtenerRespuesta('BuildPlan','ADD_FORM','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->addForm();
$respTest = obtenerRespuesta('BuildPlan','ADD_FORM','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- ADD_FORM: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->addForm();
$respTest = obtenerRespuesta('BuildPlan','ADD_FORM','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// No hay edificios asignables al plan
$_POST = array('plan_id' => '9');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->addForm();
$respTest = obtenerRespuesta('BuildPlan','ADD_FORM','ACCION','No hay edificios asignables al Plan',
    'BLDPLAN_CANDIDATES_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Hay edificios asignables al plan
$_POST = array('plan_id' => '7');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->addForm();
$respTest = obtenerRespuesta('BuildPlan','ADD_FORM','ACCION','Hay edificios asignables al Plan',
    'BLDPLAN_CANDIDATES_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- MULTIPLE_ADD: VALIDACIONES (Plan) ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- MULTIPLE_ADD: ACCIONES (Plan) ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// El plan no tiene definiciones de Documentos
$_POST = array('plan_id' => '8');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','ACCION','El plan tiene definiciones de documentos asociadas',
    'DFPLAN_ADD_NOT_DOCS', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- MULTIPLE_ADD: VALIDACIONES  ---
 */

// IDs Edificios vacío
$_POST = array('plan_id' => '7', 'buildings' => array());
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','EDIFICIOS_ID','IDs Edificios vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// IDs Edificio no numérico
$_POST = array('plan_id' => '7', 'buildings' => array('1', '2', 'aa'));
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','EDIFICIOS_ID','IDs Edificios no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- MULTIPLE_ADD: ACCIONES  ---
 */

// Algún edificio no existe
$_POST = array('plan_id' => '7', 'buildings' => array('1', '111111111'));
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Edificio ya asignado
$_POST = array('plan_id' => '1', 'buildings' => array('1', '2'));
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','ACCION','Plan ya asignado al edificio',
    'BLDPLAN_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Plan con definiciones de rutas se intenta asignar a edificio sin plantas
$_POST = array('plan_id' => '7', 'buildings' => array('1', '2'));
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','ACCION','Plan con def. de rutas, edificio sin plantas',
    'DFROUTE_EXST_FLRS_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Asignación de Plan a Edificio OK
$_POST = array('plan_id' => '7', 'buildings' => array('1', '5'));
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->multipleADD();
$respTest = obtenerRespuesta('BuildPlan','MULTIPLE_ADD','ACCION','Asignaciones del Plan a los Edificios OK',
    'BLDPLAN_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);


/*
 *  --- SEEK: VALIDACIONES (Plan)  ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEEK: ACCIONES (Plan)  ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEEK: VALIDACIONES (Edificio)  ---
 */

// ID Edificio vacío
$_POST = array('plan_id' => '1', 'edificio_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','EDIFICIO_ID','ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Edificio no numérico
$_POST = array('plan_id' => '1', 'edificio_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','EDIFICIO_ID','ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEEK: ACCIONES (Edificio)  ---
 */

// El edificio no existe
$_POST = array('plan_id' => '1', 'edificio_id' => '111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// Usuario no es responsable del edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped';

$_POST = array('plan_id' => '1', 'edificio_id' => '2');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','ACCION','Usuario no es responsable del edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Edificio y Plan no están asociados
$_SESSION['rol'] = 'organizacion';

$_POST = array('plan_id' => '8', 'edificio_id' => '1');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','ACCION','El plan no está asignado al edificio',
    'BLDPLAN_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);


// Edificio y Plan asignados
$_POST = array('plan_id' => '1', 'edificio_id' => '2');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seek();
$respTest = obtenerRespuesta('BuildPlan','SEEK','ACCION','Plan asignado al Edificio',
    'BLDPLAN_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

unset($_SESSION['rol'], $_SESSION['username']);

/*
 *  --- SEEK_PLAN: VALIDACIONES ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seekPlan();
$respTest = obtenerRespuesta('BuildPlan','SEEK_PLAN','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seekPlan();
$respTest = obtenerRespuesta('BuildPlan','SEEK_PLAN','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- SEEK_PLAN: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seekPlan();
$respTest = obtenerRespuesta('BuildPlan','SEEK_PLAN','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// El plan existe
$_POST = array('plan_id' => '1');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->seekPlan();
$respTest = obtenerRespuesta('BuildPlan','SEEK_PLAN','ACCION','El plan existe',
    'DFPLANID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- EXPIRE: VALIDACIONES (Plan) ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- EXPIRE: ACCIONES (Plan)  ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- EXPIRE: VALIDACIONES (Edificio) ---
 */

// ID Edificio vacío
$_POST = array('plan_id' => '1', 'edificio_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','EDIFICIO_ID','ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Edificio no numérico
$_POST = array('plan_id' => '1', 'edificio_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','EDIFICIO_ID','ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- EXPIRE: ACCIONES (Edificio) ---
 */

// El edificio no existe
$_POST = array('plan_id' => '1', 'edificio_id' => '111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- EXPIRE: ACCIONES ---
 */

// Usuario no es responsable del edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped';

$_POST = array('plan_id' => '1', 'edificio_id' => '2');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','ACCION','Usuario no es responsable del edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Edificio y Plan no están asociados
$_SESSION['rol'] = 'organizacion';

$_POST = array('plan_id' => '8', 'edificio_id' => '1');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','ACCION','El plan no está asignado al edificio',
    'BLDPLAN_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);


// Asignación ya vencida
$_POST = array('plan_id' => '9', 'edificio_id' => '1');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','ACCION','La asignación ya se encuentra vencida',
    'BLDPLAN_ALREADY_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Asignación vencida OK
$_POST = array('plan_id' => '7', 'edificio_id' => '5');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expire();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE','ACCION','Asignación vencida OK',
    'BLDPLAN_EDTSTATE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);
unset($_SESSION['rol'], $_SESSION['username']);

/*
 *  --- EXPIRE_ALL: VALIDACIONES ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expireAll();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE_ALL','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expireAll();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE_ALL','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- EXPIRE_ALL: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expireAll();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE_ALL','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// El plan no tiene asignaciones activas
$_POST = array('plan_id' => '9');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expireAll();
$respTest = obtenerRespuesta('BuildPlan','EXPIRE_ALL','ACCION','El plan no asignaciones activas',
    'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);


// Asignación vencidas OK
$_POST = array('plan_id' => '7');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->expireAll();
$respTest = obtenerRespuesta('BuildPlan','EDIT','ACCION','Asignaciones vencidas OK',
    'BLDPLAN_EDTSTATE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- DELETE: VALIDACIONES (Plan) ---
 */

// ID Plan vacío
$_POST = array('plan_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- DELETE: ACCIONES (Plan)  ---
 */

// El Plan no existe
$_POST = array('plan_id' => '11111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- DELETE: VALIDACIONES (Edificio)  ---
 */

// ID Edificio vacío
$_POST = array('plan_id' => '1', 'edificio_id' => '');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','EDIFICIO_ID','ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// ID Edificio no numérico
$_POST = array('plan_id' => '1', 'edificio_id' => 'aaa');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','EDIFICIO_ID','ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El edificio no existe
$_POST = array('plan_id' => '1', 'edificio_id' => '111111');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Usuario no es responsable del edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped';

$_POST = array('plan_id' => '1', 'edificio_id' => '2');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','ACCION','Usuario no es responsable del edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Edificio y Plan no están asociados
$_SESSION['rol'] = 'organizacion';

$_POST = array('plan_id' => '8', 'edificio_id' => '1');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','ACCION','El plan no está asignado al edificio',
    'BLDPLAN_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Asignación Eliminada OK
$_POST = array('plan_id' => '7', 'edificio_id' => '1');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
$respTest = obtenerRespuesta('BuildPlan','DELETE','ACCION','Asignación eliminada correctamente',
    'BLDPLAN_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testBuildPlan, $respTest);

// Eliminando instancias restantes...
$_POST = array('plan_id' => '7', 'edificio_id' => '5');
$buildPlan_service = new BuildPlan_Service();
$feedback = $buildPlan_service->DELETE();
unset($_SESSION['rol'], $_SESSION['username']);

//------------------------------------------------------------------------------
//Fin test Asignación de Edificios
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Build_Plan'] = $testBuildPlan;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;