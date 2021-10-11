<?php

include_once 'Abstract_Model.php';

class ImpSim_Model extends Abstract_Model {
    var $atributos;
    var $edificio_simulacro_id;
    var $edificio_id;
    var $simulacro_id;
    var $estado;
    var $fecha_planificacion;
    var $fecha_vencimiento;
    var $url_recurso;
    var $destinatarios;
    var $nombre_edificio;
    var $fecha_planificacion_inicio;
    var $fecha_planificacion_fin;
    var $fecha_vencimiento_inicio;
    var $fecha_vencimiento_fin;

    function __construct() {
        $this->atributos = array('edificio_simulacro_id','simulacro_id','edificio_id','estado','fecha_planificacion','fecha_vencimiento', 'fecha_vencimiento_inicio',
                                    'fecha_vencimiento_fin', 'url_recurso','destinatarios','nombre_edificio','fecha_planificacion_inicio','fecha_planificacion_fin');
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
             fecha_vencimiento,
             url_recurso,
             destinatarios
            ) VALUES (
            '$this->edificio_id',
            '$this->simulacro_id',
            '$this->estado',
            '$this->fecha_planificacion',
            '$this->fecha_vencimiento',
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
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
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
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_planificacion BETWEEN '" . ($this->fecha_planificacion_inicio == '' ? min_date : $this->fecha_planificacion_inicio) . "' AND '"
                                                    . ($this->fecha_planificacion_fin == '' ? max_date : $this->fecha_planificacion_fin) ."' AND
                estado LIKE '%" . $this->estado . "%'
            ORDER BY estado, EDIFICIO_SIMULACRO.edificio_id
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
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_planificacion BETWEEN '" . ($this->fecha_planificacion_inicio == '' ? min_date : $this->fecha_planificacion_inicio) . "' AND '"
                                                        . ($this->fecha_planificacion_fin == '' ? max_date : $this->fecha_planificacion_fin) ."' AND
                estado LIKE '%" . $this->estado . "%' 
            ORDER BY estado
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
                fecha_planificacion BETWEEN '" . ($this->fecha_planificacion_inicio == '' ? min_date : $this->fecha_planificacion_inicio) . "' AND '"
                                                    . ($this->fecha_planificacion_fin == '' ? max_date : $this->fecha_planificacion_fin) ."' AND
                estado != 'vencido'
            ORDER BY estado DESC, fecha_planificacion DESC
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }


    function seek() {
        $this->query = "
            SELECT EDIFICIO_SIMULACRO.*, EDIFICIO.username, EDIFICIO.nombre AS nombre_edificio, SIMULACRO.nombre AS nombre_simulacro, SIMULACRO.plan_id
            FROM EDIFICIO_SIMULACRO
            INNER JOIN EDIFICIO 
                ON EDIFICIO_SIMULACRO.edificio_id = EDIFICIO.edificio_id
            INNER JOIN SIMULACRO
                ON EDIFICIO_SIMULACRO.simulacro_id = SIMULACRO.simulacro_id
            WHERE
                edificio_simulacro_id = '$this->edificio_simulacro_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
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