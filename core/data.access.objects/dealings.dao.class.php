<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla rubro
 *
 * @author Nelson D. Garzón M.
 */

@session_start();
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/entries.dao.class.php');

class dealings {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function dealings() {
        $this->conn = new connection();
    }

    function get_all_count_dealings($entries) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM movimiento WHERE rubro = ?', array($entries));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_dealings_type_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM movimiento_tipo');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_dealings($entries, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT * FROM movimiento WHERE rubro = ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($entries));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_dealings($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM movimiento WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }
    
    function insert_corresponding_dealings($inflow, $value, $operation){
        $record_set = $this->conn->db->Execute('select rc.* from rubro r INNER JOIN rubro_configuracion rc ON r.id = rc.rubro where r.iglesia = ? AND rc.entrada = ? ', array($_SESSION['church'], $inflow));
        if ($record_set != false) {
            while (!$record_set->EOF){
                $final_value = ($value * $record_set->fields['porcentaje'])/100;
                switch ($operation){
                    case '+':
                        $this->insert_dealings($record_set->fields['rubro'], 'Entrada automática conforme a configuración por registro de sobre.', $final_value, 1, null);
                        break;
                    case '-':
                        $this->insert_dealings($record_set->fields['rubro'], 'Salida automática conforme a configuración por eliminación de entrada del sobre.', $final_value, 2, null);
                        break;
                    default:
                        break;
                }
                $record_set->MoveNext();
            }
        }
    }

    function insert_dealings($entry, $concept, $value, $type, $entry_aux) {
        $response = $this->conn->db->Execute('INSERT INTO movimiento(rubro, concepto, valor, tipo, rubro_aux, fecha) VALUES(?, ?, ?, ?, ?, CURDATE()) ', array($entry, $concept, $value, $type, $entry_aux));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        
        // new record in 'rubro_acumulado'
        $entries = new entries();
        switch ($type){
            case 1:
                $entries->update_mount_entries($entry, '+', $value);
                break;
            case 2:
                $entries->update_mount_entries($entry, '-', $value);
                break;
            case 3:
                $entries->update_mount_entries($entry, '-', $value);
                $entries->update_mount_entries($entry_aux, '+', $value);
                break;
            default:
                break;
        }
        
        return $response;
    }

    function update_dealings($id, $entry, $concept, $value, $type, $entry_aux) {
        return $this->conn->db->Execute('UPDATE movimiento SET rubro = ?, concepto = ?, valor = ?, tipo = ?, rubro_aux = ? WHERE id = ? ', array($entry, $concept, $value, $type, $entry_aux, $id));
    }

    function delete_dealings($id) {
        return $this->conn->db->Execute('DELETE FROM movimiento WHERE id = ?', array($id));
    }

}

?>
