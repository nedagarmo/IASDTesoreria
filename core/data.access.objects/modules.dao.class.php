<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla modulos
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class modules {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function modules() {
        $this->conn = new connection();
    }

    function get_all_count_modules() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM modulo');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_modules_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM modulo');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_modules($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM modulo ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_modules($name) {
        $record_set = $this->conn->db->Execute('SELECT id, nombre, identificador, descripcion, ruta, icono, categoria, favorito FROM modulo WHERE nombre = ?', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_module($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM modulo WHERE id = ?', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_module_search($name = "", $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM modulo WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%" . $name . "%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM modulo ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_module($name, $identificator, $description, $path, $icon, $categoria, $favorito) {
        $response = $this->conn->db->Execute('INSERT INTO modulo(nombre, identificador, descripcion, ruta, icono, categoria, favorito) VALUES(?, ?, ?, ?, ?, ?, ?) ', array($name, $identificator, $description, $path, $icon, $categoria, $favorito));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_module($id, $name, $identificator, $description, $path, $icon, $categoria, $favorito) {
        return $this->conn->db->Execute('UPDATE modulo SET nombre = ?, identificador = ?, descripcion = ?, ruta = ?, icono = ?, categoria = ?, favorito = ? WHERE id = ? ', array($name, $identificator, $description, $path, $icon, $categoria, $favorito, $id));
    }

    function delete_module($id) {
        return $this->conn->db->Execute('DELETE FROM modulo WHERE id = ?', array($id));
    }

}

?>
