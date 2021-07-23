<?php

include_once './Model/Abstract_Model.php';

class User_Model extends Abstract_Model {

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

    function ADD() {
        $this->query = "
            INSERT INTO USUARIO (
                        dni,
                        username,
                        password,
                        rol,
                        nombre,
                        apellidos,
                        email,
                        telefono,
                        foto_perfil
            ) VALUES (
                      '$this->dni',
                      '$this->username',
                      '$this->password',
                      '$this->rol',
                      '$this->nombre',
                      '$this->apellidos',
                      '$this->email',
                      '$this->telefono',
                      '$this->foto_perfil'
            );
        ";

        $this->execute_single_query();
        return $this->feedback;
    }

    function EDIT() {
        $this->query = "UPDATE USUARIO SET " .
                ($this->password == '' ? "" : "password = '$this->password', ") .
                ($this->rol == '' ? "" : "rol = '$this->rol', ") .
                ($this->nombre == '' ? "" : "nombre = '$this->nombre', ") .
                ($this->apellidos == '' ? "" : "apellidos = '$this->apellidos', ") .
                ($this->email == '' ? "" : "email = '$this->email', ") .
                ($this->foto_perfil == '' ? "" : "foto_perfil = '$this->foto_perfil', ") .
                ($this->telefono == '' ? "" : "telefono = '$this->telefono'") .
            " WHERE username = '$this->username'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function editProfile() {
        $this->query = "UPDATE USUARIO SET " .
                ($this->password == '' ? "" : "password = '$this->password', ") .
                ($this->foto_perfil == '' ? "" : "foto_perfil = '$this->foto_perfil', ") .
                ($this->email == '' ? "" : "email = '$this->email', ") .
                ($this->telefono == '' ? "" : "telefono = '$this->telefono'") .
            " WHERE username = '$this->username'";

        $this->execute_single_query();
        return $this->feedback;
    }

    function DELETE() {
        $this->query = "
            DELETE FROM USUARIO
            WHERE username = '$this->username';
        ";

        $this->execute_single_query();
        return $this->feedback;
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

    // Get user by unique fields.
    function seekByID($key, $value) {
        $this->query = "
            SELECT * FROM USUARIO
            WHERE $key = '$value'";

        $this->get_one_result_from_query();
        return $this->feedback;
    }

    function searchByRol($rol) {
        $this->query = "
            SELECT * FROM USUARIO
            WHERE rol = '$rol'
        ";

        $this->get_results_from_query();
        return $this->feedback;
    }

}

?>