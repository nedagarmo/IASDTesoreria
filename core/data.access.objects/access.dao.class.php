<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla acceso
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class access {

    private $conn;

    function access() {
        $this->conn = new connection();
    }

    function get_all_count_access() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM acceso');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_access_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM acceso');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_access($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM acceso ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_access($profile) {
        $record_set = $this->conn->db->Execute('SELECT m.* FROM acceso a INNER JOIN modulo m ON a.modulo = m.id WHERE a.perfil = ?', array($profile));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function search_access_favorite($profile) {
        $record_set = $this->conn->db->Execute('SELECT m.* FROM acceso a INNER JOIN modulo m ON a.modulo = m.id WHERE a.perfil = ? AND m.favorito = 1 ', array($profile));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function search_access_category($profile) {
        $record_set = $this->conn->db->Execute('SELECT DISTINCT c.* FROM acceso a INNER JOIN modulo m ON a.modulo = m.id INNER JOIN categoria c ON m.categoria = c.id WHERE a.perfil = ? AND m.favorito = 1 ', array($profile));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function search_access_module_for_category($profile, $category) {
        $record_set = $this->conn->db->Execute('SELECT m.* FROM acceso a INNER JOIN modulo m ON a.modulo = m.id WHERE a.perfil = ? AND m.categoria = ? ', array($profile, $category));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_access($module, $profile) {
        $record_set = $this->conn->db->Execute('SELECT * FROM acceso WHERE modulo = ? AND perfil = ? ', array($module, $profile));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_access_search($filter, $value, $order, $index, $page) {
        if (!empty($filter)) {
            $record_set = $this->conn->db->Execute('SELECT * FROM acceso WHERE '.$filter.' LIKE ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($value));
        } else {
            $record_set = $this->conn->db->Execute('SELECT * FROM acceso ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_access($profile, $module) {
        return $this->conn->db->Execute('INSERT INTO acceso(perfil, modulo) VALUES(?, ?) ', array($profile, $module));
    }

    function update_access($id, $profile, $module) {
        return $this->conn->db->Execute('UPDATE acceso SET perfil = ?, modulo = ? WHERE id = ? ', array($profile, $module, $id));
    }

    function delete_access($id) {
        return $this->conn->db->Execute('DELETE FROM acceso WHERE id = ?', array($id));
    }

}

?>
