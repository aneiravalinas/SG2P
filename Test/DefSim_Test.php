<?php

include_once './Service/DefSim_Service.php';
$testDefSim = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEARCH: VALIDACIONES (Plan) ---
 */

// ID de Plan vacío
$_POST = array('plan_id' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// ID de Plan no numérico
$_POST = array('plan_id' => 'aaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- SEARCH: ACCION (Plan) ---
 */

// El Plan no existe
$_POST = array('plan_id' => '111111');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID Simulacro no numérico
$_POST = array('plan_id' => '1', 'simulacro_id' => 'aa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','SIMULACRO_ID','ID del simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Nombre largo (más de 60 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','NOMBRE','Nombre del simulacro largo',
    'DEFNAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Nombre con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'nombr^');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','NOMBRE','Nombre del simulacro con caracteres no permitidos',
    'DEFNAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de simulacros Ok
$_POST = array('plan_id' => '1', 'nombre' => 'nombre');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->SEARCH();
$respTest = obtenerRespuesta('DefSim','SEARCH','NOMBRE','Búsqueda de simulacros Ok',
    'DFSIM_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);


/*
 *  --- ADD: VALIDACIONES (Plan) ---
 */

// ID de Plan vacío
$_POST = array('plan_id' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// ID de Plan no numérico
$_POST = array('plan_id' => 'aaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- ADD: ACCIONES (Plan) ---
 */

// El Plan no existe
$_POST = array('plan_id' => '111111');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);


/*
 *  --- ADD: VALIDACIONES ---
 */


// Nombre corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','NOMBRE','Nombre del simulacro corto',
    'DEFNAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Nombre largo (más de 60 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','NOMBRE','Nombre del simulacro largo',
    'DEFNAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Nombre con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'nombr^');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','NOMBRE','Nombre del simulacro con caracteres no permitidos',
    'DEFNAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Descripción vacía
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre Simulacro', 'descripcion' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre Simulacro', 'descripcion' => 'Descripci^n');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe un simulacro con el nombre indicando en el plan
$_POST = array('plan_id' => '6', 'nombre' => 'Simulacros del plan con simulacros', 'descripcion' => 'Descripcion');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','ACCION','Ya existe una definición de simulacro con el nombre indicado en el plan',
    'DFSIM_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Def. de Simulacro añadido Ok
$_POST = array('plan_id' => '6', 'nombre' => 'Simulacro Test', 'descripcion' => 'Descripcion');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->ADD();
$respTest = obtenerRespuesta('DefSim','ADD','ACCION','Ya existe una definición de simulacro con el nombre indicado en el plan',
    'DFSIM_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

if($feedback['ok']) {
    $simulacro_id = $defSim_service->defSim_entity->simulacro_id;
} else {
    $simulacro_id = '';
}


/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Simulacro vacío
$_POST = array('simulacro_id' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->DELETE();
$respTest = obtenerRespuesta('DefSim','DELETE','SIMULACRO_ID','ID del Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// ID de Simulacro no numérico
$_POST = array('simulacro_id' => 'aaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->DELETE();
$respTest = obtenerRespuesta('DefSim','DELETE','SIMULACRO_ID','ID del Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El Simulacro no existe
$_POST = array('simulacro_id' => '111111');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->DELETE();
$respTest = obtenerRespuesta('DefSim','DELETE','ACCION','El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// La def. del simulacro tiene implementaciones en edificios
$_POST = array('simulacro_id' => '1');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->DELETE();
$respTest = obtenerRespuesta('DefSim','DELETE','ACCION','Simulacro con implementaciones en edificios',
    'DFSIM_IMPL_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Simulacro eliminado OK
$_POST = array('simulacro_id' => $simulacro_id);
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->DELETE();
$respTest = obtenerRespuesta('DefSim','DELETE','ACCION','Simulacro eliminado Ok',
    'DFSIM_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- EDIT: VALIDACIONES (Simulacro) ---
 */

// ID de Simulacro vacío
$_POST = array('simulacro_id' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','SIMULACRO_ID','ID del Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// ID de Simulacro no numérico
$_POST = array('simulacro_id' => 'aaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','SIMULACRO_ID','ID del Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- EDIT: ACCIONES (Simulacro) ---
 */

// El Simulacro no existe
$_POST = array('simulacro_id' => '111111');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','ACCION','El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Nombre corto (menos de 5 caracteres)
$_POST = array('simulacro_id' => '1', 'nombre' => 'aa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','NOMBRE','Nombre del simulacro corto',
    'DEFNAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Nombre largo (más de 60 caracteres)
$_POST = array('simulacro_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','NOMBRE','Nombre del simulacro largo',
    'DEFNAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Nombre con caracteres no permitidos
$_POST = array('simulacro_id' => '1', 'nombre' => 'nombr^');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','NOMBRE','Nombre del simulacro con caracteres no permitidos',
    'DEFNAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Descripción vacía
$_POST = array('simulacro_id' => '1', 'nombre' => 'Nombre Simulacro', 'descripcion' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('simulacro_id' => '1', 'nombre' => 'Nombre Simulacro', 'descripcion' => 'Descripci^n');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);


/*
 *  --- EDIT: ACCIONES ---
 */

// Ya existe una definición de simulacro con el nombre indicado en el plan
$_POST = array('simulacro_id' => '1', 'nombre' => 'Otro Simulacro', 'descripcion' => 'Descripcion');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','ACCION','Ya existe una definición de simulacro con el nombre indicado en el plan',
    'DFSIM_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Simulacro modificado Ok
$_POST = array('simulacro_id' => '1', 'nombre' => 'Simulacro Edit Test', 'descripcion' => 'Descripcion Test.');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->EDIT();
$respTest = obtenerRespuesta('DefSim','EDIT','ACCION','Simulacro editado Ok',
    'DFSIM_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

if($feedback['ok']) {
    $_POST = array('simulacro_id' => '1', 'nombre' => 'Simulacros del plan con simulacros', 'descripcion' => 'Descripcion del simulacro');
    $defSim_service = new DefSim_Service();
    $feedback = $defSim_service->EDIT();
}

/*
 *  --- SEEK_PLAN: VALIDACIONES ---
 */

// ID de Plan vacío
$_POST = array('plan_id' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seekPlan();
$respTest = obtenerRespuesta('DefSim','SEEK_PLAN','ACCION','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// ID de Plan no numérico
$_POST = array('plan_id' => 'aaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seekPlan();
$respTest = obtenerRespuesta('DefSim','SEEK_PLAN','ACCION','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- SEEK_PLAN: ACCIONES ---
 */

// El Plan no existe
$_POST = array('plan_id' => '111111');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seekPlan();
$respTest = obtenerRespuesta('DefSim','SEEK_PLAN','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// El plan existe
$_POST = array('plan_id' => '1');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seekPlan();
$respTest = obtenerRespuesta('DefSim','SEEK_PLAN','ACCION','El plan existe',
    'DFPLANID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Simulacro vacío
$_POST = array('simulacro_id' => '');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seek();
$respTest = obtenerRespuesta('DefSim','SEEK','SIMULACRO_ID','ID del Simulacro vacío',
    'DFSIM_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// ID de Simulacro no numérico
$_POST = array('simulacro_id' => 'aaaa');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seek();
$respTest = obtenerRespuesta('DefSim','SEEK','SIMULACRO_ID','ID del Simulacro no numérico',
    'DFSIM_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El Simulacro no existe
$_POST = array('simulacro_id' => '111111');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seek();
$respTest = obtenerRespuesta('DefSim','SEEK','ACCION','El simulacro no existe',
    'DFSIMID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

// Consulta de Simulacro Ok
$_POST = array('simulacro_id' => '1');
$defSim_service = new DefSim_Service();
$feedback = $defSim_service->seek();
$respTest = obtenerRespuesta('DefSim','SEEK','ACCION','Consulta del simulacro Ok',
    'DFSIM_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefSim, $respTest);

//------------------------------------------------------------------------------
//Fin test Definición de Simulacros
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Def_Simulacrum'] = $testDefSim;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;