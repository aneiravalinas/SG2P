// Check Forms
function check_LOGIN() {
    if (check_USERNAME() && check_PASSWORD()) {
        encrypt();
        return true;
    } else {
        return false;
    }
}


function check_SEARCH() {
    if(
        check_DNI_SEARCH() &&
        check_USERNAME_SEARCH() &&
        check_NAME_SEARCH() &&
        check_SURNAME_SEARCH() &&
        check_EMAIL_SEARCH() &&
        check_TELEFONO_SEARCH() &&
        check_ROLE_SEARCH()
    ) {
        return true;
    } else {
        return false;
    }
}

function check_ADD() {
    if(
        check_DNI() &&
        check_PASSWORD() &&
        check_USERNAME() &&
        check_NAME() &&
        check_SURNAME() &&
        check_TELEFONO() &&
        check_EMAIL() &&
        check_ROLE() &&
        check_FOTO()
    ) {
        encrypt();
        return true;
    } else {
        return false
    }
}


function check_PROFILE() {
    if(
        check_PASSWORD_EDIT() &&
        check_TELEFONO() &&
        check_EMAIL() &&
        check_FOTO()
    ) {
        if(document.getElementById('password').value.length != 0) {
            encrypt();
        }
        return true;
    } else {
        return false;
    }
}

function check_EDIT() {
    if(
        check_PASSWORD_EDIT() &&
        check_NAME() &&
        check_SURNAME() &&
        check_TELEFONO() &&
        check_EMAIL() &&
        check_ROLE() &&
        check_FOTO()
    ) {
        if(document.getElementById('password').value.length != 0) {
            encrypt();
        }
        return true;
    } else {
        return false;
    }
}


function check_PASSWORD_EDIT() {
    if(not_empty('password', false)) {
        return check_letters_numbers('password',15);
    } else {
        return true;
    }

}

function check_DNI() {
    if(not_empty('dni', true) && check_dni('dni')) {
        return true;
    } else {
        return false;
    }
}


// Forms Fields
function check_USERNAME() {
    if(not_empty('username',true) && check_letters_numbers('username',20)) {
        return true;
    } else {
        return false;
    }
}

function check_PASSWORD() {
    if(not_empty('password',true) && check_letters_numbers('password',15)) {
        return true;
    } else {
        return false;
    }
}

function check_NAME() {
    if(not_empty('nombre', true) && check_letters_spaces_accents('nombre',30)) {
        return true;
    } else {
        return false;
    }
}

function check_SURNAME() {
    if(not_empty('apellidos', true) && check_letters_spaces_accents('apellidos',60)) {
        return true;
    } else {
        return false;
    }
}

function check_ROLE() {
    var enums = ['registrado', 'edificio', 'organizacion', 'administrador'];
    if(not_empty('rol', true) && check_enum('rol', enums)) {
        return true;
    } else {
        return false;
    }
}

function check_DNI_SEARCH() {
    if(not_empty('dni')) {
        if(check_pattern('dni', /^[0-9]{0,8}[A-Z]?$/)) {
            return true;
        } else {
            return false;
        }
    } else {
        document.getElementById('dni').style.borderColor = 'green';
        return true;
    }
}

function check_USERNAME_SEARCH() {
    if(not_empty('username')) {
        if(check_letters_numbers('username',20)) {
            return true;
        } else {
            return false;
        }
    } else {
        document.getElementById('username').style.borderColor = 'green';
        return true;
    }
}

function check_TELEFONO() {
    if(not_empty('telefono', true) && check_only_numbers('telefono', 9) && check_phone('telefono')) {
        return true;
    } else {
        return false;
    }
}

function check_EMAIL() {
    if(not_empty('email', true) && check_email('email',50)) {
        return true;
    } else {
        return false;
    }
}

function check_FOTO() {
    return check_imagen('foto_perfil');
}

function check_NAME_SEARCH() {
    if(not_empty('nombre')) {
        if(check_letters_spaces_accents('nombre',30)) {
            return true;
        } else {
            return false;
        }
    } else {
        document.getElementById('nombre').style.borderColor = 'green';
        return true;
    }
}


function check_SURNAME_SEARCH() {
    if(not_empty('apellidos')) {
        if(check_letters_spaces_accents('apellidos',60)) {
            return true;
        } else {
            return false;
        }
    } else {
        document.getElementById('apellidos').style.borderColor = 'green';
        return true;
    }
}

function check_EMAIL_SEARCH() {
    if(not_empty('email')) {
        if(check_pattern('email',
            /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@?[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
        )) {
            return true;
        } else {
            return false;
        }
    } else {
        document.getElementById('email').style.borderColor = 'green';
        return true;
    }
}

function check_TELEFONO_SEARCH() {
    if(not_empty('telefono')) {
        if(check_only_numbers('telefono',9)) {
            return true;
        } else{
            return false;
        }
    } else {
        document.getElementById('telefono').style.borderColor = 'green';
        return true;
    }
}

function check_ROLE_SEARCH() {
    var enums = ['registrado', 'edificio', 'organizacion', 'administrador'];
    if(not_empty('rol')) {
        if(check_enum('rol', enums)) {
            return true;
        } else {
            return false;
        }
    } else {
        document.getElementById('rol').style.borderColor = 'green';
        return true;
    }
}