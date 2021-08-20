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
    var $mensaje;

    function __construct() {
        $this->atributos = array('id_notificacion','username','edificio_id','plan_id','leido','fecha','mensaje');
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
        // TODO: Implement EDIT() method.
    }

    function DELETE() {
        // TODO: Implement DELETE() method.
    }

    function SEARCH() {
        // TODO: Implement SEARCH() method.
    }

    function seek() {
        // TODO: Implement seek() method.
    }

    function setAttributes($atributos) {
        foreach($this->atributos as $atributo) {
            if(isset($atributos[$atributo])) {
                $this->$atributo = $atributos[$atributo];
            }
        }
    }

}
