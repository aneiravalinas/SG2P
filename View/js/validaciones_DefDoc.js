function check_DEFDOC() {
    return check_NOMBRE_DEFDOC() &&
        check_DESCRIPCION_DEFDOC();
}


function check_NOMBRE_DEFDOC() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',50)) {
        return true;
    } else {
        return false;
    }
}

function check_DESCRIPCION_DEFDOC() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}