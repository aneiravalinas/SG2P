<?php

include_once './Model/Abstract_Model.php';

class ImpRoute_Model extends Abstract_Model {

    var $atributos;
    var $planta_ruta_id;
    var $planta_id;
    var $ruta_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $fecha_vencimiento;
    var $nombre_doc;
    var $nombre_planta;
    var $nombre_edificio;
    var $edificio_id;

    function __construct() {
        $this->atributos = array('planta_ruta_id','planta_id','ruta_id','estado','fecha_cumplimentacion','fecha_vencimiento','nombre_doc','nombre_planta', 'nombre_edificio', 'edificio_id');
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
            INSERT INTO PLANTA_RUTA 
            (
                planta_id,
                ruta_id,
                estado,
                fecha_cumplimentacion,
                fecha_vencimiento,
                nombre_doc
            ) VALUES (
                '$this->planta_id',
                '$this->ruta_id',
                '$this->estado',
                '$this->fecha_cumplimentacion',
                '$this->fecha_vencimiento',
                '$this->nombre_doc'
            );
        ";

        $this->execute_single_query();
        $this->planta_ruta_id = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE PLANTA_RUTA SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
            ($this->nombre_doc == '' ? "" : "nombre_doc = '$this->nombre_doc', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE planta_ruta_id = '$this->planta_ruta_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM PLANTA_RUTA
            WHERE
                planta_ruta_id = '$this->planta_ruta_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT PLANTA_RUTA.*, PLANTA.nombre as nombre_planta, EDIFICIO.nombre AS nombre_edificio
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            INNER JOIN EDIFICIO
                ON EDIFICIO.edificio_id = PLANTA.edificio_id
            WHERE
                PLANTA_RUTA.ruta_id = '$this->ruta_id' AND
                planta_ruta_id LIKE '%" . $this->planta_ruta_id . "%' AND
                PLANTA_RUTA.planta_id LIKE '%" . $this->planta_id . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_cumplimentacion LIKE '%" . $this->fecha_cumplimentacion . "%' AND
                fecha_vencimiento LIKE '%" . $this->fecha_vencimiento . "%' AND
                nombre_doc LIKE '%" . $this->nombre_doc . "%' AND
                EDIFICIO.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                PLANTA.nombre LIKE '%" . $this->nombre_planta . "%' AND
                EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchImpRoutes() {
        $this->query = "
            SELECT PLANTA_RUTA.*, PLANTA.nombre AS nombre_planta
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            WHERE   
                ruta_id = '$this->ruta_id' AND
                PLANTA.edificio_id = '$this->edificio_id' AND
                planta_ruta_id LIKE '%" . $this->planta_ruta_id . "%' AND
                PLANTA_RUTA.planta_id LIKE '%" . $this->planta_id . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_cumplimentacion LIKE '%" .$this->fecha_cumplimentacion . "%' AND
                fecha_vencimiento LIKE '%" . $this->fecha_vencimiento . "%' AND
                nombre_doc LIKE '%" . $this->nombre_doc . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchActiveImpRoutes() {
        $this->query = "
            SELECT PLANTA_RUTA.*, PLANTA.nombre AS nombre_planta
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            WHERE
                ruta_id = '$this->ruta_id' AND
                PLANTA.edificio_id = '$this->edificio_id' AND
                PLANTA_RUTA.planta_id LIKE '%" . $this->planta_id . "%' AND
                fecha_cumplimentacion LIKE '%" . $this->fecha_cumplimentacion . "%' AND
                nombre_doc LIKE '%" . $this->nombre_doc . "%' AND
                estado != 'vencido'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT PLANTA_RUTA.*, PLANTA.nombre AS nombre_planta, PLANTA.edificio_id, EDIFICIO.username, RUTA.nombre AS nombre_ruta, RUTA.plan_id
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            INNER JOIN EDIFICIO
                ON PLANTA.edificio_id = EDIFICIO.edificio_id
            INNER JOIN RUTA
                ON PLANTA_RUTA.ruta_id = RUTA.ruta_id
            WHERE
                planta_ruta_id = '$this->planta_ruta_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByPlantaID() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE planta_id = '$this->planta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchByRouteID() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE ruta_id = '$this->ruta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchRoutesFloors() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE
                planta_id = '$this->planta_id' AND
                ruta_id = '$this->ruta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchRoutesBuildings($edificio_id) {
        $this->query = "
            SELECT PLANTA_RUTA.*
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            WHERE ruta_id = '$this->ruta_id' AND
                  PLANTA.edificio_id = '$edificio_id'
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