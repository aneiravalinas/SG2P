<?php

include_once 'Abstract_Model.php';

class ImpFormat_Model extends Abstract_Model {
    var $atributos;
    var $edificio_formacion_id;
    var $edificio_id;
    var $formacion_id;
    var $estado;
    var $fecha_planificacion;
    var $url_recurso;
    var $destinatarios;
    var $nombre_edificio;

    function __construct() {
        $this->atributos = array('edificio_formacion_id','edificio_id','formacion_id','estado','fecha_planificacion','url_recurso','destinatarios','nombre_edificio');
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
            INSERT INTO EDIFICIO_FORMACION
            (
             edificio_id,
             formacion_id,
             estado,
             fecha_planificacion,
             url_recurso,
             destinatarios
            ) VALUES (
             '$this->edificio_id',
             '$this->formacion_id',
             '$this->estado',
             '$this->fecha_planificacion',
             '$this->url_recurso',
             '$this->destinatarios'
            );
        ";

        $this->execute_single_query();
        $this->edificio_formacion_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE EDIFICIO_FORMACION SET " .
            ($this->fecha_planificacion == '' ? "" : "fecha_planificacion = '$this->fecha_planificacion', ") .
            ($this->url_recurso == '' ? "" : "url_recurso = '$this->url_recurso', ") .
            ($this->destinatarios == '' ? "" : "destinatarios = '$this->destinatarios', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE edificio_formacion_id = '$this->edificio_formacion_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_FORMACION
            WHERE
                edificio_formacion_id = '$this->edificio_formacion_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT EDIFICIO_FORMACION.*, EDIFICIO.nombre AS nombre_edificio
            FROM EDIFICIO_FORMACION
            INNER JOIN EDIFICIO
                ON EDIFICIO_FORMACION.edificio_id = EDIFICIO.edificio_id
            WHERE
                formacion_id = '$this->formacion_id' AND
                edificio_formacion_id LIKE '%" . $this->edificio_formacion_id . "%' AND
                EDIFICIO_FORMACION.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_planificacion LIKE '%" . $this->fecha_planificacion . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchImpFormats() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE
                edificio_id = '$this->edificio_id' AND
                formacion_id = '$this->formacion_id' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_planificacion LIKE '%" . $this->fecha_planificacion . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT EDIFICIO_FORMACION.*, EDIFICIO.username, EDIFICIO.nombre AS nombre_edificio, FORMACION.nombre AS nombre_formacion, FORMACION.plan_id
            FROM EDIFICIO_FORMACION
            INNER JOIN EDIFICIO 
                ON EDIFICIO_FORMACION.edificio_id = EDIFICIO.edificio_id
            INNER JOIN FORMACION
                ON EDIFICIO_FORMACION.formacion_id = FORMACION.formacion_id
            WHERE
                edificio_formacion_id = '$this->edificio_formacion_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByFormatID() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE formacion_id = '$this->formacion_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchFormatsBuildings() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE
                edificio_id = '$this->edificio_id' AND
                formacion_id = '$this->formacion_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchActiveImpFormats() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE
                edificio_id = '$this->edificio_id' AND
                formacion_id = '$this->formacion_id' AND
                estado LIKE '%" . $this->estado . "%' AND
                estado != 'vencido'
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