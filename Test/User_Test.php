<?php

include_once './Service/User_Service.php';

$testUsuario = array();
$numTest = 0;
$numFallos = 0;



/*
 *  --- LOGIN: VALIDACIONES ---
 */

// Username corto (menos de 3 caractres)
$_POST = array('username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','USERNAME','Username largo',
                'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password corta (menos de 32 caracteres)
$_POST = array('username' => 'username', 'password' => 'pss');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','PASSWORD','Password Corta',
    'PSW_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password larga (más de 32 caracteres)
$_POST = array('username' => 'username', 'password' => 'passssssssssssssssssssssssssssssssssss');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','PASSWORD','Password Larga',
    'PSW_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password Formato
$_POST = array('username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa*');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','PASSWORD','Password caracteres no permitidos',
    'PSW_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

/*
 *  --- LOGIN: ACCIONES ---
 */

// Username no existe
$_POST = array('username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','Acción','Username no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password Incorrecta
$_POST = array('username' => 'sg2padmin', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->login();
$respTest = obtenerRespuesta('Usuario','Login','Acción','Password Incorrecta',
    'LOG_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

/*
 *  --- SEARCH: VALIDACIONES ---
 */


// DNI SEARCH, formato incorrecto.
$_POST = array('dni' => '4ZZ');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','DNI','Formato de DNI incorrecto',
    'DNI_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username corto (menos de 3 caractres)
$_POST = array('username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Rol no válido
$_POST = array('rol' => 'rolrandom');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','ROL','Rol no válido',
    'ROL_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombe corto (menos de 3 caracteres)
$_POST = array('nombre' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','NOMBRE','Nombre corto',
    'NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre largo (más de 30 caracteres)
$_POST = array('nombre' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','NOMBRE','Nombre largo',
    'NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre con caracteres no permitidos
$_POST = array('nombre' => 'u1o2');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','NOMBRE','Nombre con caracteres no permitidos',
    'NAM_LT_SPC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos corto (menos de 3 caracteres)
$_POST = array('apellidos' => 'a');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','APELLIDOS','Apellidos corto',
    'SRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos largo (más de 60 caracteres)
$_POST = array('apellidos' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','APELLIDOS','Apellidos largo',
    'SRNM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos formato
$_POST = array('apellidos' => 'aiol3pQ+');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','APELLIDOS','Apellidos formato',
    'SRNM_LT_SPC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Email Formato
$_POST = array('email' => '@mail.es');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','EMAIL','Email formato',
    'EML_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Teléfono largo
$_POST = array('telefono' => '9999999999');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','TELEFONO','Telefono largo',
    'TLF_MAX_SIZE', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Teléfono no numérico
$_POST = array('telefono' => '999999a');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','TELEFONO','Telefono no numérico',
    'TLF_WITH_LETTERS', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

/*
 *  --- SEARCH: ACCIONES ---
 */

// Búsqueda Ok
$_POST = array('telefono' => '666666666');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','Acción','Busqueda Ok con datos',
    'USR_SRCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Búsqueda Ok Vacía
$_POST = array('telefono' => '566666666');
$user_service = new User_Service();
$feedback = $user_service->SEARCH();
$respTest = obtenerRespuesta('Usuario','Search','Acción','Busqueda Ok vacia',
    'USR_SRCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

/*
 *  --- ADD: VALIDACIONES ---
 */

// DNI vacío
$_POST = array('dni' => '');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','DNI','DNI vacío',
    'DNI_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Formato DNI
$_POST = array('dni' => '44093332E');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','DNI','Formato DNI incorrecto',
    'DNI_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username corto (menos de 3 caractres)
$_POST = array('dni' => '44093332D', 'username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('dni' => '44093332D', 'username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password corta (32 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => 'a');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','PASSWORD','Password Corta',
    'PSW_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password larga (32 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','PASSWORD','Password Corta',
    'PSW_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password caracteres no permitidos
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaa+aaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','PASSWORD','Password formato incorrecto',
    'PSW_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Rol vacío
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2', 'rol' => '');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ROL','Rol vacío',
    'ROL_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Rol incorrecto
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2', 'rol' => 'rol');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ROL','Rol Incorrecto',
    'ROL_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre corto (menos de 3 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'a');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','NOMBRE','Nombre corto',
    'NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre largo (más de 30 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','NOMBRE','Nombre largo',
    'NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre formato
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nom+bre');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','NOMBRE','Nombre formato',
    'NAM_LT_SPC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos corto (menos de 3 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'a');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','APELLIDOS','Apellidos corto',
    'SRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos largo (más de 60 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','APELLIDOS','Apellidos largo',
    'SRNM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos formato
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellido+s');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','APELLIDOS','Apellidos formato',
    'SRNM_LT_SPC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Email vacío
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => '');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','EMAIL','Email vacío',
    'EML_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Formato email
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@email@email.com');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','EMAIL','Formato email',
    'EML_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Telefono vacío
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','TELEFONO','Telefono vacio',
    'TLF_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Telefono formato
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '98657390a');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','TELEFONO','Formato telefono',
    'TLF_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Foto Perfil extensión
$_FILES = array('foto_perfil' => array('name' => '/photo.php'));
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901', 'foto_perfil' => 'photo.php');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','FOTO_PERFIL','Extension Incorrecta',
    'PRPH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Foto Perfil formato nombre
$_FILES = array('foto_perfil' => array('name' => '/ph+oto.jpg'));
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901', 'foto_perfil' => 'ph+oto.jpg');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','FOTO_PERFIL','Formato nombre foto',
    'PRPH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
unset($_FILES);

/*
 *  --- ADD: ACCIONES ---
 */

// Alta de usuario con rol de responsable de edificio
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'edificio', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','No se permite la asignación manual del rol resp. edificio',
    'BM_ADD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El DNI ya existe
$_POST = array('dni' => '14197701P', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','El DNI ya existe',
    'DNI_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El nombre de usuario ya existe
$_POST = array('dni' => '44093332D', 'username' => 'sg2ped', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','El nombre de usuario ya existe',
    'USRNM_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El email ya existe
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'red@email.es',
    'telefono' => '986573901');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','El email ya existe',
    'EML_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El teléfono ya existe
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.es',
    'telefono' => '666666668');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','El teléfono ya existe',
    'TLF_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Error al subir la foto
$_FILES = array('foto_perfil' => array('tmp_name' => './foto.jpg', 'name' => './foto.jpg'));
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.es',
    'telefono' => '986573901', 'foto_perfil' => 'foto.jpg');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','Error al subir la foto de perfil',
    'PRPH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
unset($_FILES);

// Usuario añadido con éxito
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.es',
    'telefono' => '986573901');
$user_service = new User_Service();
$feedback = $user_service->ADD();
$respTest = obtenerRespuesta('Usuario','ADD','ACCION','Usuario añadido Ok',
    'USR_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

if($feedback['ok']) {
    $username = 'username';
} else {
    $username = 'sg2prg';
}



/*
 *  --- EDIT PROFILE: VALIDACIONES ---
 */

// Username corto (menos de 3 caractres)
$_POST = array('username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password corta (32 caracteres)
$_POST = array('username' => 'username', 'password' => 'a');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','PASSWORD','Password Corta',
    'PSW_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password larga (32 caracteres)
$_POST = array('username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','PASSWORD','Password Corta',
    'PSW_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password caracteres no permitidos
$_POST = array('username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaa+aaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','PASSWORD','Password formato incorrecto',
    'PSW_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);


// Email vacío
$_POST = array('username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => '');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','EMAIL','Email vacío',
    'EML_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Formato email
$_POST = array('username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'email@email@email.com');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','EMAIL','Formato email',
    'EML_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Telefono vacío
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'email@test.com', 'telefono' => '');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','TELEFONO','Telefono vacio',
    'TLF_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Telefono formato
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'email@test.com', 'telefono' => '98657390a');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','TELEFONO','Formato telefono',
    'TLF_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);


// Foto Perfil extensión
$_FILES = array('foto_perfil' => array('name' => '/photo.php'));
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'email@test.com', 'telefono' => '986573901', 'foto_perfil' => 'photo.php');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','FOTO_PERFIL','Extension Incorrecta',
    'PRPH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Foto Perfil formato nombre
$_FILES = array('foto_perfil' => array('name' => '/ph+oto.jpg'));
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'email@test.com', 'telefono' => '986573901', 'foto_perfil' => 'ph+oto.jpg');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','FOTO_PERFIL','Formato nombre foto',
    'PRPH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
unset($_FILES);

/*
 *  --- EDIT PROFILE: ACCIONES ---
 */

// El perfil a editar no pertenece al usuario en sesión.
$_SESSION['username'] = 'otheruser';
$_POST = array('username' => 'sg2porg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'rorg@email.es', 'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','ACCION','El perfil a editar no pertenece al usuario en sesión',
    'PRF_USR_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);


// El usuario no existe
$_POST = array('username' => 'otheruser', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'rorg@email.es', 'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','ACCION','El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El email ya existe
$_SESSION['username'] = 'sg2porg';
$_POST = array('username' => 'sg2porg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'red@email.es', 'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','ACCION','El email ya existe',
    'EML_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El telefono ya existe
$_POST = array('username' => 'sg2porg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'rorg@email.es', 'telefono' => '666666668');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','ACCION','El telefono ya existe',
    'TLF_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);


// Error al subir la foto
$_FILES = array('foto_perfil' => array('tmp_name' => './foto.jpg', 'name' => './foto.jpg'));
$_POST = array('username' => 'sg2porg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'rorg@email.es', 'telefono' => '666666667', 'foto_perfil' => 'foto.jpg');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','ACCION','Error al subir la foto de perfil',
    'PRPH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
unset($_FILES);

// Perfil editado correctamente
$_POST = array('username' => 'sg2porg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
    'email' => 'rorg@email.es', 'telefono' => '666666660');
$user_service = new User_Service();
$feedback = $user_service->editProfile();
$respTest = obtenerRespuesta('Usuario','EDIT_PROFILE','ACCION','Perfil editado Ok',
    'PRF_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
if($feedback['ok']) {
    $_POST = array('username' => 'sg2porg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
        'email' => 'rorg@email.es', 'telefono' => '666666667');
    $user_service = new User_Service();
    $user_service->editProfile();
}
unset($_SESSION['username']);


/*
 *  --- EDIT: VALIDACIONES ---
 */

// DNI vacío
$_POST = array('dni' => '');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','DNI','DNI vacío',
    'DNI_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Formato DNI
$_POST = array('dni' => '44093332E');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','DNI','Formato DNI incorrecto',
    'DNI_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username corto (menos de 3 caractres)
$_POST = array('dni' => '44093332D', 'username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('dni' => '44093332D', 'username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password corta (32 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => 'a');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','PASSWORD','Password Corta',
    'PSW_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password larga (32 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','PASSWORD','Password Corta',
    'PSW_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Password caracteres no permitidos
$_POST = array('dni' => '44093332D', 'username' => 'username', 'password' => 'aaaaaaaaaaaaaaaaaaaaaaaa+aaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','PASSWORD','Password formato incorrecto',
    'PSW_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Rol vacío
$_POST = array('dni' => '44093332D', 'username' => 'username', 'rol' => '');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ROL','Rol vacío',
    'ROL_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Rol incorrecto
$_POST = array('dni' => '44093332D', 'username' => 'username', 'rol' => 'rol');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ROL','Rol Incorrecto',
    'ROL_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre corto (menos de 3 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username', 'rol' => 'registrado', 'nombre' => 'a');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','NOMBRE','Nombre corto',
    'NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre largo (más de 30 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','NOMBRE','Nombre largo',
    'NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Nombre formato
$_POST = array('dni' => '44093332D', 'username' => 'username', 'rol' => 'registrado', 'nombre' => 'nom+bre');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','NOMBRE','Nombre formato',
    'NAM_LT_SPC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos corto (menos de 3 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'a');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','APELLIDOS','Apellidos corto',
    'SRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos largo (más de 60 caracteres)
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','APELLIDOS','Apellidos largo',
    'SRNM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Apellidos formato
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellido+s');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','APELLIDOS','Apellidos formato',
    'SRNM_LT_SPC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Email vacío
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => '');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','EMAIL','Email vacío',
    'EML_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Formato email
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@email@email.com');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','EMAIL','Formato email',
    'EML_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Telefono vacío
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','TELEFONO','Telefono vacio',
    'TLF_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Telefono formato
$_POST = array('dni' => '44093332D', 'username' => 'username', 'rol' => 'registrado',
    'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com', 'telefono' => '98657390a');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','TELEFONO','Formato telefono',
    'TLF_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Foto Perfil extensión
$_FILES = array('foto_perfil' => array('name' => '/photo.php'));
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901', 'foto_perfil' => 'photo.php');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','FOTO_PERFIL','Extension Incorrecta',
    'PRPH_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Foto Perfil formato nombre
$_FILES = array('foto_perfil' => array('name' => '/ph+oto.jpg'));
$_POST = array('dni' => '44093332D', 'username' => 'username',
    'rol' => 'registrado', 'nombre' => 'nombre', 'apellidos' => 'apellidos', 'email' => 'email@test.com',
    'telefono' => '986573901', 'foto_perfil' => 'ph+oto.jpg');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','FOTO_PERFIL','Formato nombre foto',
    'PRPH_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
unset($_FILES);

/*
 *  --- EDIT: ACCIONES ---
 */


// El usuario no existe
$_POST = array('dni' => '84001360R', 'username' => 'otheruser',
    'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion', 'email' => 'rorg@email.es',
    'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El dni ya existe
$_POST = array('dni' => '14197701P', 'username' => 'sg2porg',
    'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion',
    'email' => 'rorg@email.es', 'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','El email ya existe',
    'DNI_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El email ya existe
$_POST = array('dni' => '84001360R', 'username' => 'sg2porg',
    'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion',
    'email' => 'admin@email.es', 'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','El email ya existe',
    'EML_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El telefono ya existe
$_POST = array('dni' => '84001360R', 'username' => 'sg2porg',
    'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion',
    'email' => 'rorg@email.es', 'telefono' => '666666668');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','El telefono ya existe',
    'TLF_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Modificar rol DE responsable de edifico CON edificios asignados
$_POST = array('dni' => '67453966A', 'username' => 'sg2ped',
    'rol' => 'registrado', 'nombre' => 'redificio', 'apellidos' => 'redificio',
    'email' => 'red@email.es', 'telefono' => '666666668');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','No se puede modificar el rol de resp. edificio mientras tenga edificios asignados',
    'BM_WITH_BLD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);


// Modificar el rol A responsable de edificio SIN edificios asignados.
$_POST = array('dni' => '20271577K', 'username' => 'sg2prg',
    'rol' => 'edificio', 'nombre' => 'registrado', 'apellidos' => 'registrado',
    'email' => 'rg@email.es', 'telefono' => '666666665');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','No se puede modificar el rol a resp. edificio sin edificios asignados',
    'BM_ADD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Modificar rol DE responsable organización sin más responsables de organización en el sistema.
$_POST = array('dni' => '84001360R', 'username' => 'sg2porg',
    'rol' => 'registrado', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion',
    'email' => 'rorg@email.es', 'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','El usuario es el único resp. organización en el sistema',
    'OM_UNQ_EDT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Modificar rol DE administrador sin más administradores en el sistema.
$_POST = array('dni' => '14197701P', 'username' => 'sg2padmin',
    'rol' => 'registrado', 'nombre' => 'admin', 'apellidos' => 'adminsurname',
    'email' => 'admin@email.es', 'telefono' => '666666666');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','El usuario es el único administrador en el sistema',
    'ADM_UNQ_EDT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Error al subir la foto
$_FILES = array('foto_perfil' => array('tmp_name' => './foto.jpg', 'name' => './foto.jpg'));
$_POST = array('dni' => '84001360R', 'username' => 'sg2porg',
    'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion', 'email' => 'rorg@email.es',
    'telefono' => '666666667', 'foto_perfil' => 'foto.jpg');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','Error al subir la foto de perfil',
    'PRPH_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);
unset($_FILES);

// Usuario editado correctamente.
$_SESSION['username'] = 'usertest';
$_POST = array('dni' => '84001360R', 'username' => 'sg2porg',
    'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'apellidos', 'email' => 'rorg@email.es',
    'telefono' => '666666667');
$user_service = new User_Service();
$feedback = $user_service->EDIT();
$respTest = obtenerRespuesta('Usuario','EDIT','ACCION','Usuario editado correctamente',
    'USR_EDT_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

if($feedback['ok']) {
    $_POST = array('dni' => '84001360R', 'username' => 'sg2porg',
        'rol' => 'organizacion', 'nombre' => 'rorganizacion', 'apellidos' => 'rorganizacion', 'email' => 'rorg@email.es',
        'telefono' => '666666667');
    $user_service = new User_Service();
    $user_service->EDIT();
}
unset($_SESSION['username']);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// Username corto (menos de 3 caractres)
$_POST = array('username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// El usuario no existe
$_POST = array('username' => 'otheruser');
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','ACCION','El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Eliminar resp. organizacion sin haber otro en sistema.
$_POST = array('username' => 'sg2porg');
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','ACCION','Único responsable de organización',
    'OM_UNQ_DEL', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Eliminar administrador sin haber otro en sistema.
$_POST = array('username' => 'sg2padmin');
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','ACCION','Único adminsitrador',
    'ADM_UNQ_DEL', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Usuario eliminado con éxito.
$_SESSION['username'] = 'usertest';
$_POST = array('username' => $username);
$user_service = new User_Service();
$feedback = $user_service->DELETE();
$respTest = obtenerRespuesta('Usuario','DELETE','ACCION','Usuario eliminado Ok',
    'USR_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

if($feedback['ok'] && $username == 'sg2prg') {
    $_POST = array('dni' => '20271577K', 'username' => 'sg2prg', 'password' => '7a25b0bc04e77a2f7453dd021168cdc2',
        'rol' => 'registrado', 'nombre' => 'registrado',
        'apellidos' => 'registrado', 'email' => 'rg@email.es', 'telefono' => '666666665');
    $user_service = new User_Service();
    $user_service->ADD();
}
unset($_SESSION['username']);

/*
 *  --- SEEK: VALIDACIONES ---
 */

// Username corto (menos de 3 caractres)
$_POST = array('username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->seek();
$respTest = obtenerRespuesta('Usuario','SEEK','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->seek();
$respTest = obtenerRespuesta('Usuario','SEEK','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->seek();
$respTest = obtenerRespuesta('Usuario','SEEK','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);


/*
 *  --- SEEK: ACCIONES ---
 */

// El usuario no existe
$_POST = array('username' => 'randomuser');
$user_service = new User_Service();
$feedback = $user_service->seek();
$respTest = obtenerRespuesta('Usuario','SEEK','USERNAME','El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// SEEK Ok
$_POST = array('username' => 'sg2porg');
$user_service = new User_Service();
$feedback = $user_service->seek();
$respTest = obtenerRespuesta('Usuario','SEEK','USERNAME','Seek Ok',
    'USR_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);



/*
 *  --- SEEK PORTAL MANAGER: VALIDACIONES ---
 */

// Username corto (menos de 3 caractres)
$_POST = array('username' => 'uu');
$user_service = new User_Service();
$feedback = $user_service->seekPortalManager();
$respTest = obtenerRespuesta('Usuario','SEEK_PORTAL_MNG','USERNAME','Username corto',
    'USRNM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Username largo (más de 20 caracteres)
$_POST = array('username' => 'uuuuuuuuuuuuuuuuuuuuuuuuuuuuuu');
$user_service = new User_Service();
$feedback = $user_service->seekPortalManager();
$respTest = obtenerRespuesta('Usuario','SEEK_PORTAL_MNG','USERNAME','Username largo',
    'USRNM_LRG', $_POST, $feedback['code'],$numTest,$numFallos);
array_push($testUsuario, $respTest);

// Username con con caracteres no permitidos
$_POST = array('username' => 'us**');
$user_service = new User_Service();
$feedback = $user_service->seekPortalManager();
$respTest = obtenerRespuesta('Usuario','SEEK_PORTAL_MNG','USERNAME','Username caracteres no permitidos',
    'USRNM_ALF', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

/*
 *  --- SEEK PORTAL MANAGER: ACCIONES ---
 */

// El usuario no existe
$_POST = array('username' => 'randomuser');
$user_service = new User_Service();
$feedback = $user_service->seekPortalManager();
$respTest = obtenerRespuesta('Usuario','SEEK_PORTAL_MNG','ACCION','El usuario no existe',
    'USRNM_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// El usuario solicitado no es responsable de edificio
$_POST = array('username' => 'sg2porg');
$user_service = new User_Service();
$feedback = $user_service->seekPortalManager();
$respTest = obtenerRespuesta('Usuario','SEEK_PORTAL_MNG','ACCION','El usuario no es responsable de edificio',
    'USR_NOT_MANG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

// Consulta de responsable del portal Ok
$_POST = array('username' => 'sg2ped');
$user_service = new User_Service();
$feedback = $user_service->seekPortalManager();
$respTest = obtenerRespuesta('Usuario','SEEK_PORTAL_MNG','ACCION','Consulta del responsable del portal Ok',
    'SEEK_MANG_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testUsuario, $respTest);

//------------------------------------------------------------------------------
//Fin test usuario
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Usuario'] = $testUsuario;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;
