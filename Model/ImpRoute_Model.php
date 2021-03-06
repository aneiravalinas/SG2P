<?php

include_once './Model/Abstract_Model.php';

class ImpRoute_Model extends Abstract_Model {

    var $atributos;
    var $cumplimentacion_id;
    var $planta_id;
    var $ruta_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $fecha_cumplimentacion_inicio;
    var $fecha_cumplimentacion_fin;
    var $fecha_vencimiento;
    var $fecha_vencimiento_inicio;
    var $fecha_vencimiento_fin;
    var $nombre_doc;
    var $nombre_planta;
    var $nombre_edificio;
    var $edificio_id;

    function __construct() {
        $this->atributos = array('cumplimentacion_id','planta_id','ruta_id','estado','fecha_cumplimentacion', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'nombre_doc','nombre_planta', 'nombre_edificio', 'edificio_id');
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

    // Registra una cumplimentación.
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
        $this->cumplimentacion_id = $this->id_autoincrement;
        return $this->feedback;
    }

    // Modifica los datos de una cumplimentación
    function EDIT() {
        $this->query = "UPDATE PLANTA_RUTA SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
            ($this->nombre_doc == '' ? "" : "nombre_doc = '$this->nombre_doc', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE cumplimentacion_id = '$this->cumplimentacion_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Elimina una cumplimentación
    function DELETE() {
        $this->query = "
            DELETE FROM PLANTA_RUTA
            WHERE
                cumplimentacion_id = '$this->cumplimentacion_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de una Ruta que cumplan con los criterios establecidos.
    function searchCompletions() {
        $this->query = "
            SELECT PLANTA_RUTA.*, PLANTA.nombre as nombre_planta, EDIFICIO.nombre AS nombre_edificio
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            INNER JOIN EDIFICIO
                ON EDIFICIO.edificio_id = PLANTA.edificio_id
            WHERE
                PLANTA_RUTA.ruta_id = '$this->ruta_id' AND
                cumplimentacion_id LIKE '%" . $this->cumplimentacion_id . "%' AND
                PLANTA_RUTA.planta_id LIKE '%" . $this->planta_id . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                    . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                nombre_doc LIKE '%" . $this->nombre_doc . "%' AND
                EDIFICIO.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                PLANTA.nombre LIKE '%" . $this->nombre_planta . "%' AND
                EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de una Ruta en un Edificio que cumplan los criterios establecidos
    function SEARCH() {
        $this->query = "
            SELECT PLANTA_RUTA.*, PLANTA.nombre AS nombre_planta
            FROM PLANTA_RUTA
            INNER JOIN PLANTA
                ON PLANTA_RUTA.planta_id = PLANTA.planta_id
            WHERE   
                ruta_id = '$this->ruta_id' AND
                PLANTA.edificio_id = '$this->edificio_id' AND
                cumplimentacion_id LIKE '%" . $this->cumplimentacion_id . "%' AND
                PLANTA_RUTA.planta_id LIKE '%" . $this->planta_id . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                    . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                nombre_doc LIKE '%" . $this->nombre_doc . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones Activas (Pendientes o Cumplimentadas) de una Ruta en un Edificio
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
                nombre_doc LIKE '%" . $this->nombre_doc . "%' AND
                estado != 'vencido'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Consulta datos de una cumplimentación porID.
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
                cumplimentacion_id = '$this->cumplimentacion_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones por ID de Planta.
    function searchByPlantaID() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE planta_id = '$this->planta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones por ID de Ruta.
    function searchByRouteID() {
        $this->query = "
            SELECT * FROM PLANTA_RUTA
            WHERE ruta_id = '$this->ruta_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Búsqueda de cumplimentaciones por ID.
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

    // Búsqueda de cumplimentaciones de una Ruta en un Edificio
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