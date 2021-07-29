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
        if (preg_match('/[^a-zA-Z0-9]/',$string)){
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
    function solo_letras_espacios($string){
        if (preg_match('/[^a-zA-Z0-9\s]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    //comprueba si un string tiene solo letras numeros espacios y guiones altos
    //devuelve true si es corrrecto false en caso contrario
    function solo_letras_espacios_guiones($string){
        if (preg_match('/[^a-zA-Z0-9\s\-]/',$string)){
            return false;
        }else{
            return true;
        }
    }

    //comprueba si un string tiene solo letras numeros espacios y guiones
    //devuelve true si es corrrecto false en caso contrario
    function solo_letras_espacios_guiones_todos($string){
        if (preg_match('/[^a-zA-Z0-9\s\-\_]/',$string)){
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
        if(preg_match('/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@?[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/',$email)) {
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

}