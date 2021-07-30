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
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

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
            $this->feedback['code'] = 'FLR_SRCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'FLR_SRCH_KO';
        }

        $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);

        return $this->feedback;
    }

    function addForm() {
        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
        $this->feedback['resource'] = array();
        return $this->feedback;
    }

    function ADD() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        $this->feedback = $this->num_planta_not_exists();
        if(!$this->feedback['ok']) {
            $this->feedback['building'] = array('edificio_id' => $building['edificio_id']);
            return $this->feedback;
        }

        if($this->foto_planta != '') {
            $this->feedback = $this->uploader->uploadPhoto(floor_photos_path, 'foto_planta');
            if(!$this->feedback['ok']) {
                $this->feedback['building'] = array('edificio_id' => $building['edificio_id']);
                $this->feedback['code'] = 'FLR_PH_KO';
                return $this->feedback;
            } else{
                $this->foto_planta = $this->feedback['resource'];
                $this->floor_entity->foto_planta = $this->foto_planta;
            }
        } else {
            $this->floor_entity->foto_planta = default_floor_photo;
        }

        $this->feedback = $this->floor_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'FLR_ADD_OK';
        } else {
            if($this->foto_planta != default_floor_photo) {
                $this->uploader->deletePhoto(floor_photos_path,$this->foto_planta);
            }
            $this->feedback['code'] = 'FLR_ADD_KO';
        }

        $this->feedback['building'] = array('edificio_id' => $building['edificio_id']);
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


    function num_planta_not_exists() {
        $this->feedback = $this->floor_entity->seekNumPlanta();
        if($this->feedback['ok']) {
            if($this->feedback['code'] != 'QRY_EMPT') {
                $this->feedback['code'] = 'FLR_NUM_EXST';
                $this->feedback['ok'] = false;
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'NUM_PLNT_EXST_KO';
        }

        return $this->feedback;
    }

    /*function fillReturn($controller, $action, $params = array()) {
        $this->feedback['return']['controller'] = $controller;
        $this->feedback['return']['action'] = $action;
        $this->feedback['return']['params'] = array();
        foreach($params as $param=>$value) {
            array_push($this->feedback['return']['params'], array($param => $value));
        }

        return $this->feedback;
    }*/
}