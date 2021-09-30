<?php

include_once 'Abstract_Model.php';

class ImpSim_Model extends Abstract_Model {
    var $atributos;
    var $edificio_simulacro_id;
    var $edificio_id;
    var $simulacro_id;
    var $estado;
    var $fecha_planificacion;
    var $url_recurso;
    var $destinatarios;
    var $nombre_edificio;

    function __construct() {
        $this->atributos = array('edificio_simulacro_id','simulacro_id','edificio_id','estado','fecha_planificacion','url_recurso','destinatarios','nombre_edificio');
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
            INSERT INTO EDIFICIO_SIMULACRO
            (
             edificio_id,
             simulacro_id,
             estado,
             fecha_planificacion,
             url_recurso,
             destinatarios
            ) VALUES (
            '$this->edificio_id',
            '$this->simulacro_id',
            '$this->estado',
            '$this->fecha_planificacion',
            '$this->url_recurso',
            '$this->destinatarios'
            );
        ";

        $this->execute_single_query();
        $this->edificio_simulacro_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE EDIFICIO_SIMULACRO SET " .
            ($this->fecha_planificacion == '' ? "" : "fecha_planificacion = '$this->fecha_planificacion', ") .
            ($this->url_recurso == '' ? "" : "url_recurso = '$this->url_recurso', ") .
            ($this->destinatarios == '' ? "" : "destinatarios = '$this->destinatarios', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE edificio_simulacro_id = '$this->edificio_simulacro_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_SIMULACRO
            WHERE
                edificio_simulacro_id = '$this->edificio_simulacro_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT EDIFICIO_SIMULACRO.*, EDIFICIO.nombre AS nombre_edificio
            FROM EDIFICIO_SIMULACRO
            INNER JOIN EDIFICIO
                ON EDIFICIO_SIMULACRO.edificio_id = EDIFICIO.edificio_id
            WHERE
                simulacro_id = '$this->simulacro_id' AND
                edificio_simulacro_id LIKE '%" . $this->edificio_simulacro_id . "%' AND
                EDIFICIO_SIMULACRO.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_planificacion LIKE '%" . $this->fecha_planificacion . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchImpSims() {
        $this->query = "
            SELECT * FROM EDIFICIO_SIMULACRO
            WHERE
                edificio_id = '$this->edificio_id' AND
                simulacro_id = '$this->simulacro_id' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_planificacion LIKE '%" . $this->fecha_planificacion . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchActiveImpSims() {
        $this->query = "
            SELECT * FROM EDIFICIO_SIMULACRO
            WHERE
                edificio_id = '$this->edificio_id' AND
                simulacro_id = '$this->simulacro_id' AND
                estado LIKE '%" . $this->estado . "%' AND
                estado != 'vencido'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function searchBySimID() {
        $this->query = "
            SELECT * FROM EDIFICIO_SIMULACRO
            WHERE simulacro_id = '$this->simulacro_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchSimsBuildings() {
        $this->query = "
            SELECT * FROM EDIFICIO_SIMULACRO
            WHERE
                edificio_id = '$this->edificio_id' AND
                simulacro_id = '$this->simulacro_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function setAttributes($atributos) {
        foreach($this->atributos as $atributo) {
            if(isset($atributos[$atributo])) {
                $this->$atributo = $atributos[$atributo];
            }
        }
    }


}