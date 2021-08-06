<?php

include_once './Service/Floor_Service.php';
$testPlanta = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEARCH: VALIDACIONES (Edificio_ID)---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'EDIFICIO_ID', 'Edificio ID vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => '1a');
$floor_service = new Floor_Service();
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'EDIFICIO_ID', 'Edificio ID no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- SEARCH: ACCION (Edificio) ---
 */


// El edificio no existe
$_POST = array('edificio_id' => '111');
$floor_service = new Floor_Service();
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Responsable de edificio no tiene permisos para buscar plantas en el edificio
$_SESSION['rol'] = 'edificio';
$_SESSION['username'] = 'sg2ped';
$_POST = array('edificio_id' => '2');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'ACCION', 'Búsqueda de plantas en edificio no asignado',
    'FLR_SRCH_NT_ALLOWED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- SEARCH: VALIDACIONES (Resto de atributos) ---
 */

// ID Planta no numérico
$_POST = array('edificio_id' => '1', 'planta_id' => '1aa');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'PLANTA_ID', 'Planta ID no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre planta corto (menos de 3 caracteres)
$_POST = array('edificio_id' => '1', 'nombre' => 'aa');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'NOMBRE', 'Nombre Planta corto',
    'FLR_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre planta largo (más de 40 caracteres)
$_POST = array('edificio_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'NOMBRE', 'Nombre Planta largo',
    'FLR_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre planta formato
$_POST = array('edificio_id' => '1', 'nombre' => 'planta n^mero dos');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'NOMBRE', 'Nombre Planta formato',
    'FLR_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Num Planta más de 3 dígitos
$_POST = array('edificio_id' => '1', 'num_planta' => '1234');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'NUM_PLANTA', 'Num Planta más de 3 dígitos',
    'NUM_FLOOR_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Num Planta no numérico
$_POST = array('edificio_id' => '1', 'num_planta' => 'bajo');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'NUM_PLANTA', 'Num Planta no numérico',
    'NUM_FLOOR_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- SEARCH: ACCIONES (Búsqueda Ok) ---
 */

// Búsqueda Ok.
$_POST = array('edificio_id' => '1', 'nombre' => 'Planta Uno');
$feedback = $floor_service->SEARCH();
$respTest = obtenerRespuesta('Planta', 'SEARCH', 'ACCION', 'Búsqueda Ok',
    'FLR_SRCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID Planta Vacío
$_POST = array('planta_id' => '');
$feedback = $floor_service->seek();
$respTest = obtenerRespuesta('Planta', 'SEEK', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Planta no numérico
$_POST = array('planta_id' => '12a');
$feedback = $floor_service->seek();
$respTest = obtenerRespuesta('Planta', 'SEEK', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La planta no existe
$_POST = array('planta_id' => '1111');
$feedback = $floor_service->seek();
$respTest = obtenerRespuesta('Planta', 'SEEK', 'ACCION', 'La planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// La planta no pertenece a un edificio asignado al responsable
$_SESSION['username'] = 'sg2ped2';
$_POST = array('planta_id' => '1');
$feedback = $floor_service->seek();
$respTest = obtenerRespuesta('Planta', 'SEEK', 'ACCION', 'La planta no pertenece a un edificio asignado al responsable',
    'FLR_SEEK_NOT_ALLOWED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Consulta Ok
$_SESSION['username'] = 'sg2ped';
$_POST = array('planta_id' => '1');
$feedback = $floor_service->seek();
$respTest = obtenerRespuesta('Planta', 'SEEK', 'ACCION', 'Seek Ok',
    'FLR_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

unset($_SESSION['username']);
unset($_SESSION['rol']);

/*
 *  --- EMPTY_FORM: Validaciones ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->emptyForm();
$respTest = obtenerRespuesta('Planta', 'EMPTY_FORM', 'EDIFICIO_ID', 'Edificio ID vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => '1a');
$floor_service = new Floor_Service();
$feedback = $floor_service->emptyForm();
$respTest = obtenerRespuesta('Planta', 'EMPTY_FORM', 'EDIFICIO_ID', 'Edificio ID no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- EMPTY_FORM: Acciones ---
 */

// El edificio no existe
$_POST = array('edificio_id' => '1111');
$floor_service = new Floor_Service();
$feedback = $floor_service->emptyForm();
$respTest = obtenerRespuesta('Planta', 'EMPTY_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// El edificio existe
$_POST = array('edificio_id' => '1');
$floor_service = new Floor_Service();
$feedback = $floor_service->emptyForm();
$respTest = obtenerRespuesta('Planta', 'EMPTY_FORM', 'ACCION', 'El edificio existe',
    'BLDID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- ADD: Validaciones (Edificio) ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'EDIFICIO_ID', 'Edificio ID vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => '1a');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'EDIFICIO_ID', 'Edificio ID no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- ADD: ACCIONES (Edificio) ---
 */

// El edificio no existe
$_POST = array('edificio_id' => '1111');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- ADD: Validaciones ---
 */

// Nombre de planta corto (menos de 3 caracteres)
$_POST = array('edificio_id' => '1', 'nombre' => 'aa');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NOMBRE', 'Nombre de planta corto',
    'FLR_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre de planta largo (más de 40 caracteres)
$_POST = array('edificio_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NOMBRE', 'Nombre de planta largo',
    'FLR_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre de planta formato
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de pl^ta');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NOMBRE', 'Nombre de planta formato',
    'FLR_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Numero de Planta vacío
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NUM_PLANTA', 'Número de planta vacío',
    'NUM_FLOOR_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Número de planta mayor de 3 dígitos
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '1234');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NUM_PLANTA', 'Número de planta mayor de 3 dígitos',
    'NUM_FLOOR_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Número de planta no numérico
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12a');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NUM_PLANTA', 'Número de planta no numérico',
    'NUM_FLOOR_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Descripción de planta vacío
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'DESCRIPCION', 'Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Descripción caracteres no permitidos
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => 'Descrición del+Te*xto');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'DESCRIPCION', 'Descripción caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Extensión de la foto de la planta no permitido
$_FILES = array('foto_planta' => array('nombre' => './foto.php'));
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => 'Descripción', 'foto_planta' => 'foto.php');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'FOTO_PLANTA', 'Extensión no permitida',
    'FLR_PH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

//  Nombre de foto planta inválido
$_FILES = array('foto_planta' => array('nombre' => './f+to.jpg'));
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => 'Descripción', 'foto_planta' => 'f+to.jpg');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'FOTO_PLANTA', 'Formato nombre de la foto inválido',
    'FLR_PH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);
unset($_FILES);

/*
 *  --- ADD: ACCIONES ---
 */

// Ya existe una planta con ese número de planta en el edificio
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '1',
    'descripcion' => 'Descripción');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'ACCION', 'Ya existe el número de planta',
    'FLR_NUM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Error al subir la foto de la planta
$_FILES = array('foto_planta' => array('tmp_name' => './foto.jpg', 'name' => './foto.jpg'));
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '11',
    'descripcion' => 'Descripción', 'foto_planta' => 'foto.jpg');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'ACCION', 'Error al subir la foto',
    'FLR_PH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);
unset($_FILES);

// Planta añadida correctamente
$_POST = array('edificio_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '11',
    'descripcion' => 'Descripción');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'ACCION', 'Error al subir la foto',
    'FLR_PH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);
if($feedback['ok']) {
    $planta_id = $floor_service->floor_entity->planta_id;
} else {
    $planta_id = '';
}

/*
 *  --- DATA_FORM: VALIDACIONES ---
 */

// ID Planta Vacío
$_POST = array('planta_id' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->dataForm();
$respTest = obtenerRespuesta('Planta', 'DATA_FORM', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Planta no numérico
$_POST = array('planta_id' => '12a');
$floor_service = new Floor_Service();
$feedback = $floor_service->dataForm();
$respTest = obtenerRespuesta('Planta', 'DATA_FORM', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- DATA_FORM: ACCIONES ---
 */

// La Planta no existe
$_POST = array('planta_id' => '1111');
$floor_service = new Floor_Service();
$feedback = $floor_service->dataForm();
$respTest = obtenerRespuesta('Planta', 'DATA_FORM', 'ACCION', 'La planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// La planta existe
$_POST = array('planta_id' => '1');
$floor_service = new Floor_Service();
$feedback = $floor_service->dataForm();
$respTest = obtenerRespuesta('Planta', 'DATA_FORM', 'ACCION', 'La planta existe',
    'FLRID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID Planta Vacío
$_POST = array('planta_id' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->DELETE();
$respTest = obtenerRespuesta('Planta', 'DELETE', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Planta no numérico
$_POST = array('planta_id' => '12a');
$floor_service = new Floor_Service();
$feedback = $floor_service->DELETE();
$respTest = obtenerRespuesta('Planta', 'DELETE', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La Planta no existe
$_POST = array('planta_id' => '1111');
$floor_service = new Floor_Service();
$feedback = $floor_service->DELETE();
$respTest = obtenerRespuesta('Planta', 'DELETE', 'ACCION', 'La planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// La Planta tiene espacios asociados
$_POST = array('planta_id' => '1');
$floor_service = new Floor_Service();
$feedback = $floor_service->DELETE();
$respTest = obtenerRespuesta('Planta', 'DELETE', 'ACCION', 'La planta tiene espacios asociados',
    'FLR_SPC_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// La Planta tiene rutas asociadas
$_POST = array('planta_id' => '2');
$floor_service = new Floor_Service();
$feedback = $floor_service->DELETE();
$respTest = obtenerRespuesta('Planta', 'DELETE', 'ACCION', 'La planta tiene rutas asociadas',
    'FLR_RT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// La Planta se elimina correctamente
$_POST = array('planta_id' => $planta_id);
$floor_service = new Floor_Service();
$feedback = $floor_service->DELETE();
$respTest = obtenerRespuesta('Planta', 'DELETE', 'ACCION', 'Planta eliminada Ok',
    'FLR_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

/*
 *  --- EDIT: VALIDACIONES (Planta)---
 */

// ID Planta Vacío
$_POST = array('planta_id' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->EDIT();
$respTest = obtenerRespuesta('Planta', 'EDIT', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// ID Planta no numérico
$_POST = array('planta_id' => '12a');
$floor_service = new Floor_Service();
$feedback = $floor_service->EDIT();
$respTest = obtenerRespuesta('Planta', 'EDIT', 'PLANTA_ID', 'ID Planta vacío',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- EDIT: ACCIONES (Planta)---
 */

// La Planta no existe
$_POST = array('planta_id' => '1111');
$floor_service = new Floor_Service();
$feedback = $floor_service->EDIT();
$respTest = obtenerRespuesta('Planta', 'EDIT', 'ACCION', 'La planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// Nombre de planta corto (menos de 3 caracteres)
$_POST = array('planta_id' => '1', 'nombre' => 'aa');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NOMBRE', 'Nombre de planta corto',
    'FLR_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre de planta largo (más de 40 caracteres)
$_POST = array('planta_id' => '1', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NOMBRE', 'Nombre de planta largo',
    'FLR_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Nombre de planta formato
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de pl^ta');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NOMBRE', 'Nombre de planta formato',
    'FLR_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Numero de Planta vacío
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NUM_PLANTA', 'Número de planta vacío',
    'NUM_FLOOR_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Número de planta mayor de 3 dígitos
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '1234');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NUM_PLANTA', 'Número de planta mayor de 3 dígitos',
    'NUM_FLOOR_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Número de planta no numérico
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12a');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'NUM_PLANTA', 'Número de planta no numérico',
    'NUM_FLOOR_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Descripción de planta vacío
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => '');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'DESCRIPCION', 'Descripción vacía',
    'DESC_EMPTY', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Descripción caracteres no permitidos
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => 'Descrición del+Te*xto');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'DESCRIPCION', 'Descripción caracteres no permitidos',
    'DESC_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

// Extensión de la foto de la planta no permitido
$_FILES = array('foto_planta' => array('nombre' => './foto.php'));
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => 'Descripción', 'foto_planta' => 'foto.php');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'FOTO_PLANTA', 'Extensión no permitida',
    'FLR_PH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);

//  Nombre de foto planta inválido
$_FILES = array('foto_planta' => array('nombre' => './f+to.jpg'));
$_POST = array('planta_id' => '1', 'nombre' => 'nombre de la planta', 'num_planta' => '12',
    'descripcion' => 'Descripción', 'foto_planta' => 'f+to.jpg');
$floor_service = new Floor_Service();
$feedback = $floor_service->ADD();
$respTest = obtenerRespuesta('Planta', 'ADD', 'FOTO_PLANTA', 'Formato nombre de la foto inválido',
    'FLR_PH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testPlanta, $respTest);


//------------------------------------------------------------------------------
//Fin test plantas
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Planta'] = $testPlanta;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;
