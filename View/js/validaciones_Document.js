function check_IMPDOC_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH() &&
        check_BUILDING_NAME_SEARCH();
}

function check_DOC_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH();
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