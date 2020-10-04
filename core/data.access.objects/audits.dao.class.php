<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla auditoria
 *
 * @author Nelson D. Garzón M.
 */

include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');

class audit {

    private $conn;
    public $last_insert_id;
    public $result_count;

    function audit() {
        $this->conn = new connection();
    }

    function get_all_count_audit() {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM auditoria');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_audit($order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT a.id, o.nombre as operacion, a.observacion, a.tabla, u.usuario, a.fecha, a.ip, i.nombre as iglesia FROM auditoria a INNER JOIN operacion o ON a.operacion = o.id INNER JOIN usuario u ON a.usuario = u.id INNER JOIN iglesia i ON a.iglesia = i.id ORDER BY a.' . $order . ' LIMIT ' . $index . ',' . $page);
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_audit($church) {
        $record_set = $this->conn->db->Execute('SELECT * FROM auditoria WHERE iglesia = ?', array("%".$church."%"));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_audit($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM auditoria WHERE id = ?', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_audit_search($church = "", $order, $index, $page) {
        if (!empty($church)) {
            $record_set = $this->conn->db->Execute('SELECT a.id, o.nombre as operacion, a.observacion, a.tabla, u.usuario, a.fecha, a.ip, i.nombre as iglesia FROM auditoria a INNER JOIN operacion o ON a.operacion = o.id INNER JOIN usuario u ON a.usuario = u.id INNER JOIN iglesia i ON a.iglesia = i.id WHERE a.iglesia = ? ORDER BY a.' . $order . ' LIMIT ' . $index . ',' . $page, array("%" . $church . "%"));
        } else {
            $record_set = $this->conn->db->Execute('SELECT a.id, o.nombre as operacion, a.observacion, a.tabla, u.usuario, a.fecha, a.ip, i.nombre as iglesia FROM auditoria a INNER JOIN operacion o ON a.operacion = o.id INNER JOIN usuario u ON a.usuario = u.id INNER JOIN iglesia i ON a.iglesia = i.id ORDER BY a.' . $order . ' LIMIT ' . $index . ',' . $page);
        }
        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_audit($operation, $observation, $table, $user, $ip, $church) {
        $response = $this->conn->db->Execute('INSERT INTO auditoria(operacion, observacion, tabla, usuario, fecha, ip, iglesia) VALUES(?, ?, ?, ?, CURDATE(), ?, ?) ', array($operation, $observation, $table, $user, $ip, $church));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_audit($id, $operation, $observation, $table, $user, $date, $ip, $church) {
        return $this->conn->db->Execute('UPDATE auditoria SET operacion = ?, observacion = ?, tabla = ?, usuario = ?, fecha = ?, ip = ?, iglesia = ? WHERE id = ? ', array($operation, $observation, $table, $user, $date, $ip, $church, $id));
    }

    function delete_audit($id) {
        return $this->conn->db->Execute('DELETE FROM auditoria WHERE id = ?', array($id));
    }

}

?>
