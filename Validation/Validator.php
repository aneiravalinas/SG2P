<?php

abstract class Validator {

    var $validation = array();

    function rellena_validation($ok = null, $code = null, $resource = null) {
        $this->validation['ok'] = $ok;
        $this->validation['code'] = $code;
        $this->validation['resource'] = $resource;
        return $this->validation;
    }

    //comprueba que un string no sobrepase la longitud maxima en base a un valor establecido
    //si es correcta devuelve true
    //si la longitud del string es mas larga que la del string devuelve false, el string no es valido
    function longitud_maxima($string,$valor){
        if(strlen($string)<=$valor){
            return true;
        }else{
            return false;
        }
    }

    //comprueba que un string tenga la longitud minima en base al valor establecido
    //si la longitud del string es correcta devuelve true
    //si la longitud del string es mas corta que la del string devuelve false, el string no es valido
    function longitud_minima($string,$valor){
        if(strlen($string)>=$valor){
            return true;
        }else{
            return false;
        }
    }
    //comprueba si un string tiene solo letras
    //devuelve true si es corrrecto false en caso contrario
    function solo_letras($string){
        if (preg_match('/[^a-zA-Z]/',$string)){
            return false;
        }else{
            return true;
        }
    }
    //comprueba si un string tiene solo letras y números
    //devuelve true si es corrrecto false en caso contrario
    function es_alfanumerico($string){
        if (preg_match('/[^a-zA-Z0-9áéíóúñÑ]/',$string)){
            return false;
        }else{
            return true;
        }
    }
    //comprueba si un string tiene solo numeros
    //devuelve true si es corrrecto false en caso contrario
    function es_numerico($string){
        if (preg_match('/[^0-9]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    //comprueba si un string tiene solo letras numeros y espacios
    //devuelve true si es corrrecto false en caso contrario
    function solo_alfanumerico_espacios($string){
        if (preg_match('/[^a-zA-Z0-9áéíóúñÑ\s]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    function solo_letras_espacios($string) {
        if (preg_match('/[^a-zA-ZáéíóúñÑ\s]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    //comprueba si un string tiene solo letras numeros espacios y guiones altos
    //devuelve true si es corrrecto false en caso contrario
    function solo_alfanumerico_espacios_guiones($string){
        if (preg_match('/[^a-zA-Z0-9áéíóúñÑ\s\-]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    function solo_letras_espacios_guiones($string) {
        if (preg_match('/[^a-zA-ZáéíóúñÑ\s\-]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    //comprueba si un string tiene solo letras numeros espacios y guiones
    //devuelve true si es corrrecto false en caso contrario
    function solo_alfanumerico_espacios_guiones_todos($string){
        if (preg_match('/[^a-zA-Z0-9áéíóúñÑ\s\-\_]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    function solo_letras_espacios_guiones_todos($string) {
        if (preg_match('/[^a-zA-ZáéíóúñÑ\s\-\_]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    function no_vacio($string){
        if(!preg_match('/[a-zA-Z0-9]+/', $string) || $string==''){
            return false;
        }else{
            return true;
        }
    }

    function en_valores($string, $array){
        if(in_array($string, $array)){
            return true;
        }else{
            return false;
        }
    }


    function formato_email($string){
        if(filter_var($string, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    function formato_email_search($email) {
        if(preg_match('/^([a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@)?[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/',$email)) {
            return true;
        } else {
            return false;
        }
    }

    function formato_dni($dni){
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
            return true;
        }else{
            return false;
        }
    }

    function formato_dni_search($dni) {
        if(preg_match('/^[0-9]{0,8}[A-Z]?$/',$dni)) {
            return true;
        } else {
            return false;
        }
    }

    function formato_fecha($fecha){
        if(!preg_match('/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/', $fecha)){
            return false;
        }else{
            return true;
        }
    }


    function es_rol($rol) {
        $roles = array('registrado','edificio','organizacion','administrador');
        return in_array($rol,$roles);
    }

    function formato_telefono($telefono) {
        return preg_match('/^[6-9][0-9]{8}$/', $telefono);
    }

    function extension_imagen($image) {
        $extensiones = array('jpg','jpeg','png');
        $path = $_FILES[$image]['name'];
        $extension = pathinfo($path)['extension'];

        return in_array($extension,$extensiones);
    }

    function extension_fichero($string) {
        $extension = pathinfo($string)['extension'];
        return $extension == 'pdf';
    }

    function max_tamanho_imagen($image, $size) {
        return ($_FILES[$image]['size'] <= $size);
    }

    function formato_nombre_imagen($image) {
        $name = $_FILES[$image]['name'];
        $filename = pathinfo($name)['filename'];

        if(preg_match('/[^a-zA-Z0-9\-\_]/', $filename)) {
            return false;
        } else {
            return true;
        }
    }

    function nombre_doc_search($nombre_doc) {
        if(preg_match('/^[a-zA-Z0-9_-]*(\.pdf)?$/', $nombre_doc)) {
            return true;
        } else {
            return false;
        }
    }

    function formato_nombre_fichero($string) {
        $filename = pathinfo($string)['filename'];
        if(preg_match('/[^a-zA-Z0-9\-\_]/', $filename)) {
            return false;
        } else {
            return true;
        }
    }

    function solo_letras_numeros_espacios_acentos($string) {
        if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]+[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ]*[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]+$/',$string)) {
            return true;
        } else {
            return false;
        }
    }

    function exact_size($string,$size) {
        if(strlen($string) == $size) {
            return true;
        } else {
            return false;
        }
    }

    function comprobar_textos($string) {
        if(preg_match('/^[.,¡!¿?\/&ª\-_ºA-Za-z0-9À-úñÑ\s\t\n]+$/',$string)) {
            return true;
        } else {
            return false;
        }
    }

    /*function validar_fecha($fecha) {
        if(preg_match('/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/', $fecha)) {
            return true;
        } else {
            return false;
        }
    }*/

    function validar_fecha($fecha) {
        if(preg_match('/^(\d{4})(\/|-)(0[1-9]|1[0-2])\2([0-2][0-9]|3[0-1])$/', $fecha)) {
            return true;
        } else {
            return false;
        }
    }

    function validar_fecha_futura($fecha) {
        $fecha_actual = new DateTime();
        $fecha_actual = $fecha_actual->format('Y/m/d');
        $fecha_entrada = new DateTime($fecha);
        $fecha_entrada = $fecha_entrada->format('Y/m/d');

        return $fecha_entrada >= $fecha_actual;
    }

    function validar_url($url) {
        if(preg_match('/^(ftp|http|https):\/\/[^ "\']+$/', $url)) {
            return true;
        } else {
            return false;
        }
    }

}