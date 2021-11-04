function check_DEFINITION() {
    return check_DEFINITION_NAME() &&
        check_DESCRIPTION();
}

function check_DEFPLAN_SEARCH() {
    return check_ID_PLAN_SEARCH() &&
        check_DEFINITION_NAME_SEARCH();
}

function check_DEFDOC_SEARCH() {
    return check_DEFDOC_ID_SEARCH() &&
        check_DEFINITION_NAME_SEARCH();
}

function check_DEFPROC_SEARCH() {
    return check_DEFPROC_ID_SEARCH() &&
        check_DEFINITION_NAME_SEARCH();
}

function check_DEFROUTE_SEARCH() {
    return check_DEFROUTE_ID_SEARCH() &&
        check_DEFINITION_NAME_SEARCH();
}

function check_DEFFORMAT_SEARCH() {
    return check_DEFFORMAT_ID_SEARCH() &&
        check_DEFINITION_NAME_SEARCH();
}

function check_DEFSIM_SEARCH() {
    return check_DEFSIM_ID_SEARCH() &&
        check_DEFINITION_NAME_SEARCH();
}

function check_DEFINITION_NAME() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',60)) {
        return true;
    } else {
        return false;
    }
}

function check_DEFINITION_NAME_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',60);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPTION() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}


function check_ID_PLAN_SEARCH() {
    if(not_empty('plan_id')) {
        return check_only_numbers('plan_id');
    } else {
        document.getElementById('plan_id').style.borderColor = 'green';
        return true;
    }
}

function check_DEFDOC_ID_SEARCH() {
    if(not_empty('documento_id')) {
        return check_only_numbers('documento_id');
    } else {
        document.getElementById('documento_id').style.borderColor = 'green';
        return true;
    }
}

function check_DEFPROC_ID_SEARCH() {
    if(not_empty('procedimiento_id')) {
        return check_only_numbers('procedimiento_id');
    } else {
        document.getElementById('procedimiento_id').style.borderColor = 'green';
        return true;
    }
}

function check_DEFROUTE_ID_SEARCH() {
    if(not_empty('ruta_id')) {
        return check_only_numbers('ruta_id');
    } else {
        document.getElementById('ruta_id').style.borderColor = 'green';
        return true;
    }
}

function check_DEFFORMAT_ID_SEARCH() {
    if(not_empty('formacion_id')) {
        return check_only_numbers('formacion_id');
    } else {
        document.getElementById('formacion_id').style.borderColor = 'green';
        return true;
    }
}

function check_DEFSIM_ID_SEARCH() {
    if(not_empty('simulacro_id')) {
        return check_only_numbers('simulacro_id');
    } else {
        document.getElementById('simulacro_id').style.borderColor = 'green';
        return true;
    }
}