<?php

include_once './Model/Abstract_Model.php';

class BuildPlan_Model extends Abstract_Model {
    var $atributos;
    var $edificio_id;
    var $plan_id;
    var $fecha_asignacion;
    var $fecha_asignacion_inicio;
    var $fecha_asignacion_fin;
    var $fecha_cumplimentacion;
    var $fecha_cumplimentacion_inicio;
    var $fecha_cumplimentacion_fin;
    var $fecha_vencimiento;
    var $fecha_vencimiento_inicio;
    var $fecha_vencimiento_fin;
    var $estado;
    var $nombre_edificio;
    var $nombre_plan;

    function __construct() {
        $this->atributos = array('edificio_id','plan_id','fecha_asignacion','fecha_cumplimentacion', 'fecha_vencimiento', 'estado','nombre_edificio','nombre_plan',
                                    'fecha_asignacion_inicio', 'fecha_asignacion_fin', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin', 'fecha_vencimiento_inicio',
                                    'fecha_vencimiento_fin');
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
            INSERT INTO EDIFICIO_PLAN
            (
                edificio_id,
                plan_id,
                fecha_asignacion,
                fecha_cumplimentacion,
                estado
            ) VALUES (
                '$this->edificio_id',
                '$this->plan_id',
                '$this->fecha_asignacion',
                '$this->fecha_cumplimentacion',
                '$this->estado'
            );
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE EDIFICIO_PLAN SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE 
                edificio_id = '$this->edificio_id' AND
                plan_id = '$this->plan_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_PLAN
            WHERE 
                  edificio_id = '$this->edificio_id' AND
                  plan_id = '$this->plan_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT EDIFICIO_PLAN.*, EDIFICIO.nombre AS nombre_edificio
            FROM EDIFICIO_PLAN
            INNER JOIN EDIFICIO
            ON EDIFICIO_PLAN.edificio_id = EDIFICIO.edificio_id
            WHERE EDIFICIO_PLAN.plan_id = '$this->plan_id' AND
                  EDIFICIO_PLAN.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                  estado LIKE '%" . $this->estado . "%' AND
                  fecha_asignacion BETWEEN '" . ($this->fecha_asignacion_inicio == '' ? min_date : $this->fecha_asignacion_inicio) . "' AND '"
                                                            . ($this->fecha_asignacion_fin == '' ? max_date : $this->fecha_asignacion_fin) ."' AND
                  fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                            . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                  fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                            . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                  EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%'
            ORDER BY estado, edificio_id
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Recupera la información de la asignación entre un Plan y un Edificio filtrando por ID.
    function seek() {
        $this->query = "
            SELECT * FROM EDIFICIO_PLAN
            WHERE 
                edificio_id = '$this->edificio_id' AND
                plan_id = '$this->plan_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByBuildingID() {
        $this->query = "
            SELECT * FROM EDIFICIO_PLAN
            WHERE edificio_id = '$this->edificio_id';
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchBuildingsCandidates() {
        $this->query = "
            SELECT * FROM EDIFICIO
            WHERE edificio_id NOT IN (
                SELECT edificio_id
                FROM EDIFICIO_PLAN
                WHERE plan_id = '$this->plan_id'
            )
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchActivesByPlanID() {
        $this->query = "
            SELECT EDIFICIO_PLAN.*, EDIFICIO.nombre AS nombre_edificio 
            FROM EDIFICIO_PLAN
            INNER JOIN EDIFICIO
                ON EDIFICIO_PLAN.edificio_id = EDIFICIO.edificio_id
            WHERE 
                  EDIFICIO_PLAN.plan_id = '$this->plan_id' AND
                  estado != 'vencido'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    /*
     *  - Recupera la información de las asignaciones entre Plan y Edificio, junto con el nombre del Edificio y el nombre del Plan.
     */
    function searchBuildPlans() {
        $this->query = "
            SELECT EDIFICIO_PLAN.*, EDIFICIO.nombre AS nombre_edificio, PLAN.nombre AS nombre_plan
            FROM EDIFICIO_PLAN
            INNER JOIN EDIFICIO 
                ON EDIFICIO.edificio_id = EDIFICIO_PLAN.edificio_id
            INNER JOIN PLAN
                ON PLAN.plan_id = EDIFICIO_PLAN.plan_id
            WHERE EDIFICIO_PLAN.plan_id LIKE '%" . $this->plan_id . "%' AND
                  EDIFICIO_PLAN.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                  estado LIKE '%" . $this->estado . "%' AND
                  fecha_asignacion BETWEEN '" . ($this->fecha_asignacion_inicio == '' ? min_date : $this->fecha_asignacion_inicio) . "' AND '"
                                                    . ($this->fecha_asignacion_fin == '' ? max_date : $this->fecha_asignacion_fin) ."' AND
                  fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                    . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                  fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                  EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%' AND
                  PLAN.nombre LIKE '%" . $this->nombre_plan . "%'
            ORDER BY estado, edificio_id, plan_id
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    /*
     *  - Recupera la información de las asignaciones entre Plan y Edificio, junto con el nombre del Edificio y el nombre del Plan, donde el plan esté asignado al usuario
     *    en sesión.
     */
    function searchBuildPlansByResp($username) {
        $this->query = "
            SELECT EDIFICIO_PLAN.*, EDIFICIO.nombre AS nombre_edificio, PLAN.nombre AS nombre_plan
            FROM EDIFICIO_PLAN
            INNER JOIN EDIFICIO 
                ON EDIFICIO.edificio_id = EDIFICIO_PLAN.edificio_id
            INNER JOIN PLAN
                ON PLAN.plan_id = EDIFICIO_PLAN.plan_id
            WHERE EDIFICIO_PLAN.plan_id LIKE '%" . $this->plan_id . "%' AND
                  EDIFICIO_PLAN.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                  estado LIKE '%" . $this->estado . "%' AND
                  fecha_asignacion BETWEEN '" . ($this->fecha_asignacion_inicio == '' ? min_date : $this->fecha_asignacion_inicio) . "' AND '"
                                                    . ($this->fecha_asignacion_fin == '' ? max_date : $this->fecha_asignacion_fin) ."' AND
                  fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                    . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                  fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                  EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%' AND
                  PLAN.nombre LIKE '%" . $this->nombre_plan . "%' AND
                  EDIFICIO.username = '$username'
            ORDER BY estado, edificio_id, plan_id
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Recupera la información de las asignaciones ACTIVAS entre Planes y el Edificio del Portal, junto con el nombre del Plan.
    function searchPortalPlans() {
        $this->query = "
            SELECT EDIFICIO_PLAN.*, PLAN.nombre AS nombre_plan
            FROM EDIFICIO_PLAN
            INNER JOIN PLAN
                ON PLAN.plan_id = EDIFICIO_PLAN.plan_id
            WHERE
                edificio_id = '$this->edificio_id' AND
                estado != 'vencido' AND
                PLAN.nombre LIKE '%" . $this->nombre_plan . "%'
            ORDER BY estado DESC
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