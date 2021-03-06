<?php

include_once './Model/Abstract_Model.php';

class ImpDoc_Model extends Abstract_Model {
    var $atributos;
    var $cumplimentacion_id;
    var $edificio_id;
    var $documento_id;
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
        $this->atributos = array('cumplimentacion_id','edificio_id','documento_id','estado','fecha_cumplimentacion', 'fecha_cumplimentacion_inicio', 'fecha_cumplimentacion_fin',
            'fecha_vencimiento', 'fecha_vencimiento_inicio', 'fecha_vencimiento_fin', 'nombre_doc','nombre_edificio');
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
            INSERT INTO EDIFICIO_DOCUMENTO
            (
             edificio_id,
             documento_id,
             estado,
             fecha_cumplimentacion,
             fecha_vencimiento,
             nombre_doc
            ) VALUES (
            '$this->edificio_id',
            '$this->documento_id',
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

    // Modifica datos de una cumplimentación.
    function EDIT() {
        $this->query = "UPDATE EDIFICIO_DOCUMENTO SET " .
            ($this->fecha_cumplimentacion == '' ? "" : "fecha_cumplimentacion = '$this->fecha_cumplimentacion', ") .
            ($this->nombre_doc == '' ? "" : "nombre_doc = '$this->nombre_doc', ") .
            ($this->fecha_vencimiento == '' ? "" : "fecha_vencimiento = '$this->fecha_vencimiento', ") .
            ($this->estado == '' ? "" : "estado = '$this->estado'") .
            " WHERE cumplimentacion_id = '$this->cumplimentacion_id'";

        $this->execute_single_query();
        return $this->feedback;
    }

    // Elimina una cumplimentación.
    function DELETE() {
        $this->query = "
            DELETE FROM EDIFICIO_DOCUMENTO
            WHERE cumplimentacion_id = '$this->cumplimentacion_id'
        ";
        $this->execute_single_query();
        return $this->feedback;
    }


    // Busca cumplimentaciones de un Documento que cumplan con los criterios establecidos.
    function searchCompletions() {
        $this->query = "
            SELECT EDIFICIO_DOCUMENTO.*, EDIFICIO.nombre AS nombre_edificio
            FROM EDIFICIO_DOCUMENTO
            INNER JOIN EDIFICIO
                ON EDIFICIO_DOCUMENTO.edificio_id = EDIFICIO.edificio_id
            WHERE
                cumplimentacion_id LIKE '%" . $this->cumplimentacion_id . "%' AND
                EDIFICIO_DOCUMENTO.edificio_id LIKE '%" . $this->edificio_id . "%' AND
                documento_id = '$this->documento_id' AND
                estado LIKE '%" . $this->estado . "%' AND
                fecha_vencimiento BETWEEN '" . ($this->fecha_vencimiento_inicio == '' ? min_date : $this->fecha_vencimiento_inicio) . "' AND '"
                                                    . ($this->fecha_vencimiento_fin == '' ? max_date : $this->fecha_vencimiento_fin) ."' AND
                fecha_cumplimentacion BETWEEN '" . ($this->fecha_cumplimentacion_inicio == '' ? min_date : $this->fecha_cumplimentacion_inicio) . "' AND '"
                                                    . ($this->fecha_cumplimentacion_fin == '' ? max_date : $this->fecha_cumplimentacion_fin) ."' AND
                nombre_doc LIKE '%" . $this->nombre_doc . "%' AND
                EDIFICIO.nombre LIKE '%" . $this->nombre_edificio . "%'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Consulta datos de una cumplimentación por ID.
    function seek() {
        $this->query = "
            SELECT EDIFICIO_DOCUMENTO.*, EDIFICIO.username, EDIFICIO.nombre AS nombre_edificio, DOCUMENTO.nombre AS nombre_documento, DOCUMENTO.plan_id
            FROM EDIFICIO_DOCUMENTO
            INNER JOIN EDIFICIO
                ON EDIFICIO_DOCUMENTO.edificio_id = EDIFICIO.edificio_id
            INNER JOIN DOCUMENTO
                ON EDIFICIO_DOCUMENTO.documento_id = DOCUMENTO.documento_id
            WHERE
                cumplimentacion_id = '$this->cumplimentacion_id'
        ";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de un Documento.
    function searchByDocID() {
        $this->query = "
            SELECT * FROM EDIFICIO_DOCUMENTO
            WHERE documento_id = '$this->documento_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de un Documento en un Edificio.
    function searchDocsBuildings() {
        $this->query = "
            SELECT * FROM EDIFICIO_DOCUMENTO
            WHERE edificio_id = '$this->edificio_id' AND
                  documento_id = '$this->documento_id'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Busca cumplimentaciones de un Documento en un Edificio que cumplan con los criterios establecidos.
    function SEARCH() {
        $this->query = "
            SELECT * FROM EDIFICIO_DOCUMENTO
            WHERE
                edificio_id = '$this->edificio_id' AND
                documento_id = '$this->documento_id' AND
                cumplimentacion_id LIKE '%" . $this->cumplimentacion_id . "%' AND
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

    // Busca cumplimentaciones Activas (Pendientes o Cumplimentadas) de un Documento en un Edificio
    function searchActiveImpDocs() {
        $this->query = "
            SELECT * FROM EDIFICIO_DOCUMENTO
            WHERE
                edificio_id = '$this->edificio_id' AND
                documento_id = '$this->documento_id' AND
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