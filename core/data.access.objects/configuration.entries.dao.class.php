<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla rubro
 *
 * @author Nelson D. Garzón M.
 */
@session_start();
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class configuration_entries {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function configuration_entries() {
        $this->conn = new connection();
    }

    function get_all_count_configuration_entries($entries) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM rubro_configuracion WHERE rubro = ?', array($entries));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function get_sum_configuration_by_dealing($inflow){
        $record_set = $this->conn->db->Execute('SELECT SUM(total) as total FROM (SELECT SUM(rc.porcentaje) as total FROM rubro_configuracion rc INNER JOIN rubro r ON rc.rubro = r.id WHERE r.iglesia = ? AND rc.entrada = ? UNION SELECT SUM(rc.porcentaje) as total FROM remesa_configuracion rc INNER JOIN remesa r ON rc.remesa = r.id WHERE r.iglesia = ? AND rc.entrada = ?) vtable', array($_SESSION['church'], $inflow, $_SESSION['church'], $inflow));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_configuration_entries_list($entries) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro_configuracion WHERE rubro = ?',array($entries));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_configuration_entries($entries, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro_configuracion WHERE rubro = ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($entries));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_configuration_entries($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM rubro_configuracion WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_configuration_entries($entry, $percent, $inflow) {
        $response = $this->conn->db->Execute('INSERT INTO rubro_configuracion(rubro, porcentaje, entrada, fecha) VALUES(?, ?, ?, CURDATE()) ', array($entry, $percent, $inflow));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_configuration_entries($id, $entry, $percent, $inflow) {
        return $this->conn->db->Execute('UPDATE rubro_configuracion SET rubro = ?, porcentaje = ?, entrada = ? WHERE id = ? ', array($entry, $percent, $inflow, $id));
    }

    function delete_configuration_entries($id) {
        return $this->conn->db->Execute('DELETE FROM rubro_configuracion WHERE id = ?', array($id));
    }

}

?>
