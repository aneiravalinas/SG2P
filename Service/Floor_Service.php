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

    /*
     *  - Recupera las plantas de un edificio.
     *      1. Valida y busca el edificio por ID, comprobando que existe.
     *      2. Si el rol del usuario es 'edificio', verifica que es el responsable del edificio sobre el que se realiza la consulta.
     *      3. Valida los atributos recibidos que se usarán como condiciones de filtrado.
     *      4. Recupera las plantas del edificio que coincidan con las condiciones de filtrado establecidas.
     */
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


    /*
     *  - Recupera los datos de una planta.
     *      1. Valida y busca la planta por ID, comprobando qeu existe.
     *      2. Si el rol del usuario es 'edificio', verifica que la planta pertenece a un edificio del cual sea responsable.
     */
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
                unset($this->feedback['resource']);
            } else {
                $this->feedback['code'] = 'FLR_SEEK_OK';
                $this->feedback['building'] = array('edificio_id' => $building['edificio_id'], 'nombre' => $building['nombre']);
            }
        } else if($this->feedback['code'] == 'FLRID_KO') {
            $this->feedback['code'] = 'FLR_SEEK_KO';
        }

        return $this->feedback;
    }

    // Valida y busca un edificio por ID, comprobando que existe.
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
        unset($this->feedback['resource']);
        return $this->feedback;
    }

    /*
     *  - Registra una planta en un edificio.
     *      1. Valida y busca el edificio por ID, comprobando que existe.
     *      2. Valida los datos de la planta.
     *      3. Verifica que no existe una planta en el mismo edificio con el número de planta especificado.
     *      4. Sube la foto de la planta en caso de que se haya adjuntado una.
     *      5. Registra los datos de la planta.
     */
    function ADD() {
        $validation = $this->validar_EDIFICIO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByBuildingID();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->num_planta_not_exists();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        if($this->foto_planta != '') {
            $this->feedback = $this->uploader->uploadPhoto(floor_photos_path, 'foto_planta');
            if(!$this->feedback['ok']) {
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

        return $this->feedback;
    }

    // Valida y busca una planta por ID, comprobando que existe. Recupera el edificio al que pertenece la planta.
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

    /*
     *  - Elimina una planta del sistema.
     *      1. Valida y busca la planta por ID, comprobando que existe.
     *      2. Verifica que la planta no tiene espacios asociados.
     *      3. Comprueba que la planta no tiene cumplimentaciones de rutas asignadas.
     *      4. Elimina la planta junto con la foto de la planta en caso de tenga una.
     */
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
            return $this->feedback;
        }

        $this->feedback = $this->has_not_routes();
        if(!$this->feedback['ok']) {
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

        return $this->feedback;
    }


    /*
     *  - Modifica los datos de una planta.
     *      1. Valida y busca una planta por ID, comprobando que existe.
     *      2. Valida los nuevos datos de la planta.
     *      3. En caso de que se haya informado un nuevo número de planta, comprueba que no existe otra planta en el mismo edificio con ese número de planta.
     *      4. Sube la nueva foto de la planta y elimina la anterior, en caso de que se haya adjuntado una.
     *      5. Modifica los datos de la planta.
     */
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
            return $validation;
        }

        if($floor['num_planta'] !== $this->num_planta) {
            $this->floor_entity->edificio_id = $floor['edificio_id'];
            $this->feedback = $this->num_planta_not_exists();
            if(!$this->feedback['ok']) {
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

        return $this->feedback;
    }

    /*
     *  - Busca las plantas asociadas al edificio del portal.
     *      1. Valida y busca el edificio por ID, comprobando que existe.
     *      2. Recupera las plantas asociadas al edificio.
     */
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

    /*
     *  - Recupera los detalles de la planta de un portal. Los detalles de una planta del portal incluyen la información de la planta junto con el listado de los espacios
     *    asociados.
     *      1. Valida y busca la planta por ID, comprobando que existe.
     *      2. Recupera los espacios asociados a la planta.
     */
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

    // Recupera los datos de un edificio por ID.
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

    // Verifica que no existe una planta con un número de planta específico en un edificio.
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

    // Verifica que una planta no tiene espacios asociados.
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

    // Verifica que una planta no tiene asociadas cumplimentaciones de rutas.
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