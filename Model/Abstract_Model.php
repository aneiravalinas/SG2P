<?php

include_once './Config/config.php';

abstract class Abstract_Model {

    private static $db_host = host;
    private static $db_user = user;
    private static $db_pass = pass;
    private static $db_name = database;
    private static $db_test = test_database;

    private $conn;

    protected $query;
    protected $rows = array();

//    protected $id_autoincrement;

    public $ok = true;
    public $code = '00000';
    public $resource = '';
    public $feedback = array();

    abstract protected function fill_fields();
    abstract protected function ADD();
    abstract protected function EDIT();
    abstract protected function DELETE();
    abstract protected function SEARCH();
    abstract protected function seek();

    //Crea una conexión con la base de datos definida a partir de las constantes en './Config/config.php'
    function connection() {
        if (isset($_SESSION['test']) && $_SESSION['test'] === true){
            $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass);
            if (!$this->conn->select_db(self::$db_test)){
                $fileSQL = file_get_contents('./Config/prevendb_test.sql');
                $this->conn->multi_query($fileSQL);
                while ($this->conn->more_results()) {
                    $this->conn->next_result();
                }
            }
            return($this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_test) or die('fallo conexion'));
        } else {
            $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass);
            if (!$this->conn->select_db(self::$db_name)){
                $fileSQL = file_get_contents('./Config/prevendb.sql');
                $this->conn->multi_query($fileSQL);
                while ($this->conn->more_results()) {
                    $this->conn->next_result();
                }
            }
            return($this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name) or die('fallo conexion'));
        }
    }

    //Cierra la conexión creada
    private function close_connection() {
        $this->conn->close();
    }

    //Prepara el array feedback a devolver como respuesta
    protected function construct_response() {
        $this->feedback['ok'] = $this->ok;
        $this->feedback['code'] = $this->code;
        $this->feedback['resource'] = $this->resource;
    }

    //Ejecuta una query
    protected function execute_single_query() {
        if (!$this->connection()) {                 // Error de conexión
            $this->ok = false;
            $this->code = 'DB_ERR';
        } else {
            if ($this->conn->query($this->query)) { // Éxito de SQL
                $this->ok = true;
                $this->code = 'QRY_OK';
//                $this->id_autoincrement = mysqli_insert_id($this->conn); //En caso de autoincrement,
//                // recupera la clave generada
            } else {            // Error de SQL
                $this->ok = false;
                $this->code = 'QRY_KO';
            }
            $this->close_connection();
        }
        $this->construct_response();
    }

    //Obtiene resultados de una query
    protected function get_results_from_query() {
        if (!$this->connection()) {                 // Error de conexión
            $this->ok = false;
            $this->code = 'DB_ERR';
        } else {
            $result = $this->conn->query($this->query);
            if ($result) {
                $this->ok = true;
                $this->rows = array();
                if ($result->num_rows == 0) {       // El recordset vuelve vacío
                    $this->code = 'QRY_EMPT';
                    $this->resource = array();
                } else {                            // El recordset vuelve con datos
                    for($i=0; $i<$result->num_rows; $i++){
                        $this->rows[] = $result->fetch_assoc();
                    }
                    $result->close();
                    $this->code = 'QRY_DATA';
                    $this->resource = $this->rows;
                }
            } else {                                // Error de SQL
                $this->ok = false;
                $this->code = 'QRY_KO';
            }
            $this->close_connection();
        }
        $this->construct_response();
    }

    //Obtiene un único resultado de una query
    protected function get_one_result_from_query() {
        if (!$this->connection()) {                 // Error de conexión
            $this->ok = false;
            $this->code = 'DB_ERR';
        } else {
            $result = $this->conn->query($this->query);
            if ($result) {
                $this->ok = true;
                if ($result->num_rows == 0) {       // El recordset vuelve vacío
                    $this->code = 'QRY_EMPT';
                    $this->resource = '';
                } else {                            // El recordset vuelve con datos
                    $this->resource = $result->fetch_assoc();
                    $this->code = 'QRY_DATA';
                }
            } else {                                // Error de SQL
                $this->ok = false;
                $this->code = 'QRY_KO';
            }
            $this->close_connection();
        }
        $this->construct_response();
    }

}

?>