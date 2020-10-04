<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla rubro
 *
 * @author Nelson D. Garzón M.
 */
@session_start();
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class consignments {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function consignments() {
        $this->conn = new connection();
    }

    function get_all_count_consignments($church) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM remesa WHERE iglesia = ?', array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_consignments_list($church) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa WHERE iglesia = ?',array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function get_all_consignments_list_exclude($church, $consignment) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa WHERE iglesia = ? AND id NOT IN(?) ',array($church, $consignment));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_consignments($church, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT r.*, i.nombre as iglesia_nombre, (SELECT ra.valor FROM remesa_acumulado ra WHERE ra.remesa = r.id AND enviado = 0 ORDER BY ra.id DESC LIMIT 1) as acumulado FROM remesa r INNER JOIN iglesia i ON r.iglesia = i.id  WHERE r.iglesia = ? ORDER BY r.' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_consignments($concept, $church) {
        $record_set = $this->conn->db->Execute('SELECT r.* FROM remesa r  WHERE r.nombre LIKE ? AND r.iglesia IN (?)', array("%".$concept."%", $church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_consignment($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function get_mount_consignment($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa_acumulado WHERE remesa = ? AND enviado = 0 ORDER BY id DESC LIMIT 1 ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_consignments_search($concept, $church, $order, $index, $page) {
        if (!empty($concept)) {
            $record_set = $this->conn->db->Execute('SELECT r.*, i.nombre as iglesia_nombre FROM remesa r INNER JOIN iglesia i ON r.iglesia = i.id WHERE r.concepto LIKE ? AND r.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%".$concept."%", $church));
        } else {
            $record_set = $this->conn->db->Execute('SELECT r.*, i.nombre as iglesia_nombre FROM remesa r INNER JOIN iglesia i ON r.iglesia = i.id WHERE r.iglesia IN (?) ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_consignment($concept, $church) {
        $response = $this->conn->db->Execute('INSERT INTO remesa(concepto, iglesia) VALUES(?, ?) ', array($concept, $church));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        $this->update_mount_consignment($this->last_insert_id, '', 0);
        return $response;
    }

    function update_consignment($id, $concepto, $church) {
        return $this->conn->db->Execute('UPDATE remesa SET concepto = ?, iglesia = ? WHERE id = ? ', array($name, $church, $id));
    }

    function delete_consignment($id) {
        $this->conn->db->Execute('DELETE FROM remesa_acumulado WHERE remesa = ?', array($id));
        return $this->conn->db->Execute('DELETE FROM remesa WHERE id = ?', array($id));
    }
    
    function update_mount_consignment($consignment, $operation, $value){
        $consignment_mount = $this->get_mount_consignment($consignment)->fields['valor'];
        $new_value = 0;
        if($operation == '+'){
            $new_value = $consignment_mount + $value;
        }else if($operation == '-'){
            $new_value = $consignment_mount - $value;
        }
        $response = $this->conn->db->Execute('INSERT INTO remesa_acumulado(remesa, valor, fecha) VALUES(?, ?, CURDATE()) ', array($consignment, $new_value));
        return $response;
    }
    
    function insert_corresponding_consignment($inflow, $value, $operation){
        $record_set = $this->conn->db->Execute('select rc.* from remesa r INNER JOIN remesa_configuracion rc ON r.id = rc.remesa where r.iglesia = ? AND rc.entrada = ? ', array($_SESSION['church'], $inflow));
        if ($record_set != false) {
            while (!$record_set->EOF){
                $final_value = ($value * $record_set->fields['porcentaje'])/100;
                $this->update_mount_consignment($record_set->fields['remesa'], $operation, $final_value);  
                $record_set->MoveNext();
            }
        }
    }

}

?>
