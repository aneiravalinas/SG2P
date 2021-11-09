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

    // Recupera los usuarios con rol de responsable de edificio para poder ser utilizados como condición de filtrado.
    function searchForm() {
        $this->feedback = $this->user_entity->searchByRol('edificio');
        return $this->feedback;
    }

    /*
     *  - Recupera los datos de los edificios registrados en sistema.
     *      1. Valida los atributos que se utilizarán como condición de filtrado.
     *      2. Recupera los edificios que coincidan con el filtro. Si el rol del usuario es responsable de edificio, solo se recuperan aquellos edificios que tenga asignado.
     */
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

    // Recupera aquellos usuarios que son candidatos a ser responsables de un edificio (Rol 'registrado' o 'edificio').
    function addForm() {
        $this->feedback = $this->get_candidates();
        return $this->feedback;
    }

    // Valida y busca un edificio por ID, comprobando que existe.
    function deleteForm() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        return $this->feedback;
    }

    /*
     *  - Registra un edificio en el sistema.
     *      1. Valida los atributos recibidos.
     *      2. Verifica que el usuario informado para ser el responsable del edificio es un usuario candidato a serlo (el rol del usuario es 'edificio' o 'registrado').
     *      3. Sube la foto del edificio en caso de que se haya informado.
     *      4. Registra el edificio en sistema y modifica el rol del usuario asignado a 'edificio'.
     */
    function ADD() {
        $validation = $this->validar_atributos_add();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->is_candidate($this->username);
        if(!$this->feedback['ok']) {
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

    /*
     *  - Elimina un edificio del sistema.
     *      1. Valida y busca un edificio por ID, comprobando que existe.
     *      2. Verifica que el edificio no tenga plantas asociadas.
     *      3. Comprueba que el edificio no tenga planes asignados.
     *      4. Elimina el edificio y la foto asociada en caso de que exista una.
     *      5. Comprueba si el usuario responsable del edificio tiene más edificios asignados. En caso de que no los tenga,
     *         modifica su rol a 'registrado'.
     */
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

    /*
     *  1. Valida y busca un edificio por ID, comprobando que existe.
     *  2. Recupera los usuarios candidatos a ser el responsable del edificio (rol 'edificio' o 'registrado')
     */
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
        $this->feedback['code'] = 'BLDID_EXST';
        $this->feedback['resource'] = array('building' => $building, 'candidates' => $candidates);

        return $this->feedback;
    }

    /*
     *  - Modifica los datos de un edificio.
     *      1. Valida los atributos recibidos.
     *      2. Recupera el edificio por ID, comprobando que existe.
     *      3. Comprueba que el usuario asignado al edificio es candidato a ser responsable del edificio (rol 'edificio' o 'registrado').
     *      4. Sube la nueva foto del edificio y elimina la anterior, en caso de que se haya informado una foto nueva.
     *      5. Modifica los datos del edificio. En caso que se haya modificado el responsable del edificio, modifica el rol del nuevo usuario y del antiguo.
     */
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

    /*
     *  - Recupera los datos de un edificio.
     *      1. Valida y busca un edificio por ID, comprobando que existe.
     *      2. Si el usuario que solicita la acción es 'edificio', verifica que el usuario es responsable del edificio.
     */
    function seek() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'BLD_CURRENT_OK';
            if(es_resp_edificio()) {
                $building = $this->feedback['resource'];
                if ($building['username'] != getUser()) {
                    $this->feedback['ok'] = false;
                    $this->feedback['code'] = 'BLD_CURRNT_MANG_KO';
                    $this->feedback['resource'] = array();
                }
            }
        } else if($this->feedback['code'] == 'BLDID_KO') {
            $this->feedback['code'] = 'BLD_CURRENT_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Recupera los datos del edificio del portal.
     *      1. Si no se recibe un ID de edificio, recupera los datos del edificio cuyo identificador esté almacenado en sesión.
     *      2. Valida y recupera el edificio por ID, comprobando que existe.
     *      3. Almacena el ID del edificio en sesión.
     */
    function seekPortal() {
        if($this->edificio_id == '') {
            if(isset($_SESSION['portal'])) {
                $this->edificio_id = $_SESSION['portal'];
                $this->building_entity->edificio_id = $this->edificio_id;
            }
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

    // Recupera las ciudades en las que haya edificios registrados.
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

    // Recupera los edificios de una determina ciudad.
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

    // Recupera los usuarios candidatos a ser responsable de edificio.
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

    // Verifica que un usuario es candidato a ser responsable de edificio.
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

    // Recupera un edificio por ID.
    function seekByBuildingID() {
        $this->feedback = $this->building_entity->seek();
        if($this->feedback['ok']) {
            if($this->feedback['code'] == 'QRY_EMPT') {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'BLDID_NOT_EXST';
            } else {
                $this->feedback['code'] = 'BLDID_EXST';
            }
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'BLDID_KO';
        }

        return $this->feedback;
    }

    // Recupera un usuario por ID.
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

    // Verifica que un edificio no tiene plantas asociadas.
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

    // Verifica que un edificio no tenga planes asignados.
    function has_not_plans() {
        include_once './Model/BuildPlan_Model.php';
        $build_plan_model = new BuildPlan_Model();
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