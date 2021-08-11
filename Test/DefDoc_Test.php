<?php

include_once './Service/DefDoc_Service.php';
$testDefDoc = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH: VALIDACIONES (Plan) ---
 */

// Plan ID vacío
$_POST = array('plan_id' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Plan ID no numérico
$_POST = array('plan_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- SEARCH: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '11111');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// Documento ID no numérico
$_POST = array('plan_id' => '2','documento_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','DOCUMENTO_ID','ID del documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre corto (menos de 5 caracteres)
$_POST = array('plan_id' => '2','nombre' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','NOMBRE','Nombre de documento corto',
    'DFDOC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre largo (más de 50 caracteres)
$_POST = array('plan_id' => '2','nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','NOMBRE','Nombre de documento largo',
    'DFDOC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre de documento con caracteres no permitidos
$_POST = array('plan_id' => '2','nombre' => 'Nombre del doc^mento');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','NOMBRE','Nombre de documento con caracteres no permitidos',
    'DFDOC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Visibilidad documento valores no permitidos
$_POST = array('plan_id' => '2','visible' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','VISIBLE','Visibilidad documento con valores no permitidos',
    'DFDOC_VISB_VALUES', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de documentos Ok.
$_POST = array('plan_id' => '2', 'visible' => 'yes');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->SEARCH();
$respTest = obtenerRespuesta('DefDoc','SEARCH','ACCION','Búsqueda de documentos Ok',
    'DFDOC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- EMPTY_FORM: VALIDACIONES ---
 */

// Plan ID vacío
$_POST = array('plan_id' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->emptyForm();
$respTest = obtenerRespuesta('DefDoc','EMPTY_FORM','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Plan ID no numérico
$_POST = array('plan_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->emptyForm();
$respTest = obtenerRespuesta('DefDoc','EMPTY_FORM','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- EMPTY_FORM: ACCIONES ---
 */

// El plan no existe
$_POST = array('plan_id' => '11111');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->emptyForm();
$respTest = obtenerRespuesta('DefDoc','EMPTY_FORM','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// El plan existe
$_POST = array('plan_id' => '2');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->emptyForm();
$respTest = obtenerRespuesta('DefDoc','EMPTY_FORM','ACCION','El plan existe',
    'DFPLANID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- ADD: VALIDACIONES (Plan) ---
 */

// Plan ID vacío
$_POST = array('plan_id' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','PLAN_ID','ID del plan vacío',
    'DFPLAN_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Plan ID no numérico
$_POST = array('plan_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','PLAN_ID','ID del plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- ADD: ACCIONES (Plan) ---
 */

// El plan no existe
$_POST = array('plan_id' => '11111');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','ACCION','El plan no existe',
    'DFPLANID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- ADD: VALIDACIONES ---
 */

// Nombre corto (menos de 5 caracteres)
$_POST = array('plan_id' => '2','nombre' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','NOMBRE','Nombre de documento corto',
    'DFDOC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre largo (más de 50 caracteres)
$_POST = array('plan_id' => '2','nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','NOMBRE','Nombre de documento largo',
    'DFDOC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre de documento con caracteres no permitidos
$_POST = array('plan_id' => '2','nombre' => 'Nombre del doc^mento');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','NOMBRE','Nombre de documento con caracteres no permitidos',
    'DFDOC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Descripción vacía
$_POST = array('plan_id' => '2','nombre' => 'Nombre documento test', 'descripcion' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Descripción caracteres no permitidos
$_POST = array('plan_id' => '2','nombre' => 'Nombre documento test', 'descripcion' => 'Descri^n test');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Visibilidad del documento vacío
$_POST = array('plan_id' => '2','nombre' => 'Nombre documento test', 'descripcion' => 'Descripción test', 'visible' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','VISIBLE','Visibilidad del documento vacía',
    'DFDOC_VISB_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Visibilidad con valores no permitidos
$_POST = array('plan_id' => '2','nombre' => 'Nombre documento test', 'descripcion' => 'Descripción test', 'visible' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','VISIBLE','Valor de la visibilidad del documento no permitido',
    'DFDOC_VISB_VALUES', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe un documento con el nombre indicado en el plan
$_POST = array('plan_id' => '2','nombre' => 'Documentos del plan con documentos', 'descripcion' => 'Descripción test', 'visible' => 'yes');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','ACCION','Valor de la visibilidad del documento no permitido',
    'DFDOC_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Documento añadido correctamente
$_POST = array('plan_id' => '2','nombre' => 'Documentos test', 'descripcion' => 'Descripción test', 'visible' => 'yes');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->ADD();
$respTest = obtenerRespuesta('DefDoc','ADD','ACCION','Documento añadido Ok',
    'DFDOC_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

if($feedback['ok']) {
    $documento_id = $defDoc_service->defDoc_entity->documento_id;
} else {
    $documento_id = '';
}

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de documento vacío
$_POST = array('documento_id' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->seek();
$respTest = obtenerRespuesta('DefDoc','SEEK','DOCUMENTO_ID','ID de Documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// ID de documento no numérico
$_POST = array('documento_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->seek();
$respTest = obtenerRespuesta('DefDoc','SEEK','DOCUMENTO_ID','ID de Documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);


/*
 *  --- SEEK: ACCIONES ---
 */

// El documento no existe
$_POST = array('documento_id' => '1111');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->seek();
$respTest = obtenerRespuesta('DefDoc','SEEK','ACCION','Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Consulta de los detalles del documento Ok
$_POST = array('documento_id' => '1');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->seek();
$respTest = obtenerRespuesta('DefDoc','SEEK','ACCION','Consulta de los detalles del documento Ok',
    'DFDOC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de documento vacío
$_POST = array('documento_id' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->DELETE();
$respTest = obtenerRespuesta('DefDoc','DELETE','DOCUMENTO_ID','ID de Documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// ID de documento no numérico
$_POST = array('documento_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->DELETE();
$respTest = obtenerRespuesta('DefDoc','DELETE','DOCUMENTO_ID','ID de Documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El documento no existe
$_POST = array('documento_id' => '1111');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->DELETE();
$respTest = obtenerRespuesta('DefDoc','DELETE','ACCION','Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// El documento tiene implementaciones en edificios
$_POST = array('documento_id' => '1');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->DELETE();
$respTest = obtenerRespuesta('DefDoc','DELETE','ACCION','El documento tiene implementaciones en edificios',
    'DFDOC_IMPL_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Documento eliminado Ok
$_POST = array('documento_id' => $documento_id);
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->DELETE();
$respTest = obtenerRespuesta('DefDoc','DELETE','ACCION','Documento eliminado Ok',
    'DFDOC_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- EDIT: VALIDACIONES (Documento) ---
 */

// ID de documento vacío
$_POST = array('documento_id' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','DOCUMENTO_ID','ID de Documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// ID de documento no numérico
$_POST = array('documento_id' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','DOCUMENTO_ID','ID de Documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

/*
 *  --- EDIT: ACCIONES (Documento) ---
 */

// El documento no existe
$_POST = array('documento_id' => '1111');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','ACCION','Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Nombre corto (menos de 5 caracteres)
$_POST = array('documento_id' => '1', 'nombre' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','NOMBRE','Nombre de documento corto',
    'DFDOC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre largo (más de 50 caracteres)
$_POST = array('documento_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','NOMBRE','Nombre de documento largo',
    'DFDOC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Nombre de documento con caracteres no permitidos
$_POST = array('documento_id' => '1', 'nombre' => 'Nombre del doc^mento');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','NOMBRE','Nombre de documento con caracteres no permitidos',
    'DFDOC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Descripción vacía
$_POST = array('documento_id' => '1', 'nombre' => 'Nombre documento test', 'descripcion' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','DESCRIPCION','Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Descripción caracteres no permitidos
$_POST = array('documento_id' => '1', 'nombre' => 'Nombre documento test', 'descripcion' => 'Descri^n test');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','DESCRIPCION','Descripción con caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Visibilidad del documento vacío
$_POST = array('documento_id' => '1', 'nombre' => 'Nombre documento test', 'descripcion' => 'Descripción test', 'visible' => '');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','VISIBLE','Visibilidad del documento vacía',
    'DFDOC_VISB_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Visibilidad con valores no permitidos
$_POST = array('documento_id' => '1', 'nombre' => 'Nombre documento test', 'descripcion' => 'Descripción test', 'visible' => 'aa');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','VISIBLE','Valor de la visibilidad del documento no permitido',
    'DFDOC_VISB_VALUES', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);


/*
 *  --- EDIT: ACCIONES ---
 */

// Ya existe un documento con el nombre indicado en el plan
$_POST = array('documento_id' => '1', 'nombre' => 'Nombre Documento', 'descripcion' => 'Descripcion del Documento', 'visible' => 'yes');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','ACCION','Ya existe un documento con el nombre indicado en el plan',
    'DFDOC_NAME_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

// Documento editado Ok
$_POST = array('documento_id' => '1', 'nombre' => 'Documentos del plan con documentos', 'descripcion' => 'Descripcion del Documento', 'visible' => 'no');
$defDoc_service = new DefDoc_Service();
$feedback = $defDoc_service->EDIT();
$respTest = obtenerRespuesta('DefDoc','EDIT','ACCION','Documento editado Ok',
    'DFDOC_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDefDoc, $respTest);

if($feedback['ok']) {
    $_POST = array('documento_id' => '1', 'nombre' => 'Documentos del plan con documentos', 'descripcion' => 'Descripcion del Documento', 'visible' => 'yes');
    $defDoc_service = new DefDoc_Service();
    $defDoc_service->EDIT();
}


//------------------------------------------------------------------------------
//Fin test Definición de Documentos
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['DefDocumentos'] = $testDefDoc;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;