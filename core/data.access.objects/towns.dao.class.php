<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class towns {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function towns() {
        $this->conn = new connection();
    }

    function get_all_count_towns() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM municipio');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_towns_list($department) {
        $record_set = $this->conn->db->Execute('SELECT * FROM municipio WHERE departamento = ?',array($department));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_towns($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM municipio ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_towns($name) {
        $record_set = $this->conn->db->Execute('SELECT * FROM municipio WHERE nombre LIKE ? ', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_towns($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM municipio WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_towns_search($name, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM municipio WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM municipio ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_towns($name, $department) {
        $response = $this->conn->db->Execute('INSERT INTO municipio(nombre, departamento) VALUES(?,?) ', array($name, $department));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_towns($id, $name, $department) {
        return $this->conn->db->Execute('UPDATE municipio SET nombre = ?, departamento = ? WHERE id = ? ', array($name, $department, $id));
    }

    function delete_towns($id) {
        return $this->conn->db->Execute('DELETE FROM municipio WHERE id = ?', array($id));
    }

}

?>
