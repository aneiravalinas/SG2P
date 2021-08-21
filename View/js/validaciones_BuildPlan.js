

function check_BLDPLAN_SEARCH() {
    return check_EDIFICIO_ID_SEARCH() &&
            check_BLDPLAN_NOMBRE_EDIFICIO_SEARCH();
}

function check_FECHA_ASIGNACION() {
    if(not_empty('fecha_asignacion',true)) {
        return true;
    } else {
        return false;
    }
}

function check_FECHA_IMPLEMENTACION() {
    if(not_empty('fecha_implementacion',true)) {
        return true;
    } else {
        return false;
    }
}

function check_BUILDINGS() {
    if(not_empty('buildings',true)) {
        return true;
    } else {
        return false;
    }
}


function check_BLDPLAN_NOMBRE_EDIFICIO_SEARCH() {
    if(not_empty('nombre_edificio')) {
        return check_letters_numbers_accents_spaces('nombre_edificio',60);
    } else {
        document.getElementById('nombre_edificio').style.borderColor = 'green';
        return true;
    }
}