<?php

include_once './Model/Abstract_Model.php';

class Usuario_Model extends Abstract_Model {

    var $atributos;
    var $dni;
    var $username;
    var $password;
    var $rol;
    var $nombre;
    var $apellidos;
    var $email;
    var $telefono;
    var $foto_perfil;

    function __construct()
    {
        $this->atributos = array('dni','username','password','rol','nombre','apellidos','email','telefono','foto_perfil');
        $this->fill_fields();
    }

    protected function fill_fields()
    {
        foreach ($this->atributos as $atributo) {
            if(isset($_POST[$atributo])) {
                $this->$atributo = $_POST[$atributo];
            } else {
                $this->$atributo = '';
            }
        }
    }

    protected function ADD()
    {
        // TODO: Implement ADD() method.
    }

    protected function EDIT()
    {
        // TODO: Implement EDIT() method.
    }

    protected function DELETE()
    {
        // TODO: Implement DELETE() method.
    }

    protected function SEARCH()
    {
        // TODO: Implement SEARCH() method.
    }

    // Get user by username
    protected function seek()
    {
        $this->query = "
            SELECT * FROM USUARIO
            WHERE username = '$this->username'
        ";
        $this->get_one_result_from_query();
        return $this->feedback;
    }

}

?>