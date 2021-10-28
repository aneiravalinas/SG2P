function check_CUMP_DOC_PROC_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH() &&
        check_BUILDING_NAME_SEARCH();
}

function check_DOC_PROC_ROUTE_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH();
}

function check_CUMP_ROUTE_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_ID_PLANTA_SEARCH() &&
        check_NOMBRE_DOC_SEARCH() &&
        check_FLOOR_NAME_SEARCH();
}

function check_CUMP_SIM_FORMAT_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_BUILDING_NAME_SEARCH();
}

function check_SIM_FORMAT_IMPLEMENT() {
    return check_RECURSO() &&
        check_DESTINATARIOS() &&
        check_FECHA_PLANIFICACION();
}


function check_NOMBRE_DOC() {
    if(not_empty('nombre_doc')) {
        return check_name_file('nombre_doc');
    } else {
        return true;
    }
}

function check_NOMBRE_DOC_SEARCH() {
    if(not_empty('nombre_doc_field')) {
        return check_file_pdf_name('nombre_doc_field', 50);
    } else {
        document.getElementById('nombre_doc_field').style.borderColor = 'green';
        return true;
    }
}

function check_CUMPLIMENTACION_ID_SEARCH() {
    if(not_empty('cumplimentacion_id')) {
        return check_only_numbers('cumplimentacion_id');
    } else {
        document.getElementById('cumplimentacion_id').style.borderColor = 'green';
        return true;
    }
}

function check_BUILDING_NAME_SEARCH() {
    if(not_empty('nombre_edificio')) {
        return check_letters_numbers_accents_spaces('nombre_edificio',60);
    } else {
        document.getElementById('nombre_edificio').style.borderColor = 'green';
        return true;
    }
}

function check_PLANTA() {
    return not_empty('nombre_planta', true);
}

function check_FLOOR_NAME_SEARCH() {
    if(not_empty('nombre_planta')) {
        return check_letters_numbers_accents_spaces('nombre_planta',40);
    } else {
        document.getElementById('nombre_planta').style.borderColor = 'green';
        return true;
    }
}


function check_RECURSO() {
    if(not_empty('url_recurso')) {
        return check_URL('url_recurso');
    } else {
        document.getElementById('url_recurso').style.borderColor = 'green';
        return true;
    }
}

function check_DESTINATARIOS() {
    return not_empty('destinatarios', true) &&
        check_text('destinatarios',200);
}

function check_FECHA_PLANIFICACION() {
    return not_empty('fecha_planificacion', true) &&
        check_fecha_mayor_actual('fecha_planificacion');
}