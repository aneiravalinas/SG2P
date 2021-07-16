function openModal(name, tag){
    var modal = new bootstrap.Modal(document.getElementById('myModal'),
        {
            keyboard: true,
            backdrop: 'static'
        });
    modal.show();
    document.getElementById("mensajeError1").innerHTML = 'm-' + name;
    document.getElementById("mensajeError1").className = 'm-' + name;
    document.getElementById("mensajeError2").innerHTML = tag;
    document.getElementById("mensajeError2").className = tag;
    setLang();
}


function check_login() {
    if (
        not_empty('username') && check_letters_numbers('username', 20) &&
        not_empty('password')
    ) {
        encrypt();
        return true;
    } else {
        return false;
    }
}


function encrypt() {
    document.getElementById('password').value = hex_md5(document.getElementById('password').value);
    return true;
}

function not_empty(element) {
    var correct;
    var value = document.getElementById(element).value;
    var name = document.getElementById(element).name;

    if((value == null) || (value.length == 0)) {
        openModal(name,'i18n-not-empty');
        correct = false;
    } else {
        correct = true;
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }
}

function check_letters_numbers(element, size) {
    var correct = true;
    var value = document.getElementById(element).value;
    var name = document.getElementById(element).name;

    if(value.length > size) {
        openModal(name,'i18n-max-size');
        correct = false;
    }
    var pattern = /^[A-zÀ-ú0-9]+$/;
    if(!pattern.test(value)) {
        openModal(name,'i18n-only-letters-numbers');
        correct = false;
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }

}