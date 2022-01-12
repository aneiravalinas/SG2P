

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


function check_SEARCH_PLANTA() {
    if(
        check_ID_PLANTA_SEARCH() &&
        check_NOMBRE_PLANTA_SEARCH() &&
        check_NUM_PLANTA_SEARCH()
    ) {
        return true;
    } else {
        return false;
    }
}

function check_ID_PLANTA_SEARCH() {
    if(not_empty('planta_id')) {
        return check_only_numbers('planta_id');
    } else {
        document.getElementById('planta_id').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_PLANTA_SEARCH() {
    if(not_empty('nombre')) {
        return check_letters_numbers_accents_spaces('nombre',40);
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}

function check_NOMBRE_PLANTA() {
    if(not_empty('nombre',true) && check_letters_numbers_accents_spaces('nombre',40)) {
        return true;
    } else {
        return false;
    }
}

function check_NUM_PLANTA_SEARCH() {
    if(not_empty('num_planta')) {
        return check_number_positive_or_negative('num_planta',2);
    } else {
        document.getElementById('num_planta').style.borderColor = 'green';
        return true;
    }
}


function check_NUM_PLANTA() {
    if(not_empty('num_planta',true) && check_number_positive_or_negative('num_planta',2)) {
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

