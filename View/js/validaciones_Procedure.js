function check_IMPPROC_SEARCH() {
    return check_EDIFICIO_PROCEDIMIENTO_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH() &&
        check_BUILDING_NAME_SEARCH();
}

function check_PROC_SEARCH() {
    return check_EDIFICIO_PROCEDIMIENTO_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH();
}

function check_EDIFICIO_PROCEDIMIENTO_ID_SEARCH() {
    if(not_empty('edificio_procedimiento_id')) {
        return check_only_numbers('edificio_procedimiento_id');
    } else {
        document.getElementById('edificio_procedimiento_id').style.borderColor = 'green';
        return true;
    }
}