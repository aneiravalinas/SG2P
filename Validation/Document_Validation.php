<?php

include_once 'Doc_Proc_Route_Validation.php';

class Document_Validation extends Doc_Proc_Route_Validation {
    var $documento_id;

    function __construct() {
    }

    function validar_doc_and_building() {
        $validacion = $this->validar_DOCUMENTO_ID();
        if(!$validacion['ok']) {
            return $validacion;
        }

        return $this->validar_EDIFICIO_ID();
    }

    function validar_atributos_add() {
        $validation = $this->validar_DOCUMENTO_ID();
        if(!$validation['ok']) {
            return $validation;
        }

        return $this->validar_BUILDINGS();
    }

    function validar_DOCUMENTO_ID() {
        if(!$this->no_vacio($this->documento_id)) {
            return $this->rellena_validation(false,'DFDOC_ID_EMPT','IMP_DOC');
        }

        if(!$this->es_numerico($this->documento_id)) {
            return $this->rellena_validation(false,'DFDOC_ID_NOT_NUMERIC','IMP_DOC');
        }

        return $this->rellena_validation(true,'00000','IMP_DOC');
    }

}