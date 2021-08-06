<?php

include './Service/Space_Service.php';

$testEspacio = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEARCH: VALIDACIONES (Planta) ---
 */

// ID de Planta vacío
$_POST = array('planta_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'PLANTA_ID', 'Planta ID vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID de Planta no numérico
$_POST = array('planta_id' => '12a');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'PLANTA_ID', 'Planta ID no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- SEARCH: ACCIONES (Planta) ---
 */

// La planta no existe
$_POST = array('planta_id' => '111');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'ACCION', 'La planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// El usuario no es responsable del edificio al que pertence la planta.
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';
$_POST = array('planta_id' => '2');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'ACCION', 'Responsable no asignado a la planta',
    'SPC_SRCH_NOT_ALLOWED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

$_SESSION['username'] = 'sg2ped';

// ID de Espacio no numérico
$_POST = array('planta_id' => '1', 'espacio_id' => '123a');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'PLANTA_ID', 'ID de Planta no numérico',
    'SPC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre del espacio corto (menos de 3 caracteres)
$_POST = array('planta_id' => '1', 'nombre' => 'aa');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'NOMBRE', 'Nombre espacio corto',
    'SPC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre del espacio largo (más de 40 caracteres)
$_POST = array('planta_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'NOMBRE', 'Nombre espacio largo',
    'SPC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre espacio formato
$_POST = array('planta_id' => '1', 'nombre' => 'nombre del esp^cio');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'NOMBRE', 'Nombre espacio formato incorrecto',
    'SPC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- SEARCH: ACCION ---
 */

// Búsqueda de espacios Ok
$_POST = array('planta_id' => '1', 'nombre' => 'Espacio Uno');
$space_service = new Space_Service();
$feedback = $space_service->SEARCH();
$respTest = obtenerRespuesta('Espacio', 'SEARCH', 'NOMBRE', 'Búsqueda de espacios Ok',
    'SPC_SRCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Espacio vacío
$_POST = array('espacio_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->seek();
$respTest = obtenerRespuesta('Espacio', 'SEEK', 'PLANTA_ID', 'ID de Planta vacío',
    'SPC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID de Espacio no numérico
$_POST = array('espacio_id' => '123a');
$space_service = new Space_Service();
$feedback = $space_service->seek();
$respTest = obtenerRespuesta('Espacio', 'SEEK', 'PLANTA_ID', 'ID de Planta no numérico',
    'SPC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// Espacio no pertenece a un edificio asignado al responsable
$_SESSION['username'] = 'sg2ped2';
$_POST = array('espacio_id' => '2');
$space_service = new Space_Service();
$feedback = $space_service->seek();
$respTest = obtenerRespuesta('Espacio', 'SEEK', 'ACCION', 'Espacio no pertenece a un edificio asignado al responsable',
    'SPC_SEEK_NOT_ALLOWED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);


$_SESSION['username'] = 'sg2ped';
// Consulta de Espacio Ok
$_POST = array('espacio_id' => '1');
$space_service = new Space_Service();
$feedback = $space_service->seek();
$respTest = obtenerRespuesta('Espacio', 'SEEK', 'ACCION', 'Consulta de espacio Ok',
    'SPC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- EMPTY_FORM: VALIDACIONES ---
 */

// ID de Planta vacío
$_POST = array('planta_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->emptyForm();
$respTest = obtenerRespuesta('Espacio', 'EMPTY_FORM', 'PLANTA_ID', 'ID de Planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID de Planta no numérico
$_POST = array('planta_id' => '11a');
$space_service = new Space_Service();
$feedback = $space_service->emptyForm();
$respTest = obtenerRespuesta('Espacio', 'EMPTY_FORM', 'PLANTA_ID', 'ID de Planta no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- EMPTY_FORM: ACCIONES ---
 */

// La planta no existe
$_POST = array('planta_id' => '11111');
$space_service = new Space_Service();
$feedback = $space_service->emptyForm();
$respTest = obtenerRespuesta('Espacio', 'EMPTY_FORM', 'ACCION', 'La Planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// La planta existe
$_POST = array('planta_id' => '1');
$space_service = new Space_Service();
$feedback = $space_service->emptyForm();
$respTest = obtenerRespuesta('Espacio', 'EMPTY_FORM', 'ACCION', 'La Planta existe',
    'FLRID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- DATA_FORM: VALIDACIONES ---
 */

// ID de Espacio vacío
$_POST = array('espacio_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->dataForm();
$respTest = obtenerRespuesta('Espacio', 'DATA_FORM', 'ESPACIO_ID', 'ID de espacio vacío',
    'SPC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID de Espacio no numérico
$_POST = array('espacio_id' => '12a');
$space_service = new Space_Service();
$feedback = $space_service->dataForm();
$respTest = obtenerRespuesta('Espacio', 'DATA_FORM', 'ESPACIO_ID', 'ID de espacio no numérico',
    'SPC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- DATA_FORM: ACCIONES ---
 */

// El espacio no existe
$_POST = array('espacio_id' => '1111');
$space_service = new Space_Service();
$feedback = $space_service->dataForm();
$respTest = obtenerRespuesta('Espacio', 'DATA_FORM', 'ACCION', 'El espacio no existe',
    'SPCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// El espacio existe
$_POST = array('espacio_id' => '1');
$space_service = new Space_Service();
$feedback = $space_service->dataForm();
$respTest = obtenerRespuesta('Espacio', 'DATA_FORM', 'ACCION', 'El espacio existe',
    'SPCID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);


/*
 *  --- ADD: VALIDACIONES (Planta) ---
 */

// ID de Planta vacío
$_POST = array('planta_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'PLANTA_ID', 'ID de Planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID de Planta no numérico
$_POST = array('planta_id' => '11a');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'PLANTA_ID', 'ID de Planta no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- ADD: ACCIONES (Planta) ---
 */

// La planta no existe
$_POST = array('planta_id' => '11111');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'ACCION', 'La Planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- ADD: VALIDACIONES ---
 */

// Nombre de espacio corto (menos de 3 caracteres)
$_POST = array('planta_id' => '1', 'nombre' => 'aa');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'NOMBRE', 'Nombre de espacio corto',
    'SPC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre de espacio largo (más de 40 caracteres)
$_POST = array('planta_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'NOMBRE', 'Nombre de espacio largo',
    'SPC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre de espacio caracteres no permitidos
$_POST = array('planta_id' => '1', 'nombre' => 'Nombre Esp^cio');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'NOMBRE', 'Nombre de espacio caracteres no permitdos',
    'SPC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Descripción vacío
$_POST = array('planta_id' => '1', 'nombre' => 'Nombre Espacio', 'descripcion' => '');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'DESCRIPCION', 'Descripción vacío',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Descripción caracteres no permitidos
$_POST = array('planta_id' => '1', 'nombre' => 'Nombre Espacio', 'descripcion' => 'Descripción d+l +sP`cio');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'DESCRIPCION', 'Descripción caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Extensión foto espacio no permitida
$_FILES = array('foto_espacio' => array('name' => 'foto.php'));
$_POST = array('planta_id' => '1', 'nombre' => 'Nombre Espacio',
    'descripcion' => 'Descripción del Espacio', 'foto_espacio' => 'foto.php');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'FOTO_ESPACIO', 'Extensión no permitida',
    'SPC_PH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Caracteres no permitidos en el nombre de la foto del espacio
$_FILES = array('foto_espacio' => array('name' => 'f+to.jpg'));
$_POST = array('planta_id' => '1', 'nombre' => 'Nombre Espacio',
    'descripcion' => 'Descripción del Espacio', 'foto_espacio' => 'f+to.jpg');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'FOTO_ESPACIO', 'Nombre de la foto con caracteres no permitidos',
    'SPC_PH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);
unset($_FILES);


/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe un espacio con ese nombre en la planta.
$_POST = array('planta_id' => '1', 'nombre' => 'Espacio Uno',
    'descripcion' => 'Descripción del Espacio');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'ACCION', 'Ya existe un espacio con ese nombre en la planta',
    'SPC_NAM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Error al subir la foto
$_FILES = array('foto_espacio' => array('tmp_name' => 'foto.jpg', 'name' => 'foto.jpg'));
$_POST = array('planta_id' => '1', 'nombre' => 'Espacio Test',
    'descripcion' => 'Descripción del Espacio', 'foto_espacio' => 'foto.jpg');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'ACCION', 'Error al subir la foto del espacio',
    'SPC_PH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);
unset($_FILES);

// Espacio añadido con éxito.
$_POST = array('planta_id' => '1', 'nombre' => 'Espacio Test',
    'descripcion' => 'Descripción del Espacio');
$space_service = new Space_Service();
$feedback = $space_service->ADD();
$respTest = obtenerRespuesta('Espacio', 'ADD', 'ACCION', 'Espacio añadido Ok',
    'SPC_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

if($feedback['ok']) {
    $espacio_id = $space_service->space_entity->espacio_id;
} else {
    $espacio_id = '';
}

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID del Espacio vacío
$_POST = array('espacio_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->DELETE();
$respTest = obtenerRespuesta('Espacio', 'DELETE', 'ESPACIO_ID', 'ID de Espacio vacío',
    'SPC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID del Espacio no numérico
$_POST = array('espacio_id' => '12a');
$space_service = new Space_Service();
$feedback = $space_service->DELETE();
$respTest = obtenerRespuesta('Espacio', 'DELETE', 'ESPACIO_ID', 'ID de Espacio no numérico',
    'SPC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El espacio no existe
$_POST = array('espacio_id' => '1111');
$space_service = new Space_Service();
$feedback = $space_service->DELETE();
$respTest = obtenerRespuesta('Espacio', 'DELETE', 'ACCION', 'El espacio no existe',
    'SPCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Espacio eliminado Ok
$_POST = array('espacio_id' => $espacio_id);
$space_service = new Space_Service();
$feedback = $space_service->DELETE();
$respTest = obtenerRespuesta('Espacio', 'DELETE', 'ACCION', 'Espacio eliminado Ok',
    'SPC_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);


/*
 *  --- EDIT: VALIDACIONES (Espacio) ---
 */

// ID del Espacio vacío
$_POST = array('espacio_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'ESPACIO_ID', 'ID de Espacio vacío',
    'SPC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID del Espacio no numérico
$_POST = array('espacio_id' => '12a');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'ESPACIO_ID', 'ID de Espacio no numérico',
    'SPC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

/*
 *  --- EDIT: ACCIONES (Espacio) ---
 */

// El espacio no existe
$_POST = array('espacio_id' => '1111');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'ACCION', 'El espacio no existe',
    'SPCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Nombre de espacio corto (menos de 3 caracteres)
$_POST = array('espacio_id' => '1', 'nombre' => 'aa');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'NOMBRE', 'Nombre de espacio corto',
    'SPC_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre de espacio largo (más de 40 caracteres)
$_POST = array('espacio_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'NOMBRE', 'Nombre de espacio largo',
    'SPC_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Nombre de espacio caracteres no permitidos
$_POST = array('espacio_id' => '1', 'nombre' => 'Nombre Esp^cio');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'NOMBRE', 'Nombre de espacio caracteres no permitdos',
    'SPC_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Descripción vacío
$_POST = array('espacio_id' => '1', 'nombre' => 'Nombre Espacio', 'descripcion' => '');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'DESCRIPCION', 'Descripción vacío',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Descripción caracteres no permitidos
$_POST = array('espacio_id' => '1', 'nombre' => 'Nombre Espacio', 'descripcion' => 'Descripción d+l +sP`cio');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'DESCRIPCION', 'Descripción caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Extensión foto espacio no permitida
$_FILES = array('foto_espacio' => array('name' => 'foto.php'));
$_POST = array('espacio_id' => '1', 'nombre' => 'Nombre Espacio',
    'descripcion' => 'Descripción del Espacio', 'foto_espacio' => 'foto.php');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'FOTO_ESPACIO', 'Extensión no permitida',
    'SPC_PH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Caracteres no permitidos en el nombre de la foto del espacio
$_FILES = array('foto_espacio' => array('name' => 'f+to.jpg'));
$_POST = array('espacio_id' => '1', 'nombre' => 'Nombre Espacio',
    'descripcion' => 'Descripción del Espacio', 'foto_espacio' => 'f+to.jpg');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'FOTO_ESPACIO', 'Nombre de la foto con caracteres no permitidos',
    'SPC_PH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);
unset($_FILES);


/*
 *  --- EDIT: ACCIONES ---
 */

// Ya existe espacio con ese nombre en la planta
$_POST = array('espacio_id' => '1', 'nombre' => 'Espacio Dos',
    'descripcion' => 'Descripcion del espacio uno');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'ACCION', 'Ya existe un espacio con ese nombre',
    'SPC_NAM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Error al subir la foto
$_FILES = array('foto_espacio' => array('tmp_name' => '/foto.jpg', 'name' => '/foto.jpg'));
$_POST = array('espacio_id' => '1', 'nombre' => 'Espacio Uno',
    'descripcion' => 'Descripcion del espacio uno', 'foto_espacio' => 'foto.jpg');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'ACCION', 'Error al subir la foto del espacio',
    'SPC_PH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);
unset($_FILES);

// Espacio editado Ok
$_POST = array('espacio_id' => '1', 'nombre' => 'Espacio Test',
    'descripcion' => 'Descripcion del espacio uno');
$space_service = new Space_Service();
$feedback = $space_service->EDIT();
$respTest = obtenerRespuesta('Espacio', 'EDIT', 'ACCION', 'Espacio editado Ok',
    'SPC_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

if($feedback['ok']) {
    $_POST = array('espacio_id' => '1', 'nombre' => 'Espacio Uno',
        'descripcion' => 'Descripcion del espacio uno');
    $space_service = new Space_Service();
    $feedback = $space_service->EDIT();
}


/*
 *  --- SEEK_PORTAL_SPACE: VALIDACIONES ---
 */

// ID del Espacio vacío
$_POST = array('espacio_id' => '');
$space_service = new Space_Service();
$feedback = $space_service->seekPortalSpace();
$respTest = obtenerRespuesta('Espacio', 'SEEK_PRTL_SPC', 'ESPACIO_ID', 'ID de Espacio vacío',
    'SPC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// ID del Espacio no numérico
$_POST = array('espacio_id' => '12a');
$space_service = new Space_Service();
$feedback = $space_service->seekPortalSpace();
$respTest = obtenerRespuesta('Espacio', 'SEEK_PRTL_SPC', 'ESPACIO_ID', 'ID de Espacio no numérico',
    'SPC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);


/*
 *  --- SEEK_PORTAL_SPACE: VALIDACIONES ---
 */

// El espacio no existe
$_POST = array('espacio_id' => '1111');
$space_service = new Space_Service();
$feedback = $space_service->seekPortalSpace();
$respTest = obtenerRespuesta('Espacio', 'SEEK_PRTL_SPC', 'ACCION', 'El espacio no existe',
    'SPCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

// Búsqueda del espacio del portal Ok
$_POST = array('espacio_id' => '1');
$space_service = new Space_Service();
$feedback = $space_service->seekPortalSpace();
$respTest = obtenerRespuesta('Espacio', 'SEEK_PRTL_SPC', 'ACCION', 'Consulta del espacio del portal Ok',
    'PRTL_SPC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEspacio, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


//------------------------------------------------------------------------------
//Fin test espacios
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Espacio'] = $testEspacio;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;
