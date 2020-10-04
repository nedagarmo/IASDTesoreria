<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class departments {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function departments() {
        $this->conn = new connection();
    }

    function get_all_count_departments() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM departamento');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_departments_list($country) {
        $record_set = $this->conn->db->Execute('SELECT * FROM departamento WHERE pais = ?',array($country));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_departments($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM departamento ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_departments($name) {
        $record_set = $this->conn->db->Execute('SELECT * FROM departamento WHERE nombre LIKE ? ', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_departments($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM departamento WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_departments_search($name, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM departamento WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM departamento ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_departments($name, $country) {
        $response = $this->conn->db->Execute('INSERT INTO departamento(nombre, pais) VALUES(?,?) ', array($name, $country));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_departments($id, $name, $country) {
        return $this->conn->db->Execute('UPDATE departamento SET nombre = ?, pais = ? WHERE id = ? ', array($name, $country, $id));
    }

    function delete_departments($id) {
        return $this->conn->db->Execute('DELETE FROM departamento WHERE id = ?', array($id));
    }

}

?>
