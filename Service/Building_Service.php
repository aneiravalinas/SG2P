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

    function dataForm() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
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
            $this->feedback = $this->user_entity->change_role($this->username, 'edificio');
            if($this->feedback['ok']) {
                $this->feedback['code'] = 'BLD_ADD_OK';
            } else {
                $this->feedback['code'] = 'BLD_EDT_ROL_KO';
            }
        }

        return $this->feedback;

    }

    function DELETE() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];

        // TODO: Cuando se asignen planes, se debe comprobar si el edificio tiene planes asignados. En caso afirmativo, devolver código BLD_DEL_PLANS.

        $this->feedback = $this->building_entity->DELETE();
        if($this->feedback['ok']) {
            if($building['foto_edificio'] != default_building_photo) {
                $this->uploader->deletePhoto(building_photos_path, $building['foto_edificio']);
            }

            $this->feedback = $this->seekByUsername($building['username']);
            if($this->feedback['ok']) {
                $this->feedback['code'] = 'BLD_DEL_OK';
            } else {
                $this->feedback = $this->user_entity->change_role($building['username'],'registrado');
                if($this->feedback['ok']) {
                    $this->feedback['code'] = 'BLD_DEL_OK';
                } else {
                    $this->feedback['code'] = 'BLD_EDT_ROL_KO';
                }
            }
        } else {
            $this->feedback['code'] = 'BLD_DEL_KO';
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

    function seekByUsername($username) {
        $this->feedback = $this->building_entity->seekByUsername($username);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'USRNM_NOT_EXST';
            } else {
                $this->feedback['code'] = 'USRNM_EXST';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'USRNM_KO';
        }

        return $this->feedback;
    }


}