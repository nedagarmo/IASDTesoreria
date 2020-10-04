<?php

/**
 * Clase de métodos de inserción, modificación, eliminación y consulta sobre la tabla acceso
 *
 * @author Nelson D. Garzón M.
 */
include_once(dirname(__FILE__) . '/../data.bases/connection.mysql.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/dealings.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/inflows.dao.class.php');
include_once(dirname(__FILE__) . '/../data.access.objects/consignments.dao.class.php');

class envelope {

    private $conn;
    public $last_insert_id;
    public $result_count;
    public $dealings;
    public $inflows;
    public $consignments;

    function envelope() {
        $this->conn = new connection();
        $this->dealings = new dealings();
        $this->inflows = new inflows();
        $this->consignments = new consignments();
    }

    function get_all_count_envelope($church) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM sobre WHERE iglesia = ?', array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_count_inflows_by_envelope($envelope) {
        $record_set = $this->conn->db->Execute('SELECT COUNT(*) FROM sobre_entrada WHERE sobre = ?', array($envelope));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_envelope_list() {
        $record_set = $this->conn->db->Execute('SELECT * FROM sobre');
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_envelope($church, $order, $index, $page) {
        $record_set = $this->conn->db->Execute('SELECT s.*, i.nombre as iglesia_nombre, d.nombre as donante_nombre FROM sobre s INNER JOIN iglesia i ON s.iglesia = i.id INNER JOIN donante d ON s.donante = d.id WHERE s.iglesia = ? ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_all_inflows_by_envelope($envelope, $order) {
        $record_set = $this->conn->db->Execute('SELECT * FROM sobre_entrada WHERE sobre = ? ORDER BY ' . $order, array($envelope));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function search_envelope($donor, $church) {
        $record_set = $this->conn->db->Execute('SELECT s.*, d.nombre as donante_nombre FROM sobre s INNER JOIN donante d ON s.donante = d.id WHERE d.nombre LIKE ? AND s.iglesia IN (?)', array("%" . $donor . "%", $church));
        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_envelope($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM sobre WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_envelope_inflow($id) {
        $record_set = $this->conn->db->Execute('SELECT * FROM sobre_entrada WHERE id = ? ', array($id));

        if ($record_set != false) {
            return $record_set;
        } else {
            return null;
        }
    }

    function get_envelope_search($donor, $date_start, $date_end, $church, $order, $index, $page) {
        $reaminder_query = "";
        if (!empty($date_start) && !empty($date_end)) {
            $reaminder_query = " AND s.fecha BETWEEN '$date_start 00:00:00' AND '$date_end 23:59:59' ";
        }

        if (!empty($donor)) {
            $record_set = $this->conn->db->Execute('SELECT s.*, i.nombre as iglesia_nombre, d.nombre as donante_nombre FROM sobre s INNER JOIN iglesia i ON s.iglesia = i.id INNER JOIN donante d ON s.donante = d.id WHERE d.nombre LIKE ? AND s.iglesia IN (?) ' . $reaminder_query . ' ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array("%" . $donor . "%", $church));
        } else {
            $record_set = $this->conn->db->Execute('SELECT s.*, i.nombre as iglesia_nombre, d.nombre as donante_nombre FROM sobre s INNER JOIN iglesia i ON s.iglesia = i.id INNER JOIN donante d ON s.donante = d.id WHERE s.iglesia IN (?) ' . $reaminder_query . ' ORDER BY ' . $order . ' LIMIT ' . $index . ',' . $page, array($church));
        }

        if ($record_set != false) {
            $this->result_count = $record_set->RecordCount();
            return $record_set;
        } else {
            return null;
        }
    }

    function insert_envelope($number, $date, $donor, $church) {
        $response = $this->conn->db->Execute('INSERT INTO sobre(numero, fecha, donante, iglesia) VALUES(?, ?, ?, ?) ', array($number, $date, $donor, $church));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        return $response;
    }

    function update_envelope($id, $number, $date, $donor, $church) {
        return $this->conn->db->Execute('UPDATE sobre SET numero = ?, fecha = ?, donante = ?, iglesia = ? WHERE id = ? ', array($number, $date, $donor, $church, $id));
    }

    function delete_envelope($id) {
        return $this->conn->db->Execute('DELETE FROM sobre WHERE id = ?', array($id));
    }

    // Operations for sobre_entrada
    function insert_envelope_inflow($inflow, $envelope, $value) {
        $response = $this->conn->db->Execute('INSERT INTO sobre_entrada(entrada, sobre, valor) VALUES(?, ?, ?) ', array($inflow, $envelope, $value));
        $this->last_insert_id = $this->conn->db->Insert_ID();
        $this->dealings->insert_corresponding_dealings($inflow, $value, '+');
        $this->consignments->insert_corresponding_consignment($inflow, $value, '+');
        return $response;
    }

    function update_envelope_inflow($id, $inflow, $envelope, $value) {
        return $this->conn->db->Execute('UPDATE sobre_entrada SET entrada = ?, sobre = ?, valor = ? WHERE id = ? ', array($inflow, $envelope, $value, $id));
    }

    function delete_envelope_inflow($id) {
        $record = $this->inflows->get_envelope_inflows($id)->fields;
        $result = $this->conn->db->Execute('DELETE FROM sobre_entrada WHERE id = ?', array($id));
        $this->dealings->insert_corresponding_dealings($record['entrada'], $record['valor'], '-');
        $this->consignments->insert_corresponding_consignment($record['entrada'], $record['valor'], '-');
        return $result;
    }

}

?>
