

function check_BLDPLAN_SEARCH() {
    return check_EDIFICIO_ID_SEARCH();
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