
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


function check_ESPACIO_SEARCH() {
    if(check_ESPACIO_ID_SEARCH() && check_NOMBRE_ESPACIO_SEARCH()) {
        return true;
    } else {
        return false;
    }
}


function check_ESPACIO_ID_SEARCH() {
    if(not_empty('espacio_id')) {
        return check_only_numbers('espacio_id');
    } else {
        document.getElementById('espacio_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_ESPACIO() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',40)) {
        return true;
    } else {
        return false;
    }
}

function check_NOMBRE_ESPACIO_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',40);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
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