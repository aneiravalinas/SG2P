<?php

include_once './Service/Plan_Service.php';
$testPlan = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID Edificio no numérico
$_POST = array('edificio_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','EDIFICIO_ID','ID del edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Estado no válido
$_POST = array('estado' => 'randomword');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','ESTADO','Estado no permitido',
    'BLDPLAN_STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','NOMBRE_EDIFICIO','Nombre Edificio largo',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Nombre Edificio Formato
$_POST = array('plan_id' => '1', 'nombre_edificio' => 'edifici^+');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','NOMBRE_EDIFICIO','Nombre Edificio con caracteres no permitidos',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// ID Plan no numérico
$_POST = array('plan_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Nombre de Plan largo (más de 60 caracteres)
$_POST = array('nombre_plan' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','NOMBRE_PLAN','Nombre de Plan corto',
    'DEFPLAN_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Nombre de Plan con caracteres no permitidos
$_POST = array('nombre_plan' => 'NOmbre de pl^n');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','NOMBRE_PLAN','Nombre de Plan con caracteres no permitidos',
    'DEFPLAN_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Fecha asignacion inicial no válida
$_POST = array('fecha_asignacion_inicio' => '2018-12/25');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','FECHA_ASIGNACION_INICIO','Fecha asignacion inicial no válida',
    'START_DATEASSIGN_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Fecha asignacion final no válida
$_POST = array('fecha_asignacion_fin' => '2018-12/25');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','FECHA_ASIGNACION_FIN','Fecha asignacion final no válida',
    'END_DATEASSIGN_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Fecha Cumplimentación inicial no válida
$_POST = array('fecha_cumplimentacion_inicio' => '2018-12/25');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','FECHA_CUMPLIMENTACION_INICIO','Fecha Cumplimentación inicial no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Fecha Cumplimentación final no válida
$_POST = array('fecha_cumplimentacion_fin' => '2018-12/25');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','FECHA_CUMPLIMENTACION_FIN','Fecha Cumplimentación final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Fecha Vencimiento Inicial no válida
$_POST = array('fecha_vencimiento_inicio' => '2018-12/25');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','FECHA_VENCIMIENTO_INICIO','Fecha Vencimiento Inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Fecha Vencimiento Final no válida
$_POST = array('fecha_vencimiento_fin' => '2018-12/25');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','FECHA_VENCIMIENTO_FIN','Fecha Vencimiento Final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */


// Búsqueda de Planes Ok
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped2';

$_POST = array('nombre_plan' => 'Plan Uno');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Plan','SEARCH','ACCION','Búsqueda de Planes Ok',
    'PLAN_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

/*
 *  --- SEARCH_PORTAL_PLANS: VALIDACIONES ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$plan_service = new Plan_Service();
$feedback = $plan_service->searchPortalPlans();
$respTest = obtenerRespuesta('Portal','SEARCH_PORTAL_PLANS','EDIFICIO_ID','ID del edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->searchPortalPlans();
$respTest = obtenerRespuesta('Portal','SEARCH_PORTAL_PLANS','EDIFICIO_ID','ID del edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Nombre de Plan largo (más de 60 caracteres)
$_POST = array('edificio_id' => '1', 'nombre_plan' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Portal','SEARCH_PORTAL_PLANS','NOMBRE_PLAN','Nombre de Plan corto',
    'DEFPLAN_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Nombre de Plan con caracteres no permitidos
$_POST = array('edificio_id' => '1', 'nombre_plan' => 'NOmbre de pl^n');
$plan_service = new Plan_Service();
$feedback = $plan_service->SEARCH();
$respTest = obtenerRespuesta('Portal','SEARCH_PORTAL_PLANS','NOMBRE_PLAN','Nombre de Plan con caracteres no permitidos',
    'DEFPLAN_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);


/*
 *  --- SEARCH_PORTAL_PLANS: ACCIONES ---
 */

// El edificio no existe
$_POST = array('edificio_id' => '1111111111111111111');
$plan_service = new Plan_Service();
$feedback = $plan_service->searchPortalPlans();
$respTest = obtenerRespuesta('Portal','SEARCH_PORTAL_PLANS','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Búsqueda Ok
$_POST = array('edificio_id' => '1');
$plan_service = new Plan_Service();
$feedback = $plan_service->searchPortalPlans();
$respTest = obtenerRespuesta('Plan','SEARCH_PORTAL_PLANS','ACCION','Búsqueda de Planes Ok',
    'PRTL_PLANS_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','EDIFICIO_ID','ID del edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','EDIFICIO_ID','ID del edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);


// ID Plan vacío
$_POST = array('edificio_id' => '1', 'plan_id' => '');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// ID Plan no numérico
$_POST = array('edificio_id' => '1', 'plan_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Plan','SEEK','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// El edificio no existe
$_POST = array('edificio_id' => '1111111111111111111', 'plan_id' => '1');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// El usuario no tiene permisos para consultar planes en el edificio
$_POST = array('edificio_id' => '1', 'plan_id' => '1');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','ACCION','El usuario no tiene permisos para consultar planes en el edificio',
    'PLAN_SEEK_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// El plan no existe
$_POST = array('edificio_id' => '2', 'plan_id' => '1111111111111111111');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// El edificio no tiene el plan asignado
$_POST = array('edificio_id' => '2', 'plan_id' => '8');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','ACCION','El edificio no tiene el plan asignado',
    'BLDPLAN_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Consulta del Plan Ok
$_POST = array('edificio_id' => '2', 'plan_id' => '1');
$plan_service = new Plan_Service();
$feedback = $plan_service->seek();
$respTest = obtenerRespuesta('Portal','SEEK','ACCION','Consulta del Plan Ok',
    'PLAN_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

/*
 *  --- SEEK_PORTAL_PLAN: VALIDACIONES ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','EDIFICIO_ID','ID del edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','EDIFICIO_ID','ID del edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);


// ID Plan vacío
$_POST = array('edificio_id' => '1', 'plan_id' => '');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// ID Plan no numérico
$_POST = array('edificio_id' => '1', 'plan_id' => 'aaa');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Plan','SEEK_PORTAL_PLAN','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

/*
 *  --- SEEK_PORTAL_PLAN: ACCIONES ---
 */

// El edificio no existe
$_POST = array('edificio_id' => '1111111111111111111', 'plan_id' => '1');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','ACCION','El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// El plan no existe
$_POST = array('edificio_id' => '2', 'plan_id' => '1111111111111111111');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// El edificio no tiene el plan asignado
$_POST = array('edificio_id' => '2', 'plan_id' => '8');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','ACCION','El edificio no tiene el plan asignado',
    'BLDPLAN_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

// Consulta del Plan Ok
$_POST = array('edificio_id' => '2', 'plan_id' => '1');
$plan_service = new Plan_Service();
$feedback = $plan_service->seekPortalPlan();
$respTest = obtenerRespuesta('Portal','SEEK_PORTAL_PLAN','ACCION','Consulta del Plan Ok',
    'PLAN_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlan, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

//------------------------------------------------------------------------------
//Fin test Planes
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Plan'] = $testPlan;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;