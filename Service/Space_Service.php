<?php

include_once './Validation/Space_Validation.php';
include_once './Model/Space_Model.php';
include_once './Model/Floor_Model.php';
include_once './Model/Building_Model.php';
include_once './Service/Uploader_Service.php';

class Space_Service extends Space_Validation {
    var $atributos;
    var $space_entity;
    var $floor_entity;
    var $building_entity;
    var $uploader;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('espacio_id','planta_id','nombre','dimensiones','descripcion');
        $this->space_entity = new Space_Model();
        $this->floor_entity = new Floor_Model();
        $this->building_entity = new Building_Model();
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

        if(isset($_FILES['foto_espacio']['name'])) {
            $this->foto_espacio = $_FILES['foto_espacio']['name'];
        } else {
            $this->foto_espacio = '';
        }
    }

    /*
     *  - Recupera los espacios asociados a una planta.
     *      1. Valida y busca una planta por ID, comprobando que existe.
     *      2. Recupera el edificio asociado a la planta. Si el usuario tiene el rol de 'edificio', verifica que el espacio pertenece a un edificio del cual sea responsable.
     *      3. Valida los atributos recibidos que se usarán como filtro.
     *      4. Recupera los espacios de la planta que coincidan con los criterios establecidos.
     */
    function SEARCH() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $floor = $this->feedback['resource'];
        $this->building_entity->edificio_id = $floor['edificio_id'];
        $this->feedback = $this->seekByBuildingID();
        $building = $this->feedback['resource'];

        if(es_resp_edificio() && $building['username'] != getUser()) {
            $this->feedback['code'] = 'SPC_SRCH_NOT_ALLOWED';
            $this->feedback['ok'] = false;
            $this->feedback['resource'] = array();
            return $this->feedback;
        }

        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            $validation['floor'] = array('planta_id' => $floor['planta_id']);
            return $validation;
        }

        $this->feedback = $this->space_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'SPC_SRCH_OK';
            $this->feedback['floor'] = array('planta_id' => $floor['planta_id'], 'nombre' => $floor['nombre'], 'edificio_id' => $floor['edificio_id']);
        } else {
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'SPC_SRCH_KO';
            }
        }

        return $this->feedback;

    }

    /*
     *  - Recupera los datos de un espacio.
     *      1. Valida y busca un espacio por ID, comprobando que existe.
     *      2. Recupera los datos de la planta y el edificio al que pertenece el espacio. Si el rol del usuario es 'edificio', verifica que el usuario es responsable
     *         del edificio al que pertenece el espacio.
     */
    function seek() {
        $validation = $this->validar_ESPACIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySpaceID();
        if(!$this->feedback['ok']) {
            if($this->feedback['code'] == 'SPCID_KO') {
                $this->feedback['code'] = 'SPC_SEEK_KO';
            }
            return $this->feedback;
        }

        $this->floor_entity->planta_id = $this->feedback['resource']['planta_id'];
        $floor = $this->seekByFloorID()['resource'];

        if(es_resp_edificio()) {
            $this->building_entity->edificio_id = $floor['edificio_id'];
            $building = $this->seekByBuildingID()['resource'];
            if($building['username'] != getUser()) {
                $this->feedback['ok'] = false;
                $this->feedback['code'] = 'SPC_SEEK_NOT_ALLOWED';
                $this->feedback['resource'] = array();
                return $this->feedback;
            }
        }

        $this->feedback['code'] = 'SPC_SEEK_OK';
        $this->feedback['floor'] = array('nombre' => $floor['nombre']);
        return $this->feedback;
    }

    // Valida y busca una planta por ID.
    function emptyForm() {
        $validation = $this->validar_PLANTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByFloorID();
        return $this->feedback;
    }

    // Valida y busca un espacio por ID. Recupera los datos de la planta asociada.
    function dataForm() {
        $validation = $this->validar_ESPACIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySpaceID();
        if($this->feedback['ok']) {
            $this->floor_entity->planta_id = $this->feedback['resource']['planta_id'];
            $floor = $this->seekByFloorID()['resource'];
            $this->feedback['floor'] = array('nombre' => $floor['nombre']);
        }

        return $this->feedback;
    }

    /*
     *  - Registra un espacio en el sistema.
     *      1. Valida y busca una planta por ID, comprobando que existe.
     *      2. Valida los datos con los que se va a registrar el espacio.
     *      3. Verifica que no exista un espacio en la misma planta con el nombre indicado.
     *      4. Sube la foto del espacio en caso de que se haya adjuntado una.
     *      5. Registra los datos del espacio.
     */
    function ADD() {
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
            $validation['floor'] = array('planta_id' => $floor['planta_id']);
            return $validation;
        }

        $this->feedback = $this->name_space_not_exists();
        if(!$this->feedback['ok']) {
            $this->feedback['floor'] = array('planta_id' => $floor['planta_id']);
            return $this->feedback;
        }

        if($this->foto_espacio != '') {
            $this->feedback = $this->uploader->uploadPhoto(space_photos_path, 'foto_espacio');
            if(!$this->feedback['ok']) {
                $this->feedback['code'] = 'SPC_PH_KO';
                $this->feedback['floor'] = array('planta_id' => $floor['planta_id']);
                return $this->feedback;
            }
            $this->foto_espacio = $this->feedback['resource'];
        } else {
            $this->foto_espacio = default_space_photo;
        }

        $this->space_entity->foto_espacio = $this->foto_espacio;
        $this->feedback = $this->space_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'SPC_ADD_OK';
        } else {
            if($this->foto_espacio != default_space_photo) {
                $this->uploader->deletePhoto(space_photos_path, $this->foto_espacio);
            }
            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'SPC_ADD_KO';
            }
        }

        $this->feedback['floor'] = array('planta_id' => $floor['planta_id']);
        return $this->feedback;

    }

    /*
     *  - Elimina los datos de un espacio.
     *      1. Valida y busca un espacio por ID, comprobando que existe.
     *      2. Elimina los datos del espacio. En caso de que el espacio tenga una foto asociada, la elimina.
     */
    function DELETE() {
        $validation = $this->validar_ESPACIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySpaceID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $floor = $this->feedback['resource'];
        $this->feedback = $this->space_entity->DELETE();
        if($this->feedback['ok']) {
            if($floor['foto_espacio'] != default_floor_photo) {
                $this->uploader->deletePhoto(space_photos_path, $floor['foto_espacio']);
            }
            $this->feedback['code'] = 'SPC_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'SPC_DEL_KO';
        }

        $this->feedback['floor'] = array('planta_id' => $floor['planta_id']);
        return $this->feedback;
    }

    /*
     *  - Modifica los datos de un espacio.
     *      1. Valida y busca un espacio por ID, comprobando que existe.
     *      2. Valida los datos que se van a modificar del espacio.
     *      3. En caso que se haya informado un nuevo nombre de espacio, verifica que no exista otro espacio en la misma planta con el nuevo nombre.
     *      4. Sube la nueva foto del espacio en caso de que se haya adjuntado una nueva, y elimina la anterior.
     *      5. Modifica los datos del espacio.
     */
    function EDIT() {
        $validation = $this->validar_ESPACIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySpaceID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $space = $this->feedback['resource'];
        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            $validation['floor'] = array('planta_id' => $space['planta_id']);
            return $validation;
        }

        if($space['nombre'] != $this->nombre) {
            $this->space_entity->planta_id = $space['planta_id'];
            $this->feedback = $this->name_space_not_exists();
            if(!$this->feedback['ok']) {
                $this->feedback['floor'] = array('planta_id' => $space['planta_id']);
                return $this->feedback;
            }
        }

        if($this->foto_espacio != '') {
            $this->feedback = $this->uploader->uploadPhoto(space_photos_path, 'foto_espacio');
            if(!$this->feedback['ok']) {
                $this->feedback['code'] = 'SPC_PH_KO';
                $this->feedback['floor'] = array('planta_id' => $space['planta_id']);
                return $this->feedback;
            }
            $this->foto_espacio = $this->feedback['resource'];
            $this->space_entity->foto_espacio = $this->foto_espacio;
        }

        $this->feedback = $this->space_entity->EDIT();
        if($this->feedback['ok']) {
            if($this->foto_espacio != '' && $space['foto_espacio'] != default_space_photo) {
                $this->uploader->deletePhoto(space_photos_path, $space['foto_espacio']);
            }
            $this->feedback['code'] = 'SPC_EDT_OK';
        } else {
            if($this->foto_espacio != '') {
                $this->uploader->deletePhoto(space_photos_path, $this->foto_espacio);
            }

            if($this->feedback['code'] == 'QRY_KO') {
                $this->feedback['code'] = 'SPC_EDT_KO';
            }
        }

        $this->feedback['floor'] = array('planta_id' => $space['planta_id']);
        return $this->feedback;
    }

    // Recupera los datos del espacio de un portal.
    function seekPortalSpace() {
        $validation = $this->validar_ESPACIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekBySpaceID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'PRTL_SPC_SEEK_OK';
        } else if($this->feedback['code'] == 'SPCID_KO') {
            $this->feedback['code'] = 'PRTL_SPC_SEEK_KO';
        }

        return $this->feedback;
    }

    // Comprueba que no existe un espacio con el nombre indicado.
    function name_space_not_exists() {
        $feedback = $this->space_entity->seekNameSpace();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'SPC_NAM_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'SPC_NAM_KO';
        }

        return $feedback;
    }

    // Recupera los datos de un espacio por ID.
    function seekBySpaceID() {
        $feedback = $this->space_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'SPCID_NOT_EXST';
            } else {
                $feedback['code'] = 'SPCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'SPCID_KO';
        }

        return $feedback;
    }

    // Recupera los datos de una planta por ID.
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

    // Recupera los datos de un edificio por ID.
    function seekByBuildingID() {
        $feedback = $this->building_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'BLDID_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'BLDID_KO';
        }

        return $feedback;
    }
}