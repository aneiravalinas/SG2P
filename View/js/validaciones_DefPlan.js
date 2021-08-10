function check_DEFPLAN() {
    return check_NOMBRE_DEFPLAN() && check_DESCRIPCION_DEFPLAN();
}

function check_DEFPLAN_SEARCH() {
    return check_ID_PLAN_SEARCH() &&
        check_NOMBRE_DEFPLAN_SEARCH();
}

function check_ID_PLAN_SEARCH() {
    if(not_empty('plan_id')) {
        return check_only_numbers('plan_id');
    } else {
        document.getElementById('plan_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_DEFPLAN() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',60)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_DEFPLAN_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',60);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPCION_DEFPLAN() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}