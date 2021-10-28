<?php

include_once 'Abstract_Model.php';

class ImpProc_Model extends Abstract_Model {
    var $atributos;
    var $edificio_procedimiento_id;
    var $edificio_id;
    var $procedimiento_id;
    var $estado;
    var $fecha_cumplimentacion;
    var $fecha_cumplimentacion_inicio;
    var $fecha_cumplimentacion_fin;
    var $fecha_vencimiento;
    var $fecha_vencimiento_inicio;
    var $fecha_vencimiento_fin;
    var $nombre_doc;
    var $nombre_edificio;

    function __construct() {
        $this->atributos = array('edificio_procedimiento_id','edificio_id','procedimiento_id','estado','fecha_cumplimentacion', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'nombre_doc', 'nombre_edificio');
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

    // Registra una Cumplimentación.
    function ADD() {
        $this->query = "
            INSERT INTO EDIFICIO_PROCEDIMIENTO 
            (
                edificio_id,
                procedimiento_id,
                estado,
                fecha_cumplimentacion,
                fecha_vencimiento,
                nombre_doc
            ) VALUES (
                '$this->edificio_id',
                '$this->procedimiento_id',
                '$this->estado',
                '$this->fecha_cumplimentacion',
                '$this->fecha_vencimiento',
                '$this->nombre_doc'
            );
        ";

        $this->execute_single_query();
        $this->edificio_procedimiento_id = $this->id_autoincrement;
        return $this->feedback;
    }

    // Modifica datos de una cumplimentación.
    function EDIT() {
        $this->query = "UPDATE EDIFICIO_PROCEDIMIENTO SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
            ($this->nombre_doc == '' ? "" : "nombre_doc = '$this->nombre_doc', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE edificio_procedimiento_id = '$this->edificio_procedimiento_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Elimina una Cumplimentación
    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_PROCEDIMIENTO
            WHERE
                edificio_procedimiento_id = '$this->edificio_procedimiento_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Busca Cumplimentaciones de un Procedimiento que cumplan con los criterios establecidos.
    function searchCompletions() {
        $this->query = "
            SELECT EDIFICIO_PROCEDIMIENTO.*, EDIFICIO.nombre AS nombre_edificio
            FROM EDIFICIO_PROCEDIMIENTO
            INNER JOIN EDIFICIO
                ON EDIFICIO_PROCEDIMIENTO.edificio_id = EDIFICIO.edificio_id
            WHERE
                procedimiento_id = '$this->procedimiento_id' AND
                edificio_procedimiento_id LIKE '%" . $this->edificio_procedimiento_id . "%' AND
                EDIFICIO_PROCEDIMIENTO.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                        . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                nombre_doc LIKE '%". $this->nombre_doc . "%' AND
                EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca Cumplimentaciones de un Procedimiento en un Edificio que cumplan con los criterios establecidos.
    function SEARCH() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE
                edificio_id = '$this->edificio_id' AND
                procedimiento_id = '$this->procedimiento_id' AND
                edificio_procedimiento_id LIKE '%" . $this->edificio_procedimiento_id . "%' AND
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

    // Consulta datos de una cumplimentación por ID.
    function seek() {
        $this->query = "
            SELECT EDIFICIO_PROCEDIMIENTO.*, EDIFICIO.username, EDIFICIO.nombre AS nombre_edificio, PROCEDIMIENTO.nombre AS nombre_procedimiento, PROCEDIMIENTO.plan_id
            FROM EDIFICIO_PROCEDIMIENTO
            INNER JOIN EDIFICIO
                ON EDIFICIO_PROCEDIMIENTO.edificio_id = EDIFICIO.edificio_id
            INNER JOIN PROCEDIMIENTO
                ON EDIFICIO_PROCEDIMIENTO.procedimiento_id = PROCEDIMIENTO.procedimiento_id
            WHERE
                edificio_procedimiento_id = '$this->edificio_procedimiento_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de un Procedimiento.
    function searchByProcID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE procedimiento_id = '$this->procedimiento_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de un Procedimiento en un Edificio.
    function searchProcsBuildings() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE 
                edificio_id = '$this->edificio_id' AND
                procedimiento_id = '$this->procedimiento_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones Activas (Pendientes o Cumplimentadas) de un Procedimiento en un Edificio.
    function searchActiveImpProcs() {
        $this->query = "
            SELECT * FROM EDIFICIO_PROCEDIMIENTO
            WHERE
                procedimiento_id = '$this->procedimiento_id' AND
                edificio_id = '$this->edificio_id' AND
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