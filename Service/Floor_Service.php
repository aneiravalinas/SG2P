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

        $validation = $this->validar_EDIFICIO_ID();
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

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['building'] = array('edificio_id' => $building['edificio_id']);
            return $validation;
        }

        $this->feedback = $this->floor_entity->SEARCH();

        if($this->feedback['ok']) {
            $this->feedback['code'] = 'FLR_SRCH_OK';
            $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'FLR_SRCH_KO';
        }

        return $this->feedback;
    }


    function seek() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        if($this->feedback['ok']) {
            $this->building_entity->edificio_id = $this->feedback['resource']['edificio_id'];
            $building = $this->seekByBuildingID();
            $building = $building['resource'];
            if(es_resp_edificio() && $building['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'FLR_SEEK_NOT_ALLOWED';
                $this->feedback['resource'] = '';
            } else {
                $this->feedback['code'] = 'FLR_SEEK_OK';
                $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
            }
        } else if($this->feedback['code'] == 'FLRID_KO') {
            $this->feedback['code'] = 'FLR_SEEK_KO';
        }

        return $this->feedback;
    }

    function emptyForm() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

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
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['building'] = array('edificio_id' => $building['edificio_id']);
            return $validation;
        }

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
            $this->foto_planta = default_floor_photo;
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

    function dataForm() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        if($this->feedback['ok']) {
            $this->building_entity->edificio_id = $this->feedback['resource']['edificio_id'];
            $building = $this->seekByBuildingID();
            $this->feedback['building'] = array('nombre' => $building['resource']['nombre']);
        }
        return $this->feedback;
    }

    function DELETE() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $floor = $this->feedback['resource'];

        $this->feedback = $this->has_not_spaces();
        if(!$this->feedback['ok']) {
            $this->feedback['building'] = array('edificio_id' => $floor['edificio_id']);
            return $this->feedback;
        }

        $this->feedback = $this->has_not_routes();
        if(!$this->feedback['ok']) {
            $this->feedback['building'] = array('edificio_id' => $floor['edificio_id']);
            return $this->feedback;
        }

        $this->feedback = $this->floor_entity->DELETE();
        if($this->feedback['ok']) {
            if($floor['foto_planta'] != default_floor_photo) {
                $this->uploader->deletePhoto(floor_photos_path, $floor['foto_planta']);
            }
            $this->feedback['code'] = 'FLR_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'FLR_DEL_KO';
        }

        $this->feedback['building'] = array('edificio_id' => $floor['edificio_id']);
        return $this->feedback;
    }


    function EDIT() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $floor = $this->feedback['resource'];

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['building'] = array('edificio_id' => $floor['edificio_id']);
            return $validation;
        }

        if($floor['num_planta'] !== $this->num_planta) {
            $this->floor_entity->edificio_id = $floor['edificio_id'];
            $this->feedback = $this->num_planta_not_exists();
            if(!$this->feedback['ok']) {
                $this->feedback['building'] = array('edificio_id' => $floor['edificio_id']);
                return $this->feedback;
            }
        }

        if($this->foto_planta != '') {
            $this->feedback = $this->uploader->uploadPhoto(floor_photos_path,'foto_planta');
            if(!$this->feedback['ok']) {
                $this->feedback['code'] = 'FLR_PH_KO';
                $this->feedback['building'] = array('edificio_id' => $floor['edificio_id']);
                return $this->feedback;
            } else {
                $this->floor_entity->foto_planta = $this->feedback['resource'];
            }
        }

        $this->feedback = $this->floor_entity->EDIT();
        if($this->feedback['ok']) {
            if($this->foto_planta != '' && $floor['foto_planta'] != default_floor_photo) {
                $this->uploader->deletePhoto(floor_photos_path, $floor['foto_planta']);
            }
            $this->feedback['code'] = 'FLR_EDT_OK';
        } else {
            if($this->foto_planta != '') {
                $this->uploader->deletePhoto(floor_photos_path, $this->foto_planta);
            }
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'FLR_EDT_KO';
            }
        }

        $this->feedback['building'] = array('edificio_id' => $floor['edificio_id']);
        return $this->feedback;
    }

    function searchPortalFloors() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->floor_entity->searchByBuildingID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_FLR_SRCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'PRTL_FLR_SRCH_KO';
        }

        return $this->feedback;
    }

    function seekPortalFloor() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        if(!$this->feedback['ok']) {
            if($this->feedback['code'] == 'FLRID_KO') {
                $this->feedback['code'] = 'PRT_FLR_SEEK_KO';
            }
            return $this->feedback;
        }

        include_once './Model/Space_Model.php';
        $space_entity = new Space_Model();
        $this->feedback['spaces'] = $space_entity->searchByPlantaID()['resource'];
        $this->feedback['code'] = 'PRTL_FLR_SEEK_OK';

        return $this->feedback;
    }


    function seekByBuildingID() {
        $feedback = $this->building_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDID_NOT_EXST';
            } else {
                $feedback['code'] = 'BLDID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDID_KO';
        }

        return $feedback;
    }


    function num_planta_not_exists() {
        $feedback = $this->floor_entity->seekNumPlanta();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['code'] = 'FLR_NUM_EXST';
                $feedback['ok'] = false;
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'NUM_PLNT_EXST_KO';
        }

        return $feedback;
    }

    function seekByFloorID() {
        $feedback = $this->floor_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'FLRID_NOT_EXST';
            } else {
                $feedback['code'] = 'FLRID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'FLRID_KO';
        }

        return $feedback;
    }

    function has_not_spaces() {
        include_once './Model/Space_Model.php';
        $space_model = new Space_Model();
        $feedback = $space_model->searchByPlantaID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'FLR_SPC_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'FLR_SPC_KO';
        }

        return $feedback;
    }

    function has_not_routes() {
        include_once './Model/ImpRoute_Model.php';
        $impl_route_model = new ImpRoute_Model();
        $feedback = $impl_route_model->searchByPlantaID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'FLR_RT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'FLR_RT_KO';
        }

        return $feedback;
    }

}