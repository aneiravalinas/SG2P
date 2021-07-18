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

    function ADD()
    {
        // TODO: Implement ADD() method.
    }

    function EDIT()
    {
        // TODO: Implement EDIT() method.
    }

    function DELETE()
    {
        // TODO: Implement DELETE() method.
    }

    function SEARCH() {
        $this->query = "
            SELECT *
            FROM USUARIO
            WHERE
                dni LIKE '%" . $this->dni . "%' AND
                username LIKE '%" . $this->username . "%' AND
                rol LIKE '%" . $this->rol . "%' AND
                nombre LIKE '%" . $this->nombre . "%' AND
                apellidos LIKE '%" . $this->apellidos . "%' AND
                email LIKE '%" . $this->email . "%' AND
                telefono LIKE '%" . $this->telefono . "%'";

        $this->get_results_from_query();
        return $this->feedback;
    }

    // Get user by username
    function seek()
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