function check_FORMATION_IMPLEMENT() {
    return check_RECURSO() &&
        check_DESTINATARIOS() &&
        check_FECHA_PLANIFICACION();
}

function check_RECURSO() {
    if(not_empty('url_recurso')) {
        return check_URL('url_recurso');
    } else {
        document.getElementById('url_recurso').style.borderColor = 'green';
        return true;
    }
}

function check_DESTINATARIOS() {
    return not_empty('destinatarios', true) &&
            check_text('destinatarios',200);
}

function check_FECHA_PLANIFICACION() {
    return not_empty('fecha_planificacion', true) &&
            check_fecha_mayor_actual('fecha_planificacion');
}