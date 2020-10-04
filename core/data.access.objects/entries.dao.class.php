<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla rubro
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class entries {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function entries() {
        $this->conn = new connection();
    }

    function get_all_count_entries($church) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM rubro WHERE iglesia = ?', array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_entries_list($church) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro WHERE iglesia = ?',array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function get_all_entries_list_exclude($church, $entry) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro WHERE iglesia = ? AND id NOT IN(?) ',array($church, $entry));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_entries($church, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT r.*, i.nombre as iglesia_nombre, (SELECT ra.valor FROM rubro_acumulado ra WHERE ra.rubro = r.id ORDER BY ra.id DESC LIMIT 1) as acumulado FROM rubro r INNER JOIN iglesia i ON r.iglesia = i.id  WHERE r.iglesia = ? ORDER BY r.' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_entries($name, $church) {
        $record_set = $this->conn->db->Execute('SELECT r.* FROM rubro r  WHERE r.nombre LIKE ? AND r.iglesia IN (?)', array("%".$name."%", $church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_entries($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function get_mount_entry($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro_acumulado WHERE rubro = ? ORDER BY id DESC LIMIT 1 ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_entries_search($name, $church, $order, $index, $page) {
        if (!empty($name)) {
            $record_set = $this->conn->db->Execute('SELECT r.*, i.nombre as iglesia_nombre FROM rubro r INNER JOIN iglesia i ON r.iglesia = i.id WHERE r.nombre LIKE ? AND r.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$name."%", $church));
        } else {
            $record_set = $this->conn->db->Execute('SELECT r.*, i.nombre as iglesia_nombre FROM rubro r INNER JOIN iglesia i ON r.iglesia = i.id WHERE r.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_entries($name, $description, $church) {
        $response = $this->conn->db->Execute('INSERT INTO rubro(nombre, descripcion, iglesia) VALUES(?, ?, ?) ', array($name, $description, $church));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        $this->update_mount_entries($this->last_insert_id, '', 0);
        return $response;
    }

    function update_entries($id, $name, $description, $church) {
        return $this->conn->db->Execute('UPDATE rubro SET nombre = ?, descripcion = ?, iglesia = ? WHERE id = ? ', array($name, $description, $church, $id));
    }

    function delete_entries($id) {
        return $this->conn->db->Execute('DELETE FROM rubro WHERE id = ?', array($id));
    }
    
    function update_mount_entries($entry, $operation, $value){
        $entry_mount = $this->get_mount_entry($entry)->fields['valor'];
        $new_value = 0;
        if($operation == '+'){
            $new_value = $entry_mount + $value;
        }else if($operation == '-'){
            $new_value = $entry_mount - $value;
        }
        $response = $this->conn->db->Execute('INSERT INTO rubro_acumulado(rubro, valor, fecha) VALUES(?, ?, CURDATE()) ', array($entry, $new_value));
        return $response;
    }

}

?>
