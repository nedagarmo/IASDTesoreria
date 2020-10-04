<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class association {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function association() {
        $this->conn = new connection();
    }

    function get_all_count_association() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM asociacion');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_association_list($town) {
        $record_set = $this->conn->db->Execute('SELECT * FROM asociacion WHERE municipio = ?',array($town));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_association($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM asociacion ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_association($name) {
        $record_set = $this->conn->db->Execute('SELECT * FROM asociacion WHERE nombre LIKE ? ', array("%".$name."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_association($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM asociacion WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_association_search($name, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM asociacion WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM asociacion ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_association($name, $telephone, $address, $town) {
        $response = $this->conn->db->Execute('INSERT INTO asociacion(nombre, telefono, direccion, municipio) VALUES(?,?,?,?) ', array($name, $telephone, $address, $town));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_association($id, $name, $telephone, $address, $town) {
        return $this->conn->db->Execute('UPDATE asociacion SET nombre = ?, telefono = ?, direccion = ?, municipio = ? WHERE id = ? ', array($name, $telephone, $address, $town, $id));
    }

    function delete_association($id) {
        return $this->conn->db->Execute('DELETE FROM asociacion WHERE id = ?', array($id));
    }

}

?>
