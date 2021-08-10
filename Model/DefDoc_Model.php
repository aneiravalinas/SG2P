<?php

include_once './Model/Abstract_Model.php';

class DefDoc_Model extends Abstract_Model {
    var $atributos;
    var $documento_id;
    var $plan_id;
    var $nombre;
    var $descripcion;
    var $visible;

    function __construct() {
        $this->atributos = array('documento_id','plan_id','nombre','descripcion','visible');
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

    function ADD() {
        $this->query = "
            INSERT INTO DOCUMENTO (
                plan_id,
                nombre,
                descripcion,
                visible
            ) VALUES (
                '$this->plan_id',
                '$this->nombre',
                '$this->descripcion',
                '$this->visible'
            );    
        ";

        $this->execute_single_query();
        $this->documento_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE DOCUMENTO SET " .
            ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
            ($this->descripcion == '' ? "" : "descripcion = '$this->descripcion', ") .
            ($this->visible == '' ? "" : "visible = '$this->visible'") .
            " WHERE documento_id = '$this->documento_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM DOCUMENTO
            WHERE documento_id = '$this->documento_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT * 
            FROM DOCUMENTO
            WHERE
                documento_id LIKE '%" . $this->documento_id . "%' AND
                nombre LIKE '%" . $this->nombre . "%' AND
                visible LIKE '%" . $this->visible . "%' AND
                plan_id = '$this->plan_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT * FROM DOCUMENTO
            WHERE documento_id = '$this->documento_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByPlan() {
        $this->query = "
            SELECT * FROM DOCUMENTO
            WHERE plan_id = '$this->plan_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seekByDocName() {
        $this->query = "
            SELECT * FROM DOCUMENTO
            WHERE 
                  nombre = '$this->nombre' AND 
                  plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

}