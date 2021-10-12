<?php

include_once './Service/Route_Service.php';
$testRoute = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEEK_ROUTE: VALIDACIONES ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->seekRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_ROUTE', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->seekRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_ROUTE', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEEK_ROUTE: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '1111111111');
$route_service = new Route_Service();
$feedback = $route_service->seekRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_ROUTE', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// La ruta existe
$_POST = array('ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seekRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_ROUTE', 'ACCION', 'La ruta existe',
    'DFROUTEID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEARCH_IMPROUTES: VALIDACIONES (Ruta) ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEARCH_IMPROUTES: ACCIONES (Ruta) ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '1111111111');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEARCH_IMPROUTES: VALIDACIONES ---
 */

// ID de Planta no numérico
$_POST = array('ruta_id' => '1', 'planta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'PLANTA_ID', 'ID de Planta no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de cumplimentación inicial no válida
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha de cumplimentación inicial no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de cumplimentación final no válida
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha de cumplimentación final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de vencimiento inicial no válida
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
                'fecha_vencimiento_inicio' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'FECHA_VENCIMIENTO_INICIO', 'Fecha de vencimiento inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de vencimiento final no válida
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'FECHA_VENCIMIENTO_FIN', 'Fecha de vencimiento final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre de documento cumplimentación largo
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_DOC', 'Nombre de documento cumplimentación largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre de documento cumplimentación con formato incorrecto
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documet*o');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_DOC', 'Nombre de documento cumplimentación con formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => 'aa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Estado no válido
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
                    'estado' => 'estado');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'ESTADO', 'Estado no válido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre Planta corto (menos de 3 caracteres)
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'aa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_PLANTA', 'Nombre Planta Corto',
    'FLR_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre Planta largo (más de 40 caracteres)
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_PLANTA', 'Nombre Planta Largo',
    'FLR_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre planta formato
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'plant^a');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_PLANTA', 'Nombre Planta Largo',
    'FLR_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Edificio ID no numérico
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'nombre planta', 'edificio_id' => 'aa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'EDIFICIO_ID', 'Edificio ID no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre Edificio corto (menos de 3 caracteres)
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'nombre planta', 'edificio_id' => '1', 'nombre_edificio' => 'aa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_EDIFICIO', 'Nombre Edificio corto ',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre Edificio largo (más de 60 caracteres)
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'nombre planta', 'edificio_id' => '1', 'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_EDIFICIO', 'Nombre Edificio largo ',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre Edificio formato
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'nombre planta', 'edificio_id' => '1', 'nombre_edificio' => 'nombr^ edi+cio');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'NOMBRE_EDIFICIO', 'Nombre Edificio formato ',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);


/*
 *  --- SEARCH_IMPROUTES: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('ruta_id' => '1', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado', 'nombre_planta' => 'nombre planta', 'edificio_id' => '1', 'nombre_edificio' => 'nombre edificio');
$route_service = new Route_Service();
$feedback = $route_service->searchImpRoutes();
$respTest = obtenerRespuesta('Route', 'SEARCH_IMPROUTES', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPROUTE_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);


/*
 *  --- SEARCH_ROUTE: VALIDACIONES (RUTA Y EDIFICIO) ---
 */


// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio vacío
$_POST = array('ruta_id' => '1', 'edificio_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEARCH_ROUTE: ACCIONES (RUTA Y EDIFICIO) ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '11111111111111111111111111111', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no existe
$_POST = array('ruta_id' => '1', 'edificio_id' => '111111111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no está asignado al edificio
$_POST = array('ruta_id' => '1', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('ruta_id' => '1', 'edificio_id' => '2');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);


/*
 *  --- SEARCH_ROUTE: VALIDACIONES ---
 */

$_SESSION['username'] = 'sg2ped2';

// ID de Planta no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'PLANTA_ID', 'ID de Planta no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de cumplimentación inicial no válida
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha de cumplimentación inicial no válida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de cumplimentación final no válida
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha de cumplimentación final no válida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de vencimiento inicial no válida
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
                    'fecha_vencimiento_inicio' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'FECHA_VENCIMIENTO_INICIO', 'Fecha de vencimiento inicial no válida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fecha de vencimiento final no válida
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12-25');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'FECHA_VENCIMIENTO_FIN', 'Fecha de vencimiento final no válida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre de documento cumplimentación largo
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'NOMBRE_DOC', 'Nombre de documento cumplimentación largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre de documento cumplimentación con formato incorrecto
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documet*o');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'NOMBRE_DOC', 'Nombre de documento cumplimentación con formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => 'aa');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Estado no válido
$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'estado');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'ESTADO', 'Estado no válido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEARCH_ROUTE: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok

$_POST = array('ruta_id' => '1', 'edificio_id' => '2', 'planta_id' => '1', 'fecha_cumplimentacion_inicio' => '1992/12/25', 'fecha_cumplimentacion_fin' => '1992/12/25',
    'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25', 'nombre_doc' => 'documento.pdf', 'planta_ruta_id' => '1',
    'estado' => 'cumplimentado');
$route_service = new Route_Service();
$feedback = $route_service->searchRoute();
$respTest = obtenerRespuesta('Route', 'SEARCH_ROUTE', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'IMPROUTE_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK_PORTAL_ROUTE: VALIDACIONES (RUTA Y EDIFICIO) ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio vacío
$_POST = array('ruta_id' => '1', 'edificio_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEEK_PORTAL_ROUTE: ACCIONES (RUTA Y EDIFICIO) ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '11111111111111111111111111111', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no existe
$_POST = array('ruta_id' => '1', 'edificio_id' => '111111111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no está asignado al edificio
$_POST = array('ruta_id' => '1', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// La asignación entre el plan de la ruta y el edificio está vencida
$_POST = array('ruta_id' => '5', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'ACCION', 'La asignación entre el plan de la ruta y el edificio está vencida',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El estado de la ruta en el edificio es vencido
$_POST = array('ruta_id' => '1', 'edificio_id' => '2');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'ACCION', 'El estado de la ruta en el edificio es vencido',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);


/*
 *  --- SEEK_PORTAL_ROUTE: VALIDACIONES ---
 */

// ID de Planta no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => '5', 'planta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'PLANTA_ID', 'ID de Planta no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre de documento cumplimentación largo
$_POST = array('ruta_id' => '1', 'edificio_id' => '5', 'planta_id' => '1', 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'NOMBRE_DOC', 'Nombre de documento cumplimentación largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Nombre de documento cumplimentación con formato incorrecto
$_POST = array('ruta_id' => '1', 'edificio_id' => '5', 'planta_id' => '1', 'nombre_doc' => 'documet*o');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'NOMBRE_DOC', 'Nombre de documento cumplimentación con formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);



/*
 *  --- SEEK_PORTAL_ROUTE: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('ruta_id' => '1', 'edificio_id' => '5', 'planta_id' => '1', 'nombre_doc' => 'documento');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_ROUTE', 'ACCION', 'Búsqueda de cumplimentaciones Ok',
    'PRTL_IMPROUTE_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);


/*
 *  --- DATA_ROUTE_FORM: VALIDACIONES ---
 */


// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio vacío
$_POST = array('ruta_id' => '1', 'edificio_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- DATA_ROUTE_FORM: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '11111111111111111111111111111', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no existe
$_POST = array('ruta_id' => '1', 'edificio_id' => '111111111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no está asignado al edificio
$_POST = array('ruta_id' => '1', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('ruta_id' => '1', 'edificio_id' => '2');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no tiene plantas
$_SESSION['username'] = 'sg2ped2';

$_POST = array('ruta_id' => '1', 'edificio_id' => '2');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'ACCION', 'El edificio no tiene plantas',
    'BLD_FLOORS_SEARCH_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// DATA_ROUTE_FORM Ok
$_POST = array('ruta_id' => '1', 'edificio_id' => '5');
$route_service = new Route_Service();
$feedback = $route_service->dataRouteForm();
$respTest = obtenerRespuesta('Route', 'DATA_ROUTE_FORM', 'ACCION', 'DATA_ROUTE_FORM Ok',
    'BLD_FLOORS_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEARCH_PORTAL_ROUTE_FORM: VALIDACIONES ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio vacío
$_POST = array('ruta_id' => '1', 'edificio_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Edificio no numérico
$_POST = array('ruta_id' => '1', 'edificio_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEARCH_PORTAL_ROUTE_FORM: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '11111111111111111111111111111', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no existe
$_POST = array('ruta_id' => '1', 'edificio_id' => '111111111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no está asignado al edificio
$_POST = array('ruta_id' => '1', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// La asignación entre el plan de la ruta y el edificio está vencido
$_POST = array('ruta_id' => '5', 'edificio_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'ACCION', 'La asignación entre el plan de la ruta y el edificio está vencida',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no tiene plantas
$_POST = array('ruta_id' => '1', 'edificio_id' => '2');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'ACCION', 'El edificio no tiene plantas',
    'BLD_FLOORS_SEARCH_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// SEARCH_PORTAL_ROUTE_FORM OK
$_POST = array('ruta_id' => '1', 'edificio_id' => '5');
$route_service = new Route_Service();
$feedback = $route_service->searchPortalRouteForm();
$respTest = obtenerRespuesta('Route', 'SEARCH_PORTAL_ROUTE_FORM', 'ACCION', 'SEARCH_PORTAL_ROUTE_FORM OK',
    'BLD_FLOORS_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- ADD_ROUTE: VALIDACIONES ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de planta vacío
$_POST = array('ruta_id' => '1', 'planta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'PLANTA_ID', 'ID de planta vacío',
    'FLR_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de planta no numérico
$_POST = array('ruta_id' => '1', 'planta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'PLANTA_ID', 'ID de planta no numérico',
    'FLR_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- ADD_ROUTE: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '1111111111111111', 'planta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// La planta no existe
$_POST = array('ruta_id' => '1', 'planta_id' => '1111111111111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'ACCION', 'La planta no existe',
    'FLRID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para añadir cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';

$_POST = array('ruta_id' => '1', 'planta_id' => '4');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'ACCION', 'El usuario no tiene permisos para añadir cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no está asignado al edificio
$_POST = array('ruta_id' => '1', 'planta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'ACCION', 'El plan de la ruta no está asignado al edificio',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Cumplimentación añadida Ok
$_SESSION['username'] = 'sg2ped2';

$_POST = array('ruta_id' => '1', 'planta_id' => '4');
$route_service = new Route_Service();
$feedback = $route_service->addRoute();
$respTest = obtenerRespuesta('Route', 'ADD_ROUTE', 'ACCION', 'El usuario no tiene permisos para añadir cumplimentaciones en el edificio',
    'IMPROUTE_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

if($feedback['ok']) {
    $planta_ruta_id = $route_service->impRoute_entity->planta_ruta_id;
    $_POST = array('planta_ruta_id' => $planta_ruta_id);
    $route_service = new Route_Service();
    $feedback = $route_service->DELETE();
}

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- ADD_IMPROUTE_FORM: VALIDACIONES ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->addImpRouteForm();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE_FORM', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->addImpRouteForm();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE_FORM', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- ADD_IMPROUTE_FORM: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->addImpRouteForm();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE_FORM', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no tiene edificios asignados
$_POST = array('ruta_id' => '2');
$route_service = new Route_Service();
$feedback = $route_service->addImpRouteForm();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE_FORM', 'ACCION', 'El plan de la ruta no tiene edificios asignados',
    'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ADD_IMPROUTE_FORM Ok
$_POST = array('ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->addImpRouteForm();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE_FORM', 'ACCION', 'ADD_IMPROUTE_FORM Ok',
    'BLDPLAN_ASSIGN_ACTIVES_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- ADD_IMPROUTE: VALIDACIONES ---
 */

// ID de Ruta vacío
$_POST = array('ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'RUTA_ID', 'ID de Ruta vacío',
    'DFROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Ruta no numérico
$_POST = array('ruta_id' => 'aaa');
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'RUTA_ID', 'ID de Ruta no numérico',
    'DEFROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID Edificio vacío
$_POST = array('ruta_id' => '1', 'buildings' => array());
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'RUTA_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID Edificio no numérico
$_POST = array('ruta_id' => '1', 'buildings' => array('1', 'aaaa'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'RUTA_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- ADD_IMPROUTE: ACCIONES ---
 */

// La ruta no existe
$_POST = array('ruta_id' => '11111111111111111', 'buildings' => array('1'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'ACCION', 'La ruta no existe',
    'DFROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no existe
$_POST = array('ruta_id' => '1', 'buildings' => array('111111111111111111111111111111'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos sobre el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('ruta_id' => '1', 'buildings' => array('1'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'ACCION', 'El usuario no tiene permisos sobre el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El plan de la ruta no está asignado al edificio
$_SESSION['username'] = 'sg2ped';

$_POST = array('ruta_id' => '1', 'buildings' => array('1'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'ACCION', 'EEl plan de la ruta no está asignado al edificio',
    'BLDROUTE_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El edificio no tiene plantas asociadas
$_SESSION['username'] = 'sg2ped2';

$_POST = array('ruta_id' => '1', 'buildings' => array('2'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'ACCION', 'El usuario no tiene permisos sobre el edificio',
    'BLD_NOT_FLOORS', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Cumplimentación añadida Ok
$_SESSION['username'] = 'sg2ped';

$_POST = array('ruta_id' => '6', 'buildings' => array('7'));
$route_service = new Route_Service();
$feedback = $route_service->addImpRoute();
$respTest = obtenerRespuesta('Route', 'ADD_IMPROUTE', 'ACCION', 'Cumplimentación añadida Ok',
    'IMPROUTE_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

if($feedback['ok']) {
    $planta_ruta_id = $route_service->impRoute_entity->planta_ruta_id;
} else {
    $planta_ruta_id = '';
}

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('planta_ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->seek();
$respTest = obtenerRespuesta('Route', 'SEEK', 'PLANTA_RUTA_ID', 'ID de Cumplimentación vacío',
    'IMPROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('planta_ruta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->seek();
$respTest = obtenerRespuesta('Route', 'SEEK', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEEK: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('planta_ruta_id' => '1111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->seek();
$respTest = obtenerRespuesta('Route', 'SEEK', 'ACCION', 'La cumplimentación no existe',
    'IMPROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seek();
$respTest = obtenerRespuesta('Route', 'SEEK', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Consulta de los detalles de la cumplimentación Ok
$_SESSION['username'] = 'sg2ped';

$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seek();
$respTest = obtenerRespuesta('Route', 'SEEK', 'ACCION', 'Consulta de los detalles de la cumplimentación Ok',
    'IMPROUTE_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- SEEK_PORTAL_IMPROUTE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('planta_ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalImpRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_IMPROUTE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación vacío',
    'IMPROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('planta_ruta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalImpRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_IMPROUTE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- SEEK_PORTAL_IMPROUTE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('planta_ruta_id' => '1111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalImpRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_IMPROUTE', 'ACCION', 'La cumplimentación no existe',
    'IMPROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// La cumplimentación está vencida
$_POST = array('planta_ruta_id' => '3');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalImpRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_IMPROUTE', 'ACCION', 'La cumplimentación está vencida',
    'IMPROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Consulta de los detalles de la cumplimentación Ok
$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->seekPortalImpRoute();
$respTest = obtenerRespuesta('Route', 'SEEK_PORTAL_IMPROUTE', 'ACCION', 'Consulta de los detalles de la cumplimentación Ok',
    'PRTL_IMPROUTE_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES (Cumplimentación) ---
 */

// ID de Cumplimentación vacío
$_POST = array('planta_ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'PLANTA_RUTA_ID', 'ID de Cumplimentación vacío',
    'IMPROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('planta_ruta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- IMPLEMENT: ACCIONES (Cumplimentación) ---
 */

// La cumplimentación no existe
$_POST = array('planta_ruta_id' => '1111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// La cumplimentación está vencida
$_SESSION['rol'] = 'organizacion';

$_POST = array('planta_ruta_id' => '3');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'ACCION', 'La cumplimentación está vencida',
    'COMPL_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES ---
 */

// Fichero cumplimentación vacío
$_POST = array('planta_ruta_id' => $planta_ruta_id, 'nombre_doc' => '');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'NOMBRE_DOC', 'Fichero cumplimentación vacío',
    'FILENAME_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fichero cumplimentación largo (más de 50 caracteres)
$_POST = array('planta_ruta_id' => $planta_ruta_id, 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'NOMBRE_DOC', 'Fichero cumplimentación largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fichero cumplimentación formato
$_POST = array('planta_ruta_id' => $planta_ruta_id, 'nombre_doc' => 'documênto');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'NOMBRE_DOC', 'Fichero cumplimentación formato',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Fichero cumplimentación con extensión incorrecta
$_POST = array('planta_ruta_id' => $planta_ruta_id, 'nombre_doc' => 'documento.php');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'NOMBRE_DOC', 'Fichero cumplimentación con extensión incorrecta',
    'FILENAME_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES ---
 */

// Cumplimentación Ok
$_POST = array('planta_ruta_id' => $planta_ruta_id, 'nombre_doc' => 'documento.pdf');
$route_service = new Route_Service();
$feedback = $route_service->implement();
$respTest = obtenerRespuesta('Route', 'IMPLEMENT', 'ACCION', 'Cumplimentación Ok',
    'IMPROUTE_IMPL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- EXPIRE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('planta_ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->expire();
$respTest = obtenerRespuesta('Route', 'EXPIRE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación vacío',
    'IMPROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('planta_ruta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->expire();
$respTest = obtenerRespuesta('Route', 'EXPIRE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);


/*
 *  --- EXPIRE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('planta_ruta_id' => '1111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->expire();
$respTest = obtenerRespuesta('Route', 'EXPIRE', 'ACCION', 'La cumplimentación no existe',
    'IMPROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->expire();
$respTest = obtenerRespuesta('Route', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Cumplimentación vencida Ok
$_SESSION['rol'] = 'organizacion';

$_POST = array('planta_ruta_id' => $planta_ruta_id);
$route_service = new Route_Service();
$feedback = $route_service->expire();
$respTest = obtenerRespuesta('Route', 'EXPIRE', 'ACCION', 'Cumplimentación vencida Ok',
    'IMPROUTE_EXPIRE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('planta_ruta_id' => '');
$route_service = new Route_Service();
$feedback = $route_service->DELETE();
$respTest = obtenerRespuesta('Route', 'DELETE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación vacío',
    'IMPROUTE_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('planta_ruta_id' => 'aaaa');
$route_service = new Route_Service();
$feedback = $route_service->DELETE();
$respTest = obtenerRespuesta('Route', 'DELETE', 'PLANTA_RUTA_ID', 'ID de Cumplimentación no numérico',
    'IMPROUTE_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('planta_ruta_id' => '1111111111111111111111');
$route_service = new Route_Service();
$feedback = $route_service->DELETE();
$respTest = obtenerRespuesta('Route', 'DELETE', 'ACCION', 'La cumplimentación no existe',
    'IMPROUTEID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// El usuario no tiene permisos para consultar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';

$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->DELETE();
$respTest = obtenerRespuesta('Route', 'DELETE', 'ACCION', 'El usuario no tiene permisos para consultar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Sólo existe una cumplimentación de la ruta en el edificio
$_SESSION['username'] = 'sg2ped';

$_POST = array('planta_ruta_id' => '1');
$route_service = new Route_Service();
$feedback = $route_service->DELETE();
$respTest = obtenerRespuesta('Route', 'DELETE', 'ACCION', 'Sólo existe una cumplimentación de la ruta en el edificio',
    'IMPROUTE_UNIQ', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

// Cumplimentación eliminada Ok
$_POST = array('planta_ruta_id' => $planta_ruta_id);
$route_service = new Route_Service();
$feedback = $route_service->DELETE();
$respTest = obtenerRespuesta('Route', 'DELETE', 'ACCION', 'Cumplimentación eliminada Ok',
    'IMPROUTE_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testRoute, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

//------------------------------------------------------------------------------
//Fin test Rutas
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Rutas'] = $testRoute;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;