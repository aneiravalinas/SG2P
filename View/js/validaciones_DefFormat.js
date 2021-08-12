function check_DEFFORMAT() {
    return check_NOMBRE_DEFFORMAT() &&
        check_DESCRIPCION_DEFFORMAT();
}

function check_DEFFORMAT_SEARCH() {
    return check_DEFFORMAT_ID_SEARCH() &&
        check_NOMBRE_DEFFORMAT_SEARCH();
}

function check_DEFFORMAT_ID_SEARCH() {
    if(not_empty('formacion_id')) {
        return check_only_numbers('formacion_id');
    } else {
        document.getElementById('formacion_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_DEFFORMAT() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',50)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_DEFFORMAT_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',50);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPCION_DEFFORMAT() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}