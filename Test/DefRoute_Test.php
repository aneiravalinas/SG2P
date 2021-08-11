<?php

include_once './Service/DefRoute_Service.php';
$testDefRoute = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH: VALIDACIONES (Plan) ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- SEARCH: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '11111');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','ACCION','El Plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID Ruta no numérica
$_POST = array('plan_id' => '1', 'ruta_id' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','RUTA_ID','ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','NOMBRE','Nombre de ruta corto',
    'DFROUTE_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre de ruta largo (más de 50 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','NOMBRE','Nombre de ruta largo',
    'DFROUTE_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre de ruta con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre de R^ta');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','NOMBRE','Nombre de ruta con caracteres no permitidos',
    'DFROUTE_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de rutas Ok
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre de Ruta');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->SEARCH();
$respTest = obtenerRespuesta('DefRoute','SEARCH','NOMBRE','Búsqueda de rutas Ok',
    'DFROUTE_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- ADD: VALIDACIONES (Plan) ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- ADD: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '11111');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','ACCION','El Plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- ADD: VALIDACIONES ---
 */

// Nombre corto (menos de 5 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','NOMBRE','Nombre de ruta corto',
    'DFROUTE_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre de ruta largo (más de 50 caracteres)
$_POST = array('plan_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','NOMBRE','Nombre de ruta largo',
    'DFROUTE_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre de ruta con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre de R^ta');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','NOMBRE','Nombre de ruta con caracteres no permitidos',
    'DFROUTE_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Descripción Vacía
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre test de Ruta', 'descripcion' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','DESCRIPCION','Nombre de ruta vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('plan_id' => '1', 'nombre' => 'Nombre test de Ruta', 'descripcion' => 'Descri^n');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','DESCRIPCION','Nombre de ruta vacía',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);


/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe una def. de ruta con el nombre indicado en el mismo plan.
$_POST = array('plan_id' => '1', 'nombre' => 'Rutas del Plan Uno', 'descripcion' => 'Descripción de prueba.');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','ACCION','Ya existe una def. de ruta con el nombre indicado en el mismo plan',
    'DFROUTE_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Def. de ruta añadida correctamente
$_POST = array('plan_id' => '1', 'nombre' => 'Ruta Test', 'descripcion' => 'Descripción de prueba.');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->ADD();
$respTest = obtenerRespuesta('DefRoute','ADD','ACCION','Ruta añadida correctamente',
    'DFROUTE_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

if($feedback['ok']) {
    $route_id = $defRoute_service->defRoute_entity->ruta_id;
} else {
    $route_id = '';
}

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Ruta vacía
$_POST = array('ruta_id' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seek();
$respTest = obtenerRespuesta('DefRoute','SEEK','RUTA_ID','ID de Ruta vacía',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seek();
$respTest = obtenerRespuesta('DefRoute','SEEK','RUTA_ID','ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '111111');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seek();
$respTest = obtenerRespuesta('DefRoute','SEEK','ACCION','La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Consulta de los detallesa de la ruta Ok
$_POST = array('ruta_id' => '1');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seek();
$respTest = obtenerRespuesta('DefRoute','SEEK','ACCION','Consulta de los detallesa de la ruta Ok',
    'DFROUTE_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Ruta vacía
$_POST = array('ruta_id' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->DELETE();
$respTest = obtenerRespuesta('DefRoute','DELETE','RUTA_ID','ID de Ruta vacía',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->DELETE();
$respTest = obtenerRespuesta('DefRoute','DELETE','RUTA_ID','ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '111111');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->DELETE();
$respTest = obtenerRespuesta('DefRoute','DELETE','ACCION','La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Ruta con implementaciones en plantas
$_POST = array('ruta_id' => '1');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->DELETE();
$respTest = obtenerRespuesta('DefRoute','DELETE','ACCION','Ruta con implementaciones en plantas',
    'DFROUTE_IMPL_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Ruta eliminada Ok
$_POST = array('ruta_id' => $route_id);
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->DELETE();
$respTest = obtenerRespuesta('DefRoute','DELETE','ACCION','Ruta eliminada correctamente',
    'DFROUTE_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- SEEK_PLAN: VALIDACIONES ---
 */

// ID del Plan vacío
$_POST = array('plan_id' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seekPlan();
$respTest = obtenerRespuesta('DefRoute','SEEK_PLAN','PLAN_ID','ID del Plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// ID del Plan no numérico
$_POST = array('plan_id' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seekPlan();
$respTest = obtenerRespuesta('DefRoute','SEEK_PLAN','PLAN_ID','ID del Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- SEEK_PLAN: ACCIONES ---
 */

// El plan no existe
$_POST = array('plan_id' => '11111');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seekPlan();
$respTest = obtenerRespuesta('DefRoute','SEEK_PLAN','ACCION','El Plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// El plan existe
$_POST = array('plan_id' => '1');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->seekPlan();
$respTest = obtenerRespuesta('DefRoute','SEEK_PLAN','ACCION','El Plan existe',
    'DFPLANID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- EDIT: VALIDACIONES (Ruta) ---
 */

// ID de Ruta vacía
$_POST = array('ruta_id' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','RUTA_ID','ID de Ruta vacía',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','RUTA_ID','ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- EDIT: ACCIONES (Ruta) ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '111111');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','ACCION','La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- EDIT: VALIDACIONES  ---
 */

// Nombre corto (menos de 5 caracteres)
$_POST = array('ruta_id' => '1', 'nombre' => 'aa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','NOMBRE','Nombre de ruta corto',
    'DFROUTE_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre de ruta largo (más de 50 caracteres)
$_POST = array('ruta_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','NOMBRE','Nombre de ruta largo',
    'DFROUTE_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Nombre de ruta con caracteres no permitidos
$_POST = array('ruta_id' => '1', 'nombre' => 'Nombre de R^ta');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','NOMBRE','Nombre de ruta con caracteres no permitidos',
    'DFROUTE_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Descripción Vacía
$_POST = array('ruta_id' => '1', 'nombre' => 'Nombre test de Ruta', 'descripcion' => '');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','DESCRIPCION','Nombre de ruta vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Descripción con caracteres no permitidos
$_POST = array('ruta_id' => '1', 'nombre' => 'Nombre test de Ruta', 'descripcion' => 'Descri^n');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','DESCRIPCION','Nombre de ruta vacía',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

/*
 *  --- EDIT: ACCIONES  ---
 */

// Ya existe una def. de ruta con el nombre indicado en el mismo plan.
$_POST = array('ruta_id' => '1', 'nombre' => 'Otra Ruta del Plan Uno', 'descripcion' => 'Descripción de prueba.');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','ACCION','Ya existe una def. de ruta con el nombre indicado en el mismo plan',
    'DFROUTE_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

// Ruta editada Ok
$_POST = array('ruta_id' => '1', 'nombre' => 'Ruta Edit Test', 'descripcion' => 'Descripción test');
$defRoute_service = new DefRoute_Service();
$feedback = $defRoute_service->EDIT();
$respTest = obtenerRespuesta('DefRoute','EDIT','ACCION','Ruta editada correctamente',
    'DFROUTE_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefRoute, $respTest);

if($feedback['ok']) {
    $_POST = array('ruta_id' => '1', 'nombre' => 'Rutas del Plan Uno', 'descripcion' => 'Descripcion de la definicion de la ruta');
    $defRoute_service = new DefRoute_Service();
    $feedback = $defRoute_service->EDIT();
}

//------------------------------------------------------------------------------
//Fin test Definición de Rutas
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Def_Route'] = $testDefRoute;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;