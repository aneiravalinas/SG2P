var traduccion;

function setLang(lang = ''){

    if(lang == ''){
        if (getCookie('lang') != '') {
            lang = getCookie('lang');
        } else { 	
            lang='ES';
        }
    }

    setCookie('lang', lang, 1);

    switch(lang){
        case 'ES' : 
            traduccion = arrayES;
            break;
        case 'EN' :
            traduccion = arrayEN;
            break;
        case 'GA' :
            traduccion = arrayGA;
            break;
        default:
            traduccion = arrayES;
            break;
    }

    for(var clave in traduccion) {
        var elementos = document.getElementsByClassName(clave);
        for (var elem in elementos) {
            if (elem instanceof HTMLInputElement) {
                elem.placeholder = traduccion[clave];
            } else {
                elementos[elem].innerHTML = traduccion[clave];
            }
        }
        if (document.getElementById(clave)) {
            if (document.getElementById(clave) instanceof HTMLInputElement) {
                document.getElementById(clave).placeholder = traduccion[clave];
            } else {
                document.getElementById(clave).innerHTML = traduccion[clave];
            }
        }
    }
    
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function changeLang(lang){
    setCookie('lang',lang,5);
    window.location.reload(true);
}