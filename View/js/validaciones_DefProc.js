function check_DEFPROC() {
    return check_NOMBRE_DEFPROC() &&
        check_DESCRIPCION_DEFPROC();
}

function check_DEFPROC_SEARCH() {
    return check_DEFPROC_ID_SEARCH() &&
        check_NOMBRE_DEFPROC_SEARCH();
}

function check_DEFPROC_ID_SEARCH() {
    if(not_empty('procedimiento_id')) {
        return check_only_numbers('procedimiento_id');
    } else {
        document.getElementById('procedimiento_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_DEFPROC() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',50)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_DEFPROC_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',50);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPCION_DEFPROC() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}