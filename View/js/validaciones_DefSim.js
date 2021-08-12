function check_DEFSIM() {
    return check_NOMBRE_DEFSIM() &&
        check_DESCRIPCION_DEFSIM();
}

function check_DEFSIM_SEARCH() {
    return check_DEFSIM_ID_SEARCH() &&
        check_NOMBRE_DEFSIM_SEARCH();
}

function check_DEFSIM_ID_SEARCH() {
    if(not_empty('simulacro_id')) {
        return check_only_numbers('simulacro_id');
    } else {
        document.getElementById('simulacro_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_DEFSIM() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',50)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_DEFSIM_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',50);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPCION_DEFSIM() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}