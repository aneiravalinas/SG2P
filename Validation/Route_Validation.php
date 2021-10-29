<?php

include_once 'Doc_Proc_Route_Validation.php';

class Route_Validation extends Doc_Proc_Route_Validation {
    var $planta_id;
    var $ruta_id;
    var $nombre_planta;

    function __construct(){
    }


    function validar_atributos_search_portal() {
        $validacion = $this->rellena_validation(true, '00000', 'IMP_ROUTE');
        if($this->planta_id != '') {
            $validacion = $this->validar_PLANTA_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_doc != '') {
            $validacion = $this->validar_NOMBRE_DOC_SEARCH();
        }

        return $validacion;
    }

    function validar_atributos_search() {
        $validacion = parent::validar_atributos_search();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->planta_id != '') {
            $validacion = $this->validar_PLANTA_ID();
        }

        return $validacion;
    }

    function validar_atributos_searchCompletions() {
        $validacion = parent::validar_atributos_searchCompletions();
        if(!$validacion['ok']) {
            return $validacion;
        }

        if($this->planta_id != '') {
            $validacion = $this->validar_PLANTA_ID();
            if(!$validacion['ok']) {
                return $validacion;
            }
        }

        if($this->nombre_planta != '') {
            $validacion = $this->validar_NOMBRE_PLANTA();
        }

        return $validacion;
    }

    function validar_route_and_building() {
        $validacion = $this->validar_RUTA_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validation = $this->validar_RUTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_atributos_addRoute() {
        $validation = $this->validar_RUTA_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_PLANTA_ID();
    }

    function validar_PLANTA_ID() {
        if(!$this->no_vacio($this->planta_id)) {
            return $this->rellena_validation(false,'FLR_ID_EMPT','IMP_ROUTE');
        }

        if(!$this->es_numerico($this->planta_id)) {
            return $this->rellena_validation(false,'FLR_ID_NOT_NUMERIC','IMP_ROUTE');
        }

        return $this->rellena_validation(true,'00000','IMP_ROUTE');
    }

    function validar_RUTA_ID() {
        if(!$this->no_vacio($this->ruta_id)) {
            return $this->rellena_validation(false,'DFROUTE_ID_EMPT','IMP_ROUTE');
        }

        if(!$this->es_numerico($this->ruta_id)) {
            return $this->rellena_validation(false,'DEFROUTE_ID_NOT_NUMERIC','IMP_ROUTE');
        }

        return $this->rellena_validation(true,'00000','IMP_ROUTE');
    }

    function validar_NOMBRE_PLANTA() {
        if(!$this->longitud_minima($this->nombre_planta,3)) {
            return $this->rellena_validation(false,'FLR_NAM_SHRT','IMP_ROUTE');
        }

        if(!$this->longitud_maxima($this->nombre_planta,40)) {
            return $this->rellena_validation(false,'FLR_NAM_LRG','IMP_ROUTE');
        }

        if(!$this->solo_letras_numeros_espacios_acentos($this->nombre_planta)) {
            return $this->rellena_validation(false,'FLR_NAM_FRMT','IMP_ROUTE');
        }

        return $this->rellena_validation(true,'00000','IMP_ROUTE');
    }

}