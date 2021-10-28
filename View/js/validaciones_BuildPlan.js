

function check_BLDPLAN_SEARCH() {
    return check_EDIFICIO_ID_SEARCH() &&
        check_BUILDING_NAME_SEARCH();
}

function check_BUILDINGS() {
    if(not_empty('buildings',true)) {
        return true;
    } else {
        return false;
    }
}
