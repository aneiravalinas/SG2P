function check_PLAN_SEARCH() {
    return check_ID_PLAN_SEARCH &&
        check_EDIFICIO_ID_SEARCH &&
        check_NOMBRE_EDIFICIO_BLDPLAN_SEARCH() &&
        check_NOMBRE_PLAN_SEARCH;
}

function check_NOMBRE_PLAN_SEARCH() {
    if(not_empty('nombre_plan')) {
        return check_letters_numbers_accents_spaces('nombre_plan',60);
    } else {
        document.getElementById('nombre_plan').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_EDIFICIO_BLDPLAN_SEARCH() {
    if(not_empty('nombre_edificio')) {
        return check_letters_numbers_accents_spaces('nombre_edificio',60);
    } else {
        document.getElementById('nombre_edificio').style.borderColor = 'green';
        return true;
    }
}