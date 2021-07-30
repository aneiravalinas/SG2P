<?php

include_once './Model/Building_Model.php';
include_once './Model/Floor_Model.php';
include_once './Validation/Floor_Validation.php';
include_once './Service/Uploader_Service.php';

class Floor_Service extends Floor_Validation {

    var $atributos;
    var $building_entity;
    var $floor_entity;
    var $uploader;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('planta_id','edificio_id','nombre','num_planta','descripcion');
        $this->building_entity = new Building_Model();
        $this->floor_entity = new Floor_Model();
        $this->uploader = new Uploader();
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

        if(isset($_FILES['foto_planta']['name'])) {
            $this->foto_planta = $_FILES['foto_planta']['name'];
        } else {
            $this->foto_planta = '';
        }
    }

    function SEARCH() {
        // TODO: Validar Atributos Search.
        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['ok'] = false;
            $this->feedback['code'] = 'FLR_SRCH_NT_ALLOWED';
            $this->feedback['resource'] = array();
            return $this->feedback;
        }

        $this->feedback = $this->floor_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['bname'] = $building['nombre'];
            $this->feedback['code'] = 'FLR_SRCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'FLR_SRCH_KO';
        }

        return $this->feedback;
    }

    function seekByBuildingID() {
        $this->feedback = $this->building_entity->seek();
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLDID_NOT_EXST';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'BLDID_KO';
        }

        return $this->feedback;
    }
}