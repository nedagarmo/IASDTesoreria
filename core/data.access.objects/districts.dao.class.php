<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class districts {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function districts() {
        $this->conn = new connection();
    }

    function get_all_count_districts() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM distrito');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_districts_list($association) {
        $record_set = $this->conn->db->Execute('SELECT * FROM distrito WHERE asociacion = ?',array($association));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_districts($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM distrito ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_districts($name) {
        $record_set = $this->conn->db->Execute('SELECT * FROM distrito WHERE nombre LIKE ? ', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_districts($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM distrito WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_districts_search($name, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM distrito WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM distrito ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_districts($name, $pastor, $association) {
        $response = $this->conn->db->Execute('INSERT INTO distrito(nombre, pastor, asociacion) VALUES(?,?,?) ', array($name, $pastor, $association));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_districts($id, $name, $pastor, $association) {
        return $this->conn->db->Execute('UPDATE distrito SET nombre = ?, pastor = ?, asociacion = ? WHERE id = ? ', array($name, $pastor, $association, $id));
    }

    function delete_districts($id) {
        return $this->conn->db->Execute('DELETE FROM distrito WHERE id = ?', array($id));
    }

}

?>
