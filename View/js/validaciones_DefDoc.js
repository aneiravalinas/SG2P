function check_DEFDOC() {
    return check_NOMBRE_DEFDOC() &&
        check_DESCRIPCION_DEFDOC();
}

function check_DEFDOC_SEARCH() {
    return check_DEFDOC_ID_SEARCH() &&
        check_NOMBRE_DEFDOC_SEARCH();
}


function check_DEFDOC_ID_SEARCH() {
    if(not_empty('documento_id')) {
        return check_only_numbers('documento_id');
    } else {
        document.getElementById('documento_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_DEFDOC() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',50)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_DEFDOC_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',50);
    } else {
        document.getElementById('documento_id').style.borderColor = 'green';
        return true;
    }
}

function check_DESCRIPCION_DEFDOC() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}