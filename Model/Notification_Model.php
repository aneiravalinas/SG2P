<?php

include_once 'Abstract_Model.php';

class Notification_Model extends Abstract_Model {
    var $atributos;
    var $id_notificacion;
    var $username;
    var $edificio_id;
    var $plan_id;
    var $leido;
    var $fecha;
    var $fecha_inicio;
    var $fecha_fin;
    var $mensaje;

    function __construct() {
        $this->atributos = array('id_notificacion','username','edificio_id','plan_id','leido','fecha','fecha_inicio','fecha_fin','mensaje');
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
            INSERT INTO NOTIFICACION
            (
                username,
                edificio_id,
                plan_id,
                fecha,
                mensaje
            ) VALUES (
                '$this->username',
                '$this->edificio_id',
                '$this->plan_id',
                 NOW(),
                '$this->mensaje'
            );
        ";

        $this->execute_single_query();
        $this->id_notificacion = $this->id_autoincrement;
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE NOTIFICACION SET " .
            ($this->leido == '' ? "" : "leido = '$this->leido'") .
            " WHERE id_notificacion = '$this->id_notificacion'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM NOTIFICACION
            WHERE
                id_notificacion = '$this->id_notificacion'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function SEARCH() {
        $this->query = "
            SELECT NOTIFICACION.*, PLAN.nombre AS nombre_plan, EDIFICIO.nombre AS nombre_edificio
            FROM NOTIFICACION
            INNER JOIN EDIFICIO
                ON NOTIFICACION.edificio_id = EDIFICIO.edificio_id
            INNER JOIN PLAN
                ON NOTIFICACION.plan_id = PLAN.plan_id
            WHERE
                NOTIFICACION.username = '$this->username' AND
                NOTIFICACION.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                NOTIFICACION.plan_id LIKE '%" . $this->plan_id . "%' AND
                fecha BETWEEN '" . ($this->fecha_inicio == '' ? min_date : $this->fecha_inicio) . "' AND '"
                                                    . ($this->fecha_fin == '' ? max_date : $this->fecha_fin) ."' AND
                leido LIKE '%" . $this->leido . "%'
            ORDER BY leido DESC, fecha DESC
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function seek() {
        $this->query = "
            SELECT NOTIFICACION.*, PLAN.nombre AS nombre_plan, EDIFICIO.nombre AS nombre_edificio
            FROM NOTIFICACION
            INNER JOIN EDIFICIO
                ON NOTIFICACION.edificio_id = EDIFICIO.edificio_id
            INNER JOIN PLAN
                ON NOTIFICACION.plan_id = PLAN.plan_id
            WHERE
                NOTIFICACION.id_notificacion = '$this->id_notificacion'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchUnReadByUsername() {
        $this->query = "
            SELECT * FROM NOTIFICACION
            WHERE
                username = '$this->username' AND
                leido = 'no'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchBuildingsByUsername() {
        $this->query = "
            SELECT DISTINCT NOTIFICACION.edificio_id, EDIFICIO.nombre AS nombre_edificio
            FROM NOTIFICACION
            INNER JOIN EDIFICIO
                ON EDIFICIO.edificio_id = NOTIFICACION.edificio_id
            WHERE
                NOTIFICACION.username = '$this->username'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    function searchPlansByUsername() {
        $this->query = "
            SELECT DISTINCT NOTIFICACION.plan_id, PLAN.nombre AS nombre_plan
            FROM NOTIFICACION
            INNER JOIN PLAN
                ON PLAN.plan_id = NOTIFICACION.plan_id
            WHERE
                NOTIFICACION.username = '$this->username'
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
