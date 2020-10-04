<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla perfiles
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class profiles {

    private $conn;

    function profiles() {
        $this->conn = new connection();
    }

    function get_all_count_profiles() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM perfil');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_profiles_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM perfil');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_profiles($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM perfil ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_profiles($name) {
        $record_set = $this->conn->db->Execute('SELECT id, nombre, tabla FROM perfil WHERE nombre = ?', array($name));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_profile($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM perfil WHERE id = ?', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_profile_search($name = "", $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM perfil WHERE nombre LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%" . $name . "%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM perfil ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_profile($name, $table) {
        return $this->conn->db->Execute('INSERT INTO perfil(nombre, tabla) VALUES(?, ?) ', array($name, $table));
    }

    function update_profile($id, $name) {
        return $this->conn->db->Execute('UPDATE perfil SET nombre = ?, tabla = ? WHERE id = ? ', array($name, $table, $id));
    }

    function delete_profile($id) {
        return $this->conn->db->Execute('DELETE FROM perfil WHERE id = ?', array($id));
    }

}

?>
