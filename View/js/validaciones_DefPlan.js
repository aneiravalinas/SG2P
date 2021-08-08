function check_DEFPLAN() {
    return check_NOMBRE_DEFPLAN() && check_DESCRIPCION_DEFPLAN();
}



function check_NOMBRE_DEFPLAN() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',60)) {
        return true;
    } else {
        return false;
    }
}

function check_DESCRIPCION_DEFPLAN() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}