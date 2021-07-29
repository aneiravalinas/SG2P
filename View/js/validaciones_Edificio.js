function check_ADD_EDIFICIO() {

    if(
        check_NOMBRE_EDIFICIO() &&
        check_CALLE() &&
        check_CIUDAD() &&
        check_PROVINCIA() &&
        check_CPOSTAL() &&
        check_TELEFONO() &&
        check_RESPONSABLE_EDIFICIO() &&
        check_FOTO_EDIFICIO()
    ) {
        return true;
    } else {
        return false;
    }
}

function check_SEARCH_EDIFICIO() {
    if(
        check_EDIFICIO_ID_SEARCH() &&
        check_NOMBRE_EDIFICIO_SEARCH() &&
        check_CALLE_SEARCH() &&
        check_CIUDAD_SEARCH() &&
        check_PROVINCIA_SEARCH() &&
        check_CPOSTAL_SEARCH() &&
        check_TELEFONO_SEARCH() &&
        check_RESPONSABLE_EDIFICIO_SEARCH()
    ) {
        return true;
    } else {
        return false;
    }
}

function check_EDIFICIO_ID_SEARCH() {
    if(not_empty('edificio_id')) {
        return check_only_numbers('edificio_id');
    } else {
        document.getElementById('edificio_id').style.borderColor = 'green';
        return true;
    }
}


function check_NOMBRE_EDIFICIO() {
    if(not_empty('nombre', true) && check_letters_numbers_accents_spaces('nombre',60)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_EDIFICIO_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',60);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_CALLE() {
    if(not_empty('calle', true) && check_letters_numbers_accents_spaces('calle', 60)) {
        return true;
    } else {
        return false;
    }
}

function check_CALLE_SEARCH() {
    if(not_empty('calle')) {
        return check_letters_numbers_accents_spaces('calle',60);
    } else {
        document.getElementById('calle').style.borderColor = 'green';
        return true;
    }
}

function check_CIUDAD() {
    if(not_empty('ciudad', true) && check_letters_spaces_accents('ciudad',40)) {
        return true;
    } else {
        return false;
    }
}

function check_CIUDAD_SEARCH() {
    if(not_empty('ciudad')) {
        return check_letters_spaces_accents('ciudad');
    } else {
        document.getElementById('ciudad').style.borderColor = 'green';
        return true;
    }
}

function check_PROVINCIA() {
    if(not_empty('provincia', true) && check_letters_spaces_accents('provincia',40)) {
        return true;
    } else {
        return false;
    }
}

function check_PROVINCIA_SEARCH() {
    if(not_empty('provincia')) {
        return check_letters_spaces_accents('provincia',40);
    } else {
        document.getElementById('provincia').style.borderColor = 'green';
        return true;
    }
}

function check_CPOSTAL() {
    if(not_empty('codigo_postal', true) && check_codigo_postal('codigo_postal')) {
        return true;
    } else {
        return false;
    }
}

function check_CPOSTAL_SEARCH() {
    if(not_empty('codigo_postal')) {
        return check_only_numbers('codigo_postal',5);
    } else {
        document.getElementById('codigo_postal').style.borderColor = 'green';
        return true;
    }
}

function check_FOTO_EDIFICIO() {
    return check_imagen('foto_edificio');
}

function check_RESPONSABLE_EDIFICIO() {
    if(not_empty('username',true) && check_letters_numbers('username',20)) {
        return true;
    } else {
        return false;
    }
}

function check_RESPONSABLE_EDIFICIO_SEARCH() {
    if(not_empty('username')) {
        return check_letters_numbers('username',20);
    } else{
        document.getElementById('username').style.borderColor = 'green';
        return true;
    }
}