<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla acceso
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class donors {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function donors() {
        $this->conn = new connection();
    }

    function get_all_count_donors($church) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM donante WHERE iglesia = ?', array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_donors_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM donante');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_donors($church, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT d.*, i.nombre as iglesia_nombre FROM donante d INNER JOIN iglesia i ON d.iglesia = i.id WHERE d.iglesia = ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_donor($name, $church) {
        $record_set = $this->conn->db->Execute('SELECT * FROM donante WHERE nombre LIKE ? AND iglesia IN (?)', array("%".$name."%", $church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_donor($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM donante WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_donor_search($name, $church, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT d.*, i.nombre as iglesia_nombre FROM donante d INNER JOIN iglesia i ON d.iglesia = i.id WHERE d.nombre LIKE ? AND d.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%", $church));
        } else {
            $record_set = $this->conn->db->Execute('SELECT d.*, i.nombre as iglesia_nombre FROM donante d INNER JOIN iglesia i ON d.iglesia = i.id WHERE d.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_donor($name, $identification, $church) {
        $response = $this->conn->db->Execute('INSERT INTO donante(nombre, identificacion, iglesia) VALUES(?, ?, ?) ', array($name, $identification, $church));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_donor($id, $name, $identification, $church) {
        return $this->conn->db->Execute('UPDATE donante SET nombre = ?, identificacion = ?, iglesia = ? WHERE id = ? ', array($name, $identification, $church, $id));
    }

    function delete_donor($id) {
        return $this->conn->db->Execute('DELETE FROM donante WHERE id = ?', array($id));
    }

}

?>
