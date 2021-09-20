function check_IMPPROC_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH() &&
        check_BUILDING_NAME_SEARCH();
}

function check_PROC_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH();
}
