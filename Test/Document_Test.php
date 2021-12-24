<?php

include_once './Service/Document_Service.php';
$testDocument = array();
$numTest = 0;
$numFallos = 0;


/*
 *  --- SEEK_DOCUMENT: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seekDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->seekDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEEK_DOCUMENT: ACCIONES ---
 */

// El documento no existe
$_POST = array('documento_id' => '11111111111111111111111');
$document_service = new Document_Service();
$feedback = $document_service->seekDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'ACCION', 'El documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El documento existe
$_POST = array('documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seekDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'ACCION', 'El documento existe',
    'DFDOCID_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- SEEK: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- SEEK: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('cumplimentacion_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Consulta de los detalles de la cumplimentación Ok
$_SESSION['username'] = 'sg2ped2';
$_POST = array('cumplimentacion_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK', 'ACCION', 'Consulta de los detalles de la cumplimentación Ok',
    'IMPDOC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES (Documento) ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: ACCIONES (Documento) ---
 */

// El documento no existe
$_POST = array('documento_id' => '11111111111111111111111');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'ACCION', 'El documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: VALIDACIONES ---
 */

// ID de Cumplimentación no numérico
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Estado de cumplimentación inválido
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'RandomState');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'ESTADO', 'Estado de cumplimentación inválido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de cumplimentación inicial inválida
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha de cumplimentación inicial inválida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de cumplimentación final inválida
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha de cumplimentación final inválida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de vencimiento inicial inválida
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_INICIO', 'Fecha de vencimiento inicial inválida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de vencimiento final inválida
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'FECHA_VENCIMIENTO_FINAL', 'Fecha de vencimiento final inválida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Documento largo (más de 50 caracteres)
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
                'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Formato nombre documento incorrecto
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf.pdf');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'NOMBRE_DOC', 'Formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Edificio largo (más de 60 caracteres)
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre Edificio corto',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Edificio con caracteres no permitidos
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'Nombre de Ed^ficio');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Nombre de Edificio con caracteres no permitidos',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_COMPLETIONS: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('documento_id' => '1', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'Nombre de Edificio');
$document_service = new Document_Service();
$feedback = $document_service->searchCompletions();
$respTest = obtenerRespuesta('Document', 'SEARCH_COMPLETIONS', 'NOMBRE_EDIFICIO', 'Búsqueda de cumplimentaciones Ok',
    'IMPDOC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_DOCUMENT: VALIDACIONES (Documento y Edificio) ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio vacío
$_POST = array('documento_id' => '1', 'edificio_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_DOCUMENT: ACCIONES (Documento y Edificio) ---
 */

// El Documento no existe
$_POST = array('documento_id' => '11111111111', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ACCION', 'El Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El edificio no existe
$_POST = array('documento_id' => '1', 'edificio_id' => '11111111111111');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ACCION', 'El Edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no está asignado al edificio
$_POST = array('documento_id' => '1', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ACCION', 'El plan del documento no está asignado al edificio',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para buscar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ACCION', 'El usuario no tiene permisos para buscar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- SEARCH_DOCUMENT: VALIDACIONES ---
 */

$_SESSION['username'] = 'sg2ped2';

// ID de Cumplimentación no numérico
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => 'aaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Estado de cumplimentación inválido
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'RandomState');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ESTADO', 'Estado de cumplimentación inválido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de cumplimentación inicial inválida
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'FECHA_CUMPLIMENTACION_INICIO', 'Fecha de cumplimentación inicial inválida',
    'START_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de cumplimentacion final inválida
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
        'fecha_cumplimentacion_fin' => '1992/12-25');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'FECHA_CUMPLIMENTACION_FIN', 'Fecha de cumplimentacion final inválida',
    'END_DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de vencimiento inicial inválida
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12-25');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'FECHA_VENCIMIENTO_INICIO', 'Fecha de vencimiento inicial inválida',
    'START_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de vencimiento final inválida
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_final' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12-25');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'FECHA_VENCIMIENTO_FIN', 'Fecha de vencimiento final inválida',
    'END_DATEEXPIRE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Documento largo (más de 50 caracteres)
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Formato nombre documento incorrecto
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf.pdf');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'NOMBRE_DOC', 'Formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_DOCUMENT: ACCIONES ---
 */

// Búsqueda de Cumplimentaciones Ok
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'cumplimentacion_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion_inicio' => '1992/12/25',
    'fecha_cumplimentacion_fin' => '1992/12/25', 'fecha_vencimiento_inicio' => '1992/12/25', 'fecha_vencimiento_fin' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ACCION', 'Búsqueda de Cumplimentaciones Ok',
    'IMPDOC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEEK_PORTAL_DOCUMENT: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio vacío
$_POST = array('documento_id' => '1', 'edificio_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- SEEK_PORTAL_DOCUMENT: ACCIONES ---
 */

// El Documento no existe
$_POST = array('documento_id' => '11111111111', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'El Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El edificio no existe
$_POST = array('documento_id' => '1', 'edificio_id' => '11111111111111');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'El Edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no está asignado al edificio
$_POST = array('documento_id' => '1', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'El plan del documento no está asignado al edificio',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El documento no es visible
$_POST = array('documento_id' => '7', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'El documento no es visible',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan en el edificio se encuentra en estado vencido
$_POST = array('documento_id' => '4', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'El plan en el edificio se encuentra en estado vencido',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El estado del documento en el edificio se encuentra en estado vencido
$_POST = array('documento_id' => '9', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'El estado del documento en el edificio se encuentra en estado vencido',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Búsqueda de cumplimentaciones de documentos del portal Ok
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalDocument();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_DOCUMENT', 'ACCION', 'Búsqueda de cumplimentaciones de documentos del portal Ok',
    'PRTL_IMPDOC_SEARCH_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- ADD_IMPDOC_FORM: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->addImpDocForm();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC_FORM', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->addImpDocForm();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC_FORM', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- ADD_IMPDOC_FORM: ACCIONES ---
 */

// El Documento no existe
$_POST = array('documento_id' => '11111111111');
$document_service = new Document_Service();
$feedback = $document_service->addImpDocForm();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC_FORM', 'ACCION', 'El Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no tiene asignaciones con edificios
$_POST = array('documento_id' => '2');
$document_service = new Document_Service();
$feedback = $document_service->addImpDocForm();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC_FORM', 'ACCION', 'El plan del documento no tiene asignaciones con edificios',
    'BLDPLAN_ASSIGN_ACTIVES_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento tiene asignaciones activas
$_POST = array('documento_id' => '5');
$document_service = new Document_Service();
$feedback = $document_service->addImpDocForm();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC_FORM', 'ACCION', 'El plan del documento tiene asignaciones',
    'BLDPLAN_ASSIGN_ACTIVES_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- DOCUMENT_FORM: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio vacío
$_POST = array('documento_id' => '1', 'edificio_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- ADD_DOCUMENT_FORM: ACCIONES ---
 */

// El Documento no existe
$_POST = array('documento_id' => '11111111111', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'ACCION', 'El Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El edificio no existe
$_POST = array('documento_id' => '1', 'edificio_id' => '11111111111111');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'ACCION', 'El Edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no está asignado al edificio
$_POST = array('documento_id' => '1', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'ACCION', 'El plan del documento no está asignado al edificio',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para buscar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'ACCION', 'El usuario no tiene permisos para buscar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ADD_DOCUMENT_FORM Ok
$_SESSION['username'] = 'sg2ped2';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->documentForm();
$respTest = obtenerRespuesta('Document', 'DOCUMENT_FORM', 'ACCION', 'Add_DocumentForm_Ok',
    'BLDDOC_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- ADD_IMPDOC: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio vacío
$_POST = array('documento_id' => '1', 'buildings' => array());
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'BUILDINGS', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'buildings' => array('1', 'aaaa'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'BUILDINGS', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- ADD_IMPDOC: ACCIONES ---
 */

// El documento no existe
$_POST = array('documento_id' => '1111111111111111', 'buildings' => array('1'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'El documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El edificio no existe
$_POST = array('documento_id' => '1', 'buildings' => array('111111111111111111'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'El edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos sobre el edificio
$_SESSION['username'] = 'sg2ped2';
$_SESSION['rol'] = 'edificio';
$_POST = array('documento_id' => '1', 'buildings' => array('1'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'El usuario no tiene permisos sobre el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no está asignado al edificio
$_SESSION['username'] = 'sg2ped';
$_POST = array('documento_id' => '1', 'buildings' => array('1'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'El plan del documento no está asignado al edificio',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// La asignación entre el plan del documento y el edificio está vencida
$_POST = array('documento_id' => '4', 'buildings' => array('1'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'La asignación entre el plan del documento y el edificio está vencida',
    'BLDPLAN_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Ya existen cumplimentaciones activas del documento en el edificio indicado
$_SESSION['username'] = 'sg2ped2';
$_POST = array('documento_id' => '6', 'buildings' => array('6'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'Ya existen cumplimentaciones activas del documento en el edificio indicado',
    'IMPDOC_ACTIVE_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación añadida Ok
$_SESSION['username'] = 'sg2ped';
$_POST = array('documento_id' => '8', 'buildings' => array('7'));
$document_service = new Document_Service();
$feedback = $document_service->addImpDoc();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC', 'ACCION', 'Cumplimentación añadida Ok',
    'IMPDOC_ADD_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

if($feedback['ok']) {
    $imp_doc_id = $document_service->impDoc_entity->cumplimentacion_id;
} else {
    $imp_doc_id = '';
}

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- SEEK_PORTAL_IMPDOC: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEEK_PORTAL_IMPDOC: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '111111111111111111');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'ACCION', 'La cumplimentación del documento no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// La cumplimentación está vencida
$_POST = array('cumplimentacion_id' => '3');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'ACCION', 'La cumplimentación está vencida',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Detalles de la cumplimentación del portal Ok
$_POST = array('cumplimentacion_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'ACCION', 'Detalles de la cumplimentación del portal Ok',
    'PRTL_IMPDOC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- IMPLEMENT: VALIDACIONES (Cumplimentación) ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- IMPLEMENT: ACCIONES (Cumplimentación) ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('cumplimentacion_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación vencida
$_SESSION['username'] = 'sg2ped2';
$_POST = array('cumplimentacion_id' => '3');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'ACCION', 'La cumplimentación se encuentra vencida',
    'COMPL_EXPIRED', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- IMPLEMENT: VALIDACIONES ---
 */

// Nombre Documento vacío
$_SESSION['username'] = 'sg2ped2';
$_POST = array('cumplimentacion_id' => '1', 'nombre_doc' => '');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento vacío',
    'FILENAME_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre Documento largo (más de 50 caracteres)
$_POST = array('cumplimentacion_id' => '1', 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre Documento formato incorrecto
$_POST = array('cumplimentacion_id' => '1', 'nombre_doc' => 'docu^mento.pdf');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre Documento extensión no permitida
$_POST = array('cumplimentacion_id' => '1', 'nombre_doc' => 'documento.php');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Extensión no permitida',
    'FILENAME_EXT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- IMPLEMENT: ACCIONES ---
 */

// Cumplimentación Ok
$_SESSION['username'] = 'sg2ped';
$_POST = array('cumplimentacion_id' => $imp_doc_id, 'nombre_doc' => 'documento.pdf');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'ACCION', 'Cumplimentación de Documento Ok',
    'IMPDOC_IMPL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- EXPIRE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- EXPIRE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('cumplimentacion_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación vencida Ok
$_POST = array('cumplimentacion_id' => $imp_doc_id);
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'ACCION', 'Cumplimentación vencida Ok',
    'IMPDOC_EXPIRE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('cumplimentacion_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación vacío',
    'CUMP_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('cumplimentacion_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'CUMPLIMENTACION_ID', 'ID de Cumplimentación no numérico',
    'CUMP_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('cumplimentacion_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('cumplimentacion_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// La cumplimentación a eliminar es la única del documento en ese edificio
$_SESSION['username'] = 'sg2ped2';
$_POST = array('cumplimentacion_id' => '2');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'La cumplimentación a eliminar es la única del documento en ese edificio',
    'IMPDOC_UNIQ', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación eliminada Ok
$_SESSION['username'] = 'sg2ped';
$_POST = array('cumplimentacion_id' => $imp_doc_id);
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'Cumplimentación eliminada correctamente',
    'IMPDOC_DEL_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

//------------------------------------------------------------------------------
//Fin test Documentos
//------------------------------------------------------------------------------
$this->respuestaTest['resultado']['Documentos'] = $testDocument;
$this->respuestaTest['numFallos'] += $numFallos;
$this->respuestaTest['numTest'] += $numTest;