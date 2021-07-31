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
        $this->atributos = array('edificio_id', 'username', 'nombre', 'calle', 'ciudad', 'provincia', 'codigo_postal', 'telefono');
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

    function searchForm() {
        $this->feedback = $this->user_entity->searchByRol('edificio');
        return $this->feedback;
    }

    function SEARCH() {
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        if(es_resp_edificio()) {
            $this->feedback = $this->building_entity->searchByResp(getUser());
        } else {
            $this->feedback = $this->building_entity->SEARCH();
        }
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'BLD_SRCH_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'BLD_SRCH_KO';
        }

        return $this->feedback;
    }


    function addForm() {
        $this->feedback = $this->get_candidates();
        return $this->feedback;
    }

    function deleteForm() {
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
            if($this->foto_edificio != default_building_photo) {
                $this->uploader->deletePhoto(building_photos_path, $this->foto_edificio);
            }
        } else {
            $this->feedback = $this->user_entity->change_role($this->username, 'edificio');
            if($this->feedback['ok']) {
                $this->feedback['code'] = 'BLD_ADD_OK';
            } else {
                $this->feedback['code'] = 'BLD_ADD_OK_ROL_KO';
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

        $this->feedback = $this->has_not_floors();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->has_not_plans();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

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
                    $this->feedback['code'] = 'BLD_DEL_OK_ROL_KO';
                }
            }
        } else {
            $this->feedback['code'] = 'BLD_DEL_KO';
        }

        return $this->feedback;
    }

    function editForm() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        $candidates = $this->get_candidates()['resource'];

        $this->feedback['ok'] = true;
        $this->feedback['resource'] = array('building' => $building, 'candidates' => $candidates);

        return $this->feedback;
    }

    function EDIT() {
        $validation = $this->validar_atributos_edit();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $building = $this->feedback['resource'];
        $this->feedback = $this->is_candidate($this->username);
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        if($this->foto_edificio != '') {
            $this->feedback = $this->uploader->uploadPhoto(building_photos_path, 'foto_edificio');
            if(!$this->feedback['ok']) {
                $this->feedback['code'] = 'BLD_PH_KO';
                return $this->feedback;
            }
            $this->foto_edificio = $this->feedback['resource'];
            $this->building_entity->foto_edificio = $this->foto_edificio;
            $this->feedback = $this->building_entity->EDIT();
            if($this->feedback['ok']) {
                if($building['foto_edificio'] != default_building_photo) {
                    $this->uploader->deletePhoto(building_photos_path,$building['foto_edificio']);
                }
            } else{
                if($this->feedback['code'] == 'QRY_KO') {
                    $this->feedback['code'] = 'BLD_EDIT_KO';
                }
                $this->uploader->deletePhoto(building_photos_path,$this->foto_edificio);
            }
        } else {
            $this->feedback = $this->building_entity->EDIT();
            if(!$this->feedback['ok'] && $this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'BLD_EDIT_KO';
            }
        }

        if($this->feedback['ok']) {
            $failed = false;
            if($this->username != $building['username']) {
                $this->feedback = $this->user_entity->change_role($this->username,'edificio');
                if(!$this->feedback['ok']) {
                    $failed = true;
                }
                $this->feedback = $this->seekByUsername($building['username']);
                if(!$this->feedback['ok']) {
                    $this->feedback = $this->user_entity->change_role($building['username'],'registrado');
                    if(!$this->feedback['ok']) {
                        $failed = true;
                    }
                }
            }
            if($failed) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_EDIT_OK_ROL_KO';
            } else {
                $this->feedback['ok'] = true;
                $this->feedback['code'] = 'BLD_EDIT_OK';
            }

        }

        return $this->feedback;
    }

    function seek() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if($this->feedback['ok']) {
            if(es_resp_edificio()) {
                $building = $this->feedback['resource'];
                if ($building['username'] != getUser()) {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = 'BLD_CURRNT_MANG_KO';
                    $this->feedback['resource'] = array();
                } else {
                    $this->feedback['code'] = 'BLD_CURRENT_OK';
                }
            }
        } else if($this->feedback['code'] == 'BLDID_KO') {
            $this->feedback['code'] = 'BLD_CURRENT_KO';
        }

        return $this->feedback;
    }

    function seekPortal() {
        if(isset($_SESSION) && isset($_SESSION['portal'])) {
            $this->edificio_id = $_SESSION['portal'];
            $this->building_entity->edificio_id = $this->edificio_id;
        }

        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if($this->feedback['ok']) {
            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['portal'] = $this->feedback['resource']['edificio_id'];
        }
        return $this->feedback;
    }

    function showCities() {
        $this->feedback = $this->building_entity->searchCities();
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'CTY_NOT_FOUND';
            } else {
                $this->feedback['code'] = 'SRCH_CTY_OK';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'SRCH_CTY_KO';
        }

        return $this->feedback;
    }

    function searchBuildingsByCity() {
        $validation = $this->validar_CIUDAD();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->building_entity->searchByCity();
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['code'] = 'CTY_NOT_EXST';
            } else {
                $this->feedback['code'] = 'SRCH_BY_CTS_OK';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'SRCH_BY_CTS_KO';
        }

        return $this->feedback;
    }


    function get_candidates() {
        $this->feedback = $this->user_entity->get_usernames_byRoles(self::roles_candidates);
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'MANG_EMPT';
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
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'MANG_NOT_EXST';
            } else {
                $user = $this->feedback['resource'];
                if(!in_array($user['rol'],self::roles_candidates)) {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = 'MANG_INV';
                }
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'MANG_KO';
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
                $this->feedback['code'] = 'MANG_NOT_EXST';
            } else {
                $this->feedback['code'] = 'MANG_EXST';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'MANG_KO';
        }

        return $this->feedback;
    }


    function has_not_floors() {
        include_once './Model/Floor_Model.php';
        $floor_model = new Floor_Model();
        $this->feedback = $floor_model->searchByBuildingID();
        if($this->feedback['ok']) {
            if($this->feedback['code'] != 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_FLR_EXST';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'BLD_SRCH_FLR_KO';
        }

        return $this->feedback;
    }

    function has_not_plans() {
        include_once './Model/Build_Plan_Model.php';
        $build_plan_model = new Build_Plan_Model();
        $this->feedback = $build_plan_model->searchByBuildingID();
        if($this->feedback['ok']) {
            if($this->feedback['code'] != 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLD_PLN_EXST';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'BLD_SRCH_PLN_KO';
        }

        return $this->feedback;
    }

}