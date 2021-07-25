<?php

include_once './Model/Building_Model.php';
include_once './Validation/Building_Validation.php';

class Building_Service extends Building_Validation {

    var $atributos;
    var $building_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('edificio_id', 'username', 'nombre', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'telefono', 'fax');
        $this->building_entity = new Building_Model();
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

        if(isset($_FILES['foto_edificio']['name'])) {
            $this->foto_edificio = $_FILES['foto_edificio']['name'];
        } else {
            $this->foto_edificio = '';
        }
    }

    function SEARCH() {
        // TODO: Validar atributos search.

        if(es_resp_edificio()) {
            $this->building_entity->username = getUser();
            $this->feedback = $this->building_entity->searchByResp();
        } else {
            $this->feedback = $this->building_entity->SEARCH();
        }

        if($this->feedback['ok']) {
            $this->feedback['code'] = 'BLD_SRCH_OK';
        } else {
            $this->feedback['code'] = 'BLD_SRCH_KO';
        }

        return $this->feedback;
    }
}