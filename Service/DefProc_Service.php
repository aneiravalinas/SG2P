<?php

include_once './Validation/DefProc_Validation.php';
include_once './Model/DefProc_Model.php';
include_once './Model/DefPlan_Model.php';

class DefProc_Service extends DefProc_Validation {
    var $atributos;
    var $defProc_entity;
    var $defPlan_entity;
    var $feedback = array();

    function __construct() {
        $this->atributos = array('procedimiento_id','plan_id','nombre','descripcion');
        $this->defProc_entity = new DefProc_Model();
        $this->defPlan_entity = new DefPlan_Model();
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
    }

    /*
     *  - Recupera las definiciones de procedimientos de un plan.
     *      1. Valida y busca un plan por ID, comprobando que existe.
     *      2. Valida los datos recibidos que se usarán como filtro en la búsqueda.
     *      3. Recupera las definiciones de procedimientos.
     */
    function SEARCH() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $plan = $this->feedback['resource'];
        $validation = $this->validar_atributos_search();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->defProc_entity->SEARCH();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_SEARCH_OK';
            $this->feedback['plan'] = array('plan_id' => $plan['plan_id'], 'nombre' => $plan['nombre']);
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_SEARCH_KO';
        }

        return $this->feedback;

    }

    // Valida y busca la definición de un plan por ID.
    function seekPlan() {
        $validation = $this->validar_PLAN_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->seekByPlanID();
    }

    /*
     *  - Añade la definición de un Procedimiento.
     *      1. Valida y busca la definición del plan al que se asocia el procedimiento, comprobando que existe.
     *      2. Valida los atributos que conforman la definición del procedimiento.
     *      3. Comprueba que el plan no tiene una definición de procedimiento con el mismo nombre.
     *      4. Añade la definición del procedimiento.
     */
    function ADD() {
        $this->feedback = $this->seekPlan();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->name_proc_not_exist();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->defProc_entity->ADD();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_ADD_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_ADD_KO';
        }

        return $this->feedback;
    }

    // Recupera la información de la definición de un procedimiento por ID.
    function seek() {
        $validation = $this->validar_PROCEDIMIENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        $this->feedback = $this->seekByProcID();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_SEEK_OK';
        } else if($this->feedback['code'] == 'DFPROCID_KO') {
            $this->feedback['code'] = 'DFPROC_SEEK_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Elimina la definición de un procedimiento.
     *      1. Valida y busca la definición de un procedimiento por ID, comprobando que existe.
     *      2. Verifica que no existan cumplimentaciones de ese procedimiento en algún edificio.
     *      3. Elimina la definición del procedimiento.
     */
    function DELETE() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->imp_procs_not_exist();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $this->feedback = $this->defProc_entity->DELETE();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_DEL_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_DEL_KO';
        }

        return $this->feedback;
    }

    /*
     *  - Modifica los datos de la definición de un procedimiento.
     *      1. Valida y busca la definición de un procedimiento por ID, comprobando qeu existe.
     *      2. Valida los nuevos datos recibidos.
     *      3. En caso de que se haya recibido un nuevo nombre, verifica que no exista una definición de procedimiento en el mismo plan con ese nombre.
     *      4. Modifica los datos de la definición del procedimiento.
     */
    function EDIT() {
        $this->feedback = $this->seek();
        if(!$this->feedback['ok']) {
            return $this->feedback;
        }

        $proc = $this->feedback['resource'];

        $validation = $this->validar_atributos();
        if(!$validation['ok']) {
            return $validation;
        }

        if($this->nombre != $proc['nombre']) {
            $this->defProc_entity->plan_id = $proc['plan_id'];
            $this->feedback = $this->name_proc_not_exist();
            if(!$this->feedback['ok']) {
                return $this->feedback;
            }
        }

        $this->feedback = $this->defProc_entity->EDIT();
        if($this->feedback['ok']) {
            $this->feedback['code'] = 'DFPROC_EDT_OK';
        } else if($this->feedback['code'] == 'QRY_KO') {
            $this->feedback['code'] = 'DFPROC_EDT_KO';
        }

        return $this->feedback;
    }

    // Recupera los datos de la definición de un procedimiento por ID.
    function seekByProcID() {
        $feedback = $this->defProc_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROCID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPROCID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROCID_KO';
        }

        return $feedback;
    }

    // Recupera los datos de la definición de un plan por ID.
    function seekByPlanID() {
        $feedback = $this->defPlan_entity->seek();
        if($feedback['ok']) {
            if($feedback['code'] == 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPLANID_NOT_EXST';
            } else {
                $feedback['code'] = 'DFPLANID_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPLANID_KO';
        }

        return $feedback;
    }

    // Comprueba que existe un procedimiento con el nombre indicado.
    function name_proc_not_exist() {
        $feedback = $this->defProc_entity->seekByProcName();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROC_NAME_EXST';
            } else {
                $feedback['code'] = 'DFPROC_NAME_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROC_NAME_KO';
        }

        return $feedback;
    }

    // Verifica que no existen cumplimentaciones de un procedimiento.
    function imp_procs_not_exist() {
        include_once './Model/ImpProc_Model.php';
        $impProc_entity = new ImpProc_Model();
        $feedback = $impProc_entity->searchByProcID();
        if($feedback['ok']) {
            if($feedback['code'] != 'QRY_EMPT') {
                $feedback['ok'] = false;
                $feedback['code'] = 'DFPROC_IMPL_EXST';
            } else {
                $feedback['code'] = 'DFPROC_IMPL_NOT_EXST';
            }
        } else if($feedback['code'] == 'QRY_KO') {
            $feedback['code'] = 'DFPROC_IMPL_KO';
        }

        return $feedback;
    }
}