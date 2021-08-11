<?php

include_once './Service/DefProc_Service.php';
$testDefProc = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEARCH: VALIDACIONES (Plan) ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

/*
 *  --- SEARCH: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '1111');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID del Procedimiento no numérico
$_POST = array('plan_id' => '1', 'procedimiento_id' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','PROC_ID','El ID del Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','NOMBRE','Nombre del procedimiento corto',
    'DFPROC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento largo (más de 50 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','NOMBRE','Nombre del procedimiento largo',
    'DFPROC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre del Proc^edimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','NOMBRE','Nombre del procedimiento con caracteres no permitidos',
    'DFPROC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de Procedimientos Ok
$_POST = array('plan_id' => '1', 'procedimiento_id' => '', 'nombre' => 'Procedimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->SEARCH();
$respTest = obtenerRespuesta('DefProc','SEARCH','ACCION','Búsqueda de procedimientos Ok',
    'DFPROC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- EMPTY_FORM: VALIDACIONES ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->emptyForm();
$respTest = obtenerRespuesta('DefProc','EMPTY_FORM','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->emptyForm();
$respTest = obtenerRespuesta('DefProc','EMPTY_FORM','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// El plan no existe
$_POST = array('plan_id' => '1111');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->emptyForm();
$respTest = obtenerRespuesta('DefProc','EMPTY_FORM','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// El plan existe
$_POST = array('plan_id' => '1');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->emptyForm();
$respTest = obtenerRespuesta('DefProc','EMPTY_FORM','ACCION','El plan existe',
    'DFPLANID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- ADD: VALIDACIONES (Plan) ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

/*
 *  --- ADD: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '1111');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- ADD: VALIDACIONES  ---
 */

// Nombre del procedimiento corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','NOMBRE','Nombre del procedimiento corto',
    'DFPROC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento largo (más de 50 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','NOMBRE','Nombre del procedimiento largo',
    'DFPROC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre del Proc^edimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','NOMBRE','Nombre del procedimiento con caracteres no permitidos',
    'DFPROC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Descripción vacía
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre del Procedimiento', 'descripcion' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Descripción caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre del Procedimiento', 'descripcion' => 'Descripcion del Proc^dimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

/*
 *  --- ADD: ACCIONES  ---
 */

// Ya existe una def. de procedimiento con el nombre indicado en el mismo plan.
$_POST = array('plan_id' => '3', 'nombre' => 'Procedimiento del plan con procedimientos', 'descripcion' => 'Descripción del Procedimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','ACCION','Ya existe un procedimiento con el mismo nombre en el plan',
    'DFPROC_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Procedimiento añadido Ok
$_POST = array('plan_id' => '3', 'nombre' => 'Nombre del Procedimiento', 'descripcion' => 'Descripción del Procedimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->ADD();
$respTest = obtenerRespuesta('DefProc','ADD','ACCION','Procedimiento añadido Ok',
    'DFPROC_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

if($feedback['ok']) {
    $procedimiento_id = $defProc_service->defProc_entity->procedimiento_id;
} else {
    $procedimiento_id = '';
}

/*
 *  --- SEEK: VALIDACIONES  ---
 */

// ID del Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->seek();
$respTest = obtenerRespuesta('DefProc','SEEK','PROC_ID','ID de Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// ID del Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->seek();
$respTest = obtenerRespuesta('DefProc','SEEK','PROC_ID','ID de Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- SEEK: ACCIONES  ---
 */

// El procedimiento no existe
$_POST = array('procedimiento_id' => '11111');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->seek();
$respTest = obtenerRespuesta('DefProc','SEEK','ACCION','El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Consulta de detalles del procedimiento Ok
$_POST = array('procedimiento_id' => '1');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->seek();
$respTest = obtenerRespuesta('DefProc','SEEK','ACCION','Consulta de detalles del procedimiento Ok',
    'DFPROC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- DELETE: VALIDACIONES  ---
 */

// ID del Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->DELETE();
$respTest = obtenerRespuesta('DefProc','DELETE','PROC_ID','ID de Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// ID del Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->DELETE();
$respTest = obtenerRespuesta('DefProc','DELETE','PROC_ID','ID de Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- DELETE: ACCIONES ---
 */

// El procedimiento no existe
$_POST = array('procedimiento_id' => '11111');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->DELETE();
$respTest = obtenerRespuesta('DefProc','DELETE','ACCION','El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// El procedimiento tiene implementaciones en edificios
$_POST = array('procedimiento_id' => '1');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->DELETE();
$respTest = obtenerRespuesta('DefProc','DELETE','ACCION','Existen implementaciones del procedimiento en edificios',
    'DFPROC_IMPL_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Procedimiento eliminado OK
$_POST = array('procedimiento_id' => $procedimiento_id);
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->DELETE();
$respTest = obtenerRespuesta('DefProc','DELETE','ACCION','Procedimiento eliminado Ok',
    'DFPROC_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- EDIT: VALIDACIONES (Procedimiento) ---
 */

// ID del Procedimiento vacío
$_POST = array('procedimiento_id' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','PROC_ID','ID de Procedimiento vacío',
    'DFPROC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// ID del Procedimiento no numérico
$_POST = array('procedimiento_id' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','PROC_ID','ID de Procedimiento no numérico',
    'DFPROC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

/*
 *  --- EDIT: ACCIONES (Procedimiento) ---
 */

// El procedimiento no existe
$_POST = array('procedimiento_id' => '11111');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','ACCION','El procedimiento no existe',
    'DFPROCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Nombre del procedimiento corto (menos de 5 caracteres)
$_POST = array('procedimiento_id' => '1', 'nombre' => 'aaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','NOMBRE','Nombre del procedimiento corto',
    'DFPROC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento largo (más de 50 caracteres)
$_POST = array('procedimiento_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','NOMBRE','Nombre del procedimiento largo',
    'DFPROC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Nombre del procedimiento con caracteres no permitidos
$_POST = array('procedimiento_id' => '1', 'nombre' => 'Nombre del Proc^edimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','NOMBRE','Nombre del procedimiento con caracteres no permitidos',
    'DFPROC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Descripción vacía
$_POST = array('procedimiento_id' => '1', 'nombre' => 'Nombre del Procedimiento', 'descripcion' => '');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Descripción caracteres no permitidos
$_POST = array('procedimiento_id' => '1', 'nombre' => 'Nombre del Procedimiento', 'descripcion' => 'Descripcion del Proc^dimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);


/*
 *  --- EDIT: ACCIONES ---
 */

// Ya existe una def. de procedimiento con el nombre indicado en el mismo plan.
$_POST = array('procedimiento_id' => '1', 'nombre' => 'Nombre Procedimiento', 'descripcion' => 'Descripción del Procedimiento');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','ACCION','Ya existe un procedimiento con el mismo nombre en el plan',
    'DFPROC_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

// Procedimiento editado Ok
$_POST = array('procedimiento_id' => '1', 'nombre' => 'Nombre Procedimiento Test', 'descripcion' => 'Descripción del Procedimiento Test');
$defProc_service = new DefProc_Service();
$feedback = $defProc_service->EDIT();
$respTest = obtenerRespuesta('DefProc','EDIT','ACCION','Procedimiento editado correctamente',
    'DFPROC_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefProc, $respTest);

if($feedback['ok']) {
    $_POST = array('procedimiento_id' => '1', 'nombre' => 'Procedimiento del plan con procedimientos', 'descripcion' => 'Descripcion del Procedimiento');
    $defProc_service = new DefProc_Service();
    $feedback = $defProc_service->EDIT();
}


//------------------------------------------------------------------------------
//Fin test Definición de Procedimientos
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Def_Proc'] = $testDefProc;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;