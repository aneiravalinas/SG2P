function check_PLANTA() {
    return not_empty('nombre_planta', true);
}

function check_IMPROUTE_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_EDIFICIO_ID_SEARCH() &&
        check_ID_PLANTA_SEARCH() &&
        check_BUILDING_NAME_SEARCH() &&
        check_NOMBRE_DOC_SEARCH() &&
        check_FLOOR_NAME_SEARCH();
}

function check_ROUTE_SEARCH() {
    return check_CUMPLIMENTACION_ID_SEARCH() &&
        check_NOMBRE_DOC_SEARCH();
}

function check_FLOOR_NAME_SEARCH() {
    if(not_empty('nombre_planta')) {
        return check_letters_numbers_accents_spaces('nombre_planta',40);
    } else {
        document.getElementById('nombre_planta').style.borderColor = 'green';
        return true;
    }
}
