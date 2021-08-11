function check_DEFROUTE() {
    return check_NOMBRE_DEFPROC() &&
        check_DESCRIPCION_DEFPROC();
}

function check_DEFROUTE_SEARCH() {
    return check_DEFPROC_ID_SEARCH() &&
        check_NOMBRE_DEFPROC_SEARCH();
}

function check_DEFROUTE_ID_SEARCH() {
    if(not_empty('ruta_id')) {
        return check_only_numbers('ruta_id');
    } else {
        document.getElementById('ruta_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_DEFROUTE() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',50)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_DEFROUTE_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',50);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPCION_DEFROUTE() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}