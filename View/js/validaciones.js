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


function encrypt() {
    document.getElementById('password').value = hex_md5(document.getElementById('password').value);
    return true;
}

function not_empty(element, show=false) {
    var correct;
    var pattern = /^[\s]+$/;
    var value = document.getElementById(element).value;

    if((value == null) || (value.length == 0) || pattern.test(value)) {
        if(show) {
            openModal(element,'i18n-not-empty');
        }
        correct = false;
    } else {
        correct = true;
    }

    if(show) {
        if(correct) {
            document.getElementById(element).style.borderColor = 'green';
            return true;
        } else {
            document.getElementById(element).style.borderColor = 'red';
            return false;
        }
    } else {
        return correct;
    }

}

function check_letters_numbers(element, size) {
    var correct = true;
    var value = document.getElementById(element).value;

    if(value.length > size) {
        openModal(element,'i18n-max-size');
        correct = false;
    }
    var pattern = /^[A-zÀ-ú0-9]+$/;
    if(!pattern.test(value)) {
        openModal(element,'i18n-only-letters-numbers');
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

function check_name_file(element) {
    var correct = true;
    var value = document.getElementById(element).value;

    var file = value.split(/(\\|\/)/g).pop();
    var extension = file.substring(file.lastIndexOf('.')).toLowerCase();
    if(extension !== '.pdf') {
        openModal(element, 'i18n-ext-not-allowed');
        correct = false;
    } else {
        let file_name = file.substring(0, file.lastIndexOf('.'));
        let pattern = /[^a-zA-Z0-9\-_]/;
        if(pattern.test(file_name)) {
            openModal(element, 'i18n-only-letters-numbers-hyphen');
            correct = false;
        }
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }
}

function check_dni(element) {

    var correct = true;

    var validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
    var nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
    var nieRexp = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
    var str = document.getElementById(element).value.toString().toUpperCase();

    if (!nifRexp.test(str) && !nieRexp.test(str)){
        openModal(element, 'i18n-generic-format');
        correct = false;
    }
    else{
        var nie = str
            .replace(/^[X]/, '0')
            .replace(/^[Y]/, '1')
            .replace(/^[Z]/, '2');

        var letter = str.substr(-1);
        var charIndex = parseInt(nie.substr(0, 8)) % 23;

        if (validChars.charAt(charIndex) === letter){
            correct = true;
        }
        else{
            openModal(element, 'i18n-generic-format');
            correct =  false;
        }
    }

    if (correct){
        document.getElementById(element).style.borderColor = 'green'; // ponemos el bordercolor a verde
        return true; // devolvemos true
    }
    else{
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }

}

function check_letters_spaces_accents(element, size) {
    var correct = true;
    var value = document.getElementById(element).value;

    if(value.length > size) {
        openModal(element,'i18n-max-size');
        correct = false;
    }

    var pattern = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
    if(!pattern.test(value)) {
        openModal(element,'i18n-letters-spaces-accents-format');
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

function check_phone(element) {
    var correct = true;
    var value = document.getElementById(element).value;
    var pattern = /^[6-9][0-9]{8}$/;

    if(!pattern.test(value)) {
        openModal(element,'i18n-generic-format');
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

function check_email(element, size) {
    var correct = true;
    var value = document.getElementById(element).value;

    if(value.length > size) {
        openModal(element,'i18n-max-size');
        correct = false;
    }

    var pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if(!pattern.test(value)) {
        openModal(element, 'i18n-generic-format');
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

function check_enum(element, values) {
    var correct = false;
    var value = document.getElementById(element).value;

    for(var i = 0; i < values.length; i++) {
        if(values[i] === value) {
            correct = true;
            break;
        }
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        openModal(element,'i18n-wrong-enum');
        return false;
    }
}

function check_pattern(element, pattern) {
    var correct = true;
    var value = document.getElementById(element).value;

    if(!pattern.test(value)) {
        openModal(element,'i18n-generic-format');
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

function check_file_pdf_name(element, size) {
    var correct = true;
    var value = document.getElementById(element).value;

    if(value.size > size) {
        openModal(element,'i18n-max-size');
        correct = false;
    }
    var pattern = /^[a-zA-Z0-9_-]*(\.pdf)?$/;
    if(!pattern.test(value)) {
        openModal(element, 'i18n-filename-search-format');
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

function check_only_numbers(element, size=null) {
    var correct = true;
    var value = document.getElementById(element).value;

    var pattern = /^[0-9]+$/;
    if(!pattern.test(value)) {
        openModal(element,'i18n-numbers-format');
        correct = false;
    }

    if(size != null) {
        if(value.length > size) {
            openModal(element,'i18n-max-size');
            correct = false;
        }
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }
}

function check_number_positive_or_negative(element, size = null) {
    var correct = true;
    var value = document.getElementById(element).value;

    var pattern = /^[\-]?[0-9]+$/;
    if(!pattern.test(value)) {
        openModal(element,'i18n-numbers-format');
        correct = false;
    }

    if(size != null) {
        let number = value;
        if(number.charAt(0) === '-') {
            number = number.slice(1);
        }

        if(number.length > size) {
            openModal(element, 'i18n-max-size');
            correct = false;
        }
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }
}

function check_imagen(element) {
    var value = document.getElementById(element).value;
    var allowed_extensions = new Array('.jpg','.jpeg','.png');

    if(value.length !== 0) {
        extension = value.substring(value.lastIndexOf('.')).toLowerCase();
        if(allowed_extensions.includes(extension)) {
            return true;
        } else {
            openModal(element,'i18n-ext-not-allowed');
            return false;
        }
    }

    return true;
}


function check_letters_numbers_accents_spaces(element, size) {
    var correct = true;
    var value = document.getElementById(element).value;

    if(value.length > size) {
        openModal(element,'i18n-max-size');
        correct = false;
    }

    var pattern = /^[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]+(\s?[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]*)*$/g;
    if(!pattern.test(value)) {
        openModal(element,'i18n-letters-numbers-accents-spaces');
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

function check_text(element,size=null) {
    var correct = true;
    var value = document.getElementById(element).value;

    var pattern = /^[,¡!¿?.()/&ª\-_ºA-z0-9À-ú\s\t\n\u00f1\u00d1]+$/g;
    if(!pattern.test(value)) {
        openModal(element,'i18n-chars-not_allow');
        correct = false;
    }

    if(size != null) {
        if(value.length > size) {
            openModal(element,'i18n-max-size');
            correct = false;
        }
    }

    if(correct) {
        document.getElementById(element).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(element).style.borderColor = 'red';
        return false;
    }
}

function check_codigo_postal(element) {
    var correct = true;
    var value = document.getElementById(element).value;

    var pattern = /^[0-9]{5}$/;
    if(!pattern.test(value)) {
        openModal(element,'i18n-cp-format');
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

function check_URL(element) {
    var correct = true;
    var value = document.getElementById(element).value;

    var pattern = /^(ftp|http|https):\/\/[^\s"']+$/;
    if(!pattern.test(value)) {
        openModal(element, 'i18n-url-format');
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

function check_fecha_mayor_actual(element) {
    var correct = true;
    var fecha_actual = new Date();
    var fecha = new Date(document.getElementById(element).value);
    fecha_actual.setHours(0,0,0,0);

    if(fecha < fecha_actual) {
        openModal(element, 'i18n-fecha-menor-actual');
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

