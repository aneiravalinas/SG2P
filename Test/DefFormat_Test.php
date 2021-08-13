<?php

include_once './Service/DefFormat_Service.php';
$testDefFormat = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH: VALIDACIONES (Plan) ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- SEARCH: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '111111');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID de Formación no numérico
$_POST = array('plan_id' => '1', 'formacion_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','FORMACION_ID','ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','NOMBRE','Nombre corto',
    'DFFRMT_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación largo (más de 50 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','NOMBRE','Nombre largo',
    'DFFRMT_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'nombre de form^cion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','NOMBRE','Nombre con caracteres no permitidos',
    'DFFRMT_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de definiciones de formaciones Ok
$_POST = array('plan_id' => '1', 'nombre' => 'nombre de formacion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->SEARCH();
$respTest = obtenerRespuesta('DefFormat','SEARCH','ACCION','Búsqueda de formaciones Ok',
    'DFFRMT_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- ADD: VALIDACIONES (Plan) ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- ADD: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '111111');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- ADD: VALIDACIONES ---
 */

// Nombre de formación corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','NOMBRE','Nombre corto',
    'DFFRMT_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación largo (más de 50 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','NOMBRE','Nombre largo',
    'DFFRMT_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'nombre de form^cion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','NOMBRE','Nombre con caracteres no permitidos',
    'DFFRMT_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Descripción vacío
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre Formacion', 'descripcion' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre Formacion', 'descripcion' => 'Descripci^n');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe una def. de formación con el nombre indicado en el mismo plan.
$_POST = array('plan_id' => '5', 'nombre' => 'Formaciones del plan con formaciones', 'descripcion' => 'Descripcion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','ACCION','Ya existe una formación con el nombre indicado en el plan',
    'DFFRMT_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Se añade la def. de la formación Ok
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre Formacion', 'descripcion' => 'Descripcion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->ADD();
$respTest = obtenerRespuesta('DefFormat','ADD','ACCION','Formacion añadida Ok',
    'DFFRMT_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

if($feedback['ok']) {
    $formacion_id = $defFormat_service->defFormat_entity->formacion_id;
} else {
    $formacion_id = '';
}


/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Formacion vacío
$_POST = array('formacion_id' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->DELETE();
$respTest = obtenerRespuesta('DefFormat','DELETE','FORMACION_ID','ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->DELETE();
$respTest = obtenerRespuesta('DefFormat','DELETE','FORMACION_ID','ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->DELETE();
$respTest = obtenerRespuesta('DefFormat','DELETE','ACCION','La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// La def. de la formación tiene implementacionesa en edificios
$_POST = array('formacion_id' => '2');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->DELETE();
$respTest = obtenerRespuesta('DefFormat','DELETE','ACCION','La formación tiene implementaciones en edificios',
    'DFFRMT_IMPL_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// La def. de la ruta se elimina Ok
$_POST = array('formacion_id' => $formacion_id);
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->DELETE();
$respTest = obtenerRespuesta('DefFormat','DELETE','ACCION','La formacion se elimina Ok',
    'DFFRMT_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- EDIT: VALIDACIONES (Formacion) ---
 */

// ID de Formacion vacío
$_POST = array('formacion_id' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','FORMACION_ID','ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','FORMACION_ID','ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- EDIT: ACCIONES (Formacion) ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','ACCION','La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Nombre de formación corto (menos de 5 caracteres)
$_POST = array('formacion_id' => '1', 'nombre' => 'aa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','NOMBRE','Nombre corto',
    'DFFRMT_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación largo (más de 50 caracteres)
$_POST = array('formacion_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','NOMBRE','Nombre largo',
    'DFFRMT_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Nombre de formación con caracteres no permitidos
$_POST = array('formacion_id' => '1', 'nombre' => 'nombre de form^cion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','NOMBRE','Nombre con caracteres no permitidos',
    'DFFRMT_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Descripción vacío
$_POST = array('formacion_id' => '1', 'nombre' => 'Nombre Formacion', 'descripcion' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('formacion_id' => '1', 'nombre' => 'Nombre Formacion', 'descripcion' => 'Descripci^n');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- EDIT: ACCIONES ---
 */

// Ya existe una def. de formación con el nombre indicado en el mismo plan.
$_POST = array('formacion_id' => '1', 'nombre' => 'Otra Formación del plan con formaciones', 'descripcion' => 'Descripcion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','ACCION','Ya existe una formación con el nombre indicado en el plan',
    'DFFRMT_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// Definición de la formación modificada Ok
$_POST = array('formacion_id' => '1', 'nombre' => 'Titulo Formacion', 'descripcion' => 'Descripcion');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->EDIT();
$respTest = obtenerRespuesta('DefFormat','EDIT','ACCION','Formacion modificada Ok',
    'DFFRMT_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

if($feedback['ok']) {
    $_POST = array('formacion_id' => '1', 'nombre' => 'Formaciones del plan con formaciones', 'descripcion' => 'Descripción de la formación');
    $defFormat_service = new DefFormat_Service();
    $feedback = $defFormat_service->EDIT();
}

/*
 *  --- SEEK_PLAN: VALIDACIONES ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seekPlan();
$respTest = obtenerRespuesta('DefFormat','SEEK_PLAN','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seekPlan();
$respTest = obtenerRespuesta('DefFormat','SEEK_PLAN','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- SEEK_PLAN: ACCIONES ---
 */

// El plan no existe
$_POST = array('plan_id' => '111111');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seekPlan();
$respTest = obtenerRespuesta('DefFormat','SEEK_PLAN','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// El plan existe
$_POST = array('plan_id' => '1');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seekPlan();
$respTest = obtenerRespuesta('DefFormat','SEEK_PLAN','ACCION','El plan existe',
    'DFPLANID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);


/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Formacion vacío
$_POST = array('formacion_id' => '');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seek();
$respTest = obtenerRespuesta('DefFormat','SEEK','FORMACION_ID','ID de Formación vacío',
    'DFFRMT_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// ID de Formación no numérico
$_POST = array('formacion_id' => 'aaaa');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seek();
$respTest = obtenerRespuesta('DefFormat','SEEK','FORMACION_ID','ID de Formación no numérico',
    'DEFFRMT_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La formación no existe
$_POST = array('formacion_id' => '111111');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seek();
$respTest = obtenerRespuesta('DefFormat','SEEK','ACCION','La formación no existe',
    'DFFRMTID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

// La formación existe
$_POST = array('formacion_id' => '1');
$defFormat_service = new DefFormat_Service();
$feedback = $defFormat_service->seek();
$respTest = obtenerRespuesta('DefFormat','SEEK','ACCION','La formación existe',
    'DFFRMT_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefFormat, $respTest);

//------------------------------------------------------------------------------
//Fin test Definición de Formaciones
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Def_Formation'] = $testDefFormat;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;