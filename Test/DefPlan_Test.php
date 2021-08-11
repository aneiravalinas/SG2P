<?php

include_once './Service/DefPlan_Service.php';
$testDefPlan = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// Plan ID no numérico
$_POST = array('plan_id' => 'aaa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->SEARCH();
$respTest = obtenerRespuesta('DefPlan','SEARCH','PLAN_ID','El id del plan debe ser numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre Plan corto (menos de 5 caracteres)
$_POST = array('nombre' => 'aa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->SEARCH();
$respTest = obtenerRespuesta('DefPlan','SEARCH','NOMBRE','Nombre del plan corto',
    'DFPLAN_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre Plan largo (más de 60 caracteres)
$_POST = array('nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->SEARCH();
$respTest = obtenerRespuesta('DefPlan','SEARCH','NOMBRE','Nombre del plan largo',
    'DEFPLAN_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre del Plan con caracteres no permitidos
$_POST = array('nombre' => 'Nombre del Pl^n');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->SEARCH();
$respTest = obtenerRespuesta('DefPlan','SEARCH','NOMBRE','Nombre del caracteres no permitidos',
    'DEFPLAN_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);


/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de planes Ok
$_POST = array('nombre' => 'Plan Uno');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->SEARCH();
$respTest = obtenerRespuesta('DefPlan','SEARCH','ACCION','Búsqueda de planes Ok',
    'DFPLAN_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

/*
 *  --- ADD: VALIDACIONES ---
 */

// Nombre Plan corto (menos de 5 caracteres)
$_POST = array('nombre' => 'aa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','NOMBRE','Nombre del plan corto',
    'DFPLAN_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre Plan largo (más de 60 caracteres)
$_POST = array('nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','NOMBRE','Nombre del plan largo',
    'DEFPLAN_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre del Plan con caracteres no permitidos
$_POST = array('nombre' => 'Nombre del Pl^n');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','NOMBRE','Nombre del caracteres no permitidos',
    'DEFPLAN_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Descripción vacía
$_POST = array('nombre' => 'Nombre genérico de pruebas', 'descripcion' => '');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('nombre' => 'Nombre genérico de pruebas', 'descripcion' => 'Descripción con caracteres no permitid+s');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);


/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe un plan con el nombre indicado
$_POST = array('nombre' => 'Plan Uno', 'descripcion' => 'Descripción del plan.');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','ACCION','Ya existe una definición de plan con ese nombre',
    'DFPLAN_NAM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan añadido corretamente
$_POST = array('nombre' => 'Plan Test', 'descripcion' => 'Descripción del plan.');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->ADD();
$respTest = obtenerRespuesta('DefPlan','ADD','ACCION','Plan añadido correctamente',
    'DFPLAN_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

if($feedback['ok']) {
    $plan_id = $defPlan_service->defPlan_entity->plan_id;
} else {
    $plan_id = '';
}

/*
 *  --- DELETE: VALIDACIONES ---
 */

// Plan ID vacío
$_POST = array('plan_id' => '');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','PLAN_ID','ID de Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan ID no numérico
$_POST = array('plan_id' => 'aa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','PLAN_ID','ID de Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '1111');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan asignado a edificios
$_POST = array('plan_id' => '1');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan tiene edificios asignados',
    'DFPLAN_BLD_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan asignado a documentos
$_POST = array('plan_id' => '2');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan tiene def. de documentos asignadas',
    'DFPLAN_DOC_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan asignado a procedimientos
$_POST = array('plan_id' => '3');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan tiene def. de procedimientos asignadas',
    'DFPLAN_PROC_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan asignado a rutas
$_POST = array('plan_id' => '4');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan tiene def. de rutas asignadas',
    'DFPLAN_ROUTE_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan asignado a formaciones
$_POST = array('plan_id' => '5');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan tiene def. de formaciones asignadas',
    'DFPLAN_FRMT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan asignado a simulacros
$_POST = array('plan_id' => '6');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','El Plan tiene def. de simulacros asignadas',
    'DFPLAN_SIM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan eliminado Ok
$_POST = array('plan_id' => $plan_id);
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->DELETE();
$respTest = obtenerRespuesta('DefPlan','DELETE','ACCION','Plan eliminado Ok',
    'DFPLAN_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Plan ID vacío
$_POST = array('plan_id' => '');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','PLAN_ID','ID de Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan ID no numérico
$_POST = array('plan_id' => 'aa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','PLAN_ID','ID de Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre Plan corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','NOMBRE','Nombre del plan corto',
    'DFPLAN_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre Plan largo (más de 60 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','NOMBRE','Nombre del plan largo',
    'DEFPLAN_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Nombre del Plan con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre del Pl^n');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','NOMBRE','Nombre del caracteres no permitidos',
    'DEFPLAN_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Descripción vacía
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre genérico de pruebas', 'descripcion' => '');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre genérico de pruebas', 'descripcion' => 'Descripción con caracteres no permitid+s');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

/*
 *  --- EDIT: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '1111', 'nombre' => 'Plan Uno', 'descripcion' => 'Descripción del plan.');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','ACCION','El Plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Ya existe un plan con el nombre indicado
$_POST = array('plan_id' => '2', 'nombre' => 'Plan Uno', 'descripcion' => 'Descripción del plan.');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','ACCION','Ya existe una definición de plan con ese nombre',
    'DFPLAN_NAM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan editado Ok
$_POST = array('plan_id' => '1', 'nombre' => 'Plan Uno Test', 'descripcion' => 'Descripción del plan.');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->EDIT();
$respTest = obtenerRespuesta('DefPlan','EDIT','ACCION','Def del plan modificado Ok',
    'DFPLAN_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

if($feedback['ok']) {
    $_POST = array('plan_id' => '1', 'nombre' => 'Plan Uno', 'descripcion' => 'Descripción del plan.');
    $defPlan_service = new DefPlan_Service();
    $feedback = $defPlan_service->EDIT();
}


/*
 *  --- SEEK: VALIDACIONES ---
 */

// Plan ID vacío
$_POST = array('plan_id' => '');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->seek();
$respTest = obtenerRespuesta('DefPlan','SEEK','PLAN_ID','ID de Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Plan ID no numérico
$_POST = array('plan_id' => 'aa');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->seek();
$respTest = obtenerRespuesta('DefPlan','SEEK','PLAN_ID','ID de Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '1111');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->seek();
$respTest = obtenerRespuesta('DefPlan','SEEK','ACCION','El Plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);

// Consulta de los detalles del plan Ok
$_POST = array('plan_id' => '1');
$defPlan_service = new DefPlan_Service();
$feedback = $defPlan_service->seek();
$respTest = obtenerRespuesta('DefPlan','SEEK','ACCION','Consulta de los detalles de la def. del plan Ok',
    'DFPLAN_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefPlan, $respTest);


//------------------------------------------------------------------------------
//Fin test Definición de Planes
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Def_Plan'] = $testDefPlan;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;
