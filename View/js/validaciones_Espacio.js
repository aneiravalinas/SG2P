
function check_ESPACIO() {
    if(
        check_NOMBRE_ESPACIO() &&
        check_DESCRIPCION_ESPACIO() &&
        check_FOTO_ESPACIO()
    ) {
        return true;
    } else {
        return false;
    }
}


function check_NOMBRE_ESPACIO() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',40)) {
        return true;
    } else {
        return false;
    }
}

function check_DESCRIPCION_ESPACIO() {
    if(not_empty('descripcion',true) && check_text('descripcion')) {
        return true;
    } else {
        return false;
    }
}

function check_FOTO_ESPACIO() {
    return check_imagen('foto_espacio');
}