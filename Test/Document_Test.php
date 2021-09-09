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
$_POST = array('edificio_documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación vacío',
    'IMPDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('edificio_documento_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- SEEK: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('edificio_documento_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('edificio_documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Búsqueda de Planes Ok
$_SESSION['username'] = 'sg2ped2';
$_POST = array('edificio_documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seek();
$respTest = obtenerRespuesta('Document', 'SEEK_DOCUMENT', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'IMPDOC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

/*
 *  --- SEARCH_IMPLEMENTS: VALIDACIONES (Documento) ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_IMPLEMENTS: ACCIONES (Documento) ---
 */

// El documento no existe
$_POST = array('documento_id' => '11111111111111111111111');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'ACCION', 'El documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_IMPLEMENTS: VALIDACIONES ---
 */

// ID de Cumplimentación no numérico
$_POST = array('documento_id' => '1', 'edificio_documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Estado de cumplimentación inválido
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'RandomState');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'ESTADO', 'Estado de cumplimentación inválido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de cumplimentación inválida
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'FECHA_CUMPLIMENTACION', 'Fecha de cumplimentación inválida',
    'DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Documento largo (más de 50 caracteres)
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
                'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Formato nombre documento incorrecto
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf.pdf');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'NOMBRE_DOC', 'Formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'EDIFICIO_ID', 'ID Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Edificio corto (menos de 3 caracteres)
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'aa');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'NOMBRE_EDIFICIO', 'Nombre Edificio corto',
    'BLD_NAM_SHRT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Edificio largo (más de 60 caracteres)
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'NOMBRE_EDIFICIO', 'Nombre Edificio corto',
    'BLD_NAM_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Edificio con caracteres no permitidos
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'Nombre de Ed^ficio');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'NOMBRE_EDIFICIO', 'Nombre de Edificio con caracteres no permitidos',
    'BLD_NAM_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEARCH_IMPLEMENTS: ACCIONES ---
 */

// Búsqueda de cumplimentaciones Ok
$_POST = array('documento_id' => '1', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'fichero.pdf', 'edificio_id' => '1', 'nombre_edificio' => 'Nombre de Edificio');
$document_service = new Document_Service();
$feedback = $document_service->searchImplements();
$respTest = obtenerRespuesta('Document', 'SEARCH_IMPLEMENTS', 'NOMBRE_EDIFICIO', 'Búsqueda de cumplimentaciones Ok',
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
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'edificio_documento_id' => 'aaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Estado de cumplimentación inválido
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'edificio_documento_id' => '1', 'estado' => 'RandomState');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'ESTADO', 'Estado de cumplimentación inválido',
    'STATE_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Fecha de cumplimentación inválida
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992-12/25');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'FECHA_CUMPLIMENTACION', 'Fecha de cumplimentación inválida',
    'DATECOMP_KO', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre de Documento largo (más de 50 caracteres)
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
    'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocument();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Formato nombre documento incorrecto
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
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
$_POST = array('documento_id' => '6', 'edificio_id' => '6', 'edificio_documento_id' => '1', 'estado' => 'pendiente', 'fecha_cumplimentacion' => '1992/12/25',
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
 *  --- SEARCH_DOCUMENT_FORM: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio vacío
$_POST = array('documento_id' => '1', 'edificio_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- SEARCH_DOCUMENT_FORM: ACCIONES ---
 */

// El Documento no existe
$_POST = array('documento_id' => '11111111111', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'ACCION', 'El Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El edificio no existe
$_POST = array('documento_id' => '1', 'edificio_id' => '11111111111111');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'ACCION', 'El Edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no está asignado al edificio
$_POST = array('documento_id' => '1', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'ACCION', 'El plan del documento no está asignado al edificio',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para buscar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'ACCION', 'El usuario no tiene permisos para buscar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Search Document Form Ok
$_SESSION['username'] = 'sg2ped2';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->searchDocumentForm();
$respTest = obtenerRespuesta('Document', 'SEARCH_DOCUMENT_FORM', 'ACCION', 'Search Document Form Ok',
    'BLDDOC_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

unset($_SESSION['username'], $_SESSION['rol']);

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
    'BLDPLAN_ASSIGN_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento tiene asignaciones activas
$_POST = array('documento_id' => '5');
$document_service = new Document_Service();
$feedback = $document_service->addImpDocForm();
$respTest = obtenerRespuesta('Document', 'ADD_IMPDOC_FORM', 'ACCION', 'El plan del documento tiene asignaciones',
    'BLDPLAN_ASSIGN_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- ADD_DOCUMENT_FORM: VALIDACIONES ---
 */

// ID Documento vacío
$_POST = array('documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'DOCUMENTO_ID', 'ID de documento vacío',
    'DFDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Documento no numérico
$_POST = array('documento_id' => 'aaaa');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'DOCUMENTO_ID', 'ID de documento no numérico',
    'DFDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio vacío
$_POST = array('documento_id' => '1', 'edificio_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'EDIFICIO_ID', 'ID de Edificio vacío',
    'BLD_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID Edificio no numérico
$_POST = array('documento_id' => '1', 'edificio_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'EDIFICIO_ID', 'ID de Edificio no numérico',
    'BLD_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- ADD_DOCUMENT_FORM: ACCIONES ---
 */

// El Documento no existe
$_POST = array('documento_id' => '11111111111', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'ACCION', 'El Documento no existe',
    'DFDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El edificio no existe
$_POST = array('documento_id' => '1', 'edificio_id' => '11111111111111');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'ACCION', 'El Edificio no existe',
    'BLDID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El plan del documento no está asignado al edificio
$_POST = array('documento_id' => '1', 'edificio_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'ACCION', 'El plan del documento no está asignado al edificio',
    'BLDDOC_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para buscar cumplimentaciones en el edificio
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'ACCION', 'El usuario no tiene permisos para buscar cumplimentaciones en el edificio',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ADD_DOCUMENT_FORM Ok
$_SESSION['username'] = 'sg2ped2';
$_POST = array('documento_id' => '6', 'edificio_id' => '6');
$document_service = new Document_Service();
$feedback = $document_service->addDocumentForm();
$respTest = obtenerRespuesta('Document', 'ADD_DOCUMENT_FORM', 'ACCION', 'Add_DocumentForm_Ok',
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
    $imp_doc_id = $document_service->impDoc_entity->edificio_documento_id;
} else {
    $imp_doc_id = '';
}

unset($_SESSION['username'], $_SESSION['rol']);


/*
 *  --- SEEK_PORTAL_IMPDOC: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('edificio_documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación vacío',
    'IMPDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('edificio_documento_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- SEEK_PORTAL_IMPDOC: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('edificio_documento_id' => '111111111111111111');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'ACCION', 'La cumplimentación del documento no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// La cumplimentación está vencida
$_POST = array('edificio_documento_id' => '3');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'ACCION', 'La cumplimentación está vencida',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Detalles de la cumplimentación del portal Ok
$_POST = array('edificio_documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->seekPortalImpDoc();
$respTest = obtenerRespuesta('Document', 'SEEK_PORTAL_IMPDOC', 'ACCION', 'Detalles de la cumplimentación del portal Ok',
    'PRTL_IMPDOC_SEEK_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- IMPLEMENT: VALIDACIONES (Cumplimentación) ---
 */

// ID de Cumplimentación vacío
$_POST = array('edificio_documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación vacío',
    'IMPDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('edificio_documento_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);


/*
 *  --- IMPLEMENT: ACCIONES (Cumplimentación) ---
 */

// La cumplimentación no existe
$_POST = array('edificio_documento_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('edificio_documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación vencida
$_SESSION['username'] = 'sg2ped2';
$_POST = array('edificio_documento_id' => '3');
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
$_POST = array('edificio_documento_id' => '1', 'nombre_doc' => '');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento vacío',
    'FILENAME_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre Documento largo (más de 50 caracteres)
$_POST = array('edificio_documento_id' => '1', 'nombre_doc' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento largo',
    'FILENAME_LRG', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre Documento formato incorrecto
$_POST = array('edificio_documento_id' => '1', 'nombre_doc' => 'docu^mento.pdf');
$document_service = new Document_Service();
$feedback = $document_service->implement();
$respTest = obtenerRespuesta('Document', 'IMPLEMENT', 'NOMBRE_DOC', 'Nombre Documento formato incorrecto',
    'FILENAME_FRMT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Nombre Documento extensión no permitida
$_POST = array('edificio_documento_id' => '1', 'nombre_doc' => 'documento.php');
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
$_POST = array('edificio_documento_id' => $imp_doc_id, 'nombre_doc' => 'documento.pdf');
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
$_POST = array('edificio_documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación vacío',
    'IMPDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('edificio_documento_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- EXPIRE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('edificio_documento_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('edificio_documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación vencida Ok
$_POST = array('edificio_documento_id' => $imp_doc_id);
$document_service = new Document_Service();
$feedback = $document_service->expire();
$respTest = obtenerRespuesta('Document', 'EXPIRE', 'ACCION', 'Cumplimentación vencida Ok',
    'IMPDOC_EXPIRE_OK', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- DELETE: VALIDACIONES ---
 */

// ID de Cumplimentación vacío
$_POST = array('edificio_documento_id' => '');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación vacío',
    'IMPDOC_ID_EMPT', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// ID de Cumplimentación no numérico
$_POST = array('edificio_documento_id' => 'aaa');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'EDIFICIO_DOCUMENTO_ID', 'ID de Cumplimentación no numérico',
    'IMPDOC_ID_NOT_NUMERIC', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

/*
 *  --- DELETE: ACCIONES ---
 */

// La cumplimentación no existe
$_POST = array('edificio_documento_id' => '1111111');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'La cumplimentación no existe',
    'IMPDOCID_NOT_EXST', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// El usuario no tiene permisos para consultar la cumplimentación
$_SESSION['username'] = 'sg2ped';
$_SESSION['rol'] = 'edificio';
$_POST = array('edificio_documento_id' => '1');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'El usuario no tiene permisos para consultar la cumplimentación',
    'BLD_FRBD', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// La cumplimentación a eliminar es la única del documento en ese edificio
$_SESSION['username'] = 'sg2ped2';
$_POST = array('edificio_documento_id' => '2');
$document_service = new Document_Service();
$feedback = $document_service->DELETE();
$respTest = obtenerRespuesta('Document', 'DELETE', 'ACCION', 'La cumplimentación a eliminar es la única del documento en ese edificio',
    'IMPDOC_UNIQ', $_POST, $feedback['code'], $numTest, $numFallos);
array_push($testDocument, $respTest);

// Cumplimentación eliminada Ok
$_SESSION['username'] = 'sg2ped';
$_POST = array('edificio_documento_id' => $imp_doc_id);
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