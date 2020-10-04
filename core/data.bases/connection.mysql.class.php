<?php

/**
 * Clase de conexión a la base de datos del sistema.
 *
 * @author Nelson D. Garzón M.
 */

ini_set('display_errors', 'On');
include_once(dirname(__FILE__) . '/../../libraries/adodb5/adodb.inc.php');

class connection {
    public $db;
    private $driver = "mysql";
    private $server = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "ec_tesoreria";
    
    function connection()
    {
        try {
            $this->db = ADONewConnection($this->driver);
            // $this->db->debug = true;
            $this->db->Connect($this->server, $this->user, $this->password, $this->database);
        } catch (Exception $e) {
            $this->db->Close();
            die($e->getMessage());
        }
    }
}
?>
