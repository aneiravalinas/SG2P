<?php

include_once 'Validator.php';

class Building_Validation extends Validator {
    var $edificio_id;
    var $username;
    var $nombre;
    var $calle;
    var $ciudad;
    var $provincia;
    var $codigo_postal;
    var $telefono;
    var $fax;
    var $foto_edificio;

    function __construct() {

    }

}