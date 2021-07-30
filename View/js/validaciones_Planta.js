

function check_ADD_PLANTA() {
    if(
        check_NOMBRE_PLANTA() &&
        check_NUM_PLANTA() &&
        check_DESCRIPCION_PLANTA() &&
        check_FOTO_PLANTA()
    ) {
        return true;
    } else {
        return false;
    }
}


function check_NOMBRE_PLANTA() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',40)) {
        return true;
    } else {
        return false;
    }
}

function check_NUM_PLANTA() {
    if(not_empty('num_planta',true) && check_only_numbers('num_planta',2)) {
        return true;
    } else {
        return false;
    }
}

function check_DESCRIPCION_PLANTA() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}

function check_FOTO_PLANTA() {
    return check_imagen('foto_planta');
}

