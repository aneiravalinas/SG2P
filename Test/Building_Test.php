<?php

include_once './Service/Building_Service.php';
$testEdificio = array();
$numTest = 0;
$numFallos = 0;

/*
 *  --- SEARCH_FORM: ACCION ---
 */

$building_service = new Building_Service();
$feedback = $building_service->searchForm();
$respTest = obtenerRespuesta('Edificio','SEARCH_FORM','ACCION','Obtiene usuarios con rol de responable de edificio',
    'QRY_DATA', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// Edificio ID no numérico
$_POST = array('edificio_id' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','EDIFICIO_ID','Edifico ID no numérico',
        'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de Usuario (Responsable) corto (menos de 3 caracteres)
$_POST = array('username' => 'aa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','EDIFICIO_ID','Nombre del responsable corto',
    'MANG_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de Usuario (Responsable) largo (más de 20 caracteres)
$_POST = array('username' => 'aaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','EDIFICIO_ID','Nombre del responsable largo',
    'MANG_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de Usuario (Responsable) formato
$_POST = array('username' => 'user1**');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','EDIFICIO_ID','Nombre del responsable no alfanumérico',
    'MANG_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de edificio corto (menos de 3 caracteres)
$_POST = array('nombre' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','NOMBRE','Nombre del edificio corto',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de edificio largo (más de 60 caracteres)
$_POST = array('nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','NOMBRE','Nombre del edificio largo',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de edificio formato
$_POST = array('nombre' => 'ediifi*');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','NOMBRE','Formato nombre edificio incorrecto',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Calle corta (menos de 3 carcteres)
$_POST = array('calle' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CALLE','Calle corta',
    'CALLE_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Calle larga (más de 60 carcteres)
$_POST = array('calle' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CALLE','Calle larga',
    'CALLE_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Calle formato
$_POST = array('calle' => 'calle a*');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CALLE','Calle formato',
    'CALLE_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Ciudad corta (menos de 3 caracteres)
$_POST = array('ciudad' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CIUDAD','Ciudad corta',
    'CIUDAD_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Ciudad larga (más de 40 caracteres)
$_POST = array('ciudad' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CIUDAD','Ciudad larga',
    'CIUDAD_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Ciudad formato
$_POST = array('ciudad' => 'ci^udad');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CIUDAD','Ciudad formato',
    'CIUDAD_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Provincia corta (menos de 3 caracteres)
$_POST = array('provincia' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','PROVINCIA','Provincia corta',
    'PROV_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Provincia larga (más de 40 caracteres)
$_POST = array('provincia' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','PROVINCIA','Provincia larga',
    'PROV_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Provincia Formato
$_POST = array('provincia' => 'prov^ncia');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','PROVINCIA','Provincia formato',
    'PROV_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Codigo Postal no numérico
$_POST = array('codigo_postal' => '366a');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CODIGO_POSTAL','Codigo postal no numérico',
    'CP_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Codigo Postal más de 5 dígitos
$_POST = array('codigo_postal' => '3666888');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','CODIGO_POSTAL','Codigo postal más de 5 dígitos',
    'CP_MAX_SIZE', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Telefono largo (más de 9 dígitos)
$_POST = array('telefono' => '9999999999');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','TELEFONO','Teléfono largo',
    'TLF_MAX_SIZE', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Teléfono no numérico
$_POST = array('telefono' => '9865739aa');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio','SEARCH','TELEFONO','Teléfono no numérico',
    'TLF_WITH_LETTERS', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda Ok.
$_SESSION['rol'] = 'edificio';
$_POST = array('nombre' => 'Edificio Uno');
$building_service = new Building_Service();
$feedback = $building_service->SEARCH();
$respTest = obtenerRespuesta('Edificio', 'SEARCH', 'ACCION', 'Búsqueda Ok',
    'BLD_SRCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);
unset($_SESSION['rol']);

/*
 *  --- ADD_FORM: ACCIONES ---
 */

// Recupera usuarios candidatos a reponsable de edificio
$building_service = new Building_Service();
$feedback = $building_service->addForm();
$respTest = obtenerRespuesta('Edificio', 'ADD_FORM', 'ACCION', 'Recupera usuarios candidatos',
    'QRY_DATA', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- DELETE_FORM: VALIDACIONS ---
 */

// ID edificio vacío
$_POST = array('edificio_id' => '');
$building_service = new Building_Service();
$feedback = $building_service->deleteForm();
$respTest = obtenerRespuesta('Edificio', 'DELETE_FORM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => '12A');
$building_service = new Building_Service();
$feedback = $building_service->deleteForm();
$respTest = obtenerRespuesta('Edificio', 'DELETE_FORM', 'EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- DELETE_FORM: ACCIONES ---
 */

// EDIFICIO ID no existe
$_POST = array('edificio_id' => '111');
$building_service = new Building_Service();
$feedback = $building_service->deleteForm();
$respTest = obtenerRespuesta('Edificio', 'DELETE_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Edificio existe
$_POST = array('edificio_id' => '1');
$building_service = new Building_Service();
$feedback = $building_service->deleteForm();
$respTest = obtenerRespuesta('Edificio', 'DELETE_FORM', 'ACCION', 'El edificio existe',
    'BLDID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- ADD: VALIDACIONES ---
 */

// Nombre de Usuario (Responsable) corto (menos de 3 caracteres)
$_POST = array('username' => 'aa');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','USERNAME','Nombre del responsable corto',
    'MANG_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de Usuario (Responsable) largo (más de 20 caracteres)
$_POST = array('username' => 'aaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','USERNAME','Nombre del responsable largo',
    'MANG_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de Usuario (Responsable) formato
$_POST = array('username' => 'user1**');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','USERNAME','Nombre del responsable no alfanumérico',
    'MANG_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de edificio corto (menos de 3 caracteres)
$_POST = array('username' => 'usuario', 'nombre' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','NOMBRE','Nombre del edificio corto',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de edificio largo (más de 60 caracteres)
$_POST = array('username' => 'usuario', 'nombre' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','NOMBRE','Nombre del edificio largo',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Nombre de edificio formato
$_POST = array('username' => 'usuario', 'nombre' => 'ediifi*');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','NOMBRE','Formato nombre edificio incorrecto',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Calle corta (menos de 3 carcteres)
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio' ,'calle' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CALLE','Calle corta',
    'CALLE_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Calle larga (más de 60 carcteres)
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CALLE','Calle larga',
    'CALLE_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Calle formato
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle a*');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CALLE','Calle formato',
    'CALLE_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Ciudad corta (menos de 3 caracteres)
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle', 'ciudad' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CIUDAD','Ciudad corta',
    'CIUDAD_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Ciudad larga (más de 40 caracteres)
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CIUDAD','Ciudad larga',
    'CIUDAD_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Ciudad formato
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ci^udad');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CIUDAD','Ciudad formato',
    'CIUDAD_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Provincia corta (menos de 3 caracteres)
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'a');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','PROVINCIA','Provincia corta',
    'PROV_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Provincia larga (más de 40 caracteres)
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','PROVINCIA','Provincia larga',
    'PROV_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Provincia Formato
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'prov^ncia');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','PROVINCIA','Provincia formato',
    'PROV_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Codigo Postal vacío
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CODIGO_POSTAL','Codigo postal vacío',
    'CP_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Codigo Postal no numérico
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '366a');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CODIGO_POSTAL','Codigo postal no numérico',
    'CP_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Codigo Postal tamaño distinto a 5 dígitos
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '3666888');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','CODIGO_POSTAL','Codigo postal tamaño',
    'CP_SIZE', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Telefono vacío
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','TELEFONO','Teléfono vacío',
    'TLF_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Formato Teléfono
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '555555555');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','TELEFONO','Teléfono formato',
    'TLF_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Extensión foto edificio
$_FILES = array('foto_edificio' => array('name' => '/photo.php'));
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '666222345', 'foto_edificio' => 'photo.php');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','FOTO_EDIFICIO','Extensión no permitida',
    'BLD_PH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Formato nombre foto edificio
$_FILES = array('foto_edificio' => array('name' => '/pho*to.jpg'));
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '666222345', 'foto_edificio' => 'pho*to.jpg');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','FOTO_EDIFICIO','Formato nombre foto edificio incorrecto',
    'BLD_PH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);
unset($_FILES);

/*
 *  --- ADD: ACCIONES ---
 */

// El usuario que se informa como responsable de edificio no existe.
$_POST = array('username' => 'usuario', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '666222345');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','ACCION','El candidato a responsable no existe',
    'MANG_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// El usuario no es un candidato válido a responsable de edificio
$_POST = array('username' => 'sg2padmin', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '666222345');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','ACCION','El candidato a responsable no es válido',
    'MANG_INV', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Error al subir la foto del edificio
$_FILES = array('foto_edificio' => array('tmp_name' => './foto.jpg', 'name' => './foto.jpg'));
$_POST = array('username' => 'sg2ped', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '666222345', 'foto_edificio' => 'foto.jpg');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','ACCION','Error al subir la foto del edificio',
    'BLD_PH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);
unset($_FILES);

// Edificio añadido Ok
$_POST = array('username' => 'sg2ped', 'nombre' => 'Nombre Edificio', 'calle' => 'calle',
    'ciudad' => 'ciudad', 'provincia' => 'provincia', 'codigo_postal' => '36687', 'telefono' => '666222345');
$building_service = new Building_Service();
$feedback = $building_service->ADD();
$respTest = obtenerRespuesta('Edificio','ADD','ACCION','Edificio añadido Ok',
    'BLD_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

if($feedback['ok']) {
    $edificio_id = $building_service->building_entity->edificio_id;
} else {
    $edificio_id = '';
}


/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$building_service = new Building_Service();
$feedback = $building_service->DELETE();
$respTest = obtenerRespuesta('Edificio','DELETE','EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => '1aa');
$building_service = new Building_Service();
$feedback = $building_service->DELETE();
$respTest = obtenerRespuesta('Edificio','DELETE','EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El Edificio no existe
$_POST = array('edificio_id' => '11111');
$building_service = new Building_Service();
$feedback = $building_service->DELETE();
$respTest = obtenerRespuesta('Edificio','DELETE','ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// El edificio tiene plantas asociadas
$_POST = array('edificio_id' => '1');
$building_service = new Building_Service();
$feedback = $building_service->DELETE();
$respTest = obtenerRespuesta('Edificio','DELETE','ACCION', 'El edificio tiene plantas asociadas',
    'BLD_FLR_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// El edificio tiene planes asociados
$_POST = array('edificio_id' => '1');
$building_service = new Building_Service();
$feedback = $building_service->DELETE();
$respTest = obtenerRespuesta('Edificio','DELETE','ACCION', 'El edificio tiene planes asociadas',
    'BLD_PLN_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// Edificio borrado Ok
$_POST = array('edificio_id' => $edificio_id);
$building_service = new Building_Service();
$feedback = $building_service->DELETE();
$respTest = obtenerRespuesta('Edificio','DELETE','ACCION', 'Edificio borrado correctamente',
    'BLD_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- EDIT_FORM: VALIDACIONES ---
 */

// ID Edificio vacío
$_POST = array('edificio_id' => '');
$building_service = new Building_Service();
$feedback = $building_service->editForm();
$respTest = obtenerRespuesta('Edificio','EDIT_FORM','EDIFICIO_ID', 'ID Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// ID Edificio no numérico
$_POST = array('edificio_id' => '1aa');
$building_service = new Building_Service();
$feedback = $building_service->editForm();
$respTest = obtenerRespuesta('Edificio','EDIT_FORM','EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

/*
 *  --- EDIT_FORM: ACCIONES ---
 */

// El edificio no existe
$_POST = array('edificio_id' => '1111');
$building_service = new Building_Service();
$feedback = $building_service->editForm();
$respTest = obtenerRespuesta('Edificio','EDIT_FORM','EDIFICIO_ID', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);

// El edificio existe
$_POST = array('edificio_id' => '1');
$building_service = new Building_Service();
$feedback = $building_service->editForm();
$respTest = obtenerRespuesta('Edificio','EDIT_FORM','EDIFICIO_ID', 'El edificio existe',
    'BLDID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testEdificio, $respTest);


/*
 *  --- EDIT: VALIDACIONES ---
 */


//------------------------------------------------------------------------------
//Fin test edificios
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Edificio'] = $testEdificio;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;

