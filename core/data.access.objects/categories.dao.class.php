<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla acceso
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class categories {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function categories() {
        $this->conn = new connection();
    }

    function get_all_count_categories() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM categoria');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_categories_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM categoria');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_categories($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM categoria ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_categories($name) {
        $record_set = $this->conn->db->Execute('SELECT * FROM categoria WHERE nombre LIKE ?', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_categories($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM categoria WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_categories_search($name, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM categoria WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM categoria ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_categories($name, $description, $status) {
        $response = $this->conn->db->Execute('INSERT INTO categoria(nombre, descripcion, estado) VALUES(?, ?, ?) ', array($name, $description, $status));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_categories($id, $name, $description, $status) {
        return $this->conn->db->Execute('UPDATE categoria SET nombre = ?, descripcion = ?, estado = ? WHERE id = ? ', array($name, $description, $status, $id));
    }

    function delete_categories($id) {
        return $this->conn->db->Execute('DELETE FROM categoria WHERE id = ?', array($id));
    }

}

?>
