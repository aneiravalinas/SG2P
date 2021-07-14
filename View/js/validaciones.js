function cerrarModal(){
    document.getElementById("myModal").style.display = "none"
    document.getElementById("myModal").className = document.getElementById("myModal").className.replace("show", "")
}
     
function abrirModal(name, tag){
    document.getElementById("mensajeError1").innerHTML = name;
    document.getElementById("mensajeError1").className = name;
    document.getElementById("mensajeError2").innerHTML = tag;
    document.getElementById("mensajeError2").className = tag;
    setLang();
    document.getElementById("myModal").style.display = "block"
    document.getElementById("myModal").className += "show"
}

window.onclick = function(event) {
    if (event.target == document.getElementById("myModal")) {
        cerrarModal();
    }
}  

function esNoVacio(idelemento){
    var correcto = false;
    valor = document.getElementById(idelemento).value;
    nombre = document.getElementById(idelemento).name;
    longitud = document.getElementById(idelemento).value.length;
    if ((valor == null) || (longitud == 0)){
        abrirModal(nombre, "no-vacio");
        correcto = false;
    } else {
        correcto = true;
    }
    if (correcto){
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    } else {
        document.getElementById(idelemento).style.borderColor = "red";
        return false;
    }
}

function comprobarLetrasNumeros(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[A-zÀ-ú0-9]+$/;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-letras-numeros");
        correcto = false;
    }
    if (correcto){
        document.getElementById(idelemento).style.borderColor = "green";
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = "red";
        return false;
    }
}

function comprobarSoloLetras(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[A-zÀ-ú\u00f1\u00d1]*$/g;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-letras");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function comprobarLetrasEspacios(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[A-zÀ-ú\u00f1\u00d1\s]+$/g;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-letras-espacios");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function comprobarLetrasGuiones(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[-_A-zÀ-ú\u00f1\u00d1]+$/g;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-letras-guiones");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function comprobarLetrasEspaciosGuion(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[-A-zÀ-ú\s\u00f1\u00d1]+$/g;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-letras-espacios-guiones");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function comprobarLetrasEspaciosNumerosCaracteresEspeciales(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[/&ªºA-z0-9À-ú\s\u00f1\u00d1]+$/g;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-letras-espacios-numeros-especiales");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}
  
function comprobarEmail(idelemento, size) {
    var correcto = true;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    var patron = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    if (!patron.test(document.getElementById(idelemento).value)){ 
        abrirModal(document.getElementById(idelemento).name, "formato-email");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function comprobarTelefono(idelemento) {
    var correcto = true;
    var patron = /^[98]{1}[1-9]{8}$/;
    if (!patron.test(document.getElementById(idelemento).value)){ 
        abrirModal(document.getElementById(idelemento).name, "formato-telefono");
        correcto = false;
    }
    if (correcto){      
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function comprobarSoloNumeros(idelemento, size) {
    var correcto = true;
    var patron = /^\d*$/;
    if (document.getElementById(idelemento).value.length > size) {
        abrirModal(document.getElementById(idelemento).name, "max-size");
        correcto = false;
    }
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "solo-numeros");
        correcto = false;
    }
    if (correcto){
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}

function encriptar(){
    document.getElementById('pass_usuario').value = hex_md5(document.getElementById('pass_usuario').value);
    return true;
}
      
function comprobarHoras(idelemento) {
    var correcto = true;
    var patron = /^[0-9]{2}:[0-9]{2}$/;
    if (!patron.test(document.getElementById(idelemento).value)){
        abrirModal(document.getElementById(idelemento).name, "formato-hora");
        correcto = false;
    }
    if (correcto){
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = 'red';
        return false;
    }
}
    
function comprobarLongitudMinima(idelemento, size){
    var correcto = false;
    longitud = document.getElementById(idelemento).value.length;
    if (longitud < size){
        abrirModal(document.getElementById(idelemento).name, "min-size");
        correcto = false;
    } else {
        correcto = true;
    }
    if (correcto){
        document.getElementById(idelemento).style.borderColor = 'green';
        return true;
    }
    else{
        document.getElementById(idelemento).style.borderColor = "red";
        return false;
    }
}

function despuesDeFecha(idFecha1, idFecha2) {
    var date1 = document.getElementById(idFecha1).value.split('-');
    var date2 = document.getElementById(idFecha2).value.split('-');
    if (new Date(date1[0], date1[1]-1, date1[2]).getTime() < new Date(date2[0], date2[1]-1, date2[2]).getTime()) {
        document.getElementById(idFecha2).style.borderColor = 'green';
        return true;
    } else {
        abrirModal(document.getElementById(idFecha2).name, "fecha-posterior");
        document.getElementById(idFecha2).style.borderColor = 'red';
        return false;
    }
}

function despuesDeHora(idHora1, idHora2) {
    var time1 = document.getElementById(idHora1).value.split(':');
    var time2 = document.getElementById(idHora2).value.split(':');
    if (new Date(2001, 1, 1, time1[0], time1[1]).getTime() < new Date(2001, 1, 1, time2[0], time2[1]).getTime()) {
        document.getElementById(idHora2).style.borderColor = 'green';
        return true;
    } else {
        abrirModal(document.getElementById(idFecha2).name, "hora-posterior");
        document.getElementById(idHora2).style.borderColor = 'red';
        return false;
    }
}

function comprobar_login(){
    if(
        esNoVacio('login_usuario') && comprobarLetrasNumeros('login_usuario',15) &&
        esNoVacio('pass_usuario')
    ){
        encriptar();
        return true;
    } else {
        return false;
    }
}

function comprobar_registro() {
    if (
        esNoVacio('login_usuario') && comprobarLetrasNumeros('login_usuario',15) && comprobarLongitudMinima('login_usuario', 3) &&
        esNoVacio('pass_usuario') &&
        esNoVacio('nombre_usuario') && comprobarLetrasEspacios('nombre_usuario',60) &&
        esNoVacio('email_usuario') && comprobarEmail('email_usuario',40)
    ) {
        encriptar();
        return true;
    } else return false;
}

function comprobar_recurso() {
    if (
        esNoVacio('nombre_recurso') && comprobarSoloLetras('nombre_recurso',40) &&
        esNoVacio('descripcion_recurso') && comprobarLetrasEspacios('descripcion_recurso',100) &&
        esNoVacio('tarifa_recurso') && comprobarSoloNumeros('tarifa_recurso', 3)
    ) return true;
    else return false;
}

function comprobar_busqueda_recurso() {
    if (
        comprobarSoloLetras('nombre_recurso',40) &&
        comprobarSoloNumeros('tarifa_recurso', 3)
    ) return true;
    else return false;
}

function comprobar_calendario() {
    if (
        esNoVacio('nombre_calendario') && comprobarSoloLetras('nombre_calendario',40) &&
        esNoVacio('descripcion_calendario') && comprobarLetrasEspacios('descripcion_calendario',100) &&
        esNoVacio('fecha_inicio_calendario') &&
        esNoVacio('fecha_fin_calendario') && despuesDeFecha('fecha_inicio_calendario', 'fecha_fin_calendario') &&
        esNoVacio('hora_inicio_calendario') &&
        esNoVacio('hora_fin_calendario') && despuesDeHora('hora_inicio_calendario', 'hora_fin_calendario')
    ) return true;
    else return false;
}

function comprobar_usuario() {
    if (
        esNoVacio('nombre_usuario') && comprobarLetrasEspaciosGuion('nombre_usuario',60) &&
        esNoVacio('login_usuario') && comprobarLetrasGuiones('login_usuario',40) && comprobarLongitudMinima('login_usuario', 3) &&
        esNoVacio('email_usuario') && comprobarEmail('email_usuario',40)
    ) {
        if (document.getElementById('direccion_responsable') !== null && document.getElementById('telefono_responsable') !== null) {
            if (
                esNoVacio('direccion_responsable') && comprobarLetrasEspaciosNumerosCaracteresEspeciales('direccion_responsable',60) &&
                esNoVacio('telefono_responsable') && comprobarTelefono('telefono_responsable',40)
            ) return true;
            else return false;
        } else return true;
    } else return false;
}

function comprobar_responsable() {
    if (
        esNoVacio('direccion_responsable') && comprobarLetrasEspaciosNumerosCaracteresEspeciales('direccion_responsable',60) &&
        esNoVacio('telefono_responsable') && comprobarTelefono('telefono_responsable',40)
    ) return true;
    else return false;
}

function comprobar_rechazo() {
    if (
        esNoVacio('motivo_rechazo') && comprobarLetrasEspacios('motivo_rechazo', 100)
    ) return true;
    else return false;
}


function comprobar_horario() {
    if (
        esNoVacio('hora_inicio_horario') &&
        esNoVacio('hora_fin_horario') && despuesDeHora('hora_inicio_horario', 'hora_fin_horario') &&
        esNoVacio('motivo_horario') && comprobarLetrasEspacios('motivo_horario', 100)
    ) return true;
    else return false;
}

function recalcCost(tarifa, rango){
    var numMinutos = 0;
    numMinutos += (parseInt(document.getElementById('hora_fin_horario').value.split(':')[0])*60 + parseInt(document.getElementById('hora_fin_horario').value.split(':')[1]));
    numMinutos -= (parseInt(document.getElementById('hora_inicio_horario').value.split(':')[0])*60 - parseInt(document.getElementById('hora_inicio_horario').value.split(':')[1]));
    if (rango == "HORA") {
        document.getElementById('cost-amount').innerHTML = ((numMinutos/60)*parseInt(tarifa)).toFixed(2)+" ";
    } else if (rango == "DIA") {
        document.getElementById('cost-amount').innerHTML = ((numMinutos/60)*parseInt(tarifa)/24).toFixed(2)+" ";
    } else if (rango == "MES") {
        document.getElementById('cost-amount').innerHTML = ((numMinutos/60)*parseInt(tarifa)/24/7).toFixed(2)+" ";
    } else {
        document.getElementById('cost-amount').innerHTML = ((numMinutos/60)*parseInt(tarifa)/24/30).toFixed(2)+" ";
    }
}