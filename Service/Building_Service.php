<?php

include_once './Model/Building_Model.php';
include_once './Model/User_Model.php';
include_once './Validation/Building_Validation.php';
include_once './Service/Uploader_Service.php';

class Building_Service extends Building_Validation {

    const roles_candidates = array('registrado','edificio');
    var $atributos;
    var $building_entity;
    var $user_entity;
    var $uploader;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('edificio_id', 'username', 'nombre', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'telefono', 'fax');
        $this->building_entity = new Building_Model();
        $this->user_entity = new User_Model();
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

    function addForm() {
        $this->feedback = $this->get_candidates();
        return $this->feedback;
    }

    function ADD() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        if(!$this->is_candidate($this->username)) {
            return $this->feedback;
        }

        if($this->foto_edificio != '') {
            $this->feedback = $this->uploader->uploadPhoto(building_photos_path, 'foto_edificio');
            if($this->feedback['ok']) {
                $this->foto_edificio = $this->feedback['resource'];
            } else {
                $this->feedback['code'] = 'BLD_PH_KO';
                return $this->feedback;
            }
        } else {
            $this->foto_edificio = default_building_photo;
        }

        $this->building_entity->foto_edificio = $this->foto_edificio;

        $this->feedback = $this->building_entity->ADD();
        if(!$this->feedback['ok']) {
            $this->feedback['code'] = 'BLD_ADD_KO';
            if($this->foto_perfil != default_building_photo) {
                $this->uploader->deletePhoto(building_photos_path, $this->foto_edificio);
            }
        } else {
            $this->feedback = $this->username->cambiar_rol($this->username, 'edificio');
            if($this->feedback['ok']) {
                $this->feedback['code'] = 'BLD_ADD_OK';
            } else {
                $this->feedback['code'] = 'BLD_EDT_ROL_KO';
            }
        }

        return $this->feedback;

    }


    function get_candidates() {
        $this->feedback = $this->user_entity->get_usernames_byRoles(self::roles_candidates);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_RESP_EMPT';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'GT_MANG_KO';
        }

        return $this->feedback;
    }

    function is_candidate($username) {
        $this->user_entity->username = $username;
        $this->feedback = $this->user_entity->seek();
        if($this->feedback['ok']) {
            if($this->feedback['code'] = 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'USRNM_NOT_EXST';
            } else {
                $user = $this->feedback['resource'];
                if(!in_array($user['rol'],self::roles_candidates)) {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = 'BLD_RESP_INV';
                }
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'USRNM_KO';
        }

        return $this->feedback;
    }
}