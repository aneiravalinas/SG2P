<?php

include_once './Model/Abstract_Model.php';

class Building_Model extends Abstract_Model {

    var $atributos;
    var $edificio_id;
    var $username;
    var $nombre;
    var $calle;
    var $ciudad;
    var $provincia;
    var $codigo_postal;
    var $telefono;
    var $foto_edificio;

    function __construct() {
        $this->atributos = array('edificio_id', 'username', 'nombre', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'telefono', 'foto_edificio');
        $this->fill_fields();
    }

    function fill_fields() {
        foreach($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }

    function ADD() {
        $this->query = "
            INSERT INTO EDIFICIO (
                            username,
                            nombre,
                            calle,
                            ciudad,
                            provincia,
                            codigo_postal,
                            telefono,
                            foto_edificio
                ) VALUES (
                          '$this->username',
                          '$this->nombre',
                          '$this->calle',
                          '$this->ciudad',
                          '$this->provincia',
                          '$this->codigo_postal',
                          '$this->telefono',
                          '$this->foto_edificio'
                );
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE EDIFICIO SET " .
            ($this->username == '' ? "" : "username = '$this->username', ") .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->calle == '' ? "" : "calle = '$this->calle', ") .
            ($this->ciudad == '' ? "" : "ciudad = '$this->ciudad', ") .
            ($this->provincia == '' ? "" : "provincia = '$this->provincia', ") .
            ($this->foto_edificio == '' ? "" : "foto_edificio = '$this->foto_edificio', ") .
            ($this->codigo_postal == '' ? "" : "codigo_postal = '$this->codigo_postal', ") .
            ($this->telefono == '' ? "" : "telefono = '$this->telefono'") .
            " WHERE edificio_id = '$this->edificio_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO
            WHERE edificio_id = '$this->edificio_id';
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT *
            FROM EDIFICIO
            WHERE
                edificio_id LIKE '%" . $this->edificio_id . "%' AND
                username LIKE '%" . $this->username . "%' AND
                nombre LIKE '%" . $this->nombre . "%' AND
                calle LIKE '%" . $this->calle . "%' AND
                ciudad LIKE '%" . $this->ciudad . "%' AND
                provincia LIKE '%" . $this->provincia . "%' AND
                codigo_postal LIKE '%" . $this->codigo_postal . "%' AND
                telefono LIKE '%" . $this->telefono . "%'";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByResp($username) {
        $this->query = "
            SELECT *
            FROM EDIFICIO
            WHERE
                edificio_id LIKE '%" . $this->edificio_id . "%' AND
                username = '$username' AND
                nombre LIKE '%" . $this->nombre . "%' AND
                calle LIKE '%" . $this->calle . "%' AND
                ciudad LIKE '%" . $this->ciudad . "%' AND
                provincia LIKE '%" . $this->provincia . "%' AND
                codigo_postal LIKE '%" . $this->codigo_postal . "%' AND
                telefono LIKE '%" . $this->telefono . "%'";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM EDIFICIO
            WHERE edificio_id = '$this->edificio_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function seekByUsername($username) {
        $this->query = "
            SELECT * FROM EDIFICIO
            WHERE username = '$username'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchCities() {
        $this->query = "
            SELECT DISTINCT ciudad
            FROM EDIFICIO
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByCity() {
        $this->query = "
            SELECT * FROM EDIFICIO
            WHERE ciudad = '$this->ciudad'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }
}