<?php

include_once './Service/Notification_Service.php';
$testNotification = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEARCH: VALIDACIONES (Usuario) ---
 */

// Nombre de usuario corto (menos de 3 caracteres)
$_POST = array('username' => 'aa');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'NOMBRE_USUARIO', 'Nombre de usuario corto (menos de 3 caracteres)',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Nombre de usuario largo (más de 20 caracteres)
$_POST = array('username' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'NOMBRE_USUARIO', 'Nombre de usuario largo (más de 20 caracteres)',
    'USRNM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Nombre de usuario con caracteres no permitidos
$_POST = array('username' => 'User*Test');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'NOMBRE_USUARIO', 'Nombre de usuario con caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);


/*
 *  --- SEARCH: ACCIONES (Usuario) ---
 */

// El usuario no existe
$_POST = array('username' => 'user');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'ACCION', 'El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */

// ID Edificio no numérico
$_POST = array('username' => 'sg2prg', 'edificio_id' => 'aa');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// ID Plan no numérico
$_POST = array('username' => 'sg2prg', 'edificio_id' => '1', 'plan_id' => 'aa');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'PLAN_ID', 'ID Plan no numérico',
    'DFPLAN_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Valor leído incorrecto
$_POST = array('username' => 'sg2prg', 'edificio_id' => '1', 'plan_id' => '1', 'leido' => 'leido');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'LEIDO', 'Valor leído incorrecto',
    'READ_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Fecha inicio incorrecta
$_POST = array('username' => 'sg2prg', 'edificio_id' => '1', 'plan_id' => '1', 'leido' => 'yes', 'fecha_inicio' => '2012/12-25');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'FECHA_INICIO', 'Fecha inicio incorrecta',
    'START_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Fecha fin incorrecta
$_POST = array('username' => 'sg2prg', 'edificio_id' => '1', 'plan_id' => '1', 'leido' => 'yes', 'fecha_inicio' => '2012/12/25', 'fecha_fin' => '2012/12-25');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'FECHA_FIN', 'Fecha fin incorrecta',
    'END_DATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda de notificaciones Ok
$_POST = array('username' => 'sg2prg', 'edificio_id' => '1', 'plan_id' => '1', 'leido' => 'yes', 'fecha_inicio' => '2012/12/25', 'fecha_fin' => '2012/12/25');
$notification_service = new Notification_Service();
$feedback = $notification_service->search();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'ACCION', 'Búsqueda de notificaciones Ok',
    'NTF_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEARCH_FORM: VALIDACIONES ---
 */

// Nombre de usuario corto (menos de 3 caracteres)
$_POST = array('username' => 'aa');
$notification_service = new Notification_Service();
$feedback = $notification_service->searchForm();
$respTest = obtenerRespuesta('Notification', 'SEARCH_FORM', 'NOMBRE_USUARIO', 'Nombre de usuario corto (menos de 3 caracteres)',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Nombre de usuario largo (más de 20 caracteres)
$_POST = array('username' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$notification_service = new Notification_Service();
$feedback = $notification_service->searchForm();
$respTest = obtenerRespuesta('Notification', 'SEARCH_FORM', 'NOMBRE_USUARIO', 'Nombre de usuario largo (más de 20 caracteres)',
    'USRNM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Nombre de usuario con caracteres no permitidos
$_POST = array('username' => 'User*Test');
$notification_service = new Notification_Service();
$feedback = $notification_service->searchForm();
$respTest = obtenerRespuesta('Notification', 'SEARCH_FORM', 'NOMBRE_USUARIO', 'Nombre de usuario con caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEARCH_FORM: ACCIONES ---
 */

// El usuario no existe
$_POST = array('username' => 'user');
$notification_service = new Notification_Service();
$feedback = $notification_service->searchForm();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'ACCION', 'El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Search Form Ok
$_POST = array('username' => 'sg2prg');
$notification_service = new Notification_Service();
$feedback = $notification_service->searchForm();
$respTest = obtenerRespuesta('Notification', 'SEARCH', 'ACCION', 'Search Form Ok',
    'NTF_SEARCH_FORM_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEEK_NOTIFICATION: VALIDACIONES ---
 */

// ID Notificación vacío
$_POST = array('id_notificacion' => '');
$notification_service = new Notification_Service();
$feedback = $notification_service->seekNotification();
$respTest = obtenerRespuesta('Notification', 'SEEK_NOTIFICATION', 'NOTIFICACION_ID', 'ID Notificación vacío',
    'NTFID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// ID Notificación no numérico
$_POST = array('id_notificacion' => 'aaa');
$notification_service = new Notification_Service();
$feedback = $notification_service->seekNotification();
$respTest = obtenerRespuesta('Notification', 'SEEK_NOTIFICATION', 'NOTIFICACION_ID', 'ID Notificación no numérico',
    'NTFID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEEK_NOTIFICATION: ACCIONES ---
 */

// La notificación no existe
$_POST = array('id_notificacion' => '11111111111111111');
$notification_service = new Notification_Service();
$feedback = $notification_service->seekNotification();
$respTest = obtenerRespuesta('Notification', 'SEEK_NOTIFICATION', 'ACCION', 'La notificación no existe',
    'NTFID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// La notificación no está dirigida al usuario
$_SESSION['username'] = 'sg2porg';

$_POST = array('id_notificacion' => '1');
$notification_service = new Notification_Service();
$feedback = $notification_service->seekNotification();
$respTest = obtenerRespuesta('Notification', 'SEEK_NOTIFICATION', 'ACCION', 'La notificación no está dirigida al usuario',
    'NTF_USR_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Seek Notification Ok
$_SESSION['username'] = 'sg2prg';

$_POST = array('id_notificacion' => '1');
$notification_service = new Notification_Service();
$feedback = $notification_service->seekNotification();
$respTest = obtenerRespuesta('Notification', 'SEEK_NOTIFICATION', 'ACCION', 'Seek Notification Ok',
    'NTFID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

unset($_SESSION['username']);


/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID Notificación vacío
$_POST = array('id_notificacion' => '');
$notification_service = new Notification_Service();
$feedback = $notification_service->seek();
$respTest = obtenerRespuesta('Notification', 'SEEK', 'NOTIFICACION_ID', 'ID Notificación vacío',
    'NTFID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// ID Notificación no numérico
$_POST = array('id_notificacion' => 'aaa');
$notification_service = new Notification_Service();
$feedback = $notification_service->seek();
$respTest = obtenerRespuesta('Notification', 'SEEK', 'NOTIFICACION_ID', 'ID Notificación no numérico',
    'NTFID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La notificación no existe
$_POST = array('id_notificacion' => '11111111111111111');
$notification_service = new Notification_Service();
$feedback = $notification_service->seek();
$respTest = obtenerRespuesta('Notification', 'SEEK', 'ACCION', 'La notificación no existe',
    'NTFID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// La notificación no está dirigida al usuario
$_SESSION['username'] = 'sg2porg';

$_POST = array('id_notificacion' => '1');
$notification_service = new Notification_Service();
$feedback = $notification_service->seek();
$respTest = obtenerRespuesta('Notification', 'SEEK', 'ACCION', 'La notificación no está dirigida al usuario',
    'NTF_USR_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Consulta de los detalles de la notificación Ok
$_SESSION['username'] = 'sg2prg';

$_POST = array('id_notificacion' => '1');
$notification_service = new Notification_Service();
$feedback = $notification_service->seek();
$respTest = obtenerRespuesta('Notification', 'SEEK', 'ACCION', 'Consulta de los detalles de la notificación Ok',
    'NTF_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);
unset($_SESSION['username']);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID Notificación vacío
$_POST = array('id_notificacion' => '');
$notification_service = new Notification_Service();
$feedback = $notification_service->delete();
$respTest = obtenerRespuesta('Notification', 'DELETE', 'NOTIFICACION_ID', 'ID Notificación vacío',
    'NTFID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// ID Notificación no numérico
$_POST = array('id_notificacion' => 'aaa');
$notification_service = new Notification_Service();
$feedback = $notification_service->delete();
$respTest = obtenerRespuesta('Notification', 'DELETE', 'NOTIFICACION_ID', 'ID Notificación no numérico',
    'NTFID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La notificación no existe
$_POST = array('id_notificacion' => '11111111111111111');
$notification_service = new Notification_Service();
$feedback = $notification_service->delete();
$respTest = obtenerRespuesta('Notification', 'DELETE', 'ACCION', 'La notificación no existe',
    'NTFID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// La notificación no está dirigida al usuario
$_SESSION['username'] = 'sg2porg';

$_POST = array('id_notificacion' => '1');
$notification_service = new Notification_Service();
$feedback = $notification_service->delete();
$respTest = obtenerRespuesta('Notification', 'DELETE', 'ACCION', 'La notificación no está dirigida al usuario',
    'NTF_USR_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

// Notificación eliminada Ok
$_SESSION['username'] = 'sg2prg';

$_POST = array('id_notificacion' => '1');
$notification_service = new Notification_Service();
$feedback = $notification_service->delete();
$respTest = obtenerRespuesta('Notification', 'DELETE', 'ACCION', 'Notificación eliminada Ok',
    'NTF_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testNotification, $respTest);

unset($_SESSION['username']);

if($feedback['ok']) {
    $notification_service->notification_entity->setAttributes(array('id_notificacion' => '1', 'username' => 'sg2prg', 'edificio_id' => '2',
                                                                'plan_id' => '1', 'mensaje' => 'mensaje'));
    $notification_service->notification_entity->ADD();
}
//------------------------------------------------------------------------------
//Fin test Notificaciones
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Notificaciones'] = $testNotification;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;