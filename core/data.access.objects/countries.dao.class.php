<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class countries {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function countries() {
        $this->conn = new connection();
    }

    function get_all_count_countries() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM pais');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_countries_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM pais');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_countries($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM pais ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_countries($name) {
        $record_set = $this->conn->db->Execute('SELECT * FROM pais WHERE nombre LIKE ? ', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_countries($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM pais WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_countries_search($name, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM pais WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM pais ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_countries($name) {
        $response = $this->conn->db->Execute('INSERT INTO pais(nombre) VALUES(?) ', array($name));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_countries($id, $name) {
        return $this->conn->db->Execute('UPDATE pais SET nombre = ? WHERE id = ? ', array($name, $id));
    }

    function delete_countries($id) {
        return $this->conn->db->Execute('DELETE FROM pais WHERE id = ?', array($id));
    }

}

?>
