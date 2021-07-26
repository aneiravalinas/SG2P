function check_ADD_EDIFICIO() {
    return check_NOMBRE_EDIFICIO() &&
        check_CALLE() &&
        check_CIUDAD() &&
        check_PROVINCIA() &&
        check_CPOSTAL() &&
        check_FAX() &&
        check_TELEFONO() &&
        check_RESPONSABLE_EDIFICIO() &&
        check_FOTO_EDIFICIO();
}



function check_NOMBRE_EDIFICIO() {
    if(not_empty('nombre', true) && check_letters_numbers_accents_spaces('nombre',60)) {
        return true;
    } else {
        return false;
    }
}

function check_CALLE() {
    if(not_empty('calle', true) && check_letters_numbers_accents_spaces('calle', 60)) {
        return true;
    } else {
        return false;
    }
}

function check_CIUDAD() {
    if(not_empty('ciudad', true) && check_letters_spaces_accents('ciudad',40)) {
        return true;
    } else {
        return false;
    }
}

function check_PROVINCIA() {
    if(not_empty('provincia', true) && check_letters_spaces_accents('provincia',40)) {
        return true;
    } else {
        return false;
    }
}

function check_CPOSTAL() {
    if(not_empty('codigo_postal', true) && check_codigo_postal('codigo_postal')) {
        return true;
    } else {
        return false;
    }
}

function check_FAX() {
    if(not_empty('fax', true) && check_only_numbers('fax',9)) {
        return true;
    } else {
        return false;
    }
}

function check_FOTO_EDIFICIO() {
    return check_imagen('foto_edifico');
}

function check_RESPONSABLE_EDIFICIO() {
    if(not_empty('responsable',true) && check_letters_numbers('responsable',20)) {
        return true;
    } else {
        return false;
    }
}