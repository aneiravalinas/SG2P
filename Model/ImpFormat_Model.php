<?php

include_once 'Abstract_Model.php';

class ImpFormat_Model extends Abstract_Model {
    var $atributos;
    var $edificio_formacion_id;
    var $edificio_id;
    var $formacion_id;
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
        $this->atributos = array('edificio_formacion_id','edificio_id','formacion_id','estado','fecha_planificacion', 'fecha_planificacion_inicio', 'fecha_planificacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'url_recurso','destinatarios','nombre_edificio');
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

    // Registra una Cumplimentación
    function ADD() {
        $this->query = "
            INSERT INTO EDIFICIO_FORMACION
            (
             edificio_id,
             formacion_id,
             estado,
             fecha_planificacion,
             fecha_vencimiento,
             url_recurso,
             destinatarios
            ) VALUES (
             '$this->edificio_id',
             '$this->formacion_id',
             '$this->estado',
             '$this->fecha_planificacion',
             '$this->fecha_vencimiento',
             '$this->url_recurso',
             '$this->destinatarios'
            );
        ";

        $this->execute_single_query();
        $this->edificio_formacion_id = $this->id_autoincrement;
        return $this->feedback;
    }

    // Modifica datos de una cumplimentación
    function EDIT() {
        $this->query = "UPDATE EDIFICIO_FORMACION SET " .
            ($this->fecha_planificacion == '' ? "" : "fecha_planificacion = '$this->fecha_planificacion', ") .
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
            ($this->url_recurso == '' ? "" : "url_recurso = '$this->url_recurso', ") .
            ($this->destinatarios == '' ? "" : "destinatarios = '$this->destinatarios', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE edificio_formacion_id = '$this->edificio_formacion_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Elimina una cumplimentación
    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_FORMACION
            WHERE
                edificio_formacion_id = '$this->edificio_formacion_id'
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de una Formación que cumpla con los criterios establecidos
    function searchCompletions() {
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
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_planificacion BETWEEN '" . ($this->fecha_planificacion_inicio == '' ? min_date : $this->fecha_planificacion_inicio) . "' AND '"
                                                    . ($this->fecha_planificacion_fin == '' ? max_date : $this->fecha_planificacion_fin) ."' AND
                estado LIKE '%" . $this->estado . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busa cumplimentaciones de una Formación en un Edificio que cumpla con los criterios establecidos
    function SEARCH() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE
                edificio_id = '$this->edificio_id' AND
                formacion_id = '$this->formacion_id' AND
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_planificacion BETWEEN '" . ($this->fecha_planificacion_inicio == '' ? min_date : $this->fecha_planificacion_inicio) . "' AND '"
                                                    . ($this->fecha_planificacion_fin == '' ? max_date : $this->fecha_planificacion_fin) ."' AND
                estado LIKE '%" . $this->estado . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Consulta datos de una cumplimentación por ID.
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

    // Consulta datos de una cumplimentación por ID de Formación.
    function searchByFormatID() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE formacion_id = '$this->formacion_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Consulta datos de una cumplimentación por ID de Formación.
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

    // Consulta cumplimentaciones ACTIVAS (Pendientes o Cumplimentadas) de una Formación en un Edificio.
    function searchActiveImpFormats() {
        $this->query = "
            SELECT * FROM EDIFICIO_FORMACION
            WHERE
                edificio_id = '$this->edificio_id' AND
                formacion_id = '$this->formacion_id' AND
                fecha_planificacion BETWEEN '" . ($this->fecha_planificacion_inicio == '' ? min_date : $this->fecha_planificacion_inicio) . "' AND '"
                                                    . ($this->fecha_planificacion_fin == '' ? max_date : $this->fecha_planificacion_fin) ."' AND
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