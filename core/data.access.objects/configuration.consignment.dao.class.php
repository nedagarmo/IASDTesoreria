<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla remesa_configuracion
 *
 * @author Nelson D. Garzón M.
 */
@session_start();
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class configuration_consignment {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function configuration_consignment() {
        $this->conn = new connection();
    }

    function get_all_count_configuration_consignment($consignment) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM remesa_configuracion WHERE remesa = ?', array($consignment));
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

    function get_all_configuration_consignment_list($consignment) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa_configuracion WHERE remesa = ?',array($consignment));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_configuration_consignment($consignment, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa_configuracion WHERE remesa = ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($consignment));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_configuration_consignment($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM remesa_configuracion WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_configuration_consignment($consignment, $percent, $inflow) {
        $response = $this->conn->db->Execute('INSERT INTO remesa_configuracion(remesa, porcentaje, entrada, fecha) VALUES(?, ?, ?, CURDATE()) ', array($consignment, $percent, $inflow));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_configuration_consignment($id, $consignment, $percent, $inflow) {
        return $this->conn->db->Execute('UPDATE remesa_configuracion SET remesa = ?, porcentaje = ?, entrada = ? WHERE id = ? ', array($consignment, $percent, $inflow, $id));
    }

    function delete_configuration_consignment($id) {
        return $this->conn->db->Execute('DELETE FROM remesa_configuracion WHERE id = ?', array($id));
    }

}

?>
