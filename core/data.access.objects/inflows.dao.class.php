<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla acceso
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class inflows {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function inflows() {
        $this->conn = new connection();
    }

    function get_all_count_inflows($church) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM entrada WHERE iglesia = ?', array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_inflows_list($church) {
        $record_set = $this->conn->db->Execute('SELECT * FROM entrada WHERE iglesia = ?',array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_inflows($church, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT e.*, i.nombre as iglesia_nombre FROM entrada e INNER JOIN iglesia i ON e.iglesia = i.id WHERE e.iglesia = ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_inflows($name, $church) {
        $record_set = $this->conn->db->Execute('SELECT e.* FROM entrada e INNER JOIN donante d ON e.donante = d.id WHERE e.nombre LIKE ? AND s.iglesia IN (?)', array("%".$name."%", $church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_inflows($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM entrada WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function get_envelope_inflows($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM sobre_entrada WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_inflows_search($name, $church, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT e.*, i.nombre as iglesia_nombre FROM entrada e INNER JOIN iglesia i ON e.iglesia = i.id WHERE e.nombre LIKE ? AND e.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%", $church));
        } else {
            $record_set = $this->conn->db->Execute('SELECT e.*, i.nombre as iglesia_nombre FROM entrada e INNER JOIN iglesia i ON e.iglesia = i.id WHERE e.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_inflows($name, $description, $church) {
        $response = $this->conn->db->Execute('INSERT INTO entrada(nombre, descripcion, iglesia) VALUES(?, ?, ?) ', array($name, $description, $church));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_inflows($id, $name, $description, $church) {
        return $this->conn->db->Execute('UPDATE entrada SET nombre = ?, descripcion = ?, iglesia = ? WHERE id = ? ', array($name, $description, $church, $id));
    }

    function delete_inflows($id) {
        return $this->conn->db->Execute('DELETE FROM entrada WHERE id = ?', array($id));
    }

}

?>
