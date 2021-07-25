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
    var $fax;
    var $foto_edificio;

    function __construct() {
        $this->atributos = array('edificio_id', 'username', 'nombre', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'telefono', 'fax', 'foto_edificio');
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
        // TODO: Implement ADD() method.
    }

    function EDIT() {
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        // TODO: Implement DELETE() method.
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
                telefono LIKE '%" . $this->telefono . "%' AND
                fax LIKE '%" . $this->fax . "%'";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByResp() {
        $this->query = "
            SELECT *
            FROM EDIFICIO
            WHERE
                edificio_id LIKE '%" . $this->edificio_id . "%' AND
                username = '$this->username' AND
                nombre LIKE '%" . $this->nombre . "%' AND
                calle LIKE '%" . $this->calle . "%' AND
                ciudad LIKE '%" . $this->ciudad . "%' AND
                provincia LIKE '%" . $this->provincia . "%' AND
                codigo_postal LIKE '%" . $this->codigo_postal . "%' AND
                telefono LIKE '%" . $this->telefono . "%' AND
                fax LIKE '%" . $this->fax . "%'";

        $this->get_results_from_query();
        return $this->feedback;
    }

    protected function seek() {
        // TODO: Implement seek() method.
    }

}